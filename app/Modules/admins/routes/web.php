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

Route::group(['namespace' => 'Admins\Http\Controllers',
    'prefix' => buildPrefix('admin')
    , 'as' => 'admin.'], function () {
    Route::get('/home',
        'CategoryController@index')
        ->name('index');
});
