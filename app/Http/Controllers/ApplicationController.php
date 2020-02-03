<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function home(){
        if(Auth::check('web')){
            return view('home')->with('student', Auth::guard('web')->user());
        }else{
            return view('home');
        }
    }
}
