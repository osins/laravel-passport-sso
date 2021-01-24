<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/sso'], function () {
    Route::group(['prefix' => '/passport'], function () {
        Route::get('/', 'App\Http\Controllers\SsoController@redirect')->name('redirect');
        Route::get('/callback', 'App\Http\Controllers\SsoController@callback')->name('callback');
        Route::get('/user', 'App\Http\Controllers\SsoController@getUser')->name('getUser');
    });

    Route::group(['prefix' => 'github'], function () {
        Route::get('/', 'App\Http\Controllers\GithubController@redirect')->name('redirect');
        Route::get('/callback', 'App\Http\Controllers\GithubController@callback')->name('callback');
    });
});
