<?php


use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\PageHomeController;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => ['panelsetting', 'auth'] , 'prefix' => 'panel', 'as' => 'panel.'] , function () {

    Route::get('/', [DashboardController::class , 'index'])->name('index');
    Route::get('/slider', [SliderController::class , 'index'])->name('slider.index');


});


