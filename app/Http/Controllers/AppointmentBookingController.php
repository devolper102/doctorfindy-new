<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Disease;
use App\Location;
use App\Speciality;
use App\User;
use App\Area;
use App\Team;
use Carbon\Carbon;
use View;
use Helper;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentBookingController extends Controller
{
    //
    public function callAppointmentBooking (Request $request)
    {
        // dd($request->all());
        if ($request['phone_number']) {
            if (strlen($request['phone_number']) >11) {
                $request['phone_number'] = str_replace('92','0',$request['phone_number']);
                $user = User::where('phone_number', $request['phone_number'])->first();
            }
            elseif (strlen($request['phone_number']) < 11) {
                $request['phone_number'] = '0'.$request['phone_number'];
                $user = User::where('phone_number', $request['phone_number'])->first();
            }
            else {
                $user = User::where('phone_number', $request['phone_number'])->first();
            }
             if ($user === null) {
            $user = User::create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'verification_code' => strtoupper('msnsoft'),
                'slug' => filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['last_name'], FILTER_SANITIZE_STRING),
                'password' => password_hash('doctorfindy.com', PASSWORD_DEFAULT),
                'phone_number' => $request['phone_number'],
            ]);
        }
           $role = DB::table('roles')->select('name')->where('role_type', 'patient')->first();
        $user->assignRole($role->name);
        $request->patient_id = $user->id;
        }
        if ($request['added_hospital_num']) {
             if (strlen($request['added_hospital_num']) >11) {
                $request['added_hospital_num'] = str_replace('92','0',$request['added_hospital_num']);
                $hospital = User::role('hospital')->where('phone_number', $request['added_hospital_num'])->first();
            }
            elseif (strlen($request['added_hospital_num']) < 11) {
                $request['added_hospital_num'] = '0'.$request['added_hospital_num'];
                $hospital = User::role('hospital')->where('phone_number', $request['added_hospital_num'])->first();
            }
            else {
                $hospital = User::role('hospital')->where('phone_number', $request['added_hospital_num'])->first();
            }
             if ($hospital === null) {
            $hospital = User::create([
                'first_name' => $request['added_hospital_fname'],
                'last_name' => $request['added_hospital_lname'],
                'verification_code' => strtoupper('msnsoft'),
                'slug' => filter_var($request['added_hospital_fname'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['added_hospital_lname'], FILTER_SANITIZE_STRING),
                'password' => password_hash('doctorfindy.com', PASSWORD_DEFAULT),
                'phone_number' => $request['added_hospital_num'],
            ]);
        $hospital_role = DB::table('roles')->select('name')->where('role_type', 'hospital')->first();
        $hospital->assignRole($hospital_role->name);

        }
        }
       
        if($request->has('added_appointment_datetime'))
        {
          $datetime = $request->added_appointment_datetime;
            $date_arr= explode(" ", $datetime);
            $added_date= $date_arr[0];
            $added_time= $date_arr[1]." ".$date_arr[2];  
        }
        
        
        $app = new Appointment;
        $app->user_id = $request->user_id;
        if($request['added_hospital_num'])
        {
           $app->hospital_id = $hospital->id;
        }
        else
        {
           $app->hospital_id = $request->hospital;
        }
        $app->patient_id = $request->patient_id;
        $app->patient_name = $request->first_name.' '.$request->last_name;
        $app->comments = $request->comments;
        if($request['appointment']['day']!=='undefined')
        {
          $app->appointment_time = $request['appointment']['day'];
        }
        else
        {
            $app->appointment_time=$added_time;
        }
         if($request['appointment']['date']!=='undefined')
        {
          $app->appointment_date = $request['appointment']['date'];
        }
        else
        {
            $app->appointment_date=$added_date;
        }
        // $app->appointment_date = $request['appointment']['date'];
        $app->status = 'pending';
        $app->type = $request->type;
        $app->follow_up = $request->follow_up;
        $app->booked = $request->booked;
        $app->booked_by= 'call-center';
        $app->direct_booking = $request->direct_booking;
        $app->notes = $request->notes;
        if($request['added_hospital_fee'])
        {
           $app->charges = $request['added_hospital_fee'];
        }
        else
        {
           $app->charges = $request->charges;
        }
        // dd($app);
        $app->save();
        $current = Carbon::now();
        $notification= DB::table('appointment_notification')->insert([
        [
            'user_id'          => $request->user_id,
            'patient_id'       => $request->patient_id,
            'appointment_id'   => $app->id,
            'status'           => 'unread',
            'to_display'       => 'doctor',
            'admin_alert'      => 'unread',
            'created_at'       => $current,
            'updated_at'       => $current
        ]
    ]);
        $patient = User::where('phone_number', $request['phone_number'])->with('appointments_patient')->first();
        $json['type'] = 'success';
        $json['patient'] = $patient;
        return $json;
    }

    public function onlineAppointmentBooking () {

        $doctors = User::role('doctor')->with('diseases')->with('specialities')->with('location')->with('services')->with('profile')->with('location')->with('feedbacks')->with('doc_teams')->with('teams')->with('appointments')->with('roles')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->get();
        $hospitals = User::role('hospital')->with('diseases')->with('specialities')->with('location')->with('services')->with('profile')->with('location')->with('feedbacks')->with('doc_teams')->with('teams')->with('appointments')->with('roles')->get();
        $specialities = Speciality::where('top',1)->get();
        $diseases = Disease::all();
        $locations = Location::all();
        return view('back-end.csr.bookings.onlineBookingConsultation', compact('doctors', 'hospitals', 'specialities', 'diseases', 'locations'));
    }
    public function visit_appointment(Request $request){
        if($request->ajax())
        {
           $appointments = Appointment::where('type','visit')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->skip(20*$request->clickCount)->take(40)->get();
           $count =$request->clickCount+1;
           return response()->json([$appointments,$count]);
        }
        else
        {
           $appointments = Appointment::where('type','visit')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->take(40)->get();
        return view('back-end.admin.appointment-booking-system.visit_appointment',compact('appointments')); 
        }
        
    }
    public function appointmentNotifications(Request $request)
    {
        if($request->ajax())
        {
            $appointments_id=DB::table('appointment_notification')->where('admin_alert','=','unread')->orWhere('admin_alert','=','notification-send')->latest()->skip(20*$request->clickCount)->take(40)->pluck('appointment_id');

           $appointments=Appointment::whereIn('id',$appointments_id)->where('type','visit')->select('id','user_id','hospital_id','patient_id','appointment_date','appointment_time','charges','status','type','booked_by','created_at','updated_at')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->take(40)->get();

            $count =$request->clickCount+1;
           return response()->json([$appointments,$count]);
        }
        $appointments_id=DB::table('appointment_notification')->where('admin_alert','=','unread')->orWhere('admin_alert','=','notification-send')->latest()->limit(40)->pluck('appointment_id');

        $appointments=Appointment::whereIn('id',$appointments_id)->where('type','visit')->select('id','user_id','hospital_id','patient_id','appointment_date','appointment_time','charges','status','type','booked_by','created_at','updated_at')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->take(40)->get();

        return view('back-end.admin.appointment-booking-system.appointment-notifications',compact('appointments'));

    }
    public function adminMarkAppointmentNotification(Request $request)
    {

        if($request->selected === 'read')
        {
            DB::table('appointment_notification')->where('appointment_id',$request->id)->update(['admin_alert'=>'read']);
        }
        else
        {
           DB::table('appointment_notification')->where('appointment_id',$request->id)->update(['admin_alert'=>'notification-send']);

        }
        $appointments_id=DB::table('appointment_notification')->where('admin_alert','=','unread')->orWhere('admin_alert','=','notification-send')->latest()->limit(40)->pluck('appointment_id');
        
        $appointments=Appointment::whereIn('id',$appointments_id)->select('id','user_id','hospital_id','patient_id','appointment_date','appointment_time','charges','status','type','booked_by','created_at','updated_at')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->take(40)->get();
        return response()->json($appointments);

    }
    public function editAppointmentDetails($id)
    {
        if(!empty($id))
        {
            $appointment=Appointment::where('id',$id)->with('hospital_profile')->first();
            return view('back-end.admin.appointment-booking-system.edit-appointment-detail',compact('appointment'));
        }
    }
    public function updateAppointmentDetails(Request $request,$id)
    {
        $appointment=Appointment::where('id',$id)->first();
        $user=User::role('hospital')->where('id',$appointment->hospital_id)->select('id','phone_number')->first();
        if(!empty($user))
        {
           $hospital = $user;
           if($hospital->phone_number === null)
           {
             $hospital->phone_number=$request['hospital_number'];
             $hospital->update();
           }
        }
        else
        {
            if ($request['hospital_number']) {
             if (strlen($request['hospital_number']) >11) {
                $request['hospital_number'] = str_replace('92','0',$request['hospital_number']);
                $hospital = User::role('hospital')->where('phone_number', $request['hospital_number'])->first();
            }
            elseif (strlen($request['hospital_number']) < 11) {
                $request['hospital_number'] = '0'.$request['hospital_number'];
                $hospital = User::role('hospital')->where('phone_number', $request['hospital_number'])->first();
            }
            else {
                $hospital = User::role('hospital')->where('phone_number', $request['hospital_number'])->first();
            }
             if ($hospital === null) {
            $hospital = User::create([
                'first_name' => $request['hospital_first_name'],
                'last_name' => $request['Hospital_last_name'],
                'verification_code' => strtoupper('msnsoft'),
                'slug' => filter_var($request['hospital_first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['Hospital_last_name'], FILTER_SANITIZE_STRING),
                'password' => password_hash('doctorfindy.com', PASSWORD_DEFAULT),
                'phone_number' => $request['hospital_number'],
            ]);
        $hospital_role = DB::table('roles')->select('name')->where('role_type', 'hospital')->first();
        $hospital->assignRole($hospital_role->name);

        }
        }
        }

          
        if($request['appointment_date'])
        {
          $datetime = $request->appointment_date;
          $str_date = str_replace('T', ' ', $request->appointment_date);
            $date_arr= explode(" ", $str_date);

            $added_date= $date_arr[0];
            $added_time= $date_arr[1];  
            $appointment_time=date("h:i a", strtotime($added_time));
            $appointment->appointment_time=$appointment_time;
            $appointment->appointment_date=$added_date;
        }
        
        
        if($request['hospital_number'])
        {
           $appointment->hospital_id = $hospital->id;
        }

        
        $appointment->status = 'pending';
        $appointment->booked_by= 'call-center';
        $appointment->charges = $request['hospital_fee'];
       
        $appointment->update();

        return redirect('admin/visit-appointment')->with('message',"This appointment Successfully Updated");
          
    }
    public function updateConsultaionFee(Request $request){
       
     $fee = $request->consultation_fee;
    $team = Team::find($request->id);
    $slotsArray = json_decode($team->slots, true); // Decode JSON to associative array
    // dd($slotsArray);
    // Update consultation fee inside the slots array for each day
    if (isset($slotsArray['consultation_fee'])) {
        $slotsArray['consultation_fee'] = $fee;
    }

    // Update consultation fee for each day
    foreach ($slotsArray as $day => &$data) {
        if (is_array($data) && isset($data['consultation_fee'])) {
            $data['consultation_fee'] = $fee;
        }
    }
    $updatedSlotsJson = json_encode($slotsArray);

    // Update the slots attribute of the team
    $team->slots = $updatedSlotsJson;
    $team->save();
    return back()->with('message', 'Consultation Fee Successfully Updated');
    }
    public function changeAppointmentStatus(Request $request)
    {
        $appointment=Appointment::where('id',$request->id)->first();
        $appointment->status=$request->selected;
        $appointment->update();
        if($request->type === 'visit-appointment')
        {
           $appointments = Appointment::where('type','visit')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->take(40)->get(); 
        }
        elseif($request->type === 'pending-appointment') {
            $appointments = Appointment::where('status', 'pending')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
            
        }
        elseif($request->type === 'accepted-appointment') {
            $appointments = Appointment::where('status', 'accepted')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
            
        }
        elseif($request->type === 'cancel-appointment')
        {
            $appointments = Appointment::where('status', 'cancel')->with('doctor_profile', 'hospital_profile', 'patient_profile')->whereIn('patient_id',$users)->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
        }
        else
        {
            $appointments = Appointment::with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->take(40)->get();
        }

        
        return response()->json($appointments);
    }
    public function searchVisitAppointment(Request $request)
    {
        $option=$request->selected;
        if($request->ajax())
        {
            if($option === 'search-by-hospital')
            {
                $users=User::role('hospital')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->latest()->limit(40)->pluck('id');

                $appointments=Appointment::where('type','visit')->with('doctor_profile','hospital_profile','patient_profile')->whereIn('hospital_id',$users)->orderBy('appointment_date', 'desc')->get();
            }
            elseif($option === 'search-by-doctor')
            {
               $users=User::role('doctor')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->latest()->limit(40)->pluck('id');

                $appointments=Appointment::where('type','visit')->with('doctor_profile','hospital_profile','patient_profile')->whereIn('user_id',$users)->orderBy('appointment_date', 'desc')->get();
            }
            else
            {
                if($option==='search-by-patient')
                {
                      $users=User::role('patient')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->orWhere('email','like','%'.$request->search.'%')->with('appointments_patient')->whereHas('appointments_patient')->latest()->get();
                    $appointments=[];
                    $count=0;
                   foreach($users as $user)
                   {
                     foreach($user->appointments_patient as $appointment)
                     {
                        if(!empty($appointment))
                        {
                          $appointments[$count++]=$appointment;
                        }
                     }
                   }
                }
            }
            
           return response()->json([$appointments,$option]);
        }
        
    }
    
    public function delete_visit(Request $request)
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
          Appointment::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Visit Apointment Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
    public function all_appointment(Request $request){
        if($request->ajax())
        {
            if($request->type==='all-appointment')
            {
              $appointments = Appointment::with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->skip(20*$request->clickCount)->take(40)->get();
              $count =$request->clickCount+1;
              return response()->json([$appointments,$count]);

            }
           
        }
        else
        {
            $appointments = Appointment::with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->take(40)->get();
        $locations = Location::get();
        return view('back-end.admin.appointment-booking-system.all_appointment',compact('appointments','locations'));

        }
        
    }
    public function searchAllAppointment(Request $request){
        // dd($value);
        $type=$request->type;
        $option=$request->selected;
        if($request->ajax())
        {
            if($type === 'pending-appointment')
            {
                if($option === 'search-by-hospital')
                {
                    $users=User::role('hospital')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->latest()->limit(40)->pluck('id');

                    $appointments = Appointment::where('status', 'pending')->whereIn('hospital_id',$users)->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
                    
                }
                elseif($option === 'search-by-doctor')
                {
                    $users=User::role('doctor')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->latest()->limit(40)->pluck('id');

                    $appointments = Appointment::where('status', 'pending')->whereIn('user_id',$users)->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
                   
                }
                else
                {
                    $users=User::role('patient')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->latest()->limit(40)->pluck('id');

                    $appointments = Appointment::where('status', 'pending')->whereIn('patient_id',$users)->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
                }

              
            }
            elseif($type === 'accepted-appointment')
            {
                 if($option === 'search-by-hospital')
                {
                    $users=User::role('hospital')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->latest()->limit(40)->pluck('id');

                    $appointments = Appointment::where('status', 'accepted')->with('doctor_profile', 'hospital_profile', 'patient_profile')->whereIn('hospital_id',$users)->orderBy('appointment_date', 'desc')->get();
                    
                }
                elseif($option === 'search-by-doctor')
                {
                    $users=User::role('doctor')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->latest()->limit(40)->pluck('id');

                    $appointments = Appointment::where('status', 'accepted')->with('doctor_profile', 'hospital_profile', 'patient_profile')->whereIn('user_id',$users)->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
                   
                }
                else
                {
                    $users=User::role('patient')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->latest()->limit(40)->pluck('id');

                      $appointments = Appointment::where('status', 'accepted')->with('doctor_profile', 'hospital_profile', 'patient_profile')->whereIn('patient_id',$users)->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
                    
                }

            }
            elseif($type === 'cancel-appointment')
            {
                 if($option === 'search-by-hospital')
                {
                    $users=User::role('hospital')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->latest()->limit(40)->pluck('id');

                    $appointments = Appointment::where('status', 'cancel')->with('doctor_profile', 'hospital_profile', 'patient_profile')->whereIn('hospital_id',$users)->orderBy('appointment_date', 'desc')->get();
                    
                }
                elseif($option === 'search-by-doctor')
                {
                    $users=User::role('doctor')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->latest()->limit(40)->pluck('id');

                    $appointments = Appointment::where('status', 'cancel')->with('doctor_profile', 'hospital_profile', 'patient_profile')->whereIn('user_id',$users)->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
                   
                }
                else
                {
                    $users=User::role('patient')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->latest()->limit(40)->pluck('id');

                    $appointments = Appointment::where('status', 'cancel')->with('doctor_profile', 'hospital_profile', 'patient_profile')->whereIn('patient_id',$users)->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
                    
                }

            }
            else
            {
                if($option === 'search-by-hospital')
                {
                    $users=User::role('hospital')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->latest()->limit(40)->pluck('id');

                    $appointments=Appointment::with('doctor_profile','hospital_profile','patient_profile')->whereIn('hospital_id',$users)->orderBy('appointment_date', 'desc')->get();
                }
                elseif($option === 'search-by-doctor')
                {
                   $users=User::role('doctor')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->latest()->limit(40)->pluck('id');

                    $appointments=Appointment::with('doctor_profile','hospital_profile','patient_profile')->whereIn('user_id',$users)->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
                }
                else
                {
                    if($option==='search-by-patient')
                    {
                          $users=User::role('patient')->where('first_name','like','%'.$request->search.'%')->orWhere('last_name','like','%'.$request->search.'%')->orWhere('email','like','%'.$request->search.'%')->with('appointments_patient')->whereHas('appointments_patient')->latest()->limit(40)->pluck('id');
                          $appointments=Appointment::with('doctor_profile','hospital_profile','patient_profile')->whereIn('patient_id',$users)->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
                       
                    }
                }

        }
            
            
            
           return response()->json([$appointments,$option]);
        }
        
    }

    public function pending_appointment(Request $request){
           if($request->ajax())
        {
            if($request->type==='pending-appointment')
            {
                 $appointments = Appointment::where('status', 'pending')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->skip(20*$request->clickCount)->take(40)->get();
              $count =$request->clickCount+1;
              return response()->json([$appointments,$count]);

            }
           
        }
        else
        {
            $appointments = Appointment::where('status', 'pending')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->take(40)->get();
            $locations = Location::get();
            return view('back-end.admin.appointment-booking-system.all_appointment',compact('appointments','locations'));

        }
    }

    public function accepted_appointment(Request $request){
        if($request->ajax())
        {
            if($request->type==='accepted-appointment')
            {
                 $appointments = Appointment::where('status', 'accepted')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->skip(20*$request->clickCount)->take(40)->get();
              $count =$request->clickCount+1;
              return response()->json([$appointments,$count]);

            }
        }
        else
        {
          $appointments = Appointment::where('status', 'accepted')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->take(40)->get();
            $locations = Location::get();
            return view('back-end.admin.appointment-booking-system.all_appointment',compact('appointments','locations'));
        }
        
    }

    public function cancel_appointment(Request $request){
        if($request->ajax())
        {
           if($request->type==='cancel-appointment')
            {
                 $appointments = Appointment::where('status', 'cancel')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->skip(20*$request->clickCount)->take(40)->get();
              $count =$request->clickCount+1;
              return response()->json([$appointments,$count]);

            }
        }
        else
        {
            $appointments = Appointment::where('status', 'cancel')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->take(40)->get();
            $locations = Location::get();
            return view('back-end.admin.appointment-booking-system.all_appointment',compact('appointments','locations')); 
        }
       
    }

      public function online_appointment(Request $request){
        if($request->ajax())
        {
            $appointments = Appointment::where('type','online')->with('doctor_profile', 'hospital_profile', 'patient_profile')->orderBy('appointment_date', 'desc')->skip(20*$request->clickCount)->take(40)->get();
              $count =$request->clickCount+1;
              return response()->json([$appointments,$count]);
        }
        $appointments = Appointment::where('type','online')->with('doctor_profile', 'hospital_profile', 'patient_profile')->orderBy('appointment_date', 'desc')->take(40)->get();
        return view('back-end.admin.appointment-booking-system.online_appointment',compact('appointments'));
    }
     public function delete_online(Request $request)
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
          Appointment::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Online Apointment Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
    public function appointmentDateFilter(Request $request){
        // dd('d');
        $route=$request->type;
        if($route == 'all-appointment'){
        $appointments = Appointment::where('appointment_date','>=', $request->startDate)->where('appointment_date','<=', $request->endDate)->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
    }
    if($route == 'pending-appointment'){
        $appointments = Appointment::where('appointment_date','>=', $request->startDate)->where('appointment_date','<=', $request->endDate)->where('status', 'pending')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
    }
    if($route == 'accepted-appointment'){
        $appointments = Appointment::where('appointment_date','>=', $request->startDate)->where('appointment_date','<=', $request->endDate)->where('status', 'accepted')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
    }
    if($route == 'cancel-appointment'){
        $appointments = Appointment::where('appointment_date','>=', $request->startDate)->where('appointment_date','<=', $request->endDate)->where('status', 'cancel')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->orderBy('appointment_date', 'desc')->get();
    }
        // dd($appointments);
        $locations = Location::get();
        return response()->json(
            [
                'type' => 'success',
                'appointments' => $appointments,
                'locations' => $locations,
            ]
        );

    }
    public function appointmentCityFilter(Request $request){
        // dd($request->all());
        $route=$request->type;
        $location_id = $request->id;
        if($route == 'all-appointment'){
        $appointments = Appointment::with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->whereHas('hospital_profile', function ($query)  use ($location_id) {
    return $query->where('location_id', $location_id);
})->orderBy('appointment_date', 'desc')->get();
        // dd($appointments);
    }
    if($route == 'pending-appointment'){
        $appointments = Appointment::where('status', 'pending')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->whereHas('hospital_profile', function ($query)  use ($location_id) {
    return $query->where('location_id', $location_id);
})->orderBy('appointment_date', 'desc')->get();

    }
    if($route == 'accepted-appointment'){
        $appointments = Appointment::where('status', 'accepted')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->whereHas('hospital_profile', function ($query)  use ($location_id) {
    return $query->where('location_id', $location_id);
})->orderBy('appointment_date', 'desc')->get();
    }
    if($route == 'cancel-appointment'){
        $appointments = Appointment::where('status', 'cancel')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->whereHas('hospital_profile', function ($query)  use ($location_id) {
    return $query->where('location_id', $location_id);
})->orderBy('appointment_date', 'desc')->get();
    }
        $areas = Area::where('location_id', $location_id)->get();
        // dd($areas);

        return response()->json(
            [
                'type' => 'success',
                'appointments' => $appointments,
                'areas' => $areas,
            ]
        );

    }
    public function appointmentAreaFilter(Request $request){
        // dd($request->all());
        $route=$request->type;
        $area_id = $request->id;
        $location_id = Area::where('id',$area_id)->pluck('location_id');
        if($route == 'all-appointment'){
        $appointments = Appointment::with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->whereHas('hospital_profile', function ($query)  use ($area_id, $location_id) {
    return $query->where('area_id', $area_id)->where('location_id', $location_id);
})->orderBy('appointment_date', 'desc')->get();
        // dd($appointments);
    }
    if($route == 'pending-appointment'){
        $appointments = Appointment::where('status', 'pending')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->whereHas('hospital_profile', function ($query)  use ($area_id, $location_id) {
    return $query->where('area_id', $area_id)->where('location_id', $location_id);
})->orderBy('appointment_date', 'desc')->get();

    }
    if($route == 'accepted-appointment'){
        $appointments = Appointment::where('status', 'accepted')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->whereHas('hospital_profile', function ($query)  use ($area_id, $location_id) {
    return $query->where('area_id', $area_id)->where('location_id', $location_id);
})->orderBy('appointment_date', 'desc')->get();
    }
    if($route == 'cancel-appointment'){
        $appointments = Appointment::where('status', 'cancel')->with('doctor_profile', 'hospital_profile', 'patient_profile')->where('hospital_id', '!=', 0)->whereHas('hospital_profile', function ($query)  use ($area_id, $location_id) {
    return $query->where('area_id', $area_id)->where('location_id', $location_id);
})->orderBy('appointment_date', 'desc')->get();
    }
        
        return response()->json(
            [
                'type' => 'success',
                'appointments' => $appointments,
            ]
        );

    }
}
