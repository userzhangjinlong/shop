<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use DemeterChain\C;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    /**
     * @分类新增
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function cateAdd(Category $category, Request $request, $id = null){

        if($request->isMethod('post')){
            $this->validate($request, [
                'name'      =>      'required|max:10'
            ]);
            $floder = 'Uploads/Cateicon/'.date('Ymd');
            if (empty($request->id)){
                //新增
                if($request->hasFile('cateicon')){
                    if ($request->file('cateicon')->isValid()){
                        if (!Storage::disk('public')->exists($floder)){
                            Storage::makeDirectory($floder);
                        }
                        $extension = $request->file('cateicon')->getClientOriginalExtension();
                        $fileName = time() . mt_rand(1, 999) . '.'. $extension;
                        $res = $request->file('cateicon')->move($floder,$fileName);
                        if ($res) $cateicon_path = $floder.'/'.$fileName;
                    }else{
                        return $request->file('cateicon')->getError();
                    }

                }else{
                    $cateicon_path = '';
                }
                $cate = Category::create([
                    'name'          =>  $request->name,
                    'pid'           =>  $request->pid,
                    'description'   =>  $request->description ?: '',
                    'cateicon'      =>  $cateicon_path
                ]);


                if ($cate){
                    return response()
                        ->view('Admin.Public.success', 200)
                        ->header('Content-Type', 'text/plain');
                }else{
                    return back()->withInput();
                }


            }else{
                //修改
            }

        }

        $cateList = $category->tree();
        return view('Admin.Cate.add', compact('id', 'cateList'));
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cateList(Category $category){
        $cateList = $category->tree();
        return view('Admin.Cate.list', compact('cateList'));
    }


    public function cateEdit(Category $category, Request $request, $id){

        if ($request->isMethod('post')){

        }
        $cate = $category->find($id);
        $cateList = $category->tree();
        return view('Admin.Cate.edit', compact('cate','id', 'cateList'));
    }
}
