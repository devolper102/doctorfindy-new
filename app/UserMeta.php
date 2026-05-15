<?php

/**
 * Class UserMeta.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use App\User;
use File;
use Illuminate\Database\Eloquent\Model;
use Hash;
use Illuminate\Support\Str;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Storage;
/**
 * Class UserMeta
 *
 */
class UserMeta extends Model
{

    use Cachable;
    /**
     * Get the UserMeta associated with the Disease.
     *
     * @return relation
     */
    public function diseases()
    {
        return $this->belongsToMany('App\Disease', 'user_disease',
            'user_id', 'disease_id');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'experiences', 'specializations', 'memberships',
        'educations', 'awards', 'services', 'avatar', 'banner', 'gender',
        'gender_title', 'sub_heading', 'tagline', 'description',
        'delete_reason', 'delete_description', 'payout_id', 'profile_searchable', 'profile_blocked', 'weekly_alerts',
        'message_alerts', 'verify_medical', 'consultation_fee', 'saved_hospitals', 'saved_doctors',
        'saved_articles', 'downloads', 'verify_registration', 'liked_answer', 'starting_price','language','address','longitude','latitude','wait_time','total_experience','available_days','meta_intro','meta_description','meta_title','meta_keywords','online_test_report_title','online_test_report_desc','short_desc'
    ];

    /**
     * Get the user that has the profile.
     *
     * @return relation
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    
    /**
     * Store Profile in database
     *
     * @param mixed   $request Request Attributes
     * @param integer $user_id User ID
     *
     * @return json response
     */
    public function storeProfile($request, $user_id)
    {
       // dd($request->all());
        if (!empty($request) && !empty($user_id)) {
            $user = User::where('id',$user_id)->with('profile')->with('specialities')->with('orderMeta')->with('location')->first();
            
            if ($user->location == '') {
                $user_info = $user->slug;
                $user_data_info = Str::lower($user_info);
            }
            else{
                $user_info = $user->slug. '-' . $user->location->title;
                $user_data_info = Str::lower($user_info);
            }
            if ($user->first_name . '-' . $user->last_name != $request['first_name'] . '-' . $request['last_name']) {
                $user->slug = filter_var($request['first_name'], FILTER_SANITIZE_STRING) . '-' .
                    filter_var($request['last_name'], FILTER_SANITIZE_STRING);
            }
            $user->first_name = filter_var($request['first_name'], FILTER_SANITIZE_STRING);
            $user->last_name = filter_var($request['last_name'], FILTER_SANITIZE_STRING);
            if (!empty($request['email'])) {
                $user->email = filter_var($request['email'], FILTER_SANITIZE_STRING);
            }        
            if (!empty($request['phone_number'])) {
                $user->phone_number = filter_var($request['phone_number'], FILTER_SANITIZE_STRING);
            }
            if (!empty($request['assistant_phone_number'])) {
                $user->assistant_phone_number = filter_var($request['assistant_phone_number'], FILTER_SANITIZE_STRING);
            }
            if (!empty($request['location'])) {
                $location = Location::find($request['location']);
                $user->location()->associate($location);
            }
            if (!empty($request['area'])) {
                $area = Area::find($request['area']);
                $user->area()->associate($area);
            }
            if (!empty($request['password'])) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = UserMeta::find($user_profile->id);
            } else {
                $user_meta = $this;
            }

            $user_meta->user()->associate($user_id);
            $user_meta->gender_title = !empty($request['base_name']) ? $request['base_name'] : null;
            $user_meta->gender = !empty($request['gender']) ? $request['gender'] : null;
             if (!empty($request['working_time'])) {
                $user_meta->working_time = $request['working_time'];
            }
//            percentage and price range insertion
            $user_meta->commission = !empty($request['commission']) ? $request['commission'] : null;
            $user_meta->total_experience = !empty($request['total_experience']) ? $request['total_experience'] : null;
            $user_meta->wait_time = !empty($request['wait_time']) ? $request['wait_time'] : null;
            //  $request['fees_range'] = json_encode(
            //     ['from_fees' => $request->from_fees,
            //         'to_fees' =>$request->to_fees]
            // );

            if (!empty($request['days'])) {
                $user_meta->available_days = json_encode($request['days']);
            }
        if (!empty($request['language'])) {
                $user_meta->language = json_encode($request['language']);
            }
            // dd($request->all()); 
            if (!empty($request['from_fees']) && !empty($request['to_fees'])){   
            $fees_range['from_fees'] = !empty($request['from_fees']) ? $request['from_fees'] : null;
            $fees_range['to_fees'] = !empty($request['to_fees']) ? $request['to_fees'] : null;
            $user_meta->fees_range = $fees_range;
            }
            // dd($user_meta->fees_range);
            $user_meta->leave = !empty($request['on_leave']) ? json_encode($request['on_leave']) : null;
            $user_meta->sub_heading = !empty($request['subheading']) ? filter_var($request['subheading'], FILTER_SANITIZE_STRING) : null;
            // Update short_desc if it's present in the request (even if empty)
            if (array_key_exists('short_desc', $request->all())) {
                $user_meta->short_desc = !empty($request['short_desc']) ? filter_var($request['short_desc'], FILTER_SANITIZE_STRING) : null;
            }
            $user_meta->meta_description = !empty($request['meta_description']) ? filter_var($request['meta_description'], FILTER_SANITIZE_STRING) : null;
            $user_meta->meta_title = !empty($request['meta_title']) ? filter_var($request['meta_title'], FILTER_SANITIZE_STRING) : null;
            $user_meta->meta_intro = !empty($request['meta_intro']) ? filter_var($request['meta_intro'], FILTER_SANITIZE_STRING) : null;

            $user_meta->online_test_report_title = !empty($request['online_test_report_title']) ? filter_var($request['online_test_report_title'], FILTER_SANITIZE_STRING) : null;
            $user_meta->online_test_report_desc = !empty($request['online_test_report_desc']) ? filter_var($request['online_test_report_desc'], FILTER_SANITIZE_STRING) : null;
            $user_meta->meta_keywords = !empty($request['meta_keywords']) ? filter_var($request['meta_keywords'], FILTER_SANITIZE_STRING) : null;
            $user_meta->description = !empty($request['description']) ? $request['description'] : null;
            $user_meta->address = !empty($request['address']) ? filter_var($request['address'], FILTER_SANITIZE_STRING) : null;
            $user_meta->longitude = !empty($request['longitude']) ? filter_var($request['longitude'], FILTER_SANITIZE_STRING) : null;
            $user_meta->latitude = !empty($request['latitude']) ? filter_var($request['latitude'], FILTER_SANITIZE_STRING) : null;
            $user_meta->add_longitude = !empty($request['address_long']) ? filter_var($request['address_long'], FILTER_SANITIZE_STRING) : null;
            $user_meta->add_latitude = !empty($request['address_lat']) ? filter_var($request['address_lat'], FILTER_SANITIZE_STRING) : null;
           $filename = '';
            if ($request->has('willing_video')) {
                $user_meta->willing_video = $request['willing_video'];
            } else {
                $user_meta->willing_video = 'off';
            } 

            if ($request->has('willing_home_visit')) {
                $user_meta->willing_home_visit = $request['willing_home_visit'];
            } else {
                $user_meta->willing_home_visit = 'off';
            } 

             if ($request->has('mark_red')) {
                $user_meta->mark_red = $request['mark_red'];
            } else {
                $user_meta->mark_red = 'off';
            } 

            if ($request->has('mark_incomplete')) {
                $user_meta->mark_incomplete = $request['mark_incomplete'];
            } else {
                $user_meta->mark_incomplete = 'off';
            } 
            if (!empty($request['days'])) {
                $user_meta->available_days = ($request['days']);
            }
            if (!empty($request['starting_price'])) {
                $user_meta->starting_price = $request['starting_price'];
            }
            $old_path = (env('FILESYSTEM_DRIVER') === 'production') ? '/uploads/users/temp' : Helper::PublicPath() . '/uploads/users/temp';
            $new_path = (env('FILESYSTEM_DRIVER') === 'production') ? '/uploads/users/' . $user_id : Helper::PublicPath() . '/uploads/users/' . $user_id;
            if (!empty($request['avatar_img'])) {
                $filename = $request['avatar_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                $profile_img_sizes = Helper::getImageSizes('profile_img');
                $filename = $file_original_name;
                
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $disk = (env('FILESYSTEM_DRIVER') === 'production') ? 's3' : 'local_public';
                if($disk == 's3')
                {
                if (Storage::disk($disk)->exists($old_path . '/' . $file_original_name)) {
                    // dd(1);
                    
                    $filename = $user_data_info . '.' . $ext;
                        if (!Storage::disk($disk)->exists($new_path)) {
                        Storage::disk($disk)->makeDirectory($new_path);
                    }
                        if (!empty($profile_img_sizes)) {
                        // dd(96);
                        foreach ($profile_img_sizes as $key => $size) {
                            $oldFilePath = $old_path . '/' . $key . '-' . $file_original_name;
                            $newFilePath = $new_path . '/' . $key . '-' . $filename;
                            // dd($oldFilePath, $newFilePath, $filename);
                            if (Storage::disk('s3')->exists($newFilePath)) {
                                Storage::disk('s3')->delete($newFilePath);
                            }
                            Storage::disk('s3')->move($oldFilePath, $newFilePath);
                        }
                        $oldOriginalFilePath = $old_path . '/' . $file_original_name;
                        $newOriginalFilePath = $new_path . '/' . $filename;
                        if (Storage::disk('s3')->exists($newOriginalFilePath)) {
                                Storage::disk('s3')->delete($newOriginalFilePath);
                            }
                        Storage::disk('s3')->move($oldOriginalFilePath, $newOriginalFilePath);
                    } else {
                        // dd(22);
                       $oldOriginalFilePath = $old_path . '/' . $file_original_name;
                        $newOriginalFilePath = $new_path . '/' . $filename;
                        if (Storage::disk('s3')->exists($newOriginalFilePath)) {
                                Storage::disk('s3')->delete($newOriginalFilePath);
                            }
                        // Move the file on DO Spaces
                        Storage::disk('s3')->move($oldOriginalFilePath, $newOriginalFilePath);
                    }
                    
                    
                }
                $user_meta->avatar = $filename;
            }
            else{
                if (file_exists($old_path . '/' . $file_original_name)) {
                    // dd(2);

                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = $user_data_info . '.' . $ext;
                    //dd($filename,$user->slug);
                    if (!empty($profile_img_sizes)) {
                        foreach ($profile_img_sizes as $key => $size) {
                            rename($old_path . '/' . $key . '-' . $file_original_name, $new_path . '/' . $key . '-' . $filename);
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $user_meta->avatar = $filename;
            }
            } else {
                $user_meta->avatar = null;
            }
            if (!empty($request['avatar_banner_img'])) {
                $filename = $request['avatar_banner_img'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                $banner_img_sizes = Helper::getImageSizes('profile_banner');
                $filename = $request['avatar_banner_img'];
                $disk = (env('FILESYSTEM_DRIVER') === 'production') ? 's3' : 'local_public';
                if($disk == 's3')
                {
                if (Storage::disk($disk)->exists($old_path . '/' . $file_original_name)) {
                    // dd(1);
                    
                    $filename = time() . '-' . $file_original_name;
                        if (!Storage::disk($disk)->exists($new_path)) {
                        Storage::disk($disk)->makeDirectory($new_path);
                    }
                        if (!empty($banner_img_sizes)) {
                        // dd(96);
                        foreach ($banner_img_sizes as $key => $size) {
                            $oldFilePath = $old_path . '/' . $key . '-' . $file_original_name;
                            $newFilePath = $new_path . '/' . $key . '-' . $filename;
                            // dd($oldFilePath, $newFilePath, $filename);
                            if (Storage::disk('s3')->exists($newFilePath)) {
                                Storage::disk('s3')->delete($newFilePath);
                            }
                            Storage::disk('s3')->move($oldFilePath, $newFilePath);
                        }
                        $oldOriginalFilePath = $old_path . '/' . $file_original_name;
                        $newOriginalFilePath = $new_path . '/' . $filename;
                        if (Storage::disk('s3')->exists($newOriginalFilePath)) {
                                Storage::disk('s3')->delete($newOriginalFilePath);
                            }
                        Storage::disk('s3')->move($oldOriginalFilePath, $newOriginalFilePath);
                    } else {
                        // dd(22);
                       $oldOriginalFilePath = $old_path . '/' . $file_original_name;
                        $newOriginalFilePath = $new_path . '/' . $filename;
                        if (Storage::disk('s3')->exists($newOriginalFilePath)) {
                                Storage::disk('s3')->delete($newOriginalFilePath);
                            }
                        // Move the file on DO Spaces
                        Storage::disk('s3')->move($oldOriginalFilePath, $newOriginalFilePath);
                    }
                    
                    
                }
                $user_meta->banner = $filename;
            }
            else{
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty($banner_img_sizes)) {
                        foreach ($banner_img_sizes as $key => $size) {
                            rename($old_path . '/' . $key . '-' . $file_original_name, $new_path . '/' . $key . '-' . $filename);
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $user_meta->banner = filter_var($filename, FILTER_SANITIZE_STRING);
            }
            } else {
                $user_meta->banner = null;
            }
            $memberships = !empty($request['membership']) ? $request['membership'] : array();
            if (!empty($memberships)) {
                foreach ($memberships as $key => $membership) {
                    $memberships[$key]['title'] = $membership['title'];
                }
                $user_meta->memberships = json_encode($memberships);
            } else {
                $user_meta->memberships = null;
            }
            $user_meta->save();
            return 'success';
        }
    }
    /**
     * Store fAQS in database
     *
     * @param mixed   $request Request Attributes
     * @param integer $user_id User ID
     *
     * @return json response
     */
     public function storefAQS($request, $user_id)
    { 
        if (!empty($request) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = UserMeta::find($user_profile->id);
            } else {
                $user_meta = $this;
            }
            $user_meta->faqs = json_encode($request->faq);
        if($user_meta->save()){
            
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
     * Store Bank data in database
     *
     * @param mixed   $request Request Attributes
     * @param integer $user_id User ID
     *
     * @return json response
     */
     public function storeBank($request, $user_id)
    { 
        if (!empty($request) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = UserMeta::find($user_profile->id);
            } else {
                $user_meta = $this;
            }
             $data = array(
                "cc_number" => $request['cc-number'],
                "x_bank" => $request['x_bank'],
                "x_iban" => $request['x_iban'],
                "x_title" => $request['x_title'],
            );
            $user_meta->bank_data = json_encode($data);;
        if($user_meta->save()){
            
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
     * Store Registration in database
     *
     * @param mixed   $request Request Attributes
     * @param integer $user_id User ID
     *
     * @return json response
     */
    public function storeRegistration($request, $user_id)
    {
        if (!empty($request) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = UserMeta::find($user_profile->id);
            } else {
                $user_meta = $this;
            }
            $user_meta->user()->associate($user_id);
            $old_path = Helper::PublicPath() . '/uploads/users/temp';
            $new_path = Helper::PublicPath() . '/uploads/users/' . $user_id;
            if (!empty($request['registration_document'])) {
                $filename = $request['registration_document'];
                if (file_exists($old_path . '/' . $request['registration_document'])) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $request['registration_document'];
                    rename($old_path . '/' . $request['registration_document'], $new_path . '/' . $filename);
                }
            }
            $data = array(
                "registration_number" => $request['registration_number'],
                "registration_document" => $filename,
            );
            $user_meta->verify_medical = json_encode($data);
            $user_meta->save();
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Store awards and downloads
     *
     * @param mixed   $request Request Attributes
     * @param integer $user_id User ID
     *
     * @return json response
     */
    public function storeGallery($request, $user_id)
    {
        if (!empty($request) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = UserMeta::find($user_profile->id);
            } else {
                $user_meta = $this;
            }
            $user_meta->user()->associate($user_id);
            if (!empty($request['images'])) {
                $old_path = Helper::PublicPath() . '/uploads/users/temp';
                $new_path = Helper::PublicPath() . '/uploads/users/'.$user_id.'/gallery/images';
                $gallery_img_sizes = Helper::getImageSizes('profile_gallery');
                foreach ($request['images'] as $key => $user_gallery) {
                    $imagename = $user_gallery;
                    $parts = explode('.', $imagename);
                    $file_original_name = $parts[0].'.webp';
                    $filename = $file_original_name;
                    if (file_exists($old_path . '/' . $file_original_name)) {
                        if (!file_exists($new_path)) {
                            File::makeDirectory($new_path, 0755, true, true);
                        }
                        $filename = time() . '-' . $file_original_name;
                        if (!empty($gallery_img_sizes)) {
                            foreach ($gallery_img_sizes as $gallery_key => $size) {
                                rename($old_path . '/' . $gallery_key . '-' . $file_original_name, $new_path . '/' . $gallery_key . '-' . $filename);
                            }
                            rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                        } else {
                            rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                        }
                    }
                    $gallery_images[$key] = $filename;
                }
                $user_meta->gallery = json_encode($gallery_images);
            } else {
                $user_meta->gallery = null;
            }
            $videos = !empty($request['video']) ? $request['video'] : array();
            if (!empty($videos)) {
                foreach ($videos as $key => $video) {
                    $videos[$key]['url'] = $video['url'];
                }
                $user_meta->gallery_videos = json_encode($videos);
            } else {
                $user_meta->gallery_videos = null;
            }
            $user_meta->save();
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Store awards and downloads
     *
     * @param mixed   $request Request Attributes
     * @param integer $user_id User ID
     *
     * @return json response
     */
    public function storeAwardsDownloads($request, $user_id)
    {
        if (!empty($request) && !empty($user_id)) {
            $awards = $request['awards'];
            $downloads = $request['attachments'];
            if(!empty($awards)){
            foreach ($awards as $key => $award) {
                $awards[$key]['title'] = $award['title'];
                $awards[$key]['year'] = date('Y', strtotime($award['year']));
            }
            }
            $old_path = Helper::PublicPath() . '/uploads/users/temp';
            $new_path = Helper::PublicPath() . '/uploads/users/'. $user_id;
            if (!empty($downloads)) {
                foreach ($downloads as $key => $download) {
                    $filename = $download;
                    if (file_exists($old_path . '/' . $download)) {
                        if (!file_exists($new_path)) {
                            File::makeDirectory($new_path, 0755, true, true);
                        }
                        $filename = time() . '-' . $download;
                        rename($old_path . '/' . $download, $new_path . '/' . $filename);
                    }
                    $downloads[$key] = $filename;
                }
            } 
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = UserMeta::find($user_profile->id);
            } else {
                $user_meta = $this;
            }
            $user_meta->user()->associate($user_id);
            $user_meta->awards = json_encode($awards);
            if (!empty($request['attachments'])) {
                $user_meta->downloads = json_encode($downloads);
            } else {
                $user_meta->downloads = null;
            }
            $user_meta->save();
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Store Account Settings
     *
     * @param mixed   $request Request Attributes
     * @param integer $user_id User ID
     *
     * @return save data
     */
    public function storeAccountSettings($request, $user_id)
    {
        if (!empty($request) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = $this::find($user_profile->id);
            } else {
                $user_meta = $this;
                $user_meta->user()->associate($user_id);
            }
            $user_meta->profile_searchable = $request['profile_searchable'];
            $user_meta->disable_account = $request['disable_account'];
            $user_meta->save();
        } else {
            return '';
        }
    }

    /**
     * Save Experiences.
     *
     * @param string $request req->attr
     * @param string $user_id user ID
     *
     * @return \Illuminate\Http\Response
     */
    public function saveExperiences($request, $user_id)
    {
        $json = array();
        $count = 0;
        $total_exp = 0;
        $request_experience = array();
        if (!empty($request) && !empty($user_id)) {
            if ($request['experience']) {

                foreach ($request['experience'] as $key => $experience) {
                    if (
                        empty($experience['job_title'])  || empty($experience['start_date'])
                        || empty($experience['end_date']) || empty($experience['company_title'])
                    ) {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.empty_fields_not_allowed');
                        return $json;
                    }

                    if ($experience['company_title'] == 'Company Title') {
                        $json['type'] = 'error';
                        $json['message'] = trans('lang.empty_fields_not_allowed');
                        return $json;
                    }
                    $request_experience[$count] = $experience;
                    $count++;
                    $date1=date_create($experience['start_date']);
                    $date2=date_create($experience['end_date']);
                    $diff = $date1->diff($date2);
                    $total_exp += $diff->y;
                }

            }
            $experience = !empty($request['experience']) ? json_encode($request_experience) : '';
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
                
            if (!empty($user_profile->id)) {
                $user_meta = $this::find($user_profile->id);
            } else {
                $user_meta = $this;
            }
            $user_meta->user()->associate($user_id);
            $user_meta->experiences = $experience;
            $user_meta->total_experience = $total_exp;
            $user_meta->save();
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }

    /**
     * Save Experiences.
     *
     * @param string $request req->attr
     * @param string $user_id user ID
     *
     * @return \Illuminate\Http\Response
     */
    public function saveServices($request, $user_id)
    {
        $json = array();
        if (!empty($request) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)->get()->first();
            $role_type = Helper::getRoleTypeByUserID($user_id);
            if (!empty($user_profile->id)) {
                $user_meta = $this::find($user_profile->id);
            } else {
                $user_meta = $this;
                $user_meta->user()->associate($user_id);
            }
            if (!empty($request['services'])) {
                $user = User::findorFail($user_id);
                $user->services()->detach();
                $speciality_services = array();
                $services = $request['services'];
                foreach ($services as $key => $service) {
                    if (empty($service['speciality'])) {
                        $json['type'] = 'speciality_required';
                        return $json;
                    }
                    $speciality_services[$key]['speciality_id'] = $service['speciality'];
                    if (!empty($service['service'])) {
                        foreach ($service['service'] as $service_key => $speciality_service) {
                            if (empty($speciality_service['service'])) {
                                $json['type'] = 'service_required';
                                return $json;
                            }
                            $speciality_services[$key]['services'][$service_key]['service'] = $speciality_service['service'];
                            $speciality_services[$key]['services'][$service_key]['price'] = $speciality_service['price'];
                            $speciality_services[$key]['services'][$service_key]['description'] = $speciality_service['description'];
                            $user->services()->attach($speciality_service['service'], ['type' => $role_type, 'speciality' => $service['speciality']]);

                        }
                    }
                    if (!empty($service['speciality'])){
                        if ($key === 0) {
                            $user->specialities()->detach();
                        }
                        $user->specialities()->attach($service['speciality']);
                    }
                }
                $user_meta->services = json_encode($speciality_services);
                $user_meta->save();
                $json['type'] = 'success';
                return $json;
            }
            else {
                $user_meta->services = null;
                $user = User::findorFail($user_id);
                $user->specialities()->detach();
                $user_meta->save();
                $json['type'] = 'success';
                return $json;
            }
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

    /**
     * Save Experiences.
     *
     * @param string $request req->attr
     * @param string $user_id user ID
     *
     * @return \Illuminate\Http\Response
     */
    public function saveHospitalServices($request, $user_id){
        $json = array();
        if (!empty($request) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)->get()->first();
            $role_type = Helper::getRoleTypeByUserID($user_id);
            if ($role_type == 'hospital'){
                if (!empty($user_profile->id)) {
                    $user_meta = $this::find($user_profile->id);
                    $user_meta->hospital_services = json_encode($request);
                    $user_meta->save();
                    $json['type'] = 'success';
                    return $json;
                }
                else {
                    $json['error'] = 'Hospital not found';
                    return $json;
                }
            }
            else{
                $json['error'] = 'Hospital not found';
                return $json;
            }
        }
    }

    /**
     * Save Experiences.
     *
     * @param string $request req->attr
     * @param string $user_id user ID
     *
     * @return \Illuminate\Http\Response
     */
    public function saveEducations($request, $user_id)
    {
        $json = array();
        $count = 0;
        $request_education = array();
        if (!empty($request) && !empty($user_id)) {
            if (!empty($request['education'])) {
                foreach ($request['education'] as $key => $education) {
                    
                    $request_education[$count] = $education;
                    $count++;
                }
            }
            $education = !empty($request['education']) ? json_encode($request_education) : '';
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = $this::find($user_profile->id);
            } else {
                $user_meta = $this;
            }
            $user_meta->user()->associate($user_id);
            $user_meta->educations = $education;
            $user_meta->save();
            $json['type'] = 'success';
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = trans('lang.something_went_wrong');
            return $json;
        }
    }

    /**
     * Add to whish list
     *
     * @param mixed   $column  Request Attributes
     * @param integer $id      ID
     * @param integer $user_id UserID
     *
     * @return json response
     */
    public function addWishlist($column, $id, $user_id)
    {
        $wishlist = array();
        if (!empty($column) && !empty($id) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)->get()->first();
            if (!empty($user_profile->id)) {
                $profile = $this::find($user_profile->id);
            } else {
                $profile = $this;
                $profile->user()->associate($user_id);
            }
            $wishlist = json_decode($profile[$column]);
            $wishlist = !empty($wishlist) && is_array($wishlist) ? $wishlist : array();
            $wishlist[] = $id;
            $wishlist = array_unique($wishlist);
            $profile->$column = json_encode($wishlist);
            $profile->save();
            return "success";
        } else {
            return 'error';
        }
    }

    /**
     * Remove to whish list
     *
     * @param mixed   $column  Request Attributes
     * @param integer $id      ID
     * @param integer $user_id UserID
     *
     * @return json response
     */
    public function removeWishlist($column, $id, $user_id)
    {
        $wishlist = array();
        if (!empty($column) && !empty($id) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)->get()->first();
            if (!empty($user_profile->id)) {
                $profile = $this::find($user_profile->id);
            } else {
                $profile = $this;
                $profile->user()->associate($user_id);
            }
            $wishlist = json_decode($profile[$column]);
            $wishlist = !empty($wishlist) && is_array($wishlist) ? $wishlist : array();
            if (!empty($wishlist)){
                $key = array_search($id, $wishlist);
                if ($key !== false) {
                    unset($wishlist[$key]);
                }
            }
            $wishlist = array_unique($wishlist);
            $profile->$column = json_encode($wishlist);
            $profile->save();
            return "success";
        } else {
            return 'error';
        }
    }


    /**
     * Add liked Answer
     *
     * @param mixed   $column  Request Attributes
     * @param integer $id      ID
     * @param integer $user_id UserID
     *
     * @return json response
     */
    public function likeAnswer($column, $id, $user_id)
    {
        $like_answer = array();
        if (!empty($column) && !empty($id) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)->get()->first();
            if (!empty($user_profile->id)) {
                $profile = $this::find($user_profile->id);
            } else {
                $profile = $this;
                $profile->user()->associate($user_id);
            }
            $like_answer = json_decode($profile[$column], true);
            $like_answer = !empty($like_answer) && is_array($like_answer) ? $like_answer : array();
            $like_answer[] = $id;
            $like_answer = array_unique($like_answer);
            $profile->$column = json_encode($like_answer);
            $profile->save();
            return "success";
        } else {
            return "error";
        }
    }

    /**
     * Save Payout Details.
     *
     * @param string $request req->attr
     * @param string $user_id user ID
     *
     * @return \Illuminate\Http\Response
     */
    public function savePayoutDetail($request, $user_id)
    {
        $payouts = array();
        if (!empty($request) && !empty($user_id)) {
            $user_profile = $this::select('id')->where('user_id', $user_id)
                ->get()->first();
            if (!empty($user_profile->id)) {
                $profile = self::find($user_profile->id);
            } else {
                $profile = $this;
            }
            $profile->user()->associate($user_id);
            if (!empty($request['payout_settings'])) {
                $payout_setting = $request['payout_settings'];
                $payouts['type'] = $payout_setting['type'];
                if ($payout_setting['type'] == 'paypal') {
                    $payouts['paypal_email'] = $payout_setting['paypal_email'];
                } elseif ($payout_setting['type'] == 'bacs') {
                    $payouts['bank_account_name'] = $payout_setting['bank_account_name'];
                    $payouts['bank_account_number'] = $payout_setting['bank_account_number'];
                    $payouts['bank_name'] = $payout_setting['bank_name'];
                    $payouts['bank_routing_number'] = $payout_setting['bank_routing_number'];
                    $payouts['bank_iban'] = $payout_setting['bank_iban'];
                    $payouts['bank_bic_swift'] = $payout_setting['bank_bic_swift'];
                }
            }
            $profile->payout_settings  = json_encode($payouts);
            $profile->save();
            return 'success';
        } else {
            return 'error';
        }
    }
}
