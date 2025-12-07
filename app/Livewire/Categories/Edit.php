<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Edit extends Component
{
    public Category $category;
    public $name;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
    }

    public function update()
    {
        $this->validate();

        $this->category->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Category updated successfully.');

        return redirect()->route('categories.index');
    }

    public function render()
    {
        return view('livewire.categories.edit');
    }
}
