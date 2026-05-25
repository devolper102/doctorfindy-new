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
                                Find and Book Best Doctors to Fight With Your Diseases
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
                            Popular Diseases
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 specalities-main">
            <div class="row">
                <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                  <span>
                    <img :src="basePath+'/images/diabetologist-slider.svg'" alt="pictire">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14">Diabetes
                </span>
                <a href="/diseases/diabetes-insipidus" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                  <span>
                    <img :src="basePath+'/images/slider-blood-pressure.svg'" alt="pictire">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14">High Blood Pressure
                </span>
                <a href="/cardiologist-in-lahore" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                  <span>
                    <img :src="basePath+'/images/skin-diseases-image.svg'" alt="pictire">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14">Skin Diseases
                </span>
                <a href="/diseases/skin-diseases" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                  <span>
                    <img :src="basePath+'/images/heart-pain.svg'" alt="pictire">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14">Hearth Diseases
                </span>
                <a href="/diseases/heart-diseases" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                  <span>
                    <img :src="basePath+'/images/slider-pregnancy.svg'" alt="pictire">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14">Pregnancy
                </span>
                <a href="/gynecologist-in-lahore" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                  <span>
                    <img :src="basePath+'/images/acne-image.svg'" alt="pictire">
                  </span>
  
                </div>
                <span class="pt-2 pb-2 d-block text_14">Acne
                </span>
                <a href="/diseases/acne" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                  <span>
                    <img :src="basePath+'/images/piles-image.svg'" 
                    alt="pictire">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14">Piles
                </span>
                <a href="/diseases/piles" class="circle_anchor position-absolute"></a>
              </div>
              <div class="specalities-image col-lg col-md-3 col-3 col-sm-3 p-0 text-center">
                <div class="m-auto rounded-circle h_90 w_90px border-speciality">
                  <span>
                    <img :src="basePath+'/images/asthma-image.svg'" 
                    alt="pictire">
                  </span>
                </div>
                <span class="pt-2 pb-2 d-block text_14">Asthma
                </span>
                <a href="/diseases/asthma" class="circle_anchor position-absolute"></a>
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
  name: "DiseaseBannerComponent",
  props:['doctors','user','bread_crumb_data', 'fileSystemDriver'],
data(){
    return{
      basePath:'',
       moment:moment,
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