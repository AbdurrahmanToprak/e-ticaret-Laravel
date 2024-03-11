<?php

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

Route::get('/', [PageHomeController::class , 'index'])->name('home');

Route::get('/about', [PageController::class , 'about'])->name('about');
Route::get('/contact', [PageController::class , 'contact'])->name('contact');
Route::get('/products', [PageController::class , 'products'])->name('products');
Route::get('/product/detail', [PageController::class , 'productDetail'])->name('productDetail');
