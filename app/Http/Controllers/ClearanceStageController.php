<?php

namespace App\Http\Controllers;

use App\Student;
use App\ClearanceStage;
use Illuminate\Http\Request;

class ClearanceStageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stages =  ClearanceStage::all();
        return view('clearance-stage.index')->with('stages', $stages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clearance-stage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'description' => ['required'],
        ]);

        $stage = ClearanceStage::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $stage->attach_stages($request->pre_requisite);

        return redirect()->route('clearance.stage.show', $stage->id)->with('success', 'Clearance stage create. Now add requirements for this <strong>'.$stage->name.'<strong>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stage = ClearanceStage::findorfail($id);

        // dd($stage->stage_requirements());
        return view('clearance-stage.show')->with('stage', $stage);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stage = ClearanceStage::findorfail($id);

        return view('clearance-stage.edit')->with('stage', $stage);
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
        $stage = ClearanceStage::findorfail($id);

        $this->validate($request, [
            'name' => ['required'],
            'description' => ['required'],
        ]);

        $stage->name = $request->name;
        $stage->description = $request->description;
        $stage->save();

        $stage->attach_stages($request->pre_requisite);

        return redirect()->route('clearance.stage.show', $stage->id)->with('success', 'Clearance stage updated');
    }

    public function studentClearance($stage_id, $matric){
        $stage = ClearanceStage::findorfail($stage_id);
        $student = Student::where('matric', $matric)->firstorfail();

        return view('clearance-stage.student-clearance')->with(['stage' => $stage, 'student' => $student]);
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
