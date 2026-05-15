<?php

/**
 * Class PatientController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Order;
use App\Helper;
use App\Appointment;
use Carbon\Carbon;
use DB;
use App\SiteManagement;

/**
 * Class PatientController
 *
 */
class PatientController extends Controller
{
    /**
     * Show appoinement listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAppointments()
    {
        if (Auth::user()) {
            $patient = User::where('id', Auth::id())->with('appointments_patient','profile')->first();
            $meta_values = ['general_settings'];
            $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
                return view(
                    'back-end.patients.appointments.index',
                    compact('patient','managements')
                );
        } else {
            abort(404);
        }
    }
    public function storePatientStatus(Request $request)
    {
       // dd($request->all());exit();
         $json = array();
        $id = $request['id'];
        $status_value = $request['status_value'];
        $description = $request['description'];
        $get_data = Appointment::where('id',$id)->first();
        $status_change = Appointment::where('id',$id)->update(array('status_action'=>$status_value,'desc_reason'=>$description));
        $all_appointment = User::where('id', Auth::id())->with('appointments_patient')->first();
       return $all_appointment;
    }


     public function showAllAppointments()
    {
        if (Auth::user()) {
            $patient = User::where('id', Auth::id())->with('appointments_patient','profile')->first();
            $meta_values = ['general_settings'];
            $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
                return view(
                    'back-end.patients.appointments.all_appointments',
                    compact('patient','managements')
                );
        } else {
            abort(404);
        }
    }
     public function payoutSetting()
    {
        if (Auth::user()) {
            $patient = User::where('id', Auth::id())->with('appointments_patient','profile')->first();
            $meta_values = ['general_settings'];
            $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
                return view(
                    'back-end.patients.payout',
                    compact('patient','managements')
                );
        } else {
            abort(404);
        }
    }
     public function payoutAppointment($id)
    {
        $appointment = Appointment::where('id',$id)->with('patient_profile')->with('hospital_profile')->with('doctor_profile')->first();  
        $patient = User::where('id', Auth::id())->with('appointments_patient')->with('diseases')->with('specialities')->with('location')->with('services')->with('profile')->with('area')->with('feedbacks')->with('doc_teams')->with('roles')->first();
        $doctors = User::role('doctor')->where('id', '!=', Auth::id())->with('profile')->with('specialities')->with('feedbacks')->with('services')->with('location')->with('diseases')->with('orderMeta')->with('roles')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->get();
        $hospitals = User::role('hospital')->with('profile')->with('specialities')->with('feedbacks')->with('services')->with('location')->with('diseases')->with('orderMeta')->with('roles')->get();
        $managements  =  SiteManagement::all();    
         return view('back-end.patients.get_appointment_data',compact('appointment','patient','doctors', 'hospitals','managements'));
    }

     public function showInvoice($id)
    {
 
        $invoice = Order::where('id',$id)->with('patient_profile')->with('hospital_profile')->with('doctor_profile')->with('appointment')->first();  
        $patient = User::where('id', Auth::id())->with('appointments_patient')->with('diseases')->with('specialities')->with('location')->with('services')->with('profile')->with('area')->with('feedbacks')->with('doc_teams')->with('roles')->first();
        $doctors = User::role('doctor')->where('id', '!=', Auth::id())->with('profile')->with('specialities')->with('feedbacks')->with('services')->with('location')->with('diseases')->with('orderMeta')->with('roles')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->get();
        $hospitals = User::role('hospital')->with('profile')->with('specialities')->with('feedbacks')->with('services')->with('location')->with('diseases')->with('orderMeta')->with('roles')->get();
        $managements  =  SiteManagement::all();    
         return view('back-end.patients.invoices.show_invoice',compact('invoice','patient','doctors', 'hospitals','managements'));
    }
    /**
     * Get appoinetments for specific date
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getAppointments(Request $request)
    {

        if (!$request['date']){
            $request['date'] = date('Y-m-d');
        }
        else {
            $request['date'] = date('Y-m-d', strtotime($request['date']));
        }
        $json =  array();
        $list = array();
        $booking_settings = SiteManagement::getMetaValue('booking_settings');
        $online_payment = !empty($booking_settings['enable_booking']) ? $booking_settings['enable_booking'] : '';
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            $counter = 0;
            $orders = DB::table('appointments')->where('patient_id', Auth::user()->id);
            if ($online_payment == 'true') {
                $orders = $orders->where('status', 'accepted');
            }
            if (!empty($request['date'])) {
                $orders = $orders->where('appointment_date', $request['date']);
            }
            $orders = $orders->get();
            $list['count'] = $orders->count();
            if (!empty($orders)) {
                foreach ($orders as $key => $appointment) {
                    if (!empty($appointment)) {
                        $doctor = !empty($appointment->user_id) ? User::find($appointment->user_id) : '';
                        $services = !empty($appointment->services) ? json_decode($appointment->services, true) : '';
                        $list['appointment'][$counter]['user_id'] = !empty($appointment->patient_id) ? $appointment->patient_id : '';
                        $list['appointment'][$counter][$appointment->patient_id]['id'] = $appointment->id;
                        $list['appointment'][$counter][$appointment->patient_id]['status'] = $appointment->status;
                        $list['appointment'][$counter][$appointment->patient_id]['user_name'] = !empty($doctor) && !empty($appointment->user_id)
                            ? Helper::getUserName($appointment->user_id) : '';
                        $list['appointment'][$counter][$appointment->patient_id]['patient_name'] = !empty($appointment->patient_name)
                            ? $appointment->patient_name : '';
                        $list['appointment'][$counter][$appointment->patient_id]['relation'] = !empty($appointment->relation)
                            ? $appointment->relation : '';
                        $list['appointment'][$counter][$appointment->patient_id]['user_image'] = !empty($doctor)
                            ? asset(Helper::getImage('uploads/users/' . $doctor->id, $doctor->profile->avatar, 'small-', 'user.jpg'))
                            : '';
                        $list['appointment'][$counter][$appointment->patient_id]['user_verify'] = !empty($doctor) ? $doctor->user_verified : 0;
                        $list['appointment'][$counter][$appointment->patient_id]['user_location'] = !empty($doctor->location) && $doctor->location->count() > 0 ? $doctor->location->title : '';
                        $list['appointment'][$counter][$appointment->patient_id]['user_type'] = !empty($doctor) ? $doctor->getRoleNames()->first() : '';
                        $list['appointment'][$counter][$appointment->patient_id]['hospital'] = !empty($appointment->hospital_id) ? Helper::getUserName($appointment->hospital_id) : '';
                        $date = $appointment->appointment_date;
                        $patient_date = new Carbon($appointment->appointment_date);
                        $patient_appointment_date = explode("-", $date);
                        $list['appointment'][$counter][$appointment->patient_id]['patient_appointment_date'] = !empty($patient_appointment_date) ? $patient_appointment_date[2] : '';
                        $list['appointment'][$counter][$appointment->patient_id]['patient_appointment_month'] = !empty($patient_date) ? $patient_date->format('F') : '';
                        $list['appointment'][$counter][$appointment->patient_id]['appointment_date'] = !empty($appointment->appointment_date) ? $appointment->appointment_date : '';
                        $list['appointment'][$counter][$appointment->patient_id]['appointment_time'] = !empty($appointment->appointment_time) ? $appointment->appointment_time : '';
                        $list['appointment'][$counter][$appointment->patient_id]['comments'] = !empty($appointment->comments) ? $appointment->comments : '';
                        $list['appointment'][$counter][$appointment->patient_id]['type'] = !empty($appointment->type) ? $appointment->type : '';
                        if (!empty($services)) {
                            foreach ($services as $service_key => $service) {
                                if (!empty($service['service'])) {
                                    $speciality = Helper::getSpecialityByID($service['speciality']);
                                    $list['appointment'][$counter][$appointment->patient_id]['appointment_services'][$service_key]['speciality'] = !empty($speciality) ? $speciality->title : '';
                                    foreach ($service['service'] as $speciality_service_key => $speciality_service) {
                                        $service = Helper::getServiceByID($speciality_service);
                                        if (!empty($service)) {
                                            $list['appointment'][$counter][$appointment->patient_id]['appointment_services'][$service_key]['services'][$speciality_service_key]['title'] = !empty($service) ? $service->title : '';
                                        }
                                    }
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
    public function statusAppointments(Request $request){
        $json = array();
        $id = $request['id'];
        $all_data = Appointment::where('id',$id)->first();
        $status = Appointment::where('id',$id)->update(array('status'=>'cancel'));
        $all_appointment = User::where('id', Auth::id())->with('appointments_patient')->first();
       return $all_appointment;
    }
}