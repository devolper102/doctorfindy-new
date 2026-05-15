<template>
  <div>
    <section class="doctor-video-calling bg-doctor">
      <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="heading-doctor-video-calling w-100 d-inline-block">
            <h2 class="mt-2 service-text mb-xs-0 text_3- text_20 text-xs-18 font-weight-bold">Trending Surgeons
            </h2>
          </div>
        </div>
      </div>
      <div class="row mb-lg-4 mb-xs-2">
          <div v-if="doctors.length > 0 && index < 9" v-for="(doctor, index) in doctors" class="col-12 col-lg-4 col-xl-3 col-md-6 mt-2 mb-lg-0">
            <doctor-card
                :fileSystemDriver="fileSystemDriver"
                :doctor="doctor"
            ></doctor-card>
          </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="join-doctor-btn mb-4 w-100 mt-lg-0 mt-3 d-inline-block text-center">
            <a href="/doctors" class="book-rounded bg-green text-white p-2 btn_padding d-inline-block">View All doctors
              <i class="fa fa-arrow-right ml-3" aria-hidden="true">
              </i>
            </a>
          </div>
        </div>
      </div>
    </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "DoctorSectionComponent",
  props: ['doctors', 'patient', 'fileSystemDriver'],
  data() {
    return {
      search: '',
    }
  },
  computed: {},
  created () {
    let self = this

  }
}
</script>

<style scoped>

</style>