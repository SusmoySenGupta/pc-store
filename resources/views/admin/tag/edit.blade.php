@extends('layouts.admin.app')

@section('title', 'Pc Store - Edit Tag')
@section('heading', 'Edit Tag')

@section('content')
    <form action="{{ route('admin.tags.update', $tag->slug) }}" method="POST" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @method('PUT')
        @include('admin.tag.form', ['action' => 'Update tag'])
    </form>
@endsection
