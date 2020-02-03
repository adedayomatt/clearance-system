<?php

namespace App\Http\Controllers;

use App\Clearance;
use Illuminate\Http\Request;

class ClearanceController extends Controller
{
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
