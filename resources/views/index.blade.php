@extends('layouts.app')

@section('content')
    <!-- Hero section -->
    <section class="text-gray-600 body-font">
        <div class="container flex flex-col items-center px-5 py-16 mx-auto md:flex-row">
            <div class="flex flex-col items-center mb-16 text-center lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 md:items-start md:text-left md:mb-0">
                <h1 class="mb-4 text-3xl font-medium text-gray-900 title-font sm:text-4xl">
                    New Arrival!
                </h1>
                <p class="mb-8 leading-relaxed">
                    {{ $products->first()->description }}
                </p>
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $products->first()->id }}">
                    <button class="inline-flex px-6 py-2 text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">
                        Buy now
                    </button>
                    <a href="{{ route('product.show', $products->first()) }}" class="ml-1 inline-flex px-6 py-2 text-lg text-gray-800 border rounded focus:outline-none hover:bg-gray-200">
                        Details
                    </a>
                </form>
            </div>
            <div class="w-5/6 lg:max-w-lg lg:w-full md:w-1/2">
                <img class="object-cover object-center rounded" alt="hero" src="{{ $products->first()->images->count() ? Storage::url($products->first()->images->first()->path) : 'https://dummyimage.com/500x300' }}">
            </div>
        </div>
    </section>

    <!-- Features section -->
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-12 mx-auto">
            <h1 class="mb-10 text-3xl font-medium text-center text-gray-900 title-font sm:text-4xl">
                Latest products
            </h1>
            @include('components.product-card', ['products' => $products])
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

    <!-- CTA -->
    <section class="text-gray-600 body-font">
        <div class="container flex flex-col items-center px-5 py-24 mx-auto md:flex-row">
            <div class="flex flex-col w-full pr-0 mb-6 text-center md:pr-10 md:mb-0 md:w-auto md:text-left">
                <h2 class="mb-1 text-xs font-medium tracking-widest text-indigo-500 title-font">{{ env('APP_NAME', 'Pc store') }} App</h2>
                <h1 class="text-2xl font-medium text-gray-900 md:text-3xl title-font">Want to buy products on the go?</h1>
            </div>
            <div class="flex items-center flex-shrink-0 mx-auto space-x-4 md:ml-auto md:mr-0">
                <button class="inline-flex items-center px-5 py-3 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 512 512">
                        <path d="M99.617 8.057a50.191 50.191 0 00-38.815-6.713l230.932 230.933 74.846-74.846L99.617 8.057zM32.139 20.116c-6.441 8.563-10.148 19.077-10.148 30.199v411.358c0 11.123 3.708 21.636 10.148 30.199l235.877-235.877L32.139 20.116zM464.261 212.087l-67.266-37.637-81.544 81.544 81.548 81.548 67.273-37.64c16.117-9.03 25.738-25.442 25.738-43.908s-9.621-34.877-25.749-43.907zM291.733 279.711L60.815 510.629c3.786.891 7.639 1.371 11.492 1.371a50.275 50.275 0 0027.31-8.07l266.965-149.372-74.849-74.847z">
                        </path>
                    </svg>
                    <span class="flex flex-col items-start ml-4 leading-none">
                        <span class="mb-1 text-xs text-gray-600">GET IT ON</span>
                        <span class="font-medium title-font">Google Play</span>
                    </span>
                </button>
                <button class="inline-flex items-center px-5 py-3 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 305 305">
                        <path
                            d="M40.74 112.12c-25.79 44.74-9.4 112.65 19.12 153.82C74.09 286.52 88.5 305 108.24 305c.37 0 .74 0 1.13-.02 9.27-.37 15.97-3.23 22.45-5.99 7.27-3.1 14.8-6.3 26.6-6.3 11.22 0 18.39 3.1 25.31 6.1 6.83 2.95 13.87 6 24.26 5.81 22.23-.41 35.88-20.35 47.92-37.94a168.18 168.18 0 0021-43l.09-.28a2.5 2.5 0 00-1.33-3.06l-.18-.08c-3.92-1.6-38.26-16.84-38.62-58.36-.34-33.74 25.76-51.6 31-54.84l.24-.15a2.5 2.5 0 00.7-3.51c-18-26.37-45.62-30.34-56.73-30.82a50.04 50.04 0 00-4.95-.24c-13.06 0-25.56 4.93-35.61 8.9-6.94 2.73-12.93 5.09-17.06 5.09-4.64 0-10.67-2.4-17.65-5.16-9.33-3.7-19.9-7.9-31.1-7.9l-.79.01c-26.03.38-50.62 15.27-64.18 38.86z">
                        </path>
                        <path d="M212.1 0c-15.76.64-34.67 10.35-45.97 23.58-9.6 11.13-19 29.68-16.52 48.38a2.5 2.5 0 002.29 2.17c1.06.08 2.15.12 3.23.12 15.41 0 32.04-8.52 43.4-22.25 11.94-14.5 17.99-33.1 16.16-49.77A2.52 2.52 0 00212.1 0z"></path>
                    </svg>
                    <span class="flex flex-col items-start ml-4 leading-none">
                        <span class="mb-1 text-xs text-gray-600">Download on the</span>
                        <span class="font-medium title-font">App Store</span>
                    </span>
                </button>
            </div>
        </div>
    </section>

@endsection
