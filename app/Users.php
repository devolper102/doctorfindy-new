<?php

namespace App;
use App\Helper;
use App\Location;
use App\Disease;
use App\UserMeta;
Use App\User;
use Spatie\Permission\Traits\HasRoles;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Users extends User
{
    //
    use HasRoles;
    use Cachable;
    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {

        return 'hospital';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
    	
        $array = $this->toArray();
        // Customize array...
        $array = $this->transform($array);
        
        if(Helper::getRoleTypeByUserID($array['id']) == 'hospital'){
        
        $array['role'] = Helper::getRoleTypeByUserID($array['id']);

        // Get avg_rating against every user relational
        $array['feedback'] = $this->feedbacks->map(function ($data) {
        return $data['avg_rating'];
            })->toArray();

        // Get profile image against every user relational
        if( $this->profile->avatar ){

        $array['profile'] = 'uploads/users/'.$array['id'].'/'.$this->profile->avatar;

        } else {

            $array['profile'] = 'images/hospital1.png';
        }
        // Get address against every user relational

        $array['address'] =  $this->profile->address;

        // Get diseases against every user relational
        $array['diseases']['name'] = $this->diseases->map(function ($data) {
        return $data['title'];
            })->toArray();


        return $array;
        }
    }

     /**
     * Get the profile record associated with the user.
     *
     * @return relation
     */
    public function profile()
    {
        return $this->hasOne('App\UserMeta','user_id')->withDefault();
    }

     /**
     * Get the profile record associated with the user.
     *
     * @return relation
     */
    public function feedbacks()
    {
        return $this->hasMany('App\Feedback','user_id');
    }

    /**
     * The users that belong to the diseases.
     *
     * @return relation
     */
    public function diseases()
    {
        return $this->belongsToMany('App\Disease', 'user_disease','user_id')->withPivot('user_id');
    }
    /**
     * The users that belong to the OrderMeta.
     *
     * @return relation
     */
    public function orderMeta()
    {
        return $this->belongsToMany('App\OrderMeta', 'order_metas','metable_id')->withDefault();
    }
}
