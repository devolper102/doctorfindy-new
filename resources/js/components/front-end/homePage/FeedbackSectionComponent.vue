<template>
  <div class="feedback_section" id="feedback_slider">
    <div  class="feedback_bg_img mb-lg-0 mt-0 mb-md-3">
      <div class="container">
        <div class="row">
          <div class="col-12 col-xl-9">
            <div class="feedback_heading mt-4 mb-4 
            d-inline-block w-100">
              <h2 class="text_20 mt-3 service-text mb-3">
                Our Happy Clients Says About Us
              </h2>
            </div>
          </div>
          <div class="col-12 col-xl-3">
            <div class="feedback-slide-icon w-100 d-inline-block">
              <a class="carousel-control-prev" v-on:click="showPrevious">
            <span class="carousel-control-prev-icon float-left" aria-hidden="true"></span>
            <span class="float-right previous-text d-inline-block">Previous</span>
          </a>
          <a class="carousel-control-next" v-on:click="showNext">
            <span class="service-text float-left ml-2">Next</span>
            <span class="carousel-control-next-icon float-right" aria-hidden="true"></span>
          </a>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div v-if="feedbacks.length != 0" id="feedbackSlider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <!-- <a class="carousel-control-prev" v-on:click="showPrevious">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a> -->
          <VueSlickCarousel 
            ref="settings"
            v-bind="settings"
            >
            <div class="feedback-client-slider w-100 d-inline-block box_radius p-2"
            v-for="(feedback, index) in feedbacks">
            <div class="row">
              <div class="col-4">
                 <div class="w-100 d-inline-block text-center">
                <img v-if="feedback.patient.profile.avatar !== null" v-lazy="basePath+'/uploads/users/'+feedback.patient.id+'/'+feedback.patient.profile.avatar" class="d-block img-fluid rounded-circle border-white border border-3 border w_110px" :alt="feedback.patient.first_name +' '+  feedback.patient.last_name" :name="feedback.patient.first_name +' '+  feedback.patient.last_name">
              <img v-else v-lazy="basePath+'/uploads/users/default/patient.svg'" class="d-block img-fluid rounded-circle border-white border border-3 border w_110px" :alt="feedback.patient.first_name +' '+  feedback.patient.last_name" :name="feedback.patient.first_name +' '+  feedback.patient.last_name">
              </div>
              </div>
              <div class="col-8">
                <div class="view-rating-star mt-lg-2 w-100 float-left d-inline-block">
                  <h2 class="font-weight-bold mt-2 text_15 
                client-text d-lg-none d-block">
                {{ feedback.patient.first_name }} {{ feedback.patient.last_name }}</h2>
                  <star-rating 
                  class="float-lg-right mr-3"
                  active-color="#F8A401" 
                  :star-size="15"
                  v-model="feedback.avg_rating"
                  :read-only="true">
                  </star-rating>
                </div>
              </div>
            </div>
              <div class=" d-md-block mb-2 w-100">
                <h2 class="font-weight-bold text_15 
                client-text d-lg-block d-none">
                {{ feedback.patient.first_name }} {{ feedback.patient.last_name }}</h2>
                <p class="client-text text_14 feedback-text">
                {{ feedback.comment }}</p>
                <!-- <h2 class="user_identity"> {{feedback.patient.roles[0].name}} </h2> -->
              </div>
            </div>
          </VueSlickCarousel>
          <!-- <a class="carousel-control-next" v-on:click="showNext">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a> -->
        </div>
      </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
import StarRating from 'vue-star-rating'
export default {
  name: "FeedbackSectionComponent",
  components: { VueSlickCarousel, StarRating},
  props:['feedbacks','fileSystemDriver'],
  data() {
    return {
      basePath:'',
      settings: {
        arrows: true,
        dots:false,
        autoplay: false,
        slidesToShow:3,
        responsive: [
             {
               breakpoint: 1024,
               settings: {
                 slidesToShow: 2,
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
    }
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
  created() {
    
  },
  methods: {
    showNext() {
      this.$refs.settings.next()
    },
    showPrevious() {
      this.$refs.settings.prev()
    },
  },
}
</script>

<style>
.carousel-inner {
  max-height: 300px;
}

</style>