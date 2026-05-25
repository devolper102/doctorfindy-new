<template>
  <div>
    <div v-if="loading" id="loader"></div>
    <!-- Start Section Doctor Hospital Medical Center -->
    <!-- Start Doctor Profile -->
       <!-- <div class="container">
      <div class="row">
            <div class="col-12 mt-4">
              <bread-crumb-spec></bread-crumb-spec>
            </div>
      </div>
    </div> -->
    <div class="container">
      <div class="col-md-12 bg-white box_radius">
        <div class="row">
          <div class="col-12 col-lg-9 col-md-8 hos_profile p-0">
            <div class="doctor_profile_left pt-3 pb-3 w-100">
              <div class="pr-xs-0 pr-sm-0 pr-md-0 pr-lg-2">
                <div class="doctor_image position-relative float-left mr-1 mr-lg-3 mr-md-2 pb-2">
                  <img v-lazy="basePath+'/uploads/users/'+user.id+'/small-'+user.profile.avatar" :alt="user.first_name+' '+user.last_name" :name="user.first_name+' '+user.last_name" class="img-fluid rounded-circle h_110 w_110px w_md_60px h_md_60" :onerror="`this.src=${basePath}/uploads/users/default/hospital.svg`">
                  
                  <div class="total_rating text-center mt-2">
                    <span> <span class="text-green font-weight-bold"><i class="fa fa-star"></i>
                      {{ user.feedbacks | averageRating }}
                    </span> ({{ user.feedbacks.length }})</span>
                  </div>
                  <!-- <div class="float-left text-center w-100 mt-2">
                    <p v-if="user.feedbacks.length > 0" class="badge bg-green text-white text_14 
                      d-inline-block">
                      <i class="fa fa-thumbs-up"></i> {{ user.profile.votes / user.feedbacks.length * 100 }}%
                    </p>
                    <p v-else class="badge bg-green text-white text_14 d-inline-block">
                      <i class="fa fa-thumbs-up"></i> 0%
                    </p>
                  </div> -->
                </div>
                <div class="prfile_detail float-xs-left float-sm-left float-md-left float-lg-none w-sm-70 overflow-hidden">
                  <div class="doctor_name float-left w-100">
                         <a class="doctor_name float-left w-100 text-blue" :href="'/hospitals/'+user.location.slug+'/'+ user.slug"> {{user.first_name}} {{user.last_name}}</a>

                        
                  </div>
                  
                  <div class="doctor_detail_degree text_black d-lg-inline-block text_md_13 w-100 float-left">
                    <!-- <p class="d-none d-lg-block text-truncate 
                    w-100 text_12">{{user.address}}</p> -->
                    <p class="d-none d-lg-block text-truncate 
                    w-100 text_12">
                      {{ user.profile.address ? user.profile.address : '' }},<span v-if="user.area === null || user.area === 'null' || user.area === '' || user.area === 'undefined' || user.area === undefined || user.area === 0 "></span>
                      <span v-else>{{ user.area_id ? user.area.title : '' }}</span>
                       {{ user.adress ? user.location.title : '' }}</p>
                    <p class="text-black text_12">
                      <span class="text-blue font-weight-bold">
                        Open
                      </span>
                    24/7 Hours</p>
                    <p class="d-block text-blue text_12">{{ user.teams.length }} Doctors available</p>
                    <!-- <span class="theme-color-text">
                              {{ user.profile.total_experience }} Years
                            </span>
                            Experience -->
                  </div>
                  <div class="d-none d-lg-inline-block d-md-inline-block">
                    <span class="availability_shedule mb-2 d-inline-block text_12 font-weight-bold">
                      <!-- <i class="fa fa-calendar mr-3 theme-color-text"></i> -->Available Services
                    </span>
                    <ul class="clinic_detail w-100 d-inline-block mb-0">
                      <span class="w-100 d-inline-block" v-if="user.profile.hospital_services === ''|| user.profile.hospital_services === 'null'||user.profile.hospital_services === null">
                          <p class="text-blue text_14">No Services Provided</p>
                      </span>  
                      <span class="w-100 d-inline-block" v-else>
                        <li v-for="serv in convertJsonToString(user.profile.hospital_services)">
                          <span class="fa fa-check float-left"></span>
                          <span class="w-80 float-left clinic-detail-text">
                            {{serv}}
                          </span>
                        </li>
                      </span>  
                      <!-- <span v-else>        -->  
                       <!--  <li class="float-left w-50 profile_services_list" v-for="(service,name,index) in services" v-if="service === true && index <= 5">
                          <i class="fa fa-check img-fluid mr-2 mt-2 float-left pt-1" aria-hidden="true"style="color:#ea4335;"></i>
                          <span class="text_mdH_12 text_xs_11">{{name.capitalize()}}</span>
                        </li> -->
                      <!-- </span> -->
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-3 col-md-4">
            <div class="doctor_profile_right pt-lg-3 pb-3">
              <div class="row">
                <div class="col-12 col-lg-8 col-md-9 d-inline-block d-lg-none d-md-none">
                  <div class="hospitals_services_mobile d-inline-block w-100">
                    <span class="availability_shedule mb-2 d-inline-block">
                      <!-- <i class="fa fa-calendar mr-3 theme-color-text"></i> --><b>Available Services</b>
                    </span>
                    <ul class="clinic_detail w-100 d-inline-block mb-0">
                      <span v-if="user.profile.hospital_services === ''|| user.profile.hospital_services === 'null'||user.profile.hospital_services === null">
                          <p style="color:red">No Services Provided</p>
                      </span>  
                      <span v-else>
                        <li v-for="serv in convertJsonToString(user.profile.hospital_services)">
                          <span class="fa fa-check float-left">
                            <span class="w-80 clinic-detail-text">
                              {{serv}}
                            </span>
                          </span>
                        </li>
                      </span>  
                      <!-- <span v-else>        -->  
                       <!--  <li class="float-left w-50 profile_services_list" v-for="(service,name,index) in services" v-if="service === true && index <= 5">
                          <i class="fa fa-check img-fluid mr-2 mt-2 float-left pt-1" aria-hidden="true"style="color:#ea4335;"></i>
                          <span class="text_mdH_12 text_xs_11">{{name.capitalize()}}</span>
                        </li> -->
                      <!-- </span> -->
                    </ul>
                  </div>
                  <!-- <div class="mobile_design d-block d-lg-none">
                    <div class="Satisfy_percentage mt-3 mb-3">
                       <p v-if="user.feedbacks.length > 0" class="badge knockdoc_sign_up_bg text-white text_md_13">
                        <i class="fa fa-thumbs-up"></i> {{ user.profile.votes / user.feedbacks.length * 100 }}%
                      </p>
                       <p v-else class="badge knockdoc_sign_up_bg text-white text_md_13">
                        <i class="fa fa-thumbs-up"></i> 0%
                      </p>
                    </div>
                  </div> -->
                  <p class="w-100 d-inline-block mb-3 mt-3">
                      {{ user.profile.address ? user.profile.address : '' }},<span v-if="user.area === null || user.area === 'null' || user.area === '' || user.area === 'undefined' || user.area === undefined || user.area === 0 "></span><span v-else>{{ user.area_id ? user.area.title : '' }}</span> {{ user.location_id ? user.location.title : '' }}
                  </p>
                </div>
                <div class="col-12 col-lg-12 col-md-12 p-0">
                  <div class="doctor_profile_right pt-lg-3 pb-lg-3 pl-lg-0 pl-xs-0 pl-sm-0 pl-md-0">
                        <div class="list_btns d-xs-inline-block w-100 pb-lg-3 pl-lg-5 pl-xs-0 pl-sm-0 pl-md-0 position-relative">
                          <!-- <a href="#" class="d-block rounded-pill text-center knockdoc_doctor_profile_btn mt-1 mb-2 text_14 text_md_12 float-right float-lg-none float-md-none small_btn w-100 d-md-inline-block w-100 mb-2 mb-lg-2 share-network-facebook">
                                Share Profile
                              </a> -->
                                <ShareNetwork
                                  class="d-md-block font-weight-bold text-center text-blue text_12 text-xs-10 float-left float-md-left small_btn w-sm-30 w-80 book-btn book-rounded book-padding book-border position-relative w-md-100 w-xs-48"
                                  network="facebook"
                                  :url="APP_URL+'/hospitals/'+user.location.slug+'/'+ user.slug"
                                  :title=" user.first_name+' '+user.last_name "
                                  :description=" user.sub_heading "
                                  quote="The hot reload is so fast it\'s near instant. - Evan You"
                                  hashtags="DoctorFindy"
                              >
                                Share Profile
                                <span class="finger-icon bg-blue d-inline-block position-absolute">
                                  <img :src="basePath+'/images/share-image-icon.svg'" alt="pictire"></span>
                              </ShareNetwork>
                          <!-- <a href="javascript:void(0)" @click="showReportModal" class="d-block rounded-pill text-center knockdoc_doctor_profile_btn text_14 text_md_12 text_mdH_12 float-left float-lg-none small_btn w-80 mb-2 mb-lg-2 w-sm-48 mr-lg-0 mr-2 text-white"><i class="fa fa-flag d-md-none d-lg-inline-block" aria-hidden="true"></i> Report Hospital</a> -->
                          <a target="_blank" v-if="user.location_id" :href="'https://maps.google.com/?q='+user.profile.latitude+'+'+user.profile.longitude" class="d-block text-center text-white font-weight-bold mt-lg-3 mb-lg-2 mt-md-0 mt-sm-0 mb-0 text_12 text-xs-10 float-right float-md-left float-sm-left float-lg-left small_btn w-sm-30 book-video-btn bg-green book-rounded book-padding position-relative w-md-100 ml-0 ml-md-0 mt-md-3 border-green ml-sm-3 w-xs-48 ml-lg-0 w-80">Get Direction
                            <span class="finger-icon bg-blue d-inline-block position-absolute"><img :src="basePath+'/images/direction-icon-image.svg'" alt="pictire"></span>
                          </a>
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
    <!-- End Section Doctor Hospital Medical Center -->
    <report
        :user="user"
        :patient="patient"
    ></report>

  </div>
</template>

<script>
import VueSocialSharing from 'vue-social-sharing'
import VLazyImage from "v-lazy-image/v2";


Vue.use(VueSocialSharing)
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1).split('_').join(' ');
}
Vue.filter('averageRating', function(value) {
  let avgRating = 0.0
  if (value.length > 0) {
    value.forEach(function (feedback){
      avgRating += parseFloat(JSON.parse(feedback.avg_rating))
    })
    return (avgRating/value.length).toFixed(1)
  }
  else {
    return '0'
  }

});
export default {
  components: 
  {
    VLazyImage
  },
  name: 'HospitalTabComponet',
  props: ['user', 'patient','segments', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      environment: 0.0,
      staffBehaviour: 0.0,
      checkUp: 0.0,
      loading: false,
      services: [],
       resultSegments: this.segments,
        APP_URL: APP_URL,
    }
  },
  created () {
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
    // let services = this.user.profile.hospital_services
    // this.services = JSON.parse(services)

    let self = this
    if (this.user.feedbacks.length > 0) {
      this.user.feedbacks.forEach(function (x) {
        let rating = JSON.parse(x.rating)
        self.environment += parseFloat(rating['environmentRating'])
      })
      self.environment = (self.environment / this.user.feedbacks.length ).toFixed(1)
    }
    else {
      self.environment = 0
    }

    if (this.patient.length === undefined) {
      this.saved_doctors = JSON.parse(this.patient.profile.saved_doctors)
    }
    else {
      this.saved_doctors = []
    }
  },
  methods: {
    showReportModal: function () {
      this.loading = true
      if(this.patient.length === undefined) {
        document.querySelector('#doctor-report-modal').classList.add('show')
        document.querySelector('#doctor-report-modal').classList.add('feedback_modle')
        document.querySelector('#doctor-report-modal').style.display = "block"
      }
      else {
        Vue.toasted.show('Please Login First' , { duration: 3000 })
      }
      this.loading = false
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
            });       
        });
        this.hospital_services = data;
        return data;
    },
  }
}
</script>

<style scoped>
.clinic_detail{
  line-height: normal;
}
.clinic_detail li{
  display: inline-block;
  width: 115px;
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