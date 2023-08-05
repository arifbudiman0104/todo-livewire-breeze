<div>
    <div class="sm:flex space-y-4 sm:space-y-0 sm:gap-5 justify-between items-center">
        <div class="flex-shrink">
            <x-primary-button-link wire:navigate href="{{ route('todo.create') }}">
                {{ __('Create Todo') }}
            </x-primary-button-link>
        </div>
        <div>
            <x-text-input wire:model.live.debounce.500ms='search' id="search" class="w-full sm:w-72" type="text"
                name="search" autofocus autocomplete="search" placeholder="Search here" />
        </div>
    </div>
    <div class="mt-5 space-y-5">
        @forelse ($todos as $todo)
            <div wire:key='{{ $todo->id }}'
                class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 flex flex-col justify-between">
                <div class="flex items-start justify-between">
                    <div class="flex items-start flex-grow gap-4">
                        <div class="flex-shrink-0">
                            <input wire:click="check({{ $todo->id }})" type="checkbox"
                                {{ $todo->is_complete ? 'checked' : '' }}
                                class="rounded p-3 dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                        </div>
                        @if ($editingTodoId == $todo->id)
                            <div class="w-full">
                                <x-text-input wire:model='editingTodoTitle' id="title" class="w-full" type="text"
                                    required autofocus autocomplete="title" />
                                <x-input-error :messages="$errors->get('editingTodoTitle')" class="mt-2" />
                                <div class="flex mt-3 gap-5">
                                    <x-primary-button wire:click.prevent='update({{ $todo->id }})'>
                                        {{ __('Update') }}
                                    </x-primary-button>
                                    <x-secondary-button wire:click.prevent='cancelEdit'>
                                        {{ __('Cancel') }}
                                    </x-secondary-button>
                                </div>
                            </div>
                        @else
                            <div>
                                <div class="flex items-center">
                                    <h2
                                        class="text-lg font-medium text-gray-900 dark:text-gray-100 {{ $todo->is_complete ? 'line-through text-gray-400 dark:text-gray-500' : '' }}">
                                        {{ $todo->title }}
                                    </h2>
                                    @if ($todo->created_at != $todo->updated_at)
                                        <p class="ml-3 text-xs text-gray-500 dark:text-gray-400">
                                            edited
                                        </p>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $todo->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endif
                    </div>
                    <div class="flex gap-5 ml-5 items-start">
                        <button wire:click='edit({{ $todo->id }})'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6 text-gray-800 dark:text-gray-200 hover:text-indigo-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </button>
                        <button wire:click='delete({{ $todo->id }})'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6 text-gray-800 dark:text-gray-200 hover:text-indigo-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <p>
                No todos found
            </p>
        @endforelse
    </div>
</div>
