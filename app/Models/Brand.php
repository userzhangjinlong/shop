<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Brand extends Model
{
    use Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'brand_name', 'brand_desc', 'brand_img'
    ];
}
