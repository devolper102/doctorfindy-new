<?php

namespace App\Http\Controllers;

use App\Speciality_Test;
use App\Speciality;
use App\Symptom;
use View;
use Helper;
use Session;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class Speciality_TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Speciality_Test $test)
    {
        $this->test = $test;
    }
    public function index()
        {
       $specialities = Speciality::all();
       $symptoms = Symptom::where('test_symptom','1')->get();
       $tests = Speciality_Test::with('specialities')->orderBy("id","desc")->get();
     return view('back-end.admin.speciality-tests.index',compact('specialities','tests','symptoms'));
       
    }

    public function labTestMetaIndex()
    {
       $tests = DB::table('lab_tests_meta')->get();
       
        return view('back-end.admin.speciality-tests.lab_tests_meta',compact('tests'));
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
             $symptoms = explode( ',',$request->symptoms);

              $this->validate(
            $request,
            [
                'title' => 'required',
                'price' => 'required',
                'speciality_id' => 'required',
                'type' => 'required',
                'symptoms' => 'required'
            ]
        );

              // dd($request);
               $this->test->saveTest($request);
            foreach ($symptoms as $symptom){
                $this->test->symptoms()->attach($symptom);
            }
         Session::flash('message','Speciality Test Created Successfully');  
            return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Speciality_Test  $Speciality_Test
     * @return \Illuminate\Http\Response
     */
    public function show(Speciality_Test $Speciality_Test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Speciality_Test  $Speciality_Test
     * @return \Illuminate\Http\Response
     */
    public function edit($Speciality_Test)
    {
        $symptom_tags = [];
           $specialities = Speciality::all();
           $symptoms = Symptom::where('test_symptom','1')->get();
           $tests = Speciality_Test::find($Speciality_Test);
           $symptom_tags = $tests->symptoms()->get();
        return view('back-end.admin.speciality-tests.edit',compact('specialities','tests','symptoms','symptom_tags'));
    }

     public function editLabMeta($Speciality_Test)
    {
           $test = DB::table('lab_tests_meta')->where('id',$Speciality_Test)->first();
       
           
        return view('back-end.admin.speciality-tests.editLabMeta',compact('test'));
    }


    public function updateLabMeta(Request $request, $Speciality_Test)
    {
            // $test = DB::table('lab_tests_meta')->where('id',$Speciality_Test)->first();
            $updatedData = [];
             if ($request->url_title) {
                $updatedData['url_title'] = $request->url_title;
            }
            if ($request->known_as) {
                $updatedData['known_as'] = $request->known_as;
            }

            if ($request->meta_title) {
                $updatedData['meta_title'] = $request->meta_title;
            }

            if ($request->meta_description) {
                $updatedData['meta_description'] = $request->meta_description;
            }

            if ($request->introduction) {
                $updatedData['introduction'] = $request->introduction;
            }

            if ($request->description) {
                $updatedData['description'] = $request->description;
            }
             if ($request->url_title) {
              $urlTitle = Str::slug($request->url_title); 
              $urlTitle = preg_replace('/[^a-zA-Z0-9]+/', '-', $urlTitle);
                // dd($urlTitle);
              $updatedData['slug'] = $urlTitle;
    }
             $updatedData['updated_at'] = Carbon::now();

             // dd($updatedData);
            

            DB::table('lab_tests_meta')->where('id', $Speciality_Test)->update($updatedData);
             $title = DB::table('lab_tests_meta')->where('id', $Speciality_Test)->value('title');

             DB::table('lab_tests')->where('title', $title)->update(['slug' => $urlTitle]);
            // $a = DB::table('lab_tests_meta')->where('id', $Speciality_Test)->first()->pluck('title');
            // // dd($a);
            // $labTest = Speciality_Test::where('title', $a)->first();
            
            Session::flash('message','Lab Test Meta Updated Successfully');  
       return Redirect::to('admin/lab-tests-meta');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Speciality_Test  $Speciality_Test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Speciality_Test)
    {
        // dd($request->all());
         $symptoms = explode( ',',$request->symptoms);
        $this->validate(
            $request,
          [
                'title' => 'required',
                'price' => 'required',
                'speciality_id' => 'required',
                'type' => 'required',
                'symptoms' => 'required',

            ]
        );
        $this->test->updateTest($request, $Speciality_Test);
        // dd($test);
        $this->test['id'] = $Speciality_Test;
         $this->test->symptoms()->detach();

        foreach ($symptoms as $symptom){
                $this->test->symptoms()->attach($symptom);
            }
        Session::flash('message','Speciality Test Edit Successfully');  
       return Redirect::to('admin/speciality-test');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Speciality_Test  $Speciality_Test
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
        $test = $this->test::find($id);
           $this->test['id'] = $request['id'];
            $this->test->symptoms()->detach();
            $this->test->specialities()->delete();
          Speciality_Test::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Speciality Test Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
    public function deleteDuplicatesRecords(Request $request)
    {
        $results = DB::table('lab_tests')
            ->select('lab_id', 'title', DB::raw('COUNT(*) as duplicates'))
            ->groupBy('lab_id', 'title')
            ->havingRaw('COUNT(*) > 1')
            ->get();
         foreach($results as $result)
        {
              $oldestRecord = DB::table('lab_tests')
                            ->where('title', $result->title)
                            ->where('lab_id', $result->lab_id)
                            ->orderBy('updated_at', 'asc')
                            ->first();


               DB::table('lab_tests')->where('id', $oldestRecord->id)->delete();  
        }

        dd('done');
    }
}
