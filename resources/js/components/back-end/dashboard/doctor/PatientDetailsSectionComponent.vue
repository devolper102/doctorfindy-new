<template>
  <div>
    <div class="box_radius box_shadow mt-4 mb-4 d-inline-block w-100">
      <span class="box_header p-2 w-100 border-bottom d-inline-block font-weight-bold">Patient Details</span>
      <div class="user_detials p-3 d-inline-block w-100">
        <div class="">
          <div class="user_detial_img float-left">
            <img v-if="patient.profile.avatar"  v-lazy="'/uploads/users/'+patient.id+'/'+patient.profile.avatar"  :alt="patient.first_name+' '+patient.last_name" :name="patient.first_name+' '+patient.last_name" class="rounded-circle w-30px h_30 mr-2 float-left">
            <img v-else  v-lazy="'/uploads/users/default/patient.svg'"  :alt="patient.first_name+' '+patient.last_name" :name="patient.first_name+' '+patient.last_name" class="rounded-circle w-30px h_30 mr-2 float-left">
          </div>
          <div class="user_name_detail float-left">
            <p class="font-weight-bold">{{ patient.first_name }} {{ patient.last_name }}</p>
            <p> {{ patient.area_id !== null ? patient.area.title : '' }} {{ patient.location_id ? patient.location.title : '' }} {{ patient.profile.address }} </p>
          </div>
        </div>
        <div class="appointments_details ml-2 w-100 d-inline-block mt-3">
          <div class="row">
            <div class="col-6 col-lg-4 col-sm-4">
              <div class="patient_bio dob_info">
                <!--<p class="font-weight-bold">D.O.B</p>
                <p class="mb-2">11,10,1984</p>-->
                <p class="font-weight-bold">Register date</p>
                <p>{{ patient.created_at | formatDate }}</p>
              </div>
            </div>
            <div class="col-6 col-lg-4 col-sm-4">
              <div class="patient_bio">
                <p v-if="patient.profile.gender !== null" class="font-weight-bold">Gender</p>
                <p v-if="patient.profile.gender !== null" class="mb-2">{{ patient.profile.gender }}</p>
                <p class="font-weight-bold">Last appointment</p>
                <p>{{ patient.appointments_patient[patient.appointments_patient.length - 1].appointment_date | formatDate}}</p>
              </div>
            </div>
            <div class="col-12 col-lg-4 col-sm-4 text-center mt-3 mt-lg-0 mt-sm-0 mt-md-0">
              <div class="patient_bio d-inline-block text-center w-80 w-sm-100">
                <div class="call_btn d-inline-block mb-3 w-100">
                  <a href="tel:0345-0435621" class="box_radius p-2 text-white blue_btn_bg d-inline-block w-100">Help Line <i class="fas fa-phone fa-sm" aria-hidden="true"></i></a>
                </div>
                <div class="msg_btn d-inline-block w-100">
                  <a href="#" class="box_radius p-2 text-white green_btn_bg d-inline-block w-100">Chat <i class="fas fa-comments ml-2"></i> </a>
                </div>
              </div>
            </div>
            <!--<div class="w-100 d-inline-block mt-3 disease_tags">
              <a href="#" class="text-primary">Asthma</a>
              <a href="#" class="text-primary ml-4 mr-4">Hypertensian</a>
              <a href="#" class="text-primary">Asma Urat</a>
            </div>-->
          </div>
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
export default {
  name: "PatientDetailsSectionComponent",
  props: ['patient'],
  data() {
    return {

    }
  },
  created () {
    let self = this
  },
  methods: {

  },
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