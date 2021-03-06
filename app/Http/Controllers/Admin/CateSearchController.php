<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\AdminInternalException;
use App\Exceptions\AdminInvalidRequestException;
use App\Http\Requests\Admin\CateSearchRequest;
use App\Http\Requests\Admin\CateSearchValRequest;
use App\Models\Category;
use App\Models\CateSearchProperty;
use App\Http\Controllers\Controller;
use App\Models\CateSearchPropertyVal;
use App\Models\Goods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CateSearchController extends Controller
{
    public function index(Request $request, CateSearchProperty $cateSearchProperty){
        $list = $cateSearchProperty;
        // 关键字过滤
        if($keyword = $request->keyword ?? ''){
            $list = $list->where('goods_name', 'like', '%'.$request->keyword.'%');
        }

        //商品过滤
        if (!empty($request->input('cate_id'))){
            $list = $list->where('cate_id', '=', $request->input('cate_id'));
        }

        $list = $list->select('id', 'cate_name', 'sort', 'property_name')->orderBy('sort','asc')->paginate(env('PAGINATE'));
        return view('Admin.CateSearch.index', compact('list'));
    }

    /**
     * 新增编辑搜索属性模板
     *
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store($id = ''){
        if (!empty($id)){
            $catesearch_info = CateSearchProperty::find($id);
        }else{
            $catesearch_info = [];
        }

        $cate = (new Category())->tree();
        return view('Admin.CateSearch.store', compact('id','catesearch_info', 'cate'));
    }

    public function getGoodsAttribute(Request $request){
        $cate_id = $request->cate_id;
        $goods_list = (new Goods())->where('cate_id', $cate_id)->get(['id']);
        $goods_idarr = [];
        foreach ($goods_list as $v){
            $goods_idarr[] = $v->id;
        }

//        $attr_list =
    }

    /**
     * @param CateSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws AdminInvalidRequestException
     */
    public function create(CateSearchRequest $request){
        $cate_name = str_replace("|", "", $request->input('cate_name'));
        $cate_name = str_replace("-", "", $cate_name);
        $add = [
            'cate_id'       =>  intval($request->input('cate_id')),
            'property_name' =>  trim($request->input('property_name')),
            'cate_name'     =>  $cate_name,
            'sort'          =>  $request->input('sort') ? intval($request->input('sort')) : 0,
        ];

        if (empty($request->input('id'))){
            //新增
            $res = CateSearchProperty::create($add);
        }else{
            //编辑
            $res = CateSearchProperty::where('id', $request->input('id'))->update($add);
        }

        if ($res){
            return view('Admin.Public.success')->with([
                'message'=>'操作成功！',
                'url' =>url('/admin/cateSearchProperty'),
                'jumpTime'=>2,
                'urlname' => '属性列表'
            ]);
        }else{
            throw new AdminInvalidRequestException('操作失败');
        }
    }

    /**
     * @param CateSearchProperty $cateSearchProperty
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function destory(CateSearchProperty $cateSearchProperty, $id){
        $SearchProperty = $cateSearchProperty->find($id);
        DB::beginTransaction();
        try{
            $res = $SearchProperty->delete();
            CateSearchPropertyVal::where('searchproperty_id', $id)->delete();
        }catch (\Exception $exception){
            throw new AdminInternalException($exception->getMessage());
        }

        DB::commit();
        if ($res){
            return view('Admin.Public.success')->with([
                'message'=>'删除成功！',
                'url' =>url('/admin/cateSearchProperty'),
                'jumpTime'=>2,
                'urlname' => '筛选属性列表'
            ]);
        }else{
            return back()->withErrors(['删除失败！'])->withInput();
        }
    }

    /**
     * @param CateSearchProperty $cateSearchProperty
     * @param $search_id
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function storeVal(CateSearchProperty $cateSearchProperty,$search_id,$id=''){

        //获取筛选属性信息
        $search_info = $cateSearchProperty->where('id', $search_id)->first();

        //获取属性值列表
        $list = CateSearchPropertyVal::where('searchproperty_id', $search_id)->get(['id', 'searchproperty_value', 'search_val', 'sort']);

        if (!empty($id)){
            $data = CateSearchPropertyVal::where('id', $id)->first();
        }else{
            $data = [];
        }

        return view('Admin.CateSearch.storeVal', compact('search_id', 'search_info', 'list', 'data', 'id'));
    }

    /**
     * @param CateSearchValRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws AdminInvalidRequestException
     */
    public function createVal(CateSearchValRequest $request){
        $add = [
            'cate_id'               =>  intval($request->input('cate_id')),
            'searchproperty_id'     =>  intval($request->input('searchproperty_id')),
            'searchproperty_name'   =>  trim($request->input('searchproperty_name')),
            'searchproperty_value'  =>  trim($request->input('searchproperty_value')),
            'search_val'            =>  trim($request->input('search_val')),
            'cate_name'             =>  trim($request->input('cate_name')),
            'sort'                  =>  $request->input('sort') ? intval($request->input('sort')) : 0,
        ];

        if (empty($request->input('id'))){
            //新增
            $res = CateSearchPropertyVal::create($add);
        }else{
            $res = CateSearchPropertyVal::where('id', $request->input('id'))->update($add);
        }

        if ($res){
            return view('Admin.Public.success')->with([
                'message'=>'操作成功！',
                'url' =>url('/admin/cateSearchValAdd/'.intval($request->input('searchproperty_id'))),
                'jumpTime'=>2,
                'urlname' => '属性值列表'
            ]);
        }else{
            throw new AdminInvalidRequestException('操作失败');
        }

    }

    /**
     * @param CateSearchPropertyVal $cateSearchPropertyVal
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function destoryVal(CateSearchPropertyVal $cateSearchPropertyVal, $id){
        $SearchProperty = $cateSearchPropertyVal->find($id);
        $res = $SearchProperty->delete();
        if ($res){
            return view('Admin.Public.success')->with([
                'message'=>'删除成功！',
                'url' =>'',
                'jumpTime'=>2,
                'urlname' => '返回上一页'
            ]);
        }else{
            return back()->withErrors(['删除失败！'])->withInput();
        }
    }

}
