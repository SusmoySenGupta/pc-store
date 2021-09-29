@csrf
<label class="block mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-400">
        Category name
    </span>
    <input name="name" value="{{ old('name', $category->name ?? '') }}" placeholder="Category name" class="block w-full mt-1 text-sm rounded dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-purple-400 form-input">
    @foreach ($errors->get('name') as $error)
        <p class="text-xs text-red-600 dark:text-red-400 animate-pulse">
            {{ $error }}
        </p>
    @endforeach
</label>

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

<div class="block mt-4 text-sm">
    <button class="flex items-center justify-between p-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        {{ $action }}
    </button>
</div>
