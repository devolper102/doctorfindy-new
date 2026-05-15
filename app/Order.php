<?php

/**
 * Class Order.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 */
class Order extends Model
{
    /**
     * Get the user that owns the order.
     * 
     * @return relation
     */
       protected $fillable = [
        'user_id', 'hospital_id', 'patient_id', 'payment_gateway', 'appointment_time',
        'charges', 'appointment_date', 'status', 'first_name',
        'last_name', 'patient_name', 'relation_you',
        'commants'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Order can have multiple order meta
     *
     * @return relation
     */
    public function orderMeta()
    {
        return $this->morphMany('App\OrderMeta', 'metable');
    }

    /**
     * Get the payout record associated with the order.
     * 
     * @return relation
     */
    public function payout()
    {
        return $this->hasOne('App\Payout');
    }
      public function patient_profile()
    {
        return $this->hasOne('App\User', 'id','patient_id')->with('profile');
    }
      public function hospital_profile()
    {
        return $this->hasOne('App\User', 'id','hospital_id')->with('profile');
    }
       public function doctor_profile()
    {
        return $this->hasOne('App\User', 'id','user_id')->with('profile');
    }
     public function appointment()
    {
        return $this->hasOne('App\Appointment', 'id','appointment_id');
    }

    /**
     * Posts can have multiple meta
     * 
     * @param string $meta_key meta_key
     *
     * @return relation
     */
    public function metaValue($meta_key)
    {
        if (!empty($meta_key)) {
            return $this->morphMany('App\OrderMeta', 'metable')->where('meta_key', $meta_key)
                ->select('id', 'meta_value')->pluck('meta_value')->first();
        }
    }
}
