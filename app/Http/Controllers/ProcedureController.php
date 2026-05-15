<?php

namespace App\Http\Controllers;

use App\Disease;
use App\FaqAssign;
use App\Feedback;
use App\Procedure;
use App\Service;
use App\SiteManagement;
use App\Speciality;
use App\User;
use App\Location;
use App\Team;
use Illuminate\Support\Facades\Auth;
use View;
use Helper;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DOMDocument;

class ProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(Procedure $procedure)
    {
        $this->procedure = $procedure;
    }
    public function index(Request $request)
    {
        $all_procedures = Procedure::all();
        $procedure_top = Procedure::orderBy("id","desc")->where('top', '1')->get();
        $result = [];
        $all_data = User::with('roles')->get();
        $cities = Location::where('parent', '0')->get();
         foreach ($all_data as $key => $data) {
           // print_r($data->last_name);
          
            if (!($data->roles->isEmpty())) {
                if (($data->roles[0]->name =='doctor') || ($data->roles[0]->name =='hospital')) {
              
            }
            else{
                $all_data->forget($key);
            }
            }

           
            
        }
        $all_users = $all_data;
        foreach ($all_users as $key => $newdata) {
        $result[]  =   $newdata;
        }
        $procedures = Procedure::orderBy("id","desc")->with('users')->get();
       return view('back-end.admin.procedure.index',compact('result','procedures','all_procedures','procedure_top','cities'));
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
       $doctors = explode( ',',$request->doctor);
        $cities = explode( ',',$request->cities);   
        //dd($cities); 
            $this->validate(
                $request,
                [
                    'title' => 'required',
                    'fee' => 'required',
                     'doctor' => 'required'
                ],
                [
                    'title.required' => 'Enter Title!',
                    'fee.required' => 'Enter Fee!',
                    // 'doctor.required' => 'Please Enter at least one Doctor or Hospital!'
    ]
            );
            $this->procedure->saveProcedure($request);
            foreach ($doctors as $doctor){
                $this->procedure->users()->attach($doctor);
            }
            foreach ($cities as $city){
                $this->procedure->cities()->attach($city);
            }
            Session::flash('message','Procedure Created Successfully');  
            return Redirect::back();
       
    }
     public function store_procedures(Request $request)
    {

        if (!empty($request)) {
            $this->validate(
                $request,
                [
                    'procedures' => 'required'
                ],
                [
                    'procedures.required' => 'Enter at least one Procedure!'
                ]
            );
            $str_arr = explode (",", $request->procedures);
            foreach ($str_arr as $data){
                $top = DB::table('procedures')->where("id",$data)->update([
                    'top' => 1
                ]);
            }
            Session::flash('message','Add Top Procedures');
            return Redirect::back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function show(Procedure $procedure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function edit($procedure)
    {
           $result = [];
        $all_data = User::with('roles')->get();
        $cities = Location::where('parent', '0')->get();
         foreach ($all_data as $key => $data) {
            if (!($data->roles->isEmpty())) {
            if (($data->roles[0]->name =='doctor') || ($data->roles[0]->name =='hospital')) {
              
            }
            else{
                $all_data->forget($key);
            }
        }
            
        }
        $all_users = $all_data;
        foreach ($all_users as $key => $newdata) {
        $result[]  =   $newdata;
        }
        $procedure = Procedure::find($procedure);
        $newdetails = json_decode($procedure->details,true);
        $user_tags = $procedure->users()->get();
        $cities_tags = $procedure->cities()->get();
         return view('back-end.admin.procedure.edit',compact('result','procedure','user_tags','newdetails','cities','cities_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $procedure)
    {
        $doctors = explode( ',',$request->doctor);
        $cities = explode( ',',$request->cities);   
        $this->validate(
            $request,
            [
                'title' => 'required',
                'fee' => 'required',
                // 'doctor' => 'required'
            ]
        );
        $this->procedure->updateProcedure($request, $procedure);
        $this->procedure['id'] = $procedure;
        $this->procedure->users()->detach();
        foreach ($doctors as $doctor){
                $this->procedure->users()->attach($doctor);
            }
             $this->procedure->cities()->detach();
        foreach ($cities as $city){
                $this->procedure->cities()->attach($city);
            }
        Session::flash('message','Procedure Update Successfully');  
         return Redirect::to('admin/procedure');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Procedure  $procedure
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
            $procedure = $this->procedure::find($id);
            $this->procedure['id'] = $request['id'];
            $this->procedure->users()->detach();
            $this->procedure->cities()->detach();
            $this->procedure->feedbacks()->delete();
            $this->procedure->general_feedbacks()->delete();
            $this->procedure->faqs()->delete();
            Procedure::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Procedure Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
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
        if (!empty($checked)) {
            foreach ($checked as $id) {
                $this->procedure::where("id", $id)->delete();
                $this->procedure['id'] = $id;
                $this->procedure->users()->detach();
                $this->procedure->cities()->detach();
                $this->procedure->feedbacks()->delete();
                $this->procedure->general_feedbacks()->delete();
                $this->procedure->faqs()->delete();
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
            $this->procedure::where('id', $id)->update([
                'top' => null
            ]);
            $json['type'] = 'success';
            $json['message'] = ('Top Procedure Delete Successfully');
            return $json;
        }
        return $json;

    }


    public function getAllProcedures() { 
        $procedures = Procedure::with('users')->with('cities')->get();
        
        $speciality_id = Service::where('slug', 'bypass-surgery')->orWhere('slug','spinal-surgeon')->orWhere('slug','laser-eye-surgery')->orWhere('slug','breast-cancer-surgery')->limit(4)->pluck('speciality_id');

           
        $users_ids=DB::table('user_speciality')->whereIn('speciality_id',$speciality_id)->limit(4)->pluck('user_id');

       $doctors = User::role('doctor')->whereIn('id',$users_ids)->select('id','first_name','last_name','slug','email','location_id')->with('roles')->with('specialities','location','feedbacks','doc_teams','onlines','roles')
            ->with('profile',function($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
            })->limit(4)->get();
        $user_ = User::where('id', Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];
        // $doctors = User::role('doctor')->orderBy("trending","desc")->with('profile','doc_teams','specialities','location','feedbacks')->whereHas('profile')->limit(4)->get();
        $relatedService=[];
        $relatedDiseases=null;
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area','feedbacks','teams')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->limit(12)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->latest()->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->latest()->limit(4)->get();
        /*Locations*/
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        $cities_pakistan = Location::inRandomOrder()->limit(8)->get();
         $feedbacks = Feedback::where('type', 'procedure')->where('user_id', 'general')->with('patient')->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section','procedure_banner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        return view('front-end.procedures.index', compact(
            'procedures',
            'logged_user',
            'laboratories',
            'cities',
            'cities_pakistan',
            'services',
            'diseases',
            'specialities',
            'hospitals',
            'doctors',
            'feedbacks',
            'managements',
            'segments',
            'relatedDiseases',
            'relatedService',
        ));
    }
    public function getProcedureHospitals(Request $request,$spec_id,$procedure_id,$loc_id)
    {
        if($spec_id != null)
        {
          $user_ids=User::role('doctor')->where('location_id', $loc_id)->whereHas('specialities', function ($query) use ($spec_id) {
                    return $query->where('speciality_id', $spec_id);
                })->limit(6)->pluck('id');

        $doc_hospitals =Team::whereIn('doctor_id',$user_ids)->pluck('user_id')->toArray();
        
        $procedure_hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area','feedbacks','teams')->whereIn('id',$doc_hospitals)->get();   
        }
        else
        {
            $procedure_hospitals=[];
        }
        
        return response()->json($procedure_hospitals);

        
    }
    public function getProcedureDoctors(Request $request,$spec_id,$procedure_id,$loc_id)
    {
        if($spec_id != null)
        {
             $users_ids=User::role('doctor')->select('id')->where('location_id', $loc_id)->whereHas('specialities', function ($query) use ($spec_id) {
                    return $query->where('speciality_id', $spec_id);
                })->paginate(6);
        $user_ids=$users_ids->items();
        $procedure_doctors_total=$users_ids->total();
        $user_ids=$users_ids->pluck('id');

         $procedure_doctors = User::role('doctor')->whereIn('id',$user_ids)->select('id','first_name','last_name','slug','email','location_id')->with('roles')->with('specialities','location','feedbacks','doc_teams','onlines','roles')
            ->with('profile',function($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
            })->limit(6)->get();

        }
        else
        {
            $procedure_doctors=[];
            $procedure_doctors_total=[];
        }
         return response()->json([$procedure_doctors,$procedure_doctors_total]); 

      
    }
    public function showProcedure($location,$id) {
        $procedure = Procedure::where('slug', $id)->with('cities','faqsAssign')->with('users')->with('feedbacks')->with('faqs')->first();
        $speciality_id = Service::where('slug',$id)->pluck('speciality_id')->first();
        $speciality_data=Speciality::where('id',$speciality_id)->select('id')->with('diseases',function($q){
            return $q->take(12);
        })->with('related_services',function($q){
            return $q->take(12);
        })->first();
        if($speciality_data != null)
        {
          $relatedService=$speciality_data->related_services ? $speciality_data->related_services : [];
          $relatedDiseases=$speciality_data->diseases ? $speciality_data->diseases : [];  
        }
        else
        {
           $relatedService=[];
           $relatedDiseases=[]; 
           $speciality_id=$speciality_id ? $speciality_id : [];

        } 

        $location  =  Location::where('slug', $location)->first();
        $procedure_doctors=[];
        $procedure_hospitals=[];
        $user_ = User::where('id', Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];
        /*Hospital*/
         // $hosps_labs = User::role(['hospital','laboratory'])->select('id','first_name','last_name','location_id','slug','area_id')->with('location','roles')->with('profile',function($q){
         //         return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
         //     })->orderBy("trending","desc")->limit(12)->get();
         //     $hospitals=[];
         //     $laboratories=[];
         //     foreach($hosps_labs as $data)
         //     {
         //        if($data->roles[0]->name == 'hospital')
         //        {
         //            $hospitals[]=$data;
         //        }
         //        else
         //        {
         //            $laboratories[]=$data;
         //        }
         //     }
        // $hospitals = User::role('hospital')->with('location')->orderBy("trending","desc")->limit(6)->get();
         $hospitals = User::role('hospital')->select('id','first_name','last_name','location_id','slug','area_id')->with('location','roles')->with('profile',function($q){
                  return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
              })->orderBy("trending","desc")->limit(6)->get();

                $laboratories = User::role('laboratory')->select('id','first_name','last_name','location_id','slug','area_id')->with('location','roles')->with('profile',function($q){
                  return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
              })->orderBy("trending","desc")->limit(6)->get();

            /*Laboratory*/
         // $laboratories = User::role('laboratory')->with('location','profile')->orderBy("trending","desc")->limit(10)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        /*Locations*/
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        $cities_pakistan = [];
         $feedbacks = Feedback::where('type', 'procedure')->where('user_id', 'general')->with('patient')->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section','procedure_banner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        $procedureFAQs = $procedure->faqsAssign;
        if($procedureFAQs->count() > 0){
        $procedureFaqStructure = Helper::procedureFaqStructure($procedureFAQs);
        }
        $faqHtml = $procedure->faq_procedure;
$faqPairs = [];

if (!empty($faqHtml)) {   
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($faqHtml);
    libxml_clear_errors();

    $questions = $dom->getElementsByTagName('h3');
    
    foreach ($questions as $index => $question) {
        $answerNode = $question->nextSibling;
        $answerText = '';

        while ($answerNode && $answerNode->nodeName !== 'h3') {
            if ($answerNode->nodeName === 'p') {
                // Handle regular paragraphs
                $answerText .= $answerNode->textContent . "\n"; // Add a newline character after each paragraph
            } elseif ($answerNode->nodeName === 'ul') {
                // Handle unordered lists
                $liElements = $answerNode->getElementsByTagName('li');
                foreach ($liElements as $li) {
                    $answerText .= "\n• " . $li->textContent; // Add a newline character before the bullet point for each list item
                }
                $answerText .= "\n"; // Add an extra newline character after the list items
            }
            $answerNode = $answerNode->nextSibling;
        }

        // Add the question and answer to the FAQ pairs
        $faqPairs[] = [
            'question' => $question->textContent,
            'answer' => $answerText,
        ];
    }
}

        //  $faqHtml = $procedure->faq_procedure;
        //     $faqPairs = [];
        //  if (!empty($faqHtml)) {   
        //     $dom = new DOMDocument();
        //     libxml_use_internal_errors(true);
        //     $dom->loadHTML($faqHtml);
        //      libxml_clear_errors();
            
            
        //     // Extract question and answer pairs
        //     $questions = $dom->getElementsByTagName('h3');
        //     $answers = $dom->getElementsByTagName('p');

        //     foreach ($questions as $index => $question) {
        //         $answerNode = $answers[$index];
        //         $ulElements = $answerNode->getElementsByTagName('ul');
        //         if ($ulElements->length > 0) {
        //         $liElements = $ulElements[0]->getElementsByTagName('li');
        //         $answerText = '';
        //        foreach ($liElements as $li) {
        //         $answerText .= '<li>' . $li->textContent . '</li>';
        //     }
        // } else {
           
        //     $answerText = $answerNode->textContent;
        // }
        //         // $faqPairs[] = [
        //         //     'question' => $question->textContent,
        //         //     'answer' => $answers[$index]->textContent,
        //         // ];
        //     }
        //     }
        return view('front-end.procedures.show', compact(
            'speciality_id',
            'procedure',
            'procedure_doctors',
            'procedure_hospitals',
            'location',
            'logged_user',
            'laboratories',
            'cities',
            'cities_pakistan',
            'specialities',
            'hospitals',
            'managements',
            'segments',
            'relatedDiseases',
            'relatedService',
            'faqPairs'
            
        ));
    }
        public function Procedureslocation($location) {
            $procedures = Procedure::with('users')->with('cities')->get();
            $get_procedures = Location::where('slug', $location)->with('procedures')->first();
                $user_ = User::where('id', Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];
        $doctors = User::role('doctor')->orderBy("trending","desc")->with('profile','specialities','location','feedbacks')->whereHas('profile')->limit(4)->get();
        $relatedService=Location::where('slug',$location)->with('procedures')->latest()->limit(12)->get();
        $relatedDiseases=null;
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
        /*Locations*/
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(8)->get(); 
        $cities_pakistan = Location::inRandomOrder()->limit(8)->get();
         $feedbacks = Feedback::where('type', 'procedure')->where('user_id', 'general')->with('patient')->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section','procedure_banner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        return view('front-end.procedures.location', compact(
            'procedures',
            'get_procedures',
            'logged_user',
            'laboratories',
            'cities',
            'cities_pakistan',
            'services',
            'diseases',
            'specialities',
            'hospitals',
            'doctors',
            'feedbacks',
            'managements',
            'segments',
            'relatedDiseases',
            'relatedService',
        ));
    }
    public function submitFeedack(Request $request) {
        $json = Array();
        $feedback = new Feedback;
        $feedback->waiting_time = !empty($request['waiting_time']) ? $request['waiting_time'] : 0;
        $feedback->keep_anonymous = !empty($request['feedbackpublicly']) ? 'on' : 'off';
        $feedback->comment = filter_var($request['comments'], FILTER_SANITIZE_STRING);
        $time = $request['waitRating'];
        if ($time == 1) {
            $waitings = "15";
        }
        elseif ($time == 2){
            $waitings = "30";
        }
        elseif ($time == 3){
            $waitings = "45";
        }
        else {
            $waitings = "60";
        }
        $rating = Array();
        $rating['costRating'] = $request['costRating'];
        $rating['waitRating'] = $request['waitRating'];
        $rating['environmentRating'] = $request['environmentRating'];
        $rating['checkupRating'] = $request['checkupRating'];
        $rating['staffBehaviourRating'] = $request['staffBehaviourRating'];
        $avg_rating = ($request['costRating'] + $request['waitRating'] + $request['environmentRating']) / 3;

        $rating = json_encode($rating);
        $feedback->rating = $rating;
        $feedback->avg_rating = $avg_rating;
        $feedback->waiting_time = $waitings;
        $feedback->patient_id = Auth::user()->id;
        $feedback->user_id = $request['user_id'];
        $feedback->type = 'procedure';
        $result = $feedback->save();
        if ($result) {
            $json['type'] = 'success';
            $json['message'] = 'Feedback added successfully';
        }
        else {
            $json['type'] = 'error';
            $json['message'] = 'Feedback not submitted';
        }
        return $json;
    }


}
