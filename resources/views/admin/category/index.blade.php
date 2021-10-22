@extends('layouts.admin.app')
@section('heading', 'Categories')

@section('content')
    <div class="mb-10">
        <div class="flex flex-col items-start justify-start gap-4 sm:flex-row sm:items-center sm:justify-between">
            @include('components.forms.buttons.create-button', ['label' => 'Create new category', 'route' => 'admin.categories.create'])
            @include('admin.partials.trashed-link', ['route' => 'admin.categories.trashed', 'model' => 'App\Models\Category'])
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
