<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;

class Dashboard extends Component
{
    public function placeholder()
    {
        return <<<'HTML'
        <div>
            loading data...
        </div>
        HTML;
    }

    public function render()
    {
        sleep(2);
        $todosCompleted = Todo::where('user_id', auth()->id())->where('is_complete', true)->count();
        // $todosCompleted = auth()->user()->todos()->where('is_complete', true)->count();

        $todoNotCompleted = Todo::where('user_id', auth()->id())->where('is_complete', false)->count();
        // $todoNotCompleted = auth()->user()->todos()->where('is_complete', false)->count();

        return view('livewire.dashboard', compact('todosCompleted', 'todoNotCompleted'));
    }
}
