<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class CategoryRequest extends Request
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
                Rule::unique('categories')
                ->where(fn($query) => $query->where('parent_id', $this->parent_id))
                ->ignore($this->category),
            ],

            'parent_id' => [
                'present',
                'nullable',
                'integer',
                'exists:categories,id',
            ]
        ];
    }
}
