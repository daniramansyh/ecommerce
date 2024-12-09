<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::get('/', [ViewController::class, 'index'])->name('home');
Route::get('/detail/{id}',[ProductController::class, 'detail'])->name('detail');

Route::middleware('IsGuest')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/loginAuth', [UserController::class, 'loginAuth'])->name('loginAuth');
    Route::get('/sign-up', [UserController::class, 'register'])->name('signUp');
    Route::post('/regisAuth', [UserController::class, 'regisAuth'])->name('regisAuth');
    Route::get('/contact', [ViewController::class, 'contact'])->name('contact');
});

Route::middleware('IsLogin')->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::middleware('IsAdmin')->group(function () {
        Route::get('/dashboard', [ViewController::class, 'dashboard'])->name('dashboard');

        // mengelola data obat
        Route::prefix('/produk')->name('produk.')->group(function () {
            Route::get('/data', [ProductController::class, 'index'])->name('data');
            Route::get('/tambah', [ProductController::class, 'create'])->name('tambah');
            Route::post('/tambah/proses', [ProductController::class, 'store'])->name('tambah.proses');
            Route::get('/ubah/{id}', [ProductController::class, 'edit'])->name('ubah');
            Route::patch('/ubah/{id}/proses', [ProductController::class, 'update'])->name('ubah.proses');
            Route::delete('/hapus/{id}', [ProductController::class, 'destroy'])->name('hapus');
            Route::patch('/ubah/stok/{id}', [ProductController::class, 'updateStock'])->name('ubah.stock');
        });

        // mengelola akun
        Route::prefix('/kelola-akun')->name('kelola_akun.')->group(function () {
            Route::get('/data', [UserController::class, 'index'])->name('data');
            Route::get('/tambah', [UserController::class, 'create'])->name('tambah');
            Route::post('/tambah/proses', [UserController::class, 'store'])->name('tambah.proses');
            Route::get('/ubah/{id}', [UserController::class, 'edit'])->name('ubah');
            Route::patch('/ubah/{id}/proses', [UserController::class, 'update'])->name('ubah.proses');
            Route::delete('/hapus/{id}', [UserController::class, 'destroy'])->name('hapus');
        });
    });
    // mengelola order
    Route::prefix('/order')->name('order.')->group(function(){
        Route::get('/data', [OrderController::class, 'index'])->name('data');
        Route::get('/checkout/{id}', [OrderController::class, 'create'])->name('checkout');
        Route::get('/success/{id}', [OrderController::class, 'show'])->name('success');
        Route::post('/store', [OrderController::class, 'store'])->name('store');
        Route::put('/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/delete/{id}', [OrderController::class, 'destroy'])->name('delete');
        Route::get('/download/{id}', [OrderController::class, 'downloadPDF'])->name('download');
        Route::get('export-excel', [OrderController::class, 'exportExcel'])->name('export-excel');
    });
    // mengelola cart
    Route::prefix('/cart')->name('cart.')->group(function(){
        Route::get('/data', [CartController::class, 'index'])->name('data');
        Route::get('/', [CartController::class, 'show'])->name('show');
        Route::post('/add', [CartController::class, 'store'])->name('add');
        Route::delete('/delete/{id}', [CartController::class, 'destroy'])->name('destroy');

    });
});
