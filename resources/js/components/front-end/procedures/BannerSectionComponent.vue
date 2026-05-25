<template>
  <div>
  
    <section class="bg-list-doctor-pakistan">
      <div class="bg-procedure-network w-100 d-inline-block pb-3" 
      :style="{ 'background-image': 'url('+basePath+'/uploads/settings/home/' + image + ')' }" v-if="hide_show === 'true'">
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
              <div class="bg-title-doctor-in-pakistan w-100 d-inline-block pt-3 p-3">
                <h1 class="text-white text-center mt-xs-5
							mb-xs-5 text_30 text-xs-25">{{title}}</h1>
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
    </section>
      <!--   <div class="container">
          <div class="row">
                <div class="col-12 mt-4">
                  <bread-crumb-spec></bread-crumb-spec>
                </div>
          </div>
    </div>  -->
    
  </div>
</template>

<script>
import moment from 'moment';
export default {
name: "BannerSectionComponent",
 props:['managements','segments','bread_crumb_data', 'fileSystemDriver'],
 data() {
    return {
      procedure_banner: '',
      title: '',
      image: '',
      hide_show: '',
      resultSegments: this.segments,
      moment:moment,
      basePath:'',
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
    created() {
  
      this.procedure_banner = this.managements.find(pf =>pf.meta_key ==='procedure_banner_section')
      this.title = JSON.parse(this.procedure_banner.meta_value).heading;
      this.image = JSON.parse(this.procedure_banner.meta_value).hidden_procedure_banner_img;
      this.hide_show = JSON.parse(this.procedure_banner.meta_value).show_procedure_banner_sec;
  },
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