<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\DashBoard\AdminNotificationController;
use App\Http\Controllers\Api\DashBoard\LocationController;
use App\Http\Controllers\Api\DashBoard\OfferController;
use App\Http\Controllers\Api\Hubs\HubController;
use App\Http\Controllers\Api\Hubs\ReviewController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Version 1
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->middleware(['set_language'])->group(function () {

    // Route::post('locations', [LocationController::class, 'store']);


    Route::middleware(['auth:api', 'admin'])->group(function () {

        Route::post('locations', [LocationController::class, 'store']);
        Route::put('locations/{slug}', [LocationController::class, 'update']);
        Route::delete('locations/{slug}', [LocationController::class, 'destroy']);

        Route::get('/admin/users/statistics', [\App\Http\Controllers\Api\DashBoard\UserController::class, 'statistics']);

        Route::ApiResource('admin/users', \App\Http\Controllers\Api\DashBoard\UserController::class)->except(['create', 'edit']);
    });
    /*
    |--------------------------------------------------------------------------
    | Public Routes
    |--------------------------------------------------------------------------
    */

    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [RegisterController::class, 'login']);

    // Route::apiResource('location', LocationController::class)->only(['index', 'show']);



    /*
    |--------------------------------------------------------------------------
    | Protected Routes (auth:api)
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth:api')->group(function () {


        // Auth
        Route::post('/logout', [RegisterController::class, 'logout']);
        Route::post('/refresh', [RegisterController::class, 'refresh']);

        // Profile
        Route::get('/profile', [RegisterController::class, 'profile']);
        Route::put('/profile', [RegisterController::class, 'updateProfile']);


        /*
        |--------------------------------------------------------------------------
        | Hubs Routes
        |--------------------------------------------------------------------------
        */

        Route::prefix('hubs')->group(function () {

            // My hubs
            Route::get('/my', [HubController::class, 'myHubs']);

            // CRUD hubs
            Route::post('/', [HubController::class, 'store']);
            // Route::post('/', [HubController::class, 'store']);
            Route::get('/{slug}', [HubController::class, 'show']);
            Route::put('/{slug}', [HubController::class, 'update']);
            Route::delete('/{slug}', [HubController::class, 'destroy']);


            /*
            |--------------------------------------------------------------------------
            | Services inside hub
            |--------------------------------------------------------------------------
            */




            /*
            |--------------------------------------------------------------------------
            | Offers inside hub
            |--------------------------------------------------------------------------
            */

            Route::prefix('{hub}/offers')->group(function () {

                Route::get('/', [OfferController::class, 'index']);
                Route::get('/{offer}', [OfferController::class, 'show']);

                Route::post('/', [OfferController::class, 'store']);
                Route::put('/{offer}', [OfferController::class, 'update']);
                Route::delete('/{offer}', [OfferController::class, 'destroy']);
            });
        });
    });

    Route::middleware(['auth:api'])->group(function () {
        // جميع المستخدمين
        Route::get('services', [ServiceController::class, 'index']);
        Route::get('services/{id}', [ServiceController::class, 'show']);

        // Admin فقط
        Route::middleware(['auth:api', 'admin'])->group(function () {
            Route::post('services', [ServiceController::class, 'store']);
            Route::put('services/{id}', [ServiceController::class, 'update']);
            Route::delete('services/{id}', [ServiceController::class, 'destroy']);
        });
    });



    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware(['auth:api', 'admin'])->group(function () {

        Route::patch('/hubs/{hub}/status', [HubController::class, 'changeStatus']);



        // Route::apiResource('location', LocationController::class)->except(['index', 'show']);
    });

    Route::middleware('auth:api')->group(function () {
        // Hub Owner
        Route::prefix('hubs/{hub}')->group(function () {
            Route::post('/custom-services', [\App\Http\Controllers\Api\Hubs\ServiceController::class, 'storeCustom']);
            Route::get('/services', [\App\Http\Controllers\Api\Hubs\ServiceController::class, 'getCustomServices']);
            Route::put('/custom-services/{service}', [\App\Http\Controllers\Api\Hubs\ServiceController::class, 'updateCustom']);
            Route::delete('/custom-services/{service}', [\App\Http\Controllers\Api\Hubs\ServiceController::class, 'destroyCustom']);
        });

        // ============ Admin Routes ============
        Route::middleware('admin')->group(function () {
            // جميع الإشعارات مع unread_count
            Route::get('/admin/notifications', [AdminNotificationController::class, 'index']);

            // عدد الإشعارات غير المقروءة فقط
            Route::get('/admin/notifications/unread-count', [AdminNotificationController::class, 'unreadCount']);

            // وضع علامة مقروء على إشعار واحد
            Route::post('/admin/notifications/{id}/read', [AdminNotificationController::class, 'markAsRead']);

            // وضع علامة مقروء على الكل
            Route::post('/admin/notifications/mark-all-read', [AdminNotificationController::class, 'markAllAsRead']);

            // حذف إشعار
            Route::delete('/admin/notifications/{id}', [AdminNotificationController::class, 'delete']);
        });
    });
});
// routes/api.php for front hubs
Route::prefix('v1')->group(function () {

    Route::prefix('contact')->group(function () {
        Route::post('/', [ContactController::class, 'store'])->middleware('throttle:5,1'); // public

        Route::middleware('auth:api')->group(function () {
            Route::get('/', [ContactController::class, 'index']);
            Route::get('{id}', [ContactController::class, 'show']);
            Route::patch('{id}/read', [ContactController::class, 'markAsRead']);
            Route::delete('{id}', [ContactController::class, 'destroy']);
        });
    });
    Route::get('/locations', [LocationController::class, 'index']);
    Route::get('/locations/{slug}', [LocationController::class, 'show']);

    Route::middleware('auth:api')->group(function () {
        // إضافة تقييم جديد للهب
        Route::post('/hubs/{hub}/reviews', [ReviewController::class, 'store']);

        // تحديث التقييم الخاص بالمستخدم
        Route::put('/hubs/{hub}/reviews', [ReviewController::class, 'update']);

        // حذف التقييم الخاص بالمستخدم
        Route::delete('/hubs/{hub}/reviews/{review}', [ReviewController::class, 'destroy']);

        // الحصول على التقييم الخاص بالمستخدم
        Route::get('/hubs/{hub}/my-review', [ReviewController::class, 'getUserReview']);
    });

    Route::get('/hubs/{hub}/reviews',   [ReviewController::class, 'index']);
    Route::get('/front/hubs', [\App\Http\Controllers\Api\Front\HubsController::class, 'index']);
    Route::get('/front/hubs/{hub}', [\App\Http\Controllers\Api\Front\HubsController::class, 'show']);
});
