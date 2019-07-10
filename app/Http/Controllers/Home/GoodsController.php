<?php

namespace App\Http\Controllers\Home;

use App\Models\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function index(Request $request, $cate_id = '', $sort = '', $order = ''){
        $goods = new Goods();

        if (!empty($cate_id)){
            $goods = $goods->where('cate_id', $cate_id);
        }
        if (empty($order)) $order = 'asc';


        if (!empty($sort)){
            if ($sort == 'sales'){
                $goods = $goods->orderby('sale_num', $order);
            }elseif($sort == 'price'){
                $goods = $goods->orderby('present_price', $order);
            }
        }else{
            $goods = $goods->orderby('created_at', 'desc');
        }


        $list = $goods->paginate(20);


        if ($order == 'asc'){
            $order = 'desc';
        }else{
            $order = 'asc';
        }


        return view('Home.Goods.index', compact('list', 'cate_id', 'order'));
    }
}
