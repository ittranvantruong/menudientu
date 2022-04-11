<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RealtimeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\OrderController;

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

Route::get('dang-nhap', function(){
    return 'Please scan the QRCODE';
})->name('login');

Route::get('dang-nhap/{name}', [HomeController::class, 'userLogin'])->name('user.login');

Route::group(['middleware' => ['auth']], function () {

    Route::post('goi-nhan-vien', [RealtimeController::class, 'callEmployee'])->name('call.employee');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::prefix('gio-hang')->group(function () {
        Route::get('lay-thong-tin-mon-an/{product:id}', [ShoppingCartController::class, 'getProduct'])->name('get.product.cart');
        Route::get('/', [ShoppingCartController::class, 'index'])->name('index.cart');
        Route::post('/them', [ShoppingCartController::class, 'store'])->name('store.cart');
        Route::put('/sua', [ShoppingCartController::class, 'update'])->name('update.cart');
        Route::delete('/xoa/{cart}', [ShoppingCartController::class, 'delete'])->name('delete.cart');
    });
    Route::prefix('dat-mon')->group(function () {

        Route::post('/them', [OrderController::class, 'store'])->name('store.order.user');

    });
});
