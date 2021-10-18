@extends('layouts.admin.app')

@section('title', 'Pc store - Category Details')
@section('heading', 'Category Details')

@section('content')
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex items-center justify-between mb-2">
            <p class="font-bold leading-tight text-center text-gray-700 dark:text-gray-200">
                {{ $category->name }}
            </p>
            <div class="justify-end hidden sm:flex">
                @include('components.forms.buttons.back-button', ['base' => 'admin.categories.index'])
            </div>
        </div>

        <hr>

        <div class="flex flex-col gap-2 my-2">
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-800 dark:text-gray-400">Parent:</p>
                @if($category->parent->name)
                    <a href="{{ route('admin.categories.show', $category->parent->slug) }}" class="text-xs font-semibold text-right text-gray-800 break-words underline dark:text-gray-200">
                        {{ $category->parent->name }}
                    </a>
                @else
                    <p class="text-xs font-semibold text-right text-gray-800 break-words dark:text-gray-200">
                        Itself
                    </p>
                @endif
            </div>
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-800 dark:text-gray-400">No of products:</p>
                <p class="text-xs font-semibold text-right text-gray-800 break-words dark:text-gray-200">
                    {{ $category->products->count() }}
                </p>
            </div>
        </div>

        <hr>

        <div class="flex flex-col gap-2 my-2">
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-800 dark:text-gray-400">Created by:</p>
                @if ($category->createdBy->id)
                    <div class="flex items-center text-sm">
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                            @if ($category->createdBy->id)
                                <img src="{{ asset('img/profile/' . $category->createdBy->profile_photo) }}" alt="Created by" loading="lazy" class="object-cover w-full h-full rounded-full">
                            @else
                            @endif
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-600 dark:text-gray-200">{{ $category->createdBy->name }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                {{ $category->created_at->format('M d, Y') }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                {{ $category->created_at->format('H:i A') }}
                            </p>
                        </div>
                    </div>
                @else
                    <p class="text-xs font-bold text-gray-600 break-words dark:text-gray-200 whitespace-nowrap">
                        Created by the system
                    </p>
                @endif
            </div>
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-800 dark:text-gray-400 whitespace-nowrap">Updated by:</p>
                @if ($category->updatedBy->id)
                    <div class="flex items-center text-sm">
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                            @if ($category->updatedBy->id)
                                <img src="{{ asset('img/profile/' . $category->updatedBy->profile_photo) }}" alt="Created by" loading="lazy" class="object-cover w-full h-full rounded-full">
                            @else
                            @endif
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-600 dark:text-gray-200">{{ $category->updatedBy->name }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                {{ $category->updated_at->format('M d, Y') }}
                            </p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                {{ $category->updated_at->format('H:i A') }}
                            </p>
                        </div>
                    </div>
                @else
                    <p class="text-xs font-bold text-gray-600 break-words dark:text-gray-200 whitespace-nowrap">
                        No one has updated yet.
                    </p>
                @endif
            </div>
        </div>

        <hr class="block sm:hidden">

        <div class="block mt-3 sm:hidden">
            @include('components.forms.buttons.back-button', ['base' => 'admin.products.index'])
        </div>
    </div>
@endsection
