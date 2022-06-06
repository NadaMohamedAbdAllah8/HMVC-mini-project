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

// Route::get('/home-admin', 'Admins\Http\Controllers\CategoryController@index')
//     ->name('index');

Route::group(['namespace' => 'Admins\Http\Controllers',
    'prefix' => buildPrefix('admin')
    //config('adminRoute.prefix', config('mouduleRoutes.adminDefaultPrefix'))
    , 'as' => 'admin.'], function () {
    Route::get('/home',
        'CategoryController@index')
        ->name('index');
});