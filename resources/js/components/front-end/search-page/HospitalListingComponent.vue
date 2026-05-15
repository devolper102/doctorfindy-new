<template>
  <div>
        <div class="row bg-white box_radius mt-4 mb-4 box_shadow" v-for="(user, index) in allusers" v-if="index < doctorsToShow">
          <div class="col-12 cstm_border_right">
            <div class="row">
            <div class="col-lg-8 col-md-8 col-12">
              <div class="d-inline-block w-100 doctor_profile_left pt-3 pb-0 mb-lg-3 mb-md-3">
                <div class="pr-0 pr-lg-2 d-flex">
                  <div class="user_imgSec doctor_image position-relative float-left mr-1 ">
                    <div class="position-relative mb-2">
                      <v-lazy-image v-if="user.profile.avatar" :src="basePath+'/uploads/users/'+user.id+'/small-'+user.profile.avatar" :alt=" user.first_name + ' ' + user.last_name " :name=" user.first_name + ' ' + user.last_name " class="img-fluid rounded-circle h_110 w_110px w_md_60px h_md_60 w-xs-40px h-xs-40px" @error="onUserImgLoadFailure($event)"/>
                      <v-lazy-image v-else :src="basePath+'/uploads/users/default/hospital.svg'" :alt=" user.first_name + ' ' + user.last_name" :name=" user.first_name + ' ' + user.last_name " class="img-fluid rounded-circle h_110 w_110px w_md_60px h_md_60 w-xs-40px h-xs-40px"/>
                      <a href="#" class="circle_anchor position-absolute"></a>
                    </div>
                    <div class="total_rating w-80 m-auto w-md-100">
                      <span class="text-blue">
                        <star-rating
                            class="w-15 float-left m-0 vue-star-rating w-xs-45"
                            :max-rating="1"
                            :show-rating="false"
                            v-model="rating"
                            :increment="rating"
                            :rating="rating"
                            inactive-color="#cccccc"
                            active-color="#FF465C"
                            v-bind:star-size="14"
                        ></star-rating>
                        <!--                <i class="fa fa-star" aria-hidden="true"></i> -->
                          <span class=" float-left text-center mr-1 ml-1 text-blue">{{ feedbacks(user) }}
                          </span>
                          <span class="d-inline-block text-blue"> ({{ user.feedbacks.length }})</span>
                      </span>
                    </div>
                    <div class="Satisfy_percentage mt-1 ml-3 d-none d-lg-block d-md-block ml-md-0 ml-lg-3">
                      <span class="badge bg-blue text-white text_14 font-weight-normal">
                        <i class="fa fa-thumbs-up"></i>
                        <span v-if="user.profile.votes !== 'null' && user.profile.votes !== '' && user.profile.votes !== null && user.profile.votes !== 0 && user.profile.votes !== undefined">
                          {{ (user.profile.votes / user.feedbacks.length * 100).toFixed(0) }}%</span>
                          <span v-else>
                            0%
                          </span>
                      </span>
                      <span class="text_10 d-none">Satisfied patients</span>
                    </div>
                  </div>
                  <div class="profile_inner prfile_detail float-left float-lg-none overflow-hidden">
                    <div class="doctor_name float-left float-lg-none w-100">
                      <a class="w_md_80 w-xs-80 d-inline-block" :href="'/hospitals/'+user.location.slug+'/'+user.slug">
                        <h2 class="d-inline-block text_md_13">{{ user.first_name }} {{ user.last_name }}
                          <span class="ml-1">
                            <v-lazy-image v-if="user.profile.verify_registration" :src="basePath+'/images/check.png'" v-tooltip="verified_message" alt="Check" class="img-fluid"/>
                          </span>
                          <span>
                            <v-lazy-image v-if="user.profile.verify_medical !== ''" :src="basePath+'/images/shield.png'" v-tooltip="medical_message" alt="Shield" class="img-fluid"/>
                          </span>
                        </h2>
                      </a>
                      <div class="waitng_time d-inline-block float-lg-right text_md_13 float-none float-md-right">
                        <span class="text_black font-weight-bold">Open</span>
                        <span class="text-blue font-weight-bold mr-4"> 24/7 Hours</span>
                        <a href="javascript:void(0)" class="wishlist_icon" 
                          v-bind:style=" saved_doctors.includes(user.id) ? 'color: #ff465c !important;' : 'color: #BCBCBC;' "
                           @click="wishlist(user.id, '', 'saved_doctors')">
                          <i class="fa fa-heart text_md_20 text_25 text-xs-14"></i>
                        </a>
                      </div>
                    </div>
                    <div class="doctor_degree text_black d-lg-inline-block d-md-inline-block text_md_13 w-100 d-none">
                      <!--   <p>
                        <span v-for="(spec, index) in user.specialities" v-if="index <= 6">
                          {{ spec.title }}
                        </span>
                      </p> -->
                      <!-- <p class="text_14 text_md_13 d-lg-block">{{ user.profile.sub_heading }}</p> -->
                      <p class="text_14 text_md_13 d-lg-block">{{ user.profile.address }}</p>
                      <p class="text_14 text_md_13 d-lg-block font-weight-bold">{{ user.teams.length }} Doctors Available</p>
                      <!-- <span>
                        <v-lazy-image src="/images/experience.png" :alt=" user.first_name + ' ' + user.last_name " :name=" user.first_name + ' ' + user.last_name " class="img-fluid mr-2"/>
                        <span class="theme-color-text font-weight-bold">
                          {{ user.profile.total_experience }} Years
                        </span>
                        Experience
                      </span>
                      <span class="d-block">
                        <v-lazy-image src="/images/rs.png" :alt=" user.first_name + ' ' + user.last_name " :name=" user.first_name + ' ' + user.last_name " class="img-fluid mr-2"/>
                        <span class="theme-color-text font-weight-bold">Rs</span> {{ feesRange(user.profile.fees_range) }} </span> -->
                        <span class="availability_shedule mb-2 d-inline-block"><!-- <i class="fa fa-calendar mr-3 theme-color-text"></i> --><b>Available Services</b></span>
                        <ul class="clinic_detail w-100 d-inline-block mb-0">
                         <span v-if="user.profile.hospital_services === ''|| user.profile.hospital_services === 'null'||user.profile.hospital_services === null">
                            <p class="text-blue">No Services Provided</p>
                          </span>  
                          <span v-else>
                              <!-- <p >{{convertJsonToString(user.profile.hospital_services)}}</p> -->
                            <li v-for="serv in convertJsonToString(user.profile.hospital_services)">
                                <span class="fa fa-check float-left">
                                </span>
                                <span class="w-80 float-left clinic-detail-text">
                                  {{serv}}
                                </span>
                            </li>
                          </span>
                        </ul>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="doctor_degree text_black d-lg-none d-md-none text_md_13 w-100 d-inline-block pl-3 pr-3">
              <!--   <p>
                <span v-for="(spec, index) in user.specialities" v-if="index <= 6">
                  {{ spec.title }}
                </span>
              </p> -->
              <!-- <p class="text_14 text_md_13 d-lg-block">{{ user.profile.sub_heading }}</p> -->
              <p class="text_14 text_md_13 d-lg-block font-weight-bold my-2">{{ user.teams.length }} Doctors Available</p>
              <!-- <span>
                <v-lazy-image src="/images/experience.png" :alt=" user.first_name + ' ' + user.last_name " :name=" user.first_name + ' ' + user.last_name " class="img-fluid mr-2"/>
                <span class="theme-color-text font-weight-bold">
                  {{ user.profile.total_experience }} Years
                </span>
                Experience
              </span>
              <span class="d-block">
                <v-lazy-image src="/images/rs.png" :alt=" user.first_name + ' ' + user.last_name " :name=" user.first_name + ' ' + user.last_name " class="img-fluid mr-2"/>
                <span class="theme-color-text font-weight-bold">Rs</span> {{ feesRange(user.profile.fees_range) }} </span> -->
                <span class="availability_shedule mb-2 d-inline-block"><!-- <i class="fa fa-calendar mr-3 theme-color-text"></i> --><b>Available Services</b></span>
                <ul class="clinic_detail w-100 d-inline-block mb-0">
                 <span v-if="user.profile.hospital_services === ''|| user.profile.hospital_services === 'null'||user.profile.hospital_services === null">
                    <p style="color:red">No Services Provided</p>
                  </span>  
                  <span v-else>
                      <!-- <p >{{convertJsonToString(user.profile.hospital_services)}}</p> -->
                      <li v-for="serv in convertJsonToString(user.profile.hospital_services)">
                        <span class="fa fa-check float-left"></span>
                        <span class="w-80 float-left clinic-detail-text">{{serv}}</span>
                      </li>
                  </span>
                </ul>
                <p class="text_14 text_md_13 d-lg-block">{{ user.profile.address }}</p>
              </div>
            <div class="col-lg-4 col-md-4 col-12">
        <div class="doctor_profile_right pb-lg-3 pl-lg-5 pl-xs-0 pl-sm-0 pl-md-0">
          <div class="row">
            <div class="col-md-12">
              
              <div class="list_btns w-100 d-inline-block pb-2 pl-lg-0 mt-lg-4 pt-lg-2 mt-md-5 mt-3">
                <a :href="'/hospitals/'+user.location.slug+'/'+user.slug" class="d-md-inline-block text-center text_13 text_md_12 float-left float-md-none small_btn w-sm-45 w-100 mb-2 book-border book-padding text-blue book-rounded font-weight-bold">View Details</a>
                <a target="_blank" v-if="user.location_id" :href="'https://maps.google.com/?q='+user.profile.latitude+'+'+user.profile.longitude" class="d-block text-center border-green bg-green book-padding text-white mt-lg-2 mb-lg-3 mt-0 mb-0 text_13 text_md_12 float-right float-md-none float-lg-none small_btn w-sm-45 book-rounded font-weight-bold">Get Direction</a>
                <a :href="'/hospitals/'+user.location.slug+'/'+user.slug+'#onBoardSection'" class="d-block text-center book-border book-padding text-blue book-rounded text_md_12 float-left float-lg-none text_13 font-weight-bold small_btn w-md-100 mt-3 mt-md-1 mt-lg-0">On board Doctors</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
        </div>
         <span class="more_option w-100 text-center d-inline-block mb-4" v-if="allusers.length > 9">
              <a href="javascript:void(0)" @click="showMore"  class="rounded-pill bg-blue text-white p-2 btn_padding d-inline-block">
                View more Hospital
                <i aria-hidden="true" class="fa fa-arrow-right ml-1"></i>
              </a>
            </span>
  </div>
</template>

<script>
import Vue from 'vue'
import Toasted from 'vue-toasted';
import VTooltip from 'v-tooltip'
import VLazyImage from "v-lazy-image/v2";

Vue.use(Toasted)
export default {
  components: {VTooltip, VLazyImage},
  name: "HospitalListingComponent",
  props: ['users', 'fileSystemDriver'],
  data() {
    return{
      basePath:'',
      availableDayName: '',
      rating: 0.0,
      dayName: '',
      doctorsToShow: 10,
      page: 1,
      allusers: this.users,
      savedDoctors: false,
      saved_doctors: [],
      verified_message: 'Verified User',
      medical_message: 'Medical Registration Verified',
      services: [],
      hospital_services: []
    }
  },
  created () {
    this.availableDayName = ''
    if (this.$parent.patientData.length !== 0){
      if (this.$parent.patientData.profile.saved_doctors) {
        if (this.$parent.patientData.length === undefined) {
          this.saved_doctors = JSON.parse(this.$parent.patientData.profile.saved_doctors)
        }
      }
    }
    else {
      this.saved_doctors = []
    }
  },
  mounted () {
   // console.log('checkuser',this.users);
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  methods: {
    onUserImgLoadFailure(event)
    {
      event.target.src=this.basePath+'/uploads/allusers/default/hospital.svg';
    },
    showMore(){
        if(this.doctorsToShow < this.allusers.length){
          this.doctorsToShow += 10; 
          // console.log(window.location.href);
        }else{
          const getLastItem = thePath => thePath.substring(thePath.lastIndexOf('/') + 1)
          this.$parent.loading = true
          this.page = this.page+1;
          var city = getLastItem(window.location.href);
         axios.get(window.location.origin+'/nexthospital?page='+this.page+'&city='+city)
            .then((response) => {
              response.data.forEach((item) => { 
                  this.allusers.push(item);
              })
              this.$parent.loading = false
              this.doctorsToShow += 10;
            })
            .catch((error) => {
              // console.log(error);
            });
        }
    },
    titleCase: (str) =>{
         var splitStr = str.toLowerCase().split(' ');
         for (var i = 0; i < splitStr.length; i++) {
             // You do not need to check if i is larger than splitStr length, as your for does that for you
             // Assign it back to the array
             splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
         }
         // Directly return the joined string
         return splitStr.join(' '); 
    },
    convertJsonToString($value){
        var json = $.parseJSON($value);
        var data =[];
        $(json).each(function(i,val){
          $.each(val,function(k,v){
            if(v == true){
              var option = k.replace(/_/g, " ");
              option = option.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();})
               data.push(option);
            }
            // console.log(k+" : "+ v);
            });       
        });
        this.hospital_services = data;
        return data;
    },
    feedbacks(user){
    if (user.feedbacks.length > 0) {
      user.feedbacks.forEach(function (x) {
        let rating = JSON.parse(x.rating)
       this.environment += parseFloat(rating['environmentRating'])
      })
      this.environment = (self.environment / user.feedbacks.length ).toFixed(0)
    }
    else {
      this.environment = 0
    }
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

    return this.rating;
    },
    feesRange(fee) {
      let fees = JSON.parse(fee)
      return fees['from_fees'] + ' - ' + fees['to_fees']
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
            this.dayName = day1
            this.availableDayName = moment().day(day1).format('dddd')
            return availability = 'Available Today'
          } else if (availableDays.includes(day2)) {
            this.dayName = day2
            this.availableDayName = moment().day(day2).format('dddd')
            return availability = ' Available Tomorrow'
          } else if (availableDays.includes(day3)) {
            this.dayName = day3
            this.availableDayName = moment().day(day3).format('dddd')
            return availability = ' Available on ' + moment().add(2, 'day').format('dddd')
          } else if (availableDays.includes(day4)) {
            this.dayName = day4
            this.availableDayName = moment().day(day4).format('dddd')
            return availability = ' Available on ' + moment().add(3, 'day').format('dddd')
          } else if (availableDays.includes(day5)) {
            this.dayName = day5
            this.availableDayName = moment().day(day5).format('dddd')
            return availability = ' Available on ' + moment().add(4, 'day').format('dddd')
          } else if (availableDays.includes(day6)) {
            this.dayName = day6
            this.availableDayName = moment().day(day6).format('dddd')
            return availability = ' Available on ' + moment().add(5, 'day').format('dddd')
          } else if (availableDays.includes(day7)) {
            this.dayName = day7
            this.availableDayName = moment().day(day7).format('dddd')
            return availability = ' Available on ' + moment().add(6, 'day').format('dddd')
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
    },
    availableDayString(user) {
      let length = user.doc_teams.length
      let end_time = ((JSON.parse(user.doc_teams[length-1].slots)[this.dayName]['end_time']).trim()).toUpperCase()
      let start_time = ((JSON.parse(user.doc_teams[length - length].slots)[this.dayName]['start_time']).trim()).toUpperCase()

      return start_time + ` - ` + end_time
    },
    wishlist: function (id, savedDoc, column) {
      let self = this;
      let form_errors = [];
      if (self.saved_doctors == null) {
        axios.post(APP_URL + '/user/add-wishlist', {
          id: id,
          column: column,
        }).then(function (response) {
          if (response.data.authentication == true) {
            if (response.data.type == 'success') {
              if (column == 'saved_doctors') {
                self.saved_doctors.push(id);
                Vue.toasted.success( response.data.message  , { duration: 3000 })
              }
              else if (column == 'saved_hospitals') {
              }
              else if (column == 'saved_articles') {
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
      else if (self.saved_doctors.includes(id) == true) {
        axios.post(APP_URL + '/user/remove-wishlist', {
          id: id,
          column: column,
        }).then(function (response) {
          if (response.data.authentication == true) {
            if (response.data.type == 'success') {
              if (column == 'saved_doctors') {
                self.saved_doctors.pop(id);
                Vue.toasted.success(response.data.message , { duration: 3000 })
              }
            }
          }
        })
      }
      else if (self.saved_doctors.includes(id) == false) {
        axios.post(APP_URL + '/user/add-wishlist', {
          id: id,
          column: column,
        }).then(function (response) {
          if (response.data.authentication == true) {
            if (response.data.type == 'success') {
              if (column == 'saved_doctors') {
                self.saved_doctors.push(id);
                Vue.toasted.success(response.data.message , { duration: 3000 })
              }
              else if (column == 'saved_hospitals') {
              }
              else if (column == 'saved_articles') {
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
    }
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
.clinic_detail{
  line-height: normal !important;
}
.clinic_detail li{
  display: inline-block;
  width: 120px;
  font-size: 12px;
  margin-bottom: 10px;
}
.clinic_detail li .fa-check{
  color: #0E4D92;
  padding-right:10px;
  margin-top: 2px;
}
.clinic_detail .clinic-detail-text{
font-family: 'robotoregular', Helvetica, Arial, Sans-Serif;
}




</style>