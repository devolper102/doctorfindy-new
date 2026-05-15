<?php

namespace App\Http\Controllers;

use App\Article;
use App\Disease;
use App\Feedback;
use App\Helper;
use App\Location;
use App\Service;
use App\SiteManagement;
use App\Speciality;
use App\User;
use App\Symptom;
use DB;
use App\Procedure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//     public function __construct()
//     {
// //        $this->middleware('auth');
//     }
 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    $meta_values = [
        'header_service', 'show_headertabs', 'topbar_settings', 'general_settings', 'download_app_sec', 
        'home_slider', 'socials', 'footer_settings', 'subscribe_now_sec', 'home_doctor_sec', 
        'home_search_banner', 'small_devices_top_section'
    ];
     $doctors = [];
    // Cache meta values for a day
    $managements = Cache::remember('site_managements', 86400, function () use ($meta_values) {
        return SiteManagement::whereIn('meta_key', $meta_values)->get();
    });

    $hospitals = Cache::remember('hospitals', 86400, function () {
        return User::role('hospital')
            ->select('id', 'first_name', 'last_name', 'slug', 'email', 'location_id', 'area_id', 'user_discount_percentage')
            ->with([
                'location',
                'area',
                'profile' => function($q) {
                    return $q->select(
                        'user_id', 'avatar', 'banner', 'address', 'longitude', 'latitude', 'votes', 
                        'available_days', 'working_time', 'created_at', 'updated_at', 'total_experience', 
                        'description', 'experiences', 'memberships', 'educations', 'awards', 'gender', 
                        'sub_heading', 'wait_time', 'short_desc'
                    );
                }
            ])
            ->orderBy("trending", "desc")
            ->limit(6)
            ->get();
    });

    $laboratories = Cache::remember('laboratories', 86400, function () {
        return User::role('laboratory')
            ->whereIn('id', [13052, 13057, 13417, 13084, 13374, 13081])
            ->select('id', 'first_name', 'last_name', 'slug', 'email', 'location_id', 'area_id', 'user_discount_percentage')
            ->with([
                'location',
                'area',
                'profile' => function($q) {
                    return $q->select(
                        'user_id', 'avatar', 'banner', 'address', 'longitude', 'latitude', 'votes', 
                        'available_days', 'working_time', 'created_at', 'updated_at', 'total_experience', 
                        'description', 'experiences', 'memberships', 'educations', 'awards', 'gender', 
                        'sub_heading', 'wait_time', 'short_desc'
                    );
                }
            ])
            ->limit(6)
            ->get();
    });

    $specialities = Cache::remember('specialities', 86400, function () {
        return Speciality::select('id', 'title', 'slug', 'image', 'top', 'trending')
            ->where('top', '1')
            ->orderBy("created_at", "asc")
            ->limit(8)
            ->get();
    });

    $diseases = Cache::remember('diseases', 86400, function () {
        return Disease::select('id', 'title', 'slug', 'flag', 'trending')
            ->latest()
            ->limit(4)
            ->get();
    });

    $services = Cache::remember('services', 86400, function () {
        return Service::select('id', 'title', 'slug', 'image', 'trending')
            ->latest()
            ->limit(4)
            ->get();
    });

    $cities = Cache::remember('cities', 86400, function () {
        return Location::with('specialities')
            ->orderBy("created_at", "asc")
            ->get();
    });

    $articles = Cache::remember('articles', 86400, function () {
        return Article::where('is_featured', '1')
            ->with('author', 'categories')
            ->latest()
            ->take(4)
            ->get();
    });

    $feedbacks = Cache::remember('feedbacks', 86400, function () {
        return Feedback::with('patient')
            ->where('approval', '1')
            ->orderBy("created_at", "asc")
            ->limit(3)
            ->get();
    });

    $procedures = []; // Assuming this is empty for now

    $user = Cache::remember('logged_user', 3600, function () {
        return Auth::check() ? User::where('id', Auth::id())->with('profile', 'roles')->first() : [];
    });
    $logged_user = $user ? $user : [];
    return view('front-end.index', compact(
        'specialities', 'services', 'cities', 'diseases', 'doctors', 'hospitals', 
        'laboratories', 'articles', 'feedbacks', 'procedures', 'managements', 'logged_user'
    ));
}
    // public function index()
    // {
    //     $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','home_doctor_sec','home_search_banner','small_devices_top_section'];
        
    //     // dd($meta_values);
    //     /*Doctors*/
    //     $doctors = [];
       
    //     $hospitals = User::role('hospital')->select('id','first_name','last_name','slug','email','location_id','area_id','user_discount_percentage')->with('location','area')->with('profile',function($q){
    //             return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
    //         })->orderBy("trending","desc")->limit(6)->get();
       
    //     $laboratories = User::role('laboratory')->whereIn('id',[13052, 13057, 13417, 13084, 13374, 13081])->select('id','first_name','last_name','slug','email','location_id','area_id','user_discount_percentage')->with('location','area')->with('profile',function($q){
    //             return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
    //         })->limit(6)->get();
    //     /*Specialities*/
    //     $specialities = Speciality::select('id','title','slug','image','top','trending')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get(); 
    //     /*Diseases*/
    //     $diseases = Disease::select('id','title', 'slug','flag','trending')->latest()->limit(4)->get();
    //     /*Services*/
    //     $services = Service::select('id','title', 'slug','image','trending')->latest()->limit(4)->get();
    //     /*Locations*/
    //     $cities = Location::with('specialities')->orderBy("created_at","asc")->get();
    //     /*Blogs Section*/
    //     $articles = Article::where('is_featured', '1')->with('author','categories')->orderBy("created_at","desc")->latest()->take(4)->get();
    //     /*Feedbacks*/
    //     $feedbacks = Feedback::with('patient')->where('approval', '1')->orderBy("created_at","asc")->limit(3)->get();
    //     /*All Procedure*/
    //     $procedures = [];
    //     $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        
    //     $user = User::where('id', Auth::id() ? Auth::id() : '')->with('profile','roles')->first();
    //     $logged_user = $user ? $user : [];
    //     // dd($logged_user);
    //     return view (
    //         'front-end.index',
    //         compact('specialities', 'services', 'cities', 'diseases', 'doctors', 'hospitals', 'laboratories',
    //             'articles', 'feedbacks','procedures','managements', 'logged_user'
    //         )
    //     );
    // }
    public function getLabDiscountData()
    {
        $laboratories = User::role('laboratory')->with('profile','location','area')->limit(6)->get();
        return response()->json($laboratories);
    }
    public function getSymptomsData()
    {
        $symptom = Symptom::limit(11)->with('tests',function($query){
            $query->take(1);
        })->get();
        return response()->json($symptom);
    }
    public function getHeaderDefaultData()
    // {
    {
        // $cities = Location::where('top',1)->where('slug','lahore')->orWhere('slug','karachi')->orWhere('slug','islamabad')->orderBy("created_at","asc")->limit(3)->get();
        $cities = Location::where('top',1)->whereIn('slug', ['lahore', 'karachi', 'islamabad'])->orderBy("created_at","asc")->limit(3)->get();
        $hospitalsCities=[];
        foreach($cities as $city)
        {
            $hospitalsCities[]=User::role('hospital')->where('location_id',$city->id)->limit(8)->with('location')->get();
        }
        // $procedures = Procedure::where('top', '1')->with('cities')->orderBy("created_at","asc")->limit(8)->get();
        // $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area')->limit(8)->get();
        $diseases = Disease::select('id','title', 'slug','flag','trending')->limit(8)->get();
        $hospitals = User::role('hospital')->orderBy("trending","desc")->select('id','first_name','last_name','slug','email','location_id','area_id')->with([
            'profile' => function ($query) {
                $query->select('id','user_id', 'avatar', 'experiences'); 
            },
            'location' => function ($query) {
                $query->select('id','title', 'slug','flag'); 
            },
            'area' => function ($query) {
                $query->select('id','location_id', 'title', 'slug'); 
            }
        ])->limit(8)->get();
        // dd($hospitals);
        return response()->json([$hospitalsCities,$hospitals]);
    }
    public function getSpec()
    {
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image','top','trending')->orderBy("created_at","asc")->get();
        return response()->json($specialities);
    }
    public function getDocs()
    {
        /*Doctors*/
        $doctors = User::role('doctor')->with('profile','specialities','location')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->get();
        return response()->json($doctors);
    } 

    public function getHosp()
    {
        /*Hospitals*/
        $hospitals = User::role('hospital')->with('profile','location','area')->latest()->get();
        return response()->json($hospitals);
    }

    public function getDise()
    {
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag','trending')->latest()->get();
        return response()->json($diseases);
    }

    public function getLabs()
    {
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->latest()->get();
        return response()->json($laboratories);
    }

    public function getServices()
    {
        /*Services*/
        $services = Service::select('id','title', 'slug','image','trending')->latest()->get();
        return response()->json($services);
    }

     public function getCities()
    {
        /*Cities*/
        $cities = Location::where('parent','0')->with('specialities')->orderBy("created_at","asc")->get();
        return response()->json($cities);
    }
    // public function appLinkSend(Request $request) {
    //     $json = array();
    //     $text = 'https://play.google.com/store/apps?hl=en'.' '.'https://www.apple.com/ios/app-store/';
    //     $random_string = Str::random(32);
    //     Http::get('http://api.itelservices.com/send.php', [
    //         'transaction_id' => $random_string,
    //         'user' => env('DAY_WISE_SMS_USER'),
    //         'pass' => env('DAY_WISE_SMS_PASS'),
    //         'number' => $request['id'],
    //         'text' => $text,
    //         'from' => env('DAY_WISE_SMS_SENDER_ID'),
    //         'type' => 'sms'
    //     ]);
    //     $json['result'] = 'success';
    //     $json['message'] = 'Message Sent Successfully';

    //     return $json;
    // }
}
