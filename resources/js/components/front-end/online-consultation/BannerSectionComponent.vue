<template>
  <div>
  <!--    <div class="container">
        <div class="row">
              <div class="col-12 mt-4">
                <bread-crumb-spec></bread-crumb-spec>
              </div>
        </div>
    </div> 
 -->    <div class="bg-video-consultation">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8 col-12">
          <div class="banner_left_section">
            <div class="banner_heading">
              <h1><span class="contst_text">Online</span> <span class="text-xs-25"> Video Consultation</span></h1>
              <p class="text-white">Increase online traffic for your practice.</p>
            </div>
            <div class="form-inline d-block d-lg-none mb-3">
              <!-- banner_input -->
              <div class="form-control dummyinput p-2 text_10 w-sm-90 w-md-100 d-table position-relative" data-toggle="modal" data-target="#search_doctor_on_device"> Search for doctors, hospitals, specialties, services ...
                <div class=" text_14 position-absolute mobile_search_btn">
                  <span class="text_black">
                    <i class="fa fa-search fa-sm" aria-hidden="true"> </i>
                  </span>
                </div>
              </div>
              <!-- btn knockdoc_btn_bg banner_btn p-2 text-white text_14 position-absolute mobile_search_btn -->
            </div>
            <form class="form-inline d-xs-none d-sm-none d-md-none d-lg-flex">
              <div class="banner_location input-group location_input position-relative">

                <search-location-input
                    :locations = "allcities"
                >
                </search-location-input>
                <span class="position-absolute"><i aria-hidden="true" class="fa fa-map-marker fa-sm"></i></span>
              </div>

              <div id="online-consultation-search" class="input-group w-70 search_main d-inline-block ml-2">
                  <main-search-page
                    :docs = "doctors"
                    :hosp = "hospitals"
                    :labs = "laboratories"
                    :dise = "diseases"
                    :special = "specialities"
                    :service = "services"
                    :locations = "allcities"
                  ></main-search-page>
                <span class="input-group-btn btn_position border-0">
                  <a href="/doctors" class="btn bg-green banner_btn text-white text_14 h_45" type="button">Search
                    <span>
                      <i class="fa fa-search fa-sm" aria-hidden="true"></i>
                    </span>
                  </a>
                </span>
              </div>
            </form>
            <div class="search-below-text">
              <p class="text-white mt-4 mb-5 text_20">No Need to
                <strong> Travel.</strong> Every time you go to visit your<strong> doctor,
                </strong></p>
            </div>
            <div class="join-doctor-btn d-inline-block mb-xs-3 mb-sm-3 mb-md-3 w-100 pb-lg-0 pb-3">
              <a href="/practice-as-doctor" class="rounded-pill knockdoc_doctor_profile_btn knockdoc_btn_bg text-white d-inline-block text-center">Join as a Doctor
              </a>
            </div>
          </div>
        </div>
        <div class="col-4 d-xs-none d-md-none d-sm-none d-lg-block">
          <div class="video-consultation-image mt-5">
            <img class="w-90" src="images/video-consultation-image.png" alt="video-consultation-image picture">
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Modal fo search Doctor on small devices -->
    <div class="modal fade" id="search_doctor_on_device" tabindex="-1" aria-hidden="true" >
      <div class="modal-dialog m-0">
        <div class="modal-content">
          <div class="modal-header border-0 pb-2 pt-1">
            <span class="text-center w-100 text_18 pt-1">Search</span>
            <a href="/doctors"type="button" class="close p-0 w_33px h_30 text-white rounded-circle bg-white border-2 mt-1 mr-1 text-right" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="text_black">&times;</span>
            </a>
          </div>
          <div class="modal-body pl-2 pr-2 pt-0 pb-0">
            <search-location-input
                :locations = "allcities"
            >
            </search-location-input>
              <main-search-page
                    :docs = "doctors"
                    :hosp = "hospitals"
                    :labs = "laboratories"
                    :dise = "diseases"
                    :special = "specialities"
                    :service = "services"
                    :locations = "allcities"
              ></main-search-page>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal fo search Doctor on small devices -->

  </div>
</template>

<script>
export default {
  props:[ 
    'specialitys',
    'servicess',
    'cities',
    'logged_user',
    'managements',
    'doctorss',
    'hospitalss',
    'diseasess',
    'laboratorys',
 ],
  name: "BannerSectionComponent",
  data() {
    return {
      selectedLocation: [],
      resultSegments: this.segments,
      specialities: this.specialitys,
      doctors: this.doctorss,
      hospitals: this.hospitalss,
      diseases: this.diseasess,
      services: this.servicess,
      laboratories: this.laboratorys,
      allcities: this.cities,
    }
  },
  async created() {
    const specs = await axios.get('/all-spec')
    this.specialities = Object.freeze(specs.data)

    const doc = await axios.get('/all-docs')
    this.doctors = Object.freeze(doc.data) 

    const hosp = await axios.get('/all-hosp')
    this.hospitals = Object.freeze(hosp.data)

    const dis = await axios.get('/all-dise')
    this.diseases = Object.freeze(dis.data)
    
    const labs = await axios.get('/all-labs')
    this.laboratories = Object.freeze(labs.data)

    const sev = await axios.get('/all-services')
    this.services = Object.freeze(sev.data)

    const city = await axios.get('/all-cities')
    this.allcities = Object.freeze(city.data)

    
    let i = this;
    this.specialities.forEach(function(e){
      if(e.top === '1'){
        i.specs.push(e);
      }
    })
  },
  methods: {

  }
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
#search_doctor_on_device #autosuggest input{
  border-radius: 0px !important;
  margin-bottom: 10px !important;
  padding-right: 5rem;
  padding: 1.375rem .75rem;
}
#search_doctor_on_device .autosuggest__results-container {
    width: 100% !important;
    left: 0px !important;
    top: 110px !important;
}
#search_doctor_on_device .autosuggest__results{
  max-height: 100vh;
  overflow-y: auto !important;
}
#autosuggest .autosuggest__results-container{
    width: 84% !important;
    min-width: 8rem !important;
}
#autosuggest .form-control:focus {
    color: #232426;
}
.disease_search .autosuggest__results {
    overflow-y: autp;
  }
.autosuggest__results ul{
  margin: 0px !important;
}
@media (max-width: 991px){
  .banner_heading span{
    font-size: 27px;
  }
  .banner_heading{
    color: #fff;
  }
  .mobile_search_btn {
    top: 8px;
  }
  #autosuggest .autosuggest__results-container{
    width: 100% !important;
  }
  #autosuggest .form-control:focus {
    color: #232426;
    border: 1px solid #ced4da !important;
  }
}
</style>