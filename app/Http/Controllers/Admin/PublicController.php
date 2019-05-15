<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
    public function upload(Request $request){
        var_dump($request->file());
        var_dump('werwer');
    }
}
