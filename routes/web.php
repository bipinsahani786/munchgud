<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BuildABoxController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShiprocketController;
use App\Http\Controllers\RecipeController;

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/category/{slug}', [ProductController::class, 'category'])->name('products.category');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{item}/qty', [CartController::class, 'updateQty'])->name('cart.update');
Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/{item}/move-to-wishlist', [CartController::class, 'moveToWishlist'])->name('cart.moveToWishlist');
Route::post('/cart/coupon', [CartController::class, 'applyCoupon'])->name('cart.coupon');
Route::delete('/cart/coupon', [CartController::class, 'removeCoupon'])->name('cart.coupon.remove');

// Checkout (auth required)
Route::middleware('auth')->group(function() {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/order-success/{orderNumber}', [CheckoutController::class, 'success'])->name('checkout.success');
});

// Payments
Route::post('/payment/razorpay/create', [PaymentController::class, 'createOrder'])->name('payment.create');
Route::post('/payment/razorpay/verify', [PaymentController::class, 'verify'])->name('payment.verify');
Route::post('/payment/webhook', [PaymentController::class, 'webhook'])->withoutMiddleware(['web', \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])->name('payment.webhook');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/otp/send', [AuthController::class, 'sendOtp'])->name('otp.send')->middleware('throttle:5,60');
Route::post('/otp/verify', [AuthController::class, 'verifyOtp'])->name('otp.verify');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

// Account (auth required)
Route::middleware('auth')->prefix('account')->name('account.')->group(function() {
    Route::get('/', [AccountController::class, 'index'])->name('index');
    Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
    Route::patch('/profile', [AccountController::class, 'updateProfile'])->name('profile.update');
    Route::get('/orders', [AccountController::class, 'orders'])->name('orders');
    Route::get('/orders/{order}', [AccountController::class, 'orderDetail'])->name('orders.show');
    Route::get('/orders/{order}/map', [AccountController::class, 'orderMap'])->name('orders.map');
    Route::get('/orders/{order}/invoice', [AccountController::class, 'downloadInvoice'])->name('orders.invoice');
    Route::get('/addresses', [AccountController::class, 'addresses'])->name('addresses');
    Route::post('/addresses', [AccountController::class, 'storeAddress'])->name('addresses.store');
    Route::patch('/addresses/{address}', [AccountController::class, 'updateAddress'])->name('addresses.update');
    Route::delete('/addresses/{address}', [AccountController::class, 'destroyAddress'])->name('addresses.destroy');
    Route::patch('/addresses/{address}/default', [AccountController::class, 'setDefaultAddress'])->name('addresses.default');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/{sku}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::post('/wishlist/{sku}/move-to-cart', [WishlistController::class, 'moveToCart'])->name('wishlist.moveToCart');
    
    // Support Tickets
    Route::get('/tickets', [SupportTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [SupportTicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [SupportTicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [SupportTicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/reply', [SupportTicketController::class, 'reply'])->name('tickets.reply');
});

// Static pages
Route::view('/story', 'storefront.story')->name('story');
Route::view('/health-benefits', 'storefront.health')->name('health');
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes');
Route::get('/recipes/submit', [RecipeController::class, 'create'])->name('recipes.create');
Route::post('/recipes/submit', [RecipeController::class, 'submit'])->name('recipes.submit');
Route::get('/recipes/{slug}', [RecipeController::class, 'show'])->name('recipes.show');
Route::view('/reviews', 'storefront.reviews')->name('reviews');
Route::view('/about', 'pages.about')->name('about');
Route::view('/faq', 'pages.faq')->name('faq');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/refund-policy', 'pages.refund')->name('refund');
Route::view('/shipping-policy', 'pages.shipping')->name('shipping');
Route::get('/build-a-box', [BuildABoxController::class, 'index'])->name('build-a-box');
Route::post('/build-a-box/add', [BuildABoxController::class, 'addToCart'])->name('build-a-box.add');

// Reviews
Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Pincode check
Route::get('/pincode-check', [ShiprocketController::class, 'checkPincode'])->name('pincode.check');

require __DIR__.'/admin.php';
