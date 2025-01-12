<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthenticationController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Front\StripeWebhooksController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::any('tailwind', function () {
    return view('tailwind');
});
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/', [HomeController::class, 'index'])->middleware('auth:admin,web')->name('home');
    Route::get('/products', [ProductsController::class, 'index'])->middleware('auth')->name('products.index');
    Route::get('/products/{product:slug}', [ProductsController::class, 'show'])->middleware('auth')->name('products.show');


    // Route::resource('cart',  CartController::class)->middleware('auth');
    Route::resource('cart',  CartController::class);
    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store']);

    Route::get('oreders/{order}/pay', [PaymentController::class, 'create'])
        ->name('orders.payments.create');

    Route::post('oreders/{order}/stripe/payment-intent', [PaymentController::class, 'createStripePaymentIntent'])
        ->name('stripe.paymentIntent.create');

    Route::get('oreders/{order}/pay/stripe/callback', [PaymentController::class, 'confirmStripePayment'])
        ->name('stripe.return');
    
    Route::any('stripe/webhook',[StripeWebhooksController::class,'handle']);

    Route::get('stripe/test', [PaymentController::class, 'stripeTest'])
        ->name('stripe.test');





    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('auth/user/2fa', [TwoFactorAuthenticationController::class, 'index'])
        ->name('front.2fa');

    Route::any('/currency', [CurrencyConverterController::class, 'store'])
        ->name('currency.store');


    //view the settings
    Route::view('user/settings',  'front.setting.settings')->middleware('auth')
        ->name('user.settings');
}); // 'prefix' => LaravelLocalization::setLocale() end
// require __DIR__.'/auth.php';
// require __DIR__.'/web2.php';
require __DIR__ . '/dashboard.php';
// require __DIR__ . '/fortify.php';
