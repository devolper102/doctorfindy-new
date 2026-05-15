<template>
  <div>
    <!-- Topbar -->
    <header-section 
    :managements="managements"  
    :doctor="doctor">
    </header-section>
    <!-- End of Topbar -->
    <div class="dashboard_inner d-flex">
      <!-- Sidebar -->
      <sidebar-section></sidebar-section>
      <!-- End of Sidebar -->
      <div id="content-wrapper" class="d-flex flex-column mb-5 w-100 mt-4">
        <!-- Main Content -->
        <div id="content">
          <!-- Begin Page Content -->
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-9 col-sm-12 col-md-12">
                <doctor-tab :doctor="doctor"></doctor-tab>
                <doctor-summary :doctor="doctor" :appointments="appointments"></doctor-summary>
                <appointment-section v-if="appointments.length > 0" :appointments="appointments"></appointment-section>
                <h6 v-if="appointments.length === 0" style="color:black;font-weight:bold;margin-top:10px;"align="center">No Appointments</h6>
                <invoice-section :doctor="doctor"></invoice-section>
                <saved-section :doctor="doctor" :doctors="Alldoctors" :hospitals="Allhospitals"></saved-section>

              </div>
              <div class="col-lg-3 col-sm-12 col-md-12 mt-4 mt-xl-0 pl-lg-0">

                <v-date-picker
                    :popover="{visibility: visibility}"
                    @dayclick="dayClick"
                    :mode="mode"
                    v-model="selectedDate"
                ></v-date-picker>
                 <p style="color:green;font-weight:bold;margin-top:4px;">Please select date to show your appointments</p>
                <div class="box_radius box_shadow p-2 mt-3 mb-lg-0 mb-5">
                      <div class="saved_items mb-2">
                        <p class="p-1 font-weight-bold text_12" style="background-color: #ebecef;">{{doctor.appointments.length}} Appointments</span></p>
                      </div>
                      <div class="user_name_img d-inline-block w-100 mt-2 border-bottom-dark pb-2" v-for="(appointment, index) in doctor.appointments" v-if="index <= 7 ">
                        <a href="#" class="float-left mr-2">
                           <img  v-if="appointment.patient.profile.avatar"  v-lazy="'/uploads/users/'+appointment.patient_id+'/'+appointment.patient.profile.avatar" class="img-fluid w-30px h_30 rounded-circle" :alt="appointment.patient.first_name +' '+ appointment.patient.last_name">
                        <img v-else  v-lazy="'/uploads/users/default/patient.svg'" class="img-fluid w-30px h_30 rounded-circle" alt="user Image">
                        </a>
                        <div class="float-left doctor_detail text_12">
                          <span class="">{{appointment.appointment_time}} <span>({{appointment.type}})</span></span>
                          <p class="font-weight-bold">{{appointment.patient.first_name}} {{appointment.patient.last_name}}</p>
                          <p>{{appointment.appointment_date | formatDate}}</p>
                        </div>
                      </div>
                      <div class="text-center w-100">
                        <a href="/doctor/all-appointments" class=" font-weight-bold theme-color-text"> View All</a>
                      </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Footer -->
        <footer-section></footer-section>
        <!-- End of Footer -->
      </div>
    </div>
  </div>
</template>

<script>
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MMM DD,YYYY')
  }
});
import VCalendar from 'v-calendar';
import Calendar from 'v-calendar/lib/components/calendar.umd'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'

// Register components in your 'main.js'
Vue.component('calendar', Calendar)
Vue.component('date-picker', DatePicker)


export default {
  name: "DashboardContentSectionComponent",
  props: ['doctor', 'doctors', 'hospitals','managements'],
  data() {
    return {
      mode: "date",
      selectedDate: new Date(),
      appointments: [],
      date: new Date(),
     visibility: true,
    Alldoctors: this.doctors,
    Allhospitals: this.hospitals,
    }
  },
 async created () {
    const doc = await axios.get('/dashboard-all-doctors')
    this.Alldoctors = Object.freeze(doc.data) 

    const hosp = await axios.get('/dashboard-all-hospitals')
    this.Allhospitals = Object.freeze(hosp.data)

    let self = this
    self.filterAppointments()
  },
  methods: {
    filterAppointments() {
      let self = this
      self.appointments = []
      let date = moment(self.selectedDate).format('YYYY-MM-DD')
      this.doctor.appointments.forEach(function (x) {
        if(x.appointment_date === date) {
          self.appointments.push(x)
        }
      })
    },
    dayClick () {
      this.filterAppointments()
      console.log(123123, this.selectedDate)
    }
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
</style>