<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\AdminInternalException;
use App\Exceptions\AdminInvalidRequestException;
use App\Http\Requests\Admin\GoodSkuRequest;
use App\Models\Attribute;
use App\Models\Goods;
use App\Models\GoodsAttribute;
use App\Models\GoodSku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GoodSkuController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, GoodSku $goodSku){
        //with 实现多表关联查询获取
        $list = $goodSku->with(['goods' => function ($query){
            $query->select('goods_name','id');
        }]);
        // 关键字过滤
        if($keyword = $request->keyword ?? ''){
            $list = $list->where('goods_name', 'like', '%'.$request->keyword.'%');
        }

        //商品过滤
        if (!empty($request->input('goods_id'))){
            $list = $list->where('goods_id', '=', $request->input('goods_id'));
        }


        $list = $list->select('id', 'goods_id', 'title', 'price', 'stock', 'created_at')->paginate(env('PAGINATE'));

        return view('Admin.GoodSku.index', compact('list'));
    }

    /**
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store($id=''){
        if (!empty($id)){
            $sku_info = GoodSku::find($id);
        }else{
            $sku_info = [];
        }

        $goods_list = (new Goods())->where('sales', false)->select('id', 'goods_name')->get();
        return view('Admin.GoodSku.store', compact('id','goods_list', 'sku_info'));
    }

    /**
     * @param GoodSkuRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws AdminInternalException
     */
    public function create(GoodSkuRequest $request){
            $floder = 'Uploads/Goods/'.date('Ymd');
            //缩略图上传
            if (!Storage::disk('public')->exists($floder)){
                Storage::makeDirectory($floder);
            }
            if($request->file('img')){
                if ($request->file('img')->isValid()) {
                    $extension = $request->file('img')->getClientOriginalExtension();
                    $rule = ['jpg', 'png', 'gif', 'jpeg'];
                    if (!in_array($extension, $rule)) {
                        return back()->withErrors(['图片格式需要为jpg,png,gif格式!'])->withInput();
                    }
                    $fileName = time() . mt_rand(1, 999) . '.' . $extension;
                    $res = $request->file('img')->move(base_path('public/'.$floder), $fileName);
                    if (!$res) {
                        return back()->withErrors(['属性图片上传失败！'])->withInput();
                    }
                }else{
                    return back()->withErrors([$request->file('img')->getError()])->withInput();
                }
                $thumb_path = '/'.$floder.'/'.$fileName;
                $add['img'] = $thumb_path;
            }
            DB::beginTransaction();
            try{
                $add = [
                    'goods_id'      =>  intval($request->input('goods_id')),
                    'is_default'    =>  intval($request->input('is_default')),
                    'description'   =>  trim($request->input('description')),
                    'price'         =>  floatval($request->input('price')),
                    'stock'         =>  intval($request->input('stock')),
                ];
                $length = count($request->input('attributes'));
                $attributes = [];
                for ($i = 0; $i < $length; $i++){
                    if (empty($request->input('attributes')[$i])){
                        return back()->withErrors(['请填写所有必填的属性值！'])->withInput();
                    }

                    $id_arr[] = $request->input('attributes_id')[$i];
                    $val_arr[] = $request->input('attributes')[$i];
//                    $has_attributes = (new Attribute())->where(['goods_id' => $request->input('goods_id'), 'attr_id' => $request->input('attributes_id')[$i], 'attr_val' => $request->input('attributes')[$i]])->first();
//                    dd($request->input('goods_id').$request->input('attributes_id')[$i].$request->input('attributes')[$i]);
//                    dd($request->input('attributes_id')[$i]);
                    if (empty($request->input('attributes_id')[$i])){
                        $res_id = Attribute::create([
                            'goods_id'      =>      $request->input('goods_id'),
                            'attr_id'       =>      $request->input('attributes_id')[$i],
                            'attr_val'      =>      $request->input('attributes')[$i],
                        ]);
                        $attributes[] = $res_id;
                    }else{
                        if(!empty($request->input('id'))){
                            $attr_tmp = (new Attribute())->find($request->input('sku_id')[$i]);
                            $attr_tmp->attr_id = $request->input('attributes_id')[$i];
                            $attr_tmp->attr_val = $request->input('attributes')[$i];
                            $attr_tmp->goods_id = $request->input('goods_id');
                            $attr_tmp->save();
                            $attributes[] = $request->input('sku_id')[$i];
                        }else{
                            $attributes[] = $request->input('attributes_id')[$i];
                        }

                    }

                }

                $add['title'] = implode(',', $val_arr);
                $add['attributes'] = implode(',', $attributes);

                if (!empty($request->input('id'))){
                    //编辑
                    $res =  GoodSku::where('id', $request->input('id'))->update($add);
                }else{
                    //新增
                    $res = GoodSku::create($add);
                }

                if ($res){
                    $other_id = !empty($request->input('id')) ? $request->input('id') : $res;
                    if ($request->input('is_default') == 1){
                        GoodSku::where('id', '<>', $other_id)->update(['is_default' => 0]);
                    }

                }
            } catch (\Exception $exception){
//                throw new AdminInternalException($exception->getMessage());
                throw new AdminInvalidRequestException($exception->getMessage());
            }
            DB::commit();

        if ($res){
            return view('Admin.Public.success')->with([
                'message'=>'操作成功！',
                'url' =>url('/admin/goodsSkuList'),
                'jumpTime'=>2,
                'urlname' => '属性列表'
            ]);
        }else{
            return back()->withErrors(['操作失败！'])->withInput();
        }

    }

    /**
     * @param Request $request
     * @param GoodsAttribute $goodsAttribute
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGoodsAttrubute(Request $request, GoodsAttribute $goodsAttribute){
        if (empty($request->goods_id)){
            return response()->json(['code' => 400, 'msg' => '属性数据异常']);
        }
        if (empty($request->id)){
            $attr_list = $goodsAttribute->where(['goods_id' => $request->goods_id, 'hasmany' => 1])->orderBy('sort','asc')->get(['id', 'name']);
            foreach ($attr_list as $k => $v){
                $attr_list[$k]['attr_val'] = '';
                $attr_list[$k]['sku_id'] = '';
            }
        }else{

            $attributes = (new GoodSku())->where(['id' => $request->id, 'goods_id' => $request->goods_id])->first(['attributes']);
            $attriburte_id = explode(',', $attributes->attributes);
            if (empty($attriburte_id)){
                $attr_list = $goodsAttribute->where(['goods_id' => $request->goods_id, 'hasmany' => 1])->orderBy('sort','asc')->get(['id', 'name']);
                foreach ($attr_list as $k => $v){
                    $attr_list[$k]['attr_val'] = '';
                    $attr_list[$k]['sku_id'] = '';
                }
            }else{

                $list = (new Attribute())->whereIn('id', $attriburte_id)->get(['id', 'attr_id', 'attr_val']);
                $goods_attribute = [];
                foreach ($list as  $v){
                    $goods_attribute[] = $v->attr_id;
                }
                if (!empty($goods_attribute)){
                    $attri_name = [];
                    $tmp_list = $goodsAttribute->whereIn('id', $goods_attribute)->orderBy('sort','asc')->get(['id', 'name']);
                    foreach ($tmp_list as $v){
                        $attri_name[$v->id] = $v->name;
                    }

                    $attr_list = [];
                    foreach ($list as $k => $v){
                        $attr_list[$k]['name'] = $attri_name[$v->attr_id];
                        $attr_list[$k]['id'] = $v->attr_id;
                        $attr_list[$k]['sku_id'] = $v->id;
                        $attr_list[$k]['attr_val'] = $v->attr_val;
                    }
                }else{
                    $attr_list = $goodsAttribute->where(['goods_id' => $request->goods_id, 'hasmany' => 1])->orderBy('sort','asc')->get(['id','name']);
                    foreach ($attr_list as $k => $v){
                        $attr_list[$k]['attr_val'] = '';
                        $attr_list[$k]['sku_id'] = '';
                    }
                }


            }
        }

        return response()->json(['code' => 200, 'msg' => 'ok', 'list' => $attr_list]);
    }

    public function destory(GoodSku $goodSku, $id){
       $goodSku = $goodSku->find($id);
       $res = $goodSku->delete();
        if ($res){
            return view('Admin.Public.success')->with([
                'message'=>'删除成功！',
                'url' =>url('/admin/goodsSkuList'),
                'jumpTime'=>2,
                'urlname' => '商品列表'
            ]);
        }else{
            return back()->withErrors(['删除失败！'])->withInput();
        }
    }

}
