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
        Route::get('/', 'App\Http\Controllers\Controller@toSsoLogin')->name('toSsoLogin');
        Route::get('/callback', 'App\Http\Controllers\Controller@ssoCallback')->name('ssoCallback');
        Route::get('/user', 'App\Http\Controllers\Controller@getSsoUser')->name('getSsoUser');
    });

    Route::group(['prefix' => 'github'], function () {
        Route::get('/', 'App\Http\Controllers\Controller@toGithub')->name('toGithub');
        Route::get('/callback', 'App\Http\Controllers\Controller@githubCallback')->name('githubCallback');
    });
});
