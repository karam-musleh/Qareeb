<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    //
    use HasTranslations;
    protected $fillable = [
        'name',
        'description',
        'hub_id',
        'is_global',
        'is_active',
    ];
    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'is_active' => 'boolean',
        'is_global' => 'boolean',
    ];
    protected $translatable = ['name', 'description'];
    public function hubs()
    {
        return $this->belongsToMany(Hub::class)->withTimestamps();
    }
    public function scopeGlobal($query)
    {
        return $query->where('is_global', true);
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    public function hub()
    {
        return $this->belongsTo(Hub::class);
    }


}
