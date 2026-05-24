<?php

namespace App\Http\Requests;

use App\Enum\HubStatus;
use App\Enum\InitiativeType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class InitiativeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');
        $userId   = Auth::id();

        return [
            'title'       => $isUpdate ? 'sometimes|string|max:255' : 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => $isUpdate
                ? 'sometimes|in:' . implode(',', array_column(InitiativeType::cases(), 'value'))
                : 'required|in:' . implode(',', array_column(InitiativeType::cases(), 'value')),
            'image'       => 'nullable|image|max:2048',
            'location_id' => 'nullable|exists:locations,id',
            'hub_id' => [
                'nullable',
                Rule::exists('hubs', 'id')->where(function ($query) use ($userId) {
                    $query->where('owner_id', $userId)
                        ->where('status', HubStatus::APPROVED->value);
                }),
            ],
            'starts_at'   => 'nullable|date',
            'ends_at'     => 'nullable|date|after_or_equal:starts_at',
            'capacity'    => 'nullable|integer|min:1',
        ];
    }
    public function messages(): array
{
    return [
        'hub_id.exists' => __('messages.hub_not_owned_or_inactive'),
    ];
}
}


