<template>
  <div>
      <div class="container">
        <div class="row mt-2">
          <div class="col-12">
            <div class="d-flex align-items-center justify-content-between order-medicine-main">
              <div class="d-inline-block order-medicine-image pr-2 position-relative">
                <img class="book-rounded" src="/images/order-medicine-image.png" alt="picture">
                <div class="position-absolute order-medicine-box">
                  <span class="text_black text_14">Order Medicines</span>
                  <p class="text_black font-weight-bold text_16">Get 20% Off</p>
                  <div class="mt-2 shop-book-now w-100 d-inline-block">
                    <a href="javascript:void(0)" class="text-white service-bg d-inline-block text_14 book-rounded">Shop Now</a>
                  </div>
                </div>
              </div>
              <div class="d-inline-block order-medicine-image pr-2 position-relative">
                <img class="book-rounded" src="/images/order-medicine-image-2.png" alt="picture">
                <div class="position-absolute order-medicine-box">
                  <span class="text_black text_14">Medical Equipment</span>
                  <p class="text_black font-weight-bold text_16">Save 20% Order</p>
                  <div class="mt-2 shop-book-now w-100 d-inline-block">
                    <a href="javascript:void(0)" class="text-white service-bg d-inline-block text_14 book-rounded">Order Now</a>
                  </div>
                </div>
              </div>
              <div class="d-inline-block order-medicine-image pr-2 position-relative">
                <img class="book-rounded" src="/images/order-medicine-image-3.png" alt="picture">
                <div class="position-absolute order-medicine-box">
                  <span class="text_black text_14">Medical Devices</span>
                  <p class="text_black font-weight-bold text_16">Get 10% Off</p>
                  <div class="mt-2 shop-book-now w-100 d-inline-block">
                    <a href="javascript:void(0)" class="text-white service-bg d-inline-block text_14 book-rounded">Shop Now</a>
                  </div>
                </div>
              </div>
              <div class="d-inline-block order-medicine-image position-relative">
                <img class="book-rounded" src="/images/order-medicine-image-4.png" alt="picture">
                <div class="position-absolute order-medicine-box">
                  <span class="text_black text_14">Safety  Mask Set</span>
                  <p class="text_black font-weight-bold text_16">Extra 20% Off</p>
                  <div class="mt-2 shop-book-now w-100 d-inline-block">
                    <a href="javascript:void(0)" class="text-white service-bg d-inline-block text_14 book-rounded">Shop Now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-6">
            <h2 class="knockdoc-heading service-text text_25 mb-0 text_xs_20">
              Categories
            </h2>
          </div>
          <div class="col-6 mt-xl-2 mt-1">
            <a class="text-green text_14 font-weight-bold float-right" href="javascript:void(0)">
              VIEW ALL
            </a>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-12">
            <div class="d-flex align-items-center justify-content-between category-medicine-main">
              <div class="d-inline-block category-medicine-image position-relative 
              pr-2">
                <img class="book-rounded" src="/images/category-medicine-image.png" alt="picture">
                <div class="position-absolute category-medicine-box">
                  <p class="text-white font-weight-bold text_16 text_xs_13">Surgical</p>
                </div>
              </div>
              <div class="d-inline-block category-medicine-image position-relative 
              pr-2">
                <img class="book-rounded" src="/images/category-medicine-image-2.png" alt="picture">
                <div class="position-absolute category-medicine-box">
                  <p class="text-white font-weight-bold text_16 text_xs_13">Consumer</p>
                </div>
              </div>
              <div class="d-inline-block category-medicine-image position-relative 
              pr-2">
                <img class="book-rounded" src="/images/category-medicine-image-3.png" alt="picture">
                <div class="position-absolute category-medicine-box">
                  <p class="text-white font-weight-bold text_16 text_xs_13">Appliances & Devices
                  </p>
                </div>
              </div>
              <div class="d-inline-block category-medicine-image position-relative 
              pr-2">
                <img class="book-rounded" src="/images/category-medicine-image-4.png" alt="picture">
                <div class="position-absolute category-medicine-box">
                  <p class="text-white font-weight-bold text_16 text_xs_13">Medicine</p>
                </div>
              </div>
              <div class="d-inline-block category-medicine-image position-relative">
                <img class="book-rounded" src="/images/category-medicine-image-5.png" alt="picture">
                <div class="position-absolute category-medicine-box">
                  <p class="text-white font-weight-bold text_16 text_xs_13">Mom & Baby Care</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <top-selling-section></top-selling-section>
      <trending-product-section></trending-product-section>
      <div class="w-100 d-inline-block bg-medicine-order-section pb-4" style="background: url(/images/bg-medicine-order-section.png) left center no-repeat;">
        <div class="container">
          <div class="row mt-4">
            <div class="col-12 mb-3 mb-xl-0 col-xl-4 col-sm-6 col-md-6 col-lg-6">
              <div class="images">
                  <img class="img image-main-doctor" :src="images.main" alt="doctor writing" />
                  <span class="shape shape-blue"></span>
                  <span class="shape shape-light"></span>
                  </div>
            </div>
            <div class="col-12 col-xl-7 col-sm-6 col-md-6 col-lg-6">
              <!-- Right Content -->
<div class="content mt-2">
<h3 class="text-black text_25 font-weight-bold w-55 w-xs-100 w-sm-100 w-md-100 w-ipad-100 text_xs_20">{{ title }}</h3>
<ul class="steps mt-3">
<li class="d-flex align-items-center mb-2" v-for="step in steps" :key="step.id">
<span class="circle-number service-text text_14 d-inline-block rounded-pill text-center font-weight-bold 
mr-2">
{{ step.id }}</span>
<p class="service-text text_15">{{ step.text }}</p>
</li>
</ul>

<h4 class="note text_20 font-weight-bold">{{ noteTitle }}</h4>
<p class="note-text text-black text_14 mt-1">{{ noteText }}
</p>
<button class="border-0 bg-green text-white book-rounded p-2 mt-1" @click="orderNow">
{{ buttonText }}
</button>
</div>
            </div>
          </div>
        </div>
      </div>
      <shop-brand-section></shop-brand-section>
      <div class="container">
        <div class="row mt-3">
          <div class="col-12 col-xl-9">
            <h2 class="knockdoc-heading service-text text_25 mb-0 text_xs_20">
              Our Customer Feedback
            </h2>
            <p class="service-text text_14">
              Don’t take our word for it. Trust our customers
            </p>
          </div>
          <div class="col-12 col-xl-3">
            <div class="feedback-slide-icon w-100 d-inline-block">
              <a class="carousel-control-prev" @click="showPrevious">
            <span class="carousel-control-prev-icon float-left" aria-hidden="true"></span>
            <span class="float-right previous-text d-inline-block">Previous</span>
          </a>
          <a class="carousel-control-next" @click="showNext">
            <span class="service-text float-left ml-2">Next</span>
            <span class="carousel-control-next-icon float-right" aria-hidden="true"></span>
          </a>
            </div>
          </div>
        </div>
        <div class="row mt-3 mb-3">
          <div class="col-12">
             <div class="feedbackSlider w-100 
             d-inline-block">
  <VueSlickCarousel ref="feedbackSlider" v-bind="c3Setting">
    <div v-for="(n, index) in 6" :key="index">
      <div class="feedback-client-slider w-100 d-inline-block box_radius p-2 mt-xl-0 mt-3">
        <div class="row">
          <div class="col-4">
            <div class="w-100 d-inline-block">
              <img
                class="rounded-circle w_75px h_75"
                src="/images/patient.svg"
                alt="picture">
            </div>
          </div>

          <div class="col-8">
            <div class="view-rating-star mt-2 w-100 d-inline-block">
              <star-rating
                class="float-lg-right mr-3"
                active-color="#F8A401"
                star-size="15">
              </star-rating>
            </div>
          </div>
        </div>

        <div class="w-100 d-inline-block mt-2">
          <h2 class="font-weight-bold text_16 text_black">
            Floyd Miles
          </h2>
          <p class="text_black text_14">
            The last visit to Chughtai lab is too good. It was a convenient and hassle free visit
          </p>
        </div>

      </div>
    </div>

  </VueSlickCarousel>

</div>

          </div>
        </div>
      </div>
  </div>
</template>

<script>
import StarRating from 'vue-star-rating'
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
export default {
  components: { VueSlickCarousel, StarRating},
  name: "pharmacyBannerComponent",
  data() {
      return {
        c3Setting: {
  arrows: true,
  dots: true,
  autoplay: false,
  infinite: true,
  speed: 800,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1
      }
    }
  ]
},
      
        title: 'How to order medicines on DoctorFindy? It\'s Simple.',
        steps: [
{ id: 1, text: 'Upload a photo of your prescription' },
{ id: 2, text: 'Add delivery address and place the order' },
{ id: 3, text: 'We will call you to confirm the medicines' },
{ id: 4, text: 'Sit back! Your medicines will be delivered at your doorstep' }
],
noteTitle: "Don't have Prescription? Don't worry!",
noteText: 'Simply search & add the medicines OR get consultation from DoctorFindy doctor',
buttonText: 'INSTANT ORDER NOW',
images: {
main: '/images/image-main-doctor.png',
},
        
      };
    },
    
    methods: {
      showNext() {
      this.$refs.feedbackSlider.next()
    },
    showPrevious() {
      this.$refs.feedbackSlider.prev()
    },
      
    },
    
}
</script>
<style>


</style>

