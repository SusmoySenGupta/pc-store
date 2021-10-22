<label class="block w-full mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-400">
        {{ $label }}@if ($is_required)<span class="text-red-500">*</span>@endif
    </span>
    
    <select type="text" name="{{ $attribute }}[]" multiple placeholder="{{ $label }}" class="block w-full mt-1 text-sm rounded dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-purple-400 form-input">
        <option value="">-- Select {{ $label }} --</option>
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ in_array($key, old($attribute, $selected_values ?? [])) ? ' selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>

    @foreach ($errors->get("{$attribute}.*") as $all_errors)
        @foreach ($all_errors as $error)
            <p class="text-xs text-red-600 dark:text-red-400">
                {{ $error }}
            </p>
        @endforeach
    @endforeach
</label>
