<?php

/**
 * Class User.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use App\Disease;
use App\Area;
use App\Helper;
use App\Location;
use App\UserMeta;
use App\OnlineConsultation;
use App\Feedback;
use App\Models\FriendAndFamily;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 *
 */
class User extends Authenticatable implements JWTSubject
{
    use Cachable;
    use Notifiable;
    use HasRoles;
    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'slug', 'email', 'password',
        'avatar', 'banner', 'tagline', 'description',
        'location_id', 'verification_code', 'address',
        'longitude', 'latitude','phone_number', 'password', 'provider','area_id','provider_id','select_degree','pmdc_number','ncs_number','unique_id','total_discount_percentage','admin_discount_percentage', 'user_discount_percentage',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * Get User Friends and Family.
     *
     * @return relation
     */
    public function friendsAndFamily()
    {
        return $this->hasMany(FriendAndFamily::class);
    }
    /**
     * Get the location that owns the user.
     *
     * @return relation
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }
    public function branches(){
        return $this->hasMany('App\LabBranch','user_id','id');
    }
    public function area()
    {
        return $this->belongsTo('App\Area');
    }
    public function doctorArea()
    {
        return $this->belongsToMany('App\Area', 'doctor_areas', 'user_id', 'area_id');
    }
    public function locationChild()
    {
        return $this->hasMany('App\Location', 'parent','id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    /**
     * Get the profile record associated with the user.
     *
     * @return relation
     */
    public function profile()
    {
        return $this->hasOne('App\UserMeta','user_id','id');
    }
public function userMeta()
    {
        return $this->hasOne('App\UserMeta','user_id','id');
    }
    /**
     * Get the article associated with the user.
     *
     * @return relation
     */
    public function articles()
    {
        return $this->hasMany('App\Article', 'author_id');
    }

    /**
     * Get the varfication code associated with the user.
     *
     * @return relation
     */
    public function labTest()
    {
        return $this->hasMany('App\Speciality_Test', 'lab_id','id');
    }
    public function codes()
    {
        return $this->hasMany('App\Code', 'user_id');
    }

    /**
     * The team that belong to the user
     *
     * @return relation
     */
    public function teams()
    {
        return $this->hasMany('App\Team');
    }

    public function doc_teams()
    {
        return $this->hasMany('App\Team', 'doctor_id', 'id')->with('hospital');
    }
    public function doc_teamms()
    {
        return $this->hasMany('App\Team', 'doctor_id', 'id')->with('hospitalapp',function ($q){
                return $q->select('id','first_name','last_name');});
    }

    public function onlines()
    {
        return $this->hasMany('App\OnlineConsultation', 'doctor_id', 'id');
    }

    /**
     * Approved teams that belong to the hopsital
     *
     * @return relation
     */
    public function approvedTeams()
    {
        return $this->hasMany('App\Team')->where('status', 'approved');
    }

    /**
     * The appointment that belong to the user
     *
     * @return relation
     */
    public function appointments()
    {
        return $this->hasMany('App\Appointment')->with('user')->with('patient')->with('hospital_profile')->latest();
    }
    public function appointment()
    {
        return $this->hasMany('App\Appointment');
    }
    
    public function total_appointment()
    {
        return $this->hasMany('App\Appointment');
    }

    /**
     * The appointment that belong to the user(patients)
     *
     * @return relation
     */
    public function appointments_patient()
    {
        return $this->hasMany('App\Appointment', 'patient_id')->with('user')->with('hospital_profile');
    }
     public function patient_invoices()
    {
        return $this->hasMany('App\Order','patient_id')->with('doctor_profile')->with('hospital_profile')->with('patient_profile')->with('appointment');
    }

    public function doctor_invoices()
    {
        return $this->hasMany('App\Order','user_id')->with('doctor_profile')->with('hospital_profile')->with('patient_profile')->with('appointment');
    }
    /**
     * The users that belong to the service.
     *
     * @return relation
     */
    public function forums()
    {
        return $this->belongsToMany('App\Forum', 'user_forum')->withPivot('type', 'answer');
    } 

    /**
     * The users that belong to the service.
     *
     * @return relation
     */
    public function diseases()
    {
        return $this->belongsToMany('App\Disease', 'user_disease')->withPivot('user_id')->with('faqsAssign');
    }

    /**
     * Get service seller
     *
     * @return relation
     */
    public function question()
    {
        return $this->belongsToMany('App\Forum', 'user_forum')->wherePivot('type', 'question');
    }

    /**
     * Get service seller
     *
     * @return relation
     */
    public function answers()
    {
        return $this->belongsToMany('App\Forum', 'user_forum')->withPivot('type', 'answer', 'user_id')->wherePivot('type', 'answer', 'user_id');
    }

    /**
     * Get the profile record associated with the user.
     *
     * @return relation
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * The users that belong to the Order Meta.
     *
     * @return relation
     */
    public function orderMeta()
    {
        return $this->hasMany('App\OrderMeta', 'metable_id','id');
    }

    /**
     * The services that belong to the user.
     * 
     * @return relation
     */
    public function services()
    {
        return $this->belongsToMany('App\Service', 'user_service')->withPivot('type', 'speciality');
    }

    /**
     * The Speciality that belong to the user.
     *
     * @return relation
     */
    public function specialities()
    {
        return $this->belongsToMany('App\Speciality', 'user_speciality',
            'user_id', 'speciality_id')->with('faqsAssign')->with('tests');
    }
    public function speciality()
    {

        $getspeciality = $this->belongsToMany('App\Speciality', 'user_speciality',
            'user_id', 'speciality_id')->take(1);

        return $getspeciality;
    }
    public function procedures()
    {
       return $this->belongsToMany('App\Procedure', 'user_procedure', 'user_id', 'prodedure_id');
    }
public function procedures_cost()
    {
       return $this->belongsToMany('App\ProcedureEstimatedCost', 'hospital_id');
    }

    /**
     * Get the profile record associated with the user.
     *
     * @return relation
     */
    public function feedbacks()
    {
        return $this->hasMany('App\Feedback')->where('approval', '1')->orderBy('id','desc')->with('user')->with('patient');
    }
    public function feedback()
    {
        return $this->hasMany('App\Feedback')->where('approval', '1')->orderBy('id','desc');
    }
     public function vaccinationLocations()
    {
            return $this->hasMany('App\VaccinationLocation','hospital_id','id');
    }

    /**
     * Set slug before saving in DB
     *
     * @param string $value value
     *
     * @access public
     *
     * @return string
     */
    public function setSlugAttribute($value)
    {
        if (!empty($value)) {
            $temp = Str::slug($value, '-');
            if (!User::all()->where('slug', $temp)->isEmpty()) {
                $i = 1;
                $new_slug = $temp . '-' . $i;
                while (!User::all()->where('slug', $new_slug)->isEmpty()) {
                    $i++;
                    $new_slug = $temp . '-' . $i;
                }
                $temp = $new_slug;
            }
            $this->attributes['slug'] = $temp;
        }
    }

    /**
     * Store user
     *
     * @param \Illuminate\Http\Request $request           code
     * @param string                   $verification_code verification code
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeUser($request, $verification_code='')
    {
         
          if ($request['phone_number']) {

            if (substr( $request['phone_number'], 0, 2 ) === "03") {
                $request['phone_number'] = '92'.(int)$request['phone_number'];
            }
            if (substr( $request['assistant_phone_number'], 0, 2 ) === "03") {
                $request['assistant_phone_number'] = '92'.(int)$request['assistant_phone_number'];
            }
        }
        if (!empty($request)) {
            $this->first_name = filter_var($request['first_name'], FILTER_SANITIZE_STRING);
            $this->last_name = filter_var($request['last_name'], FILTER_SANITIZE_STRING);
            $this->slug = filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' .
                filter_var($request['last_name'], FILTER_SANITIZE_STRING);
            $this->email = filter_var($request['email'], FILTER_VALIDATE_EMAIL);
            $this->phone_number = filter_var($request['phone_number'], FILTER_SANITIZE_STRING);
            $this->assistant_phone_number = filter_var($request['assistant_phone_number'], FILTER_SANITIZE_STRING);
            
            $this->password = Hash::make($request['password']);
            $this->verification_code = !empty($verification_code) ? $verification_code : null;
            $this->user_verified = 0;
            $this->location_id = $request['location_id'] ?? null;
            $role = DB::table('roles')->select('name')->where('role_type', $request['role'])->first();

            $this->assignRole($role->name);
            if (!empty($request['locations'])) {
                $location = Location::find($request['locations']);
                $area = Location::find($request['areas']);
                $this->location()->associate($location);
                $this->area()->associate($area);
            }

            $this->package_expiry = null;
            $this->save();
            $user_id = $this->id;
            $profile = new UserMeta();
            $profile->user()->associate($user_id);
            if($request['role'] == 'laboratory' ){
                $start_time = date("g:i A",strtotime($request['start_time']));
                $end_time = date("g:i A",strtotime($request['end_time']));
                $profile->address = $request['address'];
                $profile->working_time = $start_time." - ".$end_time;
                $profile->latitude = $request['latitude'];
                $profile->longitude = $request['longitude'];
                $profile->available_days = json_encode($request['days']);
            }
            $profile->save();
            $role_id = Helper::getRoleByUserID($user_id);
            return $user_id;
        }
    }

    /**
     * Update user data
     *
     * @param \Illuminate\Http\Request $request           code
     * @param string                   $verification_code verification code
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUser($request, $edit_user_id='')
    {
        $json = array();
        if (!empty($request)) {
            if (!empty($edit_user_id)) {
                $user = $this::find($edit_user_id);
            } else {
                $user = $this;
            }
            $user->first_name = filter_var($request['first_name'], FILTER_SANITIZE_STRING);
            $user->last_name = filter_var($request['last_name'], FILTER_SANITIZE_STRING);
             // $user->address = filter_var($request['address'], FILTER_SANITIZE_STRING);
            $slug = filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' .
                filter_var($request['last_name'], FILTER_SANITIZE_STRING);
            $user->pmdc_number = filter_var($request['pmdc_number'], FILTER_SANITIZE_STRING);
            $user->ncs_number = filter_var($request['ncs_number'], FILTER_SANITIZE_STRING);
            if ($user->slug != Str::slug($slug, '-')) {
                $user->slug = $slug;
            }
            if (empty($user->email) && !empty($request['email'])) {
                $user->email = filter_var($request['email'], FILTER_VALIDATE_EMAIL);
            }
            if (!empty($request['password'])) {
                $user->password = Hash::make($request['password']);
            }
            $role_type = Helper::getRoleTypeByUserID($edit_user_id);
            if (!empty($request['role']) && $request['role'] != $role_type) {
                $role = DB::table('roles')->select('name')->where('role_type', $request['role'])->first();
                DB::table('model_has_roles')->where('model_id', $edit_user_id)->delete();
                $user->assignRole($role->name);
                $role_type = Helper::getRoleTypeByUserID($edit_user_id);
                if ($role_type == 'doctor') {
                    if ($user->orders->count() > 0) {
                        foreach ($user->orders as $user_orders) {
                            OrderMeta::where('metable_id', $user_orders->id)->delete();
                        }
                        $user->orders()->delete();
                    }
                    $order = new Order();
                    $order->status = 'pending';
                    $order->payment_gateway = 'paypal';
                    $order->user()->associate($edit_user_id);
                    $order->save();
                    $order_id = DB::getPdo()->lastInsertId();
                    $latest_order = Order::find($order_id);
                    $order_type = new OrderMeta();
                    $order_type->meta_key = 'type';
                    $order_type->meta_value = 'package';
                    $latest_order->orderMeta()->save($order_type);
                    $package_data = array();
                    $package = Package::where('trial', 1)->first()->toArray();
                    if (!empty($package)) {
                        $option = !empty($package['options']) ? json_decode($package['options'], true) : '';
                        foreach ($package as $package_key => $package_value) {
                            $package_data[$package_key] = $package_value;
                        }
                        $package_meta = new OrderMeta();
                        $package_meta->meta_key = 'package';
                        $package_meta->meta_value = json_encode($package_data);
                        $latest_order->orderMeta()->save($package_meta);
                        $expiry = !empty($order) ? $order->created_at->addDays($option['duration']) : '';
                        $expiry_date = !empty($expiry) ? Carbon::parse($expiry)->toDateTimeString() : '';
                        $user = User::find($edit_user_id);
                        $user->package_expiry = $expiry_date;
                        $user->save();
                    }
                }
            }
            if (!empty($request['locations'])) {
                $location = Location::find($request['locations']);
                $user->location()->associate($location);
            }
            // $user->package_expiry = null;
            $user->save();
            $user_id = $user->id;
            
            // // $profile = new UserMeta();
            // // $profile->user()->associate($user_id);
            // // $profile->save();
            // $role_id = Helper::getRoleByUserID($user_id);
            $json['user_id'] = $user_id;
            $json['type'] = 'success';
            return $json;
        }
    }

    /**
     * Get search results
     *
     * @param integer $type              type
     * @param integer $keyword           keyword
     * @param integer $search_locations  search_locations
     * @param integer $search_service    search_service
     * @param integer $search_speciality search_speciality
     * @param integer $order_by          order_by
     * @param integer $sort_by           sort_by
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function getSearchResult($type, $keyword, $search_diseases, $search_locations, $search_area, $search_service, $search_speciality, $search_gender, $video_consultation, $order_by, $sort_by)
    {
        $json = array();
        $user_id = array();
        $filters = array();
        $user_by_role = !empty($type) && $type != 'both' ? Helper::getUsersByRoleType($type) : Helper::getSearchableUsers();
        // dd($user_by_role);
                $users =   User::with('diseases')->with('specialities')->with('location')->with('area')->with('services')->with('profile')->with('location')->with('feedbacks')->with('doc_teams')->with('teams')->with('appointments')->with('roles')->with("onlines")->whereIn('id', $user_by_role);
        // $AllUsers = $UsersWithRelation->whereIn('id', $user_by_role);
                // dd($users);
        self::trending($type, $keyword, $search_diseases, $search_locations, $search_area, $search_service, $search_speciality, $search_gender, $video_consultation, $order_by, $sort_by);

        if (!empty($users)) {
            $filters['type'] = $type;
            if (!empty($keyword)) {
                $filters['keyword'] = $keyword;
                $keyword = Str::slug($keyword,'-');
                $users = $users;
                $users->whereHas('diseases', function ($query) use ($keyword) {
                    $query->where('slug', 'like', '%' . $keyword . '%');
                    $query->orWhere('title', 'like', '%' . $keyword . '%');
                });
                $users->orwhereHas('specialities', function ($query) use ($keyword) {
                    $query->where('slug', 'like', '%' . $keyword . '%');
                    $query->orWhere('title', 'like', '%' . $keyword . '%');
                });
                $users->orwhereHas('services', function ($query) use ($keyword) {
                    $query->where('slug', 'like', '%' . $keyword . '%');
                    $query->orWhere('title', 'like', '%' . $keyword . '%');
                });
                $users->orwhereHas('profile', function ($query) use ($keyword) {
                    //$query->where('tagline', 'like', '%' . $keyword . '%');
                    $query->where('sub_heading', 'like', '%' . $keyword . '%');
                });
                if ($video_consultation === 'on') {
                    $users->orwhereHas('profile', function ($query) use ($video_consultation) {
                        $query->where('sub_heading', 'like', '%' . $video_consultation . '%');
                    });
                }
                $users->orWhere('first_name', 'like', '%' . $keyword . '%');
                $users->orWhere('last_name', 'like', '%' . $keyword . '%');
                $users->orWhere('slug', 'like', '%' . $keyword . '%');
                $users->whereIn('id', $user_by_role);
            }
            if (!empty($search_diseases)) {
                $filters['diseases'] = $search_diseases;
                $search_diseases = Str::slug($search_diseases,'-');
                $selected_diseases = Disease::select('id')->where('slug', $search_diseases)
                    ->first();
                $diseases_users = DB::table('user_disease')->select('user_id')
                    ->where('disease_id', $selected_diseases->id)
                    ->groupBy('user_id')
                    ->get()->pluck('user_id')->toArray();
                $users->whereIn('id', $diseases_users)->whereIn('id', $user_by_role);
            }
            if (!empty($search_locations && request()->route()->getName() != "laboratory-by-city")) {
                $filters['locations'] = $search_locations;
                $keyword = Str::slug($search_locations,'-');
                $locations = Location::select('id')->where('slug', $keyword)
                    ->get()->pluck('id')->toArray();
                $location_user = User::select('id')->whereIn('location_id', $locations)->get()->pluck('id')->toArray();
                $users->whereIn('id', $location_user)->whereIn('id', $user_by_role);
            }
            if (!empty($search_area)) {
                $filters['area'] = $search_area;
                $keyword = Str::slug($search_area,'-');
                $area = Location::select('id')->where('slug', $keyword)
                    ->get()->pluck('id')->toArray();
                $location_user = User::select('id')->whereIn('area_id', $area)->get()->pluck('id')->toArray();
                $users->whereIn('id', $location_user)->whereIn('id', $user_by_role);
            }
            if (!empty($search_service)) {
                $filters['service'] = $search_service;
                $keyword = Str::slug($search_service,'-');
                $selected_service = Service::select('id')->where('slug', $keyword)
                    ->first();
                $service = Service::find($selected_service->id);
                if ($service->users->count() > 0) {
                    foreach ($service->users as $key => $user_service) {
                        $user_id[] = $user_service->id;
                    }
                }
                // dd($user_id);
                $users->whereIn('id', $user_by_role);
            }
            
            if (!empty($search_speciality)) {
                $filters['speciality'] = $search_speciality;
                $keyword = Str::slug($search_speciality,'-');
                $selected_speciality = Speciality::select('id')->where('slug', $keyword)
                    ->first();
                    if (!empty($selected_speciality)) {
                // if ($selected_speciality){
                //     $speciality_users = UserService::select('user_id')
                //         ->where('speciality', $selected_speciality->id)
                //         ->groupBy('user_id')
                //         ->get()->pluck('user_id')->toArray();
                //     $users->whereIn('id', $speciality_users)->whereIn('id', $user_by_role);
                // }
                        $speciality = Speciality::with('users')->find($selected_speciality->id);
                        // dd();
                        if ($speciality->users->count() > 0) {
                           
                            $user_id = $speciality->users->pluck('id')->toArray();
                                }
                               // dd($user_id);
                
                            // dd($user_id);
                            $users->whereIn('id', $user_id);
                        }
                }

            if (!empty($search_gender)) {
                $filters['gender'] = $search_gender;
                $keyword = Str::slug($search_gender,'-');
                $selected_service = UserMeta::select('user_id')->where('gender', $keyword)
                    ->get();
                   
                if ($selected_service->count() > 0) {
                    foreach ($selected_service as $key => $selected_service) {
                        $user_id[] = $selected_service->user_id;
                    }
                }
                $users->whereIn('id', $user_by_role);
            }
            $order = !empty($order_by) ? $order_by : 'asc';
            if (!empty($sort_by)) {
                if ($sort_by == 'name') {
                    $users = $users->orderBy('first_name', $order);
                } elseif ($sort_by == 'date') {
                    $users = $users->orderBy('created_at', $order);
                } else {
                    $users = $users->orderBy($sort_by, $order);
                }
            }
            $json['total'] = $users->count();
            // $users = $users->paginate(8);
        }
        /*foreach ($filters as $key => $filter) {
            $pagination = $users->appends(
                array(
                    $key => $filter 
                )
            );
        }*/

             // dd($users->get());
        $json['users'] = $users;
        return $json;
    }

    public static function trending($type, $keyword, $search_diseases, $search_locations, $search_area, $search_service, $search_speciality, $search_gender, $video_consultation, $order_by, $sort_by)
    {
//        dd($type, $keyword, $search_diseases, $search_locations, $search_area, $search_service, $search_speciality, $search_gender, $video_consultation, $order_by, $sort_by);

        if ($search_diseases) {
            $disease = Disease::where('slug', $search_diseases)->first();
            if ($disease) {
                $disease->increment('trending');
            }
        }
        if ($search_speciality) {
            $speciality = Speciality::where('slug', $search_speciality)->first();
            if ($speciality) {
                $speciality->increment('trending');
            }
        }
        if ($search_service) {
            $service = Service::where('slug', $search_service)->first();
            if ($service) {
                $service->increment('trending');
            }
        }

        $selected_speciality = Speciality::where('slug', $keyword)->orWhere('title', $keyword)
                    ->first();
        if($selected_speciality){
            $selected_speciality->increment('trending');
        }
        $selected_Service = Service::where('slug', $keyword)->orWhere('title', $keyword)->first();
        if($selected_Service){
            $selected_Service->increment('trending');
        }
        $selected_Disease = Disease::where('slug', $keyword)->orWhere('title', $keyword)
                    ->first();
        if($selected_Disease){
            $selected_Disease->increment('trending');
        }
    }

    /**
     * Update doctor payout table
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function updatePayouts()
    {
        // $payout_settings = SiteManagement::getMetaValue('commision');
        // $min_payount = !empty($payout_settings) && !empty($payout_settings[0]['min_payout']) ? $payout_settings[0]['min_payout'] : '';
        // // $payment_gateway = !empty($payout_settings) && !empty($payout_settings[0]['payment_method']) ? $payout_settings[0]['payment_method'] : 'paypal';
        // $payment_settings = SiteManagement::getMetaValue('commision');
        // $currency  = !empty($payment_settings) && !empty($payment_settings[0]['currency']) ? $payment_settings[0]['currency'] : 'USD';
        

    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
