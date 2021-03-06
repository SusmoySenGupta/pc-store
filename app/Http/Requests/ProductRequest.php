<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ProductRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                => ['required', 'regex:/^[a-zA-Z0-9\s]+$/', 'min:4', 'max:50'],
            'sku'                 => ['required', 'regex:/^[a-zA-Z0-9-]+$/', 'min:5', 'max:15', Rule::unique('products')->ignore($this->product)],
            'brand_id'            => ['required', 'exists:brands,id'],
            'category_id'         => ['required', 'exists:categories,id'],
            'price'               => ['required', 'numeric', 'gte:0', 'lte:100000000'],
            'stock'               => ['required', 'numeric', 'regex:/^[0-9]+$/', 'gte:0', 'lte:100000000'],
            'discount_percentage' => ['present', 'nullable', 'numeric', 'gte:0.0', 'lte:100.00'],
            'tags'                => ['sometimes', 'nullable', 'array'],
            'tags.*'              => ['exists:tags,id', 'distinct'],
            'description'         => ['present', 'nullable', 'min:4', 'max:2000'],
            'product_images'      => ['sometimes', 'nullable'],
            'product_images.*'    => ['sometimes', 'nullable', 'file', 'mimes:jpg,jpeg,png', 'max:4096'],
        ];
    }
}
