<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GameController::class, 'index'])->name('home');
Route::get('/jogos', [GameController::class, 'index'])->name('games.index');
Route::get('/jogos/{game:slug}', [GameController::class, 'show'])->name('games.show');
Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categorias/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::view('/contactos', 'contact')->name('contact');
Route::post('/contactos', [ContactController::class, 'send'])->middleware('throttle:5,1')->name('contact.send');
Route::get('/carrinho', [CartController::class, 'index'])->name('cart.index');
Route::patch('/carrinho', [CartController::class, 'update'])->name('cart.update');
Route::middleware('auth')->post('/carrinho/finalizar', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/carrinho/{game:slug}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/carrinho/{game:slug}', [CartController::class, 'remove'])->name('cart.remove');
Route::middleware('auth')->group(function () {
    Route::get('/compras', [CartController::class, 'purchases'])->name('purchases.index');
    Route::get('/compras/{purchase}', [CartController::class, 'purchase'])->name('purchases.show');
    Route::get('/favoritos', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favoritos/{game}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('gestao')->name('admin.')->group(function () {
    Route::get('/clientes', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/clientes/{client}/palavra-passe', [AdminUserController::class, 'editPassword'])->name('users.password.edit');
    Route::put('/clientes/{client}/palavra-passe', [AdminUserController::class, 'updatePassword'])->name('users.password.update');
    Route::resource('jogos', AdminGameController::class)->names('games');
    Route::resource('categorias', AdminCategoryController::class)->names('categories');
});

require __DIR__.'/auth.php';
