@extends('layouts.app')

@section('content')
    <!-- Product section -->
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-12 mx-auto">
            <div class="flex flex-wrap justify-start gap-1 item-center">
                @foreach ($product->category->ancestors as $parent)
                    <a href="{{ route('category_product', $parent) }}">{{ $parent->name }}</a>
                    <span>/</span>
                @endforeach
                <a href="{{ route('category_product', $product->category) }}">{{ $product->category->name }}</a>
                <span>/</span>
                <p class="font-semibold">{{ $product->name }}</p>
            </div>
            <section class="text-gray-600 body-font overflow-hidden">
                <div class="container px-5 py-12 mx-auto">
                    <div class="lg:w-4/5 mx-auto flex flex-wrap">
                        @if ($product->images->count() > 0)
                            <img alt="product" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="{{ Storage::url($product->images->first()->path) }}">
                        @else
                            <img alt="product" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="https://dummyimage.com/600x360">
                        @endif

                        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                            <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ $product->brand->name }}</h2>
                            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $product->name }}</h1>
                            <div class="flex mb-4">
                                <span class="flex items-center">
                                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                    </svg>
                                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                    </svg>
                                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                    </svg>
                                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                    </svg>
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                    </svg>
                                    <span class="text-gray-600 ml-3">4 Reviews</span>
                                </span>
                            </div>
                            <p class="leading-relaxed">
                                {{  Str::substr($product->description, 0, 300) . (Str::length($product->description) > 300 ? '...' : '') }}
                            </p>
                            <div class="flex flex-wrap items-center justify-start gap-2 my-6">
                                @foreach ($product->tags as $tag)
                                    <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full whitespace-nowrap">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="flex mt-6 pt-4 border-t border-gray-400">
                                <div>
                                    <span class="text-3xl">৳</span>
                                    <span class="text-xl font-medium @if ($product->discount_percentage > 0) line-through @endif">{{ number_format($product->price, 2, '.', ',') }}</span>
                                    @php
                                        $discount = $product->price - ($product->price * $product->discount_percentage) / 100;
                                    @endphp
                                    @if ($product->discount_percentage > 0)
                                        <span class="text-xl font-medium">{{ number_format($discount, 2, '.', ',') }}</span>
                                    @endif
                                </div>
                                @auth()
                                    @can('view', $product)
                                    <form action="{{ route('cart.store') }}" class="ml-auto" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="text-gray-800 border py-2 px-6 focus:outline-none hover:bg-gray-100 rounded">
                                            Buy now
                                        </button>
                                    </form>
                                    @endcan
                                @endauth
                                @guest()
                                <button class="flex ml-auto text-gray-800 border py-2 px-6 focus:outline-none hover:bg-gray-100 rounded">Buy now</button> 
      
                                @endguest
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </section>

    <!-- Gallery -->
    @if ($product->images->count() > 1)
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-16 mx-auto">
                <div class="text-center w-full mb-20">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Gallery</h1>
                </div>
                <div class="flex flex-wrap -m-4 justify-center">
                    @forelse($product->images as $image)
                        @if (!$loop->first)
                            <div class="lg:w-1/3 sm:w-1/2 p-4  text-center">
                                <img alt="gallery" class="w-full h-full object-cover object-center" src="{{ Storage::url($image->path) }}">
                            </div>
                        @endif
                    @empty
                    @endforelse
                    {{-- <div class="lg:w-1/3 sm:w-1/2 p-4  text-center">
                        <img alt="gallery" class="w-full h-full object-cover object-center" src="https://dummyimage.com/600x360">
                    </div>
                    <div class="lg:w-1/3 sm:w-1/2 p-4 text-center">
                        <img alt="gallery" class="w-full h-full object-cover object-center" src="https://dummyimage.com/600x360">
                    </div>
                    <div class="lg:w-1/3 sm:w-1/2 p-4  text-center">
                        <img alt="gallery" class="w-full h-full object-cover object-center" src="https://dummyimage.com/600x360">
                    </div>
                    <div class="lg:w-1/3 sm:w-1/2 p-4 text-center">
                        <img alt="gallery" class="w-full h-full object-cover object-center" src="https://dummyimage.com/600x360">
                    </div> --}}
                    {{-- <div class="lg:w-1/3 sm:w-1/2 p-4">
                        <img alt="gallery" class="w-full h-full object-cover object-center" src="https://dummyimage.com/600x360">
                    </div>
                    <div class="lg:w-1/3 sm:w-1/2 p-4">
                        <img alt="gallery" class="w-full h-full object-cover object-center" src="https://dummyimage.com/600x360">
                    </div>
                    <div class="lg:w-1/3 sm:w-1/2 p-4">
                        <img alt="gallery" class="w-full h-full object-cover object-center" src="https://dummyimage.com/600x360">
                    </div>
                    <div class="lg:w-1/3 sm:w-1/2 p-4">
                        <img alt="gallery" class="w-full h-full object-cover object-center" src="https://dummyimage.com/600x360">
                    </div> --}}
                </div>
            </div>
        </section>
    @endif

    <!-- Description -->
    @if (Str::length($product->description) > 100)
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-16 mx-auto">
                <h1 class="sm:text-3xl text-2xl font-medium text-center title-font text-gray-900 mb-4">
                    Description
                </h1>
                <p class="text-base text-left leading-relaxed">
                    {{ $product->description }}
                    {{-- Blue bottle crucifix vinyl post-ironic four dollar toast vegan taxidermy. Gastropub indxgo juice poutine, ramps microdosing banh mi pug. --}}
                </p>
            </div>
        </section>
    @endif
@endsection
