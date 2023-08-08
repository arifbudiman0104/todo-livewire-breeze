<div>
    <div class="mt-5 space-y-5">
        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 flex flex-col justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Todo Complete</h2>
                <p class="mt-2 text-xl text-indigo-600 dark:text-indigo-300">{{ $todosCompleted }}</p>
            </div>
        </div>
        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 flex flex-col justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Todo Not Complete</h2>
                <p class="mt-2 text-xl text-indigo-600 dark:text-indigo-300">{{ $todoNotCompleted }}</p>
            </div>
        </div>
    </div>
</div>
