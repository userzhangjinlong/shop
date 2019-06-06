<?php

namespace App\Http\Controllers\Home;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(Banner $banner, Category $category){

        //获取banner图片
        $banner_list = $banner->where('adver_id', 1)->select('banner_img')->get();

        return view('Home.index.lists', compact('banner_list'));
    }
}
