@extends('front-end.includes.master')
@section('title')
    @if ($user->first_name === 'Citilab and' && $user->last_name === 'Research Centre')
        Save 25% on {{ $tests->title }} test at {{ $user->first_name }} {{ $user->last_name }} - DoctorFindy
    @else
        Save 20% on {{ $tests->title }} test at {{ $user->first_name }} {{ $user->last_name }} - DoctorFindy
    @endif
@endsection

@section('meta_title','Save 20% on '.$tests->title.' test at '.$user->first_name. ' '. $user->last_name . ' '.'- DoctorFindy' )

@section('meta_keywords','pcr test price in pakistan chughtai lab,chughtai lab test rates, chughtai lab contact number, chughtai lab test price list, 
Blood Glucose Random Test, chughtai lab lft test price, chughtai lab sperm test rates, chughtai lab ultrasound price, chughtai lab Sargodha.')

@section('meta_description','Book your '. $tests->title .' test with DoctorFindy and receive a 20% discount at  '. $user->first_name. ' '. $user->last_name .'. Schedule an appointment today!') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/user-profile.min.css') }}" >
     @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
    @endphp
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
                    @endphp
                    <div class="container" v-cloak>
                          <div class="row">
                                <div class="col-12 mt-4">
                                  {{ Breadcrumbs::render('test-detail',$location->slug,$user->slug,$tests->slug) }}
                                </div>
                          </div>
                    </div> 

    <!-- End Section Doctor Hospital Medical Center -->
    <!-- Start Procedures of Doctors Hospital -->
    <section class="procedure-doctor-hospital">
        <div class="container">
            <div class="row">
                <div class="col-12">

                     {{-- <lab-test-detail
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
                    ></lab-test-detail> --}}

                    <lab-testing-section
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
                            :lab_tests="{{json_encode($labTests,true)}}"></lab-testing-section>

                    

                        
                    
                </div>
                
            </div>
        </div>
    </section>
    <!-- End Procedures of Doctors Hospital -->
    {{--Doctors in pakistan--}}
    {{--<section>
        <book-lab-test-linking
        :cities_pakistan="{{ json_encode($cities_pakistan, true) }}"
        :labs="{{json_encode($laboratories,true)}}"
        :cities="{{json_encode($cities,true)}}"
        :specialities="{{json_encode($specialities,true)}}">
        </book-lab-test-linking>
    </section>--}}
    
    <!-- End Section Top Specialist In Doctor Hospital In Lahore -->
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
@endsection