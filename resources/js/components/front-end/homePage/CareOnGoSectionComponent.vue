<template>
  <div>
    <div v-if="loading" id="loader"></div>
    <div class="mobile_section mb-lg-5 mb-3" v-if="hide_show === 'true'">
      <div class="container">
        <div class="row">
          <!-- <div class="col-12 col-lg-6 col-md-6 offset-lg-6 text-center text-lg-left text-md-left careOnGoSectionList">
            
          </div> -->
          <div class="col-12 col-lg-6 col-md-6 mt-4 mb-2 mt-lg-4 mb-lg-0">
            <div class="mobile_section_heading"w>
              <p class="knockdoc-heading service-text">{{title}}</p>
              <h3 class="service-text text-xs-20">{{subtitle}}</h3>
            </div>
            <!--  Dynamic care on the go section-->
            <!-- <div class="ml-sm-5 ml-md-0 ml-lg-0" v-html="description">
              <li class="text_sm_12 m-xs-0 md_line_height">
                
              </li>
            </div> -->
            <ul class="mobile_notes pl-xl-0 pl-3">
            <li class="text_sm_12 m-xs-0 md_line_height">
              <i class="fa fa-check" aria-hidden="true">
              </i>
              <span class="w-80 d-inline-block service-text text_14 ml-3 ml-xs-1">
                Book appointments 
              </span>
            </li>
            <li class="text_sm_12 text_14 m-xs-0 md_line_height">
              <i class="fa fa-check" aria-hidden="true">
              </i>
              <span class="w-80 d-inline-block ml-3 ml-xs-1 service-text">
                Lab test 
              </span>
            </li>
            <li class="text_sm_12 text_14 m-xs-0 md_line_height">
              <i class="fa fa-check" aria-hidden="true">
              </i>
              <span class="w-80 d-inline-block ml-3 ml-xs-1 service-text">
                Consult doctors online
              </span>
            </li>
            <li class="text_sm_12 text_14 m-xs-0 md_line_height">
              <i class="fa fa-check" aria-hidden="true">
              </i>
              <span class="w-80 d-inline-block ml-3 ml-xs-1 service-text">
                Store health records 
              </span>
            </li>
            <li class="text_sm_12 text_14 m-xs-0 md_line_height">
              <i class="fa fa-check" aria-hidden="true">
              </i>
              <span class="w-80 d-inline-block ml-3 ml-xs-1 service-text">
                Read health tips
              </span>
            </li>
            <li class="text_sm_12 text_14 m-xs-0 md_line_height">
              <i class="fa fa-check" aria-hidden="true">
              </i>
              <span class="w-80 d-inline-block ml-3 ml-xs-1 service-text">
                Download labs reports
              </span>
            </li>
            <li class="text_sm_12 text_14 m-xs-0 md_line_height">
              <i class="fa fa-check" aria-hidden="true">
              </i>
              <span class="w-80 d-inline-block ml-3 ml-xs-1 service-text">
                Instant video consultation
              </span>
            </li>
            <p class="ml-xs-0 mt-xs-2 service-text">DoctorFindy provides a good source for appointments booking,lab testing &for consulting Pakistan’s top doctors online. DoctorFindy keeps a record of your medical & medication history for future references. </p>
          </ul>
          <form class="w-100 d-inline-block mt-3">
            <div class="form-inline phone_number w-100 float-right w-sm-100 position-relative">
              <p class="box_radius bg-white border w-10 w-sm-15 w-md-15 text-center d-inline-block mr-3">+92</p>
              <input type="text"  name="text"  @keypress="isNumber($event)"class="form-control box_radius h_37" placeholder="03XXXXXXXXX" maxlength="11" 
              v-model="phone_number"/>
             <!--  <div v-if="errors.length" style="color:red;margin-left: 130px;">
                    <span> {{ errors[0] }}</span>
              </div> -->
              <span class="input-group-btn position-absolute">
              <button v-on:click="appLinkNumber" class="btn box_radius bg-green text-white send_btn" 
              type="button">Send
                <span>
                    <i class="fa fa-send fa-sm" aria-hidden="true"></i>
                  </span>
              </button>
            </span>
            </div>
          </form>
          <div class="apps_img mt-3 w-100 text-xs-center d-inline-block w-100">
            <span class="ios_img float-right float-xs-none d-xs-inline-block w-sm-30">
              <a :href="ios_url">
                <img v-lazy="basePath+'/uploads/settings/home/'+ ios_img" alt="IOS image" name="IOS image" class="img-fluid"  /></a>
            </span>
            <span class="android_img mr-4 float-right float-xs-none d-xs-inline-block w-sm-30">
              <a :href="android_url">
                <img v-lazy="basePath+'/uploads/settings/home/'+ android_img" alt="Google Play image" name="Google Play image" class="img-fluid"/>
              </a>
          </span>
          </div>
          </div>
          <div class="col-10 mx-auto col-lg-6 col-md-6 p-0">
            <div class="mobile_app_img text-md-center mt-4">
              <img v-lazy="basePath+'/uploads/settings/home/'+ app_sec_img" class="img-fluid w-70 w-md-100" alt="Mobile App section Image" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Toasted from 'vue-toasted';

Vue.use(Toasted)
export default {
  name: "CareOnGoSection",
  props:[
    'managements', 'fileSystemDriver'
  ],
  data() {
    return {
      download: '',
      phone_number: '',
      hide_show: '',
      title: '',
      subtitle: '',
      description: '',
      app_sec_img: '',
      android_url: '',
      android_img: '',
      ios_url: '',
      ios_img: '',
      loading: false,
      errors:[],
      basePath:'',

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
  },
  created() {
      this.download = this.managements.find(pf =>pf.meta_key ==='download_app_sec')
      this.title = JSON.parse(this.download.meta_value).title;
      this.subtitle = JSON.parse(this.download.meta_value).subtitle;
      this.description = JSON.parse(this.download.meta_value).description;
      this.app_sec_img = JSON.parse(this.download.meta_value).app_sec_img;
      this.android_img = JSON.parse(this.download.meta_value).android_img;
      this.android_url = JSON.parse(this.download.meta_value).android_url;
      this.ios_img = JSON.parse(this.download.meta_value).ios_img; 
      this.ios_url = JSON.parse(this.download.meta_value).ios_url;
      this.hide_show = JSON.parse(this.download.meta_value).show_app_sec; 
  },
  methods:{
     isNumber(e) {
      let char = String.fromCharCode(e.keyCode);
      if (/^[0-9]+$/.test(char)) return true;
      else e.preventDefault();
    },
    appLinkNumber: function () {
      let self = this;
      this.errors = [];
      if(!this.phone_number) this.errors.push("Mobile number required.");
      self.loading = true
      if (self.phone_number === '' || self.phone_number.length < 1 ) {
        self.loading = false
        Vue.toasted.error('Enter your mobile number' , { duration: 3000 })
        return
      }
      else if (!(/^(3)([0-9]{2}[0-9]{7})$/.test(self.phone_number)) && !(/^(03)([0-9]{2}[0-9]{7})$/.test(self.phone_number)) && !(/^(923)([0-9]{2}[0-9]{7})$/.test(self.phone_number))) {
        self.loading = false
        Vue.toasted.error("Use Correct Format  03XXXXXXXXX" , { duration: 3000 })
        return
      }
      if ((/^(3)([0-9]{2}[0-9]{7})$/.test(self.phone_number))) {
        self.phone_number = '92'+self.phone_number
      }
      if ((/^(03)([0-9]{2}[0-9]{7})$/.test(self.phone_number))) {
        self.phone_number = '92' + self.phone_number.substring(1)
      }
      axios.post(APP_URL + '/app-link-send',
        {
          id:self.phone_number,
        }
      ).then(function (response) {
        if (response.data.result === 'success') {
          self.loading = false
          Vue.toasted.success('App link sent on '+self.phone_number , { duration: 3000 })
          self.phone_number = ''
        }
        else {
          self.loading = false
          Vue.toasted.success(response.data.message , { duration: 3000 })
        }
      })
    },
  }
}
</script>
<style>

</style>