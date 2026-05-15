<template>
  <div>
    <section class="doctor-video-calling">
      <div class="container">
        <div class="row mb-4 mb-xs-2 mt-4">
          <div class="col-12 col-lg-4 col-md-6 mb-4" v-if="doctors.length > 0" v-for="user in doctors">
            <doctor-card
                :doctor="user"
                :fileSystemDriver="fileSystemDriver"
            ></doctor-card>
          </div>
          <div v-else><h3>No Data Available</h3></div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="join-doctor-btn mb-4 w-100 mt-xs-0 d-inline-block text-center mb-xs-3">
              <span class="more_option w-100 text-center d-inline-block mb-4"  v-if="doctors_total_length >= 6">
              <a href="javascript:void(0)" @click="showMore"  class="rounded-pill bg-blue text-white p-2 btn_padding d-inline-block">
                View more doctors
                <i aria-hidden="true" class="fa fa-arrow-right ml-1"></i>
              </a>
          </span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
name: "RelatedDoctorComponent",
  props: ['procedure','procedure_doctors','speciality_id','location_id', 'fileSystemDriver'],
  data() {
    return {
      search: '',
      doctors: this.procedure_doctors,
      doctorsToShow: 12,
      doctors_total_length:0,
      page: 1
    }
  },
  computed: {},
  created () {
    // console.log('this.procedure_doctors',this.procedure_doctors);
    // let self = this
    // self.procedure.users.forEach(function (user){
    //   if (user.roles[0].name === 'doctor') {
    //     self.doctors.push(user)
    //   }
    // })
  },
  mounted()
  {
    if(this.procedure_doctors.length == 0)
    {
         this.getProcedureDoctors();
    }
  },
methods:{
  getProcedureDoctors()
  {
    if(this.speciality_id.length == 0)
    {
      var speciality_id=null;
    }
    else
    {
      var speciality_id=this.speciality_id;
    }
    axios.get('/get-procedure-doctors/'+speciality_id+'/'+this.procedure.id+'/'+this.location_id)
    .then(response=>{
        this.doctors=response.data[0];
        this.doctors_total_length=response.data[1];
    })
  },
  showMore(){
        if(this.doctorsToShow >= this.doctors_total_length){
          this.doctorsToShow += 12; 
          // console.log(window.location.href);
        }else{
          const getLastItem = thePath => thePath.substring(thePath.lastIndexOf('/') + 1)
          this.$parent.loading = true
          this.page = this.page+1;
          var treatmentstring = getLastItem(window.location.href);
          console.log('treatmentstring',window.location.origin+'/treatment-nextdoctor?page='+this.page+'&treatment='+treatmentstring)
             axios.get(window.location.origin+'/treatment-nextdoctor?page='+this.page+'&treatment='+treatmentstring)
            .then((response) => {
              response.data.users.forEach((item) => { 
                  this.doctors.push(item);
              })
              this.$parent.loading = false
              this.doctorsToShow += 12;
            })
            .catch((error) => {
              // console.log('greaterrrr',error);
            });
        }
    },
}
}
</script>

<style>

</style>