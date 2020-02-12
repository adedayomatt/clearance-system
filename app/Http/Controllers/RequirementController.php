<?php

namespace App\Http\Controllers;

use App\Requirement;
use App\ClearanceStage;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($stage_id)
    {
        $stage = ClearanceStage::findorfail($stage_id);

        return view('requirement.create')->with('stage', $stage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $stage_id)
    {
        $stage = ClearanceStage::findorfail($stage_id);

        $this->validate($request, [
            'title' => ['required'],
            'instructions' => ['required']
        ]);
        
        $requirement = Requirement::create([
            'clearance_stage_id' => $stage->id,
            'title' => $request->title,
            'instructions' => $request->instructions,
            'form_id' => $request->requirement_type == 'form' ? $request->form : null,
            'file_upload' => $request->requirement_type == 'upload' ? true : false,
        ]);

        return redirect()->route('clearance.stage.show', $stage->id)->with('success', 'New requirement added to clearance stage');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requirement = Requirement::findorfail($id);
        
        return view('requirement.edit')->with('requirement', $requirement);
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
        $requirement = Requirement::findorfail($id);
        $this->validate($request, [
            'title' => ['required'],
            'instructions' => ['required']
        ]);

        $requirement->title = $request->title;
        $requirement->instructions = $request->instructions;
        if($request->requirement_type == 'form'){
            $requirement->form_id = $request->form;
        }else{
            $requirement->form_id = null;
        }
        $requirement->file_upload = $request->requirement_type == 'upload' ? true : false;
        $requirement->save();

        return redirect()->route('clearance.stage.show', $requirement->clearance_stage->id)->with('success', $requirement->title.' requirement updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $requirement = Requirement::findorfail($id);
        
        $requirement->delete();

        return redirect()->route('clearance.stage.show', $requiremnet->clearance_stage->id)->with('success', $requirement->title.' requirement removed');
    }
}
