<template>
  <div>
  	<div class="container">
  		<div class="row">
  			<div class="col-12">
  				<!-- Popular labs -->
        <div v-if="this.labs.length > 0" class="w-100 d-inline-block mt-3 mb-3">
            <div class="row">
              <div class="col-12">
                <div class="heading-allergy-immunology">
                  <h2 class="text-blue font-weight-bold text_20 text-xs-15">Popular Labs</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <ul class="disease-allergy-immunology w-100 d-inline-block patient-date">
                  <li v-for="lab in labs" class=" mr-lg-3 mb-3 w-md-48 text-center float-left">
                    <a class="pt-1 pb-1 pl-2 pr-2 text_black d-inline-block" :href="'/lab/'+lab.location.slug+'/'+lab.slug">{{lab.first_name+' '+lab.last_name}}</a>
                  </li>
                </ul>
              </div>
            </div>
        </div>
        <!-- End -->
        <!-- Best doctors in cities -->
   <!--    <div class="w-100 pb-2" v-if="specialities.length !== 0 && cities.length!==0">
          <div class="row">
            <div v-for="(location, index) in cities" v-if="location.top === '1' && index < 6" class="col-lg-3 col-md-4 col-12 col-sm-6 mt-lg-0 mt-md-0 mb-0 mb-lg-3 mb-md-3">
              <div class="accordion md-accordion visible" :id="'doctor_cities_'+location.slug" role="tablist" aria-multiselectable="true">
               
                <div class="card_main card border-0">

                  <div class="card-header p-0 heading-doctor-city-pakistan bg-white" role="tab" :id="location.slug">
                    <a data-toggle="collapse" :data-parent="'#doctor_cities_'+location.slug" :href="'#doctors_in_'+location.slug" aria-expanded="true" :aria-controls="'#doctors_in_'+location.slug" class="p-2 d-inline-block w-100 collapsed pl-0 pr-0 text_black font-weight-bold">Doctors in {{ location.title }}</a>
                  </div>

                  <div :id="'doctors_in_'+location.slug" class="collapse show" role="tabpanel" :aria-labelledby="location.slug" :data-parent="'#doctor_cities_'+location.slug">
                    <div class="card-body p-2">
                      <ul class="navbar-nav doctor-hospital-city">
                        <li v-for="specialty in specialities" class="nav-item">
                          <a class="nav-link p-0 text_black" :href="specialty.slug+'-in-'+location.slug">
                          Best {{ specialty.title }} in {{ location.title }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link p-0 text_black" :href="'/lab-tests-in-'+location.slug">
                            Book a Lab Test in {{ location.title }}</a>
                        </li>

                      </ul>
                    </div>
                  </div>

                </div>

              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-12 col-sm-6 mt-lg-0 mt-md-0 mb-0 mb-lg-3 mb-md-3">
              <div class="accordion md-accordion visible" :id="'doctor_cities_pakistan'" role="tablist" aria-multiselectable="true">
                
                <div class="card_main card border-0">

                 
                  <div class="card-header p-0 heading-doctor-city-pakistan bg-white" role="tab" :id="'doctor_cities_pakistan'">
                    <a data-toggle="collapse" :data-parent="'#doctor_cities_pakistan'" :href="'#doctors_in_pakistan'" aria-expanded="true" :aria-controls="'#doctors_in_pakistan'" class="p-2 d-inline-block w-100 collapsed pl-0 pr-0 text_black font-weight-bold">Book a Lab Test in Pakistan</a>
                  </div>
                  
                  <div :id="'doctors_in_pakistan'" class="collapse show" role="tabpanel" :aria-labelledby="'Pakistan'" :data-parent="'#doctor_cities_pakistan'">
                    <div class="card-body p-2">
                      <ul class="navbar-nav doctor-hospital-city">
                        <li v-for="city in cities_pakistan" class="nav-item">
                          <a class="nav-link p-0 text_black" :href="'lab-tests-in-'+city.slug">
                            Book a Lab Test in {{ city.title }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link p-0 text_black" :href="'/book-a-lab-test'">
                            Book a Lab Test in Pakistan</a>
                        </li>
                      </ul>
                    </div>
                  </div>

                </div>

              </div>
            </div>

            <div class="col-lg-3 col-md-4 col-12 col-sm-6 mt-lg-0 mt-md-0 mb-0 mb-lg-3 mb-md-3">
              <div class="accordion md-accordion visible" :id="'lab_in_pakistan'" role="tablist" aria-multiselectable="true">

                <div class="card_main card border-0">


                  <div class="card-header p-0 heading-doctor-city-pakistan bg-white" role="tab" :id="'lab_in_pakistan'">
                    <a data-toggle="collapse" :data-parent="'#lab_in_pakistan'" :href="'#labs_in_pakistan'" aria-expanded="true" :aria-controls="'#labs_in_pakistan'" class="p-2 d-inline-block w-100 collapsed pl-0 pr-0 text_black font-weight-bold">Top Labs in Pakistan</a>
                  </div>

                  <div :id="'labs_in_pakistan'" class="collapse show" role="tabpanel" :aria-labelledby="'lab_in_pakistan'" :data-parent="'#lab_in_pakistan'">
                    <div class="card-body p-2">
                      <ul class="navbar-nav doctor-hospital-city">
                        <li v-for="city in cities" class="nav-item">
                          <a class="nav-link p-0 text_black" :href="'/labs/'+city.slug">Best 
                           Labs in {{ city.title }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link p-0 text_black" :href="'/find-a-lab-near-you'">View all 
                           Top Labs in Pakistan</a>
                        </li>
                      </ul>
                    </div>
                  </div>

                </div>

              </div>
            </div>

          </div>
      </div> -->
  			</div>
  		</div>
  	</div>
  </div>
</template>

<script>
export default {
  name: "internal-linkingComponent",
  props: ['labs','cities','specialities','cities_pakistan'],
}
</script>

<style scoped>

</style>