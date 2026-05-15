<template>
  <div>
    <!-- Topbar -->
    <header-section 
    :managements="managements"  
    :doctor="doctor">
    </header-section>
    <!-- End of Topbar -->
    <!-- Sidebar -->
    <div class="d-flex">
    <sidebar-section></sidebar-section>
    <!-- End of Sidebar -->
    <div id="content-wrapper" class="flex-column w-100 mt-3 00">
      <!-- Main Content -->
      <div id="content">
        <!-- Begin Page Content -->
        <div class="container">
               <person-info :doctor="doctor"></person-info>
          <div class="row mt-5">
            <div class="col-lg-4 col-12 mb-0 mb-lg-4" v-for="(article, index) in doctor.articles"  v-if="doctor.articles.length >= 1 ">
              <div class="blog-image">
                <img  v-lazy="'/uploads/users/'+article.author_id+ '/articles/'+ article.image" class="img-fluid" :alt="article.title" />
                <p class="text_black font-weight-bold text_15 mt-2 blog_title"><a :href="'/health-articles/'+article.slug">{{article.title}}</a></p>
                 <!-- <ul class="shares-icon d-block mt-2">
                <li class="float-left mr-4">
                  <a class="text_black text_12" href="#">0 Like
                  <i class="fa fa-heart-o" aria-hidden="true"></i>
                </a>
                </li>
                <li class="float-left mr-4">
                  <a class="text_black text_12" href="#">0 Views
                   <i class="fa fa-eye" aria-hidden="true"></i>
                 </a>
                </li>
                <li class="float-left mr-4">
                  <a class="text_black text_12" href="#">Share
                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                  </a>
                  </li>
                  <li class="float-left mr-4">
                    <a class="text_black text_12" href="#">0 Views
                     <i class="fa fa-eye" aria-hidden="true"></i>
                   </a>
                  </li>
                  <li class="float-left mr-4">
                    <a class="text_black text_12" href="#">Share
                      <i class="fa fa-share-alt" aria-hidden="true"></i>
                    </a>
                  </li>
                </ul> -->
                   <ul class="shares_icon d-block overflow-hidden w-90 m-auto w-md-100">
                    <li class="float-left mr-2">
                      <!-- <a :id="'article-'+article.id" :class="patient.length !== 0 && patient.profile.saved_articles ? patient.profile.saved_articles.includes(article.id) ? 'shares_icon_liked' : '' : ''" @click="addToLike(article.id)"><i class="fa fa-heart-o mr-2"></i>Likes</a> -->
                      <a href="#">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <span>{{article.created_at | moment("MMMM D, YYYY")}}</span>
                      </a>
                    </li>
                    <li class="float-left mr-2">
                      <a><i class="fa fa-eye mr-2"></i>
                        <span v-if="article.views === '' || article.views === null">0</span>
                        <span v-else>{{ article.views }}</span> Views</a>
                    </li>
                    <li class="float-left mr-2">
                      <!-- <ShareNetwork
                          network="facebook"
                          url=""
                          :title=" article.title "
                          :description=" article.description "
                          quote="The hot reload is so fast it\'s near instant. - Evan You"
                          hashtags="DoctorFindy"
                      >
                        <i class="fa fa-share-alt mr-2"></i>Share
                      </ShareNetwork> -->
                      <i class="fa fa-clock-o" aria-hidden="true"></i>
                      <span>3 min</span>
                    </li>
                  </ul>
                </div>
              </div>
            
            </div>
          </div>
                 
          </div>
              
      </div>
    </div>
    </div>
      </div>

    </div>
</template>

<script>
Vue.use(require('vue-moment'));
export default {
  name: "BlogListComponent",
    props: ['doctor','managements'],
  data() {
    return {
 
    }
  },
  created () {
   //console.log(this.doctor,this.doctor.articles.length,this.doctor.articles)
  },
  // computed: {
  //   formats() {
  //     return {
  //       input: this.inputFormat && this.inputFormat.split(','),
  //     };
  //   }
  // },
  // watch: {
  //   formats() {
  //     this.date = new Date(this.date);
  //   }
  // },
  // methods: {
  //   dateChange() {}
  // }

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
    height: auto;
    background-repeat: no-repeat;
  }
</style>