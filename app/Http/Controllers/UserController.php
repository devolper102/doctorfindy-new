<?php

/**
 * Class UserController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @version <PHP: 1.0.0>
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use DB;
use PDF;
use Auth;
use Hash;
use View;
use App\Faq;
use Session;
use App\Area;
use App\Code;
use App\Demo;
use App\Team;
use App\User;
use App\Order;
use App\Helper;
use App\Payout;
use App\Report;
use App\Article;
use App\Contact;
use App\Disease;
use App\Invoice;
use App\LabCode;
use App\Package;
use App\Service;
use App\Symptom;
use App\BookTest;
use App\Location;
use App\UserMeta;
use App\OrderMeta;
use Carbon\Carbon;
use App\Speciality;
use App\Appointment;
use App\AffairDetail;
use App\EmailTemplate;
use PHPUnit\Util\Json;
use App\SiteManagement;
use App\Speciality_Test;
use Illuminate\Support\Arr;
use FontLib\Table\Type\loca;
use Illuminate\Http\Request;
use App\Mail\AdminEmailMailable;
use App\Http\Controllers\stdClass;
use App\Mail\GeneralEmailMailable;
use Spatie\Permission\Models\Role;
use const http\Client\Curl\AUTH_ANY;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserController
 *
 */
class UserController extends Controller
{
    /**
     * Defining public scope of variable
     *
     * @access public
     *
     * @var array $user
     */
    use HasRoles;
    protected $user;
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @param instance $user      make instance
     * @param instance $user_meta make user_meta instance
     *
     * @return void
     */
    public function __construct(User $user, UserMeta $user_meta, Report $report)
    {
        $this->user = $user;
        $this->user_meta = $user_meta;
        $this->report = $report;
    }

    /**
     * UserMeta Manage Account/ UserMeta Settings
     *
     * @access public
     *
     * @return View
     */
    public function accountSettings()
    {
        if (file_exists(resource_path('views/extend/back-end/account-settings/index.blade.php'))) {

            return view(
                'extend.back-end.account-settings.index'
            );
        } else {
            $user =Auth::user();
            return view(
                'back-end.account-settings.index',compact('user')
            );
        }
    }

    /**
     * Save user account settings.
     *
     * @param mixed $request request attribute
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function saveAccountSettings(Request $request)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $user_meta = new UserMeta();
        $user_id = Auth::user()->id;
        $user_meta->storeAccountSettings($request, $user_id);
        Session::flash('message', trans('lang.account_settings_saved'));
        return Redirect::back();
    }

    /**
     * Reset password form.
     *
     * @access public
     *
     * @return View
     */
    public function resetPassword()
    {
        if (file_exists(resource_path('views/extend/back-end/account-settings/reset-password.index.blade.php'))) {
            return view('extend.back-end.account-settings.reset-password.index');
        } else {
            return view('back-end.account-settings.reset-password.index');
        }
    }

    /**
     * Update user password.
     *
     * @param mixed $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function requestPassword(Request $request)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        if (!empty($request)) {
            Validator::extend(
                'old_password',
                function ($attribute, $value, $parameters) {
                    return Hash::check($value, Auth::user()->password);
                }
            );
            $this->validate(
                $request,
                [
                    'old_password'         => 'required',
                    'confirm_password'     => 'required',
                    'confirm_new_password' => 'required',
                ]
            );
            $user_id = $request['user_id'];
            $user = User::find($user_id);
            if (Hash::check($request->old_password, $user->password)) {
                if ($request->confirm_password === $request->confirm_new_password) {
                    $user->password = Hash::make($request->confirm_password);
                    // Send email
                    if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                        $email_params = array();
                        $template = DB::table('email_types')->select('id')->where('email_type', 'reset_password_email')->get()->first();
                        if (!empty($template->id)) {
                            $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                            $email_params['name'] = Helper::getUserName($user_id);
                            $email_params['email'] = $user->email;
                            $email_params['password'] = $request->confirm_password;
                            try {
                                Mail::to($user->email)
                                    ->send(
                                        new GeneralEmailMailable(
                                            'reset_password_email',
                                            $template_data,
                                            $email_params
                                        )
                                    );
                            } catch (\Exception $e) {
                                Session::flash('error', trans('lang.ph_email_warning'));
                                return Redirect::back();
                            }
                        }
                    }
                    $user->save();
                    Session::flash('message', trans('passwords.reset'));
                     Auth::logout();
                    return Redirect::to('/');
                } else {
                    Session::flash('error', trans('lang.confirmation'));
                    return Redirect::back();
                }
            } else {
                Session::flash('error', trans('lang.pass_not_match'));
                return Redirect::back();
            }
        } else {
            Session::flash('error', trans('lang.something_wrong'));
            return Redirect::back();
        }
    }
    public function updateAvatarr(Request $request, $user_id)
    {
        $user = User::find($user_id);
        // dd($user);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found.'], 404);
        }
    
        $avatar_img = $request->input('avatar_img'); // The file name provided by the changeProfileImage method
        // dd( $avatar_img);
        if (!$avatar_img) {
            return response()->json(['status' => 'error', 'message' => 'Avatar image not provided.'], 400);
        }
    
        $user_data_info = strtolower($user->slug);
        if ($user->location) {
            $user_data_info .= '-' . $user->location->title;
        }
    
        $old_path = (env('FILESYSTEM_DRIVER') === 'production') ? '/uploads/users/temp' : Helper::PublicPath() . '/uploads/users/temp';
        $new_path = (env('FILESYSTEM_DRIVER') === 'production') ? '/uploads/users/' . $user_id : Helper::PublicPath() . '/uploads/users/' . $user_id;
    
        $profile_img_sizes = Helper::getImageSizes('profile_img');
        $ext = pathinfo($avatar_img, PATHINFO_EXTENSION);
        $filename = $user_data_info . '.' . $ext;
    
        $disk = (env('FILESYSTEM_DRIVER') === 'production') ? 's3' : 'local_public';
    
        if ($disk == 's3') {
            if (Storage::disk($disk)->exists($old_path . '/' . $avatar_img)) {
                if (!Storage::disk($disk)->exists($new_path)) {
                    Storage::disk($disk)->makeDirectory($new_path);
                }
    
                foreach ($profile_img_sizes as $key => $size) {
                    $oldFilePath = $old_path . '/' . $key . '-' . $avatar_img;
                    $newFilePath = $new_path . '/' . $key . '-' . $filename;
                    if (Storage::disk('s3')->exists($newFilePath)) {
                        Storage::disk('s3')->delete($newFilePath);
                    }
                    Storage::disk('s3')->move($oldFilePath, $newFilePath);
                }
    
                $oldOriginalFilePath = $old_path . '/' . $avatar_img;
                $newOriginalFilePath = $new_path . '/' . $filename;
                if (Storage::disk('s3')->exists($newOriginalFilePath)) {
                    Storage::disk('s3')->delete($newOriginalFilePath);
                }
                Storage::disk('s3')->move($oldOriginalFilePath, $newOriginalFilePath);
            }
        } else {
            if (file_exists($old_path . '/' . $avatar_img)) {
                if (!file_exists($new_path)) {
                    mkdir($new_path, 0755, true);
                }
    
                foreach ($profile_img_sizes as $key => $size) {
                    rename($old_path . '/' . $key . '-' . $avatar_img, $new_path . '/' . $key . '-' . $filename);
                }
                rename($old_path . '/' . $avatar_img, $new_path . '/' . $filename);
            }
        }
    
        $user_meta = UserMeta::where('user_id', $user_id)->first();
        if (!$user_meta) {
            $user_meta = new UserMeta();
            $user_meta->user_id = $user_id;
        }
        $user_meta->avatar = $filename;
        $user_meta->save();
    
        return response()->json(['status' => 'success', 'message' => 'Avatar updated successfully.'], 200);
    }
    /**
     * Email Notification Settings Form.
     *
     * @access public
     *
     * @return View
     */
    public function emailNotificationSettings()
    {
        if (file_exists(resource_path('views/extend/back-end/account-settings/index.blade.php'))) {
            return view('extend.back-end.account-settings.index');
        } else {
            return view('back-end.account-settings.index');
        }
    }

    /**
     * Save Email Notification Settings.
     *
     * @param mixed $request request attribute
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function saveEmailNotificationSettings(Request $request)
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        $user_meta = new UserMeta();
        $user_id = Auth::user()->id;
        $user_meta->storeEmailNotification($request, $user_id);
        Session::flash('message', trans('lang.email_settings_saved'));
        return Redirect::back();
    }

    /**
     * Delete Account form.
     *
     * @access public
     *
     * @return View
     */
    public function deleteAccount()
    {
        if (file_exists(resource_path('views/extend/back-end/account-settings/delete-account/index.blade.php'))) {
            return view('extend.back-end.account-settings.delete-account.index');
        } else {
            return view('back-end.account-settings.delete-account.index');
        }
    }

    /**
     * Delete record from storage
     *
     * @param mixed $request request attributes
     *
     * @access public
     *
     * @return View
     */
    public function destroy(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $this->validate(
            $request,
            [
                'old_password' => 'required',
                'retype_password'    => 'required',
            ]
        );
        $json = array();
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        if (Hash::check($request->old_password, $user->password)) {
            if (!empty($user_id)) {
                $user->profile()->delete();
                $user->roles()->detach();
                DB::table('appointments')->where('user_id', $user_id)
                    ->orWhere('hospital_id', $user_id)->orWhere('patient_id', $user_id)->delete();
                if ($user->articles->count() > 0) {
                    foreach ($user->articles as $user_article) {
                        $article = Article::find($user_article->id);
                        if ($article->categories->count() > 0) {
                            $article->categories()->detach();
                        }
                    }
                    $user->articles()->delete();
                }
                DB::table('feedbacks')->where('user_id', $user_id)
                    ->orWhere('patient_id', $user_id)->delete();
                $user->forums()->detach();
                DB::table('messages')->where('user_id', $user_id)
                    ->orWhere('receiver_id', $user_id)->delete();
                if ($user->orders->count() > 0) {
                    foreach ($user->orders as $user_orders) {
                        DB::table('order_metas')->where('metable_id', $user_orders->id)->delete();
                    }
                    $user->orders()->delete();
                }
                DB::table('payouts')->where('user_id', $user_id)->delete();
                DB::table('teams')->where('user_id', $user_id)
                    ->orWhere('doctor_id', $user_id)->delete();
                $user->services()->detach();
                if ($user->question->count() > 0) {
                    foreach ($user->question as $form) {
                        DB::table('forums')->where('id', $form->id)->delete();
                        DB::table('user_forum')->where('forum_id', $form->id)->delete();
                    }
                }
                DB::table('user_forum')->where('user_id', $user_id)->where('type', 'answer')->delete();
                $user->delete();
                if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                    $delete_reason = Helper::getDeleteAccReason($request['delete_reason']);
                    $email_params = array();
                    $template = DB::table('email_types')->select('id')->where('email_type', 'admin_email_delete_account')->get()->first();
                    if (!empty($template->id)) {
                        $template_data = EmailTemplate::getEmailTemplateByID($template->id);
                        $email_params['reason'] = $delete_reason;
                        Mail::to(config('mail.username'))
                            ->send(
                                new AdminEmailMailable(
                                    'admin_email_delete_account',
                                    $template_data,
                                    $email_params
                                )
                            );
                    }
                }
                Auth::logout();
                $json['acc_del'] = trans('lang.acc_deleted');
                return $json;
            } else {
                $json['type'] = 'warning';
                $json['msg'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'warning';
            $json['msg'] = trans('lang.pass_mismatched');
            return $json;
        }
    }

    /**
     * Get Manage Account Data
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getManageAccountData()
    {
        if (Auth::user()) {
            $json = array();
            $user_id = Auth::user()->id;
            $user_meta = User::find($user_id)->profile->first();
            if (!empty($user_meta)) {
                $json['type'] = 'success';
                if ($user_meta->profile_searchable == 'true') {
                    $json['profile_searchable'] = 'true';
                }
                if ($user_meta->profile_blocked == 'true') {
                    $json['profile_blocked'] = 'true';
                }
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

    /**
     * Get User Notification Settings
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserEmailNotificationSettings()
    {
        $json = array();
        $user_meta = new UserMeta();
        $notifications = $user_meta::select('weekly_alerts', 'message_alerts')
            ->where('user_id', Auth::user()->id)->get()->first();
        if (!empty($notifications)) {
            $json['type'] = 'success';
            if ($notifications->weekly_alerts == 'true') {
                $json['weekly_alerts'] = 'true';
            }
            if ($notifications->message_alerts == 'true') {
                $json['message_alerts'] = 'true';
            }
        } else {
            $json['type'] = 'error';
        }
        return $json;
    }

    /**
     * Get User Searchable Settings
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserSearchableSettings()
    {
        $json = array();
        $user_meta = new UserMeta();
        $user_data = $user_meta::select('profile_searchable', 'disable_account')
            ->where('user_id', Auth::user()->id)->get()->first();
        if (!empty($user_data)) {
            $json['type'] = 'success';
            if ($user_data->profile_searchable == 'true') {
                $json['profile_searchable'] = 'true';
            }
            if ($user_data->disable_account == 'true') {
                $json['disable_account'] = 'true';
            }
        } else {
            $json['type'] = 'error';
        }
        return $json;
    }

    /**
     * Get dashboard
     *
     * @return View
     */
    public function getDashboard()
    {
        if (Auth::user()) {
            if (Helper::getAuthRoleType() == 'admin') {  
                $doctors_list = User::role('doctor')->with('profile')->with('specialities')->with('location')->with('feedbacks')->limit(5)->latest()->get();
                #dd($doctors_list);
                $patients_list = User::role('patient')->latest()->with('profile')->limit(5)->get();
                $doctors_count = User::role('doctor')->count();
                // dd($doctors_count);
                //$doctors_count = 100;
                $patients_count = User::role('patient')->count();
                $appointments_count = Appointment::count();
                $appointments_notification=DB::table('appointment_notification')->where('admin_alert','=','unread')->count();

                //$appointments_list = Appointment::paginate(5);
                //$all_doctors_id = User::role('doctor')->pluck('id');
                $appointments_list = Appointment::limit(5)->get();
               // $all_doctors_id = User::role('doctor')->pluck('id');
                $total_commission = 0;
                // foreach ($all_doctors_id as $doctor_id) {
                //     $user_info =  DB::table('user_metas')->where('user_id',$doctor_id)->first();
                //     if($user_info !== null){
                //         $total_commission  = (((($user_info->starting_price)*($user_info->commission))/100) + $total_commission);  
                //     }
                //     else{
                //         $total_commission = $total_commission;
                //     }
                // }

                return View(
                    'back-end.admin.dashboard',
                    compact(
                        'doctors_list',
                        'patients_list',
                        'appointments_list',
                        'doctors_count',
                        'patients_count',
                        'appointments_count',
                        'total_commission',
                        'appointments_notification',
                    )
                );
            } elseif (Helper::getAuthRoleType() == 'patient') {
                 $patient = User::where('id', Auth::id())->with('profile','appointments_patient','patient_invoices')->first();
                $doctors = User::role('doctor')->with('profile')->latest()->limit(4)->get();
                $hospitals = User::role('hospital')->with('profile')->latest()->limit(4)->get();
                $meta_values = ['general_settings'];
                $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
                return View(
                    'back-end.patients.dashboard',
                    compact(
                        'patient', 'doctors', 'hospitals','managements'
                    )
                );
            } elseif (Helper::getAuthRoleType() == 'doctor') {
                $doctor = User::where('id', Auth::id())->with('appointments','profile','doctor_invoices')->first();
                $doctors = User::role('doctor')->where('id', '!=', Auth::id())->with('profile')->latest()->limit(4)->get();
                $hospitals = User::role('hospital')->with('profile')->latest()->limit(4)->get();
                $meta_values = ['general_settings'];
                $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
                return View(
                    'back-end.doctors.dashboard',
                    compact(
                        'doctor', 'doctors', 'hospitals','managements'
                    )
                );
            } else {
                $hidden_saved_item = !empty($icons['hidden_saved_item']) ? $icons['hidden_saved_item'] : '';
                $hidden_manage_teams = !empty($icons['hidden_manage_teams']) ? $icons['hidden_manage_teams'] : '';
                return View(
                    'back-end.hospitals.dashboard',
                    compact(
                        'hidden_saved_item',
                        'hidden_manage_teams'
                    )
                );
            }
        } else {
            abort(404);
        }
    }

        public function getDoc()
    {
        /*Doctors*/
        $doctors = User::role('doctor')->with('profile')->latest()->get();
        return response()->json($doctors);
    } 
    public function getAppointmentsNotificationAlert(Request $request)
    {
        $user=Helper::getAuthRoleType();
        $id=Auth::id();
        if($user === 'admin')
        {
           $appointments_notification=DB::table('appointment_notification')->where('admin_alert','=','unread')->count();
            if($appointments_notification > 0)
            {
               DB::table('appointment_notification')->where('admin_alert','=','unread')->update(['admin_alert'=>'notification-send']);
            }
        }
        else if($user === 'doctor')
        {
             $appointments_notification=DB::table('appointment_notification')->where('user_id',$id)->where('status','=','unread')->count();
            if($appointments_notification > 0)
            {
               DB::table('appointment_notification')->where('status','=','unread')->update(['status'=>'notification-send']);
            }
        }
            
        
        return response()->json([
            'success' => true,
            'count' => $appointments_notification,
            'message' => 'Visit Appointment Notification Table'
        ]);
    }

    public function getHos()
    {
        /*Hospitals*/
        $hospitals = User::role('hospital')->with('profile')->get();
        return response()->json($hospitals);
    }

public function getPayment()
    {
        if (Auth::user()) {
            $icons = SiteManagement::getMetaValue('icons');
            $latest_appointment_icon = !empty($icons['hidden_appointment']) ? $icons['hidden_appointment'] : '';
            $latest_package_expiry_icon = !empty($icons['hidden_package_expiry']) ? $icons['hidden_package_expiry'] : '';
            $latest_new_message_icon = !empty($icons['hidden_new_message']) ? $icons['hidden_new_message'] : '';
            $payment_settings = SiteManagement::getMetaValue('payment_settings');
            $symbol = !empty($payment_settings) && !empty($payment_settings['currency']) ? Helper::currencyList($payment_settings['currency']) : array();
            $hidden_package_expiry = !empty($icons['hidden_package_expiry']) ? $icons['hidden_package_expiry'] : '';
            $hidden_available_balance = !empty($icons['hidden_available_balance']) ? $icons['hidden_available_balance'] : '';
            $hidden_pending_balance = !empty($icons['hidden_pending_balance']) ? $icons['hidden_pending_balance'] : '';
            $hidden_total_posted_articles = !empty($icons['hidden_total_posted_articles']) ? $icons['hidden_total_posted_articles'] : '';
            $hidden_check_invoices = !empty($icons['hidden_check_invoices']) ? $icons['hidden_check_invoices'] : '';
            $hidden_latest_recieved_booking = !empty($icons['hidden_latest_recieved_booking']) ? $icons['hidden_latest_recieved_booking'] : '';
            $hidden_submit_articles = !empty($icons['hidden_submit_articles']) ? $icons['hidden_submit_articles'] : '';
            $hidden_saved_item = !empty($icons['hidden_saved_item']) ? $icons['hidden_saved_item'] : '';
            $hidden_manage_teams = !empty($icons['hidden_manage_teams']) ? $icons['hidden_manage_teams'] : '';
            $hidden_manage_specialities_services = !empty($icons['hidden_manage_specialities_services']) ? $icons['hidden_manage_specialities_services'] : '';
            $hidden_new_message = !empty($icons['hidden_new_message']) ? $icons['hidden_new_message'] : '';
            if (Helper::getAuthRoleType() == 'admin') {
                return View(
                    'back-end.admin.dashboard',
                    compact(
                        'latest_appointment_icon',
                        'latest_package_expiry_icon',
                        'latest_new_message_icon',
                        'hidden_saved_item',
                        'hidden_new_message'
                    )
                );
            } elseif (Helper::getAuthRoleType() == 'patient') {
                $patient = User::where('id', Auth::id())->with('appointments_patient')->with('diseases')->with('specialities')->with('location')->with('services')->with('profile')->with('area')->with('feedbacks')->with('doc_teams')->with('roles')->first();
            $doctors = User::role('doctor')->where('id', '!=', Auth::id())->with('profile')->with('specialities')->with('feedbacks')->with('services')->with('location')->with('diseases')->with('orderMeta')->get();
            $hospitals = User::role('hospital')->with('profile')->with('specialities')->with('feedbacks')->with('services')->with('location')->with('diseases')->with('orderMeta')->get();
                $managements  =  SiteManagement::all();
// dd($patient->appointments_patient);
                return View(
                    'back-end.patients.payment',
                    compact(
                        // 'latest_appointment_icon',
                        // 'latest_new_message_icon',
                        // 'hidden_saved_item',
                        // 'hidden_new_message'
                        // 'patient', 'doctors', 'hospitals'
                        'patient',
                        'doctors',
                        'hospitals',
                        'managements'
                    )
                );
            } elseif (Helper::getAuthRoleType() == 'doctor') {
                $order = Auth::user()->orders()->where('status', 'completed')->first();
                $order_obj = !empty($order) ? Order::findOrFail($order->id) : '';
                $package_item = !empty($order_obj) ? json_decode($order_obj->metaValue('package'), true) : array();
                $package = !empty($package_item) ? Package::findOrFail($package_item['id']) : '';
                $option = !empty($package_item) && !empty($package_item['options']) ? json_decode($package_item['options'], true) : '';
                $expiry = !empty($option) ? $package->updated_at->addDays($option['duration']) : '';
                $expiry_date = !empty($expiry) ? Carbon::parse($expiry)->toDateTimeString() : '';
                $trail = !empty($package) && $package->trial == 1 ? 'true' : 'false';

                $doctor = User::where('id', Auth::id())->with('appointments')->with('diseases')->with('specialities')->with('location')->with('services')->with('profile')->with('area')->with('feedbacks')->with('doc_teams')->with('roles')->first();
                $doctors = User::role('doctor')->where('id', '!=', Auth::id())->with('profile')->with('specialities')->with('feedbacks')->with('services')->with('location')->with('diseases')->with('orderMeta')->get();
                $hospitals = User::role('hospital')->with('profile')->with('specialities')->with('feedbacks')->with('services')->with('location')->with('diseases')->with('orderMeta')->get();

                return View(
                    'back-end.doctors.dashboard',
                    compact(
                        'doctor', 'doctors', 'hospitals'
                    )
                );
            } else {
                return View(
                    'back-end.hospitals.dashboard',
                    compact(
                        'hidden_saved_item',
                        'hidden_manage_teams'
                    )
                );
            }
        } else {
            abort(404);
        }
    }
    /**
     * Show User Profile Settings Form.
     *
     * @return \Illuminate\Http\Response
     */

    public function userProfileSettings($role_type )
    {
        
        if (Auth::user()) {
            $id = Auth::id();
            $diseases = Disease::all();
            $user = User::where('id',$id)->with('diseases')->with('specialities')->with('location')->with('services')->with('appointments')->with('roles')->first();
            $user_id = UserMeta::where('user_id',Auth::id())->first();
            $diseases_tags = Auth::user()->diseases()->get();
            $user_role = $role_type == 'admin' ? 'admin' : $role_type . 's';
            $user_meta = Auth::user()->profile;
            $specs = $this->getSpecialities();
            $willing_home_visit = !empty($user_meta->willing_home_visit) ? $user_meta->willing_home_visit : '';
            $willing_video = !empty($user_meta->willing_video) ? $user_meta->willing_video : '';
            $leave = !empty($user_meta->leave) ? json_decode($user_meta->leave, true) : array();
            $mark_red = !empty($user_meta->mark_red) ? $user_meta->mark_red : '';
            $mark_incomplete = !empty($user_meta->mark_incomplete) ? $user_meta->mark_incomplete : '';
            

            $gender_title = !empty($user_meta->gender_title) ? $user_meta->gender_title : '';
            $sub_heading = !empty($user_meta->sub_heading) ? $user_meta->sub_heading : '';
            $short_desc = !empty($user_meta->short_desc) ? $user_meta->short_desc : '';
            $description = !empty($user_meta->description) ? $user_meta->description : '';
            // dd($description);
            $available_days = !empty($user_meta->available_days) ? json_decode($user_meta->available_days) : array();
            $starting_price = !empty($user_meta->starting_price) ? $user_meta->starting_price : '';
            $memberships = !empty($user_meta->memberships) ? json_decode($user_meta->memberships, true) : array();
            $registration = !empty($user_meta->verify_medical) ? json_decode($user_meta->verify_medical, true) : array();
            $registration_number = !empty($registration) ? $registration['registration_number'] : '';
            $registration_document = !empty($registration) && $registration['registration_document'] ? $registration['registration_document'] : '';
            $downloads = !empty($user_meta->downloads) ? json_decode($user_meta->downloads, true) : '';
            $locations = Location::pluck('title', 'id');
            $allLocations = Location::with('areas')->select('id','title','slug')->get();
            $address = !empty($user_meta->address) ? $user_meta->address : '';
            $longitude = !empty($user_meta->longitude) ? $user_meta->longitude : '';
            $latitude = !empty($user_meta->latitude) ? $user_meta->latitude : '';
            $add_longitude = !empty($user_meta->add_longitude) ? $user_meta->add_longitude : '';
            $add_latitude = !empty($user_meta->add_latitude) ? $user_meta->add_latitude : '';
            $avatar = !empty($user_meta->avatar) ? $user_meta->avatar : '';
            $banner = !empty($user_meta->banner) ? $user_meta->banner : '';
            $galleries = !empty($user_meta->gallery) ? json_decode($user_meta->gallery, true) : '';
            $gallery_videos = !empty($user_meta->gallery_videos) ? json_decode($user_meta->gallery_videos, true) : '';
            $gender = !empty($user_meta->gender) ? $user_meta->gender : '';

            $extended = !empty($user_meta->extend) ? $user_meta->extend : '';
            $commission = !empty($user_meta->commission) ? $user_meta->commission : '';
            $fees_range = !empty($user_meta->fees_range) ? json_decode($user_meta->fees_range, true) : '';
           
            $from_fees = !empty($fees_range['from_fees']) ? $fees_range['from_fees'] : '';
            $to_fees = !empty($fees_range['to_fees']) ? $fees_range['to_fees'] : '';
            $working_time = !empty($user_meta->working_time) ? $user_meta->working_time : '';
                $language = !empty($user_meta->language) ? json_decode($user_meta->language, true) : array();

            $hospital_services_data = !empty($user_meta->hospital_services) ? json_decode($user_meta->hospital_services) : '';
            $hospital_icu = !empty($hospital_services_data->hospital_icu) ? $hospital_services_data->hospital_icu: '';
            $hospital_emergency = !empty($hospital_services_data->hospital_emergency) ? $hospital_services_data->hospital_emergency : '';
            $hospital_ventilator = !empty($hospital_services_data->hospital_ventilator) ? $hospital_services_data->hospital_ventilator : '';
            $hospital_24_service = !empty($hospital_services_data->hospital_24_service) ? $hospital_services_data->hospital_24_service : '';
            $ambulance = !empty($hospital_services_data->ambulance) ? $hospital_services_data->ambulance : '';
            $waiting_lounge = !empty($hospital_services_data->waiting_lounge) ? $hospital_services_data->waiting_lounge : '';
            $laboratory = !empty($hospital_services_data->laboratory) ? $hospital_services_data->laboratory : '';
            $pharmacy = !empty($hospital_services_data->pharmacy) ? $hospital_services_data->pharmacy : '';
            $blood_bank = !empty($hospital_services_data->blood_bank) ? $hospital_services_data->blood_bank : '';
            $atm = !empty($hospital_services_data->atm) ? $hospital_services_data->atm : '';
            $car_parking = !empty($hospital_services_data->car_parking) ? $hospital_services_data->car_parking : '';
            $cafeteria = !empty($hospital_services_data->cafeteria) ? $hospital_services_data->cafeteria : '';
            if (file_exists(resource_path('views/extend/back-end/' . $user_role . '/profile-settings/index.blade.php'))) {
                return view(
                    'extend.back-end.' . $user_role . '/profile-settings.index',
                    compact(
                        'user',
                        'gallery_videos',
                        'willing_home_visit',
                        'willing_video',
                        'leave',
                        'mark_incomplete',
                        'mark_red',
                        'allLocations',
                        'galleries',
                        'working_time',
                        'available_days',
                        'language',
                        'gender_title',
                        'sub_heading',
                        'short_desc',
                        'description',
                        'starting_price',
                        'memberships',
                        'avatar',
                        'banner',
                        'registration_number',
                        'registration_document',
                        'downloads',
                        'user_role',
                        'address',
                        'longitude',
                        'latitude',
                        'add_longitude',
                        'add_latitude',
                        'locations',
                        'gender',
                        'specs',
                        'commission',
                        'from_fees',
                        'to_fees',
                        'extended',
                        'diseases',
                        'diseases_tags',
                        'hospital_icu',
                        'hospital_emergency',
                        'hospital_ventilator',
                        'hospital_24_service',
                        'ambulance',
                        'waiting_lounge',
                        'laboratory',
                        'pharmacy',
                        'blood_bank',
                        'atm',
                        'car_parking',
                        'cafeteria'
                    )
                );
            } else {
                return view(
                    'back-end.' . $user_role . '/profile-settings.index',
                    compact(
                        'user',
                        'gallery_videos',
                        'galleries',
                        'working_time',
                        'willing_home_visit',
                        'willing_video',
                        'leave',
                        'mark_incomplete',
                        'mark_red',
                        'allLocations',
                        'available_days',
                        'language',
                        'gender_title',
                        'sub_heading',
                        'short_desc',
                        'description',
                        'starting_price',
                        'memberships',
                        'avatar',
                        'banner',
                        'registration_number',
                        'registration_document',
                        'downloads',
                        'user_role',
                        'address',
                        'longitude',
                        'latitude',
                        'add_longitude',
                        'add_latitude',
                        'locations',
                        'gender',
                        'specs',
                        'commission',
                        'from_fees',
                        'to_fees',
                        'extended',
                        'diseases',
                        'diseases_tags',
                        'hospital_icu',
                        'hospital_emergency',
                        'hospital_ventilator',
                        'hospital_24_service',
                        'ambulance',
                        'waiting_lounge',
                        'laboratory',
                        'pharmacy',
                        'blood_bank',
                        'atm',
                        'car_parking',
                        'cafeteria'
                    )
                );
            }
        }
    }

    /**
     * Store User profile settings.
     *
     * @param \Illuminate\Http\Request $request   request attributes
     * @param string                   $role_type role_type
     *
     * @return \Illuminate\Http\Response
     */
    public function storeUserProfileSettings(Request $request, $role_type)
    {
        //dd($request->all());
        $diseases = [];
        if(!empty($request->diseases)){
        $diseases = explode( ',',$request->diseases);
        }
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if ($role_type == 'admin') {
            if ($request['email'] != Auth::user()->email) {
                $this->validate(
                    $request,
                    [
                        'email' => 'unique:users|email',
                    ]
                );
            }
            $this->validate(
                $request,
                [
                    'first_name' => 'required',
                    'last_name' => 'required',
                ]
            );
        } else {
            $this->validate(
                $request,
                [
                    'first_name' => 'required',
                    'last_name' => 'required',
                ]
            );
        }
        if (!empty($request['latitude']) || !empty($request['longitude'])) {
            $this->validate(
                $request,
                [
                    'latitude' => ['regex:/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}$/'],
                    'longitude' => ['regex:/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,6}$/'],
                ]
            ); 
        }
        if (Auth::user()) {
            $profile = $this->user_meta->storeProfile($request, Auth::user()->id);
            $user = User::where('id',Auth::user()->id)->first();
            if (!empty($diseases)){
                $user->diseases()->detach();
                foreach ($diseases as $disease){
                    $user->diseases()->attach($disease);
            }
            }
            if ($profile == 'success') {
                $json['type'] = 'success';
                $json['role'] = Helper::getAuthRoleType();
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.personal_details_saved');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Store User profile settings.
     *
     * @param \Illuminate\Http\Request $request   request attributes
     * @param string                   $role_type role_type
     *
     * @return \Illuminate\Http\Response
     */
    public function storeUserGallery(Request $request, $role_type)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (Auth::user()) {
            $profile = $this->user_meta->storeGallery($request, Auth::user()->id);
            if ($profile == 'success') {
                $json['type'] = 'success';
                $json['role'] = Helper::getAuthRoleType();
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.personal_details_saved');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

     public function storeUpdateUserGallery(Request $request, $role_type)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (Auth::user()) {
            $profile = $this->user_meta->storeGallery($request, $request['id']);
            if ($profile == 'success') {
                $json['type'] = 'success';
                $json['role'] = Helper::getAuthRoleType();
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.personal_details_saved');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Get experiences
     *
     * @return \Illuminate\Http\Response
     */
    public function getExperiences()
    {
        $json = array();
        if (Auth::user()) {
            $userId = Session::get('user_admin_id');
            $stored_experiences = array();
            if(!empty($userId)){
                $data = $this->user_meta::select('experiences')->where('user_id',$userId)->pluck('experiences')->first();
            } else {
            $data = $this->user_meta::select('experiences')->where('user_id', Auth::user()->id)->pluck('experiences')->first();
            }
            $experiences = !empty($data) ? json_decode($data, true) : array();

            if (!empty($experiences)) {
                foreach ($experiences as $key => $value) {
                    $stored_experiences[] = $value;
                }
               
                $json['type'] = 'success';
                $json['experiences'] = $stored_experiences;
                return $json;
            } else {
                
                $json['type'] = 'error';
                return $json;
            }
        } else {
            
                $json['type'] = 'error';
            return $json;
        }
    }
    /**
     * Get experiences
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserExperiences($id)
    {
        $json = array();
        $user = User::where('id',$id)->first();
        // return $user;
        if (!empty($user)) {
            $stored_experiences = array();
            $data = UserMeta::where('user_id', $id)->pluck('experiences')->first();
            $experiences = !empty($data) ? json_decode($data,true) : array();
            if (!empty($experiences)) {
                foreach ($experiences as $key => $value) {
                    $stored_experiences[] = $value;
                }
                $json['type'] = 'success';
                $json['experiences'] = $stored_experiences;
                return $json;
            } else {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
    /**
     * Get educations
     *
     * @return \Illuminate\Http\Response
     */
    public function getEducations()
    {
        $json = array();
        if (Auth::user()) {
            $userId = Session::get('user_admin_id');
            $stored_educations = array();
            if(!empty($userId)){
                 $data = $this->user_meta::select('educations')->where('user_id',$userId)->pluck('educations')->first();
            }else {
           
            $data = $this->user_meta::select('educations')->where('user_id', Auth::user()->id)->pluck('educations')->first();
            }
            $educations = !empty($data) ? json_decode($data, true) : array();
            if (!empty($educations)) {
                foreach ($educations as $key => $value) {
                    $stored_educations[] = $value;
                }
               
                $json['type'] = 'success';
                $json['educations'] = $stored_educations;
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.no_record');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Get hospitals
     *
     * @return \Illuminate\Http\Response
     */
    public function getHospitals()
    {
        $json = array();
        $hospitals = User::role('hospital')->select(
            DB::raw("CONCAT(users.first_name,' ',users.last_name) AS name"),
            "id"
        )->get()->toArray();
        if (!empty($hospitals)) {
            $json['type'] = 'success';
            $json['hospitals'] = $hospitals;
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

     /**
     * Get locations
     *
     * @return \Illuminate\Http\Response
     */
    public function getLocations()
    {
        $json = array();
        $locations = Location::get(['title', 'id']);
        if (!empty($locations)) {
            $json['type'] = 'success';
            $json['locations'] = $locations;
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Add item in wishlist.
     *
     * @param mixed $request request->attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function addWishlist(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (Auth::user()) {
            $json['authentication'] = true;
            if (!empty($request['id'])) {
                $user_id = Auth::user()->id;
                $id = $request['id'];
                if (!empty($request['column'])) {
                    if ($request['column'] === 'saved_hospitals' || $request['column'] === 'saved_doctors') {
                        if ($user_id == $id) {
                            $json['type'] = 'error';
                            $json['message'] = trans('lang.login_from_different_user');
                            return $json;
                        }
                    } elseif ($request['column'] === 'saved_articles') {
                        $article = Article::find($id);
                        if ($user_id == $article->author->id) {
                            $json['type'] = 'error';
                            $json['message'] = trans('lang.login_from_different_user');
                            return $json;
                        }
                    }
                }
                $add_wishlist = $this->user_meta->addWishlist($request['column'], $id, $user_id);
                $article_likes = '';
                if ($add_wishlist == "success") {
                    if ($request['column'] == 'saved_articles') {
                        $article = Article::find($id);
                        if (!empty($article->likes)) {
                            $article->likes = $article->likes + 1;
                        } else {
                            $article->likes = 1;
                        }
                        $article_likes = $article->likes;
                        $article->save();
                        $json['likes'] = $article_likes;
                    }
                    $json['type'] = 'success';

                    $json['message'] = trans('lang.added_to_wishlist');
                    return $json;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.something_wrong');
                    return $json;
                }
            }
        } else {
            $json['authentication'] = false;
            $json['message'] = trans('lang.need_to_reg');
            return $json;
        }
    }



    /**
     * Remove item in wishlist.
     *
     * @param mixed $request request->attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function removeWishlist(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (Auth::user()) {
            $json['authentication'] = true;
            if (!empty($request['id'])) {
                $user_id = Auth::user()->id;
                $id = $request['id'];
                if (!empty($request['column'])) {
                    if ($request['column'] === 'saved_hospitals' || $request['column'] === 'saved_doctors') {
                        if ($user_id == $id) {
                            $json['type'] = 'error';
                            $json['message'] = trans('lang.login_from_different_user');
                            return $json;
                        }
                    } elseif ($request['column'] === 'saved_articles') {
                        $article = Article::find($id);
                        if ($user_id == $article->author->id) {
                            $json['type'] = 'error';
                            $json['message'] = trans('lang.login_from_different_user');
                            return $json;
                        }
                    }
                }
                $add_wishlist = $this->user_meta->removeWishlist($request['column'], $id, $user_id);
                $article_likes = '';
                if ($add_wishlist == "success") {
                    if ($request['column'] == 'saved_articles') {
                        $article = Article::find($id);
                        if (!empty($article->likes)) {
                            $article->likes = $article->likes + 1;
                        } else {
                            $article->likes = 1;
                        }
                        $article_likes = $article->likes;
                        $article->save();
                        $json['likes'] = $article_likes;
                    }
                    $json['type'] = 'success';

                    $json['message'] = trans('lang.remove_from_wishlist');
                    return $json;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.something_wrong');
                    return $json;
                }
            }
        } else {
            $json['authentication'] = false;
            $json['message'] = trans('lang.need_to_reg');
            return $json;
        }
    }

    /**
     * Get User Saved Item
     *
     * @param mixed $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserWishlist(Request $request)
    {
        if (Auth::user()) {
            $user = $this->user::find(Auth::user()->id);
            $profile = $user->profile;
            if (!empty($request['slug'])) {
                $json = array();
                $selected_user = DB::table('users')->select('id')
                    ->where('slug', $request['slug'])->get()->first();
                $role = $this->user::getRoleTypeByUserID($selected_user->id);
                if ($role->role_type == 'doctor') {
                    $json['user_type'] = 'doctor';
                    if (in_array($selected_user->id, json_decode($profile->saved_doctors))) {
                        $json['current_doctor'] = 'true';
                    }
                    return $json;
                }
                if ($role->role_type == 'hospital') {
                    $json['user_type'] = 'hospital';
                    if (in_array($selected_user->id, json_decode($profile->saved_hospitals))) {
                        $json['current_hospital'] = 'true';
                    }
                    return $json;
                }
            }
        }
    }

    /**
     * Submit Report
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeReport(Request $request)
    {

        $report = $this->report->submitReport($request);
        $user = $report['user'];
        $doctor = $report['doctor'];
        if ($report['type'] == 'success') {
            $json['type'] = 'success';
            //send email
            if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                $user = $this->user::find($report['user_id']);
                $email_params = array();

                $report_user_admin_email = DB::table('email_types')->select('id')->where('email_type', 'admin_email_report_user')->get()->first();
                if (!empty($report_user_admin_email->id)) {
                    $template_data = EmailTemplate::getEmailTemplateByID($report_user_admin_email->id);
                    $email_params['user_name'] = $doctor->first_name.' '.$doctor->last_name;
                    $email_params['user_role'] = Helper::getRoleNameByRoleID(Helper::getRoleByUserID($doctor->id));
                    $email_params['user_profile'] = url('profile/' . $doctor->slug);
                    $email_params['name'] = $request['name'];
                    $email_params['email'] = $request['email'];
                    $email_params['description'] = $request['description'];
                    Mail::to(config('mail.username'))
                        ->send(
                            new AdminEmailMailable(
                                'admin_email_report_user',
                                $template_data,
                                $email_params
                            )
                        );
                }

                /*$report_user_admin_email = DB::table('email_types')->select('id')->where('email_type', 'admin_email_report_user')->get()->first();
                if (!empty($report_user_admin_email->id)) {
                    $template_data = EmailTemplate::getEmailTemplateByID($report_user_admin_email->id);
                    $email_params['user_name'] = Helper::getUserName($user->id);
                    $email_params['user_role'] = $user->GetRoleNames()->first();
                    $email_params['user_profile'] = url('profile/' . $user->slug);
                    $email_params['name'] = $request['name'];
                    $email_params['email'] = $request['email'];
                    $email_params['description'] = $request['description'];
                    Mail::to(config('mail.username'))
                        ->send(
                            new AdminEmailMailable(
                                'admin_email_report_user',
                                $template_data,
                                $email_params
                            )
                        );
                }
                $report_user_email = DB::table('email_types')->select('id')->where('email_type', 'user_email_report_user')->get()->first();
                if (!empty($report_user_email->id)) {
                    $template_data = EmailTemplate::getEmailTemplateByID($report_user_email->id);
                    $email_params['user_name'] = Helper::getUserName($user->id);
                    $email_params['user_role'] = $user->GetRoleNames()->first();
                    $email_params['user_profile'] = url('profile/' . $user->slug);
                    $email_params['description'] = $request['description'];
                    Mail::to($request['email'])
                        ->send(
                            new GeneralEmailMailable(
                                'user_email_report_user',
                                $template_data,
                                $email_params
                            )
                        );
                }*/
            }
            $json['message'] = trans('lang.report_submitted');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
        $json['message'] = trans('lang.report_submitted');
        return $report;
    }

    /**
     * Checkout Page.
     *
     * @param \Illuminate\Http\Request $id ID
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout($id)
    {
        if (!empty($id)) {
            $appointment = Appointment::findOrFail($id);
            $payment_settings = SiteManagement::getMetaValue('payment_settings');
            $payment_gateway = !empty($payment_settings) && !empty($payment_settings['payment_method']) ? $payment_settings['payment_method'] : array();
            $symbol = !empty($payment_settings) && !empty($payment_settings['currency']) ? Helper::currencyList($payment_settings['currency']) : array();
            if (file_exists(resource_path('views/extend/back-end/package/checkout.blade.php'))) {
                return view::make('extend.back-end.package.checkout', compact('payment_gateway', 'symbol', 'appointment'));
            } else {
                return view::make('back-end.package.checkout', compact('payment_gateway', 'symbol', 'appointment'));
            }
        } else {
            abort(404);
        }
    }

    /**
     * Print Thankyou.
     *
     * @return \Illuminate\Http\Response
     */
    public function thankyou()
    {
        if (Auth::user()) {
            echo trans('lang.thankyou');
        } else {
            abort(404);
        }
    }

    /**
     * Store registration settings.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function storeRegistrationSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        $this->validate(
            $request,
            [
                'registration_number' => 'required',
                'registration_document' => 'required',
            ]
        );
        if (Auth::user()) {
            $registration = $this->user_meta->storeRegistration($request, Auth::user()->id);
            if ($registration == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.registration_details_saved');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Store registration settings.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function updateRegistrationSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        $this->validate(
            $request,
            [
                'registration_number' => 'required',
                'registration_document' => 'required',
            ]
        );
        if (Auth::user()) {
            $registration = $this->user_meta->storeRegistration($request, $request['id']);
            if ($registration == 'success') {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.registration_details_saved');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }
    /**
     * Add Liked Answers.
     *
     * @param mixed $request request->attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function addLikedAnswer(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (Auth::user()) {
            $json['authentication'] = true;
            if (!empty($request['id'])) {
                $user_id = Auth::user()->id;
                $id = $request['id'];
                $liked_answer = $this->user_meta->likeAnswer($request['column'], $id, $user_id);
                if ($liked_answer == "success") {
                    $json['type'] = 'success';
                    $json['message'] = clean(trans('lang.answer_liked'));
                    $json['liked_text'] = clean(trans('lang.liked_answer'));
                    return $json;
                } else {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.something_wrong');
                    return $json;
                }
            }
        } else {
            $json['authentication'] = false;
            $json['message'] = trans('lang.need_to_reg');
            return $json;
        }
    }

    /**
     * Get User Saved Item
     *
     * @param mixed $request request attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getLikedAnswer(Request $request)
    {
        if (Auth::user()) {
            $user = $this->user::find(Auth::user()->id);
            $profile = $user->profile;
            if (!empty($request['id'])) {
                $json = array();
                $selected_answers = DB::table('user_forum')->select('id')
                    ->where('forum_id', $request['id'])->where('type', 'answer')->get()->first();
                if (!empty($selected_answers->id)) {
                    if (in_array($selected_answers->id, json_decode($profile->liked_answers, true))) {
                        $json['answer'] = 'true';
                    }
                }
                return $json;
            }
        }
    }

    /**
     * Get user specialities
     *
     * @return \Illuminate\Http\Response
     */
    public function getSpecialities()
    {
        $userId = Session::get('user_admin_id');

        $json = array();
        $list = array();
        if (Auth::user()) {
            if($userId){
                 $user = User::find($userId[0]);
                 $specialities = $user->profile->services;
            } else {
                $user = User::find(Auth::user()->id);
                $specialities = $user->profile->services;
            }

            if (!empty($specialities)) {
                $user_specialities = json_decode($specialities, true);

                foreach ($user_specialities as $key => $user_speciality) {
                    $speciality = Helper::getSpecialityByID($user_speciality['speciality_id']);
                    if (!empty($speciality)) {
                        $list[$key]['speciality']['id'] = $speciality->id;
                        $list[$key]['speciality']['title'] = $speciality->title;
                        $list[$key]['speciality']['image'] = url(Helper::getImage('/uploads/specialities/', $speciality->image, 'extra-small-', 'default-speciality.png'));
                        if (!empty($user_speciality['services'])) {
                            $list[$key]['speciality']['services'] = $user_speciality['services'];
                            foreach ($user_speciality['services'] as $spaciality_key => $user_service) {
                                $service = Helper::getServiceByID($user_service['service']);
                                if (!empty($service)) {
                                    $list[$key]['speciality']['services'][$spaciality_key]['id'] = $service->id;
                                    $list[$key]['speciality']['services'][$spaciality_key]['title'] = $service->title;
                                    $list[$key]['speciality']['services'][$spaciality_key]['price'] = $user_service['price'];
                                    $list[$key]['speciality']['services'][$spaciality_key]['description'] = $user_service['description'];
                                }
                            }
                        }
                    }
                }
                
                $json['type'] = 'success';
                $json['user_specialities'] = $list;
                return $json;
            } else {
                
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            abort(404);
        }
    }


    /**
     * Get specific user record
     *
     * @param mixed $request       request attributes
     * @param int   $index         index
     * @param int   $service_index service_index
     *
     * @access public
     *
     * @return View
     */
    public function destroySpeciality(Request $request, $index, $service_index = "")
    {   $userId = Session::get('user_admin_id');
        
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        if (Auth::user()) {
            if(!empty($userId))
            {
                $user = $this->user::find($userId[0]);
            } else {
            
            $user = $this->user::find(Auth::user()->id);
            
            }
            $profile = $user->profile;
            if (!empty($profile) && !empty($profile->services)) {
                $specialities = json_decode($profile->services, true);
                if (!empty($service_index) || $service_index == 0) {
                    $services = $specialities[$index]['services'];
                    unset($services[$service_index]);
                    $specialities[$index]['services'] = $services;
                } else {
                    unset($specialities[$index]);
                }
                $user_profile = UserMeta::find($profile->id);
                $user_profile->services = json_encode($specialities);
                $user_profile->save();
                $json['type'] = 'success';
                $json['message'] = trans('lang.speciality_deleted');
                return $json;
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get user saved item list
     *
     * @param mixed $request request attributes
     * @param int   $role    role
     *
     * @access public
     *
     * @return View
     */
    public function getSavedItems(Request $request, $role = '')
    {
        if (Auth::user()) {
            $user = $this->user::find(Auth::user()->id);
            $icons = SiteManagement::getMetaValue('icons');
            $hidden_doctor_image = !empty($icons['hidden_doctor_image']) ? $icons['hidden_doctor_image'] : '';
            $hidden_hospital_image = !empty($icons['hidden_hospital_image']) ? $icons['hidden_hospital_image'] : '';
            $saved_doctors   = !empty($user->profile->saved_doctors) ? json_decode($user->profile->saved_doctors) : array();
            $saved_hospitals = !empty($user->profile->saved_hospitals) ? json_decode($user->profile->saved_hospitals) : array();
            $saved_articles  = !empty($user->profile->saved_articles) ? json_decode($user->profile->saved_articles) : array();
            $currency        = SiteManagement::getMetaValue('payment_settings');
            $symbol          = !empty($currency) && !empty($currency['currency']) ? Helper::currencyList($currency['currency']) : array();
            if ($request->path() === 'patient/saved-items') {
                if (file_exists(resource_path('views/extend/back-end/patient/saved-items.blade.php'))) {
                    return view(
                        'extend.back-end.patients.saved-items',
                        compact(
                            'saved_doctors',
                            'saved_hospitals',
                            'saved_articles',
                            'symbol',
                            'hidden_doctor_image',
                            'hidden_hospital_image'
                        )
                    );
                } else {
                    return view(
                        'back-end.patients.saved-items',
                        compact(
                            'saved_doctors',
                            'saved_hospitals',
                            'saved_articles',
                            'symbol',
                            'hidden_doctor_image',
                            'hidden_hospital_image'
                        )
                    );
                }
            } elseif ($request->path() === 'doctor/saved-items') {
                if (file_exists(resource_path('views/extend/back-end/doctors/saved-items.blade.php'))) {
                    return view(
                        'extend.back-end.doctors.saved-items',
                        compact(
                            'saved_doctors',
                            'saved_hospitals',
                            'saved_articles',
                            'symbol',
                            'hidden_doctor_image',
                            'hidden_hospital_image'
                        )
                    );
                } else {
                    return view(
                        'back-end.doctors.saved-items',
                        compact(
                            'saved_doctors',
                            'saved_hospitals',
                            'saved_articles',
                            'symbol',
                            'hidden_doctor_image',
                            'hidden_hospital_image'
                        )
                    );
                }
            } elseif ($request->path() === 'hospital/saved-items') {
                if (file_exists(resource_path('views/extend/back-end/hospitals/saved-items.blade.php'))) {
                    return view(
                        'extend.back-end.hospitals.saved-items',
                        compact(
                            'saved_doctors',
                            'saved_hospitals',
                            'saved_articles',
                            'symbol',
                            'hidden_doctor_image',
                            'hidden_hospital_image'
                        )
                    );
                } else {
                    return view(
                        'back-end.hospitals.saved-items',
                        compact(
                            'saved_doctors',
                            'saved_hospitals',
                            'saved_articles',
                            'symbol',
                            'hidden_doctor_image',
                            'hidden_hospital_image'
                        )
                    );
                }
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get Payouts.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPayouts(Request $request)
    {
        if (!empty($_GET['year']) && !empty($_GET['month'])) {
            $year = $_GET['year'];
            $month = $_GET['month'];
            $payouts =  DB::table('payouts')
                ->select('*')
                ->whereYear('created_at', '=', $year)
                ->whereMonth('created_at', '=', $month)
                ->paginate(10)->setPath('');
            $pagination = $payouts->appends(
                array(
                    'year' => $request->get('year')
                )
            );
        } else {
            $payouts =  Payout::paginate(10);
        }
        $selected_year = !empty($_GET['year']) ? $_GET['year'] : '';
        $selected_month = !empty($_GET['month']) ? $_GET['month'] : '';
        $months = Helper::getMonthList();
        $years = array_combine(range(date("Y"), 1970), range(date("Y"), 1970));
        if (file_exists(resource_path('views/extend/back-end/admin/payouts.blade.php'))) {
            return view(
                'extend.back-end.admin.payouts',
                compact('payouts', 'years', 'selected_year', 'months', 'selected_month')
            );
        } else {
            return view(
                'back-end.admin.payouts',
                compact('payouts', 'years', 'selected_year', 'months', 'selected_month')
            );
        }
    }

    /**
     * Generate PDF.
     *
     * @param date $year  year
     * @param date $month month
     * 
     * @return \Illuminate\Http\Response
     */
public function generatePDFRecept($time,$date)
    {
        //dd($time,$date);
         $get_data = Appointment::where('appointment_time',$time)->where('appointment_date',$date)->with('patient_profile')->with('doctor_profile')->with('hospital_profile')->first();
         //return view('front-end.doctors.download-recept', compact('get_data'));
         //dd($get_data);
        $pdf = PDF::loadView('front-end.doctors.download-recept', compact('get_data'));
         $headers = [
              'Content-Type' => 'application/pdf',
           ];
        return $pdf->download('patient-appointment-receipt'.'.pdf', $headers);
    }
public function generateTestPDFRecept($date,$lastInsertId)
    {
        // dd($date,$id);

         $get_data = BookTest::where('date_preferred',$date)->where('id', $lastInsertId)->with('lab')->first();
         // $testData = json_decode($get_data->test_id);
         // $labData = $get_data->lab->id;
            // dd($testData);
         
         // dd($get_data);
         //return view('front-end.doctors.download-recept', compact('get_data'));
         //dd($get_data);
        $pdf = PDF::loadView('front-end.for-laboratory.download-test-pdf-reciept', compact('get_data'));
         $headers = [
              'Content-Type' => 'application/pdf',
           ];
        return $pdf->download('test-booking-receipt'.'.pdf', $headers);
    }

    public function generatePDF($year, $month)
    {
        $payouts =  DB::table('payouts')
            ->select('*')
            ->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->get();
        $pdf = PDF::loadView('back-end.admin.payouts-pdf', compact('payouts', 'year', 'month'));
        return $pdf->download('payout-' . $month . '-' . $year . '.pdf');
    }

    /**
     * Get payout detail
     * 
     * @return JSON Response
     */
    public function getPayoutDetail()
    {
        $json = array();
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            $payout_detail = !empty($user->profile) ? json_decode($user->profile->payout_settings, true) : array();
            $json['type'] = 'success';
            $json['payouts'] = $payout_detail;
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.verify_code');
            return $json;
        }
    }

    /**
     * Update Payout detail
     *
     * @param mixed $request request attributes
     * 
     * @return \Illuminate\Http\Response
     */
    public function updatePayoutDetail(Request $request)
    {
        $user_id = $request['id'];
        if (!empty($user_id)) {
            $payout_setting = $this->user_meta->savePayoutDetail($request, $user_id);
            if ($payout_setting == 'success') {
                $json['type'] = 'success';
                $json['message'] = trans('lang.payout_saved_success');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_went_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.verify_code');
            return $json;
        }
    }

    /**
     * Update user medical status
     *
     * @param mixed $request request attributes
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateUserMedical(Request $request)
    {        
        if (!empty($request['user_id'])) {
            if ($request['type'] == 'not_verify') {
                DB::table('user_metas')
                    ->where('user_id', (int)$request['user_id'])
                    ->update(['verify_registration' => 0]);
                $json['status_text'] = trans('lang.not_verified');
            } else {
                DB::table('user_metas')
                    ->where('user_id', (int)$request['user_id'])
                    ->update(['verify_registration' => 1]);
                $json['status_text'] = trans('lang.verified');
            }
            $json['type'] = 'success';
            $json['message'] = trans('lang.medical_status');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }

    /**
     * Get Doctor Invoices.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserInvoices()
     {
        if (Helper::getAuthRoleType() != 'admin' && Helper::getAuthRoleType() == 'doctor' || Helper::getAuthRoleType() == 'patient') {
            $invoices = Auth::user()->orders()->get();
            $currency   = SiteManagement::getMetaValue('payment_settings');
            $symbol = !empty($currency) && !empty($currency['currency']) ? Helper::currencyList($currency['currency']) : array();
            if (Helper::getAuthRoleType() == 'doctor') {
                if (file_exists(resource_path('views/extend/back-end/doctors/invoices/package.blade.php'))) {
                    return view('extend.back-end.doctors.invoices.package', compact('invoices', 'symbol'));
                } else {
                    return view('back-end.doctors.invoices.package', compact('invoices', 'symbol'));
                }
            } else if (Helper::getAuthRoleType() == 'patient') {
                if (file_exists(resource_path('views/extend/back-end/patients/invoices/appointment.blade.php'))) {
                    return view('extend.back-end.patients.invoices.appointment', compact('invoices', 'symbol'));
                } else {
                    return view('back-end.patients.invoices.appointment', compact('invoices', 'symbol'));
                }
            }
        } else {
            abort(404);
        }
    }

    /**
     * Get Invoices.
     *
     * @param integer $id roletype
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserInvoicess(){
        $reciept_data = array();
         if (Helper::getAuthRoleType() == 'doctor') {
             $all_appointments = Auth::user()->appointments()->get();
              $currency   = SiteManagement::getMetaValue('payment_settings');
              $symbol = !empty($currency) && !empty($currency['currency']) ? Helper::currencyList($currency['currency']) : array();
              return view('back-end.doctors.invoices.package', compact('all_appointments','symbol', 'patient_id'));

            // foreach ($all_appointments as $key => $data) {

            // $order_metas =   DB::table('orders')->where("user_id",$data->patient_id)->get();
            //     dd($order_metas);
            // }
        }
            
    }
    public function showInvoice($id)
    {
        if (!empty($id)) {
            $order = Order::findOrFail($id);


           // $order_metas =   DB::table('order_metas')->where("metable_id",$order->id)->get();
               
          //  $user =   DB::table('users')->where("id",$order->user_id)->first();
             //dd($user);
          //  $currency_code = !empty($order->metaValue('currency_code')) ? strtoupper($order->metaValue('currency_code')) : 'Rs';
 //$options = unserialize($order->metaValue('package'));
          
            //$code = Helper::currencyList($currency_code);
            //$symbol = !empty($code) ? $code['symbol'] : 'Rs';

    return view('back-end.patients.invoices.show', compact('order'));
              //return view('back-end.patients.invoices.show', compact('order','order_metas' , 'symbol', 'currency_code','options','user'));
            
        //     if (Helper::getAuthRoleType() === 'doctor') {
        //        
        //         $package_options = unserialize($options['options']);
        //         if (file_exists(resource_path('views/extend/back-end/doctors/invoices/show.blade.php'))) {
        //             return view::make('extend.back-end.doctors.invoices.show', compact('order', 'options', 'symbol', 'currency_code'));
        //         } else {
        //             return view::make('back-end.doctors.invoices.show', compact('order', 'options', 'symbol', 'currency_code'));
        //         }
        //     } else if (Helper::getAuthRoleType() === 'patient') {
        //         $options = unserialize($order->metaValue('appointment'));
        //         if (file_exists(resource_path('views/extend/back-end/patients/invoices/show.blade.php'))) {
        //             return view::make('extend.back-end.patients.invoices.show', compact('order', 'options', 'symbol', 'currency_code'));
        //         } else {
        //             return view::make('back-end.patients.invoices.show', compact('order', 'options', 'symbol', 'currency_code'));
        //         }
        //     }
        // } else {
        //     abort(404);
         }
    }

    /**
     * Store service data in storage
     *
     * @param string $request user-slug
     *
     * @access public
     *
     * @return View
     */
    public function storeServices(Request $request)
    {
        $json = array();
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            if (!empty($request['services'])) {
                $specialities  = Arr::pluck($request['services'], 'speciality');
                $temp_array  = array_unique($specialities);
                $duplicates = sizeof($temp_array) != sizeof($specialities);
                if ($duplicates == true) {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.duplicate_speciality');
                    return $json;
                }
            }
            $services = $this->user_meta->saveServices($request, Auth::user()->id);
            if ($services['type'] == 'speciality_required') {
                $json['type'] = 'error';
                $json['message'] = trans('lang.speciality_required');
                return $json;
            } elseif ($services['type'] == 'service_required') {
                $json['type'] = 'error';
                $json['message'] = trans('lang.service_required');
                return $json;
            } elseif ($services['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.speciality_updated');
                return $json;
            } elseif ($services['type'] == "error") {
                $json['type'] = 'error';
                $json['message'] = $services['message'];
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Store service data in storage
     *
     * @param string $request user-slug
     *
     * @access public
     *
     * @return View
     */
    public function updatestoreServices(Request $request)
    {
        $json = array();
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            if (!empty($request['services'])) {
                $specialities  = Arr::pluck($request['services'], 'speciality');
                $temp_array  = array_unique($specialities);
                $duplicates = sizeof($temp_array) != sizeof($specialities);
                if ($duplicates == true) {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.duplicate_speciality');
                    return $json;
                }
            }
            $services = $this->user_meta->saveServices($request,$request['id']);
            if ($services['type'] == 'speciality_required') {
                $json['type'] = 'error';
                $json['message'] = trans('lang.speciality_required');
                return $json;
            } elseif ($services['type'] == 'service_required') {
                $json['type'] = 'error';
                $json['message'] = trans('lang.service_required');
                return $json;
            } elseif ($services['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.speciality_updated');
                return $json;
            } elseif ($services['type'] == "error") {
                $json['type'] = 'error';
                $json['message'] = $services['message'];
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }


    /**
     * Store service data in storage
     *
     * @param string $request user-slug
     *
     * @access public
     *
     * @return View
     */
    public function updatestoreHospitalServices(Request $request)
    {
        $json = array();
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            if (!empty($request['hospital_icu'])) {
                $json['hospital_icu'] = true;
            }
            else{
                $json['hospital_icu'] = false;
            }
            if (!empty($request['hospital_emergency'])) {
                $json['hospital_emergency'] = true;
            }
            else{
                $json['hospital_emergency'] = false;
            }
            if (!empty($request['hospital_ventilator'])) {
                $json['hospital_ventilator'] = true;
            }
            else{
                $json['hospital_ventilator'] = false;
            }
            if (!empty($request['hospital_24_service'])) {
                $json['hospital_24_service'] = true;
            }
            else{
                $json['hospital_24_service'] = false;
            }
            if (!empty($request['ambulance'])) {
                $json['ambulance'] = true;
            }
            else{
                $json['ambulance'] = false;
            }
             if (!empty($request['waiting_lounge'])) {
                $json['waiting_lounge'] = true;
            }
            else{
                $json['waiting_lounge'] = false;
            }
             if (!empty($request['laboratory'])) {
                $json['laboratory'] = true;
            }
            else{
                $json['laboratory'] = false;
            }
             if (!empty($request['pharmacy'])) {
                $json['pharmacy'] = true;
            }
            else{
                $json['pharmacy'] = false;
            }
             if (!empty($request['blood_bank'])) {
                $json['blood_bank'] = true;
            }
            else{
                $json['blood_bank'] = false;
            }
             if (!empty($request['atm'])) {
                $json['atm'] = true;
            }
            else{
                $json['atm'] = false;
            }
             if (!empty($request['car_parking'])) {
                $json['car_parking'] = true;
            }
            else{
                $json['car_parking'] = false;
            }
             if (!empty($request['cafeteria'])) {
                $json['cafeteria'] = true;
            }
            else{
                $json['cafeteria'] = false;
            }
            $services = $this->user_meta->saveHospitalServices($json,$request['id']);
            if ($services['type'] == 'speciality_required') {
                $json['type'] = 'error';
                $json['message'] = trans('lang.speciality_required');
                return $json;
            } elseif ($services['type'] == 'service_required') {
                $json['type'] = 'error';
                $json['message'] = trans('lang.service_required');
                return $json;
            } elseif ($services['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.speciality_updated');
                return $json;
            } elseif ($services['type'] == "error") {
                $json['type'] = 'error';
                $json['message'] = $services['message'];
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }


    /**
     * Store faqs data in storage
     *
     * @param string $request user id and faq data
     *
     * @access public
     *
     * @return View
     */
    public function updatestoreFaqs(Request $request)
    {
        $json = array();
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $services = $this->user_meta->storefAQS($request,$request['id']);
            if ($services['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.faq');
                return $json;
            } elseif ($services['type'] == "error") {
                $json['type'] = 'error';
                $json['message'] = $services['message'];
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    } 


    /**
     * Store Bank data in storage
     *
     * @param string $request user id and faq data
     *
     * @access public
     *
     * @return View
     */
    public function updateBankData(Request $request)
    {
        $json = array();
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $services = $this->user_meta->storeBank($request,$request['id']);
            if ($services['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.cardsaved');
                return $json;
            } elseif ($services['type'] == "error") {
                $json['type'] = 'error';
                $json['message'] = $services['message'];
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * User listing
     *
     * @access public
     *
     * @return View
     */
    public function userListing()
    {
        $role_type = Helper::getRoleTypeByUserID(Auth::user()->id);
        if (Auth::user() && $role_type === 'admin') {
            if (!empty($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $users = $this->user::where('first_name', 'like', '%' . $keyword . '%')->orWhere('last_name', 'like', '%' . $keyword . '%')->paginate(7)->setPath('');
                $pagination = $users->appends(
                    array(
                        'keyword' => Input::get('keyword')
                    )
                );
            } else {
                $users = User::all();
            }
            if (file_exists(resource_path('views/extend/back-end/admin/users/index.blade.php'))) {
                return view('extend.back-end.admin.users.index', compact('users'));
            } else {
                return view('back-end.admin.users.index', compact('users'));
            }
        } else {
            abort(404);
        }
    }
    public function searchListingData(Request $request)
    {
        // dd('a',$request->all());
        $role=$request->type;
    if ($role === 'patient') {
                      $users = User::where('first_name','like','%'.$request->search.'%')
                         ->orWhere('last_name','like','%'.$request->search.'%')
                         ->orWhere('email','like','%'.$request->search.'%')
                         ->orWhere('phone_number','like','%'.$request->search.'%')
                         ->with('profile','userMeta')
                      ->with('specialities')
                      ->with('feedbacks')
                       ->with('services')->with('location','area')
                       ->with('diseases')->with('orderMeta')
                       ->with('appointments_patient')
                     ->limit(10)
                     ->role($role)->latest()
                       ->get();
                  
                 }
                 elseif ($role === 'hospital') {
                $users = User::where('first_name','like','%'.$request->search.'%')
                         ->orWhere('last_name','like','%'.$request->search.'%')
                         ->orWhere('email','like','%'.$request->search.'%')
                         ->orWhere('phone_number','like','%'.$request->search.'%')
                ->with('profile','userMeta')->with('specialities')->with('feedbacks')
                ->with('services')->with('location','area')
                ->with('diseases')->with('orderMeta')
                ->with('appointments')
                         ->with('teams')
                        ->limit(10)->role($role)->latest()
                       ->get();
                 }
                 elseif($role === 'doctor') {
                 $users = User::where('first_name','like','%'.$request->search.'%')
                         ->orWhere('last_name','like','%'.$request->search.'%')
                         ->orWhere('email','like','%'.$request->search.'%')
                         ->orWhere('phone_number','like','%'.$request->search.'%')
                         ->orWhere('slug','like','%'.$request->search.'%')
                 ->with('profile','userMeta')->with('specialities')
                 ->with('feedbacks','userMeta')
                    ->with('services')->with('location','area')
                    ->with('diseases')
                    ->with('orderMeta')->with('appointments')
                         ->with('doc_teams')->with('area')->limit(10)->role($role)->latest()
                       ->get();
                         // dd($users);
                 }
                  elseif($role === 'laboratory') {
                     $users = User::where('first_name','like','%'.$request->search.'%')
                         ->orWhere('last_name','like','%'.$request->search.'%')
                         ->orWhere('email','like','%'.$request->search.'%')
                         ->orWhere('phone_number','like','%'.$request->search.'%')
                     ->with('profile','userMeta')->with('specialities')->with('feedbacks')
                         ->with('services')->with('location','area')
                         ->with('diseases')->with('orderMeta')
                         ->with('appointments')
                         ->with('doc_teams')->with('area')
                         ->limit(10)->role($role)->latest()
                       ->get();
                 }
                 return response()->json($users);
               
    }
    public function roleListing(Request $request)
    {

         if($request->ajax()){
              $role=$request->type;
              if ($role === 'patient') {
                      $users = User::role($role)->latest()->with('userMeta','profile')
                      ->with('specialities')->with('feedbacks')
                     ->with('services')->with('location','area')->with('diseases')->with('orderMeta')->with('appointments_patient')->whereHas('profile')
                     ->skip(20*$request->clickCount)->take(40)
                     ->get();
                   // $users_counts = User::role('patient')->count();
                 }
                 elseif ($role === 'hospital') {
                     $users = User::role($role)->with('userMeta','userMeta','profile')
                     ->with('specialities')->with('feedbacks')
                    ->with('services')->with('location','area')
                    ->with('diseases')
                    ->with('orderMeta')->with('appointments')
                         ->with('teams')->whereHas('profile')->skip(20*$request->clickCount)->take(40)->latest()->get();
                         // dd($users);
                        // $users_counts = User::role('hospital')->count();
                 }
                 elseif($role === 'doctor') {
                     $users = User::role($role)->latest()->with('userMeta','profile')
                     ->with('specialities')->with('feedbacks')->with('services')
                     ->with('location','area')->with('diseases')
                     ->with('orderMeta')->with('appointments')
                         ->with('doc_teams')->with('area')->skip(20*$request->clickCount)->take(40)->get();
                       // dd($users);
                   // $users_counts = User::role('doctor')->count();
                 }
                  elseif($role === 'laboratory') {
                     $users = User::role($role)->latest()->with('userMeta','profile')->with('specialities')->with('feedbacks')
                        ->with('services')->with('location','area')
                        ->with('diseases')
                        ->with('orderMeta')->with('appointments')
                         ->with('doc_teams')->with('area')
                         ->skip(20*$request->clickCount)->take(40)->get();

                   // $users_counts = User::role('laboratory')->count();
                 }
                 $count =$request->clickCount+1;

                 return response()->json([$users,$count]);
             
         }
         $role = request()->segment(count(request()->segments()));
         if ($role === 'patient') {
             $users = User::role($role)->latest()->with('profile','userMeta')
                 ->with('specialities')->with('feedbacks')
                 ->with('services')->with('location','area')
                 ->with('diseases')
                 ->with('orderMeta')
                 ->with('appointments_patient')->take(40)
                 ->whereHas('profile')
                 ->get();
                 $users_counts = User::role('patient')->count( );
         }
         elseif ($role === 'hospital') {
             $users = User::role($role)->latest()->with('profile','userMeta')->with('specialities')
                    ->with('feedbacks')
                 ->with('services')->with('location','area')->with('diseases')
                 ->with('orderMeta')->with('appointments')
                 ->with('teams')->whereHas('profile')->take(40)->get();
                 // dd($users);
                $users_counts = User::role('hospital')->count();
         }
         elseif($role === 'doctor') {
            
             $users = User::role($role)->latest()->with('profile','userMeta')
             ->with('specialities')->with('feedbacks')
                 ->with('services')->with('location','area')->with('diseases')
                 ->with('orderMeta')->with('appointments')
                 ->with('doc_teams')->whereHas('profile')->take(40)->get();
                $users_counts = User::role('doctor')->count();
                // dd($users);
         }
          elseif($role === 'laboratory') {
             $users = User::role($role)->latest()->with('profile','userMeta')
             ->with('specialities')->with('feedbacks')
                 ->with('services')->with('location','area')
                 ->with('diseases')->with('orderMeta')->with('appointments')
                 ->with('doc_teams')->with('area')->take(40)->get();
                $users_counts = User::role('laboratory')->count();
         }
         $role_based_users = $users;
         $locations = Location::with('areas')->get();
         
         // $users_count = count($users_counts);
         // $extended = Helper::getExtended($users_counts);
         // $extendeds = count($extended);
         return view('back-end.admin.users.users', compact('role','role_based_users','users_counts', 'locations'));
    }
    
    /**
     * Delete User
     *
     * @param \Illuminate\Http\Request $request request attributes
     * 
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function cityFilter(Request $request){
        // dd($request->all());
        $role=$request->type;
        // dd($role);
        if($role == 'hospital'){
        $role_based_users = User::role('hospital')->latest()->where('location_id', $request->id)->with('profile','userMeta')->with('specialities')
                    ->with('feedbacks')
                 ->with('services')->with('location','area')->with('diseases')
                 ->with('orderMeta')->with('appointments')
                 ->with('teams')->with('doc_teams')->take(4)->get();
                 // dd($role_based_users);
                 $areas = Area::where('location_id', $request->id)->get();
                 return response()->json(
            [
                'type' => 'success',
                'role_based_users' => $role_based_users,
                'areas' => $areas,
            ]
        );
     }
     if($role == 'doctor'){
        $role_based_users = User::role('doctor')->latest()->where('location_id', $request->id)->with('profile','userMeta')->with('specialities')
                    ->with('feedbacks')
                 ->with('services')->with('location','area')->with('diseases')
                 ->with('orderMeta')->with('appointments')
                 ->with('teams')->with('doc_teams')->limit(4)->get();
                 // dd($role_based_users);
                 $areas = Area::where('location_id', $request->id)->get();
                 return response()->json(
            [
                'type' => 'success',
                'role_based_users' => $role_based_users,
                'areas' => $areas,
            ]
        );
     }
     if($role == 'laboratory'){
        $role_based_users = User::role('laboratory')->latest()->where('location_id', $request->id)->with('profile','userMeta')->with('specialities')
                    ->with('feedbacks')
                 ->with('services')->with('location','area')->with('diseases')
                 ->with('orderMeta')->with('appointments')
                 ->with('branches','labTest')->with('doc_teams')->limit(4)->get();
                 // dd($role_based_users);
                 $areas = Area::where('location_id', $request->id)->get();
                 return response()->json(
            [
                'type' => 'success',
                'role_based_users' => $role_based_users,
                'areas' => $areas,
            ]
        );
     }
    }
    public function dateFilter(Request $request){
        // dd($request->all());
        $role=$request->type;
        // dd($role);
     if($role == 'doctor'){
        $role_based_users = User::role('doctor')->latest()->where('created_at','>=', $request->startDate)->where('created_at','<=', $request->endDate)->with('profile','userMeta')->with('specialities')
                    ->with('feedbacks')
                 ->with('services')->with('location','area')->with('diseases')
                 ->with('orderMeta')->with('appointments')
                 ->with('teams')->with('doc_teams')->limit(4)->get();
                 // dd($role_based_users);
               
                 return response()->json(
            [
                'type' => 'success',
                'role_based_users' => $role_based_users,
            ]
        );
    }
    if($role == 'hospital'){
        $role_based_users = User::role('hospital')->latest()->where('created_at','>=', $request->startDate)->where('created_at','<=', $request->endDate)->with('profile','userMeta')->with('specialities')
                    ->with('feedbacks')
                 ->with('services')->with('location','area')->with('diseases')
                 ->with('orderMeta')->with('appointments')
                 ->with('teams')->with('doc_teams')->limit(4)->get();
                 // dd($role_based_users);
               
                 return response()->json(
            [
                'type' => 'success',
                'role_based_users' => $role_based_users,
            ]
        );
    }
    if($role == 'laboratory'){
        $role_based_users = User::role('laboratory')->latest()->where('created_at','>=', $request->startDate)->where('created_at','<=', $request->endDate)->with('profile','userMeta')->with('specialities')->with('feedbacks')->with('services')->with('location','area')->with('diseases')->with('branches','labTest')->with('orderMeta')->with('appointments')->with('teams')->with('doc_teams')->limit(4)->get();
                 // dd($role_based_users);
               
                 return response()->json(
            [
                'type' => 'success',
                'role_based_users' => $role_based_users,
            ]
        );
    }
    }
    public function changeUserStatus(Request $request)
    {
        // dd(1);
        $role=$request->type;
        $value=$request->selected;
        $id=$request->id;
        if($value==='register')
        {
          $user=User::where('id',$id)->first();
          $user->status='register';
          $user->update();
        }
        else if($value==='pending')
        {
           $user=User::where('id',$id)->first();
           $user->status='pending';
           $user->update();
        }
        else if($value==='block')
        {
            $user=User::where('id',$id)->first();
            $user->status='block';
            $user->update();
        }
        else
        {
            $user=User::where('id',$id)->first();
            $user->status='register';
            $user->update();
        }
         if($role === 'doctor'){
        $role_based_users =User::role($role)->latest()->with('profile','userMeta')
             ->with('specialities')->with('feedbacks')
                 ->with('services')->with('location','area')->with('diseases')
                 ->with('orderMeta')->with('appointments')
                 ->with('doc_teams')->whereHas('profile')->take(40)->get();
                 // dd($role_based_users);
                 return response()->json(
            [
                'type' => 'success',
                'role_based_users' => $role_based_users,
            ]
        );
     }
     else if($role === 'hospital'){
        $role_based_users =User::role('hospital')->latest()->with('profile','userMeta')->with('specialities')
                    ->with('feedbacks')
                 ->with('services')->with('location','area')->with('diseases')
                 ->with('orderMeta')->with('appointments')
                 ->with('teams')->take(40)->get();
                 // dd($role_based_users);
                 return response()->json(
            [
                'type' => 'success',
                'role_based_users' => $role_based_users,
            ]
        );
     }
     else if($role === 'laboratory'){
        $users = User::role('laboratory')->latest()->with('profile','userMeta')
             ->with('specialities')->with('feedbacks')
                 ->with('services')->with('location','area')
                 ->with('diseases')->with('orderMeta')->with('appointments')
                 ->with('doc_teams')->with('area')->take(40)->get();
                 // dd($role_based_users);
                 return response()->json(
            [
                'type' => 'success',
                'role_based_users' => $role_based_users,
            ]
        );
     }
     else if($role === 'all-blocked-doctors')
     {
        $users= User::role('doctor')->where('status','=','block')->select('id','first_name','last_name','email','phone_number','assistant_phone_number','slug','location_id','area_id','status','recommend_status','created_at','updated_at')->with('specialities')->with('location','area')->latest()->limit(40)->get(); 
        return response()->json($users);
     } 
     else if($role === 'all-doctors')
     {
        $users = User::role('doctor')->where('phone_number','!=',null)->where('status','=','register')->orwhere('status','=','1')->select('id','first_name','last_name','email','phone_number','slug','status','location_id','area_id','created_at','updated_at')->with('profile')->with('specialities')->with('location')->with('area')->with('doc_teams')->latest()->limit(40)->get();
        return response()->json($users);
     } 
     else if($role === 'all-onboard-doctors')
     {
        $users = User::role('doctor')->where('on_board','=','on-board')->where('phone_number','!=',null)->where('status','=','register')->orWhere('status','=','1')->select('id','first_name','last_name','email','phone_number','slug','location_id','area_id','status','recommend_status','created_at','updated_at')->with('profile')->with('userMeta',function ($q){
                return $q->select('user_id','avatar','commission');
            })->with('specialities')->with('location','area')->limit(40)->latest()->get();
        
        return response()->json($users);

     }
     
       
    }
    public function changeRecomendStatus(Request $request)
    {
         $role=$request->type;
        $value=$request->selected;
        $id=$request->id;
        if($value==='recommend')
        {
          $user=User::where('id',$id)->first();
          $user->recommend_status='recommend';
          $user->update();
        }
        else
        {
           $user=User::where('id',$id)->first();
           $user->recommend_status='unrecommend';
           $user->update();
        }
         if($role === 'doctor'){
        $role_based_users =User::role($role)->latest()->with('profile','userMeta')
             ->with('specialities')->with('feedbacks')
                 ->with('services')->with('location','area')->with('diseases')
                 ->with('orderMeta')->with('appointments')
                 ->with('doc_teams')->whereHas('profile')->take(40)->get();
                 // dd($role_based_users);
                 return response()->json(
            [
                'type' => 'success',
                'role_based_users' => $role_based_users,
            ]
        );
     }
     else if($role === 'hospital'){
        $role_based_users =User::role('hospital')->latest()->with('profile','userMeta')->with('specialities')
                    ->with('feedbacks')
                 ->with('services')->with('location','area')->with('diseases')
                 ->with('orderMeta')->with('appointments')
                 ->with('teams')->take(40)->get();
                 // dd($role_based_users);
                 return response()->json(
            [
                'type' => 'success',
                'role_based_users' => $role_based_users,
            ]
        );
     }
     else if($role === 'laboratory'){
        $users = User::role('laboratory')->latest()->with('profile','userMeta')
             ->with('specialities')->with('feedbacks')
                 ->with('services')->with('location','area')
                 ->with('diseases')->with('orderMeta')->with('appointments')
                 ->with('doc_teams')->with('area')->take(40)->get();
                 // dd($role_based_users);
                 return response()->json(
            [
                'type' => 'success',
                'role_based_users' => $role_based_users,
            ]
        );
     }
    }
    public function areaFilter(Request $request){
        // dd($request->all());
        $role=$request->type;
        $area_id = $request->id;
        $city_id = Area::where('id',$area_id)->pluck('location_id');
        // dd($city_id);
     if($role == 'doctor'){
        $role_based_users = User::role('doctor')->where('location_id',$city_id)->latest()->with('profile','userMeta')->with('specialities')
                    ->with('feedbacks')
                 ->with('services')->with('location','area','doctorArea')->with('diseases')
                 ->with('orderMeta')->with('appointments')
                 ->with('teams')->with('doc_teams')->whereHas('doctorArea', function ($query)  use ($area_id) {
    return $query->where('area_id', $area_id);
})->limit(4)->get();
                 // dd($role_based_users);
               
                 return response()->json(
            [
                'type' => 'success',
                'role_based_users' => $role_based_users,
            ]
        );
    }
    if($role == 'hospital'){
        $role_based_users = User::role('hospital')->latest()->where('area_id', $request->id)->with('profile','userMeta')->with('specialities')
                    ->with('feedbacks')
                 ->with('services')->with('location','area')->with('diseases')
                 ->with('orderMeta')->with('appointments')
                 ->with('teams')->with('doc_teams')->limit(4)->get();
                 // dd($role_based_users);
               
                 return response()->json(
            [
                'type' => 'success',
                'role_based_users' => $role_based_users,
            ]
        );
    }
    if($role == 'laboratory'){
        $role_based_users = User::role('laboratory')->latest()->where('area_id', $request->id)->with('profile','userMeta')->with('specialities')->with('feedbacks')->with('services')->with('location','area')->with('diseases')->with('branches','labTest')->with('orderMeta')->with('appointments')->with('teams')->with('doc_teams')->limit(4)->get();
                 // dd($role_based_users);
               
                 return response()->json(
            [
                'type' => 'success',
                'role_based_users' => $role_based_users,
            ]
        );
    }
    }
    public function deleteUser(Request $request)
    {  
        $user = $this->user::findOrFail($request['id']);
        $user->profile()->delete();
        $user->roles()->detach();
        DB::table('appointments')->where('user_id', $request['id'])
            ->orWhere('hospital_id', $request['id'])->orWhere('patient_id', $request['id'])->delete();
        if ($user->articles->count() > 0) {
            foreach ($user->articles as $user_article) {
                $article = Article::find($user_article->id);
                if ($article->categories->count() > 0) {
                    $article->categories()->detach();
                }
            }
            $user->articles()->delete();
        }
        DB::table('feedbacks')->where('user_id', $request['id'])
            ->orWhere('patient_id', $request['id'])->delete();
        if ($user->question->count() > 0) {
            foreach ($user->question as $form) {
                DB::table('forums')->where('id', $form->id)->delete();
                DB::table('user_forum')->where('forum_id', $form->id)->delete();
            }
        }
        DB::table('user_forum')->where('user_id', $request['id'])->where('type', 'answer')->delete();
        DB::table('messages')->where('user_id', $request['id'])
            ->orWhere('receiver_id', $request['id'])->delete();
        if ($user->orders->count() > 0) {
            foreach ($user->orders as $user_orders) {
                DB::table('order_metas')->where('metable_id', $user_orders->id)->delete();
            }
            $user->orders()->delete();
        }
        DB::table('payouts')->where('user_id', $request['id'])->delete();
        DB::table('teams')->where('user_id', $request['id'])
            ->orWhere('doctor_id', $request['id'])->delete();
        $user->services()->detach();
        $user->delete();
        return response()->json(
            [
                'type' => 'success',
                'message' => trans('lang.success')
            ]
        );
    }

    /**
     * Edit user profile
     *
     * @param intger $id user id
     * 
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function editUser($id)
    {
        if (!empty($id)) {
             if(Session::has('user_admin_id'))
               {
                  Session::forget('user_admin_id');
               }
            session()->push('user_admin_id', $id);            
            $user = User::where('id', $id)->with('diseases')->with('specialities')->with('location')->with('services')->with('appointments')->with('roles')->first();
            $user_role = Helper::getRoleTypeByUserID($id);
            $roles = Role::all()->toArray();
            $user_meta = $user->profile;

            $diseases = Disease::select('id', 'title', 'slug')->get();
            $diseases_tags = $user->diseases()->get();

            $gender_title = !empty($user_meta->gender_title) ? $user_meta->gender_title : '';
            $gender = !empty($user_meta->gender) ? $user_meta->gender : '';

            $willing_home_visit = !empty($user_meta->willing_home_visit) ? $user_meta->willing_home_visit : '';
            $willing_video = !empty($user_meta->willing_video) ? $user_meta->willing_video : '';
            $sub_heading = !empty($user_meta->sub_heading) ? $user_meta->sub_heading : '';

            $extend = !empty($user_meta->extend) ? $user_meta->extend : '';
            $mark_red = !empty($user_meta->mark_red) ? $user_meta->mark_red : '';
            $mark_incomplete = !empty($user_meta->mark_incomplete) ? $user_meta->mark_incomplete : '';
            $short_desc = !empty($user_meta->short_desc) ? $user_meta->short_desc : '';
            $meta_description = !empty($user_meta->meta_description) ? $user_meta->meta_description : '';
            $meta_title = !empty($user_meta->meta_title) ? $user_meta->meta_title : '';
            $meta_intro = !empty($user_meta->meta_intro) ? $user_meta->meta_intro : '';
            $online_test_report_title = !empty($user_meta->online_test_report_title) ? $user_meta->online_test_report_title : '';
            $online_test_report_desc = !empty($user_meta->online_test_report_desc) ? $user_meta->online_test_report_desc : '';
            $meta_keywords = !empty($user_meta->meta_keywords) ? $user_meta->meta_keywords : '';
             $description = !empty($user_meta->description) ? $user_meta->description : '';
            $available_days = !empty($user_meta->available_days) ? json_decode($user_meta->available_days, true) : array();
            $leave = !empty($user_meta->leave) ? json_decode($user_meta->leave, true) : array();
            $starting_price = !empty($user_meta->starting_price) ? $user_meta->starting_price : '';
            $memberships = !empty($user_meta->memberships) ? json_decode($user_meta->memberships, true) : array();
            $faqs = !empty($user_meta->faqs) ? json_decode($user_meta->faqs, true) : array();
            $registration = !empty($user_meta->verify_medical) ? json_decode($user_meta->verify_medical, true) : array();
            $registration_number = !empty($registration) ? $registration['registration_number'] : '';
            $registration_document = !empty($registration) && $registration['registration_document'] ? $registration['registration_document'] : '';
            $downloads = !empty($user_meta->downloads) ? json_decode($user_meta->downloads, true) : '';
            $locations = Location::pluck('title', 'id');
            $allLocations = Location::all();
            $address = !empty($user_meta->address) ? $user_meta->address : '';
            $longitude = !empty($user_meta->longitude) ? $user_meta->longitude : '';
            $latitude = !empty($user_meta->latitude) ? $user_meta->latitude : '';
            
            $add_longitude = !empty($user_meta->add_longitude) ? $user_meta->add_longitude : '';
            $add_latitude = !empty($user_meta->add_latitude) ? $user_meta->add_latitude : '';
            
            $bank_data = !empty($user_meta->bank_data) ? json_decode($user_meta->bank_data) : array();

            $avatar = !empty($user_meta->avatar) ? $user_meta->avatar : '';
            $banner = !empty($user_meta->banner) ? $user_meta->banner : '';
            $galleries = !empty($user_meta->gallery) ? json_decode($user_meta->gallery, true) : '';
            $gallery_videos = !empty($user_meta->gallery_videos) ? json_decode($user_meta->gallery_videos, true) : '';

            $commission = !empty($user_meta->commission) ? $user_meta->commission : '';
            $total_experience = !empty($user_meta->total_experience) ? $user_meta->total_experience : '';
            $wait_time = !empty($user_meta->wait_time) ? $user_meta->wait_time : '';
            $fees_range = !empty($user_meta->fees_range) ? json_decode($user_meta->fees_range, true) : '';
            $from_fees = !empty($fees_range['from_fees']) ? $fees_range['from_fees'] : '';
            $to_fees = !empty($fees_range['to_fees']) ? $fees_range['to_fees'] : '';
            $working_time = !empty($user_meta->working_time) ? $user_meta->working_time : '';
            $language = [];
            if ($user_role =='doctor') {
                $language = !empty($user_meta->language) ? json_decode($user_meta->language, true) : array();
            }
            $hospital_services_data = !empty($user_meta->hospital_services) ? json_decode($user_meta->hospital_services) : '';
            $hospital_icu = !empty($hospital_services_data->hospital_icu) ? $hospital_services_data->hospital_icu: '';
            $hospital_emergency = !empty($hospital_services_data->hospital_emergency) ? $hospital_services_data->hospital_emergency : '';
            $hospital_ventilator = !empty($hospital_services_data->hospital_ventilator) ? $hospital_services_data->hospital_ventilator : '';
            $hospital_24_service = !empty($hospital_services_data->hospital_24_service) ? $hospital_services_data->hospital_24_service : '';
            $ambulance = !empty($hospital_services_data->ambulance) ? $hospital_services_data->ambulance : '';
            $waiting_lounge = !empty($hospital_services_data->waiting_lounge) ? $hospital_services_data->waiting_lounge : '';
            $laboratory = !empty($hospital_services_data->laboratory) ? $hospital_services_data->laboratory : '';
            $pharmacy = !empty($hospital_services_data->pharmacy) ? $hospital_services_data->pharmacy : '';
            $blood_bank = !empty($hospital_services_data->blood_bank) ? $hospital_services_data->blood_bank : '';
            $atm = !empty($hospital_services_data->atm) ? $hospital_services_data->atm : '';
            $car_parking = !empty($hospital_services_data->car_parking) ? $hospital_services_data->car_parking : '';
            $cafeteria = !empty($hospital_services_data->cafeteria) ? $hospital_services_data->cafeteria : '';
            $doctor_specialities = !empty($user->profile->services) ? json_decode($user->profile->services, true) : array();
            $intervals = Helper::getAppointmentIntervals();
            $durations = Helper::getAppointmentDuration();
            $spaces = Helper::getAppointmentSpaces();
            $days = Helper::getAppointmentDays();
            $areas = Area::all();
            $doctor_info = Team::where('doctor_id', $user->id)->with('hospital')->paginate(10);
            if (file_exists(resource_path('views/extend/back-end/admin/users/edit/index.blade.php'))) {
                return View(
                    'extend.back-end.admin.users.edit/doctor/index',
                    compact(
                        'id',
                        'user',
                        'doctor_specialities',
                        'intervals',
                        'durations',
                        'spaces',
                        'days',
                        'doctor_info',
                        'roles',
                        'gallery_videos',
                        'galleries',
                        'working_time',
                        'available_days',
                        'language',
                        'gender_title',
                        'sub_heading',
                        'short_desc',
                        'description',
                        'meta_description',
                        'meta_title',
                        'meta_intro',
                        'meta_keywords',
                        'online_test_report_title',
                        'online_test_report_desc',
                        'starting_price',
                        'memberships',
                        'avatar',
                        'banner',
                        'registration_number',
                        'registration_document',
                        'downloads',
                        'user_role',
                        'address',
                        'longitude',
                        'latitude',
                        'locations',
                        'allLocations',
                        'gender',
                        'willing_video',
                        'willing_home_visit',
                        'extend',
                        'mark_red',
                        'mark_incomplete',
                        'leave',
                        'commission',
                        'wait_time',
                        'total_experience',
                        'from_fees',
                        'to_fees',
                        'faqs',
                        'hospital_icu',
                        'hospital_emergency',
                        'hospital_ventilator',
                        'hospital_24_service',
                        'ambulance',
                        'waiting_lounge',
                        'laboratory',
                        'pharmacy',
                        'blood_bank',
                        'atm',
                        'car_parking',
                        'cafeteria',
                        'diseases',
                        'diseases_tags',
                        'add_longitude',
                        'add_latitude',
                        'bank_data',
                        'areas'
                    )
                );
            } else {
                return view(
                    'back-end.admin.users.edit/index',
                    compact(
                        'id',
                        'user',
                        'doctor_specialities',
                        'intervals',
                        'durations',
                        'spaces',
                        'days',
                        'doctor_info',
                        'gallery_videos',
                        'galleries',
                        'working_time',
                        'available_days',
                        'language',
                        'gender_title',
                        'sub_heading',
                        'short_desc',
                        'description',
                        'meta_description',
                        'meta_title',
                        'meta_intro',
                        'online_test_report_title',
                        'online_test_report_desc',
                        'meta_keywords',
                        'starting_price',
                        'memberships',
                        'avatar',
                        'banner',
                        'registration_number',
                        'registration_document',
                        'downloads',
                        'user_role',
                        'address',
                        'longitude',
                        'latitude',
                        'locations',
                        'allLocations',
                        'gender',
                        'willing_video',
                        'willing_home_visit',
                        'extend',
                        'mark_red',
                        'mark_incomplete',
                        'leave',
                        'commission',
                        'wait_time',
                        'total_experience',
                        'from_fees',
                        'to_fees',
                        'faqs',
                        'diseases',
                        'diseases_tags',
                        'hospital_icu',
                        'hospital_emergency',
                        'hospital_ventilator',
                        'hospital_24_service',
                        'ambulance',
                        'waiting_lounge',
                        'laboratory',
                        'pharmacy',
                        'blood_bank',
                        'atm',
                        'car_parking',
                        'cafeteria',
                        'add_longitude',
                        'add_latitude',
                        'bank_data',
                        'areas'
                    )
                );
            }
        }
    }

    /**
     * Update user profile settings.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteDrAppointmentLocation ($id){
        $team = Team::where('id', $id)->delete();
        return redirect()->back()->withSuccess('Appointment Location Deleted Successfully');
        // dd($team);
    }
    public function updateUserProfileSettings(Request $request)
    {
        /*$request->validate([
            // 'from_fees' => 'integer|min:0',
            // 'to_fees' => 'integer|min:0',
        ]);*/

        $diseases = [];
        if(!empty($request->diseases)){
            $diseases = explode( ',',$request->diseases);
        }

        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        $user = User::find($request['id']);
        $old_email = '';
        if ($request['email'] != $user->email) {
            $old_email = $user->email;
            $this->validate(
                $request,
                [
                    'email' => 'unique:users|email',
                ]
            );
        }
        $this->validate(
            $request,
            [
                'role' => 'required',
            ]
        );
        if (!empty($request['id'])) {
            $user_update = $this->user->updateUser($request, $request['id']);
            if (!empty($diseases)){
                $user = User::where('id', $request->id)->first();
                $user->diseases()->detach();
                foreach ($diseases as $disease){
                    $user->diseases()->attach($disease);
                }
            }
           
            if ($user_update['type'] == 'success') {
                //$user->profile()->delete();
                $this->user_meta->storeProfile($request, $request['id']);
                
                if ($user->articles->count() > 0) {
                    foreach ($user->articles as $user_article) {
                        $article = Article::find($user_article->id);
                        $article->author_id = 1;
                        $article->save();
                    }
                }
                if ($user->question->count() > 0) {
                    foreach ($user->question as $form) {
                        DB::table('forums')->where('id', $form->id)->delete();
                        DB::table('user_forum')->where('forum_id', $form->id)->delete();
                    }
                }
                
                if (!empty($old_email)) {
                    if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                        $email_params = array();
                        $template_data = Helper::getUserUpdateEmailByAdminContent();
                        $email_params['name'] = Helper::getUserName($request['id']);
                        $email_params['email'] = $request['email'];
                        
                        try {
                            Mail::to($user->email)
                                ->send(
                                    new GeneralEmailMailable(
                                        'email_change_by_admin',
                                        $template_data,
                                        $email_params
                                    )
                                );
                        } catch (\Exception $e) {
                            $json['type'] = 'error';
                            $json['message'] = trans('lang.something_went_wrong');
                            return $json;
                            // Session::flash('error', trans('lang.ph_email_warning'));
                            // return Redirect::back();
                        }
                    }
                }
                if (!empty($request['password'])) {
                    $updated_user = User::find($request['id']);
                    if (!empty(config('mail.username')) && !empty(config('mail.password'))) {
                        $email_params = array();
                        $template_data = Helper::getUserUpdatePasswordByAdminContent();
                        $email_params['name'] = Helper::getUserName($request['id']);
                        $email_params['password'] = $request['password'];
                        try {
                            Mail::to($updated_user->email)
                                ->send(
                                    new GeneralEmailMailable(
                                        'password_change_by_admin',
                                        $template_data,
                                        $email_params
                                    )
                                );
                        } catch (\Exception $e) {
                            $json['type'] = 'error';
                            $json['message'] = trans('lang.something_went_wrong');
                            return $json;
                        }
                    }
                }
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.personal_details_saved');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }

    /**
     * Edit user profile
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {
        $seleted_role = $request->role;
        $roles = Role::all()->toArray();
        $days = Helper::getAppointmentDays();
        $locations = Location::pluck('title','id');
        if (file_exists(resource_path('views/extend/back-end/admin/users/create/index.blade.php'))) {
            return View(
                'extend.back-end.admin.users.create/index',
                compact(
                    'roles',
                    'seleted_role'
                )
            );
        } else {
            return view(
                'back-end.admin.users.create/index',
                compact(
                    'roles',
                    'seleted_role',
                    'days',
                    'locations'
                )
            );
        }
    }

    /**
     * Update user profile settings.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $this->validate(
            $request,
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6',
                'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users|min:10',
                'assistant_phone_number' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users|min:10',
                'role' => 'required',
            ]
        );
        $json = array();
        if (!empty($request)) {
            $user_id = $this->user->storeUser($request);
            // if ($request['role'] == 'doctor') {
            //     $order = new Order();
            //     $order->status = 'pending';
            //     $order->payment_gateway = 'paypal';
            //     $order->user()->associate($user_id);
            //     $order->save();
            //     $order_id = DB::getPdo()->lastInsertId();
            //     $latest_order = Order::find($order_id);
            //     $order_type = new OrderMeta();
            //     $order_type->meta_key = 'type';
            //     $order_type->meta_value = 'package';
            //     $latest_order->orderMeta()->save($order_type);
            //     $package_data = array();
            //     $package = Package::where('trial', 1)->first()->toArray();
            //     if (!empty($package)) {
            //         $option = !empty($package['options']) ? json_decode($package['options'], true) : '';
            //         foreach ($package as $package_key => $package_value) {
            //             $package_data[$package_key] = $package_value;
            //         }
            //         $package_meta = new OrderMeta();
            //         $package_meta->meta_key = 'package';
            //         $package_meta->meta_value = json_encode($package_data);
            //         $latest_order->orderMeta()->save($package_meta);
            //         $expiry = !empty($order) ? $order->created_at->addDays($option['duration']) : '';
            //         $expiry_date = !empty($expiry) ? Carbon::parse($expiry)->toDateTimeString() : '';
            //         $user = User::find($user_id);
            //         $user->package_expiry = $expiry_date;
            //         $user->save();
            //     }
            // }
            $json['type'] = 'success';
            $json['progressing'] = trans('lang.saving');
            $json['message'] = trans('lang.user_created');
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.not_authorize');
            return $json;
        }
    }
    public function getAllDoctors(){
        $json = array();
        $doctors = User::role('doctor')->with('profile')->with('specialities')->with('feedbacks')->with('services')->with('location')->with('diseases')->with('orderMeta')->latest()->get();
        $hospitals = User::role('hospital')->latest()->with('profile')->with('specialities')->with('feedbacks')->with('services')->with('location')->with('diseases')->get();
        if (!empty($doctors) && !empty($hospitals)){
            $json['doctors'] = $doctors;
            $json['hospitals'] = $hospitals;
            $json['type'] = 'success';
            return $json;
        }
        else{
            $json['error'] = 'error';
            return $json;
        }
    }
    public function getCurrentUsersSaved(){
//        $id = Auth::user()->id;
        if (!empty(Auth::user())){
            $user = $this->user::find(Auth::user()->id);
            $saved_doctors   = !empty($user->profile->saved_doctors) ? json_decode($user->profile->saved_doctors) : array();
            $saved_hospitals = !empty($user->profile->saved_hospitals) ? json_decode($user->profile->saved_hospitals) : array();
            $json = array();
            if (!empty($user)){
                $json['saved_doctors'] = json_encode($saved_doctors);
                $json['saved_hospitals'] = json_encode($saved_hospitals);
                $json['type'] = 'success';
                return $json;
            }
            else{
                $json['error'] = 'error';
                return $json;
            }
        }
        else{
            $json['saved_doctors'] = [];
            $json['saved_hospitals'] = [];
            $json['error'] = 'Please Login First';
            return $json;
        }
    }
    public function quickReg (Request $request) {

        $json = array();
        $verification_code = rand(100000, 999999);

        if (!empty($request)) {
            if ($request['phone_number']) {

                if (substr( $request['phone_number'], 0, 2 ) === "92") {
                    $user = User::where('phone_number', $request['phone_number'])->first();
                }
                elseif (substr( $request['phone_number'], 0, 2 ) === "03") {
                    $request['phone_number'] = '92'.(int)$request['phone_number'];
                }
                elseif (strlen($request['phone_number']) < 11) {
                    $request['phone_number'] = '92'.$request['phone_number'];
                    $user = User::where('phone_number', $request['phone_number'])->first();
                }
                else {
                    $user = User::where('phone_number', $request['phone_number'])->first();
                }
            }
            $user = User::where('phone_number', $request['phone_number'])->first();

            if ($user == null) {
                if (!$request['first_name']) {
                    $request['first_name'] = 'Guest';
                    $request['last_name'] = 'User';
                }
                else {
                    if (preg_match('/\s/',$request['first_name'])) {
                        list($firstname, $lastname) = explode(' ', $request['first_name'], 2);
                        $request['first_name'] = $firstname;
                        $request['last_name'] = $lastname;
                    }
                    else {
                        $request['last_name'] = 'User';
                    }
                }
                $user = User::create([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'verification_code' => $verification_code,
                    'slug' => filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' . filter_var($request['last_name'], FILTER_SANITIZE_STRING),
                    'password' => password_hash('doctorfindy.com', PASSWORD_DEFAULT),
                    'phone_number' => $request['phone_number'],
                ]);
            }
            $user_data = $user;
            $user->update(['verification_code' => $verification_code]);
            auth()->login($user);
            $role = DB::table('roles')->select('name')->where('role_type', 'patient')->first();
            $user->assignRole($role->name);
            Helper::sendSms($verification_code,$request['phone_number']);
            $json['result'] = $user;
            $json['user_data'] = $user_data;
            $json['type'] = 'success';
        }
        else {
            $json['type'] = 'error';
        }
        return $json;
    }

    public function phoneNumVer(Request $request) {
        $json = array();
        if (!empty($request['id'])) {
            User::where('id', $request['id'])->update(['user_verified' => true]);
            $teams = Team::where('doctor_id', $request['id'])->where('status', 'approved')->paginate(4);
            $json['type'] = 'success';
            $json['type'] = 'success';
        }
        else {
            $json['type'] = 'error';
        }

        return $json;
    }
    public function doctorsInCity(Request $request) {
        $location = Location::where('slug', $request->slug)->first();
        $areas = Location::where('parent', $location->id)->get();
        $specialities = Speciality::with('locations')->get();
        $doctors = User::role('doctor')->latest()->with('profile')->with('specialities')->with('feedbacks')->with('services')->with('location')->with('diseases')->with('orderMeta')->get();
        return view('front-end.doctors.index', compact('location', 'doctors', 'specialities','areas'));
    }
    public function hospitalsInCity (Request $request) {
        $location = Location::where('slug', $request->slug)->first();
        $areas = Location::where('parent', $location->id)->get();
        $specialities = Speciality::with('locations')->get();
        $hospitals = User::role('hospital')->latest()->with('profile')->with('specialities')->with('feedbacks')->with('services')->with('location')->with('diseases')->with('orderMeta')->get();
        return view('front-end.hospitals.index', compact('location', 'hospitals', 'specialities','areas'));
    }

    public function checkLogin () {
        $json = array();
        if (Auth::user()) {
            $role = Helper::getRoleTypeByUserID(Auth::id());
            $user = Auth::user();
            $user = User::where('id', $user->id)->with('diseases')->with('specialities')->with('location')->with('services')->with('profile')->with('location')->with('feedbacks')->with('doc_teams')->with('teams')->with('appointments')->with('roles')->first();;
            $json['role'] = $role;
            $json['user_details'] = $user;
            $json['type'] = 'success';
        }
        else {
            $json['type'] = 'error';
            $json['message'] = 'Please Login First.';
        }
        return $json;
    }

     public function datashow($affairDetail)
    {
        $affairDetail = AffairDetail::find($affairDetail);
        //dd($affairDetail);
         return view('front-end.pages.affairs',compact('affairDetail'));
    }


      public function getinvoice()
    {
         $allinvoice = User::all();
       //  dd($allinvoice);

         return view('back-end.admin.payment.invoices',compact('allinvoice'));
    }
    public function searchDoctorsForAppointment(Request $request){
        $speciality_id = $request->speciality_id ?? null;
        // dd($speciality_id);
        $hospital_id = $request->hospital_id ?? null;
      if($speciality_id == null && $hospital_id == null){
        // dd('hehe');
        $doctors = User::where('first_name', 'LIKE','%'.$request->keyword.'%')->orWhere('last_name', 'LIKE','%'.$request->keyword.'%')->role('doctor')->with('diseases')->with('specialities')->with('profile')->with('services')->with('location')->with('feedbacks')->with('doc_teams')->with('teams')->with('appointments')->with('roles')->limit(5)->get();
        return response()->json($doctors);
    }
    if($speciality_id != null && $hospital_id == null){
        // dd('haha');
        $doctors = User::where('first_name', 'LIKE','%'.$request->keyword.'%')->orWhere('last_name', 'LIKE','%'.$request->keyword.'%')->role('doctor')->with('diseases')->with('specialities')->with('profile')->with('services')->with('location')->with('feedbacks')->with('doc_teams')->with('teams')->with('appointments')->with('roles')->whereHas('specialities', function ($q) use ($speciality_id){
    return $q->where('speciality_id', $speciality_id);
})->limit(5)->get();
        return response()->json($doctors);
    }
    if($speciality_id == null && $hospital_id != null){
        // dd('haha');
        $doctors = User::where('first_name', 'LIKE','%'.$request->keyword.'%')->orWhere('last_name', 'LIKE','%'.$request->keyword.'%')->role('doctor')->with('diseases')->with('specialities')->with('profile')->with('services')->with('location')->with('feedbacks')->with('doc_teams')->with('teams')->with('appointments')->with('roles')->whereHas('doc_teams', function ($q) use ($hospital_id){
    return $q->where('user_id', $hospital_id);
})->whereHas('specialities', function ($qu) use ($speciality_id){
    return $qu->where('speciality_id', $speciality_id);
})->limit(5)->get();
// dd($doctors);
        return response()->json($doctors);
    }
    if($speciality_id != null && $hospital_id != null){
        // dd('haha');
        $doctors = User::where('first_name', 'LIKE','%'.$request->keyword.'%')->orWhere('last_name', 'LIKE','%'.$request->keyword.'%')->role('doctor')->with('diseases')->with('specialities')->with('profile')->with('services')->with('location')->with('feedbacks')->with('doc_teams')->with('teams')->with('appointments')->with('roles')->whereHas('doc_teams', function ($q) use ($hospital_id){
    return $q->where('user_id', $hospital_id);
})->limit(5)->get();
// dd($doctors);
        return response()->json($doctors);
    }
    }
    public function appointmentBookingSystem () {
        // dd('haha');
        $doctors = User::role('doctor')->with('diseases')->with('specialities')->with('profile')->with('services')->with('location')->with('feedbacks')->with('doc_teams')->with('teams')->with('appointments')->with('roles')->limit(10)->get();
        $hospitals = User::role('hospital')->latest()->with('diseases')->with('specialities')->with('location')->with('services')->with('profile')->with('area')->with('feedbacks')->with('doc_teams')->with('teams')->with('appointments')->with('roles')->get();
        // dd($hospitals);

        $specialities = Speciality::whereHas('users')->get();
        $diseases = Disease::all();
        $locations = Location::all();
        return view('back-end.admin.appointment-booking-system.index', compact('doctors', 'hospitals', 'specialities', 'diseases', 'locations'));
    }

    public function approve(Request $request){
        $json = array();
        $id = $request['id'];
        $all_data = Appointment::where('id',$id)->first();
        if($all_data->status =='accepted'){
            $status = Appointment::where('id',$id)->update(array('status'=>'pending'));
        }
        else{
            $status = Appointment::where('id',$id)->update(array('status'=>'accepted'));
        }
        
        $json['message'] = 'Status Change Successfully';  
        $json['type'] = 'success';
       return $json;


    }
    public function all_reports()
    {
        $reports =   DB::table('reports')->orderBy("id","desc")->get();
         return view('back-end.admin.feedback.all_reports', compact('reports'));
    }
    public function delete_report(Request $request)
     {

        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $id = $request['id'];
        
        if (!empty($id)) {
          DB::table('reports')->where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'Report Deleted Successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }
    public function forLaboratory() {
        $user_ = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];
         $doctors = User::role('doctor')->latest()->with('profile','specialities','location')->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->latest()->orderBy("trending","desc")->with('profile','location','area')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->latest()->orderBy("trending","desc")->with('profile','location','area','feedbacks')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->limit(4)->get();
        /*Locations*/
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        return view('front-end.for-laboratory.index',
            compact(
                'specialities', 'logged_user', 'laboratories', 'cities', 'services', 'diseases',
                'specialities', 'hospitals', 'doctors', 'managements','segments'
            )
        );
    }
    public function getallLaboratories()
    {
        $users = User::role('laboratory')->orderBy("trending","desc")->with('location','area')->with('profile',function ($query){
                  return $query->select('user_id','avatar','banner','online_report_url');
             })->get(); 
        return response()->json($users);
    }
    public function labsGivingOnlineReport(Request $request)
    {
          $users = User::role('laboratory')->orderBy("trending","desc")->with('location','area')->with('profile',function ($query){
                  return $query->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc','online_report_url');
             })->limit(10)->get();   
         $doctors = [];
            /*Hospital*/
             $hospitals = User::role('hospital')->orderBy("trending","desc")->with('location','area')->with('profile',function ($query){
                  return $query->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
             })->limit(6)->get();
             // dd($hospitals);
            /*Laboratory*/
            $laboratories = User::role('laboratory')->orderBy("trending","desc")->with('location','area')->with('profile',function ($query){
                  return $query->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
             })->limit(6)->get();
            /*Specialities*/
            $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
            /*Diseases*/
            $diseases = Disease::select('id','title', 'slug','flag','speciality_id')->limit(4)->get();
            /*Services*/
            $services = Service::select('id','title', 'slug','image','speciality_id')->limit(4)->get();
            /*Locations*/
            // $locations = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();
            $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
            $locations=$cities->take(6);
            $cities_pakistan = Location::inRandomOrder()->limit(8)->get();
            $symptoms = [];
            $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec'];
            $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
            $segments = [];
            $user = User::where('id', Auth::id() ? Auth::id() : '')->with('roles')->with('profile',function ($query){
                  return $query->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
             })->first();
            $logged_user = $user ? $user : [];
            $userfeedback = [];

            return view(
                    'front-end.laboratory.labsOnlineReports',
                    compact(
                        'user',
                        'users',
                        'doctors',
                        'hospitals',
                        'laboratories',
                        'specialities',
                        'diseases',
                        'services',
                        'locations',
                        'cities',
                        'cities_pakistan',
                        'symptoms',
                        'meta_values',
                        'managements',
                        'userfeedback',
                        'segments',
                        'logged_user',
                    ));  
    }
    public function getOnlineReportLaboratory(Request $request)
    {
         $slug = request()->route()->parameters['slug'];
         $pageTitle = ucwords(str_replace('-', ' ', $slug));
         $lab = User::role('laboratory')->where('slug',$slug)->with('roles')->with('profile',function ($query){
                  return $query->select('user_id','avatar','banner','created_at','updated_at','online_report_url','online_test_report_title','online_test_report_desc');
             })->first();

          $doctors = [];
            /*Hospital*/
             $hospitals = User::role('hospital')->orderBy("trending","desc")->with('location','area')->with('profile',function ($query){
                  return $query->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
             })->limit(6)->get();
             // dd($hospitals);
            /*Laboratory*/
            $laboratories = User::role('laboratory')->orderBy("trending","desc")->with('location','area')->with('profile',function ($query){
                  return $query->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
             })->limit(6)->get();
            /*Specialities*/
            $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
            /*Diseases*/
            $diseases = Disease::select('id','title', 'slug','flag','speciality_id')->limit(4)->get();
            /*Services*/
            $services = Service::select('id','title', 'slug','image','speciality_id')->limit(4)->get();
            /*Locations*/
            // $locations = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();
            $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
            $locations=$cities->take(6);
            $cities_pakistan = Location::inRandomOrder()->limit(8)->get();
            $symptoms = [];
            $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec'];
            $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
            $segments = [];
            $user = User::where('id', Auth::id() ? Auth::id() : '')->with('roles')->with('profile',function ($query){
                  return $query->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
             })->first();
            $logged_user = $user ? $user : [];
            $userfeedback = [];

            
            return view(
                    'front-end.laboratory.onlineTestReport',
                    compact(
                        'user',
                        'doctors',
                        'hospitals',
                        'laboratories',
                        'specialities',
                        'diseases',
                        'services',
                        'locations',
                        'cities',
                        'cities_pakistan',
                        'symptoms',
                        'meta_values',
                        'managements',
                        'userfeedback',
                        'segments',
                        'logged_user',
                        'slug',
                        'pageTitle',
                        'lab',
                    ));
    }
    public function nearLaboratory() {
        $user_ = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile',function ($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','faqs','total_experience','description');
            })->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];
        $users = User::role('laboratory')->with('location','area','roles')->with('LabTest',function($q){
                return $q->take(10);
            })->with('profile',function ($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','faqs','total_experience','description','online_report_url');
            })->with('feedbacks',function($q){
                return $q->take(10);
            })->with('branches',function($q){
                return $q->take(10);
            })->get();
            // dd($users[0]);
        $doctors = [];
        /*Hospital*/
            $hospitals = User::role('hospital')->orderBy("trending","desc")->select('id','first_name','last_name','location_id','slug','area_id')->with('location')->limit(6)->get();
            /*Laboratory*/
            $laboratories = User::role('laboratory')->with('location','area')->with('profile',function ($q){
                return $q->select('user_id','avatar','banner','address','longitude','latitude','votes','available_days','working_time','created_at','updated_at','faqs','total_experience','description');
            })->select('id','first_name','last_name','location_id','slug','area_id')->limit(10)->get();
          /*Specialities*/
            $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
            /*Diseases*/
            $diseases = [];
            /*Services*/
            $services = [];
        $tests = Speciality_Test::paginate(10);
            // $mostBooked= [322, 257, 2363, 7092, 2839, 7089];
            
            // $tests = Speciality_Test::orderByRaw(DB::raw("FIELD(id, " . implode(',', $mostBooked) . ") DESC"))->paginate(10);
        $count=$tests->total();
        $symptoms = [];
        $allfaqs = [];   
        $segments = \Request::segments();
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        $cities_pakistan = Location::inRandomOrder()->limit(8)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section','procedure_banner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        return view('front-end.find-near-laboratory.index',
            compact(
                'specialities','users','count','logged_user', 'laboratories', 'cities','cities_pakistan','services', 'diseases',
                'specialities', 'hospitals', 'doctors', 'tests','managements','segments','allfaqs','symptoms'
            )
        );
    }
    public function getAllTests()
    {   
        $specificTestIds = [322, 257, 2363, 7092, 2839, 7089]; 
        $tests=Speciality_Test::with('specialities')->with('symptoms')->orderByRaw("FIELD(id, " . implode(',', $specificTestIds) . ") DESC")
    ->get();

return response()->json($tests);
        return response()->json($tests);
    }
    public function getAllLabTests($id)
    {
        $tests=Speciality_Test::where('lab_id',$id)->get();
        return response()->json($tests);
    }
    public function labCityTest() {
        $city_slug = request()->route()->parameters['city'];
        $city = Location::where('slug', $city_slug)->first();
        // dd($city_id);
        $user_ = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];
        $users = User::role('laboratory')->with('profile','location','area','LabTest','branches','feedbacks','roles')->where('location_id', $city->id)->limit(6)->get();
        $doctors = User::role('doctor')->latest()->orderBy("trending","desc")->with('profile','specialities','location','feedbacks')->whereHas('profile')->limit(2)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->latest()->orderBy("trending","desc")->with('profile','location','area','feedbacks','teams')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->limit(4)->get();
        $tests = Speciality_Test::with('specialities','user')->with('symptoms')->get();
        $symptoms = Symptom::where('test_symptom','1')->with('tests')->get();
        $allfaqs = Faq::where('page_url','find-near-lab')->get();   
        $segments = \Request::segments();
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        $cities_pakistan = Location::inRandomOrder()->limit(8)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section','procedure_banner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        return view('front-end.lab-test-city.city-test',
            compact(
                'specialities','users','logged_user', 'laboratories', 'cities','cities_pakistan','city','services', 'diseases',
                'specialities', 'hospitals', 'doctors', 'tests','managements','segments','allfaqs','symptoms'
            )
        );
    }
    public function testSearch(Request $request)
    {
        $user_id = $request->user_id;
        $data = Speciality_Test::where('title', 'LIKE','%'.$request->keyword.'%')->whereHas('user', function ($query) use ($user_id) {
                    return $query->where('id', $user_id);
                })->get();
        // dd($data);
        return response()->json($data);
    }
    public function allTestSearch(Request $request)
    {
        $data = Speciality_Test::where('title', 'LIKE','%'.$request->keyword.'%')->limit(8)->get();
        // dd($data);
        return response()->json($data);
    }
    public function allTestSearchBanner(Request $request)
    {
        $data = Speciality_Test::where('title', 'LIKE','%'.$request->keyword1.'%')->limit(8)->get();
        // dd($data);
        return response()->json($data);
    }
    public function storetest(Request $request)
    {
        $json = Array();
        $result = BookTest::create([
            'lab_id' => $request['lab_id'],
            'branch_id' => $request['branch_id'],
            'test_id' => json_encode($request['selected_test']),
            'full_name' => $request['full_name'],
            'email' => $request['email'],
            'city' => $request['city'],
            'age' => $request['age'],
            'phone_number' => $request['phone_number'],
            'gender' => $request['gender'],
            'date_preferred' => $request['date_preferred'],
            'address' => $request['address'],
        ]);
        $lastInsertId = $result->id;
        if($request['lab_id'] == 13052){
        $discountCode = LabCode::where('Status',0)->first();
        $discountCode->Status = 1;
        $discountCode->save();
        $json['discountCode'] = $discountCode->CouponNumber;
    }
    else{
        $json['discountCode'] = 1234;
    }
        // dd('lastInsertId',$lastInsertId);
        $json['lastInsertId'] = $lastInsertId;
        $json['type'] = 'success';
        $json['message'] = 'Test Booked Successfully';
        return $json;
    }
    public function storeUserMessage(Request $request)
    {
        //dd($request->all());
        {
         $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'subject' => 'required',
                'message' => 'required',
                'terms' => 'required'
            ]
        );
         $data = new Contact();
        $data ->name = $request->name;
        $data ->email = $request->email;
        $data ->phone = $request->phone;
        $data ->subject = $request->subject;
        $data ->message = $request->message;
        $data ->terms = $request->terms;
        $data ->save();
         $json['type'] = 'success';
            return $json;
    }
    }
     public function contactsUsers(Request $request)
    {
        $contactUsers = Contact::orderBy("id","desc")->get();
        return view('back-end.admin.contacts.contact-us-users',compact('contactUsers'));
    }
    public function storePatientPayment(Request $request)
    {
       // dd($request->all());
         $this->validate(
            $request,
            [
                'appointment_id' => 'required',
                'user_id' => 'required',
                'hospital_id' => 'required',
                'patient_id' => 'required',
                'payment_method' => 'required',
                'appointment_time' => 'required',
                'charges' => 'required',
                'appointment_date' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
            ]
        );
        $order = new Order();
        $order ->user_id = $request->user_id;
        $order ->appointment_id = $request->appointment_id;
        $order ->hospital_id = $request->hospital_id;
        $order ->patient_id = $request->patient_id;
        $order ->payment_gateway = $request->payment_method;
        $order ->appointment_time = $request->appointment_time;
        $order ->appointment_date = $request->appointment_date;
        $order ->charges = $request->charges;
        $order ->status = 'pending';
        $order ->first_name = $request->first_name;
        $order ->last_name = $request->last_name;
        $order ->patient_name = $request->patient_name;
        $order ->relation_you = $request->relation_you;
        $order ->commants = $request->commants;
        $order ->save();
        $all_data = Appointment::where('id',$request->appointment_id)->update(array('payment'=>'paying-but-not-verified'));
         $json['type'] = 'success';
            return $json;
    } 
       public function storeDoctorDemoRequest(Request $request)
    {
       // dd($request->all());
        {
         $this->validate(
            $request,
            [
                'name' => 'required',
                'specialty' => 'required',
                'select_dagree' => 'required',
                'city' => 'required',
                'phone' => 'required',
                'add_email' => 'required'
            ]
        );
         $demo = new Demo();
        $demo ->name = $request->name;
        $demo ->speciality = $request->specialty;
        $demo ->pdmc_ncs_select = $request->select_dagree;
        if ($request->select_dagree === 'pmdc') {
            $demo ->number = $request->pdmc_number;
        }
        else{
             $demo ->number = $request->ncs_number;
        }
        
        $demo ->city = $request->city;
        $demo ->phone_number = $request->phone;
        $demo ->email = $request->add_email;
        $demo ->role = 'doctor';
        $demo ->save();
         $json['type'] = 'success';
            return $json;
    }
    }
        public function storeDemoRequest(Request $request)
    {
        //dd($request->all());
        {
         $this->validate(
            $request,
            [
                'name' => 'required',
                'registration' => 'required',
                'city' => 'required',
                'phone' => 'required',
                'email' => 'required'
            ]
        );
         $demo = new Demo();
        $demo ->name = $request->name;
        $demo ->registration_number = $request->registration;
        $demo ->city = $request->city;
        $demo ->phone_number = $request->phone;
        $demo ->email = $request->email;
        $demo ->role = $request->role;
        $demo ->save();
         $json['type'] = 'success';
            return $json;
    }
    }
     public function demoRequestDoctor(Request $request)
    {
        $doctorDemos = Demo::orderBy("id","desc")->where('role', 'doctor')->get();
        return view('back-end.admin.demos.doctor-demos',compact('doctorDemos'));
    } 
    public function demoRequestHospital(Request $request)
    {
        $hospitalDemos = Demo::orderBy("id","desc")->where('role', 'hospital')->get();
        return view('back-end.admin.demos.hospital-demos',compact('hospitalDemos'));
    }  
    public function demoRequestLab(Request $request)
    {
        $laboratoryDemos = Demo::orderBy("id","desc")->where('role', 'laboratory')->get();
        return view('back-end.admin.demos.laboratory-demos',compact('laboratoryDemos'));
    }     
      public function removeSaved(Request $request){
        $json = array();
        $allnew = [];
        $id = $request['id'];
        $getId = (int)$id;
        $active_user_id = Auth::user()->id;
        $active_user = UserMeta::where('user_id',$active_user_id)->first();
        $saved_doctors = $active_user->saved_doctors;
        $newdata = json_decode($saved_doctors);
        if (($key = array_search($getId, $newdata)) !== false) {
            unset($newdata[$key]);
        }
        $final_array = array_values($newdata);
        $new_arrays = json_encode($final_array);
        $status = UserMeta::where('user_id',$active_user_id)->update(['saved_doctors'=> $new_arrays]);
         $active_user_new = UserMeta::where('user_id',$active_user_id)->first();
       $findids =  $active_user_new->saved_doctors;
       $newgetdata = json_decode($findids);
       if (!empty($newgetdata)) {
       $newgetdata = json_decode($findids);
       foreach($newgetdata as $getdata) {
           $doctors[] = User::where('id', $getdata)->with('profile')->with('specialities')->with('services')->with('location')->with('roles')->first();
        }
            return $doctors;
        }
        else{
            $doctors = null;
            return $doctors;

        }
        }

         public function bookingLab()
      {
        $tests = BookTest::with('lab')->with('location')->latest()->get();
        // dd($tests);
        return view('back-end.admin.booing-tests.index',compact('tests'));
    }

}
