<template>
  <div>
    <!-- Start Section Doctor Video Calling -->
    <div class="benifites_bg w-100 d-inline-block mt-3 pb-lg-5 pb-4">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="heading-doctor-video-calling mt-3 mt-lg-0">
              <h2 class="text-center font-weight-bold mt-4 mb-xs-0 text_xs_20">
                Our top doctors for video calling
              </h2>
            </div>
          </div>
        </div>
        <div class="row mb-lg-4 mb-xs-2">
          <div  v-if="index < doctorsToShow" v-for="(doctor,index) in doctors" class="col-12 col-lg-4 col-md-6 col-sm-6 mt-2 mb-2 mt-lg-5 mb-lg-0">
            <doctor-card
                :doctor="doctor"
            ></doctor-card>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div v-if="doctors.length > 2" class="join-doctor-btn mt-lg-4 mt-0 
            text-center">
              <a href="javascript:void(0)" @click="doctorsToShow += 2" class="rounded-pill knockdoc_btn_bg text-white p-2 btn_padding d-inline-block">View more 
                <i class="fa fa-arrow-right ml-1" aria-hidden="true">
                </i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Section Doctor Video Calling -->

  </div>
</template>

<script>
export default {
  name: "TopDoctorsSectionComponent",
  props: ['doctors', 'patient'],
  data() {
    return {
      search: '',
        doctorsToShow: 2,
    }
  },
  computed: {},
  created () {
    let self = this
  }
}
</script>

<style>
@media (max-width: 767px){
  .doctor-name-specialties {
    min-height: 130px;
  }
}
</style>