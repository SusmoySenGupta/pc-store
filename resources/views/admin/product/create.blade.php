@extends('layouts.admin.app')

@section('title', 'Create Product')
@section('heading', 'Create Product')

@section('content')
    <form action="{{ route('admin.products.store') }}" method="POST"
        class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @include('admin.product.form', ['action' => 'Create new product'])
    </form>
@endsection
