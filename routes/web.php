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
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('homepage');
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

//Routes for Comments.
Route::resource('comments','App\Http\Controllers\CommentController')->except(['index', 'show', 'edit']);

//Routes for replies.
Route::resource('replies','App\Http\Controllers\ReplyController')->except(['index', 'show', 'edit']);

//Routes for Likes.
Route::post('/likeComment/{comment}', 'App\Http\Controllers\LikeController@likeComment');
Route::post('/dislikeComment/{comment}', 'App\Http\Controllers\LikeController@DislikeComment');
Route::post('/likeReply/{reply}', 'App\Http\Controllers\LikeController@likeReply');
Route::post('/dislikeReply/{reply}', 'App\Http\Controllers\LikeController@DislikeReply');

