<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\User;
use View;
use Helper;
use Session;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    //
    public function index(){
        $feedbacks = Feedback::orderBy("created_at","desc")->get();
        return view('back-end.admin.feedback.index', compact('feedbacks'));
    }

    public function approve($status, $id){
        Feedback::where('id',$id)->update(array('approval'=>$status));
        return redirect('admin/feedback');
    }

    public static function feedbackCheck(Request $request)
    {
        $json = array();
        $user_id = $request['user_id'];
        if (!empty(Auth::user()->id)){
            $result = Feedback::where('patient_id',Auth::user()->id)->where('user_id',$user_id)->count();
            $json['type'] = 'success';
            $json['result'] = $result;
            return $json;
        }
    }

   public function destroy(Request $request)
     {
        

        $server = Helper::doctieIsDemoSiteAjax();
        if (!empty($server)) {
            $json['type'] = 'error';
            $json['message'] = $server->getData()->message;
            return $json;
        }
        $json = array();
        $id = $request['id'];
        
        if (!empty($id)) {
          Feedback::where('id', $id)->delete();
      
            $json['type'] = 'success';
            $json['message'] = 'feedback deleted successfully';
            return $json;
        } else {
            $json['type'] = 'error';
            return $json;
        }
    }

}
