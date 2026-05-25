<template>
  <div>
    <div v-if="loading" id="loader"></div>
    <div class="sticky-wrapper">
    <div class="w-100 d-inline-block section-box pt-2 pb-2" 
    :class="{ 'sticky': isSticky }">
    <div class="container">
      <div class="row">
        <div class="col-4 d-lg-block d-none">
           <div class="position-relative w-20 float-left">
              <img v-if="user.profile.avatar" v-lazy="basePath+'/uploads/users/'+user.id+'/small-'+user.profile.avatar" :alt="user.first_name +' '+ user.last_name" :name="user.first_name +' '+ user.last_name" class="img-fluid rounded-circle h_55 w_55px w_md_80px h_md_80">
              <img v-else v-lazy="basePath+'/uploads/users/default/doctor.svg'" :alt="user.first_name +' '+ user.last_name" :name="user.first_name +' '+ user.last_name" class="img-fluid rounded-circle h_55 w_55px w_md_80px h_md_80">
              <a href="javascript:void(0)" 
              class="circle_anchor position-absolute"></a>
              <a v-if="user.profile.willing_video === 'on'" href="javascript:void(0)" 
              class="position-absolute d-table video_icon">
              <p class="w_25px h_25 rounded-circle text-center d-table-cell align-middle text-white video-circle">
                <i class="fas fa-video text_12" aria-hidden="true">
                </i>
              </p>
            </a>
          </div>
          <div class="w-80 float-left d-inline-block">
            <h2 class="d-inline-block text_14 w-80 mb-1 font-weight-bold">
              <span class="float-left text_mdH_12">
                {{ user.first_name }} {{ user.last_name }}
              </span>
            </h2>
            <p class="text_13 text-truncate" v-if="user.specialities !== null">
              <span v-for="(spec, index) in user.specialities" class="comma">{{ spec.title }}
              </span> 
            </p>
          </div>
        </div>
        <div class="col-xl-4 col-12 col-lg-4 col-md-6">
           <ul class="w-100 d-inline-block mb-0 mt-2">
              <li class="float-left mr-lg-4 mr-3">
                <a class="faq-text text_14 font-weight-bold w-100 d-inline-block text-xs-14 text_mdH_12" href="javascript:void(0)" 
                :class="{ activebtn: isActive.specialties }" 
                @click="activate('specialties')">
                  <span @click="scrolltodiv">
                    Specialties
                  </span>
                </a>
              </li>
              <li class="float-left mr-lg-4 mr-3">
                <a class="faq-text text_14 font-weight-bold w-100 d-inline-block text-xs-14 text_mdH_12" href="javascript:void(0)" 
                :class="{ activebtn: isActive.disease }" 
                @click="activate('disease')">
                  <span @click="scrolltodiv2">
                    Disease
                  </span>
                </a>
              </li>
              <li class="float-left mr-xl-4 mr-3 ml-xl-0 ml-2">
                <a class="faq-text text_14 font-weight-bold w-100 d-inline-block text-xs-14 text_mdH_12" href="javascript:void(0)" 
                :class="{ activebtn: isActive.fAQs }" 
                @click="activate('fAQs')">
                  <span @click="scrolltodiv3">
                    FAQs
                  </span>
                </a>
              </li>
              <li class="float-left mr-lg-4 mr-0 ml-lg-0 ml-3">
                <a class="faq-text text_14 font-weight-bold w-100 d-inline-block text-xs-14 text_mdH_12" href="javascript:void(0)" 
                :class="{ activebtn: isActive.reviews }" 
                @click="activate('reviews')">
                  <span @click="scrolltodiv4">
                    Reviews
                  </span>
                </a>
              </li>
           </ul>
        </div>
        <div class="col-4 d-lg-block d-none col-md-6 col-lg-4 d-md-block">
          <div class="w-100 d-inline-block sticky-section-btn">
            <a href="javascript:void(0)" @click="scrollToClass" 
            class="font-weight-bold text-center text-blue text_13 small_btn book-btn book-rounded book-border d-inline-block position-relative mr-2">
              Book Appointment
              <span class="finger-icon bg-blue d-inline-block position-absolute">
                <img :src="basePath+'/images/finger-icon.png'" 
                alt="pictire">
              </span>
            </a>
            <a href="javascript:void(0)" @click="scrollToClass" 
            class="text-center text-white font-weight-bold text_13 small_btn book-video-btn bg-green book-rounded book-padding d-inline-block position-relative 
            border-green">
            Video Consultation
              <span class="finger-icon video-cam-icon bg-blue d-inline-block position-absolute">
                <img :src="basePath+'/images/video-cam-icon.svg'"
                alt="pictire">
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
  <!-- <div class="row">
    <div class="col-12">
      <div class="w-100 d-inline-block 
      position-relative">
      <div class="position-absolute box-right">
        <div class="consultation-box bg-white box-shadow book-rounded d-xl-block d-none profile-sticky">
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
    <div class="col-md-12 box_radius bg-summery-box">
      <!-- Start Doctor Profile -->
      <div class="row">
        <div class="col-lg-7 col-md-12">
          <div class="doctor_profile_left pt-3 position-relative">
            <div class="w-100 d-inline-block">
              <div class="doctor_image position-relative float-left mr-lg-3 mr-1 pb-2">
                <div class="position-relative mb-2">
                  <img v-if="user.profile.avatar" v-lazy="basePath+'/uploads/users/'+user.id+'/small-'+user.profile.avatar" :alt="user.first_name +' '+ user.last_name" :name="user.first_name +' '+ user.last_name" class="img-fluid rounded-circle h_110 w_110px w_md_60px h_md_60">
                  <img v-else v-lazy="basePath+'/uploads/users/default/doctor.svg'" :alt="user.first_name +' '+ user.last_name" :name="user.first_name +' '+ user.last_name" class="img-fluid rounded-circle h_110 w_110px w_md_60px h_md_60">
                  <a href="javascript:void(0)" 
                  class="circle_anchor position-absolute"></a>
                  <a v-if="user.profile.willing_video === 'on'" href="javascript:void(0)" 
                  class="position-absolute d-table video_icon">
                  <p class="w_25px h_25 rounded-circle text-center d-table-cell align-middle text-white video-circle">
                    <i class="fas fa-video text_12" aria-hidden="true"></i>
                  </p>
                </a>
                </div>
                <!-- <div class="total_rating w-80 m-auto w-md-100 d-block overflow-hidden">
                  <span>
                    <span class="text-blue font-weight-bold">
                      {{ averageRating(user.feedbacks) }}

                      <star-rating
                          :max-rating="1"
                          :show-rating="false"
                          v-model="userRating"
                          :increment="userRating"
                          :rating="userRating"
                          inactive-color="#cccccc"
                          active-color="#0E4D92"
                          v-bind:star-size="14"
                          class="mt-1"
                      ></star-rating>

                      <span class="float-left text-center mr-1 ml-1 text-blue" style="margin-top: 1px;">{{userRating}}</span>
                      <span class="d-inline-block text-blue" style="margin-top: 1px;"> ({{user.feedbacks.length}})</span>
                    </span>
                  </span>
                </div> -->
              </div>
              <div class="prfile_detail details_layout float-left float-lg-none overflow-hidden">
                <div class="doctor_name float-left w-100">
                  <h2 class="d-inline-block text_md_16 w-80 w-xs-100 w-sm-100 w-md-100 w-ipad-100 doctor-profile">
                    <span class="float-left text_md_13 
                    doctor-profile-name">
                      {{ user.first_name }} {{ user.last_name }}
                    </span>
                    <span class="ml-xl-2 ml-1 profile-icon-image float-left mt-1">
											<img :src="basePath+'/images/check.png'"  v-tooltip="verified_message"  alt="Check" class="img-fluid">
										</span>
                    <span class="profile-icon-image float-left mt-1 ml-xl-2 ml-1">
											<img :src="basePath+'/images/shield.png'" alt="Shield" v-tooltip="medical_message" class="img-fluid">
										</span>
                    <span class="ml-xl-4 ml-1 float-left">
                      <a href="javascript:void(0)" @click="wishlist(user.id, '', 'saved_doctors')">
                      <i v-bind:style=" saved_doctors.includes(user.id) ? 'color: #ff465c !important;' : 'color: #BCBCBC;' " class="fa fa-heart text_md_20 text_20 text-xs-14">
                        
                      </i>
                    </a>
                    </span>
                  </h2>
                  <!-- <div class="waitng_time d-inline-block text_md_13 float-right">
                    <span class="theme-color-text font-weight-bold d-none d-lg-inline-block">Wait Time</span>
                    <span class="mr-3 d-none d-lg-inline-block"> ( {{ averageWaitingTime(user.feedbacks) }} minutes ) </span>
                    <a href="javascript:void(0)" @click="wishlist(user.id, '', 'saved_doctors')">
                      <i v-bind:style=" saved_doctors.includes(user.id) ? 'color: #ff465c !important;' : 'color: #BCBCBC;' " class="fa fa-heart text_md_20 text_25"></i>
                    </a>
                  </div> -->
                </div>
                <div class="doctor_degree text_black d-inline-block text_md_13 w-100">
                  <p class="text_12 font-weight-bold text-red text-truncate w-100" v-if="user.specialities !== null">
                    <span v-for="(spec, index) in user.specialities" class="comma">{{ spec.title }}
                    </span> </p>
                  <p class="mt-1 mb-1 text_black text_12 text-truncate w-100" 
                  v-if="education !== ''"><span v-for="(edu, index) in education" class="comma"> {{edu.degree_title}}
                  </span> </p>
                  <!-- <p class="text_14 text_md_13 d-xs-none d-sm-none d-md-none d-lg-block">
                    {{ user.sub_heading }}</p> -->
                  <!-- <p class="text_14 d-lg-block d-none d-lg-block d-md-block font-weight-bold text-red"><span v-if="user.profile.sub_heading === '' || user.profile.sub_heading === 'null' || user.profile.sub_heading === null"></span><span v-else>"{{ user.profile.sub_heading }}"</span></p> -->
                  <ul class="doctor_fee_details d-lg-inline-block d-md-inline-block w-100 mt-2 d-none mb-md-0">
                      <li class="float-left w-18 pr-2 pr-md-0 doctor-fee-list position-relative" 
                      v-if="fee!=0">
                        <span class="small_img">
                          <img :src="basePath+'/images/rs.png'" alt="currency icon" class="img-fluid h_10">
                        </span>
                        <span class="text-blue text_12 font-weight-bold">Rs</span>
                       <span class="text_12 font-weight-bold">{{fee}}
                       </span>
                      </li>
                      <li class="float-left w-30 mr-2 doctor-experience-list position-relative" v-if="user.profile.total_experience && user.profile.total_experience != '' && user.profile.total_experience != null">
                        <span class="small_img text-center">
                          <img :src="basePath+'/images/experience.png'" alt=" experience icon" class="img-fluid">
                        </span>
                        <span class="text-blue text_12 font-weight-bold">
                          {{ user.profile.total_experience }} Years
                        </span>
                        <span class="text_black text_12 font-weight-bold" v-if="user.profile.total_experience.length <= 2">
                           Experience
                        </span>
                        <span class="text_black text_12 font-weight-bold" v-else-if="user.profile.total_experience.length > 2 && user.profile.total_experience.length <= 8">
                          Years Experience
                        </span>
                        <span v-else>
                        </span>
                      </li>
                      <li class="float-left w-35" v-if="user.profile.wait_time && user.profile.wait_time != '' && user.profile.wait_time != null">
                        <span class="wait_icon text-center text-blue">
                          <img :src="basePath+'/images/wait-icon.svg'" alt=" experience icon" class="img-fluid">
                        </span>
                        <span class="text-blue ml-2 text_12 font-weight-bold">Wait Time
                        </span>
                        <span v-if="user.profile.wait_time != '' && user.profile.wait_time.length <= 2" 
                        class="text_12 font-weight-bold"> 
                      ( {{ user.profile.wait_time }} Min )</span>
                          <span v-else-if="user.profile.wait_time && user.profile.wait_time != ''" 
                          class="text_12 font-weight-bold">
                          ({{ user.profile.wait_time }})
                        </span>
                        <span class="text_12" v-else>
                          (0 min)
                        </span>
                      </li>
                      <li class="float-left w-35 text-center" v-else>
                        <span class="wait_icon">
                          <img :src="basePath+'/images/wait-icon-image.png'" alt=" experience icon" class="img-fluid">
                        </span>
                        <span class="text-blue ml-2 text_12 font-weight-bold">Wait Time</span>
                        <span class="text_12 font-weight-bold">
                        ( 15 Min)</span>
                      </li>
                    </ul>
                    <!-- <div class="Satisfy_percentage mt-3 d-block ml-md-0">
                  <p v-if="user.feedbacks.length > 0" class="badge safety-box text-white text_md_13 d-xs-none d-sm-none d-md-none d-lg-inline-block text_14">
                    <i class="fa fa-thumbs-up"></i> {{ (user.profile.votes / user.feedbacks.length * 100).toFixed(0) }}%
                  </p>
                  <span v-else class="badge safety-box text-white text_md_13 d-inline-block">
                    <i class="fa fa-thumbs-up text_14"></i> {{ (parseInt(userRating))/5*100 }}%
                  </span>
                  <span class="text_12 ml-2 text_black">
                      Satisfied patients
                  </span>
                </div> -->
                  <!-- <p class="text_14 mt-2 text_md_13 d-xs-none d-sm-none d-md-none d-lg-block"> {{ user.area_id !== null ? user.area.title : ' ' }}, {{ user.location_id !== null ? user.location.title : ' ' }} </p> -->
                  <!-- <span><img src="/images/experience.png" alt="Experience image" class="img-fluid mr-2"> <span class="theme-color-text font-weight-bold"> {{ user.profile.total_experience }} Years</span> Experience</span>
                  <span class="d-block"><img src="/images/rs.png" alt="Ruppes" class="img-fluid mr-2"> <span class="theme-color-text font-weight-bold">Rs</span> {{ user.profile.starting_price }} </span> -->
                  <!--<span class="d-block"><img src="/images/rs.png" alt="Ruppes" class="img-fluid mr-2"> <span class="theme-color-text font-weight-bold">Wait Time</span> ( {{ averageWaitingTime(user.feedbacks) }} minutes )</span>-->
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-md-12">
          <div class="doctor_profile_right pt-3 pb-1 pt-md-0">
            <div class="row">
              <div class="col-md-6">
                <div class="mobile_view_fee mt-0 mb-0 mb-lg-3 d-block d-md-none d-lg-none">
                  <div class="row">
                    <div class="col-3 p-0">
                      <div class="doctor-fee text-xs-10 text-center">
                        <span class="d-block">
                          <span class="w-xs-100 d-inline-block">
                            <img :src="basePath+'/images/rs.svg'" alt="Dr Maryam Tariq" name="Dr Maryam Tariq" class="img-fluid mr-2 d-lg-block" 
                            style="height:10px;">
                          </span> 
                          <span class="text-blue text-9 font-weight-bold"></span> 
                        <span class="mt-1 d-block text-9 
                        font-weight-bold">
                        <span v-if="fee != 0">
                              Rs {{fee}}
                             </span>
                             <span v-else>
                                <!-- {{ feesRange(user.profile.fees_range) }}  -->
                                0
                             </span>
                         </span>
                      </span>
                      </div>
                    </div>
                    <div class="col-4 p-0">
                      <div class="doctor-experience text-xs-10 
                      text-center">
                        <span>
                          <span class="w-xs-100 d-inline-block">
                            <img :src="basePath+'/images/experience.png'" alt="Dr Maryam Tariq" name="Dr Maryam Tariq" class="img-fluid mr-2 d-lg-block" 
                            style="height:12px;">
                          </span> 
                          <span class="text-blue text-9 font-weight-bold" v-if="user.profile.total_experience && user.profile.total_experience != ''">
                          {{ user.profile.total_experience }} Years
                        </span>
                        <span class="mt-1 text-9 font-weight-bold" v-if="user.profile.total_experience && user.profile.total_experience.length <= 2">
                           Experience
                        </span>
                        <span class="mt-1 text-9 font-weight-bold" v-else-if="user.profile.total_experience && user.profile.total_experience.length > 2 && user.profile.total_experience.length <= 8">
                          Years Experience
                        </span>
                        <span v-else>
                         
                        </span>
                      </span>
                      </div>
                    </div>
                    <div class="col-5 pl-0">
                      <div class="waitng_time d-inline-block text-center text-xs-10 w-100">
                        <span class="w-xs-100 d-inline-block">
                          <i class="fa fa-hourglass text-blue wait_icon mr-2" aria-hidden="true" style="font-size:10px !important"></i>
                        </span>
                        <span class="text-blue text-9 font-weight-bold">Wait Time</span> 
                        <span class="text-9 font-weight-bold" v-if="user.profile.wait_time && user.profile.wait_time != ''"> 
                          ({{ user.profile.wait_time }} Min)
                        </span>
                        <span class="text-9 font-weight-bold" v-else>
                          (15 Min)
                        </span><a href="javascript:void(0)"></a>
                      </div>
                    </div>
                  </div>
                  <p class="text_14 mobile_review mt-3">{{ user.profile.sub_heading }}</p>
                </div>
                <span class="availability_shedule pt-xl-3 d-inline-block text_12"><i class="fa fa-calendar mr-3 text-blue float-left mt-2"></i> Availability</span>
                <ul class="days ml-lg-3 d-flex w-100 mb-xl-0 mb-2">
                  <li :class=" [user.profile.available_days !== null ? user.profile.available_days.includes(day) ? 'text-green ' : 'text-blue ' : 'text-blue ', 'float-left text-blue ml-2']" v-for="(day, index) in weekDays">
                    {{ day.charAt(0).toUpperCase() + day.slice(1) }}{{ index === 6 ? '' : ','}}
                  </li>
                  <!--<li class="float-left theme-green-text">, Mon</li>
                  <li class="float-left theme-green-text">, Tue</li>
                  <li class="float-left theme-green-text">, Wed</li>
                  <li class="float-left theme-color-text">, Thu</li>
                  <li class="float-left theme-green-text">, Fri</li>
                  <li class="float-left theme-green-text">, Sat</li>-->
                </ul>
                <ul class="clinic_detail d-lg-inline-block d-none">
                  <li class="w-100 d-inline-block">
                    <span class="text_12 float-left w-75">
                      <img :src="basePath+'/images/environment.png'" 
                    alt="Environment" class="img-fluid mr-2 environment-icon-image">
                    Environment</span>
                    <span class="float-left text-blue text_12">
                    {{ parseInt(environment/5*100) }}%</span>
                  </li>
                  <li class="w-100 d-inline-block">
                    <span class="text_12 float-left w-75">
                      <img :src="basePath+'/images/staff.png'" alt="Staff" class="img-fluid mr-2 staff-icon-image">
                    Staff behavior</span>
                    <span class=" float-left text-blue text_12">
                    {{ parseInt(staffBehaviourRating/5*100) }}%
                  </span>
                  </li>
                  <li class="w-100 d-inline-block">
                    <span class="text_12 float-left w-75">
                      <img :src="basePath+'/images/doctor_checkup.png'" 
                    alt="Doctor Checkup" class="img-fluid mr-2 checkup-icon-image">
                    Doctor Checkup</span>
                    <span class=" float-left text-blue text_12">
                    {{ parseInt(checkupRating/5*100) }}%</span>
                  </li>
                </ul>
              </div>
              <div class="col-md-6">
                <div class="doctor_profile_right pt-lg-2 pl-lg-2 p-0">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="list_btns btn_layout w-100 mt-lg-0 mt-md-4 ml-md-auto mr-md-auto mt-md-5 overflow-hidden">
                        <a href="javascript:void(0)" @click="scrollToClass" class="d-md-block font-weight-bold text-center text-blue text_12 text_md_12 float-left float-md-none small_btn w-sm-48 w-100 book-btn book-rounded book-padding book-border position-relative mt-2 w-xs-48 text-10">
                        Book Appointment
                        <span class="finger-icon bg-blue d-inline-block position-absolute">
                          <img :src="basePath+'/images/finger-icon.png'" 
                          alt="pictire">
                        </span>
                      </a>
                        <a href="javascript:void(0)" @click="scrollToClass" class="d-block text-center text-white font-weight-bold mt-lg-3 mb-lg-2 mt-2 border-green mb-0 text_12 text_md_12 float-right float-md-none float-lg-none small_btn w-sm-100 book-video-btn bg-green book-rounded book-padding position-relative w-xs-48 text-10">Video Consultation
                          <span class="finger-icon video-cam-icon bg-blue d-inline-block position-absolute">
                            <!-- <img src="/images/video-cam-icon.svg"
                            alt="pictire"> -->
                            <i class="fas fa-video text_12" aria-hidden="true" style="margin-top:2px;">
                            </i>
                          </span>
                        </a>
                        <ShareNetwork
                          class="d-block text-center mt-lg-3 mt-3 mb-lg-2 mb-xl-0 mt-md-2 mb-md-2 mt-0 mb-0 text_12 font-weight-bold text-white text_md_12 float-right float-md-none float-lg-none small_btn w-sm-48 bg-blue book-padding book-rounded position-relative w-xs-100 book-border text-10"
                          network="facebook"
                          :url="APP_URL+'/doctors/'+user.location.slug+'/'+user.specialities[0].slug+'/'+user.slug"
                          hashtags="DoctorFindy"
                          title="facebook sharing"
                      >
                        Share Profile
                        <span class="finger-icon bg-blue d-inline-block position-absolute heart-icon pt-1 share-icon">
                          <i class="fa fa-share-alt" aria-hidden="true"></i>
                        </span>
                          </ShareNetwork>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Doctor Profile -->
    </div>
    <!-- <div class="container">
      <div class="row mt-4">
        <div class="col-12 mt-lg-0 mt-4 col-lg-8">
           <div class="w-100 d-inline-block">
             <h2 class="service-text font-weight-bold text_22">
               Book Appointment
             </h2>
           </div>
           <div class="w-100 d-inline-block hospiotal-btn mt-4 b-bottom pb-3">
             <a class="service-text rounded-pill service-border pt-2 pb-2 pl-4 pr-4 text_14 mr-3 d-inline-block" 
             href="javascript:void(0)">
               Chughtai Hospital - Lalak Chowk (DHA)
             </a>
              <a class="service-text rounded-pill mr-3 pt-2 pb-2 pl-4 pr-4 bg-green text-white text_14 d-inline-block" href="javascript:void(0)">
               Farooq Hospital (DHA)
             </a>
              <a class="service-text rounded-pill pt-2 pb-2 pl-4 pr-4 text_14 service-border d-inline-block" 
             href="javascript:void(0)">
               Video Consultation
             </a>
           </div>
           <div class="row mt-2">
             <div class="col-12 mt-lg-0 mt-4 col-lg-9">
               <div class="w-100 d-inline-block">
                 <h2 class="service-text text_16 
                 font-weight-bold">
                   11 April 2023
                 </h2>
                 <p class="text-black text_15">
                   Monday
                 </p>
               </div>
             </div>
             <div class="col-12 mt-lg-0 mt-4 col-lg-3">
              <form>
                <div class="w-100 d-inline-block profile-date form-group">
                   <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
              </form>
             </div>
           </div>
          <div class="row">
            <div class="col-12">
              <div class="doctor-profile-slider w-100 
          d-inline-block position-relative p-2">
              <VueSlickCarousel v-bind="c2Setting">
                <div v-for="(slot, index) in slots" :key="index">
                  <div class="mr-2">
                        <div class="w-100 d-inline-block book-date-slot text-center book-rounded"
                          :class="{ active2: active2SlotIndex === index }"
                          @click="setActive2Slot(index)">
                          <a href="javascript:void(0)">
                            <p class="text_black font-weight-bold text_13 mb-0">
                            {{ slot.day }}</p>
                            <p class="text_12 slot-text mb-0">
                            {{ slot.date }}</p>
                          </a>
                        </div>
                  </div>
                </div>
              </VueSlickCarousel>
          </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-12">
              <div class="w-100 d-inline-block">
                <h2 class="text_black text_16 font-weight-bold">
                  Select Time
                </h2>
                <p class="text_black text_14 mb-0">
                  3 Slots Available
                </p>
              </div>
              <div class="w-100 d-inline-block time-slot-picker mt-3 b-bottom pb-3">
                <div class="float-left d-inline-block mr-3 profile-time-slot">
                    <vue-timepicker 
                    id="time-pick"
                    format="HH:mm"
                    >
                    </vue-timepicker>
                </div>
                <div class="float-left d-inline-block mr-3 profile-time-slot slide-time-slot">
                    <vue-timepicker 
                    id="time-pick"
                    format="HH:mm"
                    >
                    </vue-timepicker>
                </div>
                <div class="float-left d-inline-block profile-time-slot">
                    <vue-timepicker 
                    id="time-pick"
                    format="HH:mm"
                    >
                    </vue-timepicker>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 mt-lg-0 mt-4 col-lg-4">
          <div class="w-100 d-inline-block appointment-summery-box bg-summery-box p-2">
            <p class="text-blue text_16 mb-0">
              Appointment Summary
            </p>
            <ul class="w-100 d-inline-block">
              <li class="border-fee mt-2 d-inline-block w-100 pb-2">
                <span class="text_black text_14 float-left">
                  Booking Fee
                </span>
                <span class="text_black text_14 float-right">
                  Rs : 3000
                </span>
              </li>
              <li class="border-fee mt-2 d-inline-block w-100 pb-2">
                <span class="text_black text_14 float-left">
                  Date
                </span>
                <span class="text_black text_14 float-right">
                  Thu, 30 April 2023
                </span>
              </li>
              <li class="border-fee mt-2 d-inline-block w-100 pb-2">
                <span class="text_black text_14 float-left">
                  Time
                </span>
                <span class="text_black text_14 float-right">
                  08 : 00 PM
                </span>
              </li>
              <li class="mt-2 d-inline-block w-100 pb-3">
                <span class="text_black text_14 float-left w-40">
                   Location
                </span>
                <span class="text_black text_14 float-right 
                w-60">
                  Avenue Mall Main Ghazi Road, DHA, Lahore, Punjab, Pakistan
                </span>
              </li>
              <li class="mt-2 d-inline-block w-100 text-center">
                <a class="text_14 font-weight-bold text-white book-rounded bg-red d-inline-block w-100 p-2 btn-proceed" 
                href="javascript:void(0)">
                  Proceed To Pay
                </a>
              </li>
          </ul>
          </div>
          <div class="number-btn float-right text-center mt-2">
            <a class="text-white bg-blue text_14 rounded-pill d-inline-block" href="javascript:void(0)">
              <span class="main-dot rounded-pill d-inline-block mr-2">
                <span class="dot bg-white d-inline-block rounded-pill"></span>
              </span>
              <span>Call For Assistant</span>
            </a>
          </div>
        </div>
      </div>
    </div> -->
  </div>
</template>

<script>
import VueTimepicker from 'vue2-timepicker'
import 'vue2-timepicker/dist/VueTimepicker.css'
// import VueSlickCarousel from 'vue-slick-carousel'
// import 'vue-slick-carousel/dist/vue-slick-carousel.css'
// import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
import VueSocialSharing from 'vue-social-sharing'
import VTooltip from 'v-tooltip'

Vue.use(VueSocialSharing)
export default {
  components: {VTooltip},
  // components: {VTooltip,VueSlickCarousel,VueTimepicker},
  name: "DoctorTabComponent",
  props: ['user', 'patient','fee', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      isSticky: false,
      prevScrollPos: window.pageYOffset,
      isActive: {
        specialties:true,
        disease: false,
        fAQs: false,
        reviews: false,
      },
      yourTimeValue: {
        HH: '10',
        mm: '05',
        ss: '00'
      },
      // slots: [
      //   { day: "MON", date: "11 April 2023" },
      //   { day: "TUE", date: "12 April 2023" },
      //   { day: "WED", date: "13 April 2023" },
      //   { day: "THU", date: "14 April 2023" },
      //   { day: "FRI", date: "15 April 2023" },
      //   { day: "SAT", date: "16 April 2023" },
      //   { day: "SUN", date: "17 April 2023" },
      //   { day: "MON", date: "18 April 2023" }
      // ],
      // active2SlotIndex: 0,
      // c2Setting: {
      //      arrows: true,
      //      dots: false,
      //      slidesToShow:6,
      //      responsive: [
      //        {
      //          breakpoint: 1024,
      //          settings: {
      //            slidesToShow: 6,
      //            slidesToScroll: 1,
      //          }
      //        },
      //        {
      //          breakpoint: 600,
      //          settings: {
      //            slidesToShow: 6,
      //            slidesToScroll: 1,
      //            initialSlide: 2
      //          }
      //        },
      //        {
      //          breakpoint: 480,
      //          settings: {
      //            slidesToShow: 6,
      //            slidesToScroll: 1
      //          }
      //        }
      //      ]
      //    },
      loading: false,
      APP_URL: APP_URL,
      appointment_days: [],
      weekDays: moment.weekdaysShort().map(v => v.toLowerCase()),
      verified_message: 'Verified User',
      medical_message: 'Medical Registration Verified',
      environment: 0.0,
      checkupRating: 0.0,
      staffBehaviourRating: 0.0,
      saved_doctors: [],
      userRating: 0.0,
      education:'',
      reviewCount:6,
      minRating: 4.3,
      maxRating: 5,
      reviews:[],
    }
  },
  created () {
    
    this.education = JSON.parse(this.user.profile.educations)
    let self = this
    if (this.user.feedbacks.length > 0) {
      this.user.feedbacks.forEach(function(x) {
        let rating = JSON.parse(x.rating)
        self.environment += parseFloat(rating['environmentRating'])
        self.checkupRating += parseFloat(rating['checkupRating'])
        self.staffBehaviourRating += parseFloat(rating['staffBehaviourRating'])
      })
      self.environment = (self.environment / this.user.feedbacks.length )
      self.checkupRating = (self.checkupRating / this.user.feedbacks.length )
      self.staffBehaviourRating = (self.staffBehaviourRating / this.user.feedbacks.length )
    }
    else {

       const ratingEnviroment = (Math.random() * (this.maxRating - this.minRating) + this.minRating).toFixed(1);
       const ratingCheckup= (Math.random() * (this.maxRating - this.minRating) + this.minRating).toFixed(1);
       const ratingStaffBehaviourRating= (Math.random() * (this.maxRating - this.minRating) + this.minRating).toFixed(1);

       self.environment += parseFloat(ratingEnviroment);
       self.checkupRating += parseFloat(ratingCheckup);
       self.staffBehaviourRating += parseFloat(ratingStaffBehaviourRating);
        

    }
    if (this.patient.length === undefined && this.patient.profile.saved_doctors !== null) {
      this.saved_doctors = JSON.parse(this.patient.profile.saved_doctors)
    }
    else {
      this.saved_doctors = []
    }
  },
  mounted(){
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
   window.addEventListener('scroll', this.handleScroll);
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    scrolltodiv(){
      var element = document.getElementById('specialtie-section');
      // element.scrollIntoView({ behavior: 'smooth' });

      var headerOffset = 77;
      var elementPosition = element.getBoundingClientRect().top;
      var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
    
      window.scrollTo({
           top: offsetPosition,
           behavior: "smooth"
      });
    },
    scrolltodiv2(){
      var element = document.getElementById('disease-section');
      // element.scrollIntoView({ behavior: 'smooth' });
      var headerOffset = 77;
      var elementPosition = element.getBoundingClientRect().top;
      var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
    
      window.scrollTo({
           top: offsetPosition,
           behavior: "smooth"
      });
    },
    scrolltodiv3(){
      var element = document.getElementById('profileDetialFAQ');
      // element.scrollIntoView({ behavior: 'smooth' });
      var headerOffset = 77;
      var elementPosition = element.getBoundingClientRect().top;
      var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
    
      window.scrollTo({
           top: offsetPosition,
           behavior: "smooth"
      });
    },
    scrolltodiv4(){
      var element = document.getElementById('reviews_section');
      // element.scrollIntoView({ behavior: 'smooth' });
      var headerOffset = 77;
      var elementPosition = element.getBoundingClientRect().top;
      var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
    
      window.scrollTo({
           top: offsetPosition,
           behavior: "smooth"
      });
    },
    handleScroll() {
      const currentScrollPos = window.pageYOffset;

      if (currentScrollPos > 360 && currentScrollPos) {
        this.isSticky = true;
      } else {
        this.isSticky = false;
      }

    },
    activate(name) {
      const prevActive = Object.keys(this.isActive).find(key => this.isActive[key]);
      if (prevActive) {
        this.isActive[prevActive] = false;
      }
      this.isActive[name] = true;
    },
    setActive2Slot(index) {
      this.active2SlotIndex = index;
    },
    feesRange(fee) {
          let fees = JSON.parse(fee)
          return fees['from_fees'] + ' - ' + fees['to_fees']
    },
    averageWaitingTime(feedbacks) {
      let waiting = 0
      if (feedbacks.length > 0) {
        feedbacks.forEach(function (feedback){
          waiting += parseInt(feedback.waiting_time)
        })
        waiting = waiting/feedbacks.length
        return waiting
      }
      else {
        return '0'
      }

    },
    scrollToClass() {
      let self = this
      self.loading = true
      let el = document.querySelector('.shedule_calendar')
      let rect = el.getBoundingClientRect()
      window.scrollTo(rect.left, rect.top)
      self.loading = false
    },
    wishlist: function (id, savedDoc, column) {
      let self = this;
      self.loading = false
      if (self.patient.length === 0) {
        Vue.toasted.show('Login to wishlist', { duration: 3000 })
        return
      }
      let form_errors = [];
      if (self.saved_doctors == null) {
        axios.post(APP_URL + '/user/add-wishlist', {
          id: id,
          column: column,
        }).then(function (response) {
          if (response.data.authentication === true) {
            if (response.data.type === 'success') {
              if (column === 'saved_doctors') {
                self.saved_doctors.push(id);
                self.loading = false
                Vue.toasted.success( response.data.message , { duration: 3000 })
              }
              else if (column === 'saved_hospitals') {
              }
              else if (column === 'saved_articles') {
                self.article_likes = response.data.likes;
                self.show_likes = true;
              }
            } else {
              self.loading = false
              Vue.toasted.error( response.data.message, { duration: 3000 })
            }
          } else {
            self.loading = false
            Vue.toasted.error( response.data.message , { duration: 3000 })
          }
        }).catch(function (error) {
          self.loading = false
          Vue.toasted.error(error, { duration: 3000 })
        });
      }
      else if (self.saved_doctors.includes(id) === true) {
        axios.post(APP_URL + '/user/remove-wishlist', {
          id: id,
          column: column,
        }).then(function (response) {
          if (response.data.authentication === true) {
            if (response.data.type === 'success') {
              if (column === 'saved_doctors') {
                self.saved_doctors.pop(id);
                self.loading = false
                Vue.toasted.success(response.data.message, { duration: 3000 })
              }
            }
          }
        })
      }
      else if (self.saved_doctors.includes(id) === false) {
        axios.post(APP_URL + '/user/add-wishlist', {
          id: id,
          column: column,
        }).then(function (response) {
          if (response.data.authentication === true) {
            if (response.data.type === 'success') {
              if (column === 'saved_doctors') {
                self.saved_doctors.push(id);
                self.loading = false
                Vue.toasted.success(response.data.message, { duration: 3000 })
              }
              else if (column === 'saved_hospitals') {
              }
              else if (column === 'saved_articles') {
                self.article_likes = response.data.likes;
                self.show_likes = true;
              }
            } else {
              self.loading = false
              Vue.toasted.error(response.data.message, { duration: 3000 })
            }
          } else {

          }
        }).catch(function (error) {
          self.loading = false
          Vue.toasted.error(error, { duration: 3000 })
        });
      }
    },
    averageRating(value) {
      let avgRating = 0.0
      if (value.length > 0) {
        value.forEach(function (feedback){
          avgRating += parseFloat(JSON.parse(feedback.avg_rating))
        })
        this.userRating = parseFloat((avgRating/value.length).toFixed(1))
      }
      else {
        this.userRating = 0;
       //  for (let i = 0; i < this.reviewCount; i++) {
       //      const rating = (Math.random() * (this.maxRating - this.minRating) + this.minRating).toFixed(1);
       //      this.reviews.push({ rating: parseFloat(rating) });
       //    }
       //   this.reviews.forEach(function (feedback){
       //    avgRating += parseFloat(JSON.parse(feedback.rating))
       //  })

       // this.userRating = parseFloat((avgRating/this.reviews.length).toFixed(1))

      }
    },
  }
}
</script>

<style>
.tooltip {
  display: block !important;
  z-index: 10000;
}

.tooltip .tooltip-inner {
  background: #00A2E8;
  color: white;
  border-radius: 4px;
  padding: 5px 10px 4px;
}

.tooltip .tooltip-arrow {
  width: 0;
  height: 0;
  border-style: solid;
  position: absolute;
  margin: 5px;
  border-color: #00A2E8;
  z-index: 1;
}

.tooltip[x-placement^="top"] {
  margin-bottom: 5px;
}

.tooltip[x-placement^="top"] .tooltip-arrow {
  border-width: 5px 5px 0 5px;
  border-left-color: transparent !important;
  border-right-color: transparent !important;
  border-bottom-color: transparent !important;
  bottom: -5px;
  left: calc(50% - 5px);
  margin-top: 0;
  margin-bottom: 0;
}

.tooltip[x-placement^="bottom"] {
  margin-top: 5px;
}

.tooltip[x-placement^="bottom"] .tooltip-arrow {
  border-width: 0 5px 5px 5px;
  border-left-color: transparent !important;
  border-right-color: transparent !important;
  border-top-color: transparent !important;
  top: -5px;
  left: calc(50% - 5px);
  margin-top: 0;
  margin-bottom: 0;
}

.tooltip[x-placement^="right"] {
  margin-left: 5px;
}

.tooltip[x-placement^="right"] .tooltip-arrow {
  border-width: 5px 5px 5px 0;
  border-left-color: transparent !important;
  border-top-color: transparent !important;
  border-bottom-color: transparent !important;
  left: -5px;
  top: calc(50% - 5px);
  margin-left: 0;
  margin-right: 0;
}

.tooltip[x-placement^="left"] {
  margin-right: 5px;
}

.tooltip[x-placement^="left"] .tooltip-arrow {
  border-width: 5px 0 5px 5px;
  border-top-color: transparent !important;
  border-right-color: transparent !important;
  border-bottom-color: transparent !important;
  right: -5px;
  top: calc(50% - 5px);
  margin-left: 0;
  margin-right: 0;
}

.tooltip.popover .popover-inner {
  background: #f9f9f9;
  color: black;
  padding: 24px;
  border-radius: 5px;
}

.tooltip.popover .popover-arrow {
  border-color: #f9f9f9;
}

.tooltip[aria-hidden='true'] {
  visibility: hidden;
  opacity: 0;
  transition: opacity .15s, visibility .15s;
}

.tooltip[aria-hidden='false'] {
  visibility: visible;
  opacity: 1;
  transition: opacity .15s;
}

.comma:first-child:empty ~ .comma:not(:empty) {
  margin-left: 0;  
}

.comma:first-child:empty ~ .comma:not(:empty) ~ .comma:not(:empty) {
  margin-left: -.3em;  
}

.comma:empty {
  display: none;
}

.comma:not(:first-child):before {
  content: ", ";
}

.comma:empty + .comma:not(:empty):before {
  content : "";
}

.comma:not(:empty) ~ .comma:empty + .comma:not(:empty):before {
  content : ", ";
}
</style>