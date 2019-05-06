<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use Notifiable;

    /**
     * @var string
     */
    protected $tables = 'categories';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'pid', 'description', 'cateicon'
    ];

    /**
     * @var array
     */
    protected $hidden = [

    ];
}
