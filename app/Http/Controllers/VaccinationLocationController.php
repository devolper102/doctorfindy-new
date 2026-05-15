<?php

namespace App\Http\Controllers;

use App\VaccinationLocation;
use App\Vaccination;
use App\Location;
use App\User;
use View;
use Helper;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class VaccinationLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
         $vaccinations = Vaccination::all();
         $locations = Location::all();
         $hospitals = User::role('hospital')->with('profile')->get();
         $vaccination_locations = VaccinationLocation::orderBy("id","desc")->get();
        return view('back-end.admin.vaccinations.vaccination_location',compact('vaccinations','locations','hospitals','vaccination_locations'));
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
                'vaccination_id' => 'required',
                'city' => 'required',
                'hospital_id' => 'required',
                'room' => 'required',
                'phone_no' => 'required',
            ]
        );
         $vaccination_location = new VaccinationLocation();
        $vaccination_location ->vaccination_id = $request->vaccination_id;
        $vaccination_location ->city = $request->city;
        $vaccination_location ->hospital_id = $request->hospital_id;
         $vaccination_location ->hospital_address = $request->hospital_address;
        $vaccination_location ->room = $request->room;
        $vaccination_location ->phone_no = $request->phone_no;
        $vaccination_location ->start_time = $request->start_time;
        $vaccination_location ->end_time = $request->end_time;
         $vaccination_location ->days = json_encode($request->days);

        $vaccination_location ->save();
         Session::flash('message','Vaccination Location Created Successfully');  
            return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vaccination_location  $vaccination_location
     * @return \Illuminate\Http\Response
     */
    public function show(VaccinationLocation $vaccination_location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vaccination_location  $vaccination_location
     * @return \Illuminate\Http\Response
     */
    public function edit($vaccination_location)
    {
        $vaccinations = Vaccination::all();
         $locations = Location::all();
         $hospitals = User::role('hospital')->with('profile')->get();
        $vaccination_locations = VaccinationLocation::find($vaccination_location);
        return view('back-end.admin.vaccinations.vaccination_location_edit',compact('vaccinations','locations','hospitals','vaccination_locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vaccination_location  $vaccination_location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $vaccination_location)
     {
        $this->validate(
            $request,
            [
                'vaccination_id' => 'required',
                'city' => 'required',
                'hospital_id' => 'required',
                'room' => 'required',
                'phone_no' => 'required',
            ]
        );
        $vaccination_location = VaccinationLocation::find($vaccination_location);
        $vaccination_location->vaccination_id  = $request->get('vaccination_id');
        $vaccination_location->city  = $request->get('city');
        $vaccination_location->hospital_id  = $request->get('hospital_id');
        $vaccination_location->hospital_address  = $request->get('hospital_address');
        $vaccination_location->room  = $request->get('room');
        $vaccination_location->phone_no  = $request->get('phone_no');
        $vaccination_location->start_time  = $request->get('start_time');
        $vaccination_location->end_time  = $request->get('end_time');
        $vaccination_location->days  = json_encode($request->get('days'));
        $vaccination_location->save();
        Session::flash('message','Vaccination Location Edit Successfully');  
       return Redirect::to('admin/vaccination-location');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vaccination_location  $vaccination_location
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
          VaccinationLocation::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Vaccination Location Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
}
