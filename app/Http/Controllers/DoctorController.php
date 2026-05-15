<?php

/**
 * Class DoctorController
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
use App\Helper;
use App\Location;
use App\Service;
use App\UserMeta;
use App\User;
use App\Article;
use App\OnlineConsultation;
use Auth;
use Illuminate\Http\Request;
use App\EmailTemplate;
use View;
use App\Team;
use App\Appointment;
use App\Order;
use Session;
use App\Mail\HospitalEmailMailable;
use Illuminate\Support\Facades\Mail;
use function Opis\Closure\unserialize;
use App\Speciality;
use DB;
use App\Package;
use App\Payout;
use App\SiteManagement;
use Carbon\Carbon;
use App\Mail\GeneralEmailMailable;

/**
 * Class DoctorController
 *
 */
class DoctorController extends Controller
{
    /**
     * Defining scope of the variable
     *
     * @access protected
     * @var    array $doctor
     */
    protected $doctor;

    /**
     * Create a new controller instance.
     *
     * @param instance $doctor instance
     *
     * @return void
     */
    public function __construct(UserMeta $doctor)
    {
        $this->doctor = $doctor;
    }

    /**
     * Show Doctor Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function doctorDashboard()
    {
        if (Auth::user()) {
            if (file_exists(resource_path('views/extend/back-end/doctors/dashboard.blade.php'))) {
                return view(
                    'extend.back-end.doctor.dashboard'
                );
            } else {
                return view(
                    'back-end.doctors.dashboard'
                );
            }
        }
    }


    /**
     * Store awards downloads settings.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAwardDownloadSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (Auth::user()) {
            $awards_downloads = $this->doctor->storeAwardsDownloads($request, Auth::user()->id);
            if ($awards_downloads == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.awards_downloads_saved');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }



    /**
     * Store awards downloads settings.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function storeUpdateAwardDownloadSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (Auth::user()) {
            $awards_downloads = $this->doctor->storeAwardsDownloads($request, $request['id']);
            if ($awards_downloads == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.awards_downloads_saved');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Get doctor awards.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDoctorAwards()
    {
        $json = array();
        if (Auth::user()) {
                $awards = User::find(Auth::user()->id)->Profile->awards;
                $awards_list = !empty($awards) ? json_decode($awards, true) : array();
                if (!empty($awards)) {
                    $json['type'] = 'success';
                    $json['awards'] = $awards_list;
                    return $json;
                } else {
                    $json['type'] = 'error';
                    return $json;
                }
            } else {
                $json['type'] = 'error';
                return $json;
            }  
        
    }

    /**
     * Get doctor awards.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUpdateDoctorAwards()
    {
        $json = array();
        $userId = Session::get('user_admin_id');
        if (Auth::user()) {
             if($userId){
                 $user = User::find($userId[0]);
                 $awards = $user->profile->awards;
            } else {
                $user = User::find(Auth::user()->id);
                $awards = $user->profile->awards;
            }  
                $awards_list = !empty($awards) ? json_decode($awards, true) : array();
                if (!empty($awards)) {
                    
                    $json['type'] = 'success';
                    $json['awards'] = $awards_list;
                    return $json;
                } else {
                    
                    $json['type'] = 'error';
                    return $json;
                }
            } else {
                
                $json['type'] = 'error';
                return $json;
            }  
        
    }
    /**
     * Get doctor awards.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserDoctorAwards($id)
    {
        $user = User::find($id);
        $json = array();
        if (!empty($user)) {
                $awards = User::find($id)->Profile->awards;
                $awards_list = !empty($awards) ? json_decode($awards, true) : array();
                if (!empty($awards)) {
                    $json['type'] = 'success';
                    $json['awards'] = $awards_list;
                    return $json;
                } else {
                    $json['type'] = 'error';
                    return $json;
                }
            } else {
                $json['type'] = 'error';
                return $json;
            }  
        
    }
    /**
     * Store experiences in storage
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeExperiences(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $experiences = $this->doctor->saveExperiences($request, Auth::user()->id);
            if ($experiences['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.experience_updated');
                return $json;
            } elseif ($experiences == "error") {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

     /**
     * Store experiences in storage
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeUpdateExperiences(Request $request)
    {
        
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
        $experiences = $this->doctor->saveExperiences($request, $request['id']);

            if ($experiences['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.experience_updated');
                return $json;
            } elseif ($experiences == "error") {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Store educations in storage
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeEducations(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $experiences = $this->doctor->saveEducations($request, Auth::user()->id);
            if ($experiences['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.education_updated');
                return $json;
            } elseif ($experiences == "error") {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Store educations in storage
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeUpdateEducations(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $experiences = $this->doctor->saveEducations($request, $request['id']);
            if ($experiences['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.education_updated');
                return $json;
            } elseif ($experiences == "error") {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
    /**
     * Store appointment location form
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function addLocation(Request $request) 
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            $doctor_specialities = !empty($user->profile->services) ? json_decode($user->profile->services, true) : array();
            $intervals = Helper::getAppointmentIntervals();
            $durations = Helper::getAppointmentDuration();
            $spaces = Helper::getAppointmentSpaces();
            $days = Helper::getAppointmentDays();
            $doctor_info = Team::where('doctor_id', $user->id)->with('hospital')->paginate(10);
            if (file_exists(resource_path('views/extend/back-end/doctors/appointment_locations/create/index.blade.php'))) {
                return View::make(
                    'extend.back-end.doctors.appointment_locations.create.index',
                    compact('intervals', 'durations', 'doctor_specialities', 'spaces', 'days', 'doctor_info')
                );
            } else {
                return View::make(
                    'back-end.doctors.appointment_locations.create.index',
                    compact('intervals', 'durations', 'doctor_specialities', 'spaces', 'days', 'doctor_info')
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Stote appointment location data in storage
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAppointmentLocation(Request $request)
    {
        if (Auth::user()) {
            $server = Helper::doctieIsDemoSiteAjax();
            if (!empty($server)) {
                $response['type'] = 'error';
                $response['message'] = $server->getData()->message;
                return $response;
            }
            if (!empty($request)) {
                if (!empty($request['hospital_id'])) {
                    $hospital_location = Team::where('user_id', $request['hospital_id'])->where('doctor_id', Auth::user()->id)->count();
                    if ($hospital_location > 0) {
                        $response['type'] = 'error';
                        $response['message'] = trans('lang.hospital_already_selected');
                        return $response;
                    }
                }
                $doctor_days = UserMeta::where('user_id', Auth::user()->id)->first();
                $doctor_days = json_decode($doctor_days->available_days);

                foreach ($request['slots']['appointment_days'] as $day) {
                    if (!empty($doctor_days)){
                        $res = in_array($day, $doctor_days);
                        if (!$res) {
                            array_push($doctor_days, $day);
                        }
                    }

                }
                UserMeta::where('user_id', Auth::user()->id)->update(['available_days'=> $doctor_days]);

                $location  = new Team();
                $services = $location->saveAppointmentLocation($request);
                if ($services == "success") {
                    //send email to hospital
                    // if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                    //     if (!empty($request['hospital_id'])) {
                    //         $hospital = User::findOrFail($request['hospital_id']);
                    //     }
                    //     else {
                    //         $hospital = $request['hospital'];
                    //     }
                    //     $slots = $request['slots'];
                    //     $days = $slots['appointment_days'];
                    //     $email_params = array();
                    //     $email_params['starttime'] = $slots['start_time'];
                    //     $email_params['endtime'] =  $slots['end_time'];
                    //     $email_params['appt_intervals'] = $slots['intervals'];
                    //     $email_params['appt_duration'] = $slots['duration'];
                    //     $email_params['appt_days'] = implode(',', $days);
                    //     $template_data = Helper::getEmailContent();
                    //     if (!empty($request['hospital_id'])) {
                    //         Mail::to($hospital->email)
                    //             ->send(
                    //                 new HospitalEmailMailable(
                    //                     'hospital_appointment_locations_added',
                    //                     $template_data,
                    //                     $email_params
                    //                 )
                    //             );
                    //     }
                    //     Mail::to(config('mail.username'))
                    //         ->send(
                    //             new HospitalEmailMailable(
                    //                 'hospital_appointment_locations_added',
                    //                 $template_data,
                    //                 $email_params
                    //             )
                    //         );
                    //     $req_template = DB::table('email_types')->select('id')
                    //         ->where('email_type', 'hospital_email_doctor_request_to_hospital')->get()->first();
                    //     if (!empty($req_template->id)) {
                    //         $template_data = EmailTemplate::getEmailTemplateByID($req_template->id);
                    //         $email_params['doctor_name'] = Helper::getUserName(Auth::user()->id);
                    //         if (!empty($request['hospital_id'])) {
                    //             $email_params['hospital_name'] = Helper::getUserName($hospital->id);
                    //         }
                    //         $email_params['doctor_link']  = url('profile/' . Auth::user()->slug);
                    //         if (!empty($request['hospital_id'])) {
                    //             Mail::to($hospital->email)
                    //                 ->send(
                    //                     new HospitalEmailMailable(
                    //                         'hospital_email_doctor_request_to_hospital',
                    //                         $template_data,
                    //                         $email_params
                    //                     )
                    //                 );
                    //         }
                    //     }
                    // }
                    $json['type'] = 'success';
                    $json['progressing'] = trans('lang.saving');
                    $json['message'] = trans('lang.apt_location_saved');
                    return $json;
                } else {
                    $json['type'] = 'error';
                    return $json;
                }
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorise');
            return $json;
        }
    }

    /**
     * Edit doctor appoinement location.
     *
     * @param string $id id
     *
     * @access public
     *
     * @return View
     */
    public function storeAdminAppointmentLocation(Request $request)
    {
        if (Auth::user()) {
            $server = Helper::doctieIsDemoSiteAjax();
            if (!empty($server)) {
                $response['type'] = 'error';
                $response['message'] = $server->getData()->message;
                return $response;
            }
            if (!empty($request)) {
                if (!empty($request['hospital_id'])) {
                    $hospital_location = Team::where('user_id', $request['hospital_id'])->where('doctor_id', $request['user_id'])->count();
                    if ($hospital_location > 0) {
                        $response['type'] = 'error';
                        $response['message'] = trans('lang.hospital_already_selected');
                        return $response;
                    }
                }
                $doctor_days = UserMeta::where('user_id', $request['id'])->first();
                $doctor_days = json_decode($doctor_days->available_days);

                foreach ($request['slots']['appointment_days'] as $day) {
                    if (!empty($doctor_days)){
                        $res = in_array($day, $doctor_days);
                        if (!$res) {
                            array_push($doctor_days, $day);
                        }
                    }

                }
                UserMeta::where('user_id', $request['id'])->update(['available_days'=> $doctor_days]);

                $location  = new Team();
                $services = $location->saveAdminAppointmentLocation($request);
                if ($services == "success") {
                    $json['type'] = 'success';
                    $json['progressing'] = trans('lang.saving');
                    $json['message'] = trans('lang.apt_location_saved');
                    return $json;
                } else {
                    $json['type'] = 'error';
                    return $json;
                }
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorise');
            return $json;
        }
    }

    /**
     * Edit doctor appoinement location.
     *
     * @param string $id id
     *
     * @access public
     *
     * @return View
     */
    public function editLocation($id)
    {
        if (Auth::user() && !empty($id)) {
            $user = User::find(Auth::user()->id);
            $location = Team::find($id);
            $slots = json_decode($location->slots, true);
            $days = Helper::getAppointmentDays();
            $intervals = Helper::getAppointmentIntervals();
            $durations = Helper::getAppointmentDuration();
            $spaces = Helper::getAppointmentSpaces();
            $appointment_days = !empty($slots['days']) ? $slots['days'] : array();
             $consultation_fee = !empty($slots['consultation_fee']) ? $slots['consultation_fee'] : array();
            // dd($consultation_fee);
            $doctor_specialities = !empty($user->profile->services) ? json_decode($user->profile->services, true) : array();
            $service_price = !empty($slots['services']['price']) ? $slots['services']['price'] : '';
            if (file_exists(resource_path('views/extend/back-end/doctors/appointment_locations/edit/index.blade.php'))) {
                return View::make(
                    'extend.back-end.doctors.appointment_locations.edit.index',
                    compact(
                        'id',
                        'location',
                        'slots',
                        'days',
                        'intervals',
                        'durations',
                        'spaces',
                        'doctor_specialities',
                        'service_price',
                        'appointment_days',
                        'consultation_fee'
                    )
                );
            } else {
                return View::make(
                    'back-end.doctors.appointment_locations.edit.index',
                    compact(
                        'id',
                        'location',
                        'slots',
                        'days',
                        'intervals',
                        'durations',
                        'spaces',
                        'doctor_specialities',
                        'service_price',
                        'appointment_days',
                        'consultation_fee'
                    )
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update doctor appointment slots
     *
     * @param string $id      id
     * @param mixed  $request get req attributes
     * 
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function updateSlots($id, Request $request)
    {
        if (Auth::user()) {
            $location  = new Team();
            $update_slots = $location->updateAppointmentSlots($id, $request);
            if ($update_slots == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.slot_updated');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Update appointment location services
     *
     * @param string                   $id      id
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function updateLocationServices($id, Request $request)
    {
        if (Auth::user()) {
            $location  = new Team();
            $update_slots = $location->updateAppointmentLocationServices($id, $request);
            if ($update_slots == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.save_service');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Store appointment selected day slots
     *
     * @param string                   $id      id
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeSelectedDaySlots($id, Request $request)
    {
        if (Auth::user()) {
            $location  = new Team();
            $update_slots = $location->saveSelectedDaySlots($id, $request);
            if ($update_slots == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.slot_updated');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Delete appointment location selected time slot
     *
     * @param string $slot slot
     * @param string $day  day
     * @param int    $id   id
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteSlots($slot, $day, $id)
    {
        if (Auth::user()) {
            $team  = new Team();
            $team_location = $team->deleteAppointmentSlots($slot, $day, $id);
            if ($team_location == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.slot_deleted');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Delete appointment location time slot
     *
     * @param string $day day
     * @param int    $id  id
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAllSlots($day, $id)
    {
      
        if (Auth::user()) {
            $team  = new Team();

            $team_location = $team->deleteAllAppointmentSlots($day, $id);
            if ($team_location == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.slot_deleted');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Get doctor's appointment slots
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getAppointmentSlots(Request $request)
    {
        header('Content-type: application/json; charset=utf-8');
        date_default_timezone_set("Asia/Karachi");
        $a_days = array_map('strtolower', $request['days']);
                // return json_encode($a_days);
        $a_dates = $request['dates'];
        $json = array();
        $list = array();
        $lists = array();
        $fullDayName=[];
        $halfDayName=[];
        foreach ($a_dates as $index => $date) {
            $day = Carbon::parse($date)->format('l');
          $day = strtolower($day);
          array_push($fullDayName, $day);
          }
          foreach ($a_dates as $index => $date) {
            $day = Carbon::parse($date)->format('D');
          $day = strtolower($day);
          array_push($halfDayName, $day);
          }
        foreach ($a_dates as $index => $a_date) {
            $list = array();
            if($request['hospital'] !== null){
                if($request['hospital'] == 'online' || $request['hospital'] == []){
                     $hospital_id = 'online';
                }
                else{

            $hospital_id = $request['hospital']['id'];
                }
            }
            else{
                $hospital_id = $request['hospital_id'];
            }
            if($hospital_id == 'online'){
             $hospital = OnlineConsultation::select('slots')->where('doctor_id', $request['doctor_id'])->first() ? OnlineConsultation::select('slots')->where('doctor_id', $request['doctor_id'])->first() :  $hospital = Team::select('slots')->where('doctor_id', $request['doctor_id'])->where('user_id','online')->first();
             // dd($hospital);
        // return $a_dates;
                // return $hospital;
            }else{
            $hospital = Team::select('slots')->where('doctor_id', $request['doctor_id'])->where('user_id', $hospital_id)->first();
            }
            // dd(5);
            if (!empty($hospital)) {
                $requested_date = Carbon::create($a_date);

                $date = new Carbon();
                $today = $date->now();
                $slots = json_decode($hospital->slots, true);
                if(isset($slots['days'])){
                    $requested_day_slots = !empty($slots[$halfDayName[$index]]) ? $slots[$halfDayName[$index]]['slots'] : array();
                }
                else
                {
                    // dd($slots[$fullDayName[$index]]);
                    $requested_day_slots = !empty($slots[$fullDayName[$index]]) ? $slots[$fullDayName[$index]]['slots'] : array();
                }
                
                if (!empty($requested_day_slots)) {
                    $counter = 0;
                    foreach ($requested_day_slots as $key => $slot) {
                        $time = explode('-', $key);
                        $list[$counter]['start_time'] = $time[0];
                        $bocked_appointments = DB::table('appointments')->where('appointment_time', $time[0])->where('appointment_date', $a_date)->count();
                        $requested_date->hour   = date("H:i", strtotime($time[0]));
                        if ($requested_date->lessThan($today)) {
                            $list[$counter]['space'] = 0;
                        } else if ($bocked_appointments > 0) {
                            $list[$counter]['space'] = $slot['space'] - $bocked_appointments;
                        } else {
                            $list[$counter]['space'] = (int)($slot['space']);
                        }
                        $counter++;
                    }
                }
                $lists[$a_date] = $list;
            }
        }

        $json['type'] = 'success';
        $json['slots'] = $lists;
        return json_encode($json);

    }

    /**
     * Get doctor hospital services
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getHospitalServices(Request $request)
    {
        if($request['hospital'] == null) {
            $request['hospital'] = 'online';
        }
        $json =  array();
        if (Auth::user()) {
            $team_info = Team::where('user_id', $request['hospital'])->first();
            if (!empty($team_info)) {
                $slots = json_decode($team_info['slots'], true);
                $list = array();
                $list['fee'] = !empty($slots['consultation_fee']) ? $slots['consultation_fee'] : 0;
                if (!empty($slots['services'])) {
                    foreach ($slots['services']['speciality'] as $key => $specialities) {
                        $speciality = Speciality::find($specialities['speciality_id']);
                        if (!empty($speciality)) {
                            $list['specialities'][$key]['speciality_id'] = $speciality->id;
                            $list['specialities'][$key]['speciality_title'] = $speciality->title;
                            $list['specialities'][$key]['speciality_image'] = asset(Helper::getImage('uploads/specialities', $speciality->image, '', 'default-speciality.png'));
                            if (!empty($specialities['speciality_services'])) {
                                foreach ($specialities['speciality_services'] as $service_key => $services) {
                                    $service = Helper::getServiceByID($services['service']);
                                    if (!empty($service)) {
                                        $list['specialities'][$key]['services'][$service_key]['service_id'] = $service->id;
                                        $list['specialities'][$key]['services'][$service_key]['service_title'] = $service->title;
                                        $list['specialities'][$key]['services'][$service_key]['service_price'] = $services['price'];
                                    }
                                }
                            } else {
                                $json['type'] = 'error';
                                $json['message'] = trans('lang.service_not_found');
                                return $json;
                            }
                        }
                    }
                    $json['services'] = !empty($list) ? $list : '';
                    $json['type'] = 'success';
                    return $json;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.service_not_found');
                    return $json;
                }
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Show Doctor appoinement listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAppointments()
    {
        if (Auth::user()) {
            $doctor = User::where('id', Auth::id())->with('profile','appointments')->first();
            $meta_values = ['general_settings'];
            $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
                return view(
                    'back-end.doctors.appointments.index',
                    compact('doctor','managements')
                );
        } else {
            abort(404);
        }
    }
    public function testing()
    {
             $allAppointment = Appointment::with('order')->orderBy("id","desc")->get();  
             foreach ($allAppointment as $app){
               // dd($app);
                $app_created = $app->created_at->addMinutes(50)->format('M d, Y H:i');
                $date = new Carbon();
            $today_date = $date->now()->format('M d, Y H:i');
            dd('created at and add min',$app_created,'current date',$today_date,($app_created === $today_date),$app->id,($app->order != null));
            if ($app_created === $today_date) {
                if ($app->order != null) {
                    // if ($app->order->status === 'pending') {
                    //      $status = Appointment::where('id',$app->id)->update(array('status'=>'cancel'));
                    // }
                }
                else{
                     $status = Appointment::where('id',$app->id)->update(array('status'=>'cancel'));
                }
            }
            // else{

            // }
             } 
             //dd($get_appointment);
           //$appointment_date =  $get_appointment->appointment_date;
            // $date = new Carbon();
            // $today_date = $date->now()->format('M d, Y H:i:s');
            // if (condition) {
            //     # code...
            // }
            $today_time = $date->now()->format('h:i A');
            if ($appointment_date == $today_date) {
                $appointment_time_before =  $get_appointment->appointment_time->subMinutes(30);
                if ($appointment_time_before == $today_time) {
                     $final_appointment = Appointment::where('id',$request->id)->first();
                    if ($final_appointment->status == 'paying-verified') {

                    }
                    else{
                        $status = Appointment::where('id',$id)->update(array('status'=>'cancel'));
                    }
                }
            }
    }
     public function showAllAppointments()
    {
        if (Auth::user()) {
            $doctor = User::where('id', Auth::id())->with('appointments','profile')->first();
            $meta_values = ['general_settings'];
            $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();

                return view(
                    'back-end.doctors.appointments.all_appointments',
                    compact('doctor','managements')
                );
        } else {
            abort(404);
        }
    }
    public function AllAppointmentNotification()
    {
        if(Auth::user())
        {
            $doctor = User::where('id', Auth::id())->with('appointments','profile')->first();
            $meta_values = ['general_settings'];
            $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();

                return view(
                    'back-end.doctors.appointments.all_appointments_notification',
                    compact('doctor','managements')
                );
        } else {
            abort(404);
        }
    }
    public function statusAppointments(Request $request){
        $json = array();
        $id = $request['id'];
        $status = Appointment::where('id',$id)->update(array('status'=>'cancel'));
        $all_appointment = User::where('id', Auth::id())->with('appointments')->first();
       return $all_appointment;
    }
    public function approveAppointments(Request $request){
        $json = array();
        $id = $request['id'];
        $status = Appointment::where('id',$id)->update(array('status'=>'accepted'));
        $all_appointment = User::where('id', Auth::id())->with('appointments')->first();
       return $all_appointment;
    }
    public function verifyPayment(Request $request){
        $json = array();
        $id = $request['id'];
        $status = Order::where('id',$id)->update(array('status'=>'verify'));
        $order_get = Order::where('id',$id)->first();
        $all_data = Appointment::where('id',$order_get->appointment_id)->update(array('payment'=>'paying-verified'));
        $orders = Order::where('user_id', Auth::id())->with('patient_profile')->with('hospital_profile')->with('doctor_profile')->with('appointment')->get();
       return $orders;
    }
      public function storeDoctorStatus(Request $request)
    {
         $json = array();
        $id = $request['id'];
        $status_value = $request['status_value'];
        $get_data = Appointment::where('id',$id)->first();
        $status_change = Appointment::where('id',$id)->update(array('status_action'=>$status_value));
        $all_appointment = User::where('id', Auth::id())->with('appointments')->first();
       return $all_appointment;
    }
    
      public function showBlog()
    {
        if (Auth::user()) {
            $doctor = User::where('id', Auth::id())->with('articles')->with('profile')->first();
                $meta_values = ['general_settings'];
                $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
                return view(
                    'back-end.doctors.blogs.index',
                    compact('doctor','managements')
                );
        } else {
            abort(404);
        }
    }
     /**
     * Show Doctor appoinement listing.
     *
     * @return \Illuminate\Http\Response
     */
     public function getAppointmentsByDate(Request $request){
        $json = Array();
        if (Auth::user()) {
            $date = strtotime($request->date);
            // dd(Auth::user()->id);
            $user = User::find(Auth::user()->id);
            $appointments = Appointment::with('patients')->where('user_id',Auth::user()->id)->where('appointment_date', date("Y-m-d",$date))->get();
            $tappointments = Appointment::with('patients')->where('user_id',Auth::user()->id)->where('appointment_date', date("Y-m-d",$date))->get();
           $json['appointments'] = $appointments;
           $json['tappointments'] = $tappointments;
           return $json;
            return response()->json(['appointments ' => $appointments, 'tappointments' => $tappointments]);

        }
        return false;

     }
    /**
     * Show Doctor appoinement listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAppointmentsToAdmin($id)
    {
        if (Auth::user()) {
            $user = User::find($id);
            $appointments = $user->appointments;
            $managements  =  SiteManagement::all();

            if (file_exists(resource_path('views/extend/back-end/doctors/appointments/show.blade.php'))) {
                return view(
                    'extend.back-end.doctor.appointments.show',
                    compact('appointments','managements')
                );
            } else {
                return view(
                    'back-end.doctors.appointments.show',
                    compact('appointments','managements')
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get doctor appoinetments for specific date
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getAppointments(Request $request)
    {
        $json =  array();
        $list = array();
        $booking_settings = SiteManagement::getMetaValue('booking_settings');
        $online_payment = !empty($booking_settings['enable_booking']) ? $booking_settings['enable_booking'] : '';
        if ($request['id']) {
            $user = User::find($request['id']);
            $appointments = $user->appointments;
            if ($online_payment == 'true') {
                $appointments = $appointments->where('status', 'accepted');
            }
            if (!$request['date']){
                $request['date'] = date('Y-m-d');
            }
            else {
                $request['date'] = date('Y-m-d', strtotime($request['date']));
            }
            if (!empty($request['date'])) {
                $appointments = $appointments->where('appointment_date', $request['date']);
            }
            $counter = 0;
            if ($appointments->count() > 0) {
                $list['count'] = $appointments->count();
                foreach ($appointments as $key => $appointment) {
                    $patient = !empty($appointment->patient_id) ? User::find($appointment->patient_id) : '';
                    $services = !empty($appointment->services) ? json_decode($appointment->services, true) : '';
                    $list['appointment'][$counter]['user_id'] = !empty($patient) ? $appointment->patient_id : '';
                    $list['appointment'][$counter][$appointment->patient_id]['id'] = $appointment->id;
                    $list['appointment'][$counter][$appointment->patient_id]['status'] = $appointment->status;
                    $list['appointment'][$counter][$appointment->patient_id]['user_name'] = !empty($patient) && !empty($appointment->patient_id)
                        ? Helper::getUserName($appointment->patient_id) : '';
                    $list['appointment'][$counter][$appointment->patient_id]['patient_name'] = !empty($appointment->patient_name)
                        ? $appointment->patient_name : '';
                    $list['appointment'][$counter][$appointment->patient_id]['relation'] = !empty($appointment->relation)
                        ? $appointment->relation : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_image'] = !empty($patient)
                        ? asset(Helper::getImage('uploads/users/' . $appointment->patient_id, $patient->profile->avatar, 'small-', 'user.jpg'))
                        : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_verify'] = !empty($patient) ? $patient->user_verified : 0;
                    $list['appointment'][$counter][$appointment->patient_id]['user_location'] = !empty($patient->location) && $patient->location->count() > 0 ? $patient->location->title : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_type'] = !empty($patient) ? $patient->getRoleNames()->first() : '';
                    $list['appointment'][$counter][$appointment->patient_id]['hospital'] = !empty($appointment->hospital_id) ? Helper::getUserName($appointment->hospital_id) : '';
                    $date = $appointment->appointment_date;
                    $patient_date = new Carbon($appointment->appointment_date);
                    $patient_appointment_date = explode("-", $date);
                    $list['appointment'][$counter][$appointment->patient_id]['patient_appointment_date'] = !empty($patient_appointment_date) ? $patient_appointment_date[2] : '';
                    $list['appointment'][$counter][$appointment->patient_id]['patient_appointment_month'] = !empty($patient_date) ? $patient_date->format('F') : '';
                    $list['appointment'][$counter][$appointment->patient_id]['appointment_date'] = !empty($date) ? $date : '';
                    $list['appointment'][$counter][$appointment->patient_id]['appointment_time'] = !empty($appointment->appointment_time) ? $appointment->appointment_time : '';
                    $list['appointment'][$counter][$appointment->patient_id]['comments'] = !empty($appointment->comments) ? $appointment->comments : '';
                    $list['appointment'][$counter][$appointment->patient_id]['hospital_id'] = !empty($appointment->hospital_id) ? $appointment->hospital_id : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_id'] = !empty($appointment->user_id) ? $appointment->user_id : '';
                    $list['appointment'][$counter][$appointment->patient_id]['type'] = !empty($appointment->type) ? $appointment->type : '';
                    if (!empty($services)) {
                        foreach ($services as $service_key => $service) {
                            if (!empty($service['service'])) {
                                $speciality = Helper::getSpecialityByID($service['speciality']);
                                $list['appointment'][$counter][$appointment->patient_id]['appointment_services'][$service_key]['speciality'] = !empty($speciality) ? $speciality->title : '';
                                foreach ($service['service'] as $speciality_service_key => $speciality_service) {
                                    $service = Helper::getServiceByID($speciality_service);
                                    $list['appointment'][$counter][$appointment->patient_id]['appointment_services'][$service_key]['services'][$speciality_service_key]['title'] = !empty($service) ? $service->title : '';
                                }
                            }
                        }
                    }
                    $counter++;
                }
                $json['appointments'] = $list;
                $json['type'] = 'success';
                return $json;
            } else {
                $list['count'] = $appointments->count();
                $list['appointment'] = array();
                $json['appointments'] = $list;
                return $json;
            }
        }
        elseif (Auth::user()) {
            $user = User::find(Auth::user()->id);
            $appointments = $user->appointments;
            if ($online_payment == 'true') {
                $appointments = $appointments->where('status', 'accepted');
            }
            if (!$request['date']){
                $request['date'] = date('Y-m-d');
            }
            else {
                $request['date'] = date('Y-m-d', strtotime($request['date']));
            }
            if (!empty($request['date'])) {
                $appointments = $appointments->where('appointment_date', $request['date']);
            }
            $counter = 0;
            if ($appointments->count() > 0) {
                $list['count'] = $appointments->count();
                foreach ($appointments as $key => $appointment) {
                    $patient = !empty($appointment->patient_id) ? User::find($appointment->patient_id) : '';
                    $services = !empty($appointment->services) ? json_decode($appointment->services, true) : '';
                    $list['appointment'][$counter]['user_id'] = !empty($patient) ? $appointment->patient_id : '';
                    $list['appointment'][$counter][$appointment->patient_id]['id'] = $appointment->id;
                    $list['appointment'][$counter][$appointment->patient_id]['status'] = $appointment->status;
                    $list['appointment'][$counter][$appointment->patient_id]['user_name'] = !empty($patient) && !empty($appointment->patient_id)
                        ? Helper::getUserName($appointment->patient_id) : '';
                    $list['appointment'][$counter][$appointment->patient_id]['patient_name'] = !empty($appointment->patient_name)
                        ? $appointment->patient_name : '';
                    $list['appointment'][$counter][$appointment->patient_id]['relation'] = !empty($appointment->relation)
                        ? $appointment->relation : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_image'] = !empty($patient)
                        ? asset(Helper::getImage('uploads/users/' . $appointment->patient_id, $patient->profile->avatar, 'small-', 'user.jpg'))
                        : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_verify'] = !empty($patient) ? $patient->user_verified : 0;
                    $list['appointment'][$counter][$appointment->patient_id]['user_location'] = !empty($patient->location) && $patient->location->count() > 0 ? $patient->location->title : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_type'] = !empty($patient) ? $patient->getRoleNames()->first() : '';
                    $list['appointment'][$counter][$appointment->patient_id]['hospital'] = !empty($appointment->hospital_id) ? Helper::getUserName($appointment->hospital_id) : '';
                    $date = $appointment->appointment_date;
                    $patient_date = new Carbon($appointment->appointment_date);
                    $patient_appointment_date = explode("-", $date);
                    $list['appointment'][$counter][$appointment->patient_id]['patient_appointment_date'] = !empty($patient_appointment_date) ? $patient_appointment_date[2] : '';
                    $list['appointment'][$counter][$appointment->patient_id]['patient_appointment_month'] = !empty($patient_date) ? $patient_date->format('F') : '';
                    $list['appointment'][$counter][$appointment->patient_id]['appointment_date'] = !empty($date) ? $date : '';
                    $list['appointment'][$counter][$appointment->patient_id]['appointment_time'] = !empty($appointment->appointment_time) ? $appointment->appointment_time : '';
                    $list['appointment'][$counter][$appointment->patient_id]['comments'] = !empty($appointment->comments) ? $appointment->comments : '';
                    $list['appointment'][$counter][$appointment->patient_id]['hospital_id'] = !empty($appointment->hospital_id) ? $appointment->hospital_id : '';
                    $list['appointment'][$counter][$appointment->patient_id]['user_id'] = !empty($appointment->user_id) ? $appointment->user_id : '';
                    $list['appointment'][$counter][$appointment->patient_id]['type'] = !empty($appointment->type) ? $appointment->type : '';
                    if (!empty($services)) {
                        foreach ($services as $service_key => $service) {
                            if (!empty($service['service'])) {
                                $speciality = Helper::getSpecialityByID($service['speciality']);
                                $list['appointment'][$counter][$appointment->patient_id]['appointment_services'][$service_key]['speciality'] = !empty($speciality) ? $speciality->title : '';
                                foreach ($service['service'] as $speciality_service_key => $speciality_service) {
                                    $service = Helper::getServiceByID($speciality_service);
                                    $list['appointment'][$counter][$appointment->patient_id]['appointment_services'][$service_key]['services'][$speciality_service_key]['title'] = !empty($service) ? $service->title : '';
                                }
                            }
                        }
                    }
                    $counter++;
                }
                $json['appointments'] = $list;
                $json['type'] = 'success';
                return $json;
            } else {
                $list['count'] = $appointments->count();
                $list['appointment'] = array();
                $json['appointments'] = $list;
                return $json;
            }
        }
        else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Checkout Page.
     *
     * @param \Illuminate\Http\Request $id ID
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout($id)
    {
        if (!empty($id) && Auth::user()) {
            $package = Package::find($id);
            $package_options = Helper::getPackageOptions(Auth::user()->getRoleNames());
            $payment_settings = SiteManagement::getMetaValue('payment_settings');
            $payment_gateway = !empty($payment_settings) && !empty($payment_settings['payment_method']) ? $payment_settings['payment_method'] : array();
            $symbol = !empty($payment_settings) && !empty($payment_settings['currency']) ? Helper::currencyList($payment_settings['currency']) : array();
            if (file_exists(resource_path('views/extend/back-end/doctors/package/checkout.blade.php'))) {
                return view::make('extend.back-end.doctors.package.checkout', compact('package', 'package_options', 'payment_gateway', 'symbol'));
            } else {
                return view::make('back-end.doctors.package.checkout', compact('package', 'package_options', 'payment_gateway', 'symbol'));
            }
        } else {
            abort(404);
        }
    }

    /**
     * Print Thankyou.
     *
     * @return \Illuminate\Http\Response
     */
    public function thankyou()
    {
        if (Auth::user()) {
            echo trans('lang.thankyou');
        } else {
            abort(404);
        }
    }

    /**
     * Get freelancer payouts.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPayouts()
    {
        if (Auth::user()) {
            $payouts =  Payout::where('user_id', Auth::user()->id)->paginate(10);
            if (file_exists(resource_path('views/extend/back-end/doctors/payouts.blade.php'))) {
                return view(
                    'extend.back-end.doctors.payouts.payouts',
                    compact('payouts')
                );
            } else {
                return view(
                    'back-end.doctors.payouts.payouts',
                    compact('payouts')
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payoutSettings()
    {
        if (Auth::user()) {
            $payrols = Helper::getPayoutsList();
            $user = User::find(Auth::user()->id);
            $payout_settings = $user->profile->count() > 0 ? json_decode($user->profile->payout_settings, true) : '';
            if (file_exists(resource_path('views/extend/back-end/doctors/payouts/payout_settings.blade.php'))) {
                return view(
                    'extend.back-end.doctors.payouts.payout_settings',
                    compact('payrols', 'payout_settings')
                );
            } else {
                return view(
                    'back-end.doctors.payouts.payout_settings',
                    compact('payrols', 'payout_settings')
                );
            }
        } else {
            abort(404);
        }
    }

      public function paySettings()
    {
        if (Auth::user()) {
            $orders = Order::where('user_id', Auth::id())->with('patient_profile')->with('hospital_profile')->with('doctor_profile')->with('appointment')->get();
            $doctor = User::where('id', Auth::id())->with('articles')->with('profile')->first();
            $meta_values = ['general_settings'];
            $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
                return view(
                    'back-end.doctors.payouts.request_pay_setting',
                    compact('orders','doctor','managements')
                );
        } else {
            abort(404);
        }
    }

    /**
     * Accept patient appointment
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function acceptAppointment(Request $request)
    {
        $json = array();
        if (Auth::user()) {
            if (!empty($request['appointment']) && !empty($request['patient_id'])) {
                $appointment = $request['appointment'];
                $patient = User::find($request['patient_id']);
                if ($appointment['hospital_id']) {
                    $hospital = User::findOrFail($appointment['hospital_id']);
                }
                else {
                    $hospital = '0';
                }
                $doctor = User::findOrFail($appointment['user_id']);
                DB::table('appointments')->where('id', $appointment['id'])->update(['status' => 'accepted']);
                if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                    $email_params = array();
                    $template = DB::table('email_types')->select('id')->where('email_type', 'user_email_appointment_request_approved')->get()->first();
                    if (!empty($template->id)) {
                        $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                        $email_params['user_name'] = Helper::getUserName($patient->id);
                        if ($appointment['hospital_id']) {
                            $email_params['hospital_name'] = Helper::getUserName($hospital->id);
                            $email_params['hospital_link'] = url('profile/' . $hospital->slug);
                        }
                        $email_params['doctor_name'] = Helper::getUserName($doctor->id);
                        $email_params['doctor_link'] = url('profile/' . $doctor->slug);
                        $email_params['appointment_date_time'] = Carbon::parse($appointment['appointment_date'])->format('d M, Y') . ' ' . $appointment['appointment_time'];
                        $email_params['description'] = $appointment['comments'];
                        if ($patient->email) {
                            Mail::to($patient->email)
                                ->send(
                                    new GeneralEmailMailable(
                                        'user_email_appointment_request_approved',
                                        $template_data,
                                        $email_params
                                    )
                                );
                        }
                    }
                }
                $json['type'] = 'success';
                $json['message'] = trans('lang.appointment_updated');
                $json['status'] = trans('lang.accepted');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    /**
     * Reject patient appointment
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function declineAppointment(Request $request)
    {
        $json = array();
        if (Auth::user()) {
            if (!empty($request['appointment']) && !empty($request['patient_id'])) {
                $appointment = $request['appointment'];
                $patient = User::find($request['patient_id']);
                $doctor = User::findOrFail($appointment['user_id']);
                DB::table('appointments')->where('id', $appointment['id'])->update(['status' => 'rejected']);
                if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                    $email_params = array();
                    $template = DB::table('email_types')->select('id')->where('email_type', 'user_email_appointment_request_rejected')->get()->first();
                    if (!empty($template->id) && $patient->email) {
                        $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                        $email_params['user_name'] = Helper::getUserName($patient->id);
                        $email_params['doctor_name'] = Helper::getUserName($doctor->id);
                        Mail::to($patient->email)
                            ->send(
                                new GeneralEmailMailable(
                                    'user_email_appointment_request_rejected',
                                    $template_data,
                                    $email_params
                                )
                            );
                    }
                }
                $json['type'] = 'success';
                $json['message'] = trans('lang.appointment_updated');
                $json['status'] = trans('lang.rejected');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something');
            return $json;
        }
    }

    public function Extend(Request $request)
    {
        if($request->has('extended')){

            DB::table('user_metas')->where('user_id', $request['id'])->update(['extend' => $request['extended'],'created_extend' => Carbon::now()]);
        } else {

            DB::table('user_metas')->where('user_id', $request['id'])->update(['extend' => 'off','created_extend' => null]);
        }
        
         $json['type'] = 'success';

         return $json;
    }

    public function practiceEnhance() {
        $user_ = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];

        $doctors = User::role('doctor')->orderBy("trending","desc")->with('profile','specialities','location')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->limit(2)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->latest()->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->latest()->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->latest()->limit(4)->get();
        /*Locations*/
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','banner_video_section','services_tab_sec'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
         $segments = \Request::segments();
        return view('front-end.doctor-practice.index',
            compact( 
                'specialities', 'logged_user', 'laboratories', 'cities', 'services', 'diseases',
                'specialities', 'hospitals', 'doctors', 'managements','segments'
            )
        );
    }
}
