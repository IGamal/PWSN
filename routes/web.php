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

Route::get('/', function () {return view('welcome');});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Routes for User
Route::resource('users','App\Http\Controllers\UserController');
Route::get('users/verify/{token}', [App\Http\Controllers\UserController::class, 'verify'])->name('verify');
Route::get('users/{user}/resend', [App\Http\Controllers\UserController::class, 'resend'])->name('resend');

//Routes for User

