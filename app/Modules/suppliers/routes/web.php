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

Route::group(['namespace' => buildNamespace($moduleName), 'prefix' => buildPrefix('supplier')
    , 'as' => 'supplier.', 'middleware' => 'web'], function () {
    Route::get('login', function () {
        return view('suppliers::pages.auth.login');
    })->name('login');

    Route::post('post.login', 'AuthController@login')
        ->name('post.login');

    Route::middleware('supplier:supplier')->get('logout', 'AuthController@logout')
        ->name('logout');

    Route::middleware('supplier:supplier')->resource('product', 'ProductController');

});