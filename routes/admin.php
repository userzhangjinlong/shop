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

    //品牌
    Route::get('/brandList', 'BrandController@index')->name('admin.brandList');
    Route::match(['get', 'post'], '/brandAdd/{id?}', 'BrandController@store')->name('admin.brandAdd');
    Route::match(['get', 'post'], '/brandDel/{id}', 'BrandController@delete')->name('admin.brandDel');

    //商品
    Route::get('/goodsList', 'GoodsController@index')->name('admin.goodsList');
    Route::match(['get', 'post'], '/goodsAdd/{id?}', 'GoodsController@store')->name('admin.goodsAdd');
    Route::match(['get', 'post'], '/goodsDel/{id}', 'GoodsController@delete')->name('admin.goodsDel');
    Route::post('/goodSort', 'GoodsController@goodSort')->name('admin.goodSort');

    //商品属性
    Route::post('/goodsAttrDel', 'GoodsController@destoryAttr')->name('admin.delAttr');

    //商品sku管理
    Route::get('/goodsSkuList', 'GoodSkuController@index')->name('admin.goodsSkuList');
    Route::match(['get', 'post'], '/goodsSkuAdd/{id?}', 'GoodSkuController@store')->name('admin.goodsSkuAdd');

    //广告位管理
    Route::get('/adverList', 'AdverController@index')->name('admin.adverList');
    Route::match(['get', 'post'], '/adverAdd/{id?}', 'AdverController@store')->name('admin.adverAdd');
    Route::match(['get', 'post'], '/adverDel/{id}', 'AdverController@delete')->name('admin.adverDel');

    //banner管理
    Route::get('/bannerList', 'BannerController@index')->name('admin.bannerList');
    Route::match(['get', 'post'], '/bannerAdd/{id?}', 'BannerController@store')->name('admin.bannerAdd');
    Route::match(['get', 'post'], '/bannerDel/{id}', 'BannerController@delete')->name('admin.bannerDel');

    //ckedtior 编辑器图片上传
    Route::any('/uploaddditorimage/{path?}', 'PublicController@upload')->name('admin.uploaddditorimage');
});
