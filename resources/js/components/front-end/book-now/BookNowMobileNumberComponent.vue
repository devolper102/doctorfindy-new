<template>
  <div>
    <div v-if="loading" id="loader"></div>
    <!-- Start Mobile Number Modal -->
    <div :class="$parent.bookNowMobile === true ? 'feedback_modle':''" class="modal fade show" id="mobile_number_detail" tabindex="-1" role="dialog" aria-hidden="true" style="display: block">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal_bg box_shadow">
          <div class="modal-header border-0">
            <div class="modal_bg w-100 d-inline-block box_radius box_bottom_lr_radius position-relative">

              <button data-dismiss="modal" type="button" v-on:click="closeModal()" class="close close_modal" aria-label="Close">
                <span aria-hidden="true" style="display: inline-block;">&times;</span>
              </button>

              <div class="container">
                <div class="row">
                  <div class=" col-2 pl-0 pl-lg-3 pr-0 pr-lg-3">
                    <div class="book-dr-image w-100 float-left w_xs_60px">
                      <img :src="basePath+'/uploads/users/' + doctorData.id + '/small-' + doctorData.profile.avatar" :alt="doctorData.first_name + ' ' +doctorData.last_name" :name="doctorData.first_name + ' ' +doctorData.last_name" class="img-fluid rounded-circle h_80 w_80px w_xs_60px h_xs_60px modal_img" :onerror="`this.src=${basePath}/uploads/users/default/doctor.svg`">
                    </div>
                  </div>
                  <div class="col-10 pl-lg-0 pl-3">
                    <div class="prfile_detail">
                      <h5 class="d-inline-block text_md_16 w-90">
                      {{ doctorData.first_name }} {{ doctorData.last_name }}
                        <!--        <span v-if="doctorData.profile.verify_registration"><img src="/images/black_check.png" alt="Check" class="img-fluid"></span>
                            <span v-if="doctorData.profile.verify_medical !== ''"><img src="/images/black_shield.png" alt="Shield" class="img-fluid"></span> -->
                        <span class="ml-2">
                          <img :src="basePath+'/images/doctor-check.png'"  v-tooltip="verified_message"  alt="Check" class="img-fluid">
                        </span>
                        <span>
                          <img :src="basePath+'/images/doctor-shield.png'" 
                          alt="Shield" v-tooltip="medical_message" class="img-fluid">
                        </span>
                      </h5>
                      <div class="doctor_degree text_black">
                        <p class="text_14"> {{ doctorData.profile.sub_heading}} </p>
                        <p class="text_14" >
                            <p><span v-for="(spec, index) in doctorData.specialities">
                    <span v-if="index === 0">{{ spec.title }}</span>
                    <span v-else>,{{ spec.title }}</span>
                    </span> </p>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body pl-3 pl-lg-4 modal_bg">
            <div class="prfile_detail pt-2 pb-2">
              <h2 class="font-weight-normal text_22">Appointment</h2>
            </div>
            <div class="appointment-date-time-btn w-100 d-inline-block">
              <div class="date-time float-left w-40">
                <p class="text_black d-block font-weight-bold">
                  <i class="fa fa-calendar text-green" aria-hidden="true"></i>
                  <span class="ml-3 text-xs-12">On {{ moment($parent.selected_appointment_date).format('DD-MM-YYYY') }}</span>
                </p>
                <p class="text_black font-weight-bold mt-2 d-inline-block">
                  <i class="fa fa-clock-o text-green" 
                  aria-hidden="true"></i>
                  <span class="ml-3 text-xs-12">At {{ (this.$parent.selected_time).toUpperCase() }}</span>
                </p>
              </div>
              <div class="change-date-time w-60 float-left mt-1">
                <button @click="backToAppointmentSlots" class="rounded-pill bg-green text-white float-right border-0 p-2">Change Date & Time</button>
              </div>
            </div>
            <div v-if="$parent.selectedHospital !== 'online' && hospitalData !== ''" class="hospital_details knockdoc_border mt-3">
              <p class="text_black mb-0 font-weight-bold pt-2 d-inline-block text_20 text_sm_18">
                {{ hospitalData.first_name }} {{ hospitalData.last_name }}
              </p>
              <p  class="text_black text_14" v-if="hospital !== 'online' && hospitalData.location!=undefined">
                {{ hospitalData.profile.address }}, {{ hospitalData.location.title }}
              </p>
              <a v-if="hospitalData.location!=undefined" class="theme-color-text text_14 float-right" target="_blank" :href="'https://maps.google.com/?q='+hospitalData.location.latitude+'+'+hospitalData.location.longitude">
                Get Direction
              </a>
            </div>
            <div class="form-group authentication-input mt-2">
                <label class=" mb-0 text_black text_15 text_sm_18">
                  Enter Your First Name
                </label>
                <input type="text" class="form-control doctor_profile text_14 text_black" v-model="first_name" name="first_name" id="first_name" aria-describedby="emailHelp" placeholder="First Name">
              </div>
              <div class="form-group authentication-input">
                <label class=" mb-0 text_black text_15 text_sm_18">
                  Enter Your Mobile Number
                </label>
                <input type="text" class="form-control doctor_profile text_14 text_black" v-model="phone_number" name="phone_number" id="phone_number" aria-describedby="emailHelp" placeholder="Mobile Number">
              </div>
              
            <div class="verification-text-phone-number w-100 d-inline-block">
              <!-- <p class="text_black text_14 w-60">You will receive an OTP shortly.</p> -->
              <p>We will send appointment-related communications on this number.</p>
              <!-- <p class="text_14 font-weight-bold theme-green-text float-right">Timer  00.00</p> -->
            </div>

            <div class="modal-footer knockdoc_border mt-2">
              <div class="modal_footer_btn w-100 w-sm-100 d-inline-block m-lg-auto mt-2 mt-lg-0">
                <button @click="sendVerificationCode" data-toggle="modal" class="bg-green rounded-pill w-100 text-white p-2 text-center number_modal border-0">Continue</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Mobile Number Modal -->
  </div>
</template>

<script>
import VTooltip from 'v-tooltip';
import Toasted from 'vue-toasted';
import moment from 'moment';
Vue.use(Toasted)
export default {
  components: {VTooltip},
  name: "BookNowMobileNumberComponent",
  props: ['hospital', 'slotSelected', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      moment:moment,
      doctorData: this.$parent.doctor_data,
      hospitalData: this.$parent.selectedHospital,
      phone_number: '',
      first_name: '',
      loading: false,
      verified_message: 'Verified User',
      medical_message: 'Medical Registration Verified',
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
  created () {
  },
  methods: {
    sendVerificationCode() {
      let self = this
      self.loading = true
      if (self.phone_number === '' || self.phone_number.length < 1 ) {
        Vue.toasted.error('Enter your mobile number' , { duration: 3000 })
        this.loading = false
        return
      }
      else if (!(/^(3)([0-9]{2}[0-9]{7})$/.test(self.phone_number)) && !(/^(03)([0-9]{2}[0-9]{7})$/.test(self.phone_number)) && !(/^(923)([0-9]{2}[0-9]{7})$/.test(self.phone_number))) {
        Vue.toasted.error("Use Correct Format  923XXXXXXXXX" , { duration: 3000 })
        this.loading = false
        return
      }
      if ((/^(3)([0-9]{2}[0-9]{7})$/.test(self.phone_number))) {
        self.phone_number = '92'+self.phone_number
      }
      if ((/^(03)([0-9]{2}[0-9]{7})$/.test(self.phone_number))) {
        self.phone_number = '92' + self.phone_number.substring(1)
      }
      axios.post(APP_URL + '/user/send-code', {
          phone_number: self.phone_number, first_name:self.first_name
        }).then(function (response) {
          console.log('asasasas',response.data);
          if (response.data.type === 'success') {
            Vue.toasted.success(response.data.message , { duration: 3000 })
            self.$parent.verification_code = response.data.code
            self.$parent.patientData = response.data.user
            self.$parent.bookNowMobile = false
            self.$parent.showFinalModal()
          } else {
            Vue.toasted.error(response.data.message , { duration: 3000 })
          }
      }).catch(function (error) {});
    },
    backToAppointmentSlots () {
             document.querySelector('#mobile_number_detail').classList.remove('show')
      document.querySelector('#mobile_number_detail').classList.remove('fade')
      document.querySelector('#mobile_number_detail').classList.remove('abc')
      document.querySelector('#mobile_number_detail').style.display = "none"

      let element = document.querySelector('.modal-backdrop')
      if (element) {
        element.remove(element.classList);
      }
      if (document.querySelector('#modal_patient_num')) {
        document.querySelector('#modal_patient_num').classList.add('show')
        document.querySelector('#modal_patient_num').style.display = 'block'
        document.querySelector('#modal_patient_num').classList.add('abc')
      }

    },
    closeModal() {
      document.querySelector('#mobile_number_detail').classList.remove('show')
      /*document.querySelector('body').classList.remove('scroll')*/
      document.querySelector('#mobile_number_detail').classList.remove('feedback_modle')
      document.querySelector('body').classList.remove('modal-open')
      document.querySelector('#mobile_number_detail').style.display = "none"
      this.$parent.onClose()
      this.$parent.bookNowMobile = false 
      let element = document.querySelector('.modal-backdrop')
      if (element) {
        element.remove(element.classList);
      }
    }
  }
}
</script>


<style>
.tooltip {
  display: block !important;
  z-index: 10000;
}

.tooltip .tooltip-inner {
  background: #00A2E8;
  color: white;
  border-radius: 4px;
  padding: 5px 10px 4px;
}

.tooltip .tooltip-arrow {
  width: 0;
  height: 0;
  border-style: solid;
  position: absolute;
  margin: 5px;
  border-color: #00A2E8;
  z-index: 1;
}

.tooltip[x-placement^="top"] {
  margin-bottom: 5px;
}

.tooltip[x-placement^="top"] .tooltip-arrow {
  border-width: 5px 5px 0 5px;
  border-left-color: transparent !important;
  border-right-color: transparent !important;
  border-bottom-color: transparent !important;
  bottom: -5px;
  left: calc(50% - 5px);
  margin-top: 0;
  margin-bottom: 0;
}

.tooltip[x-placement^="bottom"] {
  margin-top: 5px;
}

.tooltip[x-placement^="bottom"] .tooltip-arrow {
  border-width: 0 5px 5px 5px;
  border-left-color: transparent !important;
  border-right-color: transparent !important;
  border-top-color: transparent !important;
  top: -5px;
  left: calc(50% - 5px);
  margin-top: 0;
  margin-bottom: 0;
}

.tooltip[x-placement^="right"] {
  margin-left: 5px;
}

.tooltip[x-placement^="right"] .tooltip-arrow {
  border-width: 5px 5px 5px 0;
  border-left-color: transparent !important;
  border-top-color: transparent !important;
  border-bottom-color: transparent !important;
  left: -5px;
  top: calc(50% - 5px);
  margin-left: 0;
  margin-right: 0;
}

.tooltip[x-placement^="left"] {
  margin-right: 5px;
}

.tooltip[x-placement^="left"] .tooltip-arrow {
  border-width: 5px 0 5px 5px;
  border-top-color: transparent !important;
  border-right-color: transparent !important;
  border-bottom-color: transparent !important;
  right: -5px;
  top: calc(50% - 5px);
  margin-left: 0;
  margin-right: 0;
}

.tooltip.popover .popover-inner {
  background: #f9f9f9;
  color: black;
  padding: 24px;
  border-radius: 5px;
}

.tooltip.popover .popover-arrow {
  border-color: #f9f9f9;
}

.tooltip[aria-hidden='true'] {
  visibility: hidden;
  opacity: 0;
  transition: opacity .15s, visibility .15s;
}

.tooltip[aria-hidden='false'] {
  visibility: visible;
  opacity: 1;
  transition: opacity .15s;
}

</style>