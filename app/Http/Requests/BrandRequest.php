<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class BrandRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'regex:/^[a-zA-Z0-9\s]+$/',
                'min:4', 'max:50',
                Rule::unique('brands')->ignore($this->brand),
            ],
        ];
    }
}
