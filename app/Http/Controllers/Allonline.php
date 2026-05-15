<?php

namespace App\Http\Controllers;

use View;
use Session;
use App\Helper;
use App\Speciality;
use App\Feedback;
use App\User;
use App\OnlineConsultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Service;
use App\Team;
use App\UserMeta;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;



class Allonline extends Controller
{
    //
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
    public function index (Request $request)
    {   
        if($request->ajax())
        {
               $users_id= OnlineConsultation::latest()->skip(20*$request->clickCount)->take(40)->pluck('doctor_id');
               $users = User::role('doctor')->whereIn('id',$users_id)->latest()->with('profile','userMeta')
             ->with('specialities')->with('feedbacks')->with('location','area')
                 ->with('orderMeta')->with('onlines')->whereHas('profile')->whereHas('onlines')->get();

            $count =$request->clickCount+1;
            return response()->json([$users,$count]);
        }
        // dd($users_id);
        /*Request for all services*/
        // $special = Service::with('users')->paginate(5);
        $users_id= OnlineConsultation::latest()->take(40)->pluck('doctor_id');
        $role = request()->segment(count(request()->segments()));
        $users = User::role('doctor')->whereIn('id',$users_id)->latest()->with('profile','userMeta')
             ->with('specialities')->with('feedbacks')->with('location','area')
                 ->with('orderMeta')->with('onlines')->whereHas('profile')->whereHas('onlines')->take(40)->get();
        // dd($users[0]);
        // $users_counts = ();
        // $specialities = Helper::getDoctorsFromArray($special);
       
            return View::make(
                'back-end.admin.all-online.index',
                compact('role','users')
            );
       
    
    }
    public function searchAllOnlineDoctor(Request $request)
    {
        $user_ids=User::role('doctor')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->orWhere('email','like','%'.$request->search.'%')->limit(40)->pluck('id');
        $onlineDoc=OnlineConsultation::whereIn('doctor_id',$user_ids)->pluck('doctor_id');
        $users = User::role('doctor')->whereIn('id',$onlineDoc)->latest()->with('profile')->with('specialities')->with('location')->with('onlines')->get();


        // dd($users);
        return response()->json($users);
    }

    public function moredoc($request)
    {

        /*If request for view more doc*/
        $special = Service::with('users')->where('id', $request)->get();
        /*Get doctors from all users array*/
        $specialities = Helper::getDoctorsFromArray($special);

        return View::make(
                'back-end.admin.all-online.view-more',
                compact('specialities')
            );
        


    }
    public function doctors(Request $request)
    { 
        if($request->ajax())
        {
          $users = User::role('doctor')->where('phone_number','!=',null)->where('status','=','register')->orwhere('status','=','1')->select('id','first_name','last_name','email','phone_number','slug','status','location_id','area_id','created_at','updated_at')->with('profile')->with('specialities')->with('location')->with('area')->with('doc_teams')->latest()->skip(20*$request->clickCount)->limit(40)->get(); 
          $count =$request->clickCount+1;
            return response()->json([$users,$count]);
        }
         $users = User::role('doctor')->where('phone_number','!=',null)->where('status','=','register')->orwhere('status','=','1')->select('id','first_name','last_name','email','phone_number','slug','status','location_id','area_id','created_at','updated_at')->with('profile')->with('specialities')->with('location')->with('area')->with('doc_teams')->latest()->limit(40)->get();
         
            return View::make(
                'back-end.admin.all-doctors.index',
                compact('users')
            );
    }
    public function registeredAllDocSearch(Request $request)
    {
        $users = User::role('doctor')->where('phone_number','!=',null)->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->orWhere('email','like','%'.$request->search.'%')->where('status','=','register')->orwhere('status','=','1')->select('id','first_name','last_name','email','phone_number','location_id','area_id','status','slug','created_at','updated_at')->with('profile')->with('specialities')->with('location','area')->latest()->limit(40)->get();
       return response()->json($users);
    }

     public function allNewDoctors(Request $request)
    {
        if($request->ajax())
        {
          $users = User::role('doctor')->where('phone_number','!=',null)->where('status',null)->orWhere('status','=','pending')->orWhere('status','=','0')->select('id','first_name','last_name','email','phone_number','slug','location_id','area_id','status','recommend_status','created_at','updated_at','approve')->with('profile')->with('specialities')->with('location','area')->latest()->skip(20*$request->clickCount)->limit(40)->get();
          $count =$request->clickCount+1;
            return response()->json([$users,$count]);
        }   
         $users = User::role('doctor')->where('phone_number','!=',null)->where('status',null)->orWhere('status','=','pending')->orWhere('status','=','0')->select('id','first_name','last_name','email','phone_number','slug','location_id','area_id','status','recommend_status','created_at','updated_at','approve')->with('profile')->with('specialities')->with('location','area')->latest()->limit(40)->get();
        $role_based_users = $users;
        $role = "doctor";
      return view('back-end.admin.users.newDoctors', compact('role','role_based_users'));
    }
    public function adminApproveDoctors(Request $request)
    {
        if($request->type == 'all-new-doctors')
        {
            $user_id=$request->id;
            $user=User::where('id',$user_id)->first();
            if($request->selected === 'approve')
            {
                $user->approve='approved';
            }
            else
            {
                $user->approve='not-approved';
            }

            $user->update();
            $users = User::role('doctor')->where('phone_number','!=',null)->where('status',null)->orWhere('status','=','pending')->orWhere('status','=','0')->select('id','first_name','last_name','email','phone_number','slug','location_id','area_id','status','recommend_status','created_at','updated_at','approve')->with('profile')->with('specialities')->with('location','area')->latest()->limit(40)->get();

        }
        return response()->json($users);
    }
    public function adminApproveAllDoctors(Request $request)
    {
         $users = User::role('doctor')->where('approve','!=','approved')->with('specialities')->with('location')->whereHas('specialities')->whereHas('location')->where('approve','!=','approved')->latest()->limit(100)->pluck('id');
         $count=count($users);
         if($count == 0)
         {
           dd("Updated all doctors");
         }
         else
         {
            foreach ($users as $key => $id) {
            $user=User::where('id',$id)->first();
            $user->approve='approved';
            $user->update();
            
            }
         }

         
        dd("Successfully approved doctors");
    }
    public function allNewDoctorsSearch(Request $request)
    {
       $users = User::role('doctor')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->orWhere('email','like','%'.$request->search.'%')->where('phone_number','!=',null)->where('status',null)->orWhere('status','=','pending')->orWhere('status','=','0')->select('id','first_name','last_name','email','phone_number','location_id','area_id','status','recommend_status','slug','created_at','updated_at','approve')->with('profile')->with('specialities')->with('location','area')->latest()->limit(40)->get();
       return response()->json($users);
    }
    public function allBlockedDoctors(Request $request)
    {
        if($request->ajax())
        {
           $users= User::role('doctor')->where('status','=','block')->select('id','first_name','last_name','email','phone_number','assistant_phone_number','slug','location_id','area_id','status','recommend_status','created_at','updated_at')->with('specialities')->with('location','area')->latest()->skip(20*$request->clickCount)->limit(40)->get(); 

           $count =$request->clickCount+1;
            return response()->json([$users,$count]);

        }
        $users= User::role('doctor')->where('status','block')->select('id','first_name','last_name','email','phone_number','assistant_phone_number','slug','location_id','area_id','status','recommend_status','created_at','updated_at')->with('specialities')->with('location','area')->latest()->limit(40)->get();
        // dd($users);
        return View::make(
                'back-end.admin.all-doctors.all-blocked',
                compact('users')
            );
    }
    public function allRegisteredDoctorsInfo(Request $request)
    {
         if($request->ajax())
        {
          $users = User::role('doctor')->where('phone_number','!=',null)->where('status','=','register')->orwhere('status','=','1')->select('id','first_name','last_name','email','phone_number','slug','status','location_id','area_id','created_at','updated_at')->with('profile')->with('specialities')->with('location')->with('area')->with('doc_teams')->latest()->skip(20*$request->clickCount)->limit(40)->get(); 
          $count =$request->clickCount+1;
            return response()->json([$users,$count]);
        }
         $users = User::role('doctor')->where('phone_number','!=',null)->where('status','=','register')->orwhere('status','=','1')->select('id','first_name','last_name','email','phone_number','slug','status','location_id','area_id','created_at','updated_at')->with('profile')->with('specialities')->with('location')->with('area')->with('doc_teams')->latest()->limit(40)->get();
         
            return View::make(
                'back-end.admin.all-doctor-registered-info.index',
                compact('users')
            );
    }
    public function extendDoctors(Request $request)
    {
        if($request->ajax())
        {
           $users = User::role('doctor')->where('phone_number','!=',null)->where('recommend_status','=','recommend')->where('status','=','register')->orWhere('status','=','1')->select('id','first_name','last_name','email','phone_number','assistant_phone_number','slug','location_id','area_id','status','recommend_status','created_at','updated_at')->with('profile')->with('specialities')->with('location','area')->latest()->skip(20*$request->clickCount)->limit(40)->get();

           $count =$request->clickCount+1;
            return response()->json([$users,$count]);

        }
        $users = User::role('doctor')->where('phone_number','!=',null)->where('recommend_status','=','recommend')->where('status','=','register')->orWhere('status','=','1')->select('id','first_name','last_name','email','phone_number','assistant_phone_number','slug','location_id','area_id','status','recommend_status','created_at','updated_at')->with('profile')->with('specialities')->with('location','area')->latest()->limit(40)->get();
        // dd($users);
//         $doctors = User::role('doctor')->with('profile')->with('appointments')->with('feedbacks')->with('answers')->with('question')->with('answers')->whereHas('profile', function ($query) {
//     return $query->where('verify_registration', '=', 1);
// })->select('*');
//         $doctors = $doctors->get();

//         /*Count docs having feedbacks / review using helper function*/
//         $countFeed = Helper::getCountFeedbacks($doctors);

//         /*Get count for doctors complete profile*/
//         $extended = Helper::getExtended($doctors);

//         /*Get count for doctors without schedular and video*/
//         $without = Helper::withoutVS($doctors);

//         /*Get count for doctors without schedular and video*/
//         $withoutVSA = Helper::withoutVSA($doctors);

//         /*Get count for doctors mark as red*/
//         $markRed = Helper::markRed($doctors);

//         /*Get count for doctors With vedio schedular Appt*/
//         $withVSA = Helper::withVSA($doctors);

            return View::make(
                'back-end.admin.all-extend.index',
                compact('users')
            );
            // return View::make(
            //     'back-end.admin.all-extend.index',
            //     compact('doctors','countFeed','extended','without','withoutVSA','markRed','withVSA')
            // );
    }
    public function onBoardDoctors(Request $request)
    {
        if($request->ajax())
        {

        $users = User::role('doctor')->where('on_board','=','on-board')->where('phone_number','!=',null)->where('status','=','register')->orWhere('status','=','1')->select('id','first_name','last_name','email','phone_number','slug','location_id','area_id','status','recommend_status','created_at','updated_at')->with('profile')->with('userMeta',function ($q){
                return $q->select('user_id','avatar','commission');
            })->with('specialities')->with('location','area')->latest()->skip(20*$request->clickCount)->get();

            $count =$request->clickCount+1;
            return response()->json([$users,$count]);  
        }
        $users = User::role('doctor')->where('on_board','=','on-board')->where('phone_number','!=',null)->where('status','=','register')->orWhere('status','=','1')->select('id','first_name','last_name','email','phone_number','slug','location_id','area_id','status','recommend_status','created_at','updated_at')->with('profile')->with('userMeta',function ($q){
                return $q->select('user_id','avatar','commission');
            })->with('specialities')->with('location','area')->latest()->get();
        // dd($users);
        return View::make(
                'back-end.admin.all-doctors.on-board-doctors',
                compact('users')
            );

    }
    public function onBoardDoctorsSearch(Request $request)
    {
       $users = User::role('doctor')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->orWhere('email','like','%'.$request->search.'%')->where('on_board','=','on-board')->where('phone_number','!=',null)->where('status','=','register')->orWhere('status','=','1')->select('id','first_name','last_name','email','phone_number','slug','location_id','area_id','status','recommend_status','created_at','updated_at')->with('profile')->with('userMeta',function ($q){
                return $q->select('user_id','avatar','commission');
            })->with('specialities')->with('location','area')->limit(40)->latest()->get();
       return response()->json($users);

    }
    public function changeStatusOnboard()
    {
        $users_id=UserMeta::where('commission','>',0)->pluck('user_id');
        foreach ($users_id as $key => $id) {
            $user=User::where('id',$id)->first();
            $user->on_board='on-board';
            $user->update();
            dd('Sucessfully status changed');
        }
    }
}
