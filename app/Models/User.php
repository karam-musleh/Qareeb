<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enum\UserRole;
use App\Enum\UserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    // use HasTranslations ;
    // use Notifiable;
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array<string, mixed>
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    // المستخدم صاحب هبات
    public function hubs()
    {
        return $this->hasMany(Hub::class, 'owner_id');
    }

    // حجوزاته
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // تقييماته
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'specialization',
        'location_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            // 'status' => UserStatus::class,
        ];
    }
    // isAdmin
    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }
    // isOwner
    public function isOwner(): bool
    {
        return $this->role === UserRole::HUB_OWNER;
    }

   public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(
            Hub::class,
            'favorites',
            'user_id',
            'hub_id'
        )->withTimestamps()
            ->orderByDesc('favorites.created_at');
    }

    // ============ Favorite Helpers ============

    /**
     * التحقق من أن Hub معين في المفضلة
     */
    public function hasFavorite(Hub $hub): bool
    {
        return $this->favorites()
            ->where('hub_id', $hub->id)
            ->exists();
    }

    /**
     * إضافة Hub للمفضلة
     */
    public function addToFavorites(Hub $hub): bool
    {
        if ($this->hasFavorite($hub)) {
            return false;
        }

        $this->favorites()->attach($hub->id);
        return true;
    }

    /**
     * إزالة Hub من المفضلة
     */
    public function removeFromFavorites(Hub $hub): bool
    {
        return (bool) $this->favorites()->detach($hub->id);
    }

    /**
     * تبديل حالة المفضلة
     */
    public function toggleFavorite(Hub $hub): bool
    {
        if ($this->hasFavorite($hub)) {
            return !$this->removeFromFavorites($hub);
        }

        return $this->addToFavorites($hub);
    }

    /**
     * عدد المفضلات
     */
    // public function getFavoritesCount(): int
    // {
    //     return $this->favorites()->count();
    // }

    /**
     * آخر N مفضلات
     */
    // public function getRecentFavorites($limit = 5)
    // {
    //     return $this->favorites()
    //         ->orderByDesc('favorites.created_at')
    //         ->limit($limit)
    //         ->get();
    // }

    /**
     * البحث في المفضلات
     */
    // public function searchFavorites($query)
    // {
    //     return $this->favorites()
    //         ->where(function ($q) use ($query) {
    //             $q->whereJsonContains('name->ar', $query)
    //                 ->orWhereJsonContains('name->en', $query);
    //         })
    //         ->get();
    // }

}
