<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [CatalogController::class, 'catalog'])->name('catalog');
Route::get('/produk/{slug}', [CatalogController::class, 'show'])->name('product.detail');
Route::get('/kontak', [ContactController::class, 'contact'])->name('contact');

Route::post('/review', [HomeController::class, 'storeReview'])->name('review.store');
