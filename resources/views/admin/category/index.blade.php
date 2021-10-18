@extends('layouts.admin.app')

@section('title', 'Pc store - Categories')
@section('heading', 'Categories')

@section('content')
    <div class="mb-10">
        <div class="flex items-center">
            <a href="{{ route('admin.categories.create') }}"
                class="flex items-center justify-between p-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Create new category
                <span class="ml-2" aria-hidden="true">+</span>
            </a>
        </div>
        <div class="w-full mt-4 overflow-hidden border rounded-lg shadow-xs dark:border-none">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Parent</th>
                            <th class="px-4 py-3">Created by</th>
                            <th class="px-4 py-3">Updated by</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse ($categories as $category)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{ $loop->index + $categories->firstItem() }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <p class="font-semibold">{{ $category->name }}</p>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <p class="font-semibold">{{ $category->parent->name ?? '---' }}</p>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @include('components.forms.profile-with-time', ['model' => $category, 'type' => 'createdBy'])
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @include('components.forms.profile-with-time', ['model' => $category, 'type' => 'updatedBy'])
                                </td>
                                <td class="flex items-center gap-4 px-4 py-3 text-xs">
                                    @include('components.forms.buttons.action-button', ['actions' => ['edit', 'show', 'delete'], 'route' => 'admin.categories', 'route_key' => $category->slug])
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center text-gray-700 dark:text-gray-400">
                                <td colspan="6" class="px-4 py-3 text-sm">
                                    No categories found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @include('admin.partials.pagination', ['paginator' => $categories])
        </div>
    </div>
@endsection
