<?php

/**
 * Class SiteManagement
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
use File;
use Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

/**
 * Class SiteManagement
 *
 */
class SiteManagement extends Model
{
    use Cachable;

    protected $table = 'site_managements';
     protected $fillable = [
'meta_key','meta_value'];
    /**
     * Get Meta Values form meta keys.
     *
     * @param string $meta_key meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public static function getMetaValue($meta_key)
    {
        if (!empty($meta_key)) {
            $data = SiteManagement::select('meta_value')->where('meta_key', $meta_key)->get()->first();
            if (!empty($data)) {
                $fixed_data = preg_replace_callback(
                    '!s:(\d+):"(.*?)";!',
                    function ($match) {
                        return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
                    },
                    $data->meta_value
                );
                return json_decode($fixed_data);
            }
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveHomeSliderSettings($request)
    {
        
        if (!empty($request)) {
            $slides = $request['slide'];
            $slider_bg_img_data = DB::table('site_managements')->where('meta_key', '=', 'slider_bg_img')->select('meta_value')->first();
            $existing_data = SiteManagement::getMetaValue('home_slider');
            if (!empty($slides)) {
                foreach ($slides as $key => $home) {
                    $slides[$key]['slide_title_one'] = $home['slide_title_one'];
                    $slides[$key]['slide_title_two'] = $home['slide_title_two'];
                }
                //Saving slides
                if (!empty($existing_data)) {
                    DB::table('site_managements')->where('meta_key', '=', 'home_slider')->delete();
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'home_slider', 'meta_value' => json_encode($slides),
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
            } else {
                DB::table('site_managements')->where('meta_key', '=', 'home_slider')->delete();
            }
            
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request    req->attr
     * @param array  $image_size image_size
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveHomeSearchBannerSettings($request, $image_size = array())
    {
     //  dd($request->all());
        if (!empty($request)) {
            $search_tabs = $request['tabs'];
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_search_banner_img'])) {
                $filename = $request['hidden_search_banner_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty($image_size)) {
                        foreach ($image_size as $size) {
                            rename($old_path . '/' . $size . '-' . $file_original_name, $new_path . '/' . $size . '-' . $filename);
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                    $request['hidden_search_banner_img'] = $filename;
                }
            }
            if (!empty($search_tabs)) {
                foreach ($search_tabs as $key => $hw_tab) {
                    $search_tabs[$key]['title'] = $hw_tab['title'];
                }
            $existing_data = SiteManagement::getMetaValue('home_search_banner');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'home_search_banner')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'home_search_banner', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
              return 'success';
        } else {
            return 'error';
        }
    }
    else {
            return 'error';
        }
}

  public static function saveOnlinVideoSection($request, $image_size = array())
    {
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_onlin_video_img'])) {
                $filename = $request['hidden_onlin_video_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_onlin_video_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('onlin_video_banner_sec');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'onlin_video_banner_sec')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'onlin_video_banner_sec', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

     public static function saveProcedureBannerSection($request, $image_size = array())
    {
       // dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_procedure_banner_img'])) {
                $filename = $request['hidden_procedure_banner_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_procedure_banner_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('procedure_banner_section');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'procedure_banner_section')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'procedure_banner_section', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    public static function saveCitywiseDoctorSection($request, $image_size = array())
    {
       // dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_city_wise_doctor_img'])) {
                $filename = $request['hidden_city_wise_doctor_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_city_wise_doctor_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('city_wise_doctor_section');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'city_wise_doctor_section')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'city_wise_doctor_section', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

      public static function saveCitywiseHospitalSection($request, $image_size = array())
    {
       // dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_city_wise_hospital_img'])) {
                $filename = $request['hidden_city_wise_hospital_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_city_wise_hospital_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('city_wise_hospital_section');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'city_wise_hospital_section')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'city_wise_hospital_section', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
     public static function saveAboutUsBannerSection($request, $image_size = array())
    {
       // dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_about_us_banner_img'])) {
                $filename = $request['hidden_about_us_banner_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_about_us_banner_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('about_us_banner_section');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'about_us_banner_section')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'about_us_banner_section', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */

public static function saveForDoctorSignUp($request, $image_size = array())
    {
       // dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_for_doctor_sign_up_img'])) {
                $filename = $request['hidden_for_doctor_sign_up_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_for_doctor_sign_up_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('about_us_banner_section');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'for_doctor_sign_up')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'for_doctor_sign_up', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */

    public static function saveAboutUsWeAreHere($request, $image_size = array())
    {
       // dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_about_us_we_are_here_img'])) {
                $filename = $request['hidden_about_us_we_are_here_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_about_us_we_are_here_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('about_us_we_are_here');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'about_us_we_are_here')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'about_us_we_are_here', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
   
    public static function saveAboutUsOurDream($request, $image_size = array())
    {
       // dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_about_us_our_dream_img'])) {
                $filename = $request['hidden_about_us_our_dream_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_about_us_our_dream_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('about_us_our_dream');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'about_us_our_dream')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'about_us_our_dream', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveForHospitalKnockdocTool($request, $image_size = array())
    {
       // dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_for_hospital_knockdoc_tool_img'])) {
                $filename = $request['hidden_for_hospital_knockdoc_tool_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_for_hospital_knockdoc_tool_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('for_hospital_knockdoc_tool');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'for_hospital_knockdoc_tool')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'for_hospital_knockdoc_tool', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveForHospitalKnockdocProfile($request, $image_size = array())
    {
       // dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_for_hospital_knockdoc_profile_img'])) {
                $filename = $request['hidden_for_hospital_knockdoc_profile_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_for_hospital_knockdoc_profile_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('for_hospital_knockdoc_profile');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'for_hospital_knockdoc_profile')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'for_hospital_knockdoc_profile', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveForHospitalFourthSection($request, $image_size = array())
    {
       // dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_for_hospital_fourth_section_img'])) {
                $filename = $request['hidden_for_hospital_fourth_section_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_for_hospital_fourth_section_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('for_hospital_fourth_section');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'for_hospital_fourth_section')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'for_hospital_fourth_section', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveForLabsKnockdoc($request, $image_size = array())
    {
       // dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_for_labs_knockdoc_img'])) {
                $filename = $request['hidden_for_labs_knockdoc_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_for_labs_knockdoc_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('for_labs_knockdoc');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'for_labs_knockdoc')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'for_labs_knockdoc', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveForLabsKnockdocProfile($request, $image_size = array())
    {
       // dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_for_labs_knockdoc_profile_img'])) {
                $filename = $request['hidden_for_labs_knockdoc_profile_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_for_labs_knockdoc_profile_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('for_labs_knockdoc_profile');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'for_labs_knockdoc_profile')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'for_labs_knockdoc_profile', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveHomeAboutUsSettings($request)
    {
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_about_us_img'])) {
                $filename = $request['hidden_about_us_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_about_us_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('home_doctor_sec');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'home_doctor_sec')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'home_doctor_sec', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Store registration settings
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveRegistrationSettings($request)
    {
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/registration-form';
            if (!empty($request['hidden_register_image'])) {
                if (file_exists($old_path . '/' . $request['hidden_register_image'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['hidden_register_image'];
                    rename($old_path . '/' . $request['hidden_register_image'], $new_path . '/' . $filename);
                    $request['hidden_register_image'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('reg_form_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'reg_form_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'reg_form_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveHowItWorksSettings($request)
    {
        if (!empty($request)) {
            $existing_data = SiteManagement::getMetaValue('subscribe_now_sec');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'subscribe_now_sec')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'subscribe_now_sec', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveServiceTabsSettings($request)
    {
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_first_service_tab_img'])) {
                $filename = $request['hidden_first_service_tab_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_first_service_tab_img'] = $filename;
                }
            }
        $json = array();
        if (!empty($request)) {
            $service_tabs = $request['service_tab'];
            foreach ($service_tabs as $key => $tab) {
                if (empty($tab['title']) || empty($tab['subtitle']) || empty($tab['btn_title']) || empty($tab['btn_url'])) {
                    $json['type'] = 'error';
                    $json['message'] = trans('lang.empty_fields_not_allowed');
                    return $json;
                }
                $service_tabs[$key]['title'] = $tab['title'];
                $service_tabs[$key]['subtitle'] = $tab['subtitle'];
                $service_tabs[$key]['btn_title'] = $tab['btn_title'];
                $service_tabs[$key]['btn_url'] = $tab['btn_url'];
                
            }

            $existing_data = SiteManagement::getMetaValue('services_tab_sec');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'services_tab_sec')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'services_tab_sec', 'meta_value' => json_encode($service_tabs),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            $existing_tab_setting = self::where('meta_key', 'show_services_section')->select('meta_value')->pluck('meta_value')->first();
            if (!empty($existing_tab_setting)) {
                DB::table('site_managements')->where('meta_key', '=', 'show_services_section')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'show_services_section', 'meta_value' => $request['show_services_section'],
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }
}
    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveHowWorksTabSettings($request)
    {
        if (!empty($request)) {
            $how_works_tabs = $request['tabs'];
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_how_it_works_img'])) {
                $filename = $request['hidden_how_it_works_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_how_it_works_img'] = $filename;
                }
            }
            if (!empty($how_works_tabs)) {
                foreach ($how_works_tabs as $key => $hw_tab) {
                    $how_works_tabs[$key]['title'] = $hw_tab['title'];
                    $how_works_tabs[$key]['subtitle'] = $hw_tab['subtitle'];
                    $how_works_tabs[$key]['btn_title'] = $hw_tab['btn_title'];
                    $how_works_tabs[$key]['btn_url'] = $hw_tab['btn_url'];
                }
                $existing_data = SiteManagement::getMetaValue('how_work_tabs');
                if (!empty($existing_data)) {
                    DB::table('site_managements')->where('meta_key', 'how_work_tabs')->delete();
                }
                DB::table('site_managements')->insert(
                     [
                    'meta_key' => 'how_work_tabs', 'meta_value' => json_encode($request->except('_token','show_how_work_tabs')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
                );
                $existing_tab_setting = self::where('meta_key', 'show_how_work_tabs')->select('meta_value')->pluck('meta_value')->first();
                if (!empty($existing_tab_setting)) {
                    DB::table('site_managements')->where('meta_key', '=', 'show_how_work_tabs')->delete();
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'show_how_work_tabs', 'meta_value' => $request['show_how_work_tabs'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
                $json['type'] = 'success';
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_went_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }

    public static function saveHeaderServiceSettings($request)
    {
       // dd($request['show_headertabs']);
        if (!empty($request)) {
            $header_service_tabs = $request['tabs'];
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($header_service_tabs)) {
                foreach ($header_service_tabs as $key => $hw_tab) {
                    $header_service_tabs[$key]['title'] = $hw_tab['title'];
                    $header_service_tabs[$key]['subtitle'] = $hw_tab['subtitle'];
                    if (!empty($hw_tab['tab_img'])) {
                        $filename = $hw_tab['tab_img'];
                        $parts = explode('.', $filename);
                        $file_original_name = $parts[0].'.webp';
                        if (file_exists($old_path . '/' . $file_original_name)) {
                            if (!file_exists($new_path)) {
                                File::makeDirectory($new_path, 0755, true, true);
                            }
                            $filename = time() . '-' . $file_original_name;
                            rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                            $header_service_tabs[$key]['tab_img'] = $filename;
                        }
                    } else {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.tab_image_required');
                        return $json;
                    }
                }
                $existing_data = SiteManagement::getMetaValue('header_service');
                if (!empty($existing_data)) {
                    DB::table('site_managements')->where('meta_key', 'header_service')->delete();
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'header_service', 'meta_value' => json_encode($header_service_tabs),
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
                $existing_tab_setting = self::where('meta_key', 'show_headertabs')->select('meta_value')->pluck('meta_value')->first();
                if (!empty($existing_tab_setting)) {
                    DB::table('site_managements')->where('meta_key', '=', 'show_headertabs')->delete();
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'show_headertabs', 'meta_value' => $request['show_headertabs'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
                $json['type'] = 'success';
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_went_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }
    public static function saveForLabsBenefitsOfKnockdoc($request)
    {
       // dd($request['show_headertabs']);
        if (!empty($request)) {
            $for_labs_benefits_of_knockdoc = $request['for_lab_tabs'];
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($for_labs_benefits_of_knockdoc)) {
                foreach ($for_labs_benefits_of_knockdoc as $key => $for_lab_hw_tab) {
                    $for_labs_benefits_of_knockdoc[$key]['title'] = $for_lab_hw_tab['title'];
                    $for_labs_benefits_of_knockdoc[$key]['subtitle'] = $for_lab_hw_tab['subtitle'];
                    if (!empty($for_lab_hw_tab['for_lab_tab_img'])) {
                        $filename = $for_lab_hw_tab['for_lab_tab_img'];
                        $parts = explode('.', $filename);
                        $file_original_name = $parts[0].'.webp';
                        if (file_exists($old_path . '/' . $file_original_name)) {
                            if (!file_exists($new_path)) {
                                File::makeDirectory($new_path, 0755, true, true);
                            }
                            $filename = time() . '-' . $file_original_name;
                            rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                            $for_labs_benefits_of_knockdoc[$key]['for_lab_tab_img'] = $filename;
                        }
                    } else {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.for_lab_tab_image_required');
                        return $json;
                    }
                }
                $existing_data = SiteManagement::getMetaValue('for_labs_benefits_of_knockdoc');
                if (!empty($existing_data)) {
                    DB::table('site_managements')->where('meta_key', 'for_labs_benefits_of_knockdoc')->delete();
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'for_labs_benefits_of_knockdoc', 'meta_value' => json_encode($for_labs_benefits_of_knockdoc),
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
                $existing_tab_setting = self::where('meta_key', 'show_for_labs_benefits_of_knockdoc_sec')->select('meta_value')->pluck('meta_value')->first();
                if (!empty($existing_tab_setting)) {
                    DB::table('site_managements')->where('meta_key', '=', 'show_for_labs_benefits_of_knockdoc_sec')->delete();
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'show_for_labs_benefits_of_knockdoc_sec', 'meta_value' => $request['show_for_labs_benefits_of_knockdoc_sec'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
                $json['type'] = 'success';
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_went_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }
    public static function saveHealthCommunitySlider($request)
    {
       //  dd($request['tabs']);
        if (!empty($request)) {
            $health_community_slider_tabs = $request['tabs'];
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($health_community_slider_tabs)) {
                foreach ($health_community_slider_tabs as $key => $hw_tab) {
                    $health_community_slider_tabs[$key]['title'] = $hw_tab['title'];
                    $health_community_slider_tabs[$key]['subtitle'] = $hw_tab['subtitle'];
                    $health_community_slider_tabs[$key]['description'] = $hw_tab['description'];
                    
                    if (!empty($hw_tab['health_img'])) {
                        $filename = $hw_tab['health_img'];
                        $parts = explode('.', $filename);
                        $file_original_name = $parts[0].'.webp';
                        if (file_exists($old_path . '/' . $file_original_name)) {
                            if (!file_exists($new_path)) {
                                File::makeDirectory($new_path, 0755, true, true);
                            }
                            $filename = time() . '-' . $file_original_name;
                            rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                            $health_community_slider_tabs[$key]['health_img'] = $filename;
                        }
                    } 
                    // else {
                    //     $json['type'] = 'error';
                    //     $json['message'] = trans('lang.tab_image_required');
                    //     return $json;
                    // }
                }
                $existing_data = SiteManagement::getMetaValue('health_community_slider');
                if (!empty($existing_data)) {
                    DB::table('site_managements')->where('meta_key', 'health_community_slider')->delete();
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'health_community_slider', 'meta_value' => json_encode($health_community_slider_tabs),
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
                $existing_tab_setting = self::where('meta_key', 'show_healthtabs')->select('meta_value')->pluck('meta_value')->first();
                if (!empty($existing_tab_setting)) {
                    DB::table('site_managements')->where('meta_key', '=', 'show_healthtabs')->delete();
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'show_healthtabs', 'meta_value' => $request['show_healthtabs'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
                $json['type'] = 'success';
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_went_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }
        public static function saveBenefitsOnlineProfile($request)
         {
        //dd($request->all());
        if (!empty($request)) {
            $benefits_online_tabs = $request['tabs'];
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_benefits_online_img'])) {
                $filename = $request['hidden_benefits_online_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_benefits_online_img'] = $filename;
                }
            }
            if (!empty($benefits_online_tabs)) {
                foreach ($benefits_online_tabs as $key => $hw_tab) {
                    $benefits_online_tabs[$key]['title'] = $hw_tab['title'];
                    $benefits_online_tabs[$key]['subtitle'] = $hw_tab['subtitle'];
                }
                $existing_data = SiteManagement::getMetaValue('benefits_online_profile');
                if (!empty($existing_data)) {
                    DB::table('site_managements')->where('meta_key', 'benefits_online_profile')->delete();
                }
                DB::table('site_managements')->insert(
                     [
                    'meta_key' => 'benefits_online_profile', 'meta_value' => json_encode($request->except('_token','show_onlinetabs')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
                );
                $existing_tab_setting = self::where('meta_key', 'show_onlinetabs')->select('meta_value')->pluck('meta_value')->first();
                if (!empty($existing_tab_setting)) {
                    DB::table('site_managements')->where('meta_key', '=', 'show_onlinetabs')->delete();
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'show_onlinetabs', 'meta_value' => $request['show_onlinetabs'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
                $json['type'] = 'success';
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_went_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }

    public static function saveBenefitsOnlineDoctor($request)
    {
       // dd($request->all());
        if (!empty($request)) {
            $benefits_onlinedoctor_tabs = $request['tabs'];
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_benefits_onlinedoctor_img'])) {
                $filename = $request['hidden_benefits_onlinedoctor_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_benefits_onlinedoctor_img'] = $filename;
                }
            }
            if (!empty($benefits_onlinedoctor_tabs)) {
                foreach ($benefits_onlinedoctor_tabs as $key => $hw_tab) {
                    $benefits_onlinedoctor_tabs[$key]['title'] = $hw_tab['title'];
                    $benefits_onlinedoctor_tabs[$key]['subtitle'] = $hw_tab['subtitle'];
                }
                $existing_data = SiteManagement::getMetaValue('benefits_online_doctor');
                if (!empty($existing_data)) {
                    DB::table('site_managements')->where('meta_key', 'benefits_online_doctor')->delete();
                }
                DB::table('site_managements')->insert(
                     [
                    'meta_key' => 'benefits_online_doctor', 'meta_value' => json_encode($request->except('_token','show_onlinedoctortabs')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
                );
                $existing_tab_setting = self::where('meta_key', 'show_onlinedoctortabs')->select('meta_value')->pluck('meta_value')->first();
                if (!empty($existing_tab_setting)) {
                    DB::table('site_managements')->where('meta_key', '=', 'show_onlinedoctortabs')->delete();
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'show_onlinedoctortabs', 'meta_value' => $request['show_onlinedoctortabs'],
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
                $json['type'] = 'success';
                return $json;
            } else {
                $json['type'] = 'error';
                $json['message'] = trans('lang.something_went_wrong');
                return $json;
            }
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }
    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request    req->attr
     * @param array  $image_size image_size
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveDownloadAppSecSettings($request, $image_size = array())
    {
        $old_path = Helper::PublicPath() . '/uploads/settings/temp';
        $new_path = Helper::PublicPath() . '/uploads/settings/home';
        if (!empty($request)) {
            if (!empty($request['app_sec_img'])) {
                    $filename = $request['app_sec_img'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['app_sec_img'] = $filename;
                }
            }
            if (!empty($request['android_img'])) {
                    $filename = $request['android_img'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty($image_size)) {
                        foreach ($image_size as $size) {
                            rename($old_path . '/' . $size . '-' . $file_original_name, $new_path . '/' . $size . '-' . $filename);
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                    $request['android_img'] = $filename;
                }
            }
            if (!empty($request['ios_img'])) {
                    $filename = $request['ios_img'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty($image_size)) {
                        foreach ($image_size as $size) {
                            rename($old_path . '/' . $size . '-' . $file_original_name, $new_path . '/' . $size . '-' . $filename);
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                    $request['ios_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('download_app_sec');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'download_app_sec')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'download_app_sec', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Save settings
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveGeneralSettings($request)
    {
        $json = array();
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/general';
            if (!empty($request['site_logo'])) {
                     $filename = $request['site_logo'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['site_logo'] = $filename;
                }
            }
            if (!empty($request['site_favicon'])) {
                    $filename = $request['site_favicon'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['site_favicon'] = $filename;
                }
            }
            if (!empty($request['language'])) {
                if (
                    File::exists(resource_path('lang/' . $request['language'] . '/lang.php'))
                    && File::exists(resource_path('lang/' . $request['language'] . '/auth.php'))
                    && File::exists(resource_path('lang/' . $request['language'] . '/pagination.php'))
                    && File::exists(resource_path('lang/' . $request['language'] . '/passwords.php'))
                    && File::exists(resource_path('lang/' . $request['language'] . '/validation.php'))
                ) {
                    Helper::changeEnv(
                        [
                            'APP_LANG' => $request['language'],
                        ]
                    );
                } else {
                    return 'lang_not_found';
                }
            } else {
                return 'lang_not_found';
            }
            $existing_data = SiteManagement::getMetaValue('general_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'general_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'general_settings', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            \Artisan::call('config:cache');
            \Artisan::call('config:clear');
            \Artisan::call('cache:clear');
            \Artisan::call('view:clear');
            $json['type'] = 'success';
            return $json;
        }
    }

    /**
     * Save settings
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveSidebarSettings($request)
    {
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/general';
            if (!empty($request['hidden_ask_query_img'])) {
                if (file_exists($old_path . '/' . $request['hidden_ask_query_img'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['hidden_ask_query_img'];
                    rename($old_path . '/' . $request['hidden_ask_query_img'], $new_path . '/' . $filename);
                    $request['hidden_ask_query_img'] = $filename;
                }
            }
            if (!empty($request['hidden_download_app_img'])) {
                if (file_exists($old_path . '/' . $request['hidden_download_app_img'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['hidden_download_app_img'];
                    rename($old_path . '/' . $request['hidden_download_app_img'], $new_path . '/' . $filename);
                    $request['hidden_download_app_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('sidebar_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'sidebar_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'sidebar_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        }
    }

    /**
     * Save settings
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveforumSettings($request)
    {
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/general';
            if (!empty($request['hidden_forum_banner_image'])) {
                if (file_exists($old_path . '/' . $request['hidden_forum_banner_image'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['hidden_forum_banner_image'];
                    rename($old_path . '/' . $request['hidden_forum_banner_image'], $new_path . '/' . $filename);
                    $request['hidden_forum_banner_image'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('forum_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'forum_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'forum_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        }
    }

    /**
     * Save topbar settings
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveTopBarSettings($request)
    {
      //  dd($request->all());
        if (!empty($request)) {
            $existing_data = SiteManagement::getMetaValue('topbar_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'topbar_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'topbar_settings', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        }
    }

    /**
     * Save seo settings
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveSeoSettings($request)
    {
        if (!empty($request)) {
            $existing_data = SiteManagement::getMetaValue('seo_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'seo_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'seo_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        }
    }

    /**
     * Save appointment booking settings
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveBookingSettings($request)
    {
        if (!empty($request)) {
            $existing_data = SiteManagement::getMetaValue('booking_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'booking_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'booking_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        }
    }

    /**
     * Save social settings
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveSocialSettings($request)
    {
        $socials = $request;
        if (!empty($socials)) {
            foreach ($socials as $socail) {
                if (($socail['title'] == 'Select Social Icons' || $socail['url'] == null)) {
                    return 'error';
                }
            }
            $existing_social = SiteManagement::getMetaValue('socials');
            if (!empty($existing_social)) {
                DB::table('site_managements')->where('meta_key', '=', 'socials')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'socials', 'meta_value' => json_encode($socials),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Save footer settings
     *
     * @param string $request    meta_key
     * @param array  $image_size image_size
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveFooterSettings($request, $image_size = array())
    {
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/general/footer';
            if (!empty($request['c_info_img_one'])) {
                    $filename = $request['c_info_img_one'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty($image_size)) {
                        foreach ($image_size as $size) {
                            rename($old_path . '/' . $size . '-' . $file_original_name, $new_path . '/' . $size . '-' . $filename);
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                    $request['c_info_img_one'] = $filename;
                }
            }
            if (!empty($request['c_info_img_two'])) {
                    $filename = $request['c_info_img_two'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty($image_size)) {
                        foreach ($image_size as $size) {
                            rename($old_path . '/' . $size . '-' . $file_original_name, $new_path . '/' . $size . '-' . $filename);
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                    $request['c_info_img_two'] = $filename;
                }
            }
            if (!empty($request['footer_logo'])) {
                    $filename = $request['footer_logo'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['footer_logo'] = $filename;
                }
            }
            $customer_key = !empty($request['consumer_key']) ? $request['consumer_key'] : '';
            $customer_secret = !empty($request['consumer_secret']) ? $request['consumer_secret'] : '';
            $access_token = !empty($request['access_token']) ? $request['access_token'] : '';
            $access_token_secret = !empty($request['access_token_secret']) ? $request['access_token_secret'] : '';
            $existing_data = SiteManagement::getMetaValue('footer_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'footer_settings')->delete();
                Helper::changeEnv(
                    [
                        'TWITTER_CONSUMER_KEY' => "",
                        'TWITTER_CONSUMER_SECRET' => "",
                        'TWITTER_ACCESS_TOKEN' => "",
                        'TWITTER_ACCESS_TOKEN_SECRET' => "",
                    ]
                );
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'footer_settings', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            
            Helper::changeEnv(
                [
                    'TWITTER_CONSUMER_KEY' => $customer_key,
                    'TWITTER_CONSUMER_SECRET' => $customer_secret,
                    'TWITTER_ACCESS_TOKEN' => $access_token,
                    'TWITTER_ACCESS_TOKEN_SECRET' => $access_token_secret,
                ]
            );
            \Artisan::call('config:cache');
            \Artisan::call('config:clear');
            \Artisan::call('cache:clear');
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Store article section settings in storage
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveDataProtection($request)
    {
        //dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_data_protection_img'])) {
                    $filename = $request['hidden_data_protection_img'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_data_protection_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('data_protection');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'data_protection')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'data_protection', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

 public static function saveHealthCommunityBanner($request)
    {
       // dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_health_community_img'])) {
                    $filename = $request['hidden_health_community_img'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_health_community_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('health_community_banner');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'health_community_banner')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'health_community_banner', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }
     public static function saveDoctorInnerSection($request)
    {
       // dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_doctor_inner_img'])) {
                    $filename = $request['hidden_doctor_inner_img'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_doctor_inner_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('list_doctor_inner_section');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'list_doctor_inner_section')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'list_doctor_inner_section', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }
    public static function saveHealthDiscussionBanner($request)
    {
       // dd($request->all());
        if (!empty($request)) {
          
            $existing_data = SiteManagement::getMetaValue('health_discussion_banner');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'health_discussion_banner')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'health_discussion_banner', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }
    public static function saveSignUp($request)
    {
        //dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_sign_up_img'])) {
                    $filename = $request['hidden_sign_up_img'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_sign_up_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('sign_up_section');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'sign_up_section')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'sign_up_section', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    public static function saveBannerVideo($request)
    {
        //dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_banner_section_img'])) {
                    $filename = $request['hidden_banner_section_img'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_banner_section_img'] = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('banner_video_section');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'banner_video_section')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'banner_video_section', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }
      public static function saveSmallDevice($request)
    {
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_small_device_img'])) {
                    $filename = $request['hidden_small_device_img'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_small_device_img']  = $filename;
                }
            }
            if (!empty($request['hidden_small_device_img1'])) {
                    $filename = $request['hidden_small_device_img1'];
                    $parts = explode('.', $filename);
                    $file_original_name1 = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name1)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name1;
                    rename($old_path . '/' . $file_original_name1, $new_path . '/' . $filename);
                    $request['hidden_small_device_img1']  = $filename;
                }
            }
            $existing_data = SiteManagement::getMetaValue('small_devices_top_section');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'small_devices_top_section')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'small_devices_top_section', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    public static function saveMapImage($request)
    {
        //dd($request->all());
        if (!empty($request)) {
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/home';
            if (!empty($request['hidden_map_img'])) {
                     $filename = $request['hidden_map_img'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $request['hidden_map_img'] = $filename;
                }
            }
            else {
            return 'error';
        }
            $existing_data = SiteManagement::getMetaValue('map_image');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'map_image')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'map_image', 'meta_value' => json_encode($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }
    /**
     * Store doctor slider section settings in storage
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveDoctorsSliderSectionSettings($request)
    {
        if (!empty($request)) {
            $existing_data = SiteManagement::getMetaValue('doctors_slider');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'doctors_slider')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'doctors_slider', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Save dashboard icons in storage
     *
     * @param string $request request
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveIcons($request)
    {
        $icon_array = array();
        if (!empty($request['icons'])) {
            $icons = $request['icons'];
            $old_path = Helper::PublicPath() . '/uploads/settings/temp';
            $new_path = Helper::PublicPath() . '/uploads/settings/icon';
            foreach ($icons as $key => $icon) {
                if (!empty($icon[$key])) {
                    if (file_exists($old_path . '/' . $icon[$key])) {
                        if (!file_exists($new_path)) {
                            File::makeDirectory($new_path, 0755, true, true);
                        }
                        $filename = $icon[$key];
                        rename($old_path . '/' . $icon[$key], $new_path . '/' . time() . '-' . $filename);
                        $icon_array[$key] = time() . '-' . $filename;
                    } else {
                        $icon_array[$key] = $icon[$key];
                    }
                }
            }
            $existing_data = SiteManagement::getMetaValue('icons');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'icons')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'icons', 'meta_value' => serialize($icon_array),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Save chat settings
     *
     * @param string $request $req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveChatSettings($request)
    {
        if (!empty($request)) {
            $existing_data = SiteManagement::getMetaValue('chat_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'chat_settings')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'chat_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Save email settings
     *
     * @param string $request Email data
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveEmailSettings($request)
    {
        $email_data_array = array();
        $email_data = $request['email_data'];
        $old_path = Helper::PublicPath() . '/uploads/settings/temp';
        $new_path = Helper::PublicPath() . '/uploads/settings/email-settings';
        if (!empty($request)) {
            $email_data_array['from_email'] = $email_data['from_email'];
            $email_data_array['from_email_id'] = $email_data['from_email_id'];
            $email_data_array['sender_name'] = $email_data['sender_name'];
            $email_data_array['sender_tagline'] = $email_data['sender_tagline'];
            $email_data_array['sender_url'] = $email_data['sender_url'];
            if (!empty($request['email_logo'])) {
                    $filename = $request['email_logo'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $email_data_array['email_logo'] = $filename;
                } else {
                    $email_data_array['email_logo'] = $file_original_name;
                }
            }
            if (!empty($request['email_banner'])) {
                    $filename = $request['email_banner'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $email_data_array['email_banner'] = $filename;
                } else {
                    $email_data_array['email_banner'] = $file_original_name;
                }
            }
            if (!empty($request['sender_avatar'])) {
                    $filename = $request['sender_avatar'];
                    $parts = explode('.', $filename);
                    $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    $email_data_array['sender_avatar'] = $filename;
                } else {
                    $email_data_array['sender_avatar'] = $file_original_name;
                }
            }
            $existing_data = SiteManagement::getMetaValue('email_data');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'email_data')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'email_data', 'meta_value' => json_encode($email_data_array),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }
    /**
     * Save payment settings
     *
     * @param mixed $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function savePaymentSettings($request)
    {
        if (!empty($request)) {
            $currency = !empty($request) && !empty($request['currency']) ? $request['currency'] : '';
            $existing_data = SiteManagement::getMetaValue('payment_settings');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'payment_settings')->delete();
                Helper::changeEnv(
                    [
                        'PAYMENT_SYMBOL' => '',
                    ]
                );
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'payment_settings', 'meta_value' => serialize($request->except('_token')),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            Helper::changeEnv(
                [
                    'PAYMENT_SYMBOL' => $currency,
                ]
            );
            \Artisan::call('config:cache');
            \Artisan::call('config:clear');
            \Artisan::call('cache:clear');
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Get Meta Values form meta keys.
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public function savePaypalSettings($request)
    {
        if (!empty($request)) {
            $enable_sandbox = $request['enable_sandbox'];
            $client_id = $request['client_id'];
            $paypal_password = $request['paypal_password'];
            $paypal_secret = $request['paypal_secret'];
            $paypal_settings = array();
            $paypal_settings['client_id'] = !empty($client_id) ? $client_id : '';
            $paypal_settings['paypal_password'] = !empty($paypal_password) ? $paypal_password : '';
            $paypal_settings['paypal_secret'] = !empty($paypal_secret) ? $paypal_secret : '';
            $paypal_settings['enable_sandbox'] = !empty($enable_sandbox) ? $enable_sandbox : '';
            if (!empty($paypal_settings)) {
                $existing_paypal_settings = SiteManagement::getMetaValue('paypal_settings');
                if (!empty($existing_paypal_settings)) {
                    DB::table('site_managements')->where('meta_key', '=', 'paypal_settings')->delete();
                    Helper::changeEnv(
                        [
                            'PAYPAL_LIVE_API_USERNAME' => "",
                            'PAYPAL_LIVE_API_PASSWORD' => "",
                            'PAYPAL_LIVE_API_SECRET' => "",
                            'PAYPAL_SANDBOX_API_USERNAME' => "",
                            'PAYPAL_SANDBOX_API_PASSWORD' => "",
                            'PAYPAL_SANDBOX_API_SECRET' => "",
                        ]
                    );
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'paypal_settings', 'meta_value' => serialize($paypal_settings),
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
                $new_paypal_settings = SiteManagement::getMetaValue('paypal_settings');
                if ($new_paypal_settings['enable_sandbox'] === 'true') {
                    Helper::changeEnv(
                        [
                            'PAYPAL_LIVE_API_USERNAME' => "",
                            'PAYPAL_LIVE_API_PASSWORD' => "",
                            'PAYPAL_LIVE_API_SECRET' => "",
                            'PAYPAL_SANDBOX_API_USERNAME' => $client_id,
                            'PAYPAL_SANDBOX_API_PASSWORD' => $paypal_password,
                            'PAYPAL_SANDBOX_API_SECRET' => $paypal_secret,
                            'PAYPAL_MODE' => 'sandbox',
                        ]
                    );
                } else {
                    Helper::changeEnv(
                        [
                            'PAYPAL_LIVE_API_USERNAME' => $client_id,
                            'PAYPAL_LIVE_API_PASSWORD' => $paypal_password,
                            'PAYPAL_LIVE_API_SECRET' => $paypal_secret,
                            'PAYPAL_SANDBOX_API_USERNAME' => "",
                            'PAYPAL_SANDBOX_API_PASSWORD' => "",
                            'PAYPAL_SANDBOX_API_SECRET' => "",
                            'PAYPAL_MODE' => 'live',
                        ]
                    );
                }
                \Artisan::call('config:cache');
                \Artisan::call('config:clear');
                \Artisan::call('cache:clear');
                return 'success';
            }
        } else {
            return 'error';
        }
    }

    /**
     * Store stripe settings in storage.
     *
     * @param string $request meta_key
     *
     * @return \Illuminate\Http\Response
     */
    public function saveStripeSettings($request)
    {
        if (!empty($request)) {
            $stripe_key = $request['stripe_key'];
            $stripe_secret = $request['stripe_secret'];
            $payment_settings = array();
            $payment_settings['stripe_key'] = !empty($stripe_key) ? $stripe_key : '';
            $payment_settings['stripe_secret'] = !empty($stripe_secret) ? $stripe_secret : '';

            if (!empty($payment_settings)) {
                $existing_payment_settings = SiteManagement::getMetaValue('stripe_settings');
                if (!empty($existing_payment_settings)) {
                    DB::table('site_managements')->where('meta_key', '=', 'stripe_settings')->delete();
                    Helper::changeEnv(
                        [
                            'STRIPE_KEY' => "",
                            'STRIPE_SECRET' => "",
                        ]
                    );
                }
                DB::table('site_managements')->insert(
                    [
                        'meta_key' => 'stripe_settings', 'meta_value' => serialize($payment_settings),
                        "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                    ]
                );
                Helper::changeEnv(
                    [
                        'STRIPE_KEY' => $stripe_key,
                        'STRIPE_SECRET' => $stripe_secret,
                    ]
                );
                return 'success';
            }
        } else {
            return 'error';
        }
    }

    /**
     * Save inner page settings
     *
     * @param string $request request
     *
     * @return \Illuminate\Http\Response
     */
    public static function saveInnerPageSettings($request)
    {
        $inner_page_data_array = array();
        if (!empty($request)) {
            $inner_page = $request['inner_page'];
            $inner_page_data_array['search_list_meta_title'] = $inner_page['search_list_meta_title'];
            $inner_page_data_array['search_list_meta_desc'] = $inner_page['search_list_meta_desc'];
            $inner_page_data_array['show_search_form'] = $inner_page['show_search_form'];
            $inner_page_data_array['enable_breadcrumbs'] = $inner_page['enable_breadcrumbs'];
            $existing_data = SiteManagement::getMetaValue('inner_page_data');
            if (!empty($existing_data)) {
                DB::table('site_managements')->where('meta_key', '=', 'inner_page_data')->delete();
            }
            DB::table('site_managements')->insert(
                [
                    'meta_key' => 'inner_page_data', 'meta_value' => serialize($inner_page_data_array),
                    "created_at" => Carbon::now(), "updated_at" => Carbon::now()
                ]
            );
            return 'success';
        } else {
            return 'error';
        }
    }
}
