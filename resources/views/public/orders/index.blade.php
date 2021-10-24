@extends('layouts.app')
@section('content')
    <section class="relative text-gray-600 body-font">
        <div class="container flex flex-col flex-wrap gap-4 px-5 py-24 mx-auto sm:flex-nowrap">
            <table class="w-full mt-4">
                <thead class="mb-4">
                    <tr>
                        <th class="py-2 text-left">Order no</th>
                        <th class="text-center">No of products</th>
                        <th class="text-center">Ordered at</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Delivered at</th>
                        <th class="text-right">Total</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders ?? [] as $order)
                        <tr class="border-b">
                            <td class="py-2">
                                <div class="flex flex-wrap items-center justify-start gap-4 ">
                                    <a href="{{ route('orders.show', $order) }}">#{{ $order->id }}</a>
                                </div>
                            </td>
                            <td class="py-2 text-center">
                                <span>{{ $order->orderDetails->count() }}</span>
                            </td>
                            <td class="py-2 text-center">
                                <span>{{ $order->created_at->format('d/M/Y') }}</span>
                            </td>
                            <td class="py-2 text-center">
                                @if ($order->is_delivered)
                                    <span class="px-2 py-1 text-sm font-semibold leading-tight text-green-700 bg-green-100 rounded-full whitespace-nowrap">
                                        Delivered
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-sm font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full whitespace-nowrap">
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="py-2 text-center">
                                <span>{{ $order->delivered_at ? $order->delivered_at>format('D/M/Y') : '---' }}</span>
                            </td>
                            <td class="py-2 text-right">
                                {{ number_format($order->total_amount, 0, '.', ',') }} BDT
                            </td>
                            <td class="py-2 text-right">
                                <a href="{{ route('orders.show', $order) }}" class="flex items-center justify-center">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg></span>
                                </a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </section>
@endsection
