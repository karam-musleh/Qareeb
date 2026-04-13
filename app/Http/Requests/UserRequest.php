<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|string|max:20',
                'password' => [
                    'required',
                    'confirmed',
                    Password::min(6)
                        ->mixedCase()   // لازم حرف كبير وصغير
                        ->symbols(),    // لازم رمز
                ],
                'location_id' => 'nullable|exists:locations,id',
                'specialization' => 'nullable|string|max:255',
            ];
        }
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $this->user()->id,
            'phone' => 'sometimes|string|max:20',
            'password' => [
                'sometimes',
                'confirmed',
                Password::min(6)
                    ->mixedCase()   // لازم حرف كبير وصغير
                    ->symbols(),    // لازم رمز
            ],
            'location_id' => 'sometimes|exists:locations,id',
            'specialization' => 'sometimes|string|max:255',
        ];
    }
}
