@extends('front-end.includes.master')
@section('title','Practice as a Doctor | DoctorFindy') 
@section('meta_title','Become a Member of DoctorFindy Doctors Team') 
@section('meta_description','Join Our Community to Help Patients | DoctorFindy') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/for-doctor.min.css') }}" >
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
                  {{ Breadcrumbs::render('practice-as-doctor') }}
            </div>
      </div>
    </div>
<!-- Start section doctoe practice -->
    <banner-section
    :segments="{{json_encode($segments, true) }}"
    :managements = "{{json_encode($managements, true)}}"
    ></banner-section>
    <!-- End section doctoe practice -->
    <!--Star  section benifites DoctorFindy -->
    <benefit-section
            :managements = "{{json_encode($managements, true)}}"
    ></benefit-section>
    <!--End  section benifites DoctorFindy -->
    <!--Star  section signup lorem ipsum -->
    <joining-section></joining-section>
    <!--End  section signup lorem ipsum -->
    <!--Start  section benifits online DoctorFindy profile -->
    <online-benefits-section></online-benefits-section>
    <!--End  section benifits online DoctorFindy profile -->
    <!--Start section data ptotection -->
    <data-protection-section></data-protection-section>
    <!--End  section data ptotection -->
    <!--Star  section doctor video calling -->
    <top-doctor
            :doctors="{{ json_encode($doctors, true) }}"
    ></top-doctor>
    <!--End  section doctor video calling -->
    <!--Star section care on the go -->
    <app-section
            :managements = "{{json_encode($managements, true)}}"
    ></app-section>
    <!--End section care on the go -->
    <!--Star section request DoctorFindy demo -->
    <demo-section></demo-section>
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