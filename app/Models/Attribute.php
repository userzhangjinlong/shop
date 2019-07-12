<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Attribute extends Model
{
    use Notifiable;

    /**
     * @var string
     */
    protected $table='attributes';

    /**
     * @var array
     */
    protected $fillable = [
        'goods_id', 'attr_id', 'attr_val'
    ];
}
