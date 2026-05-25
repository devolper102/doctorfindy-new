<template>
    <div>
        <div class="w-100 d-inline-block speciality-bg-image pb-3">
            <div class="container">
              <div v-if="this.bread_crumb_data && this.bread_crumb_data.length" class="row">
                  <div class="col-12">
                    <ul  class="w-100 d-inline-block bread-crumb-listing">
                  <li v-for="(breadcrumbs,index) in this.bread_crumb_data" class="float-left">
                    <a v-if="index === 0" class="text-white text_12" :href="breadcrumbs.url">
                      {{breadcrumbs.title}}
                    </a>
                    <a v-else class="text-white text_12 speciality-bread" :href="breadcrumbs.url">
                      {{breadcrumbs.title}}
                    </a>
                  </li>
                </ul>
                  </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="w-100 d-inline-block 
                        text-center pt-3 pb-3">
                            <h1 class="font-weight-bold text-white text_30 text-xs-20">
                                Find And Book The Right Health Care Specialist Online
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                      <div class="w-100 d-inline-block mb-2">
                          <p class="text-white text_13">
                            Last Updated On {{moment().format("dddd")}},
                                {{ moment().format("MMMM") }} {{ moment().format("DD") }}, {{ moment().format("YYYY") }}
                          </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="w-100 d-inline-block mt-3">
                        <h2 class="service-text text_30">
                            Popular Specialties
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 specalities-main">
            <div class="row">
                <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality w-xs-75px h_xs_75">
                  <span>
                    <img :src="basePath+'/images/generl-physician-slider.svg'" alt="pictire">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">
                  General Physician
                </span>
                <a href="general-physician-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality w-xs-75px h_xs_75">
                  <span>
                    <img :src="basePath+'/images/dermatologist-slider.svg'" alt="pictire">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Dermatologist
                </span>
                <a href="dermatologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality w-xs-75px h_xs_75">
                  <span>
                    <img :src="basePath+'/images/gynecologist-slider.svg'" 
                    alt="pictire">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Gynecologist
                </span>
                <a href="gynecologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality w-xs-75px h_xs_75">
                  <span>
                    <img :src="basePath+'/images/diabetologist-slider.svg'" 
                    alt="pictire">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">Diabetologist
                </span>
                <a href="diabetologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality w-xs-75px h_xs_75">
                  <span>
                    <img :src="basePath+'/images/eye-specilist-slider.svg'" 
                    alt="pictire">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">
                  Eye Specialist
                </span>
                <a href="ent-specialist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality w-xs-75px h_xs_75">
                  <span>
                    <img :src="basePath+'/images/pediatrician.svg'" 
                    alt="pictire">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">
                  Child Specialist
                </span>
                <a href="pediatrician-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality w-xs-75px h_xs_75">
                  <span>
                    <img :src="basePath+'/images/psychology.svg'" alt="pictire">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">
                  Psychologist
                </span>
                <a href="psychologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality w-xs-75px h_xs_75">
                  <span>
                    <img :src="basePath+'/images/radiotologist.svg'" 
                    alt="pictire">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14 text-xs-11">
                  Radiologist
                </span>
                <a href="radiologist-in-pakistan" class="circle_anchor position-absolute"></a>
              </div>
            </div>
        </div>
        </div>
        <div class="row">
          <div class="col-12 specalities-main">
             <other-doctor
                    :doctors="doctors"
                    :user="user"
                    :fileSystemDriver="fileSystemDriver"
            ></other-doctor>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import moment from 'moment';
export default {
  name: "SpecialtiesBannerComponent",
  props:['doctors','user','bread_crumb_data', 'fileSystemDriver'],
data(){
    return{
      moment:moment,
      basePath:'',
    }
  },
  created() {
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  methods: {


  },

};

</script>

<style>

</style>