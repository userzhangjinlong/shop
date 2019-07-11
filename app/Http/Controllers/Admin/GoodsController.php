<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\AdminInternalException;
use App\Exceptions\AdminInvalidRequestException;
use App\Exceptions\HomeInvalidRequestException;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Goods;
use App\Models\GoodsAttribute;
use Carbon\Carbon;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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

            if($request->post_free === 0){
                //包邮
                $rule['postage'] = ['required', function($attrbute, $value, $fail){
                    if ($value <= 0){
                        $fail('邮费必须大于0!');
                    }
                }];
                $rule['full_price'] = 'required';
            }

            if($request->spike == 1){
                //开启秒杀
                $rule['spike_price'] = ['required', function($attrbute, $value, $fail){
                    if ($value < 0){
                        $fail('秒杀价格不能小雨0!');
                    }
                }];
                $rule['spike_b_time'] = 'required';
                $rule['spike_e_time'] = 'required';
            }

            if ($request->group_buy == 1){
                //开启拼团
                $rule['broup_buy_num'] = ['required', 'integer'];
                $rule['group_buy_price'] = 'required';
                $rule['group_buy_s_price'] = ['required', function($attrbute, $value, $fail){
                    if ($value <= 0){
                        $fail('发起拼团价格必须大于0!');
                    }
                }];
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
                'postage.required'              =>  '邮费必填',
                'full_price.required'           =>  '满多少免邮必填',
                'spike_price.required'          =>  '秒杀价格必填',
                'spike_b_time.required'         =>  '秒杀开始时间必填',
                'spike_e_time.required'         =>  '秒杀结束时间必填',
                'broup_buy_num.required'        =>  '拼团人数必填',
                'broup_buy_num.integer'         =>  '拼团人数为整数',
                'group_buy_price.required'      =>  '拼团价格必填',
                'group_buy_s_price.required'    =>  '发起拼团价格必填',
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
                //新增
                DB::beginTransaction();
                try{
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

                    $attr_length = count($request->input('attr_name'));
                    if (!empty($attr_length)){
                        $attribute_data = [];
                        for ($i = 0; $i<$attr_length; $i++){
                            if (empty($request->input('attr_name')[$i])) return back()->withErrors(['请严格按照规则填写商品属性！'])->withInput();
                            if ($request->input('hasmany')[$i] == 0 && empty($request->input('attr_val')[$i])) return back()->withErrors(['请严格按照规则填写商品属性！'])->withInput();
                            $attribute_data[] = [
                                'goods_id'  =>  $res,
                                'name'      =>  trim($request->input('attr_name')[$i]),
                                'hasmany'   =>  $request->input('hasmany')[$i],
                                'attr_val'  =>  $request->input('attr_val')[$i] ? trim($request->input('attr_val')[$i]) : '',
                                'sort'      =>  $request->input('attr_sort')[$i],
                                'created_at'=>  Carbon::now()->toDateTimeString(),
                                'updated_at'=>  Carbon::now()->toDateTimeString(),
                            ];
                        }

                        GoodsAttribute::insert($attribute_data);
                    }
                    DB::commit();
                }catch (\Exception $exception){
                    DB::rollBack();
                    throw new AdminInternalException($exception->getMessage());
                }

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
                            if ($k != 'attr_name' && $k != 'hasmany' && $k != 'attr_val' && $k != 'attr_id' && $k != 'attr_sort') $goods->$k = $v;
                        }

                    }
                }
                if (!empty($thumb_path)) $goods->thumb_img = $thumb_path;
                if (!empty($carousel_img)) $goods->thumb_img = trim($carousel_img, ',');

                DB::beginTransaction();

                try{
                    $res = $goods->save();
                    $attr_length = count($request->input('attr_name'));
                    if (!empty($attr_length)){
                        $attribute_data = [];
                        for ($i = 0; $i<$attr_length; $i++){
                            if (empty($request->input('attr_name')[$i])) return back()->withErrors(['请严格按照规则填写商品属性！'])->withInput();
                            if ($request->input('hasmany')[$i] == 0 && empty($request->input('attr_val')[$i])) return back()->withErrors(['请严格按照规则填写商品属性！'])->withInput();
                            if ($request->input('attr_id')[$i] > 0){
                                //编辑
                                $good_attribute = GoodsAttribute::find($request->input('attr_id')[$i]);
                                $good_attribute->name = trim($request->input('attr_name')[$i]);
                                $good_attribute->hasmany = $request->input('hasmany')[$i];
                                $good_attribute->attr_val = trim($request->input('attr_val')[$i]);
                                $good_attribute->sort = $request->input('attr_sort')[$i] ?: 0;

                                $good_attribute->save();
                            }else{
                                $attribute_data[] = [
                                    'goods_id'  =>  $id,
                                    'name'      =>  $request->input('attr_name')[$i],
                                    'hasmany'   =>  $request->input('hasmany')[$i],
                                    'attr_val'  =>  $request->input('attr_val')[$i] ?: '',
                                    'sort'      =>  $request->input('attr_sort')[$i],
                                    'created_at'=>  Carbon::now()->toDateTimeString(),
                                    'updated_at'=>  Carbon::now()->toDateTimeString(),
                                ];
                            }

                        }
                        if (!empty($attribute_data)) GoodsAttribute::insert($attribute_data);

                    }
                    DB::commit();

                }catch (\Exception $exception){
                    throw new AdminInternalException($exception->getMessage());
                }



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
            $attributeList = (new GoodsAttribute())->where('goods_id', $id)->get();
        }else{
            $goods_info = [];
            $attributeList = [];
        }

        return view('Admin.Goods.store', compact('cate', 'goods_info', 'id', 'brand', 'attributeList'));
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

    public function destoryAttr(Request $request){
        $goods_attribute  = (new GoodsAttribute())->find($request->attr_id);
        if (empty($goods_attribute)){
            return response()->json(['code' => 400, 'msg' => '属性数据异常']);
        }

        $res = $goods_attribute->delete();

        if ($res){
            return response()->json(['code' => 200, 'msg' => 'ok']);
        }else{
            return response()->json(['code' => 400, 'msg' => '删除失败']);
        }
    }

}
