<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a wire:navigate href="{{ route('todo.index') }}" class="hover:text-indigo-500">Todo</a> <span>/ Create</span>
        </h2>
    </x-slot>

    <div class="sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900 dark:text-gray-100">
                    @livewire('todo.todo-create')
                    {{-- <livewire:todo.todo-create /> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
