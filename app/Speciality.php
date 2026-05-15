<?php

/**
 * Class Speciality.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;
use Illuminate\Support\Str;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
/**
 * Class Speciality
 *
 */
class Speciality extends Model
{
    use Cachable;
    
    public function faqsAssign () {
        return $this->hasMany('App\FaqAssign', 'assign_value', 'id')->with('faqs')->where('type', 'speciality')->with('faqs');
    }


    /**
     * Get the services associated with the speciality.
     *
     * @return relation
     */
    public function services()
    {
        return $this->hasMany('App\Service')->with('diseases')->with('symptoms');
    }
    public function related_services()
    {
        return $this->hasMany('App\Service');
    }

     public function diseases()
    {
        return $this->hasMany('App\Disease');
    }

    /**
     * Get the services & disease associated with the speciality.
     *
     * @return relation
     */

    public function services_symptom()
    {
        return $this->hasMany('App\Service')->with('symptoms');
    }

    public function services_diseases()
    {
        return $this->hasMany('App\Service')->with('diseases');
    }
    public function symptomes()
    {
        return $this->belongsToMany('App\Symptom', 'symptome_speciality',
           'speciality_id','symptom_id');
    }

    /**
     * Get the services associated with the speciality.
     *
     * @return relation
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_speciality', 'speciality_id', 'user_id')->with('roles');
    }

    /**
     * Get the users associated with the speciality.
     *
     * @return relation
     */
    public function usersWithRelations()
    {
        return $this->belongsToMany('App\User', 'user_speciality', 'speciality_id', 'user_id')->with('diseases','specialities','location','area','services','profile','feedbacks','doc_teams','teams','appointments','onlines','roles');
    }

    public function similarUsersWithRelations()
    {
        return $this->belongsToMany('App\User', 'user_speciality', 'speciality_id', 'user_id')
        ->with('specialities',function($q){
            return $q->take(3);
        })->with('profile',function($qu){
            return $qu->select('user_id','avatar','banner','address','longitude','latitude','votes','fees_range','available_days','working_time','created_at','updated_at','total_experience','description','experiences','memberships','educations','awards','gender','sub_heading','wait_time','short_desc');
        })->with('location','area','feedbacks','doc_teams');

    }

    /**
     * Get the speciality associated with the locations.
     *
     * @return relation
     */
    public function locations()
    {
        return $this->belongsToMany('App\Location', 'location_speciality',
            'speciality_id', 'location_id');
    }

    public function tests()
    {
        return $this->hasMany('App\Speciality_Test','speciality_id','id');
    }


     public function medicines()
    {
        return $this->hasMany('App\Medicine','speciality_id','id');
    }

     public function diagnoses()
    {
        return $this->hasMany('App\Diagnose','speciality_id','id');
    }

     public function forum()
    {
        return $this->hasMany('App\Forum','speciality_id','id');
    }

    /**
     * Fillables for the database
     *
     * @access protected
     *
     * @var array $fillable
     */
    protected $fillable = array('title', 'slug','user_type', 'body', 'meta_key','meta_title', 'meta_description');

    /**
     * Set slug attribute
     *
     * @param int $value page ID
     *
     * @return array
     */
    public function setSlugAttribute($value)
    {
        $temp = Str::slug($value, '-');
        if (!Speciality::all()->where('slug', $temp)->isEmpty()) {
            $i = 1;
            $new_slug = $temp . '-' . $i;
            while (!Speciality::all()->where('slug', $new_slug)->isEmpty()) {
                $i++;
                $new_slug = $temp . '-' . $i;
            }
            $temp = $new_slug;
        }
        $this->attributes['slug'] = $temp;
    }

    /**
     * Get Parent Pages
     *
     * @param mixed $request $req->attribute
     *
     * @return array
     */
    public function saveSpeciality($request)
    {

        if (!empty($request)) {
            $this->title =  filter_var($request->title, FILTER_SANITIZE_STRING);
             $this->slug =  filter_var($request->slug, FILTER_SANITIZE_STRING);
            $this->urdu_title = filter_var($request->urdu_title);
            $this->user_type = filter_var($request->user_type, FILTER_SANITIZE_STRING);
            $this->slug = filter_var($request->title, FILTER_SANITIZE_STRING);
            $this->type = filter_var($request->type, FILTER_SANITIZE_STRING);
            $this->urdu_description = $request->urdu_description;
            $this->description = $request->desc;
            $old_path = Helper::PublicPath() . '/uploads/specialities/temp';
            $new_path = Helper::PublicPath() . '/uploads/specialities/';
            if (!empty($request['speciality_image'])) {
                $filename = $request['speciality_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('speciality'))) {
                        foreach (Helper::getImageSizes('speciality') as $key => $size) {
                            if (file_exists($old_path . '/' . $key . '-' . $file_original_name)) {
                                rename($old_path . '/' . $key . '-' . $file_original_name, $new_path . '/' . $key . '-' . $filename);
                            }
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $this->image = $filename;
            } else {
                $this->image = null;
            }
            $this->save();
            return 'success';
        }
    }

    /**
     * Update speciality
     *
     * @param mixed $request $req->attribute
     * @param int   $id      id
     *
     * @return array
     */
    public function updateSpeciality($request, $id)
    {
        if (!empty($id) && !empty($request)) {
            $speciality = self::find($id);
            // if ($speciality->title != $request['title']) {
            //     $speciality->slug  =  filter_var($request['title'], FILTER_SANITIZE_STRING);
            // }
            $speciality->title = filter_var($request->title, FILTER_SANITIZE_STRING);
            if ($speciality->slug!= $request['slug']) {
                $speciality->slug = filter_var($request['slug'], FILTER_SANITIZE_STRING);
            }
            $speciality->urdu_title = filter_var($request->urdu_title);
            $speciality->user_type = filter_var($request->user_type, FILTER_SANITIZE_STRING);
            $speciality->type = filter_var($request->type, FILTER_SANITIZE_STRING);
            $speciality->urdu_description = $request->urdu_description;
            $speciality->description = $request->desc;
            $speciality->meta_key = $request->meta_key;
            $speciality->known_as = $request->known_as;
            $speciality->meta_title = $request->meta_title;
            $speciality->meta_description = $request->meta_description;
            $old_path = Helper::PublicPath() . '/uploads/specialities/temp';
            $new_path = Helper::PublicPath() . '/uploads/specialities/';
            if (!empty($request['speciality_image'])) {
                $filename = $request['speciality_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('speciality'))) {
                        foreach (Helper::getImageSizes('speciality') as $key => $size) {
                            if (file_exists($old_path . '/' . $key . '-' . $file_original_name)) {
                                rename($old_path . '/' . $key . '-' . $file_original_name, $new_path . '/' . $key . '-' . $filename);
                            }
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $speciality->image = $filename;
            } else {
                $speciality->image = null;
            }
            if (!empty($request['speciality_app_image'])) {
                $filename = $request['speciality_app_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                }
                $speciality->app_image = $filename;
            }
            else
            {
                $speciality->app_image=null;
            }
            // dd($speciality);
            $speciality->update();
        }
    }

    /**
     * For updating skills
     *
     * @param int $user_id get user ID
     *
     * @return \Illuminate\Http\Response
     */
    public static function getDoctorSpeciality($user_id)
    {
        if (!empty($user_id)) {
            return DB::table('skill_user')->select('skill_id')
                ->where('user_id', $user_id)
                ->get()->pluck('skill_id')->toArray();
        } else {
            return '';
        }
    }
}
