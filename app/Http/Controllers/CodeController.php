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

    public function sendVerificationCode(Request $request)
    {
        try {
            $number = $request->input('phone_number');
            $firstName = trim($request->input('first_name', 'Patient'));
            $firstName = $firstName !== '' ? $firstName : 'Patient';
            $otc = '123456';

            if (empty($number)) {
                return response()->json([
                    'type' => 'error',
                    'message' => 'Phone number is required.',
                ], 422);
            }

            $user = User::where('phone_number', $number)->first();

            if ($user) {
                $user->verification_code = $otc;
                $user->save();
            } else {
                $user = User::create([
                    'first_name' => $firstName,
                    'last_name' => '',
                    'verification_code' => $otc,
                    'slug' => $this->makeUniquePatientSlug($firstName, $number),
                    'password' => password_hash('doctorfindy.com', PASSWORD_DEFAULT),
                    'phone_number' => $number,
                ]);

                UserMeta::firstOrCreate([
                    'user_id' => $user->id,
                ]);
            }

            auth()->login($user);

            $role = DB::table('roles')->select('name')->where('role_type', 'patient')->first();
            if ($role && ! $user->hasRole($role->name)) {
                $user->assignRole($role->name);
            }

            return response()->json([
                'type' => 'success',
                'user' => $user->load('roles', 'profile'),
                'message' => 'Appointment Booked successfully',
                'code' => $otc,
            ]);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'type' => 'error',
                'message' => 'Unable to send verification code. Please try again.',
            ], 500);
        }
    }

    protected function makeUniquePatientSlug($firstName, $number)
    {
        $baseSlug = Str::slug($firstName);
        if ($baseSlug === '') {
            $baseSlug = 'patient';
        }

        $baseSlug .= '-' . substr(preg_replace('/\D+/', '', $number), -4);
        $slug = $baseSlug;
        $counter = 1;

        while (User::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
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
