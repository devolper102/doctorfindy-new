<?php

/**
 * Class Service
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
/**
 * Class Service
 *
 */
class Service extends Model
{
    use Cachable;
    /**
     * Speciality can have multiple service
     *
     * @return relation
     */
    public function speciality()
    {
        return $this->belongsTo('App\Speciality')->with('locations');
    }

    public function faqsAssign () {
        return $this->hasMany('App\FaqAssign', 'assign_value', 'id')->where('type', 'service')->with('faqs');
    }

    public function symptoms()
    {
        return $this->belongsToMany('App\Symptom', 'symptom_service', 'service_id','symptom_id');
    }

    /**
     * Services can have multiple diseases
     *
     * @return relation
     */
    public function diseases()
    {
        return $this->belongsToMany('App\Disease', 'service_disease',
            'service_id','disease_id');
    }

    /**
     * The users that belong to the user.
     * 
     * @return relation
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_service')->withPivot('type', 'speciality')->with('roles');
    }

    /**
     * Fillable for the database
     *
     * @access protected
     * @var    array $fillable
     */
    protected $fillable = array(
        'title', 'slug', 'speciality_id', 'description','image'
    );

    /**
     * Protected Date
     *
     * @access protected
     * @var    array $dates
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

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
        if (!Service::all()->where('slug', $temp)->isEmpty()) {
            $i = 1;
            $new_slug = $temp . '-' . $i;
            while (!Service::all()->where('slug', $new_slug)->isEmpty()) {
                $i++;
                $new_slug = $temp . '-' . $i;
            }
            $temp = $new_slug;
        }
        $this->attributes['slug'] = $temp;
    }

    /**
     * For saving services in Database
     *
     * @param mixed $request get file
     *
     * @return \Illuminate\Http\Response
     */
    public function storeService($request)
    {
        //dd($request->all());
        if (!empty($request)) {
            $this->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $this->slug = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $this->type = filter_var($request['type'], FILTER_SANITIZE_STRING);
            $this->description = filter_var($request['description'], FILTER_SANITIZE_STRING);
           $old_path = Helper::PublicPath() . '/uploads/services/temp';
            $new_path = Helper::PublicPath() . '/uploads/services/';
            if (!empty($request['service_image'])) {
                $filename = $request['service_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('service'))) {
                        foreach (Helper::getImageSizes('service') as $key => $size) {
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
            $speciality = Speciality::find($request['speciality']);
            $this->speciality()->associate($speciality);
            $this->save();
        }
    }


    /**
     * Update service in database
     *
     * @param mixed   $request get req attributes
     * @param integer $id      get service ID
     *
     * @return \Illuminate\Http\Response
     */
    public function updateService($request, $id)
    {
        if (!empty($request) && !empty($id)) {
            $service = self::find($id);
            $service->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $service->type = filter_var($request['type'], FILTER_SANITIZE_STRING);
            if ($service->title != $request['title']) {
                $service->slug  =  filter_var($request['title'], FILTER_SANITIZE_STRING);
            }
            $service->description = filter_var($request['description'], FILTER_SANITIZE_STRING);
            $old_path = Helper::PublicPath() . '/uploads/services/temp';
            $new_path = Helper::PublicPath() . '/uploads/services/';
            if (!empty($request['service_image'])) {
                $filename = $request['service_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('service'))) {
                        foreach (Helper::getImageSizes('service') as $key => $size) {
                            if (file_exists($old_path . '/' . $key . '-' . $file_original_name)) {
                                rename($old_path . '/' . $key . '-' . $file_original_name, $new_path . '/' . $key . '-' . $filename);
                            }
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $service->image = $filename;
            } else {
                $service->image = null;
            }
            $speciality = Speciality::find($request['speciality']);
            $service->speciality()->associate($speciality);
            $service->save();
        }
    }
}
