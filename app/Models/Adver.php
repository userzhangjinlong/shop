<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Adver extends Model
{
    use Notifiable;

    protected $fillable = [
        'adver_name', 'adver_desc'
    ];
}
