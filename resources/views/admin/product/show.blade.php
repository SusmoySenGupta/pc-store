@extends('layouts.admin.app')

@section('title', 'Pc Store - Product Details')
@section('heading', 'Product Details')

@section('content')
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex items-center justify-between mb-2">
            <p class="font-bold leading-tight text-center text-gray-700 dark:text-gray-200">
                {{ $product->name }}
            </p>
            <div class="justify-end hidden sm:flex">
                @include('components.forms.buttons.back-button', ['base' => 'admin.orders.index'])
            </div>
        </div>

        <hr>

        <div class="flex flex-col gap-2 my-2">
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-800 dark:text-gray-400">SKU:</p>
                <span class="px-2 py-1 text-xs font-semibold leading-tight text-blue-700 bg-blue-200 rounded-full dark:text-white dark:bg-blue-600">
                    #{{ $product->sku }}
                </span>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-800 dark:text-gray-400">Category:</p>
                <p class="text-xs font-semibold text-right text-gray-800 break-words dark:text-gray-200">
                    {{ $product->category->name }}
                </p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-800 dark:text-gray-400">Brand:</p>
                <p class="text-xs font-semibold text-right text-gray-800 break-words dark:text-gray-200">
                    {{ $product->brand->name }}
                </p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-800 dark:text-gray-400">Tags:</p>
                <div class="flex flex-col items-end justify-center gap-2 sm:flex-row sm:items-center sm:justify-end whitespace-nowrap">
                    @forelse ($product->tags as $tag)
                        <span class="px-2 py-1 text-xs font-semibold leading-tight text-gray-600 bg-gray-200 rounded-full dark:text-gray-200 dark:bg-gray-600">
                            {{ $tag->name }}
                        </span>
                    @empty
                        No tag found
                    @endforelse
                </div>
            </div>
        </div>

        <hr>

        <div class="flex flex-col gap-2 my-2">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold text-gray-800 dark:text-gray-200">Price:</p>
                <p class="text-xs font-semibold text-right text-gray-800 break-words dark:text-gray-200">
                    Tk {{ round($product->price) }}
                </p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold text-gray-800 dark:text-gray-200">Stock:</p>
                <p class="text-xs font-semibold text-right text-gray-800 break-words dark:text-gray-200">
                    {{ $product->stock }}
                </p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold text-gray-800 dark:text-gray-200">Discount percentage:</p>
                <p class="text-xs font-semibold text-right text-gray-800 break-words dark:text-gray-200">
                    {{ $product->discount_percentage }}%
                </p>
            </div>
        </div>

        <hr>

        <div class="flex flex-col gap-2 my-2">
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-800 dark:text-gray-400">Created by:</p>
                @if ($product->createdBy->id)
                    <div class="flex items-center text-sm">
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                            @if ($product->createdBy->id)
                                <img src="{{ asset('img/profile/' . $product->createdBy->profile_photo) }}" alt="Created by" loading="lazy" class="object-cover w-full h-full rounded-full">
                            @else
                            @endif
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-600 dark:text-gray-200">{{ $product->createdBy->name }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ $product->created_at->format('M d, Y') }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ $product->created_at->format('H:i A') }}</p>
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
                @if ($product->updatedBy->id)
                    <div class="flex items-center text-sm">
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                            @if ($product->updatedBy->id)
                                <img src="{{ asset('img/profile/' . $product->updatedBy->profile_photo) }}" alt="Created by" loading="lazy" class="object-cover w-full h-full rounded-full">
                            @else
                            @endif
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-600 dark:text-gray-200">{{ $product->updatedBy->name }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ $product->updated_at > format('M d, Y') }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ $product->updated_at->format('H:i A') }}</p>
                        </div>
                    </div>
                @else
                    <p class="text-xs font-bold text-gray-600 break-words dark:text-gray-200 whitespace-nowrap">
                        No one has updated yet.
                    </p>
                @endif
            </div>
        </div>

        <hr>

        <div class="flex flex-col gap-2 my-2">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold text-gray-800 dark:text-gray-200">Images:</p>
            </div>
            <div class="flex flex-col items-start justify-center gap-2 sm:flex-row sm:items-center sm:justify-start">
                <img src="https://via.placeholder.com/300" alt="Product Image" class="w-20 h-20 img-responsive">
                <img src="https://via.placeholder.com/300" alt="Product Image" class="w-20 h-20 img-responsive">
                <img src="https://via.placeholder.com/300" alt="Product Image" class="w-20 h-20 img-responsive">
                <img src="https://via.placeholder.com/300" alt="Product Image" class="w-20 h-20 img-responsive">
                <img src="https://via.placeholder.com/300" alt="Product Image" class="w-20 h-20 img-responsive">
            </div>
        </div>

        <hr>

        <div class="flex flex-col gap-2 my-2">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold text-gray-800 dark:text-gray-200">Description:</p>
            </div>
            <div class="w-full">
                <p class="text-xs text-gray-800 dark:text-gray-400">{{ $product->description }}</p>
            </div>
        </div>

        <hr class="block sm:hidden">

        <div class="block mt-3 sm:hidden">
            @include('components.forms.buttons.back-button', ['base' => 'admin.products.index'])
        </div>
    </div>
@endsection
