<?php

namespace App\Http\Controllers\Home;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
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

        return view('Home.index.lists', compact('banner_list', 'cate_top', 'brand_list'));
    }
}
