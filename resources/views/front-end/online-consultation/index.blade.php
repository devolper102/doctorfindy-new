@extends('front-end.includes.master')
@section('title','Consult A Specialist Doctor Online | Audio/Video Call | DoctorFindy') 
@section('meta_title','Consult A Specialist Doctor Online | Audio/Video Call | DoctorFindy') 
@section('meta_description','Consult with a doctor about your health online | DoctorFindy') 
@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/online-video-consultation.min.css') }}" >
       @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
    @endphp
      <style type="text/css">
      [v-cloak] { display: none; }
    </style>

<div id="videoConsultation">
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
                  {{ Breadcrumbs::render('online-doctor-video-consultation-in-pakistan') }}
            </div>
      </div>
    </div>
    
    <banner-section
            :doctorss="{{ json_encode($doctors, true) }}"
            :hospitalss="{{ json_encode($hospitals, true) }}"
            :specialitys = "{{json_encode($specialities, true)}}"
            :servicess = "{{json_encode($services, true)}}"
            :cities = "{{json_encode($cities, true)}}"
            :logged_user = "{{json_encode($logged_user, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :laboratorys="{{ json_encode($laboratories, true) }}"
            :diseasess="{{json_encode($diseases, true) }}"
    ></banner-section>

    <!-- Start Section Doctor Views -->
    <result-section
            patients="{{$allpatients}}"
            doctors="{{$alldoctor}}"
            specialities="{{$allspecialities}}"
            consultations="{{$consultations}}"
    ></result-section>
    <!-- End Section Doctor Views -->

    <!-- Start Section Doctor Video Calling -->
    <div class="video_calling_section">
        <top-doctor-section
            :doctors="{{ json_encode($doctors, true) }}"
        ></top-doctor-section>
    </div>
    <!-- End Section Doctor Video Calling -->

    <!-- Start Section Doctor Specialities -->
    <speciality-section
            :specialities="{{json_encode($specialities, true)}}"
    ></speciality-section>
    <!-- End Section Doctor Specialities -->

    <!-- Star Section Doctor how it work -->
    <how-it-section></how-it-section>
    <!-- End Section Doctor how it work -->

    <!-- Star Section Benefits Online Consultation -->
    <benefits-section></benefits-section>
    <!-- End Section benefits Online consultation -->

    <!-- Start Section  Health Problem In Pakistan-->
    <common-health-problem-section
            :allarticles="{{json_encode($articles, true)}}"
    ></common-health-problem-section>
    <!-- End Section Health Problem In Pakistan -->

    <!-- Start Section  Doctors Blog and Tips-->
    <doctor-blogs-tips-section
            :allblogs="{{json_encode($blogs, true)}}"
    ></doctor-blogs-tips-section>
    <!-- End Section Doctors Blog and Tips -->

    <!-- Star Section Online Chat Experience -->
    <online-chat-experience
            :reviews="{{ json_encode($reviews, true) }}"
    ></online-chat-experience>
    <!-- End Section Online Chat Experience -->

   {{--Start section faqs --}}
    <section class="collepse-best-doctor-in-pakistan" v-cloak>
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
    </section>
    {{--End section faqs --}}

    {{--Care ON The Go Section--}}
    <care-on-section
            :managements = "{{$managements}}"
    ></care-on-section>
    {{--End Care ON The Go Section--}}

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
<script type="text/javascript" src="{{asset('js/videoConsultation.min.js')}}"></script>
<link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js"></script>
@endsection