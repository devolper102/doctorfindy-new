<?php

namespace App\Http\Controllers;

use App\Disease;
use App\Helper;
use App\Location;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use View;
use DB;
use App\Service;
use App\Speciality;
use App\Symptom;
use Illuminate\Http\Request;

class SymptomController extends Controller
{

    protected $symptom;
    public function __construct(Symptom $symptom)
    {
        $this->symptom = $symptom;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $symptomss = Symptom::all();
        $symptom_top = Symptom::orderBy("id","desc")->where('top', '1')->get();

        $services = Service::all();

        if (!empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $symptoms = $this->symptom::where('title', 'like', '%' . $keyword . '%')->get()->setPath('');
            $pagination = $symptoms->appends(
                array(
                    'keyword' => $request->get('keyword')
                )
            );
        } else {
            $symptoms = $this->symptom->get();
        }
        if (file_exists(resource_path('views/extend/back-end/admin/specialities/edit.blade.php'))) {
            return View::make(
                'extend.back-end.admin.symptoms.index',
                compact('symptoms','services','symptom_top','symptomss')
            );
        } else {
            return View::make(
                'back-end.admin.symptoms.index',
                compact('symptoms','services','symptom_top','symptomss')
            );
        }
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
                    'title' => 'required|string',
                ],
                [
                    'title.required' => 'Enter Symptom title!',
                    'title.string' => 'Enter title in string form',
                ]
            );
        if ($request->service === null) {
            $this->symptom->saveSymptom($request);
        }
        else{
            $services = explode( ',',$request->service);
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
         
            $this->symptom->saveSymptom($request);
            foreach ($services as $service){
                $this->symptom->services()->attach($service);
            } 
        }
            Session::flash('message', trans('lang.symptom_saved_success'));
            return Redirect::back();
    }
    public function store_symptoms(Request $request)
    {

        if (!empty($request)) {
            $this->validate(
                $request,
                [
                    'symptom' => 'required'
                ],
                [
                    'symptom.required' => 'please Enter at least one Symptom!'
                ]
            );
            $str_arr = explode (",", $request->symptom);
            foreach ($str_arr as $data){
                $top = DB::table('symptoms')->where("id",$data)->update([
                    'top' => 1
                ]);
            }
            Session::flash('message','Add Top Symptoms');
            return Redirect::back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function show(Symptom $symptom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $service = Service::all();
        if (!empty($slug)) {
            $symptom = Symptom::where('slug', $slug)->with('services')->first();
            $service_tags = $symptom->services()->get();
            if (!empty($symptom)) {
                if (file_exists(resource_path('views/extend/back-end/admin/symptoms/edit.blade.php'))) {
                    return View::make('extend.back-end.admin.symptoms.edit', compact('symptom', 'service', 'service_tags'));
                } else {
                    return View::make(
                        'back-end.admin.symptoms.edit',
                        compact('symptom','service', 'service_tags')
                    );
                }
                return Redirect::to('admin/symptom');
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                $this->validate(
            $request,
            [
                'title' => 'required|string',
            ],
            [
                'title.required' => 'Enter Specialty title!',
                'title.string' => 'Enter title in string form',
            ]
        );
                if ($request->services === null) {
                   $this->symptom->updateSymptom($request, $id);
                }
                else{
        $services = explode( ',',$request->services);
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $this->symptom->updateSymptom($request, $id);
        $this->symptom['id'] = $id;
        $this->symptom->services()->detach();
        foreach ($services as $service){
            $this->symptom->services()->attach($service);
        }
                }

        Session::flash('message', trans('lang.symptom_updated'));
        return Redirect::to('admin/symptom');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Symptom  $symptom
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
            $symptom = $this->symptom::find($id);
            if ($symptom->services->count() > 0) {
                foreach ($symptom->services as $key => $speciality_service) {
                    $service = Service::find($speciality_service->id);
                    if ($service->users->count() > 0) {
                        $service->users()->detach();
                    }
                    $service->delete();
                }

            }
            $this->symptom::where('id', $id)->delete();
            $this->symptom->faqsAssign()->delete();
            $this->symptom['id'] = $request['id'];
            $this->symptom->diseases()->detach();
            $this->symptom['id'] = $request['id'];
            $this->symptom->Specialities()->detach();
            $this->symptom['id'] = $request['id'];
            $this->symptom->tests()->detach();
            $this->symptom['id'] = $request['id'];
            $this->symptom->services()->detach();
            $json['type'] = 'success';
            $json['message'] = trans('lang.symptom_deleted');
            return $json;
        }
    }
    public function destroy_top(Request $request){
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $id = $request['id'];
        if (!empty($id)) {
            $this->symptom::where('id', $id)->update([
                'top' => null
            ]);
            $json['type'] = 'success';
            $json['message'] = ('Top Speciality Delete Successfully');
            return $json;
        }

    }
    public function deleteSelected(Request $request)
    {
        $server = Helper::DoctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $checked = $request['ids'];
        foreach ($checked as $id) {
            $this->symptom::where("id", $id)->delete();
            $this->symptom['id'] = $id;
            $this->symptom->services()->detach();
            $this->symptom->faqsAssign()->delete();
            $this->symptom['id'] = $id;
            $this->symptom->tests()->detach();
        }
        if (!empty($checked)) {
            $json['type'] = 'success';
            $json['message'] = trans('lang.specialities_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    public function detail_page($slug){
        $disease = Symptom::where('slug',$slug)->first();
        return view('front-end.symptom.details',compact('disease'));
    }
}
