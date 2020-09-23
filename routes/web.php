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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/reset-password/{token}', 'AuthController@resetPassword')->name('auth.passwords.reset');

Route::get('/reset-password/{token}', 'AuthController@resetPassword')->name('auth.passwords.update');

Route::post('/update-password', 'AuthController@updatePassword')->name('auth.passwords.update');

Route::get('/password-reset-success', 'AuthController@passwordResetSuccess')->name('auth.passwords.success');
