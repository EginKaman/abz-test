<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:60'
            ],
            'email' => [
                'required',
                'email',
                'unique:users',
                'min:2',
                'max:100'
            ],
            'phone' => [
                'required',
                'phone:UK'
            ],
            'position_id' => [
                'required',
                'integer',
                'exists:positions,id'
            ],
            'photo' => [
                'required',
                'image',
                'mimes:jpg,jpeg',
                'dimensions:min_width=70,min_height=70',
                'max:5120'
            ]
        ];
    }
}
