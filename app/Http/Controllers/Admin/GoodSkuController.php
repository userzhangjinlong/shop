<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodSkuController extends Controller
{
    public function index(Request $request){

        return view('Admin.GoodSku.index');
    }

    public function store(Request $request){

        return view('Admin.GoodSku.store');
    }
}
