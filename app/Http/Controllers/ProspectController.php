<?php

namespace App\Http\Controllers;

use Excel;
use App\Prospect;
use App\Imports\Prospect as ProspectImport;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    
    public function index(){
        $prospects = Prospect::orderby('created_at', 'desc')->get();
        return view('prospect.index')->with('prospects', $prospects);
    }

    public function initiateImport(){
        return view('prospect.import');
    }

    public function import(Request $request){
        $this->validate($request, [
            'file' => ['required']
        ]);
        $allowed_formats = ['xlsx'];
        $file = $request->file('file');
        $extension = \strtolower($file->getClientOriginalExtension());
        if(!in_array($extension, $allowed_formats)){
            return back()->with('error', 'unsuported file format');
        }
        Excel::import(new ProspectImport,$request->file('file'));
        return back()->with('success','Prospects imported');

    }

}
