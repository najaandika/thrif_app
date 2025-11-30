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
    public $showModal = false;
    public $selectedTransaction = null;
    
    protected $listeners = ['deleteTransaction' => 'delete'];

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

    public function viewTransaction($id)
    {
        $this->selectedTransaction = Transaction::with('items.product')->find($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedTransaction = null;
    }

    public function delete($id)
    {
        $transaction = Transaction::find($id);
        
        if ($transaction) {
            $transaction->delete();
            session()->flash('message', 'Transaksi berhasil dihapus.');
        }
    }

    public function render()
    {
        return view('livewire.transactions.index', [
            'transactions' => $this->transactions,
        ]);
    }
}
