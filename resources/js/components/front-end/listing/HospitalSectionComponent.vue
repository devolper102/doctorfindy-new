<template>
  <div>
    <section class="trending-hospital-in-pakistan bg-doctor">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="heading-doctor-video-calling">
              <h2 class="font-weight-bold mb-3 mb-xs-3 mt-3 text_xs_18 text_20 service-text">Trending Hospitals of Pakistan
              </h2>
            </div>
          </div>
        </div>
        <section class="doctor-hospital-medical-center">
      <div class="bg-medical-doctor-hospital mt-2">
          <div class="row">
        <div class="col-12" v-if="index < hospitalsToShow" v-for="(hospital, index) in allHospitals">
          <div class="box_radius box_shadow mb-lg-3 mb-2 bg-white">
          <hospital-tab
              :user="hospital"
              :patient="patient"
              :fileSystemDriver="fileSystemDriver"
          ></hospital-tab>
        </div>
        </div>
        </div>
      </div>
    </section>
        <div class="row">
          <div class="col-12">
            <div class="join-doctor-btn mt-2 mb-3 w-100 d-inline-block text-center">
              <a @click="showMoreHospitals()"  v-if="allHospitals.length > 5
              && hideButton==false" class="book-rounded bg-green text-white btn_padding d-inline-block">View more hospitals
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
  name: "HospitalSectionComponent",
  props: ['hospitals', 'patient', 'type', 'fileSystemDriver'],
  data() {
    return {
      search: '',
      hospitalsToShow: 5,
      allHospitals:this.hospitals,
      hideButton:false,
    }
  },
  created () {

  },
  methods:
  {
      showMoreHospitals(){
                    this.$parent.loading=true;
                    this.hospitalsToShow+=5;
                        axios.get('/hospitalShowMore/'+this.hospitalsToShow)
                    .then(response => {
                       if(this.allHospitals.length != response.data.length)
                       {
                          this.allHospitals=response.data;
                          console.log('thisco',this.hospitalsToShow);
                          console.log('alll',this.allHospitals);
                          this.$parent.loading=false;
                       }
                       else{
                         this.$parent.loading=false;
                         this.hideButton=true;
                              
                       }
                        
                    });             
                },
  },
}
</script>

<style scoped>

</style>