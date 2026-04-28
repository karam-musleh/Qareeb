<?php

namespace App\Models;

use App\Enum\OfferStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Offer extends Model
{
    use HasTranslations;
    //

    protected $fillable = [

        'hub_id',
        'title',
        'type',
        'price',
        'duration',
        'description',
        'starts_at',
        'ends_at',
    ];
    public $translatable = [
        'title',
        'description'
    ];
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function hub()
    {
        return $this->belongsTo(Hub::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // protected function status(): Attribute
    // {
    //     return Attribute::make(
    //         get: function () {
    //             $now = Carbon::now();

    //             if ($now->isBefore($this->starts_at)) {
    //                 return OfferStatus::SOON->value;
    //             }

    //             if ($now->isBetween($this->starts_at, $this->ends_at)) {
    //                 return OfferStatus::ACTIVE->value;
    //             }

    //             return OfferStatus::EXPIRED->value;
    //         }
    //     );
    // }
}
