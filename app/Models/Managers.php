<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Managers extends Model
{
    use Notifiable;

    protected $tables = 'managers';
}
