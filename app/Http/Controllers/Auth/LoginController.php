<?php
/**
 * Class LoginController
 *
 * @category Doctry
 *
 * @package Doctry
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com Amentotech
 */
namespace App\Http\Controllers\Auth;

use Schema;
use Session;
use DB;
use App\User;
use App\LoginAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Helper;

/**
 * Class LoginController
 *
 */
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Where to redirect users after login.
     *
     * @param string $request request attributes
     *
     * @return authenticated users
     */
    protected function authenticated(Request $request, $user)
    {
        //dd($request->all(),$user);
        if ($request['remember'] === null) {
        if (Schema::hasTable('users')) {
            $role_type = Helper::getRoleTypeByUserID(Auth::user()->id);
          //  dd($role_type);
            if($role_type =='admin'){
            $user_name = Helper::getUserData($user->id);
            $user_account = new LoginAccount();
            $user_account ->user_name = $user_name;
            $user_account ->ip_address = $request->ip();
            $user_account ->save();
        }

            if (!empty($role_type)) {

                if(!($role_type =='admin')){
                if (!empty($user->verification_code)) {
                    Auth::logout();
                    Session::flash('error', trans('lang.verification_code_not_verified'));
                    return Redirect::back()->withErrors('message', 'lang.verification_code_not_verified');
                } else {
                    return Redirect::to($role_type.'/dashboard');
                }
            }
            else{
                if (!empty($user->verification_code)) {
                    Auth::logout();
                    Session::flash('error', trans('lang.verification_code_not_verified'));
                    return Redirect::back()->withErrors('message', 'lang.verification_code_not_verified');;
                } else {
                    return Redirect::to('/admin/dashboard');
                }
            }
        }
             else {
                Auth::logout();
                Session::flash('error', trans('lang.no_role_assign'));
                return Redirect::back()->withErrors('message', 'lang.no_role_assign');;
            }
        }
    }
    else{
         $json = array();
        $email = $request['email'];
        $password = $request['password'];
        $remember = $request['remember'];
        $result = Auth::attempt(['email' => $email, 'password' => $password], $remember);
        if ($result) {
               $role_type = Helper::getRoleTypeByUserID(Auth::user()->id);
          //  dd($role_type);
            if($role_type =='admin'){
            $user_name = Helper::getUserData($user->id);
            $user_account = new LoginAccount();
            $user_account ->user_name = $user_name;
            $user_account ->ip_address = $request->ip();
            $user_account ->save();
        }
        return Redirect::to($role_type.'/dashboard');
        }
        else {
             Auth::logout();
                Session::flash('error', trans('lang.no_role_assign'));
                return Redirect::back()->withErrors('message', 'lang.no_role_assign');;
        }
        
    }


    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest')->except('logout');
    }

    public function vueLogin(Request $request) {
        //dd($request->all());
        if ($request['remember'] === null || $request['remember'] === false) {
            $json = array();
            $email = $request['email'];
            $password = $request['password'];
            $result = Auth::attempt(['email' => $email, 'password' => $password]);

            if ($result === false) {
                        if (substr( $request['email'], 0, 2 ) === "03") {
                        $request['email'] = '92'.(int)$request['email'];
                        $phonenumber = $request['email'];
                         $result = Auth::attempt(['phone_number' => $phonenumber, 'password' => $password]);
                        }
            }

            $id = Auth::id();
            $user_name = Helper::getUserData($id);
            $user_account = new LoginAccount();
            $user_account ->user_name = $user_name;
            $user_account ->ip_address = $request->ip();
            $user_account ->save();
            $user = User::where('id',$id)->with('profile')->with('roles')->first();
            if ($result) {
                $json['result'] = 'success';
                $json['message'] = 'You have logged in successfully';
                return $user;
            }
            else {
                $json['result'] = 'error';
                $json['message'] = 'Credentials Not Matches';
                return $json;
            }
        }
        else{
                $json = array();
                $email = $request['email'];
                $password = $request['password'];
                $remember = $request['remember'];
                $result = Auth::attempt(['email' => $email, 'password' => $password], $remember);

                if ($result === false) {
                        if (substr( $request['email'], 0, 2 ) === "03") {
                        $request['email'] = '92'.(int)$request['email'];
                        $phonenumber = $request['email'];
                        }
                $result = Auth::attempt(['phone_number' => $phonenumber, 'password' => $password]);
                }
                
           $id = Auth::id();
            $user = User::where('id',$id)->with('profile')->with('roles')->first();
            if ($result) {
                $json['result'] = 'success';
                $json['message'] = 'You have logged in successfully';
                return $user;
            }
            else {
                $json['result'] = 'error';
                $json['message'] = 'Credentials Not Matches';
                return $json;
            }
        }

    }
}
