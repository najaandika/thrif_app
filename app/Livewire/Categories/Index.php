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

    public bool $showDeleteModal = false;

    public ?int $categoryIdToDelete = null;

    protected $listeners = [
        'deleteCategory' => 'confirmDelete',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete(int $id): void
    {
        $this->categoryIdToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function deleteConfirmed(): void
    {
        if (!$this->categoryIdToDelete) {
            return;
        }

        $category = Category::find($this->categoryIdToDelete);
        if ($category) {
            $category->delete();
            session()->flash('message', 'Category deleted successfully.');
        }

        $this->showDeleteModal = false;
        $this->categoryIdToDelete = null;
    }

    public function render()
    {
        $categories = Category::where('user_id', Auth::id())
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.categories.index', [
            'categories' => $categories,
        ]);
    }
}
