@extends('front-end.includes.master')
@php
$user_location =  $user->location ? $user->location->title:'lahore';
$default_title = $user->first_name. ' '. $user->last_name.' - '.$user->specialities[0]->title.' in '.$user_location.' | DoctorFindy';
$default_description = $user->first_name. ' '.$user->last_name.' is the best '.$user->specialities[0]->title.' practicing at '.$user_location. '. Book appointment online with verified details, timings, fee and address.';

// Check if profile exists and has meta_title/meta_description values
$meta_title = $default_title;
$meta_description = $default_description;

if ($user->profile) {
    if (isset($user->profile->meta_title) && trim($user->profile->meta_title) !== '') {
        $meta_title = $user->profile->meta_title;
    }
    if (isset($user->profile->meta_description) && trim($user->profile->meta_description) !== '') {
        $meta_description = $user->profile->meta_description;
    }
}
@endphp
@section('title', $meta_title)  


@section('meta_title', $meta_title)

@section('meta_description', $meta_description)

@section('meta_image', env('APP_URL').'/uploads/users/'.$user->id.'/small-'.$user->profile->avatar) 

@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/user-profile.min.css') }}" >
    <style type="text/css">
      [v-cloak] { display: none; }
    </style>
<div id="profile">
     <div v-if="loading" id="loader-main">
        <div v-if="loading" id="loader"></div>
    </div> 
    <section class="doctor_profile">
        {{--Header Section Start--}}
   <header-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :specialitys = "{{json_encode($specialities, true)}}"
            :cities = "{{json_encode($cities, true)}}"
            :logged_user = "{{json_encode($logged_user, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :laboratorys="{{ json_encode($laboratories, true) }}"
    ></header-section>
        {{--Header Section End--}}
        {{-- Start mobile-fixed-menu Section--}}
    <mobile-fixed-menu-section
    :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
    :managements = "{{json_encode($managements, true)}}">
    </mobile-fixed-menu-section>
    {{--End Start mobile-fixed-menu Section--}}
        @php
            $doctor_fee=0;
            $location = $user->location;
            $speciality = $user->specialities->first();
            $doc_price = $user->doc_teams->min('price');
            if(count($user->doc_teams) > 0 &&  $user->doc_teams[0] && $user->doc_teams[0]->slots){
            $slots = json_decode($user->doc_teams[0]->slots);
            if(isset($slots->days)){
            $doctor_fee= $slots->consultation_fee;
        }
        else{
           $doctor_fee=  $doc_price ?? 0;
        }

            $doc_fee = $doctor_fee ?? 0;

        }else{
            $doc_fee = $doc_price ?? 0;
        }

        $speciality_id=$user->specialities[0]->id;
        $speciality_data=\App\Speciality::where('id',$speciality_id)->select('id')->with('services',function($q) use($speciality_id){
                            return $q->where('speciality_id',$speciality_id)->select('id','title','slug','speciality_id')->take(9);
                        })->first();

        @endphp
        <div class="container" v-cloak>
              <div class="row">
                    <div class="col-12 mt-2">
                      {{ Breadcrumbs::render('doctor-profile', $location,$speciality,$user) }}
                    </div>
              </div>
        </div>

        <profile-page
                :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
                :user="{{ json_encode($user, true) }}"
                :hoptis="{{ json_encode($user_hospitals, true) }}"
                :patient="{{json_encode($logged_user, true)}}"
                :segments="{{json_encode($segments, true)}}"
                :fee = "{{$doc_fee ?? 0}}"
        ></profile-page>
       <div class="container">
        <div class="row">
            <div class="col-12">
                {{--Reviews Section Start--}}
                    <reviews-section
                            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
                            :user="{{json_encode($user, true)}}"
                            :reviews="{{json_encode($user->feedbacks, true)}}"
                            :patient="{{json_encode($logged_user, true)}}"
                            :type="'doctor'"
                    ></reviews-section>
                    {{--Reviews Section End--}}
            </div>
        </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                    
                    {{--Specialties Section Start--}}
                    <spec-section
                            :user="{{json_encode($user, true)}}"
                    ></spec-section>
                    {{--Specialties Section End--}}
                    <?php
                        if($user_services->isEmpty())
                        {

                           $user_services=$speciality_data->services;
                            if($user_services->isEmpty())
                            {
                               $user_services=\App\Disease::select('id','title','slug','speciality_id')->take(9)->inRandomOrder()->get(); 
                            } 
                        }
                        
                    ?>
                    <services-section
                        :user="{{json_encode($user, true)}}"
                        :services = "{{json_encode($user_services, true)}}"
                        :specialities = "{{json_encode($specialities, true)}}"
                    ></services-section>
                    {{--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-4 d-xs-inline-block d-sm-inline-block d-md-inline-block d-lg-none">
                        <div class="feedback-btn text-center">
                            <a class="btn_padding text-white rounded-pill text_15 d-inline-block knockdoc_btn_bg" href="#">View more doctors</a>
                        </div>
                    </div>--}}
                    {{--Disease Section Start--}}
                    <disease-section
                            :specialities = "{{json_encode($specialities, true)}}"
                            :user="{{ json_encode($user, true) }}"
                            :diseases="{{json_encode($user_diseases, true) }}"
                    ></disease-section>
                    {{--Disease Section End--}}
                    {{--Gallery Section Start--}}
                    <gallery-section
                            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
                            :user="{{json_encode($user, true)}}"
                            :galleries="{{ json_encode($user->profile->gallery, true) }}"
                            :galleryvideos = "{{ json_encode($user->profile->gallery_videos, true) }}"
                    ></gallery-section>
                    {{--Gallery Section End--}}
                    {{--About Doctor Section Start--}}
                    {{--<about-doctor
                            :user="{{ json_encode($user, true) }}"  
                    ></about-doctor>--}}
                    {{--About Doctor Section End--}}


                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 mt-xs-3 mt-sm-3 mt-md-3 mt-lg-0">
                    {{--Work & Experience Section Start--}}
                    <work-experience
                            :user="{{json_encode($user, true)}}"
                    ></work-experience>
                    {{--Work & Experience Section End--}}
                    {{--Education Section Start--}}
                    <education-section
                            :user="{{ json_encode($user, true) }}"
                    ></education-section>
                    {{--Education Section End--}}
                    {{--Award Section Start--}}
                    <award-section
                            :user="{{ json_encode($user, true) }}"
                    ></award-section>
                    {{--Award Section End--}}
                    {{--Membership Section Start--}}
                    <membership-section
                            :user="{{ json_encode($user, true) }}"
                    ></membership-section>
                    {{--Membership Section End--}}
                    {{--Languages Section Start--}}
                    {{--<language-sec
                    :user="{{ json_encode($user, true) }}"
                    ></language-sec>--}}
                    {{--Languages Section End--}}
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    {{--FAQ's Section Start--}}
                    <faq-section
                            :user="{{ json_encode($user, true) }}"
                            :fee = "{{$doc_fee}}"
                            :hospitals="{{ json_encode($user_hospitals, true) }}"
                            :services = "{{json_encode($user_services, true)}}"
                    ></faq-section>
                    {{--FAQ's Section End--}}
                </div>
            </div>
        </div>
                {{--Other Doctor Section Start--}}
        <?php
                        // Get similar doctors with same speciality and same location (city), excluding current doctor
                        $doctors = $speciality->similarUsersWithRelations()
                            ->where('users.location_id', $user->location_id)
                            ->where('users.id', '!=', $user->id)
                            ->whereHas('roles', function($q) {
                                $q->where('name', 'doctor');
                            })
                            ->limit(4)
                            ->get();
        ?>
        <other-doctor
                :doctors="{{ json_encode($doctors, true) }}"
                :user="{{ json_encode($user, true) }}"
        ></other-doctor>
        {{--Other Doctor Section End--}}
    </section>
    <section>
        <internal-linking-section
        :similar_speciality="{{json_encode($similar_speciality,true)}}"
        :user="{{json_encode($user,true)}}"
        :labs="{{json_encode($laboratories,true)}}"
        :cities="{{json_encode($cities,true)}}"
        :cities_specialities="{{json_encode($city_top_specialities,true)}}"
        :cities_pakistan="{{json_encode($cities_pakistan,true)}}"
        :specialities="{{json_encode($specialities,true)}}"
        :top_hospitals = "{{json_encode($similar_hospitals, true)}}"
        :similar_doctors="{{json_encode($doctors,true)}}"
        >
        </internal-linking-section>
    </section>

    {{--Footer Section--}}
    <footer-section
            :locations = "{{json_encode($locations, true)}}"
            :specialities = "{{json_encode($specialities, true)}}"
            :laboratories = "{{json_encode($laboratories, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :top_hospitals = "{{json_encode($hospitals, true)}}"
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
    ></footer-section>
    {{--Footer Section--}}
</div>
<script type="text/javascript" src="{{asset('js/profile.min.js')}}"></script>
    @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
    @endphp
<link defer rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css">
<script defer src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
@endsection