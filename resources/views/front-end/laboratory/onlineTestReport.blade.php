@extends('front-end.includes.master')

@if($lab && $lab->profile && $lab->profile->online_test_report_title != null)
@section('title',$lab->profile->online_test_report_title) 
@else
@section('title',$pageTitle.' Test Report Online') 
@endif

@if($lab && $lab->profile && $lab->profile->online_test_report_title != null)
@section('meta_title',$lab->profile->online_test_report_title) 
@else
@section('meta_title',$pageTitle.' Test Report Online') 
@endif


@if($lab && $lab->profile && $lab->profile->online_test_report_desc != null)
@section('meta_description',$lab->profile->online_test_report_desc) 
@else
@section('meta_description','Find the best Doctors, Hospitals and Labs in Pakistan and Book a Confirmed Appointment online with PMDC verified doctors, surgeons and specialist near you.')  
@endif


@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/user-profile.min.css') }}" >
     @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
    @endphp
    <style type="text/css">
      [v-cloak] { display: none; }
    </style>
<div id="profile">
    <div v-if="loading" id="loader-main">
        <div v-if="loading" id="loader"></div>
    </div>

    {{--Header Section Start--}}
    <header-section
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
     <div class="container" v-cloak>
                          <div class="row">
                                <div class="col-12 mt-4">
                                  {{ Breadcrumbs::render('get-online-test-reports',$slug,$pageTitle) }}
                                </div>
                          </div>
                    </div> 

    <mirror-section
    :lab="{{json_encode($lab,true)}}"
    :page_title="{{json_encode($pageTitle,true)}}"
    ></mirror-section>

      <footer-section
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