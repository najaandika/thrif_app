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

    #[Validate('required|string|max:500')]
    public string $address_line = '';

    #[Validate('nullable|string|max:120')]
    public ?string $city = '';

    #[Validate('nullable|string|max:120')]
    public ?string $province = '';

    #[Validate('nullable|string|max:20')]
    public ?string $postal_code = '';

    #[Validate('nullable|string|max:1000')]
    public ?string $notes = '';

    public bool $hasAddress = false;
    public ?string $lastUpdatedHuman = null;

    public function mount(): void
    {
        $user = $this->user();

        $address = $user->address;

        if ($address) {
            $this->fill($address->only([
                'recipient_name',
                'phone',
                'address_line',
                'city',
                'province',
                'postal_code',
                'notes',
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
        $user = $this->user();

        $address = $user->address()->updateOrCreate(
            ['user_id' => $user->getAuthIdentifier()],
            $data
        );

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
