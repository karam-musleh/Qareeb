<?php

namespace App\Http\Requests;

use App\Enum\InitiativeStatus;
use Illuminate\Foundation\Http\FormRequest;

class ChangeInitiativeStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // الـ middleware admin كافي
    }

    public function rules(): array
    {
        return [
            'status' => [
                'required',
                'in:' . implode(',', array_column(InitiativeStatus::cases(), 'value')),
            ],
            'rejection_reason' => [
                'nullable',
                'string',
                'required_if:status,' . InitiativeStatus::REJECTED->value,
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required'              => __('messages.status_required'),
            'status.in'                    => __('messages.status_invalid'),
            'rejection_reason.required_if' => __('messages.rejection_reason_required'),
        ];
    }
}
