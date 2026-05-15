<template>
	<div>
		<div class="container">
			<div class="row mt-4 mb-4">
				<div class="col-12 col-xl-9 mb-3 mb-lg-0">
					<div class="row">
						<div class="col-12 col-lg-6 mb-3 mb-lg-0">
					<div class="pharmacy-detail-slider w-100 d-inline-block box_radius">
						<VueSlickCarousel v-bind="c2Setting" @afterChange="afterChange">
    <div
      v-for="(image, index) in img"
      :key="index"
      class="product-detail-slider-image mt-5"
      @mousemove="zoom"
      @mouseleave="resetZoom"
      :style="zoomStyle"
    >
      <img :src="image" class="zoom-img w-100 d-inline-block" />
    </div>
  </VueSlickCarousel>

					</div>
				</div>
				<div class="col-12 col-lg-6 mb-3 mb-lg-0">
					<div class="w-100 d-inline-block border-bottom 
					pb-2">
						<p class="font-weight-bold text_14 time-text">
							<span class="text_black">Category:</span> Beauty & Health. Multivitamin. Natural Supplements
						</p>
						<h2 class="font-weight-bold text_black text_24 text_xs_20 mt-2 mb-0">
							Herbiotics Saw Palmetto (Prezoom) 270mg 30s
						</h2>
						<div class="view-rating-star mt-2 w-100 d-flex">
              <star-rating
                active-color="#F8A401"
                star-size="15">
              </star-rating>
              <span class="text_black font-weight-bold text_14 ml-3">4.5</span>
            </div>
					</div>
					<div class="w-100 d-inline-block increment-btn-section">
						<p class="text_black text_13 mt-2">
							<span class="font-weight-bold">SKU:</span> 0039400501237
						</p>
						<p class="text_black text_13 mt-2">
							<span class="font-weight-bold">Tag:</span> herbiotics
						</p>
						<div class="product-box w-100 d-inline-block 
						mt-2">
    <!-- Size / Pack -->
    <div class="title">
    	<p class="text_black text_14 font-weight-bold">
    	Size/Pack:</p>
    </div>
    <div class="pack-btns d-flex mb-2 mt-2">
      <button class="pack-btn border-0 text_14 rounded-pill"
        :class="{active: pack==='Per Pack'}"
        @click="pack='Per Pack'">
        Per Pack
      </button>
      <button class="pack-btn border-0 text_14 rounded-pill"
        :class="{active: pack==='Per Box'}"
        @click="pack='Per Box'">
        Per Box
      </button>
    </div>
    <div class="mg-title">
    	<p class="text_black text_14 font-weight-bold">
    	MG</p>
    </div>
    <div class="mg-options d-flex mb-2 mt-2">
      <div class="mg-box book-rounded d-flex align-items-center text_14 justify-content-center"
        v-for="mg in mgs"
        :key="mg"
        :class="{active:selectedMG===mg}"
        @click="selectedMG=mg">
        {{mg}}
      </div>
    </div>
    <div class="cart-area box_radius mt-3">
      <div class="qty-cart d-flex align-items-center">
        <div class="qty-box bg-white d-flex align-items-center rounded-pill">
          <button class="text_18" @click="qty>1 && qty--">
          −</button>
          <span class="text_15 text-center">{{qty}}</span>
          <button class="text_18" @click="qty++">+</button>
        </div>
        <button class="add-cart text-white text_15 font-weight-bold rounded-pill border-0">ADD TO CART
        </button>
      </div>
      <button class="buy-now rounded-pill border-0 service-bg text-white font-weight-bold text_15 mt-3">BUY IT NOW</button>
    </div>
    <div class="discount d-flex align-items-center mt-3 box_radius">
    	<img src="/images/ticket-discount.svg" alt="picture">
    	<p class="text_14">
    		Add 15 products to cart and get 10$ discount
    	</p>
    </div>
  </div>
					</div>
				</div>
					</div>
					<div class="row mt-3 mb-3">
				<div class="col-12">
					<div class="w-100 d-inline-block pharmacy-reviews-tabs">
						<div class="tabs-header d-flex mb-2">
    <button
      class="tab-btn border-0 text_14 book-rounded"
      :class="{ active: activeTab === 'description' }"
      @click="activeTab = 'description'"
    >
      Description
    </button>

    <button
      class="tab-btn border-0 text_14 book-rounded"
      :class="{ active: activeTab === 'reviews' }"
      @click="activeTab = 'reviews'"
    >
      Reviews (3)
    </button>
  </div>

  <!-- Tabs Content -->
  <div class="tabs-content w-100 d-inline-block mt-3">
    <!-- DESCRIPTION -->
    <div v-show="activeTab === 'description'" class="tab-panel">
      <p class="text_black text_14">
        Priorin Caps: For visibly fuller, stronger hair in as early as 12 weeks. It is a combination of millet extract, biotin, L-cystine and calcium pantothenate that has been clinically shown to promote, stimulate and improve hair growth . Ingredients : Biotin: 100µg, Pantothenic Acid: 14mg, Cystine 3mg, Millet oily extract 210mg . Lock your hair fall with Priorin!
      </p>
      <h4 class="font-weight-bold text_black text_16 mt-3">Precautions</h4>
      <p class="text_black text_14">
        Keep it out of the reach of children. Store it below room temperature
        (below 25°C). Do not overdose.
      </p>
      <h4 class="font-weight-bold text_black text_16 mt-3">Side Effect</h4>
      <p class="text_black text_14">
        No side effects are reported. Consult a doctor if discomfort occurs.
      </p>
    </div>

    <!-- REVIEWS -->
    <div v-show="activeTab === 'reviews'" class="tab-panel">
      <div class="reviews-detail-wrapper w-100 
      d-inline-block box_radius">
  <!-- Rating Summary -->
  <div class="rating-summary pl-xl-3 pl-2 pr-xl-3 pr-2 pt-2 pb-2 box_radius w-100 d-xl-flex">
    <div class="rating-left mt-xl-3">
      <h1 class="text_black mb-1">{{ averageRating }}</h1>
      <div class="view-rating-star mt-1 w-100 d-flex">
        <star-rating
          active-color="#F8A401"
          star-size="15">
        </star-rating>
      </div>
      <p class="text_black text_14">All reviews come from verified purchasers</p>
    </div>

    <div class="rating-right">
      <div class="rating-row" v-for="rate in ratings" :key="rate.star">
        <span>{{ rate.star }} stars</span>
        <div class="bar">
          <div class="fill" :style="{ width: rate.percent + '%' }"></div>
        </div>
        <span>{{ rate.count }}</span>
      </div>
    </div>
  </div>

  <!-- Reviews List -->
  <div v-for="(review, index) in reviews" :key="index">
  <div class="review-item d-flex pt-3 pb-2">
  	<div class="d-inline-block customer-review-image">
      <img class="avatar" src="/images/patient.svg" alt="picture">
    </div>
    <div class="review-content d-flex align-items-center justify-content-between w-95">
    	<div class="d-inline-block">
      <h4 class="text_black font-weight-bold text_15 mb-1">
      {{ review.name }}</h4>
      <span class="date text_14">{{ review.date }}</span>
      </div>
      <div class="view-rating-star d-flex">
        <star-rating
          active-color="#F8A401"
          star-size="15">
        </star-rating>
        <span class="text_black font-weight-bold text_14 ml-3">4.5</span>
      </div>
    </div>
  </div>
  <div class="w-100 d-inline-block">
  	<p class="text_14 text-fee">{{ review.text }}</p>
  </div>
</div>
  <!-- Add Review -->
  <div class="add-review mt-3 box_radius p-xl-3 p-2">
    <h3 class="text_black mb-2 font-weight-bold text_20 text-capitalize">Add a Review</h3>
    <p class="note text_14">Your email address will not be published. Required fields are marked *</p>
    <div class="view-rating-star d-inline-block w-100 mt-1">
      <star-rating
        active-color="#F8A401"
        star-size="15">
      </star-rating>
    </div>
    <textarea class="w-100 mt-2 p-2 box_radius" placeholder="Your review *" rows="5" v-model="newReview.text"></textarea>

    <button class="mt-2 border-0 text-white service-bg rounded-pill pt-2 pb-2 pl-5 pr-5" @click="submitReview">SEND</button>
  </div>

</div>

    </div>

  </div>
					</div>
				</div>
			</div>
			<detail-trending-product-section>
			</detail-trending-product-section>
				</div>
				<div class="col-12 col-xl-3">
					<div class="page d-inline-block w-100 mt-2">

<!-- Product Grid -->
<div class="grid">
<div class="card bg-white position-relative d-flex box_radius p-2" v-for="product in filteredProducts" :key="product.id">
<span v-if="product.discount" class="badge position-absolute text-white text_14 book-rounded">-{{ product.discount }}%
</span>
<img class="mt-4 mb-2" :src="product.image" :alt="product.title" />


<p class="text_15 service-text">
{{ product.category }}</p>
<h3 class="name text_16 font-weight-bold mt-2 mb-2">
{{ product.title }}</h3>
<p class="category text_14">Powder</p>
<p class="category text_14">Pack Size: 850 gm</p>
<div class="rating text_14">
⭐ {{ product.rating }} <span>({{ product.reviews }} reviews)</span>
</div>
  <div class="d-inline-block w-100 mt-1">
<strong class="service-text text_15">${{ product.price }}
</strong>
<del class="text_14 ml-2" v-if="product.oldPrice">${{ product.oldPrice }}</del>
</div>
<div class="d-inline-block w-100 mt-1">
  <button class="cart-btn border-0 text-white text_14 rounded-pill p-2 service-bg w-100" @click="addToCart(product)">
    <img class="mr-2" src="/images/white-cart-icon.svg">
    Add to Cart
</button>
</div>
<div class="w-100 d-inline-block deal-list-slider mt-2">
	<div class="deal-slider w-100 d-inline-block text-center">
    <div class="deal-content">
      <p class="time-text text_16 font-weight-bold mb-2">
        {{ slides[activeIndex] }}
      </p>

      <div class="dots d-flex justify-content-center">
        <span
          v-for="(slide, index) in slides"
          :key="index"
          :class="{ active: activeIndex === index }"
          @click="goToSlide(index)"
        ></span>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<div class="w-100 d-flex mt-3 vitamin-bottle-box">
	<!-- CARD 1 -->
  <div class="vitamin-card green w-100 d-inline-block box_radius position-relative vitamin-card-green" style="background: url(/images/vitamin-card-green-image.png) left center no-repeat;">
    <div class="card-image text-center mb-2">
      <img src="/images/bottle-green.png" alt="Bottle">
    </div>
    <div class="card-content text-center">
      <span class="subtitle text_14 d-block mb-1">Pyridoxine Vitamin B6
      </span>
      <h2 class="font-weight-bold mb-2 text_22">Vitamins &<br>Supplements</h2>
      <a href="javascript:void(0)" class="btn green-btn d-inline-block text-white font-weight-bold text_14 rounded-pill">View more ›</a>
    </div>
  </div>

  <!-- CARD 2 -->
  <div class="vitamin-card orange mt-3 mt-lg-0 mt-md-0 mt-xl-3 w-100 d-inline-block box_radius position-relative vitamin-card-orange" style="background: url(/images/vitamin-card-orange-image.png) left center no-repeat;">
    <div class="card-image text-center mb-2">
      <img src="/images/pill-jar.png" alt="Pill Jar">
    </div>
    <div class="card-content text-center">
      <span class="subtitle text_14 d-block mb-1">Pyridoxine Vitamin B6</span>
      <h2 class="font-weight-bold mb-2 text_22">Vitamins &<br>Supplements</h2>
      <a href="javascript:void(0)" class="btn orange-btn d-inline-block text-white font-weight-bold text_14 rounded-pill">Shop now ›</a>
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
	components: 
  {
  	VueSlickCarousel,
  	StarRating,
  },
  name: "productDetailBannerComponent",
data() {
    return {
    	activeIndex: 2,
    	activeCategory: 'all',
    	averageRating: 4.7,
    	activeTab: 'description',
      zoomStyle: {},
      activeImageIndex: 0,
      pack:'Per Pack',
      mgs:[150,270,450,280],
      selectedMG:270,
      qty:1,
      img: [
        '/images/trending-detail-slider-image.png',
        '/images/trending-product-image-4.png',
        '/images/trending-product-image-2.png',
        '/images/trending-product-image-5.png'
      ],
       ratings: [
        { star: 5, percent: 90, count: 269 },
        { star: 4, percent: 75, count: 25 },
        { star: 3, percent: 40, count: 11 },
        { star: 2, percent: 20, count: 1 },
        { star: 1, percent: 30, count: 15 }
      ],
      reviews: [
        {
          name: 'Cody Fiser',
          date: 'May 20, 2023',
          rating: 4.5,
          avatar: 'https://i.pravatar.cc/50',
          text: 'Premium viverra suspendisse potenti nullam ac tortor vitae purus.'
        },
        {
          name: 'Cody Fiser',
          date: 'May 20, 2023',
          rating: 4.5,
          avatar: 'https://i.pravatar.cc/51',
          text: 'Vivamus at augue eget arcu dictum varius.'
        }
      ],
      slides: [
        "5d : 12h : 42m : 27s",
        "4d : 08h : 10m : 55s",
        "5d : 12h : 42m : 27s",
        "3d : 20h : 15m : 10s",
        "2d : 05h : 30m : 40s"
      ],
      newReview: {
        rating: 0,
        text: ''
      },
      products: [
{
id: 9,
title: 'Nestle Everyday Tea Whitener Powder 850 gm Pouch',
category: 'nutrition',
price: 150,
oldPrice: 200,
discount: 25,
rating: 4.5,
reviews: 98,
image: '/images/detail-grid-image.png'
},

],
      c2Setting: {
        arrows: true,
        dots: false,
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1
      }
    };
  },
computed: {
      filteredProducts() {
if (this.activeCategory === 'all') return this.products
return this.products.filter(p => p.category === this.activeCategory)
},
      
    },
  methods: {
  	goToSlide(index) {
      this.activeIndex = index;
    },
  	submitReview() {
      if (!this.newReview.text || !this.newReview.rating) return;

      this.reviews.unshift({
        name: 'Anonymous',
        date: new Date().toDateString(),
        rating: this.newReview.rating,
        avatar: 'https://i.pravatar.cc/52',
        text: this.newReview.text
      });

      this.newReview.text = '';
      this.newReview.rating = 0;
    },
    zoom(e) {
      const zoomer = e.currentTarget;
      const rect = zoomer.getBoundingClientRect();

      const x = ((e.clientX - rect.left) / zoomer.offsetWidth) * 100;
      const y = ((e.clientY - rect.top) / zoomer.offsetHeight) * 100;

      this.zoomStyle = {
        backgroundImage: `url(${this.img[this.activeImageIndex]})`,
        backgroundPosition: `${x}% ${y}%`,
        backgroundSize: '250%',
        backgroundRepeat: 'no-repeat'
      };
    },

    resetZoom() {
      this.zoomStyle = {};
    },

    afterChange(index) {
      this.activeImageIndex = index;
      this.zoomStyle = {};
    }
  }
};
</script>

<style>
</style>