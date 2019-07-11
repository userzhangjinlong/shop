<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class GoodSku extends Model
{
    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'goods_sku';

    /**
     * @var array
     */
    protected $fillable = [
        'goods_id', 'title', 'description', 'price', 'stock', 'img', 'is_default'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'is_default' => 'boolean'
    ];

    /**
     * 序列化、json传递参数时不会显示的字段
     *
     * @var array
     */
    protected $hidden = [];

}
