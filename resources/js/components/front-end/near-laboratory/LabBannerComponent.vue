<template>
  <div>
<div class="sticky-wrapper">
            <div class="w-100 d-lg-block d-none lab-box pt-2 pb-2" 
            :class="{ 'sticky': isSticky }">
             <div class="container">
               <div class="row">
                 <div class="col-7 p-0">
                   <ul class="w-100 d-inline-block 
                   position-relative mt-3">
                     <li class="reports-section float-left position-relative reports-sticky-section">
                      <a class="text-white text_13" href="javascript:void(0)">
                        Get online test Reports
                      </a>
                      <div class="d-inline-block reports-section-menu p-2 book-rounded position-absolute bg-white">
                        <ul class="w-100 d-inline-block mb-0">
                          <li v-for="(lab,index) in users" v-if="lab.profile && lab.profile.online_report_url != null && index < 4"class="float-left w-100 mb-1 pb-1 d-inline-block">
                            <a :href="'get-online-test-reports-'+lab.slug" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              {{lab.first_name}} {{lab.last_name}}
                            </a>
                          </li> 
                          <!-- <li class="float-left w-100 mb-1 pb-1 b-bottom d-inline-block">
                            <a href="javascript:void(0)" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              Alnasar Labs
                            </a>
                          </li>  -->
                          <li class="w-100 d-inline-block text-center">
                            <a class="bg-green book-rounded text-white text_12" href="/lab-test-report-online">
                              View All
                            </a>
                          </li>
                        </ul>
                      </div>
                   </li>
                   <!-- <li class="reports-section float-left position-relative reports-sticky-section">
                      <a class="text-white text_13" href="javascript:void(0)">
                        Book Home Samples
                      </a>
                      <div class="d-inline-block reports-section-menu p-2 book-rounded position-absolute bg-white">
                        <ul class="w-100 d-inline-block mb-0">
                          <li class="float-left w-100 mb-1 pb-1 b-bottom d-inline-block">
                            <a href="javascript:void(0)" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              Chughtai Labs
                            </a>
                          </li> 
                          <li class="float-left w-100 mb-1 pb-1 b-bottom d-inline-block">
                            <a href="javascript:void(0)" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              Alnasar Labs
                            </a>
                          </li> 
                        </ul>
                      </div>
                   </li> -->
                   <!-- <li class="float-left position-relative">
                      <a class="text-white text_13" href="javascript:void(0)" 
                      style="padding: 5px 12px;">
                        Test Price Comparison
                      </a> -->
                      <!-- <div class="d-inline-block reports-section-menu p-2 book-rounded position-absolute bg-white">
                        <ul class="w-100 d-inline-block mb-0">
                          <li class="float-left w-100 mb-1 pb-1 b-bottom d-inline-block">
                            <a href="javascript:void(0)" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              Chughtai Labs
                            </a>
                          </li> 
                          <li class="float-left w-100 mb-1 pb-1 b-bottom d-inline-block">
                            <a href="javascript:void(0)" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              Alnasar Labs
                            </a>
                          </li> 
                        </ul>
                      </div> -->
                   <!-- </li> -->
                   <li class="float-left position-relative">
                      <a class="text-white text_13" href="javascript:void(0)" 
                      @click="showDiscountModal" style="padding: 5px 12px;">
                        Get Discounts Code For Walk-in
                      </a>
                      <!-- <div class="d-inline-block reports-section-menu p-2 book-rounded position-absolute bg-white">
                        <ul class="w-100 d-inline-block mb-0">
                          <li class="float-left w-100 mb-1 pb-1 b-bottom d-inline-block">
                            <a href="javascript:void(0)" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              Chughtai Labs
                            </a>
                          </li> 
                          <li class="float-left w-100 mb-1 pb-1 b-bottom d-inline-block">
                            <a href="javascript:void(0)" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              Alnasar Labs
                            </a>
                          </li> 
                        </ul>
                      </div> -->
                   </li>
                   </ul>
                 </div>
                 <div class="col-5">
                   <div id="forHidingListing" class=" w-100 d-inline-block" @click="bodyHideListing($event)">

    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-12">
          <!-- <div class="banner_left_section pb-5 pt-xs-3 pl-xs-2 pr-xs-2">
            <div class="banner_hading">
              <h1 class="float-left w-sm-100">Online
              </h1>
              <h2 class="mb-0">
              Video Consultation</h2>
              <p class="text-white">Increase online traffic for your practice.
              </p>
            </div>
            <form class="form-inline">
                <div class="input-group location_input d-xs-none">
                  <input type="text" class="form-control rounded-pill mr-3 text_14" id="location_Search" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="Select Location">
                  <span>
                    <i class="fa fa-map-marker fa-sm" aria-hidden="true"></i>
                  </span>
                  <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Action</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Separated link</a>
                </div>
                </div>
              <div class="input-group w-70">
                  <input type="text" class="form-control banner_input text_14" id="main_Search" placeholder="Search for doctors, hospitals, specialties, services, disease" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="input-group-btn">
                  <button class="btn knockdoc_btn_bg banner_btn text-white text_14" type="button">Search
                    <span>
                        <i class="fa fa-search fa-sm" aria-hidden="true"></i>
                      </span>
                  </button>
                </span>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Location1</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Location2</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Location3</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Location4</a>
                </div>
              </div>
            </form>
            <div class="search-below-text">
              <p class="text-white mt-4 mb-5">No Need to
                <strong> Travel.</strong> Every time you go to visit your<strong> doctor,
              </strong></p>
            </div>
            <div class="join-doctor-btn">
              <a href="#" class="rounded-pill knockdoc_btn_bg text-white p-2 btn_padding">Join as a Doctor</a>
            </div>
          </div> -->
          <div class="banner_left_section w-100 d-inline-block text-center">
            
            <div class="form-inline d-none d-lg-none mb-3">
                <!-- banner_input -->
              <input type="text" placeholder="Search for Lab Tests" name="search" v-model="keyword1" class="form-control banner_input text_14 w-100">
                  <div class="listing_main" v-if="showDropdown">
                    <ul  class="lab_listing_dropdown">
                      <li v-for="item in testResult" :key="item.id">
                        <div>
                          <div role="separator" class="dropdown-divider"></div> 
                          <a :href="'/book-a-lab-test/'+item.slug" class="pt-1 pb-1 pl-2 pr-2 w-100 d-block searchListMain clearfix">
                            <div class="row">
                              <div class="col-6">
                                <div class="w-100 d-inline-block mt-xl-0 mt-1 text-left">
                                  <span class="text_black text_13 mt-1 w-100 text-truncate text-xs-9">{{item.title}}
                                  </span>
                                </div>
                              </div>
                              <div class="col-3 p-0">
                                <div class="w-100 d-inline-block mt-xl-0 mt-1 text-center">
                                  <span class="text_black text_13 mt-1 text-xs-9">
                                    Rs: {{item.averagePrice}}
                                  </span>
                                </div>
                              </div>
                              <div class="col-3 p-xl-o">
                                <div class="w-100 d-inline-block detail-btn">
                                  <a class="font-weight-bold text_12 text-blue book-rounded d-inline-block border-blue book-padding text-xs-9" :href="'/book-a-lab-test/'+item.slug">
                                    View Detail
                                  </a>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                      </li>
                    </ul>
                  </div>
              <!-- btn knockdoc_btn_bg banner_btn p-2 text-white text_14 position-absolute mobile_search_btn -->
            </div>
            <form class="form-inline w-100 d-inline-block">
              <!-- <div class="banner_location input-group location_input position-relative">

                <search-location-input
                    :locations = "allLocations"
                >
                </search-location-input>
                <span class="position-absolute"><i aria-hidden="true" class="fa fa-map-marker fa-sm"></i></span>
              </div> -->

              <div id="online-consultation-search" 
              class="w-100 search_main d-block mt-2 position-relative">
                  <input @input="hideListing($event)" type="text" placeholder="Search for Lab Test" name="search" v-model="keyword1" class="form-control text_14 w-100 h_35 book-rounded position-relative pl-5">
                  <a class="position-absolute" href="javascript:void(0)">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </a>
                  <div class="listing_main sticky-listing_main box-shadow" v-if="showDropdown">
                    <ul class="lab_listing_dropdown">
                      <li v-for="item in testResult" :key="item.id">
                        <div>
                          <div role="separator" class="dropdown-divider">
                          </div> 
                          <a :href="'/book-a-lab-test/'+item.slug" class="pt-1 pb-1 pl-2 pr-2 w-100 d-block searchListMain clearfix">
                            <div class="row">
                              <div class="col-6">
                                <div class="w-100 d-inline-block text-left mt-xl-0 mt-1">
                                  <span class="text_black text_13 mt-1 text-truncate w-100">{{item.title}}
                                  </span>
                                </div>
                              </div>
                              <div class="col-3">
                                <div class="w-100 d-inline-block 
                                text-center">
                                  <span class="text_black text_13 mt-1 w-100">
                                    Rs: {{item.averagePrice}}
                                  </span>
                                </div>
                              </div>
                              <div class="col-3">
                                <div class="w-100 d-inline-block detail-btn">
                                  <a class="font-weight-bold text_12 text-blue book-rounded d-inline-block border-blue book-padding" :href="'/book-a-lab-test/'+item.slug">
                                    View Detail
                                  </a>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                      </li>
                    </ul>
                  </div>
                <!-- <div class="input-group-btn btn_position lab-search-btn border-0">
                  <a href="/doctors" class="btn knockdoc_btn_bg banner_btn text-white text_14" type="button">Search
                    <span>
                      <i class="fa fa-search fa-sm" aria-hidden="true"></i>
                    </span>
                  </a>
                </div> -->
              </div>
            </form>
            <!-- <div class="join-doctor-btn d-inline-block mb-xs-3 mb-sm-3 mb-md-3 w-100 pb-lg-0 pb-3">
              <a href="/practice-as-doctor" class="rounded-pill knockdoc_doctor_profile_btn knockdoc_btn_bg text-white d-inline-block text-center">Book Now
              </a>
            </div> -->
          </div>
        </div>
        <!-- <div class="col-4 d-xs-none d-md-none d-sm-none d-lg-block">
          <div class="video-consultation-image mt-5">
            <img class="w-90" src="images/video-consultation-image.png" alt="video-consultation-image picture">
          </div>
        </div> -->
      </div>
    </div>
  </div>
                 </div>
               </div>
             </div>
            </div>
          </div>
  <!--   <div class="container">
        <div class="row">
              <div class="col-12 mt-4">
                <bread-crumb-spec></bread-crumb-spec>
              </div>
        </div>
    </div>  -->
    <div id="forHidingListing" class="bg-lab-image w-100 d-inline-block" @click="bodyHideListing($event)">
    <div class="container">
      <div v-if="this.bread_crumb_data && this.bread_crumb_data.length" class="row">
        <div class="col-12 pl-xl-0">
          <ul  class="w-100 d-inline-block bread-crumb-listing mt-3">
        <li v-for="(breadcrumbs,index) in this.bread_crumb_data" class="float-left">
          <a v-if="index === 0" class="text-white text_12" :href="breadcrumbs.url">
            {{breadcrumbs.title}}
          </a>
          <a v-else class="text-white text_12 speciality-bread" :href="breadcrumbs.url">
            {{breadcrumbs.title}}
          </a>
        </li>
        <!-- <li v-if="index != 0" class="float-left speciality-bread">
          <a class="text-white text_12" :href="breadcrumbs.url">
            {{breadcrumbs.title}}
          </a>
        </li> -->
      </ul>
        </div>
      </div>
      <!-- <div class="row">
      <div class="col-12">
        <div class="w-100 d-inline-block position-relative">
        <div class="position-absolute box-right">
          <div class="consultation-box bg-white box_shadow book-rounded d-xl-block d-none sticky-search">
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
        <div class="float-right call-btn call-sticky d-xl-block d-lg-block d-none">
          <a class="text_14 text-white d-inline-block font-weight-bold" href="javascript:void(0)">
            <span>
              <i class="fa fa-whatsapp mr-2 float-left" aria-hidden="true">
              </i>
            </span>
            Whatsapp Us
          </a>
        </div>
      </div>
    </div>
 -->      <div class="row">
        <div class="col-lg-12 col-12">
          <!-- <div class="banner_left_section pb-5 pt-xs-3 pl-xs-2 pr-xs-2">
            <div class="banner_hading">
              <h1 class="float-left w-sm-100">Online
              </h1>
              <h2 class="mb-0">
              Video Consultation</h2>
              <p class="text-white">Increase online traffic for your practice.
              </p>
            </div>
            <form class="form-inline">
                <div class="input-group location_input d-xs-none">
                  <input type="text" class="form-control rounded-pill mr-3 text_14" id="location_Search" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" placeholder="Select Location">
                  <span>
                    <i class="fa fa-map-marker fa-sm" aria-hidden="true"></i>
                  </span>
                  <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Action</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Separated link</a>
                </div>
                </div>
              <div class="input-group w-70">
                  <input type="text" class="form-control banner_input text_14" id="main_Search" placeholder="Search for doctors, hospitals, specialties, services, disease" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="input-group-btn">
                  <button class="btn knockdoc_btn_bg banner_btn text-white text_14" type="button">Search
                    <span>
                        <i class="fa fa-search fa-sm" aria-hidden="true"></i>
                      </span>
                  </button>
                </span>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Location1</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Location2</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Location3</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Location4</a>
                </div>
              </div>
            </form>
            <div class="search-below-text">
              <p class="text-white mt-4 mb-5">No Need to
                <strong> Travel.</strong> Every time you go to visit your<strong> doctor,
              </strong></p>
            </div>
            <div class="join-doctor-btn">
              <a href="#" class="rounded-pill knockdoc_btn_bg text-white p-2 btn_padding">Join as a Doctor</a>
            </div>
          </div> -->
          <div class="banner_left_section w-100 d-inline-block text-center">
            <div class="banner_heading">
              <h1 class="text-white mb-3 mt-xl-4">
                <span class="text_20 font-weight-normal book-lab">Book Lab
                </span>
                <span class="online-test text_35 pl-xl-4 pl-2">Tests Online In Pakistan
                </span>
              </h1>
            </div>
            <div class="form-inline d-none d-lg-none mb-3">
                <!-- banner_input -->
              <input type="text" placeholder="Search for Lab Tests" name="search" v-model="keyword1" class="form-control banner_input text_14 w-100">
                  <div class="listing_main" v-if="showDropdown">
                    <ul  class="lab_listing_dropdown">
                      <li v-for="item in testResult" :key="item.id">
                        <div>
                          <div role="separator" class="dropdown-divider"></div> 
                          <a :href="'/book-a-lab-test/'+item.slug" class="pt-1 pb-1 pl-2 pr-2 w-100 d-block searchListMain clearfix">
                            <div class="row">
                              <div class="col-6">
                                <div class="w-100 d-inline-block text-left mt-xl-0 mt-1">
                                  <span class="text_black text_13 mt-1 text-xs-9 text-truncate w-100">{{item.title}}
                                  </span>
                                </div>
                              </div>
                              <div class="col-3 p-0">
                                <div class="w-100 d-inline-block mt-xl-0 mt-1">
                                  <span class="text_black text_13 mt-1 text-xs-9">
                                    Rs: {{item.averagePrice}}
                                  </span>
                                </div>
                              </div>
                              <div class="col-3 p-xl-0">
                                <div class="w-100 d-inline-block detail-btn">
                                  <a class="font-weight-bold text_12 text-blue book-rounded d-inline-block border-blue book-padding text-xs-9" :href="'/book-a-lab-test/'+item.slug">
                                    View Detail
                                  </a>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                      </li>
                    </ul>
                  </div>
              <!-- btn knockdoc_btn_bg banner_btn p-2 text-white text_14 position-absolute mobile_search_btn -->
            </div>
            <form class="form-inline w-100 d-inline-block">
              <!-- <div class="banner_location input-group location_input position-relative">

                <search-location-input
                    :locations = "allLocations"
                >
                </search-location-input>
                <span class="position-absolute"><i aria-hidden="true" class="fa fa-map-marker fa-sm"></i></span>
              </div> -->

              <div id="online-consultation-search" 
              class="w-60 search_main d-block m-auto position-relative w-xs-100 w-sm-100 
              w-md-100">
                  <input @input="hideListing($event)" type="text" placeholder="Search for Lab Test" name="search" v-model="keyword1" class="form-control text_14 w-100 h_35 book-rounded position-relative pl-5">
                  <a class="position-absolute" 
                  href="javascript:void(0)">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </a>
                  <div class="listing_main" v-if="showDropdown">
                    <ul  class="lab_listing_dropdown">
                      <li v-for="item in testResult" :key="item.id">
                        <div>
                          <div role="separator" class="dropdown-divider"></div> 
                          <a :href="'/book-a-lab-test/'+item.slug" class="pt-1 pb-1 pl-2 pr-2 w-100 d-block searchListMain clearfix">
                            <div class="row">
                              <div class="col-6">
                                <div class="w-100 d-inline-block text-left mt-xl-0 mt-1">
                                  <span class="text_black text_13 mt-1 w-100 text-truncate text-xs-9">{{item.title}}
                                  </span>
                                </div>
                              </div>
                              <div class="col-3 p-0">
                                <div class="w-100 d-inline-block 
                                text-center mt-xl-0 mt-1">
                                  <span class="text_black text_13 mt-1 text-xs-9">
                                    Rs: {{item.averagePrice}}
                                  </span>
                                </div>
                              </div>
                              <div class="col-3 p-xl-0">
                                <div class="w-100 d-inline-block detail-btn">
                                  <a class="font-weight-bold text_12 text-blue book-rounded d-inline-block border-blue book-padding text-xs-9" :href="'/book-a-lab-test/'+item.slug">
                                    View Detail
                                  </a>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                      </li>
                    </ul>
                  </div>
                <!-- <div class="input-group-btn btn_position lab-search-btn border-0">
                  <a href="/doctors" class="btn knockdoc_btn_bg banner_btn text-white text_14" type="button">Search
                    <span>
                      <i class="fa fa-search fa-sm" aria-hidden="true"></i>
                    </span>
                  </a>
                </div> -->
              </div>
            </form>
            <div class="search-below-text w-60 d-block m-auto w-xs-100 w-sm-100 w-md-100">
              <p class="text-white mt-3 mb-4 text_13">Book Lab Tests Online in Pakistan from the comfort of your home. DoctorFindy offers you free home Sample collection, Facility to view pricing and Lab Test details online.
              </p>
            </div>
            <!-- <div class="join-doctor-btn d-inline-block mb-xs-3 mb-sm-3 mb-md-3 w-100 pb-lg-0 pb-3">
              <a href="/practice-as-doctor" class="rounded-pill knockdoc_doctor_profile_btn knockdoc_btn_bg text-white d-inline-block text-center">Book Now
              </a>
            </div> -->
          </div>
        </div>
        <!-- <div class="col-4 d-xs-none d-md-none d-sm-none d-lg-block">
          <div class="video-consultation-image mt-5">
            <img class="w-90" src="images/video-consultation-image.png" alt="video-consultation-image picture">
          </div>
        </div> -->
      </div>
      <div class="row">
                    <div class="col-12">
                      <div class="w-100 d-inline-block mb-2">
                          <p class="text-white text_13">
                            Last Updated On {{moment().format("dddd")}},
                                {{ moment().format("MMMM") }} {{ moment().format("DD") }}, {{ moment().format("YYYY") }}
                          </p>
                        </div>
                    </div>
                  </div>
    </div>

   <!--  <div class="container-fluid">
      <div class="w-100 d-inline-block mb-2">
        <p class="text-white text_13">
          Last Updated On {{moment().format("dddd")}},
              {{ moment().format("MMMM") }} {{ moment().format("DD") }}, {{ moment().format("YYYY") }}
        </p>
      </div>
    </div> -->
  </div>
<!-- Modal fo search Doctor on small devices -->
    <!-- <div class="modal fade" id="search_doctor_on_device" tabindex="-1" aria-hidden="true" >
      <div class="modal-dialog m-0">
        <div class="modal-content">
          <div class="modal-header border-0 pb-2 pt-1">
            <span class="text-center w-100 text_18 pt-1">Search</span>
            <a href="/doctors"type="button" class="close p-0 w_33px h_30 text-white rounded-circle bg-white border-2 mt-1 mr-1 text-right" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="text_black">&times;</span>
            </a>
          </div>
          <div class="modal-body pl-2 pr-2 pt-0 pb-0">
            <search-location-input
                :locations = "allLocations"
            >
            </search-location-input>
              <main-search-page
                    :docs = "doctors"
                    :hosp = "hospitals"
                    :labs = "laboratories"
                    :dise = "diseases"
                    :special = "specialities"
                    :service = "services"
                    :locations = "allLocations"
              ></main-search-page>
          </div>
        </div>
      </div>
    </div> -->
    <!-- End Modal fo search Doctor on small devices -->

    <!-- start BookedTestsComponent -->
      <div class="booking_section w-100 d-inline-block book-bg">
        <div class="w-100 d-inline-block b-bottom">
          <div class="container">
            <div class="w-75 d-block m-auto w-xs-100 w-sm-100 w-md-100">
            <div class="row">
              <div class="col-12">
                 <ul class="w-100 d-inline-block position-relative mb-1 mt-2">
                   <li class="reports-section float-left position-relative w-xs-45">
                      <a class="text_black text_13 text-xs-11" href="javascript:void(0)">
                        Get online test Reports
                      </a>
                      <div class="d-inline-block reports-section-menu p-2 book-rounded position-absolute bg-white">
                        <ul class="w-100 d-inline-block mb-0">
                          <li v-for="(lab,index) in users" v-if="lab.profile && lab.profile.online_report_url != null && index < 6" class="float-left w-100 mb-1 pb-1 d-inline-block">
                            <a :href="'get-online-test-reports-'+lab.slug" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100 text-xs-12">
                              {{lab.first_name}} {{lab.last_name}}
                            </a>
                          </li> 
                          <li class="w-100 d-inline-block text-center">
                            <a class="bg-green book-rounded text-white 
                            text_12 book-padding" href="/lab-test-report-online">
                              View All
                            </a>
                          </li>
                          <!-- <li class="float-left w-100 mb-1 pb-1 b-bottom d-inline-block">
                            <a href="javascript:void(0)" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              Alnasar Labs
                            </a>
                          </li>  -->
                        </ul>
                      </div>
                   </li>
                   <!-- <li class="reports-section float-left position-relative">
                      <a class="text_black text_13" href="javascript:void(0)">
                        Book Home Samples
                      </a>
                      <div class="d-inline-block reports-section-menu p-2 book-rounded position-absolute bg-white">
                        <ul class="w-100 d-inline-block mb-0">
                          <li class="float-left w-100 mb-1 pb-1 b-bottom d-inline-block">
                            <a href="javascript:void(0)" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              Chughtai Labs
                            </a>
                          </li> 
                          <li class="float-left w-100 mb-1 pb-1 b-bottom d-inline-block">
                            <a href="javascript:void(0)" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              Alnasar Labs
                            </a>
                          </li> 
                        </ul>
                      </div>
                   </li> -->
                  <!--  <li class="float-left position-relative">
                      <a class="text_black text_13" href="javascript:void(0)" 
                      style="padding: 5px 30px;">
                        Test Price Comparison
                      </a> -->
                      <!-- <div class="d-inline-block reports-section-menu p-2 book-rounded position-absolute bg-white">
                        <ul class="w-100 d-inline-block mb-0">
                          <li class="float-left w-100 mb-1 pb-1 b-bottom d-inline-block">
                            <a href="javascript:void(0)" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              Chughtai Labs
                            </a>
                          </li> 
                          <li class="float-left w-100 mb-1 pb-1 b-bottom d-inline-block">
                            <a href="javascript:void(0)" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              Alnasar Labs
                            </a>
                          </li> 
                        </ul>
                      </div> -->
                   <!-- </li> -->
                   <li class="float-left 
                   position-relative discount-link 
                   w-xs-52">
                      <a class="text_black text_13 text-xs-10" href="javascript:void(0)"
                      @click="showDiscountModal" style="padding: 5px 30px;">
                        Get Discounts Code For Walk-in
                      </a>
                      <!-- <div class="d-inline-block reports-section-menu p-2 book-rounded position-absolute bg-white">
                        <ul class="w-100 d-inline-block mb-0">
                          <li class="float-left w-100 mb-1 pb-1 b-bottom d-inline-block">
                            <a href="javascript:void(0)" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              Chughtai Labs
                            </a>
                          </li> 
                          <li class="float-left w-100 mb-1 pb-1 b-bottom d-inline-block">
                            <a href="javascript:void(0)" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              Alnasar Labs
                            </a>
                          </li> 
                        </ul>
                      </div> -->
                   </li>
                 </ul>
              </div>
            </div>
          </div>
          
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="section-heading mt-3 mb-xl-3">
                <h2 class="font-weight-bold text_xs_20 text-blue">
                  Popular Labs In Pakistan
                </h2>
              </div>
          </div>
          </div>
          <div class="row lab_titles">
            <div class="col-12 mb-xl-3 mb-lg-0 mb-md-0">
              <div class="w-10 d-inline-block lab-images position-relative mt-xl-3 w-xs-30 w-sm-50 w-md-23" v-for="(user, index) in users" v-if="index < 8">
                <a :href="'/lab/'+user.location.slug+'/'+user.slug" class="p-2 position-relative d-inline-block w-100">
                <span class="lab_image d-inline-block w-100 text-center">
                  <img v-if="user.profile.avatar" v-lazy="basePath+'/uploads/users/'+user.id+'/medium-'+user.profile.avatar" :alt="user.first_name+' '+user.last_name" :name="user.first_name+' '+user.last_name" class="position-relative">
                </span>
                <div class="w-100 d-inline-block toltip-box 
                bg-white text-center">
                  <a class="text_12 underline text-blue" 
                  :href="'/lab/'+user.location.slug+'/'+user.slug">
                    {{user.first_name+' '+user.last_name}}
                  </a>
                  <span class="position-absolute text-white">
                    <i class="fa fa-caret-down" aria-hidden="true">
                    </i>
                  </span>
                </div>
              </a>
              </div>
            </div>
          </div>
          <div class="row mt-3 mb-3">
            <div class="col-12">
              <div class="w-100 d-inline-block text-center">
                <a href="/find-a-lab-near-you" 
                class="d-inline-block book-rounded bg-green text-white btn-view-all mt-lg-0 mb-3 mb-lg-0 mt-3 text_13">View All
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="top-content lab-test-slider">
        <div class="container">
            <div class="row">
              <div class="col-lg-3 col-md-3" v-for="test in tests" >
                <div class="test_box bg-white box_shadow p-2 position-relative sliderBox">
                  <div class="lab_image d-inline-block w-100 text-center">
                    <img src="images/eyes-image.png">
                  </div>
                  <a :href="'/book-a-lab-test/'+test.slug" class="font-weight-bold theme-color-text">{{test.title}}</a>
                  <div class="test_description">
                    <p>{{test.details}} </p>
                  </div>
                  <p class="font-weight-bold">Rs: {{test.averagePrice}}</p>
                  <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
                  <a @click="findTest(test.id)" class="theme-color-text text-center w-100 d-inline-block p-1 add_testBtn font-weight-bold" data-toggle="modal" data-target="#testModal">Book Test</a>
                </div>
              </div>
            </div>
        </div>
      </div> -->
            
    <!-- Start Health Checkups and Screenings -->
    <!-- <div class=" specalities w-100 mt-4 ">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-heading mt-3 mt-lg-0">
              <h2 class="font-weight-bold mb-4 text_xs_20">
                Health Checkups and Screenings For
              </h2>
            </div>
          </div>
        </div>
        <div class="col-12 text-center">
          <div class="row">
          <div class="specalities-image col-lg-2 col-md-3 col-6 col-sm-3 p-0">
              <div class="p-2 m-auto rounded-circle d-table visible_rounded_circle">
                <span class="d-table-cell align-middle p-2">
                  <img src="/uploads/symptoms/default/symptom.svg" name="default" alt="default" class="h_50 w_50px">
                </span>
              </div>
              <span class="pt-2 pb-2 d-block text_14">All </span>
              <a @click="getAlltests" class="circle_anchor position-absolute"></a>
            </div>
            <div class="specalities-image col-lg-2 col-md-3 col-6 col-sm-3 p-0" v-for="(symptom,index) in symptoms" v-if="index < symptomsToShow">
              <div class="p-2 m-auto rounded-circle d-table visible_rounded_circle">
                <span class="d-table-cell align-middle p-2">
                  <img v-if="symptom.image" v-lazy="'/uploads/symptoms/'+symptom.image" :name="symptom.title" :alt="symptom.title" class="h_50 w_50px">
                  <img v-else v-lazy="'/uploads/symptoms/default/symptom.svg'" :name="symptom.title" :alt="symptom.title" class="h_50 w_50px">
                </span>
              </div>
              <span class="pt-2 pb-2 d-block text_14">{{symptom.title}}</span>
              <a @click="symptomData(symptom.id)" class="circle_anchor position-absolute"></a>
            </div>
          </div>
          <span class=" d-inline-block w-100 text-center "><a href="javascript:void(0)" v-if="symptoms.length > 5 && symptoms.length > symptomsToShow-1" @click="symptomsToShow += 5" class="d-inline-block rounded-pill knockdoc_btn_bg text-white p-2 btn_padding mt-lg-4 mb-3 mb-lg-3 mt-3">View All Symptoms
            <i aria-hidden="true" class="fa fa-arrow-right ml-2"></i></a></span>
        </div>
      </div>
    </div> -->
  <!-- End Health Checkups and Screenings -->
<div class="w-100 d-inline-block book-bg">
<div class="container">
   <div class="booking_section">
            <div class="w-100 d-inline-block">
              <div class="section-heading mt-xl-3 mb-3 mt-lg-4 mb-lg-4 w-60 w-sm-100 float-left">
                <h2 class="font-weight-bold text_xs_20 text-blue">
                 <!-- {{get_title.capitalize()}} Symptom ({{totalTestsDataCount}}) -->
                 Most Booked Lab Test
                </h2>
              </div>
              <div class="input-lab-test-search w-40 w-sm-100 float-left mt-lg-4 mb-3 mb-lg-0 mb-md-0 position-relative">
        <input class="w-100 d-inline-block h_37 book-rounded pl-5 pr-5" type="text" v-model="keyword" placeholder="Search Lab Test Name">
        <a href="javascript:void(0)" class="position-absolute">
          <i aria-hidden="true" class="fa fa-search"></i></a>
    </div>
    </div>
      </div>
      <div class="top-content" v-if="findsymptoms.length" >
        <div class="row">
          <div class="col-lg-4 col-xl-3 col-md-6 col-12 col-sm-6 mb-3" v-for="(findsymptom,index) in findsymptoms" v-if="index < TestsToShow">
            <div class="test_box bg-white box_shadow p-2 position-relative book-rounded">
              <div class="row position-relative mb-3">
                <div class="col-12">
                  <span  class="font-weight-bold text_black text_13 test_names_heading mb-1 d-inline-block w-100 text-truncate">{{findsymptom.title}}</span>
                  <div class="test_description mb-2 w-100 d-inline-block">
                    <p class="text_12 text">
                      <span class="font-weight-normal">Known As:
                    </span> {{findsymptom.known_as}}</p>
                  </div>
                </div>
                <a :href="'/book-a-lab-test/'+findsymptom.slug" class="test-details"></a>
              </div>
              <div v-if="findsymptom.turn_around_time" class="row">
                <div v-if="findsymptom.sample_type" class="col-12 col-lg-6 col-md-6 mt-2">
                  <span  class="font-weight-bold text_12">Sample Type</span>
                </div>
                <div v-if="findsymptom.sample_type" class="col-12 col-lg-6 col-md-6 mt-2">
                  <span  class="font-weight-bold text_12 d-inline-block w-100 text-right">{{findsymptom.sample_type}}</span>
                </div>
                <div class="col-12 col-lg-6 col-md-6">
                  <span class="font-weight-bold text_12">Turn Around Time</span>
                </div>
                <div class="col-12 col-lg-6 col-md-6">
                  <span class="font-weight-bold text_12 d-inline-block w-100 text-right">{{findsymptom.turn_around_time}}</span>
                </div>
              </div>
              <div class="d-inline-block float-left w-45 view-test-btn">
               <!--  <a @click="findTest(findsymptom.id)" class="text-green text-center d-inline-block text_12 font-weight-bold book-rounded" data-toggle="modal" data-target="#testModal">
                    <i class="fa fa-long-arrow-right d-inline-block mr-2" aria-hidden="true"></i>
                View Test</a> -->
                 <a class="text-green text-center d-inline-block text_12 font-weight-bold book-rounded" :href="'/book-a-lab-test/'+findsymptom.slug">
                    <i class="fa fa-arrow-right d-inline-block 
                    mr-2" aria-hidden="true"></i>
                View Test</a>
              </div>
              <div class="w-55 float-right d-inline-block mt-1 
              pl-3">
                <p class="font-weight-bold text_15">Rs. {{findsymptom.averagePrice}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
       <div v-else><h5 class="text-center font-weight-bold">No Test Found...</h5></div> 
       <span class=" d-inline-block w-100 text-center mb-3 mt-3"><a href="javascript:void(0)" v-if="findsymptoms.length > 8 && findsymptoms.length > TestsToShow-1" @click="TestsToShow += 8" class="d-inline-block book-rounded text-white 
        btn-view-all bg-green">View More </a>
      </span> 
</div> 
</div>
<div class="lab-images-box w-100 d-inline-block">
  <div class="container">
    <div class="row">
      <div class="col-12">  
         <div class="w-100 d-inline-block mt-3 mb-3">
           <h2 class="font-weight-bold mb-4 text_xs_20 text-white">
              Popular Health Checkup Package
            </h2>
         </div>
      </div>
    </div>
    <div class="row scroll-blog mb-4">
      <div class="col-12 mb-xl-0 mb-3 col-lg-6 col-xl-3 col-sm-6 
      col-md-6">
         <div class="w-100 d-inline-block lab-image-section 
         bg-white book-rounded p-2">
          <div class="w-100 d-inline-block position-relative">
             <img class="w-100" :src="basePath+'/images/chughtai-lab-package.svg'" 
             alt="pictire">
             <div class="w-100 d-inline-block text-center consult-btn">
              <a href="javascript:void(0)" class="d-inline-block book-rounded bg-red text-white text_14 font-weight-bold position-absolute">20% OFF
              </a>
            </div>
          </div>
          <div class="w-100 d-inline-block">
            <h3 class="heading text_14 font-weight-bold mb-0">
             Executive Package A
            </h3>
          </div>
          <ul class="w-100 d-inline-block lab-section-fields mb-1">
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  URINE ANALYSIS
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  ULTRASOUND SCANS
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  CHEST X-RAY
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  ECG
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  BMI
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  CBC
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  ESR
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  BLOOD SUGAR FASTING
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  HBA1C
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  BLOOD GROUP & RH FACTOR
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  URIC ACID
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  LIVER FUNCTION TEST
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  RENAL FUNCTION TEST
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  SERUM ELECTROLYTES
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  THYROID FUNCTION TEST
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  LIPID PROFILE
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  HBSAG
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  ANTI-HCV
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  ANTI-HIV 1 & 2
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  VITAMIN D
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  CONSULTATION WITH AN EXPERIENCED
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  MEDICAL SPECIALIST
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  COMPLIMENTARY BREAKFAST
                </span>
              </p>
            </li>
          </ul>
          <div class="w-100 d-inline-block mt-2 mb-3">
            <p class="text_black text_13 mb-0">
              Total Package Price Rs:(<strike>29,500</strike> -  22,125)
            </p>
          </div>
          <div class="w-40 d-inline-block book-now-btn float-left">
            <a class="text-white text_12 font-weight-bold bg-blue book-rounded d-inline-block" href="tel:0345-0435621">
              Call Now
            </a>
          </div>
          <div class="w-60 d-inline-block text-center">
            <span class="heading text_12 font-weight-bold">
              20 Test Included
            </span>
          </div>
         </div>
      </div>
      <div class="col-12 mb-xl-0 mb-3 col-lg-6 col-xl-3 col-sm-6 
      col-md-6">
         <div class="w-100 d-inline-block lab-image-section 
         bg-white book-rounded p-2">
          <div class="w-100 d-inline-block position-relative">
             <img class="w-100" :src="basePath+'/images/chughtai-lab-package.svg'" 
             alt="pictire">
             <div class="w-100 d-inline-block text-center consult-btn">
              <a href="javascript:void(0)" class="d-inline-block book-rounded bg-red text-white text_14 font-weight-bold position-absolute">20% OFF
              </a>
            </div>
          </div>
          <div class="w-100 d-inline-block">
            <h3 class="heading text_14 font-weight-bold mb-0">
              EXECUTIVE PACKAGE B
            </h3>
          </div>
          <ul class="w-100 d-inline-block lab-section-fields mb-1">
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  CBC
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  ESR
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  BLOOD SUGAR FASTING
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  HBA1C
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  BLOOD GROUP & RH FACTOR
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  URIC ACID
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  LIVER FUNCTION TEST
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  RENAL FUNCTION TEST
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  BLOOD SUGAR RANDOM
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  THYROID FUNCTION TEST
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  LIPID PROFILE
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  HBSAG
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  ANTI-HCV
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  VITAMIN D
                </span>
              </p>
            </li>
          </ul>
          <div class="w-100 d-inline-block mt-2 mb-3">
            <p class="text_black text_13 mb-0">
              Total Package Price Rs:(<strike>23,000</strike> -  15,000)
            </p>
          </div>
          <div class="w-40 d-inline-block book-now-btn float-left">
            <a class="text-white text_12 font-weight-bold bg-blue book-rounded d-inline-block" href="tel:0345-0435621">
              Call Now
            </a>
          </div>
          <div class="w-60 d-inline-block text-center">
            <span class="heading text_12 font-weight-bold">
              14 Test Included
            </span>
          </div>
         </div>
      </div>
      <div class="col-12 mb-xl-0 mb-3 col-lg-6 col-xl-3 col-sm-6 
      col-md-6">
         <div class="w-100 d-inline-block lab-image-section 
         bg-white book-rounded p-2">
          <div class="w-100 d-inline-block position-relative">
             <img class="w-100" :src="basePath+'/images/chughtai-lab-package.svg'" 
             alt="pictire">
             <div class="w-100 d-inline-block text-center consult-btn">
              <a href="javascript:void(0)" class="d-inline-block book-rounded bg-red text-white text_14 font-weight-bold position-absolute">20% OFF
              </a>
            </div>
          </div>
          <div class="w-100 d-inline-block">
            <h3 class="heading text_14 font-weight-bold mb-0">
              General Health Screen Package
            </h3>
          </div>
          <ul class="w-100 d-inline-block lab-section-fields mb-1">
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  Complete Blood Count
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  HBsAg (Hepatitis B)
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  Anti HCV (Hepatitis C)
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  Glucose (Fasting)
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  Creatinine
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                 Uric Acid
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                 Liver Function Test
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                 Lipid Profile
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                 Urine Routine Exam
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                 Stool Exam
                </span>
              </p>
            </li>
          </ul>
          <div class="w-100 d-inline-block mt-2 mb-3">
            <p class="text_black text_13 mb-0">
              Total Package Price Rs:(<strike>7,740</strike> -  6,192)
            </p>
          </div>
          <div class="w-40 d-inline-block book-now-btn float-left">
            <a class="text-white text_12 font-weight-bold bg-blue book-rounded d-inline-block" href="tel:0345-0435621">
              Call Now
            </a>
          </div>
          <div class="w-60 d-inline-block text-center">
            <span class="heading text_12 font-weight-bold">
              10 Test Included
            </span>
          </div>
         </div>
      </div>
      <div class="col-12 mb-xl-0 mb-3 col-lg-6 col-xl-3 col-sm-6 
      col-md-6">
         <div class="w-100 d-inline-block lab-image-section 
         bg-white book-rounded p-2">
          <div class="w-100 d-inline-block position-relative">
             <img class="w-100" :src="basePath+'/images/chughtai-lab-package.svg'" 
             alt="pictire">
             <div class="w-100 d-inline-block text-center consult-btn">
              <a href="javascript:void(0)" class="d-inline-block book-rounded bg-red text-white text_14 font-weight-bold position-absolute">20% OFF
              </a>
            </div>
          </div>
          <div class="w-100 d-inline-block">
            <h3 class="heading text_14 font-weight-bold mb-0">
              Bone Health Screen
            </h3>
          </div>
          <ul class="w-100 d-inline-block lab-section-fields mb-1">
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  Vitamin D
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  Calcium
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  Alkaline Phosphatase
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  Phosphorus
                </span>
              </p>
            </li>
            <li class="w-100 d-inline-block">
              <p class="mb-0">
                <span class="text-green text_8 float-left">
                  <i class="fas fa-check mr-1 mt-1" aria-hidden="true"></i>
                </span>
                <span class="heading text_11 float-left w-90">
                  Uric Acid
                </span>
              </p>
            </li>
          </ul>
          <div class="w-100 d-inline-block mt-2 mb-3">
            <p class="text_black text_13 mb-0">
              Total Package Price Rs:(<strike>4,390</strike> -  3,512)
            </p>
          </div>
          <div class="w-40 d-inline-block book-now-btn float-left">
            <a class="text-white text_12 font-weight-bold bg-blue book-rounded d-inline-block" href="tel:0345-0435621">
              Call Now
            </a>
          </div>
          <div class="w-60 d-inline-block text-center">
            <span class="heading text_12 font-weight-bold">
              5 Test Included
            </span>
          </div>
         </div>
      </div>
    </div>
    <!-- <div class="row">
      <div class="col-12">
        <div class="d-inline-block w-100 text-center mb-xl-4 mb-3 mt-xl-4 mt-1">
        <a href="javascript:void(0)" class="d-inline-block book-rounded text-green btn-view-all bg-white text_12 font-weight-bold">View All 
        </a>
      </div>
      </div>
    </div> -->
  </div>
</div>
  <div class="book-us light_bg d-inline-block w-100 p-3">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-heading text-center">
            <h2 class="font-weight-bold mb-4 text_xs_20 heading">
              Why book with us?
            </h2>
          </div>
        </div>
      </div>
      <div class="w-85 d-block m-auto w-xs-100 w-sm-100 w-md-100">
      <div class="row">
        <div class="col-12 col-lg-6 col-md-6 mb-xl-5 mb-3">
          <div class="row">
            <div class="col-2 col-lg-2 col-md-2 d-lg-flex d-md-flex pl-0">
              <div class="book-us-img w_55px h_55 rounded-circle w_md_40px h_md_40">
                <img :src="basePath+'/images/book-us_1.png'" class="img-fluid d-block">
              </div>
            </div>
            <div class="col-10 col-lg-10 col-md-10 pl-0">
              <div class="booking_text">
                <h5 class="font-weight-bold text_13">Doctorfindy Associate Labs: Labs with industry standards</h5>
                <p class="text_12">To ensure the accuracy of reports.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-md-6 mb-xl-5 mb-3">
          <div class="row ml-xl-5">
            <div class="col-2 col-lg-2 col-md-2 d-lg-flex d-md-flex pl-0">
              <div class="book-us-img w_55px h_55 rounded-circle w_md_40px h_md_40">
                <img :src="basePath+'/images/book-us_2.png'" class="img-fluid d-block digital-report-img">
              </div>
            </div>
            <div class="col-10 col-lg-10 col-md-10 pl-0">
              <div class="booking_text">
                <h5 class="font-weight-bold text_13">Digital Report</h5>
                <p class="text_12">Access your reports anytime on your Practo account. We will email you a copy.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-md-6 mb-xl-5 mb-3">
          <div class="row">
            <div class="col-2 col-lg-2 col-md-2 d-lg-flex d-md-flex pl-0">
              <div class="book-us-img w_55px h_55 rounded-circle w_md_40px h_md_40">
                <img :src="basePath+'/images/book-us_3.png'" class="img-fluid d-block">
              </div>
            </div>
            <div class="col-10 col-lg-10 col-md-10 pl-0">
              <div class="booking_text">
                <h5 class="font-weight-bold text_13">The Facility of Lab Tests at the Comfort of Your Home</h5>
                <p class="text_12">DoctorFindy is proud to take part in this revolutionary step.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-md-6 mb-xl-5 mb-3">
          <div class="row ml-xl-5">
            <div class="col-2 col-lg-2 col-md-2 d-lg-flex d-md-flex pl-0">
              <div class="book-us-img w_55px h_55 rounded-circle w_md_40px h_md_40">
                <img :src="basePath+'/images/book-us_3.png'" class="img-fluid d-block">
              </div>
            </div>
            <div class="col-10 col-lg-10 col-md-10 pl-0">
              <div class="booking_text">
                <h5 class="font-weight-bold text_13">Offers and affordable prices
                </h5>
                <p class="text_12">Access your reports anytime on your Practo account. We will email you a copy.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
  <!-- End Why Book With Us -->

  <!-- How its Work -->
  <div class="work_flow">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-heading text-center">
            <h2 class="font-weight-bold mb-4 text_xs_20 mt-2 
            heading">
              How Does DoctorFindy Work?
            </h2>
          </div>
        </div>
      </div>
      <div class="w-85 d-block inner-works-main w-md-100">
        <div class="row">
          <div class="col-12">
            <ul class="works_inner_main w-100 d-inline-block position-relative mb-0">
        <li class="works_box w-33 float-left w-md-32 w-sm-100 mb-4 mb-lg-0 mb-md-0">
          <div class="bg-_work_box w-70 float-left box_shadow light_bg text-center p-2 box_radius w-md-100 w-sm-100">
            <span class="work_img mt-3 d-inline-block">
            <img class="w_30px" :src="basePath+'/images/flask-image.png'" alt="flask-image picture">
          </span>
          <p class="text_black mt-3 mb-2 work_text text_12">Search for tests and packages and seamlessly book a home sample collection.</p>
          </div>
        </li>
        <li class="works_box w-33 float-left works_box_2 w-md-32 w-sm-100 mb-4 mb-lg-0 mb-md-0">
          <div class="bg-_work_box w-70 float-left box_shadow light_bg text-center p-2 box_radius ml-lg-2 ml-md-2 w-md-100 w-sm-100">
            <span class="work_img mt-2 d-inline-block">
            <img class="w_30px" :src="basePath+'/images/user-main-image.png'" alt="user-main-image picture">
          </span>
          <p class="text_black mt-3 mb-2 work_text text_12">We will send a certified professional to your place to assist you with the sample collection</p>
          </div>
        </li>
        <li class="w-33 float-left w-md-32 w-sm-100 mb-0 mb-lg-0 mb-md-0">
          <div class="bg-_work_box w-70 float-left box_shadow light_bg text-center p-2 box_radius ml-lg-3 ml-md-3 w-md-100 w-sm-100">
            <span class="work_img d-inline-block text_black 
            text_30">
            <i class="fa fa-envelope-o" aria-hidden="true"></i>
          </span>
          <p class="text_black mt-2 mb-2 work_text text_12">
          We will email you the reports. You can also access your reports within your account on the Doctorfindy app
        </p>
          </div>
        </li>
      </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- End How its Work -->

  <!-- FAQ Questions -->
<div class="w-100 d-inline-block work_flow">
  <div class="container">
    <div class="row">
      <div class="col-12">
      <div class="mt-3 w-100 d-inline-block">
        <div class="heading-box mt-3 mb-3 faq_main" id="profileDetialFAQ">
          <h2 class="font-weight-bold m-0 text-blue mb-3 text_18 text-xs-16">
             Frequently Asked Questions
          </h2>
          <div>
             <div class="question_main bg-white border-0 position-relative">
                <a data-toggle="collapse" class="pl-3 pr-3 pt-2 pb-2 collapsed faq_inner faq_accordian w-100 d-inline-block lab-book-faq" 
                data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <span class="service-text font-weight-bold text_15">Does DoctorFindy Take Any Additional Charges for Appointment Booking for a Lab Test?</span>
                </a>
                <div class="collapse" id="collapseExample">
                  <div class="card-body custom_collapse p-3">
                    <span class="text_14">
                      We care for your health and value your concerns; therefore, DoctorFindy doesn't charge additional fees for booking an appointment.
                    </span>
                   </div>
                </div>
             </div>
              
             <div class="bg-white border-0 question_main mt-2 position-relative">
                <a data-toggle="collapse" class="pl-3 pr-3 pt-2 pb-2 collapsed faq_inner faq_accordian w-100 d-inline-block lab-book-faq" 
                data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                <span class="service-text font-weight-bold text_15">
                Can I Get My Lab Test Result Online?</span>
                </a>
                <div class="collapse" id="collapseExample1">
                   <div class="card-body custom_collapse p-3">
                    <span class="text_14">
                      Yes, why not? DoctorFindy can provide you with online test results. You can check them through your DoctorFindy account or send them via email.
                      </span>
                   </div>
                </div>
             </div>
             <div class="bg-white border-0 question_main mt-2 position-relative">
                <a data-toggle="collapse" class="pl-3 pr-3 pt-2 pb-2 collapsed faq_inner faq_accordian w-100 d-inline-block lab-book-faq" 
                data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                <span class="service-text font-weight-bold text_15">How Can I Check For Medical Lab Reports Online?</span>
                </a>
                <div class="collapse" id="collapseExample2">
                   <div class="card-body custom_collapse p-3">
                    <span class="text_14">
                    DoctorFindy uploads all the test results. You can enter your invoice number and get the code. This code will help you to view your medical report.
                  </span>
                </div>
                </div>
             </div>
             <div class="question_main bg-white border-0 mt-2 position-relative">
                <a data-toggle="collapse" class="pl-3 pr-3 pt-2 pb-2 collapsed faq_inner faq_accordian w-100 d-inline-block lab-book-faq" 
                data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
                <span class="service-text font-weight-bold text_15">How to Book an Appointment for a Lab Test Online Through DoctorFindy?</span>
                </a>
                <div class="collapse" id="collapseExample3">
                   <div class="card-body custom_collapse p-3">
                    <span class="text_14">Booking a test online is a breeze with DoctorFindy. You can use DoctorFindy's official website or DoctorFindy app for online booking. Or, you can contact our customer services team at 0345-0435621. You can get an appointment for a lab (of your choice) at competitive prices through DoctorFindy.</span> 
                   </div>
                </div>
             </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
  <!-- FAQ Questions -->


  <!-- Start Privacy Section -->
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="privacy-section-text w-100 d-inline-block mt-3 pb-4">
          <p class="mb-0 text-blue text_14 font-weight-bold"><a href="/">DoctorFindy</a></p>
          <p class="text_black">
            <span class="text_black text_13">
              Ultimate Medical Service Provider
            </span>DoctorFindy is the ultimate solution when it comes to e-health services. DoctorFindy is one of the fastest-growing platforms offering medical assistance services.
Here you can conveniently avail the facility of tests at your doorstep. DoctorFindy is a gateway to connect to Pakistan's best doctors, hospitals, and laboratories.
          </p>
          <p class="text_black mt-3"> 
            <span class="text_black text_13">
              Top-Notch Laboratories in Pakistan 
            </span> DoctorFindy cares for you and connects you to the best labs in Pakistan. Get your medical tests done by the authentic and trusted labs in the healthcare industry. These include:
            <ul class="text_list mt-2">
              <li><a href="/lab/lahore/chughtai-lab">Chughtai Lab (Radiology Test)</a></li>
              <li><a href="lab/lahore/alnoor-diagnostic-centre">Alnoor Diagnostic Center</a></li>
              <li><a href="/lab/karachi/dr-essa-laboratory-diagnostic">Dr. Essa Laboratory</a></li>
              <li><a href="/lab/lahore/excel-labs">Excels Lab</a></li>
              <li><a href="/lab/lahore/citilab-and-research-centre">Citi-Labs And Research Center</a></li>
              <li><a href="/lab/islamabad/advance-diagnostic-centre">Advance Diagnostic Center</a></li>
              <li><a href="/lab/karachi/prolab-diagnostic-centre">ProLab Diagnostic Center</a></li>
              <li><a href="/lab/lahore/doctors-diagnostic-laboratory-consultants">Doctors Diagnostic Laboratory Consultants</a></li>
              <li><a href="/lab/islamabad/akbar-niazi-teaching-hospital-lab">Akbar Niazi Teaching Hospital Lab</a></li>
              <li><a href="/lab/lahore/hormone-lab">Hormone Lab</a></li>
              <li><a href="/lab/lahore/dna-lab-pakistan">DNA Labs Pakistan</a></li>
              <li><a href="/lab/islamabad/kulsum-international-hospital-laboratory">Kulsum Interantional Hospital</a></li>
            </ul>
          </p>
          <!-- <p class="text_black mt-3">
            <h6 class="font-weight-bold">Wide Selection of Tests:</h6> DoctorFindy Associate Labs covers a wide array of tests like blood sugar tests, thyroid tests, pregnancy tests, allergy tests, lipid profile, liver profile, platelet count, VDRL test, vitamin
            B12 deficiency test and more. Get details of all these tests such as blood test cost, when to take the tests, why it is required, who should take the test and what to do before taking the blood tests at home.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Sample Collection at Home:</h6> Book blood tests online from your home and our expert team of DoctorFindy Associate Labs technicians will arrive at the pre-scheduled time to pick up your sample. Once you
            get a diagnostic test done, you will receive your reports online.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Digital Reports:</h6> Get all your diagnostic reports emailed directly to you with detailed blood test reports & secure storage to easily access your medical records online.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Full Body Health Checkup:</h6> Keep your health and well being in check with exclusive Health Checkup Packages like Men’s Health Package, Women’s Health Package, Vitamin Package, Health Package for
            Corporates, Diabetes Packages, Packages for Senior Citizens & more. Get full details of all tests available in a package when booking online pathology tests.
          </p>
          <p class="text_black mt-3">
            DoctorFindy Associate Labs provides services to the following cities: Lahore, Islamabad, Karachi, Quetta, Peshawar, Gujranwala, Faisalabad, Gujrat, Jehlum, Sargoda, Mianwali, Hayedrabad, Gawadar.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">DoctorFindy – Leading Medical Care Providers</h6>
            DoctorFindy is a Lahore-based E-commerce marketplace for healthcare and fitness service providers and is one of the best e-health platforms, the fastest growing health tech company in Pakistan. It is the best platform for patients to connect with doctors run by a superb team of professionals. Motility throughout the country has been more difficult for Pakistanis in need of health care services. This private sector partnership helps Pakistani citizens to connect with a healthcare professional to address the issues they or their families are confronting.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">State of The Art Labs in Pakistan</h6>
            Founded in 2015, DoctorFindy stands among the top national and award-winning international companies in the healthcare industry. This platform has been built to bridge a patient with the right healthcare providers. The popular lab test in Pakistan provided by DoctorFindy includes:
            <ul class="text_list">
              <li>Chughtai Lab (Radiology Test)</li>
              <li>Alnoor Diagnostic Center</li>
              <li>Dr. Essa Laboratory</li>
              <li>Excels Lab</li>
              <li>Citi-Labs And Research Center</li>
              <li>Advance Diagnostic Center</li>
              <li>ProLab Diagnostic Center</li>
              <li>Doctors Hospital (Pathology Lab)</li>
              <li>Akbar Niazi Teaching Hospital Lab</li>
              <li>Hormone Lab</li>
              <li>DNA Labs Pakistan</li>
              <li>Kulsum Interantional Hospital</li>
            </ul>
          </p> -->
          <!-- <p class="text_black mt-3">
            <h6 class="font-weight-bold">Chughtai Lab</h6>
            Chughtai Lab provides you free home sampling service, you can get the benefits of a diagnostic center in your home. You can also book an online blood test with Chughtai lab. It offers blood tests like C/E (complete, CBC), vitamin D test, Cholesterol / HDL cholesterol ratio, blood glucose random, Covid-19 test, and many more. Chughtai lab provides blood sampling services in the cities such as Lahore, Karachi, Islamabad, Rawalpindi, Faisalabad, Gujranwala, Multan, Peshawar, Quetta, Sargodha, Rajanpur, Sialkot, Sahiwal, Dera Ghazi Khan, Dera Ismail Khan, Balakot and all other famous cities in Pakistan.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Alnoor Diagnostic Center</h6>
            Alnoor Diagnostic Center provides free medical testing services such as 17-OH progesterone, Albumin (fluid), Anti-Hbs, Liver function tests, Uric acid, and many more tests for patients. Alnoor Diagnostic Center labs are present in Lahore, Karachi, Islamabad, Rawalpindi, Faisalabad, Gujranwala, Multan, Peshawar, Quetta, Sargodha, Sialkot.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Dr. Essa Laboratory</h6>
            Dr. Essa Laboratory provides the lowest price of tests services throughout Pakistan. It provides medical tests such as lipid profile, X-ray: abdomen erect view, liver function test, 17-OH progesterone, Semen analysis, etc. Its lab test service is available in Lahore, Karachi, Islamabad, Rawalpindi, Gujranwala, Sialkot, Wah cant, Taxila, Peshawar, etc.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Excels Lab</h6>
            Excels Lab provides 24 hours service to patients with an accurate diagnosis. You can book an online test such as CT chest high resolution, albumin (fluid), anti-ds DNA, cholesterol ratio, blood urea, blood culture test, and many more. Its service is available in Lahore, Karachi, Islamabad, Rawalpindi, Gujranwala, Sialkot, Sahiwal, Taxila, etc.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Citi-Labs And Research Center</h6>
            Citi-Labs And Research Center provides high-ranking quality diagnostic services to patients. They provide 24 hours lab service. Citi-lab offers 1000+ clinical laboratory tests such as C/E (complete, CBC), vitamin D test, Cholesterol / HDL cholesterol ratio, liver function test, and many more. Its lab service is available in Lahore, Karachi, Islamabad, Rawalpindi, Faisalabad, Multan, Peshawar, Quetta, Sargodha, Sialkot, Sahiwal.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Advance Diagnostic Center</h6>
            Advance Diagnostic Center provides a free online medical testing service for patients. It provides lab testing such as renal function test, 24 hrs calcium, complete blood count (CBC) (blood test), liver function test, and many more. Its lab test services are available in Lahore, Karachi, Islamabad, Rawalpindi, Faisalabad, Gujranwala, Multan, Peshawar, Quetta.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">ProLab Diagnostic Center</h6>
            ProLab Diagnostic Center provides online lab test services such as liver function test, 17-OH progesterone, lipid profile, uric acid (serum), and many more. Its services are available in Lahore, Karachi, Islamabad, Rawalpindi, Faisalabad, Multan, Peshawar, Quetta, Sargodha, Sialkot, Faizabad.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Doctors Hospital (Pathology Lab)</h6>
            Doctors Hospital (Pathology Lab) provides you reliable and appropriate laboratory testing services for 24 hours for patients. It offers 50+ laboratory tests which include CBC test, Absolute Lymphocyte Count Test, Anti-Hbs, Absolute Neutrophil Count Test, Glucose (Fluid) Test, HbA1c, and many more.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Akbar Niazi Teaching Hospital Lab</h6>
            Akbar Niazi Teaching Hospital Lab provides complete healthcare facilities and advanced laboratory services to patients at an affordable cost. It offers blood tests like blood C/E (complete, CBC), vitamin D test, cholesterol / HDL cholesterol ratio, MCV, hemoglobin test, leukocyte count test, hematocrit test, coagulation time, blood sugar, fasting blood glucose (FBG), fasting blood sugar (FBS), isospora test and many more.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Hormone Lab</h6>
            Hormone Lab is one of the main pathology labs in Pakistan. You can book an online lab test by visiting the DoctorFindy website.
          </p> -->
          <!-- <div class="near_tests mt-4">
            <h5>Book Lab Tests Near You</h5>
            <div class="row">
              <div v-for="city in cities" class="col-12 col-lg-3 col-md-4 col-sm-6">
                <div class="all-procedure text-center city-border mb-3">
                    <a :href="'/lab-test-in-/'+ city.slug" class="text_black text_13 w-100 d-inline-block p-2" style="text-overflow: ellipsis; overflow: hidden;">Lab Tests in {{city.title}}</a>
                </div>
              </div>
            </div>
          </div>
          <div class="near_tests mt-lg-4 mt-md-4 mt-0">
            <h5>Radiology Pathology Labs in Pakistan</h5>
            <div class="row">
              <div v-for="city in cities" class="col-12 col-lg-3 col-md-4 col-sm-6">
                <div class="all-procedure text-center city-border mb-3">
                    <a :href="'/labs/'+ city.slug" class="text_black text_13 w-100 d-inline-block p-2" style="text-overflow: ellipsis; overflow: hidden;">Labs in {{city.title}}</a>
                </div>
              </div>
              
            </div>
          </div> -->
          <!-- <p class="text_black mt-3 text-center">
            This site is protected by reCAPTCHA and the Google <a class="font-weight-bold theme-color-text" 
            href="javascript:void(0)">Privacy Policy
            </a> and <a class="font-weight-bold theme-color-text" href="javascript:void(0)">Terms of Service
            </a> apply.
          </p> -->
        </div>
      </div>
    </div>
  </div>
  <!-- <helpLine-consultation-section></helpLine-consultation-section> -->
  <div class="container">
    <div class="row">
      <div class="col-12">
        <lab-tag-section
          :cities="cities"
          >
            
          </lab-tag-section>
      </div>
    </div>
  </div>
  <!-- End Privacy Section -->

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

        <lab-model :branches="users" :specialitys="specialities" :doctorss="doctors" :hospitalss="hospitals" :diseasess="diseases" :servicess="services" :laboratories="allLaboratories" :cities="allcities" :tests="allTests" :selectlab="lab"  :test_id="test_id" :fileSystemDriver="fileSystemDriver"></lab-model>
  </div>
</template>

<script>
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
import { VueAutosuggest } from 'vue-autosuggest';
import moment from 'moment';
Vue.use(Toasted)
export default {
   components: { VueSlickCarousel , VueAutosuggest },
  props:[ 'specialitys', 'servicess', 'cities', 'diseasess', 'doctorss', 'hospitalss', 'laboratories', 'trendingTopics','managements', 'logged_user', 'segments','tests','symptoms','users','totalTestsDataCount','bread_crumb_data', 'fileSystemDriver'],
  name: "LabBannerComponent",
  data() {
    return {
      basePath:'',
      moment:moment,
      c_name:'Name',
      c_phone_number:'Phone Number',
      c_address:'',
      c_code:"",
      c_home_sampling:null,
      c_age:'',
      phone_number:'',
      address:'',
      name:'',
      balance: 0,
      home_sampling:'',
      age:'',
      isSticky: false,
      prevScrollPos: window.pageYOffset,
      selectedLocation: [],
      specialities: this.specialitys,
      doctors: this.doctorss,
      hospitals: this.hospitalss,
      diseases: this.diseasess,
      services: this.servicess,
      symptomsToShow: 5,
      TestsToShow: 8,
      search: '',
      allLaboratories: [],
      allLocations: this.cities,
      allcities: [],
      allTests: [],
      findTests: [],
      submitting: false,   
      discountCodeGenerated: false,
      id : '',
      showDropdown:false,
      test_id : '',
      lab:null,
      findsymptoms : this.tests,
      keyword: null,
      keyword1: null,
      testResult:null,
      get_title: 'All',
       c2Setting: {
        slidesToShow:4,
        arrows: true,
        health_community_slider: '',
        show_healthtabs: '',
        hide_show: '',
        slides: '',
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 640,
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
    }
  },
  watch: {
        keyword(after, before) {
            this.getResults();
        },
        keyword1(after, before) {
            this.getResults1();
        }
    },
  created() {
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  mounted(){
    window.addEventListener('scroll', this.handleScroll);
      this.users.forEach(fields => {
        var lab_name = fields.first_name +" "+fields.last_name;

         this.allLaboratories.push({first_name:fields.first_name,last_name:fields.last_name,name:lab_name,id:fields.id})
      });

      this.cities.forEach(fields => {
         this.allcities.push({name:fields.title,id:fields.id})
      });
     this.getAllTestsData();
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    formatPhoneNumber() {
      if (this.phone_number.startsWith('0')) {
        this.phone_number = '92' + this.phone_number.slice(1);
      }
    },
    hideSummaryDiscountModal(e) {
      this.loading = true
      document.querySelector('body').classList.remove('modal-open')
      document.querySelector('#response_modal').style.display = 'none'
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
                         this.c_home_sampling = response.data.data.home_sampling;
                         this.c_age = response.data.data.age;
                         this.balance = response.data.balance;
                         this.phone_number = '';
                         this.name = '';
                         this.address = '';
                         this.age = '';
                         this.home_sampling = '';
                           this.$toasted.show("Your request submitted",{
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
    hideDiscountModal(e) {
      this.loading = true
      document.querySelector('#discount_modal').classList.remove('feedback_modle')
      document.querySelector('body').classList.remove('modal-open')
      document.querySelector('#discount_modal').style.display = 'none'
      this.discountCodeGenerated = false;
      this.loading = false
    },
    forHomeSampling(){
      document.getElementById('home_sampling').onchange = function() {
    document.getElementById('home-sampling-field').style.display = this.checked ? 'block' : 'none';};
    },
    showDiscountModal(){
      this.loading = true
      
        document.querySelector('#discount_modal').classList.add('show')
        document.querySelector('body').classList.add('modal-open')
        document.querySelector('#discount_modal').style.display = "block"
    
      this.loading = false
    },
     handleScroll() {
      const currentScrollPos = window.pageYOffset;
      if (currentScrollPos > 360 && currentScrollPos) {
        this.isSticky = true;
      } else {
        this.isSticky = false;
      }

    },
     getAllTestsData()
     {
        axios.get('/front-end-get-all-tests')
        .then(response=>{
             this.tests=response.data;
             this.tests.forEach(fields => {
             this.allTests.push({name:fields.title,id:fields.id,price:fields.price,discounted_price:fields.discounted_price,labo_id:fields.lab_id})
              });
              this.findsymptoms= this.tests;

        })
     },
    hideListing(e){
      if (e.target.className == 'form-control banner_input text_14 w-100') {
        if(this.keyword1.length > 3){
          this.showDropdown = true;
        }else{
          this.showDropdown = false
        }
      }else{
        this.showDropdown = false;
      }
    },
    bodyHideListing(event){
      if (event.target.className != "form-control banner_input text_14 w-100") {
        this.showDropdown = false
      }
    },
    getResults() {
          if(this.keyword.length > 2){
            axios.get('/all-test-search', { params: { keyword: this.keyword } })
                .then(res => this.findsymptoms = res.data)
                .catch(error => {});
          }
          else
          {
            if(this.keyword.length < 1)
            {
              this.findsymptoms = this.tests;
            }
          }      
        },
        getResults1() {
          if(this.keyword1.length > 2){
            this.showDropdown=true;
            axios.get('/all-test-search-banner', { params: { keyword1: this.keyword1 } })
                .then(res => this.testResult = res.data)
                .catch(error => {});
          }
        },
      findTest(id){
        this.test_id =id;
               let self = this
              self.findTests = [];
          self.tests.forEach(function (x) {
            if (x.id === id) {
                self.findTests.push(x)
            }
      })
          // console.log('sdasdw',self.findTests);
        },
           symptomData(id) {
              let self = this
              self.findsymptoms = [];
          self.symptoms.forEach(function (x) {
            if (x.id === id) {
                self.findsymptoms = x.tests
                self.get_title = x.title
            }
      })
    },
    getAlltests(){
      let self = this
      self.findsymptoms = self.tests;
      self.get_title = 'All'
    },
// end search test
  }
}
</script>
<style>
#discount_modal,#response_modal{
  background: rgba(0,0,0,0.7);
}
.autosuggest__results-container{
  width: 84%;
}
.lab-tests img{
  height: 100%;
}
.lab_listing_dropdown{
  width: 100%;
  background-color: #ffffff;
  margin: 0px;
}
.listing_main{
  width: 100% !important;
  display: block;
  margin-left:0 !important;
  max-height: 200px;
  overflow-y: auto;
  background-color: #ffffff;
  position: absolute;
  top: 38px !important;
  left: 15px;
  z-index:1;
  overflow-x: hidden;
}
.lab-search-btn{
  right: -30px !important;
}
.text_list{
  list-style: disc;
  padding-left: 40px;
}
.city-border a {
  border: 1px solid #e5e5e5;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.all-procedure a {
  background-color: #dddddd;
  color: black;
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
.slick-prev, .slick-next{
  top: 35%;
}
@media (max-width: 991px){
  .banner_heading span{
    font-size: 27px;
  }
  .banner_heading{
    color: #fff;
  }
  .mobile_search_btn {
    top: 10px !important;
  }
  .inner-slider{
    margin-top: 40px;
  }
}
.inner-slider{
  margin-top: 75px;
}
@media (max-width: 360px){
  .slick-prev {
    left: -13px;
  }
  .slick-next {
    right: -17px;
  }
}
.modal-open{
  overflow-y: scroll !important;
}
.sliderBox {
  margin: 20px;
}
.work_text{
  height: 70px !important;
  overflow: hidden;
}
.default_test{
  background: #2b4df9;
}
.input-lab-test-search input{
  border:1px solid #8b8b8b !important;
}

.lab_image img{
  width: 100px;
  border-radius: 135px;
  height: 95px;
  border: 1px solid #9F9F9F;
}
.faq_main .card-body{
  padding-left: 0;
  padding-right: 0;
  background-color:#DBE5FF;
}

.test-details{
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

</style>