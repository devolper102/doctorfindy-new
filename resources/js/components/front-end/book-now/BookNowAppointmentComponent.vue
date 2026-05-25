<template>
  <div>
    <div v-if="loading" id="loader"></div>
    <!-- Start Booking Modal -->
    <div class="modal fade" id="modal_patient_num" tabindex="-1" role="dialog" aria-labelledby="modal_patient_num_modal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content box_radius modal_bg 
        box_shadow">
          <div class="modal-header border-0">
            <div class="modal_bg w-100 d-inline-block box_radius box_bottom_lr_radius position-relative">
              <button data-dismiss="modal" type="button" v-on:click="closeModal()" class="close close_modal" aria-label="Close">
                <span aria-hidden="true" style="display: inline-block;">&times;</span>
              </button>
              <div class="container">
                <div class="row">
                  <div class=" col-2 pl-0 pl-lg-3 pr-0 pr-lg-3">
                    <div class="book-dr-image w-100 float-left w_xs_60px">
                      <img :src="basePath+'/uploads/users/' + doctorData.id + '/small-' + doctorData.profile.avatar" :alt="doctorData.first_name + ' ' +doctorData.last_name" :name="doctorData.first_name + ' ' +doctorData.last_name" class="img-fluid rounded-circle h_80 w_80px w_xs_60px h_xs_60px modal_img" :onerror="`this.src=${basePath}/uploads/users/default/doctor.svg`"
>
                    </div>
                  </div>
                  <div class="col-10 pl-lg-0 pl-3">
                    <div class="prfile_detail">
                      <h5 class="d-inline-block w-90 mb-0 text_15">
                      <span>
                        {{ doctorData.first_name }} {{ doctorData.last_name }}
                      </span>
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
                        <p class="text_12 text-red">
                          <p class="text-red text_12 font-weight-bold text-truncate">
                            <span v-for="(spec, index) in doctorData.specialities">
                    <span v-if="index === 0">{{ spec.title }}</span>
                    <span v-else>, {{ spec.title }}</span>
                    </span> </p>
                        </p>
                        <p class="text_12 text_black">
                          MBBS, CRCP (Dow), D.Derm, Diploma in Dermato-Surgery
                        </p>
                        <p class="text_13"> {{ doctorData.profile.sub_heading }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body pl-0 pl-lg-4 pr-0 pr-lg-4 modal_bg">
            <div v-if="hospitalsData[0].name !== 'Online Consultation' " class="prfile_detail pt-2 pb-2 pl-3">
              <h2 class="text_22">Book an appointment</h2>
              <p class="font-weight-bold">Choose Hospital</p>
            </div>
            <div class="select_doctor_hospital pl-3 pr-3">
              <div v-if="hospitalsData[0].name !== 'Online Consultation' " v-for="(hospitalData, index ) in hospitalsData" class="given_hospital d-inline-block float-left hospitals_box pr-2 w-33 choose_hospital_section mt-0 mt-lg-2 mt-md-2 mt-xl-2">
                <a href="javascript:void(0)" @click="chooseHospital( hospitalData, 'hospital-button-'+index )" :id="'hospital-button-'+index" class="d-inline-block select_hospital_red p-1 doctor_profile rounded-pill w-100 book-listing-profile">
                  <!-- <div class="hospital_img w-30 d-table-cell align-middle">
                    <img :src="'/uploads/users/'+hospitalData.id+'/'+hospitalData.avatar" :alt=" hospitalData.name " :name=" hospitalData.name " class="img-fluid w_60px h_60 float-left rounded-circle mr-2" onerror="this.src='/uploads/users/default/hospital.svg'">
                  </div> -->
                  <div class="hospital_fee hospital_details float-left text_12 w-100 p-2">
                    <p class="text_11 text-truncate pl-3"> {{ hospitalData.name }}</p>
                    <p class="mb-0 mt-2">
                      <span class="mr-3 pl-2">
                        <img :src="basePath+'/images/fee-icon-image.svg'">
                        <!-- <img src="/images/fee-icon-image-2.svg"> -->
                      {{ hospitalData.fees }}
                    </span>
                      <span>
                        <img :src="basePath+'/images/available-icon.svg'" 
                        style="margin-bottom: 4px;"> 
                        <!-- <img src="/images/available-icon-2.svg"
                        style="margin-bottom: 4px;"> -->
                      Available Today
                    </span>
                    </p>
                  </div>
                </a>
              </div>
              <p class="font-weight-bold mt-3 mt-2 d-inline-block w-100">Select best time for appointment</p>
            </div>
            <div class="col-md-12 p-xs-0" v-model="slots" v-if="slotsCheck">
              <div class="dateDays calendar">
                  <VueSlickCarousel
                      ref="c1" v-bind="c1Setting" @beforeChange="onBeforeChangeC2"
                  >
                    <div v-for="(num, index) in 13">
                      <div class="w-70 d-block m-auto calendar_day text-center">
                        {{ appointment_days[index] | formatDay}}
                        <p class="font-weight-normal">
                          {{ appointment_dates[index] | frontDateChange}}
                        </p></div>
                    </div>
                  </VueSlickCarousel>
                </div>
              <VueSlickCarousel
                  ref="c2" v-bind="c2Setting" @beforeChange="onBeforeChangeC1"
              >
                <div v-for="(num, index) in 13">
                  <div class="slots_shedule knockdoc_border">
                    <div v-if="slotsCheck">
                      <div class="row" v-if="morningCheckM(index, appointment_dates[index], slots[appointment_dates[index]])">
                        <div class="col-xs-4 col-sm-3 col-md-4 col-lg-2" v-if="morningCheck">
                        <span class="text_14 mt-3 d-inline-block float-left">
                          <img :src="basePath+'/images/morning.png'" alt="Morning Image" class="img-fluid float-left mr-2 mt-1"> Morning</span>
                        </div>
                        <div class="col-xs-8 col-sm-9 col-md-8 col-lg-10" v-if="morningCheck">
                          <ul class="morning text_black d-inline-block w-100 text_14 m-0">
                            <li :id="'slot-m-' + index + '-' + i" v-if="morningSlotCheckM(slot)" v-for="(slot, i) in slots[appointment_dates[index]]" v-bind:style= "[slot.space < 1 ? {'background-color': '#dadada', 'color':'#afafaf','border':'1px solid #dadada'} : choosedSlot ?  {'background-color': '#515151', 'color':'#ffffff'} : '']" class="float-left pl-2 pr-2 ml-3 mt-3 slot_radius">
                              <span @click="!slot.space < 1 && selectedSlot( slot.start_time, appointment_dates[index], appointment_days[index], 'slot-m-' + index + '-' + i)">
                                {{ slot.start_time }}
                              </span>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="row" v-if="afterNoonCheckM(index, appointment_dates[index], slots[appointment_dates[index]])">
                        <div class="col-xs-4 col-sm-3 col-md-4 col-lg-2" v-if="afternoonCheck">
                          <span class="text_14 mt-3 d-inline-block float-left"><img :src="basePath+'/images/afternoon.png'" alt="Afternoon Image" class="img-fluid float-left mr-2 mt-1"> Afternoon</span>
                        </div>
                        <div class="col-xs-8 col-sm-9 col-md-8 col-lg-10" v-if="afternoonCheck">
                          <ul class="morning text_black d-inline-block w-100 text_14 m-0">
                            <li :id="'slot-a-' + index + '-' + i" v-if="afterNoonSlotCheckM(slot)" v-for="(slot, i) in slots[appointment_dates[index]]" v-bind:style= "[slot.space < 1 ? {'background-color': '#dadada', 'color':'#afafaf','border':'1px solid #dadada'} : choosedSlot ?  {'background-color': '#515151', 'color':'#ffffff'} : '']" class="float-left pl-2 pr-2 ml-3 mt-3 slot_radius">
                              <span @click="!slot.space < 1 && selectedSlot( slot.start_time, appointment_dates[index], appointment_days[index], 'slot-a-' + index + '-' + i)">
                                {{ slot.start_time }}
                              </span>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="row" v-if="eveningCheckM(index, appointment_dates[index], slots[appointment_dates[index]])">
                        <div class="col-xs-4 col-sm-3 col-md-4 col-lg-2" v-if="eveningCheck">
                          <span class="text_14 mt-3 d-inline-block float-left"><img :src="basePath+'/images/evening.png'" alt="Evening Image" class="img-fluid float-left mr-2 mt-1"> Evening</span>
                        </div>
                        <div class="col-xs-8 col-sm-9 col-md-8 col-lg-10" v-if="eveningCheck">
                          <ul class="morning text_black d-inline-block w-100 text_14 m-0">
                            <li :id="'slot-e-' + index + '-' + i" v-if="eveningSlotCheckM(slot)" v-for="(slot, i) in slots[appointment_dates[index]]" v-bind:style= "[slot.space < 1 ? {'background-color': '#dadada', 'color':'#afafaf','border':'1px solid #dadada'} : choosedSlot ?  {'background-color': '#515151', 'color':'#ffffff'} : '']" class="float-left pl-2 pr-2 ml-3 mt-3 slot_radius">
                              <span @click="!slot.space < 1 && selectedSlot( slot.start_time, appointment_dates[index], appointment_days[index], 'slot-e-' + index + '-' + i)">
                                {{ slot.start_time }}
                              </span>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="row" v-if="nightCheckM(index, appointment_dates[index], slots[appointment_dates[index]])">
                        <div class="col-xs-4 col-sm-3 col-md-4 col-lg-2" v-if="nightCheck">
                          <span class="text_14 mt-3 d-inline-block float-left"><img :src="basePath+'/images/night.png'" alt="Night Image" class="img-fluid float-left mr-2 mt-1"> Night</span>
                        </div>
                        <div class="col-xs-8 col-sm-9 col-md-8 col-lg-10" v-if="nightCheck">
                          <ul class="morning text_black d-inline-block w-100 text_14 m-0">
                            <li :id="'slot-n-' + index + '-' + i" v-if="nightSlotCheckM(slot)" v-for="(slot, i) in slots[appointment_dates[index]]" v-bind:style= "[slot.space < 1 ? {'background-color': '#dadada', 'color':'#afafaf','border':'1px solid #dadada'} : choosedSlot ?  {'background-color': '#515151', 'color':'#ffffff'} : '']" class="float-left pl-2 pr-2 ml-3 mt-3 slot_radius">
                              <span @click="!slot.space < 1 && selectedSlot( slot.start_time, appointment_dates[index], appointment_days[index], 'slot-n-' + index + '-' + i)">
                                {{ slot.start_time }}
                              </span>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div v-if="!morningCheck && !afternoonCheck && !eveningCheck && !nightCheck">
                        <span>
                          <img :src="basePath+'/images/empty-images/no-record.png'">
                        </span>
                        <span class="w-100 text-center d-block">
                          No Data Available
                        </span>
                      </div>

                    </div>
                  </div>
                </div>
              </VueSlickCarousel>
            </div>
              <div class="modal-footer knockdoc_border mt-2">
                <div v-if="this.$parent.patientData.length !== 0 && this.$parent.patientData.phone_number !== null" class="modal_footer_btn w-80 w-sm-100 w-md-100 d-inline-flex m-lg-auto mt-2 mt-lg-0">
                  <button @click="$parent.showFinalModal" disabled id="appointment-selected" data-toggle="modal" class="bg-green rounded-pill w-lg-50 w-100 p-2 text-center appointment_modal border-0 text-white">Book Appointment</button>
                  <button v-on:click="closeModal()" href="javascript:void(0)" class="light_btn_bg rounded-pill w-lg-50 w-100 p-2 text-center ml-lg-5 d-sm-inline ml-1" data-dismiss="modal">Cancel</button>
                </div>
                <div v-else class="modal_footer_btn w-80 w-sm-100 w-md-100 d-inline-flex m-lg-auto mt-2 mt-lg-0">
                  <button @click="$parent.showMobileModal" disabled id="appointment-selected" data-toggle="modal" class="bg-green text-white rounded-pill w-lg-50 w-100 p-2 text-center appointment_modal border-0 text-white">Book Appointment</button>
                  <button v-on:click="closeModal()" href="javascript:void(0)" class="light_btn_bg rounded-pill w-lg-50 w-100 p-2 text-center ml-lg-5 d-sm-inline ml-1" data-dismiss="modal">Cancel</button>
                </div>

              </div>
            </div>
        </div>
      </div>
    </div>
    <!-- End Booking Modal -->
  </div>
</template>

<script>
Vue.filter('frontDateChange', function(value) {
  if (value) {
    return moment(String(value)).format('D MMM')
  }
});

import VTooltip from 'v-tooltip';
import Toasted from 'vue-toasted';
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

Vue.filter('formatDay', function(value) {
  if (value) {
    return moment().day(value).format('dddd')
  }
});
export default {
  components: { VueSlickCarousel,VTooltip },
  name: "BookNowComponent",
  props: ['fileSystemDriver'],
  data() {
    return {
      basePath:'',
      c1Setting: {
        arrows: true,
        dots: false,
        asNavFor: this.$refs.c2,
        focusOnSelect: true,
        slidesToShow:3,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              initialSlide: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      },
      c2Setting: {
        arrows: false,
        dots: false,
        asNavFor: this.$refs.c1,
        focusOnSelect: true,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              initialSlide: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      },
      hospitalsData: this.$parent.doctor_hospitals,
      doctorData: this.$parent.doctor_data,
      selectedHospital: [],
      appointment_days: [],
      appointment_dates: [],
      slots: [],
      slotsCheck: false,
      morning_start:'12:01 Am',
      morning_end:'11:59 Am',
      afternoon_start:'12:00 Pm',
      afternoon_end:'5:00 Pm',
      evening_start:'5:01 Pm',
      evening_end:'8:00 Pm',
      night_start:'8:01 Pm',
      night_end:'11:59 Pm',
      choosedSlot: false,

      morningCheck: false,
      afternoonCheck: false,
      eveningCheck: false,
      nightCheck: false,
      loading: false,
      verified_message: 'Verified User',
      medical_message: 'Medical Registration Verified',
    }
  },
  created () {
    this.loading = true
    this.getDatesDay()
    this.$parent.selected_appointment_day = this.appointment_days[0]
    this.$parent.selected_appointment_date = this.appointment_dates[0]
  },
  mounted () {
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
    // console.log('seeeew',this.$parent.patientData);
    this.loading = false;
    this.chooseHospital(this.$parent.doctor_hospitals[0],  "hospital-button-0");
    if ( this.selectedHospital ) {
      this.getSlots();
    }
  },
  methods:{
    getSlots() {
      let self = this;
      self.slots = [];
      self.slotsCheck = false
      axios.post(APP_URL + '/doctor/get-appointment-slots', {
        doctor_id:self.doctorData.id,
        hospital_id:self.selectedHospital.id,
        dates:self.appointment_dates,
        days:self.appointment_days
      }).then(function (response) {
        if (response.data.type === 'success') {
          console.log('slots data',response);
          self.slots = response.data.slots;
          self.slotsCheck = true
          self.loading = false
        }
        else {
          self.loading = false
          Vue.toasted.error(response.data.message , { duration: 3000 })
        }
      }).catch(function (error) {
        self.loading = false
        Vue.toasted.error(error , { duration: 3000 })
      })
    },
    onBeforeChangeC1(currentPosition, nextPosition) {
      this.$refs.c1.goTo(nextPosition)

    },
    onBeforeChangeC2(currentPosition, nextPosition) {
      this.$refs.c2.goTo(nextPosition)
    },
    chooseHospital(hospital, id ) {
      this.loading = true
      this.selectedHospital = hospital
      if (hospital.id !== 'online') {
        this.$parent.selectedHospital = this.$parent.doctor_hospitals.find(x => x.id === hospital.id);
        // console.log("inside if conditon");
      }
      else {
        this.$parent.selectedHospital = 'online'
      }
      this.$parent.hospitalFees = hospital.fees
      id = '#'+id
      let ele = document.querySelectorAll('.select_hospital_red')
      ele.forEach(function (element) {
        element.style.color = 'black'
        element.style.background = '#6c757d4a'

      })
      if (document.querySelector(id) !== null) {
        document.querySelector(id).style.background = "#0E4D92";
        document.querySelector(id).style.color = "white";
      }
      this.getSlots()
    },
    getDatesDay() {
      let self = this;
      for(let i = 0; i < 14; i++) {
        let d = moment().add(i, 'days');
        self.appointment_days.push(d.format('dddd'));
        self.appointment_dates.push(d.format('YYYY-MM-DD'));
      }
      self.appointment_days = self.appointment_days.map(v => v.toLowerCase())
    },
    timeCheck() {
      let self = this
      self.morningCheck = true
      self.afternoonCheck = true
      self.eveningCheck = true
      self.nightCheck = true
      return true
    },
    morningCheckM(index, date, slots) {
      let self = this
      self.morningCheck = false
      slots.forEach(function (slot) {
        if ((Date.parse('20 Aug 2000 ' +  self.morning_start) <= Date.parse('20 Aug 2000 ' +  slot['start_time']))
            &&
            (Date.parse('20 Aug 2000 ' +  self.morning_end) >= Date.parse('20 Aug 2000 ' +  slot['start_time'])))
        {
          return self.morningCheck = true
        }
      })
      return self.morningCheck
    },
    afterNoonCheckM(index, date, slots) {
      let self = this
      self.afternoonCheck = false
      slots.forEach(function (slot) {
        if ((Date.parse('20 Aug 2000 ' +  self.afternoon_start) <= Date.parse('20 Aug 2000 ' +  slot['start_time']))
            &&
            (Date.parse('20 Aug 2000 ' +  self.afternoon_end) >= Date.parse('20 Aug 2000 ' +  slot['start_time'])))
        {
          return self.afternoonCheck = true
        }
      })
      return self.afternoonCheck
    },
    eveningCheckM(index, date, slots) {
      let self = this
      self.eveningCheck = false
      slots.forEach(function (slot) {
        if ((Date.parse('20 Aug 2000 ' +  self.evening_start) <= Date.parse('20 Aug 2000 ' +  slot['start_time']))
            &&
            (Date.parse('20 Aug 2000 ' +  self.evening_end) >= Date.parse('20 Aug 2000 ' +  slot['start_time'])))
        {
          return self.eveningCheck = true
        }
      })
      return self.eveningCheck
    },
    nightCheckM(index, date, slots) {
      let self = this
      self.nightCheck = false
      slots.forEach(function (slot) {
        if ((Date.parse('20 Aug 2000 ' +  self.night_start) <= Date.parse('20 Aug 2000 ' +  slot['start_time']))
            &&
            (Date.parse('20 Aug 2000 ' +  self.night_end) >= Date.parse('20 Aug 2000 ' +  slot['start_time'])))
        {
          return self.nightCheck = true
        }
      })
      return self.nightCheck
    },

    morningSlotCheckM(slot) {
      let self = this
      let morningCheck = false
        if ((Date.parse('20 Aug 2000 ' +  self.morning_start) <= Date.parse('20 Aug 2000 ' +  slot['start_time']))
            &&
            (Date.parse('20 Aug 2000 ' +  self.morning_end) >= Date.parse('20 Aug 2000 ' +  slot['start_time'])))
        {
          morningCheck = true
        }
      return morningCheck
    },
    afterNoonSlotCheckM(slot) {
      let self = this
      let afternoonCheck = false
        if ((Date.parse('20 Aug 2000 ' +  self.afternoon_start) <= Date.parse('20 Aug 2000 ' +  slot['start_time']))
            &&
            (Date.parse('20 Aug 2000 ' +  self.afternoon_end) >= Date.parse('20 Aug 2000 ' +  slot['start_time'])))
        {
          return afternoonCheck = true
        }
      return afternoonCheck
    },
    eveningSlotCheckM(slot) {
      let self = this
      let eveningCheck = false
        if ((Date.parse('20 Aug 2000 ' +  self.evening_start) <= Date.parse('20 Aug 2000 ' +  slot['start_time']))
            &&
            (Date.parse('20 Aug 2000 ' +  self.evening_end) >= Date.parse('20 Aug 2000 ' +  slot['start_time'])))
        {
          eveningCheck = true
        }
      return eveningCheck
    },
    nightSlotCheckM(slot) {
      let self = this
      let nightCheck = false
        if ((Date.parse('20 Aug 2000 ' +  self.night_start) <= Date.parse('20 Aug 2000 ' +  slot['start_time']))
            &&
            (Date.parse('20 Aug 2000 ' +  self.night_end) >= Date.parse('20 Aug 2000 ' +  slot['start_time'])))
        {
          nightCheck = true
        }
      return nightCheck
    },
    selectedSlot(time, date, day, id) {
      this.$parent.selected_appointment_day = []
      this.$parent.selected_appointment_date = []
      this.$parent.selected_time = ''

      let ele = document.querySelectorAll('.slot_radius')
      ele.forEach(function (element) {
        element.classList.remove('slot_radius_hover')
      })
      id = '#'+id;
      let element = document.querySelector(id)
      element.classList.add('slot_radius_hover')

      this.$parent.selected_appointment_day = day
      this.$parent.selected_appointment_date = date
      this.$parent.selected_time = time
      document.querySelector('#appointment-selected').removeAttribute("disabled")
    },
    closeModal() {
      this.$parent.onClose()
      this.hospitalsData = []
      this.doctorData = []
      this.selectedHospital = []
      this.appointment_days = []
      this.appointment_dates = []

      let element = document.querySelector('.modal-backdrop')
      if (element) {
        element.remove(element.classList);
      }
    }
  }
}
</script>

<style>
.dateDays{
  padding: 10px;
}
.slot_radius_hover {
  background-color:#088F8F;
  color: #ffffff;
  border: 1px solid #088F8F !important;
}
.slot_radius {
    border-radius: 5px;
    border: 1px solid #808080;
}
.slick-slide img{
  margin: 10px auto;
}
.slick-prev:before, .slick-next:before {
    font-family: FontAwesome;
    font-size: 20px;
    line-height: 1;
    opacity: .75;
    color: #484848;
    content: '\f053';
}
.slick-next:before {
    content: '\f054';
}
.slick-prev {
    left: 0px;
}
.slick-next {
    right: 0;
}
.slick-prev, .slick-next{
  top: 60%;
  z-index: 1;
}

</style>