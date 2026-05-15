<template>
  <div>
    <section class="benifites-knockdock">
      <div class="w-100 d-inline-block pb-4 pb-lg-4 benifites_bg">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="heading-benifites-knockdock">
                <h2 class="font-weight-bold mt-3 mb-lg-5 mb-xs-4">Benefits of DoctorFindy</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
              <div class="main-search-consultant-content w-100 d-flex mt-4">
                <div class="search-consultant-image bg-white box_shadow box_radius h_90 w_90px float-left d-table">
					 			<span class="w-100 d-table-cell align-middle text-center m-0">
					 				<img class="w-60" src="images/doctor 1.png" alt="doctor 1
					 				 picture">
					 			</span>
                </div>
                <div class="search-consultant-text float-left ml-3 mt-4">
                  <p class="text_black text_15 font-weight-bold">Advances new business models</p>
                </div>
              </div>
              <div class="main-search-consultant-content w-100 d-flex mt-4">
                <div class="search-consultant-image bg-white box_shadow box_radius h_90 w_90px float-left d-table">
					 			<span class="w-100 d-table-cell align-middle text-center m-0">
					 				<img class="w-60" src="images/expand-image.png" alt="expand-image picture">
					 			</span>
                </div>
                <div class="search-consultant-text float-left ml-3 mt-4">
                  <p class="text_black text_15 font-weight-bold">Expands access to care and reach more patients.</p>
                </div>
              </div>
              <div class="main-search-consultant-content w-100 d-flex mt-4">
                <div class="search-consultant-image bg-white box_shadow box_radius h_90 w_90px float-left d-table">
					 			<span class="w-100 d-table-cell align-middle text-center m-0">
					 				<img class="w-60" src="images/increase-image.png" alt="increase-image picture">
					 			</span>
                </div>
                <div class="search-consultant-text float-left ml-3 mt-4">
                  <p class="text_black text_15 font-weight-bold">Increases practice revenue</p>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-5 offset-lg-1 mt-lg-0 mt-xs-3 mt-sm-3 mt-md-0">
              <div class="main-search-consultant-content w-100 d-flex mt-4">
                <div class="search-consultant-image bg-white box_shadow box_radius h_90 w_90px float-left d-table">
					 			<span class="w-100 d-table-cell align-middle text-center m-0">
					 				<img class="w-60" src="images/monitor-image.png" alt="monitor-image picture">
					 			</span>
                </div>
                <div class="search-consultant-text float-left ml-3 mt-4">
                  <p class="text_black text_15 font-weight-bold">Improves patient engagement with remote monitoring.</p>
                </div>
              </div>
              <div class="main-search-consultant-content w-100 d-flex mt-4">
                <div class="search-consultant-image bg-white box_shadow box_radius h_90 w_90px float-left d-table">
					 			<span class="w-100 d-table-cell align-middle text-center m-0">
					 				<img class="w-60" src="images/clinical-image.png" alt="clinical-image picture">
					 			</span>
                </div>
                <div class="search-consultant-text float-left ml-3 mt-4">
                  <p class="text_black text_15 font-weight-bold">Improves clinical workflows and increases practice efficiency</p>
                </div>
              </div>
              <div class="main-search-consultant-content w-100 d-flex mt-4">
                <div class="search-consultant-image bg-white box_shadow box_radius h_90 w_90px float-left d-table">
					 			<span class="w-100 d-table-cell align-middle text-center m-0">
					 				<img class="w-60" src="images/healthcare-image.png" alt="healthcare-image picture">
					 			</span>
                </div>
                <div class="search-consultant-text float-left ml-3 mt-4">
                  <p class="text_black text_15 font-weight-bold">Improves healthcare quality.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "BenefitSectionComponent",
  props:['managements'],
  data() {
    return {
      services: '',
      benefits: '',
    }
  },
  computed: {},
  created () {
     this.services = this.managements.find(pf =>pf.meta_key ==='services_tab_sec')
     this.benefits = JSON.parse(this.services.meta_value);
  },
  mounted () {},
  methods:{},

}
</script>

<style>

</style>