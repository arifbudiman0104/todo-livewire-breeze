<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class TodoList extends Component
{
    public $search;

    public $editingTodoId;

    #[Rule('required|min:3|max:255')]
    public $editingTodoTitle;

    public function deleteAllCompletedTodo(): void
    {
        $todos = Todo::where('user_id', auth()->id())
            ->where('is_complete', true)
            ->get();

        // $todos = Auth::user()
        //     ->todos()
        //     ->where('is_complete', true)
        //     ->get();

        foreach ($todos as $todo) {
            $todo->delete();
        }
    }

    public function cancelEdit(): void
    {
        $this->reset(['editingTodoId', 'editingTodoTitle']);
        $this->resetErrorBag();
    }

    public function update(Todo $todo): void
    {
        $validated = $this->validateOnly('editingTodoTitle');

        Todo::where('id', $todo->id)->update([
            'title' => $validated['editingTodoTitle'],
        ]);

        // $todo->update([
        //     'title' => $validated['editingTodoTitle'],
        // ]);

        $this->cancelEdit();
    }

    public function edit(Todo $todo): void
    {
        $this->editingTodoId = $todo->id;
        $this->editingTodoTitle = $todo->title;
        $this->resetErrorBag();
    }

    public function delete(Todo $todo): void
    {
        Todo::where('id', $todo->id)->delete();

        // $todo->delete();
    }

    public function check(Todo $todo): void
    {
        Todo::withoutTimestamps(function () use ($todo) {
            Todo::where('id', $todo->id)
                ->update(['is_complete' => ! $todo->is_complete]);
        });

        // $todo->timestamps = false
        // $todo->update(['is_complete' => ! $todo->is_complete]);
    }

    // #[On('todoCreated')]     // uncomment this line if you want to use single component on one page
    public function render(): View
    {
        $todos = Todo::where('user_id', auth()->id())
            ->where('title', 'like', '%'.$this->search.'%')
            ->orderBy('is_complete')
            ->latest()
            ->get();

        // $todos = Auth::user()
        //     ->todos()
        //     ->where('title', 'like', '%'.$this->search.'%')
        //     ->orderBy('is_complete')
        //     ->latest()
        //     ->get();

        return view('livewire.todo.todo-list', compact('todos'));
    }
}
