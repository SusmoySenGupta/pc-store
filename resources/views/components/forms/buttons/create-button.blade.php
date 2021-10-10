<div class="flex items-center">
    <a href="{{ route($route) }}"
        class="flex items-center justify-between p-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        {{ $label }}
        <span class="ml-2" aria-hidden="true">+</span>
    </a>
</div>