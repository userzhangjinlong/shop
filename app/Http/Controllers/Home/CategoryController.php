<?php

namespace App\Http\Controllers\Home;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Category $category, $id = null){
        $cate = $category->where('pid', 0)->orderby('sort', 'asc')->orderby('id', 'desc')->first();
        if (empty($id)){
            $id = $cate->id;
        }
        $list = $category->sharedDataCate($id);
        return view('Home.Category.index', compact('id', 'list'));
    }
}
