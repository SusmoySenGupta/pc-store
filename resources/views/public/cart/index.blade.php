@extends('layouts.app')

@section('content')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col w-full mb-20 text-center">
                <div class="flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h1 class="text-2xl font-medium text-gray-900 sm:text-3xl title-font"> Cart </h1>
                </div>
                @if ($errors->any())
                    @foreach ($errors->get('quantity.*') as $quantity_errors)
                        @foreach ($quantity_errors as $quantity_error)
                            <p class="text-left text-base text-red-500">{{ $quantity_error }}</p>
                        @endforeach
                    @endforeach
                @endif

                @if ($cart?->products->count())
                    <form action="{{ route('cart.update', $cart) }}" class="w-full" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <table class="w-full mt-4">
                            <thead class="mb-4">
                                <tr>
                                    <th class="py-2 text-left">Product</th>
                                    <th class="text-left">Quantity</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cart->products ?? [] as $product)
                                    <tr class="border-b">
                                        <td class="py-2">
                                            <div class="flex flex-wrap items-center justify-start gap-4 ">
                                                <img class="hidden w-20 h-20 md:block" src="{{ $product->images->count() ? Storage::url($product?->images?->first()?->path) : 'https://dummyimage.com/500x300' }}" alt="product">
                                                <a href="{{ route('product.show', $product) }}">{{ $product->name }}</a>
                                            </div>
                                        </td>
                                        <td class="py-2 text-left">
                                            <input type="hidden" class="hidden" name="product_id[]" value="{{ $product->id }}">
                                            <input name="quantity[]" type="number" class="w-20 rounded" max="25" value="{{ $product->pivot->quantity }}">
                                        </td>
                                        <td class="py-2 text-right">
                                            <span>{{ number_format(round($product->offer_price), 0, '.', ',') }} BDT</span>
                                        </td>
                                        <td class="py-2 text-right">
                                            {{ number_format(round($product->offer_price * $product->pivot->quantity), 0, '.', ',') }} BDT
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                            <tfoot>
                                @if ($cart?->products->count())
                                    <tr>
                                        <th class="py-4 text-left"></th>
                                        <th class="py-4 text-left">
                                            <button type="submit" class="inline-flex items-center justify-center gap-2 px-2 py-1 border rounded">
                                                <span>Update</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                            </button>
                                        </th>
                                        <th class="py-4 text-right">Sub total:</th>
                                        <th class="py-4 text-right">{{ number_format(round($cart->total_price), 0, '.', ',') }} BDT</th>
                                    </tr>
                                @endif
                            </tfoot>
                        </table>
                    </form>
                    <div class="flex justify-center mt-16 item-center gap-4">
                        <button class="flex px-8 py-2  text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">
                            Confirm order
                        </button>
                        <form action="{{ route('cart.destroy', $cart) }}" onsubmit="return confirm('Are you sure you want to clear your cart?')" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center gap-2 px-8 py-2 border rounded">
                                <span>Clear</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @else
                    <p class="mt-6 animate-pulse">No product available</p>
                @endif
            </div>
        </div>
    </section>
@endsection
