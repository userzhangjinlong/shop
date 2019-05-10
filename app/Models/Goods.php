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

    ];

    /**
     * @var array
     */
    protected $hidden = [

    ];
}
