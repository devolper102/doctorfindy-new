<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Article;
use App\Disease;
use App\Faq;
use App\FaqAssign;
use App\Feedback;
use App\Location;
use App\OnlineConsultation;
use App\Service;
use App\SiteManagement;
use App\Speciality;
use App\Symptom;
use App\User;
use App\VideoBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlineConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_ = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];

        $doctors = User::role('doctor')->orderBy("trending","desc")->with('profile','specialities','location','feedbacks')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area','feedbacks','teams')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->latest()->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->latest()->limit(4)->get();
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();  
        $articles = Article::with('author')->with('categories')->latest()->limit(3)->get();
        $reviews = Feedback::where('approval', '1')->with('user')->with('patient')->with('feedbacks')->get();
        $allfaqs = Faq::where('page_url','online-doctor-video-consultation-in-pakistan')->get();
        $allpatients = User::role('patient')->count();
        $alldoctor = User::role('doctor')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->count();
        $allspecialities = Speciality::count();
        $consultations = Appointment::where('type', 'online')->count();
        $blogs = VideoBlog::orderBy("id","desc")->limit(3)->get();
        $segments = \Request::segments();
        return View(
            'front-end.online-consultation.index',
            compact(
                'specialities', 'logged_user', 'laboratories', 'cities', 'services', 'diseases',
                'specialities', 'hospitals', 'doctors', 'managements', 'articles', 'reviews','allspecialities','allpatients','alldoctor', 'consultations','articles','blogs','segments','allfaqs'
            )
        );

    }

    public function getAllarticles()
    {
        $articles = Article::with('author')->with('categories')->get();
        return response()->json($articles);
    }

        public function getAllblogs()
    {
        $blogs = VideoBlog::orderBy("id","desc")->get();
        return response()->json($blogs);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OnlineConsultation  $onlineConsultation
     * @return \Illuminate\Http\Response
     */
    public function show(OnlineConsultation $onlineConsultation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OnlineConsultation  $onlineConsultation
     * @return \Illuminate\Http\Response
     */
    public function edit(OnlineConsultation $onlineConsultation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OnlineConsultation  $onlineConsultation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OnlineConsultation $onlineConsultation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OnlineConsultation  $onlineConsultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(OnlineConsultation $onlineConsultation)
    {
        //
    }
}
