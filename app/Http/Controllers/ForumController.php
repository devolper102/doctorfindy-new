<?php

/**
 * Class ForumController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */

namespace App\Http\Controllers;

use App\Disease;
use App\Location;
use App\Service;
use App\UserMeta;
use Illuminate\Http\Request;
use App\Speciality;
use App\Forum;
use App\Helper;
use App\User;
use App\SiteManagement;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Array_;

/**
 * Class ForumController
 *
 */
class ForumController extends Controller
{
    /**
     * Defining scope of the variable
     *
     * @access protected
     * @var    array $forum
     */
    protected $forum;

    /**
     * Create a new controller instance.
     *
     * @param instance $forum instance
     *
     * @return void
     */
    public function __construct(Forum $forum)
    {
        $this->forum = $forum;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = Forum::with('users')->with('questioner')->with('answers')->with('speciality')->with('comments')->orderBy('created_at', 'DESC')->get();
        $user_ = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];

        $doctors = User::role('doctor')->orderBy("trending","desc")->with('profile','specialities','location','feedbacks')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area','feedbacks','teams')->limit(4)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->limit(4)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->latest()->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->latest()->limit(4)->get();
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section','health_community_slider','show_healthtabs'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        return View(
            'front-end.forum.index',
            compact(
                'specialities', 'logged_user', 'laboratories', 'cities', 'services', 'diseases',
                'specialities', 'hospitals', 'doctors', 'managements', 'forums','segments'
            )
        );
    }

    /**
     * Post Question.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */

     public function getallspecialitiesHealthForum(){
        /*Specialities*/
          $specialities = Speciality::with('services')->with('services_symptom')->with('services_diseases')->with('locations')->with('faqsAssign')->get();
        return response()->json($specialities);
    }


    public function store(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (Auth::check()) {
            $this->validate(
                $request,
                [
                    'speciality_id' => 'required',
                    'question_description' => 'required',
                ]
            );
            $post_question = $this->forum->postQuestion($request);
            $forums = Forum::where('speciality_id', $request['speciality_id'])->with('users')->with('questioner')->with('speciality')->with('answers')->with('comments')->orderBy('created_at', 'DESC')->get();

            if ($post_question === 'success') {
                return response()->json(
                    [
                        'type' => 'success',
                        'forums' => $forums,
                        'progressing' => trans('lang.saving'),
                        'message' => trans('lang.quest_post_success')
                    ]
                );
            } else {
                return response()->json(
                    [
                        'type' => 'error',
                        'message' => trans('lang.something_went_wrong')
                    ]
                );
            }
        } else {
            return response()->json(
                [
                    'type' => 'error',
                    'message' => trans('lang.need_to_reg')
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug slug
     * 
     * @return view
     */
    public function getForumAnswers($slug)
    {
        $user_ = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];

        $doctors = User::role('doctor')->orderBy("trending","desc")->with('profile','specialities','location','feedbacks')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area','feedbacks','teams')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->latest()->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->latest()->limit(4)->get();
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section','procedure_banner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();
        $specialty = Speciality::where('slug', $slug)->first();
        $all_forums = Forum::with('users')->with('speciality')->with('questioner')->with('answers')->with('comments')->orderBy('views', 'DESC')->get();
        $forums = Forum::where('speciality_id', $specialty->id)->with('users')->with('speciality')->with('questioner')->with('answers')->with('comments')->orderBy('created_at', 'DESC')->get();
        foreach ($forums as $forum) {
            Forum::where('id', $forum->id)->update([
                'views' => $forum->views + 1
            ]);
        }
        $active_user = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        return View(
            'front-end.forum.post-questions',
            compact(
                'logged_user', 'laboratories', 'cities', 'services', 'diseases',
                'specialities', 'hospitals', 'doctors', 'managements', 'forums', 'specialty', 'all_forums','segments','active_user'
            )
        );
    }

    /**
     * Post Answer.
     *
     * @param \Illuminate\Http\Request $request request attributes
     *
     * @return \Illuminate\Http\Response
     */
    public function postAnswer(Request $request)
    {
        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $response['type'] = 'error';
            $response['message'] = $server->getData()->message;
            return $response;
        }
        if (Auth::check()) {
            $this->validate(
                $request,
                [
                    'forum_answer' => 'required',
                ]
            );
            $post_answer = $this->forum->postAnswer($request);
            $spec_id = Forum::where('id', $request['forum_id'])->first();
            $forums = Forum::where('speciality_id', $spec_id->speciality_id)->with('users')->with('questioner')->with('speciality')->with('answers')->with('comments')->orderBy('created_at', 'DESC')->get();

            if ($post_answer === 'success') {
                return response()->json(
                    [
                        'type' => 'success',
                        'forums' => $forums,
                        'progressing' => trans('lang.saving'),
                        'message' => trans('lang.answer_post_success')
                    ]
                );
            } else {
                return response()->json(
                    [
                        'type' => 'error',
                        'message' => trans('lang.something_went_wrong')
                    ]
                );
            }
        } else {
            return response()->json(
                [
                    'type' => 'error',
                    'message' => trans('lang.need_to_reg')
                ]
            );
        }
    }

    public function postComment(Request $request)
    {
        $json = Array();
        if (!empty($request)) {
            $forum = Forum::findOrFail($request['forum_id']);
            $forum->users()->attach(Auth::user()->id, ['type' => 'comment', 'answer' => filter_var($request->forum_answer, FILTER_SANITIZE_STRING)]);

            $forums = Forum::where('speciality_id', $request['speciality_id'])->with('users')->with('speciality')->with('questioner')->with('answers')->with('comments')->orderBy('created_at', 'DESC')->get();


            $json['type'] = 'success';
            $json['forums'] = $forums;
            $json['message'] = 'comment posted successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            $json['message'] = 'comment not posted';
            return $json;
        }
    }

    public function showProfile($slug) {
        $doctor = User::where('slug', $slug)->with('profile')->with('specialities')->with('area')->with('location')->with('question')->with('answers')->first();

        $user_ = User::where('id', \Auth::id() ? Auth::id() : '')->with('profile')->with('roles')->first();
        $logged_user = $user_ ? $user_ : [];

             $doctors = User::role('doctor')->orderBy("trending","desc")->with('profile','specialities','location','feedbacks')->whereHas('profile', function ($query) {
    return $query->where('verify_registration', '=', 1);
})->limit(4)->get();
        /*Hospital*/
        $hospitals = User::role('hospital')->orderBy("trending","desc")->with('profile','location','area','feedbacks','teams')->limit(6)->get();
        /*Laboratory*/
        $laboratories = User::role('laboratory')->with('profile','location','area')->limit(6)->get();
        /*Specialities*/
        $specialities = Speciality::select('id','title','slug','image')->where('top', '1')->orderBy("created_at","asc")->limit(8)->get();
        /*Diseases*/
        $diseases = Disease::select('id','title', 'slug','flag')->latest()->limit(4)->get();
        /*Services*/
        $services = Service::select('id','title', 'slug','image')->latest()->limit(4)->get();
        $cities = Location::where('top', '1')->orderBy("created_at","asc")->limit(6)->get();
        $meta_values = ['header_service','show_headertabs','topbar_settings','general_settings','download_app_sec','home_slider','socials','footer_settings','subscribe_now_sec','list_doctor_inner_section'];
        $managements = SiteManagement::whereIn('meta_key',$meta_values)->get();
        $segments = \Request::segments();

        return View(
            'front-end.forum.profile',
            compact(
                'specialities', 'logged_user', 'laboratories', 'cities', 'services', 'diseases',
                'specialities', 'hospitals', 'doctors', 'managements', 'doctors', 'doctor','segments'
            )
        );
    }

    public function postLike(Request $request) {
        $json = Array();
        $forum = Forum::where('id', $request['id'])->first();
        $liked = json_decode($forum->liked,true);
        if ($forum->liked === null) {
            $liked = $request['patient']['id'];
            $liked = array($liked);
            $json['type'] = 'success';
            $json['message'] = 'Added to liked questions successfully';

        }
        elseif (in_array($request['patient']['id'], $liked)) {
            $key = array_search($request['patient']['id'], $liked);
            if ($key !== false) {
                unset($liked[$key]);
            }
            $liked = json_encode($liked, true);
            $json['type'] = 'remove';
            $json['message'] = 'Remove from liked questions';
           
        }
        else {
            $liked = json_decode($forum->liked);
            array_push($liked, $request['patient']['id']);
            $liked = json_encode($liked, true);
             $json['type'] = 'success';
            $json['message'] = 'Added to liked questions successfully';
            
        }
        $forum = Forum::where('id', $request['id'])->update([
            'liked' => $liked
        ]);
        return $json;
    }

    public function addFollowings(Request $request) {
        $json = Array();
        $doctor = User::where('id', $request['doctor'])->with('profile')->first();
        $user = User::where('id', Auth::id())->with('profile')->first();

        if ($doctor->profile->followers === null) {
            $followers = [$user->id];
            $followers = json_encode($followers);
            UserMeta::where('id', $doctor->profile->id)->update([
                'followers' => $followers
            ]);
        }
        else {
            $followers =json_decode($doctor->profile->followers, true);
            array_push($followers, $user->id);
            $followers = json_encode($followers);
            UserMeta::where('id', $doctor->profile->id)->update([
                'followers' => $followers
            ]);
        }
        if ($user->profile->followings === null) {
            $followings = [$doctor->id];
            $followings = json_encode($followings);
            UserMeta::where('id', $user->profile->id)->update([
                'followings' => $followings
            ]);
        }
        else {
            $followings = json_decode($user->profile->followings, true);
            array_push($followings, $doctor->id);
            $followings = json_encode($followings);
            UserMeta::where('id', $user->profile->id)->update([
                'followings' => $followings
            ]);
        }
        $json['type'] = 'success';
        $json['message'] = 'Added to followings';
        return $json;
    }

    public function removeFollowings(Request $request) {
        $json = Array();
        $doctor = User::where('id', $request['doctor'])->with('profile')->first();
        $user = User::where('id', Auth::id())->with('profile')->first();

        $followings = json_decode($user->profile->followings, true);
        $key = array_search($doctor->id, $followings);
        if ($key !== false) {
            unset($followings[$key]);
        }
        if ($followings !== []){
            $followings = json_encode($followings);
        }
        UserMeta::where('id', $user->profile->id)->update([
            'followings' => $followings
        ]);

        $followers = json_decode($doctor->profile->followers, true);
        $key = array_search($user->id, $followers);
        if ($key !== false) {
            unset($followers[$key]);
        }

        if ($followers !== []){
            $followers = json_encode($followers);
        }
        UserMeta::where('id', $doctor->profile->id)->update([
            'followers' => $followers
        ]);
        $json['type'] = 'success';
        $json['message'] = 'Removed from followings';
        return $json;
    }

}
