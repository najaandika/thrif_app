<?php

// Quick sanitizer: if someone opens a URL with sensitive query params (email/password),
// redirect to the same URL without those params to avoid leaking credentials in logs/browser.
if ((isset($_GET['email']) && $_GET['email'] !== '') || (isset($_GET['password']) && $_GET['password'] !== '')) {
    $q = $_GET;
    unset($q['email'], $q['password']);
    $base = (isset($_SERVER['REQUEST_URI']) ? strtok($_SERVER['REQUEST_URI'], '?') : $_SERVER['REQUEST_URI'] ?? '/');
    $clean = $base . (count($q) ? ('?' . http_build_query($q)) : '');
    // Use relative redirect to stay on same host
    header('Location: ' . $clean, true, 302);
    exit;
}

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Services\MidtransService;

// Controllers
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LandingCartController;
use App\Http\Controllers\LandingProductCheckoutController;
use App\Http\Controllers\LandingProductOrderController;
use App\Http\Controllers\LandingProductActionController;
use App\Http\Controllers\CustomerOrderHistoryController;
use App\Http\Controllers\OrderExportController;
use App\Http\Controllers\TransactionExportController;

// Livewire (alias sesuai kebutuhan)
use App\Livewire\Dashboard;
use App\Livewire\Products\Index as ProductsIndex;
use App\Livewire\Products\Create as ProductsCreate;
use App\Livewire\Products\Edit as ProductsEdit;
// ShippingIndex import dihapus
use App\Livewire\Orders\Index as OrdersIndex;
use App\Livewire\LandingProducts\Index as LandingProductsIndex;

// --------------------------------------------------
// Public routes
// --------------------------------------------------
Route::get('/', LandingController::class)->name('landing.home');
Route::get('/landing/products', LandingProductsIndex::class)->name('landing.products.index');

Route::get('/landing/products/{product}', App\Http\Controllers\LandingProductDetailController::class)->name('landing.products.show');

Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

// Midtrans Sandbox test route
Route::get('/midtrans-test', function (MidtransService $midtrans) {
    $params = [
        'transaction_details' => [
            'order_id'     => 'TEST-' . time(),
            'gross_amount' => 10000,
        ],
        'customer_details' => [
            'first_name' => 'Tester',
            'email'      => 'tester@example.com',
        ],
    ];

    $snapToken = $midtrans->createSnapToken($params);

    return view('midtrans.test', compact('snapToken'));
})->name('midtrans.test');

// --------------------------------------------------
// Authenticated (general) routes
// --------------------------------------------------
Route::middleware(['auth'])->group(function () {
    Route::view('/profile', 'profile.account')->name('profile');
    Route::view('/profile/info', 'profile.info')->name('profile.info');
    Route::view('/profile/alamat', 'profile.address')->name('profile.address');
        Route::view('/profile/wishlist', 'profile.wishlist')->name('profile.wishlist');
    Route::view('/profile/keluar', 'profile.logout')->name('profile.logout');

    Route::post('/logout', function (Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    })->name('logout');
});

// --------------------------------------------------
// Customer-only routes
// (must be authenticated, verified and have role:customer)
// --------------------------------------------------
Route::middleware(['auth', 'verified', 'role:customer'])->group(function () {
    Route::view('/profile/riwayat', 'profile.history')->name('profile.history');

    Route::get('/landing/products/{product}/checkout', LandingProductCheckoutController::class)
        ->name('landing.products.checkout');

    Route::post('/landing/products/action', [LandingProductActionController::class, 'handle'])
        ->name('landing.products.action');

    Route::post('/landing/products/{product}/order', LandingProductOrderController::class)
        ->name('landing.products.order');

    Route::get('/landing/orders/history', CustomerOrderHistoryController::class)
        ->name('landing.orders.history');

    Route::post('/landing/cart', [LandingCartController::class, 'store'])
        ->name('landing.cart.store');

    Route::get('/landing/cart', \App\Livewire\Landing\Cart::class)
        ->name('landing.cart.index');

    Route::post('/landing/cart/finalize', [LandingCartController::class, 'finalize'])
        ->name('landing.cart.finalize');
});

// --------------------------------------------------
// Admin-only routes
// (must be authenticated, verified and have role:admin)
// --------------------------------------------------
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/pos', \App\Livewire\Pos\Index::class)->name('pos.index');


    
    // Export Routes (Moved to top to avoid conflicts)
    Route::get('/admin/export/orders/excel', [OrderExportController::class, 'excel'])->name('orders.export.excel');
    Route::get('/admin/export/orders/pdf', [OrderExportController::class, 'pdf'])->name('orders.export.pdf');

    // Products (Livewire)
    Route::get('/products', ProductsIndex::class)->name('products.index');
    Route::get('/products/create', ProductsCreate::class)->name('products.create');
    Route::get('/products/{product}/edit', ProductsEdit::class)->name('products.edit');

    // Orders (Livewire)
    Route::get('/orders', OrdersIndex::class)->name('orders.index');
    Route::get('/promotions', \App\Livewire\Promotions\Index::class)->name('promotions.index');
    Route::get('/customers', \App\Livewire\Customers\Index::class)->name('customers.index');
    Route::get('/reports', \App\Livewire\Reports\Index::class)->name('reports.index');
    Route::get('/transactions', \App\Livewire\Transactions\Index::class)->name('transactions.index');

    // Settings & Categories (Livewire)

    Route::get('/categories', \App\Livewire\Categories\Index::class)->name('categories.index');
    Route::get('/categories/create', \App\Livewire\Categories\Create::class)->name('categories.create');
    Route::get('/categories/{category}/edit', \App\Livewire\Categories\Edit::class)->name('categories.edit');

    Route::get('/settings', \App\Livewire\Settings\Index::class)->name('settings.index');
});

// Google Login
use App\Http\Controllers\AuthGoogleController;
Route::get('/auth/google/redirect', [AuthGoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [AuthGoogleController::class, 'callback'])->name('google.callback');

// Midtrans Notification
Route::post('/midtrans/notification', [App\Http\Controllers\MidtransNotificationController::class, 'handle'])->name('midtrans.notification');

require __DIR__ . '/auth.php';

