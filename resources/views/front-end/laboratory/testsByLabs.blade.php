@extends('front-end.includes.master')
@if($testsMeta && $testsMeta->meta_title)
@section('title', $testsMeta->meta_title)
@else
@section('title','Find and book best lab for '. $tests[0]->title .' test with DoctorFindy' )
@endif

@if($testsMeta && $testsMeta->meta_title)
@section('meta_title', $testsMeta->meta_title)
@else
@section('meta_title','Find and book best lab for '. $tests[0]->title .' test with DoctorFindy' )
@endif


@section('meta_keywords','Blood Glucose Random, Blood Glucose 
Random report detail, Blood Glucose Random normal range, Blood Glucose Random price 2022' )

@if($testsMeta && $testsMeta->meta_description)
@section('meta_description', $testsMeta->meta_description)
@else
@section('meta_description','DoctorFindy is online booking platform that will help you to find and book the best lab for '. $tests[0]->title .' test at a reasonable price in '. $user->location->title. '. Make a 
booking today and save a lot. ') 
@endif


@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/user-profile.min.css') }}" >
     @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();

        $breadcrumbsdata=Breadcrumbs::generate('tests-by-labs', $tests[0]->slug);
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
                   {{--<div class="container" v-cloak>
                          <div class="row">
                                <div class="col-12 mt-4">
                                  {{ Breadcrumbs::render('tests-by-labs',$tests[0]->slug) }}
                                </div>
                          </div>
                    </div>--}} 

    <!-- End Section Doctor Hospital Medical Center -->
    {{--<lab-testing-section></lab-testing-section>--}}
    <!-- Start Procedures of Doctors Hospital -->
    <section class="procedure-doctor-hospital">
        <search-banner-section
        :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
        :bread_crumb_data="{{json_encode($breadcrumbsdata,true)}}"
        :users="{{json_encode($users, true)}}"
        :tests = "{{json_encode($tests, true)}}"
        ></search-banner-section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <tests-by-labs
                    :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
                    :tests_meta="{{json_encode($testsMeta,true)}}"
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
                :users="{{ $users }}"
                    ></tests-by-labs>

                    

                        
                    
                </div>
                
            </div>
        </div>
    </section>

    {{-- <section class="procedure-doctor-hospital">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <!-- lab Review section -->
                    <lab-review
                    :reviews = "{{json_encode($userfeedback, true)}}"
                    :roles="{{json_encode($user->roles, true)}}"
                    :user="{{json_encode($users, true)}}"
                    ></lab-review>
                    <!-- lab Review section -->
                </div>
            </div>
        </div>
    </section> --}}

    <!-- lab Review section -->
    {{--Start section faqs --}}
    {{-- <section class="collepse-best-doctor-in-pakistan" v-cloak>
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-12 col-lg-12">
                            <lab-faq-section
                            ></lab-faq-section>
                        </div>
                    </div>
                </div>
            </section> --}}
    {{--End section faqs --}}

    <section>
        <blog-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :articles="{{json_encode($articles, true)}}"
            :patient="{{json_encode($logged_user, true)}}"
    ></blog-section>
    </section>
    {{--Start Tags Section --}}
    <section class="collepse-best-doctor-in-pakistan" v-cloak>
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 col-lg-12">
                    <lab-tag-section
                     :cities = "{{json_encode($locations, true)}}"
                    ></lab-tag-section>
                </div>
            </div>
        </div>
    </section>
    {{--End Tags Section --}}

    <!-- End Procedures of Doctors Hospital -->
 {{--Doctors in pakistan--}}
    <section>
        <book-lab-test-linking
        :cities_pakistan="{{ json_encode($cities_pakistan, true) }}"
        :labs="{{json_encode($laboratories,true)}}"
        :cities="{{json_encode($cities,true)}}"
        :specialities="{{json_encode($specialities,true)}}">
        </book-lab-test-linking>
    </section>
    
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