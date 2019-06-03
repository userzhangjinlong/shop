<?php

namespace App\Http\Controllers\Admin;

use App\Models\Adver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdverController extends Controller
{
    /**
     * @param Adver $adver
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Adver $adver,Request $request){

        if ($request->exists('keywords')){
            $keywords = $request->keywords;
            $list = $adver->where('adver_name', 'like', '%'.$request->keywords.'%')->select('id', 'adver_name', 'created_at')->paginate(20);
        }else{
            $keywords = '';
            $list = $adver->select('id', 'adver_name', 'created_at')->paginate(20);
        }

        return view('Admin.Adver.index', compact('list', 'keywords'));
    }

    /**
     * @param Adver $adver
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(Adver $adver, Request $request, $id=null){

        if ($request->isMethod('post')){
            $rule = [
                'adver_name'        =>      'required'
            ];

            $message = [
                'adver_name.required'           =>  '品牌名称必填',
            ];

            $validate = Validator::make($request->all(), $rule, $message);
            if (!$validate->passes()) {
                return back()->withErrors($validate->errors())->withInput();

            }

            if($request->exists('id')){
                //编辑
                $adver = $adver->find($id);
                foreach($request->all() as $k => $v){
                    if ($k != '_token'){
                        $adver->$k = $v;
                    }
                }
                $res = $adver->save();

                if ($res){
                    return view('Admin.Public.success')->with([
                        'message'=>'编辑成功！',
                        'url' =>url('/admin/adverList'),
                        'jumpTime'=>2,
                        'urlname' => '广告列表'
                    ]);
                }else{
                    return back()->withErrors(['广告编辑失败！'])->withInput();
                }
            }else{
                //新增
                $res = Adver::create([
                    'adver_name'    =>  $request->adver_name,
                    'adver_desc'    =>  $request->adver_desc ?: ''
                ]);
                if($res){
                    return view('Admin.Public.success')->with([
                        'message'=>'新增成功！',
                        'url' =>url('/admin/adverList'),
                        'jumpTime'=>2,
                        'urlname' => '广告列表'
                    ]);
                }else{
                    return back()->withErrors(['广告新增失败！'])->withInput();
                }
            }

        }

        if(!empty($id)){
            $adver_info = $adver->find($id);
        }else{
            $adver_info = [];
        }


        return view('Admin.Adver.store', compact('adver_info','id'));
    }

    /**
     * @param Adver $adver
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function delete(Adver $adver, $id){
        $info = $adver->find($id);

        $res = $info->delete();

        if ($res){
            return view('Admin.Public.success')->with([
                'message'=>'删除成功！',
                'url' =>url('/admin/adverList'),
                'jumpTime'=>2,
                'urlname' => '广告列表'
            ]);
        }else{
            return back()->withErrors(['删除失败！'])->withInput();
        }
    }

}
