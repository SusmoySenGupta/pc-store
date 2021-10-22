@csrf
@include('components.forms.inputs.input-text', [
'attribute' => 'name',
'is_required' => true,
'label' => 'Brand name',
'model' => $brand ?? '',
])

@include('components.forms.buttons.submit-button')
