<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;


class Procedure extends Model
{
    use Cachable;
    public $table = 'procedures';
    protected $fillable = ['title','slug','fee','image','description','details'];

    public function faqsAssign () {
        return $this->hasMany('App\FaqAssign', 'assign_value', 'id')->with('faqs')->where('type', 'procedure')->with('faqs');
    }

    public function saveProcedure($request)
    {
        $this ->title = $request->title;
        $this->slug = Str::slug($request->title);
        $this ->fee = $request->fee;
        $this ->description = $request->description;
        $old_path = Helper::PublicPath() . '/uploads/procedure/temp';
        $new_path = Helper::PublicPath() . '/uploads/procedure/';
        if (!empty($request['procedure_image'])) {
            $filename = $request['procedure_image'];
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
        }
        else {
            $this->image = null;
        }
        $this ->details = json_encode($request->except('_token','title','fee','color','description','procedure_image','doctor','submit'));
        $this ->save();
        return 'success';
    }
    public function updateProcedure($request, $procedure) {
        if (!empty($procedure) && !empty($request)) {
            $procedure = self::find($procedure);
            $procedure->title  = $request->get('title');
            if ($procedure->slug!= $request['slug']) {
                $procedure->slug = str_replace(' ', '-', $request['slug']);
            }
           
            // $procedure->slug  =  Str::slug($request->get('title'));
            $procedure->fee  = $request->get('fee');
            $procedure->range = $request->get('range');
            $procedure->intro_procedure=$request->get('intro_procedure');
            $procedure->description  = $request->get('description');
            $procedure->faq_procedure=$request->get('faq_procedure');
            $procedure->meta_key = $request->get('meta_key');
            $procedure->meta_title = $request->get('meta_title');
            $procedure->meta_description = $request->get('meta_description');
            $old_path = Helper::PublicPath() . '/uploads/procedure/temp';
            $new_path = Helper::PublicPath() . '/uploads/procedure/';
            if (!empty($request['procedure_image'])) {
                $filename = $request['procedure_image'];
                $parts = explode('.', $filename);
                $file_original_name = $parts[0].'.webp';
                if (file_exists($old_path . '/' . $file_original_name)) {
                    if (!file_exists($new_path)) {
                        File::makeDirectory($new_path, 0755, true, true);
                    }
                    $filename = time() . '-' . $file_original_name;
                    if (!empty(Helper::getImageSizes('procedure'))) {
                        foreach (Helper::getImageSizes('procedure') as $key => $size) {
                            if (file_exists($old_path . '/' . $key . '-' . $file_original_name)) {
                                rename($old_path . '/' . $key . '-' . $file_original_name, $new_path . '/' . $key . '-' . $filename);
                            }
                        }
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    } else {
                        rename($old_path . '/' . $file_original_name, $new_path . '/' . $filename);
                    }
                }
                $procedure->image = $filename;
            } else {
                $procedure->image = null;
            }
            $procedure ->details = json_encode($request->except('_token','title','fee','color','description','procedure_image','doctor','submit','_method'));
            $procedure->save();
            return 'success';
        }
    }
    public function procedure_cost()
    {
        
        return $this->hasMany(ProcedureEstimatedCost::class,'procedure_id','id');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'user_procedure', 'prodedure_id', 'user_id')->with('teams')->with('area')->with('location')->with('feedbacks')->with('specialities')->with('roles')->with('profile');
    }
    public function cities() {
        return $this->belongsToMany('App\Location', 'cities_procedure', 'procedure_id', 'city_id');
    }
    public function feedbacks() {
        return $this->hasMany('App\Feedback', 'user_id', 'id')->where('type', 'procedure')->where('approval', '1')->with('user');
    }

    public function general_feedbacks() {
        return $this->hasMany('App\Feedback')->where('type', 'procedure')->where('type', 'procedure')->where('user_id', 'general')->where('approval', '1')->with('user')->with('patient');
    }

    public function faqs() {
        return $this->hasMany('App\FaqAssign', 'assign_value', 'id')->with('faqs')->where('type', 'procedure');
    }
}
