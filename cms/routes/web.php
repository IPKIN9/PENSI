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

Route::get('/', 'MyAuth\AuthController@index')->name('login');
Route::prefix('auth/')->group(function () {
    Route::get('admin/regist', 'MyAuth\AuthController@register')->name('Auth.Regist');
    Route::post('admin/add', 'MyAuth\AuthController@store')->name('auth.store');
    Route::post('admin/check', 'MyAuth\AuthController@authcheck')->name('auth.check');
    Route::get('admin/logout', 'MyAuth\AuthController@logout')->name('logout');
});
Route::prefix('dashboard/')->group(function () {
    Route::get('home', 'Landing\DsController@index')->name('dashboard.index');
});
