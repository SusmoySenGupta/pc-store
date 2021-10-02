<label class="block mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-400">
        {{ $label }}
    </span>
    <input name="{{ $attribute }}" value="{{ old($attribute, $model[$attribute] ?? '') }}" placeholder="{{ $label }}"
        class="block w-full mt-1 text-sm rounded dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-purple-400 form-input">
    @forelse ($errors->get($attribute) as $error)
        <p class="text-xs text-red-600 dark:text-red-400">
            {{ $error }}
        </p>
    @empty
    @endforelse
</label>