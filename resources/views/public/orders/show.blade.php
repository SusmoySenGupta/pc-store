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
                @if ($order?->orderDetails?->count())
                    <div class="w-full">
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
                                @forelse ($order->orderDetails ?? [] as $orderDetail)
                                    <tr class="border-b">
                                        <td class="py-2">
                                            <div class="flex flex-wrap items-center justify-start gap-4 ">
                                                <img class="hidden w-20 h-20 md:block" src="{{ $orderDetail->product->images->count() ? Storage::url($orderDetail->product?->images?->first()?->path) : 'https://dummyimage.com/500x300' }}" alt="product">
                                                <a href="{{ route('product.show', $orderDetail->product) }}">{{ $orderDetail->product->name }}</a>
                                            </div>
                                        </td>
                                        <td class="py-2 text-left">
                                            <span>{{ $orderDetail->quantity }}</span>
                                        </td>
                                        <td class="py-2 text-right">
                                            <span>{{ number_format(round($orderDetail->price), 0, '.', ',') }} BDT</span>
                                        </td>
                                        <td class="py-2 text-right">
                                            {{ number_format(round($orderDetail->price * $orderDetail->quantity), 0, '.', ',') }} BDT
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                            <tfoot>
                                @if ($order->orderDetails->count())
                                    <tr>
                                        <th class="py-4 text-left"></th>
                                        <th class="py-4 text-left"></th>
                                        <th class="py-4 text-right">Sub total:</th>
                                        <th class="py-4 text-right">{{ number_format($order->orderDetails->sum('price'), 0, '.', ',') }} BDT</th>
                                    </tr>
                                @endif
                            </tfoot>
                        </table>
                    </div>
                @else
                    <p class="mt-6 animate-pulse">No product available</p>
                @endif
            </div>
        </div>
    </section>
@endsection
