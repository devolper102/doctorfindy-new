<?php

namespace App\Http\Controllers;

use App\Role;
use View;
use Helper;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy("id","desc")->get();
       return view('back-end.admin.roles.index',compact('roles'));
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
                'role_type' => 'required',
                'guard_name' => 'required'
            ]
        );
         $role = new Role();
        $role ->name = $request->name;
        $role ->role_type = $request->role_type;
        $role ->guard_name = $request->guard_name;
        $role ->save();
         Session::flash('message','Role Created Successfully');  
            return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($role)
      {
         $roles = Role::find($role);
         return view('back-end.admin.roles.edit',compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $role)
       {
        $this->validate(
            $request,
           [
                'name' => 'required',
                'role_type' => 'required',
                'guard_name' => 'required'
            ]
        );
        $role = Role::find($role);
        $role->name  = $request->get('name');
        $role->role_type  = $request->get('role_type');
        $role->guard_name  = $request->get('guard_name');
        $role ->save();
        Session::flash('message','Role Edit Successfully');  
       return Redirect::to('admin/role');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
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
          Role::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Role Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
}
