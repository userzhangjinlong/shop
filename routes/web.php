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

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'web'], function (){
//    Auth::routes();

    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/index', 'IndexController@index');

    //前台用户
//    Route::any('home/login', 'Auth\AuthController@login');
//    Route::get('home/logout', 'Auth\AuthController@logout');
//    Route::any('home/register', 'Auth\AuthController@register');

    Route::get('/home', 'HomeController@index')->name('home');
});