<template>

  <div>
    <div v-if="screenSize === 'Desktop'" class="specalities">
      <div class=" w-100 mt-3 mb-3 mt-lg-4 mb-lg-0">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="speacialities-heading w-100 
              d-inline-block">
                <h2 class="mb-4 knockdoc-heading service-text">Top Specialities
                </h2>
              </div>
            </div>
          </div>
          <div class="col-12 text-center">
              <!-- <div v-if="screenSize === 'Mobile'" class="row mb-2">
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px">
                  <span>
                    <img v-lazy="'/uploads/specialities/generl-physician-slider.svg'" name="general-physician" alt="general-physician">
                  </span>
  
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">General Physician
                </span>
                <a href="general-physician-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>

              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px">
                  <span>
                    <img v-lazy="'/uploads/specialities/dermatologist-slider.svg'" name="dermatologist" alt="dermatologist">
                  </span>
  
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Dermatologist</span>
                <a href="dermatologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>

              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px">
                  <span>
                    <img v-lazy="'/uploads/specialities/gynecologist-slider.svg'" name="gynecologist" alt="gynecologist">
                  </span>
  
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Gynecologist</span>
                <a href="gynecologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>

              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px">
                  <span>
                    <img v-lazy="'/uploads/specialities/diabetologist-slider.svg'" name="diabetologist" alt="diabetologist">
                  </span>
  
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Diabetologist</span>
                <a href="diabetologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>

              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px">
                  <span>
                    <img v-lazy="'/uploads/specialities/eye-specilist-slider.svg'" name="ent-specialist" alt="ent-specialist">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Eye Specialist
                </span>
                <a href="ent-specialist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>

              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px">
                  <span>
                    <img v-lazy="'/uploads/specialities/pediatrician.svg'" name="child-specialist" alt="child-specialist">
                  </span>
  
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Child Specialist
                </span>
                <a href="pediatrician-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>

              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px">
                  <span>
                    <img v-lazy="'/uploads/specialities/psychology.svg'" name="psychologist" alt="psychologist">
                  </span>
  
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Psychologist</span>
                <a href="psychologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>

              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px">
                  <span>
                    <img v-lazy="'/uploads/specialities/radiotologist.svg'" name="radiologist" alt="radiologist">
                  </span>
  
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Radiologist</span>
                <a href="radiologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
            </div> -->

             <div v-if="screenSize === 'Desktop'" class="row row-inherit mb-2"> 
              <!-- <div v-for="(specialty, index) in specs" v-if="specialty.top === '1'" class="specalities-image col-lg col-md-3 col-5 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
									<span>
										<img v-if="specialty.image" v-lazy="'/uploads/specialities/'+specialty.image" :name="specialty.title" :alt="specialty.title">
										<img v-else v-lazy="'/uploads/specialities/default/speciality.svg'" :name="specialty.title" :alt="specialty.title">
									</span>
                </div>
                <span class="pt-2 pb-2 d-block text_14">{{ specialty.title }}</span>
                <span class="pt-2 pb-2 d-block text_14 urdu_font"> {{ specialty.urdu_title }} </span>
                <a :href="specialty.slug+'-in-pakistan'" class="circle_anchor position-absolute"></a>
              </div> -->

               <div class="specalities-image col-lg col-md-3 col-5 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                    <img v-lazy="basePath+'/uploads/specialities/generl-physician-slider.svg'" name="general-physician" alt="general-physician">
                </div>
                <span class="pt-2 pb-2 d-block text_14">General Physician</span>
                <a href="general-physician-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>

              <div class="specalities-image col-lg col-md-3 col-5 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                    <img v-lazy="basePath+'/uploads/specialities/dermatologist-slider.svg'" name="dermatologist" alt="dermatologist">
                </div>
                <span class="pt-2 pb-2 d-block text_14">Dermatologist</span>
                <a href="dermatologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>

              <div class="specalities-image col-lg col-md-3 col-5 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                    <img v-lazy="basePath+'/uploads/specialities/gynecologist-slider.svg'" name="gynecologist" alt="gynecologist">
                </div>
                <span class="pt-2 pb-2 d-block text_14">Gynecologist</span>
                <a href="gynecologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>

              <div class="specalities-image col-lg col-md-3 col-5 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                    <img v-lazy="basePath+'/uploads/specialities/diabetologist-slider.svg'" name="diabetologist" alt="diabetologist">
                </div>
                <span class="pt-2 pb-2 d-block text_14">Diabetologist</span>
                <a href="diabetologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>

              <div class="specalities-image col-lg col-md-3 col-5 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                    <img v-lazy="basePath+'/uploads/specialities/eye-specilist-slider.svg'" name="ent-specialist" alt="ent-specialist">
                </div>
                <span class="pt-2 pb-2 d-block text_14">Eye Specialist</span>
                <a href="ent-specialist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>

              <div class="specalities-image col-lg col-md-3 col-5 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                    <img v-lazy="basePath+'/uploads/specialities/pediatrician.svg'" name="child-specialist" alt="child-specialist">
                </div>
                <span class="pt-2 pb-2 d-block text_14">Child Specialist
                </span>
                <a href="pediatrician-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>

              <div class="specalities-image col-lg col-md-3 col-5 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                    <img v-lazy="basePath+'/uploads/specialities/psychology.svg'" name="psychologist" alt="psychologist">
                </div>
                <span class="pt-2 pb-2 d-block text_14">Psychologist</span>
                <a href="psychologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-5 col-sm-3 p-0">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                    <img v-lazy="basePath+'/uploads/specialities/radiotologist.svg'" name="radiologist" alt="radiologist">
                </div>
                <span class="pt-2 pb-2 d-block text_14">Radiologist</span>
                <a href="radiologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
            </div> 
            <div class="row mb-3">
              <div class="col-12">
                <div class="d-inline-block w-100 text-center">
                  <a href="/find-a-doctor-near-you" class="box_radius bg-green text-white p-2 btn_padding d-inline-block">
                      View All Specialities
                      <i aria-hidden="true" class="fa fa-arrow-right ml-2"></i>
                  </a>
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
  name: "SpecialitySectionComponent",
  props:['specialities', 'fileSystemDriver'],
   data(){
    return{
      screenSize:'',
      // colors:['allergy_circle','anesthesiology_circle','family_circle','emergency_circle','internal_circle','medical_circle','diagnostic_circle','dermatologist_circle'],
      specs:[],
     basePath:'',
    }
  },
  mounted()
  {
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
    this.updateScreenSize();
        window.addEventListener('resize', this.updateScreenSize);
  },
  beforeUnmount() {
        window.removeEventListener('resize', this.updateScreenSize);
      },
  created(){
      let i = this;
   this.specialities.forEach(function(e){
      if(e.top === '1'){

        i.specs.push(e);
      }
   })
  },
  methods:
  {
    updateScreenSize() {
          if (window.innerWidth < 768) {
            this.screenSize = 'Mobile';
          } else {
            this.screenSize = 'Desktop';
          }
        },
  },

}
</script>

<style scoped>

</style>