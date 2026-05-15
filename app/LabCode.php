<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabCode extends Model
{
    use HasFactory;
    protected $fillable = ['expiry_date',"Sr_No", "ID_no"
          , "CouponNumber"
         , "ReferenceID"
          , "CouponStatus"
          ,"CreatedBy"
          , "ModifiedBy"
          ,"Status"
          ,"CaseID"];
}
