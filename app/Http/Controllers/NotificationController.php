<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function index () {
     $notifications = Notification::all();
        return view('back-end.admin.push-notifications.index',compact('notifications'));

    }

    public function store (Request $request)
    {
        $json = array();
        $title = $request['title'];
        $message = $request['message'];
        $url = $request['url'];

        if (!empty($message) && !empty($url))
        {
            $end_point = 'https://api.webpushr.com/v1/notification/send/all';
            $http_header = array(
                "Content-Type: Application/Json",
                "webpushrKey: iziN0fvyyrZDXw6Jlyiuu9fuEsN07a7TXoxHv9H08Xc",
                "webpushrAuthToken: 10560"
            );
            $req_data = array(
                'title' 			=> $title, //required
                'message' 		=> $message, //required
                'target_url'	=> $url, //required
//                'name'			=> 'Test campain',
                'icon'			=> 'https://dev.msnsoft.org/uploads/settings/general/1592321417-final-sc.png',
                'auto_hide'		=> 1,
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
            curl_setopt($ch, CURLOPT_URL, $end_point );
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($req_data) );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            echo $response;

            $res = json_decode($response);

            $notification = new Notification();
            $notification->title = $title;
            $notification->title = Auth::id();
            $notification->url = $url;
            $notification->message = $message;
            $notification->icon = 'https://dev.msnsoft.org/uploads/settings/general/1592321417-final-sc.png';
            $notification->notification_id = $res['ID'];
            $notification->save();

            $json['message'] = $res['status'];
            $json['description'] = $res['description'];
            $json['id'] = $res['ID'];

        }
        else
        {
            $json['message'] = "Message and URL required";
            $json['type'] = 'error';
        }
        return $json;

    }
}
