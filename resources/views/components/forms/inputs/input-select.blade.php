<label class="block w-full mt-4 text-sm">
    <span class="text-gray-700 dark:text-gray-200">
        {{ $label }}@if($is_required)<span class="text-red-500">*</span>@endif
    </span>
    <select name="{{ $attribute }}" {{ $is_required ? 'required' : '' }} class="block w-full mt-1 text-sm rounded dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-purple-400 form-input">
        <option value="">-- Select {{ $label }} --</option>
        @php $selected_option = old($attribute, $selected ?? -1) @endphp
        @forelse ($options as $option)
            <option value="{{ $option->id }}" @if($selected_option == $option->id) selected @endif>
                {{ $option->name }}
            </option>
        @empty
        @endforelse
    </select>
    @forelse ($errors->get($attribute) as $error)
        <p class="text-xs text-red-600 dark:text-red-400"> {{ $error }} </p>
    @empty
    @endforelse
</label>