<?php

namespace App\Http\Controllers;

use App\VaccinationAlert;
use App\Vaccination;
use View;
use Helper;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VaccinationAlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
          $vaccinations = Vaccination::all();
          $vaccination_alerts = VaccinationAlert::orderBy("id","desc")->get();
        return view('back-end.admin.vaccinations.vaccination_alert',compact('vaccinations','vaccination_alerts'));
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
                'vaccination_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]
        );
         $vaccination_alert = new VaccinationAlert();
        $vaccination_alert ->title = $request->title;
        $vaccination_alert ->vaccination_id = $request->vaccination_id;
        $vaccination_alert ->start_date = $request->start_date;
         $vaccination_alert ->end_date = $request->end_date;
        $vaccination_alert ->start_time = $request->start_time;
        $vaccination_alert ->end_time = $request->end_time;
        $vaccination_alert ->url = $request->url;
        $vaccination_alert ->alert_parents = $request->alert_parents;
        $vaccination_alert ->save();
         Session::flash('message','Vaccination Alert Created Successfully');  
            return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vaccination_alert  $vaccination_alert
     * @return \Illuminate\Http\Response
     */
    public function show(VaccinationAlert $vaccination_alert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vaccination_alert  $vaccination_alert
     * @return \Illuminate\Http\Response
     */
    public function edit($vaccination_alert)
      {
        $vaccinations = Vaccination::all();
        $vaccination_alerts = VaccinationAlert::find($vaccination_alert);
        return view('back-end.admin.vaccinations.vaccination_alert_edit',compact('vaccinations','vaccination_alerts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vaccination_alert  $vaccination_alert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vaccination_alert)
    {
        $this->validate(
             $request,
            [
                'title' => 'required',
                'vaccination_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]
        );
        $vaccination_alert = VaccinationAlert::find($vaccination_alert);
        $vaccination_alert->title  = $request->get('title');
        $vaccination_alert->vaccination_id  = $request->get('vaccination_id');
        $vaccination_alert->start_date  = $request->get('start_date');
        $vaccination_alert->end_date  = $request->get('end_date');
        $vaccination_alert->start_time  = $request->get('start_time');
        $vaccination_alert->end_time  = $request->get('end_time');
        $vaccination_alert->url  = $request->get('url');
        $vaccination_alert->alert_parents  = $request->get('alert_parents');
        $vaccination_alert->save();
        Session::flash('message','Vaccination Alert Edit Successfully');  
       return Redirect::to('admin/vaccination-alert');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vaccination_alert  $vaccination_alert
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
          VaccinationAlert::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Vaccination Alert Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
}
