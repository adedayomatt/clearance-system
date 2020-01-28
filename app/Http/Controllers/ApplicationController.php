<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function home(){
        if(Auth::check('web')){
            return view('student.index');
        }
        elseif(Auth::check('admin')){
            return view('admin.index');
        }else{
            return view('home');
        }
    }
}
