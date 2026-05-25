<template>
  <div>
    <!-- Start Selected appointment Modal -->
    <div :class="$parent.bookNowMobile === false ? 'feedback_modle':''" class="modal fade show" id="mobile_number_verification" tabindex="-1" role="dialog" aria-hidden="true" style="display: block">
      <div class="modal-dialog" role="document">
        <div class="modal-content box_radius modal_bg box_shadow">
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
                          <img :src="basePath+'/images/check.png'"  v-tooltip="verified_message"  alt="Check" class="img-fluid">
                        </span>
                        <span>
                          <img :src="basePath+'/images/shield.png'" alt="Shield" v-tooltip="medical_message" class="img-fluid">
                        </span>
                      </h5>
                      <div class="doctor_degree text_black">
                        <p class="text_14"> "{{ doctorData.profile.sub_heading }}" </p>
                        <p class="text_14" >
                            <p><span v-for="(spec, index) in doctorData.specialities">
                    <span v-if="index === 0"> {{ spec.title }}</span>
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
              <h2 class="font-weight-normal">Appointment</h2>
            </div>
            <div class="appointment-date-time-btn w-100 d-inline-block">
              <div class="date-time float-left w-50">
                <p class="text_black d-block font-weight-bold">
                  <i class="fa fa-calendar theme-color-text" aria-hidden="true"></i>
                  <span class="ml-3">On {{ moment($parent.selected_appointment_date).format('DD-MM-YYYY') }}</span>
                </p>
                <p class="text_black font-weight-bold mt-2 d-inline-block">
                  <i class="fa fa-clock-o theme-color-text" aria-hidden="true"></i>
                  <span class="ml-3">At {{ (this.$parent.selected_time).toUpperCase() }}</span>
                </p>
              </div>
              <div class="change-date-time w-60 float-left mt-1">
<!--                <button @click="backToAppointmentSlots" class="rounded-pill knockdoc_sign_up_bg text-white float-right border-0 p-2">Change Date & Time</button>-->
              </div>
            </div>
            <div v-if="$parent.selectedHospital !== 'online' && hospital !== ''" class="hospital_details knockdoc_border mt-3">
              <p class="text_black mb-0 font-weight-bold pt-2 d-inline-block text_25 text_sm_18">
                {{ $parent.selectedHospital.first_name }} {{ $parent.selectedHospital.last_name }}
              </p>
              <p class="text_black text_14" v-if="hospital !== 'online'">
                {{ $parent.selectedHospital.profile.address }}, {{ $parent.selectedHospital.location.title }}
              </p>
              <a class="theme-color-text text_14 float-right" target="_blank" :href="'https://maps.google.com/?q='+$parent.selectedHospital.location.latitude+'+'+$parent.selectedHospital.location.longitude">
                Get Direction
              </a>
            </div>
            <form class="w-100 d-inline-block knockdoc_border pt-3">
              <div class="form-group authentication-input">
                <label class=" mb-0 text_black text_25 text_sm_18">
                  Enter Authentication Code
                </label>
                <input v-model="verification_code" name="verification_code" type="text" class="form-control doctor_profile text_14" id="verification_code" aria-describedby="emailHelp" placeholder="Authentication code">
              </div>
            </form>
            <div class="verification-text-phone-number w-100 d-inline-block">
              <a class="text_black text_14" href="#">We’ve sent verification code on your Phone Number</a>
              <p class="text_14 font-weight-bold theme-green-text float-right mb-2">
                <vue-countdown-timer
                    @start_callback="startCallBack('event started')"
                    @end_callback="endCallBack('event ended')"
                    :start-time="startAt"
                    :end-time="endAt"
                    :interval="1000"
                    :start-label="'Timer'"
                    label-position="begin"
                    :end-text="'00.00'"
                >
                  <template slot="countdown" slot-scope="scope">
                    <span>{{scope.props.minutes}}<i></i>:</span>
                    <span>{{scope.props.seconds}}</span><i></i>
                  </template>
                </vue-countdown-timer>
              </p>
            </div>
            <div class="modal-footer knockdoc_border mt-2">
              <div class="modal_footer_btn w-80 w-sm-100 w-md-100 d-inline-flex m-lg-auto mt-2 mt-lg-0">
                <button @click="submitVerificationCode" data-toggle="modal" class="knockdoc_btn_bg rounded-pill w-50 text-white p-2 text-center last_modal border-0">Continue</button>
                <button @click="resendVerificationCode" id="resend-button" :disabled='isDisabled' class="light_btn_bg rounded-pill w-50 p-2 text-center ml-5">Resend</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Selected appointment Modal -->
  </div>
</template>

<script>
import VTooltip from 'v-tooltip';
import Vue from 'vue'
import Toasted from 'vue-toasted';

Vue.use(Toasted)
export default {
  components: {VTooltip},
  name: 'BookNowSelectAppointmentComponent',
  props: ['hospital', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      startAt: '',
      endAt: '',
      verification_code: '',
      doctorData: this.$parent.doctor_data,
      isDisabled: true,
      verified_message: 'Verified User',
      medical_message: 'Medical Registration Verified',
    }
  },
  created () {
    this.endAt = (new Date).getTime()+60000
    this.startAt = (new Date).getTime()+60000
  },
  mounted () {
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  methods: {
    submitVerificationCode () {
      if (this.verification_code === '') {
        Vue.toasted.show("Enter Verification Code" , { duration: 3000 })
      }
      else if (this.verification_code === this.$parent.verification_code) {
        this.$parent.showFinalModal();
      }
      else {
        this.verification_code = ''
        Vue.toasted.error("Wrong Verification Code" , { duration: 3000 })
      }
    },
    resendVerificationCode () {
      let self = this
      axios.post(APP_URL + '/user/resend-code', {
        phone_number: self.phone_number
      }).then(function (response) {
        if (response.data.type === 'success') {
          self.endAt = (new Date).getTime()+60000
          self.isDisabled = true
          console.log(response.data)
          Vue.toasted.success(response.data.message , { duration: 3000 })
        }
        else {
          Vue.toasted.error(response.data.message , { duration: 3000 })
        }
      }).catch(function (error) {});
    },
    endCallBack (x) {
      console.log(x)
      this.isDisabled = false
      // document.querySelector('#resend-button').prop('disabled', false)
    },
    startCallBack (x) {
      console.log(x)
      this.isDisabled = true
    },
    formatedDate () {
      return moment(this.$parent.selected_appointment_date).format('MMM DD, YYYY')
    },
    backToAppointmentSlots () {
      //document.querySelector('#mobile_number_verification').classList.remove('show')
      //document.querySelector('#mobile_number_verification').classList.remove('fade')
      //document.querySelector('#mobile_number_verification').classList.remove('abc')
      //document.querySelector('#mobile_number_verification').style.display = 'none'
      let element = document.querySelector('.modal-backdrop')
      if (element) {
        element.remove(element.classList);
      }

      //document.querySelector('#modal_patient_num').classList.add('show')
      //document.querySelector('#modal_patient_num').classList.add('feedback_modle')
      /*document.querySelector('#modal_patient_num').classList.add('abc')*/
      //document.querySelector('#modal_patient_num').style.display = 'block'
    },
    closeModal() {
      document.querySelector('#mobile_number_verification').classList.remove('show')
      document.querySelector('#mobile_number_verification').classList.remove('feedback_modle')
      document.querySelector('body').classList.remove('modal-open')
      /*document.querySelector('body').classList.remove('scroll')*/
      document.querySelector('#mobile_number_verification').style.display = 'none'
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