@extends('front-end.includes.master')
@section('title','Book A Lab Test | DoctorFindy') 
@section('meta_title','Book a Test online | DoctorFindy') 
@section('meta_description','Book a Test online | DoctorFindy') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/find-near-laboratory.min.css') }}" >
       @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
    @endphp
     <style type="text/css">
      [v-cloak] { display: none; }
    </style>
<div id="nearLab">
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
                  {{ Breadcrumbs::render('book-a-lab-test') }}
            </div>
      </div>
    </div>


    <!-- Start Lab Banner -->
    <lab-test-in-city
            :doctorss = "{{json_encode($doctors, true)}}"
            :hospitalss = "{{json_encode($hospitals, true)}}"
            :laboratories = "{{json_encode($laboratories, true)}}"
            :diseasess = "{{json_encode($diseases, true)}}"
            :specialitys = "{{json_encode($specialities, true)}}"
            :servicess = "{{json_encode($services, true)}}"
            :cities = "{{json_encode($cities, true)}}"
            :search-city="{{json_encode($city,true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :logged_user = "{{json_encode($logged_user, true)}}"
            :segments = "{{json_encode($segments, true)}}"
            :tests = "{{json_encode($tests, true)}}"
            :symptoms = "{{json_encode($symptoms, true)}}"
            :users = "{{json_encode($users,true)}}"
    ></lab-test-in-city>
    <!-- End Lab Banner -->

    <!-- Top Booked Tests -->
    <top-booked-tests
    ></top-booked-tests>
    <!-- Top Booked Tests -->


 {{--Start section faqs --}}
    <!-- <section class="collepse-best-doctor-in-pakistan" v-cloak>
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 col-lg-12">
                    <div class="heading-box box_shadow p-3 w-100 box_radius">
                        <h6 class="font-weight-bold text_black">
                            Frequently Asked Questions</h6>
                        <faq-section
                                :faqs="{{ $allfaqs }}"
                        ></faq-section>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    {{--End section faqs --}}

    <!-- {{--Care ON The Go Section--}}
    <care-on-section
            :managements = "{{$managements}}"
    ></care-on-section>
    {{--End Care ON The Go Section--}} -->
    {{--internal Linking Section--}}
      <section>
        <internal-linking-section
        :cities_pakistan="{{ json_encode($cities_pakistan, true) }}"
        :labs="{{json_encode($laboratories,true)}}"
        :cities="{{json_encode($cities,true)}}"
        :specialities="{{json_encode($specialities,true)}}">
        </internal-linking-section>
    </section>
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
<script type="text/javascript" src="{{asset('js/laboratory.min.js')}}"></script>
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
@endsection