@extends('front-end.includes.master')
@if($procedure && $procedure->meta_title)
@section('title', $procedure->meta_title)
@else
@section('title',$procedure->title.' Cost, Procedure Guideline, Recovery time & Risk | DoctorFindy') 
@endif

@if($procedure && $procedure->meta_title)
@section('meta_title', $procedure->meta_title)
@else
@section('meta_title',$procedure->title.' Cost, Procedure Guideline, Recovery time & Risk | DoctorFindy')
@endif

@section('meta_keywords',$procedure->meta_key)

@if($procedure && $procedure->meta_description)
@section('meta_description', $procedure->meta_description)
@else
@section('meta_description','You can find information regarding '.$procedure->title.' such as best doctor, hospital, cost, recovery time, risk, and complications. Click here for more detail.') 
@endif

@section('content')
<link rel="stylesheet" rel="preload" type="text/css" href="{{ asset('compiled/surgery.min.css') }}" >
       @php
        $breadCrumbs_script_data = Helper::breadCrumbsStructure();
        $organizationStructure_script_data = Helper::organizationStructure();
        
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
            :specialitys = "{{json_encode($specialities, true)}}"
            :cities = "{{json_encode($cities, true)}}"
            :logged_user = "{{json_encode($logged_user, true)}}"
            :managements = "{{json_encode($managements, true)}}"
            :laboratorys="{{ json_encode($laboratories, true) }}"
    ></header-section>
    {{--Header Section End--}}
    {{-- Start mobile-fixed-menu Section--}}
    <mobile-fixed-menu-section
    :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
    :managements = "{{json_encode($managements, true)}}">
    </mobile-fixed-menu-section>
    {{--End Start mobile-fixed-menu Section--}}
    {{--Star  section Coronary Artery Bypass Grafting--}}
    <detail-card
            :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
            :procedure="{{ $procedure }}"
            :hospitals="{{json_encode($hospitals,true)}}"
            :segments="{{ json_encode($segments, true) }}"
    ></detail-card>
      <div class="container" v-cloak>
      <div class="row">
            <div class="col-12 mt-4">
                  {{ Breadcrumbs::render('surgery-city-slug',$location, $procedure) }}
            </div>
            <div class="col-12 mt-4">
                  <h2 class="text-xs-14 text_18">Best Doctors and Hospitals related to {{$procedure->title}}</h2>
                  <lastmod>Last updated on {{Carbon\Carbon::now()->format('l, F j, Y') }}</lastmod>
            </div>
      </div>
    </div>


    {{--End  section Coronary Artery Bypass Grafting --}}


<!-- Tabs -->
<section id="tabs" v-cloak>
    <div class="container">
        <div class="row mt-2">
            <div class="col-xs-12 col-lg-12 p-lg-0">
                <nav class="mb-4">
                    <div class="nav nav-tabs nav-fill procedure_tabs" id="nav-tab" role="tablist">
                        <a class="active text_black text_18 mr-5 border_hover  position-relative d-inline-block p-2" id="nav-home-tab" data-toggle="tab" href="#doctors_tabs" role="tab" aria-controls="nav-home" aria-selected="true"> <i class="fas fa-stethoscope" aria-hidden="true"></i> Doctors</a>
                        <a class="text_black text_18 border_hover  position-relative d-inline-block p-2" data-toggle="tab" href="#hospital_tabs" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-hospital"></i> Hospitals</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="doctors_tabs" role="doctors_tabs" aria-labelledby="doctors-tabs-tab">
                        <!--Star  section trending doctor  -->
                        <related-doctor
                                :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
                                :procedure="{{ $procedure }}"
                                :procedure_doctors="{{ json_encode($procedure_doctors,true) }}"
                                :speciality_id="{{ json_encode($speciality_id,true) }}"
                                :location_id="{{ $location->id }}"
                        ></related-doctor>
                        <!--End  section trending doctor -->

                    </div>
                    <div class="tab-pane fade" id="hospital_tabs" role="hospital_tabs" aria-labelledby="hospital-tabs-tab">
                        <!--Star  section trending hospitals  -->
                        <related-hospital
                                :file-system-driver="{{ json_encode(env('FILESYSTEM_DRIVER')) }}"
                                :procedure="{{ $procedure }}"
                                :patient="{{ json_encode($logged_user, true) }}"
                                :procedure_hospitals="{{ json_encode($procedure_hospitals,true) }}"
                                :speciality_id="{{ json_encode($speciality_id,true) }}"
                                :location_id="{{ $location->id }}"
                        ></related-hospital>
                        <!--End  section trending hospitals -->


                    </div>
                </div>
                <!-- Start section patient-feedback  -->
               <!--  <section class="patient-feedback mb-lg-5 mb-md-5 mb-0" v-cloak>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="heading-box bg-white box_radius box_shadow p-3 p-xs-2 mt-lg-0 mt-3">
                                    <h6 class="font-weight-bold m-0 text_black">
                                        Frequently Asked Questions</h6>
                                    {{--FAQ's Section Start--}}
                                    <faq-section
                                            :faqs="{{ json_encode($procedure->faqs, true) }}"
                                    ></faq-section>
                                    {{--FAQ's Section End--}}
                                </div>
                            </div>
                            <other-section
                                    :users="{{ json_encode($procedure->users, true) }}"
                            ></other-section>
                        </div>
                    </div>
                </section> -->
                <!-- End section patient-feedback  -->


                <!-- Start section procedure list in pakistan -->
                <section class="procedure-list-in-pakistan" v-cloak>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <!-- <div class="heading-procedures-list-pakistan
											mt-4 mb-4 mt-xs-2">
                                    <h4 class="mb-3 text_black mb-xs-2">Procedures list in Pakistan</h4>
                                    <p class="text_black text_14 mb-3 text-justify">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s Lorem Ipsum has been the Ipsum has been
                                        industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since
                                        the 1500s Lorem Ipsum has been the Ipsum has been industry's standard dummy text ever since the 1500s Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s Lorem Ipsum has been the Ipsum has been
                                        industry's standard dummy text ever since the 1500sLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's stan
                                    </p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Start section procedure list in pakistan -->


            </div>
        </div>
    </div>
</section>
<!-- ./Tabs -->
<procedure-detail-faq
 :procedure="{{ json_encode($procedure) }}"
 :faq-pairs="{{ json_encode($faqPairs) }}">
      </procedure-detail-faq>
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