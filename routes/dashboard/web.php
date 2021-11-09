<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function() {
        Route::get('/index', 'DashboardController@index')->name('index');
        Route::resource('users', 'UserController')->except('show');
    });//end of dashboard routes
});
