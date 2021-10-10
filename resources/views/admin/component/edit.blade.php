@extends('layouts.admin.app')

@section('title', 'Edit Component')
@section('heading', 'Edit Component')

@section('content')
    <form action="{{ route('admin.components.update', $component->slug) }}" method="POST" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @method('PUT')
        @include('admin.component.form', ['action' => 'Update component'])
    </form>
@endsection
