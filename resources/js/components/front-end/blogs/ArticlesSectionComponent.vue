<template>
  <div>
<!--       <div class="container">
      <div class="row">
            <div class="col-12 mt-4">
              <bread-crumb-spec></bread-crumb-spec>
            </div>
      </div>
    </div>  -->
    <div class="blog-main-slider w-100 d-inline-block position-relative">
      <VueSlickCarousel
      v-bind="c2Setting">
       <!--  <div>
          <div class="w-100 d-inline-block position-relative">
            <div class="w-20 d-inline-block position-absolute skin-content w-xs-30">
              <span class="text-white text_15 position-absolute skin-text text-xs-11">Skin Care</span>
            </div>
            <div class="w-20 text-center d-inline-block p-2 ride-box book-rounded position-absolute w-xs-50 w-md-45 ipad_25">
              <span class="text-white text_15 text-xs-11">How to get rid of pimples fast!</span>
            </div>
            <img class="w-100 d-inline-block" src="/images/blog-slide-image.svg">
          </div>
        </div>  -->
        <div v-for="(blog,index) in round_articles">
          <div class="w-100 d-inline-block position-relative">
            <div class="position-absolute w-100 d-inline-block">
          <div class="container">
            <div class="row">
              <div class="col-12 pl-xl-0">
                  <ul  class="w-100 d-inline-block bread-crumb-listing">
                  <li v-for="(breadcrumbs,index) in bread_crumb" class="float-left">
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
          </div>
        </div>
        <div class="position-relative skin-content-box">
          <div class="w-20 d-inline-block position-absolute 
          skin-content w-xs-30">
            <span class="text-white text_13 position-absolute 
            skin-text text-xs-11">{{blog.categories[0].title}}</span>
          </div>
        </div>
        <div class="position-relative categorey-box">
           <div class="w-40 text-center d-inline-block p-2 ride-box book-rounded position-absolute w-xs-50 w-md-45 ipad_25">
            <span class="text-white text_16 text-xs-11">{{blog.title}}</span>
          </div> 
        </div>
        <img class="w-100 d-inline-block" :src="basePath+'/uploads/users/1/articles/'+blog.background_img">
          </div>
        </div>     
      </VueSlickCarousel>
    </div>
    <section class="explore-more-topics">
      <div class="container-fluid">
        <div class="w-90 m-auto d-block w-xs-100 w-sm-100 w-md-100 w-ipad-100">
        <div class="row">
          <div class="col-12">
            <div class="w-100 d-inline-block mt-4 pl-xl-2">
              <h2 class="text_black text_20 text-xs-14 
              font-weight-bold">Categories</h2>
            </div>
            <div class="categories-blog-slider w-100 d-inline-block">
              <VueSlickCarousel 
              v-bind="c3Setting">
            <div v-for="(category, index) in categories" v-if="category.articles.length>0">
              <div class="col-12">
                <div class="row">
                  <div class="col-xl col-lg-12 col-md-12 col-12 col-sm-12 p-2">
                    <div @click="showSubCategories(category)" class="categories-slider-image float-left position-relative">
                      <a href="javascript:void(0)">
                        <span class="text-white text_14 text-xs-12 position-absolute w-100 d-inline-block text-center">
                          {{category.title}}
                        </span>
                        <img v-if="category.image" class="w-100 d-inline-block book-rounded" :src="basePath+'/images/'+category.image">
                        <img v-else class="w-100 d-inline-block book-rounded" :src="basePath+'/images/health-tips-image.svg'">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <!-- <div>
                <div class="col-12">
                  <div class="row">
                    <div class="col-xl col-lg-12 col-md-12 col-12 col-sm-12 p-2">
                      <div class="categories-slider-image float-left position-relative">
                        <span class="text-white text_14 position-absolute w-100 d-inline-block text-center">
                          Mental Health
                        </span>
                        <img class="w-100 d-inline-block book-rounded" src="/images/mental-health-image.svg">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="col-12">
                  <div class="row">
                    <div class="col-xl col-lg-12 col-md-12 col-12 col-sm-12 p-2">
                      <div class="categories-slider-image float-left position-relative">
                        <span class="text-white text_14 position-absolute w-100 d-inline-block text-center">
                          Diet & Nutrition
                        </span>
                        <img class="w-100 d-inline-block book-rounded" src="/images/nutrition-image.svg">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="col-12">
                  <div class="row">
                    <div class="col-xl col-lg-12 col-md-12 col-12 col-sm-12 p-2">
                      <div class="categories-slider-image float-left position-relative">
                        <span class="text-white text_14 position-absolute w-100 d-inline-block text-center">
                          Women's Health
                        </span>
                        <img class="w-100 d-inline-block book-rounded" src="/images/women-health-image.svg">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="col-12">
                  <div class="row">
                    <div class="col-xl col-lg-12 col-md-12 col-12 col-sm-12 p-2">
                      <div class="categories-slider-image float-left position-relative">
                        <span class="text-white text_14 position-absolute w-100 d-inline-block text-center">
                          General Health
                        </span>
                        <img class="w-100 d-inline-block book-rounded" src="/images/general-health-image.svg">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="col-12">
                  <div class="row">
                    <div class="col-xl col-lg-12 col-md-12 col-12 col-sm-12 p-2">
                      <div class="categories-slider-image float-left position-relative">
                        <span class="text-white text_14 position-absolute w-100 d-inline-block text-center">
                          Health Tips
                        </span>
                        <img class="w-100 d-inline-block book-rounded" src="/images/health-tips-image.svg">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="col-12">
                  <div class="row">
                    <div class="col-xl col-lg-12 col-md-12 col-12 col-sm-12 p-2">
                      <div class="categories-slider-image float-left position-relative">
                        <span class="text-white text_14 position-absolute w-100 d-inline-block text-center">
                          Dental Health
                        </span>
                        <img class="w-100 d-inline-block book-rounded" src="/images/dental-health-image.svg">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="col-12">
                  <div class="row">
                    <div class="col-xl col-lg-12 col-md-12 col-12 col-sm-12 p-2">
                      <div class="categories-slider-image float-left position-relative">
                        <span class="text-white text_14 position-absolute w-100 d-inline-block text-center">
                          Fitness & Exercise
                        </span>
                        <img class="w-100 d-inline-block book-rounded" src="/images/fitness-image.svg">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="col-12">
                  <div class="row">
                    <div class="col-xl col-lg-12 col-md-12 col-12 col-sm-12 p-2">
                      <div class="categories-slider-image float-left position-relative">
                        <span class="text-white text_14 position-absolute w-100 d-inline-block text-center">
                          Fitness & Exercise
                        </span>
                        <img class="w-100 d-inline-block book-rounded" src="/images/fitness-image.svg">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="col-12">
                  <div class="row">
                    <div class="col-xl col-lg-12 col-md-12 col-12 col-sm-12 p-2">
                      <div class="categories-slider-image float-left position-relative">
                        <span class="text-white text_14 position-absolute w-100 d-inline-block text-center">
                          Fitness & Exercise
                        </span>
                        <img class="w-100 d-inline-block book-rounded" src="/images/fitness-image.svg">
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
            </VueSlickCarousel>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="container-fluid mt-4">
        <div class="row">
          <div class="col-lg-8 col-12 mb-3 mb-xl-0 blog-border-right">
            <div class="w-100 d-inline-block position-relative">
            <div class="page_content w-85 m-auto w-md-100 w-xs-100 
            w-sm-100">
              <!-- <div class="accordion md-accordion top_notification" id="Lahore" role="tablist" aria-multiselectable="true">
                <div class="card_main card border-0 rounded-0">

                  <div class="card-header bg-white p-0 heading-doctor-city-pakistan" role="tab" id="lahore_doctors">
                    <a class="text_black text_20 text-xs-14 font-xs-bold w-100 d-inline-block" data-toggle="collapse" data-parent="#Lahore" href="#doctors_in_lahore" aria-expanded="true" aria-controls="doctors_in_lahore">Explore more topics</a>
                  </div>
                  <div id="doctors_in_lahore" class="collapse show" role="tabpanel" aria-labelledby="lahore_doctors" data-parent="#Lahore" style="">
                    <div class="card-body p-2 w-100	d-inline-block">
                      <ul id="myDIV" class="doctor-hospital-city w-100 d-inline-block m-0">
                        <li v-if="index < 24 && category.parent === '0'" v-for="(category, index) in categories" class="w-33 float-left 
                        w-xs-50 mb-3 mb-lg-4">
                          <a href="javascript:void(0)" @click="showSubCategories(category)" class="p-0 text_14 text_black btn" :class="'newbtn'+index"> {{ category.title }} </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div> -->
              <div >
                <div v-if="selectedCategory && selectedCategory.title" class="row">
                  <div class="col-12">
                    <div class="heading-skin-hair-care mt-3">
                      <p class="text_black text_18">{{ selectedCategory.title }}</p>
                    </div>
                  </div>
                </div>
                <div class="blog-height w-100 d-inline-block">
                <div class="col-12">
                  <div class="row">
                    <div v-for="article in filteredArticles" class="specalities-image col-lg-6 col-md-6 col-12 col-sm-6 mb-4">
                      <div class="doctor-in-pakistan w-100 w-sm-100 d-inline-block position-relative bg_health_height bg-white box-shadow book-rounded">
                        <div class="w-100 d-inline-block 
                        position-relative">
                          <span class="d-inline-block w-100">
                            <img class="img-fluid book-rounded w-100" :src="basePath+'/uploads/users/1/articles/'+article.image"  :alt="article.title">
                            <!-- <div class="w-40 text-center d-inline-block p-2 blog-skin-box book-rounded position-absolute">
                              <span class="text-white text_13">
                              {{article.categories[0].title}}</span>
                            </div> -->
                          </span>
                        </div>
                        <div class="w-100 d-inline-block p-2">
                          <p class="text_13 font-weight-bold mb-0" style="overflow:hidden;height:40px;">{{ article.title }}
                          </p>
                          <span class="text_black text_12 d-inline-block mt-2" style="overflow:hidden;height:40px;">
                            {{article.short_description}}
                          </span>
                          <ul class="w-100 d-inline-block mb-0 pl-0 mt-3 position-relative blogs-date mb-2">
                            <li>
                              <span class="text_black font-weight-bold text_12 mr-4 date position-relative">
                                {{moment(article.updated_at).format("MMMM D, YYYY")}}
                              </span>
                              <span class="text_black font-weight-bold text_12">
                                By {{article.author.first_name+' '+article.author.last_name}}
                              </span>
                            </li>
                          </ul>
                        </div>
                        <a :href="'/health-articles/'+article.slug" class="circle_anchor position-absolute"></a>
                      </div>
                    </div>
                  </div>
                </div>
                <div v-if="filteredArticles.length === 0" class="w-100 d-inline-block text-center">
                  <p class="mb-0 text_black text_30">
                    No Blog Found
                  </p>
                </div>
              </div>
                <div v-if="filteredArticles.length > 0" class="w-35 m-auto d-block blog-pagination text-center mt-3 w-xs-85 w-md-100 w-sm-100">
                  <paginate
                  :page-count="totalPages"
                  :click-handler="fetchTableData"
                  :prev-text="'Previous'"
                  :next-text="'Next'"
                  :container-class="'pagination'"
                  :page-class="'page-item'"
                  :page-link-class="'page-link'"
                  :prev-class="'page-item'"
                  :next-class="'page-item'"
                  :prev-link-class="'page-link'"
                  :next-link-class="'page-link'"
                  :active-class="'active'"
                >
                </paginate>
                </div>
                <!-- <div class="bg-skin-care w-100 d-inline-block 
                p-3 specialities-background">
                  <div class="heading-skin-hair-care float-left">
                    <h2 class="text_black font-weight-bold"> {{ selectedCategory.title }}</h2>
                    <span class="text_black text_20 float-right">{{ relatedArticles.length }} Articles
                    </span>
                  </div>
                  <div class="arrow-right float-right d-inline-block">
                    <a class="text_black float-right rounded-circle w-45px h_45 text_20 arrow-bg" :href="'/health-articles/categories/'+selectedCategory.slug">
                      <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </a>
                  </div>
                  <div class="text-skin-care w-100 d-inline-block mt-2">
                    <p class="text_black text_14" v-html="selectedCategory.abstract">
                    </p>
                  </div>
                </div> -->
              </div>
            </div>
            </div>
          </div>
          <sidebar
              :fileSystemDriver="fileSystemDriver"
              :articles="sideBarArticles"
              :selected_category="selectedCategory"
          ></sidebar>
        </div>
      </div>
      <div v-if="selectedCategory != null">
        <other-doctor
        :fileSystemDriver="fileSystemDriver"
        :key="selectedCategory.id"
        :doctors="categoryRelatedDoctors"
        :user="logged_user"
        :selected_category="selectedCategory"
        >
        </other-doctor>
      </div>
    </section>
  </div>
</template>

<script>
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MMM DD,YYYY')
  }
});
import moment from 'moment'
import VueSlickCarousel from 'vue-slick-carousel'
   import 'vue-slick-carousel/dist/vue-slick-carousel.css'
   import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
export default {
  components: { VueSlickCarousel },
  name: "ArticlesSectionComponent",
  props: ['bread_crumb','round_articles','articles', 'categories','segments','logged_user', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      categoryRelatedDoctors:[],
      currentPage:1,
      sideBarArticles:this.articles.data,
      totalPages:this.articles.last_page,
      moment:moment,
      details: [],
      search: '',
      show: false,
      relatedArticles: [],
      selectedCategory: null,
      selectedSubCategory: this.categories[0].sub_categories,
      resultSegments: this.segments,
      c2Setting: {
           arrows: true,
           dots:false,
           slidesToShow:1,
           speed: 500,
           // autoplay: true,
           responsive: [
             {
               breakpoint: 1024,
               settings: {
                 slidesToShow: 1,
                 slidesToScroll: 1,
               }
             },
             {
               breakpoint: 600,
               settings: {
                 slidesToShow: 1,
                 slidesToScroll: 1,
                 initialSlide: 2
               }
             },
             {
               breakpoint: 480,
               settings: {
                 slidesToShow: 1,
                 slidesToScroll: 1
               }
             }
           ]
         },
         c3Setting: {
           arrows: true,
           dots:false,
           slidesToShow:6,
           speed: 500,
           responsive: [
             {
               breakpoint: 1024,
               settings: {
                 slidesToShow: 4,
                 slidesToScroll: 1,
               }
             },
             {
               breakpoint: 600,
               settings: {
                 slidesToShow: 2,
                 slidesToScroll: 1,
                 initialSlide: 2
               }
             },
             {
               breakpoint: 480,
               settings: {
                 slidesToShow: 2,
                 slidesToScroll: 1
               }
             }
           ]
         },
    }
  },
  watch: {
    selectedCategory(newValue) {
      if(newValue != null)
      {
          this.getRelatedDoctorsCategory(newValue);
      }
    }
  },
  computed: {
     filteredArticles() {
    if (this.selectedCategory) {
      return this.articles.data.filter(article =>
  article.categories.some(category => category.title === this.selectedCategory.title)
);
    } else {
      return this.articles.data;
    }
  }
  },
  created () {
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
    // let self = this
    // this.categories[0].sub_categories.forEach(x => self.relatedArticles.push(x.articles.length))
  },
  mounted () {
  },
  methods:{
      getRelatedDoctorsCategory(value)
    {
      axios.get('/get-article-selected-categories-related-doctors/'+value.speciality_id)
      .then((response)=>{
            this.categoryRelatedDoctors = response.data;
      });
    },
    //  fetchTableData(pageNumber) {
    //   this.currentPage = pageNumber;
    //   if(this.selectedCategory != null)
    //   {
    //       var selectedCategoryValue = this.selectedCategory.id;
          
    //   }
    //   else
    //   {
    //       var selectedCategoryValue = null

    //   }
    //   axios.get('/get-blog-health-articles-categories?page='+pageNumber+'&selected='+selectedCategoryValue)
    //   .then((response)=>{
    //         this.articles=response.data;
    //         this.totalPages=this.articles.last_page;
    //   });
    // },
    fetchTableData(pageNumber) {
      this.currentPage = pageNumber;
      const selectedCategoryValue = this.selectedCategory ? this.selectedCategory.id : null;
      axios.get('/get-blog-health-articles-categories', {
        params: {
          page: pageNumber,
          selected: selectedCategoryValue,
        },
      })
      .then((response) => {
        // console.log(response.data);
        this.articles = response.data;
        this.totalPages = this.articles.last_page;
      });
},
    showSubCategories(category) {
      // let self = this
      // self.selectedSubCategory = []
      // self.relatedArticles = []
      this.selectedCategory = category;
      this.fetchTableData(this.currentPage);
      // category.sub_categories.forEach(x => self.relatedArticles.push(x.articles.length))
      // category.sub_categories.forEach(function (article) {
      //   self.selectedSubCategory.push(article)
      // });
      // var newbtn = header.getElementsByClassName("newbtn0");
      // newbtn[0].classList.remove('newbtn0');
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