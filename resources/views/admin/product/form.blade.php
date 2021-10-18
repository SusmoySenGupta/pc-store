@csrf
@if (session()->has('error'))
    <div class="p-2 bg-red-100 rounded dark:bg-red-300 dark:text-gray-700">
        {{ session('error') }}
    </div>
@endif
<div class="flex flex-col sm:flex-row items-center sm:gap-4">
    @include('components.forms.inputs.input-text', ['attribute' => 'name', 'is_required' => true, 'label' => 'Product name', 'model' => $product ?? ''])
    @include('components.forms.inputs.input-text', ['attribute' => 'sku', 'is_required' => true, 'label' => 'SKU', 'model' => $product ?? ''])
</div>
<div class="flex flex-col sm:flex-row items-center sm:gap-4">
    @include('components.forms.inputs.input-select', ['attribute' => 'brand_id', 'is_required' => true, 'label' => 'Brand', 'options' => $brands ?? [], 'selected' => $product->brand_id ?? null])
    @include('components.forms.inputs.input-select', ['attribute' => 'category_id', 'is_required' => true, 'label' => 'Category', 'options' => $categories ?? [], 'selected' => $product->category_id ?? null])
</div>

<div class="flex flex-col sm:flex-row items-center sm:gap-4">
    @include('components.forms.inputs.input-number', ['attribute' => 'price', 'is_required' => true, 'label' => 'Price', 'model' => $product ?? ''])
    @include('components.forms.inputs.input-number', ['attribute' => 'stock', 'is_required' => true, 'label' => 'Stock amount', 'model' => $product ?? ''])
    @include('components.forms.inputs.input-number', ['attribute' => 'discount_percentage', 'is_required' => false, 'label' => 'Discount percentage', 'model' => $product ?? '', 'max' => 100.00])
</div>
<label class="block w-full mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-400">
        Tags
    </span>
    <select type="text" name="tags[]" multiple placeholder="Tags" class="block w-full mt-1 text-sm rounded dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-purple-400 form-input">
        <option value="">-- Select Tags --</option>
        @foreach ($tags as $tag_id => $tag)
            <option value="{{ $tag_id }}" {{ in_array($tag_id, old('tag_id', $tag_ids ?? [])) ? ' selected' : '' }}>
                {{ $tag }}
            </option>
        @endforeach
    </select>
    @foreach ($errors->get('tags') as $error)
        <p class="text-xs text-red-600 dark:text-red-400 animate-pulse">
            {{ $error }}
        </p>
    @endforeach
</label>

@include('components.forms.inputs.input-textarea', ['attribute' => 'description', 'is_required' => true, 'label' => 'Description', 'model' => $product ?? ''])

<label class="block w-full mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-200">
        Images
    </span>
    <div class="flex items-center justify-start gap-2">
        @isset($product)
            @forelse ($product->images as $image)
                <img src="{{ Storage::url($image->path) }}" alt="Product Image" class="w-28 img-responsive">
            @empty
            <p class="text-xs text-gray-800 dark:text-gray-400">No image available</p>
            @endforelse
        @endisset
    </div>
    <input type="file" name="product_images[]" multiple class="block w-full p-2 mt-1 text-sm rounded dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-purple-400 form-input">
    @forelse ($errors->get('product_images.*') as $product_image_errors)
        @foreach ($product_image_errors as $error)
            <p class="text-xs text-red-600 dark:text-red-400">
                {{ $error }}
            </p>
        @endforeach
    @empty
    @endforelse
</label>

@include('components.forms.buttons.submit-button')
