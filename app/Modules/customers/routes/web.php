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

$moduleName = basename(dirname(__DIR__, 1));

Route::group(['namespace' => buildNamespace($moduleName),
    'prefix' => buildPrefix('customer'), 'as' => 'customer.'], function () {
    //Route::get('/home', 'ProductController@index')->name('index');

    Route::get('home', function () {
        return view('customers::pages.auth.login');
    })->name('home');

    Route::post('login', 'AuthController@login')
        ->name('login');

    Route::middleware('customer')->resource('product', 'ProductController');

});
