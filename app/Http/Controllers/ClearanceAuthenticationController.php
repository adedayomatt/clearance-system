<?php

namespace App\Http\Controllers;

use Hash;
use App\Student;
use App\Prospect;
use Illuminate\Http\Request;
use App\Http\Traits\FileUpload;

class ClearanceAuthenticationController extends Controller
{
    use FileUpload;

    public function __construct(){
        $this->middleware('guest:web');
    }

    private function matricEligible($matric){
        $prospect = Prospect::find($matric);
        return $prospect == null ? false : $prospect;
    }

    public function checkMatric(){
        return view('student.check-matric');
    }

    public function confirmMatric(Request $request){
        $this->validate($request, [
            'matric_number' => ['required']
        ]);

        $prospect = $this->matricEligible($request->matric_number);

        if(!$prospect){
            return redirect()->back()->with('error', 'The matric number is not eligible for clearance');
        }
        return view('student.check-matric')->with('prospect', $prospect);
    }

    public function startClearance($matric){
        $prospect = $this->matricEligible($matric);
        if(!$prospect){
            return redirect()->route('student.matric.check')->with('error', 'The matric number is not eligible for clearance at the moment');
        }
        if($prospect->clearance_registered()){
            return redirect()->route('login')->with('success', 'Login to continue your clearance');
        }

        return view('student.start-clearance')->with('prospect', $prospect);
    }

    public function registerClearance(Request $request, $matric){
        $prospect = $this->matricEligible($matric);
        if(!$prospect){
            return redirect()->route('student.matric.check')->with('error', 'The matric number is not eligible for clearance at the moment');
        }
        if($prospect->clearance_registered()){
            return redirect()->route('login')->with('success', 'You can now login to start your clearance');
        }

        $this->validate($request, [
            'passport' => ['required', 'mimes: jpg,JPG,jpeg,png', 'max: 2064'],
            'front_id_card' => ['required', 'max: 2064'],
            'back_id_card' => ['required', 'max: 2064'],
            'password' => ['required', 'confirmed']
        ]);
        $format = ['jpg', 'JPG', 'jpeg','png'];
        $passport = $this->upload('passport', $as = $prospect->matric, $to = 'students', $accept = $format);
        $front_id_card = $this->upload('front_id_card', $as = $prospect->matric.'_id_front', $to = 'students', $accept = $format);
        $back_id_card = $this->upload('back_id_card', $as = $prospect->matric.'_id_back', $to = 'students', $accept = $format);

        $student = Student::create([
            'matric' => $prospect->matric,
            'email' => $prospect->email,
            'password' => Hash::make($request->password),
            'passport' => $passport['filename'],
            'school_id_front' => $front_id_card['filename'],
            'school_id_back' => $back_id_card['filename']
        ]);

        return redirect()->route('login')->with('success', 'You can now login to start your clearance');
    }

}
