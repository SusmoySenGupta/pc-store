<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class TagRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required',
                'regex:/^[a-zA-Z\s]+$/',
                'min:4',
                'max:50',
                Rule::unique('tags')->ignore($this->tag),
            ],
        ];
    }
}
