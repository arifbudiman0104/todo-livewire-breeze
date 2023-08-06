<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class TodoList extends Component
{
    public $search;

    public $editingTodoId;

    #[Rule('required|min:3|max:255')]
    public $editingTodoTitle;

    public function deleteAllCompletedTodo()
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

    public function cancelEdit()
    {
        $this->reset(['editingTodoId', 'editingTodoTitle']);
        $this->resetErrorBag();
    }

    public function update(Todo $todo)
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

    public function edit(Todo $todo)
    {
        $this->editingTodoId = $todo->id;
        $this->editingTodoTitle = $todo->title;
        $this->resetErrorBag();
    }

    public function delete(Todo $todo)
    {
        Todo::where('id', $todo->id)->delete();

        // $todo->delete();
    }

    public function check(Todo $todo)
    {
        Todo::withoutTimestamps(function () use ($todo) {
            Todo::where('id', $todo->id)
                ->update(['is_complete' => ! $todo->is_complete]);
        });

        // $todo->timestamps = false
        // $todo->update(['is_complete' => ! $todo->is_complete]);
    }

    public function render()
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
