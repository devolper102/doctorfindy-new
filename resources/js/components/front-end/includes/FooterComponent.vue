<template>
  <div>
    <div v-if="loading" id="loader"></div>
    <footer class="footer_main">
      <div class="w-100 d-none pb-3 bg-green" v-if="hideSubscribe === false && subSection === 'true'">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-md-6 col-12">
              <div class="heading-subscribe-now">
                <h2 class="text-white mt-4 mt-lg-4 mt-md-3 mb-0">{{subTitle}}</h2>
                <!-- <p class="text_black w-75 w-sm-100"><span  v-html="subDescription"></span></p> -->
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
              <form class="d-inline-block w-100 mt-3 mt-lg-4 mb-0">
                <div class="form-group enter-email w-100 float-left position-relative m-0">
                  <input v-model="email" class="subscribe-input w-100 pr-5 pl-3 pr-4 pt-3 pb-2 text_14 box_radius" type="email" id="subscribeInputEmail1" 
                  placeholder="Enter your email " />
                 <!--  <div v-if="errors.length" style="color:red">
                    <span> {{ errors[0] }}</span>
                  </div> -->
                  <div class="subscribe-btn float-left w-30 position-absolute">
                    <a @click="submitEmail" href="javascript:void(0)" class="box_radius text-white d-inline-block 
                    text_14 bg-green">Subscribe
                    </a>
                  </div>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="footer_col">
        <!-- style="background-image: url('../../images/footer_background.png');" -->
        <div class="main_footer">
        <div class="container-fluid">
          <div class="row d-xl-none d-block">
              <div class="col-12">
                <div class="w-100 d-inline-block">
              <div class="footer-logo mt-3 w-100 d-inline-block">
                <a href="/">
                  <img class="img-fluid w-80 w-sm-50 w-md-30 ipad_30" v-bind:src="basePath+'/uploads/settings/general/footer/'+ footerLogo"alt="Footer Logo" name="Footer Logo"  />
                  <!-- <img src="/images/doctorfindy-logo.png" alt="logo-img picture"> -->
                </a>
                <p class="text-white w-100 mt-3">
                  <span  v-html="footerDescription"></span>
                </p>
              </div>
              <div class="w-100 d-inline-block mt-2">
                <p class="text-white text_20">
                  صحت آپکی، ساتھ ہمارا
                </p>
              </div>
            </div>
              </div>
            </div>
          <div class="row pb-xl-5">
            <div class="col-lg-3 col-md-12 col-12 col-sm-4 mt-3 order-lg-1 order-6">
              <div class="w-100 d-xl-inline-block d-none">
              <div class="footer-logo text-center">
                <a href="/">
                  <img class="img-fluid w-80 w-sm-50 w-md-20" v-bind:src="basePath+'/uploads/settings/general/footer/'+ footerLogo"alt="Footer Logo" name="Footer Logo"  />
                  <!-- <img src="/images/doctorfindy-logo.png" alt="logo-img picture"> -->
                </a>
                <p class="text-white w-100 mt-3">
                  <span  v-html="footerDescription"></span>
                </p>
              </div>
              <div class="w-100 d-inline-block mt-2 text-center">
                <p class="text-white text_30">
                  صحت آپکی، ساتھ ہمارا
                </p>
              </div>
            </div>
              <!-- <div class="google-play-image w-100 mt-3 d-inline-block text-center">
                <a class="w-30 d-inline-block mr-2" :href="ios_url">
            <img v-lazy="'/uploads/settings/home/'+ ios_img"alt="IOS image" name="IOS image"class="img-fluid"  /></a>
                 <a class="w-30 d-inline-block" :href="android_url">
             <img v-lazy="'/uploads/settings/home/'+ android_img"alt="Google Play image" name="Google Play image"class="img-fluid"  /></a>
              </div> -->
              <div class="social-icon float-lg-right mt-3 w-100 d-inline-block text-center">
                <a v-for="socialIcon in socialIcons" class="service-text d-inline-block mr-3 pl-1 pt-1 pr-1 text-center zoom-text" 
                :href="socialIcon.url">
                <i :class="socialIcon.icon" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-lg-1 col-md-6 col-6 col-sm-4 mt-4 order-lg-2">
              <ul class="navbar-nav footer-content">
                <li class="text-white pb-2 text_14 text_sm_15">
                  <span>Top Cities</span>
                </li>
                <li class="nav-item zoom-text" v-for="(location, index) in locations" v-if="index < 6">
                  <a class="nav-link text-white pt-1 pb-1 text_12" v-bind:href="'/doctors/'+ location.slug">{{location.title}}</a>
                </li>
                <li class="nav-item zoom-text">
                  <a class="text_14 text-white" href="/doctors">View All</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-2 col-md-6 col-6 col-sm-4 mt-4 order-lg-3">
              <ul class="navbar-nav footer-content ml-xl-5">
                <li class="text-white pb-2 text_14 text_sm_15">
                  <span>Top Specialties
                  </span>
                </li>
                <li class="nav-item zoom-text" v-for="(specialty, index) in specialities" v-if="index < 6">
                  <a class="nav-link text-white pt-1 pb-1 text_12" :href="'/'+specialty.slug+'-in-pakistan'">{{specialty.title}}</a>
                </li>
                <li class="nav-item zoom-text">
                  <a class="text_14 text-white" 
                  href="/find-a-doctor-near-you">View All</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-2 col-md-6 col-6 col-sm-4 mt-4 order-lg-4">
              <ul class="navbar-nav footer-content">
                <li class="text-white pb-2 text_14 text_sm_15">
                  <span>Top Hospitals
                  </span>
                </li>
                <li class="nav-item zoom-text" v-for="(top_hospital, index) in top_hospitals" v-if="index < 6">
                  <a class="nav-link text-white pt-1 pb-1 text_12" :href="'/profile/'+top_hospital.slug" v-if=" top_hospital.location === null || top_hospital.location === 'null' || top_hospital.location === '' || top_hospital.location === 'undefined' || top_hospital.location === undefined"> {{top_hospital.first_name}} {{top_hospital.last_name}}</a>

                    <a class="nav-link text-white pt-1 pb-1 text_12" :href="'/hospitals/'+top_hospital.location.slug+'/'+ top_hospital.slug"  v-else> {{top_hospital.first_name}} {{top_hospital.last_name}}</a>
                </li>
                <li class="nav-item zoom-text">
                  <a class="text_14 text-white" href="/hospitals">View All</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-2 col-md-6 col-6 col-sm-4 mt-4 order-lg-5">
              <ul class="navbar-nav footer-content">
                <li class="text-white pb-2 text_14 text_sm_15">
                  <span>Laboratories
                  </span>
                </li>
                <li class="nav-item zoom-text" v-for="(lab, index) in laboratories" v-if="index < 6">
                  <a class="nav-link text-white pt-1 pb-1 text_12" :href="'/lab/'+lab.location.slug+'/'+lab.slug" v-if="lab.area === null || lab.area === 'null' || lab.area === '' || lab.area === 'undefined' || lab.area === undefined || lab.location === null || lab.location === 'null' || lab.location === '' || lab.location === 'undefined' || lab.location === undefined" >{{lab.first_name}} {{lab.last_name}}
                  </a>
                  <a class="nav-link text-white pt-1 pb-1 text_12" :href="'/labs/'+lab.location.slug+'/'+ lab.slug+'/'+lab.area.slug" v-else>{{lab.first_name}} {{lab.last_name}}
                  </a>

                </li>
                <li class="nav-item zoom-text">
                  <a class="text_14 text-white" 
                  href="/labs">View All</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-2 col-md-6 col-6 col-sm-4 mt-4 order-lg-6">
              <ul class="navbar-nav footer-content">
                <li class="text-white pb-2 text_14 text_sm_15">
                  <span>Company Info
                  </span>
                </li>
                <li class="nav-item zoom-text">
                  <a class="nav-link text-white pt-1 pb-1 text_12" 
                  href="/health-articles/categories">Blog</a>
                </li>
                <li class="nav-item zoom-text">
                  <a class="nav-link text-white pt-1 pb-1 text_12" 
                  href="/about">About us</a>
                </li>
                <li class="nav-item zoom-text">
                  <a class="nav-link text-white pt-1 pb-1 text_12" 
                  href="/contact">Contact Us
                  </a>
                </li>
                <li class="nav-item zoom-text">
                  <a class="nav-link text-white pt-1 pb-1 text_12" 
                  href="/doctors">Doctors</a>
                </li>
                <li class="nav-item zoom-text">
                  <a class="nav-link text-white pt-1 pb-1 text_12" 
                  href="/hospitals">Hospitals
                  </a>
                </li>
                <li class="nav-item zoom-text">
                  <a class="nav-link text-white pt-1 pb-1 text_12" 
                  href="/privacy#faqs">FAQ</a>
                </li>
                <li class="nav-item zoom-text">
                  <a class="nav-link text-white pt-1 pb-1 text_12" href="/privacy">Terms and Privacy policy</a>
                </li>
                <li class="nav-item zoom-text">
                  <a class="nav-link text-white pt-1 pb-1 text_12" href="/find-a-doctor-near-you">Find a doctors</a>
                </li>
                <!-- <li class="nav-item zoom-text">
                  <a class="nav-link text-white pt-1 pb-1 text_12" href="/privacy#cancellation">Cancelation Policy
                  </a>
                </li> -->
                <li class="nav-item zoom-text">
                  <a class="nav-link text-white pt-1 pb-1 text_12" 
                  href="/disclaimer">Disclaimer</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link text_black pt-1 pb-1 text_12" href="/sitemap.xml">Site map</a>
                </li> -->
              </ul>
            </div>
          </div>
          <div class="row">
                <div class="col-12">
                  <div class="float-right call-btn call-sticky d-inline-block">
                    <a class="text_14 text-white d-inline-block font-weight-bold" href="https://wa.me/+923450435621?text=Hello">
                      <span>
                        <i class="fa fa-whatsapp mr-2 float-left" aria-hidden="true">
                        </i>
                      </span>
                      Whatsapp Us
                    </a>
                  </div>
                </div>
              </div>
        </div>
        <div class="knockdoc_border m-0"></div>
        </div>
        <div class="pb-3 mini_footer">
        <div class="container">
          <div class="row pt-3 pb-lg-0 pb-5">
            <div class="col-12">
              <div class="copy-right-text w-100 d-inline-block 
              text-center pb-xl-0 pb-5">
                <p class="text-white">{{footerCopyRight}}</p>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import Toasted from 'vue-toasted';

Vue.use(Toasted)
export default {
name: "FooterComponent",
 props:[
    'locations',
    'specialities',
    'laboratories',
    'managements',
    'top_hospitals',
    'fileSystemDriver'
 ],
  data(){
    return{
      subscribe: '',
      footer: '',
      download: '',
      socials: '',
      subSection:'',
      subTitle : '',
      subDescription : '',
      footerLogo: '',
      footerDescription: '',
      footerCopyRight: '',
      android_url: '',
      android_img: '',
      ios_url: '',
      ios_img: '',
      socialIcons: '',
      email: '',
      loading: false,
      hideSubscribe:false,
      errors:[],
      basePath:'',
    }
  },
  mounted(){
  },
  created() {
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
      this.subscribe = this.managements.find(pf =>pf.meta_key ==='subscribe_now_sec')
      this.footer = this.managements.find(pf =>pf.meta_key ==='footer_settings')
      this.download = this.managements.find(pf =>pf.meta_key ==='download_app_sec')
      this.socials = this.managements.find(pf =>pf.meta_key ==='socials')

      this.subSection = JSON.parse(this.subscribe.meta_value).show_how_work_sec;
      this.subTitle = JSON.parse(this.subscribe.meta_value).title;
      this.subDescription = JSON.parse(this.subscribe.meta_value).hw_desc;

      this.footerLogo = JSON.parse(this.footer.meta_value).footer_logo;
      this.footerDescription = JSON.parse(this.footer.meta_value).about_us_note;
      this.footerCopyRight = JSON.parse(this.footer.meta_value).copyright;

      this.android_img = JSON.parse(this.download.meta_value).android_img;
      this.android_url = JSON.parse(this.download.meta_value).android_url;
      this.ios_img = JSON.parse(this.download.meta_value).ios_img;
      this.ios_url = JSON.parse(this.download.meta_value).ios_url;
      
      this.socialIcons = JSON.parse(this.socials.meta_value);

      const currentUrl = window.location;

      if(currentUrl.pathname === '/about')
      {
        this.hideSubscribe=true;
      }
      else
      {
        this.hideSubscribe=false;
      }

  },
  methods: {
    submitEmail () {
      let self = this
      this.errors = [];
      if(!this.email) this.errors.push("Email required.");
      self.loading = true
      if (this.email === '' || this.email.length < 1) {
        self.loading = false
        Vue.toasted.error("Enter email" , { duration: 3000 })
        return
      }
      if ((/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(this.email))) {
        axios.post(APP_URL + '/subscriber-now', {
          email: self.email
        }).then(function (response) {
          
          if (response.data.type === 'success') {
            self.loading = false
            Vue.toasted.success(response.data.message , { duration: 3000 })
            self.email = ''
          }
          else {
            self.loading = false
            Vue.toasted.show(response.data.message , { duration: 3000 })
          }
            });

      }
      else{
        self.loading = false
        Vue.toasted.error('Incorrect Email ' , { duration: 3000 })
        return
      }
    }
  }
}
</script>

<style scoped>

</style>