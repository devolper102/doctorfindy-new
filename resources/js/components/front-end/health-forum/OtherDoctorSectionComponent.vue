<template>
  <div>
    <section class="doctor-following">
      <div class="container">
        <div class="row mb-4 mb-xs-2">

          <div v-for="(doctor,index) in doctors" v-if="index <= 6" class="col-12 col-lg-4 col-md-6 mt-4 mb-5 mb-xs-2 mt-xs-2">
            <other-doctor-card
                :doctor="doctor"
                :patient="patient"
            ></other-doctor-card>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MMM DD,YYYY')
  }
});

export default {
  name: "OtherDoctorSectionComponent",
  props: [ 'doctors', 'patient' ],
  data() {
    return {
      followings: JSON.parse(this.patient.profile.followings),
    }
  },
  created () {
    console.log(this.followings)
/*    if (this.patient.profile.followings !== null) {
      this.following = this.patient.profile.followings.includes(this.user.id)
    }*/
  },
  methods: {
    addFollowing(id) {
      let self = this
      if (self.patient.length === 0) {
        Vue.toasted.show('You are not logged in' , { duration: 3000 })
        return
      }
      axios.post(APP_URL + '/follow-doctor', {
        doctor: id
      })
        .then(function (response) {
          if (response.data.type === 'success') {
            self.following = true
            Vue.toasted.success(response.data.message , { duration: 3000 })
          } else {
            Vue.toasted.error(response.data.message , { duration: 3000 })

          }
        })
    },
    unfollow(id) {
      let self = this
      axios.post(APP_URL + '/unfollow-doctor', {
        doctor: id
      })
        .then(function (response) {
          if (response.data.type === 'success') {
            self.following = false
            Vue.toasted.show(response.data.message , { duration: 3000 })
          } else {
            Vue.toasted.error(response.data.message , { duration: 3000 })
          }
        })
    }
  },
}
</script>

<style scoped>

</style>