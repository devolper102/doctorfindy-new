<?php

namespace App\Http\Controllers;

use App\Diagnose;
use App\Speciality;
use View;
use Helper;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class DiagnoseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $specialities = Speciality::all();
        $diagnoses = Diagnose::with('specialities')->orderBy("id","desc")->get();
     return view('back-end.admin.diagnosis.index',compact('specialities','diagnoses'));
       
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
              $this->validate(
            $request,
            [
                'title' => 'required',
                'speciality_id' => 'required',
            ]
        );
         $diagnose = new Diagnose();
        $diagnose ->title = $request->title;
        $diagnose ->speciality_id = $request->speciality_id;
        $diagnose ->save();
         Session::flash('message','Diagnose Created Successfully');  
            return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnose $diagnose)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function edit($diagnose)
    {
          $specialities = Speciality::all();
        $diagnoses = Diagnose::find($diagnose);
        return view('back-end.admin.diagnosis.edit',compact('specialities','diagnoses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $diagnose)
       {
        $this->validate(
            $request,
          [
                'title' => 'required',
                'speciality_id' => 'required',
            ]
        );
        $diagnose = Diagnose::find($diagnose);
        $diagnose->title  = $request->get('title');
        $diagnose->speciality_id  = $request->get('speciality_id');
        $diagnose->save();
        Session::flash('message','Diagnose Edit Successfully');  
       return Redirect::to('admin/diagnose');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
   public function destroy(Request $request)
      {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $id = $request['id'];
        
        if (!empty($id)) {
          Diagnose::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Diagnose Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
}
