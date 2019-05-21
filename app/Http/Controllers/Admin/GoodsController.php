<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function index(Goods $goods, Request $request)
    {

        $list = $goods->paginate(20);

        return view('Admin.Goods.index', compact('list'));
    }

    public function store(Goods $goods, Request $request){

        if($request->isMethod('post')){
           $goods->validatorGoodsStore($request->all());

            $floder = 'Uploads/Goods/'.date('Ymd');
            if (empty($request->id)){
                //缩略图上传
//                if (!Storage::disk('public')->exists($floder)){
//                    Storage::makeDirectory($floder);
//                }
//                $extension = $request->file('thumb_img')->getClientOriginalExtension();
//                $fileName = time() . mt_rand(1, 999) . '.'. $extension;
//                $res = $request->file('Goods')->move($floder,$fileName);
//                if ($res) $thumb_path = $floder.'/'.$fileName;

                //多图上传处理
                dd($request->file('carousel_img'));

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

            }else{
                //修改
            }

        }

        $cate = (new Category())->tree();
        return view('Admin.Goods.store', compact('cate'));
    }
}
