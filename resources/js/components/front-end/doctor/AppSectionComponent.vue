<template>
  <div>
    <div class="mobile_section" v-if="hide_show === 'true'">
      <div class="container">
        <div class="row">
          <!-- <div class="col-12 col-lg-6 col-md-6 offset-lg-6 text-center text-lg-left text-md-left careOnGoSectionList">
            
          </div> -->
          <div class="col-lg-6 col-12 col-md-6 p-0 text-lg-left text-center mt-4 mb-4 mb-lg-0 mt-lg-0">
            <div class="mobile_app_img">
              <img v-lazy="'/uploads/settings/home/'+ app_sec_img" class="img-fluid w-70 w-md-100" alt="Mobile App section Image" />
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-12 mb-0 mb-lg-3 mb-md-3">
            <div class="mobile_section_heading">
              <p>{{title}}</p>
              <h3>{{subtitle}}</h3>
            </div>
            <!-- <div v-html="description">
              <li class="text_sm_12 m-xs-0 md_line_height">
                
              </li>
            </div> -->
            <ul class="mobile_notes">
            <li class="text_14 m-xs-0 md_line_height">
              <i class="fa fa-check" aria-hidden="true">
              </i>
              <span class="w-80 d-inline-block ml-3 ml-xs-1">
                Book appointments 
              </span>
            </li>
            <li class="text_14 m-xs-0 md_line_height">
              <i class="fa fa-check" aria-hidden="true">
              </i>
              <span class="w-80 d-inline-block ml-3 ml-xs-1">
                Lab test 
              </span>
            </li>
            <li class="text_14 m-xs-0 md_line_height">
              <i class="fa fa-check" aria-hidden="true">
              </i>
              <span class="w-80 d-inline-block ml-3 ml-xs-1">
                Consult doctors online
              </span>
            </li>
            <li class="text_14 m-xs-0 md_line_height">
              <i class="fa fa-check" aria-hidden="true">
              </i>
              <span class="w-80 d-inline-block ml-3 ml-xs-1">
                Store health records 
              </span>
            </li>
            <li class="text_14 m-xs-0 md_line_height">
              <i class="fa fa-check" aria-hidden="true">
              </i>
              <span class="w-80 d-inline-block ml-3 ml-xs-1">
                Read health tips
              </span>
            </li>
              
          </ul>
          
          <form class="w-100 d-inline-block mt-3">
            <div class="form-inline phone_number w-100 float-right w-sm-100 position-relative">
              <p class="rounded-pill bg-white border p-2 w-10 w-sm-15 text-center d-inline-block mr-3 mr-xs-1 ml-xs-1 w-md-15">+92</p>
              <input type="text" maxlength="11" name="text" class="form-control rounded-pill pr-5" placeholder="Enter Number" v-model="phone_number"/>
              <span class="input-group-btn rounded-pill position-absolute doctor_app">
              <button v-on:click="appLinkNumber" class="btn bg-green text-white rounded-pill send_btn" type="button">Send
                <span>
                    <i class="fa fa-send fa-sm" aria-hidden="true"></i>
                  </span>
              </button>
            </span>
            </div>
          </form>
          <div class="apps_img mt-3 w-sm-100 w-100 text-center text-lg-right d-inline-block">
            <span class="ios_img float-right float-xs-none d-xs-inline-block w-sm-25 w-20 w-md-30">
              <a :href="ios_url">
                <img v-lazy="'/uploads/settings/home/'+ ios_img" alt="IOS image" name="IOS image" class="img-fluid"  /></a>
            </span>
            <span class="android_img mr-4 float-right float-xs-none d-xs-inline-block w-sm-25 w-20 w-md-30">
              <a :href="android_url">
                <img v-lazy="'/uploads/settings/home/'+ android_img" alt="Google Play image" name="Google Play image" class="img-fluid"/>
              </a>
          </span>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AppSectionComponent",
  props:[
    'managements',
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
      ios_img: ''

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
    appLinkNumber: function () {
      let self = this;
      self.loading = true
      if (self.phone_number === '' || self.phone_number.length < 1 ) {
        self.loading = false
        Vue.toasted.error('Enter your mobile number' , { duration: 3000 })
        return
      }
      else if (!(/^(3)([0-9]{2}[0-9]{7})$/.test(self.phone_number)) && !(/^(03)([0-9]{2}[0-9]{7})$/.test(self.phone_number)) && !(/^(923)([0-9]{2}[0-9]{7})$/.test(self.phone_number))) {
        self.loading = false
        Vue.toasted.error("Use Correct Format  923XXXXXXXXX" , { duration: 3000 })
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

<style scoped>

</style>