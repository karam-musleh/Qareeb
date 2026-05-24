<?php

namespace App\Http\Controllers\Api\Initiatives;

use App\Enum\InitiativeStatus;
use App\Enum\InitiativeType;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeInitiativeStatusRequest;
use App\Http\Requests\InitiativeRequest;
use App\Http\Resources\InitiativeResource;
use App\Mail\InitiativeApprovedMail;
use App\Mail\InitiativeRejectedMail;
use App\Models\Initiative;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InitiativeController extends Controller
{
    use ApiResponseTrait;
    /*
    |--------------------------------------------------------------------------
    | Public Routes
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $perPage = Request()->query('per_page', 10);
        $initiatives = Initiative::active()
            ->with(['location', 'hub:id, name ,slug', 'creator:id,name'])
            ->when($request->type, fn($q) => $q->ofType(InitiativeType::from($request->type)))
            ->latest()
            ->paginate($perPage);

        return $this->successResponse(InitiativeResource::collection($initiatives));
    }
public function show(Initiative $initiative)
{
    $user = Auth::guard('api')->user();

    $isOwner = $initiative->created_by === $user->id;
    $isAdmin = $user->isAdmin();

    if (!$isOwner && !$isAdmin && $initiative->status !== InitiativeStatus::ACTIVE) {
        return $this->errorResponse(__('messages.not_found'), 404);
    }

    $initiative->load(['location', 'hub', 'creator']);

    return $this->successResponse(new InitiativeResource($initiative));
}

    /*
    |--------------------------------------------------------------------------
    | Protected Routes (auth:api)
    |--------------------------------------------------------------------------
    */

    public function store(InitiativeRequest $request)
    {
        // $user = Auth::guard('api')->user();
        try {
            DB::beginTransaction();

            $data                = $request->validated();
            $data['status']      = InitiativeStatus::PENDING;
            $data['created_by']  = Auth::id();

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('initiatives', 'custom');
            }

            $initiative = Initiative::create($data);

            DB::commit();

            return $this->successResponse(
                new InitiativeResource($initiative),
                __('messages.initiative_created'),
                201
            );
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'DEBUG ERROR',
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ], 500);
        }
    }

    public function update(InitiativeRequest $request, Initiative $initiative)
    {
        if ($initiative->created_by !== Auth::id()) {
            return $this->errorResponse(__('messages.forbidden'), 403);
        }

        if ($initiative->status === InitiativeStatus::ACTIVE) {
            return $this->errorResponse(__('messages.cannot_edit_active_initiative'), 403);
        }

        try {
            DB::beginTransaction();

            $data = $request->validated();


            if ($request->hasFile('image')) {
                // حذف الصورة القديمة
                if ($initiative->image) {
                    Storage::disk('custom')->delete($initiative->image);
                }
                $data['image'] = $request->file('image')->store('initiatives', 'custom');
            }

            $initiative->update($data);

            DB::commit();

            return $this->successResponse(
                new InitiativeResource($initiative->fresh(['location', 'hub', 'creator'])),
                __('messages.initiative_updated')
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse(
                __('messages.initiative_update_failed'),
                500,
                ['error' => $e->getMessage()]
            );
        }
    }

    public function destroy(Initiative $initiative)
    {
        $user = Auth::guard('api')->user();

        if ($initiative->created_by !== Auth::id() && !$user->isAdmin()) {
            return $this->errorResponse(__('messages.forbidden'), 403);
        }

        if ($initiative->image) {
            Storage::disk('custom')->delete($initiative->image);
        }

        $initiative->delete();

        return $this->successResponse(null, __('messages.initiative_deleted'));
    }

    public function myInitiatives()
    {
        $initiatives = Initiative::with(['location', 'hub:id,name'])
            ->where('created_by', Auth::id())
            ->latest()
            ->paginate(10);

        return $this->successResponse(
            InitiativeResource::collection($initiatives),
            __('messages.my_initiatives_retrieved')
        );
    }
    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */


    public function adminIndex(Request $request)
    {

        $initiatives = Initiative::with(['location', 'hub', 'creator'])
            ->when($request->status, fn($q) => $q->where('status', InitiativeStatus::from($request->status)))
            ->when($request->type, fn($q) => $q->ofType(InitiativeType::from($request->type)))
            ->latest()
            ->paginate(10);

        return $this->successResponse(InitiativeResource::collection($initiatives));
    }

    public function changeStatus(ChangeInitiativeStatusRequest $request, Initiative $initiative)
    {
        $newStatus = InitiativeStatus::from($request->status);

        $initiative->update(['status' => $newStatus]);

        $this->sendStatusEmail($initiative, $newStatus->value, $request->rejection_reason);

        return $this->successResponse(
            new InitiativeResource($initiative->fresh()),
            'Initiative status changed to ' . $newStatus->value
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Private
    |--------------------------------------------------------------------------
    */

    private function sendStatusEmail(Initiative $initiative, string $status, ?string $rejectionReason = null): void
    {
        try {
            if ($status === InitiativeStatus::ACTIVE->value) {
                Mail::to($initiative->creator->email)
                    ->queue(new InitiativeApprovedMail($initiative));
            } elseif ($status === InitiativeStatus::REJECTED->value) {
                Mail::to($initiative->creator->email)
                    ->queue(new InitiativeRejectedMail($initiative, $rejectionReason));
            }
        } catch (\Exception $e) {
            \Log::error(__('messages.failed_to_send_initiative_status_email') . ' ' . $e->getMessage());
        }
    }
}
