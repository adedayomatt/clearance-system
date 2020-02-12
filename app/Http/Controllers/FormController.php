<?php

namespace App\Http\Controllers;

use Auth;
use App\Form;
use App\FormResponse;
use App\Requirement;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('form.index')->with('forms', Form::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form.create');
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
            'name' => ['required']
        ]);

        $form = Form::create([
            'name' => $request->name
        ]);

        return \redirect()->route('admin.form.field.create', $form->id)->with('success', "New form created, add fields");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($form_id)
    {
        $form = Form::findorfail($form_id);

        return view('form.show')->with('form', $form);
    }

    public function RequirementFormshow($requirement_id, $form_id)
    {
        $requirement = Requirement::findorfail($requirement_id);
        $form = Form::findorfail($form_id);

        return view('form.show')->with(['requirement' => $requirement, 'form' => $form]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('form.edit', Form::findorfail($id));
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
