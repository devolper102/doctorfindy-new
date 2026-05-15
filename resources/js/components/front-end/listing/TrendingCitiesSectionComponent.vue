<template>
  <div>
    <section class="top-city-and-trending-doctor-in-pakistan">
      <div class="container">
        <div class="heading-doctor-in-pakistan mt-3 w-100 d-inline-block">
          <h2 class="font-weight-bold mb-0 text_xs_20 service-text">Top Doctors of Pakistan</h2>
        </div>
        <div class="row">
          <div class="col-lg-12 col-12 mt-3">
            <div class="row">
              <div v-for="(location, index) in orderedTrendings" :key="index" class="col-6 col-sm-3 col-md-4 col-lg mb-4 text-center mb-lg-5">
                <div class="doctor-in-pakistan pt-2 pb-2 w-80 w-sm-100 d-inline-block position-relative float-left">
                  <div :class="index === 0 ? ' red_circle ' : index === 1 ? ' green_circle ' : index === 2 ? ' blue_circle ' : index === 3 ? ' red_circle ' : index === 4 ? ' green_circle ' : index === 5 ? ' blue_circle '  : index === 6 ? ' red_circle '  : index === 7 ? ' green_circle ' : '' " class=" p-2 m-auto rounded-circle w_90px h_90 w-sm-70px h-sm-70 d-table hospital-circle">
									<span class="d-table-cell align-middle">
										<img v-lazy="basePath+'/uploads/locations/'+location.flag" alt="lahore-image picture">
									</span>
                  </div>
                  <span class="pt-2 d-block text-xs-13 text_12 font-weight-bold service-text">{{ location.title }}
                  </span>
                  <a :href="'/doctors/'+location.slug" class="circle_anchor position-absolute"></a>
                </div>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-12">
                <div class="join-doctor-btn mb-4 w-100 mt-xs-0 d-inline-block text-center">
                  <a href="/doctors" class="rounded-pill knockdoc_btn_bg text-white p-2 btn_padding d-inline-block w-25 mr-0 mr-lg-4 mr-md-0 w-sm-60">View all doctors
                    <i class="fa fa-arrow-right ml-3" aria-hidden="true">
                    </i>
                  </a>
                </div>
              </div>
            </div> -->
            <div class="row">
              <div class="col-12">
                <div class="heading-doctor-video-calling">
                  <h2 class="font-weight-bold mb-0 text_20 
                  service-text">
                    Trending Doctors of Pakistan
                  </h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div v-for="(doctor, index) in doctors" class="col-12 col-lg-6 col-md-6 mb-3 mt-3 col-xl-12">
                <doc-card
                    :doctor="doctor"
                    :fileSystemDriver="fileSystemDriver"
                ></doc-card>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="join-doctor-btn mt-lg-2 mb-lg-3 w-100 mt-0 mb-3 d-inline-block text-center">
                  <a href="/search-results" class="book-rounded bg-green text-white p-2 btn_padding d-inline-block">View all doctors
                    <i class="fa fa-arrow-right ml-3" aria-hidden="true">
                    </i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="col-12 col-lg-4" v-if="hide_show === 'true'">
            <div class="bg -white box_shadow box_radius m-lg-3 mr-sm-0 ml-sm-0 mr-md-0 ml-md-0">
              <div class="doctor-image-best-video-consultation p-3 mt-xs-3 text-center">
                 <img v-lazy="'/uploads/settings/home/'+ image" class=" doctor-image-best-video-consultation " :alt="title" />
              </div>
              <div class="best-video-consultation-text text-center p-3">
                <h5 class="text_black font-weight-bold">{{title}}</h5>
                <p class="text_black text_15">{{heading}}</p>
                <p class="text_black text_13 mt-2">{{description}}</p>
                <div class="view-profile-btn w-100 d-inline-block mt-4 mb-2">
                  <a class="text-white rounded-pill text_15 d-inline-block knockdoc_btn_bg w-100" :href="url">{{btn}}</a>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </section>

    <book-now-appointment-slots
        :fileSystemDriver="fileSystemDriver"
        v-if="bookNowSlots"
        ref="bookNowAppointment"
    ></book-now-appointment-slots>
    <book-now-mobile-number
        v-if="bookNowMobile"
        v-model="selected_appointment_date"
        :hospital="selectedHospital"
        :slotSelected="slotSelected"
        :fileSystemDriver="fileSystemDriver"
    ></book-now-mobile-number>
    <book-now-number-verification
        v-if="bookNowVerification"
        :hospital="selectedHospital"
        :slotSelected="slotSelected"
        :fileSystemDriver="fileSystemDriver"
    ></book-now-number-verification>
    <book-now-final
        v-if="bookNowFinal"
        :fileSystemDriver="fileSystemDriver"
    ></book-now-final>
  </div>
</template>

<script>
export default {
  name: "TrendingCitiesSectionComponent",
  props: ['locations', 'doctors','managements','patientsData', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
       citySequence: ['Lahore', 'Karachi', 'Islamabad', 'Quetta', 'Peshawar', 'Multan', 'Faisalabad'],
      doctor_hospitals: [],
        hospitals_data: [],
      patientData: [],
      selected_appointment_date: [],
        selectedHospital: [],
        slotSelected: false,
        bookNowVerification: false,
        bookNowFinal: false,
      
        bookNowSlots: false,
        bookNowMobile:false,
      search: '',
      trendings: [],
      doctor_inner_section: '',
      title: '',
      heading: '',
      btn: '',
      url:'',
      description: '',
      hide_show: '',
      image: '',
    }
  },
  computed: {
    orderedTrendings() {
    // console.log(this.trendings);
    // console.log(this.citySequence);
    const ordered = this.trendings.slice().sort((a, b) => {
      const indexA = this.citySequence.indexOf(a.title);
      const indexB = this.citySequence.indexOf(b.title);
      return indexA - indexB;
    });
    // console.log(ordered);
    return ordered;
  },
  },
  mounted(){
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  created () {
    let self = this
    self.locations.forEach(function (location) {
      if(location.top === '1') {
        self.trendings.push(location)
      }
    })
      this.doctor_inner_section = this.managements.find(pf =>pf.meta_key ==='list_doctor_inner_section')
      this.title = JSON.parse(this.doctor_inner_section.meta_value).title;
      this.heading = JSON.parse(this.doctor_inner_section.meta_value).subtitle;
      this.btn = JSON.parse(this.doctor_inner_section.meta_value).btn;
      this.url = JSON.parse(this.doctor_inner_section.meta_value).url;
      this.description = JSON.parse(this.doctor_inner_section.meta_value).description;
      this.image = JSON.parse(this.doctor_inner_section.meta_value).hidden_doctor_inner_img;
      this.hide_show = JSON.parse(this.doctor_inner_section.meta_value).show_doctor_inner_section;
  },
  methods:
  {
    onClose: function() {
        let self = this
        self.bookNowSlots = false
        self.loading = true
        self.step = 1;
        self.appointment.patient = ''
        self.appointment.comments = ''
        self.appointment.date = ''
        self.appointment.day = ''
        self.appointment.hospital = ''
        self.appointment.patient_name = ''
        self.appointment.relation = ''
        self.appointment.speciality = ''
        self.appointment.time = ''
        self.appointment.total_charges = ''
        self.appointment.type = ''
        self.appointment.code = ''
        self.doctor_id = ''
        self.loading = false
      },
    showMobileModal: function () {
        this.slotSelected = true
        this.bookNowMobile = true

        this.loading = false

        document.querySelector('#modal_patient_num').style.display = 'none'
        document.querySelector('#modal_patient_num').classList.remove('show')
        /*document.querySelector('#modal_patient_num').classList.remove('abc')*/
      },
    showFinalModal: function () {
        this.submitAppointment(this.patientData.id)
        this.bookNowMobile = false
        this.bookNowFinal = true
        document.querySelector('#mobile_number_detail').style.display = 'none'
        document.querySelector('#mobile_number_detail').classList.remove('show')

        document.querySelector('#book_now_final').classList.add('show')
        /*document.querySelector('#book_now_final').classList.add('abc')*/
        document.querySelector('#book_now_final').style.display = "block"
        this.loading = false
      },
    showModal: function (doc, type) {
        let patientLogged = false
        let self = this
        self.loading = true
        self.bookNowSlots = false
        this.steps = 0
        let hospitaldata = [];
        this.doctor_data = [];
        this.doctor_data = doc;
        self.doctor_hospitals = [];
        self.bookNowType = type
        if (type === 'visit') {
          let index = this.doctors.findIndex(x => x.id === doc.id);
          self.hospitals_data = self.doctors[index].doc_teams;
          self.allHospitals= self.hospitals_data;
          
          self.hospitals_data.forEach(function (hospital) {
            let consultation_fee = ''
            consultation_fee = hospital.price
            if (hospital.user_id !== 'online') {
              hospitaldata = []
              // hospitaldata = self.allHospitals.find(x => x.id === JSON.parse(hospital.user_id))
              hospitaldata=hospital;
              if (hospitaldata !== undefined) {
                self.doctor_hospitals.push({
                  'id': hospitaldata.hospital.id,
                  'name': hospitaldata.hospital.first_name + ' ' + hospitaldata.hospital.last_name,
                  'first_name' : hospitaldata.hospital.first_name,
                  'last_name' : hospitaldata.hospital.last_name,
                  'avatar': hospitaldata.hospital.profile.avatar,
                  'fees': consultation_fee
                })
              }
              self.bookNowSlots = true
              self.loading = false
            }
          })
        }
        if (type === 'online') {
          let onlineTeam = ''
          let consultation_fee = ''
          doc.onlines.forEach(function (team) {
              
                onlineTeam = team

            })
          hospitaldata = []
          if (onlineTeam !== '') {
            consultation_fee = JSON.parse(onlineTeam.price)
            self.doctor_hospitals.push({
              'id': 'online',
              'name': 'Online Consultation',
              'fees' : consultation_fee,
              'avatar' : 'video'
            })
            self.loading = false
            self.bookNowSlots = true
          }
          self.selectedHospital = 'online'
        }
        if (self.doctor_hospitals.length < 1) {
          self.loading = false;
          Vue.toasted.error('Slot Not Available' , { duration: 3000 })
        }
      },
  }
}
</script>

<style scoped>

</style>