<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HubResource extends JsonResource
{
    public function toArray($request): array
    {

        $lang = request()->query('lang', app()->getLocale());

        return [
            'id' => $this->id,
            'name' => $this->getTranslation('name', $lang),
            'slug' => $this->slug,

            // 'name' => $this->getTranslation('name', $lang),
            'description' => $this->getTranslation('description', $lang),
            'address_details' => $this->getTranslation('address_details', $lang),
            'location' => $this->whenLoaded('location', function () use ($lang) {
                return [
                    'id' => $this->location->id,
                    'name' => $this->location->getTranslation('name', $lang),
                    'type' => $this->location->type,
                ];
            }),

            'images' => [
                'main' => $this->main_image_url,
                'gallery' => $this->when(
                    $this->relationLoaded('images'),
                    fn() => $this->gallery_images_urls // ✅ استخدم الـ attribute
                ),
            ],
            'services' => $this->when(
                $this->relationLoaded('services'),
                fn() => $this->services->map(function ($service) use ($lang) {
                    return [
                        'id' => $service->id,
                        'name' => $service->getTranslation('name', $lang),
                        'description' => $service->getTranslation('description', $lang),
                        'is_global' => true,
                    ];
                })
            ),

            // ✅ الخدمات الخاصة (من services table)
            'custom_services' => $this->when(
                $this->relationLoaded('customServices'),
                fn() => $this->customServices->map(function ($service) use ($lang) {
                    return [
                        'id' => $service->id,
                        'name' => $service->getTranslation('name', $lang),
                        'description' => $service->getTranslation('description', $lang),
                        'is_global' => false,
                    ];
                })
            ),

            // ✅ جميع الخدمات مع التمييز
            'all_services' => $this->when(
                $this->relationLoaded('services') && $this->relationLoaded('customServices'),
                fn() => collect($this->services)
                    ->merge($this->customServices)
                    ->map(function ($service) use ($lang) {
                        return [
                            'id' => $service->id,
                            'name' => $service->getTranslation('name', $lang),
                            'description' => $service->getTranslation('description', $lang),
                            'is_global' => $service->is_global,
                            'is_custom' => $service->hub_id !== null,
                        ];
                    })
            ),
            'contact' => $this->contact,
            'hourly_price' => $this->hourly_price,

            'status' => $this->status,
            'rejection_reason' => $this->rejection_reason,
            'owner' => $this->whenLoaded('owner', function () {
                return [
                    'id' => $this->owner->id,
                    'name' => $this->owner->name,
                    'email' => $this->owner->email,
                ];
            }),
            'social_accounts' => $this->when(
                $this->relationLoaded('hubSocialAccounts'),
                fn() => $this->hubSocialAccounts->map(function ($account) {
                    return [
                        'id' => $account->id,
                        'platform' => $account->platform,
                        'url' => $account->url,
                    ];
                })
            ),
        ];
    }
}
