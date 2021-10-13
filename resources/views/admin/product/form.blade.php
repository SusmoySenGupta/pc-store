@csrf
<div class="flex items-center gap-4">
    @include('components.forms.inputs.input-text', ['attribute' => 'name', 'is_required' => true, 'label' => 'Product name', 'model' => $product ?? ''])
    @include('components.forms.inputs.input-text', ['attribute' => 'sku', 'is_required' => true, 'label' => 'SKU', 'model' => $product ?? ''])
</div>
<div class="flex items-center gap-4">
    @include('components.forms.inputs.input-select', ['attribute' => 'brand_id', 'is_required' => true, 'label' => 'Brand', 'options' => $brands ?? [], 'selected' => $product->brand_id ?? null])
    @include('components.forms.inputs.input-select', ['attribute' => 'category_id', 'is_required' => true, 'label' => 'Category', 'options' => $categories ?? [], 'selected' => $product->category_id ?? null])
</div>

<div class="flex items-center gap-4">
    @include('components.forms.inputs.input-number', ['attribute' => 'price', 'is_required' => true, 'label' => 'Price', 'model' => $product ?? ''])
    @include('components.forms.inputs.input-number', ['attribute' => 'stock', 'is_required' => true, 'label' => 'Stock amount', 'model' => $product ?? ''])
    @include('components.forms.inputs.input-number', ['attribute' => 'discount_percentage', 'is_required' => false, 'label' => 'Discount percentage', 'model' => $product ?? '', 'max' => 100.00])
</div>

@include('components.forms.inputs.input-textarea', ['attribute' => 'description', 'is_required' => true, 'label' => 'Description', 'model' => $product ?? ''])

<label class="block w-full mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-200">
        Images
    </span>
    <input type="file" name="product_images[]" class="block w-full mt-1 text-sm rounded dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-purple-400 form-input">
    @forelse ($errors->get('product_images') as $error)
        <p class="text-xs text-red-600 dark:text-red-400">
            {{ $error }}
        </p>
    @empty
    @endforelse
</label>

@include('components.forms.buttons.submit-button')
