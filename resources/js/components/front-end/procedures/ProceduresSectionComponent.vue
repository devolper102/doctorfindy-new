<template>
  <div>
    <section id="all-procedure-section" class="top-city-doctor-in-pakistan all-procedure-section ">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="heading-procedures mt-3">
              <h2 v-if="type === 'hospitals'" class="mb-3 service-text text_20 text-xs-18"> Other Hospitals Cities </h2>
              <h2 v-else-if="type === 'location'" class="mb-3 mt-lg-0 mt-3 service-text text_20 text-xs-18"> Other Cities Doctors of Pakistan 
              </h2>
              <h2 v-else class="mb-3 mb-xs-0 service-text text_20 text-xs-18"> All Surgeries</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="w-100 d-inline-block mb-4">
              <div class="row">
                <div class="col-12">
                  <form class="form-inline d-lg-flex w-55 w-md-100 m-auto">
          <!--           <div v-if="type !== 'location' && type !== 'hospitals'" class="input-group location_input w-20">
                      <input type="text" class="form-control rounded-pill mr-3 text_14" id="location_Search" data-toggle="dropdown" placeholder="Location" aria-expanded="false">
                      <span>
                        <i class="fa fa-map-marker fa-sm" aria-hidden="true"></i>
                      </span>
                    </div> -->
                    <div class="input-group w-100 search_main" id="simple_search">
                      <input name="search" v-model="search" type="text" class="form-control banner_input text_14 bg-white box-shadow book-rounded" id="main_Search" :placeholder="'Search ' + type" data-toggle="dropdown" aria-expanded="false">
                      <span class="input-group-btn 
                      mobile_search_btn">
                        <span v-if="type === 'hospitals'">
                        <a href="/all-hospitals" class="bg-green book-rounded book-padding text-white 
                        text_14" type="button">Search
                          <span>
                            <i class="fa fa-search fa-sm" aria-hidden="true"></i>
                          </span>
                        </a>
                        </span>
                        <span v-else-if="type === 'location'">
                        <a href="/all-doctors" class="bg-green book-rounded book-padding text-white 
                        text_14" type="button">Search
                          <span>
                            <i class="fa fa-search fa-sm" aria-hidden="true"></i>
                          </span>
                        </a>
                        </span>
                        <span v-else>
                          <a href="/surgeries" class="bg-green book-rounded book-padding text-white 
                        text_14" type="button">Search
                          <span>
                            <i class="fa fa-search fa-sm" aria-hidden="true"></i>
                          </span>
                        </a>
                        </span>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
              <div class="row mt-4">
                <div v-if="index < proceduresToShow" v-for="(procedure, index) in filteredList" class="col-12 col-lg-3 col-md-4">
                  <div class="all-procedure text-center city-border mb-3">
                    <a v-if="type === 'location'" class="text_black text_14 w-100 d-inline-block 
                    p-2 text_md_12" style="text-overflow:ellipsis;" :href="'/doctors/'+procedure.slug">{{ procedure.title }}</a>
                    <a v-else-if="type === 'hospitals'" class="text_black text_14 w-100 d-inline-block 
                    p-2 text_md_12" style="text-overflow:ellipsis;" :href="'/hospitals/'+procedure.slug">{{ procedure.title }}</a>
                    <a v-else class="text_black text_14 w-100 d-inline-block p-2 text_md_12" style="text-overflow:ellipsis;" :href="'/surgeries/'+procedure.cities[0].slug+'/'+procedure.slug">{{ procedure.title }}</a>
                  </div>
                </div>
                <!-- <div class="text-center w-100">
                  <a href="javascript:void(0)" v-if="filteredList.length > 8 && filteredList.length > proceduresToShow-1" @click="proceduresToShow += 8" 
                     class="more-reviews bg-green text-white book-rounded text_14 d-inline-block">View more
                  </a>
                </div> -->
                <span v-if="filteredList.length === 0">No Result Found...</span>
              </div>
            </div>
          </div>
        </div>

          <!-- Popular labs internal linking-->
        <!-- <div v-if="this.cities.length!==0" class="w-100 d-inline-block mb-3">
            <div class="row mt-4">
              <div class="col-12">
                <div class="heading-allergy-immunology w-100 d-inline-block">
                  <h2 class="text_black font-weight-bold text_20 text-xs-18">Popular Labs</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <ul class="disease-allergy-immunology w-100 d-inline-block patient-date">
                  <li v-for="lab in labs" class=" mr-lg-3 mb-3 w-md-48 text-center d-table float-left">
                    <a class="pt-1 pb-1 pl-2 pr-2 text_black d-table-cell align-middle" :href="'/lab/'+lab.location.slug+'/'+lab.slug">{{lab.first_name+' '+lab.last_name}}</a>
                  </li>
                </ul>
              </div>
            </div>
        </div> -->
        <!-- End -->

        


      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "ProceduresSectionComponent",
  props: ['procedures', 'type','cities','specialities','labs','cities_pakistan'],
  data() {
    return {
      search: '',
      proceduresToShow: 12,
      // allprocedures: this.procedures,
    }
  },
  computed: {
    filteredList() {
      return this.procedures.filter(post => {
        return post.title.toLowerCase().includes(this.search.toLowerCase())
      })
    }
  },
  created() {
    // console.log('cscs',this.cities.length);
  }
  // async created() {
  //   console.log('all procedures',this.procedures,this.type)
  //   const spe = await axios.get('/get-all-locations')
  //   this.allprocedures = Object.freeze(spe.data)
  // }
}
</script>

<style>
#simple_search .banner_input{
  padding: 0.62rem 6rem 0.77rem 0.75rem !important;
}
</style>