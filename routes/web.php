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
Route::get('/', view('login'));
Route::get('/admin', view('admin'));

Route::middleware('throttle:60,1')->group(function () {
    Route::middleware(['user'])->post('/login', 'UserController@login');
});

Route::middleware(['admin'])->post('generateToken', 'AdminController@generateToken');
Route::middleware(['admin'])->post('revokeToken', 'AdminController@revokeToken');
Route::middleware(['admin'])->get('seeAllTokens', 'AdminController@seeAllTokens');

Route::get('validateToken', 'UserController@validateToken');
