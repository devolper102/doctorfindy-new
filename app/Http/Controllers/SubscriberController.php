<?php

namespace App\Http\Controllers;

use App\Disease;
use App\Location;
use App\Service;
use App\SiteManagement;
use App\Speciality;
use App\Subscriber;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
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
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section','procedure_banner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        return view('front-end.subscribe-now.index', compact(
            'logged_user', 'laboratories', 'cities', 'services', 'diseases',
            'specialities', 'hospitals', 'doctors', 'managements'
        ));
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
          $subscribers = Subscriber::where('email', $request['email'])->get();
        if (count($subscribers) > 0) {
            return response([
                'type' => 'erroe',
                'message' => 'You already subscribed'
            ]);
        }
        Subscriber::create([
            'email' => $request['email'],
        ]);
        return response([
            'type' => 'success',
            'message' => 'Email added to subscribers'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        //
    }

    public function subscribeNow(Request $request) {
        $subscribers = Subscriber::where('email', $request['email'])->get();
        if (count($subscribers) > 0) {
            return response([
                'type' => 'erroe',
                'message' => 'You already subscribed'
            ]);
        }
        Subscriber::create([
            'email' => $request['email'],
        ]);
        return response([
            'type' => 'success',
            'message' => 'Email added to subscribers'
        ]);
    }
}
