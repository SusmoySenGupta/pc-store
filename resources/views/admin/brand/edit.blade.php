@extends('layouts.admin.app')
@section('heading', 'Edit Brand')

@section('content')
    <form action="{{ route('admin.brands.update', $brand->slug) }}" method="POST" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @method('PUT')
        @include('admin.brand.form', ['action' => 'Update brand'])
    </form>
@endsection
