<template>
  <div>

    <!-- Start section doctor disease -->
    <section class="doctor-disease">
      <div class="container">
        <div class="row">
          <div class="col-12 mt-4">
            <form>
              <div class="input-group w-40 float-right m-auto d-block search_main overflow-hidden w-xs-100 w-sm-100 
              w-md-100">
                <input v-model="search" type="text" class="form-control pl-5 text_14 w-100 float-left h_40" id="main_Search" placeholder="Search for disease" data-toggle="dropdown" aria-expanded="false">
                <span class="input-group-btn">
                <a href="/all-doctors"class="btn banner_btn text_black text_14 h_45" type="button">
                <span>
              <i class="fa fa-search fa-sm" aria-hidden="true"></i>
              </span>
                </a>
                </span>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mt-3">
          </div>
        </div>
    <!--        <div class="row">
          <div class="col-12 mt-4">
            <bread-crumb-spec></bread-crumb-spec>
          </div>
        </div> -->
        <div class="w-100 d-inline-block mt-3 mb-3">
          <div v-if="service.diseases.length > 0" v-for="service in filteredList">
            <div class="row">
              <div class="col-12">
                <div class="heading-allergy-immunology">
                  <h6 class="text-blue font-weight-bold">{{ service.title }}</h6>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <ul class="w-100 d-inline-block patient-date mb-0">
                  <li v-for="disease in service.diseases" class=" mr-lg-3 mb-3 w-md-48 text-center float-left w-xs-100">
                    <a class="pt-1 pb-1 pl-2 pr-2 text_black w-100 d-inline-block" :href="'/diseases/'+disease.slug">
                      <span class="w-95 d-inline-block 
                      text-truncate" style="margin-top: 5px;">
                        {{ disease.title }}
                      </span>
                      <i aria-hidden="true" class="fa fa-angle-right float-right" 
                      style="margin-top: 10px;"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <span v-if="filteredList.length === 0">No Result Found...</span>
        </div>
                <!-- Popular labs -->
        <div v-if="this.laboratories.length > 0" class="w-100 d-inline-block">
            <div class="row">
              <div class="col-12">
                <div class="heading-allergy-immunology">
                  <h2 class="text-blue font-weight-bold text_20 text-xs-15">Popular Labs</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <ul class="w-100 d-inline-block patient-date mb-0">
                  <li v-for="lab in laboratories" class=" mr-lg-3 mb-3 w-md-48 text-center float-left w-xs-100">
                    <a class="pt-1 pb-1 pl-2 pr-2 text_black w-100 d-inline-block" :href="'/lab/'+lab.location.slug+'/'+lab.slug">
                      <span class="w-95 d-inline-block 
                      text-truncate" style="margin-top: 5px;">
                        {{lab.first_name+' '+lab.last_name}}
                      </span>
                      <i aria-hidden="true" class="fa fa-angle-right float-right" 
                      style="margin-top: 10px;"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
        </div>
        <!-- End -->
                    <!-- Popular Hospitals -->
        <div v-if="this.topHospitals.length > 0" class="w-100 d-inline-block mb-3">
            <div class="row">
              <div class="col-12">
                <div class="heading-allergy-immunology">
                  <h2 class="text-blue font-weight-bold text_20 text-xs-15">Popular Hospitals</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <ul class="w-100 d-inline-block patient-date mb-0">
                  <li v-for="hospital in topHospitals" class=" mr-lg-3 mb-3 w-md-48 text-center float-left w-xs-100">
                    <a class="pt-1 pb-1 pl-2 pr-2 text_black w-100 d-inline-block" :href="'/hospitals/'+hospital.location.slug+'/'+hospital.slug">
                      <span class="w-95 d-inline-block 
                      text-truncate" style="margin-top: 5px;">
                    {{hospital.first_name+' '+hospital.last_name}}
                  </span>
                      <i aria-hidden="true" class="fa fa-angle-right float-right" 
                      style="margin-top: 10px;"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
        </div>
        <!-- End -->
        <!-- Best doctors in cities -->
    <!--   <div class="w-100 pb-2" v-if="specialities.length !== 0 && cities.length!==0">
          <div class="row">
            <div v-for="(location, index) in cities" v-if="location.top === '1'" class="col-lg-3 col-md-4 col-12 col-sm-6 mt-lg-0 mt-md-0 mb-0 mb-lg-3 mb-md-3">
              <div class="accordion md-accordion visible" :id="'doctor_cities_'+location.slug" role="tablist" aria-multiselectable="true">
                <div class="card_main card border-0">

                  <div class="card-header p-0 heading-doctor-city-pakistan bg-white" role="tab" :id="location.slug">
                    <a data-toggle="collapse" :data-parent="'#doctor_cities_'+location.slug" :href="'#doctors_in_'+location.slug" aria-expanded="true" :aria-controls="'#doctors_in_'+location.slug" class="p-2 d-inline-block w-100 collapsed pl-0 pr-0 text_black font-weight-bold">Doctors in {{ location.title }}</a>
                  </div>
                  <div :id="'doctors_in_'+location.slug" class="collapse show" role="tabpanel" :aria-labelledby="location.slug" :data-parent="'#doctor_cities_'+location.slug">
                    <div class="card-body p-2">
                      <ul class="navbar-nav doctor-hospital-city">
                        <li v-for="specialty in specialities" class="nav-item">
                          <a class="nav-link p-0 text_black" :href="specialty.slug+'-in-'+location.slug">Best 
                            {{ specialty.title }} in {{ location.title }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link p-0 text_black" :href="'lab-tests-in-'+location.slug">
                            Book Lab Test in {{ location.title }}</a>
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
                    <a data-toggle="collapse" :data-parent="'#doctor_cities_pakistan'" :href="'#doctors_in_pakistan'" aria-expanded="true" :aria-controls="'#doctors_in_pakistan'" class="p-2 d-inline-block w-100 collapsed pl-0 pr-0 text_black font-weight-bold">Book Test in Pakistan</a>
                  </div>
                  <div :id="'doctors_in_pakistan'" class="collapse show" role="tabpanel" :aria-labelledby="'Pakistan'" :data-parent="'#doctor_cities_pakistan'">
                    <div class="card-body p-2">
                      <ul class="navbar-nav doctor-hospital-city">
                        <li v-for="city in cities_pakistan" class="nav-item">
                          <a class="nav-link p-0 text_black" :href="'lab-tests-in-'+city.slug">
                            Book a Lab Test in {{ city.title }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link p-0 text_black" :href="'book-a-lab-test'">
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
                    <a data-toggle="collapse" :data-parent="'#lab_in_pakistan'" :href="'#labs_in_pakistan'" aria-expanded="true" :aria-controls="'#labs_in_pakistan'" class="p-2 d-inline-block w-100 collapsed pl-0 pr-0 text_black font-weight-bold">Labs in Pakistan</a>
                  </div>
                  <div :id="'labs_in_pakistan'" class="collapse show" role="tabpanel" :aria-labelledby="'lab_in_pakistan'" :data-parent="'#lab_in_pakistan'">
                    <div class="card-body p-2">
                      <ul class="navbar-nav doctor-hospital-city">
                        <li v-for="city in cities_pakistan" class="nav-item">
                          <a class="nav-link p-0 text_black" :href="'lab-tests-in-'+city.slug">Best 
                            Labs in {{ city.title }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link p-0 text_black" :href="'find-a-lab-near-you'">View all 
                            Labs in Pakistan</a>
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
    </section>
    <!-- End section -->
  </div>
</template>

<script>
export default {
  name: "DiseaseListingSectionComponent",
  props: ['specialities', 'segments','cities','laboratories','topHospitals','cities_pakistan'],
  data() {
    return {
      details: [],
      search: '',
      specs: [],
      diseases: [],
      resultSegments: this.segments,
      allspecialities: this.specialities,
    }
  },
  computed: {
    filteredList() {
      let result = false
      let self = this
        return this.allspecialities.filter(disease => {
          result = false
          disease.diseases.forEach(disease => {
            if (disease.title.toLowerCase().includes((self.search).toLowerCase())) {
              return result = true
            }
          })
          return result
        })
    }
  },
  async created() {
    const sev = await axios.get('/get-all-diseases')
    this.allspecialities = Object.freeze(sev.data)
  },
  mounted () {},
  methods:{},
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