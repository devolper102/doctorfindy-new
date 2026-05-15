<template>
  <div>
    <section class="hospitals_section">
      <!-- <div v-if="hospitals.length > 0" v-for="hospital in hospitals"> -->
      <div class="container">
      <div class="bg-medical-doctor-hospital mt-2">
          <div class="row">
        <div class="col-12 bg-white" v-if="hospitals.length > 0" v-for="hospital in hospitals">
          <div class="box_radius box_shadow mb-lg-3 mb-2 p-2">
        <hospital-tab
            :fileSystemDriver="fileSystemDriver"
            :patient="patient"
            :user="hospital"
        ></hospital-tab>
      <!-- </div> -->
      </div>
        </div>
      <div v-else><h3>No Data Available</h3></div>
        </div>
      </div>
         <div class="row">
          <div class="col-12">
            <div class="join-doctor-btn mb-4 w-100 mt-xs-0 d-inline-block text-center mb-xs-3">
              <a href="/hospitals" class="rounded-pill bg-blue text-white p-2 btn_padding d-inline-block">View all hospitals
                <i class="fa fa-arrow-right ml-3" aria-hidden="true">
                </i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "RelatedHospitalComponent",
  props: ['procedure', 'patient','procedure_hospitals','speciality_id','location_id', 'fileSystemDriver'],
  data() {
    return {
      search: '',
      hospitals: this.procedure_hospitals,
      hospitals_total_length:0,
    }
  },
  computed: {},
  created () {
    // let self = this
    // self.procedure.users.forEach(function (user){
    //   if (user.roles[0].name === 'hospital') {
    //     self.hospitals.push(user)
    //   }
    // })
  },
  mounted()
  {
    if(this.procedure_hospitals.length == 0)
    {
         this.getProcedureHospitals();
    }
  },
  methods:
  {
    getProcedureHospitals()
    {
      if(this.speciality_id.length == 0)
    {
      var speciality_id=null;
    }
    else
    {
      var speciality_id=this.speciality_id;
    }
       axios.get('/get-procedure-hospitals/'+speciality_id+'/'+this.procedure.id+'/'+this.location_id)
        .then(response=>{
          this.hospitals=response.data;
        })
    },
  },
}
</script>

<style scoped>

</style>