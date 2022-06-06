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

Route::group(['namespace' => 'Suppliers\Http\Controllers',
    'prefix' => buildPrefix('supplier')
    //config('supplierRoute.prefix', config('mouduleRoutes.supplierDefaultPrefix'))
    , 'as' => 'supplier.'], function () {
    Route::get('/home', 'ProductController@index')
        ->name('index');
});