<?php

namespace App\Http\Controllers;

use Auth;
use App\Form;
use App\Clearance;
use App\Requirement;
use App\FormResponse;
use App\Http\Traits\FileUpload;

use Illuminate\Http\Request;

class ClearanceController extends Controller
{
    use FileUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clearances = Clearance::where('approved_at', null)->get();
        return view('clearance.index')->with('clearances', $clearances);
    }

    
    public function uploadRequirement(Request $request, $id){
        $requirement = Requirement::findorfail($id);
        $student = Auth::guard('web')->user();
        $this->validate($request, [
            'file' => ['required', 'mimes:jpeg,jpg,JPG,png,pdf']
        ]);
        $upload = $this->upload('file', $as = str_slug($student->matric.' '.$requirement->title), $to = 'clearance', $accept = ['jpeg', 'jpg', 'JPG', 'png', 'pdf']);
        
        $existing_clearance = $student->clearance($requirement->id);
        $clearance = $existing_clearance == null ? new Clearance : $existing_clearance;
        $clearance->requirement_id = $requirement->id;
        $clearance->student_id = $student->id;
        $clearance->upload = $upload['filename'];
        $clearance->approved_at = null;
        $clearance->rejected_at = null;
        $clearance->save();

        return redirect()->back()->with('success', $requirement->title.' uploaded successfully, it is pending for approval');
    }


    
    public function submitForm(Request $request, $requirement_id, $form_id){
        $requirement = Requirement::findorfail($requirement_id);
        $form = Form::findorfail($form_id);
        $student = Auth::guard('web')->user();

        $rules = [];
        foreach($form->form_fields as $field){
            if($field->required){
                $rules[$field->name] =  ['required'];
            }
        }

        $this->validate($request, $rules);

        foreach($form->form_fields as $field){
            $existing_response = $student->form_response($field->id);
            $response = $existing_response == null ? new FormResponse : $existing_response;
            $name = $field->name;
            $response->student_id = $student->id;
            $response->form_field_id =  $field->id;
            $response->response = $request->$name;
            $response->save();
        }

        $existing_clearance = $student->clearance($requirement->id);
        $clearance = $existing_clearance == null ? new Clearance : $existing_clearance;
        $clearance->requirement_id = $requirement->id;
        $clearance->student_id = $student->id;
        $clearance->approved_at = null;
        $clearance->rejected_at = null;
        $clearance->save();


        return redirect()->route('clearance.stage.show', $requirement->clearance_stage->id)->with('success', $form->name." submitted successfully");
    }

    public function approveClearance($id){
        $clearance = Clearance::findorfail($id);

        $clearance->approved_at = now();
        $clearance->rejected_at = null;
        $clearance->save();

        return redirect()->back()->with('success', 'Clearance approved');
    }

    public function rejectClearance($id){
        $clearance = Clearance::findorfail($id);

        $clearance->approved_at = null;
        $clearance->rejected_at = now();

        $clearance->save();
        
        return redirect()->back()->with('success', 'Clearance rejected');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clearance = Clearance::findorfail($id);
        return view('clearance.show')->with('clearance', $clearance);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
