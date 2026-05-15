<template>
  <div>
    <section class="procedure-answer-question">
      <div class=" doctor_profile mt-5">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="heading-procedures">
                <h4 class="mb-3 mb-xs-0 text_black font-weight-bold text-center mt-3">
                  Top Trending Topics Answering And Questions
                </h4>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div v-if="index < specToShow" v-for="(specialty, index) in allspecialities" class="col-12 col-lg-3 col-md-4">
              <div class="procedure-trending text-center city-border mb-3">
                <a class="text_black text_14 w-100 d-inline-block p-2 bg-white text-truncate" :href="'/ask-a-doctor-online/speciality/'+specialty.slug">{{ specialty.title }}</a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="join-doctor-btn mb-3 mt-3 text-center">
                <a href="javascript:void(0)" v-if="allspecialities.length > 8 && allspecialities.length > specToShow-1" @click="specToShow += 8" class="rounded-pill bg-blue text-white p-2 btn_padding d-inline-block">
                  Show more topics
                  <i class="fa fa-arrow-right ml-2" aria-hidden="true"></i>
                </a>
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
  name: "TrendingSectionComponent",
  props: ['specialities'],
  data() {
    return {
      specToShow: 8,
      allspecialities: this.specialities,
    }
  },
  async created() {
    const specs = await axios.get('/get-all-specialities-health-forum')
    this.allspecialities = Object.freeze(specs.data)
  },
  methods: {}
}
</script>

<style scoped>

</style>