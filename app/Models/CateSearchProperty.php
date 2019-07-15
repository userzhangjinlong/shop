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
}
