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
Route::group(['middleware' => ['auth']], function () {
    Route::get('/posts', 'Posts\PostController@index')->name('posts.index');
    Route::post('/posts', 'Posts\PostController@store')->name('posts.store');
    Route::get('/posts/{post}', 'Posts\PostController@show')->name('posts.show');
    Route::put('/posts/{post}', 'Posts\PostController@update')->name('posts.update')->middleware('userEdit');
    Route::delete('/posts/{post}', 'Posts\PostController@destroy')->name('posts.destroy')->middleware('adminCheck');
});

/*會員系統*/
Route::group(['middleware' => ['auth','adminCheck']], function () {
    Route::get('/users', 'Users\UserController@index')->name('users.index');
    Route::put('/users/{user}', 'Users\UserController@update')->name('users.update');
    Route::delete('/users/{user}', 'Users\UserController@destroy')->name('users.destroy');
    Route::post('/users/search', 'Users\UserController@search')->name('users.search');
});

