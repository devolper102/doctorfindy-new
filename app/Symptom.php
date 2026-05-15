<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
class Symptom extends Model
{
    use Cachable;
    //

    public function faqsAssign () {
        return $this->hasMany('App\FaqAssign', 'assign_value', 'id')->where('type', 'symptom');
    }

    public function tests()
    {
        return $this->belongsToMany('App\Speciality_Test', 'symptom_test', 'symptom_id', 'test_id');
    }


    public function services()
    {
        return $this->belongsToMany('App\Service', 'symptom_service',
            'symptom_id','service_id');
    }
    public function diseases()
    {
        return $this->belongsToMany('App\Disease', 'symptome_disease',
            'disease_id','symptom_id');
    }
    public function Specialities()
    {
        return $this->belongsToMany('App\Speciality', 'symptome_speciality',
           'speciality_id','symptom_id');
    }
    public function saveSymptom($request)
    {
        if (!empty($request)) {
            $this->title =  filter_var($request->title, FILTER_SANITIZE_STRING);
            $this->slug = str_slug(filter_var($request->title, FILTER_SANITIZE_STRING));
            $this->type = filter_var($request->type, FILTER_SANITIZE_STRING);
            $this ->test_symptom = $request->test_symptom;
            $this->description = $request->desc;
            $old_path = Helper::PublicPath() . '/uploads/symptoms/temp';
            $new_path = Helper::PublicPath() . '/uploads/symptoms/';
            if (!empty($request['symptom_image'])) {
                $filename = $request['symptom_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('symptom'))) {
                        foreach (Helper::getImageSizes('symptom') as $key => $size) {
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

    public function updateSymptom($request, $id)
    {
        if (!empty($id) && !empty($request)) {
            $symptom = self::find($id);
            if ($symptom->title != $request['title']) {
                $symptom->slug  =  str_slug(filter_var($request['title'], FILTER_SANITIZE_STRING));
            }
            $symptom->title = filter_var($request->title, FILTER_SANITIZE_STRING);
            $symptom->type = filter_var($request->type, FILTER_SANITIZE_STRING);
            $symptom->test_symptom  = $request->test_symptom;
            $symptom->description = $request->desc;
            $old_path = Helper::PublicPath() . '/uploads/symptoms/temp';
            $new_path = Helper::PublicPath() . '/uploads/symptoms/';
            if (!empty($request['symptom_image'])) {
                $filename = $request['symptom_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('symptom'))) {
                        foreach (Helper::getImageSizes('symptom') as $key => $size) {
                            if (file_exists($old_path . '/' . $key . '-' . $file_original_name)) {
                                rename($old_path . '/' . $key . '-' . $file_original_name, $new_path . '/' . $key . '-' . $filename);
                            }
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $symptom->image = $filename;
            } else {
                $symptom->image = null;
            }
            $symptom->save();
        }
    }
}
