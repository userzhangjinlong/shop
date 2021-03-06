<?php

namespace App\Models;

use Illuminate\Support\Facades\Validator;
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

    /**
     * 关联分类
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->hasOne(Category::class, 'id', 'cate_id');
    }

    /**
     * 关联品牌
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function brand(){
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function sku(){
        return $this->hasMany(GoodSku::class);
    }

}
