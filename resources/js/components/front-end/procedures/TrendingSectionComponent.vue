<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="heading-procedures-list-pakistan w-100 d-inline-block">
            <h2 class="font-weight-bold mt-3 mb-3 service-text 
            mb-xs-1 text_20 text-xs-18">Surgeries cost list in Pakistan
          </h2>
            <span class="service-text text_18 text-xs-15">Trending Surgeries </span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center mt-3 ml-xs-0 ml-sm-0 ml-md-0 ml-lg-2">
          <div class="row">
            <div v-for="(trending , index) in trendings " v-if="trending.top === '1' && index < 6" class="specalities-image col-lg col-md-4 col-6 col-sm-3 p-0">
              <div :class="colors[index]" class=" p-2 m-auto rounded-circle h_90 w_90px d-table">
									<span class="d-table-cell align-middle">
                    <img v-if="trending.image"  v-lazy="basePath+'/uploads/procedure/'+ trending.image" :alt="trending.title" :name="trending.title">
                      <img v-else  v-lazy="basePath+'/uploads/procedure/default/procedure.svg'" :alt="trending.title" :name="trending.title">
									</span>
              </div>
              <span class="pt-2 pb-2 d-block text_14 m-auto w-80 service-text">
              {{ trending.title }}</span>
              <a :href="'/surgeries/'+trending.cities[0].slug+'/'+trending.slug" class="circle_anchor position-absolute">
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="join-doctor-btn mb-4 w-100 mt-xs-2 mb-xs-2 d-inline-block text-center mt-3">
            <a href="#all-procedure-section" @click="scrollToClass" class="book-rounded bg-green text-white p-2 btn_padding d-inline-block">View All Surgeries
              <i class="fa fa-arrow-right ml-3" aria-hidden="true">
              </i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "TrendingSectionComponent",
  props: ['procedures', 'cities', 'fileSystemDriver'],
  data() {
    return{
      basePath:'',
      trendings: [],
      selectedLocation: [],
      colors:['bg-coronary','bg-normal','bg-kidny','bg-coronary','bg-bypass','bg-angiography'],
      trendings:[]
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
  created () {
    let self = this
    this.procedures.forEach(function (procedure){
      if (procedure.top === '1') {
        self.trendings.push(procedure)
      }
    })
    let i = this;
   this.trendings.forEach(function(e){
      if(e.top === '1'){

        i.trendings.push(e);
      }
   })
  },
  methods: {
    scrollToClass() {
      let el = document.querySelector('.all-procedure-section')
      let rect = el.getBoundingClientRect()
      window.scrollTo(rect.left, rect.top)
    },
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
</style>