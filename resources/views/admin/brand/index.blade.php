@extends('layouts.admin.app')
@section('heading', 'Brands')

@section('content')
    <div class="mb-10">
        <div class="flex items-center">
            @include('components.forms.buttons.create-button', ['route' => 'admin.brands.create', 'label' => 'Create new brand'])
        </div>
        <div class="w-full mt-4 overflow-hidden border rounded-lg shadow-xs dark:border-none">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Created by</th>
                            <th class="px-4 py-3">Updated by</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse ($brands as $brand)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{ $loop->index + $brands->firstItem() }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <p class="font-semibold">{{ $brand->name }}</p>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @include('components.forms.profile-with-time', ['model' => $brand, 'type' => 'createdBy'])
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @include('components.forms.profile-with-time', ['model' => $brand, 'type' => 'updatedBy'])
                                </td>
                                <td class="flex items-center gap-4 px-4 py-3 text-xs">
                                    @include('components.forms.buttons.action-button', ['actions' => ['edit', 'delete'], 'route' => 'admin.brands', 'route_key' => $brand->slug])
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center text-gray-700 dark:text-gray-400">
                                <td colspan="5" class="px-4 py-3 text-sm">
                                    No brands found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @include('admin.partials.pagination', ['paginator' => $brands])
        </div>
    </div>
@endsection
