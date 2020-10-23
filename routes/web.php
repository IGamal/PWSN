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

//Routes for User.
Route::resource('users','App\Http\Controllers\UserController')->except(['index']);
Route::get('users/verify/{token}', [App\Http\Controllers\UserController::class, 'verify'])->name('verify');
Route::get('users/{user}/resend', [App\Http\Controllers\UserController::class, 'resend'])->name('resend');

//Routes for Category.
Route::resource('categories','App\Http\Controllers\CategoryController')->except(['show', 'create']);

//Routes for Article.
Route::resource('articles','App\Http\Controllers\ArticleController');

//Routes for Donation.
Route::resource('donations','App\Http\Controllers\DonationController');

//Routes for Job.
Route::resource('jobs','App\Http\Controllers\JobController');

//Routes for News.
Route::resource('news','App\Http\Controllers\NewsController');

//Routes for Education.
Route::resource('educations','App\Http\Controllers\EducationController');
Route::get('education/videos', [App\Http\Controllers\EducationController::class, 'videos'])->name('videos');
Route::get('education/books', [App\Http\Controllers\EducationController::class, 'books'])->name('books');

