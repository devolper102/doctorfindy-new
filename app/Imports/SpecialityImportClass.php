<?php

namespace App\Imports;

use App\Speciality;
use Maatwebsite\Excel\Concerns\ToModel;

class SpecialityImportClass implements ToModel
{
    protected $id =0;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {  
      
        if($this->id>0)
        {
          

          Speciality::where('title', $row[0])->update(['known_as' => $row[1]]);
      }
      $this->id++;

    }
}
