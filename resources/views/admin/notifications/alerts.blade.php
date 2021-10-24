@extends('layouts.admin.app')
@section('heading', 'Alerts')

@section('content')
    <div class="mb-10">
        <form action="{{ route('admin.notifications.alerts.clear') }}" method="POST">
            @csrf
            @method('Delete')
            <x-button class="">
                {{ __('Clear all') }}
            </x-button>
        </form>
        <div class="w-full mt-4 overflow-hidden border rounded-lg shadow-xs dark:border-none">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">Deleted by</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse ($alerts as $alert)
                            <tr class="text-gray-700 dark:text-gray-400 @if($alert->read_at === null) bg-gray-200 dark:bg-gray-600 @endif">
                                <td class="px-4 py-3 text-sm">
                                    {{ $loop->index + $alerts->firstItem() }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ $alert->data['link'] }}" class="font-semibold underline">
                                        {{ $alert->data['name']['name'] }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <p class="font-semibold">{{ $alert->data['type'] }}</p>
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <div class="">
                                        <p class="font-semibold">{{ $alert->data['deleted_by_name'] }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $alert->data['deleted_by_email'] }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            @php
                                $alert->markAsRead();
                            @endphp
                        @empty
                            <tr class="text-center text-gray-700 dark:text-gray-400">
                                <td colspan="6" class="px-4 py-3 text-sm">
                                    No alerts available.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @include('admin.partials.pagination', ['paginator' => $alerts])
        </div>
    </div>
@endsection
