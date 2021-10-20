@extends('layouts.admin.app')

@section('title', 'Pc Store - Profile')
@section('heading', 'Profile')

@section('content')
    <form action="{{ route('admin.user.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Do you really want to update your profile?')" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @csrf
        @method('PUT')
        @if (session()->has('error'))
            <div class="p-2 bg-red-100 rounded dark:bg-red-300 dark:text-gray-700">
                {{ session('error') }}
            </div>
        @endif
        <div class="flex flex-col items-center sm:items-start justify-center gap-4 mb-2">
            <div class="relative w-24 h-24 mr-3 rounded-full">
                <img src="{{ Storage::url($user->profile_photo) }}" alt="Profile" loading="lazy" class="object-cover w-full h-full rounded-full">
                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
            </div>
            <input type="file" name="profile_photo" class="text-xs">
            @forelse ($errors->get('profile_photo') as $error)
                <p class="text-xs text-red-600 dark:text-red-400">{{ $error }}</p>
            @empty
            @endforelse
        </div>

        @include('components.forms.inputs.input-text', ['attribute' => 'name', 'is_required' => true, 'label' => 'Your name', 'model' => $user])
        @include('components.forms.inputs.input-email', ['attribute' => 'email', 'is_required' => true, 'label' => 'Your email', 'model' => $user])
        @include('components.forms.inputs.input-number', ['attribute' => 'phone', 'is_required' => true, 'label' => 'Your phone', 'model' => $user])
        @include('components.forms.inputs.input-text', ['attribute' => 'address', 'is_required' => false, 'label' => 'Your address', 'model' => $user])
        @include('components.forms.inputs.input-number', ['attribute' => 'zip', 'is_required' => false, 'label' => 'Your zip code', 'model' => $user])

        @include('components.forms.buttons.submit-button', ['action' => 'Update profile'])
    </form>
@endsection
