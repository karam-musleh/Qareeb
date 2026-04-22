<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\HubResource;
use App\Models\Hub;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    use ApiResponseTrait;


    public function index(Request $request): JsonResponse
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return $this->errorResponse(__('messages.unauthorized'), 401);
        }

        $perPage = (int) $request->query('per_page', 12);
        $perPage = max(1, min($perPage, 100)); // التحقق من الحد الأدنى والأقصى

        $favorites = $user->favorites()
            ->with([
                'location.parent',
                'owner:id,name,email',
                'images:id,imageable_id,path,type',
                'services:id,name',
            ])
            ->paginate($perPage);

        return $this->successResponse(
            HubResource::collection($favorites),
            __('messages.favorites_retrieved')
        );
    }

    /**
     * إضافة Hub إلى المفضلة
     * POST /api/favorites
     */
    public function store(Hub $hub): JsonResponse
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return $this->errorResponse(__('messages.unauthorized'), 401);
        }

        if (!$hub->isApproved() && !$user->isAdmin()) {
            return $this->errorResponse(
                __('messages.hub_not_available'),
                403
            );
        }

        if ($user->hasFavorite($hub)) {
            return $this->errorResponse(
                __('messages.already_in_favorites'),
                422
            );
        }

        $user->favorites()->syncWithoutDetaching([$hub->id]);

        $hub->load([
            'location',
            'owner',
            'images',
            'services',
            'customServices',
            'offers',
            'bookings',
            'reviews',
            'galleryImages',
            'hubSocialAccounts'
        ]);

        return $this->successResponse(
            new HubResource($hub),
            __('messages.added_to_favorites'),
            201
        );
    }

    /**
     * حذف Hub من المفضلة
     * DELETE /api/favorites/{hub}
     *
     * Hub يتم ربطه من الـ slug تلقائياً (Model Binding)
     */
    public function destroy(Hub $hub): JsonResponse
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return $this->errorResponse(__('messages.unauthorized'), 401);
        }

        if (!$user->hasFavorite($hub)) {
            return $this->errorResponse(
                __('messages.not_in_favorites'),
                404
            );
        }

        $user->favorites()->detach($hub->id);

        return $this->successResponse(
            [],
            __('messages.   ')
        );
    }

    /**
     * Toggle Favorite
     * POST /api/favorites/{hub}/toggle
     *
     * Hub يتم ربطه من الـ slug تلقائياً (Model Binding)
     */
    public function toggle(Hub $hub): JsonResponse
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return $this->errorResponse(__('messages.unauthorized'), 401);
        }

        // التحقق من أن Hub معروض
        if (!$hub->isApproved() && !$user->isAdmin()) {
            return $this->errorResponse(
                __('messages.hub_not_available'),
                403
            );
        }

        $isFavorited = $user->toggleFavorite($hub);

        return $this->successResponse(
            [
                'hub_slug' => $hub->slug, // ✅ إرجاع slug بدل id
                'is_favorited' => $isFavorited,
            ],
            $isFavorited
                ? __('messages.added_to_favorites')
                : __('messages.removed_from_favorites')
        );
    }
}
