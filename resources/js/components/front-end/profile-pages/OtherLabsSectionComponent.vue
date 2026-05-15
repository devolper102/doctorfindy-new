<template>
  <div>
    <section class="other-hospital-in-lahore" v-if="otherLabs.length">
      <div class="container">
        <div class="row mt-2 mb-2">
          <div class="col-12 col-lg-12">
            <div class="heading-other-hispital">
              <h2 class="text-blue mb-0 text_20 font-weight-bold text-xs-15">Other Labs in {{user.location.title}}</h2>
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="col-12">
            <ul class="other-hospital-in-lahore mb-0 item_list">
              <li v-for="(lab,index) in otherLabs" v-if="index < labsToShow" class="d-inline-block align-middle item text-center w-md-100 mb-2 w-sm-100 w-md-100 mr-2 mr-lg-2">
                <a class="text_14 text_black w-100 d-inline-block" :href="'/lab/'+lab.location.slug+'/'+ lab.slug">
                  {{ lab.first_name }} {{ lab.last_name }}
                </a>
              </li>
            </ul>
          </div>
          <div class="col-12">
              <div class="mt-4 more_btn text-center d-inline-block w-100">
                <a  href="javascript:void(0)" v-if="otherLabs.length > 8 && otherLabs.length > labsToShow-1" @click="labsToShow += 8" class="d-inline-block text-center bg-blue book-rounded text-white text_14 text_md_12 book-padding"> View More Labs
                </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
name: "OtherLaboratorySectionComponent",
  props:['user'],
   data() {
    return {
      labsToShow: 8,
      otherLabs:[],
    }
  },
  created () {
    

  },
  mounted()
  {
    var id = this.user.location.id;
    var user_id = this.user.id;
    var self=this;
      setTimeout(function(){
        self.getOtherLabsInCity(id,user_id);
      },7000);
  },
  methods:
  {
    getOtherLabsInCity(id,user_id)
    {
      axios.get('/get-other-labs-in-location/'+id+'/'+user_id)
      .then((response)=>{
          this.otherLabs=response.data;
      });
    }
  }
}
</script>

<style scoped>

</style>