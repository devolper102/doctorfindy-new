<template>
  <div>
    <div class="container" v-if="get_procedures.procedures.length">
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="heading-procedures-list-pakistan">
            <h2 class="font-weight-bold mt-3 mb-3 text_black 
            mb-xs-1 text-xs-18 text_20">Surgeries  cost list in {{get_procedures.title}}
          </h2>
           <!--  <span class="text_black text_20">Trending Procedures</span> -->
          </div>
        </div>
        <div class="col-lg-6 col-12">
        <!--   <form class="form-inline float-lg-right float-left mt-3 w-80 w-md-100">
            <div class="input-group location_input dropdown ml-0 position-relative w-100 w-md-100 w-sm-100 float-right procedure_search">
              <span class="mt-3 mr-3 font-weight-bold">Change Location</span>
              <search-location-input
                class="w-70 procedure_locationInner position-relative"
                :locations = "cities"
              >
              </search-location-input>
              <span><i aria-hidden="true" class="fa fa-map-marker fa-sm content_location_icon"></i></span>
            </div>
          </form> -->
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center mt-3 ml-xs-0 ml-sm-0 ml-md-0 ml-lg-2">
          <div class="row">
            <div v-for="(procedure , index) in get_procedures.procedures " class="specalities-image col-lg col-md-4 col-6 col-sm-3 p-0" v-if="index < procedureToShow">
              <div :class="colors[index]" class=" p-2 m-auto rounded-circle h_90 w_90px d-table">
									<span class="d-table-cell align-middle">
                    <img v-if="procedure.image" v-lazy="basePath+'/uploads/procedure/'+ procedure.image"  :alt="procedure.title" />
                    <img v-else v-lazy="basePath+'/uploads/procedure/default/procedure.svg'"  :alt="procedure.title" />
									</span>
              </div>
              <span class="pt-2 pb-2 d-block text_14 m-auto w-80">{{ procedure.title }}</span>
              <a :href="'/surgeries/'+get_procedures.slug+'/'+procedure.slug" class="circle_anchor position-absolute">
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="join-doctor-btn mb-4 w-100 mt-xs-2 mb-xs-2 d-inline-block text-center mt-3">
            <a href="javascript:void(0)" v-if="get_procedures.procedures.length > 8 && get_procedures.procedures.length > procedureToShow-1" @click="procedureToShow += 8"  class="book-rounded bg-green text-white p-2 btn_padding d-inline-block">View more Surgeries
              <i class="fa fa-arrow-right ml-3" aria-hidden="true">
              </i>
            </a><!-- href="#all-procedure-section" @click="scrollToClass" -->
          </div>
        </div>
      </div>
    </div>
    <div class="container" v-else><h6 align="center">No surgeries</h6></div>
  </div>
</template>

<script>
export default {
  name: "CityProceduresSectionComponent",
  props: ['procedures', 'cities','get_procedures', 'fileSystemDriver'],
  data() {
    return{
      basePath:'',
      trendings: [],
      selectedLocation: [],
      colors:['bg-coronary','bg-normal','bg-kidny','bg-coronary','bg-bypass','bg-angiography','bg-kidny','bg-bypass'],
      procedureToShow: 8,
    }
  },
  mounted(){
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  created () {
    console.log('get_procedures',this.get_procedures)

  },
  methods: {
    // scrollToClass() {
    //   let el = document.querySelector('.all-procedure-section')
    //   let rect = el.getBoundingClientRect()
    //   window.scrollTo(rect.left, rect.top)
    // },
  }
}
</script>

<style>
.autosuggest__results-container {
    background: #fff;
    font-size: 16px;
    position: absolute;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border-radius: .25rem;
    float: left;
    min-width: 10rem;
    z-index: 99;
    width: 100%;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.34);
}
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