<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Create extends Component
{
    public $name = '';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function save()
    {
        $this->validate();

        Category::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
        ]);

        session()->flash('message', 'Category created successfully.');

        return redirect()->route('categories.index');
    }

    public function render()
    {
        return view('livewire.categories.create');
    }
}
