<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HubRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch');

        return [
            'name' => [$isUpdate ? 'sometimes' : 'required', 'array'],
            'name.ar' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:255'],
            'name.en' => [$isUpdate ? 'nullable' : 'nullable', 'string', 'max:255'],

            'description' => ['nullable', 'array'],
            'description.ar' => ['nullable', 'string'],
            'description.en' => ['nullable', 'string'],


            'location_id' => [
                $isUpdate ? 'sometimes' : 'required',
                Rule::exists('locations', 'id')->where(fn($query) => $query->where('type', 'area')),
            ],

            'address_details' => [$isUpdate ? 'sometimes' : 'required', 'array'],
            'address_details.ar' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:255'],
            'address_details.en' => [$isUpdate ? 'nullable' : 'nullable', 'string', 'max:255'],
            'services' => ['nullable', 'array'],
            'service_ids' => ['nullable', 'array'],
            'service_ids.*' => ['exists:services,id'],
            'add_service_ids' => ['nullable', 'array'],
            'add_service_ids.*' => ['exists:services,id'],
            'remove_service_ids' => ['nullable', 'array'],
            'remove_service_ids.*' => ['exists:services,id'],

            'contact' => [$isUpdate ? 'sometimes' : 'required', 'string', 'regex:/^\+?[0-9\s\-()]+$/'],
            'hourly_price' => [$isUpdate ? 'sometimes' : 'required', 'integer', 'min:0'],
            'working_hours_start' => [$isUpdate ? 'sometimes' : 'required', 'date_format:H:i'],
            'working_hours_end' => [$isUpdate ? 'sometimes' : 'required', 'date_format:H:i'],


            'main_image' => [$isUpdate ? 'sometimes' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg,AVIF',   'max:51200'], // 50MB,
            'gallery' => [$isUpdate ? 'sometimes' : 'nullable', 'array'],
            'gallery.*' => ['image', 'mimes:jpg,jpeg,png,webp,svg,AVIF',   'max:51200'], // 50MB,

            'social_accounts' => ['nullable', 'array'],
            'social_accounts.*.platform' => ['required_with:social_accounts', 'string', 'max:255'],
            'social_accounts.*.url' => ['required_with:social_accounts', 'url', 'max:255'],
        ];
    }
}
