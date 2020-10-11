<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], 
    function(){ //middleware(['auth'])->
        Route::prefix('dashboard')->name('dashboard.')->group(function(){

            Route::get('/index', 'DashboardController@index')->name('index');
            Route::get('/', 'DashboardController@index')->name('dashboard.index');

            //category route
            Route::resource('categories', 'CategoryController')->except(['show']);

            //Products route
            Route::resource('products', 'ProductController')->except(['show']);

            //Client route
            Route::resource('clients', 'ClientController')->except(['show']);
            Route::resource('clients.orders', 'Client\OrderController')->except(['show']);

            //user route
            Route::resource('users', 'UserController')->except(['show']);

        }); //end dashboard

    });
