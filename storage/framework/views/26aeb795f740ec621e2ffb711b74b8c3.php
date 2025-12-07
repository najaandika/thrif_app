<?php

use Livewire\Volt\Actions;
use Livewire\Volt\CompileContext;
use Livewire\Volt\Contracts\Compiled;
use Livewire\Volt\Component;

new class extends Component implements Livewire\Volt\Contracts\FunctionalComponent
{
    public static CompileContext $__context;

    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

    public function mount()
    {
        (new Actions\InitializeState)->execute(static::$__context, $this, get_defined_vars());

        (new Actions\CallHook('mount'))->execute(static::$__context, $this, get_defined_vars());
    }

    public function logout(\App\Livewire\Actions\Logout $logout)
    {
        $arguments = [static::$__context, $this, func_get_args()];

        return (new Actions\CallMethod('logout'))->execute(...$arguments);
    }

    #[\Livewire\Attributes\Computed()]
    public function isAdmin()
    {
        $arguments = [static::$__context, $this, func_get_args()];

        return (new Actions\CallMethod('isAdmin'))->execute(...$arguments);
    }

    #[\Livewire\Attributes\Computed()]
    public function homeUrl()
    {
        $arguments = [static::$__context, $this, func_get_args()];

        return (new Actions\CallMethod('homeUrl'))->execute(...$arguments);
    }

    #[\Livewire\Attributes\Computed()]
    public function hideBrand()
    {
        $arguments = [static::$__context, $this, func_get_args()];

        return (new Actions\CallMethod('hideBrand'))->execute(...$arguments);
    }

    #[\Livewire\Attributes\Computed()]
    public function shopLogo()
    {
        $arguments = [static::$__context, $this, func_get_args()];

        return (new Actions\CallMethod('shopLogo'))->execute(...$arguments);
    }

    #[\Livewire\Attributes\Computed()]
    public function shopName()
    {
        $arguments = [static::$__context, $this, func_get_args()];

        return (new Actions\CallMethod('shopName'))->execute(...$arguments);
    }

};