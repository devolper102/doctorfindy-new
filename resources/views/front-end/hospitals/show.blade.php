@extends('front-end.includes.master')
@php
$user_location =  $user->location ? $user->location->title:'lahore';
$default_title = $user->first_name. ' '. $user->last_name.' - Hospital in '.$user_location.' | DoctorFindy';
$default_description = $user->first_name. ' '.$user->last_name.' is a leading hospital in '.$user_location. '. Book appointment online with verified details, timings, address and contact information.';

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
</head>
<body>


<div id="profile">
    <div v-if="loading" id="loader-main">
        <div v-if="loading" id="loader"></div>
    </div>
    {{--Header Section Start--}}
   <header-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :specialitys = "{{json_encode($specialities, true)}}"
            :cities = "{{json_encode($locations, true)}}"
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
            $location = $user->location;
            $area = $user->area;
        @endphp
        <div class="container" v-cloak>
              <div class="row">
                    <div class="col-12 mt-4">
                      {{ Breadcrumbs::render('hospital-profile', $location,$user) }}
                    </div>
              </div>
        </div>

    {{--Hospital Tab Section Start--}}
    <hospital-profile
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :user="{{ json_encode($user, true) }}"
            :patient="{{ json_encode($logged_user, true) }}"
            :segments="{{ json_encode($segments, true) }}"
    ></hospital-profile>
    {{--Hospital Tab Section End--}}
    {{--Hospital Specialties Section Start--}}
    <hospital-specialties
            :user="{{ json_encode($user, true) }}"
    ></hospital-specialties>
    {{--Hospital Specialties Section End--}}
    {{--Hospital Team Section Start--}}
    <hospital-team
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :user="{{ json_encode($user, true) }}"
            :doctors="{{ json_encode($hospital_team, true) }}"
    ></hospital-team>
    {{--Hospital Team Section End--}}


    <!-- Start Procedures of Doctors Hospital -->
    <section class="procedure-doctor-hospital">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <procedure-section
                            :user="{{ json_encode($user, true) }}"
                    ></procedure-section>
                    <reviews-section
                            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
                            :user="{{json_encode($user, true)}}"
                            :reviews="{{json_encode($user->feedbacks, true)}}"
                            :patient="{{json_encode($logged_user, true)}}"
                            :type="'hospital'"
                    ></reviews-section>
                    {{--Gallery Section Start--}}

                    {{--<gallery-section
                            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
                            :user="{{json_encode($user, true)}}"
                            :galleries="{{ json_encode($user->profile->gallery, true) }}"
                    ></gallery-section> --}}
                    {{--Gallery Section End--}}
                    <div class="mt-3 mb-4">
                        <faq-section
                                :user="{{ json_encode($user, true) }}"
                                :hospital-doctors="{{ json_encode($hospital_team,true)}}"
                        ></faq-section>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12 col-sm-12 col-md-12 mt-4 mt-lg-0">
                    <available-days
                            :user="{{ json_encode($user, true) }}"
                    ></available-days>
                   {{-- <about-doctor
                            :user="{{ json_encode($user, true) }}"
                    ></about-doctor> --}}
                </div>
            </div>
        </div>
        <other-hospital
                :hospitals="{{ json_encode($location_users, true) }}"
                :user="{{ json_encode($user, true) }}"
        ></other-hospital>
        @php
        $location_top_users = \App\User::role('hospital')->whereIn('location_id', [$user->location->id])->orderBy("trending","desc")->where('id', '!=', $user->id)->with('location')->limit(15)->get();
        @endphp
        <top-hospital
                :hospitals="{{ json_encode($location_top_users, true) }}"
                :user="{{ json_encode($user, true) }}"
        ></top-hospital>
    </section>
    <!-- End Procedures of Doctors Hospital -->
    <section>
        <internal-linking-section
        :similar_speciality="{{json_encode($similar_speciality,true)}}"
        :user="{{json_encode($user,true)}}"
        :labs="{{json_encode($laboratories,true)}}"
        :cities="{{json_encode($cities,true)}}"
        :cities_pakistan="{{json_encode($cities_pakistan,true)}}"
        :specialities="{{json_encode($specialities,true)}}"
        :top_hospitals = "{{json_encode($location_top_users, true)}}"
        :similar_doctors="{{json_encode($similar_doctors,true)}}"
        :cities_specialities="{{json_encode($city_top_specialities,true)}}"
        >
        </internal-linking-section>
    </section>
    {{--Footer Section--}}
    <footer-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :locations = "{{json_encode($locations, true)}}"
            :specialities = "{{json_encode($specialities, true)}}"
            :laboratories = "{{json_encode($laboratories, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :top_hospitals = "{{json_encode($hospitals, true)}}"
    ></footer-section>
    {{--Footer Section--}}
</div>
<script type="text/javascript" src="{{asset('js/profile.min.js')}}"></script>
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
@endsection