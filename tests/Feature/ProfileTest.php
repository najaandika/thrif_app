<?php

/** @var \Tests\TestCase $this */

use App\Livewire\Profile\AddressForm;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Livewire;
use Livewire\Volt\Volt;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('profile page is displayed', function () {
    $user = User::factory()->create();

    actingAs($user);

    $response = get('/profile');

    $response
        ->assertOk()
        ->assertSeeVolt('profile.update-profile-information-form')
        ->assertSeeVolt('profile.update-password-form')
        ->assertSeeVolt('profile.delete-user-form');
});

test('profile information can be updated', function () {
    $user = User::factory()->create();

    actingAs($user);

    $component = Volt::test('profile.update-profile-information-form')
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->call('updateProfileInformation');

    $component
        ->assertHasNoErrors()
        ->assertNoRedirect();

    $user->refresh();

    $this->assertSame('Test User', $user->name);
    $this->assertSame('test@example.com', $user->email);
    $this->assertNull($user->email_verified_at);
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = User::factory()->create();

    actingAs($user);

    $component = Volt::test('profile.update-profile-information-form')
        ->set('name', 'Test User')
        ->set('email', $user->email)
        ->call('updateProfileInformation');

    $component
        ->assertHasNoErrors()
        ->assertNoRedirect();

    $this->assertNotNull($user->refresh()->email_verified_at);
});

test('user can delete their account', function () {
    $user = User::factory()->create();

    actingAs($user);

    $component = Volt::test('profile.delete-user-form')
        ->set('password', 'password')
        ->call('deleteUser');

    $component
        ->assertHasNoErrors()
        ->assertRedirect('/');

    assertGuest();
    $this->assertNull($user->fresh());
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create();

    actingAs($user);

    $component = Volt::test('profile.delete-user-form')
        ->set('password', 'wrong-password')
        ->call('deleteUser');

    $component
        ->assertHasErrors('password')
        ->assertNoRedirect();

    $this->assertNotNull($user->fresh());
});

test('address form loads existing data', function () {
    $user = User::factory()->create();
    CustomerAddress::factory()->for($user)->state([
        'recipient_name' => 'Budi',
        'address_line' => 'Jl. Anggrek No. 8',
        'city' => 'Bandung',
        'province' => 'Jawa Barat',
        'postal_code' => '40123',
    ])->create();

    actingAs($user);

    Livewire::test(AddressForm::class)
        ->assertSet('recipient_name', 'Budi')
        ->assertSet('city', 'Bandung');
});

test('address form can be saved', function () {
    $user = User::factory()->create();

    actingAs($user);

    Livewire::test(AddressForm::class)
        ->set('recipient_name', 'Sari')
        ->set('phone', '08123456789')
        ->set('address_line', 'Jl. Kenanga No. 2')
        ->set('city', 'Jakarta')
        ->set('province', 'DKI Jakarta')
        ->set('postal_code', '10210')
        ->call('save')
        ->assertHasNoErrors();

    assertDatabaseHas('customer_addresses', [
        'user_id' => $user->id,
        'recipient_name' => 'Sari',
        'city' => 'Jakarta',
    ]);
});

test('checkout prefills saved address', function () {
    $seller = User::factory()->admin()->create();
    $product = Product::create([
        'user_id' => $seller->id,
        'name' => 'Tas Vintage',
        'description' => 'Tas cantik',
        'price' => 150000,
        'condition' => 'good',
        'category' => 'fashion',
        'stock' => 5,
        'is_available' => true,
    ]);

    $customer = User::factory()->create();
    CustomerAddress::factory()->for($customer)->state([
        'address_line' => 'Jl. Dahlia No. 3',
        'city' => 'Depok',
        'province' => 'Jawa Barat',
        'postal_code' => '16412',
    ])->create();

    actingAs($customer);

    get(route('landing.products.checkout', $product))
        ->assertOk()
        ->assertSee('Jl. Dahlia No. 3', escape: false)
        ->assertSee('Depok', escape: false);
});

test('order falls back to saved address when empty', function () {
    $seller = User::factory()->admin()->create();
    $product = Product::create([
        'user_id' => $seller->id,
        'name' => 'Sepatu Boots',
        'description' => 'Sepatu kulit',
        'price' => 250000,
        'condition' => 'good',
        'category' => 'footwear',
        'stock' => 3,
        'is_available' => true,
    ]);

    $customer = User::factory()->create();
    CustomerAddress::factory()->for($customer)->state([
        'address_line' => 'Jl. Melati No. 9',
        'city' => 'Semarang',
        'province' => 'Jawa Tengah',
        'postal_code' => '50123',
    ])->create();

    actingAs($customer);

    $response = post(route('landing.products.order', $product), [
        'buyer_name' => 'Andi',
        'quantity' => 1,
        'notes' => null,
    ], ['HTTP_REFERER' => route('landing.products.checkout', $product)]);

    $response->assertRedirect(route('landing.orders.history'));

    assertDatabaseHas('orders', [
        'customer_id' => $customer->id,
        'product_id' => $product->id,
        'shipping_address' => "Jl. Melati No. 9\nSemarang Jawa Tengah 50123",
    ]);
});
