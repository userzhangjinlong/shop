<?php

namespace App\Http\Controllers\Admin;

use App\Models\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
    public function upload(Goods $goods, Request $request, $path = null){
        $goods->validatorGoodsStore($request->all());

        if($request->file('thumb_img')){

        }else{

        }

        if($request->file('carousel_img')){

        }else{

        }

        $res = Goods::created([
            'goods_name'    =>  $request->goods_name,
            'cate_id'       =>  $request->cate_id,
            'desc'          =>  $request->desc,
            'tags'          =>  $request->tags,
            'original_price'=>  $request->original_price,
            'present_price' =>  $request->present_price,
            'thumb_img'     =>  $thumb_img,
            'carousel_img'  =>  $carousel_img,
            'stock'         =>  $request->stock,
            'post_free'     =>  $request->post_free,
            'postage'       =>  $request->postage,
            'full_price'    =>  $request->full_price,
            'ensure'        =>  $request->ensure,
            'goods_detail'  =>  $request->goods_detail
        ]);

        if($res){
            return view('Admin.Public.success')->with([
                'message'=>'新增成功！',
                'url' =>url('/admin/goodsList'),
                'jumpTime'=>2,
                'urlname' => '商品列表'
            ]);
        }else{
            return back()->withInput();
        }

        var_dump($path);
        var_dump($request->file('upload'));
//        var_dump('test');
    }
}
