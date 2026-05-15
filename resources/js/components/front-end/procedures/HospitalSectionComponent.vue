<template>
  <div>
    <section class="trending-hospital-in-pakistan bg-doctor">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="heading-doctor-video-calling w-100 d-inline-block">
              <h2 class="mb-3 mb-xs-0 service-text font-weight-bold mt-xs-4 text_20 text-xs-18">Trending Hospitals
              </h2>
            </div>
          </div>
        </div>
        <section class="doctor-hospital-medical-center">
      <div class="bg-medical-doctor-hospital mt-2">
          <div class="row">
        <div class="col-12" v-if="hospitals.length > 0 && index < 9" v-for="(user, index) in hospitals">
          <div class="box_radius box_shadow mb-lg-3 mb-2 p-2 
          bg-white">
            <hospital-tab
                :user="user"
                :patient="patient"
                :fileSystemDriver="fileSystemDriver"
            ></hospital-tab>
          </div>
        </div>
        </div>
      </div>
    </section>
        <div class="row">
          <div class="col-12">
            <div class="join-doctor-btn mb-4 mt-4 w-100 mt-lg-0 d-inline-block text-center mt-3">
              <a href="/hospitals" class="book-rounded bg-green text-white btn_padding d-inline-block">View all Hospitals
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
  name: "HospitalSectionComponent",
  props: ['hospitals', 'patient', 'fileSystemDriver'],
  data() {
    return {
      search: '',
      // hospitals: [],
    }
  },
  computed: {},
  // created () {
  //   let self = this
  //   // this.procedures.forEach(function (procedure) {
  //   //   procedure.users.forEach(function (user){
  //   //     if (user.roles[0].name === 'hospital') {
  //   //       self.hospitals.push(user)
  //   //     }
  //   //   })
  //   // })
  // }
}
</script>

<style scoped>

</style>