<?php

/**
 * Class User.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Serializable;
use Auth;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

/**
 * Class Appointment
 *
 */
class Appointment extends Model
{
    use Cachable;
    /**
     * Get the doctor that owns the appointment.
     * 
     * @return relation
     */
    public function user()
    {
        return $this->belongsTo('App\User')->with('profile', 'doc_teams','onlines');
    }

    /**
     * Get the doctor that owns the appointment.
     * 
     * @return relation
     */
    public function invoices()
    {
        return $this->hasMany('App\Order','user_id','user_id');
    }
   
    /**
     * Get the doctor that owns the appointment.
     * 
     * @return relation
     */
    public function patient()
    {
        return $this->hasOne('App\User', 'id','patient_id')->with('profile')->with('appointments_patient');
    }
     public function patient_profile()
    {
        return $this->hasOne('App\User', 'id','patient_id')->with('profile');
    }
    public function patient_profileApp()
    {
        return $this->hasOne(User::class, 'id', 'patient_id')->with(['profile' => function ($query) {
            $query->select('user_id', 'avatar'); 
        }]);
    }
     public function hospital_profile()
    {
        return $this->hasOne('App\User', 'id','hospital_id')->with('location')->with('profile');
    }
       public function doctor_profile()
    {
        return $this->hasOne('App\User', 'id','user_id')->with('profile')->with('specialities','doc_teams','onlines');
    }
    
    /**
     * Store patient appointment data
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function submitAppointment($request)
    {
        $json = array();
        if (!empty($request)) {
            $user_id = Auth::user()->id;
            $user = User::findOrFail($request['user_id']);
            $this->user()->associate($user);
            $this->hospital_id = intval($request['hospital']);
            $this->patient_id = intval($user_id);
            if ($request['patient'] == 'someone') {
                $this->patient_name = filter_var($request['patient_name'], FILTER_SANITIZE_STRING);
                $this->relation = filter_var($request['relation'], FILTER_SANITIZE_STRING);
            }
            $this->services = !empty($request['speciality']) ? serialize($request['speciality']) : null;
            $this->comments = !empty($request['comments']) ? filter_var($request['comments'], FILTER_SANITIZE_STRING) : null;
            $this->appointment_time = $request['time'];
            $this->appointment_date = $request['date'];
            $this->charges = intval($request['total_charges']);
            $this->status = 'pending';
            $this->type = $request['type'];
            $this->save();
            $json['last_id'] = $this->id;
            $json['type'] = 'success';
            return $json;
        }
    }

    /**
     * Store patient appointment data
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function submitAppointmentAPI($request)
    {
        $json = array();
        if (!empty($request)) {
            $patient_id = $request['patient_id'];
            $doctor_id = $request['doctor_id'];
            $user = User::findOrFail($doctor_id);
            $this->user()->associate($user);
            $this->hospital_id = intval($request['hospital']);
            $this->patient_id = intval($patient_id);
            if ($request['patient'] == 'someone') {
                $this->patient_name = filter_var($request['patient_name'], FILTER_SANITIZE_STRING);
                $this->relation = filter_var($request['relation'], FILTER_SANITIZE_STRING);
            }
            $this->services = !empty($request['speciality']) ? serialize($request['speciality']) : null;
            $this->comments = !empty($request['comments']) ? filter_var($request['comments'], FILTER_SANITIZE_STRING) : null;
            $this->appointment_time = $request['time'];
            $this->appointment_date = $request['date'];
            $this->charges = intval($request['total_charges']);
            $this->status = 'pending';
            $this->save();
            $json['last_id'] = $this->id;
            $json['type'] = 'success';
            return $json;
        }
    }
}
