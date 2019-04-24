<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| ADMIN Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:admin')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::any('/login', 'AuthController@login')->name('login');
Route::any('/register', 'AuthController@register')->name('register');
Route::group(['middleware' => ['authAdmin']], function (){

    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/index', 'IndexController@index');

    //后台用户
    Route::get('/logout', 'AuthController@logout')->name('logout');
});
