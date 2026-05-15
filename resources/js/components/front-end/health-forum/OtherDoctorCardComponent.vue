<template>
  <div>
    <div class="suggest-doctor bg-white w-100 d-inline-block p-3 box_radius box_shadow">
      <div class="doctor_image position-relative float-left w-20">
        <div class="position-relative">
          <img v-if="doctor.profile.avatar" v-lazy="'/uploads/users/'+doctor.id+'/'+doctor.profile.avatar" :alt=" doctor.first_name + ' ' + doctor.last_name " :name=" doctor.first_name + ' ' + doctor.last_name " class="img-fluid rounded-circle h_50 w_60px h_md_60">
          <img v-else v-lazy="'/uploads/users/default/doctor.svg'" :alt=" doctor.first_name + ' ' + doctor.last_name " :name=" doctor.first_name + ' ' + doctor.last_name " class="img-fluid rounded-circle h_50 w_60px">
          <a href="#" class="circle_anchor position-absolute"></a>
        </div>
      </div>
      <div class="doctor-name-specialties w-75 float-left ml-2">
        <a class="text_black font-weight-bold" :href="'/profile/'+doctor.slug">{{ doctor.first_name }} {{ doctor.last_name }}</a>
        <span class="text_15 text_black d-block">
                  {{ doctor.specialities.length > 0 ? doctor.specialities[0].title : '' }}
                </span>
        <p class="text_15 text_black">Member since {{ doctor.created_at | formatDate }}</p>
      </div>
      <div v-if="following" class="list_btns d-xs-inline-block d-sm-inline-block w-100 mt-4 mb-2">
        <a @click="unfollow(doctor.id)" class="d-block rounded-pill text-center knockdoc_doctor_profile_btn text_14">Following</a>
      </div>
      <div v-else class="list_btns d-xs-inline-block d-sm-inline-block w-100 mt-4 mb-2">
        <a @click="addFollowing(doctor.id)" class="text-white d-block rounded-pill text-center knockdoc_doctor_profile_btn text_14">Follow</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "OtherDoctorCardComponent",
  props: [ 'doctor', 'patient' ],
  data() {
    return {
      following: false,
    }
  },
  created () {
    console.log(this.doctor, this.patient)
    if (this.patient.profile.followings !== null) {
      this.following = this.patient.profile.followings.includes(this.doctor.id)
    }
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