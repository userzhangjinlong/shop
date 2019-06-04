<?php

namespace App\Http\Controllers\Admin;

use App\Models\Adver;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index(Banner $banner, Request $request){

        //with 实现多表关联查询获取
        $list = $banner->with(['adver' => function ($query){
            $query->select('adver_name','id');
        }]);
        // 关键字过滤
        if($request->exists('keywords')){
            $keywords = $request->keywords;
            $list = $list->where('banner_name', 'like', '%'.$request->keywords.'%');
        }else{
            $keywords = '';
        }

        $list = $list->select('id', 'banner_name', 'created_at', 'adver_id')->paginate(20);

        return view('Admin.Banner.index', compact('list', 'keywords'));
    }

    public function store(Banner $banner, Request $request, $id = null){

        if ($request->isMethod('post')){
            $rule = [
                'banner_name'        =>      'required',
                'adver_id'           =>      'required',
            ];

            if (empty($request->id)){
                $rule['banner_img'] = 'required';
            }

            $message = [
                'banner_name.required'          =>  '广告图名称必填',
                'adver_id.required'             =>  '广告位必选',
                'banner_img.required'           =>  '广告图片必填'
            ];
            $validate = Validator::make($request->all(), $rule, $message);

            if (!$validate->passes()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            $floder = 'Uploads/Banner/'.date('Ymd');

            //缩略图上传
            if (!Storage::disk('public')->exists($floder)){
//                Storage::makeDirectory($floder);
                Storage::makeDirectory(base_path('public/'.$floder));
            }

            if($request->file('banner_img')){
                if ($request->file('banner_img')->isValid()) {
                    $extension = $request->file('banner_img')->getClientOriginalExtension();
                    $rule = ['jpg', 'png', 'gif', 'jpeg'];
                    if (!in_array($extension, $rule)) {
                        return back()->withErrors(['图片格式需要为jpg,png,gif格式!'])->withInput();
                    }
                    $fileName = time() . mt_rand(1, 999) . '.' . $extension;
                    $res = $request->file('banner_img')->move(base_path('public/'.$floder), $fileName);
                    if (!$res) {
                        return back()->withErrors(['广告图片上传失败！'])->withInput();
                    }
                }else{
                    return back()->withErrors([$request->file('banner_img')->getErrorMessage()])->withInput();
                }
                $banner_path = '/'.$floder.'/'.$fileName;

            }

            if ($request->exists('id')){
                //编辑
                $banner = $banner->find($id);
                foreach($request->all() as $k => $v){
                    if ($k != '_token'){
                        $banner->$k = $v;
                    }
                }
                if (!empty($banner_path)) $banner->thumb_img = $banner_path;

                $res = $banner->save();

                if ($res){
                    return view('Admin.Public.success')->with([
                        'message'=>'编辑成功！',
                        'url' =>url('/admin/bannerList'),
                        'jumpTime'=>2,
                        'urlname' => 'banner列表'
                    ]);
                }else{
                    return back()->withErrors(['banner编辑失败！'])->withInput();
                }
            }else{
                //新增
                $res = Banner::create([
//                    $request->all()  //另一种添加方式待测试
                    'banner_name'    =>  $request->banner_name,
                    'adver_id'       =>  intval($request->adver_id),
                    'banner_desc'    =>  $request->banner_desc ?: '',
                    'banner_img'      =>  $banner_path
                ]);
                if($res){
                    return view('Admin.Public.success')->with([
                        'message'=>'新增成功！',
                        'url' =>url('/admin/bannerList'),
                        'jumpTime'=>2,
                        'urlname' => 'banner列表'
                    ]);
                }else{
                    return back()->withErrors(['banner新增失败！'])->withInput();
                }
            }



        }

        if(!empty($id)){
            $banner_info = $banner->find($id);
        }else{
            $banner_info = [];
        }

        $adver_list = (new Adver())->get(['id', 'adver_name']);

        return view('Admin.Banner.store', compact('banner_info', 'id', 'adver_list'));

    }

    /**
     * @param Banner $banner
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function delete(Banner $banner, $id){
        $info = $banner->find($id);

        $res = $info->delete();

        if ($res){
            return view('Admin.Public.success')->with([
                'message'=>'删除成功！',
                'url' =>url('/admin/bannerList'),
                'jumpTime'=>2,
                'urlname' => 'banner列表'
            ]);
        }else{
            return back()->withErrors(['删除失败！'])->withInput();
        }
    }

}
