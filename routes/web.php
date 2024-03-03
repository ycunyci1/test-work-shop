<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/products', [CartController::class, 'store']);
Route::delete('cart/products', [CartController::class, 'destroy']);
Route::patch('cart/products', [CartController::class, 'update']);

Route::resource('orders', OrderController::class)->middleware('auth:web');
Route::get('orders/{order}/success', [OrderController::class, 'success'])->name('orders.success');


Route::get('login', [AuthController::class, 'loginPage'])->name('login-page');
Route::post('login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:web')->name('logout');
Route::get('register', [AuthController::class, 'registerPage'])->name('register-page')->middleware('guest');
Route::post('register', [AuthController::class, 'register'])->name('register')->middleware('guest');
