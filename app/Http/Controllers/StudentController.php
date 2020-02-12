<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use App\Student;
use App\Clearance;
use App\Requirement;
use Illuminate\Http\Request;
use App\Http\Traits\FileUpload;

class StudentController extends Controller
{
    use FileUpload;

    public function index(){
        return view('student.show')->with('student', Auth::guard('web')->user());
    }

    public function show($matric){
        $student = Student::where('matric', $matric)->firstorfail();
        return view('student.show')->with('student', $student);
    }

    
    public function printCertificate(){
        $student = Auth::guard('web')->user();

        if($student->clearance_approval_progress < 100){
            return redirect()->back()->with('error', 'All documents are not approved yet');
        }

        $certificate = PDF::loadView('pdf.clearance-certificate', ['student' => $student]);
        return $certificate->stream($student->matric.'.pdf');

    }

    
}
