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
    'prefix' => buildPrefix('customer'), 'as' => 'customer.'
    , 'middleware' => 'web'], function () {
    //Route::get('/home', 'ProductController@index')->name('index');

    Route::get('login', function () {
        return view('customers::pages.auth.login');
    })->name('login');

    Route::post('post.login', 'AuthController@login')
        ->name('post.login');

    Route::group(['middleware' => 'customer:customer'], function () {
        Route::get('logout', 'AuthController@logout')
            ->name('logout');

        Route::get('', 'ProductController@index')->name('product.index');

        Route::get('show/{id}', 'ProductController@show')->name('product.show');
    });

});