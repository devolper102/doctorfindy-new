@extends('front-end.includes.master')
@section('title','Book Pakistan Best Doctor Online for Video 
Consultation - Doctorfindy') 
@section('meta_title','Book Pakistan Best Doctor Online for Video 
Consultation - Doctorfindy') 
@section('meta_description','Doctorfindy is a leading booking portal that allows you to book Pakistan best doctor online for video consultation according to your comfortable time.')
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/forum.min.css') }}" >
      @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
    @endphp
        <style type="text/css">
      [v-cloak] { display: none; }
    </style>
<div id="doctor">
    <div v-if="loading" id="loader-main">
        <div v-if="loading" id="loader"></div>
    </div>
    {{--Header Section Start--}}
   <header-section
            :doctorss="{{ json_encode($doctors, true) }}"
            :hospitalss="{{ json_encode($hospitals, true) }}"
            :specialitys = "{{json_encode($specialities, true)}}"
            :servicess = "{{json_encode($services, true)}}"
            :cities = "{{json_encode($cities, true)}}"
            :logged_user = "{{json_encode($logged_user, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :laboratorys="{{ json_encode($laboratories, true) }}"
            :diseasess="{{json_encode($diseases, true) }}"
    ></header-section>
    {{--Header Section End--}}
    {{-- Start mobile-fixed-menu Section--}}
    <mobile-fixed-menu-section
    :managements = "{{json_encode($managements, true)}}">
    </mobile-fixed-menu-section>
    {{--End Start mobile-fixed-menu Section--}}
  <div class="container" v-cloak>
      <div class="row">
            <div class="col-12 mt-4">
              {{ Breadcrumbs::render('ask-a-doctor-online') }}
            </div>
      </div>
    </div>
    <home-banner
    :segments="{{json_encode($segments, true) }}"
    :forums="{{json_encode($forums, true) }}"
    ></home-banner>

    <!-- Start section question and active user -->
    <results-nav
            :specialities="{{ $specialities }}"
            :forums="{{ $forums }}"
    ></results-nav>
    <!-- End section question and active user -->

    <!-- Start section procedure answer question -->
    <trending-section
            :specialities="{{ $specialities }}"
    ></trending-section>
    <!-- End section procedure answer question -->

    <!-- Star Section health community center and image -->
    <forum-slider
            :forums="{{ $forums }}"
            :managements = "{{json_encode($managements, true)}}"
    ></forum-slider>
    <!-- End Section health community center and image -->

    <!-- Star Section Online Chat Experience -->
    <question-slider
             :forums = "{{json_encode($forums, true)}}"
    ></question-slider>
    <!-- End Section Online Chat Experience -->
    {{--Footer Section--}}
    <footer-section
            :locations = "{{json_encode($cities, true)}}"
            :specialities = "{{json_encode($specialities, true)}}"
            :laboratories = "{{json_encode($laboratories, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :top_hospitals = "{{json_encode($hospitals, true)}}"
    ></footer-section>
    {{--Footer Section--}}
</div>
<script type="text/javascript" src="{{asset('js/doctor.min.js')}}"></script>
@endsection
