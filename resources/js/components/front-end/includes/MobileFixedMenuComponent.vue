<template>
  <div>
    <!-- Mobile fixed bar -->
        <div class="container">
          <div class="row justify-content-md-center d-flex 
          d-lg-none">
            <div class="banner_services">
              <ul class="services_main mobile_fixMenu d-inline-block p-2 bg-white w-100 m-0">
                <!-- <li class="float-left" v-for="(slide, index) in slides">
                  <a :href="slide.slide_title_url" class="nav-link rounded-pill text-white" style="cursor: pointer;"><i :class="slide.slide_title_two"></i> <span class="heading_title mt-2 d-block font-weight-bold">{{slide.slide_title_one}}</span> </a>
                </li> -->
                  <li class="float-left w-25 text-center">
                    <a class="d-inline-block bg-blue book-rounded" href="/">
                      <img v-lazy="basePath+'/images/home-icon.svg'">
                    </a>
                    <p class="text-blue text_11 mt-1 font-weight-bold mb-0 text-center">
                      Home
                    </p>
                  </li>
                  <li class="float-left w-25 text-center">
                    <a class="d-inline-block bg-blue book-rounded" href="/online-doctor-consultation">
                      <img v-lazy="basePath+'/images/search-icon.svg'">
                    </a>
                    <p class="text-blue text_11 mt-1 font-weight-bold mb-0 text-center">
                      Search
                    </p>
                  </li>
                  <li class="float-left w-25 text-center">
                    <a class="d-inline-block bg-blue book-rounded" href="/find-a-doctor-near-you">
                      <img v-lazy="basePath+'/images/doctor-icon.svg'">
                    </a>
                    <p class="text-blue text_11 mt-1 font-weight-bold mb-0 text-center">
                      Find Doctor
                    </p>
                  </li>
                  <li class="float-left w-25 text-center">
                    <a class="d-inline-block bg-blue book-rounded" href="/book-a-lab-test">
                      <img v-lazy="basePath+'/images/test-icon.svg'">
                    </a>
                    <p class="text-blue text_11 mt-1 font-weight-bold mb-0 text-center">
                      Book Test
                    </p>
                  </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Mobile fixed bar -->
  </div>
</template>
<script>
export default {
  name: "MobileFixedMenuComponent",
  props:[
    'managements', 'fileSystemDriver'
  ],
   data() {
    return {
     slides: '',
     home_slider: '',
     basePath:'',
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
      
      this.home_slider = this.managements.find(pf =>pf.meta_key ==='home_slider')
      this.slides = JSON.parse(this.home_slider.meta_value);
  },
  methods: {

  }
}
</script>

<style>
.mobile_fixMenu li a:hover{
  color: #0090BA !important;
  transform:scale(1.04);
}
</style>