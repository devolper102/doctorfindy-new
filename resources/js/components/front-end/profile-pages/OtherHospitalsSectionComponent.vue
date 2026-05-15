<template>
  <div>
    <section class="other-hospital-in-lahore" v-if="hospital_data.length">
      <div class="container">
        <div class="row mt-2 mb-4">
          <div class="col-12">
            <div class="heading-other-hispital">
              <h2 class="text-blue font-weight-bold text_20 text-xs-15">Other Hospitals in {{user.location.title}}</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <ul class="other-hospital-in-lahore mb-0 item_list">
              <li v-for="(hospital,index) in hospital_data" v-if="index < hospitalToShow"class="d-inline-block align-middle item text-center w-md-100 mb-2 w-sm-100 w-md-100 mr-2 
              mr-lg-3">
                <a class="text_14 text_black w-100 d-inline-block" :href="'/hospitals/'+hospital.location.slug+'/'+ hospital.slug">
                  {{ hospital.first_name }} {{ hospital.last_name }}
                </a>
              </li>

            </ul>
          </div>
          <div class="col-12">
              <div class="mt-4 more_btn text-center d-inline-block 
              w-100">
                <a  href="javascript:void(0)" v-if="hospital_data.length > 8 && hospital_data.length > hospitalToShow-1" @click="showMoreHospitals()" class="d-inline-block rounded-pill text-center bg-blue btn_padding text_14 text_md_12 text-white"> View More hospitals
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
name: "OtherHospitalsSectionComponent",
  props:['hospitals','user'],
  data() {
    return {
       hospitalToShow: 8,
       hospital_data:'',
    }
  },
  created () {
    

  },
  mounted(){
     if(this.hospitals.length>0)
     {
        this.hospital_data=this.hospitals;
     }
     else
     {
        this.getOtherHospitals();
     }
  },
  methods: {
    getOtherHospitals(){
      var user_id=this.user.id;
      var location_id=this.user.location.id;
      axios.get('/hospital-profile/get-other-hospitals/'+user_id+'/'+location_id).then(response=>{
            this.hospital_data=response.data;
      })
    },
    showMoreHospitals(){
          this.$parent.loading = true
         axios.get('/getMoreOtherHospital/'+this.user.id).then(response=>{
               this.$parent.loading= false,
          
               this.hospitalToShow=this.hospitalToShow+3;
               this.hospital_data = response.data;
          });
    }
  }
}
</script>

<style scoped>

</style>