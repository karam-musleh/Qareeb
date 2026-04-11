<?php

namespace App\Http\Controllers;

use App\Http\Requests\reviewRequest;
use App\Models\Review;
use App\Models\Hub;
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
        $user = Auth::user();

        // التحقق من أن المستخدم لم يقيّم الهب من قبل
        if (Review::userAlreadyReviewed($user->id, $hub->id)) {
            return $this->errorResponse('أنت قمت بتقييم هذا الهب بالفعل', 422);
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

        return $this->successResponse($data, 'تم إضافة التقييم بنجاح', 201);
    }

    /**
     * تحديث التقييم (المستخدم يعدّل تقييمه فقط)
     */
    public function update(reviewRequest $request, Hub $hub)
    {
        $user = Auth::user();
        $review = Review::getUserReview($user->id, $hub->id);

        if (!$review) {
            return $this->errorResponse('لم تقم بتقييم هذا الهب', 404);
        }

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $data = [
            'review' => $review,
            'average_rating' => $hub->averageRating(),
        ];

        return $this->successResponse($data, 'تم تحديث التقييم بنجاح');
    }

    /**
     * حذف التقييم
     */
    public function destroy(Hub $hub)
    {
        $user = Auth::user();
        $review = Review::getUserReview($user->id, $hub->id);

        if (!$review) {
            return $this->errorResponse('لم تقم بتقييم هذا الهب', 404);
        }

        $review->delete();

        $data = [
            'average_rating' => $hub->averageRating(),
        ];

        return $this->successResponse($data, 'تم حذف التقييم بنجاح');
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

        return $this->successResponse($data, 'تم جلب التقييمات بنجاح');
    }

    /**
     * عرض التقييم الخاص بالمستخدم (إن وجد)
     */
    public function getUserReview(Hub $hub)
    {
        $user = Auth::user();
        $review = Review::getUserReview($user->id, $hub->id);

        $data = [
            'review' => $review,
            'has_reviewed' => $review !== null,
        ];

        $message = $review ? 'تقييمك للهب' : 'لم تقم بتقييم هذا الهب بعد';

        return $this->successResponse($data, $message);
    }
}
