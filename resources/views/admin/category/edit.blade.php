@extends('layouts.admin.app')
@section('heading', 'Edit Category')

@section('content')
    <form action="{{ route('admin.categories.update', $category->slug) }}" method="POST" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @method('PUT')
        @include('admin.category.form', ['action' => 'Update category'])
    </form>
@endsection
