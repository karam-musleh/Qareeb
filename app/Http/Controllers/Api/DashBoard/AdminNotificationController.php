<?php

namespace App\Http\Controllers\Api\DashBoard;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class AdminNotificationController extends Controller
{

    use ApiResponseTrait;
    // جميع الإشعارات
    public function index(Request $request)
    {
        $user = auth()->guard('api')->user();

        // الإشعارات مع pagination
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // عدد الإشعارات غير المقروءة
        $unreadCount = $user->unreadNotifications()->count();

        return $this->successResponse([
            'notifications' => NotificationResource::collection($notifications),
            'unread_count' => $unreadCount,
        ], __('messages.notifications_fetched'));
    }

    // عدد الإشعارات غير المقروءة فقط
    public function unreadCount()
    {
        $user = auth()->guard('api')->user();
        $count = $user->unreadNotifications()->count();

        return $this->successResponse(['unread_count' => $count], __('messages.unread_count_retrieved'));
    }

    // وضع علامة "مقروء" على إشعار
    public function markAsRead($id)
    {
        $user = auth()->guard('api')->user();

        $notification = $user->notifications()
            ->findOrFail($id);

        $notification->markAsRead();

        return response()->json([
            'success' => true,
            'message' => __('messages.notification_marked_as_read'),
        ]);
    }

    // وضع علامة "مقروء" على جميع الإشعارات
    public function markAllAsRead()
    {
        $user = auth()->guard('api')->user();

        $user->unreadNotifications()
            ->update(['read_at' => now()]);

        return $this->successResponse(null, __('messages.all_notifications_marked_as_read'));
    }

    // حذف إشعار
    public function delete($id)
    {
        $user = auth()->guard('api')->user();

        $notification = $user->notifications()
            ->findOrFail($id);

        $notification->delete();

        return $this->successResponse(null, __('messages.notification_deleted'));
    }
}
