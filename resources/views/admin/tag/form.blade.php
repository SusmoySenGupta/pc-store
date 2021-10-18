@csrf
@if (session()->has('error'))
    <div class="p-2 bg-red-100 rounded dark:bg-red-300 dark:text-gray-700">
        {{ session('error') }}
    </div>
@endif
@include('components.forms.inputs.input-text', ['attribute' => 'name', 'is_required' => true, 'label' => 'Tag name', 'model' => $tag ?? ''])

@include('components.forms.buttons.submit-button')
