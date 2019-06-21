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
    Route::get('/index', 'IndexController@index')->name('web.index');

    //登录注册
    Route::get('/login', 'AuthController@showLoginForm')->name('web.login');
    Route::post('/login', 'AuthController@login')->name('web.loginc');
    Route::get('/register', 'AuthController@showRegisterForm')->name('web.reg');
    Route::post('/register', 'AuthController@register')->name('web.register');
    Route::post('/yzm','AuthController@yzm')->name('web.yzm');

    //商品详情
    Route::get('/goodslist/{cat_id?}', 'GoodsController@index')->name('web.goodslist');
    Route::get('/goodsdetail/{id}', 'GoodsController@detail')->name('web.goodsdetail');

    //分类
    Route::get('/category/{id?}', 'CategoryController@index')->name('web.categorylist');

    Route::group(['middleware' => 'guestAuth'], function(){
        //需要登录的路由
        Route::get('/logout', 'AuthController@logout')->name('web.logout');
    });

    //前台用户
//    Route::any('home/login', 'Auth\AuthController@login');
//    Route::get('home/logout', 'Auth\AuthController@logout');
//    Route::any('home/register', 'Auth\AuthController@register');

});