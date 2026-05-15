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
              <h1>Total Orders:<span style="color:green"> {{all_orders.length}}</span></h1>
              <table id="today_table" class="table table-bordered dt-responsive nowrap tabs_table" style="width:100%" v-if="all_orders.length > 0">
                <thead>
                <tr>
                  <th>Patient</th>
                  <th>Hospital</th>
                  <th>Time</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Payment Method</th>
                  <th>Payment Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="(order, index) in all_orders" >
                  <td>
                    <span>
                       <a href="#" class="float-left mr-2">
                         <img  v-if="order.patient_profile.profile.avatar"  v-lazy="'/uploads/users/'+order.patient_id+'/'+order.patient_profile.profile.avatar" class="img-fluid w-30px h_30 rounded-circle" :alt="order.patient_profile.first_name +' '+ order.patient_profile.last_name">
                      <img v-else  v-lazy="'/uploads/users/default/patient.svg'" class="img-fluid w-30px h_30 rounded-circle" alt="user Image">
                      </a>
                     {{order.patient_profile.first_name}} {{order.patient_profile.last_name}}
                    </span>
                  </td>
                    <td>
                      <span v-if="order.hospital_id !== 0">
                       <a :href="'/profile/'+order.hospital_profile.slug" class="float-left mr-2">
                         <img  v-if="order.hospital_profile.profile.avatar"  v-lazy="'/uploads/users/'+order.patient_id+'/'+order.hospital_profile.profile.avatar" class="img-fluid w-30px h_30 rounded-circle" :alt="order.hospital_profile.first_name +' '+ order.hospital_profile.last_name">
                      <img v-else  v-lazy="'/uploads/users/default/hospital.svg'" class="img-fluid w-30px h_30 rounded-circle" alt="user Image">
                     
                     {{order.hospital_profile.first_name}} {{order.hospital_profile.last_name}}
                     </a>
                    </span>
                    <span v-else>Online</span>
                    
                  </td>
                  <td>
                    <p>{{order.appointment_time}}</p>
                  </td>
                  <td>
                    <p>{{order.appointment_date | formatDate }}</p>
                  </td>
                  <td>
                    <p>{{order.charges  }}</p>
                  </td>
                  <td>
                    <p>{{order.payment_gateway }}</p>
                  </td>
                  <td>
                    <span class="theme-color-text font-weight-bold">
                      {{order.status}}
                    </span>
                  </td>
                  <td>
                    <span v-if="order.status !== 'verify'">
                    <button class="btn btn-primary" @click="VerifyStatus(order.id)">Not Verify</button>
                    </span>
                    <span v-else style="color:green">Verify</span>
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
  name: "AllOrdersComponent",
  props: ['orders','doctor','managements'],
  data() {
    return {
      all_orders: this.orders,
    }
  },
  created () {
    console.log('orders',this.orders)
   
  },
  methods: {
     VerifyStatus(id) {
            let self = this
            Swal.fire({
              title: 'Are you sure? to Verify Payment',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Approve it!'
            }).then((result) => {
              if (result.value) {
                //Send Request to server
                axios.delete('/doctor/payment-verify/'+id)
                    .then((response)=> {
                            Swal.fire(
                              'Approve!',
                              'Verify Payment Successfully...',
                              'success'
                            )
                            console.log('response',response.data,response)
                            self.all_orders = response.data
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