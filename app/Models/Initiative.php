<?php

namespace App\Models;

use App\Enum\InitiativeStatus;
use App\Enum\InitiativeType;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Initiative extends Model
{
    use HasFactory;
    use HasSlug;

    protected string $slugFrom = 'title';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'type',
        'status',
        'image',
        'location_id',
        'hub_id',
        'starts_at',
        'ends_at',
        'capacity',
        'created_by',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at'   => 'datetime',
        'status'    => InitiativeStatus::class,
        'type'      => InitiativeType::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | Route Model Binding
    |--------------------------------------------------------------------------
    */

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function hub()
    {
        return $this->belongsTo(Hub::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('status', InitiativeStatus::ACTIVE);
    }

    public function scopePending($query)
    {
        return $query->where('status', InitiativeStatus::PENDING);
    }

    public function scopeOfType($query, InitiativeType $type)
    {
        return $query->where('type', $type);
    }
}
