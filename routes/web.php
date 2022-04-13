<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\PostController;

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
    return view('home');
    //  將預設網址改為 resource >> view >> 下面的home
    ///   初始預設為welcome
});

Route::get('/test', function () {
    return 'Hello jarek!!';
});



Route::get('/message', 'TestController@getTest');
Route::get('/gamecode', 'Rookie\MessageController@getGameCodeList');
Route::get('/gamecode/{gametype}', 'Rookie\MessageController@getGameCodeByGameType');


Auth::routes();
// 會員註冊登入的路徑

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('/posts',PostController::class)->middleware('auth'); 