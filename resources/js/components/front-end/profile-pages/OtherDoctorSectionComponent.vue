<template>
  <div>
    <div class="pb-4 w-100 d-inline-block">
      <div v-if="blogPage === false" class="container">
        <div v-if="profilePage === true && blogPage === false" class="row">
          <div class=" mt-xl-3 mt-4 col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h5 class="text_black font-weight-bold text_16 mb-0">Similar Doctors</h5>
          </div>
        </div>
        <div v-else class="row">
          <div class=" mt-xl-3 mt-4 col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h5 class="text-blue font-weight-bold text_16 mb-0">Trending Doctors</h5>
          </div>
        </div>
        <div class="row d-block">
            
              <doctor-card
                  :fileSystemDriver="fileSystemDriver"
                  :doctors="doctors"
                  :user="user"
              ></doctor-card>
            </div>
            <div v-if="profilePage === true  && blogPage === false" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-4">
                <div class="feedback-btn text-center">
                 <a class="btn_padding text-white rounded-pill text_15 d-inline-block bg-green" href="/doctors">View more doctors <i aria-hidden="true" class="fa fa-arrow-right ml-3"></i></a>
                </div>
            </div>
        </div>
        <div v-if="blogPage === true && selected_category && selected_category.speciality" class="container">
        <div class="row">
          <div class=" mt-xl-3 mt-4 col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h5 class="text-blue font-weight-bold text_16 mb-0">Trending {{selected_category.speciality.title}} Specialist</h5>
          </div>
        </div>
        <div class="row d-block">
            
              <doctor-card
                  :doctors="doctors"
                  :user="user"
                  :fileSystemDriver="fileSystemDriver"
              ></doctor-card>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-4">
                <div class="feedback-btn text-center">
                 <a class="btn_padding text-white rounded-pill text_15 d-inline-block bg-green" :href="selected_category.speciality.slug+'-in-pakistan'">View more doctors <i aria-hidden="true" class="fa fa-arrow-right ml-3"></i></a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "OtherDoctorSectionComponent",
  props: ['doctors', 'user','selected_category', 'fileSystemDriver'],
  data() {
    return {
      profilePage:true,
      blogPage:false,
    }
  },
  created () {
    const currentUrl = window.location;
    if(currentUrl.pathname === '/diseases' || currentUrl.pathname === '/find-a-doctor-near-you' || currentUrl.pathname === '/treatments')
      {
        this.profilePage=false;
      }
      else if(currentUrl.pathname === '/health-articles/categories')
      {
        this.blogPage=true;
      }
      else
      {
        this.profilePage=true;
      }
  },
}
</script>

<style scoped>

</style>