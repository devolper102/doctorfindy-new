<template>
  <div>
    <div class="doctor-city">
      <div class="w-100 mb-3">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="accordion_heading mt-4 d-inline-block w-100">
                <h2 class="knockdoc-heading service-text">Find Doctors and Hospitals by city
                </h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div v-for="(location, index) in cities" v-if="location.top === '1'" class="col-lg-3 col-md-4 col-12 col-sm-6 mt-lg-0 mt-md-0 mb-0 mb-lg-3 mb-md-3 mt-3">
              <div class="accordion md-accordion" :id="'doctor_cities_'+location.slug" role="tablist" aria-multiselectable="true">
                <!-- Accordion card -->
                <div class="card_main card border-0">

                  <!-- Card header -->
                  <div class="card-header p-0 heading-doctor-city-pakistan bg-white" role="tab" :id="location.slug">
                    <a data-toggle="collapse" :data-parent="'#doctor_cities_'+location.slug" :href="'#doctors_in_'+location.slug" aria-expanded="true" :aria-controls="'#doctors_in_'+location.slug" class="p-2 d-inline-block w-100 collapsed pl-0 pr-0 service-text font-weight-bold">Doctors in {{ location.title }}</a>
                  </div>
                  <!-- Card body -->
                  <div :id="'doctors_in_'+location.slug" class="collapse" role="tabpanel" :aria-labelledby="location.slug" :data-parent="'#doctor_cities_'+location.slug">
                    <div class="card-body p-2">
                      <ul class="navbar-nav doctor-hospital-city">
                        <li v-for="specialty in location.specialities" class="nav-item zoom-text-speciality">
                          <a class="nav-link p-0 text_black text_13" :href="specialty.slug+'-in-'+location.slug">
                            {{ specialty.title }} in {{ location.title }}
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>

                </div>
                <!-- Accordion card -->
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
  name: "DoctorByCitySectionComponent",
  props:['specialities', 'cities'],
  data() {
    return {
    }
  },
  created() {
  },
  methods:{
  },
}
</script>

<style scoped>
[data-toggle="collapse"]:after {
    float: right !important;
}
</style>