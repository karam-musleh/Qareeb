<?php

namespace App\Actions\Initiative;

use App\Enum\InitiativeStatus;
use App\Enum\InitiativeType;
use App\Models\Initiative;
use Illuminate\Support\Str;

class CreateInitiativeAction
{
    public function execute(array $data, int $userId): Initiative
    {
        return Initiative::create([
            'title'       => $data['title'],
            'slug'        => Str::slug($data['title']) . '-' . Str::random(5),
            'description' => $data['description'] ?? null,
            'type'        => InitiativeType::from($data['type']),
            'status'      => InitiativeStatus::PENDING,
            'image'       => $data['image'] ?? null,
            'location_id' => $data['location_id'] ?? null,
            'hub_id'      => $data['hub_id'] ?? null,
            'starts_at'   => $data['starts_at'] ?? null,
            'ends_at'     => $data['ends_at'] ?? null,
            'capacity'    => $data['capacity'] ?? null,
            'created_by'  => $userId,
        ]);
    }
}
