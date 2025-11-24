<?php

namespace App\Livewire\Transactions;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

#[Layout('layouts.app')]
class Index extends Component
{
    public $search = '';

    public function getTransactionsProperty()
    {
        return Transaction::query()
            ->when($this->search, function ($q) {
                $q->where('id', 'like', "%{$this->search}%")
                  ->orWhere('payment_method', 'like', "%{$this->search}%")
                  ->orWhere('payment_status', 'like', "%{$this->search}%");
            })
            ->orderByDesc('id')
            ->with('items.product')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.transactions.index', [
            'transactions' => $this->transactions,
        ]);
    }
}
