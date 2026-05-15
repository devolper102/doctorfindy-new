<?php

namespace App\Http\Controllers;

use App\Affairs;

use View;
use Helper;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class AffairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $affairs = Affairs::orderBy("id","desc")->get();       
       return view('back-end.admin.affairs.index',compact('affairs'));
       

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
                'status' => 'required',
                'priority' => 'required'
            ]
        );
         $affairs = new Affairs();
        $affairs ->title = $request->title;
        $affairs ->status = $request->status;
        $affairs ->priority = $request->priority;
        $affairs ->save();
         Session::flash('message','Affair Created Successfully');  
            return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Affairs  $affairs
     * @return \Illuminate\Http\Response
     */
    public function show(Affairs $affairs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Affairs  $affairs
     * @return \Illuminate\Http\Response
     */
    public function edit($affairs)
    {
         $affairs = Affairs::find($affairs);
         return view('back-end.admin.affairs.edit',compact('affairs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Affairs  $affairs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $affairs)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'status' => 'required',
                'priority' => 'required'
            ]
        );
        $affairs = Affairs::find($affairs);
        $affairs->title  = $request->get('title');
        $affairs->status  = $request->get('status');
        $affairs->priority  = $request->get('priority');
        $affairs ->save();
        Session::flash('message','Affair Edit Successfully');  
       return Redirect::to('admin/affairs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Affairs  $affairs
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
          Affairs::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Affair Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
    
}
