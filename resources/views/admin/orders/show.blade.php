@extends('layouts.admin.app')
@section('heading', 'Order Details')

@section('content')
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex items-center justify-between mb-2">
            <div class="text-xs">
                @if ($order->is_delivered)
                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                        Delivered
                    </span>
                @else
                    <span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                        Pending
                    </span>
                @endif
            </div>
            <p class="font-bold leading-tight text-center text-gray-700 dark:text-gray-200">
                #Order - {{ $order->id }}
            </p>
            <div class="justify-end hidden sm:flex">
                @include('components.forms.buttons.back-button', ['base' => 'admin.orders.index'])
            </div>
        </div>

        <hr>

        <div class="flex flex-col gap-2 my-2">
            <div class="flex items-center justify-between mb-1">
                <p class="text-xs text-gray-800 dark:text-gray-400 whitespace-nowrap">Order number:</p>
                <span class="px-2 py-1 text-xs font-semibold leading-tight text-blue-700 bg-blue-200 rounded-full dark:text-white dark:bg-blue-600">
                    #{{ $order->id }}
                </span>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-800 dark:text-gray-400 whitespace-nowrap">Customer name:</p>
                <p class="text-xs font-semibold text-right text-gray-800 break-words dark:text-gray-200">
                    {{ $order->user->name }}
                </p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-800 dark:text-gray-400 whitespace-nowrap">Customer phone:</p>
                <p class="text-xs font-semibold text-right text-gray-800 break-words dark:text-gray-200">
                    {{ $order->user->phone }}
                </p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-800 dark:text-gray-400 whitespace-nowrap">Customer email:</p>
                <p class="text-xs font-semibold text-right text-gray-800 break-words dark:text-gray-200">
                    {{ $order->user->email }}
                </p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-800 dark:text-gray-400 whitespace-nowrap">Delivery address:</p>
                <p class="text-xs font-semibold text-right text-gray-800 break-words dark:text-gray-200">
                    {{ $order->shipping_address }}
                </p>
            </div>
        </div>

        <hr>

        @php
            $sub_total = 0;
            $discount_amount = 0;
        @endphp
        <div class="flex flex-col gap-2 my-2">
            @forelse ($order->orderDetails as $orderDetail)
                @php
                    $amount = $orderDetail->product->price * $orderDetail->quantity;
                    $discount_amount += $amount - $orderDetail->product->price * ($orderDetail->product->discount_percentage / 100) * $orderDetail->quantity;
                    $sub_total += $amount;
                @endphp
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start gap-4">
                        <p class="text-xs font-semibold text-right text-gray-800 break-words dark:text-gray-200 whitespace-nowrap">
                            {{ $orderDetail->quantity }}x
                        </p>
                        <p class="text-xs text-gray-800 dark:text-gray-400">
                            {{ $orderDetail->product->name }}
                        </p>
                    </div>
                    <p class="text-xs font-semibold text-right text-gray-800 break-words dark:text-gray-200 whitespace-nowrap">Tk {{ round($orderDetail->quantity * $orderDetail->product->price) }}</p>
                </div>
            @empty
                <p class="text-xs font-semibold text-center text-red-600 break-words dark:text-gray-200 whitespace-nowrap">
                    Something went wrong
                </p>
            @endforelse
        </div>

        <hr>

        <div class="flex flex-col gap-2 my-2">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold text-gray-800 dark:text-gray-200 whitespace-nowrap">Subtotal:</p>
                <p class="text-xs font-semibold text-gray-800 dark:text-gray-200 whitespace-nowrap">Tk {{ $sub_total }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-800 dark:text-gray-400 whitespace-nowrap">Discount:</p>
                <p class="text-xs font-semibold text-right text-gray-800 break-words dark:text-gray-200 whitespace-nowrap">- Tk {{ round($discount_amount) }}</p>
            </div>
        </div>

        <hr>

        <div class="flex flex-col gap-2 my-2">
            <div class="flex items-center justify-between px-1 py-2 bg-gray-100 rounded dark:bg-gray-700">
                <p class="text-xs font-semibold text-gray-800 dark:text-gray-200 whitespace-nowrap">Total:</p>
                <p class="text-xs font-semibold text-gray-800 dark:text-gray-200 whitespace-nowrap">Tk {{ round($sub_total) - round($discount_amount) }}</p>
            </div>
        </div>

        <hr class="block sm:hidden">

        <div class="block mt-3 sm:hidden">
            @include('components.forms.buttons.back-button', ['base' => 'admin.orders.index'])
        </div>
    </div>
@endsection
