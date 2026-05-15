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
use App\Service;
use App\SiteManagement;
use App\Speciality;
use DB;
use App\Procedure;
use App\Product;
use App\UserMeta;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Http;
class AuthController extends Controller
{
    public function generateAccessToken()
    {
        $admin = User::role('admin')->first(); 
        $token = Auth::guard('api')->attempt([
            'email' => $admin->email, 
            'password' => "footBALL102"
        ]);
        dd($token);
    } 
     private function normalizePhoneNumber($phoneNumber)
    {
        // Remove any non-numeric characters
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Remove leading zero and add '92'
        if (Str::startsWith($phoneNumber, '0')) {
            $phoneNumber = '92' . substr($phoneNumber, 1);
        }

        return $phoneNumber;
    }
    public function getSpecialties(){
        if(Auth::guard('api')->user()){
            $user = User::where('id',Auth::guard('api')->user()->id)->with('roles')->first();
            if($user->roles[0]->name === 'admin'){
                $specialties = Speciality::select('id','title','slug','app_image','top','trending')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get(); 
        return response()->json([
                                    'status' => 200,
                                    'msg' => 'Specialties fetch Successfully',
                                    'logo_path' => "/uploads/specialities/",
                                    'data'=>$specialties
                                ]);
            }
            else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'You are not authorized'
                                ],401);
    }
         
    }
    else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'Token Not found'
                                ],401);
    }
    }
    public function getDoctors(){
        
        if(Auth::guard('api')->user()){
            $user = User::where('id',Auth::guard('api')->user()->id)->with('roles')->first();
            if($user->roles[0]->name === 'admin'){
                $doctors = User::role('doctor')->with('profile','specialities','location')->limit(4)->get();
        return response()->json([
                                    'status' => 200,
                                    'msg' => 'Doctors fetch Successfully',
                                    'data'=>$doctors
                                ]);
            }
            else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'You are not authorized'
                                ],401);
    }
         
    }
    else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'Token Not found'
                                ],401);
    }
    }
    public function getHospitals(){
        if(Auth::guard('api')->user()){
            $user = User::where('id',Auth::guard('api')->user()->id)->with('roles')->first();
            if($user->roles[0]->name === 'admin'){
                $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area')->select('id','first_name','last_name','location_id','slug','area_id')->limit(6)->get();
        return response()->json([
                                    'status' => 200,
                                    'msg' => 'Hospitals fetch Successfully',
                                    'data'=>$hospitals
                                ]);
            }
            else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'You are not authorized'
                                ],401);
    }
         
    }
    else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'Token Not found'
                                ],401);
    }
    }
    public function getLaboratories(){
        if(Auth::guard('api')->user()){
            $user = User::where('id',Auth::guard('api')->user()->id)->with('roles')->first();
            if($user->roles[0]->name === 'admin'){
                $laboratories = User::role('laboratory')->orderBy("trending","desc")->with('profile','location','area')->select('id','first_name','last_name','location_id','slug','area_id')->limit(6)->get();
        return response()->json([
                                    'status' => 200,
                                    'msg' => 'Laboratories fetch Successfully',
                                    'data'=>$laboratories
                                ]);
            }
            else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'You are not authorized'
                                ],401);
    }
         
    }
    else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'Token Not found'
                                ],401);
    }
    }
    public function getDiseases(){
        if(Auth::guard('api')->user()){
            $user = User::where('id',Auth::guard('api')->user()->id)->with('roles')->first();
            if($user->roles[0]->name === 'admin'){
                $diseases = Disease::select('id','title', 'slug','flag','trending')->limit(4)->get();
        return response()->json([
                                    'status' => 200,
                                    'msg' => 'Diseases fetch Successfully',
                                    'data'=>$diseases
                                ]);
            }
            else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'You are not authorized'
                                ],401);
    }
         
    }
    else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'Token Not found'
                                ],401);
    }
    }
    public function getServices(){
        if(Auth::guard('api')->user()){
            $user = User::where('id',Auth::guard('api')->user()->id)->with('roles')->first();
            if($user->roles[0]->name === 'admin'){
                $services = Service::select('id','title', 'slug','image','trending')->limit(4)->get();
        return response()->json([
                                    'status' => 200,
                                    'msg' => 'Services fetch Successfully',
                                    'data'=>$services
                                ]);
            }
            else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'You are not authorized'
                                ],401);
    }
         
    }
    else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'Token Not found'
                                ],401);
    }
    }
    public function getCities(){
        if(Auth::guard('api')->user()){
            $user = User::where('id',Auth::guard('api')->user()->id)->with('roles')->first();
            if($user->roles[0]->name === 'admin'){
                $cities = Location::with('specialities')->orderBy("created_at","asc")->limit(13)->get();
        return response()->json([
                                    'status' => 200,
                                    'msg' => 'Cities fetch Successfully',
                                    'data'=>$cities
                                ]);
            }
            else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'You are not authorized'
                                ],401);
    }
         
    }
    else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'Token Not found'
                                ],401);
    }
    }
    public function getFeedbacks(){
        if(Auth::guard('api')->user()){
            $user = User::where('id',Auth::guard('api')->user()->id)->with('roles')->first();
            if($user->roles[0]->name === 'admin'){
                $feedbacks = Feedback::with('patient')->where('approval', '1')->orderBy("created_at","asc")->limit(3)->get();
        return response()->json([
                                    'status' => 200,
                                    'msg' => 'Feedbacks fetch Successfully',
                                    'data'=>$feedbacks
                                ]);
            }
            else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'You are not authorized'
                                ],401);
    }
         
    }
    else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'Token Not found'
                                ],401);
    }
    }
    public function getProcedures(){
        if(Auth::guard('api')->user()){
            $user = User::where('id',Auth::guard('api')->user()->id)->with('roles')->first();
            if($user->roles[0]->name === 'admin'){
                $procedures = Procedure::where('top', '1')->with('cities')->orderBy("created_at","asc")->limit(6)->get();
        return response()->json([
                                    'status' => 200,
                                    'msg' => 'Procedures fetch Successfully',
                                    'data'=>$procedures
                                ]);
            }
            else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'You are not authorized'
                                ],401);
    }
         
    }
    else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'Token Not found'
                                ],401);
    }
    }
    public function getManagements(){
        

        if(Auth::guard('api')->user()){
            $user = User::where('id',Auth::guard('api')->user()->id)->with('roles')->first();
            if($user->roles[0]->name === 'admin'){
                $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','home_doctor_sec','home_search_banner','small_devices_top_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        return response()->json([
                                    'status' => 200,
                                    'msg' => 'Managements fetch Successfully',
                                    'data'=>$managements
                                ]);
            }
            else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'You are not authorized'
                                ],401);
    }
         
    }
    else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'Token Not found'
                                ],401);
    }
    }
    public function getArticles(){
        if(Auth::guard('api')->user()){
            $user = User::where('id',Auth::guard('api')->user()->id)->with('roles')->first();
            if($user->roles[0]->name === 'admin'){
                $blogs = Article::where('is_featured', '1')->orderBy("created_at","desc")->limit(3)->get();
        return response()->json([
                                    'status' => 200,
                                    'msg' => 'Articles fetch Successfully',
                                    'imagePath' => 'uploads/users/1/articles/',
                                    'data'=>$blogs
                                ]);
            }
            else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'You are not authorized'
                                ],401);
    }
         
    }
    else{
        return response()->json([
                                    'status' => 401,
                                    'msg' => 'Token Not found'
                                ],401);
    }
    }
    public function getAuthUser(){
        if(Auth::guard('api')->user()){
            return response()->json([
                'data' => Auth::guard('api')->user(),
                'message' => 'Logged-in user data',
                'statusCode' => 200,
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'data' => Auth::guard('api')->user(),
                'message' => 'User Not Logged In',
                'statusCode' => 401,
                'status' => 'bad request'
            ]);
        }
    }
    
    public function loginUser(Request $request){
        // dd($request->all());
            $message=[
                'size'=>"phone number must be 11 digit",
                'email.required'=>"phone number or email must be required",
                'email.regex'=>"phone number or email is invalid"
            ];
            if(is_numeric($request->email)){
                $validator = Validator::make($request->all(), [
                    'email' => ['required','size:11','regex:/([- ,\/0-9]+)/'],
                    'password'=>['required','min:8']
                ],$message);
            }else{
                $validator = Validator::make($request->all(), [
                    'email' => ['required','email','regex:/(.+)@(.+)\.(.+)(.+)/i'],
                    'password'=>['required','min:8']
                ],$message);
            }
            if($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            if(is_numeric($request->email)){
                $user = User::where('phone_number',$request->email)->first();
                    if($user){
                            $token = Auth::guard('api')->attempt([
                                'phone_number' => request('email'), 
                                'password' => request('password')
                            ]);
                            if($token){
                                $userSession = User::role('patient')->where('id',Auth::guard('api')->id())->select('id','first_name','last_name')->first();
                                // dd($userSession);
                                return $this->createNewToken($token);
                            }
                            else{
                                return response()->json([
                                    'status' => 401,
                                    'msg' => 'Invalid username and password',
                                    'error'=>'Unauthorized'
                                ]); 
                            }
                    }else{
                        return response()->json([
                            'status' => 401,
                            'msg' => 'Invalid username and password',
                            'error'=>'Unauthorized'
                        ]); 
                    }
                  }else{
                    $token = Auth::guard('api')->attempt([
                        'email' => request('email'), 
                        'password' => request('password')
                    ]);
                       if($token){
                            $userSession = User::role('doctor')->where('id',Auth::guard('api')->id())->select('id','first_name','last_name')->first();
                            return $this->createNewToken($token);
                        }
                        else{
                           return response()->json([
                                'status' => 'error',
                                'msg' => 'Invalid username and password'
                            ]); 
                        }
                    }   
        
    }
    public function userProfile() {
        // if(Auth::guard('api')->user()){
        //     return response()->json([
        //         'data' => Auth::guard('api')->user(),
        //         'logo_path' => '/uploads/client_images/',
        //         'message' => 'Logged-in user data',
        //         'statusCode' => 200,
        //         'status' => 'success'
        //     ]);
        // }else{
        //     return response()->json([
        //         'data' => Auth::guard('api')->user(),
        //         'message' => 'no data found',
        //         'statusCode' => 401,
        //         'status' => 'bad request'
        //     ]);
        // }
        return 'hi from dev';
    }
   
    public function UserLogin(Request $request) {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'phone_number' => ['required', 'string', 'size:11'],
            'otp' => ['required', 'string', 'size:6'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::where('phone_number', $request->phone_number)->with('profile',function($q){
            return $q->select('user_id','avatar');
        })->first();
        $password = $request->otp.'doctorfindy';
        if ($user) {
            $user->verification_code=$request->otp;
            $user->password= password_hash($password, PASSWORD_DEFAULT);
            $user->save();
             $token = Auth::guard('api')->login($user);
                return response()->json(['token' => $token, 'user' => $user]);
        } else {
            $json['type'] = 'User Not Registered';
            return $json;
        }
    }
    public function UserRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ_.,() ]+$/'],
            'last_name' => ['required', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ_.,() ]+$/'],
            'phone_number' => ['required', 'string', 'size:11',"regex:/^([0-9\s\-\+\(\)]*)$/",'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'otp' => ['required', 'string', 'size:6'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::where('phone_number', $request->phone_number)->first();
        $password = $request->otp.'doctorfindy';
        if (!$user) {
            $user = User::create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'phone_number' => $request['phone_number'],
                'email' => $request['email'],
                'verification_code' => $request['otp'],
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'slug' => filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['last_name'], FILTER_SANITIZE_STRING),
                ]);
             $user->assignRole('patient');
             $token = Auth::guard('api')->login($user);
                return response()->json(['token' => $token, 'user' => $user]);
        } else {
            $json['type'] = 'User Already Registered';
            return $json;
        }
    }

     protected function createNewToken($token){
        $user = Auth::guard('api')->user();
        $user->load(['profile' => function($q) {
            $q->select('user_id', 'avatar');
        }]);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
            'status'=>'success',
            'message'=>'Signed In Successfully',
            'user'=>$user
        ]);
    }
    public function registerUser(Request $request) {
        // dd($request->all());
            $json = array();
                if (!empty($request)) {
                    $user = User::where('phone_number', $request['phone_number'])->get();
                    if (count($user) > 0) {
                        $json['type'] = 'error';
                        $json['message'] = 'User already registered';
                    }
                    $validator = Validator::make($request->all(), [ 
                        'first_name' => ['required', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ_.,() ]+$/'],
                        'last_name' => ['required', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ_.,() ]+$/'],
                        'phone_number' => ['required', 'string', 'unique:users', 'min:11','size:11',"regex:/^([0-9\s\-\+\(\)]*)$/"],
                        'email' => ['required', 'email', 'unique:users'],
                        'password' => ['required', 'string', 'min:8'],
                    ]);

                  if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                  }
                if ($request->role == 'doctor') {

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
                    $user = User::create([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'phone_number' => $request['phone_number'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'slug' => filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['last_name'], FILTER_SANITIZE_STRING),
                    'select_degree' => $request['select_degree'],
                    'pmdc_number' => $pmdc_number,
                    'ncs_number' => $ncs_number,
                    'location_id' => $request['location_id'],
                    'area_id' => $request['area_id'],
                    'gender' => $request->has('gender') ? $request['gender'] : null,
                ]);
                    // dd($user);
                    $user->assignRole(['doctor']);
                     if ($request->has('gender')) {
                        UserMeta::create([
                      'user_id' => $user->id,
                      'gender' => $request['gender'], 
                        ]);
                        }
                    if($request->specialties){
                        $specialtiesString = $request->specialties;
                        $specialties = json_decode($specialtiesString);
                        $current = Carbon::now();
                           foreach($specialties as $specialtyId)
                           {
                              DB::table('user_speciality')->insert([
                                    [
                                        'user_id'          => $user->id,
                                        'speciality_id'    => $specialtyId,
                                        'created_at'       => $current,
                                        'updated_at'       => $current
                                    ]
                                ]);
                           }
                       }
                }else if($request->role == 'patient'){
                    $user = User::create([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'phone_number' => $request['phone_number'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'slug' => filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['last_name'], FILTER_SANITIZE_STRING),
                ]);
                    $user->assignRole('patient');
                }else if($request->role == 'hospital'){
                    $user = User::create([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'phone_number' => $request['phone_number'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'slug' => filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['last_name'], FILTER_SANITIZE_STRING),
                ]);
                    // dd($user);
                    $user->assignRole('hospital');
                }
                $loggedIn = Auth::guard('api')->login($user);
                
                return $this->createNewToken($loggedIn);
            }
        
    }
    public function logout(Request $request) {
        $headers = $request->header();
        if(!empty($headers) && isset($headers) && isset($headers['authorization'][0])){
            $user = Auth::guard('api')->user();
            if($user){
                $user_id = $user->id;
                $logout = Auth::guard('api')->logout();
                if($logout){
                    return response()->json([
                        'statusCode' => 401,
                        'status' => 'error',
                        'message' => 'There is some error in logging out'
                    ], 401);
                }else{
                    return response()->json([
                        'statusCode' => 200,
                        'status' => 'success',
                        'message' => 'Logout Successfully'
                    ], 200);
                }
            }else{
                return response()->json([
                    'statusCode' => 401,
                    'status' => 'error',
                    'message' => 'Please Login First'
                ], 401);
            }
        }else{
            return response()->json([
                'statusCode' => 401,
                'status' => 'error',
                'message' => 'Bearer Token not passed'
            ], 401);
        }
    }
    
    // Products 
    public function getProducts() {
        if(Auth::guard('api')->user()){
            $user = User::where('id',Auth::guard('api')->user()->id)->with('roles')->first();
            if($user->roles[0]->name === 'admin'){
                $products = Product::where('status',1)->select('id','name','description','status','discount_price','thumbnail','price','slug')
                                            ->with('reviews','review_rating')
                                            ->latest()
                                            ->paginate(6);
                return response()->json([
                    'products' => $products,
                    'thumbnail_path' => "uploads/products/",
                    'status' => 'success',
                    'statusCode' => 200
                ],200);
            }else{
                return response()->json([
                    'message' => 'Access Denied',
                    'statusCode' => 401,
                    'status' => 'bad request'
                ],401);
            }
        }else{
            return response()->json([
                'message' => 'Token not found',
                'statusCode' => 401,
                'status' => 'bad request'
            ],401);
        }
    }
    public function getProduct($product_id) {
        if(Auth::guard('api')->user()){
            $user = User::where('id',Auth::guard('api')->user()->id)->with('roles')->first();
            if($user->roles[0]->name === 'admin'){
                $product = Product::where('id',(int)$product_id)
                            ->with('brand','attributes','tags','categories','reviews','review_rating')
                            ->first();
                return response()->json([
                    "product" => $product,
                    "status" => "success",
                    "statusCode" => 200
                ],200);
            }else{
                return response()->json([
                    'message' => 'Access Denied',
                    'statusCode' => 401,
                    'status' => 'bad request'
                ],401);
            }
        }else{
            return response()->json([
                'message' => 'Token not found',
                'statusCode' => 401,
                'status' => 'bad request'
            ],401);
        }
    }
    public function changePassword(Request $request)
    {
        // Validate the request payload
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8',
        ]);

        // Get the authenticated user
        $user = Auth::user();
        // dd($user);
        // Verify the current password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 400);
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
                        'phone_number' => ['required', 'string', 'min:11',"regex:/^([0-9\s\-\+\(\)]*)$/"],
                        'password' => 'required|string|min:8',
                    ]);

                  if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                  }
        $phoneNumber = $this->normalizePhoneNumber($request->phone_number);
        // dd($phoneNumber);
        // Find the user by phone number
        $user = User::where('phone_number', $phoneNumber)->orWhere('phone_number', $request->phone_number)->first();
        // dd($user);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        if($user->password === 'abcdefgh'){
            // Update the user's password
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['message' => 'Password reset successfully'], 200);
        }else{
            return response()->json(['message' => 'Password is already set!'], 401);
        }
       
    }
    public function redirect($provider)
    {
       $url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
       // dd( $url);
    return response()->json(['url' => $url], 200);

    }

    public function callback($provider)
    {
        // dd($provider);
        try {
            $getInfo = Socialite::driver($provider)->stateless()->user();
            $user = $this->createUser($getInfo, $provider);
            Auth::login($user);

            return response()->json([
                'status' => 'success',
                'user' => $user,
                'token' => $user->createToken('DoctorFindy')->accessToken,
            ], 200);

        } catch (\Exception $e) {
            Log::error('Social login error: ' . $e->getMessage(), ['provider' => $provider]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to authenticate user.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    protected function createUser($getInfo, $provider)
    {
        $user = User::where('provider_id', $getInfo->id)->first();

        if (!$user) {
            list($firstname, $lastname) = explode(' ', $getInfo->name, 2);
            $slug = filter_var($firstname, FILTER_SANITIZE_STRING) . '-' . filter_var($lastname, FILTER_SANITIZE_STRING);

            $user = User::create([
                'first_name'     => $firstname,
                'last_name'      => $lastname,
                'slug'           => $slug,
                'password'       => bcrypt('doctorfindy.com'),
                'email'          => $getInfo->email,
                'provider'       => $provider,
                'provider_id'    => $getInfo->id,
            ]);

            $user_profile = UserMeta::create([
                'user_id' => $user->id,
            ]);

            if (!empty($user_profile->id)) {
                $user_meta = UserMeta::find($user_profile->id);
            } else {
                $user_meta = $user_profile;
            }

            $user_meta->user()->associate($user);

            $role = DB::table('roles')->select('name')->where('role_type', 'patient')->first();
            $user->assignRole($role->name);
        }

        return $user;
    }
//         public function siginWithGoogle(Request $request)
//           {  
//           // dd($request->all());   
             
//                $password= bcrypt('doctorfindy.com');  
//                $checkUser = User::where('email', $request['email'])->first();
//                if($checkUser){
//                 $user = $checkUser;
//                }else{
//                 $slug = filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['last_name'], FILTER_SANITIZE_STRING);
//                 $user = new User();
//                 $user->slug = $slug;
//                 $user->first_name = $request['first_name'];
//                 $user->last_name = $request['last_name'];
//                 $user->email = $request['email'];
//                 $user->provider = $request['provider'];
//                 $user->password = $password;
//                 $user->save();
//                }
            
//             $user_profile = UserMeta::create([
//                 'user_id' => $user->id,
//             ]);
//             if (!empty($user_profile->id)) {
//                 $user_meta = UserMeta::find($user_profile->id);
//             } else {
//                 $user_meta = $user_profile;
//             }
//             $user_meta->user()->associate($user);
//             $role = DB::table('roles')->select('name')->where('role_type', 'patient')->first();
//             $user->assignRole($role->name);
//              $token = Auth::guard('api')->login($user);
//                 return response()->json(['token' => $token, 'user' => $user]);        
// }
    public function siginWithGoogle(Request $request)
{  
    $password = bcrypt('doctorfindy.com');  
    $checkUser = User::where('email', $request['email'])->with('profile')->first();

    if ($checkUser) {
        $user = $checkUser;
    } else {
        $slug = filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['last_name'], FILTER_SANITIZE_STRING);
        $user = new User();
        $user->slug = $slug;
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->provider = $request['provider'];
        $user->password = $password;
        $user->save();

        // Create a profile for the new user
        $user_profile = UserMeta::create([
            'user_id' => $user->id,
        ]);

        $user_meta = $user_profile ?: UserMeta::find($user_profile->id);
        $user_meta->user()->associate($user);

        $role = DB::table('roles')->select('name')->where('role_type', 'patient')->first();
        $user->assignRole($role->name);
    }

    $user->load('profile');
    $token = Auth::guard('api')->login($user);
    return response()->json(['token' => $token, 'user' => $user]);
}

}
