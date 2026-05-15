<?php

namespace App\Http\Controllers;

use App\Code;
use App\Helper;
use App\User;
use Auth;
use App\UserMeta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function resendCode(Request $request)
    {
        $user = User::with('codes')->where('phone_number',$request->number)->first();
        $json['exceed'] = false;
        $current_time = Carbon::now();

        if($user->exceed_time != null) {
            $exceed_time = new Carbon($user->exceed_time);
            $exceed_time_difference = $current_time->diffInSeconds($exceed_time);
            $exceed_time_difference = round($exceed_time_difference/60);
            if ($exceed_time_difference >= 10 && $user->codes()->count() >= 3) {
                Code::where('user_id', $user->id)->delete();
            }
        }
        if ($user->codes()->count() >= 3) {
            $json['exceed'] = true;
            $user->exceed_time = Carbon::now();
            $user->save();

            return $json;
        }

        $phone_number = $user->phone_number;
        $verification_code = "";
        $code_time = new Carbon($user->updated_at);
        $time_diff = $current_time->diffInSeconds($code_time);
        $time_difference = round($time_diff/60);

        if($time_difference > 10){
            $verification_code = rand(100000, 999999);
            Helper::sendSms($verification_code,$phone_number);
            $user->verification_code = $verification_code;
            $user->save();
        }else{
            $verification_code = $user->verification_code;
            Helper::sendSms($verification_code,$phone_number);
            $user->verification_code = $verification_code;
            $user->save();
        }
        $user = Code::create([
            'code' => $verification_code,
            'user_id' => $user->id

        ]);
        $json['type'] = "success";
        $json['message'] = "Verification code resend successfully";
        return $json;
    }

    public function appointmentBookedMessage (Request $request) {
        $appointmentDate = date('d-m-Y', strtotime($request['appointmentDate']));
        $appointmentDay = date('l', strtotime($request['appointmentDate']));
        $patientText = 'Dear'.' '.$request['patientData']['first_name'].' '.$request['patientData']['last_name'].' your appointment booked with '.
            $request['doctorData']['first_name'].' '.$request['doctorData']['last_name'].' on '.$appointmentDay.' '.$appointmentDate.
            ' at '.$request['appointmentTime'].'. On appointment approval a short message will sent you.'
        ;
        Helper::sendSms($patientText,$request['patientData']['phone_number']);
        $doctorText = 'Mr/Mrs '.$request['patientData']['first_name'].' '.$request['patientData']['last_name'].' has booked appointment with you. Respond their appointment.';
        Helper::sendSms($doctorText,$request['doctorData']['phone_number']);
        return true;
    }

    public function sendVerificationCode (Request $request) {
        $json = Array();

        $number = $request['phone_number'];
        $otc = Str::random(4);
        $otc = '123456';

        $text = 'Your verification code is ' . $otc;
        if($text != "" && $number != ""){
            $random_string = Str::random(32);
            // $result = Http::get('http://api.itelservices.com/send.php', [
            //     'transaction_id' => $random_string,
            //     'user' => env('DAY_WISE_SMS_USER'),
            //     'pass' => env('DAY_WISE_SMS_PASS'),
            //     'number' => $number,
            //     'text' => $text,
            //     'from' => env('DAY_WISE_SMS_SENDER_ID'),
            //     'type' => 'sms'
            // ]);

            $user = User::where('phone_number', $request['phone_number'])->get();

            if (count($user)) {
                User::where('phone_number', $request['phone_number'])->update(['verification_code' => $random_string]);
                $user = $user->first();
            }
            else {
                $request['last_name'] = '';
                
                $user = User::create([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'verification_code' => $otc,
                    'slug' => filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['last_name'], FILTER_SANITIZE_STRING),
                    'password' => password_hash('doctorfindy.com', PASSWORD_DEFAULT),
                    'phone_number' => $request['phone_number'],
                ]);

                $user_profile = UserMeta::create([
                    'user_id' => $user->id
                ]);
                if (!empty($user_profile->id)) {
                    $user_meta = UserMeta::find($user_profile->id);
                } else {
                    $user_meta =
                    $user_meta = $user_profile;
                }
//            dd($user_profile);
                $user_meta->user()->associate($user);
            }
            auth()->login($user);
            $role = DB::table('roles')->select('name')->where('role_type', 'patient')->first();
            $user->assignRole($role->name);


            $json['type'] = 'success';
            $json['user'] = $user;
            $json['message'] = 'Appointment Booked successfully';
            $json['code'] = $otc;
            return $json;
        }

        return 'failed';
    }

    public function codeVerification(Request $request) {
        $json = Array();
        $user = User::where('phone_number', $request['phone_number'])->with('roles')->first();
        if ($user->verification_code == $request['verification_code']) {
            $user->update([
                'verification_code' => null
            ]);
            $json['type'] = 'success';
            $json['user'] = $user;
            $json['message'] = 'Your account verified successfully';
             auth()->login($user);
             $id = Auth::id();
             $user = User::where('id',$id)->with('profile')->with('roles')->first();
             return $user;
        }
        else {
            $json['type'] = 'error';
            $json['message'] = 'Verification Code not matched';
        }
        return $json;
    }
}
