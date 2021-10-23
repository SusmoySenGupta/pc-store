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

                <table class="mt-4">
                    <thead class="mb-4">
                        <tr>
                            <th class="text-left py-2">Product</th>
                            <th class="text-left">Quantity</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cart->products ?? [] as $item)
                            <tr class="border-b">
                                <td class="py-2">
                                    <div class="flex flex-wrap items-center justify-start gap-4 ">
                                        <img class="hidden md:block w-20 h-20" src="{{ Storage::url($item->images->first()->path) }}" alt="product">
                                        <span>{{ $item->name }}</span>
                                    </div>
                                </td>
                                <td class="text-left">
                                    {{ $item->pivot->quantity }}
                                </td>
                                <td class="text-right">
                                    <span>{{ number_format(round($item->price), 0, '.', ',') }} BDT</span>
                                </td>
                                <td class="text-right">
                                    {{ number_format(round($item->price * $item->pivot->quantity), 0, '.', ',') }} BDT
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                    <tfoot>
                        @if ($cart->products)
                            <tr>
                                <th class="py-4"></th>
                                <th class="py-4"></th>
                                <th class="py-4 text-right">Sub total:</th>
                                <th class="py-4 text-right">{{ number_format(round($cart->total_price ?? 0), 0, '.', ',') }} BDT</th>
                            </tr>
                        @endif
                    </tfoot>
                </table>
            </div>

            <button class="flex px-8 py-2 mx-auto mt-16 text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">
                Confirm order
            </button>
        </div>
    </section>
@endsection
