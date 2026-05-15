<?php

namespace App\Http\Controllers;
use App\User;
use App\Location;
use App\OnlineConsultation;
use View;
use Helper;
use Session;
use App\UserMeta;
use App\Scrapping;
use App\Models\LabTestScrapping;
use App\NewCityScrapping;
use App\Speciality;
use App\Service;
use App\Disease;
use App\Team;
use App\Area;
use App\FaqAssign;
use App\Faq;
use Illuminate\Support\Str;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Redirect;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\LabLocation;
use App\Speciality_Test;

class GoutteController extends Controller
{
  public function doWebScraping(Request $request)
    {
        $specialties = Speciality::get();
          // dd($specialties);
         $client = new Client(HttpClient::create(['timeout' => 3600]));
         foreach($specialties as $specialty){
         $url = "https://oladoc.com/pakistan/wazirabad/$specialty->slug";
         // $url = "https://oladoc.com/pakistan/wazirabad/general-surgeon";

          // dd($url);
          $get_category = explode("/",$url);
          $category = end($get_category);
         // dd($category);
         $data = array();
         $crawler = $client->request('GET',$url);
         if($crawler->filter('.no-match-found')->count() > 0){
         $dataNotFound = $crawler->filter('.no-match-found')->text();
         // dd($dataNotFound);
         $length = 0;
         continue;
          }
          else{
            if($crawler->filter('#showing_results_title')->count() > 0){
         $dataFound = $crawler->filter('#showing_results_title')->text();
         preg_match('!\d+!', $dataFound, $matches);
         $length = $matches[0];
         // dd($dataFound);
          }
          else{
            $length = 0;
          }
         }
         
        for($j = 0 ; $j <= $length - 1; $j++) {
         $crawler = $client->request('GET',$url.'/'.$j);
         // dd($crawler);
//          $nodeValues = $crawler->filter('.doctor-name')->each(function ( $node) {
//           var_dump($node->attr('href')); exit();
//     return $node->attr('href');
// });
//           dd($nodeValues);
//           exit();
         // $data = [];
          // $data1 =  $crawler->filter('.listitempage')->each(function ($node) {
          //   $node->filter('.doc-listing-card')->each(function ($doc) {
          //     array_push($data,$doc->filter('.doctor-name a')->attr('href'));
          //   });
           $result = $crawler->filter('.doctor-name')->attr('href');
            // dd($result);
           preg_match('"([^\\"]+)"', $result, $doc_url);
            $doc_url = $doc_url[0];
           // var_dump($doc_url);
          if(str_contains($doc_url, '?online') !== true){
            $get_id = explode('/', $doc_url);
           $uniqueid = end($get_id);
            // dd($uniqueid);
           $data = NewCityScrapping::where("uniqueid",$uniqueid)->where('city', 'wazirabad')->first();
           if(empty($data)){
              NewCityScrapping::create([
                'url' => $doc_url,
                'category' => $category,
                'type' => 'doctor',
                'uniqueid' => $uniqueid,
                'city' => 'wazirabad'
            ]);
           }else{
            $data->url = $doc_url;
            $data->city = 'wazirabad';
            $data->type = 'doctor';
            $data->disable = 0;
            $data->save();
           }
          }
          echo $j."========".$doc_url."<br>";
          } 
           // dd($doc_url);
           
        }
        
        return "Done";
}

    public function hospitalWebScraping(Request $request)
    {
        $client = new Client(HttpClient::create(['timeout' => 3600]));
         $url = "https://oladoc.com/pakistan/wazirabad";
         $data = array();

         $crawler = $client->request('GET',$url);
         // dd($crawler);
         // $data = [];
          // $data1 =  $crawler->filter('.listitempage')->each(function ($node) {
          //   $node->filter('.doc-listing-card')->each(function ($doc) {
          //     array_push($data,$doc->filter('.doctor-name a')->attr('href'));
          //   });
          $hospital_url = array();
          $hospital_names = array();
          $visible_hospital_names = array();
          $hidden_hospital_names = array();
           $visible_hospital_names =  $crawler->filter('#best-hospital .listing_links_holder .city-listing-wrapper .visible-links a')->each(function ($node) use ($hospital_names){
            // print_r($node->text());exit();
              return $node->text();
           });
           $hidden_hospital_names =  $crawler->filter('#best-hospital .listing_links_holder .city-listing-wrapper .hidden-links a')->each(function ($node) use ($hospital_names){
            // print_r($node->text());exit();
              return $node->text();
           });
           // dd($hidden_hospital_names);

           $hospital_names = array_merge($visible_hospital_names,$hidden_hospital_names);
           // dd($hospital_names);
           //$all_hospital_name = array_slice($hospital_names,456);
           $hidden_hospital_urls =  $crawler->filter('#best-hospital .listing_links_holder .city-listing-wrapper .hidden-links a')->each(function ($node) use ($hospital_url){
              return $node->attr('href');
           });
           $visible_hospital_urls =  $crawler->filter('#best-hospital .listing_links_holder .city-listing-wrapper .visible-links a')->each(function ($node) use ($hospital_url){
              return $node->attr('href');
           });
           $hospital_urls = array_merge($visible_hospital_urls,$hidden_hospital_urls);
           // $hospital_urls = array_slice($hospital_urls,0,355);
           // dd($hospital_urls);
           // $all_hospital_name = array_slice($hospital_names,470);
           // $all_hospital_urls = array_slice($hospital_urls,470);
           // dd($all_hospital_name);
           $i = 1;
           foreach($hospital_urls as $hosp){
           $get_id = explode('/', $hosp);
           $uniqueid = end($get_id);
           // dd($uniqueid);
           $data = NewCityScrapping::where("uniqueid",$uniqueid)->where('type','hospital')->where('city','wazirabad')->first();
           if(empty($data)){
              NewCityScrapping::create([
                'url' => $hosp,
                'type' => 'hospital',
                'uniqueid' => $uniqueid,
                'city' => 'wazirabad'
            ]);
           }else{
            $data->url = $hosp;
            $data->city = 'wazirabad';
            $data->type = 'hospital';
            $data->disable = 0;
            $data->save();

           }
          echo $i."========".$hosp."<br>";
          $i = $i +1;
          }
        return "Done";
    }

 public function addDoctorDetails(Request $request)
    {
      // $a = User::role('doctor')->where('location_id',8)->get();
      $doctors = NewCityScrapping::where('city','wazirabad')->where('type','doctor')->where('disable',0)->get();
      // dd($doctors);
       $client = new Client(HttpClient::create(['timeout' => 3600]));
      // $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
      // dd($client);
        $doc_specialities = [];
        $doc_education = [];
        $doc_membership = [];
        $doc_disc_columns = [];
        $doc_name = "";
        $doc_hopitals = [];
        $last_name = "";
        $first_name = "";
        $wait_time = "";
        $experience = "";
        $doc_hopitals1 = [];
        $doc_hopitals2 = [];
        $doc_hopitals_with_price = [];
        $doc_experience = [];
        $doc_online_consultation = [];
        $doc_award = [];
        $uniqueid = "";
        $doc_timings = [];
        $doc_hospital_timings = [];
        $sidebar_hopital_count = 0;
      if(!empty($doctors)){
        foreach ($doctors as $key=>$doctor) {
          // if($key == 0)
          $get_id = explode('/', $doctor->url);
            // dd($get_id);
          $uniqueid = end($get_id);
          $user = User::role('doctor')->where('unique_id',$uniqueid)->first();
          // echo $user->id." " ;
          if(empty($user)){
          $crawler = $client->request('GET',$doctor->url);
          // dd($crawler);
          $uri= $crawler->getUri();
          $url_check = explode('/', $uri);


          if(sizeof($url_check)  > 6){
          // dd($url_check);   
          $doc_name =  $crawler->filter('.d-none')->filter('h1')->text();
          $doc_name = str_replace("GOLD ", "", $doc_name);
          // dd($doc_name);
          $last_name = strstr($doc_name," ");
          $first_name = strtok($doc_name," ");
             $doc_specialities = $crawler->filter('#acc_specialization li')->each(function ($node) use ($doc_specialities){
            // dd($node->text());
            return $node->text();
          });
            // dd($doc_specialities);
          $doc_education = $crawler->filter('#acc_education li')->each(function ($node) use ($doc_education){
            // dd($node->text());
            return $node->text();
          });
            // dd($doc_education, $doc_specialities);
          $doc_experience = $crawler->filter('#acc_experience li')->each(function ($node) use ($doc_experience){
            // dd($node->text());
            return $node->text();
          });
            // dd($doc_experience);
          $doc_membership = $crawler->filter('#acc_professional_mem li')->each(function ($node) use ($doc_membership){
            // dd($node->text());
            return $node->text();
            // dd($doc_specialities);
          });
          $doc_award = $crawler->filter('#acc_awards_reco li')->each(function ($node) use ($doc_award){
            // dd($node->text());
            return $node->text();
          });
            // dd($doc_award);
          $doc_disc_columns = $crawler->filter('table.doc-discription-columns')->filter('tr td')->each(function ($node) use ($doc_disc_columns){
            // dd($node->text());
            return $node->text();
            // dd($doc_specialities);
          });
          // dd($doc_disc_columns);
          if(count($doc_disc_columns) > 1)
          $doc_disc_columns = array_slice($doc_disc_columns, 0, -1);

          // dd($doc_disc_columns);
          // $doc_hopitals = $crawler->filter('#other-clinic-detail')->filter('.border-frame')->filter('.text')->each(function ($node) use ($doc_hopitals){
          //   // dd($node->text());
          //   return $node->text();
          //   // dd($doc_specialities);
          // });
          $doc_hopitals = $crawler->filter('#other-clinic-detail')->filter('.border-frame');
          // dd($doc_hopitals);
          $doc_hopitals = $doc_hopitals->each(function ($node) use ($doc_hopitals){
            //$hospital_div_id = $node->attr('id') ?? "";
            // dd($hospital_div_id);
            $hosital_name = "";
            $hospital_name = $node->filter('.hospital-name')->text();
            if($node->filter('.hospital-name a')->count() > 0){
              $hosital_name = $node->filter('.hospital-name a')->attr('href');
            }else{
              $hospital_name = $node->filter('.hospital-name')->text();
              // dd($hospital_name);
              $last_name = strstr($hospital_name," ");
              $first_name = strtok($hospital_name," ");
              $hospital = User::role('hospital')->where('first_name',$first_name)->Where('last_name', 'like', '%' . $last_name . '%')->where('location_id',17)->first();

              if(empty($hospital))
                return null;
              // dd($unique_id);
              $hospital = NewCityScrapping::where('uniqueid',$hospital->unique_id)->where('city','wazirabad')->first();
              $hosital_name = $hospital->url;
              // dd($hosital_name);
            }

            $node->filter('div span.doc-profile-page-content')->count() ? $node->filter('div span.doc-profile-page-content')->text(): '0';
            $hosital_price = $node->filter('div span.doc-profile-page-content')->count() ? $node->filter('div span.doc-profile-page-content')->text(): 'Rs. 0';
            if($hospital_name == "Online Video Consultation" || $hospital_name == "oladoc Care Video Consultation"){
                return null;
              }
            // dd($hosital_price);
              // $doc_hopitals2[] = array('hospital_name'=>$hosital_name,'price'=>$hosital_price);
            return $hosital_name."--".str_replace('Rs. ','',$hosital_price);
          });
          // dd($doc_hopitals);
          $doc_hopitals1 = $crawler->filter('.row-wrapper-siderbar #sidebar-wrapper .new-designed-practice-card');
          // dd($doc_hopitals1);
          $doc_hopitals1 = $doc_hopitals1->each(function ($node) use ($doc_hopitals1){
            $hosital_name = $node->filter('h3 a')->last()->attr('href');
            $hospital_text = $node->filter('h3 a')->last()->text();
            // return $hosital_name;
            // $hospital_ids = $node->filter('.date-holder')->attr('id');
            // dd($hosital_name);
            if($hospital_text != "Online Video Consultation" && $hospital_text != "oladoc Care Video Consultation"){
                $hosital_price = !empty($node->filter('tbody tr td:nth-child(2)')->text()) ? $node->filter('tbody tr td:nth-child(2)')->text():0;
                $hosital_price = trim(preg_replace("/\([^)]+\)/","",$hosital_price));

                if(!str_contains($hosital_price,"Rs")){
                 $hosital_price = 0;
                }
            // dd(trim($hosital_price));
            // dd($hosital_name);
            return $hosital_name."--".str_replace('Rs. ','',$hosital_price);
            }
            // dd($doc_specialities);
          });
         $doc_hopitals1 = array_filter($doc_hopitals1);
         // dd($doc_hopitals1);
         $sidebar_hopital_count = count($doc_hopitals1);
         // dd($sidebar_hopital_count);
           $doc_online_consultation = $crawler->filter('.row-wrapper-siderbar #sidebar-wrapper .new-designed-practice-card');
           $doc_online_consultation = $doc_online_consultation->each(function ($node) use ($doc_online_consultation){
            $online_appointment = $node->filter('h3 a')->first()->text();
            // dd($online_appointment);
            $willing_video = 'off';
            if($online_appointment == "Online Video Consultation" || $online_appointment == "oladoc Care Video Consultation" ){
              // dd('abc');
                $willing_video = 'on';
                $video_price = $node->filter('tbody tr td:nth-child(2)')->text();
            // dd($video_price);
                return $willing_video."--".str_replace('Rs. ','',$video_price);
              }
              // $doc_hopitals2[] = array('hospital_name'=>$hosital_name,'price'=>$hosital_price);
          });
           // dd('hi');
          $doc_online_consultation = array_filter($doc_online_consultation);
          // dd($doc_online_consultation);
                // if(!empty($doc_disc_columns)){
                //   if(count($doc_disc_columns))
                //   $wait_time = $doc_disc_columns[0];
                //   $experience = $doc_disc_columns[1];
                // }
            // if(!empty($doc_hopitals) && !empty($doc_hopitals)){
                  $doc_hopitals = array_merge($doc_hopitals, $doc_hopitals1);
                  // dd($doc_hopitals);
            // }
         // dd($doc_disc_columns,$doc_membership,$doc_education,$doc_specialities,$doc_name,$doc_hopitals);

        $result = $this->addDoctorsData($first_name,$last_name,$doc_specialities,$doc_education,$doc_membership,$doc_disc_columns,$doc_hopitals,$doc_experience,$doc_award,$doc_online_consultation,$uniqueid,$crawler,$sidebar_hopital_count);

        echo $key."======".$doctor->id."=====>".$doctor->url."</br>";
          }
        }
          // dd($doc_hopitals);

       // return $result;
      }

        return "Done";
        // dd($doc_disc_columns,$doc_membership,$doc_education,$doc_specialities,$doc_name,$doc_hopitals);
      }
    }
    public function addDocTeamsDetails($hosp)
    {
      // dd('hi2',$hosp);
      if($hosp == 'https://oladoc.com/pakistan/wazirabad/h/jb'){
            $hosp = 'https://oladoc.com/pakistan/wazirabad/h/jb--heart-vascular-clinic/11333';
          }
      // $hosp= "https://oladoc.com/pakistan/wazirabad/h/american-speciality-acupuncture-center/6081";
       // $client = new Client(HttpClient::create(['timeout' => 3600]));
      $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
       if(!empty($hosp)){
          $i= 0;

          $longitude = "";
          $latitude = "";
          $hosp_name = "";
          $hosp_address = "";
          $area_id = 0;
          $get_id = explode('/', $hosp);
          $uniqId = end($get_id);
          // dd($uniqId);
          $crawler = $client->request('GET',$hosp, [
    'max_redirects' => 0,
]);
          $uri= $crawler->getUri();
          $url_check = explode('/', $uri);
          $loc_slug = $url_check[4];
          $loc_id = Location::where('slug', $loc_slug)->pluck('id')->first();
          // dd($uri);

          if(sizeof($url_check)  > 6){
          $hosp_name =  $crawler->filter('.hospital-title')->text();
          // dd($hosp_name);
          $hosp_address =  $crawler->filter('.hospital-address')->filter('p ')->text();
          $last_name = strstr($hosp_name," ");
          $first_name = strtok($hosp_name," ");
          // dd($first_name, $last_name,$hosp_address);
          // dd($this->get_lat_long($hosp_address));
          // if( strpos($hosp_address, ',') !== false ) {
          //   // $area = substr($hosp_address, 0, strrpos( $hosp_address, ','));
          //   // $only_area = trim(substr($area, strrpos($area, ",") + 1));

          //   // $area_id = Area::where('title', 'LIKE', "%{$only_area}%")->pluck('id')->first();
          //   $this->findArea()
            
          // }else{
          //   $area = $hosp_address;

          //   $area_id = Area::where('title', 'LIKE', "%{$area}%")->pluck('id')->first();
          // }
          $lcn_id = Location::where('slug','wazirabad')->pluck('id')->first();
          if($hosp_address != ""){
            $area = $this->findArea($hosp_address);
            // dd($area);
            if($area !== ""){
            $area_id = Area::where('location_id', $lcn_id)->where('title', $area)->pluck('id')->first();
            }else{
              $area_id = 0;
            }
          }
          // dd($area_id);
          
          $slug = str_replace(array('.',' ',',','(',')','[',']'), '-' , $hosp_name);
          $slug = str_replace('--', '-' , $slug);
          $slug = rtrim($slug,'-');
          $slug = strtolower($slug);
          // dd($slug);
          if($crawler->filter('.get-direction-link')->count() > 0){
            // dd($crawler->filter('.get-direction-link')->count());
            $hospital_get_direction =  $crawler->filter('.get-direction-link')->attr('href');
            // dd($hospital_get_direction);
            $url_components = parse_url($hospital_get_direction);
            parse_str($url_components['query'], $params);
            $get_directions = explode(',',trim($params['query']));
            $longitude = end($get_directions);
            // dd($longitude);

            $longitude = str_replace(' ','', $longitude);
            $latitude = prev($get_directions);
           // dd($latitude);

            }else{
              // $get_directions = $this->get_lat_long($hosp_address);
              $longitude = 'not available';
              $latitude = 'not available';
           // 

            }
            // dd($latitude);  
            $user = User::where('unique_id',$uniqId)->where('location_id',$loc_id)->first();
            // dd($user);  
            if(empty($user)){
             // dd($longitude,$latitude);
              $user = User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'slug' => $slug,
                'password' => Hash::make('google'),
                'location_id' => $loc_id,
                'area_id' => $area_id ?? 0,
                'unique_id' => $uniqId
              ]);
              $user_meta = UserMeta::where('user_id',$user->id)->first();
              $user->assignRole('hospital');
              if(empty($user_meta)){
                $userMeta = UserMeta::create([
                'user_id' => $user->id,
                'address' => $hosp_address,
                'verify_registration' => 1,
                'longitude' => $longitude,
                'latitude' => $latitude,
                'hospital_services' => '{"icu":true,"emergency":false,"ventilator":true,"24_hrs_service":true,"ambulance":true,"waiting_lounge":true,"laboratory":true,"pharmacy":true,"blood_bank":true,"atm":true,"car_parking":true,"cafeteria":true}'
                ]);
              }
              echo $i."=========NewDocTeamAdded".$hosp."<br>";
              $i++;
            }
            sleep(2);
          }  
      }
       return "Done";
    }
    public function addHospitalDetails(Request $request)
    {

      //$users = UserMeta::all();
      
      $hospitals = NewCityScrapping::where('type','hospital')->where('city','wazirabad')->get();
      // dd($hospitals);
       // $client = new Client(HttpClient::create(['timeout' => 3600]));
      $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));

       if(!empty($hospitals)){
          $i= 0;
          foreach ($hospitals as $hosp) {

          $longitude = "";
          $latitude = "";
          $hosp_name = "";
          $hosp_address = "";
          $area_id = 0;
          $get_id = explode('/', $hosp->url);
          $uniqueid = end($get_id);
          $crawler = $client->request('GET',$hosp->url);
          $uri= $crawler->getUri();
          $url_check = explode('/', $uri);
          // dd($url_check);
          $loc_slug = $url_check[4];
          $loc_id = Location::where('slug', $loc_slug)->pluck('id')->first();
          // dd($loc_id);
          if(sizeof($url_check)  > 6){
          // dd($crawler);
          $hosp_name =  $crawler->filter('.hospital-title')->text();
           // dd($hosp_name);
          $hosp_address =  $crawler->filter('.hospital-address')->filter('p ')->text();
          $last_name = strstr($hosp_name," ");
          $first_name = strtok($hosp_name," ");
          // dd($first_name, $last_name);
          // dd($this->get_lat_long($hosp_address));
          // if( strpos($hosp_address, ',') !== false ) {
          //   // $area = substr($hosp_address, 0, strrpos( $hosp_address, ','));
          //   // $only_area = trim(substr($area, strrpos($area, ",") + 1));

          //   // $area_id = Area::where('title', 'LIKE', "%{$only_area}%")->pluck('id')->first();
          //   $this->findArea()
            
          // }else{
          //   $area = $hosp_address;

          //   $area_id = Area::where('title', 'LIKE', "%{$area}%")->pluck('id')->first();
          // }
          if($hosp_address != ""){
            $area = $this->findArea($hosp_address);
            // dd($area);
            if($area !== ""){
            $area_id = Area::where('location_id', $loc_id)->where('title', $area)->pluck('id')->first();
            }else{
              $area_id = 0;
            }
          }
          // dd($area_id);
          
          $slug = str_replace(array('.',' ',',','(',')','[',']'), '-' , $hosp_name);
          $slug = str_replace('--', '-' , $slug);
          $slug = rtrim($slug,'-');
          $slug = strtolower($slug);
          // dd($slug);
          if($crawler->filter('.get-direction-link')->count() > 0){
            // dd($crawler->filter('.get-direction-link')->count());
            $hospital_get_direction =  $crawler->filter('.get-direction-link')->attr('href');
            // dd($hospital_get_direction);
            $url_components = parse_url($hospital_get_direction);
            parse_str($url_components['query'], $params);
            $get_directions = explode(',',trim($params['query']));
            $longitude = end($get_directions);
            // dd($longitude);

            $longitude = str_replace(' ','', $longitude);
            $latitude = prev($get_directions);
           // dd($latitude);

            }else{
              // $get_directions = $this->get_lat_long($hosp_address);
              $longitude = 'not available';
              $latitude = 'not available';
           // 

            }
            // dd($latitude);  
            $user = User::where('unique_id',$uniqueid)->where('location_id',$loc_id)->first();
            // dd($user);  
            if(empty($user)){
             // dd($longitude,$latitude);
              $user = User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'slug' => $slug,
                'password' => Hash::make('google'),
                'location_id' => $loc_id,
                'area_id' => $area_id ?? 0,
                'unique_id' => $uniqueid
              ]);
              $user_meta = UserMeta::where('user_id',$user->id)->first();
              $user->assignRole('hospital');
              if(empty($user_meta)){
                $userMeta = UserMeta::create([
                'user_id' => $user->id,
                'address' => $hosp_address,
                'verify_registration' => 1,
                'longitude' => $longitude,
                'latitude' => $latitude,
                'hospital_services' => '{"icu":true,"emergency":false,"ventilator":true,"24_hrs_service":true,"ambulance":true,"waiting_lounge":true,"laboratory":true,"pharmacy":true,"blood_bank":true,"atm":true,"car_parking":true,"cafeteria":true}'
                ]);
              }
              echo $i."=========".$hosp->url."<br>";
              $i++;
            }
            sleep(2);
           }
          }  
      }
       return "Done";
    }
    public function getSpecialities(){

      $client = new Client(HttpClient::create(['timeout' => 3600]));
      // $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
      $url = "https://www.marham.pk/doctors";
      $crawler = $client->request('GET',$url);
      $specialities =  $crawler->filter('.grid-list li a')->each(function ($node){
            // dd($node->text());
            return $node->text();
            // dd($doc_specialities);
          });
      if(!empty($specialities)){
      $specialities = array_slice($specialities,0,93);
        // dd($specialities);
          foreach ($specialities as $speciality) {
            speciality::create([
                'title' => $speciality,
                'slug' => strtolower(str_replace(" ","-",$speciality)),
                'type' => 'speciality'
            ]);
          }
              
      }
      return "Successfully Done";
    }

    public function getServices(){

      $client = new Client(HttpClient::create(['timeout' => 3600]));
      // $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
      $url = "https://www.marham.pk/services";
      $doc_specialities = array();
      $doc_services = array();
      $crawler = $client->request('GET',$url);
      $services =  $crawler->filter('.col-12');
        // dd($specialities);
        $doc_specialities = $crawler->filter('.col-12 h3')->each(function ($node) use ($doc_specialities){
            // dd($node->text());
            return $node->text();
            // dd($doc_specialities);
          });
        $doc_services = $crawler->filter('.col-12 .grid-list li a')->each(function ($node) use ($doc_services){
            // dd($node->text());
            return $node->text();
          });
            // dd($doc_services);
        if(!empty($doc_services)){
        $services = array_slice($doc_services,1206,11);
        // dd($services);
          foreach ($services as $service) {
            Service::create([
                'title' => $service,
                'slug' => strtolower(str_replace(" ","-",$service)),
                'speciality_id' => 64,
                'type' => 'service'
            ]);
          }
              
        }
        
      return "Successfully Done";
    }

    public function addDoctorsData($first_name,$last_name,$doc_specialities,$doc_education,$doc_membership,$doc_disc_columns,$doc_hopitals,$doc_experience,$doc_award,$doc_online_consultation,$uniqueid,$crawler,$sidebar_hopital_count){
// dd($doc_hopitals);
              $slug = $first_name."".$last_name;
              $slug = str_replace('.','' , strtolower($slug));
              $slug = str_replace(array(' ','  '), '-' , $slug);
              // $slug = rtrim($slug,'-');
              // dd($slug);
              $doc_educations = null;
              $doc_experiences = null;
              $doc_memberships = null;
              $doc_awards = null;
              $latitude = "";
              $longitude = "";
              $wait_time = "";
              $experience = "";
              $willing_video = "off";
              $video_consultation_price = 0;
              // $first_hopital = $doc_hopitals[0] ?? [];
              // dd('hi1',$first_hopital);
              $doc_hospital_timings = [];
              $slots = null;
              if(!empty($doc_disc_columns)){
                  if(count($doc_disc_columns) > 1)
                  {
                    $wait_time = $doc_disc_columns[0] ?? "";
                    $experience = $doc_disc_columns[1] ?? "";
                  }else{
                    $experience = $doc_disc_columns[0] ?? "";
                  }
                }
                foreach($doc_hopitals as $first_hopital){
              if(!empty($first_hopital)){
                    $hopital_explode = explode('--',$first_hopital);
                    $hospital_url = reset($hopital_explode);
                    $get_id = explode('/', $hospital_url);
                    $unique_id = end($get_id);
                  $first_hopital = User::role('hospital')->with('profile')->where('unique_id',$unique_id)->first();
                  if(empty($first_hopital) || $first_hopital == null ){
                  // dd($first_hopital);
                     $first_hopital = $this->addDocTeamsDetails($hospital_url);
                  // dd('hi1',$hospital_url);
                }
                  $longitude = $first_hopital->profile->longitude ?? '';
                  $latitude = $first_hopital->profile->latitude ?? ''; 
                }
              }
              if(!empty($doc_education)){
                foreach ($doc_education as $education) {
                  $dash_count = substr_count($education,"-");
                  $degree_title = "";
                  if( strpos($education, '-') !== false ) {
                    if($dash_count == 1){
                      $degree_title = strtok($education,"-");
                    }else{
                      $degree_title1 = strtok($education,"-");
                      $degree_title2 = strstr($education,"-");
                      $degree_title = $degree_title1."-".strtok($degree_title2,"-");
                    }
                      
                  }else{

                      $degree_title = strtok($education,",");
                      
                  }
                  $data = array("degree_title"=>$degree_title,"start_date"=>"","end_date"=>"","job_title"=>$degree_title,"job_desc"=>$education);
                  $doc_educations[] = $data;
                }
                $doc_educations = json_encode($doc_educations);
              }
              // dd($doc_educations);
              if(!empty($doc_experience)){
                foreach ($doc_experience as $exper) {
                  
                  $data = array("company_title"=>null,"location"=> null,"start_date"=>"","end_date"=>"","job_title"=>null,'job_desc'=>$exper);
                  $doc_experiences[] = $data;
                }
                $doc_experiences = json_encode($doc_experiences);
              }
              if(!empty($doc_membership)){
                foreach ($doc_membership as $membership) {
                  
                  $data = array('title'=>$membership);
                  $doc_memberships[] = $data;
                }
                $doc_memberships = json_encode($doc_memberships);
              }
              if(!empty($doc_award)){
                foreach ($doc_award as $award) {
                  $year = substr($award, strrpos($award, ' ') + 1);
                  $data = array('title'=>$award,"year"=>$year);
                  $doc_awards[] = $data;
                }
                $doc_awards = json_encode($doc_awards);
              }
              if(!empty($doc_online_consultation)){
                foreach ($doc_online_consultation as $consultation){
                    $willing_video = "on";
                    $video_consultation_price = str_replace(array('--',','), "", strstr($consultation,"--"));
                    $video_consultation_price = (int)str_replace(",","",$video_consultation_price);
                    // $video_consultation_price = number_format($video_consultation_price);
                }
              }

              // dd($doc_online_consultation,$doc_experience,$doc_membership,$doc_experience,$doc_education,$doc_disc_columns);
              // $hospital = User::where('',$uniqueid)->first();
              $user_slug = User::where('slug',$slug)->first();
              if($user_slug == null){
              $slug = $slug;
                
              }
              else{
                $slug =$slug."-".strtolower($doc_specialities[0]);
              }
              $user = User::where('unique_id',$uniqueid)->first();
              $lcn_id = Location::where('slug','wazirabad')->pluck('id')->first();
              // dd($user);
              if(empty($user)){
                $user = User::create([
                  'first_name' => $first_name,
                  'last_name' => $last_name,
                  'slug' => $slug,
                  'password' => Hash::make('google'),
                  'location_id' => $lcn_id,
                  'unique_id' => $uniqueid,
                ]);
              }

              $user_meta = UserMeta::where('user_id',$user->id)->first();

              if(empty($user_meta)){
                $userMeta = UserMeta::create([
                'user_id' => $user->id,
                'experiences' => $doc_experiences ?? null,
                'educations' => $doc_educations ?? null,
                'memberships' => $doc_memberships ?? null,
                'awards' => $doc_awards ?? null,
                'wait_time' => str_replace("Wait Time ", "", $wait_time),
                'experience' => str_replace("Experience ", "", $wait_time),
                'verify_registration' => 1,
                'willing_video' => $willing_video,
                'total_experience' => $experience,
                'longitude' => $longitude,
                'latitude' => $latitude,
                'language' => '["english","urdu"]',
                'available_days' => '["mon","tue","wed","thu","fri","sat"]',

                ]);
              }
              if(!empty($doc_specialities)){
                foreach($doc_specialities as $speciality){
                  $speciality_id = Speciality::where('title',$speciality)->pluck('id')->first();
                  if(empty($speciality_id)){
                    $add_speciality = Speciality::create([
                      'title' => $speciality,
                      'slug' => strtolower(str_replace(" ","-",$speciality))
                    ]);
                    $speciality_id = $add_speciality->id;
                  }
                  $check_if_exist = DB::table('user_speciality')->where('user_id', $user->id)->where('speciality_id', $speciality_id)->first();
                  // dd($doc_specialities);

                  if(empty($check_if_exist)){
                     DB::table('user_speciality')->insert([
                      'user_id' => $user->id,
                      'speciality_id' => $speciality_id,
                    ]);
                  }
                }
              }
                    // dd($doc_hopitals);
              if(!empty($doc_hopitals)){
                    $hosp_count = $willing_video == 'on' ? 2 : 1;
                    // dd($hosp_count);
                foreach ($doc_hopitals as $key=>$hosp) {
                    // dd($key);
                    $count = (count($doc_hopitals) - $sidebar_hopital_count) - 1;
                    // dd($sidebar_hopital_count);
                    $hopital_explode = explode('--',$hosp);
                    $hospital_url = reset($hopital_explode);
                    $get_id = explode('/', $hospital_url);
                    $uniquesid = end($get_id);
                    $price = str_replace(array('--',','), "", strstr($hosp,"--"));
                    if($key > $count){
                      // dd($key);
                    $doc_hospital_timings = $this->hospitalTimings($uniquesid,$crawler,$hosp_count);
                    // dd($doc_hospital_timings);
                    if(!empty($doc_hospital_timings)){
                      // dd($doc_hospital_timings);
                      $slots = $this->saveMultipleAppointmentslots($doc_hospital_timings,$price);
                    }
                    $hosp_count++;
                    }else{
                      $doc_hospital_timings = $this->hospitalTimings($uniquesid,$crawler,null);
                      if(!empty($doc_hospital_timings)){
                      $slots = $this->saveAppointmentslots($doc_hospital_timings,$price);
                      }
                    }
                    // dd($slots);
                    $video_consultation_price = (int)str_replace(",","",$video_consultation_price);
                    // dd($uniqueid,'===========',$price);
                    $lcn_id = Location::where('slug','wazirabad')->pluck('id')->first();
                    $hospital = User::where('unique_id',$uniquesid)->where('location_id',$lcn_id)->first();
                    // dd('hospo', $hospital , $user);
                  if(!empty($hospital)){
                    $check_if_exist = Team::where('user_id',$hospital->id)->where('doctor_id',$user->id)->first();
                    if(empty($check_if_exist)){
                      $team = Team::create([
                      'user_id' => $hospital->id,
                      'doctor_id' => $user->id,
                      'price' => $price,
                      'video_consultation_price' => $video_consultation_price,
                      'slots' => $slots,
                      'message' => 'message',
                      'status' => 'approved'
                      ]);
                    }
                  }
                }
              }

               $user->assignRole('doctor');

              return "success";
      
    }
    public function getAllCities(){
      $client = new Client(HttpClient::create(['timeout' => 3600]));
      $url = "https://www.marham.pk/hospitals/wazirabad";
         $data = array();

         $crawler = $client->request('GET',$url);
         
          $allcitiesmarham = array();

          $allcitiesmarham =  $crawler->filter('#cities option')->each(function ($node) {
              return $node->text();
           });
          $allcitiesmarham = array_slice($allcitiesmarham, 1,127);
          $cities = array_unique($allcitiesmarham);

              // dd($allcitiesmarham);
          foreach ($cities as $city) {
             # code...
            $slug = str_slug($city);
            // $slug = array_unique($slug);
            // dd($slug);
              $checkifcity = Location::where('title', $city)->first();
              if(empty($checkifcity)){
                Location::create([
                'title' => $city,
                'slug' => $slug,
                ]);
              }
           } 


           return "done";
    }
    public function getAllAreas(){
      $cities = Location::where('flag','!=','nodatayet')->orWhereNull('flag')->get();
      // dd($cities);
      foreach($cities as $city){
      $client = new Client(HttpClient::create(['timeout' => 3600]));
      $url = "https://oladoc.com/pakistan/$city->slug";
         $data = array();

         $crawler = $client->request('GET',$url);
         
          $allareas = array();

          $allareas =  $crawler->filter('#nearme-doctor .listing_links_holder .city-listing-wrapper .visible-links a')->each(function ($node) {
              // dd($node->text());
              return str_replace("Doctors in ", "", $node->text());
           });
          // dd($allareas);
          $url = "https://www.marham.pk/hospitals/$city->slug";
         $data = array();

         $crawler = $client->request('GET',$url);
         
          $allareasmarham = array();

          $allareasmarham =  $crawler->filter('#areas option')->each(function ($node) {
              return $node->text();
           });

          // $allareasmarham = array_slice($allareasmarham, 2,291);
              // dd($allareasmarham);
          // $allareasmarham = str_replace('0','',$allareasmarham);
          $areas = array_merge($allareas,$allareasmarham);
          // dd($allareas);
          // dd($areas);
          $areas = array_unique($areas);
          // dd($areas);
          $location_id = Location::where('slug',$city->slug)->pluck('id')->first();
          // dd($location_id);
          foreach ($areas as $area) {
             # code...
            $slug = str_slug($area);
            // $slug = array_unique($slug);
            // dd($slug);
              $checkifarea = Area::where('title', $area)->where('location_id',$location_id)->first();
              if(empty($checkifarea)){
                Area::create([
                'title' => $area,
                'location_id' => $location_id,
                'slug' => $slug,
                ]);
              }
           } 


           echo "done";
       }    
    }

    public function findArea($area_string){
      //dd($area_string);
      $areas = Area::pluck('title')->all();
      $matches = [];
      foreach ($areas as $key => $area) {
        // dd($area);
       if(str_contains($area_string, $area)){
          $matches[$area] = $area_string;
        }
      }
      $result = $this->percentageMatches($matches);
      return $result;
    }

    public function percentageMatches($matches){

      $percent;
      $all_matches = [];
      $maxval="";
      $bestmatch= "";
      foreach ($matches as $key => $match) {
        $all_matches[$key] = similar_text($match, $key, $percentage);
      }
      if(count($all_matches) > 0){
      $maxval = max($all_matches);
      $bestmatch = array_search($maxval, $all_matches);
      }
      
      return $bestmatch;
    }

    public function get_lat_long($address) {
     $address = str_replace(" ", "+", trim($address));
     $api_key = "AIzaSyDbkV6AXEXk2KAeFXvUvPcetUMGXyMHOaw";  
      $url = "https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=Pakistan&key=".$api_key;
      // $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');
        // $output= json_decode($url);
        // dd($output);
        // $latitude = $output->results[0]->geometry->location->lat;
        // $longitude = $output->results[0]->geometry->location->lng;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      $response = curl_exec($ch);
      curl_close($ch);
      $response_a = json_decode($response);
      $lat = $response_a->results[0]->geometry->location->lat;
      $long = $response_a->results[0]->geometry->location->lng;
      $direction = array($lat,$long);
      // dd($lat);

       return $direction;
    }

    public function hospitalTimings($hopital_id,$crawler,$count){

      // $get_id = explode('-', $hopital_id);
      // $uniqueid = end($get_id);
      // return $uniqueid;
      $doc_hospital_timings = null;
      if($count == null){

      $doc_hospital_timings = $crawler->filter('#hospital-'.$hopital_id)->filter('.doc-profile-page-content .collapse')->each(function ($node){
                $day = $node->filter('span')->text();
                // dd($day);
            if($day != "Tomorrow" && $day != "Today" && $day != ""){
            // dd($day);
              $doc_timings[$day] = $node->filter('time span')->text();
                return $doc_timings;
              }
      });
      // dd($doc_hospital_timings);
    }else{
      // dd( $crawler->filter('#sidebar-wrapper #date-holder'.$count)->filter('tbody tr')->count());
          $doc_hospital_timings = $crawler->filter('#sidebar-wrapper #date-holder'.$count)->filter('tbody tr')->each(function ($node){
                $day = $node->filter('td')->text();
                $timing_count = $node->filter('time span')->count();
                // dd($timing_count);
            if($day != "Tomorrow" && $day != "Today" && $day != ""){
              if($timing_count > 1){
                $first_child = $node->filter('time span:nth-child(1)')->text() ?? "";
                $second_child = $node->filter('time span:nth-child(2)')->text() ?? "";
                  $doc_timings[$day] = $first_child."__".$second_child;
              }else{
                $doc_timings[$day] = $node->filter('time span')->text();
              }
              // $doc_timings[$day] = $node->filter('time span')->text();
                return $doc_timings;
              }
          });
          // dd($doc_hospital_timings);
    }
        $doc_hospital_timings = array_filter($doc_hospital_timings);
        // dd($doc_hospital_timings);
      return $doc_hospital_timings;
    }

   public function saveAppointmentslots($slots,$price)
    {
      // dd($slots);
        $start_time = [];
        $ending_time = [];
        $request_slots = array();
        $selected_slots = array();
        if(!empty($slots)){
          foreach ($slots as $key => $slot) {
            
            $value = reset($slot);
            // dd($value);
            $day = strtolower(key($slot));
            $get_time = explode(" - ", $value);
            $duration = 20;
            $spaces = 1;
            $start = Carbon::parse($get_time[0]);
            $end = Carbon::parse($get_time[1]);
            $since_start = $start->diff($end);
            if($since_start->i != 0)
                $minutes = ($since_start->h * 60) +$since_start->i;
               else
            $minutes = $since_start->h * 60;
            for($i= 0;$i < $minutes; $i = $i+$duration){
              // if($i == 0){
                $starting_time  = $start;
                $start_time = $starting_time->format('h:i a');
                $end_time = $starting_time->addMinutes($duration);
                $ending_time = $end_time->format('h:i a');
                $selected_slots[$start_time . '-' . $ending_time]['space'] = $spaces;
              }
              $request_slots[$day]['slots'] = $selected_slots;
              $request_slots[$day]['start_end_time'] = $value;
              $request_slots[$day]['start_end_time1'] = '';

                    $request_slots[$day]['consultation_fee'] = $price != ""  ? $price : '';
            }
            // dd($request_slots);
            return json_encode($request_slots, true);
            
          }

          return null;
    }

   public function saveMultipleAppointmentslots($slots,$price){
    // dd($price);
      $start_time = [];
      $ending_time = [];
      $request_slots = array();
      // $selected_slots = array();
      $day_selected_slots = array();
      if(!empty($slots)){
        // dd($slots);
            // $slots = array_slice($slots, 4);
          foreach ($slots as $key => $slot) {
            $day = strtolower(key($slot));
            $value = reset($slot);
            $contain_multiple = str_contains($value, '__');
            $multipleValues = explode("__", $value);
            // dd($contain_multiple);
            // if($contain_multiple == false)
            //   return $this->saveAppointmentslots($slots,$price);
            // dd($multipleValues);
            if($contain_multiple == true){
              $selected_slots = null;
            foreach ($multipleValues as $key => $time) {
               $get_time = explode(" - ", $time);
               $duration = 20;
               $spaces = 1;
               $minutes= 0;
               $start = Carbon::parse($get_time[0]);
               $end = Carbon::parse($get_time[1]);
               $duration = 20;
               $since_start = $start->diff($end);
               // dd($since_start);
               if($since_start->i != 0)
                $minutes = ($since_start->h * 60) +$since_start->i;
               else
               $minutes = $since_start->h * 60;
             // dd($minutes);
               for($i= 0;$i < $minutes; $i = $i+$duration){
                $starting_time  = $start;
                $start_time = $starting_time->format('h:i a');
                $end_time = $starting_time->addMinutes($duration);
                $ending_time = $end_time->format('h:i a');
                $selected_slots[$start_time . '-' . $ending_time]['space'] = $spaces;

                // $day_selected_slots[] = $selected_slots;
              }
            }
          }else{
            // $value = reset($slot);
            // // dd($value);
            // $day = strtolower(key($slot));
            $selected_slots = null;
            $get_time = explode(" - ", $value);
            $duration = 20;
            $spaces = 1;
            $start = Carbon::parse($get_time[0]);
            $end = Carbon::parse($get_time[1]);
            $since_start = $start->diff($end);
            if($since_start->i != 0)
                $minutes = ($since_start->h * 60) +$since_start->i;
               else
            $minutes = $since_start->h * 60;
            for($i= 0;$i < $minutes; $i = $i+$duration){
              // if($i == 0){
                $starting_time  = $start;
                $start_time = $starting_time->format('h:i a');
                $end_time = $starting_time->addMinutes($duration);
                $ending_time = $end_time->format('h:i a');
                $selected_slots[$start_time . '-' . $ending_time]['space'] = $spaces;
              }
             
            }
            $request_slots[$day]['slots'] = $selected_slots;
            // if($day == "wednesday"){
            //   dd($request_slots);
            // }
            // dd($request_slots);
            if(count($multipleValues) > 1){
            $request_slots[$day]['start_end_time'] = $multipleValues[0];
            $request_slots[$day]['start_end_time1'] = end($multipleValues);
            }
            else{
            $request_slots[$day]['start_end_time'] = $value;
              $request_slots[$day]['start_end_time1'] = '';
                $request_slots[$day]['consultation_fee'] = $price != ""  ? $price : '';
            }
          }
              // dd($selected_slots);

          }
          // dd(json_encode($request_slots, true));
          return json_encode($request_slots, true);
          // dd(array_keys($request_slots));
        
        return null;
   }

   public function addMissingOnlineConsultation(){
    $doctors = NewCityScrapping::where('type','doctor')->where('city','karachi')->where('category','!=','')->where('disable',0)->get()->skip(6078);
// dd($doctors);
      // $client = new Client(HttpClient::create(['timeout' => 3600]));
    $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
      $doc_online_consultation = [];
      $doc_hopitals = [];
      $willing_video = "";
      $video_consultation_price = 0;
      if(!empty($doctors)){
        foreach ($doctors as $key=>$doctor) {
          // dd($doctor);
          $get_id = explode('/', $doctor->url);
          $uniqueid = end($get_id);
          $slots = null;
          $crawler = $client->request('GET',$doctor->url);
          $doc_online_consultation = $crawler->filter('.row-wrapper-siderbar #sidebar-wrapper .new-designed-practice-card');
           $doc_online_consultation = $doc_online_consultation->each(function ($node) use ($doc_online_consultation){
            $online_appointment = $node->filter('h3 a')->first()->text();
            // dd($online_appointment);
            $willing_video = 'off';
            if($online_appointment == "Online Video Consultation" || $online_appointment == "oladoc Care Video Consultation" ){
              // dd('abc');
                $willing_video = 'on';
                $video_price = $node->filter('tbody tr td:nth-child(2)')->text();
                return $willing_video."--".str_replace('Rs. ','',$video_price);
              }
            // dd($hosital_price);
              // $doc_hopitals2[] = array('hospital_name'=>$hosital_name,'price'=>$hosital_price);
          });
           $doc_hopitals = $crawler->filter('#other-clinic-detail')->filter('.border-frame');
          // dd($doc_hopitals);
          $doc_hopitals = $doc_hopitals->each(function ($node) use ($doc_hopitals){
            //$hospital_div_id = $node->attr('id') ?? "";
            // dd($hospital_div_id);
            $hosital_name = "";
            if($node->filter('#hospital-8239')->count() > 0){
              $node->filter('div span.doc-profile-page-content')->count() ? $node->filter('div span.doc-profile-page-content')->text(): '0';
              $hosital_price = $node->filter('div span.doc-profile-page-content')->count() ? $node->filter('div span.doc-profile-page-content')->text(): 'Rs. 0';
              return "8239--".str_replace('Rs. ','',$hosital_price);
            }elseif($node->filter('#hospital-4681')->count() > 0){
              
              $node->filter('div span.doc-profile-page-content')->count() ? $node->filter('div span.doc-profile-page-content')->text(): '0';
              $hosital_price = $node->filter('div span.doc-profile-page-content')->count() ? $node->filter('div span.doc-profile-page-content')->text(): 'Rs. 0';
              return "4681--".str_replace('Rs. ','',$hosital_price);

            }
            
            // dd($hosital_price);
              // $doc_hopitals2[] = array('hospital_name'=>$hosital_name,'price'=>$hosital_price);
            return null;
          });
          $doc_online_consultation = array_merge($doc_online_consultation,$doc_hopitals);
          $doc_online_consultation = array_filter($doc_online_consultation);
          // dd($uniqueid);
          $user = User::where('unique_id',$uniqueid)->where('location_id',2)->first();
          // dd($user);
          if(!empty($doc_online_consultation)){
            foreach ($doc_online_consultation as $key => $consultation) {

                    $video_consultation_price = str_replace(array('--',','), "", strstr($consultation,"--"));
            $video_consultation_price = (int)str_replace(",","",$video_consultation_price);

            // dd($video_consultation_price);
              $online_consult_check = OnlineConsultation::where('doctor_id',$user->id)->first();
              if(strtok($consultation,"--") != "on"){
                $doc_online_timings = $this->hospitalTimings(strtok($consultation,"--"),$crawler,null);
                // dd('90890890');
              }else{

              $doc_online_timings = $this->hospitalTimings(1,$crawler,1);
              // dd('saddasd');
              }
              if(!empty($doc_online_timings)){
            // dd($doc_hospital_timings);
                

                $slots = $this->saveMultipleAppointmentslots($doc_online_timings,$video_consultation_price);
              }
              if(empty($online_consult_check)){
                $online = OnlineConsultation::create([
                    'doctor_id' => $user->id,
                    'slots' =>$slots,
                    'price' => $video_consultation_price
                ]);
              }else{
                // dd($slots);
                $online_consult_check->slots = $slots;
                $online_consult_check->save();
              }
                }

          }
           echo $key."======".$doctor->id."=====>".$doctor->url."</br>";
        }
      }

      return "done";
   }

   public function updateExperienceString(){
      $users = UserMeta::where('wait_time','like','%wait%')->get();
      // dd($users);
      foreach ($users as $key => $user) {
        $user->wait_time = str_replace('Wait Time ', '', $user->wait_time);
        $user->save();
      }
      return "Done";
   }

   public function updateTeamSlots(){
    $doctors = NewCityScrapping::where('type','doctor')->where('disable',0)->where('city','=','wazirabad')->get();
    // ->where('id','>',4982)
// dd($doctors);
      // $client = new Client(HttpClient::create(['timeout' => 3600]));
    $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
      $doc_online_consultation = [];
      $doc_hopitals = [];
      $doc_hopitals1 = [];
      $video_consultation_price = 0;
      if(!empty($doctors)){
        foreach ($doctors as $key => $doctor) {
        $willing_video = "off";
           $get_id = explode('/', $doctor->url);
          $uniqueid = end($get_id);
          $user = User::where('unique_id',$uniqueid)->first();
          // dd($user);
          $crawler = $client->request('GET',$doctor->url);
          $doc_hopitals = $crawler->filter('#other-clinic-detail')->filter('.border-frame');
          // dd($doc_hopitals);
          $doc_hopitals = $doc_hopitals->each(function ($node) use ($doc_hopitals){
            //$hospital_div_id = $node->attr('id') ?? "";
            // dd($hospital_div_id);
            $hosital_name = "";
            $hospital_name = $node->filter('.hospital-name')->text();
            if($node->filter('.hospital-name a')->count() > 0){
              $hosital_name = $node->filter('.hospital-name a')->attr('href');
            }else{
              $hospital_name = $node->filter('.hospital-name')->text();
              // dd($hospital_name);
              $last_name = strstr($hospital_name," ");
              $first_name = strtok($hospital_name," ");
              $hospital = User::where('first_name',$first_name)->Where('last_name', 'like', '%' . $last_name . '%')->first();
              if(empty($hospital))
                return null;
              $hospital = NewCityScrapping::where('uniqueid',$hospital->unique_id)->first();
              $hosital_name = $hospital->url;
            }
            $node->filter('div span.doc-profile-page-content')->count() ? $node->filter('div span.doc-profile-page-content')->text(): '0';
            $hosital_price = $node->filter('div span.doc-profile-page-content')->count() ? $node->filter('div span.doc-profile-page-content')->text(): 'Rs. 0';
            if($hospital_name == "Online Video Consultation" || $hospital_name == "oladoc Care Video Consultation"){
                return null;
              }
            // dd($hosital_price);
              // $doc_hopitals2[] = array('hospital_name'=>$hosital_name,'price'=>$hosital_price);
            return $hosital_name."--".str_replace('Rs. ','',$hosital_price);
          });
          // dd($doc_hopitals);
          $doc_hopitals1 = $crawler->filter('.row-wrapper-siderbar #sidebar-wrapper .new-designed-practice-card');
         
          $doc_hopitals1 = $doc_hopitals1->each(function ($node) use ($doc_hopitals1){
            $hosital_name = $node->filter('h3 a')->last()->attr('href');
            $hospital_text = $node->filter('h3 a')->last()->text();
            // return $hosital_name;
            // $hospital_ids = $node->filter('.date-holder')->attr('id');
            // dd($hospital_ids);
            if($hospital_text != "Online Video Consultation" && $hospital_text != "oladoc Care Video Consultation"){
                $hosital_price = !empty($node->filter('tbody tr td:nth-child(2)')->text()) ? $node->filter('tbody tr td:nth-child(2)')->text():0;
                $hosital_price = trim(preg_replace("/\([^)]+\)/","",$hosital_price));

                if(!str_contains($hosital_price,"Rs")){
                 $hosital_price = 0;
                }
            // dd(trim($hosital_price));
            // dd($hosital_name);
            return $hosital_name."--".str_replace('Rs. ','',$hosital_price);
            }
            // dd($doc_specialities);
          });
         $doc_hopitals1 = array_filter($doc_hopitals1);
         $doc_hopitals = array_filter($doc_hopitals);
         // $doc_hopitals = array_merge($doc_hopitals1,$doc_hopitals);
         $sidebar_hopital_count = count($doc_hopitals1);
         $doc_online_consultation = $crawler->filter('.row-wrapper-siderbar #sidebar-wrapper .new-designed-practice-card');
           $doc_online_consultation = $doc_online_consultation->each(function ($node) use ($doc_online_consultation){
            $online_appointment = $node->filter('h3 a')->first()->text();
            // dd($online_appointment);
            $willing_video = 'off';
            if($online_appointment == "Online Video Consultation" || $online_appointment == "oladoc Care Video Consultation" ){
              // dd('abc');
                $willing_video = 'on';
                $video_price = $node->filter('tbody tr td:nth-child(2)')->text();
                return $willing_video."--".str_replace('Rs. ','',$video_price);
              }
            // dd($hosital_price);
              // $doc_hopitals2[] = array('hospital_name'=>$hosital_name,'price'=>$hosital_price);
          });
          $doc_online_consultation = array_filter($doc_online_consultation);
          if(!empty($doc_online_consultation)){
            $willing_video="on";
          }
          // if($user->id == "1058" || $user->id == 1058){
                      
          //             dd($willing_video);
          //           }
          // dd($doc_hopitals,$willing_video);
         if(!empty($doc_hopitals)){
                    $hosp_count = $willing_video == 'on' ? 2 : 1;
                    // dd($hosp_count);
                foreach ($doc_hopitals as $key=>$hosp) {
                    // dd($key);
                    // $count = (count($doc_hopitals) - $sidebar_hopital_count) - 1;
                    // dd($sidebar_hopital_count);
                    $hopital_explode = explode('--',$hosp);
                    $hospital_url = reset($hopital_explode);
                    $get_id = explode('/', $hospital_url);
                    $uniquesid = end($get_id);
                    $price = str_replace(array('--',','), "", strstr($hosp,"--"));
                    $slots = null;
                   
                      $doc_hospital_timings = $this->hospitalTimings($uniquesid,$crawler,null);
                      if(!empty($doc_hospital_timings)){
                      $slots = $this->saveMultipleAppointmentslots($doc_hospital_timings,$price);
                      }
                   
                    // dd($slots);
                    $video_consultation_price = (int)str_replace(",","",$video_consultation_price);
                    $hospital = User::where('unique_id',$uniquesid)->role('hospital')->first();
                    // dd($hospital);
                    $lcn_id = Location::where('slug','wazirabad')->pluck('id')->first();
                  if(!empty($hospital)){
                    $check_if_exist = Team::where('user_id',$hospital->id)->where('doctor_id',$user->id)->first();
                    if(empty($check_if_exist)){
                      $team = Team::create([
                      'user_id' => $hospital->id,
                      'doctor_id' => $user->id,
                      'price' => $price,
                      'video_consultation_price' => $video_consultation_price,
                      'location_id' => $lcn_id,
                      'slots' => $slots,
                      'message' => 'message',
                      'status' => 'approved'
                      ]);
                    }else{
                      $check_if_exist->slots = $slots;
                      $check_if_exist->save();
                    }
                  }
                }
              }

              if(!empty($doc_hopitals1)){
                    $hosp_count = $willing_video == 'on' ? 2 : 1;
                    // dd($hosp_count);
                    
                foreach ($doc_hopitals1 as $key=>$hosp) {
                    // dd($key);
                    // $count = (count($doc_hopitals) - $sidebar_hopital_count) - 1;
                    // dd($sidebar_hopital_count);
                    $hopital_explode = explode('--',$hosp);
                    $hospital_url = reset($hopital_explode);
                    $get_id = explode('/', $hospital_url);
                    $uniquesid = end($get_id);
                    $price = str_replace(array('--',','), "", strstr($hosp,"--"));
                    $slots = null;
                      // dd($key);
                    $doc_hospital_timings = $this->hospitalTimings($uniquesid,$crawler,$hosp_count);
                    // dd($doc_hospital_timings);
                    if(!empty($doc_hospital_timings)){
                      // dd($doc_hospital_timings);
                      $slots = $this->saveMultipleAppointmentslots($doc_hospital_timings,$price);
                    }
                    $hosp_count++;

                    // dd($slots);
                    $video_consultation_price = (int)str_replace(",","",$video_consultation_price);
                    $hospital = User::where('unique_id',$uniquesid)->role('hospital')->first();
                    // dd($hospital);
                    $lcn_id = Location::where('slug','wazirabad')->pluck('id')->first();
                  if(!empty($hospital)){
                    $check_if_exist = Team::where('user_id',$hospital->id)->where('doctor_id',$user->id)->first();
                    if(empty($check_if_exist)){
                      $team = Team::create([
                      'user_id' => $hospital->id,
                      'doctor_id' => $user->id,
                      'price' => $price,
                      'video_consultation_price' => $video_consultation_price,
                      'location_id' => $lcn_id,
                      'slots' => $slots,
                      'message' => 'message',
                      'status' => 'approved'
                      ]);
                    }else{
                      $check_if_exist->slots = $slots;
                      $check_if_exist->save();
                    }
                  }
                }
              }

              echo $doctor->url."========>".$user->id."<br>";
        }
        return "Done";
      }
   }

   public function addlatlng(){
    $doctors = UserMeta::where('latitude','')->where('longitude','')->pluck('user_id');
    $doctors = User::with('doc_teams')->whereIn('id',$doctors)->get();
    // $client = new Client(HttpClient::create(['timeout' => 3600]));
    $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
    $doc_hopitals = [];
    $doc_hopital1 = [];
    // dd($doctors);
    if(!empty($doctors)){
      foreach ($doctors as $key => $doctor) {
          $user_meta = UserMeta::where('user_id',$doctor->id)->first();
          // dd($user_meta);
        $first_hospital = $doctor->doc_teams->first();
        if(!empty($first_hospital)){

          $hospital = User::with('profile')->where('id',$first_hospital->user_id)->first();
          $user_meta->latitude = $hospital->profile->latitude;
          $user_meta->longitude = $hospital->profile->longitude;
          $user_meta->save();
        }
        
        // dd($first_hospital);
      }
    }
      return "done";
   }

   public function updateVideoConsultacyAvailable(){
     $onlines = UserMeta::where('total_experience','like','%Wait Time%')->get();
// dd($onlines);
      if(!empty($onlines)){
        foreach ($onlines as $key => $online) {
          // dd($online);
          $user_meta = UserMeta::where('user_id',$online->user_id)->first();
// dd($user_meta);
          $user_meta->wait_time = str_replace('Wait Time ', "", $user_meta->total_experience);
          // dd($user_meta->wait_time);
          $user_meta->total_experience = "";
          $user_meta->save(); 
          // dd('abc');
        }
      }

      return "Done";
   }

   public function deleteDuplicate(){
    $duplicates = NewCityScrapping::where('city','islamabad')->get();
    if(!empty($duplicates)){
      foreach ($duplicates as $key => $duplicate) {
         $duplicate_row = NewCityScrapping::where('url',$duplicate->url)->where('id','!=',$duplicate->id)->first();
         if(!empty($duplicate_row)){
         echo "duplicate row deleted".$duplicate_row->id;
         $duplicate_row->delete();
       }
      }
    }
    dd('done');
   }

   public function addDiseases(Request $request)
    {
      $url = "https://oladoc.com/pakistan/lahore/condition";
      
      // dd($doctors);
       // $client = new Client(HttpClient::create(['timeout' => 3600]));
      $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
       $all_diseases = [];
        $category = 'Anesthesiologist';
        $speciality = Speciality::where('title',$category)->first();
          $crawler = $client->request('GET',$url);

          $diseases = $crawler->filter(".pr-md-1 .specialization:nth-child(25) .bg-white  a")->each(function ($node) use ($all_diseases){
            // dd($node->text());
            return $node->text();
          });
          $diseases = array_unique($diseases);
          dd($diseases);
        if(!empty($diseases)){

          foreach ($diseases as $key => $disease) {
            $slug = str_replace(array('.',' ',',','(',')','[',']'), '-' , $disease);
            $slug_check = Disease::where('slug',$slug)->first();
            if(!empty($slug_check)){
              $slug = $slug.'-'.strtolower($category);
            }
            Disease::create([
                'title' => $disease,
                'slug' => $slug,
                'parent' => 0,
                'speciality_id' => $speciality->id
            ]);
          }
        }
        dd("done");
      }
  public function getAreas()
    {
      $areas = Area::all();
      if(!empty($areas)){
        foreach ($areas as $key => $area) {
            $area->slug = str_replace(' ', '-', strtolower($area->title));
            $area->save();
        }
      }
      dd('done');
    }
    public function testDetailScraping(){
       // $client = new Client(HttpClient::create(['timeout' => 3600]));
       $client = new Client(HttpClient::create(['verify_peer' => false, 'verify_host' => false]));
      $urls = LabTestScrapping::where('id','>=', 11637)->where('id','<=',12106)->get();
      // dd($urls);

      foreach($urls as $data){
        $get_category = explode("/",$data->url);
        // dd($get_category);
        if($get_category[5] == 'AZ-Diagnostics'){
       $crawler = $client->request('GET',$data->url);
          $test = $crawler->filter(".lab-test-body")->each(function ($node){
            $test_name = $node->filter('.lab-test-title')->first()->text();
            $test_name = str_replace(" at AZ Diagnostics","",$test_name);
            // dd($test_name);
            $count = $node->filter('.lab-test-known-as')->count();
            // dd($count);
            if($count == 1){
            $known_as = $node->filter('.lab-test-known-as')->first()->text() ;
            $known_as = str_replace("Known as: ","",$known_as);
          }
          else{
            $known_as=null;
          }
            $countDiscountedPrice = $node->filter('.lab-test-price')->count();
            $countPrice = $node->filter('.lab-test-actual-price')->count();
            if($countPrice == 1){
            $price = $node->filter('.lab-test-actual-price')->first()->text();
            }
            else{
              $price = null;
            }
            if($countDiscountedPrice == 1){
            $discounted_price = $node->filter('.lab-test-price')->first()->text();
            }
            else{
              $discounted_price = null;
            }
            $price = str_replace("Rs. ","",$price);
            $discounted_price = str_replace("Rs. ","",$discounted_price);
// dd($test_name,$known_as,$discounted_price,$price);
            $check = Speciality_Test::where('lab_id',21624)->where('title',$test_name)->first();
            // dd($check);
            if(empty($check)){
              Speciality_Test::create([
        'title' => $test_name,
        'slug' => \Str::slug($test_name),
        'price' => (int)$price,
        'discounted_price' => (int)$discounted_price, 
        'known_as' => $known_as,
        'lab_id'=> 21624,
        ]);
          echo ' Created'."<br>";

            }
            else{

            Speciality_Test::where('lab_id',21624)->where('title',$test_name)->update([
        'title' => $test_name,
        'slug' => \Str::slug($test_name),
        'price' => (int)$price,
        'discounted_price' => (int)$discounted_price, 
        'known_as' => $known_as,
        'lab_id'=> 21624,
        ]);
          echo 'updated '."<br>";
            }
            
            // dd($test_name);
          });
        }
      }
      dd('done');
    }
    public function labTestScraping()
    {
          $url = "https://instacare.pk/book-tests/lab/innova-labs-and-diagnostics";
          $client = new Client(HttpClient::create(['timeout' => 3600]));
            $crawler = $client->request('GET', $url);
            $test = $crawler->filter(".lab-test-body");

            // Check if there is a "load more" button available
            if ($crawler->filter('.js-load-more-btn')->count() > 0) {
                // Extract the necessary parameters for the AJAX request
                $labUsername = 'ILaD39202251256AMsD6';
                $pageNumber = 332;
                $pageSize = 332;

                // Make the AJAX request to fetch additional data
                $guzzleClient = new GuzzleClient();
                $ajaxUrl = "https://instacare.pk/LabTestPublic/Lab/GetPagedTests?LabUsername=$labUsername&PageNumber=$pageNumber&PageSize=$pageSize";
                $ajaxResponse = $guzzleClient->request('GET', $ajaxUrl);
                $ajaxContent = $ajaxResponse->getBody()->getContents();
                $responseData = json_decode($ajaxContent, true);
                $htmlContent = $responseData['data']['html'];
                $crawler = new Crawler();
                $crawler->addHtmlContent($htmlContent);
                
                $additionalTest = $crawler->filter(".lab-test-body");
                
               
            }
        
          $test = $additionalTest->filter(".lab-test-body")->each(function ($node){
            $test_name = $node->filter('.lab-test-title')->first()->text();
            $test_name = str_replace(" at Innova Labs and Diagnostics","",$test_name);
            $count = $node->filter('.lab-test-known-as')->count();
            // dd($count);
            if($count == 1){
            $known_as = $node->filter('.lab-test-known-as')->first()->text() ;
            $known_as = str_replace("Known as: ","",$known_as);
          }
          else{
            $known_as=null;
          }

             $countPrice = $node->filter('.lab-test-actual-price')->count();
          if($countPrice == 1){
            $price = $node->filter('.lab-test-actual-price')->first()->text();
            $price = str_replace("Rs. ","",$price);

          }
          else{
            $price=null;
          }

          $countDiscountPrice = $node->filter('.lab-test-price')->count();
          if($countDiscountPrice == 1){
            $discounted_price = $node->filter('.lab-test-price')->first()->text();
            $discounted_price = str_replace("Rs. ","",$discounted_price);

          }
          else{
            $discounted_price=null;
          }
            // dd($test_name,$known_as,$discounted_price,$price);
            $speciality=Speciality_Test::where('lab_id',21621)->where('title', $test_name)->first();
            if($speciality != null)
            {
              $speciality->price=$price;
              $speciality->discounted_price=$discounted_price;
              $speciality->known_as=$known_as;
              $speciality->update();
            }
            else
            {
              $lastId = Speciality_Test::orderBy('id', 'desc')->first()->id;
              $lastId = $lastId + 1;
              // $speciality = new Speciality_Test();
              // $speciality->title=$test_name;
              //  $speciality->slug=\Str::slug($test_name);
              // $speciality->price=$price;
              // $speciality->discounted_price=$discounted_price;
              // $speciality->known_as=$known_as;
              // $speciality->lab_id=13416;
              // $speciality->save();
              Speciality_Test::create([
                'id' => $lastId,
                'title' => $test_name,
                'slug' => \Str::slug($test_name),
                'price' => $price,
                'discounted_price' => $discounted_price, 
                'known_as' => $known_as,
                'lab_id'=> 21621
                ]);
            }
            
            // dd($test_name);
          });
       
          
        
        dd('done');
        
        $crawlertwo = $client->request('GET','https://instacare.pk/labstest.xml');
        // dd($crawlertwo);
        $test = $crawlertwo->filter("url")->each(function ($node){
            $url = str_replace(" 2022-10-11 daily 1.0","",$node->text());
               LabTestScrapping::create([
        'url' => $url,
        'status' => 'active'
        ]);
           // dd($scrapper);
            
          });
          dd('done');
      
    }
    public function addLabTestPrice()
    {
      $tests = Speciality_Test::where('price', '>', 0)->get();
      dd($tests);
      foreach ($tests as $test){
    $test->price = $test->discounted_price;
    $test->save();
      }
      dd('done');
    }
    public function addSlug()
    {
      $lab_id = Speciality_Test::where('lab_id', 13083)->get();
      // dd($lab_id);
      // ->where('id','<=', 5627)
      foreach ($lab_id as $lab){
       $lab->lab_id = 13054;
    $lab->save();
      }
      dd('done');
    }
    public function addDiscountedPrice()
    {
      $lab_id = Speciality_Test::where('discounted_price', null)->where('id','>=', 5627)->get();
      // dd($lab_id);
      
      // ->where('id','<=', 5627)
      foreach ($lab_id as $lab){
        $lab->discounted_price = $lab->price - ($lab->price * (20 / 100));
      // dd($lab->discounted_price);
    $lab->save();
      }
      dd('done');
    }
    public function testPrice(){
        $allTests = Speciality_Test::where('price', 0)->get();
        dd($allTests);
        // dd(count($allTests));
        foreach($allTests as $mytest){
        $minPrice = Speciality_Test::where('price', '>', 0)->where('slug', $mytest->slug)->min('discounted_price');
        $maxPrice = Speciality_Test::where('price', '>', 0)->where('slug', $mytest->slug)->max('discounted_price');
        $tests = Speciality_Test::where('price', '>', 0)->where('slug', $mytest->slug)->get();
        // dd($minPrice,$maxPrice);
        

        foreach($tests as $test){
            // dd($test);
            if($minPrice < $maxPrice){

    $test->averagePrice = $minPrice. ' - ' .$maxPrice ;
    // dd($test->averagePrice,'1');
    $test->save();
}
            if($minPrice > $maxPrice){

    $test->averagePrice = $maxPrice. ' - ' .$minPrice ;
    // dd($test->averagePrice,'2');
    $test->save();
}
            if($minPrice === $maxPrice){

    $test->averagePrice = $minPrice ;
    // dd($test->averagePrice,'3');
    $test->save();
}

}
        }
        dd('done');

    }
//     public function pivotData(){
        
//         // dd($pivot);
//         $doctors = User::role('doctor')->with('profile','specialities','services','location','doc_teams','teams','feedbacks','doctorArea')->whereHas('profile', function ($query) { return $query->where('verify_registration', '=', 1);
//     })->limit(10)->get();
//         // dd($doctors);
//         foreach($doctors as $doctor){
//         $specialities = $doctor->specialities->pluck('id');
        

//         // dd($specialities);
//         foreach($specialities as $speciality){
//             $services = Service::where('speciality_id', $speciality)->pluck('id');
//         foreach($services as $service){
//             $pivot= DB::table('user_service')->get();
//             $doctor->services()->sync($service);

//     //         foreach($pivot as $piv){
//     //             $old_des = $piv->user_id;
//     // $piv->user_id = $doctor->id;
//     // $piv->speciality = $speciality;
//     // $piv->save();
//     //         }
//         // echo $speciality."<br>";
//         // echo $doctor->id."========>".$speciality."========>".$service."<br>";
// }
//         }
    
//         // ->pluck('user_id')->toArray();

//             // $area_id = User::whereIn('id',$spec_ids)->pluck('area_id')->toArray();
//             // foreach($area_id as $area){
//             // $pivot = DB::table('doctor_areas')->where('area_id',$area)->where('user_id',$doctor->id)->orderBy('id', 'desc')->get();
//             // if(count($pivot) == 0)
//             // $doctor->doctorArea()->sync($area);
//             // // dd($pivot);
//             // }
//             // $area_id = array_unique($area_id);
//             // if(count($pivot) == 0)
//             // $doctor->doctorArea()->sync($area_id);
//     }
//             dd('done');

//     }
    public function updateSGDloc_id(){
      $doctors = User::where('id','>=',13516)->where('id','<=',13732)->get();
      // dd($doctors);
      foreach ($doctors as $doctor){
        $doctor->location_id = 5;
      // dd($lab->discounted_price);
    $doctor->save();
      }
      dd('done');
    }
    public function updatePINDIloc_id(){
      $doctors = User::where('id','>=',13833)->where('id','<=',14897)->get();
      // dd($doctors);
      foreach ($doctors as $doctor){
        $doctor->location_id = 7;
      // dd($lab->discounted_price);
    $doctor->save();
      }
      dd('done');
    }
    public function updateDoctorStatus(){
      $doctor = User::role('doctor')->where('location_id','=',3)->pluck('id');
      $teams = UserMeta::whereIn('user_id',$doctor)->get();
      // dd($teams);
      foreach($teams as $team){
      $team->verify_registration = 1;
      $team->save();
      echo $team->id."========".$team->verify_registration."<br>";
}
      dd('done');

    }
    public function updatePindiDoctorStatus(){
      $doctor = User::role('hospital')->where('location_id','=',7)->pluck('id');
      // dd($doctor);
      $teams = UserMeta::whereIn('user_id',$doctor)->get();
      foreach($teams as $team){
      $team->verify_registration = 1;
      $team->save();
      echo $team->id."========".$team->verify_registration."<br>";
}
      dd('done');

    }
    public function specialtyFaqAssign(){
        $specialitiesWithFAqs = Disease::with('faqsAssign')->whereHas('faqsAssign')->pluck('id');
        // dd($specialitiesWithFAqs);
        $specialitiesWithoutFAqs = Disease::with('faqsAssign')->whereNotIn('id',$specialitiesWithFAqs)->get();
        // dd($specialitiesWithoutFAqs);
        $id = [7,8,9,10,11];
        $faqs = Faq::whereIn('id',$id)->with('faqAssign')->get();
        // dd($faqs);
        foreach($specialitiesWithoutFAqs as $specialty){
            foreach($faqs as $faq){
            $faqAssign = FaqAssign::where('assign_value',$specialty->id)->where('type','diseases')->where('faq_id',$faq->id)->get();
            if(count($faqAssign) <= 0){
            // dd(count($faqAssign));
             $faqAssign = new FaqAssign();
        $faqAssign->faq_id = $faq->id;
        $faqAssign->assign_value = $specialty->id;
        $faqAssign->type = 'diseases';
        $faqAssign->save();
        }
    }
    }
        echo "done";
    }
}
