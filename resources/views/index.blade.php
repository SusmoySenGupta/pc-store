@extends('layouts.app')

@section('content')
    <!-- Hero section -->
    <section class="text-gray-600 body-font">
        <div class="container flex flex-col items-center px-5 py-16 mx-auto md:flex-row">
            <div class="flex flex-col items-center mb-16 text-center lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 md:items-start md:text-left md:mb-0">
                <h1 class="mb-4 text-3xl font-medium text-gray-900 title-font sm:text-4xl">
                    Buy AirPods Pro and get a discount
                </h1>
                <p class="mb-8 leading-relaxed">
                    AirPods Pro have been designed to deliver Active Noise Cancellation for immersive sound, Transparency mode so you can hear your surroundings, and a customizable fit for all-day comfort. Just like AirPods, AirPods Pro connect magically to your Apple devices. And they’re ready to use right out of the case.
                </p>
                <div class="flex justify-center">
                    <button class="inline-flex px-6 py-2 text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">
                        Buy now
                    </button>
                </div>
            </div>
            <div class="w-5/6 lg:max-w-lg lg:w-full md:w-1/2">
                <img class="object-cover object-center rounded" alt="hero" src="{{ Storage::url('public/images/products/product-3.jpg') }}">
            </div>
        </div>
    </section>

    <!-- Features section -->
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-12 mx-auto">
            <h1 class="mb-10 text-3xl font-medium text-center text-gray-900 title-font sm:text-4xl">
                Latest products
            </h1>
            <div class="flex flex-wrap justify-center -m-4">
                @foreach ($products as $product)
                    <div class="w-full p-4 lg:w-1/4 md:w-1/2">
                        <a class="relative block h-48 overflow-hidden rounded">
                            <img alt="ecommerce" class="block object-cover object-center w-full h-full" src="{{ Storage::url($product->images->first()->path) }}">
                        </a>
                        <div class="mt-4">
                            <h3 class="mb-1 text-xs tracking-widest text-gray-500 title-font">{{ $product->category->name }}</h3>
                            <a href="#" class="text-lg font-medium text-gray-900 title-font">{{ $product->name }}</a>
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
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonial section -->
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <h1 class="mb-12 text-3xl font-medium text-center text-gray-900 title-font">Reviews</h1>
            <div class="flex flex-wrap -m-4">
                <div class="w-full p-4 md:w-1/2">
                    <div class="h-full p-8 bg-gray-100 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 mb-4 text-gray-400" viewBox="0 0 975.036 975.036">
                            <path
                                d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z">
                            </path>
                        </svg>
                        <p class="mb-6 leading-relaxed">
                            The Pc store has the best services and the best products. I recommend them to everyone.
                        </p>
                        <a class="inline-flex items-center">
                            <img alt="testimonial" src="{{ Storage::url('public/images/profile/fiv.jpg') }}" class="flex-shrink-0 object-cover object-center w-12 h-12 rounded-full" loading="lazy">
                            <span class="flex flex-col flex-grow pl-4">
                                <span class="font-medium text-gray-900 title-font">Susmoy Sen Gupta</span>
                                <span class="text-sm text-gray-500 uppercase">Software Engineer</span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="w-full p-4 md:w-1/2">
                    <div class="h-full p-8 bg-gray-100 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 mb-4 text-gray-400" viewBox="0 0 975.036 975.036">
                            <path
                                d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z">
                            </path>
                        </svg>
                        <p class="mb-6 leading-relaxed">
                            Buying new computer accessories is a very expensive affair. But I am glad that I found the best store.
                        </p>
                        <a class="inline-flex items-center">
                            <img alt="testimonial" src="https://images.unsplash.com/photo-1493666438817-866a91353ca9?ixlib=rb-0.3.5&q=80&fm=jpg&crop=faces&fit=crop&h=200&w=200&s=b616b2c5b373a80ffc9636ba24f7a4a9" class="flex-shrink-0 object-cover object-center w-12 h-12 rounded-full" loading="lazy">
                            <span class="flex flex-col flex-grow pl-4">
                                <span class="font-medium text-gray-900 title-font">Alper Kamu</span>
                                <span class="text-sm text-gray-500">DESIGNER</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
