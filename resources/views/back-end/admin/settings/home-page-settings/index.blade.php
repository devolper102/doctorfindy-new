@extends('back-end.master')
@section('content')
@include('includes.pre-loader')
<div class="dc-haslayout dc-manage-account la-setting-holder" id="settings">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="dc-dashboardbox dc-dashboardtabsholder dc-accountsettingholder">
                <div class="dc-dashboardtabs">
                    <ul class="dc-tabstitle nav navbar-nav">
                       
                        <li class="nav-item">
                            <a class="{{{ \Request::route()->getName() <> 'homeServicesSection'? 'active': '' }}}" data-toggle="tab" href="#dc-search-banner-settings">{{ trans('lang.search_banner_section') }}</a>
                        </li>
                         <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-slider">{{ trans('Search Banner  Slides') }}</a>
                        </li>
                         <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-about-us-settings">{{ trans('Are you a Doctor Section') }}</a>
                        </li>
                          <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-app-section-settings">{{ trans('lang.download_app_section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-how-works-settings">{{ trans('Subscribe Now Section') }}</a>
                        </li>
                          <li class="nav-item">
                            <a class="" data-toggle="tab" href="#small-devices-top-section">{{ trans('Small Devices Top Section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#how-it-works-tabs">{{ trans('How it Works') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="{{{ \Request::route()->getName()==='homeServicesSection'? 'active': '' }}}" href="{{{ route('homeServicesSection') }}}">{{ trans('Benefits of DoctorFindy') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#banner_video_section">{{ trans('Practice Doctor Banner Section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#for_doctor_sign_up">{{ trans('For Doctor-Sign Up') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#benefits-online-profile">{{ trans('Benefits of Online DoctorFindy Profile') }}</a>
                        </li>
                         <li class="nav-item">
                            <a class="" data-toggle="tab" href="#benefits-online-doctor">{{ trans('Benefits of Online Consultation a Doctor') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-article-section">{{ trans('Data Protection') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#sign_up_section">{{ trans('Sign Up/In Section') }}</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#map_image">{{ trans('Map Image') }}</a>
                        </li>
                         <li class="nav-item">
                            <a class="" data-toggle="tab" href="#onlin_video_section">{{ trans('Online Video Consultation Banner Section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#procedure_banner_section">{{ trans('Procedure Banner Section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#city_wise_doctor_section">{{ trans('City wise Doctor Banner Section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#city_wise_hospital_section">{{ trans('City wise Hospital Banner Section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#header-services-section">{{ trans('Header Services') }}</a>
                        </li>
                         <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-health-community">{{ trans('Health Community Banner Section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#health-community-slider">{{ trans('Health Community Slider') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-health-discussion">{{ trans('Health Discussion Banner Section') }}</a>
                        </li>
                         <li class="nav-item">
                            <a class="" data-toggle="tab" href="#list-doctor-inner-section">{{ trans('City List Of Doctor Inner Section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-doc-slider-settings">{{ trans('lang.doctors_slider_section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#dc-seo-section">{{ trans('lang.seo') }}</a>
                        </li>
                          <li class="nav-item">
                            <a class="" data-toggle="tab" href="#about_us_banner_section">{{ trans('About Us Banner Section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#about_us_we_are_here">{{ trans('About Us We Are Here') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#about_us_our_dream">{{ trans('About Us Our Dream') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#for_hospital_knockdoc_tool">{{ trans('For Hospital-DoctorFindy Tool') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#for_hospital_knockdoc_profile">{{ trans('For Hospital-DoctorFindy Profile') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#for_hospital_fourth_section">{{ trans('For Hospital-Fourth Section') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#for_labs_knockdoc">{{ trans('For Labs-KnockDoc') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#for_labs_knockdoc_profile">{{ trans('For Labs-DoctorFindy Profile') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="" data-toggle="tab" href="#for_labs_benefits_of_knockdoc">{{ trans('For Labs Benefits Of DoctorFindy') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="dc-tabscontent tab-content">
                    <div class="dc-securityhold tab-pane la-section-settings {{{ \Request::route()->getName() <> 'homeServicesSection'? 'active': '' }}}" id="dc-search-banner-settings">
                        @include('back-end.admin.settings.home-page-settings.search-banner')
                    </div>
                    <div class="dc-securityhold tab-pane  la-banner-settings" id="dc-slider">
                        @include('back-end.admin.settings.home-page-settings.home-slider')
                    </div>
                    
                    <div class="dc-securityhold tab-pane la-section-settings" id="dc-about-us-settings">
                        @include('back-end.admin.settings.home-page-settings.about-us-section')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="dc-how-works-settings">
                        @include('back-end.admin.settings.home-page-settings.how-it-works-section')
                    </div>
                     <div class="dc-securityhold tab-pane  la-banner-settings" id="small-devices-top-section">
                        @include('back-end.admin.settings.home-page-settings.small_devices_top_section')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="how-it-works-tabs">
                        @include('back-end.admin.settings.home-page-settings.how-it-works-tabs')
                    </div>
                    <div class="dc-securityhold tab-pane {{{ \Request::route()->getName() === 'homeServicesSection'? 'active': '' }}} la-section-settings" id="dc-services-tabs-settings">
                        @include('back-end.admin.settings.home-page-settings.service-tabs-section')
                    </div>
                     <div class="dc-securityhold tab-pane la-section-settings" id="benefits-online-doctor">
                        @include('back-end.admin.settings.home-page-settings.benefits-online-doctor')
                    </div>
                     <div class="dc-securityhold tab-pane la-section-settings" id="benefits-online-profile">
                        @include('back-end.admin.settings.home-page-settings.benefits-online-profile')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="dc-app-section-settings">
                        @include('back-end.admin.settings.home-page-settings.download-app-section')
                    </div>
                     <div class="dc-securityhold tab-pane la-section-settings" id="dc-article-section">
                        @include('back-end.admin.settings.home-page-settings.article-section')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="sign_up_section">
                        @include('back-end.admin.settings.home-page-settings.sign_up_section')
                    </div>
                     <div class="dc-securityhold tab-pane la-section-settings" id="banner_video_section">
                        @include('back-end.admin.settings.home-page-settings.banner_video_section')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="for_doctor_sign_up">
                        @include('back-end.admin.settings.home-page-settings.for-doctor-sign-up')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="map_image">
                        @include('back-end.admin.settings.home-page-settings.map_image')
                    </div>
                      <div class="dc-securityhold tab-pane  la-banner-settings" id="onlin_video_section">
                        @include('back-end.admin.settings.home-page-settings.onlin_video_section')
                    </div>
                    <div class="dc-securityhold tab-pane  la-banner-settings" id="procedure_banner_section">
                        @include('back-end.admin.settings.home-page-settings.procedure_banner_section')
                    </div>
                    <div class="dc-securityhold tab-pane  la-banner-settings" id="city_wise_doctor_section">
                        @include('back-end.admin.settings.home-page-settings.city_wise_doctor_section')
                    </div>
                      <div class="dc-securityhold tab-pane  la-banner-settings" id="city_wise_hospital_section">
                        @include('back-end.admin.settings.home-page-settings.city_wise_hospital_section')
                    </div>
                    <div class="dc-securityhold tab-pane  la-banner-settings" id="header-services-section">
                        @include('back-end.admin.settings.home-page-settings.header_services')
                    </div>
                    <div class="dc-securityhold tab-pane  la-banner-settings" id="for_labs_benefits_of_knockdoc">
                        @include('back-end.admin.settings.home-page-settings.for-labs-benefits-of-knockdoc')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="dc-health-community">
                        @include('back-end.admin.settings.home-page-settings.health_community')
                    </div>
                    <div class="dc-securityhold tab-pane  la-banner-settings" id="health-community-slider">
                        @include('back-end.admin.settings.home-page-settings.health_community_slider')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="dc-health-discussion">
                        @include('back-end.admin.settings.home-page-settings.health_discussion_banner')
                    </div>
                     <div class="dc-securityhold tab-pane  la-banner-settings" id="list-doctor-inner-section">
                        @include('back-end.admin.settings.home-page-settings.list_doctor_inner_section')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="dc-doc-slider-settings">
                        @include('back-end.admin.settings.home-page-settings.doctor-slider-settings')
                    </div>
                    <div class="dc-securityhold tab-pane la-section-settings" id="dc-seo-section">
                        @include('back-end.admin.settings.home-page-settings.seo-settings')
                    </div>
                    <div class="dc-securityhold tab-pane  la-banner-settings" id="about_us_banner_section">
                        @include('back-end.admin.settings.home-page-settings.about-us-banner-section')
                    </div>
                    <div class="dc-securityhold tab-pane  la-banner-settings" id="about_us_we_are_here">
                        @include('back-end.admin.settings.home-page-settings.about-us-we-are-here')
                    </div>
                    <div class="dc-securityhold tab-pane  la-banner-settings" id="about_us_our_dream">
                        @include('back-end.admin.settings.home-page-settings.about-us-our-dream')
                    </div>
                    <div class="dc-securityhold tab-pane  la-banner-settings" id="for_hospital_knockdoc_tool">
                        @include('back-end.admin.settings.home-page-settings.for-hospital-knockdoc-tool')
                    </div>
                    <div class="dc-securityhold tab-pane  la-banner-settings" id="for_hospital_knockdoc_profile">
                        @include('back-end.admin.settings.home-page-settings.for-hospital-knockdoc-profile')
                    </div>
                    <div class="dc-securityhold tab-pane  la-banner-settings" id="for_hospital_fourth_section">
                        @include('back-end.admin.settings.home-page-settings.for-hospital-fourth-section')
                    </div>

                    <div class="dc-securityhold tab-pane  la-banner-settings" id="for_labs_knockdoc">
                        @include('back-end.admin.settings.home-page-settings.for-labs-knockdoc')
                    </div>
                    <div class="dc-securityhold tab-pane  la-banner-settings" id="for_labs_knockdoc_profile">
                        @include('back-end.admin.settings.home-page-settings.for-labs-knockdoc-profile')
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

