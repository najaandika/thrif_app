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
    public $paymentMethod = 'all';
    public $showModal = false;
    public $selectedTransaction = null;
    
    protected $listeners = ['deleteTransaction' => 'delete'];

    public function updatingPaymentMethod(): void
    {
        // Reset pencarian saat metode pembayaran diubah
        $this->search = '';
    }

    public function getTransactionsProperty()
    {
        return Transaction::query()
            ->when($this->search, function ($q) {
                $q->where('id', 'like', "%{$this->search}%")
                  ->orWhere('payment_method', 'like', "%{$this->search}%")
                  ->orWhere('payment_status', 'like', "%{$this->search}%");
            })
            ->when($this->paymentMethod !== 'all', function ($q) {
                $q->where('payment_method', $this->paymentMethod);
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
