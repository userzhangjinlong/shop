<?php

namespace App\Http\Controllers\Home;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(Banner $banner, Category $category, Brand $brand){
        //获取banner图片
        $banner_list = $banner->where('adver_id', 1)->select('banner_img', 'url')->get();

        //获取一级分类
        $cate_top = $category->where('pid', 0)->select('id', 'name', 'cateicon')->get();

        //获取品牌列表
        $brand_list = $brand->select('id', 'brand_img')->get();

        //获取商品新品前10个商品信息
        $new_goods = (new Goods())->take(5)->orderby('created_at', 'desc')->get();

        return view('Home.index.lists', compact('banner_list', 'cate_top', 'brand_list', 'new_goods'));
    }
}
