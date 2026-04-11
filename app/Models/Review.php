<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hub_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // العلاقات
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hub()
    {
        return $this->belongsTo(Hub::class);
    }

    // التحقق من أن المستخدم لم يقيّم الهب من قبل
    public static function userAlreadyReviewed($userId, $hubId)
    {
        return self::where('user_id', $userId)
            ->where('hub_id', $hubId)
            ->exists();
    }

    // الحصول على تقييم المستخدم للهب (إن وجد)
    public static function getUserReview($userId, $hubId)
    {
        return self::where('user_id', $userId)
            ->where('hub_id', $hubId)
            ->first();
    }
}
