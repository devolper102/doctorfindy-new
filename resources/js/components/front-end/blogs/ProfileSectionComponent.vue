<template>
  <div>
<!--     <div class="container">
      <div class="row">
            <div class="col-12 mt-4">
              <bread-crumb-spec></bread-crumb-spec>
            </div>
      </div>
    </div>  -->
    <section class="skin-doctor-detail">
      <div class="container">
        <div class="row mt-5">
          <div class="col-lg-6 col-12" >
            <div class="skin-doctor-image w-20 float-left">
              <img class="img-fluid w_80px h_80 rounded-circle" v-lazy="basePath+'/uploads/users/'+user.id+'/'+user.profile.avatar" :alt="user.first_name + ' ' + user.last_name " :name="user.first_name + ' ' + user.last_name ">

            </div>
            <div class="doctor-name w-100 text-center text-lg-left float-left mt-3">
						<span class="banner_heading_color text_25 font-weight-bold d-block">
						{{ user.first_name }} {{ user.last_name }}
						</span>
            </div>
          </div>
          <div class="col-lg-6 col-12">
            <div class="view-profile-btn w-100 d-inline-block text-lg-right text-center mt-lg-0 mt-4">
              <a class="text-white rounded-pill text_15 d-inline-block knockdoc_btn_bg" :href="'/subscribe-now'">Subscribe
                <i class="fas fa-envelope-open-text ml-3"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-lg-6 col-12 col-md-6">
              <about-doctor
                :user="user"
              ></about-doctor>
          </div>
          <div class="col-lg-6 col-12 col-md-6">
            <div class="mt-3">
              <work-experience
                  :user="user"
              ></work-experience>
            </div>
          </div>
          <div class="col-lg-6 col-12 col-md-6">
            <education-section
                :user="user"
            ></education-section>
          </div>
          <div class="col-lg-6 col-12 col-md-6">
            <award-section
                :user="user"
            ></award-section>
          </div>
          <div class="col-lg-6 col-12 col-md-6">  
            <membership-section
                :user="user"
            ></membership-section>
          </div>
          <div class="col-lg-6 col-12 col-md-6">  
            <certificates
                :user="user"
            ></certificates>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="modified w-100 d-inline-block">
              <h5 class="text_black mb-4">Last modified</h5>
            </div>
          </div>
        </div>

        <div class="row mb-4" v-for="article in user.articles">
          <div class="col-lg-3 col-12 col-md-12">
            <div class="eyes-image w-100 d-inline-block w-md-100">
              <img class="img-fluid w-100" v-lazy="basePath+'/uploads/users/'+article.author_id+'/articles/'+article.image"  alt="eyes-image picture">
            </div>
          </div>
          <div class="col-lg-9 col-12 col-md-12">
            <div class="eyes-treatment w-100 d-inline-block pt-2 pb-2">
              <h6 class="text_black font-weight-bold">
                {{ article.title }}
              </h6>
              <span class="text_black text_15">By:</span>
              <span class="theme-color-text text_15">{{ user.first_name }} {{ user.last_name }}</span>
              <p class="text_black text_15 mt-2">{{ article.short_description }}</p>
              <div class="rounded-pill knockdoc_btn_bg text-white mt-4 d-inline-block text_14 px-4 py-2 text-white">
                <a class="text-white" :href="'/health-articles/'+article.slug">READ MORE</a>
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
  name: "ProfileSectionComponent",
  props:['user','segments', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      details: [],
      search: '',
      experiences: [],
      show: false,
      resultSegments: this.segments,
    }
  },
  computed: {
    filteredList() {
      return this.articles.filter(post => {
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
    console.log(this.user, JSON.parse(this.user.profile.experiences))
    this.experiences = JSON.parse(this.user.profile.experiences)
  },
  mounted () {},
  methods:{},
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