@extends('layouts.admin.app')

@section('title', 'Component Details')
@section('heading', 'Component Details')

@section('content')
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="grid items-center justify-center grid-cols-1 gap-2 mb-2 sm:grid-cols-3">
            <span></span>
            <p class="font-bold leading-tight text-center text-gray-700 dark:text-gray-200">
                Component - {{ $component->name }}
            </p>
            <div class="justify-end hidden sm:flex">
                <a href="{{ url()->previous() == url()->current() ? route('admin.components.index') : url()->previous() }}"
                    class="inline-flex items-center justify-center flex-none w-full gap-2 px-4 py-2 text-sm font-medium leading-6 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
        <hr>
        <div class="flex flex-col justify-start gap-4 px-3 mt-2 mb-3">
            <div class="flex items-center gap-2">
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                    Parent:
                </span>
                <span class="text-sm text-gray-700 dark:text-gray-200">
                    {{ $component->parent->name ?? '---' }}
                </span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                    Created at:
                </span>
                <span class="text-sm text-gray-700 dark:text-gray-200">
                    {{ $component->created_at->format('d-M-Y h:m:s') }}
                </span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                    Created by:
                </span>
                <div class="flex items-center">
                    <!-- Avatar with inset shadow -->
                    <div class="relative hidden w-8 h-8 mr-1.5 rounded-full md:block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-600 dark:text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                    </div>
                    <div>
                        <a href="#" class="text-sm font-semibold text-gray-600 underline dark:text-gray-400">
                            {{ $component->created_by ?? 'Jolina Angelie' }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                    Updated at:
                </span>
                <span class="text-sm text-gray-700 dark:text-gray-200">
                    {{ $component->updated_at->format('d-M-Y h:m:s') }}
                </span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                    Updated by:
                </span>
                <div class="flex items-center">
                    <!-- Avatar with inset shadow -->
                    <div class="relative hidden w-8 h-8 mr-1.5 rounded-full md:block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-600 dark:text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                    </div>
                    <div>
                        <a href="#" class="text-sm font-semibold text-gray-600 underline dark:text-gray-400">
                            {{ $component->updated_by ?? 'Sarah Curry' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="block sm:hidden">
        <div class="block mt-3 sm:hidden">
            <a href="{{ url()->previous() == url()->current() ? route('admin.categories.index') : url()->previous() }}"
                class="inline-flex items-center justify-center flex-none w-full gap-2 px-4 py-2 text-sm font-medium leading-6 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
            </a>
        </div>
    </div>
@endsection
