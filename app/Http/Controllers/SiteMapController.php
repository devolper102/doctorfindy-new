<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Response;
use App\Location;
use App\Area;
use App\User;
use App\Speciality;
use App\Procedure;
use App\Article;

class SiteMapController extends Controller
{
    //
    public function index()
    {
        $content = View::make('front-end.sitemap.index');
        return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');
    }
    public function diseasesFunction() {
        $diseases = \App\Disease::orderBy("id", "desc")->take(50000)->get();
        $locations = \App\Location::orderBy("id", "desc")->take(50000)->get();
        $content = View::make('front-end.sitemap.diseases', ['diseases' => $diseases, 'locations' => $locations, ]);
        return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');

    }
    public function specialitiesFunction() {
        $specialities = \App\Speciality::orderBy("id", "desc")->take(50000)->get();

        // $locations = \App\Location::orderBy("id", "desc")->with('users')->whereHas('users')->take(50000)->get();
        $content = View::make('front-end.sitemap.specialities',
            ['specialities' => $specialities]);
        return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');

    }
    // public function specialitiesCitiesFunction(){
    //     $specialities = \App\Speciality::orderBy("id", "desc")->with('users')->whereHas('users')->get();
    //     $locations = \App\Location::orderBy("id", "desc")->with('users')->whereHas('users')->get();
    //      $content = View::make('front-end.sitemap.specialitiesCities',
    //         ['specialities' => $specialities, 'locations' => $locations]);
    //     return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');

    // }
    public function servicesFunction() {

        $services = \App\Service::orderBy("id", "desc")->take(50000)->get();
        $locations = \App\Location::orderBy("id", "desc")->take(50000)->get();
        $content = View::make('front-end.sitemap.services', ['services' => $services, 'locations' => $locations]);
        return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');

    }
    public function healthArticlesFunction() {
         // dd('ddfd');
        $articles = \App\Article::orderBy("id", "desc")->take(50000)->get();
        $content = View::make('front-end.sitemap.articles', ['articles' => $articles]);
        // dd($articles);
        return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');

    }
    public function doctorsFunction() {
        // $doctors = User::role('doctor')->with('speciality','specialities', 'location')->whereHas('location')->whereHas('speciality')->whereHas('profile')->get();
        $doctors = User::role('doctor')->with('speciality','specialities', 'location')->whereHas('speciality')->whereHas('location')->whereHas('profile')->get();

       /* $locations = \App\Location::orderBy("id", "desc")->take(50000)->get();
        $specialities = \App\Speciality::orderBy("id", "desc")->take(50000)->get();*/

        $content = View::make('front-end.sitemap.doctors', ['doctors' => $doctors]);
        return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');

    }
    public function doctorsCities() {
         $location_id = User::role('doctor')->distinct('location_id')->whereHas('profile')->pluck('location_id');
        $locations = Location::whereIn('id',$location_id)->orderBy("id", "desc")->get();

        $content = View::make('front-end.sitemap.doctorCities', ['locations' => $locations]);
        return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');

    }
     public function doctorsCitiesArea() {
         $location_id = User::role('doctor')->pluck('location_id')->unique();
         $area_id = User::role('doctor')->pluck('area_id')->unique();
        // $locations = User::role('doctor')->whereIn('location_id',$location_id)->with('location','doctorArea')->whereHas('doctorArea')->get();
        $areas=Area::whereIn('id',$area_id)->with('location')->get();
        // dd($areas);
        $content = View::make('front-end.sitemap.doctorCitiesArea', ['areas' => $areas]);
        return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');

    }
    public function hospitalsFunction() {

        $location_id = User::role('hospital')->distinct('location_id')->pluck('location_id');
        $locations = Location::whereIn('id',$location_id)->orderBy("id", "desc")->take(50000)->get();
        // $specialities = \App\Speciality::orderBy("id", "desc")->take(50000)->get();

        $content = View::make('front-end.sitemap.hospitals', ['locations' => $locations]);
        return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');

    }
    //   public function hospitalsCities(){
    //     $hospitals = User::role('hospital')->with('location')->whereHas('location')->limit(50000)->get();
    //     // $locations = \App\Location::orderBy("id", "desc")->with('users')->whereHas('users')->get();
    //      $content = View::make('front-end.sitemap.hospitalsCities',
    //         ['hospitals' => $hospitals]);
    //     return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');

    // }
    public function labortoriesFunction() {

        $labortories = User::role('laboratory')->with('location')->get();
        /*$locations = \App\Location::orderBy("id", "desc")->take(50000)->get();
        $specialities = \App\Speciality::orderBy("id", "desc")->take(50000)->get();*/

        $content = View::make('front-end.sitemap.labortories', ['labortories' => $labortories]);
        return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');

    }
    public function symptomsFunction() {
        $symptoms = \App\Symptom::orderBy("id", "desc")
            ->take(50000) // each Sitemap file must have no more than 50,000 URLs and must be no larger than 10MB
            ->get();

        $content = View::make('front-end.sitemap.symptoms', ['symptoms' => $symptoms]);
        return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');

    }
    public function testsFunction() {
         // $tests = \App\Speciality_Test::orderBy("id", "desc")->with('user')->take(50000)->get();
            $users = User::role('laboratory')->with('profile','location','labTest')->get();
             // dd($users);
        $content = View::make('front-end.sitemap.tests', ['users' => $users]);
        return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');

    }
    public function procedureFunction(){
        $procedures=Procedure::orderBy("id", "desc")->with('cities')->whereHas('cities')->take(50000)->get();
        // dd($procedures);
        $content = View::make('front-end.sitemap.surgeries', ['procedures' => $procedures]);
        return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');
    }
    // public function surgeriesCityFunction()
    // {
    //     $locations = Location::where('flag','!=','nodatayet')->orWhereNull('flag')->with('procedures')->whereHas('procedures')->get();
    //      $content = View::make('front-end.sitemap.surgeriesCities', ['locations' => $locations]);
    //     return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');
    // }

}
