<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $lang = request()->query('lang', app()->getLocale());

        return [
            'id' => $this->id,
            'name' => $this->getTranslation('name', $lang),
            'slug' => $this->slug,
            'type' => $this->type->value ?? $this->type,
            'parent_id' => $this->parent_id,

            // ✅ ببساطة: بدون كل الخربطة - فقط الآباء
            'breadcrumb' => $this->getBreadcrumb($lang),

            'children' => $this->when(
                $this->relationLoaded('children') && $this->children->isNotEmpty(),
                fn() => LocationResource::collection($this->children)
            ),
        ];
    }

    /**
     * ببساطة: قايمة الآباء من الأعلى للأسفل
     * جنوب غزة - خانيونس - القرارة
     */
    private function getBreadcrumb($lang): array
    {
        $breadcrumb = [];
        $current = $this->resource;
        $depth = 0;

        while ($current && $depth < 10) {
            array_unshift($breadcrumb, [
                'id' => $current->id,
                'name' => $current->getTranslation('name', $lang),
            ]);
            $current = $current->parent ?? null;
            $depth++;
        }

        return $breadcrumb;
    }
}
