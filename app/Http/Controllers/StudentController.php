<?php

namespace App\Http\Controllers;

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

    public function uploadRequirement(Request $request, $id){
        $requirement = Requirement::findorfail($id);
        $student = Auth::guard('web')->user();
        $this->validate($request, [
            'file' => ['required', 'mimes:jpeg,jpg,JPG,png,pdf']
        ]);
        $upload = $this->upload('file', $as = str_slug($student->matric.' '.$requirement->title), $to = 'clearance', $accept = ['jpeg', 'jpg', 'JPG', 'png', 'pdf']);
        $existing_clearance = Clearance::where('requirement_id', $requirement->id)->where('student_id', $student->id)->first();
        $clearance = $existing_clearance == null ? new Clearance : $existing_clearance;
        $clearance->requirement_id = $requirement->id;
        $clearance->student_id = $student->id;
        $clearance->upload = $upload['filename'];
        $clearance->created_at = now();
        $clearance->save();

        return redirect()->back()->with('success', $requirement->title.' uploaded successfully, it is pending for approval');
    }

    public function show($matric){
        $student = Student::where('matric', $matric)->firstorfail();
        return view('student.show')->with('student', $student);
    }

    
}
