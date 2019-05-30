<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
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
                            Storage::makeDirectory($floder, 0775, true);
                        }
                        $extension = $request->file('cateicon')->getClientOriginalExtension();
                        $fileName = time() . mt_rand(1, 999) . '.'. $extension;
                        $res = $request->file('cateicon')->move(base_path('public/'.$floder),$fileName);
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
                    return view('Admin.Public.success')->with([
                        'message'=>'删除成功！',
                        'url' =>url('/admin/cateList'),
                        'jumpTime'=>2,
                        'urlname' => '分类列表'
                    ]);
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


    /**
     * @param Category $category
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function cateEdit(Category $category, Request $request, $id){

        if ($request->isMethod('post')){
            $this->validate($request, [
                'name'      =>      'required|max:10'
            ]);
            $cate = $category->getOneCate($id);
            $floder = 'Uploads/Cateicon/'.date('Ymd');
            if($request->hasFile('cateicon')){
                if ($request->file('cateicon')->isValid()){
                    if (!Storage::disk('public')->exists($floder)){
                        Storage::makeDirectory($floder);
                    }
                    $extension = $request->file('cateicon')->getClientOriginalExtension();
                    $fileName = time() . mt_rand(1, 999) . '.'. $extension;
                    $res = $request->file('cateicon')->move($floder,$fileName);
                    if ($res) $cate->cateicon = $floder.'/'.$fileName;
                }else{
                    return $request->file('cateicon')->getError();
                }

            }

            $cate->name = $request->name;
            $cate->pid = $request->pid;
            $cate->description = $request->description ?: '';

            $res = $cate->save();
            if($res){
                return view('Admin.Public.success')->with([
                    'message'=>'删除成功！',
                    'url' =>url('/admin/cateList'),
                    'jumpTime'=>2,
                    'urlname' => '分类列表'
                ]);
            }else{
                return back()->withInput();
            }

        }
        $cate = $category->getOneCate($id);
        $cateList = $category->tree();
        return view('Admin.Cate.edit', compact('cate','id', 'cateList'));
    }

    /**
     * @param Category $category
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function cateDel(Category $category, $id){
        $cate = $category->find($id);
        if(!empty($cate->cateicon)) unlink($cate->cateicon);
        $res = $cate->delete();
        if($res){
            return view('Admin.Public.success')->with([
                         'message'=>'删除成功！',
                         'url' =>url('/admin/cateList'),
                         'jumpTime'=>2,
                         'urlname' => '分类列表'
                     ]);
        }else{
            return back()->withInput();
        }
    }

    public function cateSort(Category $category, Request $request){
        $id = $request->id;
        if (empty($id)){
            return response()->json(['code' => 400, 'msg' => '分类信息不存在']);
        }

        $cate = $category->getOneCate($id);
        $cate->sort = $request->num;
        $res = $cate->save();

        if ($res){
            return response()->json(['code' => 200, 'msg' => '修改成功']);
        }else{
            return response()->json(['code' => 400, 'msg' => '修改失败']);
        }
    }

}
