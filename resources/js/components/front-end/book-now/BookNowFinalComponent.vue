<template>
  <div>
    <!-- Start Selected appointment Modal -->
    <div :class="$parent.bookNowMobile === false ? 'feedback_modle':''" class="modal fade show" id="book_now_final" tabindex="-1" role="dialog" aria-hidden="true" style="display: block">
      <div class="modal-dialog" role="document">
        <div class="modal-content box_radius modal_bg box_shadow">
          <div class="modal-header border-0">
            <div class="modal_bg w-100 d-inline-block box_radius box_bottom_lr_radius position-relative">
              <div id="logoed" class="logo">
                <img :src="basePath+'/images/logo.png'">
              </div>
             <!-- <button  href="/profile/settings/account-settings" type="button"  class="close close_modal" aria-label="Close" id="closed">
                <span aria-hidden="true" style="padding:3px 10px 0 0;display: inline-block;">&times;</span>
              </button> -->
              <a href="/profile/settings/account-settings" class="close close_modal">
                <span aria-hidden="true" style="padding:3px 10px 0 0;display: inline-block;">&times;</span>
              </a>
              <div class="container">
                <div class="row">
                  <div class=" col-2 pl-0 pl-lg-3 pr-0 pr-lg-3">
                    <div class="book-dr-image w-100 float-left w_xs_60px">
                      <img :src="basePath+'/uploads/users/' + doctorData.id + '/small-' + doctorData.profile.avatar" :alt="doctorData.first_name + ' ' +doctorData.last_name" :name="doctorData.first_name + ' ' +doctorData.last_name" class="img-fluid rounded-circle h_80 w_80px w_xs_60px h_xs_60px modal_img" onerror="this.src='/uploads/users/default/doctor.svg'">
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
                          <img :src="basePath+'/images/doctor-shield.png'" alt="Shield" v-tooltip="medical_message" class="img-fluid">
                        </span>
                      </h5>
                      <div class="doctor_degree text_black">
                        <p v-if="doctorData.profile.sub_heading" class="text_14"> "{{ doctorData.profile.sub_heading }}" </p>
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
          <div class="modal-body pl-4 modal_bg pt-0">
            <div class="verification-text-phone-number float-right d-none d-xl-block" id="removed">
              <a class="text_14 float-left mr-3 text-blue" 
              :href="'/download/'+time+'/'+date">Download <img :src="basePath+'/images/final-save.png'" class="img-fluid"></a>
              <a class="text_14 float-left text-blue" href="" 
              @click.prevent="printme" target="_blank">Print <img :src="basePath+'/images/final-print.png'" class="img-fluid">
            </a>
            </div>
            <div class="hospital_details mt-3">
              <p class="text_black mb-0 font-weight-bold pt-0 d-inline-block text_20 text_sm_18 w-100 text-center mb-3">
                Thank you!
              </p>
              <p class="text_black text_14 font-weight-bold text-center mb-2">
                Your appointment is Pending & our team will contact you for confirmation.
                <!-- <span>
                   <a class="text-blue" :href="'/profile/'+doctorData.slug">{{doctorData.first_name}} {{doctorData.last_name}}</a>
                </span>
                Soon we will get back to you. -->
              </p>
            </div>
            <div class="knockdoc_border w-100">
              <div class="verification-text-phone-number w-65 w-md-100 m-auto pt-3 text_20 text_xs_13">
                <div class="patient_summary mb-2 w-100 
                d-inline-block">
                  <span class="text_black font-weight-bold w-40 d-inline-block text_15 float-left"> 
                    <img :src="basePath+'/images/rs.svg'" class="img-fluid h_15"> Price</span>
                  <span class="w-60 d-inline-block text_15 
                  float-left">
                  {{ this.$parent.hospitalFees }}</span>
                </div>
                <div class="patient_summary mb-2 w-100 
                d-inline-block">
                  <span class="text_black font-weight-bold w-40 d-inline-block text_15 float-left"> 
                    <img :src="basePath+'/images/date-image.png'" 
                    class="img-fluid h_15"> Date</span>
                  <span class="w-60 d-inline-block text_15 
                  float-left">
                  {{ moment($parent.selected_appointment_date).format('DD-MM-YYYY') }}</span>
                </div>
                <div class="patient_summary mb-2 w-100 
                d-inline-block">
                  <span class="text_black font-weight-bold w-40 d-inline-block text_15 float-left"> 
                    <img :src="basePath+'/images/time-image.png'" 
                    class="img-fluid h_15"> Time</span>
                  <span class="w-60 d-inline-block text_15 
                  float-left">
                  {{ (this.$parent.selected_time).toUpperCase() }}
                </span>
                </div>
                <div class="patient_summary mb-2 w-100 
                d-inline-block">
                  <span class="text_black font-weight-bold w-40 d-inline-block text_15 float-left"> 
                    <img :src="basePath+'/images/time-image.png'" 
                    class="img-fluid h_15">
                     Status</span>
                  <span class="w-60 d-inline-block text_15 
                  float-left">
                  Pending</span>
                </div>
                <div class="patient_summary mb-2 w-100 
                d-inline-block">
                  <span class="text_black font-weight-bold w-40 d-inline-block text_15 float-left"> 
                    <img :src="basePath+'/images/address-image.png'" 
                    class="img-fluid h_15"> Address</span>
                  <span class="w-60 d-inline-block text_15 
                  float-left">
                  {{ this.$parent.selectedHospital.first_name}} {{ this.$parent.selectedHospital.last_name}}</span>
                </div>
              </div>
            </div>
            <div class="modal-footer knockdoc_border d-none d-xl-inline-block w-100" id="paybotton">
              <div class="modal_footer_btn w-100 d-inline-flex m-lg-auto mt-2 mt-lg-0 w-md-100 w-sm-100">
                <a href="/profile/settings/account-settings" data-dismiss="modal" class="rounded-pill w-50 p-2 text-center text-blue book-border font-weight-bold">Close</a>
                <a href="/profile/settings/account-settings" class="bg-green rounded-pill w-50 p-2 text-center ml-5 text-white">View Appointment Details</a>
              </div>
            </div>
            <div class="modal-footer knockdoc_border mt-2 d- d-inline-block d-xl-none w-100" id="paybotton">
              <div class="modal_footer_btn w-100 d-inline-block mt-2">
                <a href="" @click.prevent="printme" target="_blank" data-dismiss="modal" class="light_btn_bg rounded-pill w-100 p-2 text-center d-inline-block">Print</a>
                <a :href="'/download/'+time+'/'+date" class="knockdoc_btn_bg rounded-pill w-100 p-2 text-center mt-3 mb-3 text-white d-inline-block">Download</a>
                <!-- <a href="#" class="knockdoc_btn_bg rounded-pill w-100 p-2 text-center text-white d-inline-block">Take a Screenshot</a> -->
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
import moment from 'moment';
export default {
   components: {VTooltip},
  name: "BookNowFinalComponent",
  props:[
    'fileSystemDriver'
  ],
  data() {
    return {
      basePath:'',
      moment:moment,
      doctorData: this.$parent.doctor_data,
      hospitalData: this.$parent.selectedHospital,
      verified_message: 'Verified User',
      medical_message: 'Medical Registration Verified',
      time: this.$parent.selected_time,
      date: this.$parent.selected_appointment_date,
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
    closeModal() {
      document.querySelector('#book_now_final').classList.remove('show')
      document.querySelector('#book_now_final').classList.remove('feedback_modle')
      document.querySelector('body').classList.remove('modal-open')
      document.querySelector('#book_now_final').style.display = 'none'

      this.$parent.onClose()
      this.$parent.bookNowMobile = false
      let element = document.querySelector('.modal-backdrop')
      element.remove(element.classList);
    },
          printme(){ 
document.querySelector('#closed').classList.add('addRemove')
document.querySelector('#removed').classList.add('addRemove')
document.querySelector('#paybotton').classList.add('addRemove')
document.querySelector('#logoed').classList.remove('logo')
        window.print()
document.querySelector('#closed').classList.remove('addRemove')
document.querySelector('#removed').classList.remove('addRemove')
document.querySelector('#paybotton').classList.remove('addRemove')
document.querySelector('#logoed').classList.add('logo')
      },
  }
}
</script>

<style>
.logo{
  display: none;
}
.addRemove{
  display: none;
}
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