<template>
	<div>
	 <!-- Today Appointments Table -->
	<div class="box_radius box_shadow mt-4 mb-4 d-inline-block w-100">
        <div class="today_appointment table-responsive">
          <p class="p-2 pb-0 font-weight-bold border-bottom">Today appointments</p>
          <table class="table">
            <thead class="d-none">
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
               
                <tr class="light_green_bg" v-for="appointment in appointments">
                    <td><span><img  :src="'../images/backend_images/banner-1.png'" alt="user-img" class="rounded-circle w-30px h_30 mr-2 float-left"><span class="pt-1 d-inline-block" v-if="appointment.patients !== undefined">{{appointment.patients.first_name}}</span></span></td>
                    <td class="green_text pt-2">Medical check up</td>
                    <td class="pt-2">On going</td>
                </tr>
                   
            </tbody>
          </table>
        </div>
    </div>
     <!-- // Today Appointments Table -->
      <!-- Patient Detail -->
              
      <div class="box_radius box_shadow mt-4 mb-4 d-inline-block w-100"  v-for="appointment in appointments" >
        <span class="box_header p-2 w-100 border-bottom d-inline-block font-weight-bold">Patient Details</span>
        <div class="user_detials p-3 d-inline-block w-100">
          <div class="">
            <div class="user_detial_img float-left">
              <img  :src="'../images/backend_images/banner-1.png'" alt="user-img" class="rounded-circle w-40px h_40 mr-2">
            </div>
            <div class="user_name_detail float-left">
              <p class="font-weight-bold">Patient Name</p>
              <p v-if="appointment.patients !== undefined">{{appointment.patients.first_name +' '+ appointment.patients.last_name}}</p>
            </div>
          </div>
          <div class="appointments_details ml-2 w-100 d-inline-block mt-3">
            <div class="row">
              <div class="col-6 col-lg-4 col-sm-4">
                <div class="patient_bio dob_info">
                  <p class="font-weight-bold">D.O.B</p>
                  <p class="mb-2">11,10,1984</p>
                  <p class="font-weight-bold">Register date</p>
                  <p>{{appointment.created_at}}</p>
                </div>
              </div>
              <div class="col-6 col-lg-4 col-sm-4">
                <div class="patient_bio">
                  <p class="font-weight-bold">Gender</p>
                  <p class="mb-2">Female</p>
                  <p class="font-weight-bold">Last appointment</p>
                  <p>{{appointment.last_appointement}}</p>
                </div>
              </div>
              <div class="col-12 col-lg-4 col-sm-4 text-center mt-3 mt-lg-0 mt-sm-0 mt-md-0">
                <div class="patient_bio d-inline-block text-center w-80 w-sm-100">
                  <div class="call_btn d-inline-block mb-3 w-100">
                    <a href="#" class="box_radius p-2 text-white blue_btn_bg d-inline-block w-100" v-if="appointment.patients !== undefined">{{appointment.patients.phone_number}} <i class="fas fa-phone fa-sm" aria-hidden="true"></i></a>
                  </div>
                  <div class="msg_btn d-inline-block w-100">
                    <a href="#" class="box_radius p-2 text-white green_btn_bg d-inline-block w-100">Chat <i class="fas fa-comments ml-2"></i> </a>
                  </div>
                </div>                    
              </div>
              <div class="w-100 d-inline-block mt-3 disease_tags">
                <a href="#" class="text-primary">Asthma</a>
                <a href="#" class="text-primary ml-4 mr-4">Hypertensian</a>
                <a href="#" class="text-primary">Asma Urat</a>
              </div>
            </div>
          </div>
        </div>
          
      </div>
      <div class="box_radius box_shadow mt-4 mb-4 table-responsive w-100">
    <div class="invoices">
      <p class="p-2 font-weight-bold border-bottom">Invoices</p>
      <table class="table">
        <thead>
            <tr>
                <th>Inovoice id</th>
                <th>Purchase date</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="appointment in appointments">
                <td>{{appointment.id}}</td>
                <td>{{ appointment.appointment_date}}</td>
                <td>Rs.{{appointment.charges}}</td>
                <td>{{appointment.status}}</td>
                <td><a :href="'/doctor/show/invoice/'+appointment.user_id" class="theme-color-text font-weight-bold">View</a></td>
            </tr>
        </tbody>
      </table>
    </div>
</div>
</div>
</template>
<script>
	export default {
		props: ['appointments', 'invoices'],
		name: "DashboardPageComponent",
		data: function () {
      return {
        
      }
    },
    created () {
	    	// console.log(this.appointments[0].patients.first_name);
    	}
	}
</script>