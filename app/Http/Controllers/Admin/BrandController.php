<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index(){

        return view('Admin.Brand.index');
    }

    public function store(Brand $brand, Request $request, $id){

        if(!empty($request->id)){
            $brand_info = $brand->find($id);
//            brand_info->carousel_img = explode(',', $goods_info->carousel_img);
        }else{
            $brand_info = [];
        }
        return view('Admin.Goods.store', compact( 'brand_info', 'id'));
    }
}
