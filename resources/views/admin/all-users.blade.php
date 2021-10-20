@extends('layouts.admin.app')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
    <!-- New Table -->
    <div class="w-full overflow-hidden border rounded-lg shadow-xs dark:border-none">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Users</th>
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
                                            <img class="object-cover w-full h-full rounded-full" src="{{ asset('img/profile/' . $user->profile_photo) }}" alt="" loading="lazy" />
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
        @include('admin.partials.pagination', ['paginator' => $users])    
    </div>
@endsection
