<?php

/**
 * Class LocationController.
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
use App\Faq;
use App\Procedure;
use App\Service;
use App\SiteManagement;
use App\Speciality;
use App\User;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Util\Json;
use View;
use Helper;
use Session;
use DB;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
/**
 * Class Location Controller
 *
 */
class LocationController extends Controller
{
    /**
     * Defining scope of the variable
     *
     * @access public
     * @var    array $location
     */
    protected $location;

    /**
     * Create a new controller instance.
     *
     * @param mixed $location location instance
     *
     * @return void
     */
    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $location_top = Location::all();
       $location_tops = Location::orderBy("id","desc")->where('top', '1')->get();
        $locations = Location::limit(100)->get();
            return View::make('back-end.admin.locations.index', compact('locations','location_top','location_tops'));
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
            ]
        );
        if (!empty($request['title'])) {
            $this->location->storeLocation($request);
            Session::flash('message', trans('lang.save_location'));
            return Redirect::back();
        }
    }
    public function store_location(Request $request)
    {
          
               if (!empty($request)) {
            $this->validate(
                $request,
                [
                    
                    'location' => 'required'
                ],
                [
                    
                    'location.required' => 'please Enter at least one location!'
    ]
            );
       $str_arr = explode (",", $request->location);  
      foreach ($str_arr as $data){
        $top = DB::table('locations')->where("id",$data)->update([
           'top' => 1
        ]);
            }
            Session::flash('message','Add Top Locations');  
            return Redirect::back();
    }
}

    /**
     * Edit Locations.
     *
     * @param int $slug string
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if (!empty($slug)) {
            $location = $this->location::where('slug', $slug)->first();
            $locations_list = Arr::pluck($this->location::where('slug', '!=', $slug)->get(), 'title', 'id');
            if (!empty($location)) {
                $location_parent = $this->location::where('slug', $slug)->select('parent')->pluck('parent')->first();
                if (file_exists(resource_path('views/extend/back-end/admin/locations/edit.blade.php'))) {
                    return View::make('extend.back-end.admin.locations.edit', compact('location', 'location_parent', 'locations_list')
                    );
                } else {
                    return View::make('back-end.admin.locations.edit', compact('location', 'location_parent', 'locations_list'
                        )
                    );
                }
                Session::flash('message', trans('lang.location_updated'));
                return Redirect::to('admin/locations');
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update locations.
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
        $this->location->updateLocation($request, $id);
        Session::flash('message', trans('lang.location_updated'));
        return Redirect::to('admin/locations');
    }

    /**
     * Remove location from database.
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
            $this->location::where('id', $id)->delete();
            $this->location['id'] = $id;
            $result = $this->location->specialities()->detach();
            $this->location->users()->update([
           'location_id' => null,
           'area_id' => null,
        ]);
            $this->location->vaccinations()->update([
           'city' => null
        ]);
            //$this->location->where('parent', $id)->delete();
            $this->location->areas()->delete();
            $json['type'] = 'success';
            $json['message'] = trans('lang.location_deleted');
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
            $this->location::where('id', $id)->update([
           'top' => null
        ]);
            $json['type'] = 'success';
            $json['message'] = 'Top Location Delete Successfully';
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
            $this->location::where("id", $id)->delete();
            $this->location['id'] = $id;
            $result = $this->location->specialities()->detach();
            $this->location->users()->update([
           'location_id' => null,
           'area_id' => null,
        ]);
            $this->location->vaccinations()->update([
           'city' => null
        ]);
            //$this->location->where('parent', $id)->delete();
            $this->location->areas()->delete();

            }
            $json['type'] = 'success';
            $json['message'] = trans('lang.location_deleted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
    public function getChildLocations(Request $request){
        $childLocation = Location::where('parent', $request['id'])->get();
        $json = array();
        if (!empty($childLocation)){
            $json['child'] = $childLocation;
            $json['message'] = 'success';
        }
        else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
        }
        return $json;
    }
    public function doctorsLocation() {

        $user_ = User::where('id', Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];

        $doctorsData = User::role('doctor')->with('location','doc_teams','teams','onlines','roles','feedbacks')->with('profile',function ($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc')->where('available_days','!=',null)->where('wait_time','!=',null)->where('wait_time','!=',null);
            })->with('specialities',function ($q){
                return $q->select('title','slug','image');
            })->orderBy("trending","desc")->paginate(4);
            $all_doctors_count = $doctorsData->total();
            $doctors = $doctorsData->items();
 
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('location','area')->with('profile',function($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc','hospital_services');
            })->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('location','area')->with('profile',function ($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','faqs','total_experience','description');
            })->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->latest()->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->latest()->limit(4)->get();
        /*Locations*/
        $cities = Location::where('parent','0')->orderBy("created_at","asc")->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section','city_wise_doctor_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $faqs = Faq::where('page_url','doctors')->get();
        $segments = \Request::segments();
        return view('front-end.doctors-in-pakistan.index',
            compact(
                 'doctors', 'all_doctors_count', 'logged_user', 'laboratories', 'hospitals', 'faqs',
                'cities', 'services', 'diseases', 'specialities','segments','managements'
            ));
    }
    public function hospitalsLocation() {
        $user_ = User::where('id', Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];
       $doctors = User::role('doctor')->orderBy("trending","desc")->with('profile','specialities','location')->whereHas('profile')->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area','feedbacks','doc_teams','teams')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->limit(12)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->latest()->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->latest()->limit(4)->get();
        /*Locations*/
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        $cities_pakistan = Location::inRandomOrder()->limit(8)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section','city_wise_hospital_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $faqs = Faq::where('page_url','hospitals')->get();
        $segments = \Request::segments();
        return view('front-end.hospitals-in-pakistan.index',
            compact(
                 'doctors', 'managements',
                'logged_user', 'laboratories', 'hospitals', 'faqs',
                'cities', 'services', 'diseases', 'specialities','segments','cities_pakistan'
            ));
    }
    public function viewMoreHospital(Request $request,$show)
    {
        $showMore=$show;
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area','feedbacks','doc_teams','teams')->limit((int)$showMore)->get();
        return response()->json($hospitals);
    }
    public function getalllocations(){
        /*Location*/
           $cities = Location::where('parent', '0')->with('users')->with('specialities')->get();
        return response()->json($cities);
    }
}
