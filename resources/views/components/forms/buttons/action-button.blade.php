@if (in_array('edit', $actions))
    <a href="{{ route($route . '.edit', $route_key) }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-500 transition duration-500 ease-in-out transform dark:text-gray-400 dark:hover:text-purple-600 hover:-translate-y-1 hover:scale-110" viewBox="0 0 20 20" fill="currentColor">
            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
        </svg>
    </a>
@endif
@if (in_array('show', $actions))
    <a href="{{ route($route . '.show', $route_key) }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-pink-500 transition duration-500 ease-in-out transform dark:text-gray-400 dark:hover:text-pink-600 hover:-translate-y-1 hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
    </a>
@endif
@if (in_array('delete', $actions))
    <form action="{{ route($route . '.destroy', $route_key) }}" method="POST" onsubmit="return confirm('Do you want to delete {{ $name ?? '' }}?')">
        @csrf
        @method('DELETE')
        <button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-500 transition duration-500 ease-in-out transform dark:text-gray-400 dark:hover:text-red-600 hover:-translate-y-1 hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </button>
    </form>
@endif
