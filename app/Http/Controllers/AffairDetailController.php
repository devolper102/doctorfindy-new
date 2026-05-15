<?php

namespace App\Http\Controllers;

use App\AffairDetail;
use View;
use Helper;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Affairs;


class AffairDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      $affairs = Affairs::all();
      $affair_detail = AffairDetail::with('affairs')->orderBy("id","desc")->get();      
       return view('back-end.admin.affairs.affair_detail',compact('affairs','affair_detail'));
       
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
                'affairs_id' => 'required',
                'title' => 'required',
                'type' => 'required',
                'status' => 'required'

            ]
        );
         $affairdetail = new AffairDetail();
        $affairdetail ->affairs_id = $request->affairs_id;
        $affairdetail ->title = $request->title;
        $affairdetail ->type = $request->type;
        $affairdetail ->status = $request->status;
        $affairdetail ->url = $request->url;
        $affairdetail ->description = $request->description;
            $old_path = Helper::PublicPath() . '/uploads/affairs/temp';
            $new_path = Helper::PublicPath() . '/uploads/affairs/';
            if (!empty($request['affair_image'])) {
                $filename = $request['affair_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('affair'))) {
                        foreach (Helper::getImageSizes('affair') as $key => $size) {
                            if (file_exists($old_path . '/' . $key . '-' . $file_original_name)) {
                                rename($old_path . '/' . $key . '-' . $file_original_name, $new_path . '/' . $key . '-' . $filename);
                            }
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $affairdetail->image = $filename;
            } else {
                $affairdetail->image = null;
            }
        $affairdetail ->save();
         Session::flash('message','Affair Detail Created Successfully');  
            return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AffairDetail  $affairDetail
     * @return \Illuminate\Http\Response
     */
    public function show(AffairDetail $affairDetail)
    {
        //
    }
    
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AffairDetail  $affairDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($affairDetail)
    {
         $affairs = Affairs::all();
        $affairdetails = AffairDetail::find($affairDetail);
         return view('back-end.admin.affairs.edit_detail',compact('affairs','affairdetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AffairDetail  $affairDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $affairDetail)
    {
        $this->validate(
            $request,
          [
                'affairs_id' => 'required',
                'title' => 'required',
                'type' => 'required',
                'status' => 'required'

            ]
        );
        $affairdetail = AffairDetail::find($affairDetail);
        $affairdetail->affairs_id  = $request->get('affairs_id');
        $affairdetail->title  = $request->get('title');
        $affairdetail->type  = $request->get('type');
        $affairdetail->status  = $request->get('status');
        $affairdetail->url  = $request->get('url');
        $affairdetail->description  = $request->get('description');

          $old_path = Helper::PublicPath() . '/uploads/affairs/temp';
            $new_path = Helper::PublicPath() . '/uploads/affairs/';
            if (!empty($request['affair_image'])) {
                $filename = $request['affair_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('affair'))) {
                        foreach (Helper::getImageSizes('affair') as $key => $size) {
                            if (file_exists($old_path . '/' . $key . '-' . $file_original_name)) {
                                rename($old_path . '/' . $key . '-' . $file_original_name, $new_path . '/' . $key . '-' . $filename);
                            }
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $affairdetail->image = $filename;
            } else {
                $affairdetail->image = null;
            }
        $affairdetail ->save();
        Session::flash('message','Affair Detail Edit Successfully');  
       return Redirect::to('admin/affair-details');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AffairDetail  $affairDetail
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
          AffairDetail::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Affair Detail Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
    
}
