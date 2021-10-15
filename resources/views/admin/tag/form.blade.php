@csrf
@include('components.forms.inputs.input-text', ['attribute' => 'name', 'is_required' => true, 'label' => 'Tag name', 'model' => $tag ?? ''])

@include('components.forms.buttons.submit-button')
