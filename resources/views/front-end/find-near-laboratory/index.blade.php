@extends('front-end.includes.master')
@section('title','Book Lab Test Online With Doctorfindy And Save 30% 
Off.')
@section('meta_title','Book Lab Test Online With Doctorfindy And Save 30% 
Off.') 
@section('meta_keywords','dengue test, rft test, sperm test, x-ray, lft test,ultrasound, CBC test, PCR test, urine test report, Hemoglobin A1C, Thyroid Stimulating Hormone, Prothrombin Time test, lab test price list 2022')
@section('meta_description','With doctorfindy, you can book lab online for all lab test like dengue test, rft test, sperm test, x-ray, lft test, ultrasound, cbc test, and pcr test and and save 30%.') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/find-near-laboratory.min.css') }}" >
    @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();

        if($count > 0)
        {
            $totalTests=$count;
        }
        else
        { 
            $totalTests='';
        }
        $breadcrumbsdata=Breadcrumbs::generate('book-a-lab-test')
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
                  {{ Breadcrumbs::render('book-a-lab-test') }}
            </div>
      </div>
    </div>--}}


    <!-- Start Lab Banner -->
    <lab-banner-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :doctorss = "{{json_encode($doctors, true)}}"
            :hospitalss = "{{json_encode($hospitals, true)}}"
            :laboratories = "{{json_encode($laboratories, true)}}"
            :diseasess = "{{json_encode($diseases, true)}}"
            :specialitys = "{{json_encode($specialities, true)}}"
            :servicess = "{{json_encode($services, true)}}"
            :cities = "{{json_encode($cities, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :logged_user = "{{json_encode($logged_user, true)}}"
            :segments = "{{json_encode($segments, true)}}"
            :tests = "{{json_encode($tests->items(), true)}}"
            :total-tests-data-count="{{json_encode($totalTests,true)}}"
            :symptoms = "{{json_encode($symptoms, true)}}"
            :users = "{{json_encode($users,true)}}"
            :bread_crumb_data="{{json_encode($breadcrumbsdata,true)}}"
    ></lab-banner-section>
    <!-- End Lab Banner -->

    <!-- Top Booked Tests -->
    <top-booked-tests
    ></top-booked-tests>
    <!-- Top Booked Tests -->


 {{--Start section faqs --}}
   {{-- <!-- <section class="collepse-best-doctor-in-pakistan" v-cloak>
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
    </section> -->--}}
    {{--End section faqs --}}

    <!-- {{--Care ON The Go Section--}}
    <care-on-section
            :managements = "{{$managements}}"
    ></care-on-section>
    {{--End Care ON The Go Section--}} -->
    {{--Doctors in pakistan--}}
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
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
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