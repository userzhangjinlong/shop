<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CateSearchProperty extends Model
{
    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'category_searchproperty';

    /**
     * @var array
     */
    protected $fillable = [
        'cate_id', 'cate_name', 'property_name', 'sort'
    ];

    /**
     * 定义属性一对多关联属性值
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function propertyVal(){
        return $this->hasMany(CateSearchPropertyVal::class, 'searchproperty_id', 'id');
    }

}
