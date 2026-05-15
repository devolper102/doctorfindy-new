@extends('front-end.includes.master')
@section('title','Find and Book Best Doctor Online Near You - Doctorfindy') 
@section('meta_title','Find and Book Best Doctor Online Near You - Doctorfindy') 
@section('meta_description','Searching for the best doctor near you in Pakistan? With Doctorfindy, you can find and book any doctors appointment online without any hidden fees.') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/all-specialities.min.css') }}" >
      @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
        $breadcrumbsdata=Breadcrumbs::generate('find-a-doctor-near-you');
    @endphp
    <style type="text/css">
      [v-cloak] { display: none; }
    </style>
<div id="listing">
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
            :cities = "{{json_encode($cities, true)}}"
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
{{--<div class="container" v-cloak>
      <div class="row">
            <div class="col-12 mt-4">
                  {{ Breadcrumbs::render('find-a-doctor-near-you') }}
            </div>
      </div>
    </div>--}}

    {{--Start section top city  doctor in pakistan--}}
    <speciality-banner
    :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
    :doctors="{{ json_encode($doctors, true) }}"
    :user = "{{json_encode($logged_user, true)}}"
    :bread_crumb_data = "{{json_encode($breadcrumbsdata, true)}}"></speciality-banner>
    <speciality-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :type = "'specialties'"
            :segments = "{{ json_encode($segments, true) }}"
            :cities = "{{json_encode($cities, true)}}"
            :specialities = "{{json_encode($specialities, true)}}"
            :labs="{{json_encode($popularLab,true)}}"
            :cities_pakistan="{{ json_encode($cities_pakistan, true) }}"
    ></speciality-section>
    {{--End section top city  doctor in pakistan--}}

    {{--Footer Section--}}
    <footer-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :locations = "{{json_encode($cities, true)}}"
            :specialities = "{{json_encode($specialities, true)}}"
            :laboratories = "{{json_encode($laboratories, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :top_hospitals = "{{json_encode($hospitals, true)}}"
    ></footer-section>
    {{--Footer Section--}}
</div>
<script type="text/javascript" src="{{asset('js/listing.min.js')}}"></script>
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
@endsection