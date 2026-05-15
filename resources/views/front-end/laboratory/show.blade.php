@extends('front-end.includes.master')

@if($user && $user->profile && $user->profile->meta_title)
@section('title',$user->profile->meta_title)
@else
@section('title',$user->first_name. ' '. $user->last_name . ' Test Reports, Contact Number, Rates or Price List 2023 - DoctorFindy' )
@endif

@if($user && $user->profile && $user->profile->meta_title)
@section('meta_title',$user->profile->meta_title)
@else
@section('meta_title',$user->first_name. ' '. $user->last_name . ' Test Reports, Contact Number, Rates or Price List 2022 - DoctorFindy' )
@endif

@if($user && $user->profile && $user->profile->meta_keywords)
@section('meta_keywords',$user->profile->meta_keywords)
@else
@section('meta_keywords',$user->first_name. ' '. $user->last_name.' dengue test price, rft test price in pakistan chughtai lab, chughtai lab helpline number, chughtai lab rate list, chughtai lab x ray rates, cbc test price in chughtai lab, chughtai lab phone number, chughtai lab pcr test price lahore')
@endif



@if($user && $user->profile && $user->profile->meta_description)
@section('meta_description',$user->profile->meta_description)
@else
@section('meta_description','Book '. $user->first_name. ' '. $user->last_name . '  online for a dengue test, rft test, sperm test, x-ray, lft test, ultrasound, cbc test, and pcr test at DoctorFindy and get up to 20% off.') 
@endif


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
            :doctorss="{{ json_encode($doctors, true) }}"
            :hospitalss="{{ json_encode($hospitals, true) }}"
            :specialitys = "{{json_encode($specialities, true)}}"
            :servicess = "{{json_encode($services, true)}}"
            :cities = "{{json_encode($locations, true)}}"
            :logged_user = "{{json_encode($logged_user, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :laboratorys="{{ json_encode($laboratories, true) }}"
            :diseasess="{{json_encode($diseases, true) }}"
    ></header-section>
    {{--Header Section End--}}

{{-- Start mobile-fixed-menu Section--}}
    <mobile-fixed-menu-section
    :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
    :managements = "{{json_encode($managements, true)}}">
    </mobile-fixed-menu-section>
    {{--End Start mobile-fixed-menu Section--}}
<!-- Start Section Doctor Hospital Medical Center -->
      @php
            $location = $user->location;
            $area = $user->area;
            
            $user_script_data = Helper::labProfileStructure($user);
            $breadCrumbs_script_data = Helper::breadCrumbsStructure();
            $organizationStructure_script_data = Helper::organizationStructure();
        @endphp
        <div class="container" v-cloak>
              <div class="row">
                    <div class="col-12 mt-4">
                      {{ Breadcrumbs::render('lab-profile', $location,$area,$user) }}
                    </div>
              </div>
        </div>

    <!-- End Section Doctor Hospital Medical Center -->
    <lab-profile
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :user="{{ $user }}"
            :patient="{{ json_encode($logged_user, true) }}"
            :segments="{{ json_encode($segments, true) }}"
    ></lab-profile>
    {{--<all-lab-test-heading
    :tests_count="{{ $testCount }}"
    :user="{{ $user }}"
    ></all-lab-test-heading>--}}
    <!-- Start Procedures of Doctors Hospital -->
    <section class="procedure-doctor-hospital">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 order-xl-1 order-2">

                    <lab-tests-section
                            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
                            :doctorss = "{{json_encode($doctors, true)}}"
                            :hospitalss = "{{json_encode($hospitals, true)}}"
                            :laboratories = "{{json_encode($laboratories, true)}}"
                            :diseasess = "{{json_encode($diseases, true)}}"
                            :specialitys = "{{json_encode($specialities, true)}}"
                            :servicess = "{{json_encode($services, true)}}"
                            :cities = "{{json_encode($locations, true)}}"
                            :managements = "{{json_encode($managements, true)}}"
                            :logged_user = "{{json_encode($logged_user, true)}}"
                            :segments = "{{json_encode($segments, true)}}"
                            :tests = "{{json_encode($tests, true)}}"
                            :symptoms = "{{json_encode($symptoms, true)}}"
                            :user="{{ $user }}"
                            :tests_count="{{ $testCount }}"
                    ></lab-tests-section>
                </div>
                <div class="col-lg-4 col-xs-12 col-sm-12 col-md-12 mt-xl-4 mt-lg-0 order-xl-2 
                order-1">
                    <available-days
                            :user="{{ $user }}"
                    ></available-days>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                 <reviews-section
                            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
                            :user="{{json_encode($user, true)}}"
                            :reviews="{{json_encode($user->feedbacks, true)}}"
                            :patient="{{json_encode($logged_user, true)}}"
                            :type="'laboratory'"
                    ></reviews-section>

                    {{--Gallery Section Start--}}
                    <gallery-section
                            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
                            :user="{{json_encode($user, true)}}"
                            :galleries="{{ json_encode($user->profile->gallery, true) }}"
                    ></gallery-section>
                    {{--Gallery Section End--}}
                        <faq-section
                                :user="{{ $user }}"
                        ></faq-section>
                    <about-doctor
                            :user="{{ $user }}"
                    ></about-doctor>
            </div>
        </div>
    </div>
    <!-- End Procedures of Doctors Hospital -->

    <!-- Start section Other Hospital In Lahore -->
    <other-lab
            :user="{{ json_encode($user, true) }}"
    ></other-lab>
    <!-- End section Other Hospital In Lahore -->

    <!-- Start Section Top Specialist In Doctor Hospital In Lahore -->
    {{--<top-lab
            :laboratories="{{ json_encode($location_top_users, true) }}"
            :user="{{ json_encode($user,true) }}"
    ></top-lab>--}}
    <!-- End Section Top Specialist In Doctor Hospital In Lahore -->
    <section>
        <internal-linking-section
        :similar_speciality="{{json_encode($similar_speciality,true)}}"
        :user="{{json_encode($user,true)}}"
        :labs="{{json_encode($laboratories,true)}}"
        :cities="{{json_encode($cities,true)}}"
        :cities_pakistan="{{json_encode($cities_pakistan,true)}}"
        :specialities="{{json_encode($specialities,true)}}"
        :top_hospitals = "{{json_encode($similar_hospitals, true)}}"
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