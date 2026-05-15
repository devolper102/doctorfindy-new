<template>
  <div>

    <div id="banner">

      <header-section
          :fileSystemDriver = "fileSystemDriver"
          :specialitys = "specialities"
          :servicess = "services"
          :cities = "locations"
          :managements = "managements"
          :logged_user = "logged_user"
          :doctorss="doctors"
          :laboratorys="laboratories"
      ></header-section>
   
      <!-- <div class="inner-banner position-relative" style="background: url(../images/home-banner-image.webp) no-repeat left;"> -->
        <div class="inner-banner position-relative" :style="{ background: 'url(' +basePath + '/images/home-banner-image.webp)' }">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 col-xl-12 col-md-12 col-lg-12">
              <div class="banner_left_section w-80 d-block m-auto w-xs-100 w-sm-100 w-md-100">
                <div class="banner_heading d-inline-block w-100 text-lg-center">
                  <!-- <h1 v-if="screenSize === 'Mobile'" class="m-0 text-white" style="overflow:hidden;height:60px;">
                    <span class="contst_text float-xs-left d-lg-inline-block mr-xl-0 mr-2">{{search_form_title}}</span> 
                     <span class="d-block d-lg-inline-block float-left float-lg-none mr-2 mr-lg-0 ">Nearest
                     </span> 
                      <span class="txt-rotate d-inline-block" data-period="2000" data-rotate='["Doctors","Hospitals","Laboratories"]'></span> 
                  </h1> -->
                  <!-- <h1 v-else class="m-0 text-white"> -->
                    <h1 class="m-0 text-white">
                    <span class="contst_text float-xs-left d-lg-inline-block mr-xl-0 mr-2">{{search_form_title}}</span> 
                       <span class="txt-rotate d-inline-block"  ref="txtRotate" data-period="2000" data-rotate='["Ultimate Health Care Solution","Nearest Doctors","Nearest Hospitals","Nearest Laboratories"]'></span>  
                  </h1>
                </div>
                <div class="m-auto d-block search-main w-85 w-xs-100 w-sm-100 w-md-100">
                <div class="form-inline w-100 d-lg-none d-md-none d-block mb-3">
                  <!-- banner_input -->
                  <div class="w-100 bg-white book-rounded banner-main-input d-lg-none d-md-none d-block">
                  <div class="form-control dummyinput p-2 text_12 w-sm-100 w-md-100 d-table position-relative" data-toggle="modal" data-target="#search_doctor_on_device"> Search for doctors, hospitals, specialties...
                    <div class=" text_14 position-absolute mobile_search_btn banner-search-icon">
                      <span class="text_black">
                        <i class="fa fa-search fa-sm" aria-hidden="true"> </i>
                      </span>
                    </div>
                  </div>
                </div>
                  <!-- btn knockdoc_btn_bg banner_btn p-2 text-white text_14 position-absolute mobile_search_btn -->
                </div>
                <div class="w-100 book-rounded banner-main-input d-lg-block d-md-block d-none">
                 <form class="form-inline w-100 d-lg-inline-block d-md-block d-none search-input position-relative book-rounded">
                  <div class="banner_location input-group location_input position-relative w-28 w-xs-100 w-sm-30 w-md-35 d-inline-block" 
                  id="home_location">
                    <search-location-input
                        :fileSystemDriver = "fileSystemDriver"
                        :locations = "locations"
                    >
                    </search-location-input>
                    <span class="banner_locationIcon text_black">
                      <!-- <img src="/images/location-map--icon-image.svg" style="height:25px;"> -->
                      <i class="fa fa-map-marker" aria-hidden="true">
                      </i>
                    </span>
                  </div>
                  <div class="disease_search input-group w-70 search_main ml-lg-2 w-xs-100 w-sm-60 w-md-60 d-inline-block mt-lg-0 mt-3" id="home_search">
                   <!--  <main-search-page
                        :docs = "doctors"
                        :hosp = "hospitals"
                        :labs = "laboratories"
                        :dise = "diseases"
                        :special = "specialities"
                        :service = "services"
                        :cities = "locations"
                    ></main-search-page> -->
                        <main-search-page
                        :fileSystemDriver = "fileSystemDriver"
                        :docs = "doct"
                        :hosp = "hospit"
                        :labs = "laborator"
                        :dise = "disea"
                        :special = "speciali"
                        :service = "servic"
                        :locations = "locations"
                    ></main-search-page>
                    <span class="input-group-btn btn_position search-btn-position">
                      <a href="javascript:void(0)"class="text_black" type="button">
                        <span>
                          <i class="fa fa-search fa-sm" aria-hidden="true"></i>
                        </span>
                      </a>
                    </span>
                  </div>
                </form>
                </div>
                </div>
              <!-- <div class="row">
                <div class="col-12">
                  <div class="w-100 d-inline-block 
                  position-relative">
                  <div class="position-absolute box-right">
                    <div class="consultation-box bg-white box_shadow book-rounded d-xl-block d-none sticky" 
                    :class="{ 'sticky': isSticky }">
                      <div class="w-100 d-inline-block text-center 
                      mt-2">
                        <blink>
                          <img src="/images/emergency-icon-image.png" 
                        alt="pictire">
                        </blink>
                        <p class="text-blue font-weight-bold text_13 mt-1">Consult Now</p>
                      </div>
                      <div class="w-100 d-inline-block text-center consult-video-btn mb-1">
                        <a href="javascript:void(0)" 
                        class="d-inline-block book-rounded bg-red text-white text_13 mt-1 mb-1">Video Call
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="float-right call-btn call-sticky d-lg-block d-none">
                    <a class="text_14 text-white d-inline-block font-weight-bold" href="javascript:void(0)">
                      <span>
                        <i class="fa fa-whatsapp mr-2 float-left" aria-hidden="true">
                        </i>
                      </span>
                      Whatsapp Us
                    </a>
                  </div>
                </div>
              </div> -->
              </div>
            </div>
            <!-- <div class="col-12 col-xl-4 col-md-4 col-lg-4 mt-xl-4">
              <div class="banner-speciality-images w-100 d-inline-block text-center">
                <img v-if="currentImage" :src="currentImage" />
              </div>
            </div> -->
            <!-- <div v-if="image" class="col-5 col-xl-5 col-md-3 d-none d-lg-flex">
              <div class="banner_right_img w-100 d-flex">
                <img :src="'/uploads/settings/home/'+ image" class="img-fluid" alt="Banner Image" />
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
<div class="container">
  <div class="row mt-3 ml-0">
    <div class="w-100 d-inline-block">
      <h2  class="knockdoc-heading service-text">
        Labs Discount
      </h2>
    </div>
  </div>
      <div class="row mt-xl-3">
        <div class="col-12">
          <div class="w-100 d-inline-block discount-box-slider">
            <VueSlickCarousel
            v-bind="c2Setting" v-if="labDiscounts.length">
              <div v-for="(labs, index) in labDiscounts" :key="index">
                <div class="col-12">
                  <div class="row">
                    <div class="col-12 mb-lg-0 mb-4">
          <div class="box_radius w-100 d-inline-block pt-1 pb-1 pl-2 pr-2 get-code-box float-xl-right position-relative">
          <div class="row">
            <div class="col-4 col-lg-4 col-md-3">
              <span class="lab-logo text-center d-inline-block 
              w-100 mt-1">
                <!-- <img v-if="labs.profile.avatar != null && labs.profile.avatar != ' '" class="rounded-circle m-auto" 
                :src="'/uploads/users/'+labs.id+'/'+labs.profile.avatar" 
                alt="picture" @error="loadDummyImage($event)"> -->
                <img v-if="labs.profile.avatar != null && labs.profile.avatar != ' '" v-lazy="basePath+'/uploads/users/'+labs.id+'/'+labs.profile.avatar" alt="picture" class="rounded-circle m-auto" @error="loadDummyImage($event)"> 
                <img v-else class="rounded-circle m-auto" 
                v-lazy="basePath+'/uploads/default/lab.svg'" 
                alt="picture">
                <!-- <img src="/images/depression-problem-image.png"> -->
              </span>
            </div>
            <div class="col-8 pl-xs-0 col-lg-8 col-md-9 pl-ipad pl-xl-0">
              <div class="banner_post_text d-inline-block w-100 mb-2 text_12">
                <p class="mb-minus">
                  <span class="text_black text_15">Get</span>
                <span v-if="labs.user_discount_percentage != null" class="text-red text_30 font-weight-bold 
                text-xs-20">{{labs.user_discount_percentage}}%
                </span>
                <span v-else class="text-red text_30 font-weight-bold text_xs_20">
                  <span class="text_14 text_black">Upto</span>
                 20%</span>
                </p>
                 <p class="text_black text_12 text-truncate mb-minus">Discount on all {{labs.first_name+' '+labs.last_name}} Tests</p> 
              </div>
               <div v-if="labs.user_discount_percentage != null && labs.id != 13057" class="get-code float-left mt-lg-0 mt-md-0 mt-2 mt-xl-2 mb-xl-0 mb-1 position-relative get-index">
                <a class="text_black bg-white d-inline-block text_12 font-weight-bold" 
                href="javascript:void(0)" @click="showDiscountModal">Get Discount Code</a>
              </div> 
              <div class="float-right mt-lg-0 mt-md-0 mt-2 mt-xl-2 book-discount mb-xl-0 mb-1">
                <a class="text-white service-bg d-inline-block text_12 book-rounded" 
                :href="'/lab/'+labs.location.title+'/'+labs.slug">Book Test</a>
              </div>
              <!-- <div class="get-code float-xl-right float-left mt-lg-0 mt-md-0 mt-2 mt-xl-2">
                <a class="text_black bg-white d-inline-block font-weight-bold text_13" 
                href="javascript:void(0)">Book Test</a>
              </div> -->
            </div>
          </div>
          <a class="circle_anchor position-absolute" 
          :href="'/lab/'+labs.location.title+'/'+labs.slug">
          </a>
        </div>
        </div>
                  </div>
                </div>
              </div>
            </VueSlickCarousel>
          </div>
        </div>
        <!-- <div class="col-12 mb-lg-0 mb-4 col-lg-6 col-md-6 col-sm-6 col-xl-6">
          <div class="w-100 d-inline-block p-2 appointment-box box_radius banner-custom-margin bg-red">
          <div class="row">
            <div class="col-12 col-lg-4 order-lg-2 order-1">
              <span class="banner_mobileimg text-center d-inline-block w-100">
                <img :src="'/uploads/settings/home/'+ small_img" :alt="small_title"/>
              </span>
            </div>
            <div class="col-12 col-lg-8 order-2 order-lg-1">
              <div class="banner_post_text d-inline-block w-100 mt-2 mb-2 text_12">
                <p class="font-weight-bold text-white">{{small_title}}</p>
                <p class="text-white">{{small_description}}</p>
              </div>
              <a :href="small_url" class="box_radius bg-blue text-white p-2 d-inline-block w-100 text-center text_13 text-xs-9 mb-2">{{small_btn}}</a>
            </div>
          </div>
        </div>
        </div> -->
      </div>

      <div v-if="screenSize === 'Mobile'" class="row">
            <div class="col-12">
              <div class="speacialities-heading w-100 
              d-inline-block">
                <h2 class="mb-4 knockdoc-heading service-text">Top Specialities
                </h2>
              </div>
            </div>
          </div>
          <div v-if="screenSize === 'Mobile'" class="col-12 text-center">
              <div class="row mb-3">
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px w-xs-75px h_xs_75">
                    <img v-lazy="basePath+'/uploads/specialities/generl-physician-slider.svg'" name="general-physician" alt="general-physician">
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">General Physician
                </span>
                <a href="general-physician-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px w-xs-75px h_xs_75">
                    <img v-lazy="basePath+'/uploads/specialities/dermatologist-slider.svg'" name="dermatologist" alt="dermatologist">
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Dermatologist</span>
                <a href="dermatologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px w-xs-75px h_xs_75">
                    <img v-lazy="basePath+'/uploads/specialities/gynecologist-slider.svg'" name="gynecologist" alt="gynecologist">
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Gynecologist</span>
                <a href="gynecologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px w-xs-75px h_xs_75">
                    <img v-lazy="basePath+'/uploads/specialities/diabetologist-slider.svg'" name="diabetologist" alt="diabetologist">
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Diabetologist</span>
                <a href="diabetologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px w-xs-75px h_xs_75">
                    <img v-lazy="basePath+'/uploads/specialities/eye-specilist-slider.svg'" name="ent-specialist" alt="ent-specialist">
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Eye Specialist
                </span>
                <a href="ent-specialist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px w-xs-75px h_xs_75">
                    <img v-lazy="basePath+'/uploads/specialities/pediatrician.svg'" name="child-specialist" alt="child-specialist">
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Child Specialist
                </span>
                <a href="pediatrician-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px w-xs-75px h_xs_75">
                    <img v-lazy="basePath+'/uploads/specialities/psychology.svg'" name="psychologist" alt="psychologist">
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Psychologist</span>
                <a href="psychologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px w-xs-75px h_xs_75">
                    <img v-lazy="basePath+'/uploads/specialities/radiotologist.svg'" name="radiologist" alt="radiologist">
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Radiologist</span>
                <a href="radiologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
            </div>
          <div class="d-inline-block w-100 text-center mb-2">
            <a href="/find-a-doctor-near-you" class="box_radius bg-green text-white pl-4 pr-4 pt-1 pb-1 
            d-inline-block">
                View All
            </a>
          </div>
          </div>
          <div v-if="screenSize === 'Mobile'" class="row mt-lg-5 mt-2 d-xl-none d-block">
            <div class="col-12">
              <div class="w-100 d-inline-block">
                <h2 class="mb-4 knockdoc-heading text-blue">
                  I want to book
                </h2>
              </div>
            </div>
            <div class="col-12 mt-4">
              <div class="banner_services_main w-100 
              d-inline-block">
                <ul class="bg-white rounded-pill d-inline-block d-xs-block w-100 position-relative service-banner">
                  <li class="float-left w-23 box_radius p-2 w-xs-55 p-xl-2 pl-lg-1 position-relative">
                    <div class="row">
                      <div class="col-12 col-lg-8 col-xl-7 order-lg-1 order-2">
                        <a href="javascript:void(0)" 
                        class="rounded-pill service-text">
                          <span class="d-inline-block font-weight-bold text-xs-13 text_black w-xs-60 w-sm-100 w-md-100" style="overflow:hidden;height:40px;margin-top:75px;">Doctor Appointment
                          </span> 
                        </a>
                        <p class="text_black mb-0 text_11" 
                        style="overflow:hidden;height:33px;">
                          The best doctors in Pakistan <br>are now available for you.
                        </p>
                      </div>
                      <div class="col-12 col-lg-4 col-xl-5 p-lg-0 order-lg-2 order-1">
                        <div class="doctor-appointment-image w-100 d-inline-block position-relative">
                          <img v-lazy="basePath+'/images/doctor-appointment-image-2.svg'" alt="pictire" class="position-absolute">
                        </div>
                      </div>
                    </div>
                    <a class="circle_anchor position-absolute" 
                    href="javascript:void(0)" data-toggle="modal" data-target="#BannerAppointmentModal"></a>
                  </li>
                  <li class="float-left w-23 box_radius p-2 w-xs-40 p-xl-2 pl-lg-1 position-relative">
                    <div class="row">
                      <div class="col-12 col-lg-8 col-xl-7 order-lg-1 order-2">
                        <a href="/online-doctor-consultation" 
                        class="rounded-pill service-text">
                          <span class="d-inline-block font-weight-bold text-xs-13 text_black w-xs-80 w-sm-100 w-md-100" style="overflow:hidden;height:40px;margin-top:75px;">Video Consultation
                          </span> 
                        </a>
                        <p class="text_black mb-0 text_11" 
                        style="overflow:hidden;height:33px;">
                          Connect with a Doctor from Anywhere
                        </p>
                      </div>
                      <div class="col-12 col-lg-4 col-xl-5 p-lg-0 order-lg-2 order-1">
                        <div class="doctor-appointment-image w-100 d-inline-block position-relative">
                          <img v-lazy="basePath+'/images/video-consultation-image.svg'" alt="pictire" class="position-absolute">
                        </div>
                      </div>
                    </div>
                     <a class="circle_anchor position-absolute" href="/online-doctor-consultation"></a>
                  </li>
                  <li class="float-left w-23 box_radius p-2 w-xs-100 p-xl-2 pl-lg-1 mt-5 position-relative">
                    <div class="row">
                      <div class="col-12 col-lg-8 col-xl-7 order-lg-1 order-2">
                        <a href="/book-a-lab-test" 
                        class="rounded-pill service-text">
                          <span class="mt-0 d-inline-block font-weight-bold text-xs-13 text_black" style="overflow:hidden;height:25px;">Lab Test
                          </span> 
                          <p class="text_black text_11 mb-0 w-75" 
                          style="overflow:hidden;height:33px;">
                            Get up to 30% off on lab tests in Pakistan.
                            <br>Compare prices and book the best deal. 
                          </p>
                        </a>
                      </div>
                      <div class="col-12 col-lg-4 col-xl-5 p-lg-0 order-lg-2 order-1">
                        <div class="w-100 d-inline-block position-relative lab-image">
                          <img v-lazy="basePath+'/images/lab-test-image.svg'" alt="pictire" class="position-absolute">
                        </div>
                      </div>
                    </div>
                    <a class="circle_anchor position-absolute" href="/book-a-lab-test"></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
      <!-- fixed bar -->
          <div v-if="screenSize === 'Desktop'" class="row mt-lg-5 mt-2 d-lg-flex">
            <div class="col-12 mt-4">
              <div class="banner_services_main w-100 d-inline-block">
                <ul class="services_main_banner bg-white rounded-pill d-inline-block d-xs-block w-100 position-relative">
                <li class="float-left box_radius p-2 w-xs-45 p-xl-2 pl-lg-1 w-md-45">
                    <div class="row">
                      <div class="col-12 col-lg-8 col-xl-7 order-lg-1 order-2 pr-xl-0">
                        <div class="w-100 d-inline-block">
                          <a href="javascript::void(0)" 
                        class="rounded-pill service-text" data-toggle="modal" data-target="#BannerAppointmentModal">
                          <span class="title-margin mt-lg-0 d-inline-block font-weight-bold text-xs-13 text_12 text-truncate w-100">
                            Doctor’s Appointment
                          </span> 
                        </a>
                        <p class="text_black text_11 mb-0" style="overflow:hidden;height:35px;">
                          The best doctors in Pakistan are now available for you.
                        </p>
                        </div>
                        <a href="javascript::void(0)" class="box_radius text-white p-2 d-inline-block w-90 text-center text_12 text-xs-9 mb-2 mt-2 book-btn text_sm_9" 
                        data-toggle="modal" data-target="#BannerAppointmentModal">Book Appointment</a>
                      </div>
                      <div class="col-12 col-lg-4 col-xl-5 p-lg-0 order-lg-2 order-1">
                        <div class="doctor-appointment-image w-100 d-inline-block position-relative">
                          <img class="position-absolute" 
                          v-lazy="basePath+'/images/doctor-appointment-image-2.svg'" 
                          alt="pictire"> 
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="float-left box_radius p-2 w-xs-45 p-xl-2 pl-lg-1 w-md-45">
                    <div class="row">
                      <div class="col-12 col-lg-8 col-xl-7 order-lg-1 order-2 
                      pr-xl-0">
                        <div class="w-100 d-inline-block">
                          <a href="/online-doctor-consultation" 
                        class="rounded-pill service-text">
                          <span class="title-margin mt-lg-0 d-inline-block font-weight-bold text-xs-13 text_12 text-truncate w-100">
                            Video Consult With Doctor
                          </span> 
                        </a>
                        <p class="text_black text_11 mb-0" style="overflow:hidden;height:35px;">
                          Connect with a doctor from anywhere
                        </p>
                        </div>
                        <a href="/online-doctor-consultation" class="box_radius text-white p-2 d-inline-block w-90 text-center text_12 text-xs-9 mb-2 mt-2 book-btn text_sm_9">Video Consultation</a>
                      </div>
                      <div class="col-12 col-lg-4 col-xl-5 p-lg-0 order-lg-2 order-1">
                        <div class="doctor-appointment-image w-100 d-inline-block position-relative">
                          <img class="position-absolute" 
                          v-lazy="basePath+'/images/video-consultation-image.svg'" 
                          alt="pictire"> 
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="float-left box_radius p-2 w-xs-45 p-xl-2 pl-lg-1 w-md-45">
                    <div class="row">
                      <div class="col-12 col-lg-8 col-xl-7 order-lg-1 order-2 
                      pr-xl-0">
                        <div class="w-100 d-inline-block">
                          <a href="/book-a-lab-test" 
                        class="rounded-pill service-text">
                          <span class="title-margin mt-lg-0 d-inline-block font-weight-bold text-xs-13 text_12 text-truncate w-100">
                            Lab Tests
                          </span> 
                        </a>
                        <p class="text_black text_11 mb-0" style="overflow:hidden;height:35px;">
                          Get upto 30% off on Lab tests
                        </p>
                        </div>
                        <a href="/book-a-lab-test" class="box_radius text-white p-2 d-inline-block w-90 text-center text_12 text-xs-9 mb-2 mt-2 book-btn text_sm_9">Book A Lab Test</a>
                      </div>
                      <div class="col-12 col-lg-4 col-xl-5 p-lg-0 order-lg-2 order-1">
                        <div class="doctor-appointment-image w-100 d-inline-block position-relative">
                          <img class="position-absolute" 
                          v-lazy="basePath+'/images/lab-test-image.svg'" 
                          alt="pictire"> 
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="float-left box_radius p-2 w-xs-45 p-xl-2 pl-lg-1 w-md-45">
                    <div class="row">
                      <div class="col-12 col-lg-8 col-xl-7 order-lg-1 order-2 
                      pr-xl-0">
                        <div class="w-100 d-inline-block">
                          <a href="/surgeries" class="rounded-pill service-text">
                          <span class="title-margin mt-lg-0 d-inline-block font-weight-bold text-xs-13 text_13 text-truncate w-100">
                            Surgeries
                          </span> 
                        </a>
                        <p class="text_black text_11 mb-0" style="overflow:hidden;height:35px;">
                          Looking for the surgeon?
                        </p>
                        </div>
                        <a href="/surgeries" class="box_radius text-white p-2 d-inline-block w-90 text-center text_12 text-xs-9 mb-2 mt-2 book-btn text_sm_9">Check It Now</a>
                      </div>
                      <div class="col-12 col-lg-4 col-xl-5 p-lg-0 order-lg-2 order-1">
                        <div class="doctor-appointment-image w-100 d-inline-block position-relative">
                          <img class="position-absolute" 
                          v-lazy="basePath+'/images/search-slider.svg'" 
                          alt="pictire"> 
                        </div>
                      </div>
                    </div>
                  </li>
                  <!-- <li class="float-left w-23 box_radius p-2 w-xs-45 p-xl-2 pl-lg-1" 
                  v-for="(slide, index) in slides">
                    <div class="row">
                      <div class="col-12 col-lg-8 col-xl-7 order-lg-1 order-2">
                        <a href="javascript::void(0)" 
                        class="rounded-pill service-text">
                          <span class="title-margin mt-lg-0 d-inline-block font-weight-bold text-xs-13" style="overflow:hidden;height:40px;">{{slide.slide_title_one}}
                          </span> 
                        </a>
                        <a v-if="slide.slide_title_one === 'Video Consultation'" :href="slide.slide_title_url" class="box_radius text-white p-2 d-inline-block w-100 text-center text_12 text-xs-9 mb-2 mt-2 book-btn text_sm_9">Video Consultation</a>
                        <a v-else-if="slide.slide_title_one === 'Lab Test'" :href="slide.slide_title_url" class="box_radius text-white p-2 d-inline-block w-100 text-center text_12 text-xs-9 mb-2 mt-2 book-btn text_sm_9">Book a Lab Test</a>
                        <a v-else :href="slide.slide_title_url" class="box_radius text-white p-2 d-inline-block w-100 text-center text_12 text-xs-9 mb-2 mt-2 book-btn text_sm_9">{{small_btn}}</a>
                      </div>
                      <div class="col-12 col-lg-4 col-xl-5 p-lg-0 order-lg-2 order-1">
                        <div class="doctor-appointment-image w-100 d-inline-block position-relative">
                          <img class="position-absolute" 
                          :src="basePath+'/images/'+slide.slide_title_two" 
                          alt="pictire"> 
                        </div>
                      </div>
                    </div>
                  </li> -->
                </ul>
              </div>
            </div>
          </div>
        <!-- fixed bar -->
    </div>
    <!--start Appointment Modal -->
<!-- Modal -->
<div class="modal fade" id="BannerAppointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header pt-2 pb-2 bg-blue">
        <h5 class="modal-title text-white text-center font-weight-bold text_18 w-100 d-inline-block">Book Appointment
          <button type="button" class="close rounded-pill d-inline-block text-white" data-dismiss="modal" aria-label="Close">
          <span class="float-left" aria-hidden="true">&times;</span>
        </button>
        </h5>
      </div>
      <div class="modal-body p-0">
        <div class="w-100 d-inline-block">
        <div class="w-100 d-inline-block pt-3 pb-0 pl-3 pr-3 bg-tab">
          <div class="row">
            <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 col-12 mb-3">
              <div class="w-100 d-inline-block current-location-input position-relative">
                <span class="position-absolute">
                  <i aria-hidden="true" class="fa fa-map-marker fa-sm"></i></span>
                <input class="w-100 d-inline-block pl-4 h_40 book-rounded" type="text" placeholder="Enter City" 
                v-model="filterText"
                >
                <a class="bg-green d-inline-block text-white text_13 book-rounded position-absolute" href="javascript:void(0)">
                  <img :src="basePath+'/images/current-location-icon-image.svg'">
                  Current Location
                </a>
              </div>
            </div>
            <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 col-12 mb-3">
              <div class="w-100 d-inline-block current-location-input position-relative">
                <span class="position-absolute">
                  <i aria-hidden="true" class="fa fa-search fa-sm"></i>
                  </span>
                <input class="w-100 d-inline-block pl-4 h_40 book-rounded" type="text" placeholder="Search by specialities" 
                v-model="search"
                @input="applyFilter">                
                <a class="bg-green d-inline-block text-white text_13 book-rounded position-absolute search-btn" href="javascript:void(0)">
                  Search
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="w-100 d-inline-block appointment-tabs">
          <div class="w-100 d-inline-block pt-0 pb-3 pl-3 pr-3 bg-tab scroll-appointment">
          <div class="float-left appointment-tabs-margin" v-for="(cityName, index) in citySequence" :key="index">
           <div v-for="(city, cityIndex) in filteredItems" :key="cityIndex" v-if="city.title === cityName" class="nav nav-tabs mt-2 w-100 d-inline-block">
                <a class="nav-link box-shadow text_black w-100 d-inline-block" @click="setActive(index); updateFilterText(city);selectCity(city.title)"
                      :class="{ active: activeIndex === index }">
                  <div class="cit-bg w-100 d-inline-block mt-1">
                    <div class="w-30 d-inline-block float-left 
                    city-image">
                      <a class="bg-blue d-inline-block rounded-pill text-center" href="javascript:void(0)">
                        <!-- <img src="/images/lahore-image.webp"> -->
                        <img :src="generateImagePath(city.flag)" alt="lahore-image.webp">
                      </a>
                    </div>
                    <div class="city-name w-70 d-inline-block float-left">
                      <p class="text_13 mb-0 mt-1 pl-2">{{ city.title}}</p>
                    </div>
                  </div>
                </a>
      </div>
</div>
</div>
<div class="w-100 d-inline-block">
<div class="tab-content p-3" id="nav-tabContent">
  <div class="w-100 d-inline-block">
    <div class="row mt-2">
      <div class="col-xl-4 mb-3 col-6 col-sm-4 col-md-4 col-lg-4" v-for="(city, index) in filteredItems" :key="index">
        <div class="under-city-name w-100 d-inline-block">
          <a href="javascript:void(0)" class="text_black text_13 font-weight-bold p-2 book-rounded w-100 d-inline-block" 
          @click="setActive(index); updateFilterText(city);selectCity(city.title)">
        <i class="fa fa-map-marker mr-2" aria-hidden="true">
          </i>
          {{ city.title }}
      </a>
        </div>
      </div>
    </div>
    <div class="w-100 d-inline-block speciality-main pt-0 pb-3" 
    v-if="showSpecialities">
  <div class="row">
    <!-- {{filteredList}} -->

    <div class="col-12 col-xl-4 mb-3 col-sm-4 col-md-4 col-lg-4" 
    v-for="specialty in filteredList" :key="specialty.id">
      <!-- {{specialty}} -->
      <div class="speciality-bg w-100 d-inline-block pt-1 pb-1 pl-2 pr-2 book-rounded position-relative">
        <div class="w-20 d-inline-block float-left 
        speciality-image" style="margin-top:6px;">
          <a class="d-inline-block rounded-pill text-center" 
          href="javascript:void(0)">
            <img :src="basePath+'/images/blood-pressure.svg'">
          </a>
        </div>
        <div class="speciality-name w-70 d-inline-block float-left">

          <p class="text_13 mb-0 font-weight-bold mt-1 text_black">
          {{ specialty.title }}</p>
          <span class="text_12 text_black">
            {{ specialty.user_count }} Doctors available
          </span>
        </div>
        <a class="circle_anchor position-absolute" :href="'/'+specialty.slug+'-in-'+ selectedCity"></a>
      </div>
    </div>
      
     </div>

</div>
    
    </div>
 </div>
 
</div>
</div>
<!-- <div class="w-100 d-inline-block speciality-main pt-0 pb-3 pl-3 pr-3">
  <div class="row">
    <div class="col-12 col-xl-4 mb-3" v-for="specialty in filteredList" :key="specialty.id">
      <div class="speciality-bg w-100 d-inline-block pt-1 pb-1 pl-2 pr-2 book-rounded position-relative">
        <div class="w-20 d-inline-block float-left 
        speciality-image" style="margin-top:6px;">
          <a class="d-inline-block rounded-pill text-center" 
          href="javascript:void(0)">
            <img src="/images/blood-pressure.svg">
          </a>
        </div>
        <div class="speciality-name w-70 d-inline-block float-left">
          <p class="text_13 mb-0 font-weight-bold mt-1 text_black">
          {{ specialty.title }}</p>
          <span class="text_12 text_black">
            {{ specialty.doctor_count }} Doctors available
          </span>
        </div>
        <a class="circle_anchor position-absolute" :href="'/'+specialty.slug+'-in-'+ selectedCity"></a>
      </div>
    </div> -->
      <!-- <span v-if="filteredList.length === 0" >No Result Found...</span> -->
<!-- 
     </div>

</div> -->
        </div>
      </div>
    </div>
  </div>
</div>
    <!--End Appointment Modal -->

    <!--End Banner Section -->
    <!-- Modal fo search Doctor on small devices -->
    <div class="modal fade" id="search_doctor_on_device" tabindex="-1" aria-hidden="true" >
      <div class="modal-dialog m-0">
        <div class="modal-content">
          <div class="modal-header border-0 pb-2 pt-1">
            <span class="text-center w-100 text_18 pt-1">Search for Doctors</span>
            <span class="text_25 p-0 text-white text-right" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="text_black" style="display: flex;margin-top:-3px;">&times;</span>
            </span>
          </div>
          <div class="modal-body pl-2 pr-2 pt-0 pb-0">
            <search-location-input
                :locations = "locations"
            >
            </search-location-input>
              <main-search-page
                        :docs = "doct"
                        :hosp = "hospit"
                        :labs = "laborator"
                        :dise = "disea"
                        :special = "speciali"
                        :service = "servic"
                        :locations = "locations"
              ></main-search-page>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal fo search Doctor on small devices -->
    <!-- Discount Model Start -->
    <div class="modal" id="discount_modal" tabindex="-1" role="dialog" aria-labelledby="mobile_number_detail" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content box_radius  box_shadow">
          <div class="modal-header p-0 bg-blue">
            <div class="modal_bg w-100 d-inline-block box_radius box_bottom_lr_radius position-relative bg-blue">
              <button type="button" class="close text-white" v-on:click="hideDiscountModal(false)" aria-label="Close" style="opacity: 1 !important;">
                <span aria-hidden="true" style="padding:4px 10px 0 0;display: inline-block;">&times;</span>
              </button>
              <div class="container">
                <div class="heading-doctor-report p-2">
                  <p class="text-white text_14 text-xs-13">Get Discount
                </p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body pt-2 pb-2 pl-3 pr-3">
            <form>
              <div class="form-group w-100 float-left 
              d-inline-block mb-2">
                <label class="text_black text_13 font-weight-bold">Name</label>
                <input v-model="name" type="text" class="form-control h_37 text_14 specialities-background" id="nameInputText" aria-describedby="emailHelp" placeholder="Name">
              </div>
              <!-- <div class="form-group mb-2 w-100 d-inline-block float-left">
                <label class="text_black text_15 font-weight-bold">Email</label>
                <input type="password" class="form-control specialities-background h_37" placeholder="Password" id="discount_password">
              </div> -->
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2">
                <label class="text_black text_13 font-weight-bold">Phone Number</label>
                <input v-model="phone_number"  type="number" class="form-control specialities-background h_37" placeholder="92345-0435621" id="phone"  @input="formatPhoneNumber" onKeyPress="if(this.value.length==12) return false;">
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2">
                <input v-model="home_sampling" type="checkbox" id="home_sampling" true-value="yes" v-on:click="forHomeSampling()">
                <label class="form-check-label" for="home_sampling">For Home Sampling (گھر سے ٹیسٹ کیلئے)</label>
              </div>
              <div id="home-sampling-field">
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2">
                <label class="text_black text_13 font-weight-bold">Address</label>
                <input v-model="address" type="text" class="form-control specialities-background h_37" placeholder="address" id="phone">
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2">
                <label class="text_black text_13 font-weight-bold">Age</label>
                <input v-model="age" type="number" class="form-control specialities-background h_37" placeholder="Age" id="age">
              </div>
              </div>
              <div class="modal_footer_btn w-85 m-auto d-block w-xs-100 w-sm-100 w-md-100 w-ipad-100">
                <div class="modal_footer_btn w-100 d-inline-flex m-0 float-left mt-1 ml-0 mr-0 mb-0">
                  <div class="cancle-btn doctor-report-btn w-48 float-left mt-2">
                    <a v-on:click="hideDiscountModal(false)" class="book-border text-blue book-rounded w-100 p-2 text-center font-weight-bold d-inline-block">Cancel</a>
                  </div>
                  <div class="submit-btn w-48 float-right ml-2 mt-2">
                    <a href="javascript:void(0)" @click="getDiscount" class="bg-green book-rounded border-green w-100 text-white p-2 text-center font-weight-bold d-inline-block":disabled="submitting">Submit</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Discount modal End -->

    <div class="modal" id="response_modal" tabindex="-1" role="dialog" aria-labelledby="mobile_number_detail" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content box_radius  box_shadow">
          <div class="modal-header p-0 bg-blue">
            <div class="modal_bg w-100 d-inline-block box_radius box_bottom_lr_radius position-relative bg-blue">
              <button type="button" class="close text-white" v-on:click="hideSummaryDiscountModal(false)" aria-label="Close" style="opacity: 1 !important;">
                <span aria-hidden="true" style="padding:4px 10px 0 0;display: inline-block;">&times;</span>
              </button>
              <div class="container">
                <div v-if="balance < 10" class="heading-doctor-report p-2">
                  <p class="text-white text_14 text-xs-13">Your Discount Code</p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body px-0 py-3 w-80 m-auto">
            <form v-if="balance < 10">
              <!-- <div class="verification-text-phone-number float-right d-block mb-2" id="coupon_summary">
               <a class="text_14 float-left text-blue" :href="'/lab/download-discount/'+c_code">Download <img :src="basePath+'/images/final-save.png'" class="img-fluid"></a> 
               <a class="text_14 float-left theme-color-text" href="" @click.prevent="printme" target="_blank">Print <img src="/images/final-print.png" class="img-fluid"></a>
               
              </div> -->
              <div class="form-group w-100 float-left d-inline-block mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Name :   </label>
                <label class="text_black text_13 font-weight-bold float-right">{{c_name}}</label>
                
              </div>
             
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Phone Number :   </label>
                <label class="text_black text_13 font-weight-bold float-right">{{c_phone_number}}</label>
               
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Dicount Code :   </label>
                <label class="text_black text_13 font-weight-bold float-right"><b>{{c_code}}</b></label>
               
              </div>
              <div v-if="c_home_sampling !== null">
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Address :   </label>
                <label class="text_black text_13 font-weight-bold float-right">{{c_address}}</label>
               
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Age :   </label>
                <label class="text_black text_13 font-weight-bold float-right">{{c_age}}</label>
               
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Requested Home Sampling :   </label>
                <label class="text_black text_13 font-weight-bold float-right">{{c_home_sampling}}</label>
               
              </div>
              </div>
              </form>
            <form v-else>
              <div class="w-100 d-inline-block text-center">
                <img src="/images/pop-img.svg">
                <h2 class="text-black font-weight-bold text_25 mt-3 text-xs-20 text-center discount-font-family">
                  شکریہ!
                </h2>
              </div>
              <div class="form-group w-100  
              d-inline-block mb-2">
                <label class="text_black text_15 font-weight-bold text-right discount-font-family">تصدیق کے بعد آپ کے نمبر پر ڈسکاؤنٹ کوڈ بھیج دیا جائے گا، وہ کوڈ کسی بھی چغتائی لیب میں دکھائیں اور لیب ٹیسٹ پر  <span class="text-red text_30 font-weight-bold text_xs_20">%20</span> ڈسکاؤنٹ حاصل کریں </label>
                              
              </div>
              <div class="form-group w-100  
              d-inline-block mb-2">
                <label class="text_black text_15 font-weight-bold text-right discount-font-family">اگر آپ کو اپنا کوپن نمبر موصول نہیں ہوا تو  3 سے 5 منٹ انتظار کریں پھر ہمیں اس نمبر 03450435621 پر کال یا واٹس ایپ پر رابطہ کریں</label>
                              
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="w-100 text-center call-btn d-inline-block">
                    <a class="text_14 text-white d-inline-block font-weight-bold" href="https://wa.me/+923450435621?text=Hello I am looking for Discount code ">
                      <span>
                        <i class="fa fa-whatsapp mr-2 float-left" aria-hidden="true">
                        </i>
                      </span>
                      Whatsapp Us
                    </a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
   import 'vue-slick-carousel/dist/vue-slick-carousel.css'
   import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
   import axios from 'axios'
export default {
  components: { VueSlickCarousel },
  name: "InnerBannerComponent",
  props:[ 'specialities', 'services', 'cities', 'diseases', 'doctors', 'hospitals', 'laboratories', 'trendingTopics','managements', 'logged_user', 'fileSystemDriver'],
  data() {
    return {
      activeIndex: null,
      filterText: '',
      search: '',
      value: '',
       city: this.cities,
      selectedCity: null,
      filteredList: [],
      fullList: [],
      showSpecialities: false,
      citySequence: ['Lahore', 'Karachi', 'Islamabad', 'Quetta', 'Peshawar', 'Multan','Faisalabad'],
      screenSize:'',
      labDiscounts:this.laboratories,
      submitting: false,   
      discountCodeGenerated: false,
      // isSticky: false,
      // prevScrollPos: window.pageYOffset,
      c2Setting: {
           arrows: true,
           dots:false,
           slidesToShow:3,
           speed: 1000,
           responsive: [
            {
               breakpoint: 991,
               settings: {
                 slidesToShow: 2,
                 slidesToScroll: 1,
               }
             },
             {
               breakpoint: 1024,
               settings: {
                 slidesToShow: 3,
                 slidesToScroll: 1,
               }
             },
             {
               breakpoint: 600,
               settings: {
                 slidesToShow: 2,
                 slidesToScroll: 1,
                 initialSlide: 2
               }
             },
             {
               breakpoint: 480,
               settings: {
                 slidesToShow: 1,
                 slidesToScroll: 1
               }
             }
           ]
         },
      selectedLocation: [],
      locationSlug:'lahore',
      trendingDisease: this.diseases,
      trendingServices: this.services,
      // trendingSpecialities: this.specialities,
      home_slider: '',
      home_search_banner: '',
      small_devices: '',
      slides: '',
      search_form_title: '',
      search_banner_heading: '',
      image: '',
      specs:[],
      tabs: [],
      first:'',
      second:'',
      third:'',
      all: [],
      small_title: '',
      small_description: '',
      small_btn: '',
      small_url: '',
      small_img: '',
       small_title1: '',
      small_description1: '',
      small_btn1: '',
      small_url1: '',
      small_img1: '',
      small_hide_show: '',
      topdata: '',
      speciali: this.specialities,
      doct: this.doctors,
      hospit: this.hospitals,
      disea: this.diseases,
      laborator: this.laboratories,
      servic: this.services,
      locations: this.cities,
      c_name:'Name',
      c_phone_number:'Phone Number',
      c_address:'',
      c_code:"",
      c_home_sampling:null,
      c_age:'',
      phone_number:'',
      address:'',
      name:'',
      home_sampling:'',
      age:'',
      balance: 0,
      basePath:'',
      // currentImage: null,
      // currentText:'Nearest Doctors',

    }
  },
  created() {
    this.rotate()
    // this.filterTrending()
   
  },
  computed: {
      filteredItems: function () {
        // console.log('flag',filteredItems)
        return this.city.filter(post => {
          return post.title.toLowerCase().includes(this.filterText.toLowerCase());
        });
         
      },
  },

    mounted(){
           if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
     // window.addEventListener('scroll', this.handleScroll);
      document.addEventListener('textChange', this.handleTextChange);
    this.home_slider = this.managements.find(pf =>pf.meta_key ==='home_slider')
    this.slides = JSON.parse(this.home_slider.meta_value);

     this.home_search_banner = this.managements.find(pf =>pf.meta_key ==='home_search_banner')
      this.search_form_title = JSON.parse(this.home_search_banner.meta_value).search_form_title;
       this.search_banner_heading = JSON.parse(this.home_search_banner.meta_value).search_banner_heading;
       this.image = JSON.parse(this.home_search_banner.meta_value).hidden_search_banner_img;

     this.small_devices = this.managements.find(pf =>pf.meta_key ==='small_devices_top_section')
     this.small_title = JSON.parse(this.small_devices.meta_value).title;
     this.small_description = JSON.parse(this.small_devices.meta_value).description;
     this.small_btn = JSON.parse(this.small_devices.meta_value).button;
     this.small_url = JSON.parse(this.small_devices.meta_value).url;
     this.small_img = JSON.parse(this.small_devices.meta_value).hidden_small_device_img;
     this.small_hide_show = JSON.parse(this.small_devices.meta_value).show_smalldevice_sec;
     this.small_title1 = JSON.parse(this.small_devices.meta_value).title1;
     this.small_description1 = JSON.parse(this.small_devices.meta_value).description1;
     this.small_btn1 = JSON.parse(this.small_devices.meta_value).button1;
     this.small_url1 = JSON.parse(this.small_devices.meta_value).url1;
     this.small_img1 = JSON.parse(this.small_devices.meta_value).hidden_small_device_img1;
     this.small_hide_show = JSON.parse(this.small_devices.meta_value).show_smalldevice_sec;
     // this.labDiscountData();
     this.updateScreenSize();
     window.addEventListener('resize', this.updateScreenSize);
  },
  beforeUnmount() {
        window.removeEventListener('resize', this.updateScreenSize);
      },
      watch: {
    selectedCity: 'updateShowSpecialities',
    search: 'updateShowSpecialities',
  },
  watch: {
  filterText(newFilterText) {
    if (newFilterText === "") {
      // Clear the search bar and hide the speciality list
      this.search = "";
      this.showSpecialities = false;
    }
  },
},

  methods: {
    formatPhoneNumber() {
      if (this.phone_number.startsWith('0')) {
        this.phone_number = '92' + this.phone_number.slice(1);
      }
    },
    
    getImageSource(path) {
      console.log('laravelEnv',this.fileSystemDriver)
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        return `https://doctorfindy.sgp1.cdn.digitaloceanspaces.com/${path}`;
      } else {
        // Use local path for development
        return `/${path}`;
      }
    },
     updateShowSpecialities() {
      this.showSpecialities = !!this.selectedCity || !!this.search.trim();
    },    
    // Method to hide the speciality list
    hideSpecialityList() {
      this.showSpecialities = false;
    },
    generateImagePath(filename) {
    
    return this.basePath+`/uploads/locations/${filename}`;
  },
    applyFilter() {
    if (this.search === "") {
     // this.filteredList=[];
      this.filteredList = this.fullList;
    } else {
      this.filteredList = this.fullList.filter(post => {
        return post.title.toLowerCase().includes(this.search.toLowerCase());
      });
    }
  },
  
  fetchSpecialitiesByCity(city) {
    if (city) {
      axios.get(`/specialities-by-city/${city}`)
        .then(response => {
          if (response.data) {
            this.fullList = response.data;  
            // console.log('adssd',this.fullList)
            this.applyFilter(); 
          }
        })
        .catch(error => {
          // console.error('Error city:', error);
        });
    } else {
        
      this.fullList = [];
      // console.log('search',this.fullList)
      this.filteredList = [];
      // console.log('search',this.filteredList)
    }
  },
     selectCity(city) {
      
    this.selectedCity = city;
    // console.log(this.selectedCity)
    this.fetchSpecialitiesByCity(city);
     this.showSpecialities = true;
     
     },
    setActive(index) {
    this.selectedCity = this.filteredItems[index].title;
    // console.log("selectedcity=",this.selectedCity);
    this.filterText = this.selectedCity;
     this.fetchSpecialitiesByCity(this.selectedCity);
    this.updateFilterText(this.selectedCity);
    this.activeIndex = index;
      },
       updateFilterText(city) {
      this.filterText = city.title; 
      this.selectedCity = city.title;
      if (!city.title) {
      // this.showSpecialties = false;
     } else {
      // this.showSpecialties = true;
      this.fetchSpecialitiesByCity(city.title);
     }
        },
      
        updateScreenSize() {
          if (window.innerWidth < 768) {
            this.screenSize = 'Mobile';
          } else {
            this.screenSize = 'Desktop';
          }
        },
    loadDummyImage(event)
    {
       event.target.src='/images/healthcare-image.png';
    },
    labDiscountData()
    {
      axios.get('/home-page-lab-discount-slider-data')
      .then(response=>{
            this.labDiscounts=response.data;
      }); 
    },
    // handleScroll() {
    //   const currentScrollPos = window.pageYOffset;

    //   if (currentScrollPos > 360 && currentScrollPos) {
    //     this.isSticky = true;
    //   } else {
    //     this.isSticky = false;
    //   }
    // },
    selectedItem(result) {
      if (this.selectedLocation.length > 0) {
        if (result.label === 'Doctors') {
          window.location.href = '/doctors/'+result.item.location.slug+'/'+result.item.specialities[0].slug+'/'+result.item.slug
        }
        else if (result.label === 'Hospitals') {
          window.location.href = '/hospitals/'+result.item.location.slug+'/'+result.item.slug
        }
        else if (result.label === 'Specialities') {
          /*  dermatologist-in-lahore  */
          
          window.location.href = '/'+result.item.slug+'-in-'+this.locationSlug
        }
        else if (result.label === 'Services') {
          /*  treatments/{slug}/{location}  */
          window.location.href = '/treatments/'+result.item.slug+'/'+this.selectedLocation[0].slug
        }
        else if (result.label === 'Diseases') {
          /*  diseases/{slug}/{location}  */
          
          window.location.href = '/diseases/'+result.item.slug+'/'+this.selectedLocation[0].slug
        }
        else if (result.label === 'Laboratories') {
          /*  laboratories/{speciality}/{location}  */
             window.location.href = '/lab/'+result.item.location.slug+'/'+result.item.slug
        }
        // else {}
      }
      else {
        if (result.label === 'Doctors') {
         
          return
          window.location.href = '/doctors/'+result.item.location.slug+'/'+result.item.specialities[0].slug+'/'+result.item.slug
        }
        else if (result.label === 'Hospitals') {
          window.location.href = '/hospitals/'+result.item.location.slug+'/'+result.item.slug+'/'+result.item.area.slug
        }
        else if (result.label === 'Specialities') {
          /*  dermatologist-in-lahore  */
        
          window.location.href = '/'+result.item.slug+'-in-'+this.selectedLocation[0].slug
        }
        else if (result.label === 'Services') {
          /*  treatments/{slug}  */
          
          window.location.href = '/treatments/'+result.item.slug+'/'+this.selectedLocation[0].slug
        }
        else if (result.label === 'Diseases') {
          /*  diseases/{slug}  */
         
            window.location.href = '/diseases/'+result.item.slug+'/'+this.selectedLocation[0].slug
        }
        else if (result.label === 'Laboratories') {
          
             window.location.href = '/lab/'+result.item.location.slug+'/'+result.item.slug
        }
        // else {}
      }
    },
    showDiscountModal(){
      this.loading = true
      // if(this.patient.length === undefined) {
        document.querySelector('#discount_modal').classList.add('show')
        document.querySelector('body').classList.add('modal-open')
        document.querySelector('#discount_modal').style.display = "block"
      // }
      // else {
      //   Vue.toasted.show('Please Login First' , { duration: 3000 })
      // }
      this.loading = false
    },
    hideDiscountModal(e) {
      this.loading = true
      document.querySelector('#discount_modal').classList.remove('feedback_modle')
      document.querySelector('body').classList.remove('modal-open')
      document.querySelector('#discount_modal').style.display = 'none'
      this.discountCodeGenerated = false;
      this.loading = false
    },
    getDiscount()
    {
      if (this.submitting) {
    return;    }

  this.submitting = true;
      // let self = this;
       axios.post(APP_URL + '/labs/get-discount', {
                        phone_number : this.phone_number,
                        name : this.name,
                        address : this.address,
                        age : this.age,
                        home_sampling : this.home_sampling,
                    })
                    .then((response)=> {
                      this.submitting = false;
                      if(response.data.success===1)
                      {
                        if (!this.discountCodeGenerated) {
                             this.discountCodeGenerated = true;
                        document.querySelector('#discount_modal').classList.remove('feedback_modle')
                        document.querySelector('body').classList.remove('scroll')
                        document.querySelector('#discount_modal').style.display = 'none'
                         document.querySelector('#response_modal').classList.add('show')
                        document.querySelector('#response_modal').style.display = "block"
                        document.querySelector('#home-sampling-field').style.display = "none"
                         this.c_name = response.data.data.name;
                         this.c_phone_number = response.data.data.phone_number;
                         this.c_address = response.data.data.address;
                         this.c_code = response.data.data.code;
                         this.balance = response.data.balance;
                        //  console.log('fdfds',this.balance);
                         this.c_home_sampling = response.data.data.home_sampling;
                         this.c_age = response.data.data.age;
                         this.phone_number = '';
                         this.name = '';
                         this.address = '';
                         this.age = '';
                         this.home_sampling = '';
                           this.$toasted.show("Your request Submitted Successfully",{
                            type:'success',
                            duration: 2000
                          });
                         }
                       }
                        else{

                          this.$toasted.show(response.data.data,{
                            type:'error',
                            duration: 4000
                          });
                        } 
                    }); 
    },
    hideSummaryDiscountModal(e) {
      this.loading = true
      document.querySelector('body').classList.remove('modal-open')
      document.querySelector('#response_modal').style.display = 'none'
      this.discountCodeGenerated = false;
      this.loading = false
    },
    forHomeSampling(){
      document.getElementById('home_sampling').onchange = function() {
    document.getElementById('home-sampling-field').style.display = this.checked ? 'block' : 'none';};
    },
    // filterTrending() {
    //   /*Getting Trending Data*/
    //   this.trendingDisease = this.diseases.filter(trending => {
    //     return trending.trending > 0
    //   })
    //   this.trendingServices = this.services.filter(trending => {
    //     return trending.trending > 0
    //   })
    //   this.trendingSpecialities = this.specialities.filter(trending => {
    //     return trending.trending > 0
    //   })
    //   /*Sorting Trending Arrays*/
    //   this.trendingDisease = this.trendingDisease.sort(function(a, b) {
    //     if(a.trending < b.trending) { return 1; }
    //     if(a.trending > b.trending) { return -1; }
    //     return 0;
    //   })
    //   this.trendingServices = this.trendingServices.sort(function(a, b) {
    //     if(a.trending < b.trending) { return 1; }
    //     if(a.trending > b.trending) { return -1; }
    //     return 0;
    //   })
    //   this.trendingSpecialities = this.trendingSpecialities.sort(function(a, b) {
    //     if(a.trending < b.trending) { return 1; }
    //     if(a.trending > b.trending) { return -1; }
    //     return 0;
    //   })
    // },
    rotate(){
         var TxtRotate = function(el, toRotate, period) {
  this.toRotate = toRotate;
  this.el = el;
  this.loopNum = 0;
  this.period = parseInt(period, 10) || 1000;
  this.txt = '';
  this.tick();
  this.isDeleting = false;
};

TxtRotate.prototype.tick = function() {
  var i = this.loopNum % this.toRotate.length;
  var fullTxt = this.toRotate[i];
  if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
  } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
  }

  this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

  // Emit a custom event when the text changes
  var textChangeEvent = new CustomEvent('textChange', {
    detail: {
      fullTxt: fullTxt
    }
  });
  document.dispatchEvent(textChangeEvent);
  var that = this;
  var delta = 150 - Math.random() * 100;

  if (this.isDeleting) { delta /= 2; }

  if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
  } else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
  }

  setTimeout(function() {
    that.tick();
  }, delta);
};

window.onload = function() {
  var elements = document.getElementsByClassName('txt-rotate');
  for (var i=0; i<elements.length; i++) {
    var toRotate = elements[i].getAttribute('data-rotate');
    var period = elements[i].getAttribute('data-period');
    if (toRotate) {
      new TxtRotate(elements[i], JSON.parse(toRotate), period);
    }
  }
  // INJECT CSS
  var css = document.createElement("style");
  css.type = "text/css";
  css.innerHTML = ".txt-rotate > .wrap { padding-right:10px; border-right: 0.05em solid #fff }";
  document.body.appendChild(css);
};

    }
  }
}
</script>

<style>
#discount_modal,#response_modal{
  background: rgba(0,0,0,0.7);
}
img[lazy=loading] {
    background-image: url("/images/loader/loaderss.gif");
    background-position: center;
    background-size: contain;
    display: flex;
    width: auto;
    height: auto;
    background-repeat: no-repeat;
  }
 
  .get-code a{
    padding: 5px 7px;
    border-radius: 5px;
    border: 1px solid #9F9F9F;
  }
  .get-code a:hover{
    background-color:#EA1938 !important;
    border:1px solid #EA1938;
    color:#fff !important;
  }
img[lazy=error] {
    background-image: url("/images/loader/healthcare-image.png");
    background-position: center;
    background-size: contain;
    display: flex;
    width: auto;
    height: auto;
    background-repeat: no-repeat;
  }
#search_doctor_on_device #autosuggest input{
  border-radius: 0px !important;
  margin-bottom: 10px !important;
  padding-right: 5rem;
  padding: 1.375rem .75rem;
}
.lab-logo img{
  width: 90px;
  height: 90px;
  border-radius: 50%;
    display: inline-block;
}
#search_doctor_on_device .autosuggest__results-container {
    width: 100% !important;
    left: 0px !important;
    top: 110px !important;
}
#search_doctor_on_device .autosuggest__results{
  max-height: 100vh;
  overflow-y: auto !important;
}
.disease_search .autosuggest__results {
    overflow-y: auto;
  }
.autosuggest__results ul{
  margin: 0px !important;
}
#home_search input,#home_location input{
  border-color: transparent !important;
  border:none !important;
}
#home-sampling-field{
  display: none;
}
@media (max-width: 991px){
  .mobile_search_btn {
    top: 8px !important;
  }
 }
</style>