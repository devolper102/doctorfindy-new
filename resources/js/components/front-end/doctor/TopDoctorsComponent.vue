<template>
  <div>
    <section class="container">
      <div class="heading-doctor-video-calling">
        <h2 class="text-center font-weight-bold mt-5 mb-md-5">DoctorFindy Top doctors of the month
        </h2>
      </div>
      <div class="row">
        <div v-if="index < 3" v-for="(doctor, index) in doctors" class="col-lg-12 col-sm-12 col-md-12 mb-lg-5 mb-4">
          <doctor-card
              :doctor="doctor"
          >
          </doctor-card>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "TopDoctorsComponent",
  props: ['doctors'],
  data() {
    return {
      search: '',
    }
  },
  computed: {},
  created () {
    let self = this
    console.log(this.doctors)
  }
}
</script>

<style scoped>

</style>