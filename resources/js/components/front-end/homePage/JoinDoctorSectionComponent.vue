<template>
  <div>
    <div class="doctor-section position-relative"v-if="hide_show === 'true'">
      <!-- <div class="doctor-bg-image mt-0 mb-4 w-100 d-inline-block" style="background: url(../images/doctor-bg-image.jpg) no-repeat left;"> -->
          <div class="doctor-bg-image mt-0 mb-4 w-100 d-inline-block" :style="{ background: 'url(' + basePath + '/images/doctor-bg-image.jpg) no-repeat left' }">

        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="grip_doctor_section mt-3 mt-lg-0 mt-lg-5 ml-sm-5 ml-lg-0">
                <div class="r_u_doctor_main">
                  <div class="doctor-text d-inline-block">
                    <h1 class="knockdoc-heading service-text">{{title}} <span class="border_yellow position-relative">?</span></h1>
                    <h3 class="service-text">{{subtitle}}</h3>
                    <div class="doctor_instruction w-100 d-inline-block">
                      <p class="service-text">By collaborating with DoctorFindy, You will</p>
                      <p class="service-text">
                        <i class="fas fa-check mr-2 mt-2"></i>
                        <span>Digitally connect to millions of patients worldwide.</span>
                      </p>
                      <p class="service-text">
                        <i class="fas fa-check mr-2 mt-2"></i>
                        <span>Improve your professional practice experience. </span>
                      </p>
                      <p class="service-text">
                        <i class="fas fa-check mr-2 mt-2"></i>
                        <span>Increase your number of patients & income.</span>
                      </p>
                      <p class="service-text">
                        <i class="fas fa-check mr-2 mt-2"></i>
                        <span>Be aware about patients reviews about you. </span>
                      </p>
                      <p class="service-text">
                        <i class="fas fa-check mr-2 mt-2"></i>
                        <span>Save your time.</span>
                      </p>
                    </div>
                    <div class="d-inline-block position-relative w-100">
                      <a :href="url" class="box_radius text-white bg-green p-2 btn_padding join-doctor-btn d-inline-block float-xl-left float-right">{{btn}}
                        <i class="fa fa-arrow-right ml-2" aria-hidden="true">
                        </i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="col-12 col-lg-6 col-md-6 order-1 order-lg-2 order-md-1">
              <div class="w-100 d-inline-block mt-5">
                <img src="/images/heart-icon-image.svg" alt="pictire">
              </div>
            </div>
            <div class="col-12 order-3">
              <div class="doctor_rightImg mt-5 mt-lg-0 doctor-group-image position-relative w-100 
              d-inline-block">
              <img v-lazy="'/uploads/settings/home/'+ side_img" alt="Doctro Image" class="img-fluid w-70 w-xs-100"/>
                <img class="w-70" src="/images/doctor-speciality-image.svg" 
                alt="pictire">
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
export default {
name: "JoinDoctorSectionComponent",
 props:[
    'managements',
    'fileSystemDriver',
  ],
  data() {
    return {
      home_doctor: '',
      hide_show: '',
      title: '',
      subtitle: '',
      btn: '',
      url: '',
      side_img: '',
      basePath:'',

    }
  },
    created() {
      this.home_doctor = this.managements.find(pf =>pf.meta_key ==='home_doctor_sec')
      this.title = JSON.parse(this.home_doctor.meta_value).title;
      this.subtitle = JSON.parse(this.home_doctor.meta_value).subtitle;
      this.btn = JSON.parse(this.home_doctor.meta_value).btn_one_title;
      this.url = JSON.parse(this.home_doctor.meta_value).btn_one_url;
      this.side_img = JSON.parse(this.home_doctor.meta_value).hidden_about_us_img;
      this.hide_show = JSON.parse(this.home_doctor.meta_value).show_about_sec;
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
}
</script>

<style scoped>

</style>