<template>
  <div>
<!-- <div class="container">
      <div class="row">
            <div class="col-12 mt-4">
              <bread-crumb-spec></bread-crumb-spec>
            </div>
      </div>
    </div>  -->
    <!-- Start Articles on Skin Care -->
    <section class="articles-skin-care">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-12 box_shadow bg-skin-care pb-lg-0 pb-3">
            <aside class="p-0 w-100 d-inline-block mt-3">
            <div class="w-100 d-inline-block">
              <div class="arrow-right w-100 d-inline-block">
                <a class="text_black float-right rounded-circle w-45px h_45 text_20" href="/health-articles/categories/">
                  <i class="fa fa-arrow-left" aria-hidden="true"></i>

                </a>
              </div>
              <div class="heading-sidebar w-100 float-left 
              mt-5">
                <h1 class="text_black w-auto float-lg-right float-left">{{ category.title }}</h1>
                <div class="w-100 d-inline-block">
                  <span class="text_black text_20 float-lg-right float-left mt-lg-0 mt-3">{{ category.articles.length }} Articles
									</span>
                </div>
              </div>
              <div class="text-skin-care w-100 d-inline-block mt-2">
                <p class="text_black text_14 w-70 float-lg-right float-left w-md-100">
                  {{category.abstract}}
                </p>
              </div>
            </div>
            </aside>
          </div>
          <div class="col-lg-9 col-12">
            <div class="heading-skin-hair-care mt-5 mb-5" style="margin-left: 30px;">
              <h4 class="text_black font-weight-bold">Articles on {{ category.title }}</h4>
            </div>
            <div v-for="article in category.articles">
              <div class="row mb-4 ml-lg-3">
              <div class="col-lg-3 col-12">
                <div class="eyes-image w-100 h-100 d-inline-block">
                  <img class="img-fluid" v-lazy="basePath+'/uploads/users/'+article.author_id+'/articles/'+article.image" :alt="article.author.first_name+' '+article.author.last_name">
                </div>
              </div>
              <div class="col-lg-9 col-12">

                <div class="eyes-treatment w-100 d-inline-block pt-2 pb-2">
                  <div class="main-treatment w-100 d-inline-block">
                  <h6 class="text_black font-weight-bold"> {{ article.title }} </h6>
                  <span class="text_black text_15">By:</span>
                  <span class="theme-color-text text_15">{{ article.author.first_name }} {{ article.author.last_name }}</span>
                  <p class="text_black text_15 mt-2">{{ article.short_description }}</p>
                </div>
                  <div class="read-more-btn w-100 d-inline-block mt-3">
                    <a class="theme-color-text" :href="'/health-articles/'+article.slug">READ MORE</a>
                  </div>
                </div>

              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Articles on Skin Care -->
  </div>
</template>

<script>
export default {
  name: "CategoryDetailSectionComponent",
  props: ['category','segments', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      details: [],
      search: '',
      show: false,
      resultSegments: this.segments,
    }
  },
  computed: {},
  created () {
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
    this.category.articles.forEach(function (article){
      // console.log(article)
    })
  },
  mounted () {},
  methods:{
    showRelatedArticels(category) {
      let self = this
      self.selectedCategory = category
      category.articles.forEach(function (article) {
        self.relatedArticles.push(article)
      })
    }
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
    height:162px !important;
    background-repeat: no-repeat;
  }
</style>