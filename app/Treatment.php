<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

use Laravel\Scout\Searchable;
use Algolia\ScoutExtended\Facades\Algolia;
use Illuminate\Support\Str;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Treatment extends Model
{
     use Cachable;
     public $table = 'treatments';
     protected $fillable = [
'title','slug','description'];

    public function faqsAssign () {
        return $this->hasMany('App\FaqAssign', 'assign_value')->where('type', 'treatment');
    }

 public function saveTreatment($request)
    {
        
        $this ->title = $request->title;
        $this->slug = Str::slug($request->title);
        $this ->description = $request->description;
        $this ->save();
            return 'success';
        }
    
    public function diseases()
    {
        return $this->belongsToMany('App\Disease', 'disease_treatment', 'treatment_id', 'disease_id');
    }
    public function updateTreatment($request, $treatment)
    {
      if (!empty($treatment) && !empty($request)) {
      	
       $treatment = self::find($treatment);
       $treatment->title  = $request->get('title');
       $treatment->slug  =  Str::slug($request->get('title'));
        $treatment->description  = $request->get('description');
        $treatment ->save();
         return 'success';

        
    }
}
}
