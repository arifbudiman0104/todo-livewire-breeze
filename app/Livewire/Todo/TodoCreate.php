<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class TodoCreate extends Component
{
    #[Rule('required|min:3|max:255')]
    public $title;

    public function create()
    {
        // ddd('test');
        $validated = $this->validateOnly('title');

        Todo::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
        ]);

        // Auth::user()
        //     ->todos()
        //     ->create($validated);

        $this->redirect(route('todo.index'));
    }

    public function render()
    {
        return view('livewire.todo.todo-create');
    }
}
