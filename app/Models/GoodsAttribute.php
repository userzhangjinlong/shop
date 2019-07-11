<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class GoodsAttribute extends Model
{
    use Notifiable;

    /**
     * @var string
     */
    protected $tables = 'goods_attributes';

    /**
     * @var array
     */
    protected $fillable = [
        'goods_id', 'name', 'hasmany', 'sort'
    ];

    protected $casts = [
        'hasmant'   =>  'boolean', //布尔值
    ];

    /**
     * @var array
     */
    protected $hidden = [

    ];

}
