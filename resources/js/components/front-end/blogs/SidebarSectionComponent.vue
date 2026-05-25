<template>
  <div class="col-lg-4 col-12 pl-xl-0 bg-white blog_shadow">
    <div class="aside_bar mb-3">
      <div class="w-100 d-inline-block">
      <div v-if="selected_category && selected_category.title && selected_category.speciality" class="w-50 float-right w-xs-100 emergency-consult book-rounded pt-0 pb-2 pl-2 pr-2 position-relative mb-xl-0 mb-3">
        <div class="w-100 d-inline-block text-center emergency-consult-image">
          <img :src="basePath+'/images/blog-doctor-image.svg'" alt="pictire">
        </div>
          <div class="w-100 d-inline-block text-center consult-btn mt-2 mb-1">
            <a :href="selected_category.speciality.slug+'-in-pakistan'" class="d-inline-block book-rounded bg-red text-white text_13 mt-lg-0 mb-3 mb-lg-0 mt-3">
              Consult {{selected_category.title}}
            </a>
          </div>
          <a class="circle_anchor position-absolute" 
          href="javascript:void(0)"></a>
      </div>
      <!-- <div class="bg-skin-care w-100 d-inline-block pr-3 pl-xl-0 pl-3">
        <form>
          <div class="form-group input-doctor-onboard w-100 float-left mb-1">
            <label class="text_15 text_black w-md-100 
            font-weight-bold">Search Article
            </label>
            <div class="position-relative w-100 blog-input">
              <input v-model="search" type="text" class="form-control text_14 book-rounded border-0 h_37 btn dropdown-toggle text-left box-shadow bg-white pr-5" data-toggle="dropdown" aria-describedby="emailHelp" placeholder="search">
              <span class="articleSearchIcon position-absolute">
                <i class="fa fa-search" aria-hidden="true"></i>
              </span>
            </div>
          </div>
        </form>
      </div> -->
    </div>
      <div class="w-100 d-inline-block pl-xl-0 pl-3 pr-xl-0 pr-3">
        <h5 class="font-weight-bold mb-2 mt-2 text_black">Top Post
        </h5>
        <div class="treatment-information w-100 d-inline-block p-2">
          <div class="article_list">
            <div v-for="(article,index) in siderBarArticles" v-if="index < 5">
              <a :href="'/health-articles/'+article.slug">
                <div class="hairfall-categories pl-2 pb-2 mt-3">
                  <!-- <h5 class="work-color-text font-weight-bold">Popular</h5> -->
                  <div class="row">
                    <div v-if="article.image" class="w-lg-20 w-24 
                    mr-lg-2 mr-1">
                        <img :src="basePath+'/uploads/users/' + article.author_id + '/articles/' + article.image" alt="Article image" @error="onLogoLoadFailure($event)" class="">
                    </div>
                     <div v-else class="w-lg-20 w-24 
                    mr-lg-2 mr-1">
                       <img :src="basePath+'/images/dummy-image.svg'" alt="pictire" style="border-radius: 50%;height: 50px;width: 50px;margin-left:10px;">
                    </div>
                    <div class="float-left w-74">
                        <p class="text_black font-weight-bold">
                        {{ article.title }}</p>
                        <span class="text_black d-block text_13">
                        {{ article.author.first_name }} {{ article.author.last_name }}</span>
                        <span class="text_13 text_black d-block">
                        {{ article.category }}</span>
                        <span class="text_black text_13">{{ article.created_at | formatDate}}</span>
                    </div>
                  </div>
                </div>  
              </a>
              <!-- <div class="border_health"></div> -->
            </div>
            <span v-if="siderBarArticles.length === 0">No Result Found...</span>
          </div>
        </div>
      </div>

      <div class="w-100 d-inline-block pl-xl-0 pl-3 pr-xl-0 pr-3">
        <h5 class="font-weight-bold mb-2 mt-2 text_black">Recent Articles
        </h5>
        <div class="treatment-information w-100 d-inline-block p-2">
          <div class="article_list">
            <div v-for="(article,index) in recentArticles" v-if="index < 5">
              <a :href="'/health-articles/'+article.slug">
                <div class="hairfall-categories pl-2 pb-2 mt-3">
                  <!-- <h5 class="work-color-text font-weight-bold">Popular</h5> -->
                  <div class="row">
                    <div v-if="article.image" class="w-lg-20 w-24 
                    mr-lg-2 mr-1">
                        <img :src="basePath+'/uploads/users/' + article.author_id + '/articles/' + article.image" alt="Article image" @error="onLogoLoadFailure($event)" class="">
                    </div>
                     <div v-else class="w-lg-20 w-24 
                    mr-lg-2 mr-1">
                       <img :src="basePath+'/images/dummy-image.svg'" alt="pictire" style="border-radius: 50%;height: 50px;width: 50px;margin-left:10px;">
                    </div>
                    <div class="float-left w-74">
                        <p class="text_black font-weight-bold">
                        {{ article.title }}</p>
                        <span class="text_black d-block text_13">
                        {{ article.author.first_name }} {{ article.author.last_name }}</span>
                        <span class="text_13 text_black d-block">
                        {{ article.category }}</span>
                        <span class="text_black text_13">{{ article.created_at | formatDate}}</span>
                    </div>
                  </div>
                </div>  
              </a>
              <!-- <div class="border_health"></div> -->
            </div>
            <span v-if="recentArticles.length === 0">No Result Found...</span>
          </div>
        </div>
      </div>
    </div>
   <!--  <div class="border_health"></div>
    <div class="row mt-4">
      <div class="col-12">
        <div class="w-100 d-inline-block">
          <p class="text_black font-weight-bold text_13">Writers Profile</p>
        </div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-lg-4 col-6 col-md-4 col-sm-4 mb-3" v-for="(specialty, index) in 6">
        <div class="w-100 d-inline-block writer-image">
          <img class="w-100 d-inline-block book-rounded" src="/images/profile-image.svg">
          <span class="w-100 d-inline-block mt-2 text-center text_13">
            Asim Muneer
          </span>
        </div>
      </div>
    </div> -->
  </div>
</template>

<script>
  import axios from 'axios';
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MMM DD,YYYY')
  }
});
export default {
  name: "SidebarSectionComponent",
  props:['articles','selected_category', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      siderBarArticles:this.articles,
      details: [],
      recentArticles:[],
      search: '',
      show: false,
    }
  },
  watch: {
    search(newVal, oldVal) {
      if(newVal.length > 2)
      {
        this.getArticlesForSearch(newVal);
      }
      else
      {
        if(newVal.length === 0)
        {
            this.siderBarArticles=this.articles;
        }
      }
    },
  },
  computed: {
    // filteredList() {
    //   return this.siderBarArticles.filter(post => {
    //     return post.title.toLowerCase().includes(this.search.toLowerCase())
    //   })
    // }
  },
  created () {
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  mounted () {
    // console.log('Component mounted');
    this.getAllArticlesForSearch();
  },
  methods:{
    getAllArticlesForSearch()
    {
       axios.get('/get-recent-added-articles')
      .then((response)=>{
            this.recentArticles=response.data;
            // console.log('recent',this.recentArticles);
      }); 
    },
    getArticlesForSearch(value)
    {
      axios.get('/get-searched-articles/'+value)
      .then((response)=>{
            this.siderBarArticles=response.data;
            // console.log('siderBarArticles',this.siderBarArticles);
            
      }); 
    },
    onLogoLoadFailure(event)
    {
        event.target.src=this.basePath+'/images/dummy-image.svg';
    },
  },
}
</script>

<style scoped>
.article_list{
  max-height: 845px;
}
.treatment-information{
  z-index: 1;
  position: relative;
}
@media (max-width: 767px){
  .article_list{
    max-height: 100%;
  }
}
</style>