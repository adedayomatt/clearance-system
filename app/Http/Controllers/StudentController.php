<?php

namespace App\Http\Controllers;

use App\Prospect;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
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
        return view('student.start-clearance')->with('prospect', $prospect);
    }

    public function registerClearance($matric){
        $prospect = $this->matricEligible($matric);
        if(!$prospect){
            return redirect()->route('student.matric.check')->with('error', 'The matric number is not eligible for clearance at the moment');
        }
        if($prospect->clearance_registered()){
            return redirect()->route('login')->with('success', 'You can now login to start your clearance');
        }

        $this->validate($request, [
            'password' => ['required', 'confirmed']
        ]);

        $student = Student::create([
            'matric' => $prospect->matric,
            'email' => $prospect->email,
            'password' => $request->password
        ]);

        return redirect()->route('login')->with('success', 'You can now login to start your clearance');
    }

}
