<?php
/**
 * Class Forum.
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
use App\User;
use Auth;
use Illuminate\Support\Str;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
/**
 * Class Forum
 *
 */
class Forum extends Model
{
    use Cachable;
    public $table = 'forums';
     protected $fillable = [
'slug','speciality_id','question_title','question_description','views','liked'];
    /**
     * The users that belong to the service.
     *
     * @return relation
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_forum')->with('profile')->withPivot('type', 'answer');
    }

    /**
     * The users that belong to the service.
     *
     * @return relation
     */
    public function questioner()
    {
        return $this->belongsToMany('App\User', 'user_forum')->with('profile')->withPivot('type', 'answer')->wherePivot('type', 'question');
    }

    /**
     * Get service seller
     *
     * @return relation
     */
    public function answers()
    {
        return $this->belongsToMany('App\User', 'user_forum')->with('profile')->withPivot('id', 'type', 'answer', 'user_id')->wherePivot('type', 'answer', 'user_id');
    }


    public function comments()
    {
        return $this->belongsToMany('App\User', 'user_forum')->with('profile')->withPivot('id', 'type', 'answer', 'user_id')->wherePivot('type', 'comment', 'user_id');
    }

    public function speciality()
    {
        return $this->belongsTo('App\Speciality','speciality_id','id');
    }
    /**
     * Set slug before saving in DB
     *
     * @param string $value value
     *
     * @access public
     *
     * @return string
     */
    public function setSlugAttribute($value)
    {
        if (!empty($value)) {
            $temp = Str::slug($value, '-');
            if (!Forum::all()->where('slug', $temp)->isEmpty()) {
                $i = 1;
                $new_slug = $temp . '-' . $i;
                while (!Forum::all()->where('slug', $new_slug)->isEmpty()) {
                    $i++;
                    $new_slug = $temp . '-' . $i;
                }
                $temp = $new_slug;
            }
            $this->attributes['slug'] = $temp;
        }
    }

    /**
     * Post Question.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function postQuestion($request)
    {
        if (!empty($request)) {
            $this->question_title = $request['question_title'];
            $this->slug = filter_var($request['question_title'], FILTER_SANITIZE_STRING);
            $this->question_description = filter_var($request['question_description'], FILTER_SANITIZE_STRING);
            $this->speciality_id = $request['speciality_id'];
            $this->save();
            $this->users()->attach(Auth::user()->id, ['type' => 'question', 'answer' => null]);
            return 'success';
        } else {
            return 'error';
        }
    }

    /**
     * Post Answer.
     *
     * @param string $request req->attr
     *
     * @return \Illuminate\Http\Response
     */
    public function postAnswer($request)
    {
        if (!empty($request)) {
            $forum = Forum::findOrFail($request['forum_id']);
            $forum->users()->attach(Auth::user()->id, ['type' => 'answer', 'answer' => filter_var($request->forum_answer, FILTER_SANITIZE_STRING)]);
            return 'success';
        } else {
            return 'error';
        }
    }


}
