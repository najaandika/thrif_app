<?php

namespace Tests\Feature\Auth;

use Livewire\Volt\Volt;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\get;

test('registration screen can be rendered', function () {
    $response = get('/register');

    $response
        ->assertOk()
        ->assertSeeVolt('pages.auth.register');
});

test('new users can register', function () {
    $component = Volt::test('pages.auth.register')
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'password')
        ->set('password_confirmation', 'password');

    $component->call('register');

    $component->assertRedirect(route('login', absolute: false));

    $this->assertGuest();
});
