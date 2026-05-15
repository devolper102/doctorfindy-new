<template>
  <div>
    <div ></div>
     <!-- <div class="container">
      <div class="row">
            <div class="col-12 mt-4">
              <bread-crumb-spec></bread-crumb-spec>
            </div>
      </div>
    </div> -->
    <div class="container">
      <div class="col-md-12 p-0">
        <div class="report_doctor w-100 d-inline-block mb-3" 
        v-if="checkId !== undefined" @click="showReportModal">
          <a href="javascript:void(0)" class="rounded-pill bg-green btn_padding text-white float-right">
            <i class="fa fa-flag"></i> Report Doctor</a>
        </div>
      </div>
      <doctor-tab
          :user="user"
          :patient="patient"
          :fee="fee"
          :fileSystemDriver="fileSystemDriver"
        >
      </doctor-tab>

      <div class="row" v-if="hasTimeSlots">
       <div :key="index+'-l'" class="col-12 col-lg-6 col-md-12 mt-3 mb-4" v-for="(online, index) in onlinesWithSlots">
          <div class="shedule_calendar custom_top_rounded bg-green text-white d-inline-block w-100 box-shadow">
            <div class="video_consultation_header pt-1 pl-2 pr-2 pb-1 d-inline-block w-100">
              <!-- <img v-lazy="'/uploads/users/'+team.id+'/'+team.slug" alt="Video Consultation Icon" class="img-fluid h_50 h_md_40 w-10 w_md_40px rounded-circle float-left"> -->
              <span class="w-40px h_40 rounded-circle text_20 text-center text-white bg-white float-left">
                <!-- <i class="fas fa-video text-green mt-10" 
                aria-hidden="true"></i> -->
                <img class="fa-video-image" :src="basePath+'/images/fa-video.png'" alt="pictire">
              </span>
              <div class="shedule_head float-left ml-3 w-70">
                <span class="text-white text_13"> 
                {{ getHospitalName('online') }} </span>
                <p class="text-white">Online Video Consultation Booking</p>
              </div>
              <!--<a target="_blank" :href="'https://maps.google.com/?q='+user.profile.latitude+'+'+user.profile.longitude"
                 class="float-right font-weight-bold theme-color-text">Get Direction</a>-->
            </div>
          </div>
          <div>
            <book-now-slots
                :fileSystemDriver="fileSystemDriver"
                :user="user"
                :hospital="'online'"
                :team="online"
            ></book-now-slots>
          </div>
        </div>
        <div class="col-12 col-lg-6 col-md-12 mt-lg-3 mb-4" :key="index+'-k'" v-if="index < showSlotsBox" v-for="(team, index) in hospitalsWithSlots">
          <div class="shedule_calendar custom_top_rounded bg-white text-white d-inline-block w-100 slot_box-shadow">
            <div class="video_consultation_header pt-1 pl-2 pr-2 pb-1 d-inline-block w-100">
              <img v-if="team.hospital.length > 0 && team.hospital.profile.avatar !== null" v-lazy="basePath+'/uploads/users/'+team.hospital.id+'/extra-small-'+team.hospital.profile.avatar" alt="Video Consultation Icon" class="img-fluid h_40 h_md_40 w-40px w_md_40px rounded-circle border_transparent float-left">
              <img v-else v-lazy="basePath+'/uploads/users/default/hospital.svg'" alt="Video Consultation Icon" 
              class="img-fluid h_40 h_md_40 w_40px w_md_40px rounded-circle border_transparent float-left">
              <div class="shedule_head float-left ml-3 w-70">
                <span class="text-blue"> 
                {{ getHospitalName(team.user_id) }}</span>
                <p v-if="team.hospital.length == 0" class="text_black">Online Video Consultation Booking</p>
                <p v-if="team.hospital.length == undefined && team.hospital.profile.address !== null" class="text_black text-truncate">
                  {{team.hospital.profile.address}}
                </p>
              </div>
              <a target="_blank" :href="'https://maps.google.com/?q='+user.profile.latitude+'+'+user.profile.longitude"
                 class="float-right font-weight-bold text-blue mt-10">Get Direction</a>
            </div>
          </div>
          <div>
            <book-now-slots
                :fileSystemDriver="fileSystemDriver"
                :user="user"
                :hospital="team.hospital"
            ></book-now-slots>
          </div>
        </div>
         
        <div  class="text-center w-100 d-inline-block mb-2">
          <a href="javascript:void(0)" v-if="hospitalsWithSlots.length > 1 && hospitalsWithSlots.length > showSlotsBox" @click="showSlotsBox += 2"  class="btn_padding text-white rounded-pill text_15 d-inline-block bg-blue showmore">Show More <i aria-hidden="true" class="fa fa-arrow-right ml-3"></i></a>
        </div>
      </div>
    </div>
    <!-- Short Description Section -->
    <div class="container mb-4" v-if="user.profile.short_desc && user.profile.short_desc !== '' && user.profile.short_desc !== null">
      <div class="row">
        <div class="col-12">
          <div class="short-description-section bg-white box-shadow rounded p-3">
            <h3 class="text-blue font-weight-bold text_16 mb-1">About Doctor</h3>
            <p class="text_14 text_black line-height-normal" v-html="user.profile.short_desc"></p>
          </div>
        </div>
      </div>
    </div>
    <book-now-mobile
          v-if="bookNowMobile"
          v-model="selected_appointment_date"
          :hospital="hospital"
          :slotSelected="slotSelected"
          :fileSystemDriver="fileSystemDriver">  
    </book-now-mobile>
    <book-now-verification
          v-if="bookNowVerification"
          :hospital="selectedHospital"
          :slotSelected="slotSelected"
          :fileSystemDriver="fileSystemDriver"
    ></book-now-verification>
    <book-now-final
          v-if="bookNowFinal"
          :fileSystemDriver="fileSystemDriver"
    ></book-now-final>
    <report
        :user="user"
        :patient="patient"
    ></report>

  </div>
</template>

<script>
import Toasted from 'vue-toasted';
import VLazyImage from "v-lazy-image/v2";

Vue.use(Toasted)

// Vue.filter('hospitalAddress', function(value, hos) {
//   if (hos !== 'online') {
//     let hospital = hos.filter(x => x.id === JSON.parse(value.user_id))
//     if (hospital[0].location_id !== null && hospital[0].area_id !== null) {
//       return hospital[0].profile.address + ', ' + hospital[0].area.title + ', ' + hospital[0].location.title
//     }
//     else {
//       return ''
//     }
//   }
//   else {
//     return 'Online Video Consultation Booking'
//   }

// });

export default {
  components: 
  {
    VLazyImage
  },
  name: "DoctorProfileComponent",
  props: ['user', 'hoptis', 'patient', 'doctor','segments','fee', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      loading: false,
      doctor_data: this.user,
      slotSelected: false,
      bookNowMobile: false,
      bookNowVerification: false,
      bookNowFinal: false,
      appointment_days: [],
      appointment_dates: [],
      phone_number: '',
      selected_time: '',
      selected_appointment_date: '',
      hospitalFees: '',
      selected_date: '',
      selected_day: '',
      selected_slot: '',
      selectedHospital:'',
      verification_code: '',
      patientData: '',
      doctorData: this.user,
      bookNowType: '',
      hospital: '',
      showSlotsBox: 1,
      checkId: '',
      resultSegments: this.segments,
      hospitals: this.hoptis,
    }
  },
 async created () {
    // const hos = await axios.get('/get-all-hospital')
    // this.hospitals = Object.freeze(hos.data) 
    this.checkId = this.user.total_appointment.find(pf =>pf.patient_id === this.patient.id)
    this.getDatesDay()
    // Count online consultations with slots
    const onlineCount = this.onlinesWithSlots.length;
    if(onlineCount > 0){
        this.showSlotsBox = 1;
      }else{
        this.showSlotsBox = 2;
      }
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
  computed: {
    // Filter hospitals that have valid slots
    hospitalsWithSlots() {
      if (!this.user.doc_teams || this.user.doc_teams.length === 0) {
        return [];
      }
      return this.user.doc_teams.filter(team => this.hasTeamSlots(team));
    },
    // Filter online consultations that have valid slots
    onlinesWithSlots() {
      if (!this.user.onlines || this.user.onlines === null || this.user.onlines.length === 0) {
        return [];
      }
      return this.user.onlines.filter(online => this.hasOnlineSlots(online));
    },
    hasTimeSlots() {
      // Helper function to check if slots are valid and not empty
      const hasValidSlots = (slotsData) => {
        if (!slotsData || slotsData === null || slotsData === '' || slotsData === 'null') {
          return false;
        }
        
        // Try to parse JSON if it's a string
        try {
          const parsed = typeof slotsData === 'string' ? JSON.parse(slotsData) : slotsData;
          // Check if parsed object has any actual slot data
          if (typeof parsed === 'object' && parsed !== null) {
            // Check if there are any days with slots
            const hasDays = parsed.days && Array.isArray(parsed.days) && parsed.days.length > 0;
            // Or check if there are any direct slot properties
            const hasDirectSlots = Object.keys(parsed).some(key => {
              return key !== 'days' && parsed[key] && typeof parsed[key] === 'object' && 
                     parsed[key].slots && Object.keys(parsed[key].slots).length > 0;
            });
            return hasDays || hasDirectSlots;
          }
          return false;
        } catch (e) {
          // If parsing fails, check if it's a non-empty string
          return slotsData.length > 0;
        }
      };
      
      // Check if there are any online consultation slots with valid slots
      const hasOnlineSlots = this.user.onlines && this.user.onlines !== null && this.user.onlines.length > 0 &&
        this.user.onlines.some(online => {
          return hasValidSlots(online.slots) || hasValidSlots(online.online_slots);
        });
      
      // Check if there are any hospital teams with valid slots configured
      const hasHospitalTeams = this.user.doc_teams && this.user.doc_teams.length > 0 &&
        this.user.doc_teams.some(team => {
          return hasValidSlots(team.slots);
        });
      
      // Return true only if there are actual valid slots configured
      return hasOnlineSlots || hasHospitalTeams;
    }
  },
  methods: {
    hasValidSlots(slotsData) {
      // Helper function to check if slots are valid and not empty
      if (!slotsData || slotsData === null || slotsData === '' || slotsData === 'null') {
        return false;
      }
      
      // Try to parse JSON if it's a string
      try {
        const parsed = typeof slotsData === 'string' ? JSON.parse(slotsData) : slotsData;
        // Check if parsed object has any actual slot data
        if (typeof parsed === 'object' && parsed !== null) {
          // Check if there are any days with slots
          const hasDays = parsed.days && Array.isArray(parsed.days) && parsed.days.length > 0;
          // Or check if there are any direct slot properties
          const hasDirectSlots = Object.keys(parsed).some(key => {
            return key !== 'days' && parsed[key] && typeof parsed[key] === 'object' && 
                   parsed[key].slots && Object.keys(parsed[key].slots).length > 0;
          });
          return hasDays || hasDirectSlots;
        }
        return false;
      } catch (e) {
        // If parsing fails, check if it's a non-empty string
        return slotsData.length > 0;
      }
    },
    hasTeamSlots(team) {
      // Check if this specific team has valid slots
      return this.hasValidSlots(team.slots);
    },
    hasOnlineSlots(online) {
      // Check if this specific online consultation has valid slots
      return this.hasValidSlots(online.slots) || this.hasValidSlots(online.online_slots);
    },
    getHospitalName(hos_id) {
      if (hos_id !== 'online') {
        this.hospital = ''
        this.hospital = this.hospitals.find(x => x.id === JSON.parse(hos_id))
        this.selectedHos = this.hospital
        return this.selectedHos.first_name + ' ' + this.selectedHos.last_name
      }
      else {
        return 'Online Video Consultation Booking'
      }
    },
    getDatesDay() {
      let self = this;
      for(let i = 0; i < 14; i++) {
        let d = moment().add(i, 'days');
        self.appointment_days.push(d.format('ddd'));
        self.appointment_dates.push(d.format('YYYY-MM-DD'));
      }
      self.appointment_days = self.appointment_days.map(v => v.toLowerCase())
    },
    showMobileModal: function () {
      // this.loading = true
      this.bookNowMobile = true
      if (this.bookNowMobile) {
        document.querySelector('#mobile_number_detail').style.display = 'block'
        document.querySelector('#mobile_number_detail').classList.add('feedback_modle')
        document.querySelector('body').classList.add('scroll')
      }
      this.loading = false
    },
    showAuthentication: function () {
      this.bookNowMobile = false
      this.bookNowVerification = true
      document.querySelector('#mobile_number_detail').style.display = 'none'
      document.querySelector('body').classList.remove('scroll')

      document.querySelector('#mobile_number_verification').style.display = 'block'
      this.loading = false
    },
    showFinalModal: function () {
      this.loading = true
      this.submitAppointment(this.patientData.id)
      this.hospitalFees = this.fee
      this.bookNowVerification = false
      this.bookNowFinal = true
      this.loading = false
    },
    showReportModal: function () {
      this.loading = true
      if(this.patient.length === undefined) {
        document.querySelector('#doctor-report-modal').classList.add('show')
        document.querySelector('#doctor-report-modal').classList.add('feedback_modle')
        document.querySelector('body').classList.add('scroll')
        document.querySelector('#doctor-report-modal').style.display = "block"
      }
      else {
        Vue.toasted.show('Please Login First' , { duration: 3000 })
        /*document.querySelector('#doctor-report-modal').classList.remove('show')*/
      }
      this.loading = false
    },
    submitAppointment: function (id) {
      this.loading = true
      let self = this;
      // self.appointment.user_id = id;
      axios.post(APP_URL + '/submit-appointment', {
        date : self.selected_date,
        day : self.selected_day,
        hospital : self.selectedHospital.id,
        time : self.selected_time,
        total_charges : self.hospitalFees,
        type : self.bookNowType,
        code : self.verification_code,
        user_id : self.doctor_data.id,
      }).then(function (response) {
        if (response.data.type === 'success') {
          self.appointment_last_id = ''
          self.appointment_last_id = response.data.appointment_id;
          if (self.bookNowType === 'online') {

          }
          else {
            self.loading = false;
            self.next();
          }
        } else if (response.data.type === 'error') {
          self.loading = false;
        }
      })
          .catch(error => {});
    },
    onClose: function() {
      let self = this
      self.bookNowSlots = false
      self.loading = true
      self.loading = false
    },
  }
}
</script>

<style>

</style>