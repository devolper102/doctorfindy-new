<?php

namespace App\Http\Controllers\Api;

use DB;
use Auth;
use Hash;
use App\Team;
use App\User;
use Validator;
use App\Helper;
use App\Article;
use App\Contact;
use App\Disease;
use App\LabCode;
use App\Product;
use App\Service;
use App\Category;
use App\Feedback;
use App\Location;
use App\UserMeta;
use App\Procedure;
use Carbon\Carbon;
use App\Speciality;
use App\Appointment;
use App\LabDiscount;
use App\SiteManagement;
use App\Models\UserReports;
use App\OnlineConsultation;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\AppUserReview;
use App\Models\MedicalRecord;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Storage;

class HomeController extends Controller
{
    /**
     * HomePage
     *
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getHomepageData(){
        if(Auth::guard('api')->check()){
            $user_id = Auth::guard('api')->user()->id;
            $currentFormattedTime = Carbon::now()->format('h:i A'); // Format current time in 12-hour format with AM/PM
$upcomingAppointment = Appointment::where('patient_id', $user_id)
    ->where(function ($query) use ($currentFormattedTime) {
        $query->where('appointment_date', '>', now()->toDateString())
            ->orWhere(function ($query) use ($currentFormattedTime) {
                $query->where('appointment_date', '=', now()->toDateString())
                    ->where('appointment_time', '>=', $currentFormattedTime);
            });

    })
    ->where(function ($query) {
        $query->where('status', 'pending')
            ->orWhere('status', 'accepted');
    })
    ->with('doctor_profile')
    ->orderBy('appointment_date')
    ->orderBy('appointment_time')
    ->limit(1)->get();


    // dd($upcomingAppointment);
        }
        else{
            $upcomingAppointment = null;
        }
            // dd($upcomingAppointment);
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','home_doctor_sec','home_search_banner','small_devices_top_section'];
        /*Doctors*/
        // $doctors = User::role('doctor')->with('profile','specialities','location','onlines')->limit(4)->get();
        /*Hospital*/
        // $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image','top','trending','app_image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get(); 
        /*Diseases*/
        // $diseases = Disease::select('id','title', 'slug','flag','trending')->limit(4)->get();
        /*Services*/
        // $services = Service::select('id','title', 'slug','image','trending')->limit(4)->get();
        /*Locations*/
        $cities = Location::orderBy("created_at","asc")->get();
        // dd($cities->count());
        /*Blogs Section*/
        $articles = Article::where('is_featured', '1')->with('author','categories')->orderBy("created_at","desc")->limit(3)->get();
        /*Feedbacks*/
        // $feedbacks = Feedback::with('patient')->where('approval', '1')->orderBy("created_at","asc")->limit(3)->get();
        /*All Procedure*/
        // $procedures = Procedure::where('top', '1')->with('cities')->orderBy("created_at","asc")->limit(6)->get();
        // $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        if(Auth::guard('api')->user()){
            $user = Auth::guard('api')->user();
        }else{
            $user = [];
        }
        $logged_user = $user;
        return response()->json([
                                    'status' => 200,
                                    'msg' => 'HomePage Data fetch Successfully',
                                    // 'doctors'=>$doctors,
                                    // 'hospitals'=>$hospitals,
                                    'laboratories'=>$laboratories,
                                    'specialities'=>$specialities,
                                    // 'diseases'=>$diseases,
                                    // 'services'=>$services,
                                    'cities'=>$cities,
                                    'articles'=>$articles,
                                   //  'feedbacks'=>$feedbacks,
                                    // 'procedures'=>$procedures,
                                    // 'managements'=>$managements,
                                    'logged_user'=>$logged_user,
                                    'upcomingAppointment'=>$upcomingAppointment,
                                ]);
    }
    /**
     * Blogs Page
     *
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getBlogs(){
        $categories = Category::with('articles')->with('speciality')->with('subCategories')->get();
        // dd($categories);
        $articles = Article::with('categories')->where('status','approved')->orderBy('views','desc')->with('author')->paginate(10);
        return response()->json([
                                    'status' => 200,
                                    'msg' => 'Blogs Data fetched Successfully',
                                    'categories'=>$categories,
                                    'articles'=>$articles
                                ]);
    }
    /**
     * Contact Us form
     *
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function contactUsMessage(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [ 
                        'name' => ['required', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ_.,() ]+$/'],
                        'phone' => ['required', 'string', 'size:11',"regex:/^([0-9\s\-\+\(\)]*)$/"],
                        'subject' => ['required'],
                        'message' => ['required'],
                        'email' => ['required', 'email'],
                    ]);

                  if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                  }
         $data = new Contact();
        $data ->name = $request->name;
        $data ->email = $request->email;
        $data ->phone = $request->phone;
        $data ->subject = $request->subject;
        $data ->message = $request->message;
        $data ->save();
         return response()->json([
                                    'status' => 200,
                                    'msg' => 'Request Sent Successfully',
                                    'data'=>$data
                                ]);
    
    }
    public function getLabDiscountCode(Request $request)
    {   
    // dd($request->all()); 
    if (!LabCode::where('status', 0)->exists()) {
        $maintenanceMessage = 'Discount code functionality is currently unavailable. Please Contact on whatsapp.';
        return response()->json([
            'success' => 0,
            'data' => [
                'message' => $maintenanceMessage,
                'displayDuration' => 8000 
            ]
        ]);
    }
    if($request->home_sampling == false || $request->home_sampling == null){
    $validator = Validator::make( $request->all(), [
        'name' => 'required',
        'phone_number' => 'required|min:11',
    ]);
}
else{
    $validator = Validator::make( $request->all(), [
        'name' => 'required',
        'phone_number' => 'required|min:11',
        'home_sampling' => 'required',
        'age' => 'required',
        'address' => 'required',
    ]);
}
        if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                  }
        $input =$request->all();
         $userDiscountsCount = LabDiscount::where('phone_number', $input['phone_number'])
        ->whereMonth('created_at', now()->month)
        ->count();

    if ($userDiscountsCount >= 3) {
        $response = [
            'success' => 0, 
            'data' => 'You have already received 3 discount codes this month.'
        ];
        return response()->json($response);
    }
        $code = LabCode::where('status',0)->first();
        $input['code'] = $code->CouponNumber;
        LabDiscount::create($input);
        $code->update(['Status'=>1]);
        return response()->json([
                                    'status' => 200,
                                    'msg' => 'Request Sent Successfully',
                                    'data'=>$input
                                          ]);
    }
     public function getDoctorClinics()
    {
         if (Auth::guard('api')->user()) {
        $doctorId = Auth::guard('api')->user()->id;
        // dd($doctorId);
        $hospitalIds = Appointment::where('user_id', $doctorId)->pluck('hospital_id')->unique()->toArray();
        // dd($hospitalIds);
        $hospitals = User::role('hospital')->whereIn('id',$hospitalIds)
            ->with('profile')
            ->get();
        // dd($hospitals);
        return response()->json([
            'status'=>200,
            'hospitals'=>$hospitals,
        ]);
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    }

    public function getDoctorDashboard(Request $request)
   {  
    // dd(Auth::guard('api')->user()->id);
    if (Auth::guard('api')->user()) {
        $doctorId = Auth::guard('api')->user()->id;
       // dd($doctorId);
        $doctor = User::where('id', $doctorId)
        ->with(['appointment' => function($query) {
            $query->select('id', 'patient_id', 'user_id', 'hospital_id', 'patient_name', 'appointment_date', 'appointment_time', 'charges')
                ->latest('appointment_date')->take(1);
        }])
        ->with(['profile' => function($query) {
            $query->select('id','user_id', 'avatar');
                
        }])->first();
        // if ($doctor) {
        //     $uniqueAppointments = $doctor->appointment->unique('patient_id')->values()->toArray();
        //     $doctor->setRelation('appointment', $uniqueAppointments);
        // }
        // dd($doctor);
        // if (!$doctor) {
        //     return response()->json(['error' => 'Doctor not found'], 404);
        // }
        
        // $doctors = User::role('doctor')
        //     ->where('id', '!=', $doctorId)
        //     ->with('profile')
        //     ->latest()
        //     ->limit(4)
        //     ->get();
        // dd($doctors);
        // $hospitals = User::role('hospital')
        //     ->with('profile')
        //     ->latest()
        //     ->limit(4)
        //     ->get();
        // dd($hospitals);
        // $meta_values = ['general_settings'];
        // dd($meta_values);
        // $managements = SiteManagement::whereIn('meta_key', $meta_values)->get();
        // dd($managements);
        return response()->json([
            'status'=>200,
            // 'doctors'=>$doctors,
            // 'managements'=>$managements,
            'doctor'=>$doctor,
        ]);
        
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
// public function showAppointmentsToAdmin()
//     {   
//         if (Auth::guard('api')->user()) {
//             $doctorId = Auth::guard('api')->user()->id;
//             $user = User::find($doctorId);
//             // dd($user);
//             $appointments = $user->appointments;
//             // dd($appointments);
//             $managements  =  SiteManagement::all();
//             // dd($managements);
//             return response()->json([
//                 'status'=>200,
//                 'appointments'=>$appointments,
//                 'managements'=>$managements,
//             ]);
//         } else {
//              return response()->json([
//                 'status'=>401,
//                 'message'=>'Unauthorized',
//             ]);
//         }
//     }
public function showAppointmentsToAdmin()
    {   
        if (Auth::guard('api')->user()) {
            $doctorId = Auth::guard('api')->user()->id;
        //     $user = User::with(['appointments' => function($query) {
        //     $query->select('id', 'patient_id', 'user_id', 'hospital_id', 'patient_name', 'appointment_date', 'appointment_time', 'charges');
        // }])->find($doctorId);
            $user = User::find($doctorId);
            // dd($user);
            // $appointments = $user->appointments()->select('patient_id','user_id','hospital_id','patient_name','appointment_date','appointment_time')->get();
            // dd($appointments);
            $appointments = $user->appointments;
            $managements  =  SiteManagement::all();
            // dd($managements);
            return response()->json([
                'status'=>200,
                'appointments'=>$appointments,
                'managements'=>$managements,
            ]);

        } else {
             return response()->json([
                'status'=>401,
                'message'=>'Unauthorized',
            ]);
        }
    }
    // public function patientAppointment()
    // {   
    //     if (Auth::guard('api')->user()) {
    //         $doctorId = Auth::guard('api')->user()->id;
    //         // dd( $doctorId);
    //         $startOfMonth = now()->startOfMonth()->toDateString();
    //         $endOfMonth = now()->endOfMonth()->toDateString();
    //          $appointments=Appointment::where('user_id',$doctorId)->whereBetween('appointment_date', [$startOfMonth, $endOfMonth])->with('user')->get();
                      
    //         return response()->json([
    //             'status'=>200,
    //             'appointments'=>$appointments,
    //              ]);
            
    //     } else {
    //          return response()->json([
    //             'status'=>401,
    //             'message'=>'Unauthorized',
    //         ]);
    //     }
    // }
    public function patientAppointment($date)
    { 
     // dd($date);
     if (Auth::guard('api')->user()) {
         
         $doctorId = Auth::guard('api')->user()->id;
         $formattedDate = date('Y-m-d', strtotime($date));
         
         // Calculate the start and end date of the month
         $startOfMonth = date('Y-m-01', strtotime($formattedDate));
         $endOfMonth = date('Y-m-t', strtotime($formattedDate));
     
         // Fetch appointments within the entire month
         $appointments = Appointment::where('user_id', $doctorId)
             ->whereBetween('appointment_date', [$startOfMonth, $endOfMonth])
             ->with('user')
             ->get();
     
         return response()->json([
             'status' => 200,
             'appointments' => $appointments,
         ]);
         
     } else {
         return response()->json([
             'status' => 401,
             'message' => 'Unauthorized',
         ]);
     }
 }
 public function getDoctorProfile()
 {
    if (Auth::guard('api')->user()) {
            $doctorId = Auth::guard('api')->user()->id;
            $user = User::where('id',$doctorId)->with(['profile' => function($query) {
            $query->select('id','user_id', 'avatar'); }])->first();
                

            return response()->json([
                'status'=>200,
                'user'=>$user
            ]);

        } else {
             return response()->json([
                'status'=>401,
                'message'=>'Unauthorized',
            ]);
        }  
 }
    public function patientManagement()
    {   
        if (Auth::guard('api')->user()) {
            $doctorId = Auth::guard('api')->user()->id;
            // $user = User::find($doctorId);
            // dd($user);
            $patients = Appointment::where('user_id',$doctorId)->select('patient_id','user_id','hospital_id',
            'patient_name','appointment_date','appointment_time')->with('patient_profileApp')
            ->latest()->get()->unique('patient_id')
            ->values() 
            ->toArray();
            // dd($patients);
            // dd($appointments);
            // $managements  =  SiteManagement::all();
            // dd($managements);
            return response()->json([
                'status'=>200,
                'patients'=>$patients,
                // 'managements'=>$managements,
            ]);
        } else {
             return response()->json([
                'status'=>401,
                'message'=>'Unauthorized',
            ]);
        }
    }
    public function addClinicsData(){
        if(Auth::guard('api')->user()){
            $id =Auth::guard('api')->user()->id;
             // dd($id);
            $hospitals = User::role('hospital')->select('id','first_name','last_name')->get();
            $intervals = Helper::getAppointmentIntervals();
            $durations = Helper::getAppointmentDuration();
            $spaces = Helper::getAppointmentSpaces();
            $days = Helper::getAppointmentDays();
            $location = Team::where('doctor_id',$id)->first();
            $slots = json_decode($location->slots, true);
            // dd($slots);
            return response()->json([
                'status' => 200,
                'msg' => 'Hospitals fetch Successfully',
                'hospitals'=>$hospitals,
                'intervals'=>$intervals,
                'durations'=>$durations,
                'spaces'=>$spaces,
                'days'=>$days,
                'slots'=>$slots,
            ]);
            }
            else{
                return response()->json([
                    'status' => 401,
                    'msg' => 'Token Not found'
                ],401);
            }
    }
    public function reportUser(Request $request)
    {    
        $this->validate($request, [
            'report_reason' => 'required',
            'reported_user_id' => 'required|exists:users,id',
        ]);
        // $user = Auth::user();
        if(Auth::guard('api')->user()){
        // dd(Auth::guard('api')->user());
        $user = Auth::guard('api')->user()->id;
        $report = new UserReports();
        $report->report_reason = $request->report_reason;
        $report->reporter_id = $user;
        $report->reported_user_id = $request->reported_user_id;
        $report->save();

        return response()->json([
                'status'=>200,
                'message' => 'User reported successfully']);
        } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    }
    public function setClinicData(Request $request)
    {
    $user = Auth::guard('api')->user()->id;    
    if ($user) {
        $existingRecord = Team::where('doctor_id', $user)
                               ->where('user_id', $request->user_id)
                               ->first(); 
                               // dd($existingRecord);       
        if ($existingRecord) {
            // Update existing record
            $existingRecord->slots = $request->slots;
            $existingRecord->price = $request->price;
            $existingRecord->message = 'message';
            $existingRecord->save();
            return response()->json(['message' => 'Appointment location updated successfully']);
        } else {
            // Create a new record
            $data = new Team();
            $data->doctor_id = $user;
            // dd($data->doctor_id);
            $data->slots = $request->slots;
            $data->price = $request->price;
            $data->user_id = $request->user_id;
            $data->message = 'message';
            $data->save();            
            return response()->json(['message' => 'Appointment location saved successfully']);
        }
    } else {
        return response()->json(['error' => 'User not authenticated'], 401);
    }
   }
   public function editClinicData($id)
   {
    // dd($request->all());
    // $usre_id='6';
       $user = Auth::guard('api')->user()->id; 
       // dd($user);
        if ($user) {
        $clinicData = Team::where('doctor_id', $user)
                       ->where('user_id', $id)
                       ->first();
                       // dd($clinicData); 
            $hospitals = User::role('hospital')->select('id','first_name','last_name')->get();
            $intervals = Helper::getAppointmentIntervals();
            $durations = Helper::getAppointmentDuration();
            $spaces = Helper::getAppointmentSpaces();
            $days = Helper::getAppointmentDays();
            $location = Team::where('doctor_id',$user)->first();
            $slots = json_decode($location->slots, true);
            return response()->json([
                'message' => 'Appointment location updated successfully',
                'clinicData' => $clinicData,
                'hospitals'=>$hospitals,
                'intervals'=>$intervals,
                'durations'=>$durations,
                'spaces'=>$spaces,
                'days'=>$days,
                'slots'=>$slots,
            ]);
       }
   }
    public function getAppointmentSlots(Request $request)
    {
       // dd($request->all());
        $validatedData = $request->validate([
            'doctor_id' => 'required',
            'hospital_id' => 'required',
            'date' => 'required|date_format:Y-m-d',
        ]);
        $hospitalId = $validatedData['hospital_id'];
        $doctorId = $validatedData['doctor_id'];
        // dd($doctorId);
        if ($hospitalId == 'online') {
            $hospital = OnlineConsultation::where('doctor_id', $doctorId)->first();
        } else {
            $hospital = Team::where('doctor_id', $doctorId)->where('user_id', $hospitalId)->first();
        }

        if (!$hospital) {
            return response()->json(['error' => 'Hospital not found'], 404);
        }
        $slots = json_decode($hospital->slots, true);
        $bookedAppointments = Appointment::where('user_id', $doctorId)
                                         ->where('hospital_id', $hospitalId)
                                         ->where('appointment_date', $validatedData['date'])
                                         ->pluck('appointment_time')
                                         ->toArray();
                                         // dd($bookedAppointments);

        // $availableSlots = [];
        // foreach ($slots as $day => $daySlots) {
        //     foreach ($daySlots['slots'] as $slot => $details) {
        //         $startTime = explode('-', $slot)[0];
        //         $isBooked = in_array($startTime, $bookedAppointments);
        //         $availableSlots[] = [
        //             'start_time' => $startTime,
        //             'is_booked' => $isBooked,
        //             'space' => $details['space'] - ($isBooked ? 1 : 0),
        //         ];
        //     }
        // }

        return response()->json(['message' => 'success', 'slots' => $bookedAppointments]);
    }

   public function updateClinicData(Request $request)
    {
    // dd($user);   
    $user = Auth::guard('api')->user()->id; 
    if ($user) {
        $existingRecord = Team::where('doctor_id', $user)
                               ->where('user_id', $request->user_id)
                               ->first(); 
                               // dd($existingRecord);       
        if ($existingRecord) {
            // Update existing record
            $existingRecord->slots = $request->slots;
            $existingRecord->price = $request->price;
            $existingRecord->message = 'message';
            $existingRecord->update();
            return response()->json(['message' => 'Appointment location updated successfully']);
        } else {
                       
            return response()->json(['message' => 'Record Not Found']);
        }
    } else {
        return response()->json(['error' => 'User not authenticated'], 401);
    }
   }
   public function removeClinicData(Request $request)
    {
    $user = Auth::guard('api')->user()->id;
    // dd($user);
    if ($user) {
        $existingRecord = Team::where('doctor_id', $user)
                               ->where('user_id', $request->user_id)
                               ->first(); 
                               // dd($existingRecord);
        if ($existingRecord) {
            // Delete the existing record
            $existingRecord->delete();
            return response()->json(['message' => 'Appointment location removed successfully']);
        } else {
            return response()->json(['error' => 'Clinic data not found'], 404);
        }
    } else {
        return response()->json(['error' => 'User not authenticated'], 401);
    }
    }
    public function addPrescription(Request $request)
   {    
    // dd($request);
        // dd(Auth::guard('api')->user());
        $this->validate($request, [
        'patient_id' => 'required|exists:users,id',
        'dignosis' => 'required',
        'medicine' => 'required',
        'description' => 'required',
        'image' => 'sometimes|file|mimes:jpeg,png,jpg,pdf|max:2048',
           
    ]);
    if(Auth::guard('api')->user()){
        // dd(Auth::guard('api')->user());
        $doctorId = Auth::guard('api')->user()->id;
        // dd($doctorId);
        $prescription = new Prescription();
        $prescription->doctor_id = $doctorId;
        $prescription->patient_id = $request->patient_id;
        $prescription->dignosis = $request->dignosis;
        $prescription->medicine = $request->medicine;
        $prescription->description = $request->description;
        $prescription->save();
        // $filePath = null;
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $patientId = $request->patient_id;
        //     $directoryPath = 'uploads/users/' . $patientId . '/prescription';
        //     if (env('FILESYSTEM_DRIVER') === 'production') {
        //         $directoryPath = public_path($directoryPath);
        //         // Check if the directory exists, if not, create it
        //         if (!File::isDirectory($directoryPath)) {
        //             File::makeDirectory($directoryPath, 0777, true, true);
        //         }
        //         // Store the file with the original name in the specified directory
        //         $filePath = $file->storeAs('uploads/users/' . $patientId . '/prescription', $file->getClientOriginalName());
        //     } else {
        //         $directoryPath = public_path($directoryPath);
        //         // Check if the directory exists, if not, create it
        //         if (!File::isDirectory($directoryPath)) {
        //             File::makeDirectory($directoryPath, 0777, true, true);
        //         }
        //         // Store the file with the original name in the specified directory
        //         $fileName = $file->getClientOriginalName();
        //         $filePath = $directoryPath . '/' . $fileName;
        //         $file->move($directoryPath, $fileName);
        //     }
        // }
        $filePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $patientId = $request->patient_id;
            $directoryPath = 'uploads/users/' . $patientId . '/prescription';
            $filename = $file->getClientOriginalName();
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $disk = (env('FILESYSTEM_DRIVER') === 'production') ? 's3' : 'local_public';

            // Set the new file name
            $newFilename = $doctorId . '_' . time() . '.' . $ext;
            $filePath = $directoryPath . '/' . $newFilename;

            if ($disk === 's3') {
                // Store the file on DigitalOcean Spaces
                Storage::disk($disk)->put($filePath, file_get_contents($file), 'public');
            } else {
                // Check if the directory exists, if not, create it
                if (!File::isDirectory(public_path($directoryPath))) {
                    File::makeDirectory(public_path($directoryPath), 0777, true, true);
                }
                // Store the file locally
                $file->move(public_path($directoryPath), $newFilename);
            }

            // Save the file path to the database
            $prescription->image = $newFilename;
        }

        $prescription->save();


        return response()->json([
            'status'=>200,
            'message' => 'Prescription added successfully',
            // 'file_path' => $filePath
        ]);
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
   }
   public function AddReview(Request $request)
   {
       if(Auth::guard('api')->user()){
        // dd(Auth::guard('api')->user());
        $userId = Auth::guard('api')->user()->id;
        // dd($doctorId);
        $appuserreview = new AppUserReview();
        $appuserreview->patient_id = $request->patient_id;
        $appuserreview->category = $request->category;
        $appuserreview->experience = $request->experience;
        $appuserreview->detail = $request->detail;
        $appuserreview->save();

        return response()->json([
            'status'=>200,
            'message' => 'Review added successfully'
        ]);
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
   }
   
   public function getPrescriptions(Request $request)
   {    
    if(Auth::guard('api')->user()){
        // dd(Auth::guard('api')->user());
        $patientId = Auth::guard('api')->user()->id;
        // dd($patientId);
        $prescriptions = Prescription::where('patient_id', $patientId)->with('doctor_profile')->get();
        return response()->json([
            'status'=>200,
            'prescriptions' => $prescriptions
        ]);
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
   }
   
   public function getAllSpecialities()
   {
            $specialties = Speciality::select('id','title','slug','app_image','top','trending')->get();
            return response()->json([
                'status'=>200,
                'specialties'=>$specialties,
            ]);
   }

    public function getDoctors()
    {
        $doctors = User::role('doctor')->with('profile')->latest()->get();
        return response()->json($doctors);
    }
    public function getDoctorHospitals()
    {
        $user = Auth::guard('api')->user();
        $userId = $user->id;
        $phoneNumber = $user->phone_number;
        // dd($phoneNumber);
        if (!empty($user)) {
            $hospitals = Team::where('doctor_id', $userId)
                ->where('status', 'approved')
                ->select('user_id')
                ->get();
                // dd($hospitals);
            $list = [];

            if ($hospitals->isNotEmpty()) {
                foreach ($hospitals as $key => $hospital) {
                    $doctor_hospital = User::where('id', $hospital->user_id)->with('profile')->first();

                    if ($doctor_hospital) {
                        $list[$key]['id'] = $doctor_hospital->id;
                        $list[$key]['avatar'] = $doctor_hospital->profile->avatar;
                        $list[$key]['address'] = $doctor_hospital->profile->address;
                        $list[$key]['name'] = Helper::getUserName($doctor_hospital->id);
                        $list[$key]['phone_number'] = $phoneNumber;
                    }
                }
            }

            return response()->json(['hospitals' => $list], 200);
        } else {
            return response()->json(['message' => 'Doctor ID is required'], 400);
        }
    }
    public function getAllLocations()
    {
        $city =  Location::select('id','title','slug')->with('areas')->get();
        return response()->json([
            'status'=>200,
            'city'=>$city
        ]);
    }
    public function updateAppointment(Request $request)
    {
        $id = $request->appointment_id;
        $appointment = Appointment::where('id', $id)->first();
        $appointment->status = $request->status;
        $appointment->update();
        return response()->json([
            'status'=>200, 
            'message'=>'Status updated successfully'
        ]);
    }
    public function updateVisitStatus(Request $request)
    {
        $id = $request->appointment_id;
        $appointment = Appointment::where('id', $id)->first();
        $appointment->status_action = $request->status_action;
        $appointment->update();
        return response()->json([
            'status'=>200, 
            'message'=>'Status updated successfully'
        ]);
    }
     public function appointmentHistory()
    {   
         // $doctorId = auth()->user()->id;
         $doctorId =Auth::guard('api')->user()->id;
        $acceptedAppointments = Appointment::where('user_id',$doctorId)->where('status', 'accepted')->get();
        $cancelledAppointments = Appointment::where('user_id',$doctorId)->where('status', 'cancel')->get();
        $visitedAppointments = Appointment::where('user_id',$doctorId)->where('status_action', 'visited')->get();
         // dd($visitedAppointments);
        $notVisitedAppointments = Appointment::where('user_id',$doctorId)->where('status_action', 'not_visited')->get();
        $pendingAppointments = Appointment::where('user_id',$doctorId)->where('status', 'pending')->get();
        $appointmentHistory = [
            'accepted' => $acceptedAppointments,
            'pending' => $pendingAppointments,
            'cancelled' => $cancelledAppointments,
            'visited' => $visitedAppointments,
            'not_visited' => $notVisitedAppointments
        ];

        return response()->json($appointmentHistory);
    }
    public function getAppointmentsByDate(Request $request) {
        // dd($request->all());
         $doctorId =Auth::guard('api')->user()->id;
        $appointments = Appointment::where('user_id',$doctorId)->with('doctor_profile', 'patient_profile:id,first_name,last_name,phone_number')
            ->where('hospital_id', '!=', 0)
            ->orderBy('appointment_date', 'desc')
            ->get()
            ->groupBy(function($appointment) {
                return Carbon::parse($appointment->appointment_date)->format('Y-m-d');
                })
            ->map(function ($appointmentGroup) {
            return $appointmentGroup->map(function ($appointment) {
                $appointment->patient_profile->full_name = $appointment->patient_profile->first_name . ' ' . $appointment->patient_profile->last_name;
                return $appointment;
                // dd( $appointment);
            });
        });
            // dd($appointments);
        return response()->json($appointments);
    
}
public function patientDetail(Request $request) {
        // dd($request->all());
         $doctorId =Auth::guard('api')->user()->id;
         // dd($doctorId);
        $prescription = Prescription::where('doctor_id',$doctorId)->where('patient_id',$request->patient_id)
            ->get();
        $medicalReports= MedicalRecord::where('doctor_id',$doctorId)->where('patient_id',$request->patient_id)
            ->get();
            $patientProfile=User::where('id',$request->patient_id)->select('first_name','last_name','email','location_id','phone_number')->with('profile')->first();
             // dd($patientProfile);
       return response()->json([
            'status'=>200,
            'patientProfile'=>$patientProfile,
            'medicalReports'=>$medicalReports,
            'prescription'=>$prescription,

        ]);
    
}
    
    public function submitFeedback(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [ 
                        'comments' => ['required'],
                        'costRating' => ['required'],
                        'waitRating' => ['required'],
                        'environmentRating' => ['required'],
                        'staffBehaviourRating' => ['required'],
                        'checkupRating' => ['required'],
                        'user_id' => ['required'],
                    ]);

                  if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                  }
        $user_rating = array();
        $avg = 0;
        $avg_rating = 0;
        $count = 0;
        $json = array();
        $feedback = new Feedback;
        $user = User::find($request['user_id']);
        if ($request['vote']) {
            $user_meta = UserMeta::where('user_id', $request['user_id'])->first();
            $votes = $user_meta->votes;
            $votes = (int)$votes + 1;
            UserMeta::where('user_id', $request['user_id'])->update([
                'votes' => $votes
            ]);
        }
        $feedback->user()->associate($user);
        $feedback->waiting_time = !empty($request['waiting_time']) ? $request['waiting_time'] : 0;
        $feedback->keep_anonymous = !empty($request['feedbackpublicly']) ? 'on' : 'off';
        $feedback->comment = filter_var($request['comments'], FILTER_SANITIZE_STRING);
       
        $time = $request['waitRating'];
        if ($time == 1) {
            $waitings = "60";
        }
        elseif ($time == 2){
            $waitings = "45";
        }
        elseif ($time == 3){
            $waitings = "30";
        }
        elseif ($time == 4){
            $waitings = "15";
        }
        else {
            $waitings = "0";
        }
        $rating = Array();
        $rating['costRating'] = $request['costRating'];
        $rating['waitRating'] = $request['waitRating'];
        $rating['checkupRating'] = $request['checkupRating'];
        $rating['staffBehaviourRating'] = $request['staffBehaviourRating'];
        $rating['environmentRating'] = $request['environmentRating'];
        $avg_rating = ($request['costRating'] + $request['waitRating'] + $request['environmentRating']) / 3;

        $rating = json_encode($rating);
        $feedback->rating = $rating;
        $feedback->type = $request['type'];
        $feedback->avg_rating = $avg_rating;
        $feedback->waiting_time = $waitings;
        $feedback->user_id = $request['user_id'];
        $feedback->approval = $request['approval'];
        $feedback->patient_id = Auth::user()->id;
        // dd($feedback);
        $feedback->save();
        return response()->json([
                                    'status' => 200,
                                    'Review' => $feedback,
                                    'msg' => ucfirst($request['type']).' Review Added Successfully',
                                ]);
    }
}
