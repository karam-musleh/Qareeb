<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidLocationHierarchy;

class LocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('api')->check() && auth('api')->user()->role === \App\Enum\UserRole::ADMIN;
    }

    public function rules(): array
    {
        $type = $this->input('type');
        $currentId = null;

        // في حالة UPDATE، نحصل على الـ ID الحالي
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $location = \App\Models\Location::where('slug', $this->route('slug'))->first();
            $currentId = $location?->id;

            return [
                'name'      => 'sometimes|array',
                'name.en'   => 'sometimes|string|max:255',
                'name.ar'   => 'sometimes|string|max:255',
                'type'      => 'sometimes|string|in:governorate,city,area',
                'parent_id' => [
                    'nullable',
                    'exists:locations,id',
                    new ValidLocationHierarchy($type ?? 'governorate', $currentId),
                    // منع الـ circular reference
                    function ($attribute, $value, $fail) use ($currentId) {
                        if ($currentId && $value == $currentId) {
                            $fail('Location cannot be its own parent');
                        }
                    }
                ],
            ];
        } else {
            return [
                'name'      => 'required|array',
                'name.en'   => 'required|string|max:255',
                'name.ar'   => 'required|string|max:255',
                'type'      => 'required|string|in:governorate,city,area',
                'parent_id' => [
                    'nullable',
                    'exists:locations,id',
                    new ValidLocationHierarchy($type),
                ],
            ];
        }
    }
}
// namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;

// class LocationRequest extends FormRequest
// {
    // /**
    //  * Determine if the user is authorized to make this request.
    //  */
    // public function authorize(): bool
    // {
    //     return auth('api')->check() && auth('api')->user()->role === \App\Enum\UserRole::ADMIN;
    // }

    // /**
    //  * Get the validation rules that apply to the request.
    //  *
    //  * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    //  */
    // public function rules(): array
//     {

//         if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
//             return [
//                 'name'      => 'sometimes|array',
//                 'name.en'   => 'sometimes|string|max:255',
//                 'name.ar'   => 'sometimes|string|max:255',
//                 'parent_id' => 'nullable|exists:locations,id',
//                 'type'      => 'sometimes|string|in:governorate,city,area',
//             ];
//         } else {
//             return [
//                 'name'      => 'required|array',
//                 'name.en'   => 'required|string|max:255',
//                 'name.ar'   => 'required|string|max:255',
//                 'parent_id' => 'nullable|exists:locations,id',
//                 'type'      => 'required|string|in:governorate,city,area',
//             ];
//         }
//     }
// }
