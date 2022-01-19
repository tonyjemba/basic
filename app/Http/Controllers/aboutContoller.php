<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class aboutContoller extends Controller
{
    public function index(){
        return view('about');
    }
}
