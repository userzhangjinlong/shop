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

            }else{
                //修改
            }

        }

        $cate = (new Category())->tree();
        return view('Admin.Goods.store', compact('cate'));
    }
}
