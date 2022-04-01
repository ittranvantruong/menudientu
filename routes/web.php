<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RealtimeController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('goi-nhan-vien', [RealtimeController::class, 'callEmployee']);
Route::get('/', [HomeController::class, 'index'])->name('index.customer');
Route::get('cart', [HomeController::class, 'cart'])->name('cart.customer');
