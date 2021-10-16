@csrf
@if (session()->has('error'))
    <div class="p-2 bg-red-100 rounded dark:bg-red-300 dark:text-gray-700">
        {{ session('error') }}
    </div>
@endif
@include('components.forms.inputs.input-text', ['attribute' => 'name', 'label' => 'Category name', 'is_required' => true, 'model' => $category ?? ''])

<label class="block mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-400">
        Parent name
    </span>
    <select name="parent_id" value="{{ old('parent_id', $category->parent_id ?? '') }}" placeholder="Category name" class="block w-full mt-1 text-sm rounded dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-purple-400 form-input">
        <option value="">-- Select Parent --</option>
        @forelse ($parent_categories as $parent_category)
            <option value="{{ $parent_category->id }}" {{ $parent_category->id == old('parent_id', $category->parent_id ?? null) ? 'selected' : '' }}>
                {{ $parent_category->name }}
            </option>
        @empty
        @endforelse
    </select>
    @foreach ($errors->get('parent_id') as $error)
        <p class="text-xs text-red-600 dark:text-red-400 animate-pulse">
            {{ $error }}
        </p>
    @endforeach
</label>

@include('components.forms.buttons.submit-button')
