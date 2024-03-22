<?php


use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\AboutController;
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

    Route::get('/about', [AboutController::class , 'index'])->name('about');
    Route::post('/about/update', [AboutController::class , 'update'])->name('about.update');


});


