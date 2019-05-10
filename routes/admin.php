<?php
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
Route::get('/login', 'AuthController@showLoginForm')->name('login');
Route::post('/login', 'AuthController@login');
Route::group(['middleware' => ['authAdmin']], function (){
    //首页
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/index', 'IndexController@index');
    //退出登录
    Route::any('/logout', 'AuthController@logout')->name('logout');
    //分类
    Route::match(['get', 'post'], '/cateAdd', 'CategoryController@cateAdd')->name('cateAdd');
    Route::get('/cateList', 'CategoryController@cateList')->name('cateList');
    Route::match(['get', 'post'], '/cateEdit/{id}', 'CategoryController@cateEdit')->name('admin.cateEdit');
    Route::get('/cateDel/{id}', 'CategoryController@cateDel')->name('admin.cateDel');
    Route::post('/cateSort', 'CategoryController@cateSort')->name('admin.cateSort');

    //商品
    Route::get('/goodsList', 'GoodsController@index')->name('admin.goodsList');
    Route::match(['get', 'post'], '/goodsAdd', 'GoodsController@store')->name('admin.goodsAdd');
});
