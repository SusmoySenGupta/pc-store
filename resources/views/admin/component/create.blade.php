@extends('layouts.admin.app')

@section('title', 'Create Component')
@section('heading', 'Create Component')

@section('content')
    <form action="{{ route('admin.components.store') }}" method="POST"
        class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @include('admin.component.form', ['action' => 'Create new component'])
    </form>
@endsection
