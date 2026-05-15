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
                <div class="tab-content" id="appointment_list">
              <div class="tab-pane fade show active" id="today_appointment" role="today_appointment" aria-labelledby="today-appointment">
                <h2>Total Appointments:<span style="color:green"> {{appointments.length}}</span></h2>
               
                <table id="today_table" class="table table-bordered dt-responsive nowrap tabs_table" style="width:100%" v-if="appointments.length > 0">
                  <thead>
                  <tr>
                    <th>Time</th>
                    <th>Date</th>
                    <th>Patient</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(appointment, index) in appointments" >
                    <td>
                      <p>{{appointment.appointment_time}}</p>
                    </td>
                    <td>
                      <p>{{appointment.appointment_date | formatDate }}</p>
                    </td>
                    <td>
                      <span>
                        <span class="badge p-2 rounded-pill badge_color">New</span>
                       {{appointment.patient.first_name}} {{appointment.patient.last_name}}
                      </span>
                    </td>
                    <td>
                      <span class="theme-color-text font-weight-bold">
                        {{appointment.status}}
                      </span>
                    </td>
                    <td>
                      <span class="text_20 text-center w-100 d-block">
                                <button type="button"v-if="appointment.status === 'pending' || appointment.status === 'cancel'" @click="ApproveStatus(appointment.id)"class="box_radius p-1 text-center text-white green_btn_bg d-inline-block table_btns">
                                           Approve
                              </button>

                              <button type="button"v-if="appointment.status === 'accepted' || appointment.status === 'pending'" @click="ChangeAppointmentStatus(appointment.id)"class="box_radius p-1 pl-3 pr-3 text-center text-white  d-inline-block text_12 knockdoc_btn_bg">
                                           Cancel
                              </button>
                              <span v-if="appointment.status === 'accepted'">
                                <span v-if="appointment.status_action === null">
                                 <select v-model="status_value" class="box_radius p-1 pl-3 pr-3 text-center text-white  d-inline-block text_12 knockdoc_btn_bg" @change="onChange(appointment.id)">
                                  <option disabled value="">Select Status</option>
                                  <option value="visited">Visited</option>
                                  <option value="not_visited" >Not Visited</option>
                                  </select>
                                  </span>
                                  <span v-else-if="appointment.status_action === 'visited'"style="color:green">Visited</span>
                                  <span v-else-if="appointment.status_action === 'not_visited'" style="color:red">Not Visited</span>
                              </span>
                      </span>
                    </td>
                  </tr>

                  </tbody>
                </table>
                <h4 v-if="appointments.length === 0" style="color:black;font-weight:bold;margin-top:10px;"align="center">No Appointments</h4>
              </div>
            </div>
              </div>
              <div class="mt-5 col-lg-3 col-sm-12 col-md-12 mt-4 mt-lg-0 mb-lg-0 mb-5 pl-lg-0">
                <v-date-picker
                    :popover="{visibility: visibility}"
                    @dayclick="dayClick"
                    :mode="mode"
                    v-model="selectedDate"
                ></v-date-picker>
                 <p style="color:green;">Please select date to show your appointments</p>
              </div>
            </div>
          </div>
        </div>
        <!-- Footer -->
        <footer class="dashboard-sticky-footer bg-white box_shadow p-2 d-inline-block mt-4 p-2 border-top w-xs-100 w-md-100">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
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

export default
{
  name: "AppointmentListComponent",
  props: ['doctor','managements'],
  data() {
    return {
      doctor_: this.doctor,
      mode: "date",
      selectedDate: new Date(),
      appointments: [],
      date: new Date(),
      visibility: true,
      id: '',
      status_value: '',
    }
  },
  created () {
    let self = this
    self.filterAppointments()
  },
  methods: {
         onChange(id) {
          console.log('id',id,this.status_value);
                let self = this;
                 axios.post('/doctor/change-status/'+id,{
                id : id,
                status_value : this.status_value,
            })
             .then(function (response) {
              console.log(' new res',response.data.appointments)
                 Vue.toasted.success('Status Change Successfully...' , { duration: 3000 })
                   self.doctor_.appointments = response.data.appointments
                    self.filterAppointments()
                   e.preventDefault();
                }).catch(function (error) {
                });
            },
    filterAppointments() {
      console.log('hello wrodl')
      let self = this
      self.appointments = []
      let date = moment(self.selectedDate).format('YYYY-MM-DD')
      this.doctor_.appointments.forEach(function (x) {
        if(x.appointment_date === date) {
          console.log(x.appointment_date === date)
          self.appointments.push(x)
          console.log(self.appointments)
        }
      })
    },
    dayClick () {
      this.filterAppointments()
      console.log(123123, this.selectedDate)
    },
     ChangeAppointmentStatus(id) {
      let self = this
            Swal.fire({
              title: 'Are you sure? to Cancel Appointment',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'No',
              confirmButtonText: 'Yes, Cancel it!'
            }).then((result) => {
              if (result.value) {
                //Send Request to server
                axios.delete('/doctor/appointment-status/'+id)
                    .then((response)=> {
                            Swal.fire(
                              'Cancel!',
                              'Appointment Cancel Successfully...',
                              'success'
                            )
                            self.doctor_.appointments = response.data.appointments
                            self.filterAppointments()
                    }).catch(() => {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!',
                          footer: '<a href>Why do I have this issue?</a>'
                        });
                    });
                }

            });
          },
          ApproveStatus(id) {
            let self = this
            Swal.fire({
              title: 'Are you sure? to Approve Appointment',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Approve it!'
            }).then((result) => {
              if (result.value) {
                //Send Request to server
                axios.delete('/doctor/appointment-Approve/'+id)
                    .then((response)=> {
                            Swal.fire(
                              'Approve!',
                              'Appointment Approve Successfully...',
                              'success'
                            )
                            self.doctor_.appointments = response.data.appointments
                            self.filterAppointments()
                            console.log(response)
                    }).catch(() => {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!',
                          footer: '<a href>Why do I have this issue?</a>'
                        });
                    });
                }

            });
          },

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