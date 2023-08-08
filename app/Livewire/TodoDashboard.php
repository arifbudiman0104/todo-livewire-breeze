<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoDashboard extends Component
{
    public function placeholder()
    {
        return <<<'HTML'
        <p class="text-sm text-indigo-600 dark:text-indigo-400 space-y-1">
            Loading...
        </p>
        HTML;
    }

    public function render()
    {
        sleep(2);
        $todosCompleted = Todo::where('user_id', auth()->id())->where('is_complete', true)->count();
        // $todosCompleted = auth()->user()->todos()->where('is_complete', true)->count();

        $todoNotCompleted = Todo::where('user_id', auth()->id())->where('is_complete', false)->count();
        // $todoNotCompleted = auth()->user()->todos()->where('is_complete', false)->count();

        return view('livewire.todo.todo-dashboard', compact('todosCompleted', 'todoNotCompleted'));
    }
}
