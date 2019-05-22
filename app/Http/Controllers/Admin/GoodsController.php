<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Goods;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GoodsController extends Controller
{
    public function index(Goods $goods, Request $request)
    {
        //with 实现多表关联查询获取
        $list = Goods::query();
//        $list = $goods->with(['category'])->query();
        // 关键字过滤
        if($keyword = $request->keyword ?? ''){
            $list = $list->where('goods_name', 'like', '%'.$request->keyword.'%');
        }
//
        $list = $list->with(['category' => function($query){
            $query->select('id, goods_name, created_at, name, cate_id');
        }])->paginate(20);
//        $list = $goods->select('id, goods_name, created_at, name, cate_id')->paginate(20);
        dd($list);

        return view('Admin.Goods.index', compact('list'));
    }

    public function store(Goods $goods, Request $request){

        if($request->isMethod('post')){
            $rule = [
                'goods_name'        =>      'required',
                'cate_id'           =>      'required',
                'original_price'    =>      'required',
                'present_price'     =>      'required',
                'thumb_img'         =>      'required',
                'carousel_img'      =>      'required',
                'stock'             =>      'required|integer',
//                'postage'           =>      'integer',
                'full_price'        =>      'integer',
                'ensure'            =>      'required|string',
                'goods_detail'      =>      'required|string'
            ];

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
            if (empty($request->id)){
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
                        $res = $request->file('thumb_img')->move($floder, $fileName);
                        if (!$res) {
                            return back()->withErrors(['缩略图片上传失败！'])->withInput();
                        }
                    }else{
                        return back()->withErrors([$request->file('thumb_img')->getError()])->withInput();
                    }
                    $thumb_path = $floder.'/'.$fileName;

                }else{
                    return back()->withErrors(['商品缩略图片必须上传!'])->withInput();
                }

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
                            $res = $v->move($floder,$fileName);
                            if (!$res) {
                                return back()->withErrors(['详情图片上传失败！'])->withInput();
                            }
                            $carousel_img .= $floder.'/'.$fileName.',';
                        }else{
                            return back()->withErrors([$v->getError()])->withInput();
                        }

                    }
                }else{
                    return back()->withErrors(['详情图必须上传！'])->withInput();
                }
                $res = Goods::create([
//                    $request->all()  //另一种添加方式待测试
                    'goods_name'    =>  $request->goods_name,
                    'cate_id'       =>  intval($request->cate_id),
                    'desc'          =>  $request->desc,
                    'tags'          =>  $request->tags,
                    'original_price'=>  floatval($request->original_price),
                    'present_price' =>  floatval($request->present_price),
                    'thumb_img'     =>  $thumb_path,
                    'carousel_img'  =>  trim($carousel_img, ','),
                    'stock'         =>  intval($request->stock),
                    'post_free'     =>  floatval($request->post_free),
                    'postage'       =>  floatval($request->postage),
                    'full_price'    =>  floatval($request->full_price),
                    'ensure'        =>  $request->ensure,
                    'goods_detail'  =>  $request->goods_detail
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
            }

        }

        $cate = (new Category())->tree();
        return view('Admin.Goods.store', compact('cate'));
    }
}
