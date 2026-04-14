<?php

namespace App\Http\Controllers\Api\Hubs;

use App\Http\Controllers\Controller;
use App\Http\Requests\reviewRequest;
use App\Http\Resources\ReviewResorce;
use App\Models\Hub;
use App\Models\Review;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    use ApiResponseTrait;

    /**
     * إضافة تقييم جديد للهب
     */
    public function store(reviewRequest $request, Hub $hub)
    {
        $user = Auth::guard('api')->user();

        // التحقق من أن المستخدم لم يقيّم الهب من قبل
        if (Review::userAlreadyReviewed($user->id, $hub->id)) {
            return $this->errorResponse(__('messages.already_rated'), 422);
        }

        // إنشاء التقييم
        $review = Review::create([

            'user_id' => $user->id,
            'hub_id' => $hub->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $data = [
            'review' => $review,
            'average_rating' => $hub->averageRating(),
        ];

return $this->successResponse($data, __('messages.review_created'), 201);    }

    /**
     * تحديث التقييم (المستخدم يعدّل تقييمه فقط)
     */
    public function update(reviewRequest $request, Hub $hub)
    {
        $user = Auth::guard('api')->user();
        $review = Review::getUserReview($user->id, $hub->id);

        if (!$review) {
            return $this->errorResponse(__('messages.review_not_found'), 404);
        }

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $data = [
            'review' => $review,
            'average_rating' => $hub->averageRating(),
        ];

        return $this->successResponse(new ReviewResorce($review), __('messages.review_updated'));
    }

    /**
     * حذف التقييم
     */
    public function destroy(Hub $hub)
    {
        $user = Auth::guard('api')->user();
        $review = Review::getUserReview($user->id, $hub->id);

        if (!$review) {
            return $this->errorResponse(__('messages.review_not_found'), 404);
        }

        $review->delete();

        $data = [
            'average_rating' => $hub->averageRating(),
        ];

        return $this->successResponse($data, __('messages.review_deleted'));
    }

    /**
     * عرض جميع التقييمات للهب
     */
    public function index(Hub $hub)
    {
        $reviews = $hub->reviewsWithUsers();

        $data = [
            'reviews' => $reviews,
            'average_rating' => $hub->averageRating(),
            'review_count' => $hub->reviewCount(),
        ];

        return $this->successResponse($data, __('messages.reviews_fetched_successfully'));
    }

    /**
     * عرض التقييم الخاص بالمستخدم (إن وجد)
     */
    public function getUserReview(Hub $hub)
    {
        $user = Auth::guard('api')->user();
        $review = Review::getUserReview($user->id, $hub->id);

        $data = [
            'review' => $review,
            'has_reviewed' => $review !== null,
        ];

        $message = $review ? __('messages.user_review_fetched_successfully') : __('messages.user_has_not_reviewed');

        return $this->successResponse($data, $message);
    }
}
