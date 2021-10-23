@extends('layouts.app')

@section('content')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-12 mx-auto">
            <div class="flex flex-wrap justify-start gap-1 item-center">
                @foreach ($category->ancestors as $parent)
                    <a href="{{ route('category_product', $parent) }}">{{ $parent->name }}</a>
                    <span>/</span>
                    @if ($loop->last)
                        <p class="font-semibold">{{ $category->name }}</p>
                    @endif
                @endforeach
            </div>
            <h1 class="mb-8 text-3xl font-medium text-center text-gray-900 title-font sm:text-4xl">
                {{ $category->name }}
            </h1>
            <div class="flex flex-wrap items-center justify-center gap-2 mb-12">
                @foreach ($category->descendants as $sub_category)
                    <a href="{{ route('category_product', $sub_category) }}" class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full whitespace-nowrap">
                        {{ $sub_category->name }}
                    </a>
                @endforeach
            </div>
            <div class="flex flex-wrap justify-center gap-4 -m-4">
                @forelse ($products as $product)
                    <div class="flex flex-col justify-between w-full p-4 rounded lg:w-1/4 md:w-1/2 hover:shadow-lg">
                        <div>
                            <a href="{{ route('product.show', $product) }}" class="relative block h-48 overflow-hidden rounded">
                                <img alt="product" class="block object-cover object-center w-full h-full" src="{{ Storage::url($product->images->first()->path) }}">
                            </a>
                            <div class="mt-4">
                                <h3 class="mb-1 text-xs tracking-widest text-gray-500 title-font">{{ $product->category->name }}</h3>
                                <a href="{{ route('product.show', $product) }}" class="text-lg font-medium text-gray-900 title-font">{{ $product->name }}</a>
                                <div class="mt-1">
                                    <span class="text-2xl">৳</span>
                                    <span class="@if ($product->discount_percentage > 0) line-through @endif">{{ number_format($product->price, 2, '.', ',') }}</span>
                                    @php
                                        $discount = $product->price - ($product->price * $product->discount_percentage) / 100;
                                    @endphp
                                    @if ($product->discount_percentage > 0)
                                        <span>{{ number_format($discount, 2, '.', ',') }}</span>
                                    @endif
                                </div>
                            </div>   
                        </div>
                        <button class="px-2 py-1 mt-4 border rounded hover:bg-gray-50">
                            Buy now
                        </button>
                    </div>
                @empty
                    <p class="text-xl animate-pulse">Products coming soon!</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
