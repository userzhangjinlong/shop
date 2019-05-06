<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function cateAdd(Request $request, $id = null){

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

                }
                $cate = Category::create([
                    'name'          =>  $request->name,
                    'pid'           =>  $request->pid,
                    'description'   =>  $request->description,
                    'cateicon'      =>  $cateicon_path ?: ''
                ]);


                if ($cate){
                    return response()
                        ->view('success', 200)
                        ->header('Content-Type', 'text/plain');
                }else{
                    return back()->withInput();
                }


            }else{
                //修改
            }

        }

        return view('Admin.Cate.add', compact('id'));
    }
}
