<template>
  <div>
    <!-- style="background-image: url(../../images/surgerie-bg-image.png)" -->
    <div class="surgerie-bg-image">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mt-lg-2 mb-lg-2 mt-0 mb-3 mt-small">
            <div class="surgeries_head w-100 d-inline-block">
              <h2 class="knockdoc-heading service-text">
              Surgeries</h2>
            </div>
          </div>
        </div>
        <div class="row scroll-flow">
          <div class="col-md-12">
            <ul class="surgerie_categories d-inline-block mb-0 mt-2 mt-lg-0">
              <!-- <li v-for="(procedure, index) in procedures" 
              v-if="procedure.top === '1' && index < 6" 
              v-on:mouseenter="item = procedure.id" 
              v-on:mouseleave="item = ''" 
              class="float-left float-xs-none w-11 w-sm-100 d-inline-block bg-white box_shadow mb-4 box_radius surgerie-box w-xs-45 w-md-30 w-sm-30">
                <a v-bind:href="'/surgeries/'+procedure.cities[0].slug+'/'+procedure.slug" class="text_black d-table w-100 p-2">
                  <div class="w-100 d-inline-block text-center">
                    <div :class="colors[index]" class="p-2 m-auto rounded-circle h_75 w_75px d-table border-white border-3 surgeries-box">
                    <span class="d-inline-block text-center">
                      <img v-if="procedure.image" class="img-fluid w_50px overflow-hidden" v-lazy="'/uploads/procedure/'+ procedure.image" :alt="procedure.title" :name="procedure.title">
                      <img v-else class="img-fluid w_50px overflow-hidden" v-lazy="'/uploads/procedure/default/procedure.svg'" :alt="procedure.title" :name="procedure.title">
                    </span>
                  </div>
                  </div>
                  <span class="d-inline-block w-100 text-center text_12 font-weight-bold text-blue">{{procedure.title}}</span>
                </a>
              </li> -->
              <li class="float-left float-xs-none w-11 w-sm-100 d-inline-block bg-white box_shadow mb-3 box_radius surgerie-box w-xs-45 w-md-30 w-sm-30">
                <a href="/surgeries/lahore/kidney-transplant" class="text_black d-table w-100 p-2">
                  <div class="w-100 d-inline-block text-center">
                    <div :class="colors[0]" class="p-2 m-auto rounded-circle h_75 w_75px d-table border-white border-3 surgeries-box">
                    <span class="d-inline-block text-center">
                      <img class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/kidney-transplant.svg'" alt="kidney-transplant" name="kidney-transplant">
                    </span>
                  </div>
                  </div>
                  <span class="d-inline-block w-100 text-center text_12 font-weight-bold text-blue">Kidney Transplant</span>
                </a>
              </li>
              <li class="float-left float-xs-none w-11 w-sm-100 d-inline-block bg-white box_shadow mb-3 box_radius surgerie-box w-xs-45 w-md-30 w-sm-30">
                <a href="/surgeries/lahore/normal-delivery" class="text_black d-table w-100 p-2">
                  <div class="w-100 d-inline-block text-center">
                    <div :class="colors[1]" class="p-2 m-auto rounded-circle h_75 w_75px d-table border-white border-3 surgeries-box">
                    <span class="d-inline-block text-center">
                      <img class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/normal-delivery.svg'" alt="normal-delivery" name="normal-delivery">
                    </span>
                  </div>
                  </div>
                  <span class="d-inline-block w-100 text-center text_12 font-weight-bold text-blue">Normal Delivery</span>
                </a>
              </li>
              <li class="float-left float-xs-none w-11 w-sm-100 d-inline-block bg-white box_shadow mb-3 box_radius surgerie-box w-xs-45 w-md-30 w-sm-30">
                <a href="/surgeries/gujranwala/hernia-surgery" class="text_black d-table w-100 p-2">
                  <div class="w-100 d-inline-block text-center">
                    <div :class="colors[2]" class="p-2 m-auto rounded-circle h_75 w_75px d-table border-white border-3 surgeries-box">
                    <span class="d-inline-block text-center">
                      <img class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/hernia-surgery.svg'" alt="hernia-surgery" name="hernia-surgery">
                    </span>
                  </div>
                  </div>
                  <span class="d-inline-block w-100 text-center text_12 font-weight-bold text-blue">Hernia Surgery</span>
                </a>
              </li>
              <li class="float-left float-xs-none w-11 w-sm-100 d-inline-block bg-white box_shadow mb-3 box_radius surgerie-box w-xs-45 w-md-30 w-sm-30">
                <a href="/surgeries/gujranwala/liver-transplant" class="text_black d-table w-100 p-2">
                  <div class="w-100 d-inline-block text-center">
                    <div :class="colors[3]" class="p-2 m-auto rounded-circle h_75 w_75px d-table border-white border-3 surgeries-box">
                    <span class="d-inline-block text-center">
                      <img class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/liver-transplant.svg'" alt="liver-transplant" name="liver-transplant">
                    </span>
                  </div>
                  </div>
                  <span class="d-inline-block w-100 text-center text_12 font-weight-bold text-blue">Liver Transplant</span>
                </a>
              </li>
              <li class="float-left float-xs-none w-11 w-sm-100 d-inline-block bg-white box_shadow mb-3 box_radius surgerie-box w-xs-45 w-md-30 w-sm-30">
                <a href="/surgeries" class="text_black d-table w-100 p-2">
                  <div class="w-100 d-inline-block text-center">
                    <div :class="colors[4]" class="p-2 m-auto rounded-circle h_75 w_75px d-table border-white border-3 surgeries-box">
                    <span class="d-inline-block text-center">
                      <img class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/prp-hair-transplnt.svg'" alt="prp-hair-transplant" name="prp-hair-transplant">
                    </span>
                  </div>
                  </div>
                  <span class="d-inline-block w-100 text-center text_12 font-weight-bold text-blue">PRP Hair Treatment</span>
                </a>
              </li>
              <li class="float-left float-xs-none w-11 w-sm-100 d-inline-block bg-white box_shadow mb-3 box_radius surgerie-box w-xs-45 w-md-30 w-sm-30">
                <a href="/surgeries/lahore/bypass-surgery" class="text_black d-table w-100 p-2">
                  <div class="w-100 d-inline-block text-center">
                    <div :class="colors[5]" class="p-2 m-auto rounded-circle h_75 w_75px d-table border-white border-3 surgeries-box">
                    <span class="d-inline-block text-center">
                      <img class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/uploads/procedure/bypass.svg'" alt="by-pass" name="by-pass">
                    </span>
                  </div>
                  </div>
                  <span class="d-inline-block w-100 text-center text_12 font-weight-bold text-blue">ByPass Surgery</span>
                </a>
              </li>
              <li class="float-left float-xs-none w-11 w-sm-100 d-inline-block bg-white box_shadow mb-3 box_radius surgerie-box w-xs-45 w-md-30 w-sm-30">
                <a href="/surgeries" class="text_black d-table w-100 p-2">
                  <div class="w-100 d-inline-block text-center">
                    <div :class="colors[6]" class="p-2 m-auto rounded-circle h_75 w_75px d-table border-white border-3 surgeries-box">
                    <span class="d-inline-block text-center">
                      <img class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/images/root-canal.svg'" alt="root-canal" name="root-canal">
                    </span>
                  </div>
                  </div>
                  <span class="d-inline-block w-100 text-center text_12 font-weight-bold text-blue">Root Canal</span>
                </a>
              </li>
              <li class="float-left float-xs-none w-11 w-sm-100 d-inline-block bg-white box_shadow mb-3 box_radius surgerie-box w-xs-45 w-md-30 w-sm-30">
                <a href="/surgeries" class="text_black d-table w-100 p-2">
                  <div class="w-100 d-inline-block text-center">
                    <div :class="colors[7]" class="p-2 m-auto rounded-circle h_75 w_75px d-table border-white border-3 surgeries-box">
                    <span class="d-inline-block text-center">
                      <img class="img-fluid w_50px overflow-hidden" v-lazy="basePath+'/images/appendix.svg'" alt="appendix-surgery" name="appendix-surgery">
                    </span>
                  </div>
                  </div>
                  <span class="d-inline-block w-100 text-center text_12 font-weight-bold text-blue">Appendix Surgery</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
             <div class=" d-inline-block w-100 text-center">
                <a href="/surgeries" class="box_radius bg-green text-white p-2 btn_padding d-inline-block">
                  View All Surgeries
                  <i class="fa fa-arrow-right ml-2" aria-hidden="true"></i>
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SurgeriesAndProceduresComponent",
  props:[
    'procedures', 'fileSystemDriver'
  ],
  data: function () {
    return {
      colors:['BypassGrafting_circle','KidneyDialysis_circle','Cholecystectomy_circle','BypassGrafting_circle','NormalDelivery_circle','KidneyDialysis_circle','Cholecystectomy_circle','NormalDelivery_circle'],
      color: 'white',
      item: '',
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
    
  }
}
</script>

<style scoped>

</style>