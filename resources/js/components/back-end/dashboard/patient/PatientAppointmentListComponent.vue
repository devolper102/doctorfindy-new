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
                <div class="tab-content" id="appointment_list">
              <div class="tab-pane fade show active" id="today_appointment" role="today_appointment" aria-labelledby="today-appointment">
                <h2>Total Appointments:<span style="color:green"> {{appointments_patient.length}}</span></h2>
                
                <table id="today_table" class="table table-bordered dt-responsive nowrap tabs_table" style="width:100%" v-if="appointments_patient.length > 0">
                  <thead>
                  <tr>
                    <th>Time</th>
                    <th>Date</th>
                    <th>Doctor</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(appointment, index) in appointments_patient" >
                    <td>
                      <p>{{appointment.appointment_time}}</p>
                    </td>
                    <td>
                      <p>{{appointment.appointment_date | formatDate}}</p>
                    </td>
                    <td>
                      <span>
                        <span class="badge p-2 rounded-pill badge_color">New</span>
                       {{appointment.user.first_name}} {{appointment.user.last_name}}
                      </span>
                    </td>
                    <td>
                      <span class="theme-color-text font-weight-bold">
                        {{appointment.status}}
                      </span>
                    </td>
                    <td>
                      <span class="text_20 text-center w-100 d-block">
                              <button type="button"v-if="appointment.status === 'accepted' || appointment.status === 'pending'" @click="ChangeStatus(appointment.id)"class="box_radius p-1 pl-3 pr-3 text-center text-white  d-inline-block text_12 knockdoc_btn_bg  ">
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
                <h4 v-if="appointments_patient.length === 0" style="color:red;"align="center">No Appointment
                </h4>
             
               <!--  <div v-if="someone">
                    <div class="row">
                      <textarea class="form-control text_14"v-model="description"  rows="4" id="feedback"></textarea>
                      </div>
                </div>
                 <button type="submit" @click="onChange(appointment.id)"class="btn btn-primary" align="center">Submit</button> -->
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
  name: "PatientAppointmentListComponent",
  props: ['patient','managements'],
  data() {
    return {
      patient_: this.patient,
      mode: "date",
      selectedDate: new Date(),
      appointments_patient: [],
      date: new Date(),
      visibility: true,
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
                 axios.post('/patient/change-status/'+id,{
                id : id,
                status_value : this.status_value,
                description : this.description,
            })
             .then(function (response) {
                 Vue.toasted.success('Status Change Successfully...' , { duration: 3000 })
                 self.patient_.appointments_patient = response.data.appointments_patient
                  self.filterAppointments()
                   e.preventDefault();
                }).catch(function (error) {
                });
            },
    filterAppointments() {
      let self = this
      self.appointments_patient = []
      let date = moment(self.selectedDate).format('YYYY-MM-DD')
      this.patient_.appointments_patient.forEach(function (x) {
        if(x.appointment_date === date) {
          self.appointments_patient.push(x)
        }
      })
    },
    dayClick () {
      this.filterAppointments()
      console.log(123123, this.selectedDate)
    },
     ChangeStatus(id) {
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
                axios.delete('/patient/appointment-status/'+id)
                    .then((response)=> {
                            Swal.fire(
                              'Cancel!',
                              'Appointment Cancel Successfully...',
                              'success'
                            )
                            self.patient_.appointments_patient = response.data.appointments_patient
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