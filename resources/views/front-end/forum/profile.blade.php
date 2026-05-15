@extends('front-end.includes.master')
@section('title',$doctor->first_name. ' '. $doctor->last_name.' - '.$doctor->specialities[0]->title.' in '.$doctor->location->title.' | DoctorFindy') 

@section('meta_title',$doctor->first_name. ' '. $doctor->last_name.' - '.$doctor->specialities[0]->title.' in '.$doctor->location->title.' | DoctorFindy')

@section('meta_description', $doctor->first_name. ' '.$doctor->last_name.' is the best '.$doctor->specialities[0]->title.' practicing at '.$doctor->location->title. '. Book appointment online with verified details, timings, fee and address.')

@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/forum-doctor-profile.min.css') }}" >

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
              {{ Breadcrumbs::render('ask-a-doctor-online-profile-name', $doctor) }}
            </div>
      </div>
    </div>

    <!-- Start section doctor following profile  -->
    <doctor-tab
            :user="{{ json_encode($doctor, true) }}"
            :patient = "{{json_encode($logged_user, true)}}"
            :segments="{{json_encode($segments, true) }}"
    ></doctor-tab>
    <!-- End section doctor following profile -->


    <!-- Start section doctor following -->
    <other-doctor
            :doctors="{{ json_encode($doctors, true) }}"
            :patient = "{{ json_encode($logged_user, true) }}"
    ></other-doctor>
    <!-- End section doctor following  -->

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
