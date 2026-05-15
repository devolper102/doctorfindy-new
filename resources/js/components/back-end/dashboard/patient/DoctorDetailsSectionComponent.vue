<template>
  <div>
<div class="box_radius box_shadow mt-4 mb-4 d-inline-block w-100">
      <span class="box_header p-2 w-100 border-bottom d-inline-block font-weight-bold">Doctor Details</span>
      <div class="user_detials p-3 d-inline-block w-100">
        <div class="">
          <div class="user_detial_img float-left">
            <img v-if="user.profile.avatar" v-lazy="'/uploads/users/'+user.id+'/'+user.profile.avatar"  :alt="user.first_name+' '+user.last_name" :name="user.first_name+' '+user.last_name" class="rounded-circle w-30px h_30 mr-2 float-left">
            <img v-else v-lazy="'/uploads/users/default/doctor.svg'"  :alt="user.first_name+' '+user.last_name" :name="user.first_name+' '+user.last_name" class="rounded-circle w-30px h_30 mr-2 float-left">
          </div>
          <div class="user_name_detail float-left">
            <p class="font-weight-bold">{{ user.first_name }} {{ user.last_name }}</p>
             <p class="text_14 text_md_13 d-xs-none d-sm-none d-md-none d-lg-block">
                    {{ user.profile.sub_heading }}</p>
     <!--        <p> {{ user.area_id !== null ? user.area.title : '' }} {{ user.location_id ? user.location.title : '' }} {{ user.profile.address }} </p> -->
          </div>
        </div>
        <div class="appointments_details ml-2 w-100 d-inline-block mt-3">
          <div class="row">
            <div class="col-6 col-lg-4 col-sm-4">
              <div class="patient_bio dob_info">
                <!--<p class="font-weight-bold">D.O.B</p>
                <p class="mb-2">11,10,1984</p>-->
                <p class="font-weight-bold">Register date</p>
                <p>{{ user.created_at | formatDate }}</p>
              </div>
            </div>
            <div class="col-6 col-lg-4 col-sm-4">
              <div class="patient_bio">
              <!--   <p v-if="user.profile.gender !== null" class="font-weight-bold">Gender</p>
                <p v-if="user.profile.gender !== null" class="mb-2">{{ user.profile.gender }}</p> -->
                <p class="font-weight-bold">Education</p>
                  <p><span v-for="(edu, index) in education"> {{ edu.degree_title }}{{ index === 1 ? '' : ',' }} </span> </p>
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
  name: "DoctorDetailsSectionComponent",
  props: ['user'],
  data() {
    return {

    }
  },
  created () {
    console.log('find',this.user)
    this.education = JSON.parse(this.user.profile.educations)
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