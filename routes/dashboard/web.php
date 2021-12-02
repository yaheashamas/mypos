<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function() {
        //dashboard
        Route::get('/index', 'DashboardController@index')->name('index');

        //routes category
        Route::resource('categories', 'CategoryController')->except('show');

        //routes products
        Route::resource('products', 'ProductController')->except('show');

        //routes clients
        Route::resource('clients', 'ClientController')->except('show');
        Route::resource('client.orders', 'client\OrderController')->except('show');

        //routes users
        Route::resource('users', 'UserController')->except('show');

    });//end of dashboard routes
});
