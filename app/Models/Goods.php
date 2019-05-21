<?php

namespace App\Models;

use Dotenv\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Goods extends Model
{
    use Notifiable;

    /**
     * @var string
     */
    protected $tables = 'goods';

    /**
     * @var array
     */
    protected $fillable = [
        'cate_id', 'goods_name', 'desc', 'tags', 'original_price', 'present_price', 'thumb_img', 'carousel_img', 'stock', 'postage',
        'post_free', 'full_price', 'ensure', 'goods_detail'
    ];

    /**
     * @var array
     */
    protected $hidden = [

    ];



    public function validatorGoodsStore($data){
        return Validator::make($data, [
            'goods_name'        =>      'required',
            'cate_id'           =>      'required',
            'original_price'    =>      'required',
            'present_price'     =>      'required',
            'thumb_img'         =>      'required|string',
            'carousel_img'      =>      'required|string',
            'stock'             =>      'required|integer',
            'postage'           =>      'integer',
            'full_price'        =>      'integer',
            'ensure'            =>      'required|string',
            'goods_detail'      =>      'required|string'
        ],[
            'required' => ':attribute为必填项'
        ],[
            'goods_name.required'           =>  '商品名称必填',
            'cate_id.required'              =>  '分类名称必选',
            'original_price.required'       =>  '原价必填',
            'present_price.required'        =>  '售价必填',
            'thumb_img.required'            =>  '缩略图比选',
            'carousel_img.required'         =>  '轮播图必选',
            'stock.required'                =>  '库存必填',
            'ensure.required'               =>  '保障信息必填',
            'goods_detail.required'         =>  '商品详情必填'
        ]);
    }

}
