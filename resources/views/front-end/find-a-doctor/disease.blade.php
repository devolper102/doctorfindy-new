@extends('front-end.includes.master')
@section('title','Find Best Doctors For any Disease') 
@section('meta_title','Find Best Doctors by Disease In Pakistan - DoctorFindy') 
@section('meta_description','Find Best Doctors by Disease In Pakistan and Book a Confirmed Appointment online with PMDC verified doctors, surgeons and specialist near you.') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/all-diseses.min.css') }}" >
       @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
        $breadcrumbsdata=Breadcrumbs::generate('diseases');
        
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
       {{--<div class="container" v-cloak>
      <div class="row">
            <div class="col-12 mt-4">
                  {{ Breadcrumbs::render('diseases') }}
            </div>
      </div>
    </div>--}}
    <disease-banner
    :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
    :doctors="{{ json_encode($doctors, true) }}"
    :user = "{{json_encode($logged_user, true)}}"
    :bread_crumb_data = "{{json_encode($breadcrumbsdata, true)}}"
    ></disease-banner>
    <disease-listing
            :specialities="{{ json_encode($specialities, true) }}"
            :cities_pakistan="{{ json_encode($cities_pakistan, true) }}"
            :segments="{{ json_encode($segments, true) }}"
            :cities = "{{json_encode($cities, true)}}"
            :laboratories = "{{json_encode($laboratories, true)}}"
            :top-hospitals = "{{json_encode($hospitals, true)}}"
    ></disease-listing>

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
