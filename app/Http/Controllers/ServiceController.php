<?php

/**
 * Class ServiceController.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @version <PHP: 1.0.0>
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use App\Disease;
use App\Location;
use App\SiteManagement;
use App\User;
use View;
use Helper;
use Session;
use App\Service;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Speciality;
use Illuminate\Support\Arr;
/**
 * Class ServiceController
 *
 */
class ServiceController extends Controller
{
    /**
     * Defining scope of the variable
     *
     * @access public
     * @var    array $service
     */
    protected $service;

    /**
     * Create a new controller instance.
     *
     * @param mixed $service service instance
     *
     * @return void
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $service_all = Service::with('speciality')->get();
        $service_tops = Service::orderBy("id","desc")->where('top', '1')->get();
        $specialities = Arr::pluck(Speciality::all(), 'title', 'id');
        $services = Service::limit(1500)->get();
            return View::make(
                'back-end.admin.services.index',
                compact('services', 'specialities','service_all','service_tops')
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $this->validate(
            $request,
            [
                'title' => 'required',
                'speciality' => 'required'
            ]
        );
        $this->service->storeService($request);
        Session::flash('message', trans('lang.save_service'));
        return Redirect::back();
    }
 public function store_service(Request $request)
    {
          
               if (!empty($request)) {
            $this->validate(
                $request,
                [
                    
                    'service' => 'required'
                ],
                [
                    'service.required' => 'please Enter at least one service!'
                ]
            );
       $str_arr = explode (",", $request->service);  
      foreach ($str_arr as $data){
        $top = DB::table('services')->where("id",$data)->update([
           'top' => 1
        ]);
            }
            Session::flash('message','Add Top Services');  
            return Redirect::back();
    }
}
    /**
     * Edit Services.
     *
     * @param int $slug string
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if (!empty($slug)) {
            $service = $this->service::where('slug', $slug)->first();
            $specialities = Arr::pluck(Speciality::all(), 'title', 'id');
            if (!empty($service)) {
                $speciality = $this->service::where('slug', $slug)->select('speciality_id')->pluck('speciality_id')->first();
                if (file_exists(resource_path('views/extend/back-end/admin/services/edit.blade.php'))) {
                    return View::make(
                        'extend.back-end.admin.services.edit',
                        compact(
                            'service',
                            'speciality',
                            'specialities'
                        )
                    );
                } else {
                    return View::make(
                        'back-end.admin.services.edit',
                        compact(
                            'service',
                            'speciality',
                            'specialities'
                        )
                    );
                }
                Session::flash('message', trans('lang.service_updated'));
                return Redirect::to('admin/services');
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update services.
     *
     * @param string $request string
     * @param int    $id      integer
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $this->validate(
            $request,
            [
                'title' => 'required',
            ]
        );
        $this->service->updateService($request, $id);
        Session::flash('message', trans('lang.service_updated'));
        return Redirect::to('admin/services');
    }

    /**
     * Remove service from database.
     *
     * @param mixed $request request attributes
     *
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
            $this->service::where('id', $id)->delete();
            $this->service->faqsAssign()->delete();
            $this->service['id'] = $request['id'];
            $this->service->symptoms()->detach();
            $this->service['id'] = $request['id'];
            $this->service->diseases()->detach();
            $this->service['id'] = $request['id'];
            $this->service->users()->detach();
            $json['type'] = 'success';
            $json['message'] = trans('lang.service_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
public function destroy_top(Request $request)
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
            $this->service::where('id', $id)->update([
           'top' => null
        ]);
            $json['type'] = 'success';
            $json['message'] = 'Top Service Delete Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
    /**
     * Remove the specified resource from storage.
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
                $this->service::where("id", $id)->delete();
            $this->service->faqsAssign()->delete();
            $this->service['id'] = $id;
            $this->service->symptoms()->detach();
            $this->service['id'] = $id;
            $this->service->diseases()->detach();
            $this->service['id'] = $id;
            $this->service->users()->detach();
            }
            $json['type'] = 'success';
            $json['message'] = trans('lang.service_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
    public function getAllServices()
    {
        $user_ = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];

         /*Specialities*/
        $specialities = Speciality::where('top',1)->with('diseases',function($q){
                return $q->take(10);
            })->orderBy("created_at","asc")->limit(8)->get();
        $trending = $specialities->sortByDesc('trending')->first();

        $doctors = $trending->similarUsersWithRelations()->limit(4)->get();
        $doctors->load('specialities');
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('location','area','feedbacks')->with('profile',function($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc','hospital_services');
            })->with('teams',function($q){
                return $q->take(10);
            })->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('location','area')->with('profile',function ($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','faqs','total_experience','description');
            })->limit(12)->get();
       
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->latest()->limit(4)->get();
        /*Services*/
        $services = Service::with('diseases')->latest()->limit(4)->get();
        /*Locations*/
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();
        $cities_pakistan = Location::inRandomOrder()->limit(8)->get();

        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        return view('front-end.find-a-doctor.disease',
            compact(
            'specialities', 'logged_user', 'laboratories', 'cities', 'services', 'diseases', 'hospitals', 'doctors', 'managements','segments','cities_pakistan'
        ));
    }
     public function getdisease()
    {
        /*Services*/
          $specialities = Speciality::with('diseases')->where('top',1)->get();
        return response()->json($specialities);
    }
    public function allServices()
    {
        $user_ = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];

        $doctors = User::role('doctor')->orderBy("trending","desc")->with('profile','specialities','location','feedbacks')->whereHas('profile')->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area','feedbacks','teams')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->limit(15)->get();
        /*Specialities*/
        $specialities = Speciality::with('services')->where('top',1)->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        // dd($specialities);
        $diseases = Disease::select('id','title', 'slug','flag')->latest()->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->latest()->limit(4)->get();
        /*Locations*/
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        $cities_pakistan = Location::inRandomOrder()->limit(8)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        return view('front-end.services.all_services',
            compact(
            'specialities', 'logged_user', 'laboratories', 'cities', 'services', 'diseases', 'hospitals', 'doctors', 'managements','segments','cities_pakistan'
        ));
    }
    public function detail_page($slug){
        $locations = Location::all();
        $service = Service::where('slug',$slug)->with('speciality')->first();
        $doctors = User::role('doctor')->with('diseases')->with('specialities')->with('location')->with('services')->with('profile')->with('location')->with('feedbacks')->with('doc_teams')->with('appointments')->with('roles')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->get();
        $hospitals = User::role('hospital')->with('diseases')->with('specialities')->with('location')->with('services')->with('profile')->with('location')->with('feedbacks')->with('doc_teams')->with('appointments')->with('roles')->get();
        $services = Service::with('symptoms')->with('speciality')->with('diseases')->get();
        return view('front-end.services.details',compact('doctors', 'hospitals','locations', 'service', 'services'));
    }

    public function allSpecialities() {
        $specialities = Speciality::with('services_symptom')->where('top',1)->get();

        return view('front-end.services.index', compact('specialities'));
    }
        public function getallservicess(){

           $specialities = Speciality::with('services')->where('top',1)->get();
        return response()->json($specialities);
    }

}
