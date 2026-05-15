<template>
  <div>
    <!-- Topbar -->
    <header-patient-section
      :managements="managements"
      :patient="patient"
    ></header-patient-section>
    <!-- End of Topbar -->
    <div class=" d-flex">
      <!-- Sidebar -->
      <sidebar-patient-section></sidebar-patient-section>
      <!-- End of Sidebar -->
      <div id="content-wrapper" class="d-flex flex-column mb-5 w-100 mt-4">
        <!-- Main Content -->
        <div id="content">
          <!-- Begin Page Content -->
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-9 col-sm-12 col-md-12">
                <patient-tab :patient="patient" :appointments_patient="appointments_patient"></patient-tab>
                   <patient-appointment-section v-if="appointments_patient.length > 0" :appointments_patient="appointments_patient"></patient-appointment-section>
                    <h6 v-if="appointments_patient.length === 0" style="color:black;font-weight:bold;"align="center">No Appointments</h6>
                <patient-invoices :patient="patient"></patient-invoices>
                <patient-saved :patient="patient" :doctors="Alldoctors" :hospitals="Allhospitals"></patient-saved>
              </div>
              <div class="col-lg-3 col-sm-12 col-md-12 mt-4 mt-xl-0 pl-lg-0">
                <v-date-picker
                    :popover="{visibility: visibility}"
                    @dayclick="dayClick"
                    :mode="mode"
                    v-model="selectedDate"
                    class="patientCalender w-100 mb-3"
                ></v-date-picker>
                <p style="color:black; padding-left:7px;font-weight:bold;">Please select date to show your appointments</p>
                   <div class="box_radius box_shadow p-2 mt-3 mb-5">
                      <div class="saved_items mb-2">
                        <p class="p-1 font-weight-bold text_12" style="background-color: #ebecef;">{{patient.appointments_patient.length}} Appointments</span></p>
                      </div>
                      <div class="user_name_img d-inline-block w-100 mt-2 border-bottom-dark pb-2" v-for="(appointment, index) in patient.appointments_patient" v-if="index <= 7 ">
                        <a :href="'/profile/'+appointment.user.slug" class="float-left mr-2">
                           <img  v-if="appointment.user.profile.avatar" v-lazy="'/uploads/users/'+appointment.user_id+'/'+appointment.user.profile.avatar" class="img-fluid w-30px h_30 rounded-circle" :alt="appointment.user.first_name +' '+ appointment.user.last_name">
                        <img v-else v-lazy="'/uploads/users/default/doctor.svg'" class="img-fluid w-30px h_30 rounded-circle" alt="user Image">
                        </a>
                        <div class="float-left doctor_detail text_12">
                          <span class="">{{appointment.appointment_time}} <span>({{appointment.type}})</span></span>
                          <p class="font-weight-bold">{{appointment.user.first_name}} {{appointment.user.last_name}}</p>
                          <p>{{appointment.appointment_date | formatDate}}</p>
                        </div>
                      </div>
                      <div class="view_btn text-center w-100">
                        <a href="/patient/all-appointments"class="text_black font-weight-bold">View All</a>
                      </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Footer -->
        <footer class="dashboard-sticky-footer bg-white box_shadow p-2 d-inline-block p-2 border-top w-xs-100 w-md-100">
          <div class="container my-auto">
            <div class="copyright text-center w-lg-80">
              <span>Copyright &copy; Your Website 2020</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
    </div>
  </div>
</template>
<script>
import VCalendar from 'v-calendar';
import Calendar from 'v-calendar/lib/components/calendar.umd'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'

// Register components in your 'main.js'
Vue.component('calendar', Calendar)
Vue.component('date-picker', DatePicker)


export default
{
  name: "DashboardContentSectionComponent",
  props: ['patient', 'doctors', 'hospitals','managements'],
  data() {
    return {
      mode: "date",
      selectedDate: new Date(),
      appointments_patient: [],
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
      self.appointments_patient = []
      let date = moment(self.selectedDate).format('YYYY-MM-DD')
      this.patient.appointments_patient.forEach(function (x) {
        if(x.appointment_date === date) {
          self.appointments_patient.push(x)
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