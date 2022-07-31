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
Route::get('/', function () {return view('login');});
Route::get('/admin', function () {return view('admin');});

Route::middleware('throttle:60,1')->group(function () {
    Route::middleware(['App\Http\Middleware\user'])->post('/login', 'App\Http\Controllers\UserController@login');
});

Route::middleware(['App\Http\Middleware\admin'])->post('generateToken', 'App\Http\Controllers\AdminController@generateToken');
Route::middleware(['App\Http\Middleware\admin'])->post('revokeToken', 'App\Http\Controllers\AdminController@revokeToken');
Route::middleware(['App\Http\Middleware\admin'])->get('seeAllTokens', 'App\Http\Controllers\AdminController@seeAllTokens');

Route::post('validateToken', 'App\Http\Controllers\UserController@validateToken');
