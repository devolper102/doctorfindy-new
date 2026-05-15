@extends('front-end.includes.master')
@section('title','Find Doctors, Hospitals and Labs in Pakistan | Book Appointment Online - DoctorFindy') 
@section('meta_title','Find Doctors, Hospitals and Labs in Pakistan | Book Appointment Online - DoctorFindy') 
@section('meta_description','Find the best Doctors, Hospitals and Labs in Pakistan and Book a Confirmed Appointment online with PMDC verified doctors, surgeons and specialist near you.') 
@section('content')
<head>
   <link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/home.min.css') }}" >
 </head>
        @php
            $organizationStructure_script_data = Helper::organizationStructure();
            $filesystemDriver = env('FILESYSTEM_DRIVER');
        @endphp
<div id="home">
     <div v-if="loading" id="loader-main">
        <div v-if="loading" id="loader"></div>
    </div> 
    {{--Banner Section--}}
    <inner-banner-section
            :file-system-driver='@json($filesystemDriver)'
            :doctors = "{{json_encode($doctors, true)}}"
            :hospitals = "{{json_encode($hospitals, true)}}"
            :laboratories = "{{json_encode($laboratories, true)}}"
            :diseases = "{{json_encode($diseases, true)}}"
            :specialities = "{{json_encode($specialities, true)}}"
            :services = "{{json_encode($services, true)}}"
            :cities = "{{json_encode($cities, true)}}"
            :logged_user = "{{json_encode($logged_user, true)}}"
            :managements = "{{json_encode($managements, true)}}"
    ></inner-banner-section>
    {{--End Banner Section--}}
    {{--End mobile fixed--}}
    <mobile-fixed-menu-section
    :file-system-driver='@json($filesystemDriver)'
    :managements = "{{json_encode($managements, true)}}"
    > 
    </mobile-fixed-menu-section>
    {{--End mobile fixed--}}
    {{--Specalities Section Start--}}
    {{--Symptoms Section Start--}}
    <symptoms-section
    :file-system-driver='@json($filesystemDriver)'
    ></symptoms-section>
    {{--Symptoms Section End--}}
    <speciality-section
            :file-system-driver='@json($filesystemDriver)'
            :specialities = "{{json_encode($specialities, true)}}"
    ></speciality-section>
    {{--Specalities Section End--}}
    {{--Start join Doctor Section--}}
    <join-doctor-section
           :file-system-driver='@json($filesystemDriver)'
            :managements = "{{json_encode($managements, true)}}"
    ></join-doctor-section>
    {{--End join Doctor Section--}}
    {{--Top Doctor Hospitals Section Start--}}
    {{--<top-doctor-hospital-section
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :locations = "{{json_encode($cities, true)}}"
    ></top-doctor-hospital-section>--}}
    {{--Top Doctor Hospitals Section End--}}
    {{--Start Surgeries & Procedures--}}
    <surgeries-procedures-section
            :file-system-driver='@json($filesystemDriver)'
            :procedures = "{{json_encode($procedures, true)}}"
    ></surgeries-procedures-section>
    {{--End Surgeries & Procedures--}}
    {{--Start Blogs Section--}}
    <blog-section
            :file-system-driver='@json($filesystemDriver)'
            :articles="{{json_encode($articles, true)}}"
            :patient="{{json_encode($logged_user, true)}}"
    ></blog-section>
    {{--End Blogs Section--}}
    {{--Care ON The Go Section--}}
    <care-on-section
            :file-system-driver='@json($filesystemDriver)'
            :managements = "{{json_encode($managements, true)}}"
    ></care-on-section>
    {{--End Care ON The Go Section--}}
    {{--Start FeedBack Section--}}
    <feedback-section
            :file-system-driver='@json($filesystemDriver)'
            :feedbacks="{{json_encode($feedbacks, true)}}"
    ></feedback-section>
    {{--End FeedBack Section--}}
    {{--Find a Doctor by city--}}
    <doctor-by-city
            :file-system-driver='@json($filesystemDriver)'
            :cities = "{{json_encode($cities, true)}}"
    ></doctor-by-city>
    {{--Find a Doctor by city--}}  
    {{--Footer Section--}}
    <footer-section
    :file-system-driver='@json($filesystemDriver)'
    :locations = "{{json_encode($cities, true)}}"
    :specialities = "{{json_encode($specialities, true)}}"
    :laboratories = "{{json_encode($laboratories, true)}}"
    :top_hospitals = "{{json_encode($hospitals, true)}}"
    :managements = "{{json_encode($managements, true)}}"
    ></footer-section>
    {{--Footer Section--}}
    </div>
    <script src="{{ asset('js/home.min.js') }}" defer></script>
{{-- <script type="text/javascript"  src="{{asset('js/home.min.js')}}" defer></script> --}}
<link rel="stylesheet"href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.5.0/highlight.min.js" async></script>
@endsection