<?php

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
//, 'guestAuth' 前台商城用户登录中间键
Route::group(['middleware' => 'web'], function (){

    //首页
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/index', 'IndexController@index');

    Route::get('/login', 'AuthController@showLoginForm')->name('web.login');
    Route::post('/login', 'AuthController@login')->name('web.loginc');
    Route::get('/register', 'AuthController@showRegisterForm')->name('web.reg');
    Route::post('/register', 'AuthController@register')->name('web.register');
    Route::post('/yzm','AuthController@yzm')->name('web.yzm');

    //前台用户
//    Route::any('home/login', 'Auth\AuthController@login');
//    Route::get('home/logout', 'Auth\AuthController@logout');
//    Route::any('home/register', 'Auth\AuthController@register');

});