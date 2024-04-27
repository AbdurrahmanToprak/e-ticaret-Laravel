<?php


use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\SettingController;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => ['panelsetting', 'auth'] , 'prefix' => 'panel', 'as' => 'panel.'] , function () {

    Route::get('/', [DashboardController::class , 'index'])->name('index');
    Route::get('/slider', [SliderController::class , 'index'])->name('slider');
    Route::get('/slider/ekle', [SliderController::class , 'create'])->name('slider.create');
    Route::get('/slider/{id}/duzenle', [SliderController::class , 'edit'])->name('slider.edit');
    Route::post('/slider/kaydet', [SliderController::class , 'store'])->name('slider.store');
    Route::put('/slider/{id}/guncelle', [SliderController::class , 'update'])->name('slider.update');
    Route::delete('/slider/sil', [SliderController::class , 'destroy'])->name('slider.destroy');
    Route::post('/slider-status/update', [SliderController::class , 'status'])->name('slider.status');

    Route::resource('/category', CategoryController::class )->except('destroy');
    Route::delete('/category/sil', [CategoryController::class , 'destroy'])->name('category.destroy');
    Route::post('/category-status/update', [CategoryController::class , 'status'])->name('category.status');

    Route::resource('/product', ProductController::class )->except('destroy');
    Route::delete('/product/sil', [ProductController::class , 'destroy'])->name('product.destroy');
    Route::post('/product-status/update', [ProductController::class , 'status'])->name('product.status');

    Route::get('/about', [AboutController::class , 'index'])->name('about');
    Route::post('/about/update', [AboutController::class , 'update'])->name('about.update');

    Route::get('/contact', [ContactController::class , 'index'])->name('contact');
    Route::get('/contact/{id}/edit', [ContactController::class , 'edit'])->name('contact.edit');
    Route::put('/contact/{id}/update', [ContactController::class , 'update'])->name('contact.update');
    Route::delete('/contact/sil', [ContactController::class , 'destroy'])->name('contact.destroy');
    Route::post('/contact-status/update', [ContactController::class , 'status'])->name('contact.status');

    Route::get('/setting', [SettingController::class , 'index'])->name('setting');
    Route::get('/setting/create', [SettingController::class , 'create'])->name('setting.create');
    Route::post('/setting/store', [SettingController::class , 'store'])->name('setting.store');
    Route::get('/setting/{id}/edit', [SettingController::class , 'edit'])->name('setting.edit');
    Route::put('/setting/{id}/update', [SettingController::class , 'update'])->name('setting.update');
    Route::delete('/setting/destroy', [SettingController::class , 'destroy'])->name('setting.destroy');

    Route::get('/order', [OrderController::class , 'index'])->name('order');
    Route::get('/order/{id}/edit', [OrderController::class , 'edit'])->name('order.edit');
    Route::put('/order/{id}/update', [OrderController::class , 'update'])->name('order.update');
    Route::delete('/order/sil', [OrderController::class , 'destroy'])->name('order.destroy');
    Route::post('/order-status/update', [OrderController::class , 'status'])->name('order.status');


});


