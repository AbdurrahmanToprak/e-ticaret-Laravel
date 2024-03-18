<?php


use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\PageHomeController;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => ['panelsetting', 'auth'] , 'prefix' => 'panel', 'as' => 'panel.'] , function () {

    Route::get('/', [DashboardController::class , 'index'])->name('index');
    Route::get('/slider', [SliderController::class , 'index'])->name('slider');
    Route::get('/slider/ekle', [SliderController::class , 'create'])->name('slider.create');
    Route::get('/slider/{id}/duzenle', [SliderController::class , 'edit'])->name('slider.edit');
    Route::post('/slider/kaydet', [SliderController::class , 'store'])->name('slider.store');
    Route::put('/slider/{id}/guncelle', [SliderController::class , 'update'])->name('slider.update');
    Route::delete('/slider/{id}/sil', [SliderController::class , 'destroy'])->name('slider.destroy');


});


