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
        config(['laravel-model-caching.enabled' => false]);

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

            $userRow = DB::table('users')->where('phone_number', $number)->first();

            if ($userRow) {
                DB::table('users')->where('id', $userRow->id)->update([
                    'verification_code' => $otc,
                    'updated_at' => Carbon::now(),
                ]);
                $userId = $userRow->id;
            } else {
                $userId = DB::table('users')->insertGetId([
                    'first_name' => $firstName,
                    'last_name' => '',
                    'verification_code' => $otc,
                    'slug' => $this->makeUniquePatientSlug($firstName, $number),
                    'password' => password_hash('doctorfindy.com', PASSWORD_DEFAULT),
                    'phone_number' => $number,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                DB::table('user_metas')->updateOrInsert(
                    ['user_id' => $userId],
                    ['updated_at' => Carbon::now(), 'created_at' => Carbon::now()]
                );

            }

            $userRow = DB::table('users')->where('id', $userId)->first();

            $role = DB::table('roles')->select('id', 'name')->where('role_type', 'patient')->first();
            if ($role) {
                $hasRole = DB::table('model_has_roles')
                    ->where('role_id', $role->id)
                    ->where('model_type', User::class)
                    ->where('model_id', $userId)
                    ->exists();

                if (! $hasRole) {
                    DB::table('model_has_roles')->insert([
                        'role_id' => $role->id,
                        'model_type' => User::class,
                        'model_id' => $userId,
                    ]);
                }
            }

            return response()->json([
                'type' => 'success',
                'user' => [
                    'id' => $userRow->id,
                    'first_name' => $userRow->first_name,
                    'last_name' => $userRow->last_name,
                    'slug' => $userRow->slug,
                    'phone_number' => $userRow->phone_number,
                ],
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

        while (DB::table('users')->where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function codeVerification(Request $request)
    {
        config(['laravel-model-caching.enabled' => false]);

        $number = $request->input('phone_number');
        $code = $request->input('verification_code');

        if (empty($number) || empty($code)) {
            return response()->json([
                'type' => 'error',
                'message' => 'Phone number and verification code are required.',
            ], 422);
        }

        $userRow = DB::table('users')
            ->where('phone_number', $number)
            ->where('verification_code', $code)
            ->first();

        if (! $userRow) {
            return response()->json([
                'type' => 'error',
                'message' => 'Verification Code not matched',
            ], 422);
        }

        DB::table('users')->where('id', $userRow->id)->update([
            'verification_code' => null,
            'updated_at' => Carbon::now(),
        ]);

        $user = (new User())->newInstance((array) $userRow, true);
        $user->setRelation('roles', collect());
        $user->setRelation('profile', null);
        auth()->login($user);

        return response()->json([
            'type' => 'success',
            'user' => $user,
            'message' => 'Your account verified successfully',
        ]);
    }
}
