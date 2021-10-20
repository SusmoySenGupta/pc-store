<div class="flex items-center">
    @if ($model[$type]?->id != null)
        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
            @if ($model[$type]?->profile_photo)
                <img class="object-cover w-8 h-8 rounded-full" src="{{ Storage::url($model[$type]->profile_photo) }}" alt="" aria-hidden="true" />
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-600 dark:text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                </svg>
            @endif
            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
        </div>
        <div>
            <p class="font-semibold">{{ $model[$type]?->name }}</p>
            <p class="text-xs text-gray-600 dark:text-gray-400">
                @if ($type === 'createdBy' && $model->createdBy)
                    {{ $model->created_at->diffForHumans() }}
                @elseif ($type === 'updatedBy' && $model->updated_by)
                    {{ $model->updated_at->diffForHumans() }}
                @endif
            </p>
        </div>
    @else
        @if ($type === 'createdBy')
            <p class="font-semibold">Created by the system</p>
        @elseif ($type === 'updatedBy')
            <p class="font-semibold">No one has updated yet</p>
        @endif
    @endif
</div>
