<template>
  <div>
    <section class="health-problem-in-pakistan">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="heading-health-problem-pakistan text-center mt-0 mt-lg-5 mb-xs-3 ">
              <h2 class="font-weight-bold text_xs_25">Common Health Articles in Pakistan</h2>
              <span class="text_14">Consult a doctor online for any health issue
						</span>
            </div>
          </div>
        </div>
        <div class="row mt-lg-5 mt-3 mt-xs-1">
          <div v-if="index < showSymptoms" v-for="(article, index) in articles" class="col-12 mb-lg-5 col-lg-4 col-md-6 col-sm-6 mb-4">
            <div class="patient-problem-image w-90 w-xs-100 d-inline-block">
              <a :href="'/health-articles/'+article.slug">
                 <img v-lazy="'uploads/users/'+article.author.id+'/articles/'+article.image" :alt="article.image" :name="article.image" class="img-fluid w-100 blog_img_border health_articles">
              </a>
              <div class="patient-problem-content bg-white
						box_shadow w-100 d-inline-block p-2 skin_box_radius">
                <a class="text_black d-block font-weight-bold text_14" :href="'/health-articles/'+article.slug">{{ article.title }}</a>
<!--                <p class="text_black text_12">Starting 600 Rs</p>-->
                <!-- <a class="theme-color-text font-weight-bold float-right text_12 mr-2" :href="'/service/'+article.slug">
                  Consult now
                  <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a> -->
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="join-doctor-btn mt-0 mt-lg-2 mb-3 mb-lg-0 text-center">
              <a v-if="articles.length > 12 && showSymptoms < articles.length" @click="showSymptoms += 3" class="rounded-pill knockdoc_btn_bg text-white p-2 btn_padding d-inline-block">
                View all articles
                <i class="fa fa-arrow-right ml-2" aria-hidden="true">
                </i>
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
  name: "CommonHealthProblemsSectionComponent",
  props: ['allarticles'],
  data() {
    return {
      showSymptoms: 9,
      articles: this.allarticles,
    }
  },
    async created() {
    const article = await axios.get('/all-articles')
    this.articles = Object.freeze(article.data)
  },
}
</script>

<style scoped>

</style>