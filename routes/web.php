<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('admin.index');
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
});

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('product/{product}', [\App\Http\Controllers\HomeController::class, 'show'])->name('show');
Route::get('shop', [\App\Http\Controllers\HomeController::class, 'shop'])->name('shop');

Route::get('cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::get('cart/add/{product}', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
Route::get('cart/addwithparams/{product}', [\App\Http\Controllers\CartController::class, 'addToCartWithQuantity'])->name('cart.addWithQuantity');
Route::patch('cart/update/{productId}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::delete('cart/remove/{productId}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

Route::get('order/checkout', [\App\Http\Controllers\OrderController::class, 'checkout'])->name('order.checkout');
Route::post('order/place', [\App\Http\Controllers\OrderController::class, 'placeOrder'])->name('order.place');
