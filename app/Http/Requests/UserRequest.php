<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class UserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'    => [
                'required',
                'min:4',
                'max:50',
                'regex:/^[a-zA-Z0-9\s]+$/',
            ],
            'email'   => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user),
            ],
            'phone'   => [
                'required',
                'digits:11',
                // 'digits_between:11,11',
                Rule::unique('users', 'phone')->ignore($this->user),
            ],
            'address' => [
                'sometimes',
                'nullable',
                'min:10',
                'max:255',
            ],
            'zip' => [
                'sometimes',
                'nullable',
                'digits_between:4,5',
            ]
        ];
    }
}
