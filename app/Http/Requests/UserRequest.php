<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
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
                'phone' => 'nullable|string|max:20',
                'role' => 'required|in:user,hub_owner',
                'password' => [
                    'required',
                    'confirmed',

                ],
                'location_id' => 'nullable|exists:locations,id',
                'specialization' => 'nullable|string|max:255',
            ];
        }
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $this->user()->id,
            'phone' => 'sometimes|string|max:20',
            'role' => 'sometimes|in:user,hub_owner',
            'current_password' => 'required_with:password|string',
            'password' => [
                'sometimes',
                'confirmed',

            ],
            'location_id' => 'sometimes|exists:locations,id',
            'specialization' => 'sometimes|string|max:255',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->isMethod('put') || $this->isMethod('patch')) {
                if ($this->has('password')) {
                    // تحقق إن current_password موجودة
                    if (!$this->has('current_password')) {
                        $validator->errors()->add('current_password', 'كلمة المرور الحالية مطلوبة');
                        return;
                    }
                    // تحقق إنها صحيحة
                    if (!Hash::check($this->current_password, $this->user()->password)) {
                        $validator->errors()->add('current_password', 'كلمة المرور الحالية غير صحيحة');
                    }
                }
            }
        });
    }
}
