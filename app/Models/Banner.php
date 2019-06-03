<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Banner extends Model
{
    use Notifiable;

    protected $fillable = [
        'adver_id', 'banner_name', 'banner_img', 'banner_desc'
    ];
}
