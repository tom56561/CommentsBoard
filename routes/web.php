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

Route::get('/test', function () {
    return 'Hello Rookie!!';
});

// Route::get('/{name}',function($name){
    // return view('a')->with('name',$name);
// });

Route::get('/message', 'TestController@getTest');
Route::get('/gamecode', 'Rookie\MessageController@getGameCodeList');
Route::get('/gamecode/{gametype}', 'Rookie\MessageController@getGameCodeByGameType');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
