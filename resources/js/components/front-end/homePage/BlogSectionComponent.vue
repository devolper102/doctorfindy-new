<template>
  <div>
    <div class="w-100 d-inline-block bg-blog-content mt-4">
    <div class="blogs_section" v-if="articles.length >= 1">
      <div class="container">
        <div class="blog_heading w-100 mt-lg-4 mb-lg-4 mb-3 mt-3 position-relative">
          <h2 class="knockdoc-heading text-white">From The Blog</h2>
          <p></p>
        </div>
        <div class="d-flex d-xl-block overflow-sm-auto overflow-md-auto mb-0 mb-lg-0 w-100 blog_height">
          <div v-for="(article, index) in articles" v-if="index < 4" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 float-left pr-xl-0">
            <div class="blog_main bg-white bg-shadow 
            position-relative box_radius">
              <div class="blog_img position-relative 
              overflow-hidden">
                <img v-lazy="basePath+'/uploads/users/'+article.author.id+'/articles/'+article.image" :alt="article.image" :name="article.image" class="img-fluid w-100 blog_img_border">
                <span class="rounded-pill bg-white position-absolute blog_sm_img w-70 p-1 w-xs-70">
								<img v-lazy="basePath+'/uploads/users/'+article.author.id+'/'+article.author.profile.avatar" :alt="article.author.first_name+' '+article.author.last_name" :name="article.author.first_name+' '+article.author.last_name" class="w-20 rounded-circle img-fluid float-left">
                  <!-- {{article.author.last_name}} -->
								<span class="ml-2"> {{article.author.first_name}} {{article.author.last_name}}</span>
							</span>
              </div>
              <div class="d-block w-100">
                <div class="w-100 d-inline-block blog_services pt-0 pl-3 pr-3 pb-0">
                  <!-- <ul class=" d-block w-100 overflow-hidden m-auto pt-1 mb-1">
                    <li v-for="category in article.categories" class="float-left mr-1">
                      <a :href="'/articles/categories/'+category.slug"> {{ category.title}} </a>
                    </li>
                  </ul> -->
                  <div class="blog_main_heading d-inline-block w-100 mt-1">
                    <a class="text_black" :href="'/health-articles/'+article.slug">
                      <p class="font-weight-bold">{{ article.title }}</p>
                    </a>
                  </div>
                  <p class="d-block posted_user_name w-100 text_12 mb-0">
                    {{ article.short_description }}
                  </p>
                  <!-- <span class="text_12 font-weight-bold">Oct 7, 2020  </span>
                  <span class="text_12 font-weight-bold">3 min read</span> -->
                </div>
                <ul class="shares_icon d-inline-block w-100 mb-0 b-top mt-1">
                  <li class="float-left w-60 text_12 text_md_10 
                  pl-3 mt-2">
                    <!-- <a :id="'article-'+article.id" :class="patient.length !== 0 && patient.profile.saved_articles ? patient.profile.saved_articles.includes(article.id) ? 'shares_icon_liked' : '' : ''" @click="addToLike(article.id)"><i class="fa fa-heart-o mr-2"></i>Likes</a> -->
                    <div class="">
                      <i class="fa fa-calendar" aria-hidden="true">
                        
                      </i>
                      <span><!-- {{ article.author.roles[0].name }} |  -->{{article.created_at | moment("MMMM D, YYYY")}}</span>
                    </div>
                  </li>
                  <li class="float-left w-35 pl-2 text_12 text_md_10 mt-2">
                    <div class="">
                      <i class="fa fa-eye"></i>
                      <span v-if="article.views === '' || article.views === null">0</span>
                      <span v-else>{{ article.views }}</span> Views
                    </div>
                  </li>
                  <!-- <li class="float-left w-40 pt-2 text_12 text_md_10">
                    <ShareNetwork
                        network="facebook"
                        url=""
                        :title=" article.title "
                        :description=" article.description "
                        quote="The hot reload is so fast it\'s near instant. - Evan You"
                        hashtags="DoctorFindy"
                    >
                      <i class="fa fa-share-alt mr-2"></i>Share
                    </ShareNetwork>
                    <div class="">
                      <i class="fa fa-clock-o" aria-hidden="true">
                      </i>
                      <span>{{article.reading_time}}</span> min read
                    </div>
                  </li> -->
                </ul>
              </div>
              <a :href="'/health-articles/'+article.slug" class="article_details position-absolute" style="top: 0;right: 0;bottom: 0;left: 0;"></a>
            </div>
          </div>
        </div>
        <div class="d-inline-block w-100 text-center">
				<a href="/health-articles/categories" class="box_radius bg-white text-green p-2 btn_padding mb-3 mt-xl-3 
        d-inline-block">View All Articles
					<i class="fa fa-arrow-right ml-2" aria-hidden="true"></i>
				</a>
			</div>
      </div>
    </div>
  </div>
  </div>
</template>

<script>
import VueSocialSharing from 'vue-social-sharing'
import Toasted from 'vue-toasted'

Vue.use(Toasted)
Vue.use(VueSocialSharing);
Vue.use(require('vue-moment'));

export default {
  name: "BlogSectionComponent",
  props:['articles', 'user', 'patient', 'fileSystemDriver'],
  data() {
    return {
     basePath:'',
    }
  },
  created() {
    
  },
  mounted(){
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  methods:{
    addToLike(id) {
      let self = this;
      if (self.patient.length !== 0) {
        axios.post(APP_URL + '/like-article',
          {
            id:id,
          }
        ).then(function (response) {
          if (response.data.type === 'success') {
            
            document.querySelector('#article-'+id).classList.add('shares_icon_liked')
            Vue.toasted.success(response.data.message , { duration: 3000 })
          }
          else if(response.data.type === 'remove') {
            document.querySelector('#article-'+id).classList.remove('shares_icon_liked')
            Vue.toasted.show(response.data.message , { duration: 3000 })

          }
          else {
            Vue.toasted.show(response.data.message , { duration: 3000 })
          }
        })
      }
      else {
        Vue.toasted.show('Login first to perform this action' , { duration: 3000 })
      }
    }
  }
}
</script>

<style>

.shares_icon_liked {
  color: #ff465c !important;
}
.overflow-md-auto::-webkit-scrollbar-thumb{
  background:transparent !important;
}
</style>