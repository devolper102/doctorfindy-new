<template>
  <div>
    <div class="box-shadow dateDays calendar">
    <VueSlickCarousel
        v-if="slotsCheck"
        ref="c1" v-bind="c1Setting" @beforeChange="onBeforeChangeC2"
    >
      <div v-for="(num, index) in 13" class="">
        <div class="w-70 d-block m-auto calendar_day text-center">
          <p class="text_12 mb-0">
          {{ appointment_days[index] | formatDay}}</p>
          <p class="font-weight-normal text_12">
            {{ appointment_dates[index] | frontDateChange }}
          </p>
        </div>
      </div>
    </VueSlickCarousel>
    </div>
    <div class="box-shadow bg-white custom_bottom_rounded appointment_slider">
    <VueSlickCarousel v-if="slotsCheck" ref="c2" v-bind="c2Setting" 
    @beforeChange="onBeforeChangeC1">
      <div v-for="(num, index) in 13">
        <div class="slots_shedule">
          <div>
            <div class="row" v-if="morningCheckM(index, appointment_dates[index], slots[appointment_dates[index]])">
              <div class="col-12 col-sm-3 col-md-2 col-lg-3 col-xl-3"
              v-if="morningCheck">
                <span class="text_14 text_md_12 mt-3 d-inline-block">
                  <img :src="basePath+'/images/morning.png'" alt="Morning Image" class="img-fluid float-left mr-2 mt-1"> Morning 
                </span>
              </div>
              <div class="col-12 col-sm-9 col-md-10 col-lg-9 col-xl-9" v-if="morningCheck">
                <ul class="morning text_black d-inline-block text_14 m-0 float-left booking_timmings">
                  <li :id="'slot-m-' + index + '-' + i" v-if="morningSlotCheckM(slot)" v-for="(slot, i) in slots[appointment_dates[index]]" v-bind:style= "[slot.space < 1 ? {'background-color': '#dadada', 'color':'#afafaf','border':'1px solid #dadada'} : choosedSlot ?  {'background-color': '#515151', 'color':'#ffffff'} : '']" class="float-left pl-2 pr-2 ml-2 mt-xl-3 mt-2 slot_radius text_md_12">
                    <span @click="!slot.space < 1 && selectedSlot( slot.start_time, appointment_dates[index], appointment_days[index], 'slot-n-' + index + '-' + i, hospital)">
                      {{ slot.start_time }}
                    </span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="row" v-if="afterNoonCheckM(index, appointment_dates[index], slots[appointment_dates[index]])">
              <div class="col-12 col-sm-3 col-md-2 col-lg-3 col-xl-3"
              v-if="afternoonCheck">
                <span class="text_14 text_md_12 mt-3 d-inline-block">
                  <img :src="basePath+'/images/afternoon.png'" alt="Afternoon Image" class="img-fluid float-left mr-2 mt-1"> Afternoon
                </span>
              </div>
              <div class="col-12 col-sm-9 col-md-10 col-lg-9 
              col-xl-9" v-if="afternoonCheck">
                <ul class="morning text_black d-inline-block text_14 m-0 float-left booking_timmings">
                  <li :id="'slot-a-' + index + '-' + i" v-if="afterNoonSlotCheckM(slot)" v-for="(slot, i) in slots[appointment_dates[index]]" v-bind:style= "[slot.space < 1 ? {'background-color': '#dadada', 'color':'#afafaf','border':'1px solid #dadada'} : choosedSlot ?  {'background-color': '#515151', 'color':'#ffffff'} : '']" class="float-left pl-2 pr-2 ml-2 mt-xl-3 mt-2 slot_radius text_md_12">
                    <span @click="!slot.space < 1 && selectedSlot( slot.start_time, appointment_dates[index], appointment_days[index], 'slot-n-' + index + '-' + i, hospital)">
                      {{ slot.start_time }}
                    </span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="row" v-if="eveningCheckM(index, appointment_dates[index], slots[appointment_dates[index]])">
              <div class="col-12 col-sm-3 col-md-2 col-lg-3 col-xl-3" v-if="eveningCheck">
                <span class="text_14 text_md_12 mt-3 d-inline-block">
                  <img :src="basePath+'/images/evening.png'" alt="Evening Image" class="img-fluid float-left mr-2 mt-1"> Evening
                </span>
              </div>
              <div class="col-12 col-sm-9 col-md-10 col-lg-9 
              col-xl-9" v-if="eveningCheck">
                <ul class="morning text_black d-inline-block text_14 m-0 float-left booking_timmings">
                  <li :id="'slot-e-' + index + '-' + i" v-if="eveningSlotCheckM(slot)" v-for="(slot, i) in slots[appointment_dates[index]]" v-bind:style= "[slot.space < 1 ? {'background-color': '#dadada', 'color':'#afafaf','border':'1px solid #dadada'} : choosedSlot ?  {'background-color': '#515151', 'color':'#ffffff'} : '']" class="float-left pl-2 pr-2 ml-2 mt-xl-3 mt-2 slot_radius text_md_12">
                    <span @click="!slot.space < 1 && selectedSlot( slot.start_time, appointment_dates[index], appointment_days[index], 'slot-n-' + index + '-' + i, hospital)">
                      {{ slot.start_time }}
                    </span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="row" v-if="nightCheckM(index, appointment_dates[index], slots[appointment_dates[index]])">
              <div class="col-12 col-sm-3 col-md-2 col-lg-3 col-xl-3" v-if="nightCheck">
                <span class="text_14 text_md_12 mt-3 d-inline-block"><img :src="basePath+'/images/night.png'" alt="Night Image" class="img-fluid float-left mr-2 mt-1"> Night</span>
              </div>
              <div class="col-12 col-sm-9 col-md-10 col-lg-9 
              col-xl-9" v-if="nightCheck">
                <ul class="morning text_black d-inline-block text_14 m-0 float-left booking_timmings">
                  <li :id="'slot-n-' + index + '-' + i" v-if="nightSlotCheckM(slot)" v-for="(slot, i) in slots[appointment_dates[index]]" v-bind:style= "[slot.space < 1 ? {'background-color': '#dadada', 'color':'#afafaf','border':'1px solid #dadada'} : choosedSlot ?  {'background-color': '#515151', 'color':'#ffffff'} : '']" class="float-left pl-2 pr-2 ml-2 mt-xl-3 mt-2 slot_radius text_md_12">
                    <span @click="!slot.space < 1 && selectedSlot( slot.start_time, appointment_dates[index], appointment_days[index], 'slot-n-' + index + '-' + i, hospital)">
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
              <span class="text_black d-inline-block w-100 text-center">
                No Data Available
              </span>
            </div>
          </div>
        </div>
      </div>
    </VueSlickCarousel>

  </div>
</div>
</template>
<script>
Vue.filter('frontDateChange', function(value) {
  if (value) {
    return moment(String(value)).format('D MMM')
  }
});
import VueSlickCarousel from 'vue-slick-carousel'
import Toasted from 'vue-toasted';
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

Vue.use(Toasted)

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment((value)).format('d/m/Y')
  }
});
Vue.filter('formatDay', function(value) {
  if (value) {
    return moment().day(value).format('ddd')
  }
});
export default {
  components: { VueSlickCarousel },
  name: "BookNowSlotsComponent",
  props: ['user', 'hospital', 'team', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      c1Setting: {
        arrows: true,
        dots: false,
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
              slidesToShow: 2,
              slidesToScroll: 1
            }
          }
        ]
      },
      c2Setting: {
        arrows: false,
        dots: false,
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
      appointment_days: [],
      appointment_dates: [],
      slots: [],
      online_slots:[],
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

      selected_appointment_day: [],
      selected_appointment_date: [],
      selected_time: '',
      selected_slot: false,

      doctor_data: '',
      selectedHospital: '',
      selected_date: '',
    }
  },
  mounted(){
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  async created () {
    this.getDatesDay()
   await this.getSlots()
    this.selected_appointment_day = this.appointment_days[0]
    this.selected_appointment_date = this.appointment_dates[0]
  },
  methods: {
    getSlots() {
      let self = this;
      self.slots = [];
      self.slotsCheck = false
      axios.post('/doctor/get-appointment-slots', {
        doctor_id:self.user.id,
        hospital:self.hospital,
        dates:self.appointment_dates,
        days:self.appointment_days
      }).then(function (response) {
        if ( response.data.type === 'success' ) {
          self.slotsCheck = true
          self.slots = response.data.slots

        }
        else {
          Vue.toasted.error(response.data.message , { duration: 3000 })
        }
      }).catch(function (error) {
        Vue.toasted.error(error , { duration: 3000 })
      })
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
    timeCheck() {
      let self = this
      self.morningCheck = true
      self.afternoonCheck = true
      self.eveningCheck = true
      self.nightCheck = true
      return true
    },
    onBeforeChangeC1(currentPosition, nextPosition) {
      this.$refs.c1.goTo(nextPosition)
    },
    onBeforeChangeC2(currentPosition, nextPosition) {
      this.$refs.c2.goTo(nextPosition)
    },
    morningCheckM(index, date, slots) {
      let self = this
      self.morningCheck = false
      slots.forEach(function (slot) {
        if ((Date.parse('19 Aug 2000 ' +  self.morning_start) <= Date.parse('20 Aug 2000 ' +  slot['start_time']))
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
        if ((Date.parse('19 Aug 2000 ' +  self.afternoon_start) <= Date.parse('20 Aug 2000 ' +  slot['start_time']))
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
        if ((Date.parse('19 Aug 2000 ' +  self.evening_start) <= Date.parse('20 Aug 2000 ' +  slot['start_time']))
            &&
            (Date.parse('20 Aug 2000 ' +  self.evening_end) >= Date.parse('20 Aug 2000 ' +  slot['start_time'])))
        {
          self.eveningCheck = true
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
          self.nightCheck = true
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
        afternoonCheck = true
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

    selectedSlot(time, date, day, id, hospital) {
      let self = this
      this.$parent.slotSelected = true
      this.$parent.selected_time = time
      this.$parent.selected_date = date
      this.$parent.selected_appointment_date = date
      this.$parent.selected_day = day
      this.$parent.selected_slot = true
      this.$parent.selectedHospital = hospital
      this.$parent.hospital = hospital
      let hospitalTeam;
      if(hospital !== 'online'){
       hospitalTeam = this.$parent.user.doc_teams.find(x => x.user_id === JSON.stringify(this.hospital.id))
      }
      else{

      hospitalTeam = this.$parent.user.onlines.find(x => x.doctor_id === self.user.id)

      }
        this.$parent.hospitalFees = JSON.parse(hospitalTeam.slots)['consultation_fee']
        this.$parent.bookNowType = 'visit'
      
      this.$parent.showMobileModal()
    },


  }
}
</script>

<style>
.slot_radius_hover {
  background-color: #515151;
  color: #ffffff;
}
.slick-slide img{
  margin: 10px auto;
}
.dateDays{
  background-color: #EAEAEA !important;
  padding: 10px;
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
.dateDays .slick-slide, .appointment_slider .slick-slide{
  height:inherit !important;
}
</style>