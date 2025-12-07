<?php

namespace App\Livewire\Profile;

use App\Models\User;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddressForm extends Component
{
    #[Validate('required|string|max:255')]
    public string $recipient_name = '';

    #[Validate('nullable|string|max:30')]
    public ?string $phone = '';

    #[Validate('required|string|max:500')]
    public string $address_line = '';

    public bool $hasAddress = false;
    public ?string $lastUpdatedHuman = null;

    public function mount(): void
    {
        $user = $this->user();

        // Get first address (since there's no user_id relationship)
        $address = CustomerAddress::first();

        if ($address) {
            $this->fill($address->only([
                'recipient_name',
                'phone',
                'address_line',
            ]));

            $this->hasAddress = true;
            $this->lastUpdatedHuman = optional($address->updated_at)->diffForHumans();
        } else {
            $this->recipient_name = $user->name ?? '';
        }
    }

    public function save(): void
    {
        $data = $this->validate();

        // Update or create first address
        $address = CustomerAddress::first();
        
        if ($address) {
            $address->update($data);
        } else {
            $address = CustomerAddress::create($data);
        }

        $this->hasAddress = true;
        $this->lastUpdatedHuman = optional($address->fresh())->updated_at?->diffForHumans();

        session()->flash('addressSaved', 'Alamat berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.profile.address-form');
    }

    private function user(): User
    {
        $user = Auth::user();

        abort_unless($user instanceof User, 403);

        return $user;
    }
}
