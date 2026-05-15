<?php

namespace App\Http\Controllers;


use View;
use Helper;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
      {
        $departments = Department::orderBy("id","desc")->get();
       return view('back-end.admin.department.index',compact('departments'));
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
         $department = new Department();
        $department ->title = $request->title;
        $department ->description = $request->description;
        $department ->save();
         Session::flash('message','Department Created Successfully');  
            return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($department)
    {
         $departments = Department::find($department);
         return view('back-end.admin.department.edit',compact('departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $department)
    {
       $this->validate(
            $request,
            [
                'title' => 'required',
            ]
        );
        $departments = Department::find($department);
        $departments->title  = $request->get('title');
        $departments->description  = $request->get('description');
        $departments ->save();
        Session::flash('message','Department Edit Successfully');  
       return Redirect::to('admin/department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
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
          Department::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Department Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
}
