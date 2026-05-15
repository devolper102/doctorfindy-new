<?php

namespace App\Imports;
use Illuminate\Support\Str;
use App\LabCode;
use Maatwebsite\Excel\Concerns\ToModel;

class LabCodeImport implements ToModel
{
    protected $id =18825;
    protected $newRecordsAdded = false;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
//     public function model(array $row)
// {
//     if ($this->id > 0) {
       
//         $existingCode = LabCode::where('CouponNumber', $row[0])->first();
        
//         if (!$existingCode) {
            
//             $newLabCode = new LabCode(["CouponNumber" => $row[0], "Status" => $row[1]]);
//             $newLabCode->save();
//             return $newLabCode;
//         }
//     }
    
//     $this->id++;
// }
    public function model(array $row)
  {
    $couponNumber = $row[0];
    $status = $row[1];
    $existingCode = LabCode::where('CouponNumber', $couponNumber)->first();

    if ($existingCode) {
        if ($existingCode->Status == 1) {
            $existingCode->update(["Status" => 0]);
            return $existingCode;
        } else {
            return null;
        }
    } else {
        $newLabCode = new LabCode(["CouponNumber" => $couponNumber, "Status" => $status]);
        $newLabCode->save();
        return $newLabCode;
    }

}
}
