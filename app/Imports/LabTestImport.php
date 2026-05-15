<?php

namespace App\Imports;
use Illuminate\Support\Str;
use App\Speciality_Test;
use Maatwebsite\Excel\Concerns\ToModel;

class LabTestImport implements ToModel
{
    protected $id =19761;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {  
      
        if($this->id>0)
        {
          $originalPrice = (int)$row[2];
          $discountPercentage = 25; // 25% discount

          $discountedPrice = $originalPrice - ($originalPrice * $discountPercentage / 100);
          $slug = Str::slug($row[1]);
           $specialityTest = new Speciality_Test([
            "id" => $this->id,
            "title" => $row[1],
            "price" => $originalPrice,
            "discounted_price" => $discountedPrice,
            "turn_around_time" => $row[4],
            "slug"=>$slug,
            "sample_requirement" => $row[3],
            "lab_id" => 36723,
        ]);

        $this->id++; // Increment id for the next record

        return $specialityTest;
      }
      // $this->id++;

    }
}
