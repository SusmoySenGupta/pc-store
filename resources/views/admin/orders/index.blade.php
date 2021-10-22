@extends('layouts.admin.app')
@section('heading', 'Orders')

@section('content')
    <div class="mb-10">
        <div class="w-full mt-4 overflow-hidden border rounded-lg shadow-xs dark:border-none">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">#Order</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Amount</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Updated by</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse ($orders as $order)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{ $loop->index + $orders->firstItem() }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <p class="font-semibold">#{{ $order->id }}</p>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <div class="flex items-center text-sm">
                                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                            <img class="object-cover w-full h-full rounded-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=200&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" loading="lazy">
                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                        </div>
                                        <div>
                                            <p class="font-semibold">{{ $order->customer->name }}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                {{ $order->customer->phone }}
                                            </p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                {{ $order->customer->address }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sx">
                                    <span class="font-semibold">৳ {{ $order->total_amount }}</span>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @if ($order->is_delivered)
                                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            Delivered
                                        </span>
                                    @else
                                        <span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @include('components.forms.profile-with-time', ['model' => $order, 'type' => 'updatedBy'])
                                </td>
                                <td class="px-4 py-3 text-xs ">
                                    <div class="flex items-center gap-2">
                                        @include('components.forms.buttons.action-button', ['actions' => ['show'], 'route' => 'admin.orders', 'route_key' => $order->id])

                                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" onsubmit="return confirm('Do you want to mark this order as {{ $order->is_delivered ? 'pending' : 'delivered' }} ?')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit">
                                                @if($order->is_delivered)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-500 transition duration-500 ease-in-out transform dark:text-gray-400 dark:hover:text-red-600 hover:-translate-y-1 hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                  </svg>
                                                @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500 transition duration-500 ease-in-out transform dark:text-gray-400 dark:hover:text-green-500 hover:-translate-y-1 hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center text-gray-700 dark:text-gray-400">
                                <td colspan="10" class="px-4 py-3 text-sm">
                                    No orders found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @include('admin.partials.pagination', ['paginator' => $orders])
        </div>
    </div>
@endsection
