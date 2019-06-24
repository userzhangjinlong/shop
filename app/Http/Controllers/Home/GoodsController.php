<?php

namespace App\Http\Controllers\Home;

use App\Models\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function index(Request $request, $cate_id = null){
        $goods = new Goods();

        if (!empty($cate_id)){
            $goods = $goods->where('cate_id', $cate_id);
        }

        if (!empty($request->sort)){
            if ($request->sort == 2){
                $goods = $goods->orderby('present_price', 'asc');
            }elseif($request->sort == 1){
                $goods = $goods->orderby('sale_num', 'asc');
            }elseif($request->sort == 3){
                $goods = $goods->orderby('present_price', 'desc');
            }elseif($request->sort == 4){
                $goods = $goods->orderby('sale_num', 'desc');
            }
        }else{
            $goods = $goods->orderby('created_at', 'desc');
        }

        $list = $goods->paginate(20);

        return view('Home.Goods.index', compact('list'));
    }
}
