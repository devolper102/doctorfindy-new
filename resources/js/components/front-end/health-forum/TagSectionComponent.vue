<template>
  <div>
    <section class="explore-question-tags">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="heading-explore-question">
              <h6 class="text_black font-weight-bold mb-3">Explore our Questions</h6>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="doctor-specialiety-btn d-flex d-lg-block overflow-sm-auto overflow-md-auto text_nowrap">
              <a :href="'/ask-a-doctor-online/speciality/'+specialty.slug" v-for="(specialty,index) in allspecialities" class="text_14 bg-doctor-section rounded-pill mr-2 mb-3 d-inline-block bg-doctor-section-btn"v-if="index < specialityToShow">
                {{ specialty.title }}
              </a>
            </div>
          </div>
        </div>
         <div class="row">
            <div class="col-12">
              <div class="join-doctor-btn mb-3 mt-3 text-center">
                <a href="javascript:void(0)" v-if="allspecialities.length > 8 && allspecialities.length > specialityToShow-1" @click="specialityToShow += 8" class="rounded-pill knockdoc_btn_bg text-white p-2 btn_padding d-inline-block">
                  Show more tags
                  <i class="fa fa-arrow-right ml-2" aria-hidden="true"></i>
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
  name: 'TagSectionComponent',
  props: ['allspecialities'],
  data() {
    return {
      specialityToShow: 8,
    }
  }
}
</script>

<style scoped>

</style>