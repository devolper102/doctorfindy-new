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
          <div class="container">
                <div class="tab-content" id="appointment_list">
              <div class="tab-pane fade show active" id="today_appointment" role="today_appointment" aria-labelledby="today-appointment">
                <h1>Total Appointments:<span style="color:green"> {{patient.appointments_patient.length}}</span></h1>
                <table id="today_table" class="table table-bordered dt-responsive nowrap tabs_table" style="width:100%" v-if="patient.appointments_patient.length > 0">
                  <thead>
                  <tr>
                    <th>Patient</th>
                    <th>Hospital</th>
                    <th>Time</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(appointment, index) in patient.appointments_patient" >
                    <td>
                      <span>
                         <a :href="'/profile/'+appointment.user.slug" class="float-left mr-2">
                           <img  v-if="appointment.user.profile.avatar" v-lazy="'/uploads/users/'+appointment.user_id+'/'+appointment.user.profile.avatar" class="img-fluid w-30px h_30 rounded-circle" :alt="appointment.user.first_name +' '+ appointment.user.last_name">
                        <img v-else v-lazy="'/uploads/users/default/doctor.svg'" class="img-fluid w-30px h_30 rounded-circle" alt="user Image">
                       
                       {{appointment.user.first_name}} {{appointment.user.last_name}} </a>
                      </span>
                    </td>
                      <td>
                        <span v-if="appointment.hospital_id !== 0">
                         <a :href="'/profile/'+appointment.hospital_profile.slug" class="float-left mr-2">
                           <img  v-if="appointment.hospital_profile.profile.avatar" v-lazy="'/uploads/users/'+appointment.hospital_id+'/'+appointment.hospital_profile.profile.avatar" class="img-fluid w-30px h_30 rounded-circle" :alt="appointment.hospital_profile.first_name +' '+ appointment.hospital_profile.last_name">
                        <img v-else v-lazy="'/uploads/users/default/hospital.svg'" class="img-fluid w-30px h_30 rounded-circle" alt="user Image">
                       
                       {{appointment.hospital_profile.first_name}} {{appointment.hospital_profile.last_name}}
                       </a>
                      </span>
                      <span v-else>Online</span>
                      
                    </td>
                    <td>
                      <p>{{appointment.appointment_time}}</p>
                    </td>
                    <td>
                      <p>{{appointment.appointment_date | formatDate }}</p>
                    </td>
                    <td>
                      <p>{{appointment.charges  }}</p>
                    </td>
                    <td>
                      <p>{{appointment.type }}</p>
                    </td>
                    <td>
                      <span class="theme-color-text font-weight-bold">
                        {{appointment.status}}
                      </span>
                    </td>
                    <td>
                      <span v-if="appointment.payment !== 'paying-verified'">
                      <a  :href="'/patient/payout-setting/'+appointment.id"class="btn btn-primary" >Payout</a>
                      </span>
                      <span v-else style="color:green"><h5>Paying</h5></span>
                    </td>
                  </tr>

                    </tbody>
                  </table>
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
  </div>
</template>

<script>
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MMM DD,YYYY')
  }
});
export default
{
  name: "PayoutAppointmentsComponent",
  props: ['patient','managements'],
  data() {
    return {
      
    }
  },
  created () {
   
  },
  methods: {
  

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