@extends('front-end.includes.master')
@section('title', '('.$get_procedures->procedures->count(). ') Surgeries In '.$get_procedures->title . ' | DoctorFindy')

@section('meta_title', '('.$get_procedures->procedures->count(). ') Surgeries In '.$get_procedures->title . ' | DoctorFindy')

@section('meta_description',$get_procedures->procedures->count(). ' Surgeries and their cost in '.lcfirst($get_procedures->title) . ' | DoctorFindy') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/surgery.min.css') }}" >
       @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
        $breadcrumbsdata=Breadcrumbs::generate('surgery-city',$get_procedures);
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
            :file-system-driver="{{json_encode(env('FILESYSTEM_DRIVER'))}}"
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
    :file-system-driver="{{json_encode(env('FILESYSTEM_DRIVER'))}}"
    :managements = "{{json_encode($managements, true)}}">
    </mobile-fixed-menu-section>
    {{--End Start mobile-fixed-menu Section--}}
    <!-- Start bg list doctor in pakistan  -->
    <banner-section
    :file-system-driver="{{json_encode(env('FILESYSTEM_DRIVER'))}}"
    :managements = "{{json_encode($managements, true)}}"
    :segments="{{ json_encode($segments, true) }}"
    :bread_crumb_data = "{{json_encode($breadcrumbsdata, true)}}"
    ></banner-section>
    <!-- End bg list doctor  pakistan  -->
      <!-- <div class="container" v-cloak>
      <div class="row">
            <div class="col-12 mt-4">
              {{ Breadcrumbs::render('surgery-city', $get_procedures) }}
            </div>
      </div>
    </div> -->

    <!--Star  section procedure cost list in pakistan  -->
    <section class="procedure-cost-list-pakistan">
        <city-procedure-section
                :file-system-driver="{{json_encode(env('FILESYSTEM_DRIVER'))}}"
                :procedures="{{$procedures}}"
                :cities="{{$cities}}"
                :get_procedures="{{$get_procedures}}"
        ></city-procedure-section>
    </section>
    <!--End  section  procedure cost list in pakistan -->

    <!-- Start section top city  doctor in pakistan  -->
    <procedures-section
            :procedures="{{$procedures}}"
            :type="'procedure'"
            :cities="{{json_encode($cities,true)}}"
            :specialities="{{json_encode($specialities,true)}}"
            :labs="{{json_encode($laboratories,true)}}"
            :cities_pakistan="{{json_encode($cities_pakistan,true)}}"
    ></procedures-section>
    <!-- End section top city  doctor in pakistan  -->
    {{--internal Linking Section--}}
      <section>
        <internal-linking-section
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
            :file-system-driver="{{json_encode(env('FILESYSTEM_DRIVER'))}}"
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