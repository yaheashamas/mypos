<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function() {
        //dashboard
        Route::get('/index', 'DashboardController@index')->name('index');

        //category
        Route::resource('categories', 'CategoryController')->except('show');

        //products
        Route::resource('products', 'ProductController')->except('show');

        //clients
        Route::resource('clients', 'ClientController')->except('show');
        Route::resource('client.orders', 'client\OrderController')->except('show');


        //order
        Route::resource('orders', 'OrderController');
        Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');
        Route::get('/clients/{client}/orders/{order}','OrderController@edit')->name('clients.orders.edit');

        //users
        Route::resource('users', 'UserController')->except('show');

    });//end of dashboard routes
});
