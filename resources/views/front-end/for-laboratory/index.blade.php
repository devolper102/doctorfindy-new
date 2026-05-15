@extends('front-end.includes.master')
@section('title','DoctorFindy for Labs') 
@section('meta_title','Benifits of DoctorFindy for Labs | DoctorFindy') 
@section('meta_description','Join DoctorFindy and Connect with Millions of patients, access and manage your account from anywhere any time') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/for-lab.min.css') }}" >
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
                  {{ Breadcrumbs::render('for-lab') }}
            </div>
      </div>
    </div>



    <!-- Start Lab Banner -->
    <lab-banner-section
    :segments="{{json_encode($segments, true) }}"
    ></lab-banner-section>
    <!-- End Lab Banner -->

    <!--Start Lab benifits Section -->
   <lab-benefits-section></lab-benefits-section>
    <!--End Lab benifits Section -->

    <!--Start Lab DoctorFindy section -->
   <lab-knockdoc-section></lab-knockdoc-section>
    <!--End Lab DoctorFindy section -->

    <!--Start Lab Data Protection section -->
   <lab-protection-section></lab-protection-section>
    <!--End Lab Data Protection section -->

    <!--Start Top Laboratories -->
    <top-laboratory-section :laboratories="{{ json_encode($laboratories, true) }}"></top-laboratory-section>
    <!--End Top Laboratories -->

    <app-section
            :managements = "{{json_encode($managements, true)}}"
    ></app-section>
    <!--End section care on the go -->

    <!--Star section request DoctorFindy demo -->
    <lab-demo-section></lab-demo-section>
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