<template>
	<div>
		<div class="w-100 d-inline-block shop-brand-slider bg-shop-brand">
			<div class="container">
          <div class="row mt-3 mb-3">
            <div class="col-12">
            	<div class="d-flex align-items-center justify-content-between">
            		<div class="d-inline-block">
            			<h2 class="knockdoc-heading service-text text_25 mb-0 text_xs_20">
			              Shop by Brands
			            </h2>
            		</div>
            		<div class="nav-buttons d-inline-block">
        <button
          class="nav-btn border-0 text_20 bg-green rounded-pill text-white"
          :class="{ disabled: currentIndex === 0 }"
          @click="prevSlide"
        >
          <span class="position-relative angle-left-right-icon">‹</span>
        </button>

        <button
          class="nav-btn border-0 text_20 bg-green rounded-pill text-white"
          :class="{ disabled: currentIndex >= maxIndex }"
          @click="nextSlide"
        >
          <span class="position-relative angle-left-right-icon">›</span>
        </button>
      </div>
            	</div>

  <div class="slider-wrapper w-100 mt-3">
      <div
        class="slider-track"
        :style="{ transform: `translateX(-${currentIndex * slideWidth}px)` }"
      >
        <div class="brand-card" v-for="(brand, i) in brands" :key="i">
          <img :src="brand.logo" alt="">
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

export default {
  name: "shopBrandComponent",
  data() {
    return {
      currentIndex: 0,
      slideWidth: 236, // card width + gap
      brands: [
        { logo: '/images/shop-brand-image.png' },
        { logo: '/images/shop-brand-image-2.png' },
        { logo: '/images/shop-brand-image-3.png' },
        { logo: '/images/shop-brand-image-4.png' },
        { logo: '/images/shop-brand-image-5.png' },
        { logo: '/images/shop-brand-image.png' }
      ]
    };
  },
  computed: {
    maxIndex() {
      return this.brands.length - 4; // visible cards
    }
  },
  methods: {
    nextSlide() {
      if (this.currentIndex < this.maxIndex) {
        this.currentIndex++;
      }
    },
    prevSlide() {
      if (this.currentIndex > 0) {
        this.currentIndex--;
      }
    }
  }
};

</script>

<style>

</style>