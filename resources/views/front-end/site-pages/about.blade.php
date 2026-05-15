@extends('front-end.includes.master')
@section('title','About DoctorFindy') 
@section('meta_title','DoctorFindy Dream') 
@section('meta_description','Basic info About DoctorFindy') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/about-page.min.css') }}" >
       @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
    @endphp
     <style type="text/css">
      [v-cloak] { display: none; }
    </style>
<div id="sitePages">
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
              {{ Breadcrumbs::render('about') }}
            </div>
      </div>
    </div>
<we-are-about-section
></we-are-about-section>
<for-you-about-section :teams = "{{json_encode($teams, true)}}"></for-you-about-section>
    <footer-section
            :locations = "{{json_encode($cities, true)}}"
            :specialities = "{{json_encode($specialities, true)}}"
            :laboratories = "{{json_encode($laboratories, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :top_hospitals = "{{json_encode($hospitals, true)}}"
    ></footer-section>
    {{--Footer Section--}}
</div>
<script type="text/javascript" src="{{asset('js/sitePages.min.js')}}"></script>
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
@endsection