@extends('layouts.admin.app')
@section('heading', 'Profile')

@section('content')
    <form action="{{ route('admin.user.store') }}" method="POST" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @csrf

        @include('components.forms.inputs.input-text', ['attribute' => 'name', 'is_required' => true, 'label' => 'Your name', 'model' => $user ?? null])
        @include('components.forms.inputs.input-email', ['attribute' => 'email', 'is_required' => true, 'label' => 'Your email', 'model' => $user ?? null])
        @include('components.forms.inputs.input-number', ['attribute' => 'phone', 'is_required' => true, 'label' => 'Your phone', 'model' => $user ?? null])
        @include('components.forms.inputs.input-text', ['attribute' => 'address', 'is_required' => false, 'label' => 'Your address', 'model' => $user ?? null])
        @include('components.forms.inputs.input-number', ['attribute' => 'zip', 'is_required' => false, 'label' => 'Your zip code', 'model' => $user ?? null])

        @include('components.forms.buttons.submit-button', ['action' => 'Update profile'])
    </form>
@endsection
