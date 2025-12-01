<?php

namespace App\Livewire\Profile;

use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithPagination;

class OrderHistory extends Component
{
    use WithPagination;

    public string $status = 'all';

    protected $queryString = [
        'status' => ['except' => 'all'],
    ];

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        abort_unless($user && method_exists($user, 'isCustomer') && $user->isCustomer(), 403);

        return view('livewire.profile.order-history', [
            'orders' => $this->orders($user->id, $user->email),
            'statusOptions' => $this->statusOptions(),
        ]);
    }

    protected function orders(int $userId, string $email): LengthAwarePaginator
    {
        $hasCustomerColumn = Schema::hasColumn('orders', 'customer_id');

        return Order::with('product')
            ->where(function ($query) use ($userId, $email, $hasCustomerColumn) {
                if ($hasCustomerColumn) {
                    $query->where('customer_id', $userId)
                        ->orWhere('buyer_contact', $email);
                } else {
                    $query->where('buyer_contact', $email)
                        ->orWhere('user_id', $userId);
                }
            })
            ->when($this->status !== 'all', fn ($query) => $query->where('status', $this->status))
            ->latest()
            ->paginate(5);
    }

    protected function statusOptions(): array
    {
        return [
            'all' => 'Semua',
            'pending' => 'Pending',
            'paid' => 'Paid',
        ];
    }
}
