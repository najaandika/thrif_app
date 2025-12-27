<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;
    public $search = '';

    protected $listeners = [
        'delete' => 'deleteCategory',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteCategory(int $id): void
    {
        $category = Category::find($id);
        
        if ($category) {
            $category->delete();
            session()->flash('message', 'Category deleted successfully.');
        }
    }

    public function render()
    {
        $categories = Category::query()
            ->withCount('products')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.categories.index', [
            'categories' => $categories,
        ]);
    }
}
