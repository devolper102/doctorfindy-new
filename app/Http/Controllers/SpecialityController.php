<?php

/**
 * Class SpecialityController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use App\Disease;
use App\Location;
use App\Imports\SpecialityImportClass;
use App\SiteManagement;
use App\User;
use FontLib\Table\Type\loca;
use Illuminate\Support\Facades\Auth;
use View;
use Session;
use App\Helper;
use App\Speciality;
use App\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Service;
use Maatwebsite\Excel\Facades\Excel;
/**
 * Class SpecialityController
 *
 */
class SpecialityController extends Controller
{
    /**
     * Defining scope of the variable
     *
     * @access public
     * @var    array $speciality
     */
    protected $speciality;

    /**
     * Create a new controller instance.
     *
     * @param instance $speciality instance
     *
     * @return void
     */
    public function __construct(Speciality $speciality)
    {
        $this->speciality = $speciality;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $specialitty = Speciality::all();
        $symptomes = Symptom::all();
        $speciality_top = Speciality::orderBy("id","desc")->where('top', '1')->get();

        $location = Location::where('parent',0)->get();
        $specialities = Speciality::get();
            return View::make(
                'back-end.admin.specialities.index',
                compact('specialities','location','specialitty','speciality_top','symptomes')
            );
        
    }
     public function uploadSpecialitiesContent()
    {
       return view('back-end.admin.specialities.uploadKnownAs');
    }
    public function specilitiesContentImport(Request $request)
    {
       $file=$request->file('file');
       $data = Excel::import(new SpecialityImportClass, request()->file('file'));
        return "file uploaded successfully";
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param mixed $request $req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->user_type);
        $locations = explode( ',',$request->location);
         $symptomes = explode( ',',$request->symptomes);
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        if (!empty($request)) {
            $this->validate(
                $request,
                [
                    'title' => 'required|string',
                    'user_type' => 'required',
                    'location' => 'required'
                ],
                [
                    'title.required' => 'Enter Specialty title!',
                    'title.string' => 'Enter title in string form',
                    'user_type.required' => 'Enter Specialty User Type!',
                    'location.required' => 'please Enter at least one location!'
    ]
            );
            $this->speciality->saveSpeciality($request);
            foreach ($locations as $location){
                $this->speciality->locations()->attach($location);
            }
            foreach ($symptomes as $symptome){
                $this->speciality->symptomes()->attach($symptome);
            }
            Session::flash('message', trans('lang.speciality_saved_success'));
            return Redirect::back();
        }
    }
    public function store_speciality(Request $request)
    {
        if (!empty($request)) {
            $this->validate(
                $request,
                [
                    'speciality' => 'required'
                ],
                [
                    'speciality.required' => 'please Enter at least one speciality!'
                ]
            );
            $str_arr = explode (",", $request->speciality);
            foreach ($str_arr as $data){
                $top = DB::table('specialities')->where("id",$data)->update([
                    'top' => 1
                ]);
            }
            Session::flash('message','Add Top Specialities');
            return Redirect::back();
        }
    }
    /**
     * Edit resource.
     *
     * @param int $slug integer
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $location = Location::all();
        $symptomes = Symptom::all();
        if (!empty($slug)) {
            $speciality = $this->speciality::where('slug', $slug)->first();
            $loc_tags = $speciality->locations()->get();
            $sym_tags = $speciality->symptomes()->get();
            if (!empty($speciality)) {
                if (file_exists(resource_path('views/extend/back-end/admin/specialities/edit.blade.php'))) {
                    return View::make('extend.back-end.admin.specialities.edit', compact('speciality', 'location', 'loc_tags','symptomes','sym_tags'));
                } else {
                    return View::make(
                        'back-end.admin.specialities.edit',
                        compact('speciality','location', 'loc_tags','symptomes','sym_tags')
                    );
                }
                return Redirect::to('admin/specialities');
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }


    /**
     * Update resource.
     *
     * @param string $request string
     * @param int    $id      int
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $locations = explode( ',',$request->location);
        $symptomes = explode( ',',$request->symptomes);
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $this->validate(
            $request,
            [
                'title' => 'required|string',
                // 'location' => 'required'
            ],
            [
                'title.required' => 'Enter Specialty title!',
                'title.string' => 'Enter title in string form',
                // 'location.required' => 'please Enter at least one location!'
            ]
        );
        $this->speciality->updateSpeciality($request, $id);
        $this->speciality['id'] = $id;
        // $this->speciality->locations()->detach();
        // foreach ($locations as $location){
        //     $this->speciality->locations()->attach($location);
        // }
         $this->speciality['id'] = $id;
        $this->speciality->symptomes()->detach();

        foreach ($symptomes as $symptome){
                $this->speciality->symptomes()->attach($symptome);
            }
        Session::flash('message', trans('lang.speciality_updated'));
        return Redirect::to('admin/specialities');
    }

    /**
     * Remove the specified resource from storage.
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
            $speciality = $this->speciality::find($id);
            if ($speciality->services->count() > 0) {
                foreach ($speciality->services as $key => $speciality_service) {
                    $service = Service::find($speciality_service->id);
                    if ($service->users->count() > 0) {
                        $service->users()->detach();
                    }
                    $service->delete();
                }
                
            }
            $this->speciality['id'] = $request['id'];
            $this->speciality->locations()->detach();
            $this->speciality['id'] = $request['id'];
            $this->speciality->symptomes()->detach();
            $this->speciality::where('id', $id)->delete();
            $this->speciality->faqsAssign()->delete();
            $this->speciality->services()->update([
           'speciality_id' => null
        ]);
            $this->speciality->tests()->update([
           'speciality_id' => null
        ]);
            $this->speciality->medicines()->update([
           'speciality_id' => null
        ]);
            $this->speciality->diagnoses()->update([
           'speciality_id' => null
        ]);
            $this->speciality['id'] = $request['id'];
            $this->speciality->users()->detach();
            $json['type'] = 'success';
            $json['message'] = trans('lang.speciality_deleted');
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
            $this->speciality::where('id', $id)->update([
           'top' => null
        ]);
            $json['type'] = 'success';
            $json['message'] = ('Top Speciality Delete Successfully');
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
        foreach ($checked as $id) {
            $this->speciality::where("id", $id)->delete();
            $this->speciality['id'] = $id;
            $this->speciality->locations()->detach();
               $this->speciality->faqsAssign()->delete();
            $this->speciality->services()->update([
           'speciality_id' => null
        ]);
            $this->speciality->tests()->update([
           'speciality_id' => null
        ]);
            $this->speciality->medicines()->update([
           'speciality_id' => null
        ]);
            $this->speciality->diagnoses()->update([
           'speciality_id' => null
        ]);
            $this->speciality['id'] =  $id;
            $this->speciality->users()->detach();
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

    /**
     * Get specialities
     *
     * @return \Illuminate\Http\Response
     */
    public function getSpecialities()
    {
        $json = array();
        $specialities = $this->speciality::all();
        if (!empty($specialities)) {
            $json['type'] = 'success';
            $json['specialities'] = $specialities;
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Get selected speciality service
     *
     * @param mixed $request request attributes
     * 
     * @return \Illuminate\Http\Response
     */
    public function getSpecialityService(Request $request)
    {
        $json = array();
        $speciality = $this->speciality::find($request['id']);
        $speciality->services->toArray();
        if (!empty($speciality)) {
            $json['type'] = 'success';
            $json['speciality'] = $speciality;
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Get selected speciality service
     *
     * @param mixed $request request attributes
     * 
     * @return \Illuminate\Http\Response
     */
    public function getServices(Request $request)
    {
        $json = array();
        $type = !empty($request['type']) && $request['type'] == 'slug' ? 'slug' : 'id';
        if ($type == 'slug') {
            $selected_speciality = speciality::select('id')->where('slug', $request['id'])
                ->first();
            $speciality = $this->speciality::find($selected_speciality->id);
        } else {
            $speciality = $this->speciality::find($request['id']);
        }
        if (!empty($speciality) && $speciality->services->count() > 0) {
            $services = $speciality->services->toArray();
            if (!empty($speciality)) {
                if (!empty($speciality)) {
                    $json['type'] = 'success';
                    $json['services'] = $services;
                    return $json;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.something_wrong');
                    return $json;
                }
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
    public function allSpecialties(){
        $user_ = User::where('id', Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];

      /*Specialities*/
       $specialities = Speciality::select('id','title','slug','image','trending')->where('top', '1')->orderBy("created_at","asc")->withCount('users')->limit(8)->get();
       $trending = $specialities->sortByDesc('trending')->first();

     $doctors = $trending->similarUsersWithRelations()->limit(4)->get();
     $doctors->load('specialities');
     // dd($doctors);
      // User::role('doctor')->select('id','first_name','last_name','slug','email','location_id','trending')
      //       ->with('specialities',function($q){
      //       return $q->take(3);
      //   })->with('profile',function($qu){
      //       return $qu->select('user_id','avatar','banner','address','longitude','latitude','votes','fees_range','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc')->whereNotNull('total_experience');
      //   })->with('location','area','feedbacks','doc_teams')->limit(4)->get(); 
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area','feedbacks','teams')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->limit(6)->get();
        $popularLab = User::role('laboratory')->with('profile','location','area')->limit(15)->get();
       
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->latest()->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->latest()->limit(4)->get();
        /*Locations*/
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(8)->get(); 
        $cities_pakistan = Location::inRandomOrder()->limit(8)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        return view('front-end.specialties.index', compact(
              'doctors', 'managements',
            'logged_user', 'laboratories','popularLab', 'hospitals', 'diseases',
            'cities', 'services', 'diseases', 'specialities', 'segments','cities_pakistan'
        ));
    }
    public function detail_page($slug){
        $locations = Location::all();
        $speciality = Speciality::where('slug',$slug)->with('locations')->first();
        $doctors = User::role('doctor')->with('diseases')->with('specialities')->with('location')->with('services')->with('profile')->with('location')->with('feedbacks')->with('doc_teams')->with('appointments')->with('roles')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->get();
        $hospitals = User::role('hospital')->with('diseases')->with('specialities')->with('location')->with('services')->with('profile')->with('location')->with('feedbacks')->with('doc_teams')->with('appointments')->with('roles')->get();
        $services = Service::with('symptoms')->with('speciality')->with('diseases')->get();
        return view('front-end.specialties.details',compact('speciality', 'doctors', 'locations','hospitals', 'service', 'services'));
    }
    public function getallspecialities(){
        /*Specialities*/
           $specialities = Speciality::withCount('users')->get();
        return response()->json($specialities);
    }

   // public function getSpecialitiesByCity($city) {
   
    // $location = Location::where('title', $city)->first();

    // if ($location) {
        
    //     $specialities = $location->specialities;

    //        $specialities->each(function ($speciality) use ($location) {
    //         $doctorCount = $speciality->users()
    //             ->where('location_id', $location->id)
    //             ->count();
    //         $speciality->doctor_count = $doctorCount;
    //     });

    //     return response()->json($specialities);
    // } else {
    //     return response()->json(['error' => 'City not found'], 404);
    // }
// }
// public function getSpecialitiesByCity($city) {
//     $city_id = Location::where('slug', $city)->first()->id;
//     // dd($city_id);
//     $specialitiesInCity = DB::table('specialities')
//         ->join('user_speciality', 'specialities.id', '=', 'user_speciality.speciality_id')
//         ->join('users', 'user_speciality.user_id', '=', 'users.id')
//         ->where('users.location_id', $city_id)
//         ->distinct()
//         ->pluck('specialities.title')
//         ->toArray();
//         // dd($specialitiesInCity);
//     $specialitiesWithDoctorCount = [];
    
    
//     foreach ($specialitiesInCity as $specialityName) {
//         $doctorCount = DB::table('specialities')
//             ->join('user_speciality', 'specialities.id', '=', 'user_speciality.speciality_id')
//             ->join('users', 'user_speciality.user_id', '=', 'users.id')
//             ->where('specialities.title', $specialityName)
//             ->where('users.location_id', $city_id)
//             ->count();
           
//         $specialitiesWithDoctorCount[] = [
//             'title' => $specialityName,
//             'doctor_count' => $doctorCount,
//         ];
//     }

//     return response()->json($specialitiesInCity);
// }

public function getSpecialitiesByCity($city) {
    $location = Location::where('title', $city)->first();

    if (!$location) {
        return response()->json([]);
    }
    $specialitiesInCity = Speciality::whereHas('users', function ($query) use ($location) {
        $query->where('location_id', $location->id);
    })->get();
    $result = [];    
    foreach ($specialitiesInCity as $speciality) {
        $doctorCount = $speciality->users()
            ->where('location_id', $location->id)
            ->count();        
        $result[] = [
            'slug' => $speciality->slug,
            'title' => $speciality->title,
            'user_count' => $doctorCount,
        ];
    }
    
    return response()->json($result);
}
    public function getAllDiseases(){
        $json = array();
        $diseases = Speciality::all();
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
    public function getAllDoctor (Request $request) {
        $doctors = User::role('doctor')->with('profile')->with('specialities')->with('services')->with('location')->with('feedbacks')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->get();
        $location = $request['location'];
        $specialty = $request['specialty'];
        return view('front-end.find-a-doctor.detail', compact('doctors', 'location', 'specialty'));
    }
    public function getAllHospital (Request $request) {
        $doctors = User::role('doctor')->with('profile')->with('specialities')->with('services')->with('location')->with('feedbacks')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->get();
        $location = $request['location'];
        $specialty = $request['specialty'];
        return view('front-end.find-a-doctor.detail', compact('doctors', 'location', 'specialty'));
    }

    public function getDataByArea (Request $request) {
        $doctors = User::role($request['role'])->with('profile')->with('specialities')->with('services')->with('location')->with('feedbacks')->get();
        $location = $request['location'];
        $area = $request['area'];
        dd($doctors, $location, $area);
        return view('front-end.find-a-doctor.detail', compact('doctors', 'location', 'specialty'));
    }
}
