<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use View;
use Helper;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $urls = Url::orderBy("id","desc")->get();
       return view('back-end.admin.urls.index',compact('urls'));

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
                'url' => 'required'
            ]
        );
         $urls = new Url();
        $urls ->title = $request->title;
         $urls->slug = Str::slug($request->title);
        $urls ->url = $request->url;
        $urls ->meta_title = $request->meta_title;
        $urls ->meta_description = $request->meta_description;
        $urls ->description = $request->description;
        $urls ->save();
         Session::flash('message','Page Created Successfully');  
            return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\url  $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
         $urls_show = Url::find($url);
         return view('back-end.admin.urls.show',compact('urls_show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\url  $url
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
         $urls = Url::find($url);
         return view('back-end.admin.urls.edit',compact('urls'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\url  $url
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $url)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'url' => 'required'
            ]
        );
        $urls = Url::find($url);
        $urls->title  = $request->get('title');
        $urls->slug  =  Str::slug($request->get('title'));
        $urls->url  = $request->get('url');
        $urls->meta_title  = $request->get('meta_title');
        $urls->meta_description  = $request->get('meta_description');
        $urls->description  = $request->get('description');
        $urls ->save();
        Session::flash('message','Page Edit Successfully');  
       return Redirect::to('admin/url');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\url  $url
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
          Url::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Page deleted successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
}
