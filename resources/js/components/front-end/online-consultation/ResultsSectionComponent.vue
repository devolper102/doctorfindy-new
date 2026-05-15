<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-lg col-md-3 col-6 col-sm-6">
          <div class="patient-detail-banner-image w-20 float-left mt-3 mt-xs-4 w-xs-25 w-md-25">
            <img class="h_50 h_xs_35" src="/images/banner-patient-image.png" alt="banner-patient-image picture">
          </div>
          <div class="patient-detail-banner-text w-60 float-left text-center mt-lg-4 mt-3 mt-xs-3 w-sm-75 pl-lg-0 pl-2 w-md-75">
            <span class="text_black font-weight-bold text_xs_14">{{ consultations }}+</span>
            <p class="text_black d-block font-weight-bold text_xs_12">Total Consultations</p>
          </div>
        </div>
        <div class="col-lg col-md-3 col-6 col-sm-6">
          <div class="patient-detail-banner-image w-20 float-left mt-3 mt-xs-4 w-xs-25 w-md-25">
            <img class="h_50 h_xs_35" src="/images/banner-patient-image-2.png" alt="banner-patient-image-2 picture">
          </div>
          <div class="patient-detail-banner-text w-40 float-left text-center mt-lg-4 mt-3 mt-xs-3 w-sm-75 pl-lg-0 pl-2 w-md-75">
            <span class="text_black font-weight-bold text_xs_14">{{ patients }}+</span>
            <p class="text_black d-block font-weight-bold text_xs_12">Happy Users
            </p>
          </div>
        </div>
        <div class="col-lg col-md-3 col-6 col-sm-6">
          <div class="patient-detail-banner-image w-20 float-left mt-3 mt-xs-4 w-xs-25 w-md-25">
            <img class="h_50 h_xs_35" src="/images/banner-patient-image-3.png" alt="banner-patient-image-3 picture">
          </div>
          <div class="patient-detail-banner-text w-60 float-left text-center mt-lg-4 mt-3 mt-xs-3 w-sm-75 pl-lg-0 pl-2 w-md-75">
            <span class="text_black font-weight-bold text_xs_14">{{ doctors }}+</span>
            <p class="text_black d-block font-weight-bold text_xs_12">Verified Doctors</p>
          </div>
        </div>
        <div class="col-lg col-md-3 col-6 col-sm-6">
          <div class="patient-detail-banner-image w-20 float-left mt-3 mt-xs-4 w-xs-25 w-md-25">
            <img class="h_50 h_xs_35" src="/images/cell-phone-image.png" alt="cell-phone-image picture">
          </div>
          <div class="patient-detail-banner-text w-30 float-left text-center mt-lg-4 mt-3 mt-xs-3 w-sm-75 pl-lg-0 pl-2 w-md-75">
            <span class="text_black font-weight-bold text_xs_14">{{ specialities }}+</span>
            <p class="text_black d-block font-weight-bold text_xs_12">Specialities</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ResultsSectionComponent",
  props: ['patients', 'doctors', 'specialities', 'consultations'],
  data() {
    return {}
  },
  created () {
    console.log(this.doctors)
  }
}
</script>

<style scoped>

</style>