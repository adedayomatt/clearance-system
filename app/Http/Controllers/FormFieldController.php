<?php

namespace App\Http\Controllers;

use App\Form;
use App\FormField;
use Illuminate\Http\Request;

class FormFieldController extends Controller
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
    public function create($form_id)
    {
        $form = Form::findorfail($form_id);
        return view('form.field.create')->with('form', $form);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $form_id)
    {
        $form = Form::findorfail($form_id);

        $this->validate($request, [
            'label' => ['required'],
        ]);

        $field = FormField::create([
            'form_id' => $form->id,
            'label' => $request->label,
            'name' => \str_replace('-','_', str_slug($request->label)),
            'placeholder' => $request->placeholder,
            'required' => $request->has('required'),
        ]);

        return redirect()->route('form.show', $form->id)->with('success', 'New field added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('form.field.edit')->with('field', FormField::findorfail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $form_id)
    {
        $field = FormField::findorfail($form_id);

        $this->validate($request, [
            'label' => ['required'],
        ]);

        $field->label = $request->label;
        $field->name = \str_replace('-','_', str_slug($request->label));
        $field->placeholder = $request->placeholder;
        $field->required = $request->has('required');
        $field->save();

        return \redirect()->route('form.show', $field->form->id)->with('success', 'Field updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $field = FormField::findorfail($form_id);
        $field->delete();

        return \redirect()->route('form.show', $field->form->id)->with('success', 'Field deleted');

    }
}
