<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CateSearchPropertyVal extends Model
{
    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'category_searchproperty_value';

    /**
     * @var array
     */
    protected $fillable = [
        'cate_id', 'cate_name', 'searchproperty_id', 'searchproperty_name', 'searchproperty_value', 'search_val', 'sort'
    ];
}
