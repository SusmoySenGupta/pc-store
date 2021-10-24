@extends('layouts.app')
@section('content')
    <section class="relative text-gray-600 body-font">
        <div class="container flex flex-wrap px-5 py-24 mx-auto sm:flex-nowrap">
            <form action="{{ route('orders.store') }}" method="POST" onsubmit="return confirm('Are you sure?')" class="flex flex-col w-full mx-auto mt-8 bg-white lg:w-1/3 md:w-1/2 md:py-8 md:mt-0">
                @csrf
                <h1 class="mb-4 text-2xl font-medium text-gray-900 sm:text-3xl title-font">Payment form</h1>
                <div class="relative mb-4">
                    <label for="payment_method" class="text-sm leading-7 text-gray-600">Payment method</label>
                    <select type="text" name="payment_method" required class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-white border border-gray-300 rounded outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                        <option value="Bkash">Bkash</option>
                        <option value="Nagad">Nagad</option>
                        <option value="Rocket">Rocket</option>
                    </select>
                </div>
                <div class="relative mb-4">
                    <label for="txn_id" class="text-sm leading-7 text-gray-600">Txn id</label>
                    <input type="number" name="txn_id" required class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-white border border-gray-300 rounded outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                </div>
                <div class="relative mb-4">
                    <label for="txn_id" class="text-sm leading-7 text-gray-600">Amount</label>
                    <input type="number" name="amount" value="{{ $cart->total_price }}" required readonly class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 border border-gray-300 rounded focus:outline-none outline-none">
                </div>
                <button type="submit" class="px-6 py-2 text-lg text-white bg-indigo-500 border-0 rounded focus:outline-none hover:bg-indigo-600">Checkout</button>
                <p class="mt-3 text-xs text-gray-500">Orders can not be canceled.</p>
            </form>
        </div>
    </section>
@endsection
