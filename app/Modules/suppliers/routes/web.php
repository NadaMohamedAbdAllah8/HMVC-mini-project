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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home-supplier', 'Suppliers\Http\Controllers\ProductController@index')
//     ->name('index');

Route::group(['namespace' => 'Suppliers\Http\Controllers',
    'prefix' => 'supplier', 'as' => 'supplier.'], function () {
    Route::get('/home',
        'ProductController@index')
        ->name('index');
});