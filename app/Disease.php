<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Disease extends Model
{
   use Cachable;
    protected $table = 'diseases';
   protected $fillable = ['title','slug','speciality_id','parent','description','introduction_detail'];
    public function faqsAssign () {
        return $this->hasMany('App\FaqAssign', 'assign_value', 'id')->where('type', 'diseases')->with('faqs');
    }
    public function speciality()
    {
        return $this->belongsTo('App\Speciality');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
     public function services()
    {
        return $this->belongsToMany('App\Service', 'service_disease',
           'disease_id','service_id')->with('symptoms');
    }
    public function symptomes()
    {
        return $this->belongsToMany('App\Symptom', 'symptome_disease',
           'disease_id','symptom_id');
    }
    public function treatment()
    {
        return $this->belongsToMany('App\Treatment', 'disease_treatment', 'disease_id', 'treatment_id');
    }


    public function toSearchableArray()
    {

        $array = $this->toArray();

        // Customize array...
        $array = $this->transform($array);

        return $array;
    }
    /**
     * Get the Disease associated with the User.
     *
     * @return relation
     */
    public function user_meta()
    {
        return $this->belongsToMany('App\UserMeta', 'user_disease',
            'disease_id', 'user_id');
    }

    public function diseases()
    {
        return $this->belongsToMany('App\Disease', 'user_disease')->withPivot('user_id');
    }

    public function users()
    {
        // return $this->belongsToMany('App\User', 'user_disease')->withPivot('disease_id')->with('specialities');
        return $this->belongsToMany('App\User', 'user_disease', 'disease_id', 'user_id')->with('roles')->with('diseases','specialities','location','area','services','profile','feedbacks','doc_teams','teams','appointments','onlines','roles','speciality');
    }
    public function usersDiseaseRelations()
    {
        return $this->belongsToMany('App\User', 'user_disease', 'disease_id', 'user_id')->with('diseases','specialities','location','area','services','profile','feedbacks','doc_teams','teams','appointments','onlines','roles','speciality');
    }

    public function storeDisease($request)
    {
       // dd($request->all());
        if (!empty($request)) {
            $this->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $this->urdu_title = filter_var($request->urdu_title);
            $slug = filter_var($request['title'], FILTER_SANITIZE_STRING);
            $this->slug = str::slug($slug,'-');
            $this->urdu_decription = $request->urdu_decription;
            $this->speciality_id = $request->speciality_id;
            $this->description = filter_var($request['description'], FILTER_SANITIZE_STRING);
//            $this->parent = filter_var($request['parent'], FILTER_VALIDATE_INT);
            $old_path = Helper::PublicPath() . '/uploads/disease/temp';
            if (!empty($request['disease_image'])) {
                $filename = $request['disease_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    $new_path = Helper::PublicPath() . '/uploads/disease/';
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('disease'))) {
                        foreach (Helper::getImageSizes('disease') as $key => $size) {
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
     * Update disease in database
     *
     * @param mixed   $request get req attributes
     * @param integer $id      get location ID
     *
     * @return \Illuminate\Http\Response
     */
    public function updateDisease($request, $id)
    {
       // dd($request->all());
        if (!empty($request) && !empty($id)) {
            $disease = self::find($id);
            // if ($disease->title != $request['title']) {
            //     $slug  =  filter_var($request['title'], FILTER_SANITIZE_STRING);
            //     $disease->slug = Str::slug($slug,'-');
            // }
            
            $parent_cat = filter_var($request['parent'], FILTER_VALIDATE_INT);
            $disease->title = filter_var($request['title'], FILTER_SANITIZE_STRING);
            if ($disease->slug!= $request['slug']) {
                $disease->slug = str_replace(' ', '-', $request['slug']);
            }
            
            $disease->urdu_title = filter_var($request->urdu_title);
            $disease->urdu_decription = $request->urdu_decription;
            $disease->description = ($request['description']);
            $disease->introduction_detail = $request->introduction_detail;
            $disease->speciality_id = $request['speciality_id'];
            $disease->parent = $parent_cat;
            $disease->meta_key=$request->meta_key;
            $disease->meta_title=$request->meta_title;
            $disease->meta_description=$request->meta_description;
            $old_path = Helper::PublicPath() . '/uploads/disease/temp';
            if (!empty($request['disease_image'])) {
                $filename = $request['disease_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    $new_path = Helper::PublicPath() . '/uploads/disease/';
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('disease'))) {
                        foreach (Helper::getImageSizes('disease') as $key => $size) {
                            rename($old_path . '/' . $key . '-' . $file_original_name, $new_path . '/' . $key . '-' . $filename);
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $disease->flag = filter_var($filename, FILTER_SANITIZE_STRING);
            } else {
                $disease->flag = null;
            }
            $disease->update();
        }
    }
}
