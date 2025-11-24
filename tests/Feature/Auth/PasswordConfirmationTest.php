<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Livewire\Volt\Volt;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('confirm password screen can be rendered', function () {
    $user = User::factory()->create();

    actingAs($user);

    $response = get('/confirm-password');

    $response
        ->assertSeeVolt('pages.auth.confirm-password')
        ->assertStatus(200);
});

test('password can be confirmed', function () {
    $user = User::factory()->create();

    actingAs($user);

    $component = Volt::test('pages.auth.confirm-password')
        ->set('password', 'password');

    $component->call('confirmPassword');

    $component
        ->assertRedirect('/')
        ->assertHasNoErrors();
});

test('password is not confirmed with invalid password', function () {
    $user = User::factory()->create();

    actingAs($user);

    $component = Volt::test('pages.auth.confirm-password')
        ->set('password', 'wrong-password');

    $component->call('confirmPassword');

    $component
        ->assertNoRedirect()
        ->assertHasErrors('password');
});
