<template>
  <div>
    <div v-for="(user, index) in usersData">
    <div class="row bg-white box_radius mt-0 mt-lg-4 mt-md-4 mb-4 box_shadow pb-xl-0 pb-4">
      <div class="col-12 cstm_border_right ">
        <div class="row">
      <div class="col-lg-8 col-md-8 col-12">
        <div class="doctor_profile_left pt-3">
          <div class="pr-xs-0 pr-sm-0 pr-md-0 pr-lg-0 d-flex">
                <div class="user_imgSec doctor_image position-relative float-left mr-1">
                  <div class="position-relative mb-0">
                    <a v-if="user.location != null" :href="'/doctors/'+user.location.slug+'/'+user.specialities[0].slug+'/'+user.slug">

                      <v-lazy-image v-if="user.profile && user.profile.avatar" :src="basePath+'/uploads/users/'+user.id+'/small-'+user.profile.avatar" :alt=" user.first_name + ' ' + user.last_name " :name=" user.first_name + ' ' + user.last_name " class="img-fluid rounded-circle h_90 w_90px w_md_60px h_md_60 w-xs-40px h-xs-40px"/>
                      <v-lazy-image v-else :src="basePath+'/uploads/users/default/doctor.svg'"  :name=" user.first_name + ' ' + user.last_name " class="img-fluid rounded-circle h_90 w_90px w_md_60px h_md_60 h-xs-40px"/>
                    </a>
                    <a v-else :href="'/doctors/lahore/'+user.specialities[0].slug+'/'+user.slug">
                      <v-lazy-image v-if="user.profile && user.profile.avatar" :src="basePath+'/uploads/users/'+user.id+'/small-'+user.profile.avatar" :alt=" user.first_name + ' ' + user.last_name " :name=" user.first_name + ' ' + user.last_name " class="img-fluid rounded-circle h_90 w_90px w_md_60px h_md_60 h-xs-40px"/>
                      <v-lazy-image v-else :src="basePath+'/uploads/users/default/doctor.svg'" :alt=" user.first_name + ' ' + user.last_name " :name=" user.first_name + ' ' + user.last_name " class="img-fluid rounded-circle h_90 w_90px w_md_60px h_md_60 h-xs-40px"/>
                    </a>
                    <a v-if="userVideoWilling(user) === 'on'" href="#" class="position-absolute d-table video_icon">
                      <p class="w_25px h_25 rounded-circle text-center d-table-cell align-middle text-white video-circle w-xs-20px h-xs-20px">
                        <i  class="fas fa-video text_12" aria-hidden="true"></i>
                      </p>
                    </a>
                  </div>
                  <div class="total_rating w-80 m-auto 
                  w-md-100">
                    <span class="theme-color-text">
                      <star-rating
                        class="w-15 float-left m-0 vue-star-rating mt-1 w-xs-45"
                          :max-rating="1"
                          :show-rating="false"
                          v-model="rating"
                          :increment="rating"
                          :rating="rating"
                          inactive-color="#cccccc"
                          active-color="#088F8F"
                          v-bind:star-size="14"
                      ></star-rating>
                      <!--                <i class="fa fa-star" aria-hidden="true"></i> -->
                        <span class=" float-left text-center mr-1 ml-1 text-blue">{{ userRating(user) }}
                        </span>
                        <span class="d-inline-block text-blue"> 
                        ({{ user.feedbacks.length }})</span>
                      </span>
                  </div>
                  <!-- <div class="Satisfy_percentage ml-3 d-none d-lg-block d-md-block ml-md-0 ml-lg-3">
                    <a class="badge bg-blue text-white text_12 font-weight-normal" href="javascript:void(0)">
                      <i class="fa fa-thumbs-up"></i>
                      <span v-if="user.profile == [] || user.profile == '' || user.profile == null ||  user.profile.votes === 'null' || user.profile.votes === '' || user.profile.votes === null || user.profile.votes === 0">
                        0%</span>
                        <span v-else>
                          {{ (user.profile.votes / user.feedbacks.length * 100).toFixed(0) }}%
                        </span>
                    </a>
                    <span class="text_10 d-none">Satisfied patients</span>
                  </div> -->
                </div>
                
                <!-- w-sm-80 w-md-75 w-xs-70 w-80 -->
                <div class="profile_inner prfile_detail float-left float-lg-none overflow-hidden">
                  <div class="doctor_name float-left float-lg-none w-100">
                    <a v-if="user.location != null" :href="'/doctors/'+user.location.slug+'/'+user.specialities[0].slug+'/'+user.slug" class="d-inline-block w-85">
                      <h2 class="d-inline-block text_md_13 mb-0">
                        <span class="float-left doctor-name">
                          {{user.first_name }} {{ user.last_name }}
                        </span>
                        <span class="ml-xl-2">
                        <v-lazy-image v-if="user.profile && user.profile.verify_registration" :src="basePath+'/images/check.png'" v-tooltip="verified_message" alt="Check" class="img-fluid"/>
                      </span>
                        <span class="float-left mt-1 ml-xl-2">
                          <span class="ml-lg-0 float-left">
                        <img class="tick-image" 
                        :src="basePath+'/images/tick-image.png'" 
                        alt="pictire">
                      </span>
                        <span class="float-left ml-2">
                          <v-lazy-image v-if="user.profile && user.profile.verify_medical !== ''" :src="basePath+'/images/shield.png'" v-tooltip="medical_message" alt="Shield" 
                        class="img-fluid image-sheild"/>
                        </span>
                      </span>
                      <span class="float-left ml-4">
                        <a href="javascript:void(0)" class="wishlist_icon" @click="wishlist(user.id, '', 'saved_doctors')">
                        <i v-bind:style=" saved_doctors.includes(user.id) ? 'color: #ff465c !important;' : 'color: #BCBCBC;' " class="fa fa-heart text_md_20 text_20 text-xs-14"></i>
                      </a>
                      </span>
                      </h2>
                    </a>
                    <a v-else :href="'/doctors/lahore/'+user.specialities[0].slug+'/'+user.slug" class="d-inline-block w-80">
                      <h2 class="d-inline-block text_md_13">
                        <span class="float-left">
                          {{user.first_name }} {{ user.last_name }}
                        </span>
                        <span class="ml-xl-2">
                        <v-lazy-image v-if="user.profile.verify_registration" :src="basePath+'/images/check.png'" v-tooltip="verified_message" alt="Check" class="img-fluid"/>
                      </span>
                      <span class="ml-xl-2 float-left mt-1">
                        <img class="tick-image" 
                        :src="basePath+'/images/tick-image.png'" 
                        alt="pictire">
                      </span>
                        <span class="float-left ml-2 mt-1">
                        <v-lazy-image v-if="user.profile.verify_medical !== '' " :src="basePath+'/images/shield.png'" v-tooltip="medical_message" alt="Shield" 
                        class="img-fluid image-sheild"/>
                      </span>
                      <span class="float-left ml-4">
                        <a href="javascript:void(0)" class="wishlist_icon" @click="wishlist(user.id, '', 'saved_doctors')">
                        <i v-bind:style=" saved_doctors.includes(user.id) ? 'color: #ff465c !important;' : 'color: #BCBCBC;' " class="fa fa-heart text_md_20 text_20 text-xs-14"></i>
                      </a>
                      </span>
                      </h2>
                    </a>
                  </div>
                  <div class="doctor_degree text_black d-inline-block text_14 w-100">
                    <p class="text_12 text-truncate w-100 text-red font-weight-bold">
                    <span v-for="(spec, index) in user.specialities" v-if="spec.title == speciality.title" class="comma"> {{ spec.title }}</span>
                    <span v-else class="comma">{{ spec.title }}</span>
                    </p>
                    <p class="text_12 text-truncate w-100" v-if="userEducation(user) !== ''">
                      <span v-for="(edu, index) in userEducation(user)" class="comma"> {{edu.degree_title}}
                      </span>
                    </p>
                    <p class="text-blue text_12 mb-0 d-lg-none d-block">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                      <span class="ml-2">Slots Not Available</span>
                    </p>
                    <p class="text_13 d-lg-block d-none d-lg-block d-md-block"><span v-if="user.profile && user.profile.sub_heading">{{ user.profile.sub_heading }}</span><span v-else>
                    </span></p>
                    <!-- <p class="text_14 text_md_13 d-xs-none d-sm-none d-md-none d-lg-block">{{ user.profile.address }}</p> -->
                    <ul class="doctor_fee_details d-lg-inline-block d-md-inline-block w-100 mt-1 d-none">
                      <li class="float-left w-18 pr-2 pr-md-0 text_12" v-if="docFee(user)!= 0" >
                        <span class="small_img">
                          <v-lazy-image :src="basePath+'/images/rs.svg'" :alt=" user.first_name + ' ' + user.last_name " :name=" user.first_name + ' ' + user.last_name " class="img-fluid rs-image"/>
                        </span>
                        <span class="text-blue text_12 font-weight-bold">Rs</span>
                        <span class="text_12 font-weight-bold">
                         {{docFeeRange(user)}}
                       </span>
                      </li>
                      <li class="float-left w-30 mr-2 ml-2 text-center text_12" v-if="user.profile && user.profile.total_experience && user.profile.total_experience != ''">
                        <span class="small_img text-left">
                          <v-lazy-image :src="basePath+'/images/experience.svg'" :alt=" user.first_name + ' ' + user.last_name " :name=" user.first_name + ' ' + user.last_name " class="img-fluid experience-image"/>
                        </span>
                        <span class="text-blue text_12 font-weight-bold">
                          {{ user.profile.total_experience }} Years
                        </span>
                        <span class="text_12 font-weight-bold" 
                        v-if="user.profile.total_experience.length < 10"> Experience</span>
                      </li>
                      <li class="float-left w-35 text_12 text-center" v-if="user.profile.wait_time && user.profile.wait_time != ''">
                        <span class="wait_icon text-left pl-3">
                          <!-- <i class="fa fa-hourglass" aria-hidden="true"></i> -->
                          <img class="wait-icon" :src="basePath+'/images/wait-icon.svg'" 
                          alt="picture">
                        </span>
                        <span class="text-blue text_12 font-weight-bold">Wait Time</span>
                        <span class="text_12 font-weight-bold"> ({{ user.profile.wait_time }} Min)</span>
                      </li>
                    </ul>
                    <!-- <div class="Satisfy_percentage">
                      <p class="badge knockdoc_sign_up_bg text-white text_13 d-none d-lg-inline-block">
                        <i class="fa fa-thumbs-up"></i>
                         <span v-if="user.profile.votes === 'null' || user.profile.votes === '' || user.profile.votes === null || user.profile.votes === 0">
                        0%</span>
                        <span v-else>
                          {{ (user.profile.votes / user.feedbacks.length * 100).toFixed(0) }}%
                        </span>
                      </p>
                      <span class="d-none d-lg-inline-block">Satisfied patients</span>
                    </div> -->
                  </div>
                </div>
          </div>
          <!-- <div v-if="user.doc_teams.length > 0">

            <div class="row mt-3" >
            <div class="col-lg-6 col-12 col-sm-6 col-md-6" v-for="(docteam,index) in user.doc_teams">

              <div class="hospital-main w-100 d-inline-block p-2 position-relative border border-dark">
                 <div class="row">
                    <div class="col-3">
                       <div class="hospital-image w-100 d-inline-block">
                          <v-lazy-image v-if="docteam.hospital.profile.avatar !== null" :src="'/uploads/allusers/'+docteam.hospital.id+'/small-'+docteam.hospital.profile.avatar" :alt=" docteam.hospital.first_name + ' ' + docteam.hospital.last_name " :name=" docteam.hospital.first_name + ' ' + docteam.hospital.last_name"/>
                          <v-lazy-image v-else :src="'/uploads/users/default/hospital.svg'" alt="Video Consultation Icon" class="img-fluid h_50 h_md_40 w_50px w_md_40px rounded-circle border_transparent float-left"/>
                       </div>
                    </div>
                    <div class="col-9">
                       <div class="hospital-detail w-100 d-inline-block">
                          <a class="text-gold font-weight-bold theme-color-text" href="javascript:void(0)">{{docteam.hospital.first_name + ' ' + docteam.hospital.last_name }}</a>
                          <p class="text-fee mb-0 text_12" v-if="docteam.hospital.profile.address != ''">{{docteam.hospital.profile.address }}</p>
                           <p class="text-fee mb-0 text_12" v-else>Not Available</p>
                       </div>
                    </div>
                 </div>
              </div>
              <a class="circle_anchor position-absolute" href="javascript:void(0)"></a>
            </div>
             
         </div>
            
          </div> -->
          
        </div>
      </div>

      <!-- <div class="col-lg-4 col-md-4 col-12">
        <div class="doctor_profile_right mt-2 mt-md-3">
          <div class="mobile_view_fee mt-0 mb-2 d-block d-md-none d-lg-none">
            <div class="row">
              <div class="col-4 pr-0">
                <div class="doctor-experience text_md_13 text-center">
                  <span><v-lazy-image src="/images/experience.png" alt="Dr Maryam Tariq" name="Dr Maryam Tariq" class="img-fluid mr-2 d-lg-block"/> <span class="theme-color-text">
                    {{ user.profile.total_experience }}
                  </span>
                  <span class="d-block d-lg-block mt-1">Experience</span>
                </span>
                </div>
              </div>
              <div class="col-4 pr-0">
                <div class="doctor-fee text_md_13 text-center">
                  <span class="d-block"><v-lazy-image src="/images/rs.png" alt="Dr Maryam Tariq" name="Dr Maryam Tariq" class="img-fluid mr-2 d-lg-block"/> <span class="theme-color-text"></span> 

                  <span class="mt-1 d-block">
                    <span >
                         {{docFee(user)}}
                       </span>
                       
                   </span>
                </span>
                </div>
              </div>
              <div class="col-4">
                <div class="waitng_time d-inline-block text-center text_md_13 w-100"><i class="fa fa-hourglass theme-color-text wait_icon mr-2" aria-hidden="true"></i><span class="theme-color-text">Wait Time</span> <span class=" mt-1 d-block">  ({{ user.profile.wait_time }}) </span>
                 <a href="javascript:void(0)"></a>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12"> -->
              <!-- <div class="mobile_design mt-0 mb-2 d-block d-md-none d-lg-none">
                <p class="text_14 mobile_review">{{ user.profile.sub_heading }}</p> -->
                <!-- <p class="text_14 mt-2 mb-2 text_md_13">{{ user.profile.address }}</p> -->
              <!-- </div> -->
              <!--  <div class="listing_availability theme-green-text text_14 text_md_12 mb-1 text-center text_md_left text-lg-left d-none d-lg-inline-block d-md-inline-block w-100" v-if="user.doc_teams[0] ">
                <span class="availability_shedule mb-1 d-lg-block d-inline-block text-center text_12">
                  <i v-if="user.doc_teams[0] && user.doc_teams[0].slots " class="fa fa-calendar mr-2 text-blue" aria-hidden="true"></i>
                  <span class="text_black">
                    {{ checkAvailability(user) }}
                  </span>
                </span>
                <span class="text_black text-center d-lg-block ml-lg-5 text_12">
                  <p style="margin:0px;" class="font-weight-bold text_13">{{availableDayString(user)}}
                  </p>
                </span>
              </div> -->
              <!-- <div class="listing_availability theme-green-text text_14 text_md_12 mb-1 text-center text_md_left text-lg-left d-none d-lg-inline-block d-md-inline-block w-100" v-if="user.doc_teams[1] ">
                <span class="availability_shedule mb-1 d-lg-block d-inline-block text-center text_12">
                  <i class="fa fa-calendar mr-2 text-blue" aria-hidden="true"></i>
                  <span class="text_black">
                    {{ checkAvailabilitySecondTeam(user) }}
                  </span>
                </span>
                <span class="text_black text-center d-lg-block ml-lg-5 text_12">
                  <p style="margin:0px;" class="font-weight-bold text_13">{{availableDayStringSecondTeam(user)}}
                  </p>
                </span>
              </div> -->
              <!-- <div class="mobile_design mb-3 d-inline-block d-lg-none d-md-none w-100"> -->
                <!-- <div class="float-left">
                  <div class="Satisfy_percentage mt-1 d-block d-lg-none">
                    <span class="badge bg-blue text-white text_14 font-weight-normal">
                      <i class="fa fa-thumbs-up"></i>
                      <span v-if="user.profile.votes === 'null' || user.profile.votes === '' || user.profile.votes === null || user.profile.votes === 0">
                        0%</span>
                        <span v-else>
                          {{ (user.profile.votes / user.feedbacks.length * 100).toFixed(0) }}%
                        </span>
                    </span>
                  </div>
                </div> -->
                <!-- <span v-if="user.doc_teams.length >= 1 ">
                <div class="float-lg-right text-lg-right w-xs-100 d-xs-inline-block mt-xl-0 mt-2">
                  <span class="text_black text-xl-center d-lg-block float-xl-right float-lg-none">
                    <p style=";margin:0px;" class="font-weight-bold">{{availableDayString(user)}}
                  </p>
                  </span>
                </div>
                <div class="mobile_availability d-inline-block d-lg-none w-100 mt-2 theme-green-text">
                  <span class="availability_shedule mt-2 mb-2 d-lg-block ml-lg-5">
                    <i class="fa fa-calendar mr-2" aria-hidden="true"></i>
                  {{ checkAvailability(user) }}
                  </span>
                </div>
                </span> -->
                <!-- <span v-if="user.doc_teams[1]">
                <div class="float-right text-right w-xs-100 d-xs-inline-block">
                  <span class="text_black text-center d-lg-block float-right float-lg-none">
                    <p style="margin:0px;" class="font-weight-bold">{{availableDayStringSecondTeam(user)}}
                  </p>
                  </span>
                </div>
                <div class="mobile_availability d-inline-block d-lg-none w-100 mt-2 theme-green-text">
                  <span class="availability_shedule mt-2 mb-2 d-lg-block ml-lg-5">
                    <i class="fa fa-calendar mr-2" aria-hidden="true"></i>
                  {{ checkAvailabilitySecondTeam(user) }}
                  </span>
                </div>
                </span> -->
              <!-- </div> --> 
            <!-- </div>
          </div>
        </div>
      </div> -->
      <div class="col-lg-4 col-12 mt-xl-5 mt-2 col-md-4 d-lg-block d-md-block d-none">
        <div class="list_btns w-80 m-auto w-xs-100 w-sm-100 w-md-100 d-block pb-2 pl-xl-5 mt-lg-0 mt-3" 
        v-if="user.roles[0].name === 'doctor'">
                <a href="javascript:void(0)" @click="$parent.showModal(user, 'visit')" class="d-md-block font-weight-bold text-center text-blue text_12 text-xs-10 float-left float-md-left small_btn w-sm-30 w-80 book-btn book-rounded book-padding book-border position-relative w-md-100 w-xs-48" data-toggle="modal" data-target="#modal_patient_num">Book Appointment
                  <span class="finger-icon bg-blue d-inline-block position-absolute">
                    <img :src="basePath+'/images/finger-icon.png'" 
                    alt="pictire">
                  </span>
                </a>
                <!-- <a v-if="user.location != null" :href="'/doctors/'+user.location.slug+'/'+user.specialities[0].slug+'/'+user.slug" class="d-block text-center mt-lg-3 mb-lg-2 mt-md-0 mt-sm-0 mb-md-2 mt-0 mb-0 text_12 font-weight-bold text-white text_md_12 float-right float-md-left float-lg-left small_btn w-sm-33 bg-blue book-padding book-rounded position-relative book-border w-md-30 ml-0 ml-md-3 ml-sm-3 float-sm-left w-xs-48 ml-lg-0 w-ipad-100 w-80">View Profile 
                  <span class="finger-icon bg-blue d-inline-block position-absolute heart-icon pt-1">
                    <i class="fa fa-heart" aria-hidden="true">
                    </i>
                  </span>
                </a> -->
                <!-- <a :href="'/doctors/lahore/'+user.specialities[0].slug+'/'+user.slug" class="d-block text-center text_12 font-weight-bold mt-lg-3 text-white text_md_12 float-right float-md-left float-lg-left small_btn w-sm-48 bg-blue book-padding book-rounded position-relative book-border w-md-30 ml-0 ml-md-3 w-xs-48 ml-lg-0 w-ipad-100 w-80">View Profile 
                  <span class="finger-icon heart-icon bg-blue d-inline-block position-absolute pt-1">
                    <i class="fa fa-heart" aria-hidden="true">
                    </i>
                  </span>
                </a> -->
                <a href="javascript:void(0)" v-if="userVideoWilling(user) === 'on'" @click="$parent.showModal(user, 'online')" data-target="#modal_patient_num" data-toggle="modal" class="d-block text-center text-white font-weight-bold mt-lg-3 mb-lg-2 mt-md-0 mt-sm-0 mb-0 text_12 text-xs-10 float-right float-md-left float-sm-left float-lg-left small_btn w-sm-30 book-video-btn bg-green book-rounded book-padding position-relative w-md-100 ml-0 ml-md-0 mt-md-3 border-green ml-sm-3 w-xs-48 ml-lg-0 w-80">Video Consultation
                  <span class="finger-icon video-cam-icon bg-blue d-inline-block position-absolute">
                    <!-- <img src="/images/video-cam-icon.svg" 
                    alt="pictire"> -->
                    <i class="fas fa-video text_12" aria-hidden="true" style="margin-right:1px;">
                    </i>
                  </span>
                </a>
              </div>
              <!-- <div class="list_btns w-100 d-inline-block mt-lg-0 mt-3" v-else>
                <a target="_blank"
                   :href="'https://maps.google.com/?q='+user.profile.latitude+'+'+user.profile.longitude"
                   class="d-block text-center text_md_12 float-xs-left float-sm-left float-md-left float-lg-left text_12 text-white font-weight-bold small_btn w_md_100 mt-xs-3 mt-sm-3 mt-md-0 mt-sm-0 mt-lg-3 bg-blue book-padding book-rounded book-border w-md-30 ml-0 ml-md-3 ml-sm-3 w-sm-30 w-xs-48 ml-lg-0 w-ipad-100 w-80">Direction
                 </a>
                <a href="javascript:void(0)" class="d-block text-center text-white mt-lg-3 mb-lg-2 mt-0 mb-0 text_12 font-weight-bold text_md_12 float-right float-lg-left bg-blue book-padding book-rounded position-relative book-border w-md-30 ml-0 ml-md-3 ml-sm-3 w-sm-30 mt-sm-0 w-xs-48 ml-lg-0 w-ipad-100 w-80">View Profile
                  <span class="finger-icon bg-blue d-inline-block position-absolute heart-icon pt-1">
                    <i class="fa fa-heart" aria-hidden="true">
                    </i>
                  </span>
                </a>
              </div> -->
      </div>
    </div>
    <div class="row d-block d-lg-none d-md-none mt-3">
      <div class="col-12">
        <ul class="doctor_fee_details d-inline-block w-100 mt-1 mb-0">
          <li class="float-left w-18 pr-2 pr-md-0 text_11 text-9 w-xs-25" v-if="docFee(user)!= 0" >
            <div class="small_img text-center mb-2">
              <v-lazy-image :src="basePath+'/images/rs.svg'" :alt=" user.first_name + ' ' + user.last_name " :name=" user.first_name + ' ' + user.last_name " class="img-fluid rs-image"/>
            </div>
            <span class="text-blue text_11 text-9 
            font-weight-bold">Rs
            </span>
            <span class="text_11 text-9 font-weight-bold">
             {{docFeeRange(user)}}
           </span>
          </li>
          <li class="float-left w-35 mr-1 ml-1 text-center 
          text_11 text-9" v-if="user.profile && user.profile.total_experience && user.profile.total_experience != ''">
            <div class="small_img text-left pl-0 text-center mb-2">
              <v-lazy-image :src="basePath+'/images/experience.svg'" :alt=" user.first_name + ' ' + user.last_name " :name=" user.first_name + ' ' + user.last_name " class="img-fluid experience-image"/>
            </div>
            <span class="text-blue text_11 text-9 
            font-weight-bold">
              {{ user.profile.total_experience }} Years
            </span>
            <span class="text_11 font-weight-bold text-9" 
            v-if="user.profile.total_experience.length < 10"> Experience
          </span>
          </li>
          <li class="float-left w-43 text_11 text-center text-9 w-xs-35" v-if="user.profile.wait_time && user.profile.wait_time != ''">
            <p class="wait_icon text-left pl-0 text-center mb-2">
              <!-- <i class="fa fa-hourglass" aria-hidden="true"></i> -->
              <img class="wait-icon" :src="basePath+'/images/wait-icon.svg'" 
              alt="picture">
            </p>
            <span class="text-blue text_11 font-weight-bold text-9">Wait Time</span>
            <span class="text_11 font-weight-bold text-9"> ({{ user.profile.wait_time }} Min)</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 col-md-12 col-12">
        <!-- <div class="w-100 d-inline-block patient-box pt-2 pb-2 pl-3 pr-3 mt-lg-3 mt-1">
          <p class="text_14 text-box">"I recommend the doctor Patient friendly environment, the Doctor was very professional , listen attentively and ask questions.
          </p>
        </div>
        <div class="d-inline-block circle-box">
          <span class="patient-box d-inline-block"></span>
        </div> -->
        <div class="w-100 d-inline-block hospitalFor_doctors pb-2" v-if="user.doc_teams.length > 0">
                    <VueSlickCarousel v-bind="c1Setting">
                      <div v-if="userVideoWilling(user) === 'on'" class="w-90 d-block m-auto">
                        <div class="video-call-box w-100 d-inline-block book-rounded p-2 mt-2">
                        <div class="w-10 float-left video-icon">
                          <a href="javascript:void(0)">
                            <img :src="basePath+'/images/video-group-image.png'" alt="pictire">
                          </a>
                        </div>
                        <div class="w-85 float-left video-detail ml-2">
                          <p class="text_black text_12 mb-0 font-weight-bold">
                            Video Consultation
                          </p>
                          <p class="text_black text_12 mb-0 mt-1 text-xs-11">
                            {{availableDayStringOnline(user)}}
                          </p>
                          <p class="text-red text_12 mb-0 font-weight-bold mt-1">
                              {{checkAvailabilityOnline(user)}}
                            <span class="float-right text_black">
                              <span class="text-blue">
                                Rs:
                              </span>
                               {{user.onlines[0].price}}
                            </span>
                          </p>
                        </div>
                      </div>
                      <a class="position-absolute circle_anchor" href="javascript:void(0)"  @click="$parent.showModal(user, 'online')" data-toggle="modal" data-target="#modal_patient_num"></a>
                      </div>
                <div  v-for="(docteam,index) in user.doc_teams" v-if="index < 3">
                      <div class="hospital-main w-90 d-block border border-dark position-relative box_radius hospital-main-slider mt-2">
                         <div class="row">
                            <!-- <div class="col-3">
                               <div class="hospital-image w-100 d-inline-block">
                                  <a href="javascript:void(0)">
                                    <v-lazy-image v-if="docteam.user_id != 'online' && docteam.hospital.profile.avatar !== null" :src="'/uploads/allusers/'+docteam.hospital.id+'/small-'+docteam.hospital.profile.avatar" :alt=" docteam.hospital.first_name + ' ' + docteam.hospital.last_name " :name=" docteam.hospital.first_name + ' ' + docteam.hospital.last_name"/>
                                  <v-lazy-image v-else :src="'/uploads/users/default/hospital.svg'" alt="Video Consultation Icon" class="img-fluid d-inline-block w-45px h_45 rounded-circle 
                                  m-2"/>
                                  </a>
                               </div>
                            </div> -->
                            <div class="col-12">
                               <div class="hospital-detail w-100 d-inline-block overflow-hidden eclipse pt-1 p-2">
                                  <a class="text_black font-weight-bold text_12" 
                                  href="javascript:void(0)" >{{docteam.hospital.first_name + ' ' + docteam.hospital.last_name }}</a>
                                  <!-- <p v-if="docteam.user_id != 'online' " class="text_black mt-1 mb-0 text_12 overflow-hidden eclipse h-20" :title="docteam.hospital.profile.address">
                                    {{docteam.hospital.profile.address }}
                                  </p> -->
                                  <p class="text_black text_12 mb-0 mt-1 text-xs-11">
                                    {{availableDayStringOnline(user)}}
                                  </p>
                                  <p class="text-red font-weight-bold mb-0 text_12 mt-1">
                                    {{checkAvailabilityHospital(user)}}
                                    <span class="float-right text_black">
                                    <span class="text-blue">Rs:
                                    </span> {{checkPrice(docteam)}}
                                  </span>
                                    </p>
                               </div>
                              <!--  <div class="discount-box bg-white book-rounded text-center w-50 position-absolute">
                                <p class="text-blue text_12 eclipse overflow-hidden">
                                  10% Discount on online payment
                                </p>
                              </div> -->

                            </div>
                         </div>
                         <a class="position-absolute circle_anchor" href="javascript:void(0)"  @click="$parent.showModal(user, 'visit')" data-toggle="modal" data-target="#modal_patient_num"></a>
                      </div>
                      
                </div>
                    </VueSlickCarousel>
            </div>
      </div>
    </div>
    <div class="row d-block d-lg-none d-md-none mt-3">
      <div class="col-lg-4 col-12 col-md-4">
        <div class="list_btns w-80 m-auto w-xs-100 w-sm-100 w-md-100 d-block pb-2 pl-xl-5 mt-lg-0 mt-3" 
        v-if="user.roles[0].name === 'doctor'">
                <a href="javascript:void(0)" @click="$parent.showModal(user, 'visit')" class="d-md-block font-weight-bold text-center text-blue text_12 text-xs-10 float-left float-md-left small_btn w-sm-30 w-80 book-btn book-rounded book-padding book-border position-relative w-md-100 w-xs-48" data-toggle="modal" data-target="#modal_patient_num">Book Appointment
                  <span class="finger-icon bg-blue d-inline-block position-absolute">
                    <img :src="basePath+'/images/finger-icon.png'" 
                    alt="pictire">
                  </span>
                </a>
                <!-- <a v-if="user.location != null" :href="'/doctors/'+user.location.slug+'/'+user.specialities[0].slug+'/'+user.slug" class="d-block text-center mt-lg-3 mb-lg-2 mt-md-0 mt-sm-0 mb-md-2 mt-0 mb-0 text_12 font-weight-bold text-white text_md_12 float-right float-md-left float-lg-left small_btn w-sm-33 bg-blue book-padding book-rounded position-relative book-border w-md-30 ml-0 ml-md-3 ml-sm-3 float-sm-left w-xs-48 ml-lg-0 w-ipad-100 w-80">View Profile 
                  <span class="finger-icon bg-blue d-inline-block position-absolute heart-icon pt-1">
                    <i class="fa fa-heart" aria-hidden="true">
                    </i>
                  </span>
                </a> -->
                <!-- <a :href="'/doctors/lahore/'+user.specialities[0].slug+'/'+user.slug" class="d-block text-center text_12 font-weight-bold mt-lg-3 text-white text_md_12 float-right float-md-left float-lg-left small_btn w-sm-48 bg-blue book-padding book-rounded position-relative book-border w-md-30 ml-0 ml-md-3 w-xs-48 ml-lg-0 w-ipad-100 w-80">View Profile 
                  <span class="finger-icon heart-icon bg-blue d-inline-block position-absolute pt-1">
                    <i class="fa fa-heart" aria-hidden="true">
                    </i>
                  </span>
                </a> -->
                <a href="javascript:void(0)" v-if="userVideoWilling(user) === 'on'" @click="$parent.showModal(user, 'online')" data-target="#modal_patient_num" data-toggle="modal" class="d-block text-center text-white font-weight-bold mt-lg-3 mb-lg-2 mt-md-0 mt-sm-0 mb-0 text_12 text-xs-10 float-right float-md-left float-sm-left float-lg-left small_btn w-sm-30 book-video-btn bg-green book-rounded book-padding position-relative w-md-100 ml-0 ml-md-0 mt-md-3 border-green ml-sm-3 w-xs-48 ml-lg-0 w-80">Video Consultation
                  <span class="finger-icon video-cam-icon bg-blue d-inline-block position-absolute">
                    <img :src="basePath+'/images/video-cam-icon.svg'" 
                    alt="pictire">
                  </span>
                </a>
              </div>
              <!-- <div class="list_btns w-100 d-inline-block mt-lg-0 mt-3" v-else>
                <a target="_blank"
                   :href="'https://maps.google.com/?q='+user.profile.latitude+'+'+user.profile.longitude"
                   class="d-block text-center text_md_12 float-xs-left float-sm-left float-md-left float-lg-left text_12 text-white font-weight-bold small_btn w_md_100 mt-xs-3 mt-sm-3 mt-md-0 mt-sm-0 mt-lg-3 bg-blue book-padding book-rounded book-border w-md-30 ml-0 ml-md-3 ml-sm-3 w-sm-30 w-xs-48 ml-lg-0 w-ipad-100 w-80">Direction
                 </a>
                <a href="javascript:void(0)" class="d-block text-center text-white mt-lg-3 mb-lg-2 mt-0 mb-0 text_12 font-weight-bold text_md_12 float-right float-lg-left bg-blue book-padding book-rounded position-relative book-border w-md-30 ml-0 ml-md-3 ml-sm-3 w-sm-30 mt-sm-0 w-xs-48 ml-lg-0 w-ipad-100 w-80">View Profile
                  <span class="finger-icon bg-blue d-inline-block position-absolute heart-icon pt-1">
                    <i class="fa fa-heart" aria-hidden="true">
                    </i>
                  </span>
                </a>
              </div> -->
      </div>
    </div>
    </div>
    </div>
  </div>
  <span class="more_option w-100 text-center d-inline-block mb-4"  v-if="usersData.length >= 10 && !noMoreData">
              <a href="javascript:void(0)" @click="showMore"  class="book-rounded bg-blue text-white p-2 btn_padding d-inline-block">
                View more doctors
                <i aria-hidden="true" class="fa fa-arrow-right ml-1"></i>
              </a>
          </span>
</div>
</template>

<script>
import VueSocialSharing from 'vue-social-sharing'
import Toasted from 'vue-toasted'
import VTooltip from 'v-tooltip'
import StarRating from 'vue-star-rating'
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
import VLazyImage from "v-lazy-image/v2";
Vue.component('star-rating', StarRating);

Vue.use(VueSocialSharing)
Vue.use(Toasted)
export default {
  components: { VueSlickCarousel,VTooltip, VLazyImage},
  name: "DoctorListingTab",
  props: ['usersData', 'patient','speciality', 'fileSystemDriver'],
  data() {
    return{
      basePath:'',
      c1Setting: {
        arrows: true,
        dots: false,
        focusOnSelect: true,
        slidesToShow:2,
        infinite:false,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
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
      availableDayName: '',
      dayName: '',
      savedDoctors: false,
      saved_doctors: [],
      verified_message: 'Verified User',
      medical_message: 'Medical Registration Verified',
      rating: 0.0,
      education:'',
      noMoreData: false,
      doctorsToShow: 10,
      page: 1
    }
  },
  created (){
    
    // if (this.user.profile.educations !== null || this.user.profile.educations !== undefined) {
    // this.education = JSON.parse(this.user.profile.educations)
    // }
    // else{
    //   this.education = ''
    // }
    let self = this
    this.availableDayName = ''
    if (this.$parent.patientData.length === undefined) {
      if (this.$parent.patientData.profile.saved_doctors !== null) {
        this.saved_doctors = JSON.parse(this.$parent.patientData.profile.saved_doctors)
      }
      else {
        this.saved_doctors = []
      }
    }
    else {
      this.saved_doctors = []
    }
    
    

    
  },
  mounted () {
    // console.log('abacsss',this.usersData);
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  methods: {

    // feesRange(fee) {
    //       let fees = JSON.parse(fee)
    //       return fees['from_fees'] + ' - ' + fees['to_fees']
    // },
    userVideoWilling(user){
      if(user.onlines.length > 0)
        return "on";
      else
        return "off";
    },
    userEducation(user){
      if(user.profile && user.profile.educations != null)
      return JSON.parse(user.profile.educations)
      else
        return '';
    },
    // showMore(){
    //     if(this.doctorsToShow < this.usersData.length){
    //       this.doctorsToShow += 10; 
    //     }else{
    //       const getLastItem = thePath => thePath.substring(thePath.lastIndexOf('/') + 1)
    //       this.$parent.loading = true
    //       this.page = this.page+1;
    //       var specialitystring = getLastItem(window.location.href);
    //       var city = getLastItem(window.location.href);

    //       var speciality = specialitystring.split("-", 1);
    //          axios.get(window.location.origin+'/nextdoctor?page='+this.page+'&city='+city+'&speciality='+specialitystring)
    //         .then((response) => {
    //           response.data.users.forEach((item) => { 
    //               this.usersData.push(item);
    //           })
    //           response.data.hospitals.forEach((item) => { 
    //               this.$parent.doctor_hospitals.push(item);
    //           })
    //           this.$parent.loading = false
    //           this.doctorsToShow += 10;
    //         })
    //         .catch((error) => {
    //         });
    //     }
    // },
    showMore() {
  if (this.doctorsToShow < this.usersData.length) {
    this.doctorsToShow += 10;
  } else {
    const getLastItem = thePath => thePath.substring(thePath.lastIndexOf('/') + 1);
    this.$parent.loading = true;
    this.page = this.page + 1;

    const specialitystring = getLastItem(window.location.href);
    const parts = specialitystring.split("-in-");
    const speciality = parts[0];
    const city = parts[1];
    axios.get(window.location.origin + '/nextdoctor?page=' + this.page + '&city=' + city + '&speciality=' + speciality)
      .then((response) => {
        response.data.users.forEach((item) => {
          this.usersData.push(item);
        });
        response.data.hospitals.forEach((item) => {
          this.$parent.doctor_hospitals.push(item);
        });
        this.$parent.loading = false;

        if (response.data.users.length < 10) {
          // No more data to load, hide the button
          this.noMoreData = true;
        }

        this.doctorsToShow += 10;
      })
      .catch((error) => {
        // Handle error
      });
  }
},



    userRating(user){
      let avgRating = 0.0
      user.feedbacks.forEach(function (feedback){
        avgRating += parseFloat(feedback.avg_rating)
      })
      if (user.feedbacks.length > 0) {
        this.rating = parseFloat(((avgRating/parseFloat(user.feedbacks.length))/5).toFixed(0))
      }
      else {
        this.rating = 0
      }
    },
    docFeeRange(user)
    {
        var price='';

        var length=user.doc_teams.length;
        if(length > 1)
        {
            var minPrice=Math.min(...user.doc_teams.map(team => team.price));
            var maxPrice=Math.max(...user.doc_teams.map(team => team.price));
            if(minPrice < maxPrice)
            {
              price = minPrice+'-'+maxPrice;
              return price;
            }
            else
            {
               user.doc_teams.filter((item)=>{ 
                  price=item.price;
              });
              return price;
            }
            
        }
        else
        {
          user.doc_teams.filter((item)=>{ 
              price=item.price;
          });
          return price;
        }

    },
    docFee(user){
      var docPrice = [];
        if(user.doc_teams.length > 0){

        user.doc_teams.forEach(function(x) {
          let slots = JSON.parse(x.slots)
        if (slots && slots.consultation_fee){
          docPrice.push(slots.consultation_fee);
        }
        else if (x.price > 0){
          docPrice.push(x.price);
        }
        else{
          docPrice.push(0);
        }
        })
        return Math.min.apply(Math, docPrice);
        }
        return 0;
      },
      checkPrice(team){
        let slots = JSON.parse(team.slots)
        let price ='';
         if (slots && slots.consultation_fee){
          return price = slots.consultation_fee
        }
        else if(team.price > 0){
          return price = team.price
        }
        else{
          return price
        }
      },
    averageWaitingTime(time) {
      let average = 0
      if (time.length > 0) {
        time.forEach(function (time) {
          average += parseInt(time.waiting_time)
        })
        return parseInt(average/time.length)
      }
      else {
        return '0'
      }

    },
    availableDayStringOnline(user) {
      if (user.onlines[0]) {
      let availableDays = JSON.parse(user.onlines[0].slots)
      if (availableDays !== '' && availableDays !== null) {
        let availability = '';
        let day1 = ((moment().format('dddd')).toLowerCase().trim());
        let day2 = ((moment().add(1, 'day').format('dddd')).toLowerCase().trim());
        let day3 = ((moment().add(2, 'day').format('dddd')).toLowerCase().trim());
        let day4 = ((moment().add(3, 'day').format('dddd')).toLowerCase().trim());
        let day5 = ((moment().add(4, 'day').format('dddd')).toLowerCase().trim());
        let day6 = ((moment().add(5, 'day').format('dddd')).toLowerCase().trim());
        let day7 = ((moment().add(6, 'day').format('dddd')).toLowerCase().trim());
        let start_end_time ='';
          let start_end_time1 ='';
        if(availableDays.days){
        day1 = ((moment().format('ddd')).toLowerCase().trim());
        day2 = ((moment().add(1, 'day').format('ddd')).toLowerCase().trim());
        day3 = ((moment().add(2, 'day').format('ddd')).toLowerCase().trim());
        day4 = ((moment().add(3, 'day').format('ddd')).toLowerCase().trim());
        day5 = ((moment().add(4, 'day').format('ddd')).toLowerCase().trim());
        day6 = ((moment().add(5, 'day').format('ddd')).toLowerCase().trim());
        day7 = ((moment().add(6, 'day').format('ddd')).toLowerCase().trim());
        if (availableDays[day1] ) {
        start_end_time = ((JSON.parse(user.onlines[0].slots)[day1]['start_time']))+' - '+((JSON.parse(user.doc_teams[0].slots)[day1]['end_time']));
        }
        else if(availableDays[day2]){
          start_end_time = ((JSON.parse(user.onlines[0].slots)[day2]['start_time']))+' - '+((JSON.parse(user.onlines[0].slots)[day2]['end_time']));
        }
        else if(availableDays[day3]){
          start_end_time = ((JSON.parse(user.onlines[0].slots)[day3]['start_time']))+' - '+((JSON.parse(user.onlines[0].slots)[day3]['end_time']));
        }
        else if(availableDays[day4]){
          start_end_time = ((JSON.parse(user.onlines[0].slots)[day4]['start_time']))+' - '+((JSON.parse(user.onlines[0].slots)[day4]['end_time']));
        }
        else if(availableDays[day5]){
          start_end_time = ((JSON.parse(user.onlines[0].slots)[day5]['start_time']))+' - '+((JSON.parse(user.onlines[0].slots)[day5]['end_time']));
        }
        else if(availableDays[day6]){
          start_end_time = ((JSON.parse(user.onlines[0].slots)[day6]['start_time']))+' - '+((JSON.parse(user.onlines[0].slots)[day6]['end_time']));
        }
        else if(availableDays[day7]){
          start_end_time = ((JSON.parse(user.onlines[0].slots)[day7]['start_time']))+' - '+((JSON.parse(user.onlines[0].slots)[day7]['end_time']));
        }
        else{

        }
      }
      else{
        if (availableDays[day1] ) {
        start_end_time = ((JSON.parse(user.onlines[0].slots)[day1]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.onlines[0].slots)[day1]['start_end_time1']));
          }
        else if(availableDays[day2]){
          start_end_time = ((JSON.parse(user.onlines[0].slots)[day2]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.onlines[0].slots)[day2]['start_end_time1']));
        }
        else if(availableDays[day3]){
          start_end_time = ((JSON.parse(user.onlines[0].slots)[day3]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.onlines[0].slots)[day3]['start_end_time1']));
        }
        else if(availableDays[day4]){
          start_end_time = ((JSON.parse(user.onlines[0].slots)[day4]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.onlines[0].slots)[day4]['start_end_time1']));
        }
        else if(availableDays[day5]){
          start_end_time = ((JSON.parse(user.onlines[0].slots)[day5]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.onlines[0].slots)[day5]['start_end_time1']));
        }
        else if(availableDays[day6]){
          start_end_time = ((JSON.parse(user.onlines[0].slots)[day6]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.onlines[0].slots)[day6]['start_end_time1']));
        }
        else if(availableDays[day7]){
          start_end_time = ((JSON.parse(user.onlines[0].slots)[day7]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.onlines[0].slots)[day7]['start_end_time1']));
        }
        else {

        }
      }
        

          
            if(start_end_time1 != '')
              return start_end_time+"\n"+start_end_time1;
            else
              return start_end_time ?? 'Slots Not Available';
      }
      else{
        return 'Slots Not Available';
      }
        
      }
      return 'Slots Not Available';
      // return start_time + ` - ` + end_time
    },
    checkAvailabilityOnline(user) 
    {
      if (user.onlines) {
      let availableDays = JSON.parse(user.onlines[0].slots)
      
      if (availableDays !== '' && availableDays !== null) {
        let availability = '';
        let day1 = ((moment().format('dddd')).toLowerCase().trim());
        let day2 = ((moment().add(1, 'day').format('dddd')).toLowerCase().trim());
        let day3 = ((moment().add(2, 'day').format('dddd')).toLowerCase().trim());
        let day4 = ((moment().add(3, 'day').format('dddd')).toLowerCase().trim());
        let day5 = ((moment().add(4, 'day').format('dddd')).toLowerCase().trim());
        let day6 = ((moment().add(5, 'day').format('dddd')).toLowerCase().trim());
        let day7 = ((moment().add(6, 'day').format('dddd')).toLowerCase().trim());
        if(availableDays.days){
        day1 = ((moment().format('ddd')).toLowerCase().trim());
        day2 = ((moment().add(1, 'day').format('ddd')).toLowerCase().trim());
        day3 = ((moment().add(2, 'day').format('ddd')).toLowerCase().trim());
        day4 = ((moment().add(3, 'day').format('ddd')).toLowerCase().trim());
        day5 = ((moment().add(4, 'day').format('ddd')).toLowerCase().trim());
        day6 = ((moment().add(5, 'day').format('ddd')).toLowerCase().trim());
        day7 = ((moment().add(6, 'day').format('ddd')).toLowerCase().trim());
      }
        if (availableDays !== null) {
          if (availableDays[day1] ) {
            this.dayName = moment().day(day1).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day1).format('dddd')
            return availability = 'Available Today'
          } else if (availableDays[day2]) {
            this.dayName = moment().day(day2).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day2).format('dddd')
            return availability = ' Available Tomorrow'
          } else if (availableDays[day3]) {
            this.dayName = moment().day(day3).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day3).format('dddd')
            return availability = ' Available on ' + moment().add(2, 'day').format('DD-MM-YYYY  dddd')
          } else if (availableDays[day4]) {
            this.dayName = moment().day(day4).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day4).format('dddd')
            return availability = ' Available on ' + moment().add(3, 'day').format('DD-MM-YYYY  dddd')
          } else if (availableDays[day5]) {
            this.dayName = moment().day(day5).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day5).format('dddd')
            return availability = ' Available on ' + moment().add(4, 'day').format('DD-MM-YYYY  dddd')
          } else if (availableDays[day6]) {
            this.dayName = moment().day(day6).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day6).format('dddd')
            return availability = ' Available on ' + moment().add(5, 'day').format('DD-MM-YYYY  dddd')
          } else if (availableDays[day7]) {
            this.dayName = moment().day(day7).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day7).format('dddd')
            return availability = ' Available on ' + moment().add(6, 'day').format('DD-MM-YYYY  dddd')
          } else {
            return availability = 'Not Available'
          }
        } else {
          return availability = 'Not Available'
        }
        return availability;
      }
      else {

      }
      }
    },
    checkAvailability: function (user) {
      if (user.doc_teams[0]) {
      let availableDays = JSON.parse(user.doc_teams[0].slots)
      let hospitalName = user.doc_teams[0].hospital.first_name+' '+user.doc_teams[0].hospital.last_name
      if (availableDays !== '' && availableDays !== null) {
        let availability = '';
        let day1 = ((moment().format('dddd')).toLowerCase().trim());
        let day2 = ((moment().add(1, 'day').format('dddd')).toLowerCase().trim());
        let day3 = ((moment().add(2, 'day').format('dddd')).toLowerCase().trim());
        let day4 = ((moment().add(3, 'day').format('dddd')).toLowerCase().trim());
        let day5 = ((moment().add(4, 'day').format('dddd')).toLowerCase().trim());
        let day6 = ((moment().add(5, 'day').format('dddd')).toLowerCase().trim());
        let day7 = ((moment().add(6, 'day').format('dddd')).toLowerCase().trim());
        if(availableDays.days){
        day1 = ((moment().format('ddd')).toLowerCase().trim());
        day2 = ((moment().add(1, 'day').format('ddd')).toLowerCase().trim());
        day3 = ((moment().add(2, 'day').format('ddd')).toLowerCase().trim());
        day4 = ((moment().add(3, 'day').format('ddd')).toLowerCase().trim());
        day5 = ((moment().add(4, 'day').format('ddd')).toLowerCase().trim());
        day6 = ((moment().add(5, 'day').format('ddd')).toLowerCase().trim());
        day7 = ((moment().add(6, 'day').format('ddd')).toLowerCase().trim());
      }
        if (availableDays !== null) {
          if (availableDays[day1] ) {
            this.dayName = moment().day(day1).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day1).format('dddd')
            return availability = 'Available Today at '+hospitalName
          } else if (availableDays[day2]) {
            this.dayName = moment().day(day2).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day2).format('dddd')
            return availability = ' Available Tomorrow at '+hospitalName
          } else if (availableDays[day3]) {
            this.dayName = moment().day(day3).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day3).format('dddd')
            return availability = ' Available on ' + moment().add(2, 'day').format('DD-MM-YYYY  dddd')+' at '+hospitalName
          } else if (availableDays[day4]) {
            this.dayName = moment().day(day4).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day4).format('dddd')
            return availability = ' Available on ' + moment().add(3, 'day').format('DD-MM-YYYY  dddd')+' at '+hospitalName
          } else if (availableDays[day5]) {
            this.dayName = moment().day(day5).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day5).format('dddd')
            return availability = ' Available on ' + moment().add(4, 'day').format('DD-MM-YYYY  dddd')+' at '+hospitalName
          } else if (availableDays[day6]) {
            this.dayName = moment().day(day6).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day6).format('dddd')
            return availability = ' Available on ' + moment().add(5, 'day').format('DD-MM-YYYY  dddd')+' at '+hospitalName
          } else if (availableDays[day7]) {
            this.dayName = moment().day(day7).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day7).format('dddd')
            return availability = ' Available on ' + moment().add(6, 'day').format('DD-MM-YYYY  dddd')+' at '+hospitalName
          } else {
            return availability = 'Not Available'
          }
        } else {
          return availability = 'Not Available'
        }
        return availability;
      }
      else {

      }
      }
    },
    checkAvailabilityHospital: function (user){
      if (user.doc_teams[0]) {
      let availableDays = JSON.parse(user.doc_teams[0].slots)
      let hospitalName = user.doc_teams[0].hospital.first_name+' '+user.doc_teams[0].hospital.last_name
      if (availableDays !== '' && availableDays !== null) {
        let availability = '';
        let day1 = ((moment().format('dddd')).toLowerCase().trim());
        let day2 = ((moment().add(1, 'day').format('dddd')).toLowerCase().trim());
        let day3 = ((moment().add(2, 'day').format('dddd')).toLowerCase().trim());
        let day4 = ((moment().add(3, 'day').format('dddd')).toLowerCase().trim());
        let day5 = ((moment().add(4, 'day').format('dddd')).toLowerCase().trim());
        let day6 = ((moment().add(5, 'day').format('dddd')).toLowerCase().trim());
        let day7 = ((moment().add(6, 'day').format('dddd')).toLowerCase().trim());
        if(availableDays.days){
        day1 = ((moment().format('ddd')).toLowerCase().trim());
        day2 = ((moment().add(1, 'day').format('ddd')).toLowerCase().trim());
        day3 = ((moment().add(2, 'day').format('ddd')).toLowerCase().trim());
        day4 = ((moment().add(3, 'day').format('ddd')).toLowerCase().trim());
        day5 = ((moment().add(4, 'day').format('ddd')).toLowerCase().trim());
        day6 = ((moment().add(5, 'day').format('ddd')).toLowerCase().trim());
        day7 = ((moment().add(6, 'day').format('ddd')).toLowerCase().trim());
      }
        if (availableDays !== null) {
          if (availableDays[day1] ) {
            this.dayName = moment().day(day1).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day1).format('dddd')
            return availability = 'Available Today'
          } else if (availableDays[day2]) {
            this.dayName = moment().day(day2).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day2).format('dddd')
            return availability = ' Available Tomorrow'
          } else if (availableDays[day3]) {
            this.dayName = moment().day(day3).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day3).format('dddd')
            return availability = ' Available on ' + moment().add(2, 'day').format('dddd DD-MM-YYYY')
          } else if (availableDays[day4]) {
            this.dayName = moment().day(day4).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day4).format('dddd')
            return availability = ' Available on ' + moment().add(3, 'day').format('dddd DD-MM-YYYY')
          } else if (availableDays[day5]) {
            this.dayName = moment().day(day5).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day5).format('dddd')
            return availability = ' Available on ' + moment().add(4, 'day').format('dddd DD-MM-YYYY')
          } else if (availableDays[day6]) {
            this.dayName = moment().day(day6).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day6).format('dddd')
            return availability = ' Available on ' + moment().add(5, 'day').format('dddd DD-MM-YYYY')
          } else if (availableDays[day7]) {
            this.dayName = moment().day(day7).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day7).format('dddd')
            return availability = ' Available on ' + moment().add(6, 'day').format('dddd DD-MM-YYYY')
          } else {
            return availability = 'Not Available'
          }
        } else {
          return availability = 'Not Available'
        }
        return availability;
      }
      else {

      }
      }
    },
    checkAvailabilitySecondTeam: function (user) {
      if (user.doc_teams[1]) {
      let availableDays = JSON.parse(user.doc_teams[1].slots)
      let hospitalName = user.doc_teams[1].hospital.first_name+' '+user.doc_teams[1].hospital.last_name
      if (availableDays !== '' && availableDays !== null) {
        let availability = '';
        let day1 = ((moment().format('dddd')).toLowerCase().trim());
        let day2 = ((moment().add(1, 'day').format('dddd')).toLowerCase().trim());
        let day3 = ((moment().add(2, 'day').format('dddd')).toLowerCase().trim());
        let day4 = ((moment().add(3, 'day').format('dddd')).toLowerCase().trim());
        let day5 = ((moment().add(4, 'day').format('dddd')).toLowerCase().trim());
        let day6 = ((moment().add(5, 'day').format('dddd')).toLowerCase().trim());
        let day7 = ((moment().add(6, 'day').format('dddd')).toLowerCase().trim());
        if(availableDays.days){
        day1 = ((moment().format('ddd')).toLowerCase().trim());
        day2 = ((moment().add(1, 'day').format('ddd')).toLowerCase().trim());
        day3 = ((moment().add(2, 'day').format('ddd')).toLowerCase().trim());
        day4 = ((moment().add(3, 'day').format('ddd')).toLowerCase().trim());
        day5 = ((moment().add(4, 'day').format('ddd')).toLowerCase().trim());
        day6 = ((moment().add(5, 'day').format('ddd')).toLowerCase().trim());
        day7 = ((moment().add(6, 'day').format('ddd')).toLowerCase().trim());
      }
        if (availableDays !== null) {
          if (availableDays[day1] ) {
            this.dayName = moment().day(day1).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day1).format('dddd')
            return availability = 'Available Today at '+hospitalName
          } else if (availableDays[day2]) {
            this.dayName = moment().day(day2).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day2).format('dddd')
            return availability = ' Available Tomorrow at '+hospitalName
          } else if (availableDays[day3]) {
            this.dayName = moment().day(day3).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day3).format('dddd')
            return availability = ' Available on ' + moment().add(2, 'day').format('DD-MM-YYYY  dddd')+' at '+hospitalName
          } else if (availableDays[day4]) {
            this.dayName = moment().day(day4).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day4).format('dddd')
            return availability = ' Available on ' + moment().add(3, 'day').format('DD-MM-YYYY  dddd')+' at '+hospitalName
          } else if (availableDays[day5]) {
            this.dayName = moment().day(day5).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day5).format('dddd')
            return availability = ' Available on ' + moment().add(4, 'day').format('DD-MM-YYYY  dddd')+' at '+hospitalName
          } else if (availableDays[day6]) {
            this.dayName = moment().day(day6).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day6).format('dddd')
            return availability = ' Available on ' + moment().add(5, 'day').format('DD-MM-YYYY  dddd')+' at '+hospitalName
          } else if (availableDays[day7]) {
            this.dayName = moment().day(day7).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day7).format('dddd')
            return availability = ' Available on ' + moment().add(6, 'day').format('DD-MM-YYYY  dddd')+' at '+hospitalName
          } else {
            return availability = 'Not Available'
          }
        } else {
          return availability = 'Not Available'
        }
        return availability;
      }
      else {

      }
      }
    },

    availableDayString(user) {
      if (user.doc_teams[0]) {
      let availableDays = JSON.parse(user.doc_teams[0].slots)
      if (availableDays !== '' && availableDays !== null) {
        let availability = '';
        let day1 = ((moment().format('dddd')).toLowerCase().trim());
        let day2 = ((moment().add(1, 'day').format('dddd')).toLowerCase().trim());
        let day3 = ((moment().add(2, 'day').format('dddd')).toLowerCase().trim());
        let day4 = ((moment().add(3, 'day').format('dddd')).toLowerCase().trim());
        let day5 = ((moment().add(4, 'day').format('dddd')).toLowerCase().trim());
        let day6 = ((moment().add(5, 'day').format('dddd')).toLowerCase().trim());
        let day7 = ((moment().add(6, 'day').format('dddd')).toLowerCase().trim());
        let start_end_time ='';
          let start_end_time1 ='';
        if(availableDays.days){
        day1 = ((moment().format('ddd')).toLowerCase().trim());
        day2 = ((moment().add(1, 'day').format('ddd')).toLowerCase().trim());
        day3 = ((moment().add(2, 'day').format('ddd')).toLowerCase().trim());
        day4 = ((moment().add(3, 'day').format('ddd')).toLowerCase().trim());
        day5 = ((moment().add(4, 'day').format('ddd')).toLowerCase().trim());
        day6 = ((moment().add(5, 'day').format('ddd')).toLowerCase().trim());
        day7 = ((moment().add(6, 'day').format('ddd')).toLowerCase().trim());
        if (availableDays[day1] ) {
        start_end_time = ((JSON.parse(user.doc_teams[0].slots)[day1]['start_time']))+' - '+((JSON.parse(user.doc_teams[0].slots)[day1]['end_time']));
        }
        else if(availableDays[day2]){
          start_end_time = ((JSON.parse(user.doc_teams[0].slots)[day2]['start_time']))+' - '+((JSON.parse(user.doc_teams[0].slots)[day2]['end_time']));
        }
        else if(availableDays[day3]){
          start_end_time = ((JSON.parse(user.doc_teams[0].slots)[day3]['start_time']))+' - '+((JSON.parse(user.doc_teams[0].slots)[day3]['end_time']));
        }
        else if(availableDays[day4]){
          start_end_time = ((JSON.parse(user.doc_teams[0].slots)[day4]['start_time']))+' - '+((JSON.parse(user.doc_teams[0].slots)[day4]['end_time']));
        }
        else if(availableDays[day5]){
          start_end_time = ((JSON.parse(user.doc_teams[0].slots)[day5]['start_time']))+' - '+((JSON.parse(user.doc_teams[0].slots)[day5]['end_time']));
        }
        else if(availableDays[day6]){
          start_end_time = ((JSON.parse(user.doc_teams[0].slots)[day6]['start_time']))+' - '+((JSON.parse(user.doc_teams[0].slots)[day6]['end_time']));
        }
        else if(availableDays[day7]){
          start_end_time = ((JSON.parse(user.doc_teams[0].slots)[day7]['start_time']))+' - '+((JSON.parse(user.doc_teams[0].slots)[day7]['end_time']));
        }
        else{

        }
      }
      else{
        if (availableDays[day1] ) {
        start_end_time = ((JSON.parse(user.doc_teams[0].slots)[day1]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.doc_teams[0].slots)[day1]['start_end_time1']));
          }
        else if(availableDays[day2]){
          start_end_time = ((JSON.parse(user.doc_teams[0].slots)[day2]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.doc_teams[0].slots)[day2]['start_end_time1']));
        }
        else if(availableDays[day3]){
          start_end_time = ((JSON.parse(user.doc_teams[0].slots)[day3]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.doc_teams[0].slots)[day3]['start_end_time1']));
        }
        else if(availableDays[day4]){
          start_end_time = ((JSON.parse(user.doc_teams[0].slots)[day4]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.doc_teams[0].slots)[day4]['start_end_time1']));
        }
        else if(availableDays[day5]){
          start_end_time = ((JSON.parse(user.doc_teams[0].slots)[day5]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.doc_teams[0].slots)[day5]['start_end_time1']));
        }
        else if(availableDays[day6]){
          start_end_time = ((JSON.parse(user.doc_teams[0].slots)[day6]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.doc_teams[0].slots)[day6]['start_end_time1']));
        }
        else if(availableDays[day7]){
          start_end_time = ((JSON.parse(user.doc_teams[0].slots)[day7]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.doc_teams[0].slots)[day7]['start_end_time1']));
        }
        else {

        }
      }
        

          
            if(start_end_time1 != '')
              return start_end_time+"\n"+start_end_time1;
            else
              return start_end_time ?? 'Slots Not Available';
      }
      else{
        return 'Slots Not Available';
      }
        
      }
      return 'Slots Not Available';
      // return start_time + ` - ` + end_time
    },
    availableDayStringSecondTeam(user) {
      if (user.doc_teams[1]) {
      let availableDays = JSON.parse(user.doc_teams[1].slots)
      if (availableDays !== '' && availableDays !== null) {
        let availability = '';
        let day1 = ((moment().format('dddd')).toLowerCase().trim());
        let day2 = ((moment().add(1, 'day').format('dddd')).toLowerCase().trim());
        let day3 = ((moment().add(2, 'day').format('dddd')).toLowerCase().trim());
        let day4 = ((moment().add(3, 'day').format('dddd')).toLowerCase().trim());
        let day5 = ((moment().add(4, 'day').format('dddd')).toLowerCase().trim());
        let day6 = ((moment().add(5, 'day').format('dddd')).toLowerCase().trim());
        let day7 = ((moment().add(6, 'day').format('dddd')).toLowerCase().trim());
        let start_end_time ='';
          let start_end_time1 ='';
        if(availableDays.days){
        day1 = ((moment().format('ddd')).toLowerCase().trim());
        day2 = ((moment().add(1, 'day').format('ddd')).toLowerCase().trim());
        day3 = ((moment().add(2, 'day').format('ddd')).toLowerCase().trim());
        day4 = ((moment().add(3, 'day').format('ddd')).toLowerCase().trim());
        day5 = ((moment().add(4, 'day').format('ddd')).toLowerCase().trim());
        day6 = ((moment().add(5, 'day').format('ddd')).toLowerCase().trim());
        day7 = ((moment().add(6, 'day').format('ddd')).toLowerCase().trim());
        if (availableDays[day1] ) {
        start_end_time = ((JSON.parse(user.doc_teams[1].slots)[day1]['start_time']))+' - '+((JSON.parse(user.doc_teams[1].slots)[day1]['end_time']));
        }
        else if(availableDays[day2]){
          start_end_time = ((JSON.parse(user.doc_teams[1].slots)[day2]['start_time']))+' - '+((JSON.parse(user.doc_teams[1].slots)[day2]['end_time']));
        }
        else if(availableDays[day3]){
          start_end_time = ((JSON.parse(user.doc_teams[1].slots)[day3]['start_time']))+' - '+((JSON.parse(user.doc_teams[1].slots)[day3]['end_time']));
        }
        else if(availableDays[day4]){
          start_end_time = ((JSON.parse(user.doc_teams[1].slots)[day4]['start_time']))+' - '+((JSON.parse(user.doc_teams[1].slots)[day4]['end_time']));
        }
        else if(availableDays[day5]){
          start_end_time = ((JSON.parse(user.doc_teams[1].slots)[day5]['start_time']))+' - '+((JSON.parse(user.doc_teams[1].slots)[day5]['end_time']));
        }
        else if(availableDays[day6]){
          start_end_time = ((JSON.parse(user.doc_teams[1].slots)[day6]['start_time']))+' - '+((JSON.parse(user.doc_teams[1].slots)[day6]['end_time']));
        }
        else if(availableDays[day7]){
          start_end_time = ((JSON.parse(user.doc_teams[1].slots)[day7]['start_time']))+' - '+((JSON.parse(user.doc_teams[1].slots)[day7]['end_time']));
        }
        else{

        }
      }
      else{
        if (availableDays[day1] ) {
        start_end_time = ((JSON.parse(user.doc_teams[1].slots)[day1]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.doc_teams[1].slots)[day1]['start_end_time1']));
          }
        else if(availableDays[day2]){
          start_end_time = ((JSON.parse(user.doc_teams[1].slots)[day2]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.doc_teams[1].slots)[day2]['start_end_time1']));
        }
        else if(availableDays[day3]){
          start_end_time = ((JSON.parse(user.doc_teams[1].slots)[day3]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.doc_teams[1].slots)[day3]['start_end_time1']));
        }
        else if(availableDays[day4]){
          start_end_time = ((JSON.parse(user.doc_teams[1].slots)[day4]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.doc_teams[1].slots)[day4]['start_end_time1']));
        }
        else if(availableDays[day5]){
          start_end_time = ((JSON.parse(user.doc_teams[1].slots)[day5]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.doc_teams[1].slots)[day5]['start_end_time1']));
        }
        else if(availableDays[day6]){
          start_end_time = ((JSON.parse(user.doc_teams[1].slots)[day6]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.doc_teams[1].slots)[day6]['start_end_time1']));
        }
        else if(availableDays[day7]){
          start_end_time = ((JSON.parse(user.doc_teams[1].slots)[day7]['start_end_time']));
          start_end_time1 = ((JSON.parse(user.doc_teams[1].slots)[day7]['start_end_time1']));
        }
        else {

        }
      }
        

          
            if(start_end_time1 != '')
              return start_end_time+"\n"+start_end_time1;
            else
              return start_end_time ?? 'Slots Not Available';
      }
      else{
        return 'Slots Not Available';
      }
        
      }
      return 'Slots Not Available';
      // return start_time + ` - ` + end_time
    },

    wishlist: function (id, savedDoc, column) {
      let self = this;
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
                Vue.toasted.success( response.data.message , { duration: 3000 })
              }
              else if (column === 'saved_hospitals') {
              }
              else if (column === 'saved_articles') {
                self.article_likes = response.data.likes;
                self.show_likes = true;
              }
            } else {
              Vue.toasted.error( response.data.message , { duration: 3000 })
            }
          } else {
            Vue.toasted.error( response.data.message , { duration: 3000 })
          }
        }).catch(function (error) {
          Vue.toasted.error(error , { duration: 3000 })
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
                Vue.toasted.success(response.data.message , { duration: 3000 })
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
                Vue.toasted.success(response.data.message , { duration: 3000 })
              }
              else if (column === 'saved_hospitals') {
              }
              else if (column === 'saved_articles') {
                self.article_likes = response.data.likes;
                self.show_likes = true;
              }
            } else {
              Vue.toasted.error(response.data.message , { duration: 3000 })
            }
          } else {

          }
        }).catch(function (error) {
          Vue.toasted.error(error , { duration: 3000 })
        });
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
.vue-star-rating{
  display: inline-block !important;
}
.vue-star-rating span, .vue-star-rating span svg{
  width: 100% !important;
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
.eclipse{
  white-space: nowrap;
  text-overflow: ellipsis;
}
.hospitalFor_doctors .slick-slide img{
  margin: -2px auto;
}
</style>