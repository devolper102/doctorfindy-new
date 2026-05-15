<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use Validator,Redirect,Response,File;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\UserMeta;

class SocialController extends Controller
{
    //

    public function redirect($provider)
    { 

        return Socialite::driver($provider)->stateless()->redirect();
    }
    public function callback($provider)
    {   
        $getInfo = Socialite::driver($provider)->stateless()->user();
        $user = $this->createUser($getInfo,$provider);
        auth()->login($user);
        return redirect()->to('/');
    }
    function createUser($getInfo,$provider){
        // dd($getInfo,$provider);
        $user = User::where('provider_id', $getInfo->id)->first();
        list($firstname, $lastname) = explode(' ', $getInfo->name,2);
        $slug = filter_var($firstname, FILTER_SANITIZE_STRING) . '-' .
            filter_var($lastname, FILTER_SANITIZE_STRING);
        if (!$user) {
            $user = User::create([
                'first_name'     => $firstname,
                'last_name'     => $lastname,
                'slug'         => $slug,
                'password'         => password_hash('doctorfindy.com',PASSWORD_DEFAULT),
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
            $user_profile = UserMeta::create([
                    'user_id' => $user->id
                ]);
                if (!empty($user_profile->id)) {
                    $user_meta = UserMeta::find($user_profile->id);
                } else {
                    $user_meta =
                    $user_meta = $user_profile;
                }
//            dd($user_profile);
                $user_meta->user()->associate($user);
            
            auth()->login($user);
            $role = DB::table('roles')->select('name')->where('role_type', 'patient')->first();
            $user->assignRole($role->name);
        }
        return $user;
    }
}
