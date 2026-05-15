<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Speciality;
use App\Models\MedicineCategory;
use App\Models\MedicineSubcategory;
use View;
use Helper;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
     public function index()
        {
      $specialities = Speciality::all();
      $medicines = Medicine::with('specialities')->orderBy("id","desc")->get();
      $categories = MedicineCategory::orderBy('name', 'asc')->get();
      $subcategories = MedicineSubcategory::orderBy('name', 'asc')->get();
      
     return view('back-end.admin.medicines.index',compact('specialities','medicines','categories','subcategories'));
       
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
                'name' => 'required',
                'speciality_id' => 'required',
            ]
        );
         $medicine = new Medicine();
        $medicine ->name = $request->name;
        $medicine ->speciality_id = $request->speciality_id;
        $medicine ->save();
         Session::flash('message','Medicine Created Successfully');  
            return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
     public function edit($medicine)
     {
          $specialities = Speciality::all();
        $medicines = Medicine::find($medicine);
        $categories = MedicineCategory::orderBy('name', 'asc')->get();
        $subcategories = MedicineSubcategory::orderBy('name', 'asc')->get();
        return view('back-end.admin.medicines.edit',compact('specialities','medicines','categories','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $medicine)
       {
        $this->validate(
            $request,
          [
                'name' => 'required',
                'speciality_id' => 'required',
            ]
        );
        $medicine = Medicine::find($medicine);
        $medicine->name  = $request->get('name');
        $medicine->speciality_id  = $request->get('speciality_id');
        $medicine->save();
        Session::flash('message','Medicine Edit Successfully');  
       return Redirect::to('admin/medicine');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
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
          Medicine::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Medicine Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
}
