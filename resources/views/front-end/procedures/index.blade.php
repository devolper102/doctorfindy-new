@extends('front-end.includes.master')
@section('title','Surgeries Cost, Procedure Guideline, Recovery time & Risk - DoctorFindy') 
@section('meta_title','Surgeries Cost, Procedure Guideline, Recovery time & Risk - DoctorFindy') 
@section('meta_description','You can find information regarding surgeries such as best doctor, hospital, cost, recovery time, risk, and complications. Click here for more detail.') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/surgery.min.css') }}" >
       @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
        $breadcrumbsdata=Breadcrumbs::generate('surgeries');
    @endphp
    <style type="text/css">
      [v-cloak] { display: none; }
    </style>

<div id="procedure">
    <div v-if="loading" id="loader-main">
        <div v-if="loading" id="loader"></div>
    </div>
    {{--Header Section Start--}}
   <header-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
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

    <!-- Start bg list doctor in pakistan  -->
    <banner-section
    :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
    :managements = "{{json_encode($managements, true)}}"
    :segments="{{ json_encode($segments, true) }}"
    :bread_crumb_data = "{{json_encode($breadcrumbsdata, true)}}"
    ></banner-section>
    <!-- End bg list doctor  pakistan  -->
  {{--<div class="container" v-cloak>
      <div class="row">
            <div class="col-12 mt-4">
              {{ Breadcrumbs::render('surgeries') }}
            </div>
      </div>
    </div>--}}
    <!--Star  section procedure cost list in pakistan  -->
    <section class="procedure-cost-list-pakistan">
        <trending-section
                :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
                :procedures="{{$procedures}}"
                :cities="{{$cities}}"
        ></trending-section>
    </section>
    <!--End  section  procedure cost list in pakistan -->

    <!--Star  section trending doctor  -->
        <doctor-section
                :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
                :doctors="{{json_encode($doctors,true)}}"
                :patient="{{json_encode($logged_user, true)}}"
        ></doctor-section>
    <!--End  section trending doctor -->
    <procedures-section
            :procedures="{{$procedures}}"
            :type="'procedure'"
            :cities = "{{json_encode($cities, true)}}"
            :cities_pakistan = "{{json_encode($cities_pakistan, true)}}"
            :specialities = "{{json_encode($specialities, true)}}"
            :labs = "{{json_encode($laboratories, true)}}"
    ></procedures-section>
    <!-- Start section trending hospital in pakistan -->

    <hospital-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :hospitals="{{json_encode($hospitals,true)}}"
            :patient="{{json_encode($logged_user, true)}}"
    ></hospital-section>
    <!-- End section trending hospital in pakistan   -->

     {{--internal Linking Section--}}
      <section>
        <internal-linking-section
        :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
        :related_service="{{json_encode($relatedService,true)}}"
        :related_diseases="{{json_encode($relatedDiseases,true)}}"
        :cities_pakistan="{{ json_encode($cities_pakistan, true) }}"
        :labs="{{json_encode($laboratories,true)}}"
        :cities="{{json_encode($cities,true)}}"
        :specialities="{{json_encode($specialities,true)}}">
        </internal-linking-section>
    </section>
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
<script type="text/javascript" src="{{asset('js/procedure.min.js')}}"></script>
@endsection