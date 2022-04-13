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
Route::apiResource('/posts', 'Posts\PostController')->middleware('auth'); 


Route::get('/message', 'TestController@getTest');
Route::get('/gamecode', 'Rookie\MessageController@getGameCodeList');
Route::get('/gamecode/{gametype}', 'Rookie\MessageController@getGameCodeByGameType');