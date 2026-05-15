<?php

namespace App\Http\Controllers;

use App\Disease;
use App\Helper;
use App\Service;
use App\Symptom;
use App\Speciality;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use View;

class DiseaseController extends Controller
{

    /**
     * Defining scope of the variable
     *
     * @access public
     * @var    array $location
     */
    protected $diseases;

    /**
     * Create a new controller instance.
     *
     * @param mixed $location location instance
     *
     * @return void
     */
    public function __construct(Disease $diseases)
    {
        $this->diseases = $diseases;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $diseases = Disease::with('speciality')->get();
        $services = Service::all();
        $symptomes = Symptom::all();
        $specialities = Arr::pluck(Speciality::all(), 'title', 'id');
            return View::make(
                'back-end.admin.diseases.index',
                compact('diseases','services','symptomes','specialities')
            );
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
        //dd($request);
        //$services = explode( ',',$request->speciality);
        $symptomes = explode( ',',$request->symptomes);
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        //dd($request['speciality_id']);
        $this->validate(
            $request,
            [
                'title' => 'required',
                'speciality_id' => 'required'
            ],
            [
                    'speciality_id.required' => 'Please select a speciality'
            ]
        );
        if ($request['symptomes'] === null ) {
            $this->diseases->storeDisease($request);
        }
        else {
            $this->diseases->storeDisease($request);
            foreach ($symptomes as $symptome){
                $this->diseases->symptomes()->attach($symptome);
            }
        }
        Session::flash('message', trans('lang.save_disease'));
            return Redirect::to('admin/diseases');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $speciality = Service::all();
        $symptomes = Symptom::all();
        $specialities = Arr::pluck(Speciality::all(), 'title', 'id');
        // dd($speciality);
        if (!empty($slug)) {
            $disease = $this->diseases::where('slug', $slug)->first();

            $spe_tags = $disease->services()->get();
            $sym_tags = $disease->symptomes()->get();
            if (!empty($disease)) {
                if (file_exists(resource_path('views/extend/back-end/admin/diseases/edit.blade.php'))) {
                    return View::make(
                        'extend.back-end.admin.diseases.edit',
                        compact(
                            'disease','speciality','spe_tags','symptomes','sym_tags'
                        )
                    );
                } else {
                    return View::make(
                        'back-end.admin.diseases.edit',
                        compact(
                            'disease','speciality','spe_tags','symptomes','sym_tags','specialities'
                        )
                    );
                }
                Session::flash('message', trans('lang.disease_updated'));
                return Redirect::to('admin/locations');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $symptomes = explode( ',',$request->symptomes);
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $this->validate(
            $request,
            [
                'title' => 'required',
                'speciality_id' => 'required'
            ],
            [
                'speciality_id.required' => 'Please select a speciality'
            ]
        );
        if ($request['symptomes'] === null ) {
            $this->diseases->updateDisease($request, $id);
        }
        else {
            $this->diseases->updateDisease($request, $id);
            $this->diseases['id'] = $id;
            $this->diseases->symptomes()->detach();

            foreach ($symptomes as $symptome){
                    $this->diseases->symptomes()->attach($symptome);
                }
        }
        Session::flash('message', trans('lang.disease_updated'));
        return Redirect::to('admin/diseases');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $id = $request['id'];
        if (!empty($id)) {
            $this->diseases::where('id', $id)->delete();
            $this->diseases['id'] = $id;
            $this->diseases->services()->detach();
            $this->diseases->faqsAssign()->delete();
            $this->diseases['id'] = $id;
            $this->diseases->treatment()->detach();
            $this->diseases['id'] = $id;
            $this->diseases->user_meta()->detach();
            $this->diseases['id'] = $id;
            $this->diseases->symptomes()->detach();
            $json['type'] = 'success';
            $json['message'] = trans('lang.disease_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Remove the all resource from storage.
     *
     * @param mixed $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
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
        if (!empty($checked)) {
            foreach ($checked as $id) {
//                $this->diseases->user_meta()->detach();
                $this->diseases::where("id", $id)->delete();
                $this->diseases['id'] = $id;
            $this->diseases->faqsAssign()->delete();
            $this->diseases['id'] = $id;
            $this->diseases->treatment()->detach();
            $this->diseases['id'] = $id;
            $this->diseases->user_meta()->detach();
            }
            $json['type'] = 'success';
            $json['message'] = trans('lang.disease_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
    public function forum(){
        $specialities = Disease::all();
        return view('front-end/all-diseases/index', compact('specialities'));
    }
    public function detail_page($slug){
        $disease = Disease::where('slug',$slug)->first();
        return view('front-end.disease-forum.details',compact('disease'));
    }
    public function getAllDiseases(){
        $json = array();
        $diseases = Disease::all();
        if (!empty($diseases)) {
            $json['type'] = 'success';
            $json['diseases'] = json_decode($diseases);
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
    public function allDiseases() {
        $specialities = Speciality::with('services_diseases')->get();
        return view('front-end.all-diseases.index', compact('specialities'));
    }
}
