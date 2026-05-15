<template>
  <div class="dc-appointment-holder slider_arrow">
    <div class="dc-title">
        <h4 v-if="type === 'online'">{{ trans('lang.select_best_time_cons') }}</h4>
        <h4 v-else>{{ trans('lang.select_best_time') }}</h4>

    </div>

    <VueSlickCarousel
            ref="mother"
            :slidesToShow="3"
            :focusOnSelect="false"
            :swipe="false"
            :responsive="[

              {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        }
      },

            ]"
            :arrows="false"
            :asNavFor="$refs.child"
            v-if="appointment_days.length > 0 && appointment_dates.length > 0"
    >
      <div class="parent-slider" v-for="index in 14"><span style="font-size: 8px" v-html="getDates(index)"></span>
        <!--<input type="hidden" :value="appointment_days[index]" name="appointment[day]">
        <input type="hidden" :value="appointment_dates[index]" name="appointment[date]">-->
      </div>
    </VueSlickCarousel>
      <input type="hidden" name="appointment[day]">
      <input type="hidden" name="appointment[date]">
    <VueSlickCarousel
            ref="child"
            :focusOnSelect="false"
            :swipe="false"
            :asNavFor="$refs.mother"
            v-if="appointment_days.length > 0 && appointment_dates.length > 0 && slotsCheck"
    >
      <div v-for="(appointment_date, key) in appointment_dates">
          <div>


              <div v-if="slots[appointment_date].length > 0" class="col-12">
                  <div class="row">
                      <div class="col-md-2 col-sm-12 col-xs-12 mobile_text_left">
                          <span class="time_icon"><i class="fa fa-sun-o" aria-hidden="true"></i></span> Morning
                      </div>
                      <div class="col-md-10 col-xs-12 col-sm-12 less_padding">
                      <div class="dc-timeslots">
                          <span class="dc-radio next-step" v-for="(slot, index) in slots[appointment_date]" :key="index" v-if="
                            (Date.parse('20 Aug 2000 ' +  morning_start)
                            <=
                            Date.parse('20 Aug 2000 ' +  slot['start_time']))
                            &&
                            (Date.parse('20 Aug 2000 ' +  morning_end)
                            >=
                            Date.parse('20 Aug 2000 ' +  slot['start_time']))
                            ">
                            <input v-if="slot['space'] > 0" type="radio" v-bind:id="'availableslot-'+key+'-'+index" name="appointment[time]" :value="slot['start_time']">
                            <input v-else type="radio" v-bind:id="'availableslot-'+key+'-'+index" name="appointment[time]" :value="slot['start_time']" disabled>
                            <label @click="selectedSlot(appointment_date, appointment_days[key])" :for="'availableslot-'+key+'-'+index"><span> {{slot['start_time']}}</span><em>Spaces: {{slot['space']}}</em></label>
                        </span>
                      </div>
                  </div>
              </div>
                  <div class="row">
                  <div class="col-md-2 col-sm-12 col-xs-12 mobile_text_left">
                      <span class="time_icon"><i class="fa fa-sun-o" aria-hidden="true"></i></span> Afternoon
                  </div>
                  <div class="col-md-10 col-xs-12 col-sm-12 less_padding">
                      <div class="dc-timeslots">
                        <span class="dc-radio next-step" v-for="(slot, index) in slots[appointment_date]" :key="index" v-if="
                            (Date.parse('20 Aug 2000 ' +  afternoon_start)
                            <=
                            Date.parse('20 Aug 2000 ' +  slot['start_time']))
                            &&
                            (Date.parse('20 Aug 2000 ' +  afternoon_end)
                            >=
                            Date.parse('20 Aug 2000 ' +  slot['start_time']))
                            ">
                            <input v-if="slot['space'] > 0" type="radio" v-bind:id="'availableslot-'+key+'-'+index" name="appointment[time]" :value="slot['start_time']" >
                            <input v-else type="radio" v-bind:id="'availableslot-'+key+'-'+index" name="appointment[time]" :value="slot['start_time']" disabled >
                            <label @click="selectedSlot(appointment_date, appointment_days[key])" :for="'availableslot-'+key+'-'+index"><span> {{slot['start_time']}}</span><em>Spaces: {{slot['space']}}</em></label>
                        </span>
                      </div>
                  </div>
              </div>
                  <div class="row">
                  <div class="col-md-2 col-sm-12 col-xs-12 mobile_text_left">
                      <span class="time_icon"><i class="fa fa-sun-o" aria-hidden="true"></i></span> Evening
                  </div>
                  <div class="col-md-10 col-xs-12 col-sm-12 less_padding">
                      <div class="dc-timeslots">
                        <span class="dc-radio next-step" v-for="(slot, index) in slots[appointment_date]" :key="index" v-if="
                            (Date.parse('20 Aug 2000 ' +  evening_start)
                            <=
                            Date.parse('20 Aug 2000 ' +  slot['start_time']))
                            &&
                            (Date.parse('20 Aug 2000 ' +  evening_end)
                            >=
                            Date.parse('20 Aug 2000 ' +  slot['start_time']))
                            ">
                                <input v-if="slot['space'] > 0" type="radio" v-bind:id="'availableslot-'+key+'-'+index" name="appointment[time]" :value="slot['start_time']" >
                            <input v-else type="radio" v-bind:id="'availableslot-'+key+'-'+index" name="appointment[time]" :value="slot['start_time']" disabled >
                            <label @click="selectedSlot(appointment_date, appointment_days[key])" :for="'availableslot-'+key+'-'+index"><span> {{slot['start_time']}}</span><em>Spaces: {{slot['space']}}</em></label>
                        </span>
                      </div>
                  </div>
              </div>
                  <div class="row">
                  <div class="col-md-2 col-sm-12 col-xs-12 mobile_text_left">
                    <span class="time_icon"> <i class="fa fa-moon-o" aria-hidden="true"></i> </span>  Night
                  </div>
                  <div class="col-md-10 col-xs-12 col-sm-12 less_padding">
                      <div class="dc-timeslots">
                        <span class="dc-radio next-step" v-for="(slot, index) in slots[appointment_date]" :key="index" v-if="
                            (Date.parse('19 Aug 2000 ' +  night_start)
                            <=
                            Date.parse('20 Aug 2000 ' +  slot['start_time']))
                            &&
                            (Date.parse('20 Aug 2000 ' +  night_end)
                            >=
                            Date.parse('20 Aug 2000 ' +  slot['start_time']))
                            ">
                                <input v-if="slot['space'] > 0" type="radio" v-bind:id="'availableslot-'+key+'-'+index" name="appointment[time]" :value="slot['start_time']" >
                            <input v-else type="radio" v-bind:id="'availableslot-'+key+'-'+index" name="appointment[time]" :value="slot['start_time']" disabled >
                            <label @click="selectedSlot(appointment_date, appointment_days[key])" :for="'availableslot-'+key+'-'+index"><span> {{slot['start_time']}}</span><em>Spaces: {{slot['space']}}</em></label>
                        </span>
                      </div>
                  </div>
              </div>
          </div>
              <div v-else ><span>No Slot Available</span></div>
        </div>
      </div>
    </VueSlickCarousel>
      <input type="hidden" id="type" name="type" :value="type">
  </div>
</template>

<script>
  import VueSlickCarousel from 'vue-slick-carousel'
  import 'vue-slick-carousel/dist/vue-slick-carousel.css'
  import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

import Event from '../event.js'
// import 'ant-design-vue/dist/antd.css'
export default {
    components: { VueSlickCarousel },
  props: ['doctor_id', 'hospital_id','type'],
  data: function () {
      return {
        appointment_days : [],
        appointment_dates: [],
        selected_day:moment(),
        appointment_date:'',
        day:'',
        slots:[],

        morning_start:'6:00 Am',
        morning_end:'11:59 Am',
        afternoon_start:'12:00 Pm',
        afternoon_end:'5:00 Pm',
        evening_start:'5:01 Pm',
        evening_end:'8:00 Pm',
        night_start:'8:01 Pm',
        night_end:'5:59 Am',
        slotsCheck: false,
      }
    },
  methods: {
    showNext() {
      this.$refs.carousel.next()
    },
    showPrev() {
      this.$refs.carousel.previous()
    },
    onSelect(value) {
      var day = this.getDay(value);
      this.displaySlots(day);
    },
    onPanelChange(value, mode) {
      var day = this.getDay(value);
      this.displaySlots(day);
    },
    displaySlots(day) {
      this.appointment_date = this.selected_day.year() +'-'+this.selected_day.format('M')+'-'+this.selected_day.date();
      this.day = day;
      var self = this;
      axios.post(APP_URL + '/doctor/get-appointment-slots', {doctor_id:self.doctor_id, hospital_id:self.hospital_id, day:day, date:this.appointment_date})
      .then(function (response) {
        if (response.data.type === 'success') {
            self.slots = response.data.slots;
        } else {

        }
      })
      .catch(function (error) {

      })

    },
    getDay: function(value) {
      var weekday = new Array(7);
      weekday[0] = "sun";
      weekday[1] = "mon";
      weekday[2] = "tue";
      weekday[3] = "wed";
      weekday[4] = "thu";
      weekday[5] = "fri";
      weekday[6] = "Sat";
      var n = weekday[value.day()];
      return n;
    },
    getDates: function (index) {
      var self = this;
      index = index - 1;
      var d = moment().add(index, 'days');
      return '<span class="day">'+d.format('dddd')+'</span><span class="date">'+d.format('MMMM Do')+'</span>'
      return d.format('ddd,MMMM Do')
    },
    getDatesDay: function () {
      var self = this;
      for(var i = 0; i < 14; i++) {
        var d = moment().add(i, 'days');
        self.appointment_days.push(d.format('ddd'));
        self.appointment_dates.push(d.format('YYYY-MM-DD'));
      }
      self.appointment_days = self.appointment_days.map(v => v.toLowerCase())
      // console.log(self.appointment_days)
      // console.log(self.appointment_dates)
    },
    displayDaySlots() {
      var self = this;
      self.slots = [];
      axios.post(APP_URL + '/doctor/get-appointment-slots', {doctor_id:self.doctor_id, hospital_id:self.hospital_id, dates:self.appointment_dates, days:self.appointment_days})
              .then(function (response) {
                if (response.data.type === 'success') {
                  self.slots = response.data.slots;
                  self.slotsCheck = true;
                } else {

                }
              })
              .catch(function (error) {

              })
    },
    selectedSlot(date, day) {
      document.getElementsByName('appointment[date]').value = date
      document.getElementsByName('appointment[day]').value = day
    },
  },
  mounted: function() {
    /*var selected_day  = this.getDay(this.selected_day);
    Event.$on('display-slots', (data) => {
      this.doctor_id = data.doctor;
      this.hospital_id = data.hospital;
      this.displaySlots(selected_day);
    })*/
    /*this.displaySlots(xselected_day);*/
    this.getDatesDay()
    this.displayDaySlots();
  }
}
</script>
<style scoped>
  .slick-slide {
    text-align: center;
    padding:0px !important;
  }
  .dc-timeslots .dc-radio {
      padding: 5px;
      width: auto !important;
  }
  .dc-timeslots {
      max-width: 522px;
      text-align: center;
      margin-bottom: 20px;
      min-height:48px !important;
  }
  .slick-arrow {
      background: transparent;
  }
  .slider_arrow .slick-prev:before, .slider_arrow .slick-next:before{
      color: #3fabf3 !important;
  }
  .slick-prev {
      left: -5px;
  }
  .slick-next {
      right: 5px;
  }

  /*.slick-list{
    padding:0 5px 25px 5px !important;
  }*/
  .slick-current .parent-slider {
    width: 75% !important;
    padding: 2px 0;
    background-color: #3fabf3;
    color: #ffffff;
      border-radius: 50px;
  }
  .day{
    text-transform: uppercase;
    display: block;
      font-size: 14px;
  }
  .date {
      font-size: 14px;
  }
  .slick-prev, .slick-next{
    top: -28px;
  }
  .time_icon {
    color:#ffd000;
  }
  .col-md-2{
    padding: 0px !important;
    text-align: left;
  }
</style>