<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PageHomeController;
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

Route::group(['middleware' => 'sitesetting'] , function () {

    Route::get('/', [PageHomeController::class , 'index'])->name('home');
    Route::get('/urunler', [PageController::class , 'products'])->name('products');
    Route::get('/erkek/{slug?}', [PageController::class , 'products'])->name('erkekurunler');
    Route::get('/kadin/{slug?}', [PageController::class , 'products'])->name('kadinurunler');
    Route::get('/cocuk/{slug?}', [PageController::class , 'products'])->name('cocukurunler');
    Route::get('/indirimdeki-urunler', [PageController::class , 'productsOnSale'])->name('productsOnSale');
    Route::get('/hakkimizda', [PageController::class , 'about'])->name('about');
    Route::get('/iletisim', [PageController::class , 'contact'])->name('contact');
    Route::post('/iletisim/store', [AjaxController::class , 'contactStore'])->name('contactStore');
    Route::get('/urun/{slug}', [PageController::class , 'productDetail'])->name('productDetail');
    Route::get('/sepet', [CartController::class , 'index'])->name('cart');
    Route::post('/sepet/ekle', [CartController::class , 'add'])->name('cart_add');
    Route::post('/sepet/sil', [CartController::class , 'remove'])->name('cart_remove');
    Auth::routes();
    Route::get('/cikis', [AjaxController::class, 'logout'])->name('cikis');
});



