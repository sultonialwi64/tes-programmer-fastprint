<?php

use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

// Route untuk Fetch data API pertama kali
Route::get('/fetch-data', [ProdukController::class, 'fetchApi']);

// Route Halaman Utama
Route::get('/', [ProdukController::class, 'index']);

// Route CRUD lengkap (Create, Store, Edit, Update, Destroy)
Route::resource('produk', ProdukController::class);