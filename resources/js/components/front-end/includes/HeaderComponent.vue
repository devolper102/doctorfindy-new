<template>
  <div>
    <header class="w-100 d-inline-block" id="header">
      <div class="top_header_border d-none d-lg-none w-100 mb-1 bg-blue">
        <div class="container">
          <div class="row">
            <div class="col-5">
              <ul class="about-contact-section float-left w-100 d-inline-block">
                <li class="float-left text_13 mr-3 pt-1 zoom-text">
                <a href="/products" class="text-white">Products
                </a>
              </li>
              <li class="float-left text_13 mr-3 pt-1 zoom-text">
                <a href="/brands-and-offers" class="text-white">Brands & Offers</a>
              </li>
              </ul>
            </div>
            <!-- <div class="col-3 pl-lg-0">
              <div class="dropdown w-65 w-md-80 apps_dropdown">
                <a href="javascript:void(0)" class="text_13 text_black applink">Download KnockDoc App <i class="fa fa-mobile" aria-hidden="true"></i> </a>
                <div class="dropdown-menu text_12 box_shadow more_submenu">
                  <a class="float-left w-48 mr-2" :href="ios_url">
                    <p class="mb-1">For IOS</p>
                    <v-lazy-image :src="'/uploads/settings/home/'+ ios_img"alt="IOS image" name="IOS image"class="img-fluid"  />
                  </a>
                    <a class="float-left w-48" :href="android_url">
                      <p class="mb-1">For Android</p>
                      <v-lazy-image :src="'/uploads/settings/home/'+ android_img"alt="Google Play image" name="Google Play image"/>
                    </a>
                </div>
              </div>
            </div> -->
            <div class="col-7">
            <ul class="top_menu float-right mb-2 w-55 pl-2 w-ipad-100">
              <li class="nav-link float-left p-0 mr-4 pt-1 
              zoom-text">
                <a href="/practice-as-doctor" class="nav-item text-white text_13">For Doctors</a>
              </li>
              <li class="nav-link float-left p-0 mr-5 pt-1 zoom-text">
                <a href="/for-hospital" class="nav-item text-white text_13">For Hospital and Clinics</a>
              </li>
              <li class="nav-link float-left p-0 mr-3 pt-1 zoom-text">
                <a href="/for-lab" class="nav-item text-white text_13">
                For Lab</a>
              </li>
              <!-- <li class="nav-link float-left p-0 mr-0 more_list dropdown">
                  <a href="javascript:void(0)" class="nav-item text_black text_13 p-3" id="moreDropdown">More</a>
                  <div class="dropdown-menu text_12 box_shadow box_radius more_submenu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="/doctors">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
              </li> -->
            </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="container p-0">
        <div class="row no-gutters">
          <nav class="navbar navbar-expand-lg navbar-light w-100 header_nav home_header mt-lg-1 pt-2 pb-2 pt-lg-0 pb-lg-0 mobile_border">
            <button class="navbar-toggler float-left ml-sm-2 ml-md-2 pl-2" type="button" data-toggle="modal" data-target="#MenuButtonModal" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a v-if="screenSize === 'Desktop'" class="navbar-brand w-sm-30 w-15 d-flex" href="/">
               <img v-lazy="basePath+'/uploads/settings/general/'+ main_logo" alt="Site Logo" name="Site Logo"  class="site-logo"/>
            </a>
             <a v-else class="navbar-brand w-sm-30 w-15 d-flex logo-responsive" href="/">
               <img v-lazy="basePath+'/uploads/settings/general/white-header-logo.svg'" alt="Site Logo" name="Site Logo" />
            </a>
            <!-- <div class="float-left d-block d-lg-none d-xl-none mr-2 product-login" v-if="logged_user.length !== undefined">
              <a href="/login" class="float-left text-white applink pr-3">
                <i class="fa fa-user-circle text_md_20" aria-hidden="true"></i>
                  Login
                </a> -->
              <!-- <span class="text_black float-left mr-1 ml-1">|</span> -->
              
              <!-- <a class="float-left text_black applink" href="/register">Register</a> -->
              <!-- <div class="dropdown-menu login_dropdown_list w-100 box_shadow text_12" aria-labelledby="dropdownMenuButton">
                <a href="/login" class="w-100 pt-0 pl-3 pb-0 pr-3 d-inline-block">Login</a>
                <div role="separator" class="dropdown-divider mt-1 mb-1"></div>
                <a href="/register" class="w-100 pt-0 pl-3 pb-0 pr-3 d-inline-block">Register</a>
              </div> -->
            <!-- </div> -->
            <ul class="d-lg-none d-block call-icon mb-0 float-right mr-5">
              <li>
                <a class="text-white" :href="'tel:'+number">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                </a>
              </li>
            </ul>
            <ul class="d-lg-none d-none show-cart lab-show-cart mb-0 float-right">
                  <li class="nav-item header_margin float-left m-0">
                    <a @click="showdropdownLab()" class="text_black d-inline-block shoping-cart-btn position-relative" href="javascript:void(0)">
                    <sup class="mt-2 text_15">
                      <span id="cart-item" class="position-absolute text-center">
                        0
                      </span>
                    </sup>
                      <span class="w-100 d-inline-block mt-2 text_black">
                        <i class="fa fa-shopping-cart w-xs-100 
                        float-left" aria-hidden="true" style="font-size:24px;"></i>
                    </span>
                    </a>
                  </li>
                </ul>
            <ul v-if="showCart" class="d-lg-none d-block show-cart mb-0">
                  <li class="nav-item header_margin float-left m-0">
                    <a @click="showcartdropdown()" class="text_black d-inline-block shoping-cart-btn position-relative" 
                    href="javascript:void(0)">
                    <sup class="mt-2 text_15">
                      <span id="cart-item" class="position-absolute knockdoc_btn_bg text-center">
                        0
                      </span>
                    </sup>
                      <span class="w-100 d-inline-block mt-2">
                        <i class="fa fa-shopping-cart w-xs-100 
                        float-left" aria-hidden="true" style="font-size:28px;"></i>
                    </span>
                    </a>
                  </li>
                </ul>
            <a class="nav-link rounded-pill mobile_knockdoc_head_btn text-white d-none d-lg-none" :href="'tel:'+number">{{title}}
              <i class="fas fa-phone fa-sm" aria-hidden="true"></i>
            </a>
            <div v-if="logged_user.length === undefined" class=" dropdown d-block d-lg-none header_margin position-relative">
              <div class="d-inline-block user_dropdown_main" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <a class="nav-link float-left pl-0 pr-1 text-white d-none" href="javascript:void(0)">User Name</a>
                <a class="float-left mr-md-3" href="javascript:void(0)">
                  <v-lazy-image v-if="logged_user.profile.avatar !== null" class="h_40 w-40px border-1 border border-white rounded-circle d-flex mrlg-0 mr-2" :src="basePath+'/uploads/users/'+logged_user.id+'/'+logged_user.profile.avatar" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name"/>
                  <v-lazy-image v-else-if="logged_user.roles[0].name === 'doctor'" :src="basePath+'/uploads/users/default/doctor.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name" class="h_40 w-40px border-1 border border-white rounded-circle d-flex"/>
                  <v-lazy-image v-else-if="logged_user.roles[0].name === 'hospital'" :src="basePath+'/uploads/users/default/hospital.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name" class="h_40 w_40px border-1 border border-white rounded-circle d-flex"/>
                  <v-lazy-image v-else-if="logged_user.roles[0].name === 'patient'" :src="basePath+'/uploads/users/default/patient.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name" class="h_40 w_40px border-1 border border-white rounded-circle d-flex"/>
                  <v-lazy-image v-else="logged_user.roles[0].name === 'laboratory'" :src="basePath+'/uploads/users/default/lab.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name" class="h_40 w_40px border-1 border border-white rounded-circle d-flex"/>
                </a>
                <div class="dropdown-menu user_dropdown_list w-100 box_shadow box_radius text_12" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" :href="'/'+logged_user.roles[0].name+'/dashboard'">Dashboard</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/doctors">Book appointment</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" :href="'/'+logged_user.roles[0].name+'/appointments'">My appointment</a>
                  <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" :href="'/'+logged_user.roles[0].name+'/dashboard#wish-list'">Wish list</a>
                  <div role="separator" class="dropdown-divider"></div>
                  <a class="dropdown-item" @click="logout()"> Logout</a>
                </div>
              </div>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <span class="text-right text-white w-100 d-inline-block text_25 d-inline-block d-lg-none" data-dismiss="collapse" aria-label="Close">
                <i class="fa fa-times" @click="closeCollapse()" aria-hidden="true"></i>
              </span>
              <ul class="navbar-nav mr-auto w-100 position-relative navigation_menu">
                <!-- <li class="nav-item header_margin d-none d-lg-block" id="appointment_btn">
                  <a class="nav-link rounded-pill knockdoc_head_btn text-white d-inline-block" :href="url">{{btn}} <span class="sr-only">(current)</span></a>
                </li> -->
                <li class="nav-item dropdown doctor_list d-none d-lg-inline-block">
                  <a class="nav-link dropdown-toggle" href="#" 
                  id="doctorsDrodpwon" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Find your Doctor</a>
                  <div class="dropdown-menu mega-menu box_radius box_shadow doctors_dropdown" aria-labelledby="doctorsDrodpwon">
                    <!-- <a class="position-absolute triangle-image" 
                    href="javascript:void(0)">
                      <img src="/images/triangle-image.png" 
                      alt="pictire">
                    </a> -->
                    <div class="arrow-up"></div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="w-100 d-inline-block">
                          <span class="text_14 text-blue font-weight-bold">Find by Specialties
                          </span>
                        </div>
                        <ul class="w-100 d-inline-block mt-1">
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/dermatologist-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[0]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/skin-disease.svg'" alt="dermatologist" name="dermatologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              Dermatologist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/dermatologist-in-lahore">
                                    Dermatologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/dermatologist-in-islamabad">
                                    Dermatologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/dermatologist-in-karachi">
                                    Dermatologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/dermatologist-in-pakistan">
                                    Dermatologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/gynecologist-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[1]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/gynecologist.svg'" alt="gynecologist" name="gynecologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              Gynecologist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/gynecologist-in-lahore">
                                    Gynecologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/gynecologist-in-islamabad">
                                    Gynecologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/gynecologist-in-karachi">
                                    Gynecologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/gynecologist-in-pakistan">
                                    Gynecologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/pediatrician-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[2]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/child-specialist.svg'" alt="pediatrician" name="pediatrician"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              Child Specialist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/pediatrician-in-lahore">
                                    Child Specialist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/pediatrician-in-islamabad">
                                    Child Specialist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/pediatrician-in-karachi">
                                    Child Specialist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/pediatrician-in-pakistan">
                                    Child Specialist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/ent-specialist-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[3]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/ent-specialist.svg'" alt="ent-specialist" name="ent-specialist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              Ent Specialist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/ent-specialist-in-lahore">
                                    Ent Specialist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/ent-specialist-in-islamabad">
                                    Ent Specialist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/ent-specialist-in-karachi">
                                    Ent Specialist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/ent-specialist-in-pakistan">
                                    Ent Specialist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/diabetologist-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[4]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/diabelogist.svg'" alt="diabetologist" name="diabetologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              Diabetologist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diabetologist-in-lahore">
                                    Diabetologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diabetologist-in-islamabad">
                                    Diabetologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diabetologist-in-karachi">
                                    Diabetologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diabetologist-in-pakistan">
                                    Diabetologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/neurologist-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[5]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/neuro.svg'" alt="neurologist" name="neurologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              Neurologist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/neurologist-in-lahore">
                                    Neurologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/neurologist-in-islamabad">
                                    Neurologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/neurologist-in-karachi">
                                    Neurologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/neurologist-in-pakistan">
                                    Neurologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/cardiologist-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[6]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/cardiologist.svg'" alt="cardiologist" name="cardiologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              Cardiologist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/cardiologist-in-lahore">
                                    Cardiologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/cardiologist-in-islamabad">
                                    Cardiologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/cardiologist-in-karachi">
                                    Cardiologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/cardiologist-in-pakistan">
                                    Cardiologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/general-physician-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[7]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/general-physician.svg'" alt="general-physician" name="general-physician"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              General Physician
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/general-physician-in-lahore">
                                    General Physician in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/general-physician-in-islamabad">
                                    General Physician in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/general-physician-in-karachi">
                                    General Physician in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/general-physician-in-pakistan">
                                    General Physician in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block">
                      <a href="/find-a-doctor-near-you" 
                      class="d-inline-block book-rounded bg-green text-white text_12 btn-view mt-lg-0 mb-3 mb-lg-0 mt-3">View All
                      </a>
                    </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="w-100 d-inline-block">
                          <span class="text_14 text-blue font-weight-bold">Find by Diseases</span>
                        </div>
                        <ul class="w-100 d-inline-block mt-1">
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/diabetes-insipidus" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/diabelogist.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Diabetes
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/diabetes-insipidus/lahore">
                                    Diabetes Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/diabetes-insipidus/islamabad">
                                    Diabetes Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/diabetes-insipidus/karachi">
                                    Diabetes Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/diabetes-insipidus">
                                    Diabetes Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/blood-pressure" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/blood-pressure.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">High Blood Pressure
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute treatment-list-menu">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/blood-pressure/lahore">
                                    High Blood Pressure Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/blood-pressure/islamabad">
                                    High Blood Pressure Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/blood-pressure/karachi">
                                    High Blood Pressure Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/blood-pressure">
                                    High Blood Pressure Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/skin-diseases" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/skin-disease.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Skin Diseases
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute treatment-list-menu">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/skin-diseases/lahore">
                                    Skin Diseases Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/skin-diseases/islamabad">
                                    Skin Diseases Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/skin-diseases/karachi">
                                    Skin Diseases Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/skin-diseases">
                                    Skin Diseases Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/heart-diseases" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/heart-disease.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Heart Diseases
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute treatment-list-menu">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/heart-diseases/lahore">
                                    Heart Diseases Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/heart-diseases/islamabad">
                                    Heart Diseases Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/heart-diseases/karachi">
                                    Heart Diseases Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/heart-diseases">
                                    Heart Diseases Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/pregnancy-obstetrician" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/pregnant.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Pregnancy
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician/lahore">
                                   Pregnancy Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician/islamabad">
                                   Pregnancy Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician/karachi">
                                    Pregnancy Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician">
                                    Pregnancy Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/acne" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/acne.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Acne
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/acne/lahore">
                                   Acne Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/acne/islamabad">
                                   Acne Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/acne/karachi">
                                    Acne Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/acne">
                                    Acne Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/piles" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/piles.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Piles
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/piles/lahore">
                                   Piles Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/piles/islamabad">
                                   Piles Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/piles/karachi">
                                    Piles Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/piles">
                                    Piles Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/asthma" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/asthma.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Asthma
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/asthma/lahore">
                                   Asthma Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/asthma/islamabad">
                                   Asthma Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/asthma/karachi">
                                    Asthma Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/asthma">
                                    Asthma Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block">
                      <a href="/diseases" 
                      class="d-inline-block book-rounded bg-green text-white btn-view mt-lg-0 mb-3 mb-lg-0 mt-3 text_12">View All
                      </a>
                    </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="w-100 d-inline-block">
                          <span class="text_14 text-blue font-weight-bold">Find by Surgeries</span>
                        </div>
                        <ul class="w-100 d-inline-block mt-1">
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/bypass-surgery" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/open-heart.svg'" 
                              alt="Open Heart Surgery">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Open Heart Surgery
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/lahore/bypass-surgery">
                                    Open Heart Surgery in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/islamabad/bypass-surgery">
                                    Open Heart Surgery in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="'/surgeries/karachi/bypass-surgery">
                                    Open Heart Surgery in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    Open Heart Surgery in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/mri" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/mri.svg'" 
                              alt="MRI">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">MRI
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/lahore/mri">
                                    MRI in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/islamabad/mri">
                                    MRI in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/karachi/mri">
                                    MRI in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    MRI in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/c-section" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/c-section.svg'" 
                              alt="C-Section">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">C-Section
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/lahore/c-section">
                                    C-Section in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/Islamabad/c-section">
                                    C-Section in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/karachi/c-section">
                                    C-Section in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    C-Section in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/chemotherapy" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/chemotherapy.svg'" 
                              alt="chemotherapy">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Chemotherapy
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/lahore/chemotherapy">
                                    Chemotherapy in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/Islamabad/chemotherapy">
                                    Chemotherapy in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/karachi/chemotherapy">
                                    Chemotherapy in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    Chemotherapy in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/Hair-Transplant" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/hair-transpllant.svg'" 
                              alt="hair-transplant">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Hair Transplant
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/lahore/Hair-Transplant">
                                    Hair Transplant in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="j/surgeries/islamabad/Hair-Transplant">
                                    Hair Transplant in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/karachi/Hair-Transplant">
                                    Hair Transplant in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    Hair Transplant in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/kidney-transplant" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/kidney-transplant.svg'" 
                              alt="kidney-transplant">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Kidney Transplant
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/lahore/kidney-transplant">
                                    Kidney Transplant in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/islamabad/kidney-transplant">
                                    Kidney Transplant in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/karachi/kidney-transplant">
                                    Kidney Transplant in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    Kidney Transplant in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/braces-price-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/braces.svg'" 
                              alt="braces">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Braces
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/lahore/braces-price-in-pakistan">
                                    Braces in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/islamabad/braces-price-in-pakistan">
                                    Braces in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/karachi/braces-price-in-pakistan">
                                    Braces in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    Braces in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/laser-hair-removal" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/laser-hair-removal.svg'" 
                              alt="laser-hair-removal">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Laser Hair Removal
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/lahore/laser-hair-removal">
                                    Laser Hair Removal in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/islamabad/laser-hair-removal">
                                    Laser Hair Removal in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/karachi/laser-hair-removal">
                                    Laser Hair Removal in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    Laser Hair Removal in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block">
                      <a href="/surgeries" 
                      class="d-inline-block book-rounded bg-green text-white btn-view mt-lg-0 mb-3 mb-lg-0 mt-3 text_12">View All
                      </a>
                    </div>
                      </div>
                      <!-- <div class="col-lg-3">
                        <div class="w-100 d-inline-block emergency-consult book-rounded p-2">
                          <div class="w-100 d-inline-block text-center emergency-consult-image">
                            <img src="/images/emergency-consult-image.png" 
                            alt="pictire">
                          </div>
                          <div class="w-100 d-inline-block 
                          text-center mt-2">
                            <img src="/images/emergency-icon-image.png" alt="pictire">
                            <p class="text-blue font-weight-bold text_16 mt-1">EMERGENCY</p>
                          </div>
                          <div class="w-100 d-inline-block text-center consult-btn mt-2 mb-1">
                            <a href="javascript:void(0)" 
                            class="d-inline-block book-rounded bg-red text-white text_14 mt-lg-0 mb-3 mb-lg-0 mt-3">Consult Now
                            </a>
                          </div>
                        </div>
                      </div> -->
                    </div>
                  </div>
                </li>
                <li class="d-block d-lg-none w-100 d-inline-block position-relative doctor-speciality-list">
                  <a href="javascript:void(0)" class="nav-link text-white">Doctors
                    <!-- data-toggle="modal" data-target="#doctors_menu" -->
                  </a>
                  <div class="w-100 d-inline-block doctor-speciality-list-menu">
                  <div class="row">
                    <div class="col-lg-4">
                        <div class="w-100 d-inline-block">
                          <span class="text_15 text-white">Find by Specialties
                          </span>
                        </div>
                        <ul class="w-100 d-inline-block mt-1">
                          <li class="w-100 d-inline-block speciality-list cursor position-relative">
                            <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[0]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/skin-disease.svg'" alt="dermatologist" name="dermatologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              Dermatologist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/dermatologist-in-lahore">
                                    Dermatologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/dermatologist-in-islamabad">
                                    Dermatologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/dermatologist-in-karachi">
                                    Dermatologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/dermatologist-in-pakistan">
                                    Dermatologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[1]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/gynecologist.svg'" alt="gynecologist" name="gynecologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              Gynecologist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/gynecologist-in-lahore">
                                    Gynecologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/gynecologist-in-islamabad">
                                    Gynecologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/gynecologist-in-karachi">
                                    Gynecologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/gynecologist-in-pakistan">
                                    Gynecologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[2]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/child-specialist.svg'" alt="pediatrician" name="pediatrician"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              Child Specialist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/pediatrician-in-lahore">
                                    Child Specialist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/pediatrician-in-islamabad">
                                    Child Specialist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/pediatrician-in-karachi">
                                    Child Specialist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/pediatrician-in-pakistan">
                                    Child Specialist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[3]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/ent-specialist.svg'" alt="ent-specialist" name="ent-specialist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              Ent Specialist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/ent-specialist-in-lahore">
                                    Ent Specialist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/ent-specialist-in-islamabad">
                                    Ent Specialist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/ent-specialist-in-karachi">
                                    Ent Specialist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/ent-specialist-in-pakistan">
                                    Ent Specialist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[4]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/diabelogist.svg'" alt="diabetologist" name="diabetologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              Diabetologist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diabetologist-in-lahore">
                                    Diabetologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diabetologist-in-islamabad">
                                    Diabetologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diabetologist-in-karachi">
                                    Diabetologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diabetologist-in-pakistan">
                                    Diabetologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[5]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/neuro.svg'" alt="neurologist" name="neurologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              Neurologist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/neurologist-in-lahore">
                                    Neurologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/neurologist-in-islamabad">
                                    Neurologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/neurologist-in-karachi">
                                    Neurologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/neurologist-in-pakistan">
                                    Neurologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[6]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/cardiologist.svg'" alt="cardiologist" name="cardiologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              Cardiologist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/cardiologist-in-lahore">
                                    Cardiologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/cardiologist-in-islamabad">
                                    Cardiologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/cardiologist-in-karachi">
                                    Cardiologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/cardiologist-in-pakistan">
                                    Cardiologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[7]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/general-physician.svg'" alt="general-physician" name="general-physician"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              General Physician
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/general-physician-in-lahore">
                                    General Physician in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/general-physician-in-islamabad">
                                    General Physician in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/general-physician-in-karachi">
                                    General Physician in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/general-physician-in-pakistan">
                                    General Physician in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block 
                        text-center">
                      <a href="/find-a-doctor-near-you" 
                      class="d-inline-block book-rounded bg-white text-blue text_13 btn-view mt-lg-0 mb-2 mb-lg-0 mt-3 underline">View All
                      </a>
                    </div>
                    <div class="white-border w-100 d-inline-block mb-2">
                  </div>
                      </div>
                  </div>
                  <div class="col-lg-4">
                        <div class="w-100 d-inline-block">
                          <span class="text_15 text-white">Find by Diseases</span>
                        </div>
                        <ul class="w-100 d-inline-block mt-1">
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/diabelogist.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Diabetes
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/diabetes-insipidus/lahore">
                                    Diabetes Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/diabetes-insipidus/islamabad">
                                    Diabetes Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/diabetes-insipidus/karachi">
                                    Diabetes Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/diabetes-insipidus">
                                    Diabetes Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/blood-pressure.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">High Blood Pressure
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute treatment-list-menu">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/blood-pressure/lahore">
                                    High Blood Pressure Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/blood-pressure/islamabad">
                                    High Blood Pressure Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/blood-pressure/karachi">
                                    High Blood Pressure Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/blood-pressure">
                                    High Blood Pressure Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/skin-disease.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Skin Diseases
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute treatment-list-menu">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/skin-diseases/lahore">
                                    Skin Diseases Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/skin-diseases/islamabad">
                                    Skin Diseases Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/skin-diseases/karachi">
                                    Skin Diseases Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/skin-diseases">
                                    Skin Diseases Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/heart-disease.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Heart Diseases
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute treatment-list-menu">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/heart-diseases/lahore">
                                    Heart Diseases Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/heart-diseases/islamabad">
                                    Heart Diseases Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/heart-diseases/karachi">
                                    Heart Diseases Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/heart-diseases">
                                    Heart Diseases Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/pregnant.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Pregnancy
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician/lahore">
                                   Pregnancy Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician/islamabad">
                                   Pregnancy Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician/karachi">
                                    Pregnancy Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician">
                                    Pregnancy Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/acne.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Acne
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/acne/lahore">
                                   Acne Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/acne/islamabad">
                                   Acne Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/acne/karachi">
                                    Acne Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/acne">
                                    Acne Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/piles.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Piles
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/piles/lahore">
                                   Piles Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/piles/islamabad">
                                   Piles Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/piles/karachi">
                                    Piles Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/piles">
                                    Piles Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/asthma.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Asthma
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/asthma/lahore">
                                   Asthma Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/asthma/islamabad">
                                   Asthma Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/asthma/karachi">
                                    Asthma Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/asthma">
                                    Asthma Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block 
                        text-center">
                      <a href="/diseases" 
                      class="d-inline-block book-rounded bg-white text-blue btn-view mt-lg-0 mb-lg-0 mt-3 mb-2 underline text_13">View All
                      </a>
                    </div>
                    <div class="white-border w-100 d-inline-block mb-2"></div>
                      </div>
                      <div class="col-lg-4">
                        <div class="w-100 d-inline-block">
                          <span class="text_15 text-white">Find by Surgeries</span>
                        </div>
                        <ul class="w-100 d-inline-block mt-1">
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="javascript:void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/open-heart.svg'" 
                              alt="Open Heart Surgery">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Open Heart Surgery
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/lahore/bypass-surgery">
                                    Open Heart Surgery in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/islamabad/bypass-surgery">
                                    Open Heart Surgery in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="'/surgeries/karachi/bypass-surgery">
                                    Open Heart Surgery in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    Open Heart Surgery in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/mri" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/mri.svg'" 
                              alt="MRI">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">MRI
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/lahore/mri">
                                    MRI in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/islamabad/mri">
                                    MRI in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/karachi/mri">
                                    MRI in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    MRI in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/c-section" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/c-section.svg'" 
                              alt="C-Section">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">C-Section
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/lahore/c-section">
                                    C-Section in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/Islamabad/c-section">
                                    C-Section in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/Karachi/c-section">
                                    C-Section in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    C-Section in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/chemotherapy" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/chemotherapy.svg'" 
                              alt="chemotherapy">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Chemotherapy
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/Lahore/Chemotherapy">
                                    Chemotherapy in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/Islamabad/Chemotherapy">
                                    Chemotherapy in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/Karachi/Chemotherapy">
                                    Chemotherapy in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    Chemotherapy in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/Hair-Transplant" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/hair-transpllant.svg'" 
                              alt="hair-transplant">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Hair Transplant
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/lahore/Hair-Transplant">
                                    Hair Transplant in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/islamabad/Hair-Transplant">
                                    Hair Transplant in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/karachi/Hair-Transplant">
                                    Hair Transplant in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    Hair Transplant in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/kidney-transplant" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/kidney-transplant.svg'" 
                              alt="kidney-transplant">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Kidney Transplant
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/lahore/kidney-transplant">
                                    Kidney Transplant in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/islamabad/kidney-transplant">
                                    Kidney Transplant in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/karachi/kidney-transplant">
                                    Kidney Transplant in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    Kidney Transplant in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/Braces" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/braces.svg'" 
                              alt="braces">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Braces
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/lahore/braces-price-in-pakistan">
                                    Braces in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/Islamabad/braces-price-in-pakistan">
                                    Braces in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/karachi/braces-price-in-pakistan">
                                    Braces in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    Braces in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/laser-hair-removal" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/laser-hair-removal.svg'" 
                              alt="laser-hair-removal">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Laser Hair Removal
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/lahore/laser-hair-removal">
                                    Laser Hair Removal in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/islamabad/laser-hair-removal">
                                    Laser Hair Removal in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/karachi/laser-hair-removal">
                                    Laser Hair Removal in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    Laser Hair Removal in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block 
                        text-center">
                      <a href="/surgeries" 
                      class="d-inline-block book-rounded bg-white text-blue btn-view mt-lg-0 mb-2 mb-lg-0 mt-3 underline text_13">View All
                      </a>
                    </div>
                    <div class="w-100 d-inline-block white-border mb-2"></div>
                      </div>
                </div>
                </li>
                <li class="nav-item dropdown hospital_list d-none d-lg-inline-block">
                  <a class="nav-link dropdown-toggle d-inline-block" href="#" id="hospitalsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hospitals</a>
                  <div class="dropdown-menu mega-menu box_radius box_shadow hospitals_dropdown" aria-labelledby="hospitalsDropdown">
                    <!-- <a class="position-absolute hospital-triangle-image" 
                    href="javascript:void(0)">
                      <img src="/images/triangle-image.png" 
                      alt="pictire">
                    </a> -->
                    <div class="arrow-up"></div>
                    <div class="row">
                      <div v-for="(hospital,index) in hospitals_cities" class="col-3">
                        <div class="w-100 d-inline-block">
                          <span class="text_14 text-blue 
                          font-weight-bold">Hospitals in {{hospital[0].location.title}}
                          </span>
                        </div>
                        <ul v-for="(hosp, index) in hospital" class="w-100 d-inline-block mt-1">
                          <li class="w-100 d-inline-block mb-1 zoom-text-hospital">
                            <a class="d-inline-block w-100 text-truncate text_13" 
                            :href="'/hospitals/'+hosp.location.slug+'/'+hosp.slug">
                              {{hosp.first_name+' '+hosp.last_name}}
                            </a>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block">
                          <a :href="'/hospitals/'+hospital[0].location.slug" 
                          class="d-inline-block book-rounded bg-green text-white btn-view mt-lg-0 mb-3 mb-lg-0 mt-3 text_12">View All
                          </a>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="w-100 d-inline-block">
                          <span class="text_14 text-blue 
                          font-weight-bold">Hospitals in Pakistan
                          </span>
                        </div>
                        <ul v-for="(hospital, index) in hospitalss" class="w-100 d-inline-block mt-1">
                          <li class="w-100 d-inline-block mb-1 zoom-text-hospital">
                            <a class="d-inline-block w-100 text-truncate text_13" 
                            :href="'/hospitals/'+hospital.location.slug+'/'+hospital.slug">
                              {{hospital.first_name+' '+hospital.last_name}}
                            </a>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block">
                          <a href="/hospitals" 
                          class="d-inline-block book-rounded bg-green text-white btn-view mt-lg-0 mb-3 mb-lg-0 mt-3 text_12">View All
                          </a>
                        </div>
                      </div>
                    </div>
                    <!-- <a v-for="(city,index) in areas" v-if="index < 6"v-bind:href="'/hospitals/'+ city.slug" class="allergy_services font-weight-bold d-table float-left mb-3 text-xs-center text-sm-center text-md-center disease_img_main">
                      <span class="disease_name d-table-cell align-middle mt-xs-2 mt-sm-2 mt-md-2 text-left">Hospitals in {{ city.title }} 
                      </span>
                      <span :class="colors[index]" class="  h_60 w_60px rounded-circle text-center pt-1 d-flex dropdownInner_img">
                        <v-lazy-image v-if="city.flag" class="w-70" :src="'/uploads/locations/'+city.flag" :alt="city.title" :name="city.title"/>
                        <v-lazy-image v-else class="w-70" :src="'/uploads/locations/default/location.svg'" :alt="city.title" :name="city.title"/>
                      </span>
                    </a> -->
                    <!-- <div class="w-100 d-inline-block 
                    text-center">
                      <a href="/hospitals" class="d-inline-block rounded-pill bg-green text-white p-2 btn_padding mt-lg-0 mb-3 mb-lg-0 mt-3">View All Hospitals
                        <i aria-hidden="true" class="fa fa-arrow-right ml-2"></i>
                      </a>
                    </div> -->
                  </div>
                </li>
                <li class="d-block d-lg-none hospital-speciality-list 
                position-relative">
                  <a href="javascript:void(0)" 
                  class="nav-link text-white">Hospitals
                  <!-- data-toggle="modal" data-target="#hospital_menu" -->
                </a>
                  <div class="w-100 d-inline-block hospital-speciality-list-menu">
                    <div class="row">
                      <div v-for="(hospital,index) in hospitals_cities" class="col-3 
                      col-12">
                        <div class="w-100 d-inline-block">
                          <span class="text_15 text-white 
                          mt-2">Hospital in {{hospital[0].location.title}}
                          </span>
                        </div>
                        <ul v-for="(hosp, index) in hospital" class="w-100 d-inline-block mt-1">
                          <li class="w-100 d-inline-block mb-1">
                            <a class="d-inline-block w-100 text-truncate text_13 text-white" 
                            :href="'/hospitals/'+hosp.location.slug+'/'+hosp.slug">
                              {{hosp.first_name+' '+hosp.last_name}}
                            </a>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block">
                          <a :href="'/hospitals/'+hospital[0].location.slug" 
                          class="d-inline-block book-rounded bg-white text-blue btn-view mt-lg-0 mb-2 mb-lg-0 mt-3 underline text_13">View All
                          </a>
                        </div>
                        <div class="w-100 d-inline-block white-border mb-2"></div>
                      </div>
                      <div class="col-3 col-12">
                        <div class="w-100 d-inline-block">
                          <span class="text_15 text-white">Hospital in Pakistan
                          </span>
                        </div>
                        <ul v-for="(hospital, index) in hospitalss" class="w-100 d-inline-block mt-1">
                          <li class="w-100 d-inline-block mb-1">
                            <a class="d-inline-block w-100 text-truncate text-white" 
                            :href="'/hospitals/'+hospital.location.slug+'/'+hospital.slug">
                              {{hospital.first_name+' '+hospital.last_name}}
                            </a>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block">
                          <a href="/hospitals" 
                          class="d-inline-block book-rounded bg-white text-blue btn-view mt-lg-0 mb-2 mb-lg-0 mt-3 underline text_13">View All
                          </a>
                        </div>
                        <div class="w-100 d-inline-block white-border mb-2"></div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown lab_list d-none d-lg-inline-block">
                  <a class="nav-link dropdown-toggle d-inline-block" href="#" id="labDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Labs</a>
                  <div class="dropdown-menu mega-menu box_radius box_shadow hospitals_dropdown" aria-labelledby="hospitalsDropdown">
                    <!-- <a class="position-absolute lab-triangle-image" 
                    href="javascript:void(0)">
                      <img src="/images/triangle-image.png" 
                      alt="pictire">
                    </a> -->
                    <div class="row">
                      <div class="col-4">
                        <div class="w-100 d-inline-block mb-2">
                            <span class="text_14 text-blue font-weight-bold">Find by Cities
                          </span>
                        </div>
                        <div class="w-100 d-inline-block">
                           <a v-for="(city,index) in areas" v-if="index < 6" :href="'/labs/'+ city.slug" class="allergy_services font-weight-bold d-table float-left mb-14 text-xs-center text-sm-center text-md-center disease_img_main w-100 d-inline-block text_black">
                        <span class="disease_name d-table-cell align-middle mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 font-weight-normal">Labs in {{ city.title }} 
                        </span>
                        <!-- <span :class="colors[index]" class="  h_60 w_60px rounded-circle text-center pt-1 d-flex dropdownInner_img">
                          <v-lazy-image v-if="city.flag" class="w-70" :src="'/uploads/locations/'+city.flag" :alt="city.title" :name="city.title"/>
                          <v-lazy-image v-else class="w-70" :src="'/uploads/locations/default/location.svg'" :alt="city.title" :name="city.title"/>
                        </span> -->
                      </a>
                        </div>
                        <div class="w-100 d-inline-block">
                          <a href="/find-a-lab-near-you" 
                          class="d-inline-block book-rounded bg-green text-white btn-view mt-lg-0 mb-3 mb-lg-0 mt-3 text_12">View All
                          </a>
                        </div>
                      </div>
                      <div class="col-5 p-0">
                        <div class="w-100 d-inline-block mb-2">
                            <span class="text_14 text-blue font-weight-bold">Popular Labs
                          </span>
                        </div>
                        <div class="w-100 d-inline-block">
                            <div class="discount_labs_tests mb-1">
                      <!-- <label>Discount Labs</label> -->
                        <!-- <a href="/book-a-lab-test" class="allergy_services font-weight-bold d-table float-left mb-3 text-xs-center text-sm-center text-md-center disease_img_main">
                          <span class="disease_name d-table-cell align-middle mt-xs-2 mt-sm-2 mt-md-2 text-left">Book A Test </span>
                          <span  class="emergency_circle h_60 w_60px rounded-circle text-center pt-1 d-flex dropdownInner_img">
                            <v-lazy-image  class="w-70" src="/images/book_a_test.png" alt="default" name="default"/>
                          </span>
                        </a> -->
                        <a v-for="(user,index) in laboratorys" v-if="index < 6" :href="'/lab/'+user.location.slug+'/'+user.slug" class="allergy_services d-table float-left mb-2 text-xs-center text-sm-center text-md-center disease_img_main w-100 d-inline-block position-relative">
                          <span :class="colors[index]" class="  h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img mr-2 speciality-box">
                            <v-lazy-image v-if="user.profile.avatar" :src="basePath+'/uploads/users/'+user.id+'/medium-'+user.profile.avatar" :alt="user.first_name+' '+user.last_name" :name="user.first_name+' '+user.last_name" style="width: 58px;" class="rounded-circle"/>
                            <v-lazy-image v-else class="w-70" :src="basePath+'/uploads/locations/default/lab.svg'" :alt="user.first_name" :name="user.first_name"/>
                          </span>
                          <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left discount-list margin-2 w-75 text_13">
                            {{user.first_name+' '+user.last_name}} 
                            <span class="d-inline-block book-rounded bg-red text-white text_12 discount-padding" 
                            v-if="user.user_discount_percentage && user.user_discount_percentage != ' '">{{user.user_discount_percentage}}% OFF
                          </span> 
                          <!-- <div v-if="user.user_discount_percentage && user.user_discount_percentage != ' '" class="d-inline-block bg-blue discount-list-menu position-absolute text-center">
                              <a class="bg-blue d-inline-block text_12 text-center book-rounded text-white underline" 
                              href="javascript:void(0)">
                                Get a Disscount
                              </a>
                            </div> -->
                        </span>
                        </a>
                    </div>
                        </div>
                        <div class="w-100 d-inline-block">
                          <a href="/find-a-lab-near-you" 
                          class="d-inline-block book-rounded bg-green text-white btn-view mt-lg-0 mb-3 mb-lg-0 mt-3 text_12">View All
                          </a>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="w-100 d-inline-block emergency-consult book-rounded pt-0 pb-2 pl-2 pr-2">
                          <div class="w-100 d-inline-block text-center emergency-consult-image">
                            <img :src="basePath+'/images/lab-test-image.png'" 
                            alt="pictire">
                          </div>
                          <div class="w-100 d-inline-block 
                          text-center mt-2">
                            <p class="text-blue font-weight-bold text_16 mt-1">BOOK A TEST</p>
                          </div>
                          <div class="w-100 d-inline-block text-center consult-btn mt-2 mb-1">
                            <a href="/book-a-lab-test" 
                            class="d-inline-block book-rounded bg-red text-white text_14 mt-lg-0 mb-3 mb-lg-0 mt-3">Book Now
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row mt-3">
                      <div class="col-12">
                        <div class="w-85 w-xs-100 w-sm-100 w-md-100 d-block m-auto lab-test-btn">
                          <a href="javascript:void(0)" 
                          class="d-inline-block book-rounded text-blue mt-lg-0 mb-3 mb-lg-0 mt-3 underline text_12 mr-2">
                          Get online Test Reports
                          </a>
                          <a href="javascript:void(0)" 
                          class="d-inline-block book-rounded text-blue mt-lg-0 mb-3 mb-lg-0 mt-3 underline text_12 mr-2">
                          Book Home Sampling
                          </a>
                          <a href="javascript:void(0)" 
                          class="d-inline-block book-rounded text-blue mt-lg-0 mb-3 mb-lg-0 mt-3 underline text_12 mr-2">
                          Test Prices Comparison
                          </a>
                          <a href="javascript:void(0)" 
                          class="d-inline-block book-rounded text-blue mt-lg-0 mb-3 mb-lg-0 mt-3 underline text_12">
                          Get Discounts Codes for Walk-In
                          </a>
                        </div>
                      </div>
                    </div> -->
                       <!-- <div class="w-100 d-inline-block text-center">
                        <a href="/find-a-lab-near-you" class="d-inline-block rounded-pill bg-green text-white p-2 btn_padding mt-lg-0 mb-3 mb-lg-0 mt-3">View All Labs
                          <i aria-hidden="true" class="fa fa-arrow-right ml-2"></i>
                        </a>
                      </div> -->
                    </div>
                </li>
                <li class="d-block d-lg-none position-relative labs-list">
                  <a href="#" class="nav-link text-white">Labs
                    <!-- data-toggle="modal" data-target="#labs_menu" -->
                  </a>
                  <div class="w-100 d-inline-block labs-list-menu">
                    <div class="row">
                      <div class="col-xl-4 col-12">
                        <div class="w-100 d-inline-block">
                          <span class="text_15 text-white">
                            Find by Cities
                          </span>
                        </div>
                        <div class="w-100 d-inline-block">
                           <a v-for="(city,index) in areas" v-if="index < 6" :href="'/labs/'+ city.slug" class="allergy_services d-table float-left mb-2 text-xs-center text-sm-center text-md-center disease_img_main w-100 d-inline-block text-white">
                        <span class="disease_name d-table-cell align-middle mt-xs-2 mt-sm-2 mt-md-2 text-left">Lab in {{ city.title }} 
                        </span>
                      </a>
                        </div>
                        <div class="w-100 d-inline-block">
                          <a href="/find-a-lab-near-you" 
                          class="d-inline-block book-rounded bg-white text-blue btn-view mt-lg-0 mb-2 mb-lg-0 mt-3 underline text_13">View All
                          </a>
                        </div>
                        <div class="w-100 d-inline-block white-border mb-2"></div>
                      </div>
                      <div class="col-xl-4 col-12">
                        <div class="w-100 d-inline-block">
                          <span class="text_15 text-white">
                            Popular Labs
                          </span>
                        </div>
                        <div class="w-100 d-inline-block">
                            <div class="border-0 discount_labs_tests">
                        <a v-for="(user,index) in laboratorys" v-if="index < 6" :href="'/lab/'+user.location.slug+'/'+user.slug" class="allergy_services d-table float-left mb-2 text-xs-center text-sm-center text-md-center disease_img_main w-100 d-inline-block position-relative">
                          <span :class="colors[index]" class="  h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img mr-2 speciality-box">
                            <v-lazy-image v-if="user.profile.avatar" :src="basePath+'/uploads/users/'+user.id+'/medium-'+user.profile.avatar" :alt="user.first_name+' '+user.last_name" :name="user.first_name+' '+user.last_name" style="width: 58px;" class="rounded-circle"/>
                            <v-lazy-image v-else class="w-70" :src="basePath+'/uploads/locations/default/lab.svg'" :alt="user.first_name" :name="user.first_name"/>
                          </span>
                          <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left discount-list mt-xl-0 w-75 text-white">
                            {{user.first_name+' '+user.last_name}} 
                            <span class="d-inline-block book-rounded bg-red text-white text_14 discount-padding" 
                            v-if="user.user_discount_percentage && user.user_discount_percentage != ' '">{{user.user_discount_percentage}}% OFF
                          </span> 
                          <!-- <div v-if="user.user_discount_percentage && user.user_discount_percentage != ' '" class="d-inline-block bg-blue discount-list-menu position-absolute text-center">
                              <a class="bg-white d-inline-block text_13 text-center book-rounded text-blue underline" 
                              href="javascript:void(0)">
                                Get a Disscount
                              </a>
                            </div> -->
                        </span>
                        </a>
                    </div>
                        </div>
                        <div class="w-100 d-inline-block 
                        text-center">
                          <a href="/find-a-lab-near-you" 
                          class="d-inline-block book-rounded bg-white text-blue btn-view mt-lg-0 mb-2 mb-lg-0 mt-0 underline text_13">View All
                          </a>
                        </div>
                        <div class="w-100 d-inline-block white-border"></div>
                      </div>
                      <div class="col-xl-4 col-12">
                        <div class="w-100 d-inline-block emergency-consult book-rounded pt-0 pb-2 pl-2 pr-2 border-white mt-3">
                          <div class="w-100 d-inline-block 
                          text-center mt-3">
                            <p class="text-white font-weight-bold text_16 mt-1">BOOK A TEST</p>
                          </div>
                          <div class="w-100 d-inline-block text-center consult-btn mt-2 mb-1">
                            <a href="/book-a-lab-test" 
                            class="d-inline-block book-rounded bg-red text-white text_14 mt-lg-0 mb-3 mb-lg-0 mt-3">Book Now
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown services_list d-none d-lg-inline-block" v-if="hide_show === 'true'">
                  <a class="nav-link dropdown-toggle d-inline-block" href="#" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
                  <div class="dropdown-menu mega-menu box_radius box_shadow services_dropdown" aria-labelledby="hospitalsDropdown">
                    <!-- <a class="position-absolute triangle-image" 
                    href="javascript:void(0)">
                      <img src="/images/triangle-image.png" 
                      alt="pictire">
                    </a> -->
                    <div class="arrow-up"></div>
                    <a  v-bind:href="service.subtitle" v-for="(service,index) in topservices" class="allergy_services d-table float-left mb-2 mb-xs-5 mr-1 mr-xs-1 mr-sm-2 mr-md-2 text-center disease_img_main">
                      <span :class="colors[index]" class="h_25 w_25px rounded-circle text-center pt-1 d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                         <v-lazy-image :src="basePath+'/uploads/settings/home/'+ service.tab_img":alt="service.title" :name="service.title" />
                      </span>
                      <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75">{{service.title}} </span>
                    </a>
                  </div>
                </li>
                <li id="call_now" class="nav-item header_margin d-none d-lg-block zoom-text-number">
                  <a href="tel:0345-0435621" class="nav-link rounded-pill book-border text-blue d-inline-block"><i class="fas fa-phone fa-sm mr-2" aria-hidden="true"></i> 0345-0435621 
                  </a>
                </li>
                <li class="d-block d-lg-none position-relative services-list">
                  <a href="javascript:void(0)" class="nav-link text-white">Services
                    <!-- data-toggle="modal" data-target="#services_menu" -->
                  </a>
                  <div class="w-100 d-inline-block services-list-menu">
                    <a v-bind:href="service.subtitle" v-for="(service,index) in topservices" class="allergy_services d-table float-left mb-2 mb-xs-5 mr-1 mr-xs-1 mr-sm-2 mr-md-2 text-center disease_img_main services-images">
                      <span :class="colors[index]" class="h_25 w_25px rounded-circle text-center pt-1 d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                         <v-lazy-image :src="basePath+'/uploads/settings/home/'+ service.tab_img":alt="service.title" :name="service.title" />
                      </span>
                      <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">{{service.title}} </span>
                    </a>
                  </div>
                </li>
                <ul v-if="logged_user.length !== undefined" class="d-none d-lg-inline-block pt-1 pl-4">
                  <li class="nav-item header_margin position-relative header_cstm_border mr-0 float-left">
                    <a class="nav-link applink pl-0 service-text" 
                    href="/login">Login </a>
                  </li>
                  <li class="nav-item header_margin float-left mr-3">
                    <a class="nav-link applink pr-0 service-text" 
                    href=/register> Register</a>
                  </li>
                </ul>
                <ul class="d-lg-none d-none show-cart lab-show-cart 
                pl-1">
                  <li class="nav-item header_margin float-right m-0">
                    <a @click="showdropdownLab()" class="text_black text-center d-inline-block shoping-cart-btn position-relative" 
                    href="javascript:void(0)">
                    <sup class="mt-2 text_15">
                      <span id="cart-item" class="position-absolute">
                        0
                      </span>
                    </sup>
                      <span class="w-100 d-inline-block mt-2 text_black">
                        <i class="fa fa-shopping-cart w-xs-100 
                        float-left" aria-hidden="true" style="font-size:24px;"></i>
                    </span>
                    </a>
                  </li>
                </ul>
                <ul v-if="showCart" class="d-lg-block d-none show-cart pl-1">
                  <li class="nav-item header_margin float-right m-0">
                    <a @click="showcartdropdown()" class="text_black text-center d-inline-block shoping-cart-btn position-relative" 
                    href="javascript:void(0)">
                    <sup class="mt-2 text_15">
                      <span id="cart-item" class="position-absolute knockdoc_btn_bg">
                        0
                      </span>
                    </sup>
                      <span class="w-100 d-inline-block mt-2">
                        <i class="fa fa-shopping-cart w-xs-100 
                        float-left" aria-hidden="true" style="font-size:24px;"></i>
                    </span>
                    </a>
                  </li>
                </ul>
                <li v-if="logged_user.length === undefined" class="d-none d-lg-block position-relative w-20 mr-0 usersInfo">
                  <div class="dropdown header_margin">
                    <div class="d-inline-block user_dropdown_main float-right">
                      <a class="nav-link float-left pl-0 user_name service-text" href="javascript:void(0)">{{logged_user.first_name}}</a>
                      <a class="float-left" href="javascript:void(0)">
                        <v-lazy-image v-if="logged_user.profile.avatar !== null" class="h_40 w-40px border-1 border border-white rounded-circle d-flex" :src="basePath+'/uploads/users/'+logged_user.id+'/'+logged_user.profile.avatar" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name"/>
                        <v-lazy-image v-else-if="logged_user.roles[0].name === 'doctor'" class="h_40 w_40px border-1 border border-white rounded-circle d-flex" :src="basePath+'/uploads/users/default/doctor.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name"/>
                        <v-lazy-image v-else-if="logged_user.roles[0].name === 'hospital'" :src="basePath+'/uploads/users/default/hospital.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name" class="h_40 w_40px border-1 border border-white rounded-circle d-flex"/>
                        <v-lazy-image v-else-if="logged_user.roles[0].name === 'patient'" :src="basePath+'/uploads/users/default/patient.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name" class="h_40 w_40px border-1 border border-white rounded-circle d-flex"/>
                        <v-lazy-image v-else="logged_user.roles[0].name === 'laboratory'" :src="basePath+'/uploads/users/default/lab.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name" class="h_40 w_40px border-1 border border-white rounded-circle d-flex"/>
                      </a>
                      <div class="dropdown-menu user_dropdown_list w-20 box_shadow box_radius text_12" aria-labelledby="dropdownMenuButton">
                        <a class="position-absolute triangle-image" 
                        href="javascript:void(0)">
                      <img :src="basePath+'/images/triangle-image.png'" 
                      alt="pictire">
                    </a>
                        <a class="dropdown-item service-text" 
                        :href="'/'+logged_user.roles[0].name+'/dashboard'" :src="'/'+logged_user.roles[0].name+'/dashboard'">Dashboard</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item service-text" href="/doctors">Book appointment</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item service-text" 
                        :href="'/'+logged_user.roles[0].name+'/appointments'">My appointment</a>
                         <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item service-text" 
                        :href="'/'+logged_user.roles[0].name+'/dashboard#wish-list'">Wish list</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item service-text" 
                        @click="logout()"> Logout</a>
                      </div>
                    </div>
                  </div>
                </li>
                <div data-v-6c102e1e="" role="separator" class="dropdown-divider d-inline-block w-100 custom_divider d-block d-lg-none"></div>
              </ul>
              <!-- <ul class="top_menu mb-2 mt-3 d-block d-lg-none">
                <li class="nav-link p-0 mb-4">
                  <a href="/practice-as-doctor" class="nav-item text_13 text-yellow">For Doctors</a>
                </li>
                <li class="nav-link p-0 mb-4">
                  <a href="/for-hospital" class="nav-item text_13 text-yellow">For Hospital and Clinics</a>
                </li>
                <li class="nav-link p-0 mb-4">
                  <a href="/for-lab" class="nav-item text_13 text-yellow">For Lab</a>
                </li>
                <li class="nav-link p-0 mb-4 mobile_more_list more_list dropdown float-left">
                    <a href="javascript:void(0)" class="nav-item text-white text_13" id="moreDropdown">More</a>
                    <div class="dropdown-menu text_12 box_shadow box_radius more_submenu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="/doctors">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
              </ul> -->
              <ul class="about-contact-section float-left w-100 d-lg-none d-block">
                <!-- <li class="float-left text_13 mr-3 w-xs-100 w-sm-100 w-md-100 mb-4">
                <a href="/products" class="text-yellow">Products
                </a>
              </li>
              <li class="float-left text_13 mr-3 w-xs-100 w-sm-100 w-md-100 mb-4">
                <a href="/brands-and-offers" class="text-yellow">Brands & Offers</a>
              </li> -->
              <li class="nav-item header_margin d-block 
              d-lg-none mt-3" id="call_now">
              <p class="mb-0 text-white text_13 font-weight-bold">
                Helpline
              </p>
                  <a class="nav-link rounded-pill text-white border-white p-0 d-inline-block cell-phone" 
                  :href="'tel:'+number"><i class="fas fa-phone fa-sm mr-2">
                  </i> {{number}} 
                  </a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
      <div id="labdrop" class="bg-white box-shadow position-absolute dropdown-add-to-cart-lab">
        <div class="w-100 d-inline-block p-2">
          <div class="sign-modal-heading w-100 d-inline-block">
            <h5 class="text-fee font-weight-bold text_14 float-left">
               <span class="text_black font-weight-bold">
                 Lab Test
               </span>
            </h5>
            <a class="text_black d-inline-block float-right text_18" 
            href="javascript:void(0)" @click="crossiconlab()">
                <i class="fa fa-times float-left" aria-hidden="true"></i>
            </a>
         </div>
         <div class="row mb-3" >
           <div class="col-3">
             <div class="w-100 d-inline-block lab-cart-image">
               <img :src="basePath+'/images/medium-chughtai-lab-lahore.webp'">
             </div>
           </div>
            <div class="col-9 pl-0">
              <div class="w-100 d-inline-block lab-cart-content">
                <span class="font-weight-bold text_13 text_black">
                 Chughtai Lab
                </span>
                <span class="font-weight-bold text_13 text_black float-right">
                  Rs:
                  <strike class="text-red">
                    <span class="text_black">232</span>
                  </strike>
                   - 320
                </span>
                <p class="text_13 text_black mt-2">
                  <span>
                    Complete Blood Count (CBC) (Blood Test) at Chughtai Lab
                  </span>
                  <a class="bg-blue book-rounded float-right d-inline-block mt-2" href="javascript:void(0)" 
                  style="padding: 6px 7px;">
                    <img :src="basePath+'/images/shoping-cross-icon.svg'" style="height:18px;">
                  </a>
                </p>
              </div>
            </div>
         </div>
         <div class="row mb-3" >
           <div class="col-3">
             <div class="w-100 d-inline-block lab-cart-image">
               <img :src="basePath+'/images/medium-chughtai-lab-lahore.webp'">
             </div>
           </div>
            <div class="col-9 pl-0">
              <div class="w-100 d-inline-block lab-cart-content">
                <span class="font-weight-bold text_13 text_black">
                 Chughtai Lab
                </span>
                <span class="font-weight-bold text_13 text_black float-right">
                  Rs:
                  <strike class="text-red">
                    <span class="text_black">232</span>
                  </strike>
                   - 320
                </span>
                <p class="text_13 text_black mt-2">
                  <span>
                    Complete Blood Count (CBC) (Blood Test) at Chughtai Lab
                  </span>
                  <a class="bg-blue book-rounded float-right d-inline-block mt-2" href="javascript:void(0)" 
                  style="padding: 6px 7px;">
                    <img :src="basePath+'/images/shoping-cross-icon.svg'" style="height:18px;">
                  </a>
                </p>
              </div>
            </div>
         </div>
        </div>
      </div>
      <div id="cartdrop" class="dropdown-add-to-cart bg-white box_shadow position-absolute">
                     <div class="w-100 d-inline-block p-2">
         <div class="sign-modal-heading w-100 d-inline-block">
            <a class="text_black d-inline-block float-right text_24" 
            href="javascript:void(0)" @click="crossicon()">
                <i class="fa fa-times" aria-hidden="true"></i>
            </a>
            <h5 class="text-fee font-weight-bold border-bottom pb-3">Cart
               <span class="color-date font-weight-normal">({{cartItem.length}} item)</span>
            </h5>
         </div>
         <div class="scroll-cart-drop-header w-100 d-inline-block">
         <div class="col-12 border-bottom pb-2" v-for="(item,index) in cartItem" :key="index">
         <div class="row mt-3">
            <div class="col-4">
               <div class="cart-modal-image w-100 d-inline-block">
                  <v-lazy-image :src="basePath+'/uploads/products/'+item.thumbnail" fluid alt="picture"/>
               </div>
            </div>
            <div class="col-8">
              <div class="row">
                <div class="col-9">
                  <div class="image-text w-100 d-inline-block">
                    <p class="text-fee text-size-15 mb-1">
                      {{item.name}}
                    </p>
                  </div>
                </div>
                <div class="col-3">
                  <div class="remove-text w-100 d-inline-block">
                    <a  @click="removeCartItem(index)" 
                      class="color-date border-bottom font-weight-bold text_14" href="javascript:void(0)">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                  </div>
                </div>
              </div>
               <div class="row mt-3">
                  <div class="col-12">
                     <label class="w-100 d-inline-block font-weight-bold text-fee mb-0 text-size-14 pl-3">
                        QTY
                     </label>
                     <div class="discount-input w-70 mb-2 
               position-relative service-bg m-auto d-block box-radius w-xs-100">
               <a href="javascript:void(0)" class="float-left d-inline-block w-30 text-center text-size-22" v-on:click="decrement(index,item.discount_price!=''||item.discount_price!=null?item.discount_price:item.price)" 
                      variant="outline-secondary percentage_Btn"> 
                      <span class="minus-icon"></span> 
                  </a>
                  <div style="display:none">
                     {{updateState}}
                  </div>
                  <vue-numeric class="form-control w-40 float-left text-center border-0 number-input bg-white box-shadow" 
                  v-model="counterVal[index]">
                  </vue-numeric>
                   <a href="javascript:void(0)" class="float-left d-inline-block w-30 text-center mt-1 color-date" v-on:click="increment(index,item.discount_price!=''||item.discount_price!=null?item.discount_price:item.price)" variant="outline-secondary percentage_Btn">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                  </a>
              </div>
                  </div>
                  <div class="col-6">
                     <div class="price w-100 d-inline-block mt-3">
                        <span class="color-date">Rs. {{item.price}}</span>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="price w-100 d-inline-block mt-3">
                        <span class="text-fee">Discount Price: Rs. {{item.discount_price}}</span>
                     </div>
                  </div>
               </div>
            </div>
            </div>
         </div>
        <div class="col-12" v-if="cartItem.length==0">
          <div class="empty-cart-image w-100 d-inline-block text-center">
           <!--  <b-img src="/images/empty-cart.png" fluid-img="picture">
            </b-img> -->
               <img v-lazy="basePath+'/images/empty-cart.png'" fluid-img="picture" />
          </div>
        </div>
       </div>
            <div v-if="cartItem.length>0" class="row">
            <div class="col-6">
               <div class="total-price w-100 d-inline-block mt-3">
                  <span class="text-fee text-size-15">Total
                      <span class="color-date">(Inclusive of VAT)</span>
                   </span>
               </div>
            </div>
            <div class="col-6">
               <div class="total-price w-100 d-inline-block mt-3 text-center">
                  <span class="text-fee font-weight-bold text-size-17">
                      Rs. {{total_cart_amount}}
                  </span>
               </div>
            </div>
         </div>
            <div v-if="cartItem.length>0" class="row">
            <div class="col-12">
               <div class="checkout-btn w-100 d-inline-block mt-3 text-center 
               pb-2">
                  <a class="text-white knockdoc_btn_bg box_radius d-inline-block font-weight-bold w-100 pt-2 pb-2" 
                  href="/product/checkout">
                     Proceed to Checkout
                  </a>
               </div>
            </div>
         </div>
    </div>
      </div>
    </header>
    <div class="modal fade" id="MenuButtonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header border-0 pb-0">
        <button type="button" class="close text-white text_30" data-dismiss="modal" aria-label="Close" style="opacity:1;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-0">
        <div class="w-100 d-inline-block navbar-collapse">
          <div class="w-100 d-inline-block bg-white book-rounded">
            <div class="float-left d-inline-block w-100 product-login" v-if="logged_user.length !== undefined">
              <a href="/login" class="text-blue applink font-weight-bold w-100 d-inline-block" style="padding: 10px 20px 10px 15px;">
                <span>Login</span>
                <span class="float-right">
                  <img :src="basePath+'/images/login-image-icon.svg'" style="height:25px;margin-top: -2px;">
                </span>
              </a>
            </div>
          </div>
               <!-- <span class="text-right text-white w-100 d-inline-block text_25 d-inline-block d-lg-none" data-dismiss="collapse" aria-label="Close">
                <i class="fa fa-times" @click="closeCollapse()" aria-hidden="true"></i>
              </span> -->
              <ul class="navbar-nav mr-auto w-100 position-relative navigation_menu mt-3">
                <!-- <li class="nav-item header_margin d-none d-lg-block" id="appointment_btn">
                  <a class="nav-link rounded-pill knockdoc_head_btn text-white d-inline-block" :href="url">{{btn}} <span class="sr-only">(current)</span></a>
                </li> -->
                <li class="nav-item dropdown doctor_list d-none d-lg-inline-block">
                  <a class="nav-link dropdown-toggle" href="#" 
                  id="doctorsDrodpwon" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Find your Doctor</a>
                  <div class="dropdown-menu mega-menu box_radius box_shadow doctors_dropdown" aria-labelledby="doctorsDrodpwon">
                    <!-- <a class="position-absolute triangle-image" 
                    href="javascript:void(0)">
                      <img src="/images/triangle-image.png" 
                      alt="pictire">
                    </a> -->
                    <div class="arrow-up"></div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="w-100 d-inline-block">
                          <span class="text_14 text-blue font-weight-bold">Find by Specialties
                          </span>
                        </div>
                        <ul class="w-100 d-inline-block mt-1">
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/dermatologist-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[0]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/skin-disease.svg'" alt="dermatologist" name="dermatologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              Dermatologist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/dermatologist-in-lahore">
                                    Dermatologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/dermatologist-in-islamabad">
                                    Dermatologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/dermatologist-in-karachi">
                                    Dermatologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/dermatologist-in-pakistan">
                                    Dermatologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/gynecologist-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[1]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/gynecologist.svg'" alt="gynecologist" name="gynecologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              Gynecologist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/gynecologist-in-lahore">
                                    Gynecologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/gynecologist-in-islamabad">
                                    Gynecologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/gynecologist-in-karachi">
                                    Gynecologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/gynecologist-in-pakistan">
                                    Gynecologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/pediatrician-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[2]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/child-specialist.svg'" alt="pediatrician" name="pediatrician"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              Child Specialist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/pediatrician-in-lahore">
                                    Child Specialist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/pediatrician-in-islamabad">
                                    Child Specialist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/pediatrician-in-karachi">
                                    Child Specialist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/pediatrician-in-pakistan">
                                    Child Specialist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/ent-specialist-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[3]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/ent-specialist.svg'" alt="ent-specialist" name="ent-specialist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              Ent Specialist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/ent-specialist-in-lahore">
                                    Ent Specialist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/ent-specialist-in-islamabad">
                                    Ent Specialist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/ent-specialist-in-karachi">
                                    Ent Specialist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/ent-specialist-in-pakistan">
                                    Ent Specialist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/diabetologist-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[4]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/diabelogist.svg'" alt="diabetologist" name="diabetologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              Diabetologist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diabetologist-in-lahore">
                                    Diabetologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diabetologist-in-islamabad">
                                    Diabetologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diabetologist-in-karachi">
                                    Diabetologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diabetologist-in-pakistan">
                                    Diabetologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/neurologist-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[5]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/neuro.svg'" alt="neurologist" name="neurologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              Neurologist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/neurologist-in-lahore">
                                    Neurologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/neurologist-in-islamabad">
                                    Neurologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/neurologist-in-karachi">
                                    Neurologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/neurologist-in-pakistan">
                                    Neurologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/cardiologist-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[6]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/cardiologist.svg'" alt="cardiologist" name="cardiologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              Cardiologist
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/cardiologist-in-lahore">
                                    Cardiologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/cardiologist-in-islamabad">
                                    Cardiologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/cardiologist-in-karachi">
                                    Cardiologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/cardiologist-in-pakistan">
                                    Cardiologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a href="/general-physician-in-pakistan" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[7]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/general-physician.svg'" alt="general-physician" name="general-physician"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">
                              General Physician
                              <!-- <a class="text-blue text_14 ml-2" href="javascript:void(0)">
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a> -->
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/general-physician-in-lahore">
                                    General Physician in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/general-physician-in-islamabad">
                                    General Physician in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/general-physician-in-karachi">
                                    General Physician in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/general-physician-in-pakistan">
                                    General Physician in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block">
                      <a href="/find-a-doctor-near-you" 
                      class="d-inline-block book-rounded bg-green text-white text_12 btn-view mt-lg-0 mb-3 mb-lg-0 mt-3">View All
                      </a>
                    </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="w-100 d-inline-block">
                          <span class="text_14 text-blue font-weight-bold">Find by Diseases</span>
                        </div>
                        <ul class="w-100 d-inline-block mt-1">
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/diabetes-insipidus" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/diabelogist.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Diabetes
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/diabetes-insipidus/lahore">
                                    Diabetes Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/diabetes-insipidus/islamabad">
                                    Diabetes Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/diabetes-insipidus/karachi">
                                    Diabetes Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/diabetes-insipidus">
                                    Diabetes Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/blood-pressure" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/blood-pressure.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">High Blood Pressure
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute treatment-list-menu">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/blood-pressure/lahore">
                                    High Blood Pressure Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/blood-pressure/islamabad">
                                    High Blood Pressure Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/blood-pressure/karachi">
                                    High Blood Pressure Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/blood-pressure">
                                    High Blood Pressure Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/skin-diseases" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/skin-disease.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Skin Diseases
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute treatment-list-menu">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/skin-diseases/lahore">
                                    Skin Diseases Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/skin-diseases/islamabad">
                                    Skin Diseases Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/skin-diseases/karachi">
                                    Skin Diseases Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/skin-diseases">
                                    Skin Diseases Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/heart-diseases" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/heart-disease.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Heart Diseases
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute treatment-list-menu">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/heart-diseases/lahore">
                                    Heart Diseases Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/heart-diseases/islamabad">
                                    Heart Diseases Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/heart-diseases/karachi">
                                    Heart Diseases Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/heart-diseases">
                                    Heart Diseases Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/pregnancy-obstetrician" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/pregnant.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Pregnancy
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician/lahore">
                                   Pregnancy Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician/islamabad">
                                   Pregnancy Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician/karachi">
                                    Pregnancy Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician">
                                    Pregnancy Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/acne" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/acne.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Acne
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/acne/lahore">
                                   Acne Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/acne/islamabad">
                                   Acne Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/acne/karachi">
                                    Acne Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/acne">
                                    Acne Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/piles" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/piles.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Piles
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/piles/lahore">
                                   Piles Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/piles/islamabad">
                                   Piles Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/piles/karachi">
                                    Piles Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/piles">
                                    Piles Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/diseases/asthma" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/asthma.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Asthma
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/asthma/lahore">
                                   Asthma Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/asthma/islamabad">
                                   Asthma Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/asthma/karachi">
                                    Asthma Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/diseases/asthma">
                                    Asthma Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block">
                      <a href="/diseases" 
                      class="d-inline-block book-rounded bg-green text-white btn-view mt-lg-0 mb-3 mb-lg-0 mt-3 text_12">View All
                      </a>
                    </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="w-100 d-inline-block">
                          <span class="text_14 text-blue font-weight-bold">Find by Surgeries</span>
                        </div>
                        <ul class="w-100 d-inline-block mt-1">
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/bypass-surgery" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/open-heart.svg'" 
                              alt="Open Heart Surgery">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Open Heart Surgery
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/lahore/bypass-surgery">
                                    Open Heart Surgery in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/islamabad/bypass-surgery">
                                    Open Heart Surgery in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="'/surgeries/karachi/bypass-surgery">
                                    Open Heart Surgery in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    Open Heart Surgery in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/mri" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/mri.svg'" 
                              alt="MRI">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">MRI
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/lahore/mri">
                                    MRI in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/islamabad/mri">
                                    MRI in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/karachi/mri">
                                    MRI in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    MRI in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="javascript::void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/c-section.svg'" 
                              alt="C-Section">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">C-Section
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/Lahore/C-Section">
                                    C-Section in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/Islamabad/C-Section">
                                    C-Section in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/Karachi/C-Section">
                                    C-Section in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    C-Section in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="javascript::void(0)" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/chemotherapy.svg'" 
                              alt="chemotherapy">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Chemotherapy
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/Lahore/Chemotherapy">
                                    Chemotherapy in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/Islamabad/Chemotherapy">
                                    Chemotherapy in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/Karachi/Chemotherapy">
                                    Chemotherapy in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    Chemotherapy in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/Hair-Transplant" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/hair-transpllant.svg'" 
                              alt="hair-transplant">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Hair Transplant
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/lahore/Hair-Transplant">
                                    Hair Transplant in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/islamabad/Hair-Transplant">
                                    Hair Transplant in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/karachi/Hair-Transplant">
                                    Hair Transplant in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    Hair Transplant in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/kidney-transplant" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/kidney-transplant.svg'" 
                              alt="kidney-transplant">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Kidney Transplant
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/lahore/kidney-transplant">
                                    Kidney Transplant in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/islamabad/kidney-transplant">
                                    Kidney Transplant in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/karachi/kidney-transplant">
                                    Kidney Transplant in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    Kidney Transplant in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/Braces" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/braces.svg'" 
                              alt="braces">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Braces
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/lahore/braces-price-in-pakistan">
                                    Braces in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/islamabad/braces-price-in-pakistan">
                                    Braces in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/karachi/braces-price-in-pakistan">
                                    Braces in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    Braces in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>

                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a href="/surgeries/lahore/laser-hair-removal" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/laser-hair-removal.svg'" 
                              alt="laser-hair-removal">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 margin-2 w-75">Laser Hair Removal
                            </span>
                            </a>
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/lahore/laser-hair-removal">
                                    Laser Hair Removal in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/islamabad/laser-hair-removal">
                                    Laser Hair Removal in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries/karachi/laser-hair-removal">
                                    Laser Hair Removal in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-white text_13 underline" 
                                  href="/surgeries">
                                    Laser Hair Removal in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block">
                      <a href="/surgeries" 
                      class="d-inline-block book-rounded bg-green text-white btn-view mt-lg-0 mb-3 mb-lg-0 mt-3 text_12">View All
                      </a>
                    </div>
                      </div>
                      <!-- <div class="col-lg-3">
                        <div class="w-100 d-inline-block emergency-consult book-rounded p-2">
                          <div class="w-100 d-inline-block text-center emergency-consult-image">
                            <img src="/images/emergency-consult-image.png" 
                            alt="pictire">
                          </div>
                          <div class="w-100 d-inline-block 
                          text-center mt-2">
                            <img src="/images/emergency-icon-image.png" alt="pictire">
                            <p class="text-blue font-weight-bold text_16 mt-1">EMERGENCY</p>
                          </div>
                          <div class="w-100 d-inline-block text-center consult-btn mt-2 mb-1">
                            <a href="javascript:void(0)" 
                            class="d-inline-block book-rounded bg-red text-white text_14 mt-lg-0 mb-3 mb-lg-0 mt-3">Consult Now
                            </a>
                          </div>
                        </div>
                      </div> -->
                    </div>
                  </div>
                </li>
                <li class="d-block d-lg-none w-100 d-inline-block position-relative doctor-speciality-list h_40">
                  <a class="nav-link text-white" data-toggle="collapse" href="#collapseDoctorMain">
                    <span class="float-left">
                      Doctors
                    </span>
                    <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                    </i>
                  </a>
                  <div id="collapseDoctorMain" class="w-100 collapse position-relative">
                  <div class="w-100 d-inline-block doctor-speciality-list-menu">
                  <div class="row">
                    <div class="col-lg-4">
                        <div class="w-100 d-inline-block mt-1 pl-2">
                          <span class="text_15 text-white">Find by Specialties
                          </span>
                        </div>
                        <ul class="w-100 d-inline-block mt-3 pl-3">
                          <li class="w-100 d-inline-block speciality-list cursor position-relative">
                            <a data-toggle="collapse" href="#collapDermatologist" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[0]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/skin-disease.svg'" alt="dermatologist" name="dermatologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              Dermatologist
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapDermatologist" class="w-100 position-absolute collapse">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/dermatologist-in-lahore">
                                    Dermatologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/dermatologist-in-islamabad">
                                    Dermatologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/dermatologist-in-karachi">
                                    Dermatologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/dermatologist-in-pakistan">
                                    Dermatologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                            <a data-toggle="collapse" href="#collapseGynecologist" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[1]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/gynecologist.svg'" alt="gynecologist" name="gynecologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              Gynecologist
                              <i class="fa fa-sort-desc ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseGynecologist" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/gynecologist-in-lahore">
                                    Gynecologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/gynecologist-in-islamabad">
                                    Gynecologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/gynecologist-in-karachi">
                                    Gynecologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/gynecologist-in-pakistan">
                                    Gynecologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                            <a data-toggle="collapse" href="#collapseChildSpecialist" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[2]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/child-specialist.svg'" alt="pediatrician" name="pediatrician"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              Child Specialist
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseChildSpecialist" 
                            class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/pediatrician-in-lahore">
                                    Child Specialist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/pediatrician-in-islamabad">
                                    Child Specialist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/pediatrician-in-karachi">
                                    Child Specialist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/pediatrician-in-pakistan">
                                    Child Specialist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                            <a data-toggle="collapse" href="#collapseEntSpecialist" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[3]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/ent-specialist.svg'" alt="ent-specialist" name="ent-specialist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              Ent Specialist
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseEntSpecialist" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/ent-specialist-in-lahore">
                                    Ent Specialist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/ent-specialist-in-islamabad">
                                    Ent Specialist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/ent-specialist-in-karachi">
                                    Ent Specialist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/ent-specialist-in-pakistan">
                                    Ent Specialist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a data-toggle="collapse" href="#collapseDiabetologist" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[4]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/diabelogist.svg'" alt="diabetologist" name="diabetologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              Diabetologist
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseDiabetologist" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diabetologist-in-lahore">
                                    Diabetologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diabetologist-in-islamabad">
                                    Diabetologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diabetologist-in-karachi">
                                    Diabetologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diabetologist-in-pakistan">
                                    Diabetologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a data-toggle="collapse" href="#collapseNeurologist" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[5]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/neuro.svg'" alt="neurologist" name="neurologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              Neurologist
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseNeurologist" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/neurologist-in-lahore">
                                    Neurologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/neurologist-in-islamabad">
                                    Neurologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/neurologist-in-karachi">
                                    Neurologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/neurologist-in-pakistan">
                                    Neurologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a data-toggle="collapse" href="#collapseCardiologist" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[6]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/cardiologist.svg'" alt="cardiologist" name="cardiologist"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              Cardiologist
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseCardiologist" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/cardiologist-in-lahore">
                                    Cardiologist in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/cardiologist-in-islamabad">
                                    Cardiologist in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/cardiologist-in-karachi">
                                    Cardiologist in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/cardiologist-in-pakistan">
                                    Cardiologist in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                            <a data-toggle="collapse" href="#collapseGeneralPhysician" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span :class="colors[7]" class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box mr-2">
                              <v-lazy-image class="w-70 img-fluid mt-1" :src="basePath+'/images/general-physician.svg'" alt="general-physician" name="general-physician"/>
                              <!-- <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">
                              General Physician
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseGeneralPhysician" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/general-physician-in-lahore">
                                    General Physician in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/general-physician-in-islamabad">
                                    General Physician in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-2 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/general-physician-in-karachi">
                                    General Physician in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/general-physician-in-pakistan">
                                    General Physician in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block 
                        text-center">
                      <a href="/find-a-doctor-near-you" 
                      class="d-inline-block book-rounded bg-white text-blue text_13 btn-view mt-lg-0 mb-2 mb-lg-0 mt-3">View All
                      </a>
                    </div>
                    <div class="white-border w-100 d-inline-block mb-2">
                  </div>
                      </div>
                  </div>
                  <div class="col-lg-4">
                        <div class="w-100 d-inline-block">
                          <span class="text_15 text-white">Find by Diseases</span>
                        </div>
                        <ul class="w-100 d-inline-block mt-3 pl-2">
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                             <a data-toggle="collapse" href="#collapseDiabetes" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/diabelogist.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Diabetes
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseDiabetes" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/diabetes-insipidus/lahore">
                                    Diabetes Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/diabetes-insipidus/islamabad">
                                    Diabetes Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/diabetes-insipidus/karachi">
                                    Diabetes Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/diabetes-insipidus">
                                    Diabetes Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                             <a data-toggle="collapse" href="#collapseBloodPressure" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/blood-pressure.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">High Blood Pressure
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseBloodPressure" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute treatment-list-menu">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/blood-pressure/lahore">
                                    High Blood Pressure Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/blood-pressure/islamabad">
                                    High Blood Pressure Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/blood-pressure/karachi">
                                    High Blood Pressure Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/blood-pressure">
                                    High Blood Pressure Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                             <a data-toggle="collapse" href="#collapseSkinDiseases" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/skin-disease.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Skin Diseases
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseSkinDiseases" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute treatment-list-menu">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/skin-diseases/lahore">
                                    Skin Diseases Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/skin-diseases/islamabad">
                                    Skin Diseases Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/skin-diseases/karachi">
                                    Skin Diseases Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/skin-diseases">
                                    Skin Diseases Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                             <a data-toggle="collapse" href="#collapseHeartDiseases" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/heart-disease.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Heart Diseases
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseHeartDiseases" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute treatment-list-menu">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/heart-diseases/lahore">
                                    Heart Diseases Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/heart-diseases/islamabad">
                                    Heart Diseases Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/heart-diseases/karachi">
                                    Heart Diseases Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/heart-diseases">
                                    Heart Diseases Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                             <a data-toggle="collapse" href="#collapsePregnancy" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/pregnant.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Pregnancy
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapsePregnancy" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician/lahore">
                                   Pregnancy Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician/islamabad">
                                   Pregnancy Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician/karachi">
                                    Pregnancy Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/pregnancy-obstetrician">
                                    Pregnancy Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                             <a data-toggle="collapse" href="#collapseAcne" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/acne.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Acne
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseAcne" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/acne/lahore">
                                   Acne Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/acne/islamabad">
                                   Acne Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/acne/karachi">
                                    Acne Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/acne">
                                    Acne Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                             <a data-toggle="collapse" href="#collapsePiles" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/piles.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Piles
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapsePiles" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/piles/lahore">
                                   Piles Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/piles/islamabad">
                                   Piles Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/piles/karachi">
                                    Piles Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/piles">
                                    Piles Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                             <a data-toggle="collapse" href="#collapseAsthma" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img speciality-box 
                              mr-2">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/asthma.svg'" alt="pictire">
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Asthma
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseAsthma" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/asthma/lahore">
                                   Asthma Treatment In Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/asthma/islamabad">
                                   Asthma Treatment In Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/asthma/karachi">
                                    Asthma Treatment In Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/diseases/asthma">
                                    Asthma Treatment In Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block 
                        text-center">
                      <a href="/diseases" 
                      class="d-inline-block book-rounded bg-white text-blue btn-view mt-lg-0 mb-lg-0 mt-3 mb-2 text_13">View All
                      </a>
                    </div>
                    <div class="white-border w-100 d-inline-block mb-2"></div>
                      </div>
                      <div class="col-lg-4">
                        <div class="w-100 d-inline-block">
                          <span class="text_15 text-white">Find by Surgeries</span>
                        </div>
                        <ul class="w-100 d-inline-block mt-3 pl-2">
                          <li class="w-100 d-inline-block speciality-list position-relative cursor">
                             <a data-toggle="collapse" href="#collapseHeartSurgery" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/open-heart.svg'" 
                              alt="Open Heart Surgery">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Open Heart Surgery
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseHeartSurgery" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/lahore/bypass-surgery">
                                    Open Heart Surgery in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/islamabad/bypass-surgery">
                                    Open Heart Surgery in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="'/surgeries/karachi/bypass-surgery">
                                    Open Heart Surgery in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    Open Heart Surgery in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                             <a data-toggle="collapse" href="#collapseMRI" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/mri.svg'" 
                              alt="MRI">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">MRI
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseMRI" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/lahore/mri">
                                    MRI in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/islamabad/mri">
                                    MRI in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/karachi/mri">
                                    MRI in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    MRI in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                             <a data-toggle="collapse" href="#collapseSection" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/c-section.svg'" 
                              alt="C-Section">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">C-Section
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseSection" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/lahore/c-section">
                                    C-Section in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/Islamabad/c-section">
                                    C-Section in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/karachi/c-section">
                                    C-Section in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    C-Section in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                             <a data-toggle="collapse" href="#collapseChemotherapy" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/chemotherapy.svg'" 
                              alt="chemotherapy">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Chemotherapy
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseChemotherapy" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/lahore/chemotherapy">
                                    Chemotherapy in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/Islamabad/chemotherapy">
                                    Chemotherapy in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/karachi/chemotherapy">
                                    Chemotherapy in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    Chemotherapy in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                             <a data-toggle="collapse" href="#collapseHairTransplant" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/hair-transpllant.svg'" 
                              alt="hair-transplant">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Hair Transplant
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseHairTransplant" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/lahore/Hair-Transplant">
                                    Hair Transplant in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/islamabad/Hair-Transplant">
                                    Hair Transplant in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/karachi/Hair-Transplant">
                                    Hair Transplant in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    Hair Transplant in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                             <a data-toggle="collapse" href="#collapseKidneyTransplant" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/kidney-transplant.svg'" 
                              alt="kidney-transplant">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Kidney Transplant
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseKidneyTransplant" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/lahore/kidney-transplant">
                                    Kidney Transplant in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/islamabad/kidney-transplant">
                                    Kidney Transplant in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="islamabad">
                                    Kidney Transplant in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    Kidney Transplant in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                             <a data-toggle="collapse" href="#collapseBraces" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/braces.svg'" 
                              alt="braces">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Braces
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseBraces" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/lahore/braces-price-in-pakistan">
                                    Braces in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/islamabad/braces-price-in-pakistan">
                                    Braces in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/karachi/braces-price-in-pakistan">
                                    Braces in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    Braces in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                          <li class="w-100 d-inline-block speciality-list position-relative 
                          cursor">
                             <a data-toggle="collapse" href="#collapseHairRemoval" class="allergy_services d-table float-left mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main mb-1 w-100">
                              <span class=" h_25 w_25px rounded-circle text-center d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                              <img class="w-70 img-fluid mt-1" 
                              v-lazy="basePath+'/images/laser-hair-removal.svg'" 
                              alt="laser-hair-removal">
                              <!-- <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" alt="surgery.title" name="surgery.title"> -->
                            </span>
                            <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">Laser Hair Removal
                              <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                              </i>
                            </span>
                            </a>
                            <div id="collapseHairRemoval" class="w-100 collapse position-absolute">
                            <div class="w-100 d-inline-block bg-blue p-2 speciality-list-menu 
                            position-absolute">
                              <ul class="w-100 d-inline-block mb-0 pl-2">
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/lahore/laser-hair-removal">
                                    Laser Hair Removal in Lahore
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/islamabad/laser-hair-removal">
                                    Laser Hair Removal in Islamabad
                                  </a>
                                </li>
                                <li class="float-left w-100 mb-1 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries/karachi/laser-hair-removal">
                                    Laser Hair Removal in Karachi
                                  </a>
                                </li>
                                <li class="float-left w-100 d-inline-block">
                                  <a class="text-blue text_13 underline" 
                                  href="/surgeries">
                                    Laser Hair Removal in Pakistan
                                  </a>
                                </li>
                              </ul>
                            </div>
                            </div>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block 
                        text-center">
                      <a href="/surgeries" 
                      class="d-inline-block book-rounded bg-white text-blue btn-view mt-lg-0 mb-2 mb-lg-0 mt-3 text_13">View All
                      </a>
                    </div>
                    <div class="w-100 d-inline-block white-border mb-2"></div>
                      </div>
                    </div>
                </div>
                </li>
                <li class="nav-item dropdown hospital_list d-none d-lg-inline-block">
                  <a class="nav-link dropdown-toggle d-inline-block" href="#" id="hospitalsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hospitals</a>
                  <div class="dropdown-menu mega-menu box_radius box_shadow hospitals_dropdown" aria-labelledby="hospitalsDropdown">
                    <!-- <a class="position-absolute hospital-triangle-image" 
                    href="javascript:void(0)">
                      <img src="/images/triangle-image.png" 
                      alt="pictire">
                    </a> -->
                    <div class="arrow-up"></div>
                    <div class="row">
                      <div v-for="(hospital,index) in hospitals_cities" class="col-3">
                        <div class="w-100 d-inline-block">
                          <span class="text_14 text-blue 
                          font-weight-bold">Hospitals in {{hospital[0].location.title}}
                          </span>
                        </div>
                        <ul v-for="(hosp, index) in hospital" class="w-100 d-inline-block mt-1">
                          <li class="w-100 d-inline-block mb-1 zoom-text-hospital">
                            <a class="d-inline-block w-100 text-truncate text_13" 
                            :href="'/hospitals/'+hosp.location.slug+'/'+hosp.slug">
                              {{hosp.first_name+' '+hosp.last_name}}
                            </a>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block">
                          <a :href="'/hospitals/'+hospital[0].location.slug" 
                          class="d-inline-block book-rounded bg-green text-white btn-view mt-lg-0 mb-3 mb-lg-0 mt-3 text_12">View All
                          </a>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="w-100 d-inline-block">
                          <span class="text_14 text-blue 
                          font-weight-bold">Hospitals in Pakistan
                          </span>
                        </div>
                        <ul v-for="(hospital, index) in hospitalss" class="w-100 d-inline-block mt-1">
                          <li class="w-100 d-inline-block mb-1 zoom-text-hospital">
                            <a class="d-inline-block w-100 text-truncate text_13" 
                            :href="'/hospitals/'+hospital.location.slug+'/'+hospital.slug">
                              {{hospital.first_name+' '+hospital.last_name}}
                            </a>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block">
                          <a href="/hospitals" 
                          class="d-inline-block book-rounded bg-green text-white btn-view mt-lg-0 mb-3 mb-lg-0 mt-3 text_12">View All
                          </a>
                        </div>
                      </div>
                    </div>
                    <!-- <a v-for="(city,index) in areas" v-if="index < 6"v-bind:href="'/hospitals/'+ city.slug" class="allergy_services font-weight-bold d-table float-left mb-3 text-xs-center text-sm-center text-md-center disease_img_main">
                      <span class="disease_name d-table-cell align-middle mt-xs-2 mt-sm-2 mt-md-2 text-left">Hospitals in {{ city.title }} 
                      </span>
                      <span :class="colors[index]" class="  h_60 w_60px rounded-circle text-center pt-1 d-flex dropdownInner_img">
                        <v-lazy-image v-if="city.flag" class="w-70" :src="'/uploads/locations/'+city.flag" :alt="city.title" :name="city.title"/>
                        <v-lazy-image v-else class="w-70" :src="'/uploads/locations/default/location.svg'" :alt="city.title" :name="city.title"/>
                      </span>
                    </a> -->
                    <!-- <div class="w-100 d-inline-block 
                    text-center">
                      <a href="/hospitals" class="d-inline-block rounded-pill bg-green text-white p-2 btn_padding mt-lg-0 mb-3 mb-lg-0 mt-3">View All Hospitals
                        <i aria-hidden="true" class="fa fa-arrow-right ml-2"></i>
                      </a>
                    </div> -->
                  </div>
                </li>
                <li class="d-block d-lg-none hospital-speciality-list position-relative w-100 d-inline-block h_40">
                  <a class="nav-link text-white" data-toggle="collapse" href="#collapseHospitalMain">
                  <span class="float-left">
                      Hospitals
                  </span>
                  <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true"></i>
                </a>
                <div id="collapseHospitalMain" class="w-100 collapse position-relative">
                  <div class="w-100 d-inline-block hospital-speciality-list-menu">
                    <div class="row">
                      <div v-for="(hospital,index) in hospitals_cities" class="col-3 
                      col-12">
                        <div class="w-100 d-inline-block pl-2 mt-1">
                          <span class="text_15 text-white 
                          mt-2">Hospital in {{hospital[0].location.title}}
                          </span>
                        </div>
                        <ul v-for="(hosp, index) in hospital" class="w-100 d-inline-block mt-1 pl-3 mt-3">
                          <li class="w-100 d-inline-block mb-1">
                            <a class="d-inline-block w-100 text-truncate text_13 text-white" 
                            :href="'/hospitals/'+hosp.location.slug+'/'+hosp.slug">
                              {{hosp.first_name+' '+hosp.last_name}}
                            </a>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block text-center">
                          <a :href="'/hospitals/'+hospital[0].location.slug" 
                          class="d-inline-block book-rounded bg-white text-blue btn-view mt-lg-0 mb-2 mb-lg-0 mt-3 text_13">View All
                          </a>
                        </div>
                        <div class="w-100 d-inline-block white-border mb-2"></div>
                      </div>
                      <div class="col-3 col-12">
                        <div class="w-100 d-inline-block pl-2 mt-1">
                          <span class="text_15 text-white">Hospital in Pakistan
                          </span>
                        </div>
                        <ul v-for="(hospital, index) in hospitalss" class="w-100 d-inline-block mt-3 pl-3">
                          <li class="w-100 d-inline-block mb-1">
                            <a class="d-inline-block w-100 text-truncate text-white" 
                            :href="'/hospitals/'+hospital.location.slug+'/'+hospital.slug">
                              {{hospital.first_name+' '+hospital.last_name}}
                            </a>
                          </li>
                        </ul>
                        <div class="w-100 d-inline-block text-center">
                          <a href="/hospitals" 
                          class="d-inline-block book-rounded bg-white text-blue btn-view mt-lg-0 mb-2 mb-lg-0 mt-3 text_13">View All
                          </a>
                        </div>
                        <div class="w-100 d-inline-block white-border 
                        mb-2"></div>
                      </div>
                    </div>
                  </div>
                </div>
                </li>
                <li class="nav-item dropdown lab_list d-none d-lg-inline-block">
                  <a class="nav-link dropdown-toggle d-inline-block" href="#" id="labDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Labs</a>
                  <div class="dropdown-menu mega-menu box_radius box_shadow hospitals_dropdown" aria-labelledby="hospitalsDropdown">
                    <!-- <a class="position-absolute lab-triangle-image" 
                    href="javascript:void(0)">
                      <img src="/images/triangle-image.png" 
                      alt="pictire">
                    </a> -->
                    <div class="row">
                      <div class="col-3">
                        <div class="w-100 d-inline-block mb-2">
                            <span class="text_14 text-blue font-weight-bold">Find by Cities
                          </span>
                        </div>
                        <div class="w-100 d-inline-block">
                           <a v-for="(city,index) in areas" v-if="index < 6" :href="'/labs/'+ city.slug" class="allergy_services font-weight-bold d-table float-left mb-14 text-xs-center text-sm-center text-md-center disease_img_main w-100 d-inline-block text_black">
                        <span class="disease_name d-table-cell align-middle mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 font-weight-normal">Labs in {{ city.title }} 
                        </span>
                        <!-- <span :class="colors[index]" class="  h_60 w_60px rounded-circle text-center pt-1 d-flex dropdownInner_img">
                          <v-lazy-image v-if="city.flag" class="w-70" :src="'/uploads/locations/'+city.flag" :alt="city.title" :name="city.title"/>
                          <v-lazy-image v-else class="w-70" :src="'/uploads/locations/default/location.svg'" :alt="city.title" :name="city.title"/>
                        </span> -->
                      </a>
                        </div>
                        <div class="w-100 d-inline-block">
                          <a href="/find-a-lab-near-you" 
                          class="d-inline-block book-rounded bg-green text-white btn-view mt-lg-0 mb-3 mb-lg-0 mt-3 text_12">View All
                          </a>
                        </div>
                      </div>
                      <div class="col-5 p-0">
                        <div class="w-100 d-inline-block mb-2">
                            <span class="text_14 text-blue font-weight-bold">Popular Labs
                          </span>
                        </div>
                        <div class="w-100 d-inline-block">
                            <div class="discount_labs_tests mb-1">
                      <!-- <label>Discount Labs</label> -->
                        <!-- <a href="/book-a-lab-test" class="allergy_services font-weight-bold d-table float-left mb-3 text-xs-center text-sm-center text-md-center disease_img_main">
                          <span class="disease_name d-table-cell align-middle mt-xs-2 mt-sm-2 mt-md-2 text-left">Book A Test </span>
                          <span  class="emergency_circle h_60 w_60px rounded-circle text-center pt-1 d-flex dropdownInner_img">
                            <v-lazy-image  class="w-70" src="/images/book_a_test.png" alt="default" name="default"/>
                          </span>
                        </a> -->
                        <a v-for="(user,index) in laboratorys" v-if="index < 6" :href="'/lab/'+user.location.slug+'/'+user.slug" class="allergy_services d-table float-left mb-2 text-xs-center text-sm-center text-md-center disease_img_main w-100 d-inline-block position-relative">
                          <span :class="colors[index]" class="  h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img mr-2 speciality-box">
                            <v-lazy-image v-if="user.profile.avatar" :src="basePath+'/uploads/users/'+user.id+'/medium-'+user.profile.avatar" :alt="user.first_name+' '+user.last_name" :name="user.first_name+' '+user.last_name" style="width: 58px;" class="rounded-circle"/>
                            <v-lazy-image v-else class="w-70" :src="basePath+'/uploads/locations/default/lab.svg'" :alt="user.first_name" :name="user.first_name"/>
                          </span>
                          <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left discount-list margin-2 w-75 text_13">
                            {{user.first_name+' '+user.last_name}} 
                            <span class="d-inline-block book-rounded bg-red text-white text_12 discount-padding" 
                            v-if="user.user_discount_percentage && user.user_discount_percentage != ' '">{{user.user_discount_percentage}}% OFF
                          </span> 
                          <!-- <div v-if="user.user_discount_percentage && user.user_discount_percentage != ' '" class="d-inline-block bg-blue discount-list-menu position-absolute text-center">
                              <a class="bg-blue d-inline-block text_12 text-center book-rounded text-white underline" 
                              href="javascript:void(0)">
                                Get a Disscount
                              </a>
                            </div> -->
                        </span>
                        </a>
                    </div>
                        </div>
                        <div class="w-100 d-inline-block">
                          <a href="/find-a-lab-near-you" 
                          class="d-inline-block book-rounded bg-green text-white btn-view mt-lg-0 mb-3 mb-lg-0 mt-3 text_12">View All
                          </a>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="w-100 d-inline-block emergency-consult book-rounded pt-0 pb-2 pl-2 pr-2">
                          <div class="w-100 d-inline-block text-center emergency-consult-image">
                            <img :src="basePath+'/images/lab-test-image.png'" 
                            alt="pictire">
                          </div>
                          <div class="w-100 d-inline-block 
                          text-center mt-2">
                            <p class="text-blue font-weight-bold text_16 mt-1">BOOK A TEST</p>
                          </div>
                          <div class="w-100 d-inline-block text-center consult-btn mt-2 mb-1">
                            <a href="/book-a-lab-test" 
                            class="d-inline-block book-rounded bg-red text-white text_14 mt-lg-0 mb-3 mb-lg-0 mt-3">Book Now
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row mt-3">
                      <div class="col-12">
                        <div class="w-85 w-xs-100 w-sm-100 w-md-100 d-block m-auto lab-test-btn">
                          <a href="javascript:void(0)" 
                          class="d-inline-block book-rounded text-blue mt-lg-0 mb-3 mb-lg-0 mt-3 underline text_12 mr-2">
                          Get online Test Reports
                          </a>
                          <a href="javascript:void(0)" 
                          class="d-inline-block book-rounded text-blue mt-lg-0 mb-3 mb-lg-0 mt-3 underline text_12 mr-2">
                          Book Home Sampling
                          </a>
                          <a href="javascript:void(0)" 
                          class="d-inline-block book-rounded text-blue mt-lg-0 mb-3 mb-lg-0 mt-3 underline text_12 mr-2">
                          Test Prices Comparison
                          </a>
                          <a href="javascript:void(0)" 
                          class="d-inline-block book-rounded text-blue mt-lg-0 mb-3 mb-lg-0 mt-3 underline text_12">
                          Get Discounts Codes for Walk-In
                          </a>
                        </div>
                      </div>
                    </div> -->
                       <!-- <div class="w-100 d-inline-block text-center">
                        <a href="/find-a-lab-near-you" class="d-inline-block rounded-pill bg-green text-white p-2 btn_padding mt-lg-0 mb-3 mb-lg-0 mt-3">View All Labs
                          <i aria-hidden="true" class="fa fa-arrow-right ml-2"></i>
                        </a>
                      </div> -->
                    </div>
                </li>
                <li class="d-block d-lg-none position-relative labs-list w-100 d-inline-block h_40">
                  <a class="nav-link text-white" data-toggle="collapse" href="#collapseLabMain">
                    <span class="float-left">
                      Labs
                    </span>
                    <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                    </i>
                  </a>
                  <div id="collapseLabMain" class="w-100 collapse position-relative">
                  <div class="w-100 d-inline-block labs-list-menu">
                    <div class="row">
                      <div class="col-xl-4 col-12">
                        <div class="w-100 d-inline-block mt-1 pl-2">
                          <span class="text_15 text-white">
                            Find by Cities
                          </span>
                        </div>
                        <div class="w-100 d-inline-block mt-3 pl-2">
                           <a v-for="(city,index) in areas" v-if="index < 6" :href="'/labs/'+ city.slug" class="allergy_services d-table float-left mb-2 text-xs-center text-sm-center text-md-center disease_img_main w-100 d-inline-block text-white">
                        <span class="disease_name d-table-cell align-middle mt-xs-2 mt-sm-2 mt-md-2 text-left">Lab in {{ city.title }} 
                        </span>
                      </a>
                        </div>
                        <div class="w-100 d-inline-block text-center">
                          <a href="/find-a-lab-near-you" 
                          class="d-inline-block book-rounded bg-white text-blue btn-view mt-lg-0 mb-2 mb-lg-0 mt-3 text_13">View All
                          </a>
                        </div>
                        <div class="w-100 d-inline-block white-border mb-2"></div>
                      </div>
                      <div class="col-xl-4 col-12">
                        <div class="w-100 d-inline-block">
                          <span class="text_15 text-white">
                            Popular Labs
                          </span>
                        </div>
                        <div class="w-100 d-inline-block mt-3 pl-2">
                            <div class="border-0 discount_labs_tests">
                        <a v-for="(user,index) in laboratorys" v-if="index < 6" :href="'/lab/'+user.location.slug+'/'+user.slug" class="allergy_services d-table float-left mb-2 text-xs-center text-sm-center text-md-center disease_img_main w-100 d-inline-block position-relative">
                          <span :class="colors[index]" class="  h_25 w_25px rounded-circle text-center d-inline-block float-left dropdownInner_img mr-2 speciality-box">
                            <v-lazy-image v-if="user.profile.avatar" :src="basePath+'/uploads/users/'+user.id+'/medium-'+user.profile.avatar" :alt="user.first_name+' '+user.last_name" :name="user.first_name+' '+user.last_name" style="width: 58px;" class="rounded-circle"/>
                            <v-lazy-image v-else class="w-70" :src="basePath+'/uploads/locations/default/lab.svg'" :alt="user.first_name" :name="user.first_name"/>
                          </span>
                          <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left discount-list mt-xl-0 w-85 text-white">
                            {{user.first_name+' '+user.last_name}} 
                            <span class="d-inline-block book-rounded bg-red text-white text_12 
                            discount-padding-off" 
                            v-if="user.user_discount_percentage && user.user_discount_percentage != ' '">{{user.user_discount_percentage}}% OFF
                          </span> 
                          <!-- <div v-if="user.user_discount_percentage && user.user_discount_percentage != ' '" class="d-inline-block bg-blue discount-list-menu position-absolute text-center">
                              <a class="bg-white d-inline-block text_13 text-center book-rounded text-blue underline" 
                              href="javascript:void(0)">
                                Get a Disscount
                              </a>
                            </div> -->
                        </span>
                        </a>
                    </div>
                        </div>
                        <div class="w-100 d-inline-block 
                        text-center">
                          <a href="/find-a-lab-near-you" 
                          class="d-inline-block book-rounded bg-white text-blue btn-view mt-lg-0 mb-2 mb-lg-0 mt-0 text_13">View All
                          </a>
                        </div>
                        <div class="w-100 d-inline-block white-border">
                        </div>
                      </div>
                      <div class="col-xl-4 col-12">
                        <div class="w-100 d-inline-block emergency-consult book-rounded pt-0 pb-2 pl-2 pr-2 border-white mt-3">
                          <div class="w-100 d-inline-block 
                          text-center mt-3">
                            <p class="text-white font-weight-bold text_16 mt-1">BOOK A TEST</p>
                          </div>
                          <div class="w-100 d-inline-block text-center consult-btn mt-2 mb-1">
                            <a href="/book-a-lab-test" 
                            class="d-inline-block book-rounded bg-red text-white text_14 mt-lg-0 mb-3 mb-lg-0 mt-3">Book Now
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </li>
                <li class="nav-item dropdown services_list d-none d-lg-inline-block" v-if="hide_show === 'true'">
                  <a class="nav-link dropdown-toggle d-inline-block" href="#" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
                  <div class="dropdown-menu mega-menu box_radius box_shadow services_dropdown" aria-labelledby="hospitalsDropdown">
                    <!-- <a class="position-absolute triangle-image" 
                    href="javascript:void(0)">
                      <img src="/images/triangle-image.png" 
                      alt="pictire">
                    </a> -->
                    <div class="arrow-up"></div>
                    <a  v-bind:href="service.subtitle" v-for="(service,index) in topservices" class="allergy_services d-table float-left mb-2 mb-xs-5 mr-1 mr-xs-1 mr-sm-2 mr-md-2 text-center disease_img_main">
                      <span :class="colors[index]" class="h_25 w_25px rounded-circle text-center pt-1 d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                         <v-lazy-image :src="basePath+'/uploads/settings/home/'+ service.tab_img":alt="service.title" :name="service.title" />
                      </span>
                      <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75">{{service.title}} </span>
                    </a>
                  </div>
                </li>
                <li id="call_now" class="nav-item header_margin d-none d-lg-block zoom-text-number">
                  <a href="tel:0345-0435621" class="nav-link rounded-pill book-border text-blue d-inline-block"><i class="fas fa-phone fa-sm mr-2" aria-hidden="true"></i> 0345-0435621 
                  </a>
                </li>
                <li class="d-block d-lg-none position-relative services-list w-100 d-inline-block h_40">
                  <a class="nav-link text-white" data-toggle="collapse" href="#collapseServiceMain">
                    <span class="float-left">
                      Services
                    </span>
                    <i class="fa fa-sort-desc margin-2 ml-1" aria-hidden="true">
                    </i>
                  </a>
                  <div id="collapseServiceMain" class="w-100 collapse position-relative">
                  <div class="w-100 d-inline-block services-list-menu mt-3 pl-3">
                    <a v-bind:href="service.subtitle" v-for="(service,index) in topservices" class="allergy_services d-table float-left mb-2 mb-xs-5 mr-1 mr-xs-1 mr-sm-2 mr-md-2 text-center disease_img_main services-images">
                      <span :class="colors[index]" class="h_25 w_25px rounded-circle text-center pt-1 d-inline-block dropdownInner_img speciality-box mr-2 float-left">
                         <v-lazy-image :src="basePath+'/uploads/settings/home/'+ service.tab_img":alt="service.title" :name="service.title" />
                      </span>
                      <span class="disease_name float-left mt-xs-2 mt-sm-2 mt-md-2 text-left text_13 mt-xl-1 w-75 text-white">{{service.title}} </span>
                    </a>
                  </div>
                </div>
                </li>
                <ul v-if="logged_user.length !== undefined" class="d-none d-lg-inline-block pt-1 pl-5">
                  <li class="nav-item header_margin position-relative header_cstm_border mr-0 float-left">
                    <a class="nav-link applink pl-0 service-text" 
                    href="/login">Login </a>
                  </li>
                  <li class="nav-item header_margin float-left mr-3">
                    <a class="nav-link applink pr-0 service-text" 
                    href=/register> Register</a>
                  </li>
                </ul>
                <ul v-if="showCart" class="d-lg-block d-none show-cart">
                  <li class="nav-item header_margin float-right m-0">
                    <a @click="showcartdropdown()" class="text_black text-center d-inline-block shoping-cart-btn position-relative" 
                    href="javascript:void(0)">
                    <sup class="mt-2 text_15">
                      <span id="cart-item" class="position-absolute knockdoc_btn_bg">
                        0
                      </span>
                    </sup>
                      <span class="w-100 d-inline-block mt-2">
                        <i class="fa fa-shopping-cart w-xs-100 
                        float-left" aria-hidden="true" style="font-size:28px;"></i>
                    </span>
                    </a>
                  </li>
                </ul>
                <li v-if="logged_user.length === undefined" class="d-none d-lg-block position-relative w-20 mr-0 usersInfo">
                  <div class="dropdown header_margin">
                    <div class="d-inline-block user_dropdown_main float-right">
                      <a class="nav-link float-left pl-0 user_name service-text" href="javascript:void(0)">{{logged_user.first_name}}</a>
                      <a class="float-left" href="javascript:void(0)">
                        <v-lazy-image v-if="logged_user.profile.avatar !== null" class="h_40 w-40px border-1 border border-white rounded-circle d-flex" :src="basePath+'/uploads/users/'+logged_user.id+'/'+logged_user.profile.avatar" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name"/>

                        <v-lazy-image v-else-if="logged_user.roles[0].name === 'doctor'" class="h_40 w_40px border-1 border border-white rounded-circle d-flex" :src="basePath+'/uploads/users/default/doctor.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name"/>

                        <v-lazy-image v-else-if="logged_user.roles[0].name === 'hospital'" :src="basePath+'/uploads/users/default/hospital.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name" class="h_40 w_40px border-1 border border-white rounded-circle d-flex"/>

                        <v-lazy-image v-else-if="logged_user.roles[0].name === 'patient'" :src="basePath+'/uploads/users/default/patient.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name" class="h_40 w_40px border-1 border border-white rounded-circle d-flex"/>

                        <v-lazy-image v-else="logged_user.roles[0].name === 'laboratory'" :src="basePath+'/uploads/users/default/lab.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name" class="h_40 w_40px border-1 border border-white rounded-circle d-flex"/>
                      </a>
                      <div class="dropdown-menu user_dropdown_list w-20 box_shadow box_radius text_12" aria-labelledby="dropdownMenuButton">
                        <a class="position-absolute triangle-image" 
                        href="javascript:void(0)">
                      <img :src="basePath+'/images/triangle-image.png'" 
                      alt="pictire">
                    </a>
                        <a class="dropdown-item service-text" 
                        :href="'/'+logged_user.roles[0].name+'/dashboard'" :src="'/'+logged_user.roles[0].name+'/dashboard'">Dashboard</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item service-text" href="/doctors">Book appointment</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item service-text" 
                        :href="'/'+logged_user.roles[0].name+'/appointments'">My appointment</a>
                         <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item service-text" 
                        :href="'/'+logged_user.roles[0].name+'/dashboard#wish-list'">Wish list</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item service-text" 
                        @click="logout()"> Logout</a>
                      </div>
                    </div>
                  </div>
                </li>
                <div data-v-6c102e1e="" role="separator" class="dropdown-divider d-inline-block w-100 custom_divider d-block d-lg-none"></div>
              </ul>
              <!-- <ul class="top_menu mb-2 mt-3 d-block d-lg-none">
                <li class="nav-link p-0 mb-4">
                  <a href="/practice-as-doctor" class="nav-item text_13 text-yellow">For Doctors</a>
                </li>
                <li class="nav-link p-0 mb-4">
                  <a href="/for-hospital" class="nav-item text_13 text-yellow">For Hospital and Clinics</a>
                </li>
                <li class="nav-link p-0 mb-4">
                  <a href="/for-lab" class="nav-item text_13 text-yellow">For Lab</a>
                </li>
                <li class="nav-link p-0 mb-4 mobile_more_list more_list dropdown float-left">
                    <a href="javascript:void(0)" class="nav-item text-white text_13" id="moreDropdown">More</a>
                    <div class="dropdown-menu text_12 box_shadow box_radius more_submenu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="/doctors">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
              </ul> -->
              <ul class="about-contact-section float-left w-100 d-lg-none d-block">
                <!-- <li class="float-left text_13 mr-3 w-xs-100 w-sm-100 w-md-100 mb-4">
                <a href="/products" class="text-yellow">Products
                </a>
              </li>
              <li class="float-left text_13 mr-3 w-xs-100 w-sm-100 w-md-100 mb-4">
                <a href="/brands-and-offers" class="text-yellow">Brands & Offers</a>
              </li> -->
              <li class="nav-item header_margin d-block 
              d-lg-none mt-3" id="call_now">
              <p class="mb-2 text-white text_13 font-weight-bold" style="letter-spacing:1px;">
                Helpline
              </p>
                  <a class="nav-link rounded-pill text-white border-white p-0 d-inline-block cell-phone mr-1" 
                  :href="'tel:'+number"><i class="fas fa-phone fa-sm mr-2">
                  </i> {{number}} 
                  </a>
                  <a class="nav-link rounded-pill text-white border-white p-0 d-inline-block cell-phone" href="https://wa.me/+923450435621?text=Hello">
                      <span>
                        <i class="fa fa-whatsapp mr-2 float-left mt-1" aria-hidden="true">
                        </i>
                      </span>
                      Whatsapp Us
                    </a>
                </li>
              </ul>
            </div>
      </div>
    </div>
  </div>
</div>
    <!-- start doctors navigation modal content on mobile/ipad -->
    <div class="modal fade" id="doctors_menu" tabindex="-1" aria-hidden="true" >
      <div class="modal-dialog m-0">
        <div class="modal-content">
          <div class="modal-header border-0 pb-2 pt-1">
            <span class="text-center w-100 text_18 pt-1">Doctors</span>
            <button type="button" class="close p-0 w_33px h_30 text-white rounded-circle bg-white border-2 mt-1 mr-1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="text_black">&times;</span>
            </button>
          </div>
          <!-- start modal Content -->
          <div class=" mobile-nav mega-menu doctors_dropdown mt-3">
            <div class="arrow-up"></div>
            <a v-for="(speciality, index) in specialitys" v-if="index < 9" :href="'/'+speciality.slug+'-in-pakistan'" class="allergy_services font-weight-bold d-table float-left mb-3 mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main" style="min-height:80px;">
              <span :class="colors[index]" class=" h_60 w_60px rounded-circle text-center pt-1 d-inline-block dropdownInner_img">
                <v-lazy-image v-if="speciality.image" class="w-70 img-fluid mt-1" :src="basePath+'/uploads/specialities/'+speciality.image" :alt="speciality.title" :name="speciality.title"/>
                <v-lazy-image v-else class="w-70 img-fluid mt-1" :src="basePath+'/uploads/specialities/default/speciality.svg'" :alt="speciality.title" :name="speciality.title"/>
              </span>
              <span class="disease_name d-table-cell align-middle mt-3" style="color: #7D7D7D;">{{ speciality.title }} </span>
            </a>
            <div class="w-100 d-inline-block text-center">
                      <a href="/find-a-doctor-near-you" class="d-inline-block rounded-pill knockdoc_btn_bg text-white p-2 btn_padding mt-lg-0 mb-3 mb-lg-0 mt-3">View All Specialities
                        <i aria-hidden="true" class="fa fa-arrow-right ml-2"></i>
                      </a>
                    </div>
          </div>
          <!-- end modal content -->
        </div>
      </div>
    </div>
    <!-- // End doctors navigation modal content on mobile/ipad -->
    <!-- start Hospitals navigation modal content on mobile/ipad -->
    <div class="modal fade" id="hospital_menu" tabindex="-1" aria-hidden="true" >
      <div class="modal-dialog m-0">
        <div class="modal-content">
          <div class="modal-header border-0 pb-2 pt-1">
            <span class="text-center w-100 text_18 pt-1">Hospitals</span>
            <button type="button" class="close p-0 w_33px h_30 text-white rounded-circle bg-white border-2 mt-1 mr-1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="text_black">&times;</span>
            </button>
          </div>
          <!-- start modal Content -->
          <div class=" mobile-nav mega-menu doctors_dropdown mt-3">
            <div class="arrow-up"></div>
              <a v-for="(city,index) in areas"  v-if="index < 6" v-bind:href="'/hospitals/'+ city.slug" class="allergy_services font-weight-bold d-table float-left mb-3 mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main" style="min-height:80px;">
                <span :class="colors[index]" class=" h_60 w_60px rounded-circle text-center pt-1 d-inline-block float-right float-xs-none mr-0 float-sm-none float-md-none">
                  <v-lazy-image v-if="city.flag" class="w-70" :src="basePath+'/uploads/locations/'+city.flag" :alt="city.title" :name="city.title"/>
                  <v-lazy-image v-else class="w-70" :src="basePath+'/uploads/locations/default/location.svg'" :alt="city.title" :name="city.title"/>
                </span>
                <span class="disease_name d-table-cell align-middle mt-3" style="color: #7D7D7D;">Hospitals in {{ city.title }} </span>
              </a>
               <div class="w-100 d-inline-block text-center">
                      <a href="/hospitals" class="d-inline-block rounded-pill knockdoc_btn_bg text-white p-2 btn_padding mt-lg-0 mb-3 mb-lg-0 mt-3">View All Hospitals
                        <i aria-hidden="true" class="fa fa-arrow-right ml-2"></i>
                      </a>
                    </div>
            </div>
          <!-- end modal content -->
        </div>
      </div>
    </div>
    <!-- // End Hospitals navigation modal content on mobile/ipad -->
    <!-- start Hospitals navigation modal content on mobile/ipad -->
    <div class="modal fade" id="labs_menu" tabindex="-1" aria-hidden="true" >
      <div class="modal-dialog m-0">
        <div class="modal-content">
          <div class="modal-header border-0 pb-2 pt-1">
            <span class="text-center w-100 text_18 pt-1">Labs</span>
            <button type="button" class="close p-0 w_33px h_30 text-white rounded-circle bg-white border-2 mt-1 mr-1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="text_black">&times;</span>
            </button>
          </div>
          <!-- start modal Content -->
          <div class=" mobile-nav mega-menu doctors_dropdown mt-1">
            <div class="arrow-up"></div>
              <div class="discount_labs_tests pl-3 pr-3">
                <label>Discount Labs</label>
                  <a href="/book-a-lab-test" class="allergy_services font-weight-bold d-table float-left mb-3 mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main">
                    <span  class="emergency_circle h_60 w_60px rounded-circle text-center pt-1 d-inline-block float-right float-xs-none mr-0 float-sm-none float-md-none">
                      <v-lazy-image  class="w-70" :src="basePath+'/images/book_a_test.png'" alt="default" name="default"/>
                    </span>
                    <span class="disease_name d-table-cell align-middle mt-3" style="color: #7D7D7D;">Book A Test </span>
                  </a>
                  <a v-for="(user,index) in laboratorys" v-if="index < 6" :href="'/lab/'+user.location.slug+'/'+user.slug" class="allergy_services font-weight-bold d-table float-left mb-3 mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main">
                    <span :class="colors[index]" class="h_60 w_60px rounded-circle text-center pt-1 d-inline-block float-right float-xs-none mr-0 float-sm-none float-md-none">
                      <v-lazy-image v-if="user.profile.avatar" :src="basePath+'/uploads/users/'+user.id+'/medium-'+user.profile.avatar" :alt="user.first_name+' '+user.last_name" :name="user.first_name+' '+user.last_name" style="width: 50px; margin-top: 1px;" class="rounded-circle"/>
                      <v-lazy-image v-else class="w-70" :src="basePath+'/uploads/locations/default/lab.svg'" :alt="user.first_name" :name="user.first_name"/>
                    </span>
                    <span class="disease_name d-table-cell align-middle mt-3" style="color: #7D7D7D;">{{user.first_name+' '+user.last_name}} <span v-if="index==0">( 20% OFF )</span> </span>
                  </a>
                  <!-- <div class="arrow-up"></div> -->
              </div>
              <!-- <a href="/book-a-lab-test" class="allergy_services font-weight-bold d-table float-left mb-3 mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main" style="min-height:80px;">
                <span  class="red_circle h_60 w_60px rounded-circle text-center pt-1 d-inline-block float-right float-xs-none mr-0 float-sm-none float-md-none">
                  <v-lazy-image  class="w-70" src="/uploads/locations/default/location.svg" alt="default" name="default"/>
                </span>
                <span class="disease_name d-table-cell align-middle mt-3" style="color: #7D7D7D;">Book A Test </span>
              </a> -->
              <a v-for="(city,index) in areas" v-if="index < 6" v-bind:href="'/labs/'+ city.slug" class="allergy_services font-weight-bold d-table float-left mb-3 mb-xs-1 mr-xs-1 text-xs-center text-sm-center text-md-center disease_img_main" style="min-height:80px;">
                <span :class="colors[index]" class=" h_60 w_60px rounded-circle text-center pt-1 d-inline-block float-right float-xs-none mr-0 float-sm-none float-md-none">
                  <v-lazy-image v-if="city.flag" class="w-70" :src="basePath+'/uploads/locations/'+city.flag" :alt="city.title" :name="city.title"/>
                  <v-lazy-image v-else class="w-70" :src="basePath+'/uploads/locations/default/location.svg'" :alt="city.title" :name="city.title"/>
                </span>
                <span class="disease_name d-table-cell align-middle mt-3" style="color: #7D7D7D;">Lab in {{ city.title }} </span>
              </a>
                  <div class="w-100 d-inline-block text-center">
                      <a href="/find-a-lab-near-you" class="d-inline-block rounded-pill knockdoc_btn_bg text-white p-2 btn_padding mt-lg-0 mb-3 mb-lg-0 mt-3">View All Labs
                        <i aria-hidden="true" class="fa fa-arrow-right ml-2"></i>
                      </a>
                    </div>
            </div>
          <!-- end modal content -->
        </div>
      </div>
    </div>
    <!-- // End Hospitals navigation modal content on mobile/ipad -->
    <!-- start Services navigation modal content on mobile/ipad -->
    <div class="modal fade" id="services_menu" tabindex="-1" aria-hidden="true" >
      <div class="modal-dialog m-0">
        <div class="modal-content">
          <div class="modal-header border-0 pb-2 pt-1">
            <span class="text-center w-100 text_18 pt-1">Services</span>
            <button type="button" class="close p-0 w_33px h_30 text-white rounded-circle bg-white border-2 mt-1 mr-1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="text_black">&times;</span>
            </button>
          </div>
          <!-- start modal Content -->
          <div class=" mobile-nav mega-menu doctors_dropdown mt-3">
            <div class="arrow-up"></div>
            <a  v-bind:href="service.subtitle" v-for="(service,index) in topservices" class="allergy_services font-weight-bold d-table float-left mb-3 mb-xs-5 mr-1 mr-xs-1 mr-sm-2 mr-md-2 text-center disease_img_main">
              <span :class="colors[index]" class=" h_60 w_60px rounded-circle text-center p-2 d-inline-block float-none float-lg-right mr-2 mr-xs-0 green_circle overflow-hidden">
                 <v-lazy-image :src="basePath+'/uploads/settings/home/'+ service.tab_img":alt="service.title" :name="service.title" />
              </span>
              <span class="disease_name d-table-cell align-middle mt-3" style="color: #7D7D7D;">{{service.title}} </span>
            </a>
          </div>
          <!-- end modal content -->
        </div>
      </div>
    </div>
    <!-- // End Services navigation modal content on mobile/ipad -->
  </div>
</template>
<script>
import VueNumeric from 'vue-numeric';
import VLazyImage from "v-lazy-image/v2";
export default {
  components: 
  {
    VueNumeric,
    VLazyImage
  },
  name: "HeaderComponent",
  props:[
    'specialitys',
    'cities',
    'logged_user',
    'managements',
    'laboratorys',
    'fileSystemDriver',
  ],
   data() {
    return {
      screenSize:'',
      hospitalss:[],
      diseasess:[],
      surgeries:[],
      hospitals_cities:[],
      total_cart_amount:0,
      cartItem:[],
      updateState:'',
      counterVal:[],
      total_amount_array:[],
      showCart:false,
      value:0,
      hide_show: '',
      topservices: '',
      title: '',
      number: '',
      btn: '',
      url: '',
      header_service: '',
      show_headertabs: '',
      topbar_settings: '',
      site_logo: '' ,
      main_logo: '',
      colors:['allergy_circle','family_circle','internal_circle','diagnostic_circle','anesthesiology_circle',
        'emergency_circle','medical_circle','dermatologist_circle','allergy_circle','family_circle','internal_circle',
        'diagnostic_circle','anesthesiology_circle','emergency_circle','medical_circle'],
      specs:[],
      areas:[],
      headerServices:[],
      limitPosition: 500,
      scrolled: false,
      lastPosition: 0,
      show: false,
      selectedLocation: [],
      download: '',
      android_url: '',
      android_img: '',
      ios_url: '',
      ios_img: '',
      basePath:'',
    }
  },
  mounted()
  {
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
    this.updateScreenSize();
        window.addEventListener('resize', this.updateScreenSize);
  },
  beforeUnmount() {
        window.removeEventListener('resize', this.updateScreenSize);
      },
  created() {
    window.addEventListener("scroll", this.handleScroll);

    const managements = Array.isArray(this.managements) ? this.managements : [];
    const parseMeta = (item, fallback = {}) => {
      if (!item || !item.meta_value) {
        return fallback;
      }
      try {
        return JSON.parse(item.meta_value);
      } catch (error) {
        return fallback;
      }
    };

    this.header_service = managements.find(pf => pf.meta_key === 'header_service');
    this.topservices = parseMeta(this.header_service, []);

    this.show_headertabs = managements.find(pf => pf.meta_key === 'show_headertabs');
    this.hide_show = this.show_headertabs ? this.show_headertabs.meta_value : '';

    const topbarSettings = parseMeta(
      managements.find(pf => pf.meta_key === 'topbar_settings'),
      {}
    );
    this.topbar_settings = managements.find(pf => pf.meta_key === 'topbar_settings');
    this.title = topbarSettings.title || '';
    this.number = topbarSettings.number || '';
    this.btn = topbarSettings.btn || '';
    this.url = topbarSettings.url || '';

    this.site_logo = managements.find(pf => pf.meta_key === 'general_settings');
    const generalSettings = parseMeta(this.site_logo, {});
    this.main_logo = generalSettings.site_logo || '';

    this.download = managements.find(pf => pf.meta_key === 'download_app_sec');
    const downloadSettings = parseMeta(this.download, {});
    this.android_img = downloadSettings.android_img || '';
    this.android_url = downloadSettings.android_url || '';
    this.ios_img = downloadSettings.ios_img || '';
    this.ios_url = downloadSettings.ios_url || '';

    const cities = Array.isArray(this.cities) ? this.cities : [];
    cities.forEach((city) => {
      if (city.top === '1' || city.top === 1) {
        this.areas.push(city);
      }
    });

    if(window.location.href.includes('brands-and-offers') || window.location.href.includes('product')){
        this.showCart = true;
      }
    this.getHeaderData();
    },
 
  methods: {
    showdropdownLab(id){
      var newid = 'labdrop';
      var check = document.getElementById("labdrop").style.display;
      if (check == "block") {
        document.getElementById("labdrop").style.display = 'none';
      }else{
        document.getElementById("labdrop").style.display = 'block';
      }
    },
    updateScreenSize() {
          if (window.innerWidth < 1024) {
            this.screenSize = 'Mobile';
          } else {
            this.screenSize = 'Desktop';
          }
        },
    getHeaderData()
    {
        axios.get('/get-header-default-data')
        .then(response=>{
          this.hospitals_cities=response.data[0];
          // this.surgeries=response.data[1];
          this.hospitalss=response.data[1];
          // this.diseasess=response.data[3];
      }); 
    },
    removeCartItem(index) {
        this.cartItem.splice(index, 1);
        this.counterVal.splice(index, 1);
        localStorage.setItem("cart", JSON.stringify(this.cartItem));
        // document.getElementById('cart-item').innerHTML=[...new Set(this.cartItem)].length;
        var numberCart = document.querySelectorAll("#cart-item");
        for (var i = numberCart.length - 1; i >= 0; i--) {
          numberCart[i].innerHTML = [...new Set(this.cartItem)].length;
        }
        this.calculateTotalAmountCart();
      },
         increment(index,amount) { 
            this.counterVal[index]++;
        if(this.counterVal[index]>=100){
          this.counterVal[index] = 100;
          this.$toasted.show('For More Quantity Contact Us.',{
            type:'success',
            duration: 2000
          });
        }else{
          this.saveProductQuantity(index,this.counterVal[index]);
          this.total_cart_amount = this.total_cart_amount+amount;
        }
        this.updateState = this.counterVal[index];
        },
        decrement(index,amount) {
            this.counterVal[index]--;
        if(this.counterVal[index]<=0){
          this.counterVal[index] = 1;
        }else{
          this.saveProductQuantity(index,this.counterVal[index]);
          this.total_cart_amount = this.total_cart_amount-amount;
        }
        this.updateState = this.counterVal[index];
        },
      saveProductQuantity(index,quantity){
        this.cartItem[index].product_quantity = quantity;
        localStorage.setItem("cart", JSON.stringify([...new Set(this.cartItem)]));
      },
         showcartdropdown(id){
            var newid = 'cartdrop';
            var total_amount_array = [];
            var check = document.getElementById("cartdrop").style.display;
            if (check == "block") {
              document.getElementById("cartdrop").style.display = 'none';
            }else{
              document.getElementById("cartdrop").style.display = 'block';
            }
            this.cartItem = JSON.parse(localStorage.getItem('cart'));
            this.calculateTotalAmountCart();
        this.productQuantityUpdate();
          },
          productQuantityUpdate(){
        if(this.cartItem.length>0){
          this.counterVal=[];
          this.cartItem.filter(elem=>{
            this.counterVal.push(elem.product_quantity);
          });
        }
        this.updateState = this.counterVal[0];
      },
         calculateTotalAmountCart(){
        if(this.cartItem.length > 0){
          this.total_amount_array=[];
          this.cartItem.filter((amount)=>{
            if(amount.discount_price){
              this.total_amount_array.push(amount.discount_price*amount.product_quantity);
            }else{
              this.total_amount_array.push(amount.price*amount.product_quantity);
            }
          });
          this.total_cart_amount = this.total_amount_array.reduce((a,b)=>{return a+b});
        }
      },
          crossicon(id){
            var newid = 'cartdrop';
            var check = document.getElementById("cartdrop").style.display;
            if (check == "block") {
              document.getElementById("cartdrop").style.display = 'none';
            }else{
              document.getElementById("cartdrop").style.display = 'block';
            }
          },
          crossiconlab(id){
            var newid = 'labdrop';
            var check = document.getElementById("labdrop").style.display;
            if (check == "block") {
              document.getElementById("labdrop").style.display = 'none';
            }else{
              document.getElementById("labdrop").style.display = 'block';
            }
          },
       closeCollapse(){
      var mobileCollapse = document.getElementById("navbarSupportedContent");
      mobileCollapse.classList.remove("show");
    },
    logout() {
      axios.post(APP_URL + '/logout')
          .then(function (response) {
              window.location = APP_URL
          })
          .catch(function (error) {
          })
    },
    handleScroll() {
      this.show = window.scrollY;
    },
  }
}
</script>
<style scoped>
/* Common hover styles for dropdowns */
#hospitalsDropdown:hover,
#doctorsDropdown:hover,
#servicesDropdown:hover,
#labDropdown:hover {
  color: #243562 !important;
  font-weight: bold;
}

/* Lazy loading image styles */
img[lazy="loading"] {
  height: 40px !important;
}

/* Modal overflow styles */
.modal-open .modal {
  overflow-x: hidden !important;
  overflow-y: hidden !important;
}
</style>