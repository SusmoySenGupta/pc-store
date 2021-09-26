@php
$side_navs = [
    'Dashboard' => [
        'route' => 'admin.dashboard',
        'icon' => '<svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"> </path></svg>',
    ],
    'Categories' => [
        'all-route' => 'admin.categories.*',
        'route' => 'admin.categories.index',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>',
    ],
    'Brands' => [
        'route' => '',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>'
    ],
];
@endphp

<div class="py-4 text-gray-500 dark:text-gray-400">
    <a class="ml-6 text-xl text-gray-500 dark:text-gray-200 flex items-center gap-2" href="{{ route('admin.dashboard') }}">
        <x-application-logo class="w-8 h-8 fill-current text-gray-500 dark:text-gray-200" />
        <span class="tracking-tighter"><span class="font-semibold">P</span>c store</span>
    </a>
    <ul class="mt-6">
        @forelse ($side_navs as $key => $value)
            <li class="relative px-6 py-3">
                @php $active = ""; @endphp
                @if ($value['route'] && request()->routeIs($value['all-route'] ?? $value['route']))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                    @php $active = 'text-gray-800 dark:text-gray-100'; @endphp
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $active }}"
                    href="{{ $value['route'] ? route($value['route']) : '#' }}">
                   {!! $value['icon'] !!}
                    <span class="ml-4">{{ $key }}</span>
                </a>
            </li>
        @empty

        @endforelse
    </ul>
</div>
