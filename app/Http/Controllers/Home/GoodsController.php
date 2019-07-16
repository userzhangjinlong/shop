<?php

namespace App\Http\Controllers\Home;

use App\Models\CateSearchProperty;
use App\Models\CateSearchPropertyVal;
use App\Models\Goods;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function index(Request $request, $cate_id, $sort = '', $order = ''){
        $goods = new Goods();

        $goods = $goods->where('cate_id', $cate_id);
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

        //分类属性列表
        $screen_list = CateSearchProperty::where('cate_id', $cate_id)->orderBy('sort', 'asc')->select('id', 'property_name')->get();

        return view('Home.Goods.index', compact('list', 'cate_id', 'order', 'screen_list'));
    }
}
