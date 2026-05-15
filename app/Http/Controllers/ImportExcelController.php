<?php

namespace App\Http\Controllers;
use App\User;
use App\Location;
use View;
use Helper;
use Session;
use App\UserMeta;
use App\Speciality;
use Illuminate\Support\Facades\Redirect;
use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
      public function import(Request $request) 
    {
         $this->validate(
            $request,
            [
                'role' => 'required',
                'select_file' => 'required',
            ]
        );
       $rows = Excel::toArray(new UsersImport, $request->file('select_file'));
      // dd('all',$rows[0],$request->all());

// Doctors Import

if ($request->role === 'doctor') {
  
    foreach ($rows as $key => $allDoctors) {

       // $allDoctors = $rows[0];
       // dd($allDoctors);
       foreach($allDoctors as $key => $row)
      {
        if ($row['name'] === '' || $row['name'] === null) {
          array_shift($allDoctors);
        }
        else {

       // dd($row);
        // different area and address
         $address_array = explode(',',$row['address']);
         $area = end($address_array);
         $new_address = str_replace($area,'', $row['address']);

//dd($address_array, $area,$new_address);


        $newlast_name = str_replace('Dr','', $row['name']);
        $old_user = User::where('last_name', $newlast_name)->first();
    if ($old_user != null || $old_user != '' || (!empty($old_user)) )
  { 
    array_shift($allDoctors);

  }
  else{

  // start find and create Speciality
           $speciality_data = Speciality::where('title', $row['speciality'])->first();
          // dd($location_data,$location_data->areas);exit();
               if ($speciality_data != null || $speciality_data != '' || 
                (!empty($speciality_data))) {
               $speciality_id = $speciality_data->id;
               }
               else{
                  $speciality = new Speciality();
                  $speciality ->title = $row['speciality'];
                  $speciality ->slug = Str::slug($row['speciality']);
                  $speciality ->save();
                  $speciality_id =  $speciality->id;
               }
    // end find and create Speciality


    

        //dd($old_user);exit();
        // start find and create location
           $location_data = Location::where('title', $row['city'])->first();
          // dd($location_data,$location_data->areas);exit();
               if ($location_data != null || $location_data != '' || 
                (!empty($location_data))) {
               $location_id = $location_data->id;
               }
               else{
                  $location = new Location();
                  $location ->title = $row['city'];
                  $location ->slug = Str::slug($row['city']);
                  $location ->parent = 0;
                  $location ->save();
                  $location_id =  $location->id;
               }
    // end find and create location

           $area_data = Location::where('id', $location_id)->with('areas')->first();
           //dd($area_data,$location_id);
if ($area_data != null || $area_data != '' || (!empty($area_data)) )
  {
          $new_area_data  =  $area_data->where('title', $area)->first();

            if ($new_area_data != null || $new_area_data != '' || (!empty($new_area_data))) {
              $area_id = $new_area_data->id;
            }
            else{
              $location = new Location();
                  $location ->title = $area;
                  $location ->slug = Str::slug($area);
                  $location ->parent = $location_id;
                  $location ->save();
                  $area_id = $location->id;
            }
            

}
else{
  $area_id  = 1;
}





        if ($location_id != null || $area_id != null) {   
            $user = new User();
              $user ->first_name = 'Dr';
              $user ->last_name = $newlast_name;
              // $user ->first_name = 'user';
              // $user ->last_name = $row['name'];
              $user ->slug = Str::slug('dr'.'-'.$newlast_name);
              $user ->email = null;
              $user ->password = Hash::make('google');
              $user ->location_id = $location_id;
              $user ->area_id = $area_id;
              $user ->phone_number = $row['apptphone'];
              $user ->save();
              $user_getid =  $user->id;


              $user_mate = UserMeta::create([
                    'user_id' => $user_getid,
                    'experiences' => null,
                    'specializations' => null,
                    'memberships' => null,
                    'educations' => null,
                    'awards' => null,
                    'services' => null,
                    'avatar' => null,
                    'banner' => null,
                    'gender' => null,
                    'gender_title' => null,
                    'sub_heading' => null,
                    'tagline' => null,
                    'short_desc' => null,
                    'description' => null,
                    'delete_reason' => null,
                    'delete_description' => null,
                    'payout_id' => null,
                    'profile_searchable' => null,
                    'weekly_alerts' => null,
                    'disable_account' => null,
                    'message_alerts' => null,
                    'verify_medical' => null,
                    'consultation_fee' => null,
                    'saved_hospitals' => null,
                    'saved_doctors' => null,
                    'saved_articles'=> null,
                    'downloads' => null,
                    'address'  => null,
                    'longitude' => null,
                    'latitude' => null,
                    'verify_registration'=> 0,
                    'recommendation' => null,
                    'votes' => null,
                    'available_days' => null,
                    'working_time' => null,
                    'liked_answers' => null,
                    'starting_price' => null,
                    'payout_settings' => null,
                    'gallery' => null,
                    'gallery_videos' => null,
                    'willing_video' => null,
                    'willing_home_visit' => null,
                    'extend' => '',
                    'mark_red' => null, 
                    'mark_incomplete' => null,
                    'leave' => null,
                    'created_extend' => null,
                    'fees_range' => null, 
                    'commission' => null, 
                    'faqs'=> null,
                    'total_experience' => null,
                    'bank_data' => null,
                    'add_longitude' => null,
                    'language' => null,
                    'user_metascol' => null,

                ]);
    $role = DB::table('roles')->select('name')->where('role_type', $request->role)->first();
                $user->assignRole($role->name);
          }
  
    if ($user_getid != null) {
      $status = UserMeta::where('user_id',$user_getid) ->update([
        'address' => $new_address,
        'starting_price' => $row['fee'],
    ]);
    }
    // DB::insert('insert into user_speciality values (user_id, speciality_id)', [$user_getid, $speciality_id]);
      DB::table('user_speciality')->insert([
                    'user_id' => $user_getid,
                    'speciality_id' => $speciality_id,
                ]);
          
        }
      }

    }    

}
}

 
  



// end Doctors Import

// Hospitals Import

if ($request->role === 'hospital') {
  
    foreach ($rows as $key => $allHospitals) {

       // $allHospitals = $rows[0];
       foreach($allHospitals as $key => $row)
      {
        $newfirstname = str_replace('Hospital','', $row['name']);
        $old_user = User::where('first_name', $newfirstname)->first();
    if ($old_user != null || $old_user != '' || (!empty($old_user)) )
  { 
    array_shift($allHospitals);

  }
  else{

    

        //dd($old_user);exit();
        // start find and create location
           $location_data = Location::where('title', $row['city'])->first();
          // dd($location_data,$location_data->areas);exit();
               if ($location_data != null || $location_data != '' || 
                (!empty($location_data))) {
               $location_id = $location_data->id;
               }
               else{
                  $location = new Location();
                  $location ->title = $row['city'];
                  $location ->slug = Str::slug($row['city']);
                  $location ->parent = 0;
                  $location ->save();
                  $location_id =  $location->id;
               }
    // end find and create location

           $area_data = Location::where('id', $location_id)->with('areas')->first();
           //dd($area_data,$location_id);
if ($area_data != null || $area_data != '' || (!empty($area_data)) )
  {
          $new_area_data  =  $area_data->where('title', $row['area'])->first();

            if ($new_area_data != null || $new_area_data != '' || (!empty($new_area_data))) {
              $area_id = $new_area_data->id;
            }
            else{
              $location = new Location();
                  $location ->title = $row['area'];
                  $location ->slug = Str::slug($row['area']);
                  $location ->parent = $location_id;
                  $location ->save();
                  $area_id = $location->id;
            }
            

}
else{
  $area_id  = 1;
}





        if ($location_id != null || $area_id != null) {   
            $user = new User();
              $user ->first_name = $newfirstname;
              $user ->last_name = 'Hospital';
              // $user ->first_name = 'user';
              // $user ->last_name = $row['name'];
              $user ->slug = Str::slug($newfirstname.'-'.'hospital');
              $user ->email = null;
              $user ->password = Hash::make('google');
              $user ->location_id = $location_id;
              $user ->area_id = $area_id;
              $user ->phone_number = $row['phone'];
              $user ->save();
              $user_getid =  $user->id;


              $user_mate = UserMeta::create([
                    'user_id' => $user_getid,
                    'experiences' => null,
                    'specializations' => null,
                    'memberships' => null,
                    'educations' => null,
                    'awards' => null,
                    'services' => null,
                    'avatar' => null,
                    'banner' => null,
                    'gender' => null,
                    'gender_title' => null,
                    'sub_heading' => null,
                    'tagline' => null,
                    'short_desc' => null,
                    'description' => null,
                    'delete_reason' => null,
                    'delete_description' => null,
                    'payout_id' => null,
                    'profile_searchable' => null,
                    'weekly_alerts' => null,
                    'disable_account' => null,
                    'message_alerts' => null,
                    'verify_medical' => null,
                    'consultation_fee' => null,
                    'saved_hospitals' => null,
                    'saved_doctors' => null,
                    'saved_articles'=> null,
                    'downloads' => null,
                    'address'  => null,
                    'longitude' => null,
                    'latitude' => null,
                    'verify_registration'=> 0,
                    'recommendation' => null,
                    'votes' => null,
                    'available_days' => null,
                    'working_time' => null,
                    'liked_answers' => null,
                    'starting_price' => null,
                    'payout_settings' => null,
                    'gallery' => null,
                    'gallery_videos' => null,
                    'willing_video' => null,
                    'willing_home_visit' => null,
                    'extend' => '',
                    'mark_red' => null, 
                    'mark_incomplete' => null,
                    'leave' => null,
                    'created_extend' => null,
                    'fees_range' => null, 
                    'commission' => null, 
                    'faqs'=> null,
                    'total_experience' => null,
                    'bank_data' => null,
                    'add_longitude' => null,
                    'language' => null,
                    'user_metascol' => null,

                ]);
    $role = DB::table('roles')->select('name')->where('role_type', $request->role)->first();
                $user->assignRole($role->name);
          }
  
    if ($user_getid != null) {
      $status = UserMeta::where('user_id',$user_getid) ->update([
        'address' => $row['address'],
        'longitude' => $row['longitude'],
        'latitude' => $row['latitude'],
    ]);
    }
          
        }
      }

    }    

}

 
 // end Hospital Import   
     Session::flash('message','Import Data Successfully');  
            return Redirect::back();
  }
      
}

