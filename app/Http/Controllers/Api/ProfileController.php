<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Hash;
use App\Article;
use App\Disease;
use App\Feedback;
use App\Helper;
use App\Location;
use App\Area;
use App\Service;
use App\SiteManagement;
use App\Speciality;
use DB;
use App\Procedure;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\File;
use Storage;
class ProfileController extends Controller
{
    /**
     * Show Doctor profile detail
     *
     * @param string $slug user-slug
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getDoctorProfileData(Request $request) {
                $slug = $request->query('slug');
        // dd($request->all());
                if (!empty($slug)) { 
            $doctor = User::role('doctor')->where('slug', $slug)->select('id','first_name','last_name','slug','email','location_id')
            ->with('specialities',function($q){
                return $q->take(5);
            })
            ->with('profile',function($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
            })
            ->with('feedbacks',function($q){
                return $q->take(5);
            })->with('total_appointment','onlines','roles','speciality','doc_teams','location','diseases','services')->first();
        }
               $similar_doctors=$doctor->specialities[0]->similarUsersWithRelations()->limit(4)->get();
                // dd($similar_doctors);
                return response()->json([
                    "doctor" => $doctor,
                    "similar_doctors" => $similar_doctors,
                    "logo-path" => 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com/uploads/users/{user_id}/{filename.webp}',
                    "status" => "success",
                    "statusCode" => 200
                ],200);
        
    }
    /**
     * Show Lab profile detail
     *
     * @param string $slug user-slug
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getLabProfileData(Request $request) {
                $slug = $request->query('slug');
        // dd($slug);
                if (!empty($slug)) {
            $lab = User::where('slug', $slug)->select('id','first_name','last_name','location_id','slug','area_id','user_discount_percentage')->with(['location','area','roles'])->withCount('labTest')->with('labTest',function ($q){
                return $q->take(10);
            })->with('profile',function ($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','faqs','total_experience','description','meta_intro','meta_title','meta_description','meta_keywords','online_report_url');
            })->with('feedback',function ($q){
                return $q->take(6);
            })->with('branches',function ($q){
                return $q->take(5);
            })->first();
            $totalLabTestCount = $lab->lab_test_count;
        }
                // dd($totalLabTestCount);
            $otherLabs=User::role('laboratory')->select('id','first_name','last_name','location_id','slug','area_id')->with('location','roles')->with('profile',function($q){
                 return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
             })->orderBy("trending","desc")->limit(4)->get();
                return response()->json([
                    "totalLabTestCount" => $totalLabTestCount,
                    "lab" => $lab,
                    "otherLabs" => $otherLabs,
                    "logo-path" => 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com/uploads/users/{user_id}/{filename.webp}',
                    "status" => "success",
                    "statusCode" => 200
                ],200);
        
    }
    /**
     * Update Patient profile detail
     *
     * @param int $id 
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePatientProfile(Request $request, $id)
    {
        // dd($request->all(), $id);
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $id,
            'address' => 'string|max:255',
            'phone_number' => 'string|size:11',
            // 'gender' => 'in:male,female',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's information
        $user->update([
            'first_name' => $request->input('first_name', $user->first_name),
            'last_name' => $request->input('last_name', $user->last_name),
            'email' => $request->input('email', $user->email),
            'address' => $request->input('address', $user->address),
            'phone_number' => $request->input('phone_number', $user->phone_number),
            'slug' => filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['last_name'], FILTER_SANITIZE_STRING), 
        ]);

        // Update the gender information in the profile relationship
        // $user->profile->update([
        //     'gender' => $request->input('gender', $user->profile->gender),
        // ]);
        // Return a response
        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }
    public function editDoctorProfile()
    {
        // dd($request->all());
        // Validate the incoming request data
        $userId = Auth::guard('api')->user()->id;
        // dd($userId);
        $user = User::where('id', $userId)->select('first_name','last_name','email','address','phone_number','location_id','area_id')->first();
        $locations= Location::all();
        $area= Area::all();

        // dd($user);
        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
            'locations' => $locations,
            'areas' => $area,

         ]);
    }
    public function updateDoctorProfile(Request $request)
    {
        $user = Auth::guard('api')->user();
        // dd($user);
        $userId = $user->id;
        // Update the user's information
        $user->update([
            'first_name' => $request->input('first_name', $user->first_name),
            'last_name' => $request->input('last_name', $user->last_name),
            'email' => $request->input('email', $user->email),
            'address' => $request->input('address', $user->address),
            'phone_number' => $request->input('phone_number', $user->phone_number),
            'location_id' => $request->input('location_id', $user->location_id),
            'area_id' => $request->input('area_id', $user->area_id),

            // 'slug' => filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['last_name'], FILTER_SANITIZE_STRING), 
        ]);
        
        // // Update the gender information in the profile relationship
        // $user->profile->update([
        //     'gender' => $request->input('gender', $user->profile->gender),
        // ]);
        // Return a response
        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }
    /**
     * get Medical Report
     *
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getMedicalReport(Request $request)
    {
        $medicalReports = MedicalRecord::where('patient_id', $request->patient_id)->get();
        return response()->json([
                                    'medicalReports' => $medicalReports,
                                    'status' => 200,
                                    'msg' => 'Medical Report Fetched Successfully',
                                ]);
    }
    /**
     * Add Medical Report
     *
     * @param int $id 
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function addMedicalReport(Request $request)
    {
        // dd($request->all());
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [ 
                        'title' => ['required'],
                        'date' => ['required'],
                        'time' => ['required'],
                        'doctor_name' => ['required'],
                        'doctor_id'=>['required'],
                        'patient_name' => ['required'],
                        'report_file' => ['nullable', 'file'],
                    ]);

                  if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                  }
                // Handle file upload
                  if(env('FILESYSTEM_DRIVER') === 'production'){
        if ($request->hasFile('report_file')) {
        $file = $request->file('report_file');
        $patientId = Auth::id();
        $directoryPath = public_path('uploads/users/' . $patientId . '/medicalReports');
        // dd($directoryPath);
        // Check if the directory exists, if not, create it
        if (!File::isDirectory($directoryPath)) {
            File::makeDirectory($directoryPath, 0777, true, true);
        }

        // Store the file with original name in the specified directory
        $filePath = $file->storeAs('uploads/users/' . $patientId . '/medicalReports', $file->getClientOriginalName());
    } else {
        $filePath = null;
    }
}else{
    $filePath = null;
    if ($request->hasFile('report_file')) {
        $file = $request->file('report_file');
        $patientId = Auth::id();
        $directoryPath = 'uploads/users/' . $patientId . '/medicalReports';

        // Check if the directory exists, if not, create it
        if (!File::isDirectory(public_path($directoryPath))) {
            File::makeDirectory(public_path($directoryPath), 0777, true, true);
        }

        // Store the file with original name in the specified directory
        $fileName = $file->getClientOriginalName();
        $filePath = $directoryPath . '/' . $fileName;
        $file->move(public_path($directoryPath), $fileName);
    }

}
    // Save medical report
        $medicalReport = new MedicalRecord;
        $medicalReport->title = $request->title;
        $medicalReport->date = $request->date;
        $medicalReport->time = $request->time;
        $medicalReport->doctor_name = $request->doctor_name;
        $medicalReport->doctor_id = $request->doctor_id;
        $medicalReport->patient_name = $request->patient_name;
        $medicalReport->patient_id = Auth::id();
        $medicalReport->report_file = $filePath;
        $medicalReport->save();
                  return response()->json([
                                    'status' => 200,
                                    'msg' => 'Medical Report Added Successfully',
                                ]);
    }

    /**
     * update Medical Report
     *
     * @param int $id 
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function updateMedicalReport(Request $request, $id)
    {
        // dd($request->all());
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [ 
                        'title' => ['required'],
                        'date' => ['required'],
                        'time' => ['required'],
                        'doctor_name' => ['required'],
                        'patient_name' => ['required'],
                        'report_file' => ['nullable', 'file'],
                    ]);

                  if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                  }
                // Handle file upload
                  if(env('FILESYSTEM_DRIVER') === 'production'){
        if ($request->hasFile('report_file')) {
        $file = $request->file('report_file');
        $patientId = Auth::id();
        $directoryPath = public_path('uploads/users/' . $patientId . '/medicalReports');
        // dd($directoryPath);
        // Check if the directory exists, if not, create it
        if (!File::isDirectory($directoryPath)) {
            File::makeDirectory($directoryPath, 0777, true, true);
        }

        // Store the file with original name in the specified directory
        $filePath = $file->storeAs('uploads/users/' . $patientId . '/medicalReports', $file->getClientOriginalName());
    } else {
        $filePath = null;
    }
}else{
    $filePath = null;
    if ($request->hasFile('report_file')) {
        $file = $request->file('report_file');
        $patientId = Auth::id();
        $directoryPath = 'uploads/users/' . $patientId . '/medicalReports';

        // Check if the directory exists, if not, create it
        if (!File::isDirectory(public_path($directoryPath))) {
            File::makeDirectory(public_path($directoryPath), 0777, true, true);
        }

        // Store the file with original name in the specified directory
        $fileName = $file->getClientOriginalName();
        $filePath = $directoryPath . '/' . $fileName;
        $file->move(public_path($directoryPath), $fileName);
    }

}
    // Save medical report
        $medicalReport = MedicalRecord::findOrFail($id);
        $medicalReport->title = $request->title;
        $medicalReport->date = $request->date;
        $medicalReport->time = $request->time;
        $medicalReport->doctor_name = $request->doctor_name;
        $medicalReport->patient_name = $request->patient_name;
        $medicalReport->patient_id = Auth::id();
        $medicalReport->report_file = $filePath;
        $medicalReport->save();
                  return response()->json([
                                    'status' => 200,
                                    'msg' => 'Medical Report updated Successfully',
                                ]);
    }
    public function DeleteMedicalRecors(Request $request, $id)
    {
       
        $medicalReport = MedicalRecord::find($id);
        // dd($medicalReport);
        if (!$medicalReport) {
            return response()->json(['message' => 'Medical report not found'], 404);
        }
       $user = Auth::user();
       // dd($user);
       if ($user->id !== $medicalReport->patient_id && $user->id !== $medicalReport->doctor_id) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }
        // if ($medicalReport->patient_id !== auth()->id()) {
        //     return response()->json(['message' => 'Unauthorized'], 403);
        // }

        $medicalReport->delete();
        return response()->json(['message' => 'Medical report deleted successfully'], 200);
    }
    
    
}
