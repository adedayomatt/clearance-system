<?php

namespace App\Http\Controllers;

use App\Prospect;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    
    public function index(){
        return view('prospect.index')->with('prospects', $prospect);
    }
}
