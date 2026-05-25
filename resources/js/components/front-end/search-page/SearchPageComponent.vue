<template>
  <div>
    <div v-if="loading" id="loader"></div>
    <div class="search-bg w-100 d-inline-block">
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-12 pl-xs-2 pr-xs-2 p-sm-2 p-sm-2 pl-md-2 pr-sm-2 p-lg-0">
            <!-- Banner Section Start -->
            
            <search-banner ref="searchBanner" :fileSystemDriver = "fileSystemDriver"></search-banner>
             <filter-section ref="searchFilter"></filter-section>
            <!-- Banner Section End -->
            <!-- Search Section Start -->
            <search-section
                :fileSystemDriver = "fileSystemDriver"
                :docs = "docs"
                :hosp = "hosp"
                :labs = "labs"
                :dise = "dise"
                :special = "special"
                :service = "allservices"
                :cities = "cities"
                :resultLocation="resultLocation"
            ></search-section> 
            <!-- Search Section End -->
            
            <!-- Search Page Filter Start -->
            <filters-section ref="searchFilters"></filters-section>
            <div v-if="type === 'laboratory' && type !== 'doctor' && resultSpeciality.length === 0 && resultService.length !== 0 && resultDisease.length !== 0 && resultSpeciality.description === null" class="w-100 d-inline-block pl-0 pr-0 pl-lg-5 pr-lg-5">

            </div>

            
            <!-- Search Page Filter End -->
          </div>
        </div>
        <div class="row">
          <div class="col-12 pl-xl-0">
            <div class="w-100 d-inline-block mb-2 mt-2">
                <p class="text-white text_13">
                  Last Updated On {{moment().format("dddd")}},
                      {{ moment().format("MMMM") }} {{ moment().format("DD") }}, {{ moment().format("YYYY") }}
                </p>
              </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div v-if="type !== 'laboratory'" class="bg-filter w-100 d-inline-block">
    <div class="container">
      <!-- <div class="row pt-3 pb-0">
        <div class="col-12">
          <div class="w-100 filter-main">
          <div class="all-btn text-center float-left listing-filter position-relative ml-1">
            <a v-if="activeFilters === false" @click="activateAllFilter()" class="bg-green book-rounded text-white text_12 d-inline-block" href="javascript:void(0)">
              All
            </a>
            <a v-else @click="clearAllFilter()" class="bg-green book-rounded text-white text_12 d-inline-block clear-button" href="javascript:void(0)">
              Clear Filter
              <span class="text-white ml-3 d-inline-block border-white rounded-pill circle-cross">
                <i class="fa fa-times" aria-hidden="true"></i>
              </span>
            </a>
          </div>
          <div class="text-center float-left listing-filter position-relative emergency">
      <a class="text_12 d-inline-block text-blue float-left" id="emergency"
      href="javascript:void(0)" 
      :class="{ activebtn: isActive.emergency }"
         @click="activate('emergency')">
         <span>
           <img class="float-left emergency-icon" src="/images/emergency-icon.png" alt="pictire">
         </span>
        Emergency
      </a>
       <span v-if="isActive.emergency === true">
        <span @click="removeFilter('emergency')" 
        class="cross" aria-hidden="true">
        <img class="position-absolute tick" src="/images/tick-image.png" alt="pictire">
        </span>
      </span>
      
    </div>
          <div class="text-center float-left listing-filter position-relative video-consultation">
      <a class="text_12 d-inline-block text-blue float-left" id="video_check"
      href="javascript:void(0)" 
      :class="{ activebtn: isActive.videoConsultation }"
      @click="activate('videoConsultation')">
        Video Consultation
      </a>
       <span v-if="isActive.videoConsultation === true">
        <span @click="removeFilter('videoConsultation')" 
        class="cross" aria-hidden="true">
        <img class="position-absolute tick" src="/images/tick-image.png" alt="pictire">
        </span>
      </span>
      
    </div>
    <div class="text-center float-left listing-filter position-relative 
    fee-range-btn">
      <a class="text-blue text_12 d-inline-block position-relative"
         href="javascript:void(0)" data-toggle="modal" data-target="#fee-range-modal" 
         :class="{ activebtn: isActive.feeRange }">
        Fee Range
      </a>
      <span v-if="isActive.feeRange === true">
        <span @click="removeFilter('feeRange')" 
        class="cross" aria-hidden="true">
        <img class="position-absolute tick" src="/images/tick-image.png" alt="pictire">
        </span>
      </span>
      
    </div>
          <div class="text-center float-left listing-filter position-relative most-experienced">
            <a id="experience" class="text_12 d-inline-block text-blue float-left" href="javascript:void(0)" 
            :class="{ activebtn: isActive.mostExperienced }"
            @click="activate('mostExperienced')">
              Most Experienced
            </a>
            <span v-if="isActive.mostExperienced === true">
              <span @click="removeFilter('mostExperienced')" 
              class="cross" aria-hidden="true">
              <img class="position-absolute tick" src="/images/tick-image.png" alt="pictire">
              </span>
            </span>
          </div>
          <div class="text-center float-left listing-filter position-relative fee-range-btn female-doctor">
            <a id="female" class="text-blue text_12 d-inline-block position-relative" href="javascript:void(0)" 
            :class="{ activebtn: isActive.femaleDoctor }"
            @click="activate('femaleDoctor')">
              Female Doctor
            </a>
            <span v-if="isActive.femaleDoctor === true">
              <span @click="removeFilter('femaleDoctor')" 
              class="cross" aria-hidden="true">
              <img class="position-absolute tick" src="/images/tick-image.png" alt="pictire">
              </span>
            </span>
          </div>
          <div class="text-center float-left listing-filter position-relative male-doctor">
            <a id="male" class="text_12 d-inline-block text-blue" 
            href="javascript:void(0)" 
            :class="{ activebtn: isActive.maleDoctor }"
            @click="activate('maleDoctor')">
              Male Doctor
            </a>
            <span v-if="isActive.maleDoctor === true">
              <span @click="removeFilter('maleDoctor')" 
              class="cross" aria-hidden="true">
              <img class="position-absolute tick" src="/images/tick-image.png" alt="pictire">
              </span>
            </span>
          </div>
          <div class="text-center float-left listing-filter position-relative available-today">
            <a id="available_today" class="text_12 d-inline-block text-blue" 
            href="javascript:void(0)" 
            :class="{ activebtn: isActive.availableToday }"
            @click="activate('availableToday')">
              Available Today
            </a>
            <span v-if="isActive.availableToday === true">
               <span @click="removeFilter('availableToday')" 
              class="cross" aria-hidden="true">
              <img class="position-absolute tick" src="/images/tick-image.png" alt="pictire">
              </span>
            </span>
          </div>
          <div class="text-center float-left listing-filter position-relative fee-range-btn time-slot">
            <a class="text-blue text_12 d-inline-block position-relative" 
            href="javascript:void(0)" data-toggle="modal" 
            data-target="#time-slot-modal" 
            :class="{ activebtn: isActive.timeSlot }">
              Time Slot
            </a>
            <span v-if="isActive.timeSlot === true">
              <span @click="removeFilter('timeSlot')" 
              class="cross" aria-hidden="true">
              <img class="position-absolute tick" src="/images/tick-image.png" alt="pictire">
              </span>
            </span>
          </div>
          <div class="text-center float-left listing-filter position-relative highest-rated">
            <a class="text_12 d-inline-block text-blue" 
            href="javascript:void(0)" 
            :class="{ activebtn: isActive.highestRated }"
            @click="activate('highestRated')">
              Highest Rated
            </a>
            <span v-if="isActive.highestRated === true">
              <span @click="removeFilter('highestRated')" 
              class="cross" aria-hidden="true">
              <img class="position-absolute tick" src="/images/tick-image.png" alt="pictire">
              </span>
            </span>
          </div>
          <div class="text-center float-left listing-filter position-relative clear-btn">
            <a @click="clearAllFilter()" class="bg-green book-rounded text-white text_12 d-inline-block" 
            href="javascript:void(0)">
              Clear Filter
              <span class="text-white ml-3 d-inline-block border-white rounded-pill">
                <i class="fa fa-times" aria-hidden="true"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      </div> -->
      <div class="row pt-3 pb-0">
      <div class="px-0 col-12 horizontal-scroll d-flex smart-bar center doc-card-shadow">
        <div class="listing-filter all-btn position-relative ml-1">
          <a v-if="activeFilters === false" @click="activateAllFilter()" class="bg-green book-rounded text-white text_12 d-inline-block" 
          href="javascript:void(0)">
              All
          </a>
          <a v-else @click="clearAllFilter()" class="bg-green book-rounded text-white text_12 d-inline-block clear-button" href="javascript:void(0)">
            Clear Filter
            <span class="text-white ml-3 d-inline-block border-white rounded-pill circle-cross">
              <i class="fa fa-times" aria-hidden="true" 
              style="margin-left: 3px;margin-top: 1px;font-size: 12px;"></i>
            </span>
          </a>
        </div>
        <div class="text-center float-left listing-filter position-relative video-consultation">
            <a class="text_12 d-inline-block text-blue" id="video_check"
      href="javascript:void(0)" 
      :class="{ activebtn: isActive.videoConsultation }"
      @click="activate('videoConsultation')">
        Video Consultation
      </a>
       <span v-if="isActive.videoConsultation === true">
        <span @click="removeFilter('videoConsultation')" 
        class="cross" aria-hidden="true">
        <img class="position-absolute tick" :src="basePath+'/images/tick-image.png'" alt="pictire">
        </span>
      </span>
        </div>
      <div class="text-center float-left listing-filter position-relative fee-range-btn">
          <a class="text-blue text_12 d-inline-block position-relative"
         href="javascript:void(0)" data-toggle="modal" data-target="#fee-range-modal" 
         :class="{ activebtn: isActive.feeRange }">
        Fee Range
      </a>
      <span v-if="isActive.feeRange === true">
        <span @click="removeFilter('feeRange')" 
        class="cross" aria-hidden="true">
        <img class="position-absolute tick" :src="basePath+'/images/tick-image.png'" alt="pictire">
        </span>
      </span>
      </div>
      <div class="text-center float-left listing-filter position-relative most-experienced">
          <a id="experience" class="text_12 d-inline-block text-blue" href="javascript:void(0)" 
            :class="{ activebtn: isActive.mostExperienced }"
            @click="activate('mostExperienced')">
              Most Experienced
            </a>
            <span v-if="isActive.mostExperienced === true">
              <span @click="removeFilter('mostExperienced')" 
              class="cross" aria-hidden="true">
              <img class="position-absolute tick" :src="basePath+'/images/tick-image.png'" alt="pictire">
              </span>
            </span>
      </div>
      <div class="text-center float-left listing-filter position-relative fee-range-btn female-doctor">
          <a id="female" class="text-blue text_12 d-inline-block position-relative" href="javascript:void(0)" 
            :class="{ activebtn: isActive.femaleDoctor }"
            @click="activate('femaleDoctor')">
              Female Doctor
            </a>
            <span v-if="isActive.femaleDoctor === true">
              <span @click="removeFilter('femaleDoctor')" 
              class="cross" aria-hidden="true">
              <img class="position-absolute tick" :src="basePath+'/images/tick-image.png'" alt="pictire">
              </span>
            </span>
      </div>
      <div class="text-center float-left listing-filter position-relative male-doctor">
          <a id="male" class="text_12 d-inline-block text-blue" 
            href="javascript:void(0)" 
            :class="{ activebtn: isActive.maleDoctor }"
            @click="activate('maleDoctor')">
              Male Doctor
            </a>
            <span v-if="isActive.maleDoctor === true">
              <span @click="removeFilter('maleDoctor')" 
              class="cross" aria-hidden="true">
              <img class="position-absolute tick" :src="basePath+'/images/tick-image.png'" alt="pictire">
              </span>
            </span>
      </div>
      <div class="text-center float-left listing-filter position-relative available-today">
          <a id="available_today" class="text_12 d-inline-block text-blue" href="javascript:void(0)" 
            :class="{ activebtn: isActive.availableToday }"
            @click="activate('availableToday')">
              Available Today
            </a>
            <span v-if="isActive.availableToday === true">
               <span @click="removeFilter('availableToday')" 
              class="cross" aria-hidden="true">
              <img class="position-absolute tick" :src="basePath+'/images/tick-image.png'" alt="pictire">
              </span>
            </span>
      </div>
      <div class="text-center float-left listing-filter position-relative fee-range-btn time-slot">
          <a class="text-blue text_12 d-inline-block position-relative" 
            href="javascript:void(0)" data-toggle="modal" 
            data-target="#time-slot-modal" 
            :class="{ activebtn: isActive.timeSlot }">
              Time Slot
            </a>
            <span v-if="isActive.timeSlot === true">
              <span @click="removeFilter('timeSlot')" 
              class="cross" aria-hidden="true">
              <img class="position-absolute tick" :src="basePath+'/images/tick-image.png'" alt="pictire">
              </span>
            </span>
      </div>
      <div class="text-center float-left listing-filter position-relative highest-rated">
          <a class="text_12 d-inline-block text-blue" 
            href="javascript:void(0)" 
            :class="{ activebtn: isActive.highestRated }"
            @click="activate('highestRated')">
              Highest Rated
            </a>
            <span v-if="isActive.highestRated === true">
              <span @click="removeFilter('highestRated')" 
              class="cross" aria-hidden="true">
              <img class="position-absolute tick" :src="basePath+'/images/tick-image.png'" alt="pictire">
              </span>
            </span>
      </div>
    </div>
    </div>
    </div>
  </div>
<section class="doctor_profile d-inline-block w-100 pt-3" 
    id="filter-section">
      <div :class=" type === 'laboratory' ? 'container' : 'container-fluid ' ">
        <!-- Bread Crumbs Start -->
      <!--   <bread-crumb-search
            :resultType="resultType"
            :resultLocation="resultLocation"
            :resultService="resultService"
            :resultDisease="resultDisease"
            :resultSpeciality="resultSpeciality"
            :resultKeywords="resultKeywords"
        ></bread-crumb-search>
 -->        <!-- Bread Crumbs End -->
        <!-- Search Page Filter Section Start -->
       
        <!-- Search Page Filter Section End -->
        <!--Laboratory Content Section Start-->
        <section class="doctor_profile d-inline-block w-100" v-if="type === 'laboratory'">
          <div class="container">
            <div class="row mt-4 mb-4 position-relative">
              <!-- <div class="col-12 col-lg-3 px-0 px-lg-3"> -->
                <!--Laboratory Test Filter Section Start-->
                <!-- <lab-filter-content
                    :tests="tests"
                    :users="usersData"
                ></lab-filter-content> -->
                <!--Laboratory Test Filter Section End-->
              <!-- </div> -->
              <div class="col-12 col-lg-12">
                <div class="w-80 d-block m-auto w-xs-100 w-sm-100 w-md-100 w-ipad-100">
                <!-- Start Lab Profile -->
                <div>
                  <lab-listing-tab
                      :fileSystemDriver = "fileSystemDriver"
                      :users="usersData"
                      :allLocations="cities"
                      :allLaboratories="laboratories"
                      :allTests="tests"
                  ></lab-listing-tab>

                </div>
                <div class="join-doctor-btn mt-4 text-center">
                <!--   <span v-if="doctorsToShow.length > 10">
                  <a href="javascript:void(0)" @click="doctorsToShow += 1" v-if="type === 'doctor'" class="rounded-pill knockdoc_btn_bg text-white p-2 btn_padding d-inline-block">
                    View doctors
                    <i aria-hidden="true" class="fa fa-arrow-right ml-1"></i>
                  </a>
                  </span> -->
               <!--    <span v-if="usersData.length > 10">
                  <a href="javascript:void(0)" @click="doctorsToShow += 1" v-if="type === 'hospital'" class="rounded-pill knockdoc_btn_bg text-white p-2 btn_padding d-inline-block">
                    View Hospital
                    <i aria-hidden="true" class="fa fa-arrow-right ml-1"></i>
                  </a>
                  </span> -->
                  <span class="more_option w-100 text-center d-inline-block" v-if="totalCount > usersData.length">
                    <a href="javascript:void(0)" @click="showMoreLabs" v-if="type === 'laboratory'" class="rounded-pill bg-blue text-white p-2 btn_padding d-inline-block border-0">
                      View Laboratory
                      <i aria-hidden="true" class="fa fa-arrow-right ml-1"></i>
                    </a>
                  </span>
                </div>
                <!-- End Lab Profile -->
              </div>
              </div>
            </div>
          </div>
        </section>
        <!--Laboratory Listing Section End-->
        <div class="row m-0" v-else-if="type === 'hospital'">
          <!-- Doctor Tabs Listings Component Start-->
          <div class="col-12 col-lg-12">
           <div class="w-80 d-block m-auto w-xs-100 w-sm-100 w-md-100 w-ipad-100">
              <!--Doctor Listing Section Start-->
              <hospital-listing-tab
                  :users="usersData"
                  :fileSystemDriver = "fileSystemDriver"
              ></hospital-listing-tab>
              <!--Doctor Listing Section End-->
            </div>
          </div>
          <!-- Doctor Tabs Listings Component End-->
          <!-- Map Section Component Start -->
          <!-- <div class="col-12 col-lg-3 pr-lg-0 d-xs-none d-sm-none d-md-none d-lg-block" style="margin-bottom: 50px;">
            <div class=" mt-4 mb-4 mb-lg-0 position-relative" style="display: flex; height: 100%;overflow: hidden;">
              <div class="map_btn position-absolute bg-white" v-bind:class="{ 'hide_map_btn': hideBtn }">
                <span v-on:click="expandmap">
                  <a href="javascript:void(0)" v-on:click="showHideMap = !showHideMap" class="map_toggle w-40px h_40 rounded-circle float-left text-white text-center mr-2"> <i class="fas fa-chevron-right align-middle" style="line-height: 40px;"></i> </a>
                </span>
                <span class="pt-2 pr-2 d-inline-block">Hide Map</span>
              </div>
              <div v-if="lati && usersData.length > 0" v-bind:class="{'toggle_map ': showHideMap}" class="google_map w-100 d-flex position-relative">
                <map-section></map-section>
              </div>
            </div>
          </div> -->
          <!-- <div class="col-12 col-lg-3 pr-lg-0 d-xs-none d-sm-none d-md-none d-lg-block" style="margin-bottom: 50px;">
            <div class=" mt-4 mb-4 mb-lg-0 position-relative" style="display: flex; height: 100%;overflow: hidden;">
              
            </div>
          </div> -->
          <!-- Map Section Component End -->
        </div>
        <!-- Search Page Content Start -->
        <div class="row m-0" v-else>
          <!-- Doctor Tabs Listings Component Start-->
          <div class="col-12 col-lg-12">
              <!--Doctor Listing Section Start-->
             <div class="w-80 d-block m-auto w-xs-100 w-sm-100 w-md-100 w-ipad-100">
              <doctor-tab
                  v-if="type === 'doctor'"
                  :usersData="usersData"
                  :patient="patientsData"
                  :speciality="resultSpeciality"
                  :fileSystemDriver = "fileSystemDriver"
              ></doctor-tab>
              <!--Doctor Listing Section End-->
            </div>
          </div>
        
          <!-- Doctor Tabs Listings Component End-->
          <!-- Map Section Component Start -->
          <!-- <div class="col-12 col-lg-3 pr-lg-0 d-xs-none d-sm-none d-md-none d-lg-block" style="margin-bottom: 50px;">
            <div class=" mt-4 mb-4 mb-lg-0 position-relative" style="display: flex; height: 100%;overflow: hidden;">
              <div class="map_btn position-absolute bg-white" v-bind:class="{ 'hide_map_btn': hideBtn }">
                <span  v-on:click="expandmap">
                  <a href="javascript:void(0)" v-on:click="showHideMap = !showHideMap" class="map_toggle w-40px h_40 rounded-circle float-left text-white text-center mr-2"> <i class="fas fa-chevron-right align-middle" style="line-height: 40px;"></i> </a>
                </span>
                <span class="pt-2 pr-2 d-inline-block">Hide Map</span>
              </div>
              <div v-if="lati && usersData.length > 0" v-bind:class="{'toggle_map ': showHideMap}" class="google_map w-100 d-flex position-relative">
                <map-section></map-section>
              </div>
            </div>
          </div> -->
           <!-- <div class="col-12 col-lg-3 pr-lg-0 d-xs-none d-sm-none d-md-none d-lg-block" style="margin-bottom: 50px;">
            <div class=" mt-4 mb-4 mb-lg-0 position-relative" style="display: flex; height: 100%;overflow: hidden;">
            </div>
          </div> -->
          <!-- Map Section Component End -->
          
        </div>
        <!-- Search Page Content End -->
      </div>
      <div v-if="type === 'doctor' && resultSpeciality.length !== 0 && resultService.length === 0 && resultDisease.length === 0 && resultSpeciality.description!==null" class="w-100 d-inline-block pl-0 pr-0 pl-lg-5 pr-lg-5">
    <div class="container">
      <section>
      <!-- <h1 class="pt-4 text_20 text-xs-16 font-weight-bold mb-0" v-if="resultLocation.length === 0 && resultService.length === 0 && resultDisease.length === 0 && resultSpeciality.length === 0 "></h1> -->
        <h1 class="text_20 text-xs-16 service-text font-weight-bold mb-0">Who is a {{ details.title }}?
        </h1>
        <div class="doctor-description w-100 d-inline-block mt-4 w-xs-100 pl-2 pl-lg-0 bg-white box_shadow box_radius mb-4">
          <div id="all-speciality-content" class="w-100 d-inline-block">
          <span class="pt-3 pl-3 pr-3 pb-0 w-100 d-inline-block"  
          v-html="details.description">
          </span>
        </div>
        <div class="read-more w-100 d-inline-block text-center mt-2 mb-2">
            <a v-if="showMore" id="show-more" @click="showMoreContent()" class="text-blue font-weight-bold text_15" href="javascript:void(0)">Read More
              <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </a>
            <a v-if="showLess" id="show-less" @click="showLessContent()" class="text-blue font-weight-bold text_15" href="javascript:void(0)">Read Less
              <i class="fa fa-angle-double-left" aria-hidden="true"></i>
            </a>
        </div>
          <!-- <div class="read-more-btn w-100 d-inline-block pb-3 text-center">
            <a class="text-white text_14 knockdoc_btn_bg box_radius font-weight-bold d-inline-block" 
            href="javascript:void(0)">
              <i class="fa fa-long-arrow-down pr-2" aria-hidden="true"></i>
              READ MORE
            </a>
          </div> -->
        </div>
    </section>
    </div>
  </div>
      <!--Search Page Detail Component Start-->
      <search-page-details
          :users="usersData"
          :resultLocation="resultLocation"
          :resultService="resultService"
          :resultDisease="resultDisease"
          :resultSpeciality="resultSpeciality"
          :cities="cities"
          :cities_pakistan="citiesPakistan"
          :location_areas="location_areas"
          :specialities="special"
          :labs="labs"
      ></search-page-details>
      <!--Search Page Detail Component End-->
      <!-- <span  v-if="type === 'doctor'">
        <span v-if="resultLocation.length === 0"></span>
        <span v-else>
        <div class="doctor-city bg-white pl-0 pr-0 pl-lg-5 pr-lg-5">
          <div class="container-fluid">
            <h2 v-if="this.resultLocation.title" class="pt-4 pb-3 text-xs-14 text_18">Different Areas of {{resultLocation.title}}</h2>
             <div class="row">
              <div class="col-12">
                <div class="bg-white p-4 mb-4 patient-doctor-box">
                  <div class="row mt-4">
                    <div v-for="(area, index) in resultLocation.areas" class="col-12 col-lg-3 col-md-4 col-sm-6" v-if="index <= 5">
                      <div class="areas_cards all-procedure text-center city-border mb-3">
                        <a class="text_black text_14 w-100 d-inline-block p-2" :href="'/doctors/'+resultLocation.slug+'/'+area.slug">{{ area.title }}</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </span>
      </span> -->
    </section>
    
    
    <!--Book Now Components Start-->
    <book-now-appointment-slots
        v-if="bookNowSlots"
        ref="bookNowAppointment"
        :fileSystemDriver = "fileSystemDriver"
    ></book-now-appointment-slots>
    <book-now-mobile-number
        v-if="bookNowMobile"
        v-model="selected_appointment_date"
        :hospital="selectedHospital"
        :slotSelected="slotSelected"
        :fileSystemDriver = "fileSystemDriver"
    ></book-now-mobile-number>
    <book-now-number-verification
        v-if="bookNowVerification"
        :hospital="selectedHospital"
        :slotSelected="slotSelected"
        :fileSystemDriver = "fileSystemDriver"
    ></book-now-number-verification>
    <book-now-final
        v-if="bookNowFinal"
        :fileSystemDriver = "fileSystemDriver"
    ></book-now-final>

<!--start fee range Modal -->
<div class="modal fade" id="fee-range-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header service-bg pl-4">
        <h5 class="modal-title text_14 text-white" 
        id="exampleModalLabel">
          Fee Range
        </h5>
        <button type="button" class="close text-white border-white p-0 m-0 d-inline-block rounded-pill font-weight-normal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pl-4">
        <div class="form-check fee-range-form mb-2">
          <input v-model="selectedfee" class="form-check-input" type="radio" name="exampleRadios1" id="exampleRadios1000" value="1000">
          <label class="form-check-label service-text text_14" 
          for="exampleRadios1000">
            Below Rs, 1000
          </label>
          </div>
          <div class="form-check fee-range-form mb-2">
          <input v-model="selectedfee" class="form-check-input" type="radio" name="exampleRadios2" id="exampleRadios2000" value="2000">
          <label class="form-check-label service-text text_14" 
          for="exampleRadios2000">
            Below Rs, 2000
          </label>
          </div>
          <div class="form-check fee-range-form mb-2">
          <input v-model="selectedfee" class="form-check-input" type="radio" name="exampleRadios3" id="exampleRadios3000" value="3000">
          <label class="form-check-label service-text text_14" 
          for="exampleRadios3000">
            Below Rs, 3000
          </label>
          </div>
          <div class="form-check fee-range-form">
          <input v-model="selectedfee" class="form-check-input" type="radio" name="exampleRadios4" id="exampleRadios4000" value="4000">
          <label class="form-check-label service-text text_14" 
          for="exampleRadios4000">
            Below Rs, 4000
          </label>
          </div>
      </div>
    </div>
  </div>
</div>
<!--end fee range Modal -->

<!--start time slot Modal -->
<div class="modal fade" id="time-slot-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header service-bg pl-4">
        <h5 class="modal-title text_14 text-white" 
        id="exampleModalLabel">
          Time Slot
        </h5>
        <button type="button" class="close text-white border-white p-0 m-0 d-inline-block rounded-pill font-weight-normal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pl-lg-4 pr-lg-4">
        <div class="row">
          <div class="col-12 mt-lg-0 mt-4 col-lg-6">
            <div class="w-100 d-inline-block time-slot-picker">
              <label class="w-100 d-inline-block service-text text_14">
                From
              </label>
              <vue-timepicker 
                id="time-pick"
                v-model="filterTimeFrom"
                format="HH:mm"
                required
                >
              </vue-timepicker>
            </div>
          </div>
            <div class="col-12 mt-lg-0 mt-4 col-lg-6">
            <div class="w-100 d-inline-block time-slot-picker">
              <label class="w-100 d-inline-block service-text text_14">
                To
              </label>
              <vue-timepicker 
                id="time-pick"
                v-model="filterTimeTo"
                format="HH:mm"
                required
                >
              </vue-timepicker>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end time slot Modal -->
  </div>

</template>

<script>
import VueTimepicker from 'vue2-timepicker'
import 'vue2-timepicker/dist/VueTimepicker.css'
import moment from 'moment';
  import Vue from 'vue'
  import Toasted from 'vue-toasted';
  import VueGeolocation from 'vue-browser-geolocation';
  Vue.use(VueGeolocation);
  Vue.use(Toasted)

  export default {
    components: { VueTimepicker },
    name: "SearchPageComponent",
    props: [

      'userData', 'resultLocation', 'resultService', 'labs', 'cities', 'dise', 'special',
      'resultDisease', 'resultSpeciality', 'patientsData', 'hosp', 'allservices', 'type', 'tests', 'docs','totalCount','citiesPakistan','location_areas','bread_crumb_data', 'fileSystemDriver'],
    data() {
      return {
        basePath:'',
        moment: moment,
        activeFilters:false,
        selectedfee: 0,
        filterTimeFrom:'',
        filterTimeTo:'',
         isActive: {
        videoConsultation: false,
        emergency: false,
        feeRange: false,
        timeSlot:false,
        mostExperienced:false,
        femaleDoctor:false,
        maleDoctor:false,
        highestRated:false,
        availableToday:false,
      },
        yourTimeValue: {
        HH: '10',
        mm: '05',
        ss: '00'
      },
        showMore:true,
        showLess:false,
        loading: false,
        usersData: this.userData,
        resultFaqs: [],
        page:1,
        page_type:'',
        locationResult: [],
        diseaseResult: [],
        serviceResult: [],
        specialityResult: [],
        hospitals: [],
        hospital: '',
        users: [],
        sort_by_hospital: false,
        hospital_name: '',
        fees_filter: false,
        sort_by_filter:false,
        fees_range: '',
        sort_by_filter: false,
        sort_by: '',
        showHideMap: false,
        selected_appointment_day: [],
        selected_appointment_date: [],
        selected_time: '',
        selectedHospital: [],
        bookNowType: '',
        hospitalFees: '',
        patientData: this.patientsData,
        selectedLocation: [],
        lati: '',
        slotSelected: false,
        bookNowMobile: false,
        bookNowVerification: false,
        bookNowFinal: false,
        bookNowSlots: false,
        details: [],
        verification_code: '',
        savedDoctor: [],
        availableData: '',
        doctorsToShow: 10,
        totalDoctors: 0,
        doctor_hospitals: [],
        hospitals_data: [],
        appointment: [],
        appointment_last_id: '',
        date: '',
        fees: 0,
        selectedAreaFilter:null,
        filters: false,
        infoWindow: {
          position: {lat: 0, lng: 0},
          open: false,
          template: ''
        },
        hideBtn: false,
      specialities: this.special,
      allDoctors: this.docs,
      allHospitals: [],
      diseases: this.dise,
      laboratories: this.labs,
      services: this.allservices,
      locations: this.cities,
      }
    },
  async  created() {
    this.searchTypeCheck();
      this.showPosition()
    //    const specs = await axios.get('/all-spec')
    // this.specialities = Object.freeze(specs.data)

    // const doc = await axios.get('/all-docs')
    // this.allDoctors = Object.freeze(doc.data) 

    // const hosp = await axios.get('/all-hosp')
    // this.allHospitals = Object.freeze(hosp.data)

    // const dis = await axios.get('/all-dise')
    // this.diseases = Object.freeze(dis.data)
    
    // const labs = await axios.get('/all-labs')
    // this.laboratories = Object.freeze(labs.data)

    // const sev = await axios.get('/all-services')
    // this.services = Object.freeze(sev.data)

    // const city = await axios.get('/all-cities')
    // this.locations = Object.freeze(city.data)
    },
      
    mounted() {
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
      var all_data = document.getElementById('all-speciality-content');
      localStorage.setItem('height', all_data.offsetHeight);
      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
          all_data.style.height = '225px';
        }else{
          all_data.style.height = '235px';
        }
      all_data.style.overflow = 'hidden';
    },
    beforeCreate() {
    },
    computed: {
      filteredList() {
        return this.hospitals.filter(hospital => {
          return (hospital.first_name+' '+hospital.last_name).toLowerCase().includes(this.search.toLowerCase())
        })
      },
      computedDate: function() {
        return this.date;
      },
      filteredListOfHospitals() {
        return this.hospitals.filter(hospital => {
          return (hospital.first_name+' '+hospital.last_name).toLowerCase().includes(this.search.toLowerCase())
        })
      }
    },
    watch: {
      selectedfee: function (val) {
      if (val === null) {
        this.clearFilters()
      }
      else {
        this.setFeeSelected(val)
      }
    },
    filterTimeFrom: function (val) {
        this.setFromTime(val)
    },  
    filterTimeTo: function (val) {
        this.setToTime(val)
    },
    },
    methods: {
       showMoreLabs(){
        if(this.doctorsToShow < this.usersData.length){
          this.doctorsToShow += 10; 
      
        }else{
          
          this.$parent.loading = true
          this.page = this.page+1;
          
         axios.get('/nextlaboratories', { params: { page: this.page } })
            .then((response) => {
              response.data.forEach((item) => { 
                  this.usersData.push(item);
              })
              this.$parent.loading = false
              this.doctorsToShow += 10;
            })
            .catch((error) => {
              // console.log(error);
            });
        }
    },
      setFeeSelected(value) {
      if (value === null) {

      }
      else {
        this.fees_filter = true
        this.fees_range = value
        this.activate('feeRange');
        const modal = document.querySelector('#fee-range-modal');
        $(modal).modal('hide');
      //   document.querySelector('#fee-range-modal').classList.remove('show');
      //   let element = document.querySelector('.modal-backdrop')
      // if (element) {
      //   element.remove(element.classList);
      // }
      }
    },
    setFromTime(value) {
      if (value === null) {

      }
      else {
        this.filterTimeFrom = value;
        if(this.filterTimeTo)
        {
           this.activate('timeSlot');
           
           const modalTime = document.querySelector('#time-slot-modal');
            $(modalTime).modal('hide');
        }
      }
    },
    setToTime(value) {
      if (value === null) {

      }
      else {
        this.filterTimeTo = value;
        if(this.filterTimeFrom)
        {
          this.activate('timeSlot');
          const modalTime = document.querySelector('#time-slot-modal');
            $(modalTime).modal('hide');
        }
      }
    },
      activate(name) {

      if(this.isActive[name])
      {
        this.isActive[name] = false;
        const hasAnyTrueValue = Object.values(this.isActive).some(value => value === true);
        if(hasAnyTrueValue === false)
        {
          this.activeFilters=false;
        }
        else
        {
          this.activeFilters=true;
        }

      }
      else
      {
        this.isActive[name] = true;
        this.activeFilters=true;

      }
      this.filterData();

    },
      removeFilter(name)
      { 

        // if (prevActive) {
          this.isActive[name] = false;
          const hasAnyTrueValue = Object.values(this.isActive).some(value => value === true);
          if(hasAnyTrueValue === false)
          {
            this.activeFilters=false;
          }
          else
          {
            this.activeFilters=true;
          }
        // }
         this.filterData();
      },
      activateAllFilter()
      {
        this.activeFilters=true;
         this.isActive= {
        videoConsultation: true,
        emergency: true,
        feeRange: false,
        timeSlot: false,
        mostExperienced:true,
        femaleDoctor: true,
        maleDoctor: true,
        highestRated: true,
        availableToday: true,
      };
         this.filterData();
      },
      clearAllFilter()
      {
        this.activeFilters=false;
          this.isActive= {
        videoConsultation: false,
        emergency: false,
        feeRange: false,
        timeSlot: false,
        mostExperienced:false,
        femaleDoctor: false,
        maleDoctor: false,
        highestRated: false,
        availableToday: false,
      };

          this.filterData();
      },
      showMoreContent(){
        var height = localStorage.getItem('height');
        var all_data = document.getElementById('all-speciality-content');
        all_data.style.height = height+'px';
        this.showLess = true;
        this.showMore = false;
      },
      showLessContent(){
        var all_data = document.getElementById('all-speciality-content');
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
          all_data.style.height = '225px';
        }else{
          all_data.style.height = '235px';
        }
        all_data.scrollIntoView({ behavior: 'smooth'});
        this.showLess = false;
        this.showMore = true;
      },
      searchTypeCheck () {
      if(this.resultLocation.length > 0  || this.resultLocation.length === undefined) {
        this.details = this.resultLocation;
        this.page_type='city-detail';
      }
      if(this.resultService.length > 0 || this.resultService.length === undefined) {
        this.details = this.resultService;
        this.page_type='service-detail';
      }
      if(this.resultDisease.length > 0  || this.resultDisease.length === undefined) {
        this.details = this.resultDisease;
        this.page_type='disease-detail';
      }
      if(this.resultSpeciality.length > 0 || this.resultSpeciality.length === undefined) {
        this.details = this.resultSpeciality;
        this.page_type='speciality-detail';
        
      }
    
    },
      expandmap(){
        this.hideBtn = !this.hideBtn;
      },
      startCallBack: function (x) {},
      endCallBack: function (x) {
            this.resendVerButton = !this.resendVerButton
        },
      jsonParseConvert() {
        if (this.resultDisease) {
          this.diseaseResult = JSON.parse(this.resultDisease)
        }
        if (this.resultLocation) {
          this.locationResult = JSON.parse(this.resultLocation)
        }
        if (this.resultService) {
          this.serviceResult = JSON.parse(this.resultService)
        }
        if (this.resultSpeciality) {
          this.specialityResult = JSON.parse(this.resultSpeciality)
        }

      },
      openInfoWindowTemplate (item) {
        this.loading = true
        this.setInfoWindowTemplate(item)
        this.infoWindow.position = {lat:Number(item.profile.latitude), lng:Number(item.profile.longitude)};
        this.infoWindow.open = true
        this.loading = false
      },
      setInfoWindowTemplate: function (marker) {
        this.infoWindow.template = `
        <div>
        <img src="${this.basePath+'/uploads/users/'+marker.profile.user_id+'/small-' + marker.profile.avatar}" :alt="marker.profile.avatar" :alt-text="marker.first_name + ' ' + marker.last_name">
          <h3>${marker.first_name+' '+marker.last_name}</h3> ${marker.profile.tagline}<br>
          ${marker.profile.address}<br>
          ${marker.assistant_phone_number}<br>
         </div>`;
        return this.infoWindow.template;
      },
      waitingTimeAverage (feedback) {
        this.loading = true
        let totalTime = 0
        feedback.forEach(function (time) {
          if (time.waiting_time !== 0) {
            totalTime = parseInt(time.waiting_time) + parseInt(totalTime)
          }
        })
        if (totalTime !== 0) {
          let wait =  Math.round(totalTime / feedback.length)
          if (wait === 1) {
            return ' Waiting Time 15 min '
          }
          else if (wait === 2) {
            return ' Waiting Time 30 min '
          }
          else if (wait === 3) {
            return ' Waiting Time 60 min '
          }
          else {
            return ' Waiting Time More then 1 hr '
          }
        }
        this.loading = false
      },
      clearFilters() {
        this.loading = true
        this.filters = false
        this.search = ''
        this.query = ''
        let checkbox = document.querySelectorAll("input[type=checkbox]")
        checkbox.forEach(item => {
          item.checked = false
        })
        let inputs = document.querySelectorAll("input[type=radio]")
        inputs.forEach(item => {
          item.checked = false
        })
        this.$refs.searchBanner.selectedHos = this.$refs.searchBanner.selectedSortBy = this.$refs.searchBanner.selectedfee = null
        this.$refs.searchFilters.selectedHos = this.$refs.searchFilter.selectedSortBy = this.$refs.searchFilters.selectedfee = null
        this.loading = false
        return this.usersData = this.userData
      },
      filterData()
      {
        let self = this
        self.loading = true
        let currentday = moment(this.date).format('ddd')
        this.usersData = this.userData;
        

         if(this.page_type === 'disease-detail')
          {
            var area=this.selectedAreaFilter;
            if(this.fees_filter === false)
            {
               var fee=false;
            }
            else
            {
               var fee =this.fees_range;
            }

            if(this.filterTimeTo && this.filterTimeFrom)
            {
               var filterTimeTo=this.filterTimeTo;
               var filterTimeFrom=this.filterTimeFrom;
            }
            else
            {
               var filterTimeTo=false;
               var filterTimeFrom=false;
            }
            // var base = window.location.origin;
            var slug=this.resultDisease.slug;
            var location=this.resultLocation;
            var availableToday=this.isActive.availableToday
            var experience= this.isActive.mostExperienced;
            var videoConsultation= this.isActive.videoConsultation;
            var male=this.isActive.maleDoctor;
            var female=this.isActive.femaleDoctor;
            var highest_rated=this.isActive.highestRated;
            var timeSlot= this.isActive.timeSlot;

            axios.get('/diseases/'+slug+'/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee+'/'+male+'/'+female+'/'+highest_rated+'/'+timeSlot+'/'+filterTimeTo+'/'+filterTimeFrom)
            .then(response=>{
              this.usersData=response.data;
              this.loading=false;

            })

          }
          if(this.page_type === 'speciality-detail')
          {
            var area=this.selectedAreaFilter;
            if(this.fees_filter === false)
            {
               var fee=false;
            }
            else
            {
               var fee =this.fees_range;
            }
             if(this.filterTimeTo && this.filterTimeFrom)
            {
               var filterTimeTo=this.filterTimeTo;
               var filterTimeFrom=this.filterTimeFrom;
            }
            else
            {
               var filterTimeTo=false;
               var filterTimeFrom=false;
            }
            // var base = window.location.origin;
            var slug=this.resultSpeciality.slug;
            var location=this.resultLocation;
            var availableToday=this.isActive.availableToday
            var experience= this.isActive.mostExperienced;
            var videoConsultation= this.isActive.videoConsultation;
            var male=this.isActive.maleDoctor;
            var female=this.isActive.femaleDoctor;
            var highest_rated=this.isActive.highestRated;
            var timeSlot= this.isActive.timeSlot;

            axios.get('/speciality/'+slug+'/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee+'/'+male+'/'+female+'/'+highest_rated+'/'+timeSlot+'/'+filterTimeTo+'/'+filterTimeFrom)
            .then(response=>{
              this.usersData=response.data;
              this.loading=false;

            })

          }
          if(this.page_type === 'service-detail')
          {
            var area=this.selectedAreaFilter;
            if(this.fees_filter === false)
            {
               var fee=false;
            }
            else
            {
               var fee =this.fees_range;
            }
             if(this.filterTimeTo && this.filterTimeFrom)
            {
               var filterTimeTo=this.filterTimeTo;
               var filterTimeFrom=this.filterTimeFrom;
            }
            else
            {
               var filterTimeTo=false;
               var filterTimeFrom=false;
            }
            // var base = window.location.origin;
            var slug=this.resultService.slug;
            var location=this.resultLocation;
            var availableToday=this.isActive.availableToday
            var experience= this.isActive.mostExperienced;
            var videoConsultation= this.isActive.videoConsultation;
            var male=this.isActive.maleDoctor;
            var female=this.isActive.femaleDoctor;
            var highest_rated=this.isActive.highestRated;
            var timeSlot= this.isActive.timeSlot;

            axios.get('/treatments/'+slug+'/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee+'/'+male+'/'+female+'/'+highest_rated+'/'+timeSlot+'/'+filterTimeTo+'/'+filterTimeFrom)
            .then(response=>{
              this.usersData=response.data;
              this.loading=false;

            })

          }
          if(this.page_type === 'city-detail')
          {
            var area=this.selectedAreaFilter;
            if(this.fees_filter === false)
            {
               var fee=false;
            }
            else
            {
               var fee =this.fees_range;
            }
             if(this.filterTimeTo && this.filterTimeFrom)
            {
               var filterTimeTo=this.filterTimeTo;
               var filterTimeFrom=this.filterTimeFrom;
            }
            else
            {
               var filterTimeTo=false;
               var filterTimeFrom=false;
            }
            // var base = window.location.origin;
            var location=this.resultLocation;
            var availableToday=this.isActive.availableToday
            var experience= this.isActive.mostExperienced;
            var videoConsultation= this.isActive.videoConsultation;
            var male=this.isActive.maleDoctor;
            var female=this.isActive.femaleDoctor;
            var highest_rated=this.isActive.highestRated;
            var timeSlot= this.isActive.timeSlot;

            axios.get('/doctors/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee+'/'+male+'/'+female+'/'+highest_rated+'/'+timeSlot+'/'+filterTimeTo+'/'+filterTimeFrom)
            .then(response=>{
              this.usersData=response.data;
              this.loading=false;

            })

          }
       



      },
       // filterData () {
//         let self = this
//         self.loading = true
//         let currentday = moment(this.date).format('ddd')
//         this.usersData = this.userData
//         /*let e = document.getElementById('sort_by_hospital')*/

//         // let male = false
//         // let female = false
//         // let availableToday = false
//         // let experience = false
//         // let videoConsultation = false
//         // let available_next_7_days = false
//         // let available_next_3_days = false
//         // let available_tomorrow = false
//         // let emergency = false
//         if (this.type === 'doctor') {
//             emergency = document.querySelector('#emergency').checked ? true : false;
//             console.log('adadadda',emergency);
//           // male = document.querySelector('#male').checked || document.querySelector('#mobile_male').checked ? true : false
//           // female = document.querySelector('#female').checked || document.querySelector('#mobile_female').checked ? true : false
//           // availableToday = document.querySelector('#available_today').checked || document.querySelector('#mobile_available_today').checked ? true : false
//           //  experience = document.querySelector('#experience').checked || document.querySelector('#mobile_experience').checked ? true : false
//           // videoConsultation = document.querySelector('#video_check').checked || document.querySelector('#mobile_video_check').checked ? true : false
          
//         }
//         if(
//             this.usersData.length &&
//             availableToday &&
//             videoConsultation && experience &&
//             this.sort_by_hospital &&
//             this.fees_filter 
//         ) {

//         }

// /*Video Consultation Filter Start*/
        
//         // if (videoConsultation) {
            
//         //     this.loading=true;
         
//         //  if(this.page_type === 'disease-detail')
//         //  {
//         //    var area=this.selectedAreaFilter;
//         //    if(this.fees_filter === false)
//         //    {
//         //       var fee=false;
//         //    }
//         //    else
//         //    {
//         //       var fee =this.fees_range;
//         //    }
//         //    // var base = window.location.origin;
//         //    var slug=this.resultDisease.slug;
//         //    var location=this.resultLocation;
           
//         //    axios.get('/diseases/'+slug+'/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//         //    .then(response=>{
//         //      this.usersData=response.data;
//         //    })

//         //  }
//         //  if(this.page_type === 'speciality-detail')
//         //  {
//         //    var area=this.selectedAreaFilter;
//         //    if(this.fees_filter === false)
//         //    {
//         //       var fee=false;
//         //    }
//         //    else
//         //    {
//         //       var fee =this.fees_range;
//         //    }
//         //    // var base = window.location.origin;
//         //    var slug=this.resultSpeciality.slug;
//         //    var location=this.resultLocation;
           
//         //    axios.get('/speciality/'+slug+'/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//         //    .then(response=>{
//         //      this.usersData=response.data;
//         //      this.loading=false;

//         //    })

//         //  }
//         //  if(this.page_type === 'service-detail')
//         //  {
//         //    var area=this.selectedAreaFilter;
//         //    if(this.fees_filter === false)
//         //    {
//         //       var fee=false;
//         //    }
//         //    else
//         //    {
//         //       var fee =this.fees_range;
//         //    }
//         //    // var base = window.location.origin;
//         //    var slug=this.resultService.slug;
//         //    var location=this.resultLocation;
           
//         //    axios.get('/treatments/'+slug+'/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//         //    .then(response=>{
//         //      this.usersData=response.data;
//         //      this.loading=false;

//         //    })

//         //  }
//         //  if(this.page_type === 'city-detail')
//         //  {
//         //    var area=this.selectedAreaFilter;
//         //    if(this.fees_filter === false)
//         //    {
//         //       var fee=false;
//         //    }
//         //    else
//         //    {
//         //       var fee =this.fees_range;
//         //    }
//         //    // var base = window.location.origin;
//         //    var location=this.resultLocation;
           
//         //    axios.get('/doctors/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//         //    .then(response=>{
//         //      this.usersData=response.data;
//         //      this.loading=false;

//         //    })

//         //  }

//         // }
//         /*Video Consultation Filter End*/

//         /*Gender Filter Start*/

//         // if (male && female) {
//         //   this.usersData = this.usersData.filter(function(a){
//         //     return a.profile.gender === 'male' || a.profile.gender === 'female'
//         //   })
//         // }
//         // else if (male) {
          
//         //   this.usersData = this.usersData.filter(function(a){
//         //     return a.profile.gender === 'male'
//         //   })
//         // }
//         // else if (female) {
//         //   this.usersData.filter(function(a){
//         //   });
//         //   this.usersData = this.usersData.filter(function(a){
//         //     return a.profile.gender === 'female'
//         //   })
//         // }
//         /*Gender Filter End*/
        
//         /*Available Today Start*/
//         if (availableToday) {
//           this.loading=true;
//           if(this.page_type === 'disease-detail')
//          {
//            var area=this.selectedAreaFilter;
//            if(this.fees_filter === false)
//            {
//               var fee=false;
//            }
//            else
//            {
//               var fee =this.fees_range;
//            }
//            // var base = window.location.origin;
//            var slug=this.resultDisease.slug;
//            var location=this.resultLocation;
           
//            axios.get('/diseases/'+slug+'/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//            .then(response=>{
//              this.usersData=response.data;
//              this.loading=false;

//            })

//          }
//          if(this.page_type === 'speciality-detail')
//          {
//            var area=this.selectedAreaFilter;
//            if(this.fees_filter === false)
//            {
//               var fee=false;
//            }
//            else
//            {
//               var fee =this.fees_range;
//            }
//            // var base = window.location.origin;
//            var slug=this.resultSpeciality.slug;
//            var location=this.resultLocation;
           
//            axios.get('/speciality/'+slug+'/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//            .then(response=>{
//              this.usersData=response.data;
//              this.loading=false;

//            })

//          }
//          if(this.page_type === 'service-detail')
//          {
//            var area=this.selectedAreaFilter;
//            if(this.fees_filter === false)
//            {
//               var fee=false;
//            }
//            else
//            {
//               var fee =this.fees_range;
//            }
//            // var base = window.location.origin;
//            var slug=this.resultService.slug;
//            var location=this.resultLocation;
           
//            axios.get('/treatments/'+slug+'/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//            .then(response=>{
//              this.usersData=response.data;
//              this.loading=false;

//            })

//          }
//          if(this.page_type === 'city-detail')
//          {
//            var area=this.selectedAreaFilter;
//            if(this.fees_filter === false)
//            {
//               var fee=false;
//            }
//            else
//            {
//               var fee =this.fees_range;
//            }
//            // var base = window.location.origin;
//            var location=this.resultLocation;
           
//            axios.get('/doctors/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//            .then(response=>{
//              this.usersData=response.data;
//              this.loading=false;

//            })

//          }

         
//         }
//         /*Available Today End*/
       
//        if (experience) {
//           self.loading=true;
//             if(this.page_type === 'disease-detail')
//          {
//            var area=this.selectedAreaFilter;
//            if(this.fees_filter === false)
//            {
//               var fee=false;
//            }
//            else
//            {
//               var fee =this.fees_range;
//            }
//            // var base = window.location.origin;
//            var slug=this.resultDisease.slug;
//            var location=this.resultLocation;
           
//            axios.get('/diseases/'+slug+'/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//            .then(response=>{
//              this.usersData=response.data;
//              this.loading=false;

//            })

//          }
//          if(this.page_type === 'speciality-detail')
//          {
//            var area=this.selectedAreaFilter;
//            if(this.fees_filter === false)
//            {
//               var fee=false;
//            }
//            else
//            {
//               var fee =this.fees_range;
//            }
//            // var base = window.location.origin;
//            var slug=this.resultSpeciality.slug;
//            var location=this.resultLocation;
           
//            axios.get('/speciality/'+slug+'/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//            .then(response=>{
//              this.usersData=response.data;
//              this.loading=false;

//            })

//          }
//          if(this.page_type === 'service-detail')
//          {
//            var area=this.selectedAreaFilter;
//            if(this.fees_filter === false)
//            {
//               var fee=false;
//            }
//            else
//            {
//               var fee =this.fees_range;
//            }
//            // var base = window.location.origin;
//            var slug=this.resultService.slug;
//            var location=this.resultLocation;
           
//            axios.get('/treatments/'+slug+'/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//            .then(response=>{
//              this.usersData=response.data;
//              this.loading=false;


//            })

//          }
//          if(this.page_type === 'city-detail')
//          {
//            var area=this.selectedAreaFilter;
//            if(this.fees_filter === false)
//            {
//               var fee=false;
//            }
//            else
//            {
//               var fee =this.fees_range;
//            }
//            // var base = window.location.origin;
//            var location=this.resultLocation;
           
//            axios.get('/doctors/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//            .then(response=>{
//              this.usersData=response.data;
//              this.loading=false;

//            })

//          }
          
//           }
//         /*Hospital Filter End*/
//         /*Fee Filter Start*/
//         if (this.fees_filter) {
//            this.loading=true;
          
//             if(this.page_type === 'disease-detail')
//          {
//            var area=this.selectedAreaFilter;
//            if(this.fees_filter === false)
//            {
//               var fee=false;
//            }
//            else
//            {
//               var fee =this.fees_range;
//            }
//            // var base = window.location.origin;
//            var slug=this.resultDisease.slug;
//            var location=this.resultLocation;
//            self.loading = true;
//            axios.get('/diseases/'+slug+'/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//            .then(response=>{
//              this.usersData=response.data;
//              this.loading=false;


//            })

//          }
//          if(this.page_type === 'speciality-detail')
//          {
//            var area=this.selectedAreaFilter;
//            if(this.fees_filter === false)
//            {
//               var fee=false;
//            }
//            else
//            {
//               var fee =this.fees_range;
//            }
//            // var base = window.location.origin;
//            var slug=this.resultSpeciality.slug;
//            var location=this.resultLocation;
           
//            axios.get('/speciality/'+slug+'/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//            .then(response=>{
//              this.usersData=response.data;
//              this.loading=false;
             
//            })

//          }
//          if(this.page_type === 'service-detail')
//          {
//            var area=this.selectedAreaFilter;
//            if(this.fees_filter === false)
//            {
//               var fee=false;
//            }
//            else
//            {
//               var fee =this.fees_range;
//            }
//            // var base = window.location.origin;
//            var slug=this.resultService.slug;
//            var location=this.resultLocation;
           
//            axios.get('/treatments/'+slug+'/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//            .then(response=>{
//              this.usersData=response.data;
//              this.loading=false;

//            })

//          }
//          if(this.page_type === 'city-detail')
//          {
//            var area=this.selectedAreaFilter;
//            if(this.fees_filter === false)
//            {
//               var fee=false;
//            }
//            else
//            {
//               var fee =this.fees_range;
//            }
//            // var base = window.location.origin;
//            var location=this.resultLocation;
           
//            axios.get('/doctors/'+location+'/'+area+'/filters/'+videoConsultation+'/'+availableToday+'/'+experience+'/'+fee)
//            .then(response=>{
//              this.usersData=response.data;
//              this.loading=false;

//            })

//          }
         
         
//         }
//         /*Fee Filter End*/
//        /* sorting section filter */
        
          
//           // if (this.sort_by_filter === 'Fee high to low') {
//           //   this.usersData.sort(function (a, b) {
//           //     if (a.profile.starting_price < b.profile.starting_price) { return -1 }
//           //     if (a.profile.starting_price > b.profile.starting_price) { return 1 }
//           //     return 0
//           //   })
//           // }
//           // if (this.sort_by_filter === 'Fee low to high') {
//           //   this.usersData.sort(function (a, b) {
//           //     if (a.profile.starting_price > b.profile.starting_price) { return -1 }
//           //     if (a.profile.starting_price < b.profile.starting_price) { return 1 }
//           //     return 0
//           //   })
//           // }
         
        
//        /* sorting section filter End*/

//         this.filters = !(
//             availableToday &&
//             videoConsultation &&
//             available_next_7_days &&
//             available_next_3_days &&
//             available_tomorrow &&
//             experience &&
//             this.sort_by_hospital === null &&
//             this.fees_filter === null
//         );
//         self.loading = false
//         return self.usersData;
//       },
      prev: function () {
        this.steps--
      },
      next: function () {
        this.steps++
      },
      videoConsul (doc) {
        let result = false
        doc.doc_teams.forEach(function (team) {
          if (team.user_id === 'online') {
            result = true
          }
        })
        return result;
      },
      getDayName: function () {
        var currentDate = new Date();
        var weekday = new Array(7);
        weekday[0] = "sun";
        weekday[1] = "mon";
        weekday[2] = "tue";
        weekday[3] = "wed";
        weekday[4] = "thu";
        weekday[5] = "fri";
        weekday[6] = "sat";
        return weekday[currentDate.getDay()];
      },
      getNext7DaysName: function () {
        var day = [];
        day.push((moment().format('ddd')).toLowerCase().trim());
        day.push((moment().add(1, 'day').format('ddd')).toLowerCase().trim());
        day.push((moment().add(2, 'day').format('ddd')).toLowerCase().trim());
        day.push((moment().add(3, 'day').format('ddd')).toLowerCase().trim());
        day.push((moment().add(4, 'day').format('ddd')).toLowerCase().trim());
        day.push((moment().add(5, 'day').format('ddd')).toLowerCase().trim());
        day.push((moment().add(6, 'day').format('ddd')).toLowerCase().trim());
        return day;
      },
      getNext3DaysName: function () {
        var day = [];
        day.push((moment().format('ddd')).toLowerCase().trim());
        day.push((moment().add(1, 'day').format('ddd')).toLowerCase().trim());
        day.push((moment().add(2, 'day').format('ddd')).toLowerCase().trim());
        return day;
      },
      getNextName: function () {
        var day = [];
        day.push((moment().add(1, 'day').format('ddd')).toLowerCase().trim());
        return day;
      },
      getCurrentUsersSaved: function () {
        let self = this;
        axios.get(APP_URL + '/getCurrentUsersSaved')
          .then(function (response) {
            if(response.data != null){
              if(response.data.saved_doctors.length > 0) {
                self.savedDoctor = JSON.parse(response.data.saved_doctors);
              }
              if(response.data.saved_hospital != null) {
                self.savedHospital = response.data.saved_hospital;
              }
            }
          })
      },
      showPosition: function() {
        navigator.geolocation.getCurrentPosition(pos => {
          this.lati = pos;
        }, err => {
        })

      },
      getAllUsers: function () {
        let self = this;
        axios.get(APP_URL + '/getAllDoctors')
          .then(function (response) {
            self.allHospitals = response.data.hospitals;
          })
      },
      showModal: function (doc, type) {
        let patientLogged = false
        let self = this
        self.loading = true
        self.bookNowSlots = false
        this.steps = 0
        let hospitaldata = [];
        this.doctor_data = [];
        this.doctor_data = doc;
        self.doctor_hospitals = [];
        self.bookNowType = type
        if (type === 'visit') {
          let index = this.usersData.findIndex(x => x.id === doc.id);
          self.hospitals_data = self.usersData[index].doc_teams;
          self.allHospitals= self.hospitals_data;
          
          self.hospitals_data.forEach(function (hospital) {
            let consultation_fee = ''
            consultation_fee = hospital.price
            if (hospital.user_id !== 'online') {
              hospitaldata = []
              // hospitaldata = self.allHospitals.find(x => x.id === JSON.parse(hospital.user_id))
              hospitaldata=hospital;
              if (hospitaldata !== undefined) {
                self.doctor_hospitals.push({
                  'id': hospitaldata.hospital.id,
                  'name': hospitaldata.hospital.first_name + ' ' + hospitaldata.hospital.last_name,
                  'first_name' : hospitaldata.hospital.first_name,
                  'last_name' : hospitaldata.hospital.last_name,
                  'avatar': hospitaldata.hospital.profile.avatar,
                  'fees': consultation_fee
                })
              }
              self.bookNowSlots = true
              self.loading = false
            }
          })
        }
        if (type === 'online') {
          let onlineTeam = ''
          let consultation_fee = ''
          doc.onlines.forEach(function (team) {
              
                onlineTeam = team

            })
          hospitaldata = []
          if (onlineTeam !== '') {
            consultation_fee = JSON.parse(onlineTeam.price)
            self.doctor_hospitals.push({
              'id': 'online',
              'name': 'Online Consultation',
              'fees' : consultation_fee,
              'avatar' : 'video'
            })
            self.loading = false
            self.bookNowSlots = true
          }
          self.selectedHospital = 'online'
        }
        if (self.doctor_hospitals.length < 1) {
          self.loading = false;
          Vue.toasted.error('Slot Not Available' , { duration: 3000 })
        }
      },
      resendCode: function(){
          let self = this
          self.resendVerButton = !self.resendVerButton
          self.loading = true
          let form_errors = []
            let user_phone = self.patientData.phone_number;
            axios.post(APP_URL + '/user/resend-code', {
                number: user_phone,
            }).then(function (response) {
                self.endTime = (new Date).getTime()+60000
                self.loading = false
            }).catch(function (error) {
                form_errors.push(Vue.prototype.trans(error));
                form_errors.forEach(element => {
                    self.showError(element)
                });
            });
        },
      checkAppointmentStep1: function () {
        let self = this
          self.loading = true
          let form_errors = [];
          var patient = jQuery("input[name='patient']:checked").val();
          var slotChecked = jQuery("input[name='appointment[time]']:checked").val();
          if (patient == 'someone') {
            var patient_name = document.getElementById('patient_name').value;
            if (!patient_name) form_errors.push(Vue.prototype.trans('lang.patient_name_req'));
            if (!document.getElementById('relation').value) form_errors.push(Vue.prototype.trans('lang.select_relation_req'));
            form_errors.forEach(element => {
              this.showError(element)
            });
            if (form_errors.length > 0) {
              return false;
            }

          }
          if (slotChecked !== undefined) {
            var timeSlot = document.getElementsByName('appointment[time]');
            var isTimeSlot = false;
            for (var i = 0; i < timeSlot.length; i++) {
              if (timeSlot[i].checked) {
                isTimeSlot = true;
                break;
              }
            }
            if (isTimeSlot === true) {
              let submitAppointmentForm = document.getElementById('submit_appointment_form')
              let formData = new FormData(submitAppointmentForm)
              let a_date = formData.get('appointment[date]')
              let a_day = formData.get('appointment[day]')
              let a_type = formData.get('type')
              if (a_date === "" || a_day === "") {
                a_date = document.getElementsByName('appointment[date]').value
                a_day = document.getElementsByName('appointment[day]').value
              }
              formData.append('appointment[date]', a_date)
              formData.append('appointment[day]', a_day)
              formData.append('type', a_type)

              axios.post(APP_URL + '/store-appointment-data', formData)
                .then(function (response) {
                  self.appointment.patient = response.data.patient;
                  self.appointment.comments = response.data.comments;
                  self.appointment.date = response.data.date;
                  self.appointment.day = response.data.day;
                  self.appointment.hospital = response.data.hospital;
                  self.appointment.patient_name = response.data.patient_name;
                  self.appointment.relation = response.data.relation;
                  self.appointment.speciality = response.data.speciality;
                  self.appointment.time = response.data.time;
                  self.appointment.total_charges = response.data.total_charges;
                  self.appointment.type = response.data.type;
                  self.loading = false
                  self.next();
                })
            } else {
              this.showError(Vue.prototype.trans('lang.select_appointment_time'))
              return false;
            }
          } else {
            form_errors.push(Vue.prototype.trans('Select slot first'))
            form_errors.forEach(element => {
              this.showError(element)
            })
            /*this.showError(Vue.prototype.trans('lang.hospital_req'))*/
            return false
          }
        },
      checkAppointmentStep3: function () {
          let self = this
          self.loading = true
          let user_id = self.patientData.id
          axios.post(APP_URL + '/verify-appointment-code', {
            code: self.appointment.code,
          })
            .then(function (response) {
              if (response.data.type == 'success') {
                self.submitAppointment(user_id);
              } else if (response.data.type == 'error') {
                  self.loading = false
                self.showError(response.data.message);
              }
            })
        },
      finalStep: function (online_appointment) {
          if (online_appointment == true) {
            window.location.replace(APP_URL + '/checkout/' + this.appointment_last_id)
          }
          else {
            window.location.replace(APP_URL + '/patient/appointments/' + this.appointment_last_id)
          }
        },
      onClose: function() {
        let self = this
        self.bookNowSlots = false
        self.loading = true
        self.step = 1;
        self.appointment.patient = ''
        self.appointment.comments = ''
        self.appointment.date = ''
        self.appointment.day = ''
        self.appointment.hospital = ''
        self.appointment.patient_name = ''
        self.appointment.relation = ''
        self.appointment.speciality = ''
        self.appointment.time = ''
        self.appointment.total_charges = ''
        self.appointment.type = ''
        self.appointment.code = ''
        self.doctor_id = ''
        self.loading = false
      },
      availableDaysNames: function (dayNames, id) {
        let self = this
        var days = []
        if (dayNames !== null && dayNames !== [] && dayNames !== '') {
          dayNames = JSON.parse(dayNames)
          let weekDays = moment.weekdaysShort()
          weekDays.forEach(function (day) {
            if(dayNames.includes(day.toLowerCase())) {
              days.push('<em class="dc-available"> '+day+' </em>')
            }
            else {
              days.push('<em class="dc-dayon"> '+day+' </em>')
            }
          })
        }
        else {
          days.push('<em class="dc-dayon"> Not Available </em>')
        }


        return (JSON.stringify(days).replace(/[\\[\]"]+/g, ''))

      },
      appointmentStatusMessage: function () {
        let self = this
        let appointmentData = self.appointment
        let appointmentTime = self.appointment.time
        let appointmentDate = self.appointment.date
        let appointmentDay = self.appointment.day
        axios.post(APP_URL + '/user/appointmentbookingstatus', {
          appointmentData: self.appointment,
          appointmentTime: appointmentTime,
          appointmentDate: appointmentDate,
          appointmentDay: appointmentDay,
          patientData: self.patientData,
          doctorData: self.doctor_data,
        })
          .then(function (response) {
              if (response.data.type == 'success') {

              } else if (response.data.type == 'error') {

              }
          })
      },
      showMobileModal: function () {
        this.slotSelected = true
        this.bookNowMobile = true

        this.loading = false

        document.querySelector('#modal_patient_num').style.display = 'none'
        document.querySelector('#modal_patient_num').classList.remove('show')
        /*document.querySelector('#modal_patient_num').classList.remove('abc')*/
      },
      showAuthentication: function () {
        this.slotSelected = true
        this.bookNowMobile = false
        this.bookNowVerification = false

        document.querySelector('#mobile_number_detail').style.display = 'none'
        document.querySelector('#mobile_number_detail').classList.remove('show')
        /*document.querySelector('#mobile_number_detail').classList.remove('abc')*/

        /*document.querySelector('#mobile_number_verification').style.display = 'block'
        document.querySelector('#mobile_number_verification').classList.add('show')*/
        /*document.querySelector('#mobile_number_verification').classList.add('abc')*/
        this.loading = false
      },
      showFinalModal: function () {
        this.submitAppointment(this.patientData.id)
        this.bookNowMobile = false
        this.bookNowFinal = true
        document.querySelector('#mobile_number_detail').style.display = 'none'
        document.querySelector('#mobile_number_detail').classList.remove('show')

        document.querySelector('#book_now_final').classList.add('show')
        /*document.querySelector('#book_now_final').classList.add('abc')*/
        document.querySelector('#book_now_final').style.display = "block"
        this.loading = false
      },
      submitAppointment: function (id) {
        let self = this;
        self.loading = true;
        self.appointment.user_id = id;
        axios.post(APP_URL + '/submit-appointment', {
          date : self.selected_appointment_date,
          day : self.selected_appointment_day,
          hospital : self.selectedHospital.id,
          patient_name : self.appointment.patient_name,
          time : self.selected_time,
          total_charges : self.hospitalFees,
          type : self.bookNowType,
          code : self.verification_code,
          user_id : self.doctor_data.id,
        }).then(function (response) {
          if (response.data.type === 'success') {
            self.appointment_last_id = ''
            self.appointment_last_id = response.data.appointment_id;
            if (self.bookNowType === 'online') {

            }
            else {
              self.loading = false;
              self.next();
            }
          } else if (response.data.type == 'error') {
            self.loading = false;
            self.showError(response.data.message);
          }
        })
            .catch(error => {});
      },
      selectedCity(result) {
      if (this.resultSpeciality  != '') {
          /*  dermatologist-in-lahore  */
          window.location.href = '/'+this.resultSpeciality.slug+'-in-'+result.item.slug
        }
        if (this.resultService  != '') {
          window.location.href = '/treatments/'+this.resultService.slug +'/' + result.item.slug
        }
        
        if (this.resultDisease != '' ) {
          window.location.href = '/diseases/'+this.resultDisease.slug +'/' + result.item.slug
        }
    },
     selectedItem(result) {
      if (this.resultLocation != 'pakistan') {
        if (result.label === 'Doctors') {
          window.location.href = '/doctors/'+result.item.location.slug+'/'+result.item.specialities[0].slug+'/'+result.item.slug
        }
        else if (result.label === 'Hospitals') {
          window.location.href = '/hospitals/'+result.item.location.slug+'/'+result.item.slug
        }
        else if (result.label === 'Specialities') {
          /*  dermatologist-in-lahore  */
          window.location.href = '/'+result.item.slug+'-in-'+this.resultLocation
        }
        else if (result.label === 'Services') {
          /*  treatments/{slug}/{location}  */
          window.location.href = '/treatments/'+result.item.slug+'/'+this.resultLocation
        }
        else if (result.label === 'Diseases') {
          /*  diseases/{slug}/{location}  */
          
          window.location.href = '/diseases/'+result.item.slug+'/'+this.resultLocation
        }
        else if (result.label === 'Laboratories') {
          /*  laboratories/{speciality}/{location}  */
          
             window.location.href = '/lab/'+result.item.location.slug+'/'+result.item.slug
        }
        // else {}
      }
      else {
        if (result.label === 'Doctors') {
          window.location.href = '/doctors/'+result.item.location.slug+'/'+result.item.specialities[0].slug+'/'+result.item.slug
        }
        else if (result.label === 'Hospitals') {
          window.location.href = '/hospitals/'+result.item.location.slug+'/'+result.item.slug
        }
        else if (result.label === 'Specialities') {
          /*  dermatologist-in-lahore  */
           window.location.href = '/'+result.item.slug+'-in-pakistan'
        }
        else if (result.label === 'Services') {
          /*  treatments/{slug}  */
          
          window.location.href = '/treatments/'+result.item.slug
        }
        else if (result.label === 'Diseases') {
          /*  diseases/{slug}  */
         
            window.location.href = '/diseases/'+result.item.slug
        }
        else if (result.label === 'Laboratories') {
          
           window.location.href = '/lab/'+result.item.location.slug+'/'+result.item.slug
        }
        // else {}
      }
    },
    },

    }
</script>

<style>
    .vdpArrowPrev:after {
        border-right-color: #cc99cd;
    }
    .vdpArrowNext:after {
        border-left-color: #cc99cd;
    }
    .vdpTimeUnit > input:hover,
    .vdpTimeUnit > input:focus {
        border-bottom-color: #cc99cd;
    }
    .vdpCell.today {
        color: #cc99cd;
    }
    .vdpCell.selectable:hover .vdpCellContent,
    .vdpCell.selected .vdpCellContent {
        background: #cc99cd;
    }

    .custom_btn{
        min-width: 75px;
        line-height: 30px;
        margin-right: 5px;
        display: block;
        max-width: 145px;
        float: left;
        font-size: 11px;
    }

    .btn_group .custom_btn:nth-of-type(2){
        margin:0px;
    }
    
    .dc-main-section{
        padding:0 15px;
    }
    .toggle_map {
      transform: translateX(100%);
      transition: transform 0.5s ease-in-out;
    }
    .hide_map_btn {
      transform: translateX(63%);
      transition: transform 0.5s ease-in-out;
    }

@media (max-width: 991px){
  .mobile_search_btn {
    top: 8px !important;
    right: 0 !important;
  }
}

</style>