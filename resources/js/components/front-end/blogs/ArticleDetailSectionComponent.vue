<template>
  <div>
    
<!--     <div class="container">
      <div class="row">
            <div class="col-12 mt-4">
              <bread-crumb-spec></bread-crumb-spec>
            </div>
      </div>
    </div>  -->
    <!-- Start  Articles based on Health interests -->
    <section class="articles-based-health-interests">
      <div class="container-fluid overflow-hidden">
        <div class="row">
          <div class="col-lg-8 col-12 p-0">
            <div class="w-100 d-inline-block blog-border-right position-relative">
            <div class="d-block m-auto w-xs-100" style="width:83%;">
            <div class="w-100 d-inline-block mt-3 pl-xl-0 pl-3 pr-xl-0 
            pr-3">
              <h1 class="text_30 text-xs-25 text_black mb-0 font-weight-bold">
                <!-- 6 CALCIUM RICH FOODS YOU SHOULD ADD <br>TO YOUR DIET -->
                {{article.title}}
              </h1>
              <p class="text_13 text_black mb-xl-0 mb-2 mt-2">
                by {{article.author.first_name+' '+article.author.last_name}} - Publish date  {{moment(article.updated_at).format("MMMM D, YYYY")}}
              </p>
            </div>
            <div class="bg-image-skin-care position-relative mt-3" v-bind:style='{ backgroundImage: `url("${imageUrl}")` }' v-bind:alt="imageAlt"></div>
          </div>
            <div class="doctor-skin-care-detail w-80 p-3 m-auto position-relative">
              <!-- <div class="row">
                <div class="col-lg-2 col-sm-4 col-md-4 col-6">
                  <div v-if="article.image" class="skin-patient-image">
                    <img class="img-fluid w_90px h_90 rounded-circle" v-lazy="'/uploads/users/'+article.author_id+'/articles/'+article.image" :alt="article.title" @error="onLogoLoadFailure($event)">
                  </div>
                   <div v-else class="skin-patient-image">
                    <img class="w_90px h_90 rounded-circle" src="/images/dummy-image.svg" alt="pictire">
                  </div>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 pl-0 col-6">
                  <div class="heading-skin-care mt-4">
                    <h4 class="text_black font-weight-bold text_md_14">{{ article.title }}</h4>
                  </div>
                </div>
              </div> -->
              <!-- <div class="row">
                <div class="col-lg-6 col-12">
                  <div class="doctor-name">
										<span class="text-blue text_16 font-weight-bold d-block">
											By DoctorFindy
										</span>
                    <span class="work-color-text text_16">
                      {{article.created_at | formatDate}}
										</span>
                  </div>
                </div>
            <div class="col-lg-6 col-12">
              <div class="view-profile-btn w-100 d-inline-block text-center text-lg-right">
                <a class="text-white rounded-pill text_15 d-inline-block knockdoc_btn_bg" :href="'/health-articles/profile/'+article.author.slug">View profile</a>
              </div>
            </div>
              </div> -->
              <div v-html="article.description" class="skin-care-text w-100 d-inline-block mt-xl-4">
              </div>
              <ul class="blog-social-icon d-inline-block pl-0 position-absolute">
                    <li class="mb-3">
                      <ShareNetwork
                        network="InstaPaper"
                        :url="baseUrl+'/blog/'+article.slug"
                        :title="article.title"
                        hashtags="DoctorFindy"
                        @open="shareEvent"
                        class="text-white d-inline-block text_20 text-center">
                        <!-- <i class="fa fa-instagram" aria-hidden="true"></i> -->
                        <img :src="basePath+'/images/instagram-image-icon.svg'" 
                        style="height:25px;">
                    </ShareNetwork>
                  </li>
                  <li class="mb-3">
                    <a class="d-inline-block text-center" href="javascript:void(0)">
                      <img :src="basePath+'/images/gmail-image.svg'" 
                      style="height:25px;">
                    </a>
                  </li>
                    <li class="mb-3">
                      <ShareNetwork
                        network="facebook"
                        :url="baseUrl+'/health-articles/'+article.slug"
                        :title="article.title"
                        :description="article.short_description"
                        hashtags="DoctorFindy"
                        @open="shareEvent"
                        class="text-white d-inline-block text_20 text-center">
                        <!-- <i class="fa fa-facebook" aria-hidden="true"></i> -->
                        <img :src="basePath+'/images/facebook-image.svg'" 
                        style="height:25px;">
                    </ShareNetwork>
                  </li>
                  <li class="mb-3">
                      <ShareNetwork
                        network="Twitter"
                        :url="baseUrl+'/health-articles/'+article.slug"
                        :title="article.title"
                        :description="article.short_description"  
                        hashtags="DoctorFindy"
                        @open="shareEvent"
                        class="text-white d-inline-block text_20 text-center">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </ShareNetwork>
                  </li>
                    <li class="mb-3">
                      <ShareNetwork
                        network="LinkedIn"
                        :url="baseUrl+'/health-articles/'+article.slug"
                        :title="article.title"
                        :description="article.short_description"
                        hashtags="DoctorFindy"
                        @open="shareEvent"
                        class="text-white d-inline-block text_20 text-center linkdin-icon">
                        <!-- <i class="fa fa-linkedin" aria-hidden="true"></i> -->
                        <img :src="basePath+'/images/linkdin-image.svg'" 
                        style="height:20px;">
                    </ShareNetwork>
                  </li>
                  </ul>
            </div>
              <div class="col-12">
                <div class="m-auto d-block w-xs-100" style="width:83%;">
                   <ul class="share-icon w-100 d-inline-block mt-xl-0 
                   mt-5">
                     <li class="float-left mr-3 w-xs-100 mb-2">
                       <span class="d-block text_black text_14">
                         {{totalShared}}
                       </span>
                       <span class="d-block text_14 
                       work-color-text">
                         Shares
                       </span>
                     </li>
                     <li class="float-left mr-xl-3 mr-2 mb-2">
                       <!-- <a class="gmail-icon book-rounded float-left text-white" href="javascript:void(0)">
                         <img src="/images/gmail-image.svg" style="height: 20px;">
                         <span>
                           Gmail
                         </span>
                       </a> -->
                       <ShareNetwork
                        network="Email"
                        :url="baseUrl+'/health-articles/'+article.slug"
                        :title="article.title"
                        :description="article.short_description"
                        hashtags="DoctorFindy"
                        @open="shareEvent"
                        class="gmail-icon book-rounded float-left text-white">
                        <img :src="basePath+'/images/gmail-image.svg'" style="height: 20px;">
                        <!-- <span>
                           Gmail
                         </span> -->
                    </ShareNetwork>
                     </li>
                     <li class="float-left mr-xl-3 mr-2 mb-2">
                       <!-- <a class="linkdIn-icon book-rounded float-left text-white" href="javascript:void(0)">
                         <i class="fa fa-linkedin" aria-hidden="true"></i>
                         <span>
                           LinkdIn
                         </span>
                       </a> -->
                       <ShareNetwork
                        network="LinkedIn"
                        :url="baseUrl+'/health-articles/'+article.slug"
                        :title="article.title"
                        :description="article.short_description"
                        hashtags="DoctorFindy"
                        @open="shareEvent"
                        class="linkdIn-icon book-rounded float-left text-white">
                        <i class="fa fa-linkedin text_18" aria-hidden="true"></i>
                        <!-- <span>
                           LinkedIn
                         </span> -->
                    </ShareNetwork>
                     </li>
                     <li class="float-left mr-xl-3 mr-2 mb-2">
                       <!-- <a class="facebook-icon book-rounded float-left text-white" href="javascript:void(0)">
                         <i class="fa fa-facebook" aria-hidden="true"></i>
                         <span>
                           Facebook
                         </span>
                       </a> -->
                       <ShareNetwork
                        network="facebook"
                        :url="baseUrl+'/health-articles/'+article.slug"
                        :title="article.title"
                        :description="article.short_description"
                        hashtags="DoctorFindy"
                        @open="shareEvent"
                        class="facebook-icon book-rounded float-left text-white">
                        <i class="fa fa-facebook text_18" aria-hidden="true"></i>
                        <!-- <span>
                           Facebook
                         </span> -->
                    </ShareNetwork>
                     </li>
                     <li class="float-left mb-2">
                       <!-- <a class="whatsapp-icon book-rounded float-left text-white" href="javascript:void(0)">
                         <i class="fa fa-whatsapp" aria-hidden="true"></i>
                         <span>
                           Whatsapp
                         </span>
                       </a> -->
                       <ShareNetwork
                        network="Whatsapp"
                        :url="baseUrl+'/health-articles/'+article.slug"
                        :title="article.title"
                        :description="article.short_description"
                        hashtags="DoctorFindy"
                        @open="shareEvent"
                        class="whatsapp-icon book-rounded float-left text-white">
                        <i class="fa fa-whatsapp text_18" aria-hidden="true"></i>
                        <!-- <span>
                           Whatsapp
                         </span> -->
                    </ShareNetwork>
                     </li>
                   </ul>
                   <div class="row mt-xl-4">
                <div class="col-xl-2 col-4">
                    <div class="w-100 d-inline-block">
                        <img class="rounded-pill" :src="basePath+'/images/profile-image.svg'">
                    </div>
                </div>
                <div class="col-xl-10 col-8">
                    <div class="w-100 d-inline-block blog-profile-image-content">
                        <h1 class="text_black text_18 font-weight-bold">{{article.author.first_name+' '+article.author.last_name}}</h1>
                        <p class="work-color-text text_13">
                            {{article.author.profile.description}}
                        </p>
                    </div>
                    <!-- <div class="w-100 d-inline-block mt-3 text-center comment-btn">
                        <a class="text_14 text-white d-inline-block bg-black book-rounded" href="javascript:void(0)">
                          View Comments (0)
                        </a>
                    </div> -->
                </div>
            </div>
                </div>
              </div>
            <div v-if="relatedArticles.length > 0">
              <div class="col-12 mt-xl-4 mt-3">
                <div class="w-sm-100 m-auto related_articles"style="width:82%;">
                  <div class="article-based-ealth w-100 d-inline-block mb-4">
                    <p class="text_black font-weight-bold" style="font-size:30px;">
                      Related Articles
                    </p>
                  </div>
                  <ul class="fitness-categories w-100 d-inline-block mb-0 position-relative">
                    <li v-for="article in relatedArticles" class="float-left fitness_articleLinks article_based bg-white box-shadow book-rounded w-45 float-left mx-lg-2 mx-0 mb-4 border-0 w-xs-100 position-relative">
                      <span class="d-inline-block w-100">
                      <img class="card-img-top aricles_card book-rounded w-100" v-lazy="basePath+'/uploads/users/'+article.author_id+'/articles/'+article.image" :alt="article.title">
                      <!-- <div class="w-40 text-center d-inline-block p-2 blog-skin-box book-rounded position-absolute">
                        <span class="text-white text_13">
                          Skin Care</span>
                      </div> -->
                    </span>
                      <div class="w-100 d-inline-block p-2 fitness-bg">
                      <a class="article_text text_13 text_black w-100 pl-lg-0 card-text d-inline-block font-weight-bold" 
                      :href="'/health-articles/'+article.slug" style="overflow:hidden;height:40px;"> {{article.title}} </a>
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
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            </div>
          </div>
          <sidebar
              :fileSystemDriver="fileSystemDriver"
              :articles="articles"
          ></sidebar>
        </div>
      </div>
      <!-- </div> -->
    </section>
    <!-- End Articles based on Health interests -->
  </div>
</template>

<script>
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MMM DD,YYYY')
  }
});
import moment from 'moment'

export default {
  name: "ArticleDetailSectionComponent",
  props: ['article', 'articles','segments', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      moment:moment,
      details: [],
      search: '',
      show: false,
      relatedArticles: [],
      resultSegments: this.segments,
      baseUrl:'',
      imageUrl:'',
      imageAlt:'',
      totalShared:this.article.total_shared,
    }
  },
  computed: {
    filteredList() {
      return this.specialties.filter(post => {
        return post.title.toLowerCase().includes(this.search.toLowerCase())
      })
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
    let self = this
    this.article.categories.forEach(function (category, index){
      category.articles.forEach(function (article){
        if (index < 1){
          self.relatedArticles.push(article)
        }
      })
    })
  },
  mounted () {
    this.image();
    this.baseUrl = window.location.origin;

  },
  methods:{
    shareEvent()
    {
      axios.get('/save-share-count-of-blog/'+this.article.id)
      .then((response)=>{
            this.totalShared=response.data;
      });
    },
    onLogoLoadFailure(event)
    {
        event.target.src='/images/dummy-image.svg';
    },
     image()
    {

       if(this.article.background_img!==null && this.article.background_img!=="")
      {
        this.imageUrl=this.basePath+'/uploads/users/'+this.article.author_id+'/articles/'+this.article.background_img;
        this.imageAlt=this.article.slug+'-background-img';

      }
      else
      {
        this.imageUrl=this.basePath+'/uploads/users/1/articles/blog-single-1591191459-health.jpg';
        this.imageAlt='article-default-background-img';
      }
    } ,
    showRelatedArticles(category) {},

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
  .skin-care-text a{
    color: #0E4D92;
  }
  .blog-social-icon a {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    padding-top: 9px;
    background: #E5EAEE;
    font-size: 20px;
}
.blog-social-icon .linkdin-icon{
padding-top: 11px !important;
}
.blog-social-icon{
    left: -70px;
    top: 110px;
}
@media (max-width: 767px){
  .blog-social-icon {
    left: 30px;
    top: -60px;
  }
  .blog-social-icon li{
    float: left;
    margin-right: 10px;
  }
  .articles-based-health-interests .doctor-skin-care-detail {
    top: 80px !important;
    width: 100% !important;
    box-shadow: none;
  }
  .articles-based-health-interests .related_articles{
    margin-top: 20px !important;
  }
}
</style>