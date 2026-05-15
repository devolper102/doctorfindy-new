<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Hash;
use App\Article;
use App\Disease;
use App\Feedback;
use App\Helper;
use App\Location;
use App\Service;
use App\SiteManagement;
use App\Speciality;
use DB;
use App\Procedure;
use App\Speciality_Test;

class ListingController extends Controller
{
    /**
     * Fetch Specialty wise Doctors
     *
     * @param string $slug specialty-slug
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getSpecialtyDoctors(Request $request) {
        // dd($slug);
                $slug = $request->query('specialty-slug');
                $speciality = Speciality::where('slug',$slug)->first();
                $user_ids = DB::table('user_speciality')->where('speciality_id',$speciality->id)->pluck('user_id')->toArray();
                $doctors = User::whereIn('id',$user_ids)->select('id','first_name','last_name','location_id','slug')->with('location','doc_teams','onlines','roles','feedbacks')->with('profile',function ($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
            })->with('specialities',function ($q){
                return $q->select('title','slug','image');
            })->paginate(10);
                // dd($doctors[5]->teams);
               $totalDoctorsCount = User::whereIn('id', $user_ids)->count();
                return response()->json([
                    "totalDoctorsCount" => $totalDoctorsCount,
                    "doctors" => $doctors,
                    "logo-path" => 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com/uploads/users/{user_id}/{filename.webp}',
                    "status" => "success",
                    "statusCode" => 200
                ],200);
        
    }
    /**
     * Fetch Specialty City wise Doctors
     *
     * @param string $slug specialty-slug
     *
     * @param string $location route parameter location
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getSpecialtyCityDoctors(Request $request) {
        // dd($slug);
                $slug = $request->query('specialty-slug');
                $location = request()->route()->parameters['location'];
                $location_id = Location::where('slug', $location)->with('areas',function ($q){
                    return $q->select('id','title','slug','location_id')->limit(15);
                    })->first();
                // dd($slug, $location, $location_id);
                $speciality = Speciality::where('slug',$slug)->first();
                $user_ids = DB::table('user_speciality')->where('speciality_id',$speciality->id)->pluck('user_id')->toArray();
                $doctors = User::role('doctor')->whereIn('id',$user_ids)->where('location_id',$location_id->id)->select('id','first_name','last_name','location_id','slug')->with('location','doc_teams','teams','onlines','roles','feedbacks')->with('profile',function ($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
            })->with('specialities',function ($q){
                return $q->select('title','slug','image');
            })->paginate(10);
                // dd($doctors[5]->teams);
               $totalDoctorsCount = User::whereIn('id', $user_ids)->where('location_id',$location_id->id)->count();
                return response()->json([
                    "totalDoctorsCount" => $totalDoctorsCount,
                    "doctors" => $doctors,
                    "logo-path" => 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com/uploads/users/{user_id}/{filename.webp}',
                    "status" => "success",
                    "statusCode" => 200
                ],200);
        
    }
    /**
     * Fetch City wise Doctors
     *
     *
     * @param string $locationSlug location-slug
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getCityWiseDoctors(Request $request) {
        // dd($slug);
                $locationSlug = $request->query('location-slug');
                $location_id = Location::where('slug', $locationSlug)->first();
                // dd($slug, $location, $location_id);
            //     $doctors = User::role('doctor')->where('location_id',$location_id->id)->select('id','first_name','last_name','location_id','slug')->with('location','doc_teams','teams','onlines','roles','feedbacks')->with('profile',function ($q){
            //     return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
            // })->with('specialities',function ($q){
            //     return $q->select('title','slug','image');
            // })->paginate(10);
            //     // dd($doctors[5]->teams);
            //    $totalDoctorsCount = User::role('doctor')->where('location_id',$location_id->id)->count();
                $doctors = User::role('doctor')->where('location_id',$location_id->id)->select('id','first_name','last_name','location_id','slug')->with([
                    'doc_teamms' => function($query) {
                        $query->select('user_id','doctor_id','slots','status','price'); 
                    },
                    'location' => function($query) {
                        $query->select('id','title','slug'); 
                    }
                ])->with('location','teams','onlines',)
                ->with('profile',function ($q){
                return $q->select('user_id','avatar','wait_time','total_experience');
            })->with('specialities',function ($q){
                return $q->select('title','slug','image');
            })->paginate(10);
            // dd($doctors);
                // dd($doctors[5]->teams);
               $totalDoctorsCount = User::role('doctor')->where('location_id',$location_id->id)->count();
               
                return response()->json([
                    "totalDoctorsCount" => $totalDoctorsCount,
                    "doctors" => $doctors,
                    "logo-path" => 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com/uploads/users/{user_id}/{filename.webp}',
                    "status" => "success",
                    "statusCode" => 200
                ],200);
        
    }
    public function getCityWiseOnlineDoctors(Request $request) {
        // dd($slug);
                $locationSlug = $request->query('location-slug');
                $location_id = Location::where('slug', $locationSlug)->first();
                // dd($slug, $location, $location_id);
            //     $doctors = User::role('doctor')->where('location_id',$location_id->id)->whereHas('profile', function ($query) {
            //             $query->where('willing_video', "on");
            //         })->select('id','first_name','last_name','location_id','slug')->with('location','doc_teams','teams','onlines','roles','feedbacks')->with('profile',function ($q){
            //     return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
            // })->with('specialities',function ($q){
            //     return $q->select('title','slug','image');
            // })->paginate(10);
                $doctors = User::role('doctor')->where('location_id',$location_id->id)->whereHas('profile', function ($query) {
                        $query->where('willing_video', "on");
                    })->select('id','first_name','last_name','location_id','slug')->with([
                    'doc_teamms' => function($query) {
                        $query->select('user_id','doctor_id','slots','status','price'); 
                    },
                    'location' => function($query) {
                        $query->select('id','title','slug'); 
                    }
                ])->with('location','teams','onlines',)
                    ->with('profile',function ($q){
                return $q->select('user_id','avatar','wait_time','total_experience');
            })->with('specialities',function ($q){
                return $q->select('title','slug','image');
            })->paginate(10);
                // dd($doctors);
               $totalDoctorsCount = User::role('doctor')->where('location_id',$location_id->id)->whereHas('profile', function ($query) {
        $query->where('willing_video', "on");
    })->count();
               // dd($totalDoctorsCount);
                return response()->json([
                    "totalDoctorsCount" => $totalDoctorsCount,
                    "doctors" => $doctors,
                    "logo-path" => 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com/uploads/users/{user_id}/{filename.webp}',
                    "status" => "success",
                    "statusCode" => 200
                ],200);
        
    }
    /**
     * Fetch Disease wise Doctors
     *
     * @param string $slug disease-slug
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getDiseaseDoctors(Request $request) {
                $slug = $request->query('disease-slug');
        // dd($slug);
               $disease=!empty($slug) ? Disease::where('slug',$slug)->with('faqsAssign')->with('users')->with('speciality',function ($q){
                return $q->select('id','title','slug','description');
                    })->first() : '';
               $speciality_id = Disease::where('slug',$disease->slug)->pluck('speciality_id')->first();
            


                $user_ids = DB::table('user_speciality')->where('speciality_id',$speciality_id)->pluck('user_id')->toArray();
                $doctors = User::role('doctor')->whereIn('id',$user_ids)->select('id','first_name','last_name','location_id','slug')->with('roles')->with('location','doc_teams','onlines','feedbacks')->with('profile',function ($query){
                    return $query->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
                    })->with('specialities')->paginate(10);
               $totalDoctorsCount = User::whereIn('id', $user_ids)->count();

                return response()->json([
                    "totalDoctorsCount" => $totalDoctorsCount,
                    "doctors" => $doctors,
                    "logo-path" => 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com/uploads/users/{user_id}/{filename.webp}',
                    "status" => "success",
                    "statusCode" => 200
                ],200);
        
    }
    /**
     * Fetch Disease City wise Doctors
     *
     * @param string $slug disease-slug
     *
     * @param string $location route parameter location
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getDiseaseCityDoctors(Request $request) {
                $slug = $request->query('disease-slug');
                $location = request()->route()->parameters['location'];
        // dd($slug);
               $disease=!empty($slug) ? Disease::where('slug',$slug)->with('faqsAssign')->with('speciality',function ($q){
                return $q->select('id','title','slug','description');
                })->first() : '';

              $location_data=Location::where('slug',$location)->select('id','title','slug')->first();
              $speciality_id = Disease::where('slug',$disease->slug)->pluck('speciality_id')->first();
                
                $user_ids = DB::table('user_speciality')->where('speciality_id',$speciality_id)->pluck('user_id')->toArray();

            $doctors = User::role('doctor')->whereIn('id',$user_ids)->where('location_id',$location_data->id)->select('id','first_name','last_name','location_id','slug')->with('roles')->with('location','doc_teams','onlines','feedbacks')->with('profile',function ($query){
                  return $query->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
             })->with('specialities')->limit(10)->get();
               $totalDoctorsCount = User::whereIn('id', $user_ids)->where('location_id',$location_data->id)->count();
                return response()->json([
                    "totalDoctorsCount" => $totalDoctorsCount,
                    "doctors" => $doctors,
                    "logo-path" => 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com/uploads/users/{user_id}/{filename.webp}',
                    "status" => "success",
                    "statusCode" => 200
                ],200);
        
    }
    /**
     * Fetch Treatment wise Doctors
     *
     * @param string $slug treatment-slug
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getTreatmentDoctors(Request $request) {
                $service = $request->query('treatment-slug');
                $speciality_id = Service::where('slug',$service)->pluck('speciality_id')->first();
        // dd($service);
            $service=!empty($service) ? Service::where('slug',$service)->select('id','slug','title','speciality_id','description')->with('speciality',function ($q){
                return $q->select('id','title','slug');
            })->with('users')->with('faqsAssign')->first() : '';
             

            $user_ids = DB::table('user_speciality')->where('speciality_id',$speciality_id)->pluck('user_id')->toArray();
             $doctors = User::role('doctor')->whereIn('id',$user_ids)->select('id','first_name','last_name','location_id','slug')->with('roles')->with('location','doc_teams','teams','onlines','feedbacks')->with('profile',function ($query){
                  return $query->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
             })->with('specialities')->paginate(10);
               $totalDoctorsCount = User::whereIn('id', $user_ids)->count();
                return response()->json([
                    "totalDoctorsCount" => $totalDoctorsCount,
                    "doctors" => $doctors,
                    "logo-path" => 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com/uploads/users/{user_id}/{filename.webp}',
                    "status" => "success",
                    "statusCode" => 200
                ],200);
        
    }
    /**
     * Fetch Treatment City wise Doctors
     *
     * @param string $slug treatment-slug
     * 
     * @param string $location route parameter location
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getTreatmentCityDoctors(Request $request) {
                $service = $request->query('treatment-slug');
                $location = request()->route()->parameters['location'];
                $speciality_id = Service::where('slug',$service)->pluck('speciality_id')->first();
                $location=!empty($location) ? Location::where('slug',$location)->select('id','title','slug')->first()  : '';
                $location_id=$location->id;
                $service=!empty($service) ? Service::where('slug',$service)->select('id','slug','title','speciality_id','description')->with('speciality',function ($q){
                return $q->select('id','title','slug');
            })->with('users')->with('faqsAssign')->first() : '';
             

            $user_ids = DB::table('user_speciality')->where('speciality_id',$speciality_id)->pluck('user_id')->toArray();
             $doctors = User::role('doctor')->whereIn('id',$user_ids)->select('id','first_name','last_name','location_id','slug')->with('roles')->with('location','doc_teams','teams','onlines','feedbacks')->where('location_id', $location_id)->with('profile',function ($query){
                  return $query->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
             })->with('specialities')->paginate(10);   
               $totalDoctorsCount = User::whereIn('id', $user_ids)->where('location_id',$location_id)->count();
                return response()->json([
                    "totalDoctorsCount" => $totalDoctorsCount,
                    "doctors" => $doctors,
                    "logo-path" => 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com/uploads/users/{user_id}/{filename.webp}',
                    "status" => "success",
                    "statusCode" => 200
                ],200);
        
    }
    /**
     * Fetch Surgery City wise Doctors
     *
     * @param string $slug surgery-slug
     * 
     * @param string $location route parameter location
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getSurgeryCityDoctors(Request $request) {
            // dd($request->all());
                $slug = $request->query('surgery-slug');
                $location = request()->route()->parameters['location'];
                $loc_id = Location::where('slug', $location)->pluck('id')->first();
                $speciality_id = Service::where('slug',$slug)->pluck('speciality_id')->first();
                $user_ids=User::role('doctor')->where('location_id', $loc_id)->whereHas('specialities', function ($query) use ($speciality_id) {
                    return $query->where('speciality_id', $speciality_id);
                })->pluck('id')->toArray();
                // dd($speciality_id, $user_ids);
                $doctors = User::role('doctor')->whereIn('id',$user_ids)->select('id','first_name','last_name','slug','email','location_id')->with('roles')->with('specialities','location','feedbacks','doc_teams','onlines','roles')
            ->with('profile',function($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
            })->paginate(10);
               $totalDoctorsCount = count($user_ids);
               // dd($totalDoctorsCount);
                return response()->json([
                    "totalDoctorsCount" => $totalDoctorsCount,
                    "doctors" => $doctors,
                    "logo-path" => 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com/uploads/users/{user_id}/{filename.webp}',
                    "status" => "success",
                    "statusCode" => 200
                ],200);
        
    }
    /**
     * Fetch Surgeries, Treatments, Specialties and Diseases
     *
     * 
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getTopSpecialtiesTreatmentsSurgeriesDiseases(){
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image','top','trending','app_image')->where('top', '1')->orderBy("created_at","asc")->paginate(10); 
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag','trending')->paginate(10);
        /*Services*/
        $treatments = Service::select('id','title', 'slug','image','trending')->paginate(10);
        $surgeries = Procedure::where('top', '1')->with('cities')->orderBy("created_at","asc")->paginate(10);
        return response()->json([
                    "specialities" => $specialities,
                    "diseases" => $diseases,
                    "treatments" => $treatments,
                    "surgeries" => $surgeries,
                    "status" => "success",
                    "statusCode" => 200
                ],200);
    }
    /**
     * Fetch Specialty by city with Doctor Count
     * 
     * 
     * @param string $location route parameter location
     *
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getSearchSpecialtiesByCity(Request $request) {
    $locationSlug = request()->route()->parameters['location'];
    $location = Location::where('slug', $locationSlug)->first();

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
            'doctor_count' => $doctorCount,
        ];
    }

    return response()->json([
                    "specialities" => $result,
                    "status" => "success",
                    "statusCode" => 200
                ],200);
    }
    /**
     * Book a lab Test
     * 
     * Fetch all top labs with tests
     *
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function bookLabTestPage(){
        // $labs = User::role('laboratory')->with('location','area','roles')->with('LabTest',function($q){
        //         return $q->take(10);
        //     })->with('profile',function ($q){
        //         return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','faqs','total_experience','description','online_report_url');
        //     })->with('feedbacks',function($q){
        //         return $q->take(10);
        //     })->with('branches',function($q){
        //         return $q->take(10);
        //     })->paginate(10);
        $labs = User::role('laboratory')->select('id','first_name','last_name','slug','email','location_id','user_discount_percentage','verification_code')->with('LabTest',function($q){
                return $q->take(10);
            })->with('profile',function ($q){
                return $q->select('user_id','avatar','online_report_url');
            })->withCount('branches')
           ->paginate(10);
            // dd($labs);
        $tests = Speciality_Test::paginate(10);
        return response()->json([
                    "labs" => $labs,
                    "tests" => $tests,
                    "status" => "success",
                    "statusCode" => 200
                ],200);
    }
    /**
     * Fetch Specialty by city with Doctor Count
     * 
     * 
     * @param string $slug lab-slug
     *
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function labAvailableTests(Request $request){
        $slug = $request->query('lab-slug');
        $lab_id = User::where('slug', $slug)->pluck('id')->first();
        $tests = Speciality_Test::where('lab_id', $lab_id)->paginate(10);
        return response()->json([
                    "tests" => $tests,
                    "status" => "success",
                    "statusCode" => 200
                ],200);
    }
    /**
     * Main Search For Doctor
      * Hospital, lab, Specialty, Treatment, surgery
       *and disease
     * 
     * 
     * @param string $search_query query
     * @param string $location location
     *
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getSearch(Request $request){
        // dd($request->all());
        $search_query= $request['query'];
        $location= $request['location'];
        $location =Location::where('slug','like','%'.$location.'%')->select('id')->first();
        // $doctors = User::role('doctor')->with('profile','location','specialities')->whereHas('profile')->WhereRaw("concat(first_name, ' ', last_name) like '%".$search_query."%' ")->where('location_id',$location->id)->take(8)->get();
        $doctors = User::role('doctor')->select('id','first_name','last_name','slug','email','location_id')->with([
        'profile' => function($query) {
            $query->select('user_id','avatar'); 
        },
        'location' => function($query) {
            $query->select('id','title','slug'); 
        }
    ])->whereHas('profile')->WhereRaw("concat(first_name, ' ', last_name) like '%".$search_query."%' ")->where('location_id',$location->id)->take(8)->get();
        $hospitals = User::role('hospital')->with('profile','location','area')->WhereRaw("concat(first_name, ' ', last_name) like '%".$search_query."%' ")->where('location_id',$location->id)->take(10)->get();
        $laboratories = User::role('laboratory')->select('id','first_name','last_name','slug','email','location_id')->with([
        'profile' => function($query) {
            $query->select('user_id','avatar'); 
        },
        'location' => function($query) {
            $query->select('id','title','slug'); 
        }
    ])->WhereRaw("concat(first_name, ' ', last_name) like '%".$search_query."%' ")->where('location_id',$location->id)->take(10)->get();
        $specialities = Speciality::Where("title",'like',"%".$search_query."%")->select('title', 'slug', 'image', 'id','app_image')->take(10)->get();
        foreach ($specialities as $speciality) {
        $doctorCount = $speciality->users()
            ->where('location_id', $location->id)
            ->count();    
        $speciality->doctor_count = $doctorCount;
}
        $services = Service::Where("title",'like',"%".$search_query."%")->select('title', 'slug', 'image', 'id')->take(10)->get();
        $diseases = Disease::Where("title",'like',"%".$search_query."%")->select('title', 'slug', 'flag', 'id')->take(10)->get();
        $surgeries = Procedure::Where("title",'like',"%".$search_query."%")->select('title', 'slug', 'image', 'id')->take(10)->get();
        return response()->json([
                    'doctors'=>$doctors,
                    'hospitals'=>$hospitals,
                    'laboratories'=>$laboratories,
                    'specialities'=>$specialities,
                    'treatments'=>$services,
                    "surgeries" => $surgeries,
                    'diseases'=>$diseases,
                    "status" => "success",
                    "statusCode" => 200
                ],200);
    }
    /**
     * Fetch City wise Doctors
     *
     *
     * @param string $locationSlug location-slug
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getCityWiseLabs(Request $request) {
                $locationSlug = $request->query('location-slug');
        // dd($locationSlug);
                $location=Location::where('slug',$locationSlug)->first();
                // dd($slug, $location, $location_id);
            //     $labs = User::role('laboratory')->where('location_id', $location->id)->with('location','area','feedbacks','roles')->with('profile',function ($q){
            //     return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','faqs','total_experience','description');
            // })->with('branches',function($q){
            //     return $q->take(10);
            // })->whereHas('labTest',function($query){
            //     return $query->select('id','lab_id')->take(1);
            // })->paginate(10);
                $labs = User::role('laboratory')->select('id','first_name','last_name','slug','email','location_id','user_discount_percentage','verification_code')->where('location_id', $location->id)->whereHas('labTest',function($query){
                return $query->select('id','lab_id')->take(1);
            })->with('profile',function ($q){
                return $q->select('user_id','avatar');
            })->withCount('branches')->with('branches',function($q){
                return $q->take(10);})
                ->paginate(10);
                // dd($doctors[5]->teams);
               $totalLabsCount = User::role('laboratory')->where('location_id', $location->id)->count();
               
                return response()->json([
                    "totalLabsCount" => $totalLabsCount,
                    "labs" => $labs,
                    "logo-path" => 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com/uploads/users/{user_id}/{filename.webp}',
                    "status" => "success",
                    "statusCode" => 200
                ],200);
        
    }
    /**
     * Search For Lab Tests
     * 
     * 
     * @param string $search_query query
     *
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function searchLabTests(Request $request){
        $search_query= $request['query'];
        $labId= $request['lab_id'];
        // dd($search_query);
        $tests = Speciality_Test::where('lab_id', $labId)->where('title', 'LIKE','%'.$search_query.'%')->paginate(10);
        
        return response()->json([
                    'tests'=>$tests,
                    "status" => "success",
                    "statusCode" => 200
                ],200);
    }
}
