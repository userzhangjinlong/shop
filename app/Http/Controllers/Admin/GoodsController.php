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

    public function store(){

        $cate = (new Category())->tree();
        return view('Admin.Goods.store', compact('cate'));
    }
}
