@extends('layouts.admin.app')
@section('heading', 'Dashboard')

@section('content')
    <!-- Cards -->
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <!-- Card -->
        <div class="flex items-center p-4 bg-white border rounded-lg shadow-xs dark:bg-gray-800 dark:border-none">
            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total users
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $total_users }}
                </p>
            </div>
        </div>
        <!-- Card -->
        <div class="flex items-center p-4 bg-white border rounded-lg shadow-xs dark:bg-gray-800 dark:border-none">
            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total incomes
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ number_format($total_incomes, 0, '.', ',') }} BDT
                </p>
            </div>
        </div>
        <!-- Card -->
        <div class="flex items-center p-4 bg-white border rounded-lg shadow-xs dark:bg-gray-800 dark:border-none">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Delivered orders
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $total_delivered_orders }}
                </p>
            </div>
        </div>
        <!-- Card -->
        <div class="flex items-center p-4 bg-white border rounded-lg shadow-xs dark:bg-gray-800 dark:border-none">
            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Pending orders
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $total_pending_orders }}
                </p>
            </div>
        </div>
    </div>

    <!-- New Table -->
    <div class="w-full overflow-hidden border rounded-lg shadow-xs dark:border-none">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Users</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Registered at</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Verified at</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @forelse ($users as $user)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                        @if ($user->profile_photo)
                                            <img class="object-cover w-full h-full rounded-full" src="{{ Storage::url($user->profile_photo) }}" alt="profile" loading="lazy" />
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @endif
                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                    </div>
                                    <div>
                                        <p class="font-semibold">{{ $user->name }} {{ auth()->user()->id == $user->id ? '(You)' : '' }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ Str::ucfirst($user->role) }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $user->email }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $user->created_at->format('M d, Y h:i A') }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                @if ($user->email_verified_at)
                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                        Verified
                                    </span>
                                @else
                                    <span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $user->email_verified_at?->format('M d, Y h:i A') ?? '---' }}
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center text-gray-700 dark:text-gray-400">
                            <td colspan="10" class="px-4 py-3 text-sm">
                                No users found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($total_users > 5)
            <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <a href="{{ route('admin.user.index') }}" class="flex items-center col-span-3">
                    See all users
                </a>
            </div>
        @endif
    </div>
@endsection
