@csrf
@include('components.forms.inputs.input-text', ['attribute' => 'name', 'label' => 'Category name', 'is_required' => true, 'model' => $category ?? ''])

@include('components.forms.inputs.input-select', ['attribute' => 'parent_id', 'label' => 'Parent category', 'is_required' => false, 'options' => $categories ?? [], 'selected' => $category->parent_id ?? -1])


@include('components.forms.buttons.submit-button')
