@extends('layouts.admin.app')

@section('title', 'Create Tag')
@section('heading', 'Create Tag')

@section('content')
    <form action="{{ route('admin.tags.store') }}" method="POST" enctype="multipart/form-data" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @include('admin.tag.form', ['action' => 'Create new tag'])
    </form>
@endsection
