<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AdminController extends Controller
{
    use AuthenticatesUsers;

    public function __construct(){
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function loginForm(){
        return view('auth.admin.login');
    }

    public function redirectTo(){
        return route('admin.index');
    }
}
