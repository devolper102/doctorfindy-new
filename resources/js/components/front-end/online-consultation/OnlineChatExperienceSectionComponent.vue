<template>
  <div>
    <section class="online-chat-experience">
      <div class="bg-online-chat-experience w-100 d-inline-block pb-5">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="heading-online-chat-experience">
                <h2 class="font-weight-bold text-center mt-4 mb-4 text_xs_25">
                  What our users say about their online chat experience

                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="top-content">
          <div class="container">
            <div id="online-chat-slider" class="carousel slide" data-ride="carousel">
              <div class="row">
                <div class="carousel-inner w-100" role="listbox" style="overflow: visible;height: 250px;">
                  <VueSlickCarousel
                      ref="c2" v-bind="c2Setting" @beforeChange="onBeforeChangeC2"
                  >
                    <div v-if="review.user !== null" v-for="review in reviews" class="bg-white w-80 mx-auto d-block box_radius box_shadow box_height online-chat-experience-slider">
                      <div class="online-user-images-text p-3 text-center">
                        <img class="w-35px h_35 rounded-pill m-auto" v-if="review.user.profile.avatar !== null" v-lazy="'/uploads/users/'+review.user.id+'/'+review.user.profile.avatar" :alt="review.user.first_name +' '+  review.user.last_name" >
                        
                        <img class="w-35px h_35 rounded-pill m-auto"v-else v-lazy="'/uploads/users/default/patient.svg'" :alt="review.user.first_name +' '+  review.user.last_name" >
                        <span class="text_black text_15 d-block">
                          {{review.user.first_name}} {{review.user.last_name}}
												</span>
                        <p class="text_black text_14 w-md-80 m-auto">
                          {{review.comment}}
                        </p>
                      </div>
                    </div>
                  </VueSlickCarousel>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
export default {
  components: { VueSlickCarousel },
  name: "OnlineChatExperienceSectionComponent",
  props:['reviews'],
  data() {
    return {
      c2Setting: {
        arrows: true,
        dots: false,
        slidesToShow:3,
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
    }
  },
  created () {

  },
  methods: {
    onBeforeChangeC2(currentPosition, nextPosition) {
      this.$refs.c2.goTo(nextPosition)
    },
  }
}
</script>

<style scoped>

</style>