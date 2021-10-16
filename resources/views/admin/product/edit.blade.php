@extends('layouts.admin.app')

@section('title', 'Pc Store - Edit Product')
@section('heading', 'Edit Product')

@section('content')
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @method('PUT')
        @include('admin.product.form', ['action' => 'Update product'])
    </form>
@endsection
