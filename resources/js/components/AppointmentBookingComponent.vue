<template>
  <div>
    <div class="dc-reason-holder" style="margin:0px;">
        <div class="dc-searchvtwo">
            <figure class="dc-docpostimg booking_doctor_image">
                <img v-if="doctor_data.profile.avatar !== null" v-bind:src="'/uploads/users/'+doctor_data.profile.user_id+'/' + doctor_data.profile.avatar" alt="">
                <img v-else v-bind:src="'/uploads/users/default/small-default.jpg'" alt="">
                <figcaption v-if="videoConsul(doctor_data)">
                    <span class="dc-featuredtag"><i class="fa fa-video"></i></span>
                </figcaption>
            </figure>
            <div class="booking_doctor_detials">
                <a :href="'/speciality/'+doctor_data.specialities[0].slug" class="dc-docstatus" v-if="doctor_data.specialities.length > 0">{{doctor_data.specialities[0].title}}</a>
                <h3 class="doctor_name"><a :href="'/profile/'+doctor_data.slug">{{doctor_data.first_name+" "+doctor_data.last_name}}</a>
                    <i v-tooltip="'<em>Verified User</em>'" v-if="doctor_data.profile.verify_medical" class="far fa-check-circle dc-tipso"></i>
                    <i v-tooltip="'<em>Medical Registration Verified</em>'" v-if="doctor_data.profile.verify_registration" class="icon-sheild dc-tipso"></i>
                </h3>
                <ul class="dc-docinfo">
                    <!--<li><em>{{doctor_data.profile.sub_heading}}</em></li>-->
                    <li v-if="doctor_data.profile.total_experience !== null && doctor_data.roles[0].name === 'doctor'">
                        <span><b>{{ doctor_data.profile.total_experience }}</b> Experience</span>
                    </li>
                    <li>
                        <span class="dc-stars">
                            <span v-bind:style="{ width: doctor_data.feedbacks.length+'%'}"></span>
                        </span>
                    </li>
                </ul>
            </div>
            <div class= "given_hospital">

                <span class="radio-toolbar" v-if="doctor_hospitals.length > 0 && type === 'visit'">
                <span class="mr-2 video_btn_main" v-for="(hospital, index) in doctor_hospitals" v-if="hospital.id === 'online'">
                    <input type="radio" :id="'appointment-hospital-'+index" name="hospital" :value="hospital.id"
                           :key="index" v-on:change="getHospitalServices(user_id, 'appointment-hospital-'+index, index, hospital.fees)"
                           v-model="selected_hospital" :class="'appointment-hospital-'+index">
                    <label :for="'appointment-hospital-'+index" :id="'appointment-label-'+index" class="appointment-hospital modal_video_btn" style="width:100%;"> <div class="booking_hospital_info">
                        <div class="doctor_rel_hospital">
                            <div class="hospital_img">
                                <!--  <img v-bind:src="'/uploads/users/'+hospital.id+'/extra-small-' +hospital.avatar" alt="">-->
                                <i class="fa fa-video"></i>
                            </div>
                            <div class="hospital_details">
                                <h3>{{hospital.name}}</h3>
                                <span v-if="hospital.fees !== undefined"> <i class="ti-wallet"></i> </span>
                                <span v-if="hospital.fees !== undefined">Rs  {{hospital.fees}}</span>
                                <div class="available_time">
                                    <span> <i class="ti-clipboard"></i>
                                    </span>
                                    <span>Available Today</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </label>
              </span>
              <small class="text-danger" id="hospital_dropdown" style="display: block"></small>
            </span>

            </div>
        </div>
        <fieldset class="booking_hospital">
            <span class="hospital_name" v-if="type === 'visit'"><h3> Choose Hospital </h3></span>
            <span class="radio-toolbar" v-if="doctor_hospitals.length > 0">
                <span class="mr-2 hospital_selection" v-for="(hospital, index) in doctor_hospitals" v-if="hospital.id !== 'online'">
                    <input type="radio" :id="'appointment-hospital-'+index" name="hospital" :value="hospital.id"
                           :key="index" v-on:change="getHospitalServices(user_id, 'appointment-hospital-'+index, index)"
                           v-model="selected_hospital" :class="'appointment-hospital-'+index">
                    <label :for="'appointment-hospital-'+index" :id="'appointment-label-'+index" class="appointment-hospital" style="width:100%;"> <div class="booking_hospital_info">
                        <div class="doctor_rel_hospital">
                            <div class="hospital_img">
                                <img v-bind:src="'/uploads/users/'+hospital.id+'/extra-small-' +hospital.avatar" alt="">
                            </div>
                            <div class="hospital_details">
                                <h3>{{hospital.name}}</h3>
                                <span v-if="hospital.fees !== undefined"> <i class="ti-wallet"></i> </span>
                                <span v-if="hospital.fees !== undefined">Rs  {{hospital.fees}}</span>
                                <div class="available_time">
                                    <span> <i class="ti-clipboard"></i>
                                    </span>
                                    <span>Available Today</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </label>
              </span>
              <small class="text-danger" id="hospital_dropdown2" style="display: block"></small>
            </span>
            <span v-else>
                <em class="dc-dayon"> No Hospital available</em>
                <div class="dc-tabscontenttitle mb-3">
                     <h3>Add Hospital Details</h3>
                 </div>
                <div class="w-100 d-inline-block">
                <input type="text" name="hospital_fname" :value="added_hospital.first_name" placeholder="Hospital First Name">
                <input type="text" name="hospital_lname" :value="added_hospital.last_name" placeholder="Hospital Last Name">
                <input type="number" name="hospital_number" :value="added_hospital.number" placeholder="Hospital Number">
                <input type="integer" name="added_hospital_charges" :value="added_hospital.fee" placeholder="Add Fee">
                </div>
                <div id="add-appointment-datetime" class="appointment-date w-100 d-inline-block">
                    <label>Appointment Time</label>
                    <datetime 
                        format="YYYY-MM-DD H:i:s" 
                        v-model="appointment_DateTime"
                        placeholder="Add Appointment Date & Time"
                        @input="addedAppointmentDateTime()"
                    ></datetime>
                </div>
            </span>
        </fieldset>
    </div>
      <input type="hidden" name="hospital_type">

      <div v-if="show_slots">
          <div class="dc-appointment-holder slider_arrow book-slide-appointment">
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
                  <div v-for="(num, index) in appointment_dates" class="">
        <div class="d-inline-block m-auto calendar_day 
        text-center">
            <span>{{ appointment_days[index] | formatDay}}</span>
          <p class="font-weight-normal">
            {{ appointment_dates[index] | frontDateChange }}
          </p>
        </div>
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
                      <div v-if="slots[appointment_date] !== undefined ">
                          <div v-if="slots[appointment_date].length < 1" class="no_slot">
                              <img :src="'/images/empty-images/no-record.png'">
                              <div class="dc-tabscontenttitle">
                                    <h3>No Slot Add Appointment Time</h3>
                              </div>
                              <div id="add-appointment-datetime" class="appointment-date w-100 d-inline-block">
                                  <datetime 
                                        format="YYYY-MM-DD H:i:s" 
                                         v-model="appointment_DateTime"
                                         placeholder="Add Appointment Date & Time"
                                         @input="addedAppointmentDateTime()"
                                 ></datetime>
                              </div>
                              
                          </div>
                          <div v-else class="col-12">
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

                      </div>
                  </div>
              </VueSlickCarousel>
              <input type="hidden" id="type" name="type" :value="type">
              <input type="hidden" id="hospital_fees" name="hospital_fees" :value="hospital_fees">
          </div>
      </div>
  </div>
</template>

<script>
Vue.filter('frontDateChange', function(value) {
  if (value) {
    return moment(String(value)).format('D MMM')
  }
});
Vue.filter('formatDay', function(value) {
  if (value) {
    return moment().day(value).format('dddd')
  }
});
import Event from '../event.js'
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
import VTooltip from 'v-tooltip'
import datetime from 'vuejs-datetimepicker';
export default {
  props: ['user_id', 'doctor_data', 'hospitals', 'currency', 'type'],
  components: { VueSlickCarousel, VTooltip ,datetime},
  data: function () {
      return {
        doctor_hospitals: JSON.parse(this.hospitals),
        hospital_services:[],
        base_url:APP_URL,
        selected_hospital:'',
        added_hospital:{
            first_name:'',
            last_name:'',
            number:'',
            fee:'',
        },
        showServices : false,
        charges:[],
          title:'',
        selected_services:{
          price:'',
        },
        patient_type:'myself',
        total_charges:'',
        show_myself:false,
        show_slots:false,
        appointment_days : [],
        appointment_dates: [],
        selected_day:moment(),
        appointment_date:'',
        appointment_DateTime:'',
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
        hospital_fees: '',
      }
    },
  mounted: function() {
    var self = this;
    this.getDatesDay()
    if (this.type === 'online') {
      this.getHospitalServices(this.user_id, 'appointment-hospital-0', '0')
      $('.form-group-half .dc-select').css("display", "none")
      $( "input[name$='hospital_type']" ).val( "online" );
    }
    else {
      $( "input[name$='hospital_type']" ).val( "visit" );
      this.selected_hospital = $('#appointment-hospital-0').val()
      this.getHospitalServices(this.user_id, 'appointment-hospital-0', '0')
    }
    this.displayDaySlots();

  },
  methods: {
    showNext() {
      this.$refs.carousel.next()
    },
    showPrev() {
      this.$refs.carousel.previous()
    },
    videoConsul (doc) {
      let result = false
      doc.doc_teams.forEach(function (team) {
        if (team.user_id === 'online') {
          result = true
        }
      })
      return result;
    },
    onSelect(value) {
      var day = this.getDay(value);
      this.displaySlots(day);
    },
    onPanelChange(value, mode) {
      var day = this.getDay(value);
      this.displaySlots(day);
    },
/*    displaySlots(day) {
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

    },*/
    selectedPatient: function(type) {
      if (type == 'someone') {
        this.show_myself = true;
      } else {
        this.show_myself = false;
      }
    },
    tabs:function(){
      $(".tab").on("click",function () {
        $(".tab").removeClass("active");
        $(this).addClass("active");   
      });
    },
    getHospitalServices: function (doctor_id, className, i) {
      var self = this
      self.loading = true
      self.selected_hospital = $('#'+className).val()
      if(this.doctor_hospitals.length !==0)
      {
         this.hospital_fees = this.doctor_hospitals[i].fees
         this.displayDaySlots()

      }
      else
      {
        this.hospital_fees='';
      }

        document.getElementById('hospital_dropdown').style.display = "none";
        document.getElementById('hospital_dropdown2').style.display = "none";
        if(doctor_id) {
          this.show_slots = true
          axios.post(APP_URL + '/doctor/get-hospital-services', {hospital:self.selected_hospital, doctor:doctor_id})
          .then(function (response) {
            if (response.data.type == 'success') {
              self.hospital_services = response.data.services;
              if (self.hospital_services.price) {
                self.total_charges = self.hospital_services.price;
              } else {
                self.total_charges = 0;
              }
              Event.$emit('display-slots', { doctor: doctor_id, hospital:self.selected_hospital });
              self.showServices = true;
            } else if (response.data.type == 'error') {
              self.showServices = false;
            }
          })
          .catch(error => {

          });
        } else {
          this.showServices = false;
        }
      $('.appointment-hospital').css({'background-color': '#fff','color': '#3d4461','border':'1px solid #3fabf3', 'font-size':'12px', 'padding':'6px 12px'})
      $('#appointment-label-'+i).css({'background-color': '#3fabf3','color': '#ffffff','border':'1px solid #3fabf3', 'font-size':'12px', 'padding':'6px 12px'})

      },
      toggleCollapse: function(element_id) {
        jQuery('.active.dc-paneltitle').siblings().hide('slow');
        jQuery('.active.dc-paneltitle').removeClass('active');
        jQuery('#'+element_id).addClass('active');
        jQuery('#'+element_id).siblings().show('slow');
			
      },
      displayServicePrice: function (price, title, element_id) {
        if (document.getElementById(element_id).checked == true) {
          this.total_charges = parseInt(this.total_charges) + parseInt(price);
          this.charges.push(Vue.util.extend(
            {}, this.selected_services, this.selected_services.title = title, this.selected_services.price = price)
          )
        } else {
            this.total_charges = parseInt(this.total_charges) - parseInt(price);
            this.charges = this.charges.filter(function( obj ) {
              return obj.title !== title;
            });
        }
      },
    getDatesDay: function () {
      var self = this;
      for(var i = 0; i < 14; i++) {
        var d = moment().add(i, 'days');
        self.appointment_days.push(d.format('dddd'));
        self.appointment_dates.push(d.format('YYYY-MM-DD'));
      }
      self.appointment_days = self.appointment_days.map(v => v.toLowerCase())
      // console.log(self.appointment_days)
      // console.log(self.appointment_dates)
    },
    getDates: function (index) {
      var self = this;
      index = index - 1;
      var d = moment().add(index, 'days');
      return '<span class="day">'+d.format('dddd')+'</span><span class="date">'+d.format('MMMM Do')+'</span>'
    },
    displayDaySlots() {
      var self = this;
      self.slots = [];
      axios.post(APP_URL + '/doctor/get-appointment-slots', {doctor_id:self.user_id, hospital_id:self.selected_hospital, dates:self.appointment_dates, days:self.appointment_days})
        .then(function (response) {
          if (response.data.type === 'success') {
            self.slots = response.data.slots;
            // console.log(self.slots)
            self.slotsCheck = true;
            self.loading = false;
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
    addedAppointmentDateTime()
    {
       this.$parent.appointmentDateTime=this.appointment_DateTime;
    }
  },
  created () {

  }

}
</script>
<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity .3s ease;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
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
.radio-toolbar input[type="radio"] {
    display: none;
}
.radio-toolbar label {
    display: inline-block;
    background-color: #fff;
    border: #00aaff;
    padding: 10px 20px;
    cursor: pointer;
    border: groove;
    border-radius: 30px;
}
.no_slot img{
    margin: 10px auto;
}
.modal_video_btn .fa-video{
    font-size: 28px;
    padding: 14px 0 0 5px;
}
.video_btn_main{
    width: 60%;
    display: inline-block;
}
.hospital_details{
  float:left;
}
/*.radio-toolbar input[type="radio"]:checked+label {
    background-color: #5b9bc9;
    border: #00aaff;
    color:#fff
}*/
/*.radio-toolbar input[type="radio"]+label:hover {
    transition: transform .2s;
    border: #000000;
    transform: scale(1.2);
}*/

.book-appointment-date .calendar_day {
    border: 1px solid #ea4335;
    color: #ea4335;
    border-radius: 50px;
     cursor: pointer; 
     width:95%;
}
.book-appointment-date .slick-active .calendar_day:hover, 
.book-appointment-date .slick-current .calendar_day {
    background-color: #ea4335;
    color: #fff;
}


</style>