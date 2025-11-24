<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\from;
use function Pest\Laravel\post;

function createProduct(User $owner, array $overrides = []): Product
{
    return Product::create(array_merge([
        'user_id' => $owner->id,
        'name' => 'Vintage Jacket',
        'description' => 'Jaket klasik',
        'price' => 150000,
        'condition' => 'good',
        'category' => 'Outerwear',
        'stock' => 5,
        'image' => null,
        'is_available' => true,
    ], $overrides));
}

test('customer dapat membuat order dari landing page', function () {
    $admin = User::factory()->admin()->create();
    $customer = User::factory()->create();
    $product = createProduct($admin, ['stock' => 3]);

    actingAs($customer);

    $response = from(route('landing.products.checkout', $product))
        ->post(route('landing.products.order', $product), [
        'buyer_name' => 'Customer Satu',
        'buyer_contact' => '08123',
        'shipping_address' => 'Jl. Mawar No. 1',
        'quantity' => 2,
        'notes' => 'Tolong kirim cepat',
        ]);

    $response
        ->assertRedirect(route('landing.orders.history'))
        ->assertSessionHas('status');

    $order = Order::where('product_id', $product->id)->first();

    expect($order)->not->toBeNull();
    expect($order->buyer_name)->toBe('Customer Satu');
    expect($order->buyer_contact)->toBe('08123');
    expect($order->shipping_address)->toBe('Jl. Mawar No. 1');
    expect($product->fresh()->stock)->toBe(1);
});

test('admin tidak bisa membuat order publik', function () {
    $admin = User::factory()->admin()->create();
    $product = createProduct($admin);

    actingAs($admin);

    post(route('landing.products.order', $product), [
        'buyer_name' => 'Admin',
        'quantity' => 1,
    ])->assertForbidden();

    expect(Order::count())->toBe(0);
});

test('order publik gagal bila stok kurang', function () {
    $admin = User::factory()->admin()->create();
    $customer = User::factory()->create();
    $product = createProduct($admin, ['stock' => 1]);

    actingAs($customer);

    $response = from(route('landing.products.checkout', $product))
        ->post(route('landing.products.order', $product), [
        'buyer_name' => 'Customer Dua',
        'quantity' => 2,
        ]);

    $response
        ->assertRedirect(route('landing.products.checkout', $product))
        ->assertSessionHasErrorsIn('order', ['quantity']);

    expect(Order::count())->toBe(0);
    expect($product->fresh()->stock)->toBe(1);
});
