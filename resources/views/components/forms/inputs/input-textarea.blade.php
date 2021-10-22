<label class="block w-full mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-200">
        {{ $label }}@if ($is_required)<span class="text-red-500">*</span>@endif
    </span>
    <textarea rows="4" name="{{ $attribute }}" placeholder="{{ $label }}" {{ $is_required ? 'required' : '' }} class="block w-full mt-1 text-sm rounded dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-purple-400 form-input">{{ old($attribute, $model[$attribute] ?? '') }}</textarea>
    @forelse ($errors->get($attribute) as $error)
        <p class="text-xs text-red-600 dark:text-red-400">
            {{ $error }}
        </p>
    @empty
    @endforelse
</label>
