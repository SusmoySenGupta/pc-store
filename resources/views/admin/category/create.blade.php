@extends('layouts.admin.app')

@section('title', 'Pc store - Create Category')
@section('heading', 'Create Category')

@section('content')
    <form action="{{ route('admin.categories.store') }}" method="POST"
        class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @include('admin.category.form', ['action' => 'Create new category'])
    </form>
@endsection
