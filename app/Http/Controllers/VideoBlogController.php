<?php

namespace App\Http\Controllers;

use App\VideoBlog;
use Session;
use Helper;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class VideoBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = VideoBlog::orderBy("id","desc")->get();
       return view('back-end.admin.video-blogs.index',compact('blogs'));
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
                'url' => 'required'
            ]
        );
        $blog = new VideoBlog();
        $blog ->url = $request->url;
        $blog ->description = $request->description;
        $blog ->save();
         Session::flash('message','Video Blog Created Successfully');  
            return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VideoBlog  $videoBlog
     * @return \Illuminate\Http\Response
     */
    public function show(VideoBlog $videoBlog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VideoBlog  $videoBlog
     * @return \Illuminate\Http\Response
     */
    public function edit($videoBlog)
    {
        $blogs = VideoBlog::find($videoBlog);
         return view('back-end.admin.video-blogs.edit',compact('blogs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VideoBlog  $videoBlog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $videoBlog)
    {
        $this->validate(
            $request,
            [
                'url' => 'required'
            ]
        );
        $blog = VideoBlog::find($videoBlog);
        $blog->url  = $request->get('url');
        $blog->description  = $request->get('description');
        $blog ->save();
        Session::flash('message','Video Blog Edit Successfully');  
       return Redirect::to('admin/video-blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VideoBlog  $videoBlog
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
          VideoBlog::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Video Blog Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
}
