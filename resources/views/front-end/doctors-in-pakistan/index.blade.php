@extends('front-end.includes.master')
@section('title','Find '.$all_doctors_count.'+ verified doctors near you across Pakistan.') 
@section('meta_title','Find '.$all_doctors_count.'+ verified doctors near you across Pakistan.') 
@section('meta_description','Looking for best doctor in Pakistan? Doctorfindy will help you to find '.$all_doctors_count.'+ verified doctors and book their appointment online at reasonable price.') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/doctors-pakistan.min.css') }}" >
       @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
        $breadcrumbsdata=Breadcrumbs::generate('doctors');

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
   :managements = "{{json_encode($managements, true)}}"
    > 
    </mobile-fixed-menu-section>
    {{--End Start mobile-fixed-menu Section--}}
     {{--Start bg list doctor in pakistan --}}
    <banner
    :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
    :managements = "{{json_encode($managements, true)}}"
    :segments = "{{json_encode($segments, true)}}"
    :bread_crumb_data="{{json_encode($breadcrumbsdata,true)}}"
    ></banner>
      <!-- <div class="container" v-cloak>
      <div class="row">
            <div class="col-12 mt-4">
                  {{ Breadcrumbs::render('doctors') }}
            </div>
      </div>
    </div> -->
     {{--End bg list doctor in pakistan--}}
     {{--Start section top city and trending doctor in pakistan--}}
    <trending-cities
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :locations = "{{json_encode($cities, true)}}"
            :doctors = "{{json_encode($doctors, true)}}"
            :managements = "{{json_encode($managements, true)}}"
    ></trending-cities>
     {{--End section top city and trending doctor in pakistan--}}
     {{--Start section top city  doctor in pakistan--}}
    <location-section

            :type = "'location'"
            :procedures = "{{json_encode($cities, true)}}"
    ></location-section>
     {{--End section top city  doctor in pakistan--}}
     {{--Start section collepse best doctor in pakistan--}}
    {{--<section class="collepse-best-doctor-in-pakistan" v-cloak>
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 col-lg-12">
                    <div class="heading-box box_shadow p-3 w-100 box_radius">
                        <h6 class="font-weight-bold text_black">
                            Frequently Asked Questions</h6>
                        <faq-section
                                :faqs="{{ $faqs }}"
                        ></faq-section>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
    {{--End section collepse best doctor in pakistan--}}

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
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
@endsection
