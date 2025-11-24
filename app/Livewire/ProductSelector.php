<?php
namespace App\Livewire;

use Livewire\Component;

class ProductSelector extends Component
{
    public $query = '';

    protected $updatesQueryString = ['query'];

    public function mount()
    {
        $this->query = '';
    }

    public function getResultsProperty()
    {
        if (! $this->query) return collect();

        return \App\Models\Product::query()
            ->where('name', 'like', "%{$this->query}%")
            ->orWhere('sku', 'like', "%{$this->query}%")
            ->orderBy('name')
            ->limit(10)
            ->get();
    }

    public function select($id)
    {
        $this->emitUp('productSelected', (int) $id);
        $this->query = '';
    }

    public function render()
    {
        return view('livewire.product-selector', [
            'results' => $this->results,
        ]);
    }
}
