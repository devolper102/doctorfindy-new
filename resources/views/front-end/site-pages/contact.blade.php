@extends('front-end.includes.master')
@section('title','Contact Us | DoctorFindy') 
@section('meta_title','Get in touch with DoctorFindy') 
@section('meta_description','Get in touch with DoctorFindy') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/contact-page.min.css') }}" >
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
    <div class="google-map w-md-100 w-100 d-inline-block order-2 order-lg-1">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3404.0339247814863!2d74.26554211451248!3d31.44073298139602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391903c2073fffff%3A0x1d99af38b745985c!2sMsnsoft!5e0!3m2!1sen!2s!4v1602653866997!5m2!1sen!2s" style="border:0;width: 100%;height: 100vh;" allowfullscreen="true" aria-hidden="false" tabindex="0" id="initialize">
        </iframe>
    </div>
    {{-- Start mobile-fixed-menu Section--}}
    <mobile-fixed-menu-section
    :managements = "{{json_encode($managements, true)}}">
    </mobile-fixed-menu-section>
    {{--End Start mobile-fixed-menu Section--}}
      <div class="container" v-cloak>
      <div class="row">
            <div class="col-12 mt-4">
              {{ Breadcrumbs::render('contact') }}
            </div>
      </div>
    </div>
    <div class="container">
        <div class="contact-box w-100 d-inline-block position-relative box_shadow mb-4">
                <get-in-touch-contact-section
                :segments = "{{json_encode($segments, true)}}"
                ></get-in-touch-contact-section>
        </div>
    </div>    

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
<script type="text/javascript" src="{{asset('js/sitePages.min.js')}}"></script>
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
@endsection
