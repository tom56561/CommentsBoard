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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::middleware('auth:api')->group(function () {
//     Route::apiResource('posts', 'App\Http\Controllers\Api\PostController');
// });

/* RESTful api */
// Route::apiResource('/posts', 'Posts\PostController')->middleware('auth')->middleware('isAdmin');

/*留言板*/
Route::get('/posts', 'Posts\PostController@index')->name('posts.index')->middleware('auth');
Route::post('/posts', 'Posts\PostController@store')->name('posts.store')->middleware('auth');
Route::get('/posts/{post}', 'Posts\PostController@show')->name('posts.show')->middleware('auth');
Route::put('/posts/{post}', 'Posts\PostController@update')->name('posts.update')->middleware('auth')->middleware('userEdit');
Route::delete('/posts/{post}', 'Posts\PostController@destroy')->name('posts.destroy')->middleware('auth')->middleware('adminCheck');

/*會員系統*/
Route::get('/users', 'Users\UserController@index')->name('users.index')->middleware('auth')->middleware('adminCheck');
Route::put('/users/{user}', 'Users\UserController@update')->name('users.update')->middleware('auth')->middleware('adminCheck');
Route::delete('/users/{user}', 'Users\UserController@destroy')->name('users.destroy')->middleware('auth')->middleware('adminCheck');









Route::get('/message', 'TestController@getTest');
Route::get('/gamecode', 'Rookie\MessageController@getGameCodeList');
Route::get('/gamecode/{gametype}', 'Rookie\MessageController@getGameCodeByGameType');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
