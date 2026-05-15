@extends('front-end.includes.master')
@section('title','DoctorFindy for Clinics and Hospitals') 
@section('meta_title','Join DoctorFindy and Connect with Millions of Patients  Online | DoctorFindy') 
@section('meta_description','DoctorFindy for Clinics and Hospitals to Help Patients') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/for-hospital.min.css') }}" >
       @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
    @endphp
     <style type="text/css">
      [v-cloak] { display: none; }
    </style>

<div id="forPage">
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
                  {{ Breadcrumbs::render('for-hospital') }}
            </div>
      </div>
    </div>


    <!-- Start Lab Banner -->
    <for-hospital-banner-section
    :segments="{{json_encode($segments, true) }}"
    :managements = "{{json_encode($managements, true)}}"
    ></for-hospital-banner-section>
    <!-- End Lab Banner -->

    <!--Start Lab benifits Section -->
   <for-hospital-benefits-section></for-hospital-benefits-section>
    <!--End Lab benifits Section -->

    <!--Start Lab DoctorFindy section -->
   <for-hospital-knockdoc-section></for-hospital-knockdoc-section>
    <!--End Lab DoctorFindy section -->

    <!--Start Lab DoctorFindy section -->
   <management-software-section></management-software-section>
    <!--End Lab DoctorFindy section -->

    <!--Start Lab DoctorFindy section -->
   <knocdoc-hospital-section></knocdoc-hospital-section>
    <!--End Lab DoctorFindy section -->

    <!--Start Lab Data Protection section -->
   <for-hospital-protection-section></for-hospital-protection-section>
    <!--End Lab Data Protection section -->

    <!--Start Top Laboratories -->
    <top-hospital-section :hospitals="{{ json_encode($hospitals, true) }}"></top-hospital-section>
    <!--End Top Laboratories -->


    <!--Star section care on the go -->
    <app-section
            :managements = "{{json_encode($managements, true)}}"
    ></app-section>
    <!--End section care on the go -->

    <!--Star section request DoctorFindy demo -->
    <hospital-demo-section></hospital-demo-section>
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
<script type="text/javascript" src="{{asset('js/forPages.min.js')}}"></script>
@endsection