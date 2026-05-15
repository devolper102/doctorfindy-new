<template>
  <div>
    <!-- Topbar -->
   <header-section 
    :managements="managements"  
    :doctor="doctor">
    </header-section>
    <!-- End of Topbar -->
    <!-- Sidebar -->
    <div class="dashboard_inner d-flex"> 
    <sidebar-section></sidebar-section>
    <!-- End of Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column w-100 mt-3">
      <!-- Main Content -->
      <div id="content">
        <!-- Begin Page Content -->
        <div class="container">
              <div class="tab-content" id="appointment_list">
            <div class="tab-pane fade show active" id="today_appointment" role="today_appointment" aria-labelledby="today-appointment">
              <h2>Total Appointments Notifications:<span style="color:green"> {{doctor.appointments.length}}</span></h2>
              <table id="today_appointment_notification" class="table table-bordered dt-responsive nowrap tabs_table" style="width:100%" v-if="doctor.appointments.length > 0">
                <thead>
                <tr>
                  <th>Patient</th>
                  <th>Hospital</th>
                  <th>Time</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Type</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(appointment, index) in doctor.appointments" >
                  <td>
                    <span>
                       <a href="#" class="float-left mr-2">
                         
                      <img   v-lazy="'/uploads/users/default/patient.svg'" class="img-fluid w-30px h_30 rounded-circle" alt="user Image">
                      </a>
                     {{appointment.patient.first_name}} {{appointment.patient.last_name}}
                    </span>
                  </td>
                    <td>
                      <span v-if="appointment.hospital_id !== 0">
                       <a :href="'/profile/'+appointment.hospital_profile.slug" class="float-left mr-2">
                         
                      <img v-lazy="'/uploads/users/default/hospital.svg'" class="img-fluid w-30px h_30 rounded-circle" alt="user Image">
                     
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
  name: "AllAppointmentsNotificationComponent",
  props: ['doctor','managements'],
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