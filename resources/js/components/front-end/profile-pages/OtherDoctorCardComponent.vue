<template>
  <div>
    <div class="w-90 d-block m-auto w-xs-100 w-sm-100 w-md-100 w-ipad-100">
    <div class="suggest-doctor bg-white w-100 d-inline-block pt-2 pb-xl-2 pb-4 pl-3 pr-3 box-shadow box_radius">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-12 mt-2">
          <div class="doctor_data d-flex w-100">
      <div class="doctor_image position-relative float-left">
        <div class="position-relative mb-1">
          <img v-if="doctor.profile && doctor.profile.avatar != null && doctor.profile.avatar != ' '" v-lazy="basePath+'/uploads/users/'+doctor.id+'/small-'+doctor.profile.avatar" :alt="doctor.first_name + ' ' + doctor.last_name" :name="doctor.first_name + ' ' + doctor.last_name"class="img-fluid rounded-circle h_90 w_90px w_md_60px h_md_60">
          <img v-else v-lazy="basePath+'/uploads/users/default/doctor.svg'" :alt="doctor.first_name + ' ' + doctor.last_name" :name="doctor.first_name + ' ' + doctor.last_name"class="img-fluid rounded-circle h_90 w_90px w_md_60px h_md_60">
          <div v-if="userVideoWilling(doctor) === 'on'" href="#" class="position-absolute video_icon doctor-video-box" style="bottom: 7px;right: 10px;">
            <a href="javascript:void(0)" class="w_20px h_20 rounded-circle text_14 text-center d-inline-block text-white bg-blue position-relative">
              <i class="fas fa-video position-absolute doctor-video-icon" aria-hidden="true"></i>
            </a>
          </div>
          <a :href="'/doctors/'+doctor.location.slug+'/'+doctor.specialities[0].slug+'/'+doctor.slug" class="circle_anchor position-absolute"></a>
        </div>
        <div class="total_rating w-80 m-auto w-md-100 d-inline-block d-lg-block">
          <span class="text-green">
            <star-rating
                class="w-30 float-left m-0 vue-star-rating"
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
              <span class=" float-left text-center">{{ rating }}</span>
              <!-- <span class="d-inline-block text_black" style="margin-top: 3px;"> ({{ user.feedbacks.length }})</span> -->
          </span>
        </div>
        <!-- <p class="badge knockdoc_sign_up_bg text-white text_12 float-left ">
          <i class="fa fa-thumbs-up" aria-hidden="true"></i>
          {{ doctor.feedbacks.length ? doctor.profile.votes/doctor.feedbacks.length * 100 : 0}}%
        </p> -->
      </div>
      <div class="doctor-name-specialties w-75 float-left ml-2">
        <div class="w-100 d-inline-block">
          <a class="text-blue font-weight-bold float-left mr-3 name" :href="'/doctors/'+doctor.location.slug+'/'+doctor.specialities[0].slug+'/'+doctor.slug">
            <h2 class="d-inline-block text_md_13 mb-0 text_15">
              <span class="float-left doctor-name font-weight-bold">
                {{ doctor.first_name }} {{ doctor.last_name }}
              </span>
              <span class="float-left ml-xl-2">
            <span class="ml-lg-0 float-left">
              <img :src="basePath+'/images/tick-image.png'" alt="pictire" class="tick-image"></span> 
              <span class="float-left ml-2">
                <img :src="basePath+'/images/shield.png'" class="img-fluid image-sheild" alt="Shield"></span>
          </span>
            </h2>
          </a>
        </div>
         <p class="text_12 text-truncate w-100 text-red font-weight-bold">
                    <span v-for="(spec, index) in doctor.specialities" class="comma"> {{ spec.title }}</span>
                    </p>
        <!-- <span class="text_12 w-100 text-truncate text_black d-block">
          <span class="comma" v-for="spec in doctor.specialities.slice(1,2)">{{spec.title}} </span>
        </span> -->
        <ul class="doctor_fee_details d-lg-inline-block d-md-inline-block w-100 mt-1 d-none">
          <!-- <li class="float-left w-18 pr-2 pr-md-0 text_12">
            <div class="small_img">
              <img src="/images/rs.svg" class="img-fluid rs-image v-lazy-image v-lazy-image-loaded">
            </div> 
            <span class="text-blue text_12 font-weight-bold">Rs</span> <span class="text_12 font-weight-bold">
              1500
            </span>
          </li>  -->
          <li class="float-left w-22 pr-2 pr-md-0 text_12" v-if="docFee(doctor)!= 0" >
            <span class="small_img">
              <v-lazy-image :src="basePath+'/images/rs.svg'" :alt=" doctor.first_name + ' ' + doctor.last_name " :name=" doctor.first_name + ' ' + doctor.last_name " class="img-fluid rs-image"/>
            </span>
            <span class="text-blue text_12 font-weight-bold">Rs</span>
            <span class="text_12 font-weight-bold">
             {{docFeeRange(doctor)}}
           </span>
          </li>
         <!--  <li class="float-left w-28 mr-2 ml-2 text-center text_12">
            <div class="small_img text-left pl-3">
              <img src="/images/experience.svg" class="img-fluid experience-image ">
            </div> 
            <span class="text-blue text_12 font-weight-bold">
              11 Years
            </span> 
            <span class="text_12 font-weight-bold">Experience</span>
          </li>  -->
          <li class="float-left w-28 mr-2 ml-2 text-center text_12" v-if="doctor.profile && doctor.profile.total_experience && doctor.profile.total_experience != ''">
            <span class="small_img text-left">
              <v-lazy-image :src="basePath+'/images/experience.svg'" :alt=" doctor.first_name + ' ' + doctor.last_name " :name=" doctor.first_name + ' ' + doctor.last_name " class="img-fluid experience-image"/>
            </span>
            <span class="text-blue text_12 font-weight-bold">
              {{ doctor.profile.total_experience }}
            </span>
            <span class="text_12 font-weight-bold" 
            v-if="doctor.profile.total_experience.length < 10">Experience</span>
          </li>
          <li class="float-left w-35 text_12 text-center" v-if="doctor.profile && doctor.profile.wait_time && doctor.profile.wait_time != null && doctor.profile.wait_time != ' '">
            <span class="wait_icon text-left">
              <!-- <i class="fa fa-hourglass" aria-hidden="true"></i> -->
              <img class="wait-icon" :src="basePath+'/images/wait-icon.svg'" 
              alt="picture">
            </span>
            <span class="text-blue text_12 font-weight-bold">Wait Time</span>
            <span class="text_12 font-weight-bold"> ({{ doctor.profile.wait_time }})</span>
          </li>
          <!-- <li class="float-left w-35 text_12 text-center">
            <p class="wait_icon text-left pl-3">
              <img src="/images/wait-icon.svg" alt="picture" class="wait-icon">
            </p> 
              <span class="text-blue text_12 font-weight-bold">Wait Time</span> 
              <span class="text_12 font-weight-bold"> (Under 15 Min)
              </span>
          </li> -->
          </ul>
        <!-- <p class="text_13 text_black">Fee<strong> Rs {{docFee(doctor)}}
        </strong></p>
        <p class="text_13 text_black">Experience<strong> {{ doctor.profile.total_experience }}</strong></p> -->
        <!-- <span class="theme-green-text text_13" v-if="doctor.doc_teams.length >= 1 ">
          <i class="fa fa-calendar mr-2" aria-hidden="true"></i>
          {{ checkAvailability(doctor) }}
        </span>
        <div class="d-block">
          <span class="text_black font-weight-bold text_13">{{ dayName | dayFormat }}</span>
          <span class="text_black text_13">
            {{ availableDayString(doctor) }}
          </span>
        </div> -->
      </div>
    </div>
        </div>
        <div class="col-lg-4 col-12 mt-xl-5 mt-2 col-md-4 d-lg-block d-md-block d-none">
          <div class="view-profile-btn w-80 d-block m-auto text-center mt-2 mb-2 position-relative w-xs-100 w-sm-100 w-md-100">
        <a :href="'/doctors/'+doctor.location.slug+'/'+doctor.specialities[0].slug+'/'+doctor.slug" class="d-md-block font-weight-bold text-center text-blue text_12 text-xs-10 float-left float-md-left small_btn w-sm-30 w-80 book-btn book-rounded book-padding book-border position-relative w-md-100 w-xs-48">Book appointment
          <span class="finger-icon bg-blue d-inline-block position-absolute">
            <img class="position-absolute" :src="basePath+'/images/finger-icon.png'" alt="pictire">
          </span>
        </a>
        <a v-if="userVideoWilling(doctor) === 'on'" :href="'/doctors/'+doctor.location.slug+'/'+doctor.specialities[0].slug+'/'+doctor.slug" class="d-block text-center text-white font-weight-bold mt-lg-3 mb-lg-2 mt-md-0 mt-sm-0 mb-0 text_12 text-xs-10 float-right float-md-left float-sm-left float-lg-left small_btn w-sm-30 book-video-btn bg-green book-rounded book-padding position-relative w-md-100 ml-0 ml-md-0 mt-md-3 border-green ml-sm-3 w-xs-48 ml-lg-0 w-80">video consultation
          <span class="finger-icon video-cam-icon bg-blue d-inline-block position-absolute">
            <img class="position-absolute" :src="basePath+'/images/video-cam-icon.svg'" alt="pictire">
          </span>
        </a>
      </div>
        </div>
      </div>
      <div class="row d-block d-lg-none d-md-none mt-3">
        <div class="col-12">
          <ul class="doctor_fee_details d-inline-block mb-0 w-100 
          mt-1">
          <li class="float-left w-18 pr-2 pr-md-0 text_11 text-9">
            <div class="small_img mb-2 text-center">
              <img :src="basePath+'/images/rs.svg'" class="img-fluid rs-image v-lazy-image v-lazy-image-loaded">
            </div> 
            <span class="text-blue text_11 text-9 font-weight-bold">Rs</span> <span class="text_11 text-9 font-weight-bold">
              {{docFeeRange(doctor)}}
            </span>
          </li> 
          <li v-if="doctor.profile && doctor.profile.total_experience && doctor.profile.total_experience != null && doctor.profile.total_experience != ' '" class="float-left w-35 mr-1 ml-1 text-center text_11 text-9">
            <div class="small_img text-center mb-2">
              <img :src="basePath+'/images/experience.svg'" class="img-fluid experience-image ">
            </div> 
            <span class="text-blue text_11 text-9 font-weight-bold">
              {{ doctor.profile.total_experience }}
            </span> 
            <span class="text_11 text-9 font-weight-bold">Experience
            </span>
          </li> 
          <li v-if="doctor.profile && doctor.profile.wait_time && doctor.profile.wait_time != null && doctor.profile.wait_time != ' '" class="float-left w-43 text_11 text-9 text-center">
            <p class="wait_icon text-center mb-2">
              <img :src="basePath+'/images/wait-icon.svg'" alt="picture" class="wait-icon">
            </p> 
              <span class="text-blue text_11 text-9 font-weight-bold">Wait Time</span> 
              <span class="text_11 text-9 font-weight-bold"> 
                ({{ doctor.profile.wait_time }})
              </span>
          </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 col-md-12 col-12">
          <div class="w-100 d-inline-block doctor-slider">
          <VueSlickCarousel 
          v-bind="c1Setting">
            <div v-if="userVideoWilling(doctor) === 'on'" class="w-90 d-block m-auto">
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
                            {{availableDayStringOnline(doctor)}}
                          </p>
                          <p class="text-red text_12 mb-0 font-weight-bold mt-1">
                              {{checkAvailabilityOnline(doctor)}}
                            <span class="float-right text_black">
                              <span class="text-blue">
                                Rs:
                              </span>
                               {{doctor.onlines[0].price}}
                            </span>
                          </p>
                        </div>
                      </div>
                      <a class="position-absolute circle_anchor" href="javascript:void(0)"  @click="$parent.showModal(doctor, 'online')" data-toggle="modal" data-target="#modal_patient_num"></a>
                      </div>
                <div  v-for="(docteam,index) in doctor.doc_teams" v-if="index < 3">
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
                               <div class="hospital-detail w-100 d-inline-block eclipse pt-1 p-2">
                                  <a class="text_black font-weight-bold text_12" 
                                  href="javascript:void(0)" >{{docteam.hospital.first_name + ' ' + docteam.hospital.last_name }}</a>
                                  <!-- <p v-if="docteam.user_id != 'online' " class="text_black mt-1 mb-0 text_12 overflow-hidden eclipse h-20" :title="docteam.hospital.profile.address">
                                    {{docteam.hospital.profile.address }}
                                  </p> -->
                                  <p class="text_black text_12 mb-0 mt-1 text-xs-11">
                                    {{availableDayStringOnline(doctor)}}
                                  </p>
                                  <p class="text-red font-weight-bold mb-0 text_12 mt-1">
                                    {{checkAvailabilityHospital(doctor)}}
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
                         <a class="position-absolute circle_anchor" href="javascript:void(0)"  @click="$parent.showModal(doctor, 'visit')" data-toggle="modal" data-target="#modal_patient_num"></a>
                      </div>
                      
                </div>
          </VueSlickCarousel>
          </div>
        </div>
      </div>
      <div class="row d-block d-lg-none d-md-none mt-3">
        <div class="col-lg-4 col-12 mt-xl-5 mt-2 col-md-4">
          <div class="view-profile-btn w-80 d-block m-auto text-center mt-2 mb-2 position-relative w-xs-100 w-sm-100 w-md-100">
        <a @click="$parent.showModal(doctor, 'visit')" :href="'/doctors/'+doctor.location.slug+'/'+doctor.specialities[0].slug+'/'+doctor.slug" class="d-md-block font-weight-bold text-center text-blue text_12 text-xs-10 float-left float-md-left small_btn w-sm-30 w-80 book-btn book-rounded book-padding book-border position-relative w-md-100 w-xs-48">Book appointment
          <span class="finger-icon bg-blue d-inline-block position-absolute">
            <img class="position-absolute" :src="basePath+'/images/finger-icon.png'" alt="pictire">
          </span>
        </a>
        <a v-if="userVideoWilling(doctor) === 'on'"  @click="$parent.showModal(doctor, 'online')" :href="'/doctors/'+doctor.location.slug+'/'+doctor.specialities[0].slug+'/'+doctor.slug" class="d-block text-center text-white font-weight-bold mt-lg-3 mb-lg-2 mt-md-0 mt-sm-0 mb-0 text_12 text-xs-10 float-right float-md-left float-sm-left float-lg-left small_btn w-sm-30 book-video-btn bg-green book-rounded book-padding position-relative w-md-100 ml-0 ml-md-0 mt-md-3 border-green ml-sm-3 w-xs-48 ml-lg-0 w-80">video consultation
          <span class="finger-icon video-cam-icon bg-blue d-inline-block position-absolute">
            <img class="position-absolute" :src="basePath+'/images/video-cam-icon.svg'" alt="pictire">
          </span>
        </a>
      </div>
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
import StarRating from 'vue-star-rating'
import VLazyImage from "v-lazy-image/v2";
Vue.component('star-rating', StarRating);

Vue.filter('dayFormat', function(value) {
  if (value) {
    return moment().day(value).format("dddd")
  }
});
/*.doctor_data{
  min-height: 135px;
}*/
export default {
  components: { VueSlickCarousel,VLazyImage},
  name: 'OtherDoctorCardComponent',
  props: ['doctor', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      c1Setting: {
        arrows: true,
        dots: false,
        focusOnSelect: true,
        slidesToShow:2,
        infinite: false,
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
      rating: 0.0,
      dayName: '',
    }
  },
  mounted(){
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  created () {
    let self = this
    let avgRating = 0.0
    if (this.doctor.feedbacks.length > 0) {
    this.doctor.feedbacks.forEach(function (feedback){
      avgRating += parseFloat(feedback.avg_rating)
    })
      this.rating = parseFloat(((avgRating/parseFloat(this.doctor.feedbacks.length))/5).toFixed(1))
    }
    else {
      this.rating = 0
    }
  },
  methods: {
    userVideoWilling(user){
      if(user.onlines.length > 0)
        return "on";
      else
        return "off";
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
    checkAvailability: function (user) {
      let availableDays = JSON.parse(user.profile.available_days)
      if (availableDays !== '') {
        let availability = '';
        let day1 = ((moment().format('ddd')).toLowerCase().trim());
        let day2 = ((moment().add(1, 'day').format('ddd')).toLowerCase().trim());
        let day3 = ((moment().add(2, 'day').format('ddd')).toLowerCase().trim());
        let day4 = ((moment().add(3, 'day').format('ddd')).toLowerCase().trim());
        let day5 = ((moment().add(4, 'day').format('ddd')).toLowerCase().trim());
        let day6 = ((moment().add(5, 'day').format('ddd')).toLowerCase().trim());
        let day7 = ((moment().add(6, 'day').format('ddd')).toLowerCase().trim());
        if (availableDays !== null) {
          if (availableDays.includes(day1) === true) {
            this.dayName = moment().day(day1).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day1).format('dddd')
            return availability = 'Available Today'
          } else if (availableDays.includes(day2)) {
            this.dayName = moment().day(day2).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day2).format('dddd')
            return availability = ' Available Tomorrow'
          } else if (availableDays.includes(day3)) {
            this.dayName = moment().day(day3).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day3).format('dddd')
            return availability = ' Available on ' + moment().add(2, 'day').format('dddd')
          } else if (availableDays.includes(day4)) {
            this.dayName = moment().day(day4).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day4).format('dddd')
            return availability = ' Available on ' + moment().add(3, 'day').format('dddd')
          } else if (availableDays.includes(day5)) {
            this.dayName = moment().day(day5).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day5).format('dddd')
            return availability = ' Available on ' + moment().add(4, 'day').format('dddd')
          } else if (availableDays.includes(day6)) {
            this.dayName = moment().day(day6).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day6).format('dddd')
            return availability = ' Available on ' + moment().add(5, 'day').format('dddd')
          } else if (availableDays.includes(day7)) {
            this.dayName = moment().day(day7).format('dddd').toLowerCase().trim()
            this.availableDayName = moment().day(day7).format('dddd')
            return availability = ' Available on ' + moment().add(6, 'day').format('dddd')
          } else {
            return availability = 'Not Available</em>'
          }
        } else {
          return availability = '<em class="dc-dayon">Not Available</em>'
        }
        return availability;
      }
      else {

      }
    },
    availableDayString(user) {
      let length = user.doc_teams.length
      let dayName = this.dayName;
      if(user.doc_teams[0].slots != null && user.doc_teams[0].slots != ""){
        if((JSON.parse(user.doc_teams[0].slots)[this.dayName]) != undefined && (JSON.parse(user.doc_teams[0].slots)[this.dayName]) != null){

          let start_end_time = ((JSON.parse(user.doc_teams[0].slots)[this.dayName]['start_end_time']));
          let start_end_time1 = ((JSON.parse(user.doc_teams[0].slots)[this.dayName]['start_end_time1']));
            if(start_end_time1 != '')
              return start_end_time+"\n"+start_end_time1;
            else
              return start_end_time ?? 'Not Available';
      }else{
        return 'Not Available';
      }
        
      }
      return 'Not Available';
    },
    docFee(user){
      var docPrice = [];
        if(user.doc_teams.length > 0){

        user.doc_teams.forEach(function(x) {
          docPrice.push(x.price);
        })
        return Math.min.apply(Math, docPrice);
        }
        return 0;
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
  }
}
</script>

<style scoped>
.vue-star-rating{
  margin-top: 2px;
}

@media(max-width:359px){
  .h_60{
    height:50px;
  } 
  .w_60px{
    width:50px;
  }
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