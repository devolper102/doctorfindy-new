<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Speciality_Test extends Model
{
    use Cachable;
    public $table = 'lab_tests';


    protected $guarded = [];


    public function specialities()
    {
        return $this->belongsTo('App\Speciality','speciality_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','lab_id','id')->with('profile','feedback','location');
    }


    public function symptoms()
    {
        return $this->belongsToMany('App\Symptom', 'symptom_test', 'test_id', 'symptom_id');
    }



    public function saveTest($request)
    {
        $this ->title = $request->title;
        $this ->price = $request->price;
        $this ->speciality_id = $request->speciality_id;
        $this ->type = $request->type;
        $this ->details = $request->details;
        $this ->description = $request->description;
        $this ->save();
            return 'success';
    }
    public function updateTest($request, $id)
    {
      if (!empty($id) && !empty($request)) {
      	
       $test = self::find($id);
       $test->title  = $request->get('title');
        $test->price  = $request->get('price');
        $test->speciality_id  = $request->get('speciality_id');
        $test->type  = $request->get('type');
        $test ->details = $request->details;
        $test ->description = $request->description;
        $test ->save();
         return 'success';
    }
}

}
