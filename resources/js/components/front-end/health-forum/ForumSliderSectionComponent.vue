<template>
  <div>
    <section class="online-chat-experience" id="health_slider">
      <div class="top-content">
        <div class="container">
          <VueSlickCarousel
              v-bind="c2Setting">
            <div v-for="(slide,index) in slides"v-if="hide_show === 'true'">
              <div class="row inner-slider">
                <div class="col-lg-4 offset-lg-2 col-12 order-2 order-lg-1">
                  <h3 class="text_black mt-3 mt-lg-5 font-weight-bold text-lg-left text-center" id="slide_title">{{slide.title}} {{slide.subtitle}}</h3>
                  <p class="text_black text_11 text-lg-left text-center px-5 px-lg-0">{{slide.description}}</p>
                </div>
                <div class="col-12 col-lg-6 order-1 order-lg-2">
                    <img v-lazy="'/uploads/settings/home/'+ slide.health_img":alt="slide.title"class="img-fluid w-50 text-center m-auto"/>
                </div>
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
  name: "ForumSliderSectionComponent",
  props: ['managements'],
  data() {
    return {
      c2Setting: {
        slidesToShow:1,
        arrows: true,
        health_community_slider: '',
        show_healthtabs: '',
        hide_show: '',
        slides: '',
      },
    }
  },
    created () {
    this.health_community_slider = this.managements.find(pf =>pf.meta_key ==='health_community_slider')
    this.slides = JSON.parse(this.health_community_slider.meta_value);
    this.show_healthtabs = this.managements.find(pf =>pf.meta_key ==='show_healthtabs')
    this.hide_show = this.show_healthtabs.meta_value;

  },
}
</script>

<style scoped>
.inner-slider{
  margin-top: 75px;
}
@media (max-width: 991px){
  .inner-slider{
    margin-top: 40px;
  }
}

</style>