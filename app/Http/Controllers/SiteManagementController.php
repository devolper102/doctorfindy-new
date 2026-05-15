<?php

/**
 * Class SiteManagementController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use DB;
use File;
use Auth;
use Session;
use App\Helper;
use App\Speciality;
use App\SiteManagement;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Page;
use App\Location;
use Illuminate\Support\Arr;
/**
 * Class SiteManagementController
 *
 */
class SiteManagementController extends Controller
{
    /**
     * Defining scope of variable
     *
     * @access public
     * @var    array $category
     */
    protected $settings;

    /**
     * Create a new controller instance.
     *
     * @param mixed $settings get site-management model
     *
     * @return void
     */
    public function __construct(SiteManagement $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Show home page settings form.
     *
     * @access public
     *
     * @return View
     */
    public function homePageSettings()
    {
        if (Auth::user()) {
            $home_slides = $this->settings::getMetaValue('home_slider');
            $slider_bg_image = $this->settings::where('meta_key', 'slider_bg_img')->select('meta_value')->pluck('meta_value')->first();
            $home_search_banner = $this->settings::getMetaValue('home_search_banner'); //Search Banner
            // $search_form_title = !empty($home_search_banner['search_form_title']) ? $home_search_banner['search_form_title'] : '';
            // $search_banner_heading = !empty($home_search_banner['search_banner_heading']) ? $home_search_banner['search_banner_heading'] : '';
            // $search_banner_subheading = !empty($home_search_banner['search_banner_subheading']) ? $home_search_banner['search_banner_subheading'] : '';
            // $search_banner_btn_title = !empty($home_search_banner['search_banner_btn_title']) ? $home_search_banner['search_banner_btn_title'] : '';
            // $search_banner_btn_url = !empty($home_search_banner['search_banner_btn_url']) ? $home_search_banner['search_banner_btn_url'] : '';
            // $search_banner_img = !empty($home_search_banner['hidden_search_banner_img']) ?  $home_search_banner['hidden_search_banner_img'] : '';
            // $search_banner_icon = !empty($home_search_banner['search_banner_icon']) ? $home_search_banner['search_banner_icon'] : '';
            $home_doctor_sec = $this->settings::getMetaValue('home_doctor_sec'); // About us section

            $doctor_title = !empty($home_doctor_sec->title) ? $home_doctor_sec->title : '';

            $doctor_subtitle = !empty($home_doctor_sec->subtitle) ? $home_doctor_sec->subtitle : '';
            $doctor_btn_one_title = !empty($home_doctor_sec->btn_one_title) ? $home_doctor_sec->btn_one_title : '';
            $doctor_btn_one_url = !empty($home_doctor_sec->btn_one_url) ? $home_doctor_sec->btn_one_url : '';
            $about_img = !empty($home_doctor_sec->hidden_about_us_img) ? $home_doctor_sec->hidden_about_us_img : '';

  

            $subscribe_now_sec = $this->settings::getMetaValue('subscribe_now_sec'); // Subscribe Now section
            $subscribe_title = !empty($subscribe_now_sec->title) ? $subscribe_now_sec->title : '';
            $subscribe_desc = !empty($subscribe_now_sec->hw_desc) ? $subscribe_now_sec->hw_desc : '';
            $home_how_works_tabs = $this->settings::getMetaValue('how_work_tabs'); //How it Works Tabs
            $header_service = $this->settings::getMetaValue('header_service'); //Header Service Tabs

            $for_labs_benefits_of_knockdoc = $this->settings::getMetaValue('for_labs_benefits_of_knockdoc'); //for_labs_benefits_of_knockdoc

            $health_community_slider = $this->settings::getMetaValue('health_community_slider'); //Health Community Slider Tabs
            $benefits_online_profile = $this->settings::getMetaValue('benefits_online_profile'); //How it Benefits Online Profile Tabs
            $benefits_online_doctor = $this->settings::getMetaValue('benefits_online_doctor'); //How it Benefits Online Doctor Tabs
            $tabs_unserialize_array = SiteManagement::getMetaValue('services_tab_sec'); //Services Tabs
            $home_download_app = $this->settings::getMetaValue('download_app_sec'); //Download App section
            $app_sec_title = !empty($home_download_app->title) ? $home_download_app->title : '';
            $app_sec_subtitle = !empty($home_download_app->subtitle) ? $home_download_app->subtitle : '';
            $app_sec_desc = !empty($home_download_app->description) ? $home_download_app->description : '';
            $app_sec_img = !empty($home_download_app->app_sec_img) ? $home_download_app->app_sec_img : '';
            $android_img = !empty($home_download_app->android_img) ? $home_download_app->android_img : '';
            $app_android_url = !empty($home_download_app->android_url) ? $home_download_app->android_url : '';
            $ios_img = !empty($home_download_app->ios_img) ? $home_download_app->ios_img : '';
            $app_ios_url = !empty($home_download_app->ios_url) ? $home_download_app->ios_url : '';
            $data_protection = $this->settings::getMetaValue('data_protection'); //Data Protection Section

            $data_protection_title = !empty($data_protection->title) ? $data_protection->title : '';
            $data_protection_subtitle = !empty($data_protection->subtitle) ? $data_protection->subtitle : '';
            $data_protection_desc = !empty($data_protection->description) ? $data_protection->description : '';
            $data_protection_img = !empty($data_protection->hidden_data_protection_img) ? $data_protection->hidden_data_protection_img : '';
            $health_community_banner = $this->settings::getMetaValue('health_community_banner'); //Health Community Banner
            $health_community_title = !empty($health_community_banner->title) ? $health_community_banner->title : '';
            $health_community_subtitle = !empty($health_community_banner->subtitle) ? $health_community_banner->subtitle : '';
            $health_community_img = !empty($health_community_banner->hidden_health_community_img) ? $health_community_banner->hidden_health_community_img : '';
            $doctor_inner_section = $this->settings::getMetaValue('list_doctor_inner_section'); //Health Community Banner
            $doctor_inner_title = !empty($doctor_inner_section->title) ? $doctor_inner_section->title : '';
            $doctor_inner_subtitle = !empty($doctor_inner_section->subtitle) ? $doctor_inner_section->subtitle : '';
            $doctor_inner_description = !empty($doctor_inner_section->description) ? $doctor_inner_section->description : '';
            $doctor_inner_btn = !empty($doctor_inner_section->btn) ? $doctor_inner_section->btn : '';
            $doctor_inner_url = !empty($doctor_inner_section->url) ? $doctor_inner_section->url : '';
            $doctor_inner_img = !empty($doctor_inner_section->hidden_doctor_inner_img) ? $doctor_inner_section->hidden_doctor_inner_img : '';
             $health_discussion_banner = $this->settings::getMetaValue('health_discussion_banner'); //Health Discussion Banner
            $health_discussion_title = !empty($health_discussion_banner->title) ? $health_discussion_banner->title : '';
            $health_discussion_description = !empty($health_discussion_banner->description) ? $health_discussion_banner->description : '';
            $sign_up_section = $this->settings::getMetaValue('sign_up_section'); //Sign Up Section
            $sign_up_sec_title = !empty($sign_up_section->title) ? $sign_up_section->title : '';
            $sign_up_sec_desc = !empty($sign_up_section->description) ? $sign_up_section->description : '';
            $sign_up_img = !empty($sign_up_section->hidden_sign_up_img) ? $sign_up_section->hidden_sign_up_img : '';

            $banner_video_section = $this->settings::getMetaValue('banner_video_section'); //Banner Video Section
            $banner_video_sec_title = !empty($banner_video_section->title) ? $banner_video_section->title : '';
            $banner_video_sec_desc = !empty($banner_video_section->description) ? $banner_video_section->description : '';
            $banner_video_sec_heading = !empty($banner_video_section->heading) ? $banner_video_section->heading : '';
            $banner_video_sec_url = !empty($banner_video_section->url) ? $banner_video_section->url : '';
            $banner_section_img = !empty($banner_video_section->hidden_banner_section_img) ? $banner_video_section->hidden_banner_section_img : '';

             $small_devices_top_section = $this->settings::getMetaValue('small_devices_top_section'); //Small Devices Top Section
            $small_devices_title = !empty($small_devices_top_section->title) ? $small_devices_top_section->title : '';
            $small_devices_desc = !empty($small_devices_top_section->description) ? $small_devices_top_section->description : '';
            $small_devices_btn = !empty($small_devices_top_section->button) ? $small_devices_top_section->button : '';
            $small_devices_url = !empty($small_devices_top_section->url) ? $small_devices_top_section->url : '';
            $small_device_img = !empty($small_devices_top_section->hidden_small_device_img) ? $small_devices_top_section->hidden_small_device_img : '';
            $small_devices_title1 = !empty($small_devices_top_section->title1) ? $small_devices_top_section->title1 : '';
            $small_devices_desc1 = !empty($small_devices_top_section->description1) ? $small_devices_top_section->description1 : '';
            $small_devices_btn1 = !empty($small_devices_top_section->button1) ? $small_devices_top_section->button1 : '';
            $small_devices_url1 = !empty($small_devices_top_section->url1) ? $small_devices_top_section->url1 : '';
            $small_device_img1 = !empty($small_devices_top_section->hidden_small_device_img1) ? $small_devices_top_section->hidden_small_device_img1 : '';
            $map_image_section = $this->settings::getMetaValue('map_image'); //Map Image
            $map_img = !empty($map_image_section->hidden_map_img) ? $map_image_section->hidden_map_img : '';

            $onlin_video_banner_sec = $this->settings::getMetaValue('onlin_video_banner_sec'); //Online Video Consultation Banner
           $onlin_video_heading = !empty($onlin_video_banner_sec->heading) ? $onlin_video_banner_sec->heading : '';
            $onlin_video_subheading = !empty($onlin_video_banner_sec->subheading) ? $onlin_video_banner_sec->subheading : '';
            $onlin_video_below_title = !empty($onlin_video_banner_sec->below_title) ? $onlin_video_banner_sec->below_title : '';
            $onlin_video_btn = !empty($onlin_video_banner_sec->btn) ? $onlin_video_banner_sec->btn : '';
            $onlin_video_url = !empty($onlin_video_banner_sec->url) ? $onlin_video_banner_sec->url : '';
            $onlin_video_img = !empty($onlin_video_banner_sec->hidden_onlin_video_img) ? $onlin_video_banner_sec->hidden_onlin_video_img : '';

            $procedure_banner_section = $this->settings::getMetaValue('procedure_banner_section'); //Procedure Banner Section
           $procedure_banner_heading = !empty($procedure_banner_section->heading) ? $procedure_banner_section->heading : '';
            $procedure_banner_img = !empty($procedure_banner_section->hidden_procedure_banner_img) ? $procedure_banner_section->hidden_procedure_banner_img : '';

            $city_wise_doctor_section = $this->settings::getMetaValue('city_wise_doctor_section'); //City wise Doctor Banner Section
           $city_wise_doctor_heading = !empty($city_wise_doctor_section->heading) ? $city_wise_doctor_section->heading : '';
            $city_wise_doctor_img = !empty($city_wise_doctor_section->hidden_city_wise_doctor_img) ? $city_wise_doctor_section->hidden_city_wise_doctor_img : '';

            $city_wise_hospital_section = $this->settings::getMetaValue('city_wise_hospital_section'); //City wise Hospital Banner Section
           $city_wise_hospital_heading = !empty($city_wise_hospital_section->heading) ? $city_wise_hospital_section->heading : '';
            $city_wise_hospital_img = !empty($city_wise_hospital_section->hidden_city_wise_hospital_img) ? $city_wise_hospital_section->hidden_city_wise_hospital_img : '';

            //for doctor sign up
            $for_doctor_sign_up = $this->settings::getMetaValue('for_doctor_sign_up'); 
           $for_doctor_sign_up_heading = !empty($for_doctor_sign_up->heading) ? $for_doctor_sign_up->heading : '';
           $for_doctor_sign_up_description = !empty($for_doctor_sign_up->description) ? $for_doctor_sign_up->description : '';
            $for_doctor_sign_up_img = !empty($for_doctor_sign_up->hidden_for_doctor_sign_up_img) ? $for_doctor_sign_up->hidden_for_doctor_sign_up_img : '';


            //About us Section
            $about_us_banner_section = $this->settings::getMetaValue('about_us_banner_section'); 
           $about_us_banner_heading = !empty($about_us_banner_section->heading) ? $about_us_banner_section->heading : '';
           $about_us_banner_description = !empty($about_us_banner_section->description) ? $about_us_banner_section->description : '';
            $about_us_banner_img = !empty($about_us_banner_section->hidden_about_us_banner_img) ? $about_us_banner_section->hidden_about_us_banner_img : '';

             //About us we_are_here
            $about_us_we_are_here = $this->settings::getMetaValue('about_us_we_are_here'); 
           $about_us_we_are_here_heading = !empty($about_us_we_are_here->heading) ? $about_us_we_are_here->heading : '';
           $about_us_we_are_here_description = !empty($about_us_we_are_here->description) ? $about_us_we_are_here->description : '';
            $about_us_we_are_here_img = !empty($about_us_we_are_here->hidden_about_us_we_are_here_img) ? $about_us_we_are_here->hidden_about_us_we_are_here_img : '';
            
            //About us our Dream
            $about_us_our_dream = $this->settings::getMetaValue('about_us_our_dream'); 
           $about_us_our_dream_heading = !empty($about_us_our_dream->heading) ? $about_us_our_dream->heading : '';
           $about_us_our_dream_description = !empty($about_us_our_dream->description) ? $about_us_our_dream->description : '';
            $about_us_our_dream_img = !empty($about_us_our_dream->hidden_about_us_our_dream_img) ? $about_us_our_dream->hidden_about_us_our_dream_img : '';

            //for hospital knockdoc tool
            $for_hospital_knockdoc_tool = $this->settings::getMetaValue('for_hospital_knockdoc_tool'); 
           $for_hospital_knockdoc_tool_heading = !empty($for_hospital_knockdoc_tool->heading) ? $for_hospital_knockdoc_tool->heading : '';
           $for_hospital_knockdoc_tool_description = !empty($for_hospital_knockdoc_tool->description) ? $for_hospital_knockdoc_tool->description : '';
            $for_hospital_knockdoc_tool_img = !empty($for_hospital_knockdoc_tool->hidden_for_hospital_knockdoc_tool_img) ? $for_hospital_knockdoc_tool->hidden_for_hospital_knockdoc_tool_img : '';

            //for hospital knockdoc profile
            $for_hospital_knockdoc_profile = $this->settings::getMetaValue('for_hospital_knockdoc_profile'); 
           $for_hospital_knockdoc_profile_heading = !empty($for_hospital_knockdoc_profile->heading) ? $for_hospital_knockdoc_profile->heading : '';
           $for_hospital_knockdoc_profile_description = !empty($for_hospital_knockdoc_profile->description) ? $for_hospital_knockdoc_profile->description : '';
            $for_hospital_knockdoc_profile_img = !empty($for_hospital_knockdoc_profile->hidden_for_hospital_knockdoc_profile_img) ? $for_hospital_knockdoc_profile->hidden_for_hospital_knockdoc_profile_img : '';

            //for hospital fourth_section
            $for_hospital_fourth_section = $this->settings::getMetaValue('for_hospital_fourth_section'); 
           
           $for_hospital_fourth_section_description = !empty($for_hospital_fourth_section->description) ? $for_hospital_fourth_section->description : '';
            $for_hospital_fourth_section_img = !empty($for_hospital_fourth_section->hidden_for_hospital_fourth_section_img) ? $for_hospital_fourth_section->hidden_for_hospital_fourth_section_img : '';

            //for Lab knockdoc 
            $for_labs_knockdoc = $this->settings::getMetaValue('for_labs_knockdoc'); 
           $for_labs_knockdoc_heading = !empty($for_labs_knockdoc->heading) ? $for_labs_knockdoc->heading : '';
           $for_labs_knockdoc_description = !empty($for_labs_knockdoc->description) ? $for_labs_knockdoc->description : '';
            $for_labs_knockdoc_img = !empty($for_labs_knockdoc->hidden_for_labs_knockdoc_img) ? $for_labs_knockdoc->hidden_for_labs_knockdoc_img : '';

            //for lab knockdoc profile
            $for_labs_knockdoc_profile = $this->settings::getMetaValue('for_labs_knockdoc_profile'); 
           $for_labs_knockdoc_profile_heading = !empty($for_labs_knockdoc_profile->heading) ? $for_labs_knockdoc_profile->heading : '';
           $for_labs_knockdoc_profile_description = !empty($for_labs_knockdoc_profile->description) ? $for_labs_knockdoc_profile->description : '';
            $for_labs_knockdoc_profile_img = !empty($for_labs_knockdoc_profile->hidden_for_labs_knockdoc_profile_img) ? $for_labs_knockdoc_profile->hidden_for_labs_knockdoc_profile_img : '';

            $doctor_slider = $this->settings::getMetaValue('doctors_slider'); //Doctors Slider
            $slider_speciality = !empty($doctor_slider['speciality']) ? $doctor_slider['speciality'] : '';
            $show_doctors_slider = !empty($doctor_slider['show_doctors_slider']) ? $doctor_slider['show_doctors_slider'] : '';
            $specialities = Speciality::pluck('title', 'id')->toArray();
            $seo_settings = $this->settings::getMetaValue('seo_settings'); //Article Section
            $meta_title = !empty($seo_settings['meta_title']) ? $seo_settings['meta_title'] : '';
            $meta_desc = !empty($seo_settings['meta_desc']) ? $seo_settings['meta_desc'] : '';
            if (file_exists(resource_path('views/extend/back-end/admin/settings/home-page-settings/index.blade.php'))) {
                return view(
                    'extend.back-end.admin.settings.home-page-settings.index',
                    compact(
                        'meta_title',
                        'meta_desc',
                        'home_slides',
                        'home_search_banner',
                        'doctor_title',
                        'doctor_subtitle',
                        'doctor_btn_one_title',
                        'doctor_btn_one_url',
                        'about_img',
                        'subscribe_title',
                        'subscribe_desc', 
                        'tabs_unserialize_array',
                        'app_sec_title',
                        'app_sec_subtitle',
                        'app_sec_desc',
                        'android_img',
                        'app_android_url',
                        'ios_img',
                        'app_ios_url',
                        'home_how_works_tabs',
                        'header_service',
                        'for_labs_benefits_of_knockdoc',
                        'health_community_slider',
                        'benefits_online_profile',
                        'benefits_online_doctor',
                        'slider_bg_image',
                        'app_sec_img',
                        'data_protection_title',
                        'data_protection_subtitle',
                        'data_protection_desc',
                        'data_protection_img',
                        'health_community_title',
                        'health_community_subtitle',
                        'health_community_img',
                        'health_discussion_title',
                        'health_discussion_description',   
                        'sign_up_sec_title',
                        'sign_up_sec_desc',
                        'sign_up_img',
                        'banner_video_sec_title',
                        'banner_video_sec_desc',
                        'banner_video_sec_heading',
                        'banner_video_sec_url',
                        'banner_section_img',
                        'map_img',
                        'onlin_video_heading',
                        'onlin_video_subheading',
                        'onlin_video_below_title',
                        'onlin_video_btn',
                        'onlin_video_url',
                        'onlin_video_img',
                        'procedure_banner_heading',
                        'procedure_banner_img',
                        'city_wise_doctor_heading',
                        'city_wise_doctor_img',
                        'city_wise_hospital_heading',
                        'city_wise_hospital_img',
                        'about_us_banner_heading',
                        'about_us_banner_description',
                        'about_us_banner_img',
                        'for_doctor_sign_up_heading',
                        'for_doctor_sign_up_description',
                        'for_doctor_sign_up_img',
                        'about_us_our_dream_heading',
                        'about_us_our_dream_description',
                        'about_us_our_dream_img',
                        'for_hospital_knockdoc_tool_heading',
                        'for_hospital_knockdoc_tool_description',
                        'for_hospital_knockdoc_tool_img',
                        'for_hospital_knockdoc_profile_heading',
                        'for_hospital_knockdoc_profile_description',
                        'for_hospital_knockdoc_profile_img',
                        'for_labs_knockdoc_heading',
                        'for_labs_knockdoc_description',
                        'for_labs_knockdoc_img',
                        'for_labs_knockdoc_profile_heading',
                        'for_labs_knockdoc_profile_description',
                        'for_labs_knockdoc_profile_img',
                        'for_hospital_fourth_section_description',
                        'for_hospital_fourth_section_img',
                        'about_us_we_are_here_heading',
                        'about_us_we_are_here_description',
                        'about_us_we_are_here_img',
                        // 'first_service_tab_img',
                        'small_devices_title',
                        'small_devices_desc',
                        'small_devices_btn',
                        'small_devices_url',
                        'small_device_img',
                        'small_devices_title1',
                        'small_devices_desc1',
                        'small_devices_btn1',
                        'small_devices_url1',
                        'small_device_img1',
                        'specialities',
                        'doctor_inner_title',
                        'doctor_inner_subtitle',
                        'doctor_inner_description',
                        'doctor_inner_btn',
                        'doctor_inner_url',
                        'doctor_inner_img',
                        'slider_speciality',
                        'show_doctors_slider'
                    )
                );
            } else {
                return view(
                    'back-end.admin.settings.home-page-settings.index',
                    compact(
                        'meta_title',
                        'meta_desc',
                        'home_slides',
                        'home_search_banner',
                        'doctor_title',
                        'doctor_subtitle',
                        'doctor_btn_one_title',
                        'doctor_btn_one_url',
                        'about_img',
                        'subscribe_title',
                        'subscribe_desc', 
                        'tabs_unserialize_array',
                        'app_sec_title',
                        'app_sec_subtitle',
                        'app_sec_desc',
                        'android_img',
                        'app_android_url',
                        'ios_img',
                        'app_ios_url',
                        'home_how_works_tabs',
                        'header_service',
                        'for_labs_benefits_of_knockdoc',
                        'health_community_slider',
                        'benefits_online_profile',
                        'benefits_online_doctor',
                        'slider_bg_image',
                        'app_sec_img',
                        'data_protection_title',
                        'data_protection_subtitle',
                        'data_protection_desc',
                        'data_protection_img',
                        'health_community_title',
                        'health_community_subtitle',
                        'health_community_img',
                        'health_discussion_title',
                        'health_discussion_description',
                        'sign_up_sec_title',
                        'sign_up_sec_desc',
                        'sign_up_img',
                        'banner_video_sec_title',
                        'banner_video_sec_desc',
                        'banner_video_sec_heading',
                        'banner_video_sec_url',
                        'banner_section_img',
                        'map_img',
                        'onlin_video_heading',
                        'onlin_video_subheading',
                        'onlin_video_below_title',
                        'onlin_video_btn',
                        'onlin_video_url',
                        'onlin_video_img',
                        'procedure_banner_heading',
                        'procedure_banner_img',
                        'city_wise_doctor_heading',
                        'city_wise_doctor_img',
                        'city_wise_hospital_heading',
                        'city_wise_hospital_img',
                        'for_doctor_sign_up_heading',
                        'for_doctor_sign_up_description',
                        'for_doctor_sign_up_img',
                        'about_us_banner_heading',
                        'about_us_banner_description',
                        'about_us_banner_img',
                        // 'first_service_tab_img',
                        'about_us_our_dream_heading',
                        'about_us_our_dream_description',
                        'about_us_our_dream_img',
                        'for_hospital_knockdoc_tool_heading',
                        'for_hospital_knockdoc_tool_description',
                        'for_hospital_knockdoc_tool_img',
                        'for_hospital_knockdoc_profile_heading',
                        'for_hospital_knockdoc_profile_description',
                        'for_hospital_knockdoc_profile_img',
                        'for_hospital_fourth_section_description',
                        'for_hospital_fourth_section_img',
                        'for_labs_knockdoc_heading',
                        'for_labs_knockdoc_description',
                        'for_labs_knockdoc_img',
                        'for_labs_knockdoc_profile_heading',
                        'for_labs_knockdoc_profile_description',
                        'for_labs_knockdoc_profile_img',
                        'about_us_we_are_here_heading',
                        'about_us_we_are_here_description',
                        'about_us_we_are_here_img',
                        'small_devices_title',
                        'small_devices_desc',
                        'small_devices_btn',
                        'small_devices_url',
                        'small_device_img',
                        'small_devices_title1',
                        'small_devices_desc1',
                        'small_devices_btn1',
                        'small_devices_url1',
                        'small_device_img1',
                        'specialities',
                         'doctor_inner_title',
                        'doctor_inner_subtitle',
                        'doctor_inner_description',
                        'doctor_inner_btn',
                        'doctor_inner_url',
                        'doctor_inner_img',
                        'slider_speciality',
                        'show_doctors_slider'
                    )
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Store home settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeHomeSliderSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $request->validate(
            [
                'slide.*.slide_title_one' => 'required',
            ]
        );
        $json = array();
        if (!empty($request)) {
            $store_home_slider_settings = $this->settings->saveHomeSliderSettings($request);
            if ($store_home_slider_settings['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($store_home_slider_settings['type'] == "error") {
                $json['type'] = 'error';
                $json['message'] = $store_home_slider_settings['message'];;
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Store home search banner settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return json response
     */
    public function storeHomeSearchBannerSettings(Request $request)
    {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $store_home_search_banner_settings = $this->settings->saveHomeSearchBannerSettings($request, $image_size);
            if ($store_home_search_banner_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

 public function storeOnlinVideoSection(Request $request)
    {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $onlin_video_section = $this->settings->saveOnlinVideoSection($request, $image_size);
            if ($onlin_video_section == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

     public function storeProcedureBannerSection(Request $request)
    {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $procedure_banner_section = $this->settings->saveProcedureBannerSection($request, $image_size);
            if ($procedure_banner_section == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

    public function storecitywisedoctorSection(Request $request)
    {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $city_wise_doctor_section = $this->settings->saveCitywiseDoctorSection($request, $image_size);
            if ($city_wise_doctor_section == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

     public function storeCitywiseHospitalSection(Request $request)
    {
        //dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $city_wise_hospital_section = $this->settings->saveCitywiseHospitalSection($request, $image_size);
            if ($city_wise_hospital_section == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
 

        }
    }
    /**
     * Store home about us settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return json response
     */
    public function storeAboutUsBannerSection(Request $request)
    {
        //dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $about_us_banner_section = $this->settings->saveAboutUsBannerSection($request, $image_size);
            if ($about_us_banner_section == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
 

        }
    }
    public function storeForDoctorSignUp(Request $request)
    {
        //dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $for_doctor_sign_up = $this->settings->saveForDoctorSignUp($request, $image_size);
            if ($for_doctor_sign_up == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
 

        }
    }
    public function storeAboutUsWeAreHere(Request $request)
    {
        //dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $about_us_we_are_here = $this->settings->saveAboutUsWeAreHere($request, $image_size);
            if ($about_us_we_are_here == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
 

        }
    }

    public function storeAboutUsOurDream(Request $request)
    {
        //dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $about_us_our_dream = $this->settings->saveAboutUsOurDream($request, $image_size);
            if ($about_us_our_dream == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
 

        }
    }

    public function storeForHospitalKnockdocTool(Request $request)
    {
        //dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $for_hospital_knockdoc_tool = $this->settings->saveForHospitalKnockdocTool($request, $image_size);
            if ($for_hospital_knockdoc_tool == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
 

        }
    }
    public function storeForHospitalKnockdocProfile(Request $request)
    {
        //dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $for_hospital_knockdoc_profile = $this->settings->saveForHospitalKnockdocProfile($request, $image_size);
            if ($for_hospital_knockdoc_profile == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
 

        }
    }
    public function storeForHospitalFourthSection(Request $request)
    {
        //dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $for_hospital_fourth_section = $this->settings->saveForHospitalFourthSection($request, $image_size);
            if ($for_hospital_fourth_section == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
 

        }
    }
    public function storeForLabsKnockdoc(Request $request)
    {
        //dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $for_labs_knockdoc = $this->settings->saveForLabsKnockdoc($request, $image_size);
            if ($for_labs_knockdoc == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
 

        }
    }
    public function storeForLabsKnockdocProfile(Request $request)
    {
        //dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $for_labs_knockdoc_profile = $this->settings->saveForLabsKnockdocProfile($request, $image_size);
            if ($for_labs_knockdoc_profile == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
 

        }
    }
    public function storeForLabsBenefitsOfKnockdoc(Request $request)
    {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $for_labs_benefits_of_knockdoc = $this->settings->saveForLabsBenefitsOfKnockdoc($request);
            if ($for_labs_benefits_of_knockdoc['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($for_labs_benefits_of_knockdoc['type'] == "error") {
                $json['type'] = 'error';
                $json['message'] = $for_labs_benefits_of_knockdoc['message'];
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
    public function storeHomeAboutUsSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $store_home_about_us_settings = $this->settings->saveHomeAboutUsSettings($request);
            if ($store_home_about_us_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Show general settings form settings
     *
     * @access public
     *
     * @return View
     */
    public function generalSettings()
    {
        if (Auth::user()) {
            $register_form = $this->settings::getMetaValue('reg_form_settings'); //Registration Form Settings
            $reg_one_title = !empty($register_form) && !empty($register_form['step1_title']) ? $register_form['step1_title'] : '';
            $reg_one_subtitle = !empty($register_form) && !empty($register_form['step1_subtitle']) ? $register_form['step1_subtitle'] : '';
            $reg_two_title = !empty($register_form) && !empty($register_form['step2_title']) ? $register_form['step2_title'] : '';
            $reg_two_subtitle = !empty($register_form) && !empty($register_form['step2_subtitle']) ? $register_form['step2_subtitle'] : '';
            $term_note = !empty($register_form) && !empty($register_form['step2_term_note']) ? $register_form['step2_term_note'] : '';
            $reg_three_title = !empty($register_form) && !empty($register_form['step3_title']) ? $register_form['step3_title'] : '';
            $reg_three_subtitle = !empty($register_form) && !empty($register_form['step3_subtitle']) ? $register_form['step3_subtitle'] : '';
            $register_image = !empty($register_form) && !empty($register_form['register_image']) ? $register_form['register_image'] : '';
            $term_page_url  = !empty($register_form) && !empty($register_form['term_page_url']) ? $register_form['term_page_url'] : '';
            $reg_four_title = !empty($register_form) && !empty($register_form['step4_title']) ? $register_form['step4_title'] : '';
            $reg_four_subtitle = !empty($register_form) && !empty($register_form['step4_subtitle']) ? $register_form['step4_subtitle'] : '';
            $general_settings = $this->settings::getMetaValue('general_settings'); //General Settings
            $site_title = !empty($general_settings) && !empty($general_settings->site_title) ? $general_settings->site_title : '';
            $site_logo = !empty($general_settings) && !empty($general_settings->site_logo) ? $general_settings->site_logo : '';
            $site_favicon = !empty($general_settings) && !empty($general_settings->site_favicon) ? $general_settings->site_favicon : '';
            $gmap_api_key = !empty($general_settings) && !empty($general_settings->gmap_api_key) ? $general_settings->gmap_api_key : '';
            $enable_theme_color = !empty($general_settings) && !empty($general_settings->enable_theme_color) ? $general_settings->enable_theme_color : '';
            $primary_color = !empty($general_settings) && !empty($general_settings->primary_color) ? $general_settings->primary_color : '';
            $languages = Helper::getTranslatedLang();
            $selected_language = !empty($general_settings) && !empty($general_settings->language) ? $general_settings->language : '';

            $topbar_settings = $this->settings::getMetaValue('topbar_settings'); //TopBar Settings
            $topbar_title = !empty($topbar_settings) ? $topbar_settings->title : '';
            $topbar_number = !empty($topbar_settings) ? $topbar_settings->number : '';
            $topbar_btn = !empty($topbar_settings) ? $topbar_settings->btn : '';
            $topbar_url = !empty($topbar_settings) ? $topbar_settings->url : '';

            $social_list = Helper::getSocialData(); //Social Settings
            $socials_array = $this->settings::getMetaValue('socials');
            $footer_settings = $this->settings::getMetaValue('footer_settings'); //Footer Settings


            $c_info_img_one = !empty($footer_settings) ? $footer_settings->c_info_img_one : '';
            $c_info_title_one = !empty($footer_settings) ? $footer_settings->c_info_title_one : '';
            $c_info_number = !empty($footer_settings) ? $footer_settings->c_info_number : '';
            $c_info_img_two = !empty($footer_settings) ? $footer_settings->c_info_img_two : '';
            $c_info_title_two = !empty($footer_settings) ? $footer_settings->c_info_title_two : '';
            $c_info_email = !empty($footer_settings) ? $footer_settings->c_info_email : '';
            $footer_logo = !empty($footer_settings) ? $footer_settings->footer_logo : '';
            $footer_about_us_note = !empty($footer_settings) ? $footer_settings->about_us_note : '';
            $footer_address = !empty($footer_settings) ? $footer_settings->address : '';
            $footer_email = !empty($footer_settings) ? $footer_settings->email : '';
            $footer_phone = !empty($footer_settings) ? $footer_settings->phone : '';
            $footer_copyright = !empty($footer_settings) ? $footer_settings->copyright : '';
            $icons = Helper::getIconList();
            $dash_icons  = SiteManagement::getMetaValue('icons');
            $chat_setting = SiteManagement::getMetaValue('chat_settings');
            $port = !empty($chat_setting) && !empty($chat_setting['port']) ? $chat_setting['port'] : 3001;
            $host = !empty($chat_setting) && !empty($chat_setting['host']) ? $chat_setting['host'] : 'http://localhost';
            $data = $this->settings::getMetaValue('email_data');
            $from_email = !empty($data->from_email) ? $data->from_email : null;
            $from_email_id = !empty($data->from_email_id) ? $data->from_email_id : null;
            $sender_name = !empty($data->sender_name) ? $data->sender_name : null;
            $sender_tagline = !empty($data->sender_tagline) ? $data->sender_tagline : null;
            $sender_url = !empty($data->sender_url) ? $data->sender_url : null;
            $email_logo = !empty($data->email_logo) ? $data->email_logo : null;
            $email_banner = !empty($data->email_banner) ? $data->email_banner : null;
            $sender_avatar = !empty($data->sender_avatar) ? $data->sender_avatar : null;
            $currency = Arr::pluck(Helper::currencyList(), 'code', 'code');
            $payment_methods = Helper::getPaymentMethodList();
            $payment_settings = $this->settings::getMetaValue('payment_settings');
            $existing_currency = !empty($payment_settings->currency) ? $payment_settings->currency : '';
            $payment_gateway = !empty($payment_settings->payment_method) ? $payment_settings->payment_method : array();
            $min_payout = !empty($payment_settings->min_payout) ? $payment_settings->min_payout : null;
            $stripe_settings = $this->settings::getMetaValue('stripe_settings');
            $stripe_key = !empty($stripe_settings) ? $stripe_settings['stripe_key'] : '';
            $stripe_secret = !empty($stripe_settings) ? $stripe_settings['stripe_secret'] : '';

            $existing_payment_settings = $this->settings::getMetaValue('paypal_settings');
            $client_id = !empty($existing_payment_settings['client_id']) ? $existing_payment_settings['client_id'] : '';
            $payment_password = !empty($existing_payment_settings['paypal_password']) ? $existing_payment_settings['paypal_password'] : '';
            $existing_payment_secret = !empty($existing_payment_settings['paypal_secret']) ? $existing_payment_settings['paypal_secret'] : '';
            $inner_page  = SiteManagement::getMetaValue('inner_page_data');
            $search_list_meta_title = !empty($inner_page) && !empty($inner_page['search_list_meta_title']) ? $inner_page['search_list_meta_title'] : '';
            $search_list_meta_desc = !empty($inner_page) && !empty($inner_page['search_list_meta_desc']) ? $inner_page['search_list_meta_desc'] : '';
            $show_search_form = !empty($inner_page) && !empty($inner_page['show_search_form']) ? $inner_page['show_search_form'] : '';
            $enable_breadcrumbs = !empty($inner_page) && !empty($inner_page['enable_breadcrumbs']) ? $inner_page['enable_breadcrumbs'] : '';
            $sidebar  = SiteManagement::getMetaValue('sidebar_settings');
            $display_sidebar = !empty($sidebar) && !empty($sidebar['display_sidebar']) ? $sidebar['display_sidebar'] : '';
            $display_query_section = !empty($sidebar) && !empty($sidebar['display_query_section']) ? $sidebar['display_query_section'] : '';
            $ask_query_img = !empty($sidebar) && !empty($sidebar['hidden_ask_query_img']) ? $sidebar['hidden_ask_query_img'] : '';
            $query_title = !empty($sidebar) && !empty($sidebar['query_title']) ? $sidebar['query_title'] : '';
            $query_subtitle = !empty($sidebar) && !empty($sidebar['query_subtitle']) ? $sidebar['query_subtitle'] : '';
            $query_btn_title = !empty($sidebar) && !empty($sidebar['query_btn_title']) ? $sidebar['query_btn_title'] : '';
            $query_btn_link = !empty($sidebar) && !empty($sidebar['query_btn_link']) ? $sidebar['query_btn_link'] : '';
            $query_desc = !empty($sidebar) && !empty($sidebar['query_desc']) ? $sidebar['query_desc'] : '';
            $display_get_app_sec = !empty($sidebar) && !empty($sidebar['display_get_app_sec']) ? $sidebar['display_get_app_sec'] : '';
            $download_app_img = !empty($sidebar) && !empty($sidebar['hidden_download_app_img']) ? $sidebar['hidden_download_app_img'] : '';
            $download_app_title = !empty($sidebar) && !empty($sidebar['download_app_title']) ? $sidebar['download_app_title'] : '';
            $download_app_subtitle = !empty($sidebar) && !empty($sidebar['download_app_subtitle']) ? $sidebar['download_app_subtitle'] : '';
            $download_app_desc = !empty($sidebar) && !empty($sidebar['download_app_desc']) ? $sidebar['download_app_desc'] : '';
            $download_app_link = !empty($sidebar) && !empty($sidebar['download_app_link']) ? $sidebar['download_app_link'] : '';
            $display_get_ad_sec = !empty($sidebar) && !empty($sidebar['display_get_ad_sec']) ? $sidebar['display_get_ad_sec'] : '';
            $ad_content = !empty($sidebar) && !empty($sidebar['ad_content']) ? $sidebar['ad_content'] : '';
            $twitter_user_name = !empty($footer_settings) && !empty($footer_settings->twitter_user_name) ? $footer_settings->twitter_user_name : '';
            $consumer_key = !empty($footer_settings) && !empty($footer_settings->consumer_key) ? $footer_settings->consumer_key : '';
            $consumer_secret = !empty($footer_settings) && !empty($footer_settings->consumer_secret) ? $footer_settings->consumer_secret : '';
            $access_token = !empty($footer_settings) && !empty($footer_settings->access_token) ? $footer_settings->access_token : '';
            $access_token_secret = !empty($footer_settings) && !empty($footer_settings->access_token_secret) ? $footer_settings->access_token_secret : '';
            $number_of_tweets = !empty($footer_settings) && !empty($footer_settings->number_of_tweets) ? $footer_settings->number_of_tweets : '';
            $menu_one_title = !empty($footer_settings) && !empty($footer_settings->menu_one_title) ? $footer_settings->menu_one_title : '';
            $menu_two_title = !empty($footer_settings) && !empty($footer_settings->menu_two_title) ? $footer_settings->menu_two_title : '';
            $menu_three_title = !empty($footer_settings) && !empty($footer_settings->menu_three_title) ? $footer_settings->menu_three_title : '';
            $menu_four_title = !empty($footer_settings) && !empty($footer_settings->menu_four_title) ? $footer_settings->menu_four_title : '';
            $footer_first_location = !empty($footer_settings) && !empty($footer_settings->first_location) ? $footer_settings->first_location : '';
            $footer_second_location = !empty($footer_settings) && !empty($footer_settings->second_location) ? $footer_settings->second_location : '';
           
            $locations = Location::all();
            $forum_settings  = SiteManagement::getMetaValue('forum_settings');
            $forum_banner_image = !empty($forum_settings) && !empty($forum_settings['hidden_forum_banner_image']) ? $forum_settings['hidden_forum_banner_image'] : '';
            $forum_banner_title = !empty($forum_settings) && !empty($forum_settings['forum_banner_title']) ? $forum_settings['forum_banner_title'] : '';
            $forum_banner_subtitle = !empty($forum_settings) && !empty($forum_settings['forum_banner_subtitle']) ? $forum_settings['forum_banner_subtitle'] : '';
            $forum_banner_desc = !empty($forum_settings) && !empty($forum_settings['forum_banner_desc']) ? $forum_settings['forum_banner_desc'] : '';
            if (file_exists(resource_path('views/extend/back-end/admin/settings/general/index.blade.php'))) {
                return view(
                    'extend.back-end.admin.settings.general.index',
                    compact(
                        'forum_banner_image',
                        'forum_banner_title',
                        'forum_banner_subtitle',
                        'forum_banner_desc',
                        'footer_first_location',
                        'footer_second_location',
                        'locations',
                        'menu_one_title',
                        'menu_two_title',
                        'menu_three_title',
                        'menu_four_title',
                        'number_of_tweets',
                        'twitter_user_name',
                        'consumer_key',
                        'consumer_secret',
                        'access_token',
                        'access_token_secret',
                        'min_payout',
                        'reg_one_title',
                        'reg_one_subtitle',
                        'reg_two_title',
                        'reg_two_subtitle',
                        'reg_three_title',
                        'reg_three_subtitle',
                        'register_image',
                        'reg_four_title',
                        'reg_four_subtitle',
                        'term_page_url',
                        'term_note',
                        'site_title',
                        'site_logo',
                        'site_favicon',
                        'gmap_api_key',
                        'enable_theme_color',
                        'primary_color',
                        'topbar_title',
                        'topbar_number',
                        'topbar_btn',
                        'topbar_url',
                        'social_list',
                        'socials_array',
                        'c_info_img_one',
                        'c_info_title_one',
                        'c_info_number',
                        'c_info_img_two',
                        'c_info_title_two',
                        'c_info_email',
                        'footer_logo',
                        'footer_about_us_note',
                        'footer_address',
                        'footer_email',
                        'footer_phone',
                        'footer_copyright',
                        'languages',
                        'selected_language',
                        'icons',
                        'dash_icons',
                        'port',
                        'host',
                        'from_email',
                        'from_email_id',
                        'sender_name',
                        'sender_tagline',
                        'sender_url',
                        'email_logo',
                        'email_banner',
                        'sender_avatar',
                        'currency',
                        'payment_methods',
                        'stripe_settings',
                        'stripe_key',
                        'stripe_secret',
                        'client_id',
                        'payment_password',
                        'existing_payment_secret',
                        'existing_currency',
                        'payment_gateway',
                        'search_list_meta_title',
                        'search_list_meta_desc',
                        'show_search_form',
                        'enable_breadcrumbs',
                        'display_sidebar',
                        'display_query_section',
                        'ask_query_img',
                        'query_title',
                        'query_subtitle',
                        'query_btn_title',
                        'query_btn_link',
                        'query_desc',
                        'display_get_app_sec',
                        'download_app_img',
                        'download_app_title',
                        'download_app_subtitle',
                        'download_app_desc',
                        'download_app_link',
                        'display_get_ad_sec',
                        'ad_content'
                    )
                );
            } else {
                return view(
                    'back-end.admin.settings.general.index',
                    compact(
                        'forum_banner_image',
                        'forum_banner_title',
                        'forum_banner_subtitle',
                        'forum_banner_desc',
                        'footer_first_location',
                        'footer_second_location',
                        'locations',
                        'menu_one_title',
                        'menu_two_title',
                        'menu_three_title',
                        'menu_four_title',
                        'number_of_tweets',
                        'twitter_user_name',
                        'consumer_key',
                        'consumer_secret',
                        'access_token',
                        'access_token_secret',
                        'min_payout',
                        'reg_one_title',
                        'reg_one_subtitle',
                        'reg_two_title',
                        'reg_two_subtitle',
                        'reg_three_title',
                        'reg_three_subtitle',
                        'register_image',
                        'reg_four_title',
                        'reg_four_subtitle',
                        'term_page_url',
                        'term_note',
                        'site_title',
                        'site_logo',
                        'site_favicon',
                        'gmap_api_key',
                        'enable_theme_color',
                        'primary_color',
                        'topbar_title',
                        'topbar_number',
                        'topbar_btn',
                        'topbar_url',
                        'social_list',
                        'socials_array',
                        'c_info_img_one',
                        'c_info_title_one',
                        'c_info_number',
                        'c_info_img_two',
                        'c_info_title_two',
                        'c_info_email',
                        'footer_logo',
                        'footer_about_us_note',
                        'footer_address',
                        'footer_email',
                        'footer_phone',
                        'footer_copyright',
                        'languages',
                        'selected_language',
                        'icons',
                        'dash_icons',
                        'port',
                        'host',
                        'from_email',
                        'from_email_id',
                        'sender_name',
                        'sender_tagline',
                        'sender_url',
                        'email_logo',
                        'email_banner',
                        'sender_avatar',
                        'currency',
                        'payment_methods',
                        'stripe_settings',
                        'stripe_key',
                        'stripe_secret',
                        'client_id',
                        'payment_password',
                        'existing_payment_secret',
                        'existing_currency',
                        'payment_gateway',
                        'search_list_meta_title',
                        'search_list_meta_desc',
                        'show_search_form',
                        'enable_breadcrumbs',
                        'display_sidebar',
                        'display_query_section',
                        'ask_query_img',
                        'query_title',
                        'query_subtitle',
                        'query_btn_title',
                        'query_btn_link',
                        'query_desc',
                        'display_get_app_sec',
                        'download_app_img',
                        'download_app_title',
                        'download_app_subtitle',
                        'download_app_desc',
                        'download_app_link',
                        'display_get_ad_sec',
                        'ad_content'
                    )
                );
            }
        } else {
            abort(404);
        }
    }

    /**
     * Store registration settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
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
        if (!empty($request)) {
            $reg_settings = $this->settings->saveRegistrationSettings($request);
            if ($reg_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($reg_settings == "error") {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Store how it works section settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeHowItWorksSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $reg_settings = $this->settings->saveHowItWorksSettings($request);
            if ($reg_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($reg_settings == "error") {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Store service tabs section settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
public function storeServiceTabsSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
         $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $service_tabs_settings = $this->settings->saveServiceTabsSettings($request, $image_size);
            if ($service_tabs_settings['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($service_tabs_settings['type'] == "error") {
                $json['type'] = 'error';
                $json['message'] = $service_tabs_settings['message'];
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Store homepage seo settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeSeoSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $seo_settings = $this->settings->saveSeoSettings($request);
            if ($seo_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($seo_settings['type'] == "error") {
                $json['type'] = 'error';
                $json['message'] = $seo_settings['message'];
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Store How it works sections tabs section settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeHowWorkTabSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $hwtabs = $this->settings->saveHowWorksTabSettings($request);
            if ($hwtabs['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($hwtabs['type'] == "error") {
                $json['type'] = 'error';
                $json['message'] = $hwtabs['message'];
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
    public function storeHeaderServiceSettings(Request $request)
    {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $heardertabs = $this->settings->saveHeaderServiceSettings($request);
            if ($heardertabs['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($heardertabs['type'] == "error") {
                $json['type'] = 'error';
                $json['message'] = $heardertabs['message'];
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    public function storeHealthCommunitySlider(Request $request)
    {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $healthtabs = $this->settings->saveHealthCommunitySlider($request);
            if ($healthtabs['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($healthtabs['type'] == "error") {
                $json['type'] = 'error';
                $json['message'] = $healthtabs['message'];
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
    public function storebenefitsonlineprofile(Request $request)
    {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $onlinetabs = $this->settings->saveBenefitsOnlineProfile($request);
            if ($onlinetabs['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($onlinetabs['type'] == "error") {
                $json['type'] = 'error';
                $json['message'] = $onlinetabs['message'];
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    public function storebenefitsonlinedoctor(Request $request)
    {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $onlinedoctortabs = $this->settings->saveBenefitsOnlineDoctor($request);
            if ($onlinedoctortabs['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($onlinedoctortabs['type'] == "error") {
                $json['type'] = 'error';
                $json['message'] = $onlinedoctortabs['message'];
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Store download app section settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeDownloadAppSecSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $download_app_settings = $this->settings->saveDownloadAppSecSettings($request, $image_size);
            if ($download_app_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($download_app_settings == "error") {
                $json['type'] = 'error';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Get freelancer's projects
     *
     * @return \Illuminate\Http\Response
     */
    public function getHomeSliderSlides()
    {
        $json = array();
        if (Auth::user()) {
            $stored_sliders = array();
            $slides = $this->settings::getMetaValue('home_slider');
            if (!empty($slides)) {
                foreach ($slides as $key => $value) {
                    $stored_sliders[] = $value;
                }
                $json['type'] = 'success';
                $json['slides'] = $stored_sliders;
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
     * Get home page section display settings
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getHomeSectionsDisplaySettings()
    {
        $json = array();
        $subscribe_now_sec = !empty(SiteManagement::getMetaValue('subscribe_now_sec')) ? SiteManagement::getMetaValue('subscribe_now_sec') : array();
        $download_app_sec = !empty(SiteManagement::getMetaValue('download_app_sec')) ? SiteManagement::getMetaValue('download_app_sec') : array();
        $home_doctor_sec = !empty(SiteManagement::getMetaValue('home_doctor_sec')) ? SiteManagement::getMetaValue('home_doctor_sec') : array();
        $search_banner_sec = !empty(SiteManagement::getMetaValue('home_search_banner')) ? SiteManagement::getMetaValue('home_search_banner') : array();
        $data_protection = !empty(SiteManagement::getMetaValue('data_protection')) ? SiteManagement::getMetaValue('data_protection') : array();
        $health_community_banner = !empty(SiteManagement::getMetaValue('health_community_banner')) ? SiteManagement::getMetaValue('health_community_banner') : array();
        $list_doctor_inner_section = !empty(SiteManagement::getMetaValue('list_doctor_inner_section')) ? SiteManagement::getMetaValue('list_doctor_inner_section') : array();
         $health_discussion_banner = !empty(SiteManagement::getMetaValue('health_discussion_banner')) ? SiteManagement::getMetaValue('health_discussion_banner') : array();
        $sign_up_section = !empty(SiteManagement::getMetaValue('sign_up_section')) ? SiteManagement::getMetaValue('sign_up_section') : array();
        $onlin_video_banner_sec = !empty(SiteManagement::getMetaValue('onlin_video_banner_sec')) ? SiteManagement::getMetaValue('onlin_video_banner_sec') : array();
        $procedure_banner_section = !empty(SiteManagement::getMetaValue('procedure_banner_section')) ? SiteManagement::getMetaValue('procedure_banner_section') : array();
        $city_wise_doctor_section = !empty(SiteManagement::getMetaValue('city_wise_doctor_section')) ? SiteManagement::getMetaValue('city_wise_doctor_section') : array();
        $city_wise_hospital_section = !empty(SiteManagement::getMetaValue('city_wise_hospital_section')) ? SiteManagement::getMetaValue('city_wise_hospital_section') : array();

        $about_us_banner_section = !empty(SiteManagement::getMetaValue('about_us_banner_section')) ? SiteManagement::getMetaValue('about_us_banner_section') : array();

         $about_us_we_are_here = !empty(SiteManagement::getMetaValue('about_us_we_are_here')) ? SiteManagement::getMetaValue('about_us_we_are_here') : array();

         $about_us_our_dream = !empty(SiteManagement::getMetaValue('about_us_our_dream')) ? SiteManagement::getMetaValue('about_us_our_dream') : array();

         $for_hospital_knockdoc_tool = !empty(SiteManagement::getMetaValue('for_hospital_knockdoc_tool')) ? SiteManagement::getMetaValue('for_hospital_knockdoc_tool') : array();

         $for_hospital_knockdoc_profile = !empty(SiteManagement::getMetaValue('for_hospital_knockdoc_profile')) ? SiteManagement::getMetaValue('for_hospital_knockdoc_profile') : array();

         $for_hospital_fourth_section = !empty(SiteManagement::getMetaValue('for_hospital_fourth_section')) ? SiteManagement::getMetaValue('for_hospital_fourth_section') : array();

         $for_labs_knockdoc = !empty(SiteManagement::getMetaValue('for_labs_knockdoc')) ? SiteManagement::getMetaValue('for_labs_knockdoc') : array();

         $for_labs_knockdoc_profile = !empty(SiteManagement::getMetaValue('for_labs_knockdoc_profile')) ? SiteManagement::getMetaValue('for_labs_knockdoc_profile') : array();

         $for_doctor_sign_up = !empty(SiteManagement::getMetaValue('for_doctor_sign_up')) ? SiteManagement::getMetaValue('for_doctor_sign_up') : array();

        $banner_video_section = !empty(SiteManagement::getMetaValue('banner_video_section')) ? SiteManagement::getMetaValue('banner_video_section') : array();
        $small_devices_top_section = !empty(SiteManagement::getMetaValue('small_devices_top_section')) ? SiteManagement::getMetaValue('small_devices_top_section') : array();
        $show_how_work_tabs = $this->settings::where('meta_key', 'show_how_work_tabs')->select('meta_value')->pluck('meta_value')->first();
        $show_services_section = $this->settings::where('meta_key', 'show_services_section')->select('meta_value')->pluck('meta_value')->first();
        $show_onlinetabs = $this->settings::where('meta_key', 'show_onlinetabs')->select('meta_value')->pluck('meta_value')->first();
        $show_onlinedoctortabs = $this->settings::where('meta_key', 'show_onlinedoctortabs')->select('meta_value')->pluck('meta_value')->first();
        $show_headertabs = $this->settings::where('meta_key', 'show_headertabs')->select('meta_value')->pluck('meta_value')->first();
        $show_for_labs_benefits_of_knockdoc_sec = $this->settings::where('meta_key', 'show_for_labs_benefits_of_knockdoc_sec')->select('meta_value')->pluck('meta_value')->first();
        $show_healthtabs = $this->settings::where('meta_key', 'show_healthtabs')->select('meta_value')->pluck('meta_value')->first();
        if (!empty($subscribe_now_sec->show_how_work_sec)) {
            if ($subscribe_now_sec->show_how_work_sec == 'true') {
                $json['show_how_work_sec'] = 'true';
            } 
        }
        if (!empty($download_app_sec->show_app_sec)) {
            if ($download_app_sec->show_app_sec == 'true') {
                $json['show_app_sec'] = 'true';
            }
        }
        if (!empty($home_doctor_sec->show_about_sec)) {
            if ($home_doctor_sec->show_about_sec == 'true') {
                $json['show_about_sec'] = 'true';
            }
        }
        if (!empty($search_banner_sec->show_search_banner)) {
            if ($search_banner_sec->show_search_banner == 'true') {
                $json['show_search_banner'] = 'true';
            }
        }
        if (!empty($show_how_work_tabs)) {
            if ($show_how_work_tabs == 'true') {
                $json['show_how_work_tabs'] = 'true';
            }
        }
        if (!empty($show_services_section)) {
            if ($show_services_section == 'true') {
                $json['show_services_section'] = 'true';
            }
        }
        if (!empty($show_onlinetabs)) {
            if ($show_onlinetabs == 'true') {
                $json['show_onlinetabs'] = 'true';
            }
        }
        if (!empty($show_onlinedoctortabs)) {
            if ($show_onlinedoctortabs == 'true') {
                $json['show_onlinedoctortabs'] = 'true';
            }
        }
        if (!empty($data_protection->show_article_sec)) {
            if ($data_protection->show_article_sec == 'true') {
                $json['show_article_sec'] = 'true';
            }
        }
         if (!empty($health_community_banner->show_health_community_banner)) {
            if ($health_community_banner->show_health_community_banner == 'true') {
                $json['show_health_community_banner'] = 'true';
            }
        }
         if (!empty($list_doctor_inner_section->show_doctor_inner_section)) {
            if ($list_doctor_inner_section->show_doctor_inner_section == 'true') {
                $json['show_doctor_inner_section'] = 'true';
            }
        }
        if (!empty($health_discussion_banner->show_health_discussion_banner)) {
            if ($health_discussion_banner->show_health_discussion_banner == 'true') {
                $json['show_health_discussion_banner'] = 'true';
            }
        }
        if (!empty($sign_up_section->show_signup_sec)) {
            if ($sign_up_section->show_signup_sec == 'true') {
                $json['show_signup_sec'] = 'true';
            }
        }
         if (!empty($banner_video_section->show_bannervide_sec)) {
            if ($banner_video_section->show_bannervide_sec == 'true') {
                $json['show_bannervide_sec'] = 'true';
            }
        }
          if (!empty($small_devices_top_section->show_smalldevice_sec)) {
            if ($small_devices_top_section->show_smalldevice_sec == 'true') {
                $json['show_smalldevice_sec'] = 'true';
            }
        }
        if (!empty($onlin_video_banner_sec->show_onlin_video_sec)) {
            if ($onlin_video_banner_sec->show_onlin_video_sec == 'true') {
                $json['show_onlin_video_sec'] = 'true';
            }
        }
        if (!empty($procedure_banner_section->show_procedure_banner_sec)) {
            if ($procedure_banner_section->show_procedure_banner_sec == 'true') {
                $json['show_procedure_banner_sec'] = 'true';
            }
        }
         if (!empty($city_wise_doctor_section->show_city_wise_doctor_sec)) {
            if ($city_wise_doctor_section->show_city_wise_doctor_sec == 'true') {
                $json['show_city_wise_doctor_sec'] = 'true';
            }
        }
        if (!empty($city_wise_hospital_section->show_city_wise_hospital_sec)) {
            if ($city_wise_hospital_section->show_city_wise_hospital_sec == 'true') {
                $json['show_city_wise_hospital_sec'] = 'true';
            }
        }
        if (!empty($about_us_banner_section->show_about_us_banner_sec)) {
            if ($about_us_banner_section->show_about_us_banner_sec == 'true') {
                $json['show_about_us_banner_sec'] = 'true';
            }
        }
        if (!empty($for_doctor_sign_up->show_for_doctor_sign_up_sec)) {
            if ($for_doctor_sign_up->show_for_doctor_sign_up_sec == 'true') {
                $json['show_for_doctor_sign_up_sec'] = 'true';
            }
        }
        if (!empty($about_us_we_are_here->show_about_us_we_are_here_sec)) {
            if ($about_us_we_are_here->show_about_us_we_are_here_sec == 'true') {
                $json['show_about_us_we_are_here_sec'] = 'true';
            }
        }
        if (!empty($about_us_our_dream->show_about_us_our_dream_sec)) {
            if ($about_us_our_dream->show_about_us_our_dream_sec == 'true') {
                $json['show_about_us_our_dream_sec'] = 'true';
            }
        }
        if (!empty($for_hospital_knockdoc_tool->show_for_hospital_knockdoc_tool_sec)) {
            if ($for_hospital_knockdoc_tool->show_for_hospital_knockdoc_tool_sec == 'true') {
                $json['show_for_hospital_knockdoc_tool_sec'] = 'true';
            }
        }
        if (!empty($for_hospital_knockdoc_profile->show_for_hospital_knockdoc_profile_sec)) {
            if ($for_hospital_knockdoc_profile->show_for_hospital_knockdoc_profile_sec == 'true') {
                $json['show_for_hospital_knockdoc_profile_sec'] = 'true';
            }
        }
        if (!empty($for_hospital_fourth_section->show_for_hospital_fourth_section_sec)) {
            if ($for_hospital_fourth_section->show_for_hospital_fourth_section_sec == 'true') {
                $json['show_for_hospital_fourth_section_sec'] = 'true';
            }
        }
        if (!empty($for_labs_knockdoc->show_for_labs_knockdoc_sec)) {
            if ($for_labs_knockdoc->show_for_labs_knockdoc_sec == 'true') {
                $json['show_for_labs_knockdoc_sec'] = 'true';
            }
        }
        if (!empty($for_labs_knockdoc_profile->show_for_labs_knockdoc_profile_sec)) {
            if ($for_labs_knockdoc_profile->show_for_labs_knockdoc_profile_sec == 'true') {
                $json['show_for_hospital_knockdoc_profile_sec'] = 'true';
            }
        }
        if (!empty($show_headertabs)) {
            if ($show_headertabs == 'true') {
                $json['show_headertabs'] = 'true';
            }
        }
        if (!empty($show_for_labs_benefits_of_knockdoc_sec)) {
            if ($show_for_labs_benefits_of_knockdoc_sec == 'true') {
                $json['show_for_labs_benefits_of_knockdoc_sec'] = 'true';
            }
        }
        
        if (!empty($show_healthtabs)) {
            if ($show_healthtabs == 'true') {
                $json['show_healthtabs'] = 'true';
            }
        }
        return $json;
    }
    /**
     * Store service section color settings
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getHomeServiceSectionsColorSettings()
    {
        $json = array();
        $services_tab_sec = !empty(SiteManagement::getMetaValue('services_tab_sec')) ? SiteManagement::getMetaValue('services_tab_sec') : array();
        if (!empty($services_tab_sec)) {
            $json['type'] = 'success';
            $json['section'] = $services_tab_sec;
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Store general settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeGeneralSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $store_general_settings = $this->settings->saveGeneralSettings($request);
            if ($store_general_settings['type'] == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($store_general_settings == "lang_not_found") {
                $json['type'] = 'error';
                $json['message'] = trans('lang.lang_not_found');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

    /**
     * Store sidebar settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeSidebarSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $store_sidebar_settings = $this->settings->saveSidebarSettings($request);
            if ($store_sidebar_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($store_sidebar_settings == "lang_not_found") {
                $json['type'] = 'error';
                $json['message'] = trans('lang.lang_not_found');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

    /**
     * Store sidebar settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeforumSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $store_forum_settings = $this->settings->saveforumSettings($request);
            if ($store_forum_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($store_forum_settings == "lang_not_found") {
                $json['type'] = 'error';
                $json['message'] = trans('lang.lang_not_found');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

    /**
     * Get theme color display settings
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getThemeColorDisplaySetting()
    {
        $settings = array();
        $json = array();
        $settings = SiteManagement::getMetaValue('general_settings');
        //Primary Color
        if (!empty($settings->enable_primary_color)) {
            if ($settings->enable_primary_color == 'true') {
                $json['enable_primary_color'] = 'true';
            }
        }
        //Secondary Color
        if (!empty($settings->enable_secondary_color)) {
            if ($settings->enable_secondary_color == 'true') {
                $json['enable_secondary_color'] = 'true';
            }
        }
        //Tertiary Color
        if (!empty($settings->enable_tertiary_color)) {
            if ($settings->enable_tertiary_color == 'true') {
                $json['enable_tertiary_color'] = 'true';
            }
        }
        $json['primary_color'] = !empty($settings->primary_color) ? $settings->primary_color : '';
        $json['secondary_color'] = !empty($settings->secondary_color) ? $settings->secondary_color : '';
        $json['tertiary_color'] = !empty($settings->tertiary_color) ? $settings->tertiary_color : '';
        return $json;
    }

    /**
     * Get theme color display settings
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getThemeLanguageSetting()
    {
        $settings = array();
        $json = array();
        $settings = SiteManagement::getMetaValue('general_settings');
        if (!empty($settings['language'])) {
            $json['type'] = 'success';
            $json['language'] = $settings['language'];
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Store topbar settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeTopBarSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $store_topbar_settings = $this->settings->saveTopBarSettings($request);
            if ($store_topbar_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($store_topbar_settings == "lang_not_found") {
                $json['type'] = 'error';
                $json['message'] = trans('lang.lang_not_found');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }
    /**
     * Store booking settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAppointmentBookingSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $store_topbar_settings = $this->settings->saveBookingSettings($request);
            if ($store_topbar_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($store_topbar_settings == "lang_not_found") {
                $json['type'] = 'error';
                $json['message'] = trans('lang.lang_not_found');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

    /**
     * Get topbar switch settings
     * It includes Enable/Disable TopBar &
     * Enable/Disable TopBar Social Icons
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getTopbarSwicthSettings()
    {
        $settings = array();
        $json = array();
        $settings = SiteManagement::getMetaValue('topbar_settings');
        //Enable TopBar
        if (!empty($settings->enable_topbar)) {
            if ($settings->enable_topbar == 'true') {
                $json['enable_topbar'] = 'true';
            }
        }
        //Enable Social Icons
        if (!empty($settings->enable_social_icons)) {
            if ($settings->enable_social_icons == 'true') {
                $json['enable_social_icons'] = 'true';
            }
        }
        return $json;
    }

    /**
     * Get topbar switch settings
     * It includes Enable/Disable TopBar &
     * Enable/Disable TopBar Social Icons
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getBookingSwicthSettings()
    {
        $settings = array();
        $json = array();
        $settings = SiteManagement::getMetaValue('booking_settings');
        //Enable TopBar
        if (!empty($settings['enable_booking'])) {
            if ($settings['enable_booking'] == 'true') {
                $json['enable_booking'] = 'true';
            }
        }
        return $json;
    }

    /**
     * Import new updates
     *
     * @return \Illuminate\Http\Response
     */
    public function importUpdate()
    {
        $json = array();
        \Artisan::call('migrate');
        $json['type'] = 'success';
        return $json;
    }

    /**
     * Get footer settings
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getFooterSettings()
    {
        $settings = array();
        $json = array();
        $settings = SiteManagement::getMetaValue('footer_settings');
        //Enable Contact Info Area
        if (!empty($settings->show_contact_info_sec)) {
            if ($settings->show_contact_info_sec == 'true') {
                $json['show_contact_info_sec'] = 'true';
            }
        }
        //Enable Footer Socials
        if (!empty($settings->enable_footer_socials)) {
            if ($settings->enable_footer_socials == 'true') {
                $json['enable_footer_socials'] = 'true';
            }
        }
        return $json;
    }

    /**
     * Store social settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeSocialSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request['social'])) {
            $social_settings = $this->settings->saveSocialSettings($request['social']);
            if ($social_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Store footer social settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeFooterSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $image_size = array(
                'small',
            );
            $footer_settings = $this->settings->saveFooterSettings($request, $image_size);
            if ($footer_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Get awards.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoles()
    {
        $json = array();
        if (Auth::user()) {
            $roles = Role::select('id', 'name')->get()->toArray();
            if (!empty($roles)) {
                $json['type'] = 'success';
                $json['roles'] = $roles;
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
     * Update Role.
     *
     * @param mixed $request get req attributes
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateRole(Request $request)
    {
        $json = array();
        if (Auth::user()) {
            $role_id = $request['role_id'];
            $role_name = $request['role_name'];
            if (!empty($role_id)) {
                DB::table('roles')
                    ->where('id', $role_id)
                    ->update(['name' => $role_name]);
                $json['type'] = 'success';
                $json['message'] = 'Role Updated';
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
     * Store social settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return View
     */
    public function storeArticleSectionSettings(Request $request)
    {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $data_protection = $this->settings->saveDataProtection($request);
            if ($data_protection == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    public function storeHealthCommunityBanner(Request $request)
         {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $health_community = $this->settings->saveHealthCommunityBanner($request);
            if ($health_community == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
      public function storeDoctorInnerSection(Request $request)
         {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $doctor_inner = $this->settings->saveDoctorInnerSection($request);
            if ($doctor_inner == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
    public function storeHealthDiscussionBanner(Request $request)
    {
      //  dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $health_discussion = $this->settings->saveHealthDiscussionBanner($request);
            if ($health_discussion == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
    public function storeSignUpSection(Request $request)
    {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $sign_up = $this->settings->saveSignUp($request);
            if ($sign_up == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
      public function storeBannerVideoSection(Request $request)
    {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $bannervideo = $this->settings->saveBannerVideo($request);
            if ($bannervideo == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
      public function storeSmallDeviceSection(Request $request)
    {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $smalldevice = $this->settings->saveSmallDevice($request);
            if ($smalldevice == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

      public function storeMapImageSection(Request $request)
    {
       // dd($request->all());
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $this->validate(
            $request,
            [
                'hidden_map_img' => 'required',
            ]
        );
        $json = array();
        if (!empty($request)) {
            $mapimage = $this->settings->saveMapImage($request);
            if ($mapimage == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }
    /**
     * Store doctor slider section settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return View
     */
    public function storeDoctorSliderSectionSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $doctors_slider = $this->settings->saveDoctorsSliderSectionSettings($request);
            if ($doctors_slider == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Get Page Options for the show page and show banner.
     *
     * @param mixed $request get req attributes
     * 
     * @return \Illuminate\Http\Response
     */
    public function getPageOption(Request $request)
    {
        $json = array();
        if (!empty($request['page_id'])) {
            $page = Page::find($request['page_id']);
            if (!empty($page)) {
                $meta = !empty($page->meta) ? Helper::getUnserializeData($page->meta) : '';
                $show_page = !empty($meta) ? $meta['show_page'] : '';
                $json['type'] = 'success';
                $json['show_page'] = $show_page;
                return $json;
            }
        }
    }

    /**
     * Get chat display setting
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getChatDisplaySetting()
    {
        $json = array();
        $settings = !empty(SiteManagement::getMetaValue('general_settings')) ? SiteManagement::getMetaValue('general_settings') : array();
        if (!empty($settings->display_chat)) {
            if ($settings->display_chat == 'true') {
                $json['display_chat'] = 'true';
            } else if ($settings['display_chat'] == 'false') {
                $json['display_chat'] = 'false';
            } else {
                $json['display_chat'] = 'true';
            }
        }
        if (!empty($settings->display_registration)) {
            if ($settings->display_registration == 'true') {
                $json['display_registration'] = 'true';
            } else if ($settings['display_registration'] == 'false') {
                $json['display_registration'] = 'false';
            } else {
                $json['display_registration'] = 'true';
            }
        }
        return $json;
    }

    /**
     * Get chat display setting
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function getSidebarSetting()
    {
        $json = array();
        $settings = !empty(SiteManagement::getMetaValue('sidebar_settings')) ? SiteManagement::getMetaValue('sidebar_settings') : array();
        if (!empty($settings['display_sidebar'])) {
            if ($settings['display_sidebar'] == 'true') {
                $json['display_sidebar'] = 'true';
            } else if ($settings['display_sidebar'] == 'false') {
                $json['display_sidebar'] = 'false';
            } else {
                $json['display_sidebar'] = 'true';
            }
        }
        if (!empty($settings['display_query_section'])) {
            if ($settings['display_query_section'] == 'true') {
                $json['display_query_section'] = 'true';
            } else if ($settings['display_query_section'] == 'false') {
                $json['display_query_section'] = 'false';
            } else {
                $json['display_query_section'] = 'true';
            }
        }
        if (!empty($settings['display_get_app_sec'])) {
            if ($settings['display_get_app_sec'] == 'true') {
                $json['display_get_app_sec'] = 'true';
            } else if ($settings['display_get_app_sec'] == 'false') {
                $json['display_get_app_sec'] = 'false';
            } else {
                $json['display_get_app_sec'] = 'true';
            }
        }
        if (!empty($settings['display_get_ad_sec'])) {
            if ($settings['display_get_ad_sec'] == 'true') {
                $json['display_get_ad_sec'] = 'true';
            } else if ($settings['display_get_ad_sec'] == 'false') {
                $json['display_get_ad_sec'] = 'false';
            } else {
                $json['display_get_ad_sec'] = 'true';
            }
        }
        return $json;
    }

    /**
     * Store dashboard icons
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeDashboardIcons(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $upload_icons
                = $this->settings->saveIcons($request);
            if ($upload_icons == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } elseif ($upload_icons == "lang_not_found") {
                $json['type'] = 'error';
                $json['message'] = trans('lang.lang_not_found');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

    /**
     * Import Demo content.
     *
     * @return \Illuminate\Http\Response
     */
    public function importDemo()
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return redirect()->to('admin/settings/general-settings');
        }
        \Artisan::call('migrate:fresh');
        \Artisan::call('db:seed');
        return redirect()->to('/');
    }

    /**
     * Remove Demo content.
     *
     * @return \Illuminate\Http\Response
     */
    public function removeDemoContent()
    {
        $server_verification = Helper::doctieIsDemoSite();
        if (!empty($server_verification)) {
            Session::flash('error', $server_verification);
            return Redirect::back();
        }
        \Artisan::call('migrate:fresh');
        \Artisan::call('db:seed', ['--class' => 'UserSeeder', '--force' => true]);
        \Artisan::call('db:seed', ['--class' => 'RoleTableSeeder', '--force' => true]);
        \Artisan::call('db:seed', ['--class' => 'ModelRoleSeeder', '--force' => true]);
        \Artisan::call('db:seed', ['--class' => 'EmailTemplateSeeder', '--force' => true]);
        \Artisan::call('db:seed', ['--class' => 'EmailTypeSeeder', '--force' => true]);
        return redirect()->to('/');
    }

    /**
     * Clear select cache of the app.
     *
     * @param boolean $request $req
     *
     * @return \Illuminate\Http\Response
     */
    public function clearCache(Request $request)
    {
        $json = array();
        if ($request['clear_cache'] == true) {
            \Artisan::call('config:cache');
            \Artisan::call('cache:clear');
            \Artisan::call('config:clear');
        }
        if ($request['clear_views'] == true) {
            \Artisan::call('view:clear');
        }
        if ($request['clear_routes'] == true) {
            \Artisan::call('route:clear');
        }
        $json['type'] = 'success';
        return $json;
    }

    /**
     * Remove all cache of the app.
     *
     * @return \Illuminate\Http\Response
     */
    public function clearAllCache()
    {
        $json = array();
        \Artisan::call('optimize:clear');
        $json['type'] = 'success';
        return $json;
    }

    /**
     * Store chat settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeChatSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $store_chat_settings
                = $this->settings->saveChatSettings($request);
            if ($store_chat_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

    /**
     * Store Email Settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeEmailSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $store_email_settings
                = $this->settings->saveEmailSettings($request);
            if ($store_email_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

    /**
     * Store payment settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storePaymentSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $default_settings = $this->settings->savePaymentSettings($request);
            if ($default_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Store paypal settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storePaypalSettings(Request $request)
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
                'client_id' => 'required',
                'paypal_password' => 'required',
                'paypal_secret' => 'required',
            ]
        );
        $json = array();
        if (!empty($request)) {
            $default_settings = $this->settings->savePaypalSettings($request);
            if ($default_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Store stripe settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeStripeSettings(Request $request)
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
                'stripe_key' => 'required',
                'stripe_secret' => 'required',
            ]
        );
        $json = array();
        if (!empty($request)) {
            $default_settings = $this->settings->saveStripeSettings($request);
            if ($default_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_wrong');
            return $json;
        }
    }

    /**
     * Get Site Payment Option.
     *
     * @return response
     */
    public function getSitePaymentOption()
    {
        $json = array();
        $paypal_settings = !empty(SiteManagement::getMetaValue('paypal_settings')) ? SiteManagement::getMetaValue('paypal_settings') : array();
        if (!empty($paypal_settings['enable_sandbox'])) {
            $json['enable_sandbox'] = $paypal_settings['enable_sandbox'];
        } else {
            $json['enable_sandbox'] = 'false';
        }
        return $json;
    }

    /**
     * Store Inner Page Settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeDoctorSliderSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $store_doctor_slider_settings
                = $this->settings->saveDoctorsSliderSectionSettings($request);
            if ($store_doctor_slider_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

    /**
     * Store Inner Page Settings
     *
     * @param mixed $request get req attributes
     *
     * @access public
     *
     * @return \Illuminate\Http\Response
     */
    public function storeInnerPageSettings(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        $json = array();
        if (!empty($request)) {
            $store_inner_page_settings
                = $this->settings->saveInnerPageSettings($request);
            if ($store_inner_page_settings == "success") {
                $json['type'] = 'success';
                $json['progressing'] = trans('lang.saving');
                $json['message'] = trans('lang.settings_saved');
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_wrong');
                return $json;
            }
        }
    }

    /**
     * Get inner page settings.
     *
     * @return show job single page
     */
    public function getInnerPageSettings()
    {
        $json = array();
        $inner_page_settings = !empty(SiteManagement::getMetaValue('inner_page_data')) ? SiteManagement::getMetaValue('inner_page_data') : array();
        if (!empty($inner_page_settings['show_search_form'])) {
            if ($inner_page_settings['show_search_form'] == 'true') {
                $json['show_search_form'] = 'true';
            }
        }
        if (!empty($inner_page_settings['enable_breadcrumbs'])) {
            if ($inner_page_settings['enable_breadcrumbs'] == 'true') {
                $json['enable_breadcrumbs'] = 'true';
            }
        }
        return $json;
    }    
}
