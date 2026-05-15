<template>
  <div>
    <section class="online-chat-experience" v-if="forums.length >= 1">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="heading-online-chat-experience">
              <h2 class="font-weight-bold text-center
							mt-4 mb-4">
                Most Helpful Question From Our Lovely Community
              </h2>
            </div>
          </div>
        </div>
      </div>
      <div class="top-content" id="question_slider">
        <div class="container">
          <VueSlickCarousel
              v-bind="c2Setting"
          >
            <div v-for="forum in forums">
              <div class="text-center ml-2 mr-2 position-relative">
                    <div class="community-helper-image">
                      <img class="w-40px h_40 rounded-pill m-auto" v-lazy="'/uploads/users/'+forum.users[0].id+'/'+forum.users[0].profile.avatar" :alt="forum.users[0].first_name +' '+ forum.users[0].last_name">
                    </div>
                    <div class="community-helper-name w-100 d-inline-block">
                      <span class="text_black text_18 font-weight-bold">{{ forum.users[0].first_name }} {{ forum.users[0].last_name }}</span>
                    </div>
                    <div class="community-helper-text">
                      <p class="text_12 text_black">
                        {{ forum.question_title }}
                      </p>
                    </div>
                    <div class="community-helper-box doctor_profile w-100 w-xs-90 d-inline-block box_radius mt-4">
                      <div class="online-user-images-text p-3 text-center">
                        <p class="text_black text_13">
                          <span class="slider_answer" v-if="forum.answers.length">{{ forum.answers[0].pivot.answer }}</span>
                        </p>
                        <div class="icon-weight-problem pb-2">
                          <a class="tags-icon text_black text_13 float-left" href="#">
                            <i class="fa fa-tag mr-2" aria-hidden="true"></i>
                            Weight problem
                          </a>
                          <a class="text_13 text_black float-right" href="#">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            {{ forum.views }}
                          </a>
                        </div>
                      </div>
                    </div>
                  <a class="position-absolute" :href="'/ask-a-doctor-online/speciality/'+forum.speciality.slug" style="top: 0;left: 0;bottom: 0;right: 0;">
                </a>
            </div>
            </div>

          </VueSlickCarousel>
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
  name: 'QuestionSliderSectionComponent',
  props: ['forums'],
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
  created () {
    console.log('fvfvfgf',this.forums)
  }
}
</script>

<style scoped>
  
</style>