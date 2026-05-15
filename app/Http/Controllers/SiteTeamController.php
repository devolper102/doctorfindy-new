<?php

namespace App\Http\Controllers;

use App\SiteTeam;
use View;
use Helper;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SiteTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
      {
        $teams = SiteTeam::orderBy("id","desc")->get();
       return view('back-end.admin.site-teams.index',compact('teams'));
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
                'full_name' => 'required',
                'designation' => 'required',
            ]
        );
         $team = new SiteTeam();
        $team ->full_name = $request->full_name;
        $team->slug = Str::slug($request->full_name);
        $team ->designation = $request->designation;
        $team ->description = $request->description;
        $old_path = Helper::PublicPath() . '/uploads/team/temp';
            $new_path = Helper::PublicPath() . '/uploads/team/';
            if (!empty($request['team_image'])) {
                $filename = $request['team_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('team'))) {
                        foreach (Helper::getImageSizes('team') as $key => $size) {
                            if (file_exists($old_path . '/' . $key . '-' . $file_original_name)) {
                                rename($old_path . '/' . $key . '-' . $file_original_name, $new_path . '/' . $key . '-' . $filename);
                            }
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $team->image = $filename;
            } else {
                $team->image = null;
            }
        $team ->save();
         Session::flash('message','Team Member Created Successfully');  
            return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SiteTeam  $SiteTeam
     * @return \Illuminate\Http\Response
     */
    public function show(SiteTeam $SiteTeam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SiteTeam  $SiteTeam
     * @return \Illuminate\Http\Response
     */
    public function edit($SiteTeam)
    {
         $siteTeams = SiteTeam::find($SiteTeam);
         return view('back-end.admin.site-teams.edit',compact('siteTeams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SiteTeam  $SiteTeam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $SiteTeam)
      {
       $this->validate(
            $request,
            [
                'full_name' => 'required',
                'designation' => 'required',
            ]
        );
        $siteTeam = SiteTeam::find($SiteTeam);
        $siteTeam->full_name  = $request->get('full_name');
        $siteTeam->slug = Str::slug($request->get('full_name'));
        $siteTeam->designation  = $request->get('designation');
        $siteTeam->description  = $request->get('description');

            $old_path = Helper::PublicPath() . '/uploads/team/temp';
            $new_path = Helper::PublicPath() . '/uploads/team/';
            if (!empty($request['team_image'])) {
                $filename = $request['team_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('team'))) {
                        foreach (Helper::getImageSizes('team') as $key => $size) {
                            if (file_exists($old_path . '/' . $key . '-' . $file_original_name)) {
                                rename($old_path . '/' . $key . '-' . $file_original_name, $new_path . '/' . $key . '-' . $filename);
                            }
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $siteTeam->image = $filename;
            } else {
                $siteTeam->image = null;
            }

        $siteTeam ->save();
        Session::flash('message','Team Member Edit Successfully');  
       return Redirect::to('admin/site-team');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SiteTeam  $SiteTeam
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
          SiteTeam::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'SiteTeam Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
}

