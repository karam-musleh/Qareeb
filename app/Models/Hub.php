<?php

namespace App\Models;

use App\Enum\HubStatus;
use App\Enum\UserRole;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Hub extends Model
{

    use HasTranslations, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'owner_id',
        'location_id',
        'working_hours_start',
        'working_hours_end',
        'description',
        'address_details',
        'contact',
        'status',
        'hourly_price',
        'rejection_reason',
        // 'images',

    ];

    protected $translatable = [
        'name',
        'description',
        'address_details'
    ];

    protected $casts = [
        'status' => HubStatus::class,
        'contact' => 'string',
        'working_hours_start' => 'datetime:H:i',
        'working_hours_end' => 'datetime:H:i',

    ];
    protected $appends = ['url'];

    //
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // موقع الهب
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    // خدمات الهب
    // public function services()
    // {
    //     return $this->belongsToMany(Service::class)->withTimestamps();
    // }

    // عروض الهب
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    // حجوزات الهب
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // تقييمات الهب
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // حساب متوسط التقييم
    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    // عدد التقييمات
    public function reviewCount()
    {
        return $this->reviews()->count();
    }

    // التقييمات مع المستخدمين
    public function reviewsWithUsers()
    {
        return $this->reviews()->with('user')->latest()->get();
    }



    public function services()
    {
        return $this->belongsToMany(Service::class, 'hub_service')
            ->where('services.is_global', true)
            ->where('services.is_active', true);
    }

    // الخدمات العامة فقط اللي اختارها الـ owner
    public function globalServices()
    {
        return $this->belongsToMany(Service::class, 'hub_service')
            ->where('is_global', true);
    }

    // الخدمات الخاصة بهذا الـ Hub
    public function customServices()
    {
        return $this->hasMany(Service::class, 'hub_id')

            ->where('is_global', false)
            ->where('is_active', true);
    }
    public function allServices()
    {
        $globalServices = $this->services()->get();
        $customServices = $this->customServices()->get();

        return $globalServices->merge($customServices);
    }

    public function hubSocialAccounts()
    {
        return $this->morphMany(SocialAccount::class, 'accountable');
    }
    // صور الهب (Morph)
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function mainImage()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'main');
    }

    public function galleryImages()
    {
        return $this->morphMany(Image::class, 'imageable')->where('type', 'gallery');
    }
    protected function mainImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() =>
            $this->mainImage
                ? Storage::disk('custom')->url($this->mainImage->path)
                : null
        );
    }

    // protected function galleryImagesUrls(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn() =>
    //         $this->galleryImages->map(
    //             fn($img) => Storage::disk('custom')->url($img->path)
    //         )
    //     );
    // }
    public function getGalleryImagesWithIds()
    {
        return $this->images()
            ->where('type', 'gallery')
            ->get()
            ->map(fn($image) => [
                'id' => $image->id,
                'url' => Storage::disk('custom')->url($image->path),  // أو $image->path
            ]);
    }

    protected function imagesUrls(): Attribute
    {
        return Attribute::make(
            get: fn() =>
            $this->images->map(
                fn($img) => Storage::disk('custom')->url($img->path)
            )
        );
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    // في app/Models/Hub.php
    public function updateGallery($newFiles = [], $deleteIds = [])
    {
        // حذف
        if (!empty($deleteIds)) {
            $this->images()
                ->whereIn('id', $deleteIds)
                ->where('type', 'gallery')
                ->each(function ($image) {
                    if (Storage::disk($image->disk ?? 'custom')->exists($image->path)) {
                        Storage::disk($image->disk ?? 'custom')->delete($image->path);
                    }
                    $image->delete();
                });
        }

        // إضافة
        if (!empty($newFiles)) {
            foreach ($newFiles as $file) {
                $path = $file->store('hubs/gallery', 'custom');
                $this->images()->create([
                    'path' => $path,
                    'type' => 'gallery',
                    'disk' => 'custom',
                ]);
            }
        }
    }
    public function scopeVisibleFor($query, $user = null, $locationId = null)
    {
        // 👑 Admin → كل شيء
        if ($user && $user->isAdmin()) {
            return $query;
        }

        // 👤 logged-in user → نفس المنطقة +    ved
        if ($user) {
            return $query
                ->where('status', HubStatus::APPROVED->value)
                ->when($locationId, fn($q) => $q->where('location_id', $locationId));
        }

        // 👤 guest → approved فقط
        return $query->where('status', HubStatus::APPROVED->value);
    }
    // isAdmin method in User model
}
