<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecapsController extends Controller
{
    public function dataKesakitan(){
        return view('recaps.dataKesakitan');
        //return "asd";
    }

    public function topTen(){
        return view('recaps.topTen');
    }
}
