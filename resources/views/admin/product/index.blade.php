@extends('layouts.admin.app')
@section('heading', 'Products')

@section('content')
    <div class="mb-10">
        <div class="flex flex-col items-start justify-start gap-4 sm:flex-row sm:items-center sm:justify-between">
            @include('components.forms.buttons.create-button', ['route' => 'admin.products.create', 'label' => 'Create new product'])
            @include('admin.partials.trashed-link', ['route' => 'admin.products.trashed', 'model' => 'App\Models\Product'])
        </div>
        <div class="w-full mt-4 overflow-hidden border rounded-lg shadow-xs dark:border-none">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">SKU</th>
                            <th class="px-4 py-3">Price</th>
                            <th class="px-4 py-3 whitespace-nowrap">Stock Qty.</th>
                            <th class="px-4 py-3">Discount</th>
                            <th class="px-4 py-3">Created by</th>
                            <th class="px-4 py-3">Updated by</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse ($products as $product)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-xs">
                                    {{ $loop->index + $products->firstItem() }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <p class="font-semibold">{{ $product->name }}</p>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <p class="font-semibold">{{ $product->sku }}</p>
                                </td>
                                <td class="px-4 py-3 text-xs whitespace-nowrap">
                                    <p>Tk {{ $product->price }}</p>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <p>{{ $product->stock }}</p>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <p>{{ $product->discount_percentage ?? 0 }}%</p>
                                </td>
                                <td class="px-4 py-3 text-xs whitespace-nowrap">
                                    @include('components.forms.profile-with-time', ['model' => $product, 'type' => 'createdBy'])
                                </td>
                                <td class="px-4 py-3 text-xs whitespace-nowrap">
                                    @include('components.forms.profile-with-time', ['model' => $product, 'type' => 'updatedBy'])
                                </td>
                                <td class="px-4 py-3 text-xs whitespace-nowrap">
                                    <div class="flex items-center gap-2 ">
                                        @include('components.forms.buttons.action-button', ['actions' => ['edit', 'show', 'delete'], 'route' => 'admin.products', 'route_key' => $product->id])
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center text-gray-700 dark:text-gray-400">
                                <td colspan="10" class="px-4 py-3 text-sm">
                                    No products found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @include('admin.partials.pagination', ['paginator' => $products])
        </div>
    </div>
@endsection
