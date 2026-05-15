<?php

/**
 * Class Location.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
/**
 * Class Location
 *
 */
class Location extends Model
{
    use Cachable;
    /**
     * Fillable for the database
     *
     * @access protected
     * @var    array $fillable
     */
    protected $fillable = [
        'title', 'slug', 'parent', 'flag', 'description'
    ];

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
     * Get the users for the location.
     *
     * @return relation
     */
    public function users()
    {
        return $this->hasMany('App\User')->with('roles');
    }
    public function hospitals()
    {
        return $this->hasMany('App\User','location_id','id');
    }
     public function vaccinations()
    {
            return $this->hasMany('App\VaccinationLocation','city','id');
    }

    public function areas()
    {
        return $this->hasMany('App\Area','location_id', 'id');
    }
    /**
     * Get the users for the location.
     *
     * @return relation
     */
    public function specialities()
    {
//            return $this->belongsToMany('App\Speciality');
        return $this->belongsToMany('App\Speciality', 'location_speciality',
            'location_id', 'speciality_id');
    }
     public function procedures()
    {
       return $this->belongsToMany('App\Procedure', 'cities_procedure', 'city_id', 'procedure_id');
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
            if (!Location::all()->where('slug', $temp)->isEmpty()) {
                $i = 1;
                $new_slug = $temp . '-' . $i;
                while (!Location::all()->where('slug', $new_slug)->isEmpty()) {
                    $i++;
                    $new_slug = $temp . '-' . $i;
                }
                $temp = $new_slug;
            }
            $this->attributes['slug'] = $temp;
        }
    }

    /**
     * For saving locations in Database
     *
     * @param mixed $request get file
     *
     * @return \Illuminate\Http\Response
     */
    public function storeLocation($request)
    {
        if (!empty($request)) {
            $this->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $this->latitude = filter_var($request['latitude'], FILTER_SANITIZE_STRING);
            $this->longitude = filter_var($request['longitude'], FILTER_SANITIZE_STRING);
            $this->slug = Str::slug(filter_var($request['title'], FILTER_SANITIZE_STRING));
            $this->description = filter_var($request['loc_desc'], FILTER_SANITIZE_STRING);
            $this->parent = filter_var($request['parent_location'], FILTER_VALIDATE_INT);
            $old_path = Helper::PublicPath() . '/uploads/locations/temp';
            if (!empty($request['hidden_location_image'])) {
                $filename = $request['hidden_location_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    $new_path = Helper::PublicPath() . '/uploads/locations/';
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('location'))) {
                        foreach (Helper::getImageSizes('location') as $key => $size) {
                            rename($old_path . '/' . $key . '-' . $file_original_name, $new_path . '/' . $key . '-' . $filename);
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $this->flag = filter_var($filename, FILTER_SANITIZE_STRING);
            } else {
                $this->flag = null;
            }
            $this->save();
        }
    }


    /**
     * Update location in database
     *
     * @param mixed   $request get req attributes
     * @param integer $id      get location ID
     *
     * @return \Illuminate\Http\Response
     */
    public function updateLocation($request, $id)
    {
        if (!empty($request) && !empty($id)) {
            $location = self::find($id);
            $parent_cat = filter_var($request['parent_location'], FILTER_VALIDATE_INT);
            $location->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            // $location->slug  =  Str::slug(filter_var($request['title'], FILTER_SANITIZE_STRING));
            $location->description = filter_var($request['loc_desc'], FILTER_SANITIZE_STRING);
            $location->parent = $parent_cat;
            $old_path = Helper::PublicPath() . '/uploads/locations/temp';
            if (!empty($request['hidden_location_image'])) {
                $filename = $request['hidden_location_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    $new_path = Helper::PublicPath() . '/uploads/locations/';
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('location'))) {
                        foreach (Helper::getImageSizes('location') as $key => $size) {
                            rename($old_path . '/' . $key . '-' . $file_original_name, $new_path . '/' . $key . '-' . $filename);
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $location->flag = filter_var($filename, FILTER_SANITIZE_STRING);
            } else {
                $location->flag = null;
            }
            $location->save();
        }
    }
}
