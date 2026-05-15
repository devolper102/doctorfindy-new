<template>
  <div>

    <!-- Start section all specialties  -->
    <section class="all-specialties">
      <div class="container">
        <div class="row mt-3">
          <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 col-12">
            <div class="heading-all-specialties w-100 
            d-inline-block">
              <h2 class="service-text text_30">All Specialties</h2>
            </div>
          </div>
          <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6 col-12 mt-xl-0 mt-3">
            <form>
              <div class="input-group w-75 float-right d-block search_main specialties-input mb-lg-2 mb-3 ml-auto mr-auto overflow-hidden w-xs-100 w-sm-100 w-md-100">
                <input v-model="search" type="text" class="form-control pl-5 text_14 w-100 float-left h_40 w-xs-100 w-sm-100 w-md-100" id="main_Search" placeholder="Search for Specialty" data-toggle="dropdown" aria-expanded="false">
                <span class="input-group-btn">
    						<a href="/all-doctors" class="btn banner_btn text_black text_14" type="button">
    						<span>
							<i class="fa fa-search fa-sm" aria-hidden="true"></i>
							</span>
    						</a>
  							</span>
              </div>
            </form>
          </div>
        </div>
   <!--      <div class="row">
          <div class="col-12 mt-4">
            <bread-crumb-spec></bread-crumb-spec>
          </div>
        </div> -->
        <div class="row">
          <div class="col-12">
            <div class="patient-doctor-box w-100 d-inline-block">
              <div class="row mt-4">
                <div v-for="(specialty, index) in filteredList" class="col-12 col-lg-3 col-md-4 col-sm-6">
                  <div class="all-procedure text-center city-border mb-3">
                    <a class="text_black text_13 w-100 d-inline-block pt-1 pb-1 pl-2 pr-2" :href="'/'+specialty.slug+'-in-pakistan'" style="text-overflow: ellipsis; overflow: hidden;">
                      <span class="w-95 d-inline-block text-truncate" style="margin-top: 5px;">
                        {{ specialty.title }}
                      </span>
                      <i class="fa fa-angle-right float-right" aria-hidden="true" style="margin-top:10px;">
                      </i>
                      <span class="text_13 d-block">
                        {{ specialty.users_count }} doctors available
                      </span>
                    </a>
                  </div>
                </div>
                <span v-if="filteredList.length === 0" >No Result Found...</span>
              </div>
            </div>
          </div>
        </div>
         
        <!-- popular labs internal linking -->
        <div class="w-100 d-inline-block mb-3">
            <div class="row">
              <div class="col-12">
                <div class="heading-allergy-immunology">
                  <h6 class="service-text font-weight-bold">Popular labs in Pakistan</h6>
                </div>
              </div>
            </div>
             <div class="row">
              <div class="col-12">
                <div class="mb-2 patient-doctor-box w-100 d-inline-block">
                  <div class="row mt-3">
                    <div v-for="lab in labs" class="col-12 col-lg-3 col-md-4 col-sm-6">
                      <div class="all-procedure text-center city-border mb-3">
                        <a class="text_black text_13 w-100 d-inline-block pt-1 pb-1 pl-2 pr-2" :href="'/labs/'+lab.location.slug" style="text-overflow: ellipsis; overflow: hidden;">
                          <span class="w-95 d-inline-block text-truncate" style="margin-top: 5px;">
                            {{ lab.first_name }}
                          </span>
                          <i class="fa fa-angle-right float-right" aria-hidden="true" style="margin-top: 10px;"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
    
          <!-- <span v-if="filteredList.length === 0">No Result Found...</span> -->
        </div>

                <!-- Best doctors in cities -->
     <!--  <div class="w-100 pb-2" v-if="specialities.length !== 0 && cities.length!==0">
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
                    <a data-toggle="collapse" :data-parent="'#doctor_cities_pakistan'" :href="'#doctors_in_pakistan'" aria-expanded="true" :aria-controls="'#doctors_in_pakistan'" class="p-2 d-inline-block w-100 collapsed pl-0 pr-0 text_black font-weight-bold">Book Lab Test in Pakistan</a>
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

  </div>
</template>

<script>
export default {
  name: 'SpecialtiesSectionComponent',
  props: ['specialities', 'type', 'segments','labs','cities_pakistan','cities'],
  data() {
    return {
      details: [],
      search: '',
      resultSegments: this.segments,
      allspecialties: this.specialities,
    }
  },
  mounted()
  {
    // console.log('seeeeda',this.specialities);
  },
  computed: {
    filteredList() {
      return this.allspecialties.filter(post => {
        return post.title.toLowerCase().includes(this.search.toLowerCase())
      })
    }
  },
 async created() {
    const spe = await axios.get('/get-all-specialities')
    this.allspecialties = Object.freeze(spe.data)
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

.all-procedure a{

  background-color:#dddddd;
  color:black;
}  
</style>