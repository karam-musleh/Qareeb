<?php

namespace App\Http\Requests;

use App\Enum\InitiativeType;
use Illuminate\Foundation\Http\FormRequest;

class InitiativeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'title'       => $isUpdate ? 'sometimes|string|max:255'  : 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => $isUpdate
                ? 'sometimes|in:' . implode(',', array_column(InitiativeType::cases(), 'value'))
                : 'required|in:' . implode(',', array_column(InitiativeType::cases(), 'value')),
            'image'       => 'nullable|image|max:2048',
            'location_id' => 'nullable|exists:locations,id',
            'hub_id'      => 'nullable|exists:hubs,id',
            'starts_at'   => 'nullable|date',
            'ends_at'     => 'nullable|date|after_or_equal:starts_at',
            'capacity'    => 'nullable|integer|min:1',
        ];
    }
}
