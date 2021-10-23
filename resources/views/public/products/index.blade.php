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
            @include('components.product-card', ['products' => $products])
        </div>
    </section>
@endsection
