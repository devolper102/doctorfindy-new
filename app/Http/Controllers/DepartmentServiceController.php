<?php

namespace App\Http\Controllers;
use View;
use Helper;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use App\DepartmentService;
use App\Department;
use Illuminate\Http\Request;

class DepartmentServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
        {
       $departments = Department::all();
        $department_services = DepartmentService::with('departments')->orderBy("id","desc")->get(); 
       return view('back-end.admin.department.department_service',compact('departments','department_services'));
       
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
                'department_id' => 'required',
                'service' => 'required',
            ]
        );
         $departmentservice = new DepartmentService();
        $departmentservice ->department_id = $request->department_id;
        $departmentservice ->service = $request->service;
        $departmentservice ->description = $request->description;
        $departmentservice ->save();
         Session::flash('message','Department Servicel Created Successfully');  
            return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DepartmentService  $departmentService
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentService $departmentService)
    {
  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DepartmentService  $departmentService
     * @return \Illuminate\Http\Response
     */
    public function edit($departmentService)
    {
        $departments = Department::all();
        $department_services = DepartmentService::find($departmentService);
        return view('back-end.admin.department.edit_service',compact('departments','department_services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DepartmentService  $departmentService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $departmentService)
      {
        $this->validate(
            $request,
          [
                'department_id' => 'required',
                'service' => 'required',
            ]
        );
        $departmentService = DepartmentService::find($departmentService);
        $departmentService->department_id  = $request->get('department_id');
        $departmentService->service  = $request->get('service');
        $departmentService->description  = $request->get('description');
        $departmentService->save();
        Session::flash('message','Department Service Edit Successfully');  
       return Redirect::to('admin/department-service');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DepartmentService  $departmentService
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
          DepartmentService::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Department Service Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
}
