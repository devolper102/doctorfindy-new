<template>
    <div class="form-group">
        <label style="display:inline-block">
            <input type="checkbox" name="hospital_icu" class="willing_home_visit" :checked="this.hospital_icu"> ICU
        </label>
        <label style="display:inline-block; margin-left: 20px">
            <input type="checkbox" name="hospital_emergency" class="willing_home_visit" :checked="this.hospital_emergency"> Emergency
        </label>
        <label style="display:inline-block; margin-left: 20px">
            <input type="checkbox" name="hospital_ventilator" class="willing_home_visit" :checked="this.hospital_ventilator"> Ventilator
        </label>
        <label style="display:inline-block; margin-left: 20px">
            <input type="checkbox" name="hospital_24_service" class="willing_home_visit" :checked="this.hospital_24_service"> 24 Hours Service
        </label>
         <label style="display:inline-block; margin-left: 20px">
            <input type="checkbox" name="ambulance" class="willing_home_visit" :checked="this.ambulance"> Ambulance
        </label>
         <label style="display:inline-block; margin-left: 20px">
            <input type="checkbox" name="waiting_lounge" class="willing_home_visit" :checked="this.waiting_lounge"> Waiting Lounge
        </label>
         <label style="display:inline-block; margin-left: 20px">
            <input type="checkbox" name="laboratory" class="willing_home_visit" :checked="this.laboratory"> Laboratory
        </label>
         <label style="display:inline-block; margin-left: 20px">
            <input type="checkbox" name="pharmacy" class="willing_home_visit" :checked="this.pharmacy"> Pharmacy
        </label>
         <label style="display:inline-block; margin-left: 20px">
            <input type="checkbox" name="blood_bank" class="willing_home_visit" :checked="this.blood_bank"> Blood Bank
        </label>
         <label style="display:inline-block; margin-left: 20px">
            <input type="checkbox" name="atm" class="willing_home_visit" :checked="this.atm"> Atm
        </label>
         <label style="display:inline-block; margin-left: 20px">
            <input type="checkbox" name="car_parking" class="willing_home_visit" :checked="this.car_parking"> Car Parking
        </label>
           <label style="display:inline-block; margin-left: 20px">
            <input type="checkbox" name="cafeteria" class="willing_home_visit" :checked="this.cafeteria"> Cafeteria
        </label>

    </div>
</template>

<script>
  export default {
        props: ['hospital_icu','hospital_emergency','hospital_ventilator','hospital_24_service','ambulance','waiting_lounge','laboratory','pharmacy','blood_bank','atm','car_parking','cafeteria'],
    created() {
        // console.log(this.ambulance,this.waiting_lounge,this.laboratory,this.pharmacy,this.blood_bank,this.atm,this.car_parking,this.cafeteria,'hello every one');
    },
    data() {
      return {
      }
    },
    methods: {

    },

  }
</script>
