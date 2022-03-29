<?php

use Illuminate\Support\Facades\Route;
use App\Admin\Http\Controllers\AdminController;
use App\Admin\Http\Controllers\AdminHomeController;
use App\Admin\Http\Controllers\CategoryController;
use App\Admin\Http\Controllers\ProductController;
use App\Admin\Http\Controllers\OrderController;
use App\Admin\Http\Controllers\UserController;

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

Route::get('dang-nhap', [AdminController::class, 'login'])->name('admin.login');

Route::post('dang-nhap', [AdminController::class, 'postLogin'])->name('post.login');

Route::group(['middleware' => ['admin']], function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.index');

    //danh mục
    Route::prefix('danh-muc')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index.category');
        Route::post('/', [CategoryController::class, 'store'])->name('store.category');
        Route::get('/sua/{category:id}', [CategoryController::class, 'edit'])->name('edit.category');
        Route::put('/sua', [CategoryController::class, 'update'])->name('update.category');
        Route::delete('/xoa/{category:id}', [CategoryController::class, 'delete'])->name('delete.category');
        Route::post('/thay-doi-nhieu', [CategoryController::class, 'multiple'])->name('multiple.category');
    });

    // sản phẩm
    Route::prefix('san-pham')->group(function () {

        Route::get('/them', [ProductController::class, 'create'])->name('create.product');
        Route::get('/sua/{product:id}', [ProductController::class, 'edit'])->name('edit.product');

        Route::post('/them', [ProductController::class, 'store'])->name('store.product');
        Route::put('/sua', [ProductController::class, 'update'])->name('update.product');
        Route::get('/', [ProductController::class, 'index'])->name('index.product');
        Route::delete('/xoa/{product:id}', [ProductController::class, 'delete'])->name('delete.product');
        Route::post('/thay-doi-nhieu', [ProductController::class, 'multiple'])->name('multiple.product');
    });

    Route::prefix('don-hang')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index.order');
        Route::get('get-product', [OrderController::class, 'getProduct'])->name('get.product.order');
        Route::get('/them', [OrderController::class, 'create'])->name('create.order');
        Route::post('/them', [OrderController::class, 'store'])->name('store.order');

        Route::get('/sua/{order:id}', [OrderController::class, 'edit'])->name('edit.order');
        Route::put('/sua', [OrderController::class, 'update'])->name('update.order');
        Route::patch('/sua-trang-thai/{order:id}/{status}', [OrderController::class, 'updateStatus'])->name('update.order.status');
        Route::delete('/xoa/{order:id}', [OrderController::class, 'delete'])->name('delete.order');


    });

    //thêm thành viên
    Route::prefix('thanh-vien')->group(function () {
        Route::get('them', [UserController::class, 'create'])->name('create.user');
        Route::get('sua/{user:id}', [UserController::class, 'edit'])->name('edit.user');
        Route::get('/', [UserController::class, 'index'])->name('index.user');

        Route::post('them', [UserController::class, 'store'])->name('store.user');
        Route::put('sua', [UserController::class, 'update'])->name('update.user');
        Route::delete('xoa/{user:id}', [UserController::class, 'delete'])->name('delete.user');
    });

    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
