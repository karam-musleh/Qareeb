<?php

namespace App\Http\Controllers\Api\DashBoard;

use App\Http\Controllers\Controller;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    use ApiResponseTrait;
    /**
     * عرض جميع المستخدمين للادمن
     * GET /api/admin/users
     */
    public function index(): JsonResponse
    {
        try {
            // Pagination
            $perPage = request()->query('per_page', 10);
            $page = request()->query('page', 1);

            // Search & Filter
            $query = User::query();

            // البحث بالاسم والايميل والهاتف
            if (request()->has('search')) {
                $search = request()->get('search');
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            }

            // تصفية حسب الدور
            if (request()->has('role') && request()->get('role') !== '') {
                $query->where('role', request()->get('role'));
            }

            // ترتيب النتائج
            $sortBy = request()->get('sort_by', 'created_at');
            $sortOrder = request()->get('sort_order', 'desc');
            $query->orderBy($sortBy, $sortOrder);

            // احصل على النتائج مع البيانات المرتبطة
            $users = $query->with('location')
                ->paginate($perPage, ['*'], 'page', $page);
            return $this->successResponse(
                UserResource::collection($users),
                'Users fetched successfully',
                200,
                [
                    'pagination' => [
                        'total' => $users->total(),
                        'per_page' => $users->perPage(),
                        'current_page' => $users->currentPage(),
                        'last_page' => $users->lastPage(),
                        'from' => $users->firstItem(),
                        'to' => $users->lastItem(),
                    ]
                ]
            );


        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ في جلب المستخدمين',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * عرض مستخدم محدد
     * GET /api/admin/users/{id}
     */
    public function show($id): JsonResponse
    {
        try {
            $user = User::with(['location', 'hubs', 'reviews'])
                ->find($id);

            if (!$user) {
                return $this->errorResponse('المستخدم غير موجود', 404);
            }

            return $this->successResponse(
                new UserResource($user),
            'User fetched successfully'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('حدث خطأ في جلب بيانات المستخدم', 500, $e->getMessage());
        }
    }

    /**
     * POST /api/admin/users
     */
    public function store(UserRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            // إذا تم توفير كلمة المرور، تأكد من تشفيرها
            if (isset($validated['password'])) {
                $validated['password'] = bcrypt($validated['password']);
            }

            $user = User::create($validated);

            return $this->successResponse(
                new UserResource($user),
                'User created successfully',
                201
            );
        } catch (\Exception $e) {
            return $this->errorResponse('حدث خطأ في إنشاء المستخدم', 500, $e->getMessage());
        }
    }

    /**
     * تحديث مستخدم
     * PUT /api/admin/users/{id}
     */
    public function update(UserRequest $request, $id): JsonResponse
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return $this->errorResponse('المستخدم غير موجود', 404);
            }

            $validated = $request->validated();

            // إذا تم تحديث كلمة المرور
            if (isset($validated['password'])) {
                $validated['password'] = bcrypt($validated['password']);
            }

            $user->update($validated);

            return $this->successResponse(
                new UserResource($user),

                'User updated successfully'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('حدث خطأ في تحديث المستخدم', 500, $e->getMessage());
        }
    }

    /**
     * حذف مستخدم
     * DELETE /api/admin/users/{id}
     */
    public function destroy($id): JsonResponse
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return $this->errorResponse('المستخدم غير موجود', 404);
            }

            // منع حذف الادمن
            if ($user->isAdmin()) {
                return $this->errorResponse('لا يمكن حذف مسؤول النظام', 403);
            }

            // حذف الصور المرتبطة
            $user->images()->delete();

            // حذف المستخدم
            $user->delete();

            return $this->successResponse(
                null,
                'User deleted successfully'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('حدث خطأ في حذف المستخدم', 500);
        }
    }


    //  * GET /api/admin/users/statistics

    public function statistics(): JsonResponse
    {
        try {
            $stats = [
                'total_users' => User::count(),
                'admins' => User::where('role', 'admin')->count(),
                'hub_owners' => User::where('role', 'hub_owner')->count(),
                'regular_users' => User::where('role', 'user')->count(),
                'verified_emails' => User::whereNotNull('email_verified_at')->count(),
                'new_users_this_month' => User::where('created_at', '>=', now()->startOfMonth())->count(),
            ];

            return $this->successResponse(
                $stats,
                'User statistics fetched successfully'
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                'حدث خطأ في جلب الإحصائيات',
                500
            );
        }
    }
}
