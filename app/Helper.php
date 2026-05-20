<?php

/**
 * Class Helper
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use DB;
use Auth;
use File;
use App\User;
use Storage;
use App\Location;
use App\Service;
use App\Payout;
use App\SiteManagement;
use Spatie\Permission\Models\Role;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use App\Speciality;
use Illuminate\Pagination\LengthAwarePaginator;
use Breadcrumbs;
use App\Appointment;
use Twitter;
use View;
// require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Config;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\Graph;
/**
 * Class Helper
 *
 */
class Helper extends Model
{
    use Cachable;
    /**
     * Demo site refresh page
     *
     * @param string $message message text
     *
     * @access public
     *
     * @return string
     */
    public static function doctieIsDemoSite($message = '')
    {
        $message = !empty($message) ? $message : trans('lang.restricted_text');
        if (isset($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] === 'amentotech.com') {
            return $message;
        }
    }

    /**
     * Demo site ajax request
     *
     * @param string $message message text
     *
     * @access public
     *
     * @return string
     */
    public static function doctieIsDemoSiteAjax($message = '')
    {
        $message = !empty($message) ? $message : trans('lang.restricted_text');
        if (isset($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] === 'amentotech.com') {
            return response()->json(['message' => $message]);
        }
    }

    /**
     * Get Image Sizes Define your images sizes here
     *
     * @return string
     */
    public static function getImageSizes($type = '')
    {
        $image_sizes = array(
            'category' => array(
                'small' => array(
                    'width' => 50,
                    'height' => 50,
                ),
            ),
            'profile_gallery' => array(
                'small' => array(
                    'width' => 235,
                    'height' => 167,
                ),
            ),
            'location' => array(
                'extra-small' => array(
                    'width' => 18,
                    'height' => 11,
                ),
            ),
            'speciality' => array(
                'extra-small' => array(
                    'width' => 40,
                    'height' => 40,
                ),
                'small' => array(
                    'width' => 65,
                    'height' => 45,
                ),
            ),
            'disease' => array(
                'extra-small' => array(
                    'width' => 40,
                    'height' => 40,
                ),
                'small' => array(
                    'width' => 65,
                    'height' => 45,
                ),
            ),
            'banner_icon_img' => array(
                'small' => array(
                    'width' => 14,
                    'height' => 14,
                ),
            ),
            'banner_img' => array(
                'small' => array(
                    'width' => 200,
                    'height' => 250,
                ),
            ),
            'c_info_img' => array(
                'small' => array(
                    'width' => 45,
                    'height' => 40,
                ),
            ),
            'mobile_app' => array(
                'small' => array(
                    'width' => 110,
                    'height' => 36,
                ),
            ),
            'profile_banner' => array(
                'small' => array(
                    'width' => 270,
                    'height' => 150,
                ),
            ),
            'profile_img' => array(
                'small' => array(
                    'width' => 100,
                    'height' => 100,
                ),
                'extra-small' => array(
                    'width' => 48,
                    'height' => 48,
                ),
                'medium' => array(
                    'width' => 255,
                    'height' => 255,
                ),
                'saved_items' => array(
                    'width' => 217,
                    'height' => 217,
                ),
            ),
            'articles' => array(
                'list' => array(
                    'width' => 271,
                    'height' => 194,
                ),
                'listing' => array(
                    'width' => 308,
                    'height' => 220,
                ),
                'blog-single' => array(
                    'width' => 825,
                    'height' => 360,
                ),
                'extra-small' => array(
                    'width' => 40,
                    'height' => 40,
                ),
                'featured' => array(
                    'width' => 350,
                    'height' => 250,
                ),
            ),
        );
        if (!empty($type) && array_key_exists($type, $image_sizes)) {
            return $image_sizes[$type];
        } else {
            return '';
        }
    }

    /**
     * Store Temporary images
     *
     * @param mixed  $temp_path  Temporary Path.
     * @param object $file       file.
     * @param string $type       type
     * @param array  $image_size Image Size.
     * @param string $img_type   Image type.
     *
     * @return json response
     */
    public static function uploadTempImage($temp_path, $file, $type = "", $image_size = array(), $img_type = '')
{
    $json = array();
    if (!empty($file)) {
        // create directory if not exist for production
        if (env('FILESYSTEM_DRIVER') === 'production' && !Storage::disk('s3')->exists($temp_path)) {
            Storage::disk('s3')->makeDirectory($temp_path);
        }

        $file_original_name = $file->getClientOriginalName();
         $parts = explode('.', $file_original_name);
        $extension = end($parts);
        $extension = $file->getClientOriginalExtension();
        $disk = (env('FILESYSTEM_DRIVER') === 'production') ? 's3' : 'local_public';

        if ($img_type == 'multiple_types') {
            if($disk === 's3'){
            Storage::disk($disk)->put($temp_path . $file_original_name, file_get_contents($file->getPathname()), 'public');
            }else{
                    Storage::disk('local_public')->putFileAs(
                    $type . '/temp/',
                    $file,
                    $file_original_name
                );
                    }
            $json['message'] = trans('lang.img_uploaded');
            $json['type'] = 'success';
            return $json;
        }

        if ($extension === "svg" || $extension === "webp" || $extension === "jpg" || $extension === "png" || $extension === 'gif') {
            $file_original_name = $parts[0] . '.webp';
            if (!empty($image_size)) {
                foreach ($image_size as $key => $size) {
                    $small_img = Image::make($file)->encode('webp', 100);
                    $small_img->fit(
                        $size['width'],
                        $size['height'],
                        function ($constraint) {
                            $constraint->upsize();
                        }
                    );
                    if($disk === 's3'){

                    Storage::disk($disk)->put($temp_path . $key . '-' . $file_original_name, $small_img->stream(), 'public');
                    }else{

                    $small_img->save($temp_path . $key . '-' . $file_original_name);
            // dd('a', $small_img);
                    }
                }
            }

            // save original image size
            $img = Image::make($file);
            if($disk === 's3'){
            Storage::disk($disk)->put($temp_path . $file_original_name, $img->stream(), 'public');
            }else{
                    $img->save($temp_path . '/' . $file_original_name);
                    }
            $json['message'] = trans('lang.img_uploaded');
            $json['type'] = 'success';
            return $json;
        } elseif ($extension === 'ico') {
            if($disk === 's3'){
            Storage::disk($disk)->put($temp_path . $file_original_name, file_get_contents($file->getPathname()), 'public');
            }else{
                Storage::disk('local_public')->putFileAs(
                    $type . '/temp/',
                    $file,
                    $file_original_name
                );
                    }
            $json['message'] = trans('lang.img_uploaded');
            $json['type'] = 'success';
            return $json;
        } else {
            $json['message'] = trans('lang.img_jpg_png');
            $json['type'] = 'error';
            return $json;
        }
    } else {
        $json['message'] = trans('lang.image_not_found');
        $json['type'] = 'error';
        return $json;
    }
}


    /**
     * List category in tree format
     *
     * @param string  $model      Model Name should be in uppercase form
     * @param integer $parent_id  Image
     * @param string  $cat_indent Category Indentation Symbol
     *
     * @access public
     *
     * @return array
     */
    public static function listTreeCategories($model, $parent_id = 0, $cat_indent = '')
    {
        $parent_cat = array();
        if ($model === 'location') {
            $parent_cat = Location::select('title', 'id', 'parent')->where('parent', $parent_id)->get()->toArray();
        } elseif ($model === 'service') {
            $parent_cat = Service::select('title', 'id', 'parent')->where('parent', $parent_id)->get()->toArray();
        }
         elseif ($model === 'category') {
            $parent_cat = Category::select('title', 'id', 'parent')->where('parent', $parent_id)->get()->toArray();
        }
        foreach ($parent_cat as $key => $value) {
            echo '<option value="' . $value['id'] . '">' . $cat_indent . $value['title'] . '</option>';
            self::listTreeCategories('', $value['id'], $cat_indent . '—');
        }
    }

    /**
     * Get public path
     *
     * @return \Illuminate\Http\Response
     */
    public static function publicPath()
    {
        $filesystemDriver = env('FILESYSTEM_DRIVER');
        if($filesystemDriver == 'production'){
            $path = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
            return $path;
        }
        else{
        $path = public_path();
        if (isset($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] != '127.0.0.1') {
            $path = getcwd();
        }
        return $path;
        }
    }

    /**
     * Get storage public disk 
     *
     * @return \Illuminate\Http\Response
     */
    public static function getPublicStorageDisk()
    {
        $disk = 'local_public';
        if (isset($_SERVER["SERVER_NAME"]) && $_SERVER["SERVER_NAME"] != '127.0.0.1') {
            $disk = 'live_public';
        }
        return $disk;
    }

    /**
     * Get image
     *
     * @param string $path    image path
     * @param string $image   image
     * @param string $size    size
     * @param string $default default image
     *
     * @access public
     *
     * @return string
     */
    public static function getImage($path, $image, $size = '', $default = '')
  
    {
        // dd($path, $image);

        $image_output = '';
        if(env('FILESYSTEM_DRIVER') === 'production'){
            $disk = 's3';

    if (!empty($path) && !empty($image)) {
        $file = $path . '/' . $size . $image;
        // dd($file);

        // Check if the file exists on DO Spaces
        if (Storage::disk($disk)->exists($file)) {
            // Use Storage::url() for DO Spaces
            $image_output = Storage::disk($disk)->url($file);
        } else {
            // Check if the original file exists on DO Spaces
            $file = $path . '/' . $image;
            if (Storage::disk($disk)->exists($file)) {
                // Use Storage::url() for DO Spaces
                $image_output = Storage::disk($disk)->url($file);
            } else {
                // Use the default image if neither size-specific nor original image exists
                $image_output = Storage::disk($disk)->url('images/' . $default);
            }
        }
    } else {
        // Use the default image if path or image is empty
        // $image_output = asset('images/' . $default);
            $image_output = Storage::disk($disk)->url('images/' . $default);
        // dd($image_output);
    }
        }
        else{
        if (!empty($path) && !empty($image)) {
            $file = $path . '/' . $size . $image;
            if (file_exists($file)) {
                if (!empty($size)) {
                    $image_output = $path . '/' . $size . $image;
                } else {
                    $image_output = $path . '/' . $image;
                }
            } else {
                $file=$path . '/' .$image;
                if(file_exists($file))
                {
                    $image_output = $path . '/' .$image;
                }
                else
                {
                  $image_output = 'images/' . $default;  
                }
                
            }
        } else {
            $image_output = 'images/' . $default;
        }
    }
        return html_entity_decode(clean($image_output));
    }

    public static function getDiseaseImage($path, $image, $size = '', $default = '')
    {
        $image_output = '';
        if (!empty($path) && !empty($image)) {
            $file = $path .'/'. $size . $image;
            if (file_exists($file)) {
                if (!empty($size)) {
                    $image_output = $path . '/' . $size . $image;
                } else {
                    $image_output = $path . '/' . $image;
                }
            } else {
                $image_output = 'images/' . $default;
            }
        } else {
            $image_output = 'images/' . $default;
        }
        return html_entity_decode(clean($image_output));
    }

    /**
     * Generate random code
     *
     * @param integer $limit Limit of numbers
     *
     * @access public
     *
     * @return array
     */
    public static function generateRandomCode($limit)
    {
        if (!empty($limit) && is_numeric($limit)) {
            return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
        }
    }

    /**
     * Get role by userID
     *
     * @param integer $user_id UserID
     *
     * @access public
     *
     * @return array
     */
    public static function getRoleByUserID($user_id)
    {
        $role = DB::table('model_has_roles')->select('role_id')->where('model_id', $user_id)
            ->first();
        return $role->role_id;
    }

    /**
     * Get role by userID
     *
     * @param integer $user_id UserID
     *
     * @access public
     *
     * @return array
     */
    public static function getRoleTypeByUserID($user_id)
    {
        $role = DB::table('model_has_roles')->select('role_id')->where('model_id', $user_id)
            ->first();
        if (!empty($role)) {
            $role_type = Role::select('role_type')->where('id', $role->role_id)->pluck('role_type')->first();
        }
        return !empty($role_type) ? $role_type : '';
    }

    /**
     * Get auth role type
     *
     * @access public
     *
     * @return array
     */
    public static function getAuthRoleType()
    {
        if (Auth::user()) {
            $role = DB::table('model_has_roles')->select('role_id')->where('model_id', Auth::user()->id)
                ->first();
            if (!empty($role)) {
                $role_type = Role::select('role_type')->where('id', $role->role_id)->pluck('role_type')->first();
            }
            return !empty($role_type) ? $role_type : '';
        }
    }

    /**
     * Get role by roleID
     *
     * @param integer $role_id RoleID
     *
     * @access public
     *
     * @return array
     */
    public static function getRoleNameByRoleID($role_id)
    {
        $role = \Spatie\Permission\Models\Role::where('id', $role_id)
            ->first();
        if (!empty($role)) {
            return $role->name;
        } else {
            return '-';
        }
    }

    /**
     * Get users by role type
     *
     * @param string $role_type role_type
     *
     * @access public
     *
     * @return array
     */
    public static function getUsersByRoleType($role_type)
    {
        if (!empty($role_type)) {
            return DB::table('users')
                ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->select('users.id')
                ->where('roles.role_type', $role_type)
                ->get()->pluck('id')->toArray();
        }
    }

    /**
     * Get searchable users.
     *
     * @access public
     *
     * @return array
     */
    public static function getSearchableUsers()
    {
        return DB::table('users')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select('users.id')
            ->where('roles.role_type', '!=', 'patient')
            ->where('roles.role_type', '!=', 'admin')
            ->get()->pluck('id')->toArray();
    }

    /**
     * Get dashboard menu
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function getDashboardList()
    {
        $auth_role = Auth::user() ? self::getAuthRoleType() : '';
        $menu_items = array(
            'dashboard' => array(
                'role' => array('doctor', 'hospital', 'patient', 'laboratory'),
                'title' => trans('lang.dashboard'),
                'link' => url($auth_role . '/dashboard'),
                'icon' => 'ti-desktop',
                'parent_class' => '',
                'route' => '',
                'parent_active' => '',
                'child_active' => '',
            ),
            'user_appointment_list' => array(
                'role' => array('patient'),
                'title' => trans('lang.appointment_list'),
                'link' => route('userAppointments'),
                'icon' => 'ti-align-justify',
                'parent_class' => '',
                'route' => 'userAppointments',
                'parent_active' => '',
                'child_active' => '',
            ),
            'manage_teams' => array(
                'role' => array('hospital'),
                'title' => trans('lang.manage_teams'),
                'link' => route('manageTeams'),
                'icon' => 'ti-user',
                'parent_class' => '',
                'route' => '',
                'parent_active' => '',
                'child_active' => '',
            ),
            'appointment_list' => array(
                'role' => array('doctor'),
                'title' => trans('lang.appointment_list'),
                'link' => route('doctorAppointments'),
                'icon' => 'ti-layers-alt',
                'parent_class' => '',
                'route' => 'doctorAppointments',
                'parent_active' => '',
                'child_active' => '',
            ),
            'appointment_settings' => array(
                'role' => array('doctor'),
                'title' => trans('lang.appointment_settings'),
                'link' => route('addAppointmentLocation'),
                'icon' => 'ti-calendar',
                'parent_class' => '',
                'route' => 'addAppointmentLocation',
                'parent_active' => '',
                'child_active' => '',
            ),
             'dashboards' => array(
                'role' => array('admin'),
                'title' => trans('lang.dashboard'),
                'link' => url('admin/dashboard'),
                'icon' => 'ti-desktop',
                'route' => 'user-role',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
              'manage_hospital' => array(
                'role' => array('admin'),
                'title' => trans('lang.manage_hospital'),
                'link' => url('users/hospital'),
                'icon' => 'fa fa-hospital',
                'route' => 'user-role',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
            // 'manage_doctor' => array(
            //     'role' => array('admin'),
            //     'title' => trans('lang.manage_doctor'),
            //     'link' => url('users/doctor'),
            //     'icon' => 'fa fa-user-md',
            //     'route' => 'user-role',
            //     'parent_class' => '',
            //     'parent_active' => '',
            //     'child_active' => '',
            //     'childern' => '',
            // ),
               'reports' => array(
                'role' => array('admin'),
                'title' => trans('lang.manage_doctor'),
                'link' => 'javascript:;',
                'icon' => 'fa fa-user-md',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                    array(
                        'title' => trans('All Doctors'),
                        'link' => url('users/doctor'),
                        'route' => 'users/doctor',
                    ),
                     array(
                        'title' => trans('Online Consultation'),
                        'link' => route('allOnline'),
                        'route' => 'allOnline',
                    ),
                     array(
                        'title' => trans('New Doctor Requests'),
                        'link' => route('allNewDoctors'),
                        'route' => 'allNewDoctors',
                    ),
                    array(
                        'title' => trans('Registered Doctors'),
                        'link' => route('allDoctors'),
                        'route' => 'allDoctors',
                    ),
                    array(
                        'title' => trans('All Extended Doctors'),
                        'link' => route('all-extend-doctors'),
                        'route' => 'all-extend-doctors',
                    ),
                    array(
                        'title' => trans('Onboard Doctors'),
                        'link' => route('all-onboard-doctors'),
                        'route' => 'all-onboard-doctors',
                    ),
                    array(
                        'title' => trans('Blocked Doctors'),
                        'link' => route('all-blocked-doctors'),
                        'route' => 'all-blocked-doctors',
                    ),
                    array(
                        'title' => trans('Registered Doctors Info'),
                        'link' => route('all-register-doctors-info'),
                        'route' => 'all-register-doctors-info',
                    ),
                ),
            ),
               'appointment' => array(
                'role' => array('admin'),
                'title' => trans('Appointments'),
                'link' => 'javascript:;',
                'icon' => 'fa fa-calendar-check-o',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                      array(
                        'title' => trans('Appointment Booking'),
                        'link' => url('appointment-booking-system'),
                        'route' => 'appointment-booking-system',
                    ),
                    array(
                        'title' => trans('Patient Visit'),
                        'link' => url('admin/visit-appointment'),
                        'route' => 'visit-appointment',
                    ), array(
                        'title' => trans('Video Appointments'),
                        'link' => url('admin/online-appointment'),
                        'route' => 'online-appointment',
                    ),
                     array(
                        'title' => trans('All Video And Visit'),
                        'link' => url('admin/all-appointment'),
                        'route' => 'all-appointment',
                    ),
                     # Pending and approved appointmetns by usman.
                     array(
                        'title' => trans('Not Confirmed Yet'),
                        'link' => url('admin/pending-appointment'),
                        #'route' => '',
                    ),
                     array(
                        'title' => trans('Confirmed Appointment'),
                        'link' => url('admin/accepted-appointment'),
                        #'route' => '',
                    ),
                     array(
                        'title' => trans('Cancel Appointments'),
                        'link' => url('admin/cancel-appointment'),
                        #'route' => '',
                    ),
                     array(
                        'title' => trans('Notifications'),
                        'link' => url('admin/appointment-notifications'),
                        #'route' => '',
                    ),
                ),
            ),
               'products' => array(
                'role' => array('admin'),
                'title' => trans('Products'),
                'link' => 'javascript:;',
                'icon' => 'fa fa-podcast',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                      array(
                        'title' => trans('Catalouge'),
                        'link' => url('product/catalogue'),
                        'route' => 'product/catalogue',
                    ),
                      array(
                        'title' => trans(''),
                        'link' => url('product/creat/catalogue'),
                        'route' => 'product/creat/catalogue',
                    ),
                      array(
                        'title' => trans('Categories'),
                        'link' => url('product/categories'),
                        'route' => 'product/categories',
                    ),
                      array(
                        'title' => trans('Tags'),
                        'link' => url('product/tag'),
                        'route' => 'product/tag',
                    ),
                       array(
                        'title' => trans('Brands'),
                        'link' => url('product/brand'),
                        'route' => 'product/brand',
                    ),
                         array(
                        'title' => trans('Attributes'),
                        'link' => url('product/attributes'),
                        'route' => 'product/attributes',
                    ),
                           array(
                        'title' => trans('Reviews'),
                        'link' => url('product/reviews'),
                        'route' => 'product/reviews',
                    ),
                           array(
                        'title' => trans('Page Setting'),
                        'link' => url('product/page/setting'),
                        'route' => 'product/page/setting',
                    ),
                ),
            ),
               'Sales' => array(
                'role' => array('admin'),
                'title' => trans('Sales'),
                'link' => 'javascript:;',
                'icon' => 'fa fa-podcast',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                      array(
                        'title' => trans('Orders'),
                        'link' => url('product/order'),
                        'route' => 'product/order',
                    ),
                         array(
                        'title' => trans('Transcations'),
                        'link' => url('product/transcations'),
                        'route' => 'product/transcations',
                    ),
                ),
            ),
            'laboratory' => array(
                'role' => array('admin'),
                'title' => trans('laboratories'),
                'link' => 'javascript:;',
                'icon' => 'fa fa-flask',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                    array(
                        'title' => trans('lang.all_laboratories'),
                        'link' => url('users/laboratory'),
                        'route' => 'user-role',
                    ), array(
                        'title' => trans('lang.all_branches'),
                        'link' => url('admin/labs/branches'),
                        'route' => 'procedure-cost',
                    ), array(
                        'title' => trans('lang.upload_discount'),
                        'link' => url('admin/labs/upload_discount'),
                        'route' => 'upload-discount',
                    ), array(
                        'title' => trans('lang.lab_code_listing'),
                        'link' => url('admin/labs/lab_code_listing'),
                        'route' => 'lab-code-listing',
                    ),array(
                        'title' => 'Booking Tests',
                        'link' => url('admin/booking-tests'),
                        'route' => 'user-role',
                    ),array(
                        'title' => 'Upload Lab Tests File',
                        'link' => url('import-export-view'),
                        'route' => 'user-role',
                    ), 
                    array(
                        'title' => 'Block User',
                        'link' => url('black-list'),
                        'route' => 'user-role',
                    ), 
                ),
            ),
            'manage_users' => array(
                'role' => array('admin'),
                'title' => trans('lang.manage_users'),
                'link' => url('users/patient'),
                'icon' => 'fa fa-user-plus',
                'route' => 'user-role',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
          //add new category
                'locations' => array(
                'role' => array('admin'),
                'title' => trans('lang.locations'),
                'link' => route('locations'),
                'icon' => 'ti-location-pin',
                'route' => 'locations',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
            'roles' => array(
                'role' => array('admin'),
                'title' => trans('Roles'),
                'link' => url('admin/role'),
                'icon' => 'fa fa-group',
                'route' => '',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
               'report' => array(
                'role' => array('admin'),
                'title' => trans('Reports'),
                'link' => url('admin/all-reports'),
                'icon' => 'fa fa-exclamation-triangle',
                'route' => '',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
            'notification_center' => array(
                'role' => array('admin'),
                'title' => trans('lang.push_notifications'),
                'link' => url('admin/notification'),
                'icon' => 'fa fa-bell',
                'route' => 'push-notification',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
            'diseases' => array(
                'role' => array('admin'),
                'title' => trans('lang.diseases'),
                'link' => route('disease'),
                'icon' => 'fa fa-cogs',
                'route' => 'disease',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
                'specialities' => array(
                'role' => array('admin'),
                'title' => trans('lang.specialities'),
                'link' => route('specialities'),
                'icon' => 'fa fa-user-secret',
                'route' => 'specialities',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
               'services' => array(
                'role' => array('admin'),
                'title' => trans('lang.services'),
                'link' => route('services'),
                'icon' => 'fab fa-servicestack',
                'route' => 'services',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
                 'symptom' => array(
                'role' => array('admin'),
                'title' => 'Symptoms',
                'link' => route('symptom'),
                'icon' => 'fa fa-snowflake-o',
                'route' => 'symptom',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
                  'treatments' => array(
                'role' => array('admin'),
                'title' => 'Treatments',
                'link' =>  url('admin/treatments'),
                'icon' => 'fa fa-medkit',
                'route' => 'treatments',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
  
              'faq' => array(
                'role' => array('admin'),
                'title' => trans('Faqs'),
                'link' => url('admin/faq'),
                'icon' => 'fa fa-question-circle',
               // 'route' => 'feedbacks',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ), 
              'Procedures' => array(
                'role' => array('admin'),
                'title' => trans('All Surgeries'),
                'link' => 'javascript:;',
                'icon' => 'fa fa-spinner',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                    array(
                        'title' => trans('Surgeries'),
                        'link' => url('admin/procedure'),
                        'route' => 'procedure',
                    ), array(
                        'title' => trans('Surgeries Estimated Cost'),
                        'link' => url('admin/procedure-cost'),
                        'route' => 'procedure-cost',
                    ), 
                ),
            ),
                
                'facilities' => array(
                'role' => array('admin'),
                'title' => trans('Facilities'),
                'link' => url('admin/facility'),
                'icon' => 'fa fa-archive',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
            'video-blogs' => array(
                'role' => array('admin'),
                'title' => trans('Video Blogs'),
                'link' => url('admin/video-blog'),
                'icon' => 'fa fa-archive',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
                'speciality_test' => array(
                'role' => array('admin'),
                'title' => trans('Speciality Tests'),
                'link' => url('admin/speciality-test'),
                'icon' => 'fa fa-eyedropper',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
                'lab_tests_meta' => array(
                'role' => array('admin'),
                'title' => trans('Lab Tests Meta'),
                'link' => url('admin/lab-tests-meta'),
                'icon' => 'fa fa-eyedropper',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
                'pharmacy' => array(
                'role' => array('admin'),
                'title' => 'Pharmacy',
                'link' => 'javascript:;',
                'icon' => 'fa fa-plus-square',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                    array(
                        'title' => 'Medicine Category',
                        'link' => url('admin/medicine-category'),
                        'route' => 'medicine-category',
                    ),
                    array(
                        'title' => 'Medicine Sub Category',
                        'link' => url('admin/medicine-subcategory'),
                        'route' => 'medicine-subcategory',
                    ),
                    array(
                        'title' => 'Medicines',
                        'link' => url('admin/pharmacy-medicine'),
                        'route' => 'pharmacy-medicine',
                    ),
                ),
            ),
                'diagnose' => array(
                'role' => array('admin'),
                'title' => trans('Diagnosis'),
                'link' => url('admin/diagnose'),
                'icon' => 'fa fa-cog',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
            'feedback' => array(
                'role' => array('admin'),
                'title' => trans('lang.feedback'),
                'link' => url('admin/feedback'),
                'icon' => 'fa fa-commenting',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
            'contacts' => array(
                'role' => array('admin'),
                'title' => trans('Contact Us Users'),
                'link' => url('admin/contact-us-users'),
                'icon' => 'fa fa-compress',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
            'teams' => array(
                'role' => array('admin'),
                'title' => trans('Site Team'),
                'link' => url('admin/site-team'),
                'icon' => 'fa fa-compress',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
             'Demos' => array(
                'role' => array('admin'),
                'title' => trans('All Demo Requests'),
                'link' => 'javascript:;',
                'icon' => 'fa fa-laptop',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                    array(
                        'title' => trans('Doctor Demo Requests'),
                        'link' => url('admin/doctor/demo-request'),
                        'route' => 'demo-request',
                    ), array(
                        'title' => trans('Hospital Demo Requests'),
                        'link' => url('admin/hospital/demo-request'),
                        'route' => 'demo-request',
                    ), array(
                        'title' => trans('Laboratort Demo Requests'),
                        'link' => url('admin/laboratory/demo-request'),
                        'route' => 'demo-request',
                    ),
                ),
            ),
                'vaccination' => array(
                'role' => array('admin'),
                'title' => trans('Vaccinations'),
                'link' => 'javascript:;',
                'icon' => 'fa fa-deaf',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                    array(
                        'title' => trans('Vaccination'),
                        'link' => url('admin/vaccination'),
                        'route' => 'vaccination',
                    ), array(
                        'title' => trans('Vaccination Location'),
                        'link' => url('admin/vaccination-location'),
                        'route' => 'vaccination-location',
                    ), array(
                        'title' => trans('Vaccination Alert'),
                        'link' => url('admin/vaccination-alert'),
                        'route' => 'vaccination-alert',
                    ),
                ),
            ),
                
            'department' => array(
                'role' => array('admin'),
                'title' => trans('Departments'),
                'link' => 'javascript:;',
                'icon' => ' fa fa-building',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                    array(
                        'title' => trans('Department'),
                        'link' => url('admin/department'),
                        'route' => 'department',
                    ), array(
                        'title' => trans('Department Service'),
                        'link' => url('admin/department-service'),
                        'route' => 'department-service',
                    ),
                ),
            ),
                   'affair' => array(
                'role' => array('admin'),
                'title' => trans('Current Affairs'),
                'link' => 'javascript:;',
                'icon' => 'fa fa-pencil-square',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                    array(
                        'title' => trans('Affair'),
                        'link' => route('affairs'),
                        'route' => 'affairs',
                    ), array(
                        'title' => trans('Affair Details'),
                        'link' => route('affair-details'),
                        'route' => 'affair-details',
                    ),
                ),
            ),

            'articles' => array(
                'role' => array('admin'),
                'title' => trans('lang.manage_articles'),
                'link' => 'javascript:;',
                'icon' => 'ti-pencil-alt',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                    array(
                        'title' => trans('lang.create_article'),
                        'link' => route('createArticle'),
                        'route' => 'createArticle',
                    ), array(
                        'title' => trans('lang.article_categories'),
                        'link' => route('categories'),
                        'route' => 'categories',
                    ),
                ),
            ),
            'create_article' => array(
                'role' => array('doctor'),
                'title' => trans('lang.create_article'),
                'link' => route('createArticle'),
                'route' => 'createArticle',
                'icon' => 'ti-pencil-alt',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
               
            ),
            // 'articles' => array(
            //     'role' => array('doctor'),
            //     'title' => trans('lang.manage_articles'),
            //     'link' => 'javascript:;',
            //     'icon' => 'ti-pencil-alt',
            //     'parent_class' => 'menu-item-has-children',
            //     'parent_active' => '',
            //     'child_active' => '',
            //     'childern' => array(
            //         array(
            //             'title' => trans('lang.create_article'),
            //             'link' => route('createArticle'),
            //             'route' => 'createArticle',
            //         ), 
            //     ),
            // ),
            'payouts' => array(
                'role' => array('doctor'),
                'title' => trans('lang.payouts_settings'),
                'link' => route('doctorPayoutsSettings'),
                'icon' => 'ti-money',
                'parent_class' => '',
                'route' => '',
                'parent_active' => '',
                'child_active' => '',
            ),
            'saved_items' => array(
                'role' => array('hospital', 'doctor', 'patient','laboratory'),
                'title' => trans('lang.my_saved_items'),
                'link' => url($auth_role . '/saved-items'),
                'icon' => 'ti-heart',
                'parent_class' => '',
                'route' => '',
                'parent_active' => '',
                'child_active' => '',
            ),
            'doctor_packages' => array(
                'role' => array('doctor'),
                'title' => trans('lang.packages'),
                'link' => route('doctorPackages'),
                'icon' => 'ti-package',
                'parent_class' => '',
                'route' => '',
                'parent_active' => '',
                'child_active' => '',
            ),
            'invoices' => array(
                'role' => array('doctor'),
                'title' => trans('lang.invoices'),
                'link' => route('userInvoices'),
                'icon' => 'ti-file',
                'parent_class' => '',
                'route' => '',
                'parent_active' => '',
                'child_active' => '',
            ),
                'invoices' => array(
                'role' => array('patient'),
                'title' => trans('lang.invoices'),
                'link' => route('userInvoice'),
                'icon' => 'ti-file',
                'parent_class' => '',
                'route' => '',
                'parent_active' => '',
                'child_active' => '',
            ),
            'msgs' => array(
                'role' => array('doctor', 'patient'),
                'title' => trans('lang.inbox'),
                'link' => route('message'),
                'icon' => 'ti-comments',
                'route' => 'message',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
            ),
            // 'account_settings' => array(
            //     'role' => array('doctor', 'hospital', 'patient', 'admin'),
            //     'title' => trans('lang.account_settings'),
            //     'link' => route('accountSettings'),
            //     'icon' => 'ti-key',
            //     'route' => 'accountSettings',
            //     'parent_class' => '',
            //     'parent_active' => '',
            //     'child_active' => '',
            //     'childern' => '',
            // ),
            'email_templates' => array(
                'role' => array('admin'),
                'title' => trans('lang.email_templates'),
                'link' => route('emailTemplates'),
                'icon' => 'ti-email',
                'route' => 'emailTemplates',
                'parent_class' => '',
                'parent_active' => '',
                'child_active' => '',
                'childern' => '',
            ),
            
            // 'packages' => array(
            //     'role' => array('admin'),
            //     'title' => trans('lang.packages'),
            //     'link' => route('createPackage'),
            //     'icon' => 'ti-package',
            //     'parent_class' => '',
            //     'route' => '',
            //     'parent_active' => '',
            //     'child_active' => '',
            // ),
            // 'admin_payouts' => array(
            //     'role' => array('admin'),
            //     'title' => trans('lang.payouts'),
            //     'link' => route('adminPayouts'),
            //     'icon' => 'ti-money',
            //     'parent_class' => '',
            //     'route' => '',
            //     'parent_active' => '',
            //     'child_active' => '',
            // ),
            'settings' => array(
                'role' => array('admin'),
                'title' => trans('lang.settings'),
                'link' => 'javascript:;',
                'icon' => 'ti-home',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                    array(
                        'title' => trans('lang.home_page_settings'),
                        'link' => route('homePageSettings'),
                        'route' => 'homePageSettings',
                    ),
                    array(
                        'title' => trans('lang.general_settings'),
                        'link' => route('generalSettings'),
                        'route' => 'generalSettings',
                    ),
                    array(
                        'role' => array('doctor', 'hospital', 'patient', 'admin', 'laboratory'),
                        'title' => trans('Security settings'),
                        'link' => route('accountSettings'),
                        'route' => 'accountSettings',
                    ),
                    array(
                        'role' => array('doctor', 'hospital', 'patient', 'admin', 'laboratory'),
                        'title' => trans('lang.profile_settings'),
                        'link' => route('profileSettings', ['role_type' => $auth_role]),
                        'route' => 'profileSettings',
                    ), array(
                        'title' => trans('lang.imprv_opts'),
                        'link' => route('improvement-opts'),
                        'route' => 'improvement-opts',
                    ),
                    array(
                        'title' =>trans('lang.create_page'),
                        'link' => url('admin/url'),
                        'route' => '',
                    ),
                ),
            ),
            //   'profile_settings' => array(
            //     'role' => array('doctor', 'hospital', 'patient', 'admin'),
            //     'title' => trans('lang.profile_settings'),
            //     'link' => route('profileSettings', ['role_type' => $auth_role]),
            //     'icon' => 'ti-settings',
            //     'route' => 'profileSettings',
            //     'parent_class' => '',
            //     'parent_active' => '',
            //     'child_active' => '',
            //     'childern' => '',
            // ),
         
            'pages' => array(
                'role' => array('admin'),
                'title' => trans('lang.pages'),
                'link' => 'javascript:;',
                'icon' => 'ti-menu-alt',
                'parent_class' => 'menu-item-has-children',
                'parent_active' => '',
                'child_active' => '',
                'childern' => array(
                    array(
                        'title' => trans('lang.create_page'),
                        'link' => route('createPage'),
                        'route' => 'createPage',
                    ),
                    array(
                        'title' => trans('lang.page_listing'),
                        'link' => route('pages'),
                        'route' => 'pages',
                    ),
                     array(
                        'title' => trans('lang.packages'),
                        'link' => route('createPackage'),
                       // 'route' => 'pages',
                    ),
                      array(
                        'title' => trans('lang.payouts'),
                        'link' => route('adminPayouts'),
                        //'route' => 'pages',
                    ),
                      
                      
                ),
            ),
            
            // 'categories' => array(
            //     'role' => array('admin'),
            //     'title' => trans('lang.taxonomies'),
            //     'link' => 'javascript:;',
            //     'icon' => 'ti-layout-grid2',
            //     'parent_class' => 'menu-item-has-children',
            //     'parent_active' => '',
            //     'child_active' => '',
            //     'childern' => array(
                    // array(
                    //     'title' => trans('lang.locations'),
                    //     'link' => route('locations'),
                    //     'route' => 'locations',
                    // ),
                    // array(
                    //     'title' => trans('lang.article_categories'),
                    //     'link' => route('categories'),
                    //     'route' => 'categories',
                    // ),
                    // array(
                    //     'title' => trans('lang.specialities'),
                    //     'link' => route('specialities'),
                    //     'route' => 'specialities',
                    // ),
                    // array(
                    //     'title' => trans('lang.services'),
                    //     'link' => route('services'),
                    //     'route' => 'services',
                    // ),
                    // array(
                    //     'title' => trans('lang.diseases'),
                    //     'link' => route('disease'),
                    //     'route' => 'disease',
                    // ),
                    // array(
                    //     'title' => trans('lang.imprv_opts'),
                    //     'link' => route('improvement-opts'),
                    //     'route' => 'improvement-opts',
                    // ),
            //     ),
            // ),
        );
        return $menu_items;
    }
    /**
     * Get dashboard menu
     *
     * @param string $type menu type
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function getSideBarMenu($type = '')
    {
        $auth_role = self::getAuthRoleType();
        $items = self::getDashboardList();
        $output = '';
         if (!empty($items)) {
            foreach ($items as $key => $item) {
                if (!empty($item['role'])) {
                    if (is_array($item['role']) && in_array($auth_role, $item['role'])) {
                    $output .= "<li class='nav-item'><a class='nav-link' href='$item[link]'><i class='$item[icon]'></i><span>$item[title]</span></a></li>";
                    }
                }
            }
        }
        echo $output;
    }

    /**
     * Get dashboard menu
     *
     * @param string $type menu type
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function displayDashboardMenu($type = '')
    {
        // dd($type);
        $auth_role = self::getAuthRoleType();
        $items = self::getDashboardList();
        $output = '';
        $hr = $type == 'dashboard' ? '<hr>' : '';
        if (!empty($items)) {
            foreach ($items as $key => $item) {
                if (!empty(Request::route()->getName()) && !empty($item['route']) && $item['route'] == Request::route()->getName()) {
                    $item['parent_active'] = $type == 'dashboard' ? 'dc-open' : '';
                    $item['child_active'] = $type == 'dashboard' ? 'style="display: block;"' : '';
                } elseif (!empty(Request::route()->getName()) && !empty($item['childern'])) {
                    foreach ($item['childern'] as $childkey => $childitem) {
                        if (!empty($childitem['route']) && Request::route()->getName() == $childitem['route']) {
                            $item['parent_active'] = $type == 'dashboard' ? 'dc-open' : '';
                            $item['child_active'] = $type == 'dashboard' ? 'style="display: block;"' : '';
                        }
                    }
                }
                if (!empty($item['role'])) {
                    if (is_array($item['role']) && in_array($auth_role, $item['role'])) {
                        $output .= "<li class='$item[parent_class] $item[parent_active]'>";
                        if (!empty($item['childern'])) {
                            $output .= "<span class='dc-dropdowarrow'><i class='lnr lnr-chevron-right'></i></span>";
                        }
                        $output .= "<a href='$item[link]'>";
                        $output .= "<i class='$item[icon]'></i><span>$item[title]</span>";
                        $output .= "</a>";
                        if (!empty($item['childern'])) {
                            $output .= "<ul class='sub-menu' $item[child_active]>";
                            foreach ($item['childern'] as $child_key => $child_item) {
                                $output .= "<li>$hr<a href='$child_item[link]'>$child_item[title]</a></li>";
                            }
                            $output .= "</ul>";
                        }
                        $output .= "</li>";
                    }
                } else {
                    $output .= "<li class='$item[parent_class] $item[parent_active]'>";
                    if (!empty($item['childern'])) {
                        $output .= "<span class='dc-dropdowarrow'><i class='lnr lnr-chevron-right'></i></span>";
                    }
                    $output .= "<a href='$item[link]'>";
                    $output .= "<i class='$item[icon]'></i><span>$item[title]</span>";
                    $output .= "</a>";
                    if (!empty($item['childern'])) {
                        $output .= "<ul class='sub-menu' $item[child_active]>";
                        foreach ($item['childern'] as $child_key => $child_item) {
                            $output .= "<li>$hr<a href='$child_item[link]'>$child_item[title]</a></li>";
                        }
                        $output .= "</ul>";
                    }
                    $output .= "</li>";
                }
            }
        }
        echo $output;
    }

    /**
     * Get genders array
     *
     * @access public
     *
     * @return array()
     */
    public static function getGenderArray()
    {
        $gender_array = array(
            'male' => trans('lang.male'),
            'female' => trans('lang.female'),
        );

        return $gender_array;
    }

    /**
     * Get doctors array
     *
     * @param string $key key
     * 
     * @access public
     *
     * @return array()
     */
    public static function getDoctorArray($key = "")
    {
        $list = array(
            'mr' => trans('lang.mr'),
            'mrs' => trans('lang.mrs'),
            'dr' => trans('lang.dr'),
            'prof' => trans('lang.prof'),
            'phd' => trans('lang.phd'),
            'mbbs' => trans('lang.mbbs'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
        return $list;
    }

    /**
     * Get location intervals array
     *
     * @param string $key key
     * 
     * @access public
     *
     * @return array()
     */
    public static function getAppointmentIntervals($key = "")
    {
        $list = array(
            '5'    => trans('lang.5_minutes'),
            '10'    => trans('lang.10_minutes'),
            '20'    => trans('lang.20_minutes'),
            '30'    => trans('lang.30_minutes'),
            '60'    => trans('lang.1_hours'),
            '90'    => trans('lang.1_30_hours'),
            '120'    => trans('lang.2_hours'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
        return $list;
    }

    /**
     * Get location intervals array
     *
     * @param string $key key
     * 
     * @access public
     *
     * @return array()
     */
    public static function getAppointmentDuration($key = "")
    {
        $list = array(
            '5'  => trans('lang.5_minutes'),
            '10' => trans('lang.10_minutes'),
            '20' => trans('lang.20_minutes'),
            '30' => trans('lang.30_minutes'),
            '40' => trans('lang.40_minutes'),
            '50' => trans('lang.50_minutes'),
            '60' => trans('lang.60_minutes'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
        return $list;
    }

    /**
     * Get reasons array
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function getReasonsArray()
    {
        $reason_array = array(
            'select' => trans('lang.select_reason_to_leave'),
            'reason1' => trans('lang.reason_1'),
            'reason2' => trans('lang.reason_2'),
        );

        return $reason_array;
    }

    /**
     * Get username
     *
     * @param integer $user_id ID
     *
     * @access public
     *
     * @return array
     */
    public static function getUserName($user_id)
    {
        if (!empty($user_id)) {
            $user = User::find(intVal(clean($user_id)));
            return html_entity_decode(clean($user->first_name . ' ' . $user->last_name));
        } else {
            return '';
        }
    }

    /**
     * Get Notification
     *
     * @param integer $user_id ID
     *
     * @access public
     *
     * @return array
     */
    public static function getAppointmentNotificationById($appointment_id)
    {
        if (!empty($appointment_id)) {
            $notification = DB::table('appointment_notification')->where('appointment_id',$appointment_id)->select('admin_alert')->first();
            $status=$notification->admin_alert;
            return $status;
        } else {
            return '';
        }
    }
 
    /**
     * Get slug
     *
     * @param integer $user_id ID
     *
     * @access public
     *
     * @return array
     */
    public static function getUserSlug($user_id)
    {
        if (!empty($user_id)) {
            $user = User::find($user_id);
            return $user->slug;
        } else {
            return '';
        }
    }

    /**
     * Get home slider
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getHomeSlider($type)
    {
        if (!empty($type)) {
            $home_slides = SiteManagement::getMetaValue('home_slider');
            //$slider_bg_image = SiteManagement::where('meta_key', 'slider_bg_img')->select('meta_value')->pluck('meta_value')->first();
            
            if ($type == 'home_slides') {
                return !empty($home_slides) ? $home_slides : array();
            }
            if ($type == 'slider_bg_image') {
                return !empty($slider_bg_image) ? $slider_bg_image : '';
            }
        } else {
            return '';
        }
    }

    /**
     * Get home search banner
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getSearchBanner($type)
    {
        if (!empty($type)) {
            $home_search_banner = SiteManagement::getMetaValue('home_search_banner');
            $search_form_title = !empty($home_search_banner['search_form_title']) ? $home_search_banner['search_form_title'] : '';
            $search_banner_heading = !empty($home_search_banner['search_banner_heading']) ? $home_search_banner['search_banner_heading'] : '';
            $search_banner_subheading = !empty($home_search_banner['search_banner_subheading']) ? $home_search_banner['search_banner_subheading'] : '';
            $search_banner_btn_title = !empty($home_search_banner['search_banner_btn_title']) ? $home_search_banner['search_banner_btn_title'] : '';
            $search_banner_btn_url = !empty($home_search_banner['search_banner_btn_url']) ? $home_search_banner['search_banner_btn_url'] : '';
            $search_banner_img = !empty($home_search_banner['hidden_search_banner_img']) ? $home_search_banner['hidden_search_banner_img'] : '';
            $show_search_banner = !empty($home_search_banner['show_search_banner']) ? $home_search_banner['show_search_banner'] : '';
            if ($type == 'show_banner') {
                return $show_search_banner;
            }
            if ($type == 'form_title') {
                return $search_form_title;
            }
            if ($type == 'banner_heading') {
                return $search_banner_heading;
            }
            if ($type == 'banner_subheading') {
                return $search_banner_subheading;
            }
            if ($type == 'btn_title') {
                return $search_banner_btn_title;
            }
            if ($type == 'btn_url') {
                return $search_banner_btn_url;
            }
            if ($type == 'banner_img') {
                if (!empty($search_banner_img)) {
                    return $search_banner_img;
                }
            }
        } else {
            return '';
        }
    }

    /**
     * Get home services tabs
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getServicesSection($type)
    {
        if (!empty($type)) {
            $services_tabs = SiteManagement::getMetaValue('services_tab_sec');
            $show_services_section = SiteManagement::where('meta_key', 'show_services_section')->select('meta_value')->pluck('meta_value')->first();
            if ($type == 'services_tabs') {
                return $services_tabs;
            }
            if ($type == 'show_services_section') {
                return $show_services_section;
            }
        } else {
            return '';
        }
    }

    /**
     * Get home about us section
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getAboutUsSection($type)
    {
        if (!empty($type)) {
            $about_us_sec = SiteManagement::getMetaValue('home_about_us_sec');
            $show_about_sec = !empty($about_us_sec['show_about_sec']) ? $about_us_sec['show_about_sec'] : '';
            $title = !empty($about_us_sec['title']) ? $about_us_sec['title'] : '';
            $subtitle = !empty($about_us_sec['subtitle']) ? $about_us_sec['subtitle'] : '';
            $description = !empty($about_us_sec['description']) ? $about_us_sec['description'] : '';
            $btn_one_title = !empty($about_us_sec['btn_one_title']) ? $about_us_sec['btn_one_title'] : '';
            $btn_one_url = !empty($about_us_sec['btn_one_url']) ? $about_us_sec['btn_one_url'] : '';
            $btn_two_title = !empty($about_us_sec['btn_two_title']) ? $about_us_sec['btn_two_title'] : '';
            $btn_two_url = !empty($about_us_sec['btn_two_url']) ? $about_us_sec['btn_two_url'] : '';
            $about_us_img = !empty($about_us_sec['hidden_about_us_img']) ? $about_us_sec['hidden_about_us_img'] : '';
            $img_title = !empty($about_us_sec['img_title']) ? $about_us_sec['img_title'] : '';
            $img_subtitle = !empty($about_us_sec['img_subtitle']) ? $about_us_sec['img_subtitle'] : '';
            if ($type == 'show_about_sec') {
                return $show_about_sec;
            }
            if ($type == 'title') {
                return $title;
            }
            if ($type == 'subtitle') {
                return $subtitle;
            }
            if ($type == 'description') {
                return $description;
            }
            if ($type == 'btn_one_title') {
                return $btn_one_title;
            }
            if ($type == 'btn_one_url') {
                return $btn_one_url;
            }
            if ($type == 'btn_two_title') {
                return $btn_two_title;
            }
            if ($type == 'btn_two_url') {
                return $btn_two_url;
            }
            if ($type == 'about_us_img') {
                return $about_us_img;
            }
            if ($type == 'img_title') {
                return $img_title;
            }
            if ($type == 'img_subtitle') {
                return $img_subtitle;
            }
        } else {
            return '';
        }
    }

    /**
     * Get home how it works section
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getHowItWorksSection($type)
    {
        if (!empty($type)) {
            $how_works_sec = SiteManagement::getMetaValue('home_how_works_sec');
            $how_works_tabs = SiteManagement::getMetaValue('how_work_tabs');
            $show_how_work_sec = !empty($how_works_sec['show_how_work_sec']) ? $how_works_sec['show_how_work_sec'] : '';
            $show_how_work_tabs = SiteManagement::where('meta_key', 'show_how_work_tabs')->select('meta_value')->pluck('meta_value')->first();
            $title = !empty($how_works_sec['title']) ? $how_works_sec['title'] : '';
            $subtitle = !empty($how_works_sec['subtitle']) ? $how_works_sec['subtitle'] : '';
            $description = !empty($how_works_sec['hw_desc']) ? $how_works_sec['hw_desc'] : '';
            if ($type == 'show_how_work_sec') {
                return $show_how_work_sec;
            }
            if ($type == 'title') {
                return $title;
            }
            if ($type == 'subtitle') {
                return $subtitle;
            }
            if ($type == 'description') {
                return $description;
            }
            if ($type == 'how_works_tabs') {
                return $how_works_tabs;
            }
            if ($type == 'show_how_work_tabs') {
                return $show_how_work_tabs;
            }
        } else {
            return '';
        }
    }

    /**
     * Get download app section
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getDownloadAppSection($type)
    {
        if (!empty($type)) {
            $dwnld_app_sec = SiteManagement::getMetaValue('download_app_sec');
            $show_app_sec = !empty($dwnld_app_sec->show_app_sec) ? $dwnld_app_sec->show_app_sec : '';
            $title = !empty($dwnld_app_sec->title) ? $dwnld_app_sec->title : '';
            $subtitle = !empty($dwnld_app_sec->subtitle) ? $dwnld_app_sec->subtitle : '';
            $description = !empty($dwnld_app_sec->description) ? $dwnld_app_sec->description : '';
            $app_sec_img = !empty($dwnld_app_sec->app_sec_img) ? $dwnld_app_sec->app_sec_img : '';
            $android_url = !empty($dwnld_app_sec->android_url) ? $dwnld_app_sec->android_url : '';
            $android_img = !empty($dwnld_app_sec->android_img) ? $dwnld_app_sec->android_img : '';
            $ios_url = !empty($dwnld_app_sec->ios_url) ? $dwnld_app_sec->ios_url : '';
            $ios_img = !empty($dwnld_app_sec->ios_img) ? $dwnld_app_sec->ios_img : '';
            if ($type == 'show_app_sec') {
                return $show_app_sec;
            }
            if ($type == 'title') {
                return $title;
            }
            if ($type == 'subtitle') {
                return $subtitle;
            }
            if ($type == 'description') {
                return $description;
            }
            if ($type == 'app_sec_img') {
                return $app_sec_img;
            }
            if ($type == 'android_url') {
                return $android_url;
            }
            if ($type == 'android_img') {
                return $android_img;
            }
            if ($type == 'ios_url') {
                return $ios_url;
            }
            if ($type == 'ios_img') {
                return $ios_img;
            }
        } else {
            return '';
        }
    }

    /**
     * Get general settings
     *
     * @param string $type type
     * 
     * @access public
     *
     * @return string
     */
    public static function getGeneralSettings($type)
    {

        if (!empty($type)) {
            $settings = array();
            $settings = SiteManagement::getMetaValue('general_settings');
            if (!($settings==null)) {
            $site_logo = self::getImage('uploads/settings/general', $settings->site_logo, '', 'logo.png');
            $site_favicon = self::getImage('uploads/settings/general', $settings->site_favicon, '', 'favicon.png');
             if ($type === 'site_logo') {
                return $site_logo;
            }
            if ($type === 'site_favicon') {
                return $site_favicon;
            }
            }
        } 
    }

    /**
     * Get topbar settings
     *
     * @param string $type type
     * 
     * @access public
     *
     * @return string
     */
    public static function getTopBarSettings($type)
    {
        if (!empty($type)) {
            $settings = array();
            $settings = SiteManagement::getMetaValue('topbar_settings');
            $enable_socials = !empty($settings) ? $settings->enable_social_icons : '';
            $enable_topbar = !empty($settings) ? $settings->enable_topbar : '';
            $title = !empty($settings) ? $settings->title : '';
            $number = !empty($settings) ? $settings->number : '';
            if ($type === 'enable_socials') {
                return $enable_socials;
            }
            if ($type === 'enable_topbar') {
                return $enable_topbar;
            }
            if ($type === 'title') {
                return $title;
            }
            if ($type === 'number') {
                return $number;
            }
        } else {
            return '';
        }
    }

    /**
     * Get social media data
     *
     * @access public
     *
     * @return array
     */
    public static function getSocialData()
    {
        $social = array(
            'facebook' => array(
                'title' => trans('lang.socials.fb'),
                'color' => '#3b5999',
                'icon' => 'fa fa-facebook',
            ),
            'twitter' => array(
                'title' => trans('lang.socials.twitter'),
                'color' => '#55acee',
                'icon' => 'fa fa-twitter',
            ),
            'linkedin' => array(
                'title' => trans('lang.socials.linkedin'),
                'color' => '#0077B5',
                'icon' => 'fa fa-linkedin',
            ),
            'googleplus' => array(
                'title' => trans('lang.socials.gplus'),
                'color' => '#dd4b39',
                'icon' => 'fa fa-google-plus',
            ),
            'rss' => array(
                'title' => trans('lang.socials.rss'),
                'color' => '#ff6600',
                'icon' => 'fas fa-rss',
            ),
            'youtube' => array(
                'title' => trans('lang.socials.youtube'),
                'color' => '#0077B5',
                'icon' => 'fab fa-youtube',
            ),
            'instagram' => array(
                'title' => trans('Instagram'),
                'color' => '#0077B5',
                'icon' => 'fa fa-instagram',
            ),

        );
        return $social;
    }

    /**
     * Display socials
     *
     * @param string $type type
     * 
     * @access public
     *
     * @return array
     */
    public static function displaySocials($type)
    {
        $output = "";
        $social_array = SiteManagement::getMetaValue('socials');
        $social_list = self::getSocialData();
        $class = '';
        if ($type === 'topbar') {
            $class = 'dc-socialiconsborder';
        } else {
            $class = '';
        }
        if (!empty($social_array)) {
            $output .= "<ul class='dc-simplesocialicons " . $class . "'>";
            foreach ($social_array as $social) {

                if (array_key_exists($social->title, $social_list)) {
                    $socialList = $social_list[$social->title];
                   
                    $output .= "<li class='dc-{$social->title}'><a href = '" . $social->url . "'><i class='{$socialList['icon']}' ></i></a></li>";
                }
            }
            $output .= "</ul>";
        }
        echo $output;
    }

    /**
     * Get footer settings
     *
     * @param string $type footer setting type
     *
     * @access public
     *
     * @return string
     */
    public static function getFooterSettings($type)
    {
        if (!empty($type)) {
            $settings = array();
            $settings = SiteManagement::getMetaValue('footer_settings');
            $show_contact_info_sec = !empty($settings) ? $settings->show_contact_info_sec : '';
            $c_info_img_one = !empty($settings) ? $settings->c_info_img_one : '';
            $c_info_title_one = !empty($settings) ? $settings->c_info_title_one : '';
            $c_info_number = !empty($settings) ? $settings->c_info_number : '';
            $c_info_img_two = !empty($settings) ? $settings->c_info_img_two : '';
            $c_info_title_two = !empty($settings) ? $settings->c_info_title_two : '';
            $c_info_email = !empty($settings) ? $settings->c_info_email : '';
            if (!empty($settings->footer_logo)) {
            $footer_logo = self::getImage('uploads/settings/general/footer', $settings->footer_logo, '', 'flogo.png');
        }else{
            return '';
        }
            $footer_about_us_note = !empty($settings) ? $settings->about_us_note : '';
            $footer_address = !empty($settings) ? $settings->address : '';
            $footer_email = !empty($settings) ? $settings->email : '';
            $footer_phone = !empty($settings) ? $settings->phone : '';
            $show_footer_socials = !empty($settings) ? $settings->enable_footer_socials : '';
            $footer_copyright = !empty($settings) ? $settings->copyright : '';
            $menu_one_title = !empty($settings) && !empty($settings->menu_one_title) ? $settings->menu_one_title : trans('lang.by_specialty');
            $menu_two_title = !empty($settings) && !empty($settings->menu_two_title) ? $settings->menu_two_title : trans('lang.by_us');
            $menu_three_title = !empty($settings) && !empty($settings->menu_three_title) ? $settings->menu_three_title : trans('lang.by_india');
            $menu_four_title = !empty($settings) && !empty($settings->menu_four_title) ? $settings->menu_four_title : trans('lang.by_location');
            $footer_first_location = !empty($settings) && !empty($settings->first_location) ? $settings->first_location : 'united-states';
            $footer_second_location = !empty($settings) && !empty($settings->second_location) ? $settings->second_location : 'india';
            if ($type === 'first_menu_title') {
                return $menu_one_title;
            }
            if ($type === 'second_menu_title') {
                return $menu_two_title;
            }
            if ($type === 'third_menu_title') {
                return $menu_three_title;
            }
            if ($type === 'fourth_menu_title') {
                return $menu_four_title;
            }
            if ($type === 'second_menu_location') {
                return $footer_first_location;
            }
            if ($type === 'third_menu_location') {
                return $footer_second_location;
            }
            if ($type === 'show_contact_info_sec') {
                return $show_contact_info_sec;
            }
            if ($type === 'contact_info_img_one') {
                return $c_info_img_one;
            }
            if ($type === 'contact_info_title_one') {
                return $c_info_title_one;
            }
            if ($type === 'contact_info_number') {
                return $c_info_number;
            }
            if ($type === 'contact_info_img_two') {
                return $c_info_img_two;
            }
            if ($type === 'contact_info_title_two') {
                return $c_info_title_two;
            }
            if ($type === 'contact_info_email') {
                return $c_info_email;
            }
            if ($type === 'footer_logo') {
                return $footer_logo;
            }
            else{
                return '';
            }
            if ($type === 'footer_about_us_note') {
                return $footer_about_us_note;
            }
            if ($type === 'footer_address') {
                return $footer_address;
            }
            if ($type === 'footer_phone') {
                return $footer_phone;
            }
            if ($type === 'footer_email') {
                return $footer_email;
            }
            if ($type === 'show_footer_socials') {
                return $show_footer_socials;
            }
            if ($type === 'footer_copyright') {
                return $footer_copyright;
            }
        } else {
            return '';
        }
    }

    /**
     * Get unserialize data
     *
     * @param array $data data
     *
     * @access public
     *
     * @return array
     */
    public static function getUnserializeData($data)
    {
        if (!empty($data)) {
            $fixed_data = preg_replace_callback(
                '!s:(\d+):"(.*?)";!',
                function ($match) {
                    return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
                },
                $data
            );
            return unserialize($fixed_data);
        } else {
            return '';
        }
    }

    /**
     * Format file name
     *
     * @param string $file_name filename
     *
     * @return \Illuminate\Http\Response
     */
    public static function formateFileName($file_name)
    {
        if (!empty($file_name)) {
            $file =  strstr($file_name, '-');
            if ($file == true) {
                return substr($file, 1);
            } else {
                return $file_name;
            }
        } else {
            return '';
        }
    }

    /**
     * Format file size
     *
     * @param integer $bytes bytes
     *
     * @return \Illuminate\Http\Response
     */
    public static function formateFileSize($bytes)
    {
        if (!empty($bytes)) {
            $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
            for ($i = 0; $bytes > 1024; $i++) {
                $bytes /= 1024;
            }
            return round($bytes, 2) . ' ' . $units[$i];
        } else {
            return '';
        }
    }

    /**
     * Get file size and name
     *
     * @param string $file file
     * @param string $type type
     * @param string $path path
     *
     * @return \Illuminate\Http\Response
     */
    public static function getImageDetail($file, $type, $path = '')
{
    if (!empty($file) && !empty($path)) {
        $disk = (env('FILESYSTEM_DRIVER') == 'production') ? 's3' : 'local';

        if ($type === 'size') {
            $filePath = $path . '/' . $file;

            if (Storage::disk($disk)->exists($filePath)) {
                return self::formateFileSize(Storage::disk($disk)->getSize($filePath));
            } else {
                return 0;
            }
        } elseif ($type === 'name') {
            return self::formateFileName($file);
        } else {
            return '';
        }
    } else {
        return '';
    }
}


    /**
     * Get Delete Acc Reasons
     *
     * @param string $key key
     * 
     * @access public
     *
     * @return array
     */
    public static function getDeleteAccReason($key = "")
    {
        $list = array(
            'not_satisfied' => trans('lang.del_acc_reason.not_satisfied'),
            'not_good_support' => trans('lang.del_acc_reason.no_good_supp'),
            'Others' => trans('lang.del_acc_reason.others'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get general settings
     *
     * @param string $type type
     * 
     * @access public
     *
     * @return string
     */
    public static function getArticleSectionSettings($type)
    {
        if (!empty($type)) {
            $settings = array();
            $settings = SiteManagement::getMetaValue('article_section');
            $article_sec_title = !empty($settings['title']) ? $settings['title'] : '';
            $article_sec_subtitle = !empty($settings['subtitle']) ? $settings['subtitle'] : '';
            $article_sec_desc = !empty($settings['description']) ? $settings['description'] : '';
            $show_article_sec = !empty($settings['show_article_sec']) ? $settings['show_article_sec'] : '';
            if ($type === 'section_title') {
                return $article_sec_title;
            }
            if ($type === 'section_subtitle') {
                return $article_sec_subtitle;
            }
            if ($type === 'section_description') {
                return $article_sec_desc;
            }
            if ($type === 'show_article_sec') {
                return $show_article_sec;
            }
        } else {
            return '';
        }
    }

    /**
     * Get specific speciality
     *
     * @param int $speciality_id speciality_id
     * 
     * @access public
     *
     * @return array
     */
    public static function getSpecialityByID($speciality_id)
    {
        if (!empty($speciality_id)) {
            $speciality = Speciality::find($speciality_id);
            return !empty($speciality) ? $speciality : '';
        } else {
            return '';
        }
    }

     /**
     * Get  speciality
     *
     * 
     * @access public
     *
     * @return array
     */
    public static function getSpecialities()
    {
        
           // $speciality = Speciality::get();
         $speciality =   DB::table('specialities')->orderBy("created_at","desc")->where("top",1)->limit(8)->get();
        if (!empty($speciality)) {
            return !empty($speciality) ? $speciality : '';
        } else {
            return '';
        }
    }

     public static function getCurrentAffairs()
    {
         $affairs =   \App\Affairs::with('affairdetails')->latest()->where("status",1)->limit(1)->get();
        // $affairDetails = AffairDetail::with('affairs')->get();
         //dd($affairs);
        if (!empty($affairs)) {
            return !empty($affairs) ? $affairs : '';
        } else {
            return '';
        }
    }


    public static function gettrending()
    {
          $Disease =   collect(Disease::where('trending','>','0')->get());
          $Speciality = collect(Speciality::where('trending','>','0')->get());
          $Service = collect(Service::where('trending','>','0')->get());

          $trending = $Speciality->merge($Service)->merge($Disease);
          $trending1 = $trending->sortByDesc('trending');
          
          return $trending1;
        
    }
public static function getPatientsFeedback()
    {

         $feedback =   DB::table('feedbacks')->latest()->where("approval",1)->limit(12)->get();

        if (!empty($feedback)) {
            return !empty($feedback) ? $feedback : '';
        } else {
            return '';
        }
        
    }
  // public static function getUserData($user_id)
  //   {
  //       if (!empty($user_id)) {
  //           $user = User::find(intVal(clean($user_id)));
  //            $fullname = html_entity_decode(clean($user->first_name . ' ' . $user->last_name));
  //           return $fullname;
  //       } else {
  //           return '';
  //       }
  //   }
    public static function getUserData($user_id)
{
    if (!empty($user_id)) {
        $user = User::find(intVal(clean($user_id)));

        if ($user) {
            $fullname = html_entity_decode(clean($user->first_name . ' ' . $user->last_name));
            return $fullname;
        } else {
            return ''; // User not found, return empty string or handle as needed
        }
    } else {
        return '';
    }
}

    public static function getUserPhonumber($user_id)
    {
        if (!empty($user_id)) {
            $user = User::find(intVal(clean($user_id)));
             $phone_number = $user->phone_number;
            return $phone_number;
        } else {
            return '';
        }
    }
      public static function getDoctorProfile($user_id)
    {
        if (!empty($user_id)) {
            $user = User::find(intVal(clean($user_id)));
             $slug = html_entity_decode(clean($user->slug));
            return $slug;
        } else {
            return '';
        }
    }
    public static function getDoctors(){
         $location =   DB::table('locations')->orderBy("id","desc")->where("top",1)->limit(6)->get();
        if (!empty($location)) {
            return !empty($location) ? $location : '';
        } else {
            return '';
        }
    }
      public static function getHospitals(){
         $hospital =   DB::table('locations')->orderBy("created_at","desc")->where("top",1)->limit(6)->get();
        if (!empty($hospital)) {
            return !empty($hospital) ? $hospital : '';
        } else {
            return '';
        }
    }
      public static function getHospitalss(){
         $hospital =   DB::table('locations')->orderBy("created_at","desc")->where("top",1)->limit(5)->get();
        if (!empty($hospital)) {
            return !empty($hospital) ? $hospital : '';
        } else {
            return '';
        }
    }
    public static function getAllDoctors(){
         $location =   DB::table('locations')->orderBy("id","desc")->where("top",1)->get();
        if (!empty($location)) {
            return !empty($location) ? $location : '';
        } else {
            return '';
        }
    }
    public static function getAllSpecialities()
    {
         $speciality =   DB::table('specialities')->orderBy("id","desc")->where("top",1)->get();
        if (!empty($speciality)) {
            return !empty($speciality) ? $speciality : '';
        } else {
            return '';
        }
    }
      public static function getAllLaboratory()
    {
        $laboratories = User::role('laboratory')->with('profile')->with('specialities')->with('feedbacks')->with('services')->with('location')->with('diseases')->get();
        if (!empty($laboratories)) {
            return !empty($laboratories) ? $laboratories : '';
        } else {
            return '';
        }
    }
       public static function getLabProfile($user_id)
    {
        if (!empty($user_id)) {
            $user = User::find(intVal(clean($user_id)));
             $slug = html_entity_decode(clean($user->slug));
            return $slug;
        } else {
            return '';
        }
    }
    /**
     * Get specific service
     *
     * @param int $service_id service_id
     * 
     * @access public
     *
     * @return array
     */
    public static function getServiceByID($service_id)
    {
        if (!empty($service_id)) {
            $service = Service::find($service_id);
            return !empty($service) ? $service : '';
        } else {
            return '';
        }
    }

    /**
     * Get location intervals array
     *
     * @param string $key key
     * 
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function getAppointmentSpaces($key = "")
    {
        $list = array(
            '1' => array(
                'value' => 1,
            ),
            '2' => array(
                'value' => 2,
            ),
            '3' => array(
                'value' => 3,
            ),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
        return $list;
    }

    /**
     * Get appointment days list
     *
     * @param string $key key
     * 
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public static function getAppointmentDays($key = "")
    {
        $list = array(
            'mon' => array(
                'title' => 'Mon',  
                'name' => trans('lang.monday'),
            ),
            'tue' => array(
                'title' => 'Tue',
                'name' => trans('lang.tuesday'),
            ),
            'wed' => array(
                'title' => 'Wed',
                'name' => trans('lang.wednesday'),
            ),

            'thu' => array(
                'title' => 'Thu',
                'name' => trans('lang.thursday'),
            ),
            'fri' => array(
                'title' => 'Fri',
                'name' => trans('lang.friday')
            ),
            'sat' => array(
                'title' => 'Sat',
                'name' => trans('lang.saturday'),
            ),
            'sun' => array(
                'title' => 'Sun',
                'name' => trans('lang.sunday'),
            ),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
        return $list;
    }

    /**
     * Custom paginator
     *
     * @param mixed $request        $request        attributes
     * @param array $values         $values         array values to be paginated
     * @param mixed $posts_per_page $posts_per_page posts to show per page
     *
     * @return $items
     */
    public static function customPaginator($request, $values = array(), $posts_per_page = '5')
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($values);
        $perPage = intval($posts_per_page);
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $items = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $items->setPath($request->url());
        return $items;
    }

    /**
     * Email Content
     *
     * @access public
     *
     * @return array
     */
    public static function getEmailContent()
    {
        $output = "";
        $output .= "Hello!<br/>";
        $output .= "A new appointment location has been added.<br/>";
        $output .= '<ul style="margin: 0; width: 100%; float: left; list-style: none; font-size: 14px; line-height: 20px; padding: 0 0 15px; font-family: "Work Sans", Arial, Helvetica, sans-serif;">';
        $output .= '<li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">"Start Time"</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><strong>%starttime%</strong></span></li>
        <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">"End Time"</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;"><strong>%endtime%</strong></span></li>
        <li style="width: 100%; float: left; line-height: inherit; list-style-type: none;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">"Appointment Intervals"</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%appt_intervals%</span></li>
        <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">"Appointment Duration"</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%appt_duration%</span></li>
        <li style="width: 100%; float: left; line-height: inherit; list-style-type: none; background: #f7f7f7;"><strong style="width: 50%; float: left; padding: 10px; color: #333; font-weight: 400; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">"Appointment Days"</strong> <span style="width: 50%; float: left; padding: 10px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">%appt_days%</span></li>
        </ul>';
        $output .= "%signature%";
        return $output;
    }

    /**
     * Check User Verification
     *
     * @param int     $user_id user_id
     * @param boolean $tooltip tooltip
     * @param string  $text    text
     * 
     * @access public
     *
     * @return array
     */
    public static function verifyUser($user_id, $tooltip = true, $text = '')
    {
        $text = trans('lang.verified_user');
        if (!empty($user_id)) {
            $tooltip_text = '';
            $class = '';
            if ($tooltip == true) {
                $tooltip_text = '<em>' . clean($text) . '</em>';
                $class        = 'dc-awardtooltip';
            }
            $verified_user = User::select('user_verified')->where('id', intval($user_id))->pluck('user_verified')->first();
            if (!empty($verified_user) && $verified_user == 1) {
                echo '<i class="far fa-check-circle dc-tipso" data-tipso="' . $tooltip_text . '"></i>';
            } else {
                return;
            }
        } else {
            return '';
        }
    }

    /**
     * Check Medical Verification
     *
     * @param int     $user_id user_id
     * @param boolean $tooltip tooltip
     * @param string  $text    text
     * 
     * @access public
     *
     * @return array
     */
    public static function verifyMedical($user_id, $tooltip = true, $text = 'Medical Registration Verified')
    {
        if (!empty($user_id)) {
            $tooltip_text = '';
            $class = '';
            if ($tooltip == true) {
                $tooltip_text = '<em>' . $text . '</em>';
                $class        = 'dc-awardtooltip';
            }
            $user = User::findOrFail($user_id);
            $verified_medical = !empty($user->profile) && !empty($user->profile->verify_registration) ? $user->profile->verify_registration : '';
            if (!empty($verified_medical) && $verified_medical == 1) {
                echo '<i class="icon-sheild dc-tipso" data-tipso="' . $tooltip_text . '"></i>';
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    /**
     * Language list
     *
     * @param string $lang lang
     *
     * @access public
     *
     * @return array
     */
    public static function getTranslatedLang($lang = "")
    {
        $languages = array(
            'en' => array(
                'code' => 'en',
                'title' => 'English',
            ),
            'de' => array(
                'code' => 'de',
                'title' => 'German',
            ),
            'tr' => array(
                'code' => 'tr',
                'title' => 'Turkish',
            ),
            'es' => array(
                'code' => 'es',
                'title' => 'Spanish',
            ),
            'pt' => array(
                'code' => 'pt',
                'title' => 'Portuguese',
            ),
            'zh' => array(
                'code' => 'zh',
                'title' => 'Chinese',
            ),
            'bn' => array(
                'code' => 'bn',
                'title' => 'Bengali',
            ),
            'fr' => array(
                'code' => 'fr',
                'title' => 'French',
            ),
            'ru' => array(
                'code' => 'ru',
                'title' => 'Russian',
            ),
            'UK' => array(
                'code' => 'UK',
                'title' => 'Ukrainian',
            ),
            'ja' => array(
                'code' => 'ja',
                'title' => 'Japanese',
            ),
            'ur' => array(
                'code' => 'ur',
                'title' => 'Urdu',
            ),
        );

        if (!empty($lang) && array_key_exists($lang, $languages)) {
            return $languages[$lang];
        } else {
            return $languages;
        }
    }

    /**
     * Get google map api key
     *
     * @access public
     *
     * @return array
     */
    public static function getGoogleMapApiKey()
    {
        $settings =  SiteManagement::getMetaValue('general_settings');
        if (!empty($settings) && !empty($settings->gmap_api_key)) {
            return $settings->gmap_api_key;
        } else {
            return '';
        }
    }

    /**
     * Get dashboard icon list
     *
     * @param string $icon icon
     *
     * @access public
     *
     * @return array
     */
    public static function getIconList($icon = "")
    {
        $icons = array(
            'latest_appointments' => array(
                'value' => 'latest_appointments',
                'title' => trans('lang.latest_appointments'),
            ),
            'package_expiry' => array(
                'value' => 'package_expiry',
                'title' => trans('lang.pkg_expiry'),
            ),
            'new_message' => array(
                'value' => 'new_message',
                'title' => trans('lang.new_msgs'),
            ),
            'saved_item' => array(
                'value' => 'saved_item',
                'title' => trans('lang.save_items'),
            ),
            'available_balance' => array(
                'value' => 'available_balance',
                'title' => trans('lang.available_balance'),
            ),
            'total_posted_articles' => array(
                'value' => 'total_posted_articles',
                'title' => trans('lang.total_posted_articles'),
            ),
            'check_invoices' => array(
                'value' => 'check_invoices',
                'title' => trans('lang.check_invoices'),
            ),
            'latest_recieved_booking' => array(
                'value' => 'latest_recieved_booking',
                'title' => trans('lang.latest_recieved_booking'),
            ),
            'submit_articles' => array(
                'value' => 'submit_articles',
                'title' => trans('lang.submit_articles'),
            ),
            'manage_teams' => array(
                'value' => 'manage_teams',
                'title' => trans('lang.manage_teams'),
            ),
            'manage_specialities_services' => array(
                'value' => 'manage_specialities_services',
                'title' => trans('lang.manage_specialities_services'),
            ),
            'doctor_image' => array(
                'value' => 'doctor_image',
                'title' => trans('lang.saved_doctor_image'),
            ),
            'hospital_image' => array(
                'value' => 'hospital_image',
                'title' => trans('lang.saved_hospital_image'),
            ),
        );
        if (!empty($icon) && array_key_exists($icon, $icons)) {
            return $icons[$icon];
        } else {
            return $icons;
        }
    }

    /**
     * Currency list
     *
     * @param string $code code
     *
     * @access public
     *
     * @return array
     */
    public static function currencyList($code = "")
    {
        $currency_array = array(
            'USD' => array(
                'numeric_code'  => 840,
                'code'          => 'USD',
                'name'          => 'United States dollar',
                'symbol'        => '$',
                'fraction_name' => 'Cent[D]',
                'decimals'      => 2
            ),
            'AUD' => array(
                'numeric_code'  => 36,
                'code'          => 'AUD',
                'name'          => 'Australian dollar',
                'symbol'        => '$',
                'fraction_name' => 'Cent',
                'decimals'      => 2
            ),
            'BRL' => array(
                'numeric_code'  => 986,
                'code'          => 'BRL',
                'name'          => 'Brazilian real',
                'symbol'        => 'R$',
                'fraction_name' => 'Centavo',
                'decimals'      => 2
            ),
            'CAD' => array(
                'numeric_code'  => 124,
                'code'          => 'CAD',
                'name'          => 'Canadian dollar',
                'symbol'        => '$',
                'fraction_name' => 'Cent',
                'decimals'      => 2
            ),
            'CZK' => array(
                'numeric_code'  => 203,
                'code'          => 'CZK',
                'name'          => 'Czech koruna',
                'symbol'        => 'Kc',
                'fraction_name' => 'Halér',
                'decimals'      => 2
            ),
            'DKK' => array(
                'numeric_code'  => 208,
                'code'          => 'DKK',
                'name'          => 'Danish krone',
                'symbol'        => 'kr',
                'fraction_name' => 'Øre',
                'decimals'      => 2
            ),
            'EUR' => array(
                'numeric_code'  => 978,
                'code'          => 'EUR',
                'name'          => 'Euro',
                'symbol'        => '€',
                'fraction_name' => 'Cent',
                'decimals'      => 2
            ),
            'HKD' => array(
                'numeric_code'  => 344,
                'code'          => 'HKD',
                'name'          => 'Hong Kong dollar',
                'symbol'        => '$',
                'fraction_name' => 'Cent',
                'decimals'      => 2
            ),
            'HUF' => array(
                'numeric_code'  => 348,
                'code'          => 'HUF',
                'name'          => 'Hungarian forint',
                'symbol'        => 'Ft',
                'fraction_name' => 'Fillér',
                'decimals'      => 2
            ),
            'ILS' => array(
                'numeric_code'  => 376,
                'code'          => 'ILS',
                'name'          => 'Israeli new sheqel',
                'symbol'        => '?',
                'fraction_name' => 'Agora',
                'decimals'      => 2
            ),
            'INR' => array(
                'numeric_code'  => 356,
                'code'          => 'INR',
                'name'          => 'Indian rupee',
                'symbol'        => 'INR',
                'fraction_name' => 'Paisa',
                'decimals'      => 2
            ),
               'Rs' => array(
                'numeric_code'  => 586,
                'code'          => 'Rs',
                'name'          => 'Pakistan rupee',
                'symbol'        => 'Rs',
                'fraction_name' => 'Paisa',
                'decimals'      => 2
            ),
            'JPY' => array(
                'numeric_code'  => 392,
                'code'          => 'JPY',
                'name'          => 'Japanese yen',
                'symbol'        => '¥',
                'fraction_name' => 'Sen[G]',
                'decimals'      => 2
            ),
            'MYR' => array(
                'numeric_code'  => 458,
                'code'          => 'MYR',
                'name'          => 'Malaysian ringgit',
                'symbol'        => 'RM',
                'fraction_name' => 'Sen',
                'decimals'      => 2
            ),
            'MXN' => array(
                'numeric_code'  => 484,
                'code'          => 'MXN',
                'name'          => 'Mexican peso',
                'symbol'        => '$',
                'fraction_name' => 'Centavo',
                'decimals'      => 2
            ),
            'NOK' => array(
                'numeric_code'  => 578,
                'code'          => 'NOK',
                'name'          => 'Norwegian krone',
                'symbol'        => 'kr',
                'fraction_name' => 'Øre',
                'decimals'      => 2
            ),
            'NZD' => array(
                'numeric_code'  => 554,
                'code'          => 'NZD',
                'name'          => 'New Zealand dollar',
                'symbol'        => '$',
                'fraction_name' => 'Cent',
                'decimals'      => 2
            ),
            'PHP' => array(
                'numeric_code'  => 608,
                'code'          => 'PHP',
                'name'          => 'Philippine peso',
                'symbol'        => 'PHP',
                'fraction_name' => 'Centavo',
                'decimals'      => 2
            ),
            'PLN' => array(
                'numeric_code'  => 985,
                'code'          => 'PLN',
                'name'          => 'Polish zloty',
                'symbol'        => 'zl',
                'fraction_name' => 'Grosz',
                'decimals'      => 2
            ),
            'GBP' => array(
                'numeric_code'  => 826,
                'code'          => 'GBP',
                'name'          => 'British pound[C]',
                'symbol'        => '£',
                'fraction_name' => 'Penny',
                'decimals'      => 2
            ),
            'SGD' => array(
                'numeric_code'  => 702,
                'code'          => 'SGD',
                'name'          => 'Singapore dollar',
                'symbol'        => '$',
                'fraction_name' => 'Cent',
                'decimals'      => 2
            ),
            'SEK' => array(
                'numeric_code'  => 752,
                'code'          => 'SEK',
                'name'          => 'Swedish krona',
                'symbol'        => 'kr',
                'fraction_name' => 'Öre',
                'decimals'      => 2
            ),
            'CHF' => array(
                'numeric_code'  => 756,
                'code'          => 'CHF',
                'name'          => 'Swiss franc',
                'symbol'        => 'Fr',
                'fraction_name' => 'Rappen[I]',
                'decimals'      => 2
            ),
            'TWD' => array(
                'numeric_code'  => 901,
                'code'          => 'TWD',
                'name'          => 'New Taiwan dollar',
                'symbol'        => '$',
                'fraction_name' => 'Cent',
                'decimals'      => 2
            ),
            'THB' => array(
                'numeric_code'  => 764,
                'code'          => 'THB',
                'name'          => 'Thai baht',
                'symbol'        => '?',
                'fraction_name' => 'Satang',
                'decimals'      => 2
            ),
            'RUB' => array(
                'numeric_code'  => 643,
                'code'          => 'RUB',
                'name'          => 'Russian ruble',
                'symbol'        => '???.',
                'fraction_name' => 'Kopek',
                'decimals'      => 2
            ),
        );

        if (!empty($code) && array_key_exists($code, $currency_array)) {
            return $currency_array[$code];
        } else {
            return $currency_array;
        }
    }

    /**
     * Get payment method list
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getPaymentMethodList($key = "")
    {
        $list = array(
            'paypal' => array(
                'title' => trans('lang.paypal'),
                'value' => 'paypal',
            ),
            'stripe' => array(
                'title' => trans('lang.stripe'),
                'value' => 'stripe',
            ),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Change the .env file Data.
     *
     * @param array $data array
     *
     * @return array
     */
    public static function changeEnv($data = array())
    {
        if (count($data) > 0) {

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;

            // Loop through given data
            foreach ((array) $data as $key => $value) {

                // Loop through .env-data
                foreach ($env as $env_key => $env_value) {

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if ($entry[0] == $key) {
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Get home services tabs
     *
     * @param string $type type
     *
     * @access public
     *
     * @return string
     */
    public static function getSpecialitySlider($type)
    {
        if (!empty($type)) {
            $list = array();
            $selected_speciality = SiteManagement::getMetaValue('doctors_slider');
            if ($type == 'display') {
                return $selected_speciality['show_doctors_slider'];
            }
            if ($type == 'speciality') {
                if (!empty($selected_speciality['speciality'])) {
                    $speciality = Speciality::find($selected_speciality['speciality']);
                    $doctors = DB::table('user_service')->select('user_id')
                        ->where('speciality', $selected_speciality['speciality'])->where('type', 'doctor')->groupBy('user_id')->get()->pluck('user_id')->toArray();
                    $list['title'] = !empty($speciality) && !empty($speciality->title) ? $speciality->title : '';
                    $list['slug'] = !empty($speciality) && !empty($speciality->slug) ? ($speciality->slug) : '';
                    $list['image'] = !empty($speciality) ? self::getImage('uploads/specialities',  $speciality->image, 'small-', 'default-speciality.png') : '';
                    $list['description'] = !empty($speciality) && !empty($speciality->description) ? ($speciality->description) : '';
                    $list['doctors'] = !empty($doctors) ? $doctors : array();
                    return $list;
                }
            }
        } else {
            return '';
        }
    }

    /**
     * Get package expiry image
     *
     * @param string $path  path
     * @param string $image image
     *
     * @access public
     *
     * @return string
     */
    public static function getDashExpiryImages($path, $image)
    {
        if (!empty($image) && file_exists($path . '/' . $image)) {
            return url($path . '/' . $image);
        } else {
            return '';
        }
    }

    /**
     * Get Package Duration List
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getPackageDurationList($key = "")
    {
        $list = array(
            '10' => trans('lang.pckge_quarter'),
            '30' => trans('lang.pckge_monthly'),
            '360' => trans('lang.pckge_yearly'),
            // 'other' => trans('lang.pckge_duration_other'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get package options
     *
     * @access public
     * @return array
     */
    public static function getPackageOptions()
    {
        $list = array(
            '0' => trans('lang.pkg_price'),
            '1' => trans('lang.pkg_no_of_services'),
            '2' => trans('lang.pkg_no_of_brochures'),
            '3' => trans('lang.pkg_no_of_articles'),
            '4' => trans('lang.pkg_no_of_awards'),
            '5' => trans('lang.pkg_no_of_memberships'),
            '6' => trans('lang.pkg_duration'),
            '7' =>  trans('lang.pkg_bookings'),
            '9' =>  trans('lang.pkg_private_chat'),
            '10' =>  trans('lang.featured'),
        );
        return $list;
    }

    /**
     * Get package options
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getWaitingTime($key = "")
    {
        $list = array(
            '1' => '0 to 15 min',
            '2' => '15 to 30 min',
            '3' => '30 to 1 hr',
            '4' => 'More then hr'
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Sort by array
     *
     * @param string $key key
     * 
     * @access public
     *
     * @return array
     */
    public static function sortByArray($key = "")
    {
        $list = array(
            'id' => trans('lang.id'),
            'name' => trans('lang.name'),
            'date' => trans('lang.date'),
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return clean($list[$key]);
        } else {
            return clean($list);
        }
    }

    /**
     * Get text direction
     *
     * @access public
     *
     * @return string
     */
    public static function getTextDirection()
    {
        $language = \App::getLocale();
        $lang_array = ['ur'];
        $textdir = 'ltr';
        if (in_array($language, $lang_array)) {
            $textdir = 'rtl';
        }
        return $textdir;
    }

    /**
     * Get body lang Class
     *
     * @access public
     *
     * @return array
     */
    public static function getBodyLangClass()
    {
        $settings = SiteManagement::getMetaValue('general_settings');
        if (!empty($settings) && !empty($settings['body-lang-class'])) {
            return $settings['body-lang-class'];
        } else {
            return '';
        }
    }

    /**
     * Get body lang Class
     *
     * @param string $breadcrumb_name breadcrumb_name
     * @param string $variable        variable
     * 
     * @access public
     *
     * @return array
     */
    public static function displayBreadcrumbs($breadcrumb_name = '', $variable = '')
    {
        $settings = SiteManagement::getMetaValue('inner_page_data');
        $output = '';
        if (!empty($settings) && $settings['enable_breadcrumbs'] == 'true') {
            $breadcrumbs = Breadcrumbs::generate($breadcrumb_name, $variable);
            $output .= "
                <div class='dc-breadcrumbarea'>
                <div class='container'>
                <div class='row'>
                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                <ol class='dc-breadcrumb'>";
            foreach ($breadcrumbs as $breadcrumb) {
                if ($breadcrumb->url && !$breadcrumbs->last()) {
                    $output .= "<li><a href='$breadcrumb->url'>" . html_entity_decode(clean($breadcrumb->title)) . "</a></li>";
                } else {
                    $output .= "<li class='active'>" . html_entity_decode(clean($breadcrumb->title)) . "</li>";
                }
            }
            $output .= "</ol>";
            $output .= "</div></div></div></div>";
        } else {
            $output = '';
        }
        return $output;
    }

    /**
     * Get dashboard images
     *
     * @param string $path    path
     * @param string $image   image
     * @param string $default default
     * 
     * @access public
     *
     * @return string
     */
    public static function getDashboardImages($path, $image, $default)
    {
        if (!empty($image) && file_exists($path . '/' . $image)) {
            echo '<img src="' . url($path . '/' . $image) . '" alt="' . trans('lang.img') . '">';
        } else {
            echo '<i class="fa fa-' . $default . '"></i>';
        }
    }

    /**
     * Get Payouts list
     *
     * @access public
     *
     * @return array
     */
    public static function getPayoutsList()
    {
        $list = array(
            'paypal' => array(
                'id'        => 'paypal',
                'title'        => trans('lang.paypal'),
                'img_url'    => url('/images/payouts/paypal.png'),
                'status'    => 'enable',
                'fields'    => array(
                    'paypal_email' => array(
                        'type'            => 'text',
                        'classes'        => '',
                        'required'        => true,
                        'placeholder'    => trans('lang.add_paypal_email_address'),
                        'message'        => trans('lang.paypal_email_address_is_required'),
                    )
                )
            ),
            'bacs' => array(
                'id'        => 'bacs',
                'title'        => trans('lang.direct_bank_transfer'),
                'img_url'    => url('/images/payouts/bank.png'),
                'status'    => 'enable',
                'fields'    => array(
                    'bank_account_name' => array(
                        'type'            => 'text',
                        'classes'        => '',
                        'required'        => true,
                        'placeholder'    => trans('lang.bank_account_name'),
                        'message'        => trans('lang.bank_account_name_is_required'),
                    ),
                    'bank_account_number' => array(
                        'type'            => 'text',
                        'classes'        => '',
                        'required'        => true,
                        'placeholder'    => trans('lang.bank_account_number'),
                        'message'        => trans('lang.bank_account_number_is_required'),
                    ),
                    'bank_name' => array(
                        'type'            => 'text',
                        'classes'        => '',
                        'required'        => true,
                        'placeholder'    => trans('lang.bank_name'),
                        'message'        => trans('lang.bank_name_is_required'),
                    ),
                    'bank_routing_number' => array(
                        'type'            => 'text',
                        'classes'        => '',
                        'required'        => false,
                        'placeholder'    => trans('lang.bank_routing_number'),
                        'message'        => trans('lang.bank_routing_number_is_required'),
                    ),
                    'bank_iban' => array(
                        'type'            => 'text',
                        'classes'        => '',
                        'required'        => false,
                        'placeholder'    => trans('lang.bank_iban'),
                        'message'        => trans('lang.bank_iban_is_required'),
                    ),
                    'bank_bic_swift' => array(
                        'type'            => 'text',
                        'classes'        => '',
                        'required'        => false,
                        'placeholder'    => trans('lang.bank_bic_swift'),
                        'message'        => trans('lang.bank_bic_swift_is_required'),
                    )
                )
            ),
        );
        return $list;
    }

    /**
     * Get month list
     *
     * @param string $key key
     *
     * @access public
     *
     * @return array
     */
    public static function getMonthList($key = "")
    {
        $list = array(
            '01'    => "January",
            '02'    => "February",
            '03'     => "March",
            '04'    => "April",
            '05'    => "May",
            '06'    => "June",
            '07'    => "July",
            '08'    => "August",
            '09'    => "September",
            '10'    => "October",
            '11'    => "November",
            '12'    => "December",
        );
        if (!empty($key) && array_key_exists($key, $list)) {
            return $list[$key];
        } else {
            return $list;
        }
    }

    /**
     * Get order meta value
     *
     * @param string $meta_key meta_key
     *
     * @access public
     *
     * @return array
     */
    public static function getOrderMeta($meta_key)
    {
        if (!empty($meta_key)) {
            $data = DB::table('order_metas')->select('meta_value')->where('meta_key', $meta_key)->get()->first();
            if (!empty($data)) {
                $fixed_data = preg_replace_callback(
                    '!s:(\d+):"(.*?)";!',
                    function ($match) {
                        return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
                    },
                    $data->meta_value
                );
                return unserialize($fixed_data);
            }
        }
    }

    /**
     * Get current package
     *
     * @param Collection $user user
     *
     * @access public
     *
     * @return array
     */
    public static function getCurrentPackage(User $user)
    {
        $user_order = $user->orders->where('appointment_date', null)->first();
        if (!empty($user_order)) {
            $order =  DB::table('order_metas')->select('meta_value')->where('metable_id', $user_order['id'])->where('meta_key', 'package')->first();
            $package_detail = Unserialize($order->meta_value);
            return !empty($package_detail) ? Helper::getUnserializeData($package_detail['options']) : '';
        }
    }

    /**
     * Get current package
     *
     * @access public
     *
     * @return array
     */
    public static function getFeaturedUsers()
    {
        return DB::table('users')
            ->join('orders', 'orders.user_id', '=', 'users.id')
            ->join('order_metas', 'order_metas.metable_id', '=', 'orders.id')
            ->select('users.id')
            ->where('order_metas.meta_key', 'package')
            ->get()->pluck('id')->toArray();
    }

    /**
     * Update payouts
     *
     * @access public
     *
     * @return array
     */
    public static function updatePayouts()
    {
        $payout_settings = SiteManagement::getMetaValue('payment_settings');
        $min_payount = !empty($payout_settings) && !empty($payout_settings['min_payout']) ? $payout_settings['min_payout'] : '';
        $currency  = !empty($payout_settings) && !empty($payout_settings['currency']) ? $payout_settings['currency'] : 'USD';
        $appointments = Appointment::select('user_id', DB::raw('sum(charges) total_charges'))
            ->groupBy('user_id')
            ->get();
        if (!empty($appointments)) {
            foreach ($appointments as $key => $appointment) {
                if ($appointment->total_charges >= $min_payount) {
                    $user = User::find($appointment->user_id);
                    $user_payout = !empty($user->profile) && !empty($user->profile->payout_settings) ? Helper::getUnserializeData($user->profile->payout_settings) : '';
                    if (!empty($user_payout)) {
                        if ($user->orders->count() > 0) {
                            foreach ($user->orders as $user_order) {
                                $order = Order::find($user_order->id);
                                if (empty($order->payout)) {
                                    $payout = new Payout();
                                    $payout->user()->associate($appointment->user_id);
                                    $payout->amount = $appointment->total_charges;
                                    $payout->currency = $currency;
                                    $payout->payout_detail = $user->profile->payout_settings;
                                    $payout->user_id = $appointment->user_id;
                                    $payout->order_id = $user_order->id;
                                    $payout->payment_method = self::getPayoutsList()[$user_payout['type']]['title'];
                                    $payout->status = 'pending';
                                    $payout->save();
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Email Content
     *
     * @access public
     *
     * @return array
     */
    public static function getDownloadAppEmailContent()
    {
        $output = "";
        $output .= 'Hello!<br/>
            You can download application by clicking the link below 
            <div style="width: 100%; float: left; padding: 15px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
            <div style="width: 100%; float: left; padding: 15px; background: #f7f7f7; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
            <div style="width: 100%; float: left; padding: 30px 15px; border: 2px solid #fff; text-align: center; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;">
            <h3 style="font-size: 26px; margin-bottom: 15px; font-weight: normal; line-height: 26px; margin: 0; color: #333; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; font-family: "Work Sans", Arial, Helvetica, sans-serif;">Application download link is</h3>
            <a href="%download_link%">Download Application</a>
            </div>
            </div>
            </div>
            %signature%';
        $output .= "%signature%";
        return $output;
    }

    /**
     * Create a new controller instance.
     *
     * @param string  $screen_name      tweeter username
     * @param integer $number_of_tweets number of tweets to show
     * 
     * @return array
     */
    public static function twitterUserTimeLine($screen_name, $number_of_tweets = '')
    {
        if (!empty($screen_name)) {
            $tweets_to_show = !empty($number_of_tweets) ? $number_of_tweets : 2;
            return Twitter::getUserTimeline(
                [
                    'count' => $tweets_to_show, 'format' => 'array',
                    'tweet_mode' => 'extended', 'screen_name' => $screen_name
                ]
            );
        } else {
            return '';
        }
    }

    /**
     * Get size
     *
     * @param integer $bytes bytes
     *
     * @return \Illuminate\Http\Response
     */
    public static function bytesToHuman($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Service new order email content
     *
     * @access public
     *
     * @return array
     */
    public static function getUserUpdateEmailByAdminContent()
    {
        $output = "";
        $output .= "Hello %user_name%";
        $output .= " ";
        $output .= "Your Email is change by Admin. Your can now login with new email address %email%";
        $output .= "%signature%";
        return $output;
    }

    /**
     * Service new order email content
     *
     * @access public
     *
     * @return array
     */
    public static function getUserUpdatePasswordByAdminContent()
    {
        $output = "";
        $output .= "Hello %user_name%!";
        $output .= " ";
        $output .= "Your Password is change by Admin. Your can now login with new password <strong>%password%</strong>";
        $output .= "%signature%";
        return $output;
    }

    /**
     * Get doctors users from array
     *
     * @access public
     *
     * @return array
     */

    public static function getDoctorsFromArray($request)
    {    
        
        foreach ($request as $key => $value) {
            # loop on array to get doctors
             $counter = 0;
             $doctors = [];
            if(count($value->users) > 0) {

            foreach ($value->users as $key => $users) {
                # Check if user is doctor.

                if($users->GetRoleNames()->first() == 'doctor'){
                    $doctors[$counter] = $users;
                     $counter++;
                    }
               
            }
            $alldoc[$value->id] = $doctors;
        } else {

            $alldoc[$value->id] = [];
        }

        }

        return !empty($alldoc) ? $alldoc : '';
    }


     /**
     * Get specific service
     *
     * @param int $location_id location_id
     * 
     * @access public
     *
     * @return array
     */
    public static function getLocationByID($location_id)
    {
        if (!empty($location_id)) {
            $location = Location::find($location_id);
            return !empty($location) ? $location : '';
        } else {
            return '';
        }
    }

     /**
     * Get count feedbacks 
     *
     * @param int $users 
     * 
     * @access public
     *
     * @return count
     */
    public static function getCountFeedbacks($users)
    {    
        $alldoc = 0;   
        foreach ($users as $key => $value) {
            # loop on array to get doctors
            if($value->profile->extend == 'on') {
                if($value->profile) {
                    if(count($value->feedbacks) > 0) {

                        $alldoc += count($value->feedbacks);
                }    }   
            } 

        }

        return $alldoc;
    }

     /**
     * Get Extended Doctors 
     *
     * @param int $users 
     * 
     * @access public
     *
     * @return count
     */
    public static function getExtended($users)
    {
        $alldoc = [];
        foreach ($users as $key => $value) {
            # loop on array to get doctors
             
                # Check if profile is extended.
                if($value->profile->extend == 'on'){
                    $alldoc[] = $value;
                }

        }
        return !empty($alldoc) ? $alldoc : [];
    }

     /**
     * Get total doctors without video schedular
     *
     * @param int $users 
     * 
     * @access public
     *
     * @return count
     */
    public static function withoutVS($users)
    { 
        $counter = 0;
        $doctors = [];
        $alldoc = [];
        foreach ($users as $key => $value) {
            # loop on array to get doctors
             
            if($value->profile->extend == 'on') {
                # Check if profile is extended.
                if(($value->profile->willing_video == 'off' || $value->profile->willing_video == null) && ($value->profile->available_days == null) ){
                    
                    $doctors[$counter] = $value;
                    $counter++;
                    $alldoc[$value->id] = $doctors;
                }
            } 

        }
        return !empty(count($alldoc)) ? count($alldoc) : '0';
    }

     /**
     * Get total doctors without video schedular Appt
     *
     * @param int $users 
     * 
     * @access public
     *
     * @return count
     */
    public static function withoutVSA($users)
    { 
        $counter = 0;
        $doctors = [];
        $alldoc = [];
        foreach ($users as $key => $value) {
            # loop on array to get doctors
             
            if($value->profile->extend == 'on') {
                # Check if profile is extended.
                if(($value->profile->willing_video == 'off' || $value->profile->willing_video == null) && ($value->profile->available_days == null) ){
                    if(count($value->appointments) > 0) {
                        $doctors[$counter] = $value;
                        $counter++;
                        $alldoc[$value->id] = $doctors;
                    }
                }
            } 

        }
        return !empty(count($alldoc)) ? count($alldoc) : '0';
    }

     /**
     * Get total doctors mark red
     *
     * @param int $users 
     * 
     * @access public
     *
     * @return count
     */
    public static function markRed($users)
    { 
        $counter = 0;
        $doctors = [];
        $alldoc = [];
        foreach ($users as $key => $value) {
            # loop on array to get doctors
             
            if($value->profile->extend == 'on') {
                # Check if profile is extended.
                if($value->profile->mark_red == 'on' ){
                   
                        $doctors[$counter] = $value;
                        $counter++;
                        $alldoc[$value->id] = $doctors;
                    
                }
            } 

        }
        return !empty(count($alldoc)) ? count($alldoc) : '0';
    }

    /**
     * Get total doctors with vedio schedule appt reviews
     *
     * @param int $users 
     * 
     * @access public
     *
     * @return count
     */
    public static function withVSA($users)
    { 
        $counter = 0;
        $doctors = [];
        $alldoc = [];
        foreach ($users as $key => $value) {
            # loop on array to get doctors
             
            if($value->profile->extend == 'on') {
                # Check if profile is extended.
                if(($value->profile->willing_video == 'on' || $value->profile->willing_video != null) && ($value->profile->available_days != null) && ($value->profile->avatar != null) && (count($value->feedbacks) > 0)){
                    if(count($value->appointments) > 0) {
                        $doctors[$counter] = $value;
                        $counter++;
                        $alldoc[$value->id] = $doctors;
                    }
                }
            } 

        }
        return !empty(count($alldoc)) ? count($alldoc) : '0';
    }


    /**
     * Get total feedback by city and speciality base
     *
     * @param int locations
     *
     * @access public
     *
     * @return count
     */
    public static function feedbackcount($locations, $speciality_id)
    {
        $counter = 0;
        $datas = $locations->users()->get();
        foreach ($datas as $data){
            $feedbacks = $data->feedbacks()->get();
            $speciality = $data->specialities()->get();
            foreach ($speciality as $speciality) {
                if ($speciality->id == $speciality_id) {
                    $counter = count($feedbacks) + $counter;
                }
            }
        }
        return !empty($counter) ? $counter : '0';
    }

    /**
     * Get total user whose profile are completed (without Video, Scheduler, Appt. Number)
     *
     * @param int locations
     *
     * @access public
     *
     * @return count
     */
    public static function prof_comp_without_vid_sche_appt($locations, $speciality_id)
    {
        $counter = 0;
        $datas = $locations->users()->get();
        foreach ($datas as $data){
            $profile = $data->profile()->first();
            $speciality = $data->specialities()->get();
            foreach ($speciality as $speciality) {
                if ($profile->working_time == null && $profile->extend == 'on' && $profile->willing_video == 'off' && $profile->mark_incomplete == 'off' && $speciality->id == $speciality_id && $data->assistant_phone_number == null) {
                    $counter++;
                }
            }
        }
        return !empty($counter) ? $counter : '0';
    }

    /**
     * Get total user whose profile are completed (without Video, Scheduler)
     *
     * @param int locations
     *
     * @access public
     *
     * @return count
     */
    public static function prof_comp_without_vid_sche($locations, $speciality_id)
    {
        $counter = 0;
        $datas = $locations->users()->get();
        foreach ($datas as $data){
            $profile = $data->profile()->first();
            $speciality = $data->specialities()->get();
            foreach ($speciality as $speciality) {
                if ($profile->working_time == null && $profile->extend == 'on' && $profile->willing_video == 'off' && $profile->mark_incomplete == 'off' && $speciality->id == $speciality_id) {
                    $counter++;
                }
            }
        }
        return !empty($counter) ? $counter : '0';
    }

    /**
     * Get total user whose profile are completed
     *
     * @param int locations
     *
     * @access public
     *
     * @return count
     */
    public static function prof_comp($locations, $speciality_id)
    {
        $counter = 0;
        $datas = $locations->users()->get();
        foreach ($datas as $data){
            $profile = $data->profile()->first();
            $speciality = $data->specialities()->get();
            foreach ($speciality as $speciality) {
                if ($profile->mark_incomplete == 'off' && $profile->extend == 'on' && $speciality->id == $speciality_id && $profile->extend == 'on') {
                    $counter++;
                }
            }
        }
        return !empty($counter) ? $counter : '0';
    }
    /**
     * Get total user's question count
     *
     * @param int locations
     *
     * @access public
     *
     * @return count
     */
    public static function ques_count($locations, $speciality_id)
    {
        $counter = 0;
        $datas = $locations->users()->get();
        foreach ($datas as $data){
            $user = $data->profile()->first();
            $question = $data->question()->get();
            $speciality = $data->specialities()->get();
            foreach ($speciality as $speciality) {
                if ($speciality->id == $speciality_id && $user->extend == 'on') {
                    $counter = count($question) + $counter;
                }
            }
        }
        return !empty($counter) ? $counter : '0';
    }


    /**
     * Get total all cities extended doctors
     *
     * @param int locations
     *
     * @access public
     *
     * @return count
     */
    public static function all_cities_extended_doc($locations, $speciality_id)
    {
        $counter = 0;
        $datas = $locations->users()->get();
        foreach ($datas as $data){
            $user = $data->profile()->first();
            $question = $data->question()->get();
            $speciality = $data->specialities()->get();
            foreach ($speciality as $speciality) {
                if ($speciality->id == $speciality_id && $user->extend == 'on') {
                    $counter = count($question) + $counter;
                }
            }
        }
        return !empty($counter) ? $counter : '0';
    }
    public static function hospitalAffiliation($affliated_hospital_name,$affliated_hospital_phone,$affliated_hospital_address,$affliated_hospital_image){
        $hospital_affilation = array (
            "hospitalAffiliation" =>array(
                "@type" => "Hospital",
                "name" => $affliated_hospital_name,
                "telephone" => '0345-0435621',
                "priceRange" => "PKR 1500",
                "address" => array(
                    "@type" => "PostalAddress",
                    "name" => $affliated_hospital_address
                ),
                "image" => array(
                    "@type" => "ImageObject",
                    "url" => $affliated_hospital_image,
                    "height" => "170",
                    "width" => "170",
                )
            )
        );

        return $hospital_affilation;
    }

    public static function rating($user_id){
        $ratings = [];
        $worst_rating = "N/A";
        $best_rating = "N/A";
        $rating_count = "N/A";
        $rating_avg = "N/A";
        $user_rating = Feedback::where('user_id', $user_id)->first();
        if(!empty($user_rating)){
             $rates = json_decode($user_rating->rating,true);
           // dd($rates);
            foreach ($rates as $key => $rate)
                $ratings[] = $rate;
        }
        if(!empty($ratings)){
            $worst_rating = min($ratings);
            $best_rating = max($ratings);
            $rating_count = count($ratings);
            $rating_avg = array_sum($ratings)/count($ratings);
        }
        else {
            $rating_count = 0;
        }
        $rates = array(
            "aggregateRating" => array(
            "@type" =>"AggregateRating",
            "worstRating" => $worst_rating,
            "bestRating" => $best_rating,
            "ratingValue" => $rating_avg,
            "ratingCount" => $rating_count
            )
        );

        return $rates;
    }

    public static function memberHospital($members){
        // dd($members);
        $member = [];
        $speciality = [];
            foreach ($members as $key => $mem) {
                // dd($mem);
                $user = User::with('location','specialities','doc_teams')->with(['profile'=>function($q){
                    $q->select('user_id','id','description','avatar','address','available_days');
                }])->where('id',$mem->doctor_id)->select('first_name','last_name','phone_number','slug','id','location_id')->first();
                $city = Location::where('id',$user->location_id)->pluck('title')->first();
                $specialities = DB::table('user_speciality')->select('speciality_id')
                    ->where('user_id', $mem->doctor_id)->groupBy('speciality_id')->get()->pluck('speciality_id')->toArray();
                if(!empty($specialities)){
                    $speciality = Speciality::whereIn('id',$specialities)->pluck('title')->toArray();
                }
                // $locationSlug = $user->location->slug ? $user->location->slug : 'karachi';
                // $specialitySlug = $user->specialities[0]->slug ? $user->specialities[0]->slug : 'general-physician';
                // dd($locationSlug);
                  $app_url = env('APP_URL');
                  $url = env('APP_URL');
        // $url = $app_url."doctors/".$locationSlug."/".$user->specialities[0]->slug."/".$user->slug;
                  // dd($user);
                  if(!empty($user->doc_teams[0])){
            if(!empty($user->doc_teams[0]->slots)){

            $available_days = json_decode($user->doc_teams[0]->slots);
            // dd($user->doc_teams[0]);
            foreach($available_days as $index => $current){
                $start_end_time = $current->start_end_time ? $current->start_end_time : 'Not Available Today';
            }
            }
            else{
                $start_end_time = '12:00 pm - 2:00 pm';
            }
            }
            else{
                $start_end_time = '12:00 pm - 2:00 pm';
            }
               if(!empty($user->profile->description) && $user->profile->description != null && $user->profile->description != ''){
                $dr_description = $user->profile->description;
               }
               else{
                $dr_description = 'Best Doctor in town';
               }
               if(!empty($user->profile->address) && $user->profile->address != null && $user->profile->address != ''){
                $dr_address = $user->profile->address;
               }
               else{
                $dr_address = array(
                    "@type" => "PostalAddress",
                    "streetAddress" => "MsnSoft, 644, Near Gourmet",
                    "addressLocality" => "Airline Society",
                    "addressRegion" => "Lahore",
                    "postalCode" => "54000",
                    "name" => "DoctorFindy",
                    "telephone" => "0345-0435621",
                );
               }
               if(!empty($user->profile->avatar) && $user->profile->avatar != null && $user->profile->avatar != ''){
                $image_url = config('app.url')."/uploads/users/".$user->id."/".$user->profile->avatar;
               }
               else{
                $image_url = $image_url = config('app.url')."/uploads/users/default/doctor.svg";
               }   
               // dd($dr_address,$dr_description);
               $author = User::role('patient')->skip(rand(1,55))->first();
               // dd($author);
        $memberOfHospital = Schema::Physician()->name($user->first_name." ".$user->last_name)->currenciesAccepted('PKR')->publicAccess('true')->aggregateRating(array(
                    "@type" => "AggregateRating",
                    "ratingValue" => 4.9,
                    "worstRating" => 2,
                    "bestRating" => 5,
                    "reviewCount" => rand(2,5),
                ))->description($dr_description)->url($url)->telephone('0345-0435621')->priceRange($mem->price ?? '1000')->image(array( 
               "@type" => "ImageObject",
               "url" => $image_url,
                "height" => "170",
                "width" => "170",
            ))->medicalSpecialty($speciality)->openingHours($start_end_time)->address($dr_address); 
            }
        
        // dd($memberOfHospital);
       
        echo $memberOfHospital->toScript();
    }
    public static function doctorProfileStructure ($user) {
        
        $specialities = $user->specialities->pluck('id')->toArray();
        $services = $user->specialities[0]->services->take(5)->pluck('title')->toArray();
// dd($services);
        $avtar = $user->profile->avatar ?? 'doctor.svg';
        $affliated_hospital_name = "";
        $affliated_hospital_phone = $user->phone_number ?? "Not provided";
        $affliated_hospital_address = $user->profile->address?? "Not provided";
        $affliated_hospital_image = config('app.url')."/uploads/users/".$user->id."/".$avtar;
        $days = [];
        $hospital_name = [];
        $hospital_phone = [];
        $hospital_address = [];
        $hospital_image = [];
        $speciality = [];
        $service = [];
        $doctor_specialities = "";
        $doctor_services = "";
        if(!empty($specialities)){
            $speciality =  $user->specialities->pluck('title')->toArray();
        }
        if(!empty($user->profile->available_days)){
            foreach (Helper::getAppointmentDays() as $key => $day)
                if (!empty(json_decode($user->profile->available_days))) {
                    if (in_array($key, json_decode($user->profile->available_days)))
                        $days[] = html_entity_decode(clean($day['title']));
                }
        }
        
        $available_days = implode(",", $days);
        $available_locations = $user->doc_teams;

        // dd($available_locations);
        // if(!empty($available_locations)){
        // foreach ($available_locations as $key => $hospital) {
        //     // dd($hospital);
        //     $hospital_obj = $hospital->hospital;
        //     if(!empty($hospital_obj)){
        //         $hospital_name[] = $hospital_obj->first_name." ".$hospital_obj->last_name;
        //         if($hospital_obj->profile->address != null)
        //             {
        //                 $hospital_address[] = $hospital_obj->profile->address;
        //             }
        //         if($hospital_obj->phone_number != null)
        //             {
        //                 $hospital_phone[] =  $hospital_obj->phone_number;
        //             }
        //         if($hospital_obj->profile->avatar != null)
        //             {
        //                 $hospital_image[] =  config('app.url')."/uploads/users/".$hospital_obj->id."/".$hospital_obj->profile->avatar;
        //             }
        //         }
        //     }
        // }
        
        // if(!empty($hospital_phone)){
        //     $affliated_hospital_phone = $hospital_phone[0];
        // }
        // if(!empty($hospital_name)){
        //     $affliated_hospital_name = $hospital_name[0];
        // }
        // if(!empty($hospital_address)){
        //     $affliated_hospital_address = $hospital_address[0];
        // }

        // if(!empty($hospital_image)){
        //     $affliated_hospital_image =  $hospital_image[0];
        // }

        if(!empty($speciality)){
            $doctor_specialities = $speciality;
        }
        if(!empty($services)){
            $doctor_services = $services;
        }
        if(!empty($user->profile->address) && $user->profile->address != null && $user->profile->address != ''){
                $dr_address = $user->profile->address;
               }
               else{
                $dr_address = array(
                    "@type" => "PostalAddress",
                    "streetAddress" => "MsnSoft, 644, Near Gourmet",
                    "addressLocality" => "Airline Society",
                    "addressRegion" => "Lahore",
                    "postalCode" => "54000",
                    "name" => "DoctorFindy",
                    "telephone" => "0345-0435621",
                );
               }
        $doc_price = $user->doc_teams->min('price');
            $doc_fee = $doc_price ?? 1000;
            // dd($doc_fee);
            $dscrption = $user->profile->description ?? '';
        $app_url = env('APP_URL');
        // dd($user->location->slug,$user->specialities[0]->slug);
        $url = $app_url."/profile/".$user->slug;   
        $drProfileStructure = Schema::Physician()->name($user->first_name." ".$user->last_name)->currenciesAccepted('PKR')->publicAccess('true')->description($dscrption)->url($url)->telephone('0345-0435621')->priceRange($doc_fee)->aggregateRating(array(
                    "@type" => "AggregateRating",
                    "ratingValue" => 4.9,
                    "worstRating" => 2,
                    "bestRating" => 5,
                    "reviewCount" => rand(2,5),
                ))->image(array( 
               "@type" => "ImageObject",
               "url" => config('app.url')."/uploads/users/".$user->id."/".$avtar,
                "height" => "170",
                "width" => "170",
            ))->medicalSpecialty(array(
                "@type" => "medicalSpecialty",
                "name" => $doctor_specialities
            ))->openingHours('5 pm')->AvailableService(array(
                "@type" => "MedicalEntity",
                "name" => $doctor_services
            ))->address($dr_address);
        echo $drProfileStructure->toScript();
        // return json_encode($script_data,JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
    public static function hospitalProfileStructure ($user) {
        $days = [];
        $service =[];
        $services = DB::table('user_service')->select('service_id')
                    ->where('user_id', $user->id)->groupBy('service_id')->get()->pluck('service_id')->toArray();
        if(!empty($services)){
                $service = Service::whereIn('id',$services)->pluck('title');
        }
        $members = $user->approvedTeams->take(5);
        if($members->count() > 0){
        // dd($members,'f');
        $members_array = self::memberHospital($members);
        }
        else{
            $members_array =[];
        }
        if(!empty($user->profile->available_days)){
            foreach (Helper::getAppointmentDays() as $key => $day)
                if (!empty(json_decode($user->profile->available_days))) {
                    if (in_array($key, json_decode($user->profile->available_days, true)))
                        $days[] = html_entity_decode(clean($day['title']));
                }
             
        }
        $available_days = implode(",", $days);
        $app_url = env('APP_URL');
                $url = $app_url."hospitals/".$user->location->slug."/".$user->slug;
       
$hospitalProfileStructure = Schema::Hospital()->name($user->first_name." ".$user->last_name,)->description($user->profile->description)->url($url)->telephone('0345-0435621')->openingHours('24 Hours')->image(array(
               "@type" => "ImageObject",
               "url" => config('app.url')."/uploads/users/".$user->id."/".$user->profile->avatar 
            ))
->address(array(
                "@type" => "PostalAddress",
                 "name" => $user->profile->address,
            ))->geo(array(
                "@type" => "GeoCoordinates",
                "latitude" => $user->profile->latitude,
                "longitude" => $user->profile->longitude
            ))->hospitalAffiliation($members_array);
        echo $hospitalProfileStructure->toScript();
        // return json_encode($script_data,JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
    public static function labProfileStructure ($user) {
        $days = [];
        $service =[];
        $app_url = env('APP_URL');
        $url = $app_url."lab/".$user->location->slug."/".$user->slug;
        $labProfileStructure = Schema::DiagnosticLab()->name($user->first_name." ".$user->last_name)->description($user->profile->description)->telephone('0345-0435621')->url($url)->image(array(
               "@type" => "ImageObject",
               "url" => config('app.url')."/uploads/users/".$user->id."/".$user->profile->avatar 
            ))->address(array(
                "@type" => "PostalAddress",
                 "name" => $user->profile->address,
            ))->geo(array(
                "@type" => "GeoCoordinates",
                "latitude" => $user->profile->latitude,
                "longitude" => $user->profile->longitude
            ));
        // dd($labProfileStructure);
        echo $labProfileStructure->toScript();
    }
     public static function blogleStructure ($blog_id) {
        $names = [];
        $article = Article::where('id', $blog_id)->with('categories')->with('author')->first();
        if(!empty($article->categories)){
            foreach ($article->categories as $key => $category) {
                $names[] = $category->title;
            }
        }
        $script_data = array (
            "title" => $article->title,
            "short_description" => $article->short_description,
            "datePublished" => $article->created_at,
            "dateModified" => $article->updated_at,
            "url" => url()->current(),
            "description" => $article->description,
            "reading_time" => $article->reading_time. ' mins',
            "image" => config('app.url')."/uploads/users/".$article->author->id."/articles/".$article->image,
           "height" => "170",
            "width" => "170",
            "author" => array(
                "@type" => "Person",
                "name" => $article->author->first_name .' '.  $article->author->last_name,
                "role" => $article->author->roles[0]->role_type,
            ),
            "caterories" => array(
                "@type" => "Caterories",
                "name" => $names,
            )

        );
        $articleURL =config('app.url')."/health-articles/".$article->slug;
        $articleStructure = Schema::Article()->headline($article->title)->url($articleURL)->image(array( 
               "@type" => "ImageObject",
               "url" => config('app.url')."/uploads/users/".$article->author->id."/articles/".$article->image,
                "height" => "300",
                "width" => "600",
            ))->datePublished($article->created_at)->dateModified($article->updated_at)->author(array(
                "@type" => "Person",
                "name" => $article->author->first_name .' '.  $article->author->last_name))
            ->publisher(array(
                "@type" => "Organization",
                "name" => 'DoctorFindy | Find and Book Best Doctors',
                "sameAS" => config('app.url')."/health-articles",
                "logo" => array( 
               "@type" => "ImageObject",
               "url" => asset(Helper::getGeneralSettings('site_logo')))
            ))->mainEntityOfPage(array(
               "@type" => "WebPage",
               "@id" => $articleURL));
        echo $articleStructure->toScript();
        // return json_encode($script_data,JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
    public static function blogsListingGraph() {
        // dd($article);
        $articlesURL = config('app.url')."/health-articles/categories";
        $logoURL = asset(Helper::getGeneralSettings('site_logo'));
        $graph = new Graph();
        $graph->MedicalOrganization()->identifier($articlesURL.'/#Organization')->name('DoctorFindy | Find and Book Best Doctors')->url($articlesURL)->logo(array( 
               "@type" => "ImageObject",
               "@id" => $logoURL.'/#logo',
               "url" => $logoURL,
               "caption" => 'DoctorFindy | Find and Book Best Doctors',
               "inLanguage" => 'en-US',
               "height" => "300",
               "width" => "600",
           ));
        $graph->WebSite()->identifier($articlesURL.'/#WebSite')->url($articlesURL)->name('DoctorFindy | Find and Book Best Doctors')->publisher(array(
            "@id" => $articlesURL.'/#Organization',
        ))->inLanguage('en-US')->potentialAction(array(
            "@type" => 'SearchAction',
            "target" => config('app.url')."/health-articles/?s={search_query}",
            "query-input" => 'required name=search_query'
        ));
        $graph->CollectionPage()->identifier($articlesURL.'/#WebPage')->url($articlesURL)->name('Read Health Blogs and Well Being Articles | DoctorFindy')->about(array("@id" => $articlesURL.'/#Organization' ))->isPartOf(array("@id" => $articlesURL.'/#WebSite'))->inLanguage('en-US');
        echo $graph;
    }
    public static function blogDetailGraph($article) {
        // dd($article);
        $articlesURL = config('app.url')."/health-articles/categories";
        $logoURL = asset(Helper::getGeneralSettings('site_logo'));
        $imageURL = config('app.url')."/uploads/users/".$article->author->id."/articles/".$article->image;
        $graph = new Graph();
        $graph->MedicalOrganization()->identifier($articlesURL.'/#Organization')->name('DoctorFindy | Find and Book Best Doctors')->url($articlesURL)->logo(array( 
               "@type" => "ImageObject",
               "@id" => $logoURL.'/#logo',
               "url" => $logoURL,
               "caption" => 'DoctorFindy | Find and Book Best Doctors',
               "inLanguage" => 'en-US',
               "height" => "300",
               "width" => "600",
           ));
        $graph->WebSite()->identifier($articlesURL.'/#WebSite')->url($articlesURL)->name('DoctorFindy | Find and Book Best Doctors')->publisher(array(
            "@id" => $articlesURL.'/#Organization',
        ))->inLanguage('en-US');
        $graph->ImageObject()->identifier($imageURL.'/#articleImage')->url($imageURL)->width('600')->height('300')->inLanguage('en-US');
        $script_data = [];
        $breadcrumbs = \request()->segments();
        (array_unshift($breadcrumbs , ''));

        $segments = '';
        $name = '';
        foreach ($breadcrumbs as $key => $segment) {

            if ($key > 0){
                $segments .= '/'.$segment;
            }
            else {
                $segments .= $segment;
            }
            if ($segments === '') {
                $name = 'Home';
            }
            else {
                $name = ucfirst($segment);
            }

            array_push($script_data, [
                "@type" => "ListItem",
                "position" => $key + 1,
                "item" => config('app.url').$segments,
                "name" => $name,
            ]);
        $graph->BreadcrumbList()->itemListElement($script_data);
        }
        $graph->person()->name($article->author->first_name .' '.  $article->author->last_name)->worksFor(config('app.url'));
        $graph->WebPage()->identifier(config('app.url')."/health-articles/".$article->slug.'/#WebPage')->url(config('app.url')."/health-articles/".$article->slug)->name($article->title)->datePublished($article->created_at)->dateModified($article->updated_at)->author(array(
                "@type" => "Person",
                "name" => $article->author->first_name .' '.  $article->author->last_name))->primaryImageOfPage(array( 
               "@type" => "ImageObject",
               "@id" => config('app.url')."/uploads/users/".$article->author->id."/articles/".$article->image.'/#WebPage',
               "url" => config('app.url')."/uploads/users/".$article->author->id."/articles/".$article->image,
                "height" => "300",
                "width" => "600",
            ))->inLanguage('en-US');
                $graph->BlogPosting()->headline($article->title)->url(config('app.url')."/health-articles/".$article->slug)->datePublished($article->created_at)->dateModified($article->updated_at)->name($article->title)->description($article->short_description)->author(array(
                "@type" => "Person",
                "name" => $article->author->first_name .' '.  $article->author->last_name))->publisher(array(
                "@type" => "Organization",
                "@id" => $articlesURL.'/#Organization',
                "name" => 'DoctorFindy | Find and Book Best Doctors',
                "sameAS" => config('app.url')."/health-articles",
            ))->image(array( 
               "@type" => "ImageObject",
               "@id" => config('app.url')."/uploads/users/".$article->author->id."/articles/".$article->image.'/#WebPage',
               "url" => config('app.url')."/uploads/users/".$article->author->id."/articles/".$article->image,
                "height" => "300",
                "width" => "600",
            ))->inLanguage('en-US');
        echo $graph;
    }
    public static function specialityStructure ($slug, $location) {
        $specialty = Speciality::where('slug', $slug)->first();
        $about = 'Find Best '. $slug . ' in ' . $location;
        
        $specialityStructure = Schema::MedicalWebPAge()->specialty($specialty->title)->description($specialty->description)->about(["@type" => "CommunicateAction",
                "name" => $about,
                ]);
        echo $specialityStructure->toScript();
        // return json_encode($script_data,JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
    public static function userfaqsStructure ($faqs, $user) {
        // dd($faqs, $user);
        $role_type = $user->roles[0]->name;
        if ($role_type == "laboratory"){
        $script_data_faqs = array (
        );
        foreach ($faqs as $faq) {
            $question1 = json_decode($faq->description)[0];
            $question = str_replace('user_slug', $user->first_name.' '.$user->last_name, $question1);
            $answer1 = json_decode($faq->description)[1];
            $answer = str_replace('user_slug',  $user->first_name.' '.$user->last_name, $answer1);
            array_push($script_data_faqs,
            ["@type" => "Question",
                "name" => $question,
                "acceptedAnswer" => array(
                    "@type" => "Answer",
                    "text" => $answer,
                )]
            );
        }
        }if ($role_type == "hospital"){
        $onboard_doctors_id = $user->teams()->pluck('doctor_id')->take(10)->toArray();
        $onboard_doctors = User::whereIn('id',$onboard_doctors_id)->select('first_name','last_name')->get();
        // dd($onboard_doctors);
        if(!empty($onboard_doctors[0])){
           $doctor1 = $onboard_doctors[0]->first_name.' '.$onboard_doctors[0]->last_name;
         }
         else{
            $doctor1 = '';
         }
         if(!empty($onboard_doctors[1])){
           $doctor2 = ', '.$onboard_doctors[1]->first_name.' '.$onboard_doctors[1]->last_name;
         }
         else{
            $doctor2 = '';
         }
         if(!empty($onboard_doctors[2])){
           $doctor3 =', '.$onboard_doctors[2]->first_name.' '.$onboard_doctors[2]->last_name;
         }
         else{
            $doctor3 = '';
         }
         if(!empty($onboard_doctors[3])){
           $doctor4 = ', '.$onboard_doctors[3]->first_name.' '.$onboard_doctors[3]->last_name;
         }
         else{
            $doctor4 = '';
         }
         if(!empty($onboard_doctors[4])){
           $doctor5 = ', '.$onboard_doctors[4]->first_name.' '.$onboard_doctors[4]->last_name;
         }
         else{
            $doctor5 = '';
         }
         if(!empty($onboard_doctors[5])){
           $doctor6 = ', '.$onboard_doctors[5]->first_name.' '.$onboard_doctors[5]->last_name;
         }
         else{
            $doctor6 = '';
         }
         if(!empty($onboard_doctors[6])){
           $doctor7 = ', '.$onboard_doctors[6]->first_name.' '.$onboard_doctors[6]->last_name;;
         }
         else{
            $doctor7 = '';
         }
         if(!empty($onboard_doctors[7])){
           $doctor8 = ', '.$onboard_doctors[7]->first_name.' '.$onboard_doctors[7]->last_name;
         }
         else{
            $doctor8 = '';
         }
         if(!empty($onboard_doctors[8])){
           $doctor9 = ', '.$onboard_doctors[8]->first_name.' '.$onboard_doctors[8]->last_name;
         }
         else{
            $doctor9 = '';
         }
         if(!empty($onboard_doctors[9])){
           $doctor10 = 'and '.$onboard_doctors[9]->first_name.' '.$onboard_doctors[9]->last_name;
         }
         else{
            $doctor10 = '';
         }
         $hosp_address = $user->profile->address ? $user->profile->address : 'MsnSoft, 644, Near Gourmet, Airline Society, Lahore'; 
        // dd($all_doctors);
        $script_data_faqs = array (
        );
        foreach ($faqs as $faq) {
            $question1 = json_decode($faq->description)[0];
            $question = str_replace('user_slug', $user->first_name.' '.$user->last_name, $question1);
            $answer1 = json_decode($faq->description)[1];
            $answer = str_replace('user_slug',  $user->first_name.' '.$user->last_name, $answer1);
            $answer = str_replace('user_address', $hosp_address, $answer);
            $answer = str_replace('onboard_doctors',  $doctor1.' '.$doctor2.' '.$doctor3.' '.$doctor4.' '.$doctor5.' '.$doctor6.' '.$doctor7.' '.$doctor8.' '.$doctor9.' '.$doctor10, $answer);
            array_push($script_data_faqs,
            ["@type" => "Question",
                "name" => $question,
                "acceptedAnswer" => array(
                    "@type" => "Answer",
                    "text" => $answer,
                )]
            );
        }
        }
        if ($role_type == "doctor"){
        $specialities = $user->specialities->pluck('id')->toArray();          
    if(!empty($specialities)){
            // foreach ($specialities as $spec) {
                $speciality =  $user->specialities->pluck('title')->toArray();
                    // dd($speciality); 

            // }
                if(!empty($speciality[0])){
           $speciality1 = $speciality[0];
         }
         else{
            $speciality1 = '';
         }
         if(!empty($speciality[1])){
           $speciality2 = 'and '.$speciality[1];
         }
         else{
            $speciality2 = '';
         }
        }
               $degrees = [];
        $services = $user->specialities[0]->services->take(5)->pluck('title')->toArray();
        if(!empty($services[0])){
           $service1 = $services[0];
         }
         else{
            $service1 = '';
         }
         if(!empty($services[1])){
           $service2 = ','.$services[1];
         }
         else{
            $service2 = '';
         }
         if(!empty($services[2])){
           $service3 = ','.$services[2];
         }
         else{
            $service3 = '';
         }
         if(!empty($services[3])){
           $service4 = ','.$services[3];
         }
         else{
            $service4 = '';
         }
         if(!empty($services[4])){
           $service5 = 'and '.$services[4];
         }
         else{
            $service5 = '';
         }


               // dd($services);
        $educations = json_decode($user->profile->educations);
        // dd($educations);
         if(!empty($educations)){
            foreach ($educations as $education) {
               array_push($degrees,[
                "name" => $education->job_desc,
                ]
            );
        }
        // dd($degrees);
         if(!empty($degrees[0])){
           $degree1 = $degrees[0]['name'];
         }
         else{
            $degree1 = '';
         }
         if(!empty($degrees[1])){
           $degree2 = 'and '.$degrees[1]['name'];
         }
         else{
            $degree2 = '';
         }
    }
    else{
         $degree1 = '';
         $degree2 = '';
    }
        $doc_price = $user->doc_teams->min('price');
            $doc_fee = $doc_price ?? 1000;
            $day = Carbon::now()->format('l');
            $day = strtolower($day);
            // $d    = new DateTime($date);
            // $d->format('l');
            $start_end_time='';
            if(!empty($user->doc_teams[0])){
            // dd($hosp_id);
            $doc_hospital = $user->doc_teams[0]->hospital;
            $hospital_name = $doc_hospital->first_name.' '.$doc_hospital->last_name;
            if(!empty($user->doc_teams[0]->slots)){

            $available_days = json_decode($user->doc_teams[0]->slots);
            if(!empty($available_days)){
            foreach($available_days as $index => $current){
                if(!empty($current->start_end_time)){

                $start_end_time = $current->start_end_time;
                }
                else{
                    $start_end_time = '12:00 pm - 2:00 pm';
                }

            }
        }
        else{
                $start_end_time = '12:00 pm - 2:00 pm';
            }
            }
            else{
                $start_end_time = '12:00 pm - 2:00 pm';
            }
            }
            else{
                $start_end_time = '12:00 pm - 2:00 pm';
                $hospital_name = '';
            }
            // dd($start_end_time);
        $script_data_faqs = array (
        );
        foreach ($faqs as $faq) {
            $question1 = json_decode($faq->description)[0];
            $question = str_replace('user_slug', $user->first_name.' '.$user->last_name, $question1);
            $answer1 = json_decode($faq->description)[1];
            $answer = str_replace('user_slug',  $user->first_name.' '.$user->last_name, $answer1);
            $answer = str_replace('quali',  $degree1.' '.$degree2, $answer);
            $answer = str_replace('user_specialty',  $speciality1.' '.$speciality2, $answer);
            if(!empty($services)){

            $answer = str_replace('user_service',  $service1.' '.$service2.' '.$service3.' '.$service4.' '.$service5, $answer);
            }
            else{
               $answer = str_replace('user_service','', $answer); 
            }
            $answer = str_replace('user_fee',  $doc_fee, $answer);
            $answer = str_replace('avail_time',  $start_end_time, $answer);
            $answer = str_replace('doc_hospital',  $hospital_name, $answer);

            array_push($script_data_faqs,
            ["@type" => "Question",
                "name" => $question,
                "acceptedAnswer" => array(
                    "@type" => "Answer",
                    "text" => $answer,
                )]
            );
        }
        }
        // dd($script_data_faqs);
        $FAQs = Schema::FAQPage()->mainEntity($script_data_faqs);
        

        echo $FAQs->toScript();
    }
    public static function breadCrumbsStructure () {

        $script_data = [];
        $breadcrumbs = \request()->segments();
        (array_unshift($breadcrumbs , ''));

        $segments = '';
        $name = '';
        foreach ($breadcrumbs as $key => $segment) {

            if ($key > 0){
                $segments .= '/'.$segment;
            }
            else {
                $segments .= $segment;
            }
            if ($segments === '') {
                $name = 'Home';
            }
            else {
                $name = ucfirst($segment);
            }

            array_push($script_data, [
                "@type" => "ListItem",
                "position" => $key + 1,
                "item" => "https://doctorfindy.com".$segments,
                "name" => $name,
            ]);

        $breadcrumbList = Schema::BreadcrumbList()->itemListElement($script_data);
        }

        echo $breadcrumbList->toScript();
    }
    public static function localBusinessStructure ($type, $speciality, $location,$disease,$service,$users) {
        // dd($type, $speciality, $location,$disease,$service,$users);
        $all_user = [];
        $faqs = [];
        $all_faqs = [];
        $script_data_faqs = [];
        $onboard_doctors = $users->take(10);
        $users = $users->take(4);
        if($type === 'doctor'){
        if ($users != null || $users != '') {
            foreach ($users as $key => $user) {
             $all_user[] = self::doctorProfileStructure ($user);
            }
        }
    }
    if($type === 'hospital'){
        if ($users != null || $users != '') {
            foreach ($users as $key => $user) {
             $all_user[] = self::hospitalProfileStructure ($user);
            }
        }
    }
    if($type === 'laboratory'){
        if ($users != null || $users != '') {
            foreach ($users as $key => $user) {
             $all_user[] = self::labProfileStructure ($user);
            }
        }
    }
        $siteUrl = url('/');
        $image = $siteUrl. '/images/KnockDock.png';
        $name = 'DoctorFindy | Find and Book Best Doctors';
        if(!empty($location)){
            $locationSlug = $location->title;
            $locationSlug = $locationSlug.' ';
        }
        else{
            $locationSlug = '';
        }
        if(!empty($onboard_doctors[0])){
           $doctor1 = $onboard_doctors[0]->first_name.' '.$onboard_doctors[0]->last_name;
         }
         else{
            $doctor1 = '';
         }
         if(!empty($onboard_doctors[1])){
           $doctor2 = ', '.$onboard_doctors[1]->first_name.' '.$onboard_doctors[1]->last_name;
         }
         else{
            $doctor2 = '';
         }
         if(!empty($onboard_doctors[2])){
           $doctor3 =', '.$onboard_doctors[2]->first_name.' '.$onboard_doctors[2]->last_name;
         }
         else{
            $doctor3 = '';
         }
         if(!empty($onboard_doctors[3])){
           $doctor4 = ', '.$onboard_doctors[3]->first_name.' '.$onboard_doctors[3]->last_name;
         }
         else{
            $doctor4 = '';
         }
         if(!empty($onboard_doctors[4])){
           $doctor5 = ', '.$onboard_doctors[4]->first_name.' '.$onboard_doctors[4]->last_name;
         }
         else{
            $doctor5 = '';
         }
         if(!empty($onboard_doctors[5])){
           $doctor6 = ', '.$onboard_doctors[5]->first_name.' '.$onboard_doctors[5]->last_name;
         }
         else{
            $doctor6 = '';
         }
         if(!empty($onboard_doctors[6])){
           $doctor7 = ', '.$onboard_doctors[6]->first_name.' '.$onboard_doctors[6]->last_name;;
         }
         else{
            $doctor7 = '';
         }
         if(!empty($onboard_doctors[7])){
           $doctor8 = ', '.$onboard_doctors[7]->first_name.' '.$onboard_doctors[7]->last_name;
         }
         else{
            $doctor8 = '';
         }
         if(!empty($onboard_doctors[8])){
           $doctor9 = ', '.$onboard_doctors[8]->first_name.' '.$onboard_doctors[8]->last_name;
         }
         else{
            $doctor9 = '';
         }
         if(!empty($onboard_doctors[9])){
           $doctor10 = 'and '.$onboard_doctors[9]->first_name.' '.$onboard_doctors[9]->last_name;
         }
         else{
            $doctor10 = '';
         }
         // dd($disease);
        if ($speciality && $speciality != null && $speciality != '') {
            $faqs = $speciality->faqsAssign;
            $id =  $speciality->id;
            $name = 'Best '.ucfirst($type) . ' for ' . $speciality->title.' in '.$locationSlug.'Pakistan' ;
            $image = $siteUrl.'/uploads/specialities/'.$speciality->image;
            $script_data_faqs = [];

        foreach ($faqs as $faq) {
            $question1 = json_decode($faq->faqs->description)[0];
            $question = str_replace('Slug in City', $speciality->title.' in '.$locationSlug.'Pakistan', $question1);
            $answer1 = json_decode($faq->faqs->description)[1];
            $answer = str_replace('Slug in City', $speciality->title.' in '.$locationSlug.'Pakistan', $answer1);
            $answer = str_replace('onboard_doctors',  $doctor1.' '.$doctor2.' '.$doctor3.' '.$doctor4.' '.$doctor5.' '.$doctor6.' '.$doctor7.' '.$doctor8.' '.$doctor9.' '.$doctor10, $answer);
            array_push($script_data_faqs,
            ["@type" => "Question",
                "name" => $question,
                "acceptedAnswer" => array(
                    "@type" => "Answer",
                    "text" => $answer,
                )]
            );
        }
        $FAQs = Schema::FAQPage()->mainEntity($script_data_faqs);
        

        echo $FAQs->toScript();
        }
        if ($location != null && $location != '' && !$speciality && !$service && ! $disease) {
            $id =  $location->id;
             $name = 'Best '.$type . ' for ' . $location->title.' Pakistan' ;
            $image = $siteUrl.'/uploads/locations/'.$location->image;
        }
        if ($service && $service != null && $service != '') {
            $faqs = $service->faqsAssign;
            $id =  $service->id;
             $name = 'Best '.ucfirst($type) . ' for ' . $service->title.' treatment in '.$locationSlug.'Pakistan' ;
            $image = $siteUrl.'/uploads/services/'.$service->image;
              $script_data_faqs = [];
             foreach ($faqs as $faq) {
            $question1 = json_decode($faq->faqs->description)[0];
            $question = str_replace('SlugBoth in City', $service->title.' treatment in '.$locationSlug.'Pakistan', $question1);
            $answer1 = json_decode($faq->faqs->description)[1];
            $answer = str_replace('SlugBoth in City', $service->title.' treatment in '.$locationSlug.'Pakistan', $answer1);
            $answer = str_replace('onboard_doctors',  $doctor1.' '.$doctor2.' '.$doctor3.' '.$doctor4.' '.$doctor5.' '.$doctor6.' '.$doctor7.' '.$doctor8.' '.$doctor9.' '.$doctor10, $answer);
            array_push($script_data_faqs,
            ["@type" => "Question",
                "name" => $question,
                "acceptedAnswer" => array(
                    "@type" => "Answer",
                    "text" => $answer,
                ),]
            );
        }
        $FAQs = Schema::FAQPage()->mainEntity($script_data_faqs);
        

        echo $FAQs->toScript();
        }
         if ($disease && $disease != null && $disease != '') {
            // dd('a');
            $faqs = $disease->faqsAssign;
            $id =  $disease->id;
             $name = 'Best '.ucfirst($type) . ' for ' . $disease->title.' disease in '.$locationSlug.'Pakistan' ;
            $image = $siteUrl.'/uploads/diseases/'.$disease->image;
              $script_data_faqs = [];
             foreach ($faqs as $faq) {
            $question1 = json_decode($faq->faqs->description)[0];
            $question = str_replace('SlugBoth in City', $disease->title.' disease in '.$locationSlug.'Pakistan', $question1);
            $answer1 = json_decode($faq->faqs->description)[1];
            $answer = str_replace('SlugBoth in City', $disease->title.' disease in '.$locationSlug.'Pakistan', $answer1);
            $answer = str_replace('onboard_doctors',  $doctor1.' '.$doctor2.' '.$doctor3.' '.$doctor4.' '.$doctor5.' '.$doctor6.' '.$doctor7.' '.$doctor8.' '.$doctor9.' '.$doctor10, $answer);
            array_push($script_data_faqs,
            ["@type" => "Question",
                "name" => $question,
                "acceptedAnswer" => array(
                    "@type" => "Answer",
                    "text" => $answer,
                ),]
            );
        }
        $FAQs = Schema::FAQPage()->mainEntity($script_data_faqs);
        

        echo $FAQs->toScript();
        }
        $LocalBusiness = Schema::LocalBusiness()->name($name)->image($image)->publicAccess('true')->priceRange('PKR 1000 - 2500')->aggregateRating(array(
                    "@type" => "AggregateRating",
                    "ratingValue" => 4.9,
                    "worstRating" => 2,
                    "bestRating" => 5,
                    "reviewCount" => rand(575,599),
                ))->address(array(
                    "@type" => "PostalAddress",
                    "streetAddress" => "MsnSoft, 644, Near Gourmet",
                    "addressLocality" => "Airline Society",
                    "addressRegion" => "Lahore",
                    "postalCode" => "54000",
                    "name" => "DoctorFindy",
                    "telephone" => "0345-0435621",
                ))->geo(array(
                    "@type" => "GeoCoordinates",
                    "latitude" => "31.435049",
                    "longitude" => "74.269876",
                ));

        echo $LocalBusiness->toScript();
    }
    public static function organizationStructure() {
        $socials_settings = SiteManagement::getMetaValue('socials');
        $facebook_url = !empty($socials_settings[0]->url) ? $socials_settings[0]->url : '';
        $twitter_url = !empty($socials_settings[1]->url) ? $socials_settings[1]->url : '';
        $linkedin_url = !empty($socials_settings[2]->url) ? $socials_settings[2]->url : '';
        $instagram_url = !empty($socials_settings[3]->url) ? $socials_settings[3]->url : '';
        $youtube_url = !empty($socials_settings[4]->url) ? $socials_settings[4]->url : '';
        
         $localBusiness = Schema::Organization()
    ->name('DoctorFindy | Find Best Doctors, Hospitals and Book Lab Tests Near You')
    ->url('https://doctorfindy.com/')
    ->email('info@msnsoft.org')
    ->logo(asset(Helper::getGeneralSettings('site_logo')))
    ->description("Your next most loved arrangement booking framework. Find and book arrangements online with the best wellbeing experts. Get you wellbeing concerns tackled quicker by connecting with specialists, emergency clinics and facilities in an a lot simpler way!")
    ->foundingDate('2020')
    ->sameAS(array($facebook_url,$twitter_url,$linkedin_url,$instagram_url,$youtube_url))
    ->areaServed(array(array("@type" => "GeoCircle",
   "name" => "Lahore",
   "geoMidpoint" => array(
    "@type" => "GeoCoordinates",
    "latitude" => "31.46393750",
    "longitude" => "74.39043750"
   ),
   "geoRadius" => 50,
  ),array(
   "@type" => "GeoCircle",
   "name" => "Karachi",
   "geoMidpoint" => array(
    "@type" => "GeoCoordinates",
    "latitude" => "24.86785880",
    "longitude" => "67.07956600"
   ),
   "geoRadius" => 50,
  ),array(
   "@type" => "GeoCircle",
   "name" => "Islamabad",
   "geoMidpoint" => array(
    "@type" => "GeoCoordinates",
    "latitude" => "33.64154130",
    "longitude" => "73.07422210"
   ),
   "geoRadius" => 50,
  ),array(
   "@type" => "GeoCircle",
   "name" => "Rawalpindi",
   "geoMidpoint" => array(
    "@type" => "GeoCoordinates",
    "latitude" => "33.64154130",
    "longitude" => "73.07422210"
   ),
   "geoRadius" => 50,
  ),array(
   "@type" => "GeoCircle",
   "name" => "Faisalabad",
   "geoMidpoint" => array(
    "@type" => "GeoCoordinates",
    "latitude" => "31.43326780",
    "longitude" => "73.10815790"
   ),
   "geoRadius" => 50,
  ),array(
   "@type" => "GeoCircle",
   "name" => "Peshawar",
   "geoMidpoint" => array(
    "@type" => "GeoCoordinates",
    "latitude" => "33.64154130",
    "longitude" => "73.07422210"
   ),
   "geoRadius" => 50,
  ),array(
   "@type" => "GeoCircle",
   "name" => "Multan",
   "geoMidpoint" => array( 
    "@type" => "GeoCoordinates",
    "latitude" => "24.86785880",
    "longitude" => "67.07956600"
   ),
   "geoRadius" => 50,
  ),array(
   "@type" => "GeoCircle",
   "name" => "Gujranwala",
   "geoMidpoint" => array(
    "@type" => "GeoCoordinates",
    "latitude" => "31.46393750",
    "longitude" => "74.39043750"
   ),
   "geoRadius" => 50,
  ),array(
   "@type" => "GeoCircle",
   "name" => "Abbottabad",
   "geoMidpoint" => array(
    "@type" => "GeoCoordinates",
    "latitude" => "33.64154130",
    "longitude" => "73.07422210"
   ),
   "geoRadius" => 50,
  ),array(
   "@type" => "GeoCircle",
   "name" => "Bahawalnagar",
   "geoMidpoint"  => array(
    "@type" => "GeoCoordinates",
    "latitude" => "31.46393750",
    "longitude" => "74.39043750"
   ),
   "geoRadius" => 50,
  )))->address(array(
            "@type" => "PostalAddress",
            "streetAddress" => "MsnSoft, 644, Near Gourmet,",
            "addressLocality" => "Airline Society",
            "addressRegion" => "Lahore",
            "postalCode" => "54000",
            "addressCountry" =>array(
                "@type" => "Country",
                "name" => "Pakistan"
                )
            ))
    ->contactPoint(array(
                "@type" => "ContactPoint",
                "telephone" => " 0345-0435621",
                "contactType" => "Customer Service (Call Center)",
                "email" => "info@msnsoft.org",
                "areaServed" => "Pakistan",
            ));
echo $localBusiness->toScript();
    }

    public static function diseaseDoctor($request){
        $data = $request->user_meta()->get();
        return !empty($data) ? $data : '';
    }
    public static function specialityDoctor($request){
        $data = $request->user()->get();
        return !empty($data) ? $data : '';
    }

    //sms
    // public static function sendSms($text,$number){
    //     if($text != "" && $number != ""){
    //         $random_string = Str::random(32);
    //         Http::get('http://api.itelservices.com/send.php', [
    //             'transaction_id' => $random_string,
    //             'user' => env('DAY_WISE_SMS_USER'),
    //             'pass' => env('DAY_WISE_SMS_PASS'),
    //             'number' => $number,
    //             'text' => $text,
    //             'from' => env('DAY_WISE_SMS_SENDER_ID'),
    //             'type' => 'sms'
    //         ]);
    //         return 'success';
    //     }

    //     return 'failed';

    // }

    public static function getPatientsInvoices($doctor_id){
        $reciept_data = array();
         if (self::getAuthRoleType() == 'doctor') {
             $all_appointments = Auth::user()->appointments()->where('appointment_date',date('Y-m-d'))->get();
              
              return $all_appointments;

            // foreach ($all_appointments as $key => $data) {

            // $order_metas =   DB::table('orders')->where("user_id",$data->patient_id)->get();
            //     dd($order_metas);
            // }
        }
        return false;
    }

    public static function editLocation($id){
        if (Auth::user() && !empty($id)) {
            $user = User::find(Auth::user()->id);
            $location = Team::where('user_id',$id)->first();
            $slots = json_decode($location->slots, true);
            $days = Helper::getAppointmentDays();
            $intervals = Helper::getAppointmentIntervals();
            $durations = Helper::getAppointmentDuration();
            $spaces = Helper::getAppointmentSpaces();
            $appointment_days = !empty($slots['days']) ? $slots['days'] : array();
            $doctor_specialities = !empty($user->profile->services) ? json_decode($user->profile->services, true) : array();
            $service_price = !empty($slots['services']['price']) ? $slots['services']['price'] : '';
            $services = '';
            $services .=  View::make('back-end.doctors.appointment_locations.edit.services',compact('id',
                'location',
                'slots',
                'days',
                'intervals',
                'durations',
                'spaces',
                'doctor_specialities',
                'service_price',
                'appointment_days'))->render();
        }

        // return $services;
    }
    public static function  getMeta($type,$diseases,$location,$area,$service,$speciality,$gender,$video_consultation){

        $route_name = request()->route()->getName();
        if (request()->route()->getName() === 'loc-area-spec-gen'
            ||
            request()->route()->getName() === 'loc-spec-gen')
        {
            $gender = request()->route()->parameters['gender'];
            $location = request()->route()->parameters['location'];
            $speciality = request()->route()->parameters['speciality'];

            if (request()->route()->getName() === 'loc-spec-gen') {
                $page_title = 'Best '. ucfirst(request()->route()->parameters['gender']) . ' ' . ucfirst(request()->route()->parameters['speciality']) .' In ' . ucfirst(request()->route()->parameters['location']) .' | Instant Appointment Booking‎ - DoctorFindy';
                $meta_title = 'Best '. ucfirst(request()->route()->parameters['gender']) . ' ' . ucfirst(request()->route()->parameters['speciality']) .' In '. ucfirst(request()->route()->parameters['location']) .' | Instant Appointment Booking‎ - DoctorFindy';
                $meta_description = 'Book Online Appointment with Best ' . ucfirst(request()->route()->parameters['gender']) . ' ' . ucfirst(request()->route()->parameters['speciality']) .' in ' . ucfirst(request()->route()->parameters['location']) . ' Or Get Online Consultation With Verified Doctors Details, Fees, Contact Number And Timings.';
            }
            else {
                $page_title = 'Best '. ucfirst(request()->route()->parameters['gender']) . ' ' . ucfirst(request()->route()->parameters['speciality']) .' In '. ucwords(str_replace('-', ' ', request()->route()->parameters['area'])) . ' ' . ucfirst(request()->route()->parameters['location']) .' | Instant Appointment Booking‎ - DoctorFindy';
                $meta_title = 'Best '. ucfirst(request()->route()->parameters['gender']) . ' ' . ucfirst(request()->route()->parameters['speciality']) .' In '. ucwords(str_replace('-', ' ', request()->route()->parameters['area'])) . ', ' . ucfirst(request()->route()->parameters['location']) .' | Instant Appointment Booking‎ - DoctorFindy';
                $meta_description = 'Book Online Appointment with Best ' . ucfirst(request()->route()->parameters['gender']) . ' ' . ucfirst(request()->route()->parameters['speciality']) .' in ' . ucfirst(request()->route()->parameters['location']) . ' Or Get Online Consultation With Verified Doctors Details, Fees, Contact Number And Timings.';
                 $area = request()->route()->parameters['area'];
            }
            $type = 'doctor';
        }
        switch ($route_name) {
          case "specialityDetails":
            $speciality = request()->route()->parameters['slug'];
            $type = 'doctor';
            break;
          case "all-laboratories":
            $page_title = 'Book Appointment Online with Best Labs in Pakistan | DoctorFindy';
            $meta_title = 'Book Appointment Online with Best Labs in Pakistan | DoctorFindy';
            $meta_description = 'Get Lab Test and Consultation with Qualified Specialist Doctors, Surgeons, physicians in Labs. You can Ask a Doctor Online 24/7 from Anywhere all across Pakistan';
            $type = 'laboratory';
            break;
          case "online-consultation":
            $page_title = 'Online Doctor Consultation | DoctorFindy';
            $meta_title = 'Consult Online Doctor in Pakistan | Ask a Doctor Online - DoctorFindy';
            $meta_description = 'Get Video consultation with Qualified Specialist Doctors, Surgeons, physicians. You can Ask a Doctor Online 24/7 from Anywhere all across Pakistan';
            $video_consultation = 'on';
            $type = 'doctor';
            break;
          case "online-consultation-with-speciality":
            $page_title = 'Ask A '. ucfirst(request()->route()->parameters['speciality']) .' Online | Consult A '. ucfirst(request()->route()->parameters['speciality']) .' Online In Pakistan';
            $meta_title = 'Ask A '. ucfirst(request()->route()->parameters['speciality']) .' Online | Consult A '. ucfirst(request()->route()->parameters['speciality']) .' Online In Pakistan';
            $meta_description = 'Get Video consultation with Best '.ucfirst(request()->route()->parameters['speciality']).' in Pakistan. You can Ask a '.ucfirst(request()->route()->parameters['speciality']). ' Online 24/7 from Anywhere all across Pakistan and receive instant medical advice.';
            $video_consultation = 'on';
            $speciality = request()->route()->parameters['speciality'];
            $type = 'doctor';
            break;
          case "online-consultation-with-speciality-with-location":
            $video_consultation = 'on';
            $speciality = request()->route()->parameters['speciality'];
            $location = request()->route()->parameters['location'];
            $type = 'doctor';
            break;
          case "searchResults":
            $type = 'doctor';
            break;
          case "all-doctors":
            $type = 'doctor';
            break;
          case "all-hospitals":
            $type = 'hospital';
            break;
          case "doctors-location-area":
            $page_title = 'Best Doctors In ' . ucwords(str_replace('-', ' ', request()->route()->parameters['area']) .' ' . ucfirst(request()->route()->parameters['location']) . ' | Get Appointment Online - DoctorFindy');
            $meta_title = 'Best Doctors In ' . ucwords(str_replace('-', ' ', request()->route()->parameters['area']) .' ' . ucfirst(request()->route()->parameters['location']) . ' | Get Appointment Online - DoctorFindy');
            $meta_description = 'Book appointment or consult online with Best Doctors In '. ucwords(str_replace('-', ' ', request()->route()->parameters['area'])). ' '. ucfirst(request()->route()->parameters['location']) .' View verified details of doctors timings, contact number, Fees, address & reviews.';
            $area = request()->route()->parameters['area'];
            $location = request()->route()->parameters['location'];
            $type = 'doctor';
            break;
          case "hospitals-location-area":
            $page_title = 'Best Hospitals In ' . ucwords(str_replace('-', ' ', request()->route()->parameters['area']) .' ' . ucfirst(request()->route()->parameters['location']) . ' | Get Appointment Online - DoctorFindy');
            $meta_title = 'Best Hospitals In ' . ucwords(str_replace('-', ' ', request()->route()->parameters['area']) .' ' . ucfirst(request()->route()->parameters['location']) . ' | Get Appointment Online - DoctorFindy');
            $meta_description = 'Book appointment or consult online with Best Doctors In '. ucwords(str_replace('-', ' ', request()->route()->parameters['area'])). ' '. ucfirst(request()->route()->parameters['location']) .' View verified details of doctors timings, contact number, Fees, address & reviews.';
            $area = request()->route()->parameters['area'];
            $location = request()->route()->parameters['location'];
            $type = 'hospital';
            break;
          case "laboratories-location-area":
            $area = request()->route()->parameters['area'];
            $location = request()->route()->parameters['location'];
            $type = 'laboratory';
            break;
          case "specialityDetailsLocation":
            $speciality = request()->route()->parameters['slug'];
            $area = request()->route()->parameters['slug'];
            $location = request()->route()->parameters['location'];

            $type = 'doctor';
            break;
          case "doctors-speciality-city":
            $speciality = request()->route()->parameters['slug'];
            $area = request()->route()->parameters['area'];
            $location = request()->route()->parameters['location'];
            $type = 'doctor';
            break;
          case "diseasesDetails":
          case "diseasesDetailsPakistan":
            $page_title = 'Best Doctors For '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' Treatment In Pakistan - DoctorFindy';
            $meta_title = 'Best Doctors For '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' Treatment In Pakistan - DoctorFindy';
            $meta_description = 'Appointment Or Consult Online with Best Doctors For '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) .' Treatment In Pakistan. View Complete Details Doctor Timings, Address, Fees and reviews.';
            $diseases = request()->route()->parameters['slug'];
            $type = 'doctor';
            break;
          case "diseasesDetailsLocation":
            $page_title = 'Best Doctors For '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' Treatment In ' . ucfirst(request()->route()->parameters['location']) . ' - DoctorFindy';
            $meta_title = 'Best Doctors For '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' Treatment In ' . ucfirst(request()->route()->parameters['location']) . ' - DoctorFindy';
            $meta_description = 'Appointment Or Consult Online with Best Doctors For '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' Treatment In ' . ucfirst(request()->route()->parameters['location']) . '. View Complete Details Doctor Timings, Address, Fees and reviews.';
            $diseases = request()->route()->parameters['slug'];
            $location = request()->route()->parameters['location'];
            $type = 'doctor';
            break;
          case "diseasesDetailsLocationArea":
            $page_title = 'Best Doctors of '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' in ' . ucwords(str_replace('-', ' ', request()->route()->parameters['area'])) . ', ' . ucfirst(request()->route()->parameters['location']) .' | DoctorFindy';
            $meta_title = 'Best Doctors of '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' in ' . ucwords(str_replace('-', ' ', request()->route()->parameters['area'])) . ', ' . ucfirst(request()->route()->parameters['location']) .' | DoctorFindy';
            $meta_description = 'Best Doctors of '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' in ' . ucwords(str_replace('-', ' ', request()->route()->parameters['area'])) . ', ' . ucfirst(request()->route()->parameters['slug']) .'. Get Appointment online with Best Doctors in ' . ucwords(str_replace('-', ' ', request()->route()->parameters['area']));
            $diseases = request()->route()->parameters['slug'];
            $location = request()->route()->parameters['location'];
            $area = request()->route()->parameters['area'];
            $type = 'doctor';
            break;
          case "servicesDetails":
            $page_title = 'Best Doctors For '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' Treatment In Pakistan - DoctorFindy';
            $meta_title = 'Best Doctors For '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' Treatment In Pakistan - DoctorFindy';
            $meta_description = 'Appointment Or Consult Online with Best Doctors For '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) .' Treatment In Pakistan. View Complete Details Doctor Timings, Address, Fees and reviews.';
            $service = request()->route()->parameters['slug'];
            $type = 'doctor';
            break;
          case "servicesDetailsLocation":
            $page_title = 'Best Doctors For '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' Treatment In ' . ucfirst(request()->route()->parameters['location']) . ' - DoctorFindy';
            $meta_title = 'Best Doctors For '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' Treatment In ' . ucfirst(request()->route()->parameters['location']) . ' - DoctorFindy';
            $meta_description = 'Appointment Or Consult Online with Best Doctors For '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' Treatment In ' . ucfirst(request()->route()->parameters['location']) . '. View Complete Details Doctor Timings, Address, Fees and reviews.';
            $service = request()->route()->parameters['slug'];
            $location = request()->route()->parameters['location'];
            $type = 'doctor';
            break;
          case "servicesDetailsLocationArea":
            $page_title = 'Best Doctors of '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' in ' . ucwords(str_replace('-', ' ', request()->route()->parameters['area'])) . ', ' . ucfirst(request()->route()->parameters['location']) .' | DoctorFindy';
            $meta_title = 'Best Doctors of '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' in ' . ucwords(str_replace('-', ' ', request()->route()->parameters['area'])) . ', ' . ucfirst(request()->route()->parameters['location']) .' | DoctorFindy';
            $meta_description = 'Best Doctors of '. ucwords(str_replace('-', ' ', request()->route()->parameters['slug'])) . ' in ' . ucwords(str_replace('-', ' ', request()->route()->parameters['area'])) . ', ' . ucfirst(request()->route()->parameters['slug']) .'. Get Appointment online with Best Doctors in ' . ucwords(str_replace('-', ' ', request()->route()->parameters['area']));
            $service = request()->route()->parameters['slug'];
            $location = request()->route()->parameters['location'];
            $area = request()->route()->parameters['area'];
            $type = 'doctor';
            break;
          case "speciality-by-location":
            if (\request()->route()->parameters['location'] !== 'pakistan')
            {
                $location = request()->route()->parameters['location'];
            }
            else {
                $location = null;
            }
            $page_title = 'Best ' . ucfirst(request()->route()->parameters['slug']) . ' In '. ucfirst(request()->route()->parameters['location']) .' | Instant Appointment Booking‎ - DoctorFindy';
            $meta_title = 'Best ' . ucfirst(request()->route()->parameters['slug']) . ' In '. ucfirst(request()->route()->parameters['location']) .' | Instant Appointment Booking‎ - DoctorFindy';
            $meta_description = 'Book Online Appointment with Best '. ucfirst(request()->route()->parameters['slug']) .' in '. ucfirst(request()->route()->parameters['location']) .' Or Get Online Consultation With Verified Doctors Details, Fees, Contact Number And Timings.';
            $speciality = request()->route()->parameters['slug'];
            $type = 'doctor';
            break;
          case "speciality":
           $page_title = 'Best ' . ucfirst(request()->route()->parameters['slug']) . ' In Pakistan | Instant Appointment Booking‎ - DoctorFindy';
            $meta_title = 'Best ' . ucfirst(request()->route()->parameters['slug']) . ' In Pakistan | Instant Appointment Booking‎ - DoctorFindy';
            $meta_description = 'Book Online Appointment with Best '. ucfirst(request()->route()->parameters['slug']) .' in Pakistan Or Get Online Consultation With Verified Doctors Details, Fees, Contact Number And Timings.';
            $speciality = request()->route()->parameters['slug'];
            $type = 'doctor';
            break;
          case "doctors-by-city":
            $page_title = 'Best Doctors In '. ucfirst(request()->route()->parameters['slug']) .' | Get Appointment Online - DoctorFindy';
            $meta_title = 'Best Doctors In '. ucfirst(request()->route()->parameters['slug']) .' | Get Appointment Online - DoctorFindy';
            $meta_description = 'Book appointment or consult online with Best Doctors In ' . ucfirst(request()->route()->parameters['slug']) . ' View verified details of doctors timings, contact number, Fees, address & reviews.';
            if (\request()->route()->parameters['slug'] !== 'pakistan')
            {
                $location = request()->route()->parameters['slug'];
            }
            $type = 'doctor';
            break;
          case "hospitals-by-city":
            $page_title = 'Best Hospitals in ' . ucfirst(request()->route()->parameters['slug']) . ' | Doctors List, Address And Contact Number - DoctorFindy';
            $meta_title = 'Best Hospitals in ' . ucfirst(request()->route()->parameters['slug']) . ' | Doctors List, Address And Contact Number - DoctorFindy';
            $meta_description = 'Find the Best Hospitals with complete details about the Doctors List, Address And Contact Number of all government and private hospitals in ' . ucfirst(request()->route()->parameters['slug']) . '.';
            $location = request()->route()->parameters['slug'];
            $type = 'hospital';
            break;
          case "laboratory-by-city":
            $page_title = 'Best Labs in ' . ucfirst(request()->route()->parameters['slug']) . ' | Doctors List, Address And Contact Number - DoctorFindy';
            $meta_title = 'Best Labs in ' . ucfirst(request()->route()->parameters['slug']) . ' | Doctors List, Address And Contact Number - DoctorFindy';
            $meta_description = 'Find the Best Labs with complete details about the Doctors List, Address And Contact Number of all government and private hospitals in ' . ucfirst(request()->route()->parameters['slug']) . '.';
            $location = request()->route()->parameters['slug'];
            $type = 'laboratory';
            break;
          case "laboratories-speciality-city":
            $page_title = 'Best Labs of '. ucfirst(request()->route()->parameters['slug']) .' in ' . ucfirst(request()->route()->parameters['location']) . ' | Doctors List, Address And Contact Number - DoctorFindy';
            $meta_title = 'Best Labs of '. ucfirst(request()->route()->parameters['slug']) .' in ' . ucfirst(request()->route()->parameters['location']) . ' | Doctors List, Address And Contact Number - DoctorFindy';
            $meta_description = 'Find the Best Hospitals with complete details about the Doctors List, Address And Contact Number of all government and private Labs in ' . ucfirst(request()->route()->parameters['location']) . '.';
            $speciality = request()->route()->parameters['slug'];
            if (request()->route()->parameters['slug'] == 'male' || request()->route()->parameters['slug'] == 'female') {
                $gender = request()->route()->parameters['slug'];

            }
            else {
                $area = request()->route()->parameters['slug'];
                $location = request()->route()->parameters['location'];
            }
            $type = 'laboratory';
            break;
          case "hospitals-speciality-city":
            $location = request()->route()->parameters['location'];
            $speciality = request()->route()->parameters['slug'];
            $area = request()->route()->parameters['slug'];
            $type = 'hospital';
            break;
          default:
           $type = $type;
        }

        $meta_data = array("type"=>$type,"diseases"=>$diseases,"location"=>$location,"area"=>$area,"service"=>$service,"speciality"=>$speciality,"gender"=>$gender,"video_consultation"=>$video_consultation);
        
        return (object)$meta_data;
    }
     public static function procedureFaqStructure ($faqs) {
        $script_data_faqs = array (
        );
        foreach ($faqs as $faq) {
            $question = json_decode($faq->faqs->description)[0];
            $answer = json_decode($faq->faqs->description)[1];
            // dd($question);   
            array_push($script_data_faqs,
            ["@type" => "Question",
                "name" => $question,
                "acceptedAnswer" => array(
                    "@type" => "Answer",
                    "text" => $answer,
                )]
            );
        }
        $FAQs = Schema::FAQPage()->mainEntity($script_data_faqs);
        

        echo $FAQs->toScript();
     }
}
