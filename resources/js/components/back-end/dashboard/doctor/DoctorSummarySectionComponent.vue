<template>
  <div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-12 mt-3 mt-lg-4">
        <div class="box_shadow box_radius d-inline-block w-100 p-2 blue_bg appointment_box bg_position">
          <!-- <img src="/images/color_calander.png"> -->
          <div class="appointments_details w-lg-100 w-md-75 w-sm-80 float-right">
            <h2 class="m-0">{{ appointments.length }}</h2>
            <p class="text_12">Appointments</p>
            <p class="theme-green-text font-weight-bold">Today</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 mt-3 mt-lg-4">
        <div class="box_shadow box_radius d-inline-block w-100 p-2 blue_bg urgent_appointment bg_position">
          <!-- <img src="/images/urgent_appointment.png"> -->
          <div class="appointments_details w-lg-100 w-md-75 w-sm-80 float-right">
            <h2 class="m-0">{{ appointments.length }}</h2>
            <p class="text_12">Urgent Appointments</p>
            <p class="theme-green-text font-weight-bold">Today</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 mt-3 mt-lg-4">
        <div class="box_shadow box_radius d-inline-block w-100 p-2 blue_bg income bg_position">
            <!-- <img src="/images/rs_blue.svg">  -->         
          <div class="appointments_details w-lg-100 w-md-75 w-sm-80 float-right">
            <h2 class="m-0">Rs.{{ income }}</h2>
            <p class="text_12">Income</p>
            <p class="theme-green-text font-weight-bold">Today</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12 mt-3 mt-lg-4">
        <div class="box_shadow box_radius d-inline-block w-100 p-2 blue_bg pay bg_position">
          <!-- <img src="/images/money.png"> -->
          <div class="appointments_details w-lg-100 w-md-75 w-sm-80 float-right">
            <h2 class="m-0">Rs.1000</h2>
            <p class="text_12">Pay to DoctorFindy</p>
            <p class="theme-green-text font-weight-bold">Today</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "DoctorSummarySectionComponent",
  props: ['doctor','appointments'],
  data() {
    return {
      income: 0,
    }
  },
  created () {
    let self = this
    this.doctor.appointments.forEach(function (x) {
      self.income += x.charges
    })
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