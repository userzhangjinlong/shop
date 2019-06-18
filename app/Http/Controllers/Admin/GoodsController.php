<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Goods;
use DemeterChain\C;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GoodsController extends Controller
{
    /**
     * @param Goods $goods
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Goods $goods, Request $request)
    {
        //with 实现多表关联查询获取
        $list = $goods->with(['category' => function ($query){
            $query->select('name','id');
        },'brand' => function($query_brand){
            $query_brand->select('id', 'brand_name');
        }]);
        // 关键字过滤
        if($keyword = $request->keyword ?? ''){
            $list = $list->where('goods_name', 'like', '%'.$request->keyword.'%');
        }


        $list = $list->select('id', 'goods_name', 'created_at', 'cate_id', 'brand_id', 'order')->paginate(20);
        return view('Admin.Goods.index', compact('list'));
    }

    /**
     * @param Goods $goods
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Goods $goods, Request $request, $id = null){

        if($request->isMethod('post')){

            $rule = [
                'goods_name'        =>      'required',
                'cate_id'           =>      'required',
                'original_price'    =>      'required',
                'present_price'     =>      'required',
                'stock'             =>      'required|integer',
//                'postage'           =>      'integer',
//                'full_price'        =>      'integer',
                'ensure'            =>      'required|string',
                'goods_detail'      =>      'required|string'
            ];

            if (empty($request->id)){
                $rule['thumb_img'] = 'required';
                $rule['carousel_img'] = 'required';
            }

            $message = [
                'goods_name.required'           =>  '商品名称必填',
                'cate_id.required'              =>  '分类名称必选',
                'original_price.required'       =>  '原价必填',
                'present_price.required'        =>  '售价必填',
                'thumb_img.required'            =>  '缩略图比选',
                'carousel_img.required'         =>  '轮播图必选',
                'stock.required'                =>  '库存必填',
                'ensure.required'               =>  '保障信息必填',
                'goods_detail.required'         =>  '商品详情必填',
//                'postage.integer'               =>  '邮费必须填写为整数'
            ];
            $validate = Validator::make($request->all(), $rule, $message);

            if (!$validate->passes()) {
                return back()->withErrors($validate->errors())->withInput();

            }
            $floder = 'Uploads/Goods/'.date('Ymd');

            //缩略图上传
            if (!Storage::disk('public')->exists($floder)){
                Storage::makeDirectory($floder);
            }

            if($request->file('thumb_img')){
                if ($request->file('thumb_img')->isValid()) {
                    $extension = $request->file('thumb_img')->getClientOriginalExtension();
                    $rule = ['jpg', 'png', 'gif', 'jpeg'];
                    if (!in_array($extension, $rule)) {
                        return back()->withErrors(['图片格式需要为jpg,png,gif格式!'])->withInput();
                    }
                    $fileName = time() . mt_rand(1, 999) . '.' . $extension;
                    $res = $request->file('thumb_img')->move(base_path('public/'.$floder), $fileName);
                    if (!$res) {
                        return back()->withErrors(['缩略图片上传失败！'])->withInput();
                    }
                }else{
                    return back()->withErrors([$request->file('thumb_img')->getError()])->withInput();
                }
                $thumb_path = '/'.$floder.'/'.$fileName;

            }
//            else{
//                return back()->withErrors(['商品缩略图片必须上传!'])->withInput();
//            }
            if($request->file('carousel_img')){
                $carousel_img = '';
                foreach($request->file('carousel_img') as $k => $v){
                    if($v->isValid()){
                        $extension = $v->getClientOriginalExtension();
                        $rule = ['jpg', 'png', 'gif', 'jpeg'];
                        if (!in_array($extension, $rule)) {
                            return back()->withErrors(['图片格式需要为jpg,png,gif格式!'])->withInput();
                        }
                        $fileName = time() . mt_rand(1, 999) . '.'. $extension;
                        $res = $v->move(base_path('public/'.$floder),$fileName);
                        if (!$res) {
                            return back()->withErrors(['详情图片上传失败！'])->withInput();
                        }
                        $carousel_img .= '/'.$floder.'/'.$fileName.',';
                    }else{
                        return back()->withErrors([$v->getError()])->withInput();
                    }

                }
            }
//            else{
//                return back()->withErrors(['详情图必须上传！'])->withInput();
//            }

            if (empty($request->id)){
                $res = Goods::create([
//                    $request->all()  //另一种添加方式待测试
                    'goods_name'    =>  $request->goods_name,
                    'cate_id'       =>  intval($request->cate_id),
                    'brand_id'       =>  intval($request->brand_id),
                    'desc'          =>  $request->desc,
                    'tags'          =>  $request->tags,
                    'original_price'=>  floatval($request->original_price),
                    'present_price' =>  floatval($request->present_price),
                    'thumb_img'     =>  $thumb_path,
                    'carousel_img'  =>  trim($carousel_img, ','),
                    'stock'         =>  intval($request->stock),
                    'post_free'     =>  $request->post_free != 0 ? 1 : 0,
                    'postage'       =>  floatval($request->postage),
                    'full_price'    =>  floatval($request->full_price),
                    'ensure'        =>  $request->ensure,
                    'goods_detail'  =>  $request->goods_detail,
                    'sales'  =>  $request->sales != 0 ? 1 : 0,
                    'hot'  =>  $request->hot,
                    'best_good'  =>  $request->best_good,
                    'spike'  =>  $request->spike,
                    'spike_price'  =>  floatval($request->spike_price),
                    'spike_b_time'  =>  $request->spike_b_time,
                    'spike_e_time'  =>  $request->spike_e_time,
                    'group_buy'  =>  $request->group_buy,
                    'broup_buy_num'  =>  intval($request->broup_buy_num),
                    'group_buy_price'  =>  floatval($request->group_buy_price),
                    'group_buy_s_price'  =>  floatval($request->group_buy_s_price),
                ]);
                if($res){
                    return view('Admin.Public.success')->with([
                        'message'=>'新增成功！',
                        'url' =>url('/admin/goodsList'),
                        'jumpTime'=>2,
                        'urlname' => '商品列表'
                    ]);
                }else{
                    return back()->withErrors(['商品新增失败！'])->withInput();
                }

            }else{
                //修改
                $goods = $goods->find($id);
                foreach($request->all() as $k => $v){
                    if ($k != '_token'){
                        if ($k == 'post_free'){
                            $goods->$k = $v != 0 ? 1 : 0;
                        }elseif ($k == 'sales'){
                            $goods->$k = $v != 0 ? 1 : 0;
                        }else{
                            $goods->$k = $v;
                        }

                    }
                }
                if (!empty($thumb_path)) $goods->thumb_img = $thumb_path;
                if (!empty($carousel_img)) $goods->thumb_img = trim($carousel_img, ',');

                $res = $goods->save();

                if ($res){
                    return view('Admin.Public.success')->with([
                        'message'=>'编辑成功！',
                        'url' =>url('/admin/goodsList'),
                        'jumpTime'=>2,
                        'urlname' => '商品列表'
                    ]);
                }else{
                    return back()->withErrors(['商品编辑失败！'])->withInput();
                }


            }

        }

        $cate = (new Category())->tree();
        $brand = (new Brand())->get(['id', 'brand_name']);
        if(!empty($request->id)){
            $goods_info = $goods->find($id);
            $goods_info->carousel_img = explode(',', $goods_info->carousel_img);
        }else{
            $goods_info = [];
        }

        return view('Admin.Goods.store', compact('cate', 'goods_info', 'id', 'brand'));
    }

    /**
     * @param Goods $goods
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function delete(Goods $goods, $id){
        $info = $goods->find($id);

        $res = $info->delete();

        if ($res){
            return view('Admin.Public.success')->with([
                'message'=>'删除成功！',
                'url' =>url('/admin/goodsList'),
                'jumpTime'=>2,
                'urlname' => '商品列表'
            ]);
        }else{
            return back()->withErrors(['删除失败！'])->withInput();
        }
    }

    /**
     * @param Goods $goods
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function goodSort(Goods $goods,Request $request){
        $good = $goods->find($request->id);
        if (empty($good)){
            return response()->json(['code' => 400, 'msg' => '商品信息不存在,请重试']);
        }

        $good->order = $request->num;

        $res = $good->save();

        if ($res){
            return response()->json(['code' => 200, 'msg' => 'ok']);
        }else{
            return response()->json(['code' => 400, 'msg' => '排序失败请重试']);
        }

    }
}
