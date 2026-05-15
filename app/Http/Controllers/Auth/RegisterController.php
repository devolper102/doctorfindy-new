<?php

/**
 * Class RegisterController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @version <PHP: 1.0.0>
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Session;
use App\UserMeta;
use DB;
use App\EmailTemplate;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneralEmailMailable;
use App\Order;
use App\OrderMeta;
use App\Package;
use Carbon\Carbon;

/**
 * Class RegisterController
 *
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Validate user input.
     *
     * @param mixed $request Request Attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'server_error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator, 'register');
        } else {
            event(new Registered($user = $this->create($request->all())));
            /*if (empty(config('mail.username')) && empty(config('mail.password'))) {
                $json['email'] = $user['email'];
                $json['url'] = $user['url'];
            }*/
            $json['type'] = 'success';
            return $json;
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data return data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            []
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $request returns request
     *
     * @return \App\User
     */

    public function vueRegistration(Request $request) {
      // dd($request->all());
        $json = array();
//        $verification_code = Helper::generateRandomCode(6);
        // $verification_code = '123456';
        if (!empty($request)) {
            $user = User::where('phone_number', $request['phone_number'])->get();
            if (count($user) > 0) {
                $json['type'] = 'error';
                $json['message'] = 'User already registered';
            }
            else {
                        if ($request['select_degree'] === 'pmdc') {
                                $pmdc_number = $request['pmdc_number'];
                        }
                        else{
                            $pmdc_number = null;
                        }
                        if ($request['select_degree'] === 'ncs') {
                            $ncs_number = $request['ncs_number'];
                        }
                        else{
                            $ncs_number = null;
                        }
                        if($request['selectLocation'] !== null)
                        {
                            $location=$request['selectLocation'];
                            $location_id=$location['id'];
                            $location_title=$location['title'];

                        }
                $user = User::create([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'email' => $request['email'],
                    // 'verification_code' => $verification_code,
                    'slug' => filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['last_name'], FILTER_SANITIZE_STRING),
                    'password' => Hash::make($request['password']),
                    'phone_number' => $request['phone_number'],
                    'select_degree' => $request['select_degree'],
                    'pmdc_number' => $pmdc_number,
                    'ncs_number' => $ncs_number,
                ]);
                if($request->role === 'doctor')
                {
                    $user->location_id=$location_id;
                    $user->update();
                    if($request['selectedSpeciality'])
                    {
                       $specialities= $request['selectedSpeciality'];
                       $current = Carbon::now();
                       foreach($specialities as $specialty)
                       {
                          DB::table('user_speciality')->insert([
                                [
                                    'user_id'          => $user->id,
                                    'speciality_id'       => $specialty['id'],
                                    'created_at'       => $current,
                                    'updated_at'       => $current
                                ]
                            ]);
                       }
                    }
                }
                $user_mate = UserMeta::create([
                    'user_id' => $user->id,
                    'experiences' => null,
                    'specializations' => null,
                    'memberships' => null,
                    'ducations' => null,
                    'awards' => null,
                    'services' => null,
                    'avatar' => null,
                    'banner' => null,
                    'gender' => null,
                    'gender_title' => null,
                    'sub_heading' => null,
                    'tagline' => null,
                    'short_desc' => null,
                    'description' => null,
                    'delete_reason' => null,
                    'delete_description' => null,
                    'payout_id' => null,
                    'profile_searchable' => null,
                    'weekly_alerts' => null,
                    'disable_account' => null,
                    'message_alerts' => null,
                    'verify_medical' => null,
                    'consultation_fee' => null,
                    'saved_hospitals' => null,
                    'saved_doctors' => null,
                    'saved_articles'=> null,
                    'downloads' => null,
                    'address'  => null,
                    'longitude' => null,
                    'latitude' => null,
                    'verify_registration'=> 0,
                    'recommendation' => null,
                    'votes' => null,
                    'available_days' => null,
                    'working_time' => null,
                    'liked_answers' => null,
                    'starting_price' => null,
                    'payout_settings' => null,
                    'gallery' => null,
                    'gallery_videos' => null,
                    'willing_video' => null,
                    'willing_home_visit' => null,
                    'extend' => '',
                    'mark_red' => null, 
                    'mark_incomplete' => null,
                    'leave' => null,
                    'created_extend' => null,
                    'fees_range' => null, 
                    'commission' => null, 
                    'faqs'=> null,
                    'total_experience' => null,
                    'bank_data' => null,
                    'add_longitude' => null,
                    'language' => null,
                    'user_metascol' => null,

                ]);
                $user_data = $user;
                //$user->update(['verification_code' => $verification_code]);
                $role = DB::table('roles')->select('name')->where('role_type', $request['role'])->first();
                $user->assignRole($role->name);
                //$msg_string = 'Your verification code is '.$verification_code;
                // Helper::sendSms($msg_string,$request['phone_number']);
                // $json['result'] = $user;
                // $json['user_data'] = $user_data;
                // $json['type'] = 'success';
                // $json['message'] = 'A verification sent on your mobile number';
                auth()->login($user);
                $id = Auth::id();
                $user = User::where('id',$id)->with('profile')->with('roles')->first();
                $json['type'] = 'success';
                $json['user'] = $user;
                $json['message'] = 'Your account Created successfully';
                 
             // return $user;
            }
        }
        return $json;
    }
    protected function createClientCheckout(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'first_name' => ['required', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ_.,() ]+$/'],
            'address' => ['required'],
            'phone_number' => ['required', 'string', 'min:11','size:11',"regex:/^([0-9\s\-\+\(\)]*)$/"]
        ]);
        if ($request['address'] == "null") {
            $this->validate($request, [
                'address' => ['required']
            ]);
        }
        $json = array();
         if (!empty($request)) {
            if ($request['patient_id']) {
                $user = User::where(['id'=>$request['patient_id'],'phone_number'=>$request['phone_number']])->first();
                if ($user){
                    $json['result'] = $user;
                    $json['user_data'] = $user;
                    $json['type'] = 'success';
                    $json['message'] = 'Your account created successfully';
                    return response()->json($json);
                }else{
                    $user = User::where('id',$request['patient_id'])->with('profile')->first();
                    if ($user) {
                       if ($user->phone_number && $user->profile->address) {
                            $json['result'] = $user;
                            $json['user_data'] = $user;
                            $json['type'] = 'success';
                            $json['message'] = 'Your account created successfully';
                            return response()->json($json);
                        }else{
                            $usermeta = UserMeta::where('user_id',$user->id)->first();
                            $user->phone_number = $request['phone_number'];
                            $user->update();
                            $usermeta->address = $request['address'];
                            $usermeta->update();
                            $json['result'] = $user;
                            $json['user_data'] = $user;
                            $json['type'] = 'success';
                            $json['message'] = 'Your account created successfully';
                            return response()->json($json);
                        }
                    }else{
                        $this->validate($request, [
                            'first_name' => ['required', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ_.,() ]+$/'],
                            'phone_number' => ['required', 'string', 'min:11','size:11',"regex:/^([0-9\s\-\+\(\)]*)$/"],
                            'address' => ['required'],
                        ]);
                        $user = User::create([
                            'first_name' => $request['first_name'],
                            "last_name" => $request['first_name'],
                            'phone_number' => $request['phone_number'],
                            'slug' => filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['first_name'], FILTER_SANITIZE_STRING),
                            'password' => Hash::make("dummy123"),
                        ]);
                        $user->assignRole(['patient']);
                        $user_data = $user;
                        $user_mate = UserMeta::create([
                            'user_id' => $user->id,
                            'address' => $request['address']
                        ]);
                        $user = User::where('id',$user->id)->with('roles')->first();
                        $json['result'] = $user;
                        $json['user_data'] = $user_data;
                        $json['type'] = 'success';
                        $json['message'] = 'Your account created successfully';
                        return response()->json($json);
                    }
                }
            }else{
                        $this->validate($request, [
                            'first_name' => ['required', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ_.,() ]+$/'],
                            'phone_number' => ['required', 'string', 'min:11','size:11',"regex:/^([0-9\s\-\+\(\)]*)$/"],
                            'address' => ['required'],
                        ]);
                        $user = User::create([
                            'first_name' => $request['first_name'],
                            "last_name" => $request['first_name'],
                            'phone_number' => $request['phone_number'],
                            'slug' => filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['first_name'], FILTER_SANITIZE_STRING),
                            'password' => Hash::make("dummy123"),
                        ]);
                        $user->assignRole(['patient']);
                        $user_data = $user;
                        $user_mate = UserMeta::create([
                            'user_id' => $user->id,
                            'address' => $request['address']
                        ]);
                        $user = User::where('id',$user->id)->with('roles')->first();
                        $json['result'] = $user;
                        $json['user_data'] = $user_data;
                        $json['type'] = 'success';
                        $json['message'] = 'Your account created successfully';
                        return response()->json($json);
            }
        }
    }

}
