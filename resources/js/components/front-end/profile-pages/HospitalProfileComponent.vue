<template>
  <div>
    <div v-if="loading" id="loader"></div>
    <!-- Start Section Doctor Hospital Medical Center -->
    <!-- Start Doctor Profile -->
       <!-- <div class="container">
            <div class="row">
                  <div class="col-12 mt-4">
                    <bread-crumb-spec></bread-crumb-spec>
                  </div>
            </div>
          </div> -->
      <hospital-tab
            :user="user"
            :patient="patient"
            :segments="segments"
            :fileSystemDriver="fileSystemDriver"
    ></hospital-tab>
    
    <!-- Short Description Section -->
    <div class="container mb-2 mt-2" v-if="user.profile.short_desc && user.profile.short_desc !== '' && user.profile.short_desc !== null">
      <div class="row">
        <div class="col-12">
          <div class="short-description-section bg-white box-shadow rounded p-3">
            <h3 class="text-blue font-weight-bold text_16 mb-1">About Hospital</h3>
            <p class="text_14 text_black line-height-normal" v-html="user.profile.short_desc"></p>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1).split('_').join(' ');
}
Vue.filter('averageRating', function(value) {
  let avgRating = 0.0
  if (value.length > 0) {
    value.forEach(function (feedback){
      avgRating += parseFloat(JSON.parse(feedback.avg_rating))
    })
    return (avgRating/value.length).toFixed(1)
  }
  else {
    return '0'
  }

});
export default {
  name: 'HospitalProfileComponent',
  props: ['user', 'patient','segments','fileSystemDriver'],
  data() {
    return {
      environment: 0.0,
      staffBehaviour: 0.0,
      checkUp: 0.0,
      loading: false,
      services: [],
       resultSegments: this.segments,
    }
  },
  created () {
    let services = this.user.profile.hospital_services
    this.services = JSON.parse(services)

    let self = this
    if (this.user.feedbacks.length > 0) {
      this.user.feedbacks.forEach(function (x) {
        let rating = JSON.parse(x.rating)
        self.environment += parseFloat(rating['environmentRating'])
      })
      self.environment = (self.environment / this.user.feedbacks.length ).toFixed(1)
    }
    else {
      self.environment = 0
    }

    if (this.patient.length === undefined) {
      this.saved_doctors = JSON.parse(this.patient.profile.saved_doctors)
    }
    else {
      this.saved_doctors = []
    }
  },
  methods: {
    showReportModal: function () {
      this.loading = true
      if(this.patient.length === undefined) {
        document.querySelector('#doctor-report-modal').classList.add('show')
        document.querySelector('#doctor-report-modal').style.display = "block"
      }
      else {
        Vue.toasted.show('Please Login First' , { duration: 3000 })
      }
      this.loading = false
    },
  }
}
</script>

<style scoped>

</style>