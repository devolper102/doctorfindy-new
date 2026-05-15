<?php

namespace App\Http\Controllers;

use App\Vaccination;
use View;
use Helper;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
      {
        $vaccinations = Vaccination::orderBy("id","desc")->get();
       return view('back-end.admin.vaccinations.index',compact('vaccinations'));
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
         $vaccination = new Vaccination();
        $vaccination ->title = $request->title;
        $vaccination ->description = $request->description;
        $vaccination ->url = $request->url;
        $vaccination ->duration = $request->duration;
        $vaccination ->save();
         Session::flash('message','Vaccination Created Successfully');  
            return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vaccination  $vaccination
     * @return \Illuminate\Http\Response
     */
    public function show(Vaccination $vaccination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vaccination  $vaccination
     * @return \Illuminate\Http\Response
     */
    public function edit($vaccination)
    {
         $vaccinations = Vaccination::find($vaccination);
         return view('back-end.admin.vaccinations.edit',compact('vaccinations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vaccination  $vaccination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $vaccination)
      {
       $this->validate(
            $request,
            [
                'title' => 'required',
            ]
        );
        $vaccination = Vaccination::find($vaccination);
        $vaccination->title  = $request->get('title');
        $vaccination->description  = $request->get('description');
        $vaccination->url  = $request->get('url');
        $vaccination->duration  = $request->get('duration');
        $vaccination ->save();
        Session::flash('message','Vaccination Edit Successfully');  
       return Redirect::to('admin/vaccination');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vaccination  $vaccination
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
          Vaccination::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Vaccination Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
}
