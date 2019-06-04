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

    /**
     * 关联广告位表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function  adver(){
        return $this->hasOne(Adver::class, 'id', 'adver_id');
    }

}
