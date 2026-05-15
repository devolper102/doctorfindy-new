<template>
  <div>
    <div v-if="loading" id="loader"></div>
    <!-- Start Onboard Doctor -->
    <div id="onBoardSection">
      <section class="onboard-doctor" v-if="doctorsList.length > 0">
        <div class="container">
          <div class="row mt-3 mb-3">
            <div class="col-12 col-lg-6">
              <div class="heading-onboard-doctor">
                <h4 class="font-weight-bold">Onboard doctors</h4>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <form>
                <div class="form-group input-doctor-onboard w-100 bg-white rounded-pill float-left dropdown">
                  <!-- <input type="text" name="search" v-model="search" class="form-control text_14 rounded-pill border-0 h_45 btn dropdown-toggle text-left box_shadow w-70" data-toggle="dropdown" aria-describedby="emailHelp" placeholder="Search doctors by specialization....">
                  <div class="search-icon-box w-20 float-right">
                    <a href="/all-hospitals"class="bg-white box_shadow d-inline-block w-45px h_45 rounded-pill text-secondary position-relative">
                      <i class="fa fa-search position-absolute" style="top:35%;left: 35%;" aria-hidden="true"></i>
                    </a>
                  </div> -->
                  <div class="position-relative  w-100">
                    <input v-model="search" type="text" class="form-control text_14 rounded-pill border-0 h_42px dropdown-toggle text-left box-shadow bg-white pr-5" data-toggle="dropdown" aria-describedby="emailHelp" placeholder="search">
                    <!-- <div class="search-icon-box w-20 float-right">
                      <a class="bg-white box_shadow d-table text-center w-45px h_45 rounded-pill text-secondary" href="#">
                      <i class="fa fa-search align-middle d-table-cell" aria-hidden="true"></i>
                      </a>
                    </div> -->
                    <a class="articleSearchIcon position-absolute" href="javascript:void(0)">
                      <i class="fa fa-search" aria-hidden="true"></i>
                    </a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- End  Onboard Doctor-->

      <!-- Start section Doctor Video Calling -->
      <section class="doctor-video-calling">
        <div class="container">
          <div class="row">
                        <div v-if="index < doctorToShow  " v-for="(doctor, index) in filteredList" class="col-lg-12 col-sm-12 col-md-12 mb-lg-5 mb-4">
                            
           <!--  <div v-if="index < doctorToShow  " v-for="(doctor, index) in doctorsList" class="col-lg-4 col-sm-12 col-md-6 mb-lg-5 mb-4"> -->
              <doc-card
                  :doctor="doctor"
                  :fileSystemDriver="fileSystemDriver"
              ></doc-card>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="join-doctor-btn text-center mb-4">
                <!-- <a  @click="showMoreDoctors()" class="rounded-pill knockdoc_btn_bg text-white p-2 btn_padding d-inline-block"> -->
                  <a  @click="showMoreDoctors()" v-if="filteredList.length > doctorToShow-1"class="rounded-pill bg-blue text-white p-2 btn_padding d-inline-block">
                  View more doctors
                  <i class="fa fa-arrow-right ml-1" aria-hidden="true">
                  </i>
                </a>
              </div>
            </div>
          </div>
          <span v-if="doctorsList.length === 0"><h3>No Result Found...</h3></span>
        </div>
      </section>
      <!-- End section Doctor Video Calling -->
    </div>
  </div>
</template>

<script>
Vue.filter('dayFormat', function(value) {
  if (value) {
    return moment().day(value).format("dddd")
  }
});

export default {
  name: "HospitalTeamSectionComponent",
  props: ['user', 'doctors', 'fileSystemDriver'],
  data() {
    return {
      loading: false,
      doctorsList:[],
      dayName: '',
      doctorToShow: 3,
      totalDoctor: 0,
      search: '',
    }
  },
  mounted() {
  },
  created () {
    let self = this
    self.user.teams.forEach(function (team,index)
      {if(index <= 2){
      self.doctorsList.push((self.doctors.filter(doctor => doctor.id === JSON.parse(team.doctor_id)))[0])
    }})
    self.totalDoctor = self.doctorsList.length
  },
  computed: {
    filteredList() {
      let self = this
      return self.doctorsList.filter(post => {
        return (post.first_name+' '+post.last_name).toLowerCase().includes(self.search.toLowerCase())
      })
    }
  },
  methods: {
    showMoreDoctors(){
          this.$parent.loading = true
          this.doctorToShow=this.doctorToShow+3;
         axios.get('/getMoreDoctors/'+this.user.id+'/'+this.doctorToShow).then(response=>{
               this.$parent.loading= false,
               this.doctorsList = response.data;
          });
    }
    // checkAvailability: function (user) {
    //   let availableDays = JSON.parse(user.profile.available_days)
    //   if (availableDays !== '') {
    //     let availability = '';
    //     let day1 = ((moment().format('ddd')).toLowerCase().trim());
    //     let day2 = ((moment().add(1, 'day').format('ddd')).toLowerCase().trim());
    //     let day3 = ((moment().add(2, 'day').format('ddd')).toLowerCase().trim());
    //     let day4 = ((moment().add(3, 'day').format('ddd')).toLowerCase().trim());
    //     let day5 = ((moment().add(4, 'day').format('ddd')).toLowerCase().trim());
    //     let day6 = ((moment().add(5, 'day').format('ddd')).toLowerCase().trim());
    //     let day7 = ((moment().add(6, 'day').format('ddd')).toLowerCase().trim());
    //     if (availableDays !== null) {
    //       if (availableDays.includes(day1) === true) {
    //         this.dayName = day1
    //         this.availableDayName = moment().day(day1).format('dddd')
    //         return availability = 'Available Today'
    //       } else if (availableDays.includes(day2)) {
    //         this.dayName = day2
    //         this.availableDayName = moment().day(day2).format('dddd')
    //         return availability = ' Available Tomorrow'
    //       } else if (availableDays.includes(day3)) {
    //         this.dayName = day3
    //         this.availableDayName = moment().day(day3).format('dddd')
    //         return availability = ' Available on ' + moment().add(2, 'day').format('dddd')
    //       } else if (availableDays.includes(day4)) {
    //         this.dayName = day4
    //         this.availableDayName = moment().day(day4).format('dddd')
    //         return availability = ' Available on ' + moment().add(3, 'day').format('dddd')
    //       } else if (availableDays.includes(day5)) {
    //         this.dayName = day5
    //         this.availableDayName = moment().day(day5).format('dddd')
    //         return availability = ' Available on ' + moment().add(4, 'day').format('dddd')
    //       } else if (availableDays.includes(day6)) {
    //         this.dayName = day6
    //         this.availableDayName = moment().day(day6).format('dddd')
    //         return availability = ' Available on ' + moment().add(5, 'day').format('dddd')
    //       } else if (availableDays.includes(day7)) {
    //         this.dayName = day7
    //         this.availableDayName = moment().day(day7).format('dddd')
    //         return availability = ' Available on ' + moment().add(6, 'day').format('dddd')
    //       } else {
    //         return availability = 'Not Available</em>'
    //       }
    //     } else {
    //       return availability = '<em class="dc-dayon">Not Available</em>'
    //     }
    //     return availability;
    //   }
    //   else {

    //   }
    // },
    // availableDayString(user) {
    //   let length = user.doc_teams.length
    //   let end_time = ((JSON.parse(user.doc_teams[length-1].slots)[this.dayName]['end_time']).trim()).toUpperCase()
    //   let start_time = ((JSON.parse(user.doc_teams[length - length].slots)[this.dayName]['start_time']).trim()).toUpperCase()
    //   return start_time + ` - ` + end_time
    // },
  }
}
</script>

<style>
img[lazy=loading] {
    background-image: url("/images/loader/loaderss.gif");
    background-position: center;
    background-size: contain;
    display: flex;
    width: auto;
    height: auto;
    background-repeat: no-repeat;
  }
img[lazy=error] {
    background-image: url("/images/loader/healthcare-image.png");
    background-position: center;
    background-size: contain;
    display: flex;
    width: auto;
    height: auto;
    background-repeat: no-repeat;
  }
.articleSearchIcon {
  top: 13px;
  right: 20px;
  color: #495057;
}
.video-cam-icon img {
    top: 3px !important;
    left: 4px !important;
}

.finger-icon img {
    top: 3px;
    left: 5px;
}

</style>