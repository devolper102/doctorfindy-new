<?php
/**
 * Class Feedback.
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
/**
 * Class Feedback
 *
 */
class Feedback extends Model
{
    use Cachable;
    public $table = "feedbacks";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'waiting_time', 'rating', 'comment', 'keep_anonymous',
    ];

    /**
     * Protected Date
     *
     * @access protected
     * @var    array $dates
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the profile record associated with the user.
     *
     * @return relation
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'patient_id', 'id')->with('roles')->with('profile');
    }

    /**
     * Get the profile record associated with the patient.
     *
     * @return relation
     */
    public function patient()
    {
        return $this->belongsTo('App\User', 'patient_id')->with('profile')->with('roles');
    }


    public function feedbacks() {
        return $this->belongsTo('App\Procedure', 'procedure_id', 'id');
    }

    /**
     * Submit Feedback.
     *
     * @param mixed $request $req->attr
     * 
     * @return response
     */
    public static function submitFeedback($request, $patient_id = '')
    {
        $user_rating = array();
        $avg = 0;
        $avg_rating = 0;
        $count = 0;
        $json = array();
        $feedback = new Feedback;
        $user = User::find($request['user_id']);
        if ($request['vote']) {
            $user_meta = UserMeta::where('user_id', $request['user_id'])->first();
            $votes = $user_meta->votes;
            $votes = (int)$votes + 1;
            UserMeta::where('user_id', $request['user_id'])->update([
                'votes' => $votes
            ]);
        }
        $feedback->user()->associate($user);
        $feedback->waiting_time = !empty($request['waiting_time']) ? $request['waiting_time'] : 0;
        $feedback->keep_anonymous = !empty($request['feedbackpublicly']) ? 'on' : 'off';
        $feedback->comment = filter_var($request['comments'], FILTER_SANITIZE_STRING);
        /*if (!empty($request['rating'])) {
            foreach ($request['rating'] as $key => $value) {
                if ($value['rate'] > 0) {
                    $count++;
                    $user_rating[$key]['rating'] = intval($value['rate']);
                    $user_rating[$key]['reason'] = intval($value['reason']);
                    $avg = $avg + intval($value['rate']);
                }
            }
            if ($avg <= 0 ) {
                $json['type'] = 'rating_error';
                return $json;
            }
            $avg_rating = $avg / $count;
            $feedback->rating = json_encode($user_rating);
        }*/
        $time = $request['waitRating'];
        if ($time == 1) {
            $waitings = "15";
        }
        elseif ($time == 2){
            $waitings = "30";
        }
        elseif ($time == 3){
            $waitings = "45";
        }
        else {
            $waitings = "60";
        }
        $rating = Array();
        $rating['costRating'] = $request['costRating'];
        $rating['waitRating'] = $request['waitRating'];
        $rating['checkupRating'] = $request['checkupRating'];
        $rating['staffBehaviourRating'] = $request['staffBehaviourRating'];
        $rating['environmentRating'] = $request['environmentRating'];
        $avg_rating = ($request['costRating'] + $request['waitRating'] + $request['environmentRating']) / 3;

        $rating = json_encode($rating);
        $feedback->rating = $rating;
        $feedback->type = $request['type'];
        $feedback->avg_rating = $avg_rating;
        $feedback->waiting_time = $waitings;
        $feedback->user_id = $request['user_id'];
        $feedback->patient_id = Auth::user()->id;
        $feedback->save();

        if ($request['type'] !== 'procedure'){
            $user_profile = UserMeta::select('id')->where('user_id', $user->id)->get()->first();
            if (!empty($user_profile->id)) {
                $user_meta = UserMeta::find($user_profile->id);
            } else {
                $user_meta = new UserMeta();
                $user_meta->user()->associate($user->id);
            }

            if (!empty($request['votes']) && $request['votes'] == '1') {
                if (!empty($user_meta->votes)) {
                    $user_meta->votes = $user_meta->votes + 1;
                } else {
                    $user_meta->votes = intval($request['votes']);
                }
            }
            $user_meta->save();
        }


        return 'success';
    }
}
