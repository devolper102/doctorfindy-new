<template>

  <div>
    <div class="doctor-hospital">
      <div class="doctor-hospital-bg-image">
        <div class="container">
          <div class="row mt-0 mt-lg-3 mb-3 mb-lg-0">
            <div class="col-md mb-3 mb-lg-0">
              <div class="heading-doctor-in-pakistan mt-lg-0 mt-3 mb-3 mb-lg-4 text-center">
                <h2 class="knockdoc-heading">TOP DOCTORS IN PAKISTAN</h2>
              </div>
              <div class="row mobile_design">
                
                <div v-for="(location, index) in cities"  v-if="location.top === '1'" class="col-4 text-center mb-lg-4 mt-3 mb-3">
                  
                  <div class="doctor-in-pakistan box_shadow bg-white p-2 d-inline-block 
                  position-relative">
                    <div  class=" p-2 m-auto rounded-circle w_90px h_90 w-sm-60px h-sm-60 d-table cities_circle">
										<span class="d-table-cell align-middle">
											<img v-if="location.flag" v-lazy="basePath+'/uploads/locations/'+ location.flag" :alt="location.title" :name="location.title"  />
											<img v-else v-lazy="basePath+'/uploads/locations/default/location.svg'" :name="location.title"  />
										</span>
                    </div>
                    <span class="pt-2 pb-2 d-block font-weight-bold text-xs-13">{{location.title}}</span>
                    <a v-bind:href="'/doctors/'+ location.slug" class="circle_anchor position-absolute"></a>
                  </div>
                </div>
            
                <div class="join_now_btn text-center w-100">
								<span class="d-inline-block">
									<a href="/doctors" class="rounded-pill knockdoc_btn_bg text-white p-2 btn_padding mt-3 mt-lg-4 d-inline-block">View all Doctors
										<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i>
									</a>
								</span>
                </div>
              </div>
            </div>
            <div class="col-2 d-none d-lg-block">
              <div class="border-vertical">
                <span></span>
              </div>
            </div>
            <div class="col-md mt-sm-3 mt-xs-3 mb-xs-3 mt-sm-3 mb-sm-3 mt-md-0 mb-md-3 mt-lg-0">
              <div class="heading-doctor-in-pakistan mt-lg-0 mt-3 mb-3 mb-lg-4 text-center">
                <h2 class="knockdoc-heading">TOP HOSPITALS IN PAKISTAN</h2>
              </div>
              <div class="row mobile_design">
                <div v-for="(location, index) in cities" v-if="location.top === '1'" class="col-4 text-center mb-lg-4 mt-3 mb-3">
                  <div  class="doctor-in-pakistan box_shadow bg-white p-2 d-inline-block position-relative">
                    <div  class="p-2 m-auto rounded-circle w_90px h_90 w-sm-60px h-sm-60 d-table cities_circle">
										<span class="d-table-cell align-middle">
											<img v-if="location.flag" v-lazy="basePath+'/uploads/locations/'+ location.flag" :alt="location.title" :name="location.title"  />
											<img v-else v-lazy="basePath+'/uploads/locations/default/location.svg'" :name="location.title"  />
										</span>
                    </div>
                    <span class="pt-2 pb-2 d-block font-weight-bold text-xs-13">{{location.title}}</span>
                    <a v-bind:href="'/hospitals/'+ location.slug" class="circle_anchor position-absolute"></a>
                  </div>
                </div>
            
             
                <div class="join_now_btn text-center w-100">
								<span class="d-inline-block">
									<a href="/hospitals" class="rounded-pill knockdoc_btn_bg text-white p-2 btn_padding mt-3 mt-lg-4 d-inline-block">View all Hospitals
										<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i>
									</a>
								</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
export default {
name: "TopDoctorHospitalSectionComponent",
props:[
    'locations', 'fileSystemDriver'
  ],
  data(){
    return{
      colors:['red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle'],
     basePath:'',
      cities:[],
    }
  },
  mounted(){
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  created() {
    let i = this;
   this.locations.forEach(function(e){
      if(e.top === '1'){

        i.cities.push(e);
      }
   })
   
  }
}
</script>

<style scoped>

</style>