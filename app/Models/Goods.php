<?php

namespace App\Models;

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
}
