@extends('layouts.admin.app')

@section('title', 'Create Brand')
@section('heading', 'Create Brand')

@section('content')
    <form action="{{ route('admin.brands.store') }}" method="POST"
        class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @include('admin.brand.form', ['action' => 'Create new brand'])
    </form>
@endsection
