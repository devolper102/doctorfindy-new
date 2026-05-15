<template>
  <div>
   <div class="box_radius box_shadow mt-4 mb-4 p-2 p-lg-3 d-inline-block w-100">
                <div class="user_name_img d-inline-block w-100">
                  <a href="#" class="float-left mr-1 mr-lg-3">
                    <img  v-if="patient.profile.avatar" v-lazy="'/uploads/users/'+patient.id+'/'+patient.profile.avatar" class="img-fluid w-80px h_80 rounded-circle" :alt="patient.first_name +' '+ patient.last_name">
                      <img v-else v-lazy="'/uploads/users/default/patient.svg'" class="img-fluid w-80px h_80 rounded-circle" alt="user Image">
                  </a>
                  <h2 class="float-left mt-2">{{ patient.first_name }} {{ patient.last_name }}</h2>
                </div>
                <div class="user_date d-inline-block">
                  <a href="#" class="float-left text_black mr-0 mr-lg-3 mt-3 ">
                    <img src="/images/calander.png" class="img-fluid" alt="user Image">
                  </a>
                  <div class="welcome_text patientWelcomeText float-left mt-3 ml-3 ml-lg-0">
                    <h2>Welcome <span>{{ currentDate }}</span> (<span> {{ time }} </span>)</h2>
                    <p class="text-secondary">Today <span style="color:green"> {{appointments_patient.length}}</span> Appointment</p>
                  </div>
                </div>
              </div>
  </div>
</template>

<script>
export default {
  name: "PatientTabSectionComponent",
  props: ['patient','appointments_patient'],
  data() {
    return {
      date: moment(),
      currentDate: moment().format('DD MMMM YYYY'),
    }
  },
  computed: {
    time: function(){
      return this.date.format('h:mm:ss A');
    }
  },
  mounted: function(){
    setInterval(() => {
      this.date = moment(this.date.add(1, 'seconds'))
    }, 1000);
  },
  created () {
   
console.log(this.appointments_patient)
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