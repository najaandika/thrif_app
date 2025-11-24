<?php

namespace App\View\Components\Profile;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * Halaman profil yang sedang aktif.
     */
    public string $active;

    public function __construct(string $active = 'account')
    {
        $this->active = $active;
    }

    public function render(): View
    {
        return view('components.profile.layout');
    }
}
