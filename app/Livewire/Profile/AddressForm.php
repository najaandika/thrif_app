<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddressForm extends Component
{
    #[Validate('required|string|max:255')]
    public string $recipient_name = '';

    #[Validate('nullable|string|max:30')]
    public ?string $phone = '';

    #[Validate('required|string|max:1000')]
    public string $address_line = '';

    public bool $hasAddress = false;
    public ?string $lastUpdatedHuman = null;

    public function mount(): void
    {
        $user = $this->user();

        // Load directly from User model
        $this->recipient_name = $user->name ?? '';
        $this->phone = $user->phone ?? '';
        $this->address_line = $user->address ?? '';

        $this->hasAddress = !empty($user->address);
        $this->lastUpdatedHuman = optional($user->updated_at)->diffForHumans();
    }

    public function save(): void
    {
        $this->validate();

        $user = $this->user();

        $user->update([
            'name' => $this->recipient_name,
            'phone' => $this->phone,
            'address' => $this->address_line,
        ]);

        $this->hasAddress = true;
        // Since we updated the user, the updated_at touches
        $this->lastUpdatedHuman = optional($user->fresh())->updated_at?->diffForHumans();

        session()->flash('addressSaved', 'Alamat berhasil disimpan.');
        
        // Optional question: Should we dispatch 'profile-updated'? 
        // Yes, because we updated the name.
        $this->dispatch('profile-updated', name: $user->name);
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
