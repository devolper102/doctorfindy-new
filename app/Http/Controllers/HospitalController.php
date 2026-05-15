<?php
/**
 * Class HospitalController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use App\User;
use App\Team;
use App\Location;
use App\Service;
use App\UserMeta;
use App\Article;
use App\Disease;
use App\Speciality;
use App\SiteManagement;
use Carbon\Carbon;
use Auth;
use Helper;
use Illuminate\Http\Request;
use DB;
use App\EmailTemplate;
use App\Mail\DoctorEmailMailable;
use Illuminate\Support\Facades\Mail;

/**
 * Class HospitalController
 *
 */
class HospitalController extends Controller
{

    /**
     * Show hospital team listing
     *
     * @access public
     *
     * @return View
     */
    public function doctorListing(Request $request)
    {
        if ($request['id']) {
            $id = $request['id'];
            $hospital = User::findOrFail($id);
            $teams = !empty($hospital) ? $hospital->teams()->paginate(8) : array();
            if (file_exists(resource_path('views/extend/back-end/hospitals/team/index.blade.php'))) {
                return view('back-end.hospitals.team.index', compact('teams','hospital'));
            } else {
                return view('back-end.hospitals.team.index', compact('teams','hospital'));
            }
        }
        if (Auth::user() && Helper::getAuthRoleType() === 'hospital') {
            $hospital = User::findOrFail(Auth::user()->id);
            $teams = !empty($hospital) ? $hospital->teams()->paginate(8) : array();
            if (file_exists(resource_path('views/extend/back-end/hospitals/team/index.blade.php'))) {
                return view('back-end.hospitals.team.index', compact('teams','hospital'));
            } else {
                return view('back-end.hospitals.team.index', compact('teams','hospital'));
            }
        } else {
            abort(404);
        }
    }

    /**
     * Show hospital team listing
     *
     * @param \Illuminate\Http\Request $request request attributes
     * 
     * @access public
     *
     * @return View
     */
    public function approveUser(Request $request)
    {
        if (Auth::user() && Helper::getAuthRoleType() === 'hospital') {
            $team = Team::findOrFail($request['id']);
            $team->status = 'approved';
            $team->save();
            if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                $email_params = array();
                $doctor_approve_req_template = DB::table('email_types')->select('id')
                    ->where('email_type', 'doctor_email_doctor_request_approved')->get()->first();
                if (!empty($doctor_approve_req_template->id)) {
                    $hospital = User::findOrFail($team->user_id);
                    $doctor = User::findOrFail($team->doctor_id);
                    $template_data = EmailTemplate::getEmailTemplateByID($doctor_approve_req_template->id);
                    $email_params['doctor_name'] = Helper::getUserName($doctor->id);
                    $email_params['hospital_name']  = Helper::getUserName($hospital->id);
                    $email_params['hospital_link']  = url('profile/'.$hospital->slug);
                    Mail::to($doctor->email)
                        ->send(
                            new DoctorEmailMailable(
                                'doctor_email_doctor_request_approved',
                                $template_data,
                                $email_params
                            )
                        );
                }
            }  
            return response()->json(
                [
                'type' => 'success',
                'message' => trans('lang.success')
                ]
            );
        } else {
            return response()->json(
                [
                'type' => 'error',
                'message' => trans('lang.error')
                ]
            );
        }
    }

    /**
     * Show hospital team listing
     *
     * @param \Illuminate\Http\Request $request request attributes
     * 
     * @access public
     *
     * @return View
     */
    public function rejectUser(Request $request)
    {
        if (Auth::user() && Helper::getAuthRoleType() === 'hospital') {
            $team = Team::findOrFail($request['id']);
            $team->status = 'cancelled';
            $team->save();
            if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                $email_params = array();
                $doctor_cancelled_req_template = DB::table('email_types')->select('id')
                    ->where('email_type', 'doctor_email_doctor_request_cancelled')->get()->first();
                if (!empty($doctor_cancelled_req_template->id)) {
                    $hospital = User::findOrFail($team->user_id);
                    $doctor = User::findOrFail($team->doctor_id);
                    $template_data = EmailTemplate::getEmailTemplateByID($doctor_cancelled_req_template->id);
                    $email_params['doctor_name'] = Helper::getUserName($doctor->id);
                    $email_params['hospital_name']  = Helper::getUserName($hospital->id);
                    $email_params['hospital_link']  = url('profile/'.$hospital->slug);
                    Mail::to($doctor->email)
                        ->send(
                            new DoctorEmailMailable(
                                'doctor_email_doctor_request_cancelled',
                                $template_data,
                                $email_params
                            )
                        );
                }
            }  
            return response()->json(
                [
                'type' => 'success',
                'message' => trans('lang.success')
                ]
            );
        } else {
            return response()->json(
                [
                'type' => 'error',
                'message' => trans('lang.error')
                ]
            );
        }
    }

    /**
     * Delete hospital doctor
     *
     * @param \Illuminate\Http\Request $request request attributes
     * 
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUser(Request $request)
    {
        if (Auth::user() && Helper::getAuthRoleType() === 'hospital') {
            $team = Team::findOrFail($request['id']);
            $team->delete();
            return response()->json(
                [
                'type' => 'success',
                'message' => trans('lang.success')
                ]
            );
        }
        elseif (Auth::user() && Helper::getAuthRoleType() === 'admin') {
            $team = Team::findOrFail($request['id']);
            $team->delete();
            return response()->json(
                [
                    'type' => 'success',
                    'message' => trans('lang.success')
                ]
            );
        }
        else {
            return response()->json(
                [
                'type' => 'error',
                'message' => trans('lang.error')
                ]
            );
        }
    }
    public function forHospital() {
        $user_ = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];
       $doctors = User::role('doctor')->with('profile','specialities','location')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->latest()->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->latest()->limit(4)->get();
        /*Locations*/
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();
         $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','banner_video_section','services_tab_sec'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        return view('front-end.for-hospital.index',
            compact(
                'specialities', 'logged_user', 'laboratories', 'cities', 'services', 'diseases',
                'specialities', 'hospitals', 'doctors', 'managements','segments'
            )
        );
    }
    
}
