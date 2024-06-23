<?php
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Client\OrderController;
use App\Http\Controllers\Dashboard\OrdersController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


// routes/web.php

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::middleware('auth')->prefix('dashdoard')->name('dashboard.')->group(function () {

        Route::get('check/', [DashboardController::class, 'index'])->name('index');

         //userRoutes
        Route::resource('users',UserController::class)->except('show');


        //CategoryRoutes
        Route::resource('categories',CategoryController::class)->except('show');

        //ProductsRoutes
        Route::resource('products',ProductsController::class)->except('show');


        //ProductsRoutes
        Route::resource('clients',ClientController::class)->except('show');
        Route::resource('clients.orders',OrderController::class)->except('show');

        //orders routes
        Route::resource('orders',OrdersController::class)->except('show');

        Route::get('/orders/{order}/products',[OrdersController::class,'products'])->name('orders.products');


    });

});

/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/


// Route::middleware('auth')->prefix('dashdoard')->name('dashboard.')->group(function () {

//     Route::get('/check', [DashboardController::class, 'index'])->name('index');

//     //userRoutes
//     Route::resource('users',UserController::class)->except('show');

// });







