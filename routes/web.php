<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;

// Публичные страницы
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/catalog/{product}', [CatalogController::class, 'show'])->name('catalog.show');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/promos', [PromoController::class, 'index'])->name('promos');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::post('/contacts', [ContactController::class, 'send'])->name('contacts.send');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Корзина
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Авторизация
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Личный кабинет (только для авторизованных)
Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::get('/account/orders', [AccountController::class, 'orders'])->name('account.orders');
    Route::get('/account/profile', [AccountController::class, 'profile'])->name('account.profile');
    Route::post('/account/profile', [AccountController::class, 'updateProfile'])->name('account.profile.update');
    Route::get('/account/addresses', [AccountController::class, 'addresses'])->name('account.addresses');
});

// Админ-панель (только для is_admin)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews');
    Route::get('/articles', [AdminController::class, 'articles'])->name('articles');
    Route::get('/promos', [AdminController::class, 'promos'])->name('promos');
});
