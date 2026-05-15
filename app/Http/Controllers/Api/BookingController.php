<?php

namespace App\Http\Controllers\Api;

use DB;
use Auth;
use Hash;
use App\User;
use Validator;
use App\Helper;
use App\Article;
use App\Disease;
use App\LabCode;
use App\Service;
use App\BookTest;
use App\Feedback;
use App\Location;
use Carbon\Carbon;
use App\Speciality;
use App\Appointment;
use App\LabDiscount;
use App\SiteManagement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FriendAndFamily;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    /**
     * Store patient appointment
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function bookAppointment(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [ 
                        'first_name' => ['required', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ_.,() ]+$/'],
                        'phone_number' => ['required', 'string', 'size:11',"regex:/^([0-9\s\-\+\(\)]*)$/"],
                        'doctor_id' => ['required'],
                        'hospital_id' => ['required'],
                        'time' => ['required'],
                        'date' => ['required'],
                        'charges' => ['required'],
                        'type' => ['required'],
                        'booked_for' => ['required'],
                    ]);

                  if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                  }
        if($request['booked_for']==="me"){
             if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            $token = Auth::guard('api')->tokenById($user->id);
        }
        else{
            $number = $request['phone_number'];
        $user = User::where('phone_number', $request['phone_number'])->first();
        if($user){
        $token = Auth::guard('api')->login($user);
            }else{
                if($request['otp']){
                    $password = $request['otp'] . substr($request['first_name'], 0, 3);
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $user = User::create([
                        'first_name' => $request['first_name'],
                        'last_name' => '',
                        'password' => $hashedPassword,
                        'phone_number' => $request['phone_number'],
                        'verification_code' => $request['otp'],
                        'slug' => filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['last_name'], FILTER_SANITIZE_STRING),
                    ]);
                        // dd($user);
                        $user->assignRole('patient');
                        $token = Auth::guard('api')->login($user);
                    }else{
                      $json['type'] = 'otp required';
                        return $json;
                    }
                }
        }
        if (Auth::guard('api')->user()) {
            $authuser = Auth::guard('api')->user();
            $userOtp = $authuser->verification_code;
            $passwords = $userOtp .'doctorfindy';
            if (password_verify($passwords, $authuser->password)) {
                $json = array();
            $appointment = new Appointment();
            $patient_id = Auth::guard('api')->user()->id;
            $patient_name = Auth::guard('api')->user()->first_name;
            $doctor_id = $request['doctor_id'];
            $hospital_id = intval($request['hospital_id']);
            
            $appointment->user_id = $doctor_id;
            $appointment->patient_id = $patient_id;
            $appointment->patient_name = $patient_name;
            $appointment->hospital_id = $hospital_id;
            $appointment->appointment_time = $request['time'];
            $appointment->appointment_date = $request['date'];
            $appointment->charges = $request['charges'];
            $appointment->status = 'pending';
            $appointment->type = $request['type'];
            $appointment->booked_by = 'user';
            $appointment->save();
            $json['appointment'] = $appointment;
            $json['type'] = 'success';
            $json['password'] = $passwords;
            $json['token'] = $token;
            return $json;
            }        
        } else {
            $json['type'] = 'error';
            return $json;
        }
          }
          if($request['booked_for']==="other"){
            $relativeId = $request['relative_id'];
            $patientName =FriendAndFamily::where('id', $relativeId)->first()->name;
            // dd( $patientName);
             if (Auth::guard('api')->check()) {
                $user = Auth::guard('api')->user();
                // dd($user);
                $token = Auth::guard('api')->tokenById($user->id);
                $json = array();

                $appointment = new Appointment();
                $patient_id = Auth::guard('api')->user()->id;
                $doctor_id = $request['doctor_id'];
                $hospital_id = intval($request['hospital_id']);
                
                $appointment->user_id = $doctor_id;
                $appointment->patient_id = $patient_id;
                $appointment->patient_name = $patientName;
                $appointment->hospital_id = $hospital_id;
                $appointment->appointment_time = $request['time'];
                $appointment->appointment_date = $request['date'];
                $appointment->charges = $request['charges'];
                $appointment->status = 'pending';
                $appointment->type = $request['type'];
                $appointment->booked_by = 'user';
                $appointment->relative_id = $relativeId;
                $appointment->save();
                $json['appointment'] = $appointment;
                $json['type'] = 'success';
                $json['token'] = $token;
                return $json;

            }
            
          }        
    }
    /**
     * Cancel patient appointment
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelAppointment(Request $request){
        // dd(Auth::id());
        // dd($request);
        $validator = Validator::make($request->all(), [ 
                        'appointment_id' => ['required'],
                    ]);

                  if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                  }
        $appointment = Appointment::where('id', $request->appointment_id)->first();
        // dd($appointment);
        $appointment->status = $request->status;
        $appointment->notes = $request->notes;
        // dd($appointment);

        $appointment->update();
        // dd($appointment);
        return response()->json([
                    "msj" => "Appointment Canceled Successfully",
                    "status" => "success",
                    "statusCode" => 200,
                    "appointment" => $appointment
                ],200);

    }
    /**
     * Re-schedule patient appointment
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function rescheduleAppointment(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [ 
                        'appointment_id' => ['required'],
                        'appointment_time' => ['required'],
                        'appointment_date' => ['required'],
                    ]);

                  if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                  }
        // $appointment = Appointment::where('id', $request->appointment_id)->where('patient_id', Auth::id())->first();
        $appointment = Appointment::where('id', $request->appointment_id)->first();
        // dd($appointment);
        $appointment->appointment_time = $request->appointment_time;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->save();
        // dd($appointment);
        return response()->json([
                    "msj" => "Appointment Re-scheduled Successfully",
                    "status" => "success",
                    "statusCode" => 200,
                    "appointment" => $appointment
                ],200);

    }
    /**
     * Book Lab Test
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    // public function bookLabTest(Request $request){
    //     // dd($request->all());
    //     $validator = Validator::make($request->all(), [ 
    //                     'full_name' => ['required', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ_.,() ]+$/'],
    //                     'phone_number' => ['required', 'string', 'size:11',"regex:/^([0-9\s\-\+\(\)]*)$/"],
    //                     'branch_id' => ['required'],
    //                     'lab_id' => ['required'],
    //                     'city_id' => ['required'],
    //                     'test_ids' => ['required'],
    //                     'date_preferred' => ['required'],
    //                     'email' => ['required', 'email'],
    //                 ]);
    //     if($request->home_sampling == 1){
    //         $validator = Validator::make($request->all(), [ 
    //                     'address' => ['required'],
    //                 ]);
    //     }
    //               if ($validator->fails()) {
    //                 return response()->json($validator->errors(), 422);
    //               }
    //     if (Auth::guard('api')->check()) {
    //         $user = Auth::guard('api')->user();
    //         $token = Auth::guard('api')->tokenById($user->id);
    //     }
    //     else{
    //     $number = $request['phone_number'];
    //     $user = User::where('phone_number', $request['phone_number'])->first();
    //     if($user){
    //     $token = Auth::guard('api')->login($user);
    //     //    dd($token);
    //                 }else{
    //                     if($request['otp']){
    //                         // dd('dfdf');
    //                 $password = $request['otp'] . substr($request['full_name'], 0, 3);
    //                 // dd($password);
    //                 $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    //                  $user = new User();
    //                  $user->first_name=$request['full_name'];
    //                  $user->last_name='';
    //                  $user->password= $hashedPassword;
    //                  $user->phone_number= $request['phone_number'];
    //                  $user->verification_code = $request['otp'];
    //                  dd($user->verification_code);
    //                  $user->slug = filter_var($request['full_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['last_name'], FILTER_SANITIZE_STRING);
                
    //                 dd($user->slug);
    //                  $user->save();
    //                     dd($user);
    //                     $user->assignRole('patient');
    //                     $token = Auth::guard('api')->login($user);
    //                 }else{
    //                   $json['type'] = 'otp required';
    //                     return $json;
    //                 }
    //                 $user->assignRole('patient');
    //                 $token = Auth::guard('api')->login($user);
    //                 }
    //     }
    //         if (Auth::guard('api')->user()) {
    //         $json = Array();
    //     $result = BookTest::create([
    //         'lab_id' => $request['lab_id'],
    //         'branch_id' => $request['branch_id'],
    //         'test_id' => json_encode($request['test_ids']),
    //         'full_name' => $request['full_name'],
    //         'email' => $request['email'],
    //         'city' => $request['city_id'],
    //         'age' => $request['age'],
    //         'phone_number' => $request['phone_number'],
    //         'gender' => $request['gender'],
    //         'date_preferred' => $request['date_preferred'],
    //         'home_sampling' => $request['home_sampling'],
    //         'address' => $request['address'],
    //         'user_id' => $request['user_id'],
    //         'status' => $request['status'],
    //     ]);
    //     $bookedTests = $result;
    //     if($request['lab_id'] == 13052){
    //     $discountCode = LabCode::where('Status',0)->first();
    //     $discountCode->Status = 1;
    //     $discountCode->save();
    //     $json['discountCode'] = $discountCode->CouponNumber;
    //     $labDiscount = new LabDiscount();
    //     $labDiscount->name = $request['full_name'];
    //     $labDiscount->phone_number = $request['phone_number'];
    //     $labDiscount->code = $discountCode->CouponNumber; 
    //     $labDiscount->address = $request['address'];
    //     $labDiscount->home_sampling = $request['home_sampling'];
    //     $labDiscount->user_id = $request['user_id'];
    //     $labDiscount->test_id = json_encode($request['test_ids']);
    //     // dd($labDiscount->test_id);

    //     $labDiscount->save();
    // }
    //     // dd('lastInsertId',$lastInsertId);
    //     $json['bookedTests'] = $bookedTests;
    //     $json['type'] = 'success';
    //     $json['message'] = 'Test Booked Successfully';
    //     return $json;
        
    //     } else {
    //         $json['type'] = 'error';
    //         return $json;
    //     }

    // }
    public function bookLabTest(Request $request)
{
    $validator = Validator::make($request->all(), [
        'full_name' => ['required', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ_.,() ]+$/'],
        'phone_number' => ['required', 'string', 'size:11', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
        'branch_id' => ['required'],
        'lab_id' => ['required'],
        'city_id' => ['required'],
        'test_ids' => ['required'],
        'date_preferred' => ['required'],
        'email' => ['required', 'email'],
    ]);

    if ($request->home_sampling == 1) {
        $validator->after(function ($validator) use ($request) {
            if (empty($request->address)) {
                $validator->errors()->add('address', 'Address is required for home sampling.');
            }
        });
    }

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    if (Auth::guard('api')->check()) {
        $user = Auth::guard('api')->user();
        $token = Auth::guard('api')->tokenById($user->id);
    } else {
        $user = User::where('phone_number', $request->phone_number)->first();
        // dd(  $user);
        if (!$user) {
            if (!$request->has('otp')) {
                // dd('dfd');
                return response()->json(['type' => 'otp required'], 400);
            }

            $password = $request->otp . substr($request->full_name, 0, 3);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $user = new User();
            $user->first_name = $request->full_name;
            $user->last_name = '';
            $user->password = $hashedPassword;
            $user->phone_number = $request->phone_number;
            $user->verification_code = $request->otp;
            // dd($user->verification_code);
            $user->slug = filter_var($request->full_name, FILTER_SANITIZE_STRING) . '-' . filter_var('', FILTER_SANITIZE_STRING);
            $user->save();
            // dd( $user);
            $user->assignRole('patient');
        }

        $token = Auth::guard('api')->login($user);
    }

    if (Auth::guard('api')->user()) {
        $bookedTest = BookTest::create([
            'lab_id' => $request->lab_id,
            'branch_id' => $request->branch_id,
            'test_id' => json_encode($request->test_ids),
            'full_name' => $request->full_name,
            'email' => $request->email,
            'city' => $request->city_id,
            'age' => $request->age,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'date_preferred' => $request->date_preferred,
            'home_sampling' => $request->home_sampling,
            'address' => $request->address,
            'user_id' => $user->id,
            'status' => $request->status,
        ]);

        if ($request->lab_id == 13052) {
            $discountCode = LabCode::where('Status', 0)->first();
            $discountCode->Status = 1;
            $discountCode->save();

            $labDiscount = new LabDiscount();
            $labDiscount->name = $request->full_name;
            $labDiscount->phone_number = $request->phone_number;
            $labDiscount->code = $discountCode->CouponNumber;
            $labDiscount->address = $request->address;
            $labDiscount->home_sampling = $request->home_sampling;
            $labDiscount->user_id = $user->id;
            $labDiscount->test_id = json_encode($request->test_ids);
            $labDiscount->save();

            $json['discountCode'] = $discountCode->CouponNumber;
        }

        $json['bookedTests'] = $bookedTest;
        $json['type'] = 'success';
        $json['message'] = 'Test Booked Successfully';
        return $json;
    } else {
        return response()->json(['type' => 'error'], 400);
    }
}

    public function bookTestRecord(Request $request)
    {  
        // dd($reques->all());
        $user=Auth::guard('api')->user();
        if ($user) {
            // dd($user);
        $bookedtest = BookTest::with(['lab.profile'])->where('user_id',$user->id)
            ->select('id', 'lab_id', 'test_id','date_preferred','status')
            ->get()
            ->map(function ($item) use ($user){
                $labFirstName = $item->lab->first_name;
                // dd($labFirstName);
                $labLastName = $item->lab->last_name;
                $labLogo = $item->lab->profile->avatar;
                $item->first_name = $labFirstName;
                $item->last_name = $labLastName;
                $item->avatar = $labLogo;
                unset($item->lab);
                $discountCodes = LabDiscount::where('user_id', $user->id)
                    ->where('test_id', $item->test_id)->select('id','code')
                    ->get()->unique('code');

                // Attach discount codes
                $item->discount_codes = $discountCodes;

                return $item;
            });
        return response()->json([
            'bookedtest' => $bookedtest,
            'message' => 'Book Test fetch Successfully'
        ]);
        } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    }
    // public function getBookedTests()
    // {
    //     if (Auth::guard('api')->user()) {
    //     $discountCodes = LabDiscount::whereIn('phone_number', function ($query) {
    //         $query->select('phone_number')
    //               ->from('book_tests')
    //               ->where('lab_id', 13052); 
    //     })
    //     ->get();

    //     $responseData = $discountCodes->map(function ($discountCode) {
    //         $bookTest = BookTest::where('phone_number', $discountCode->phone_number)
    //                         ->where('lab_id', 13052)
    //                         ->with(['lab.profile']) 
    //                         ->select('id', 'lab_id', 'test_id')
    //                         ->first();
    //                         $labFirstName = $bookTest->lab->first_name;
    //                         $labLastName = $bookTest->lab->last_name;
    //                         $labLogo = $bookTest->lab->profile->avatar;
                            
    //     return [
    //         'name' => $discountCode->name,
    //         'phone_number' => $discountCode->phone_number,
    //         'code' => $discountCode->code,
    //         'address' => $discountCode->address,
    //         'age' => $discountCode->age,
    //         'home_sampling' => $discountCode->home_sampling,
    //         'date_preferred' => $bookTest ? $bookTest->date_preferred : null,
    //         'first_name' => $labFirstName,
    //         'last_name' => $labLastName,
    //         'avatar' => $labLogo,
    //     ];
    // });

    // return response()->json([
    //     'discount_codes' => $responseData,
    //     'message' => 'Discount Codes Fetched Successfully'
    // ]);
    // } else {
    //     return response()->json(['error' => 'Unauthorized'], 401);
    // }
    // }
    public function getBookedTests()
   {
    $user = Auth::guard('api')->user();
    if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    $user_id = $user->id;
    $bookedTests = BookTest::where('user_id', $user_id)
                            ->where('lab_id', '!=', 13052)
                            ->with(['lab.profile'])
                            ->get();
                            // dd($bookedTests);
    $discountCodes = LabDiscount::where('user_id', $user_id)->get();
     $responseData = $discountCodes->map(function ($discountCode) {
        return [
            'name' => $discountCode->name,
            'phone_number' => $discountCode->phone_number,
            'code' => $discountCode->code,
            'address' => $discountCode->address,
            'age' => $discountCode->age,
            'home_sampling' => $discountCode->home_sampling,
            'lab_name'=>'Chughtai Lab',
            // 'date_preferred' => $bookedTest ? $bookedTest->date_preferred : null,
        ];
    });
    return response()->json([
        'discount_codes' => $responseData,
        'booked_tests' => $bookedTests,
        'message' => 'Discount Codes and Booked Tests Fetched Successfully'
    ]);
    }

    public function getPatientAppointments(){
        // dd(Auth::user());
            $patient = User::where('id', Auth::id())->with('appointments_patient','profile')->first();
                return response()->json([
                    "patient" => $patient,
                    "status" => "success",
                    "statusCode" => 200
                ],200);
    }
}
