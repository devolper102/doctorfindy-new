  <template>
  <div>
    <section class="top-city-and-trending-doctor-in-pakistan">
      <div class="container">
        <div class="heading-doctor-in-pakistan mt-3 w-100 
        d-inline-block">
          <h2 class="font-weight-bold mb-0 text_xs_20 service-text">Top Hospitals of Pakistan</h2>
        </div>
        <div class="row">
          <div class="col-12 mt-3">
            <div class="row">
              <div v-for="(location, index) in topHospitals" class="specalities-image col-lg col-md-4 col-6 col-sm-3 mb-4 text-center mb-lg-5">
                <div class="doctor-in-pakistan pt-2 pb-2 bg-white w-80 w-sm-100 d-inline-block position-relative float-left">
                  <div :class="index === 0 ? ' red_circle ' : index === 1 ? ' green_circle ' : index === 2 ? ' blue_circle ' : index === 3 ? ' red_circle ' : index === 4 ? ' green_circle ' : index === 5 ? ' blue_circle ' : index === 6 ? ' red_circle ' : index === 7 ? ' green_circle ' : '' " class=" p-2 m-auto rounded-circle w_90px h_90 w-sm-70px h-sm-70 d-table hospital-circle">
  									<span class="d-table-cell align-middle">
  										<img v-lazy="basePath+'/uploads/locations/'+location.flag" :alt="location.title" :name="location.title">
  									</span>
                  </div>
                  <span class="pt-2 d-block text-xs-13 text_12 font-weight-bold service-text">{{ location.title }}</span>
                  <a :href="'/hospitals/'+location.slug" class="circle_anchor position-absolute"></a>
                  </a>
                </div>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-12">
                <div class="join-doctor-btn mt-4 mb-4 w-100 mt-xs-0 d-inline-block text-center">
                  <a href="#" class="rounded-pill bg-green text-white p-2 btn_padding d-inline-block w-25 mr-4 w-sm-60">View all hospitals
                    <i class="fa fa-arrow-right ml-3" aria-hidden="true">
                    </i>
                  </a>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "TopLocationsSectionComponent",
  props: ['cities', 'type', 'fileSystemDriver'],
  data() {
    return {
      search: '',
      topHospitals: [],
      locations: [],
      basePath:'',
    }
  },
  computed: {},
  mounted()
  {
    // console.log('check',this.cities);
  },
  created () {
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
    let self = this
    self.cities.forEach(function (location) {
      if(location.top === '1') {
        self.topHospitals.push(location)
      }
    })
    // console.log('vhave',this.topHospitals);
  }

}
</script>

<style scoped>

</style>