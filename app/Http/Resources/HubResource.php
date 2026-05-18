<?php

namespace App\Http\Resources\Initiatives;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InitiativeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'slug'        => $this->slug,
            'description' => $this->description,
            'type'        => $this->type->value,
            'status'      => $this->status->value,
            'image'       => $this->image ? asset('storage/' . $this->image) : null,
            'capacity'    => $this->capacity,

            'starts_at'   => $this->starts_at?->format('Y-m-d H:i'),
            'ends_at'     => $this->ends_at?->format('Y-m-d H:i'),

            'location'    => $this->whenLoaded('location', fn() => [
                'id'   => $this->location->id,
                'name' => $this->location->name,
            ]),

            'hub'         => $this->whenLoaded('hub', fn() => [
                'id'   => $this->hub->id,
                'name' => $this->hub->name,
                'slug' => $this->hub->slug,
            ]),

            'creator'     => $this->whenLoaded('creator', fn() => [
                'id'   => $this->creator->id,
                'name' => $this->creator->name,
            ]),

            'created_at'  => $this->created_at->format('Y-m-d'),
        ];
    }
}
