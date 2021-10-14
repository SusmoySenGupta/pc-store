@extends('layouts.admin.app')

@section('title', 'Create Product')
@section('heading', 'Create Product')

@section('content')
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @if (session()->has('error'))
            <div class="p-2 bg-red-100 rounded dark:bg-red-300 dark:text-gray-700">
                {{ session('error') }}
            </div>
        @endif
        @include('admin.product.form', ['action' => 'Create new product'])
    </form>
@endsection
