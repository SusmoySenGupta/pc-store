<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateCartRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity'   => ['required', 'array'],
            'quantity.*' => ['required', 'numeric', 'min:0', 'max:25'],
        ];
    }
}
