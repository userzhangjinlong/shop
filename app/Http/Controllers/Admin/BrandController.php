<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * @param Brand $brand
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Brand $brand, Request $request){
        if ($request->exists('keywords')){
            $keywords = $request->keywords;
            $list = $brand->where('brand_name', 'like', '%'.$request->keywords.'%')->select('id', 'brand_name', 'brand_img', 'created_at')->paginate(20);
        }else{
            $keywords = '';
            $list = $brand->select('id', 'brand_name', 'brand_img', 'created_at')->paginate(20);
        }

        return view('Admin.Brand.index', compact('list', 'keywords'));
    }

    /**
     * @param Brand $brand
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(Brand $brand, Request $request, $id=null){

        if ($request->isMethod('post')){
            $rule = [
                'brand_name'        =>      'required'
            ];

            if (empty($request->id)){
                $rule['brand_img'] = 'required';
            }

            $message = [
                'brand_name.required'           =>  '品牌名称必填',
                'brand_img.required'            =>  '品牌图比选',
            ];

            $validate = Validator::make($request->all(), $rule, $message);
            if (!$validate->passes()) {
                return back()->withErrors($validate->errors())->withInput();

            }

            $floder = 'Uploads/Brand/'.date('Ymd');
            //缩略图上传
            if (!Storage::disk('public')->exists($floder)){
                Storage::makeDirectory($floder);
            }

            if($request->file('brand_img')){
                if ($request->file('brand_img')->isValid()) {
                    $extension = $request->file('brand_img')->getClientOriginalExtension();
                    $rule = ['jpg', 'png', 'gif', 'jpeg'];
                    if (!in_array($extension, $rule)) {
                        return back()->withErrors(['图片格式需要为jpg,png,gif格式!'])->withInput();
                    }
                    $fileName = time() . mt_rand(1, 999) . '.' . $extension;
                    $res = $request->file('brand_img')->move(base_path('public/'.$floder), $fileName);
                    if (!$res) {
                        return back()->withErrors(['缩略图片上传失败！'])->withInput();
                    }
                }else{
                    return back()->withErrors([$request->file('brand_img')->getError()])->withInput();
                }

                $brand_path = '/'.$floder.'/'.$fileName;
            }
            if ($request->exists('id')){
                //编辑
                $brand = $brand->find($id);
                foreach($request->all() as $k => $v){
                    if ($k != '_token'){
                        $brand->$k = $v;
                    }
                }
                if (!empty($brand_path)) $brand->brand_img = $brand_path;
                $res = $brand->save();

                if ($res){
                    return view('Admin.Public.success')->with([
                        'message'=>'编辑成功！',
                        'url' =>url('/admin/brandList'),
                        'jumpTime'=>2,
                        'urlname' => '品牌列表'
                    ]);
                }else{
                    return back()->withErrors(['品牌编辑失败！'])->withInput();
                }
            }else{
                //新增
                $res = Brand::create([
                    'brand_name'    =>  $request->brand_name,
                    'brand_desc'    =>  $request->brand_desc ?: '',
                    'brand_img'     =>  $brand_path
                ]);
                if($res){
                    return view('Admin.Public.success')->with([
                        'message'=>'新增成功！',
                        'url' =>url('/admin/brandList'),
                        'jumpTime'=>2,
                        'urlname' => '品牌列表'
                    ]);
                }else{
                    return back()->withErrors(['品牌新增失败！'])->withInput();
                }
            }

        }

        if(!empty($request->id)){
            $brand_info = $brand->find($id);
        }else{
            $brand_info = [];
        }
        return view('Admin.Brand.store', compact( 'brand_info', 'id'));
    }


    public function delete(Brand $brand, $id){
        $info = $brand->find($id);

        $res = $info->delete();

        if ($res){
            return view('Admin.Public.success')->with([
                'message'=>'删除成功！',
                'url' =>url('/admin/brandList'),
                'jumpTime'=>2,
                'urlname' => '品牌列表'
            ]);
        }else{
            return back()->withErrors(['删除失败！'])->withInput();
        }
    }

}
