<template>
  <div>
    <div v-if="loading" id="loader"></div>
       <!--  <div class="container">
          <div class="row">
                <div class="col-12 mt-4">
                  <bread-crumb-spec></bread-crumb-spec>
                </div>
          </div>
      </div> -->
      <lab-tab
            :user="user"
            :patient="patient"
            :segments="segments"
            :fileSystemDriver="fileSystemDriver"
    ></lab-tab>
  </div>
</template>

<script>
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
  name: "LabProfileComponent",
  props: ['user', 'patient','segments', 'fileSystemDriver'],
  data() {
    return {
      loading: false,
       resultSegments: this.segments,
    }
  },
  mounted() {
  },
  created () {
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