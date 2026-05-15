<?php

namespace App\Http\Controllers;

use App\Facility;
use View;
use Helper;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
      {
        $facilities = Facility::orderBy("id","desc")->get();
        return view('back-end.admin.facility.index',compact('facilities'));
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
            ]
        );
         $facility = new Facility();
        $facility ->title = $request->title;
        $facility ->description = $request->description;
        $facility ->save();
         Session::flash('message','Facility Created Successfully');  
            return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit($facility)
    {
        $facilities = Facility::find($facility);
         return view('back-end.admin.facility.edit',compact('facilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $facility)
       {
       $this->validate(
            $request,
            [
                'title' => 'required',
            ]
        );
        $facility = Facility::find($facility);
        $facility->title  = $request->get('title');
        $facility->description  = $request->get('description');
        $facility ->save();
        Session::flash('message','Facility Edit Successfully');  
       return Redirect::to('admin/facility');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facility  $facility
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
          Facility::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Facility Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
}
