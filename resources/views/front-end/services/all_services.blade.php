@extends('front-end.includes.master')
@section('title','Find a Doctor By Treatments in Pakistan - DoctorFindy') 
@section('meta_title','Find Best Doctors by Treatments In Pakistan - DoctorFindy') 
@section('meta_description','Choose the right doctor, surgeon or physician according to the treatment you need, and book an online appointment with the best doctor in Pakistan.') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/all-services.min.css') }}" >
       @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
        $breadcrumbsdata=Breadcrumbs::generate('treatments');

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
                  {{ Breadcrumbs::render('treatments') }}
            </div>
      </div>
    </div>--}}
     <all-services-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :specialities="{{ json_encode($specialities, true) }}"
            :cities_pakistan="{{ json_encode($cities_pakistan, true) }}"
            :segments="{{ json_encode($segments, true) }}"
            :labs="{{json_encode($laboratories,true)}}"
            :cities="{{json_encode($cities,true)}}"
            :top-hospitals = "{{json_encode($hospitals, true)}}"
            :bread_crumb_data = "{{json_encode($breadcrumbsdata, true)}}"></speciality-banner>

    ></all-services-section>
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
@endsection