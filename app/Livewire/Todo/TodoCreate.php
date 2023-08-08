<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class TodoCreate extends Component
{
    #[Rule('required|min:3|max:255')]
    public $title;

    public function create(): void
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

        // uncomment this line if you want to use multiple component on one page
        // $this->reset('title');
        // $this->dispatch('todoCreated');

        // comment this line if you want to use single component on one page
        $this->redirect(route('todo.index'));
    }

    public function render(): View
    {
        return view('livewire.todo.todo-create');
    }
}
