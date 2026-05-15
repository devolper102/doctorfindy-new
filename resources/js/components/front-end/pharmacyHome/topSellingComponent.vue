<template>
	<div>
		<div class="w-100 d-inline-block 
		top-selling-bg-image mt-4" style="background: url(/images/top-selling-bg-image.png) left center no-repeat;">
			<div class="container">
				<div class="d-flex align-items-center justify-content-between mt-3 mb-3">
					<h2 class="knockdoc-heading service-text text_25 mb-0 text_xs_20">Top Selling Items</h2>
					<a href="javascript:void(0)" class="service-text text_14 font-weight-bold">
		              VIEW ALL
		            </a>
				</div>
				<div class="row mt-3 mb-xl-3">
          <div class="col-xl-3 col-12 mb-3 mb-xl-0 pr-lg-0 col-sm-6 col-md-6 col-lg-6">
            <div class="d-inline-block w-100">
                <div class="mega-wrapper position-relative bg-white box_radius">

    <div class="mega-container w-100 d-flex 
    position-relative"
         @mouseenter="isHovering = true"
         @mouseleave="resetHover">

      <!-- LEFT CATEGORY LIST -->
      <ul class="mega-left bg-white p-0 m-0 
      position-relative box_radius w-100">
        <li
          v-for="cat in categories"
          :key="cat.id"
          @mouseenter="activeCategory = cat.id"
          :class="{ active: activeCategory === cat.id }"
        >
        <img :src="cat.icon" alt="picture">
        <span>
          {{ cat.name }}
      </span>
          <span class="arrow text_20 position-absolute">›
          </span>
        </li>
      </ul>

      <!-- RIGHT HOVER PANEL -->
      <div
        class="mega-overlay bg-white position-absolute"
        v-show="isHovering && activeCategory"
      >
        <div class="overlay-inner d-xl-flex">

          <!-- 2 COLUMNS -->
          <div class="overlay-cols d-xl-flex">
            <div class="overlay-col w-100 d-inline-block">
              <h4 class="service-text font-weight-bold text_16 mb-2">{{ activeCategoryName }}</h4>
              <ul>
                <li class="text-black mb-2" v-for="item in subCategories" :key="item">
                  {{ item }}
                </li>
              </ul>
            </div>

            <div class="overlay-col w-100 d-inline-block">
              <h4 class="service-text font-weight-bold text_16 mb-2">{{ activeCategoryName }}</h4>
              <ul>
                <li class="text-black mb-2" v-for="item in subCategories" :key="item">
                  {{ item }}
                </li>
              </ul>
            </div>
          </div>

          <!-- BRAND BOX -->
          <div class="brand-box ">
            <h4 class="text-white text_16">Shop by Brands
            </h4>
            <ul>
              <li class="text-white text_14" v-for="brand in brands" :key="brand">
                {{ brand }}
              </li>
            </ul>
            <img class="w-100 mt-3" src="/images/brand-bottles.png" alt="">
          </div>

        </div>
      </div>

    </div>

  </div>
      </div>
          </div>
          <div class="col-xl-2 p-lg-0 pl-lg-2 col-12 mb-3 mb-xl-0 col-sm-6 col-md-6 col-lg-6">
            <div class="d-inline-block w-100">
        <div class="w-100 d-inline-block bg-white 
        p-2 box_radius position-relative">
        <span class="badge-btn position-absolute text-white text_14 book-rounded">-25%</span>
          <p class="font-weight-bold service-text text_15 mt-2">
            This Week Deal
          </p>
          <p class="font-weight-bold text_15 time-text">5d: 12h : 42m : 27s</p>
          <img class="blood-pressure-image" src="/images/blood-pressure-image.png" alt="picture">
          <p class="font-weight-bold text_14">
            Amandean Wild Caught 
          </p>
          <p class="text_14 price-text">
            Equipment
          </p>
          <div class="price d-flex align-items-center justify-content-between">
            <div class="d-inline-block">
          <strong class="time-text text_15">
            $150.00
          </strong>
          </div>
          <div class="d-inline-block">
            <del class="text_14 price-text">
              $200.00
              </del>
          </div>
          <div class="d-inline-block">
            <button class="cart-btn border-0 text-white text_14 rounded-pill pt-1 pb-1 pl-2 pr-2 service-bg">
              <img src="/images/white-cart-icon.svg">
          </button>
          </div>
          </div>
        </div>
      </div>
          </div>
					<div class="col-xl-7 pl-xl-2 col-12 mb-3 mb-xl-0">
			<div class="d-inline-block w-100">
				<div class="page d-inline-block w-100 selling-product-section">
<!-- Product Grid -->
<div class="grid">
<div class="card bg-white position-relative d-flex box_radius p-2" v-for="product in filteredProducts" :key="product.id">
<div class="rating text_12 float-right mt-0">
⭐ {{ product.rating }} <span>({{ product.reviews }} reviews)</span>
</div>
<img class="selling-icon-product-image" :src="product.image" :alt="product.title" />

<h3 class="name text_13 font-weight-bold mb-1">
{{ product.title }}</h3>
<p class="price-text text_12">Powder</p>
<p class="price-text text_12">Pack Size: 850 gm</p>

<div class="price d-flex align-items-center justify-content-between">
  <div class="d-inline-block">
<strong class="service-text text_13">${{ product.price }}
</strong>
<br>
<del class="text_12 price-text" v-if="product.oldPrice">${{ product.oldPrice }}</del>
</div>
<div class="d-inline-block">
  <button class="cart-btn border-0 text-white text_14 rounded-pill pt-1 pb-1 pl-2 pr-2 service-bg" @click="addToCart(product)">
    <img src="/images/white-cart-icon.svg">
</button>
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
	</div>
</template>

<script>

export default {
  name: "topSellingComponent",
   data() {
    return {
      isHovering: false,
      activeCategory: null,

      categories: [
      {
        id: 1,
        name: "Medicines & Treatments",
        icon: "/images/medicines-treatment.svg"
      },
      {
        id: 2,
        name: "Vitamins & Supplements",
        icon: "/images/vitamins-supplement.svg"
      },
      {
        id: 3,
        name: "Beauty & Health",
        icon: "/images/beauty-health.svg"
      },
      {
        id: 4,
        name: "Homeopathic Remedies",
        icon: "/images/homeopathic-remedies.svg"
      },
      {
        id: 5,
        name: "Health Care",
        icon: "/images/health-care.svg"
      },
      {
        id: 6,
        name: "Personal Care",
        icon: "/images/personal-care.svg"
      },
      {
        id: 7,
        name: "Nutrition's & Supplements",
        icon: "/images/nutrition-supplement.svg"
      },
      {
        id: 8,
        name: "Sexual Wellness",
        icon: "/images/sexual-wellness.svg"
      },
      {
        id: 9,
        name: "Gift Sets",
        icon: "/images/gift-sets.svg"
      },
      {
        id: 10,
        name: "Weekly Deals",
        icon: "/images/weekly-deals.svg"
      },
    ],

      subCategories: [
        "Cough, Cold & Flu",
        "Aliquet",
        "Maecenas Commodo",
        "Arcu Id Cursus",
        "Condimentum"
      ],

      brands: [
        "Pfizer",
        "Abbott",
        "GSK",
        "Nestle"
      ],
      products: [
{
id: 11,
title: 'Nestle Everyday Tea Whitener Powder 850 gm Pouch',
category: 'nutrition',
price: 150,
oldPrice: 200,
discount: 25,
rating: 4.5,
reviews: 98,
image: '/images/selling-top-image-icon.svg'
},
{
id: 12,
title: 'Ultra Men Multivitamin',
category: 'vitamins',
price: 150,
oldPrice: 200,
discount: 25,
rating: 4.6,
reviews: 120,
image: '/images/selling-top-image-icon-2.svg'
},
{
id: 13,
title: 'Dettol Antiseptic Liquid',
category: 'skincare',
price: 150,
oldPrice: 200,
discount: 25,
rating: 4.7,
reviews: 210,
image: '/images/selling-top-image-icon-3.svg'
},
{
id: 14,
title: 'Rossmax Blood Pressure Monitor',
category: 'cold_fever',
price: 150,
oldPrice: 200,
discount: 25,
rating: 4.4,
reviews: 75,
image: '/images/selling-top-image-icon-4.svg'
},
{
id: 15,
title: 'Rossmax Blood Pressure Monitor',
category: 'cold_fever',
price: 150,
oldPrice: 200,
discount: 25,
rating: 4.4,
reviews: 75,
image: '/images/selling-top-image-icon-5.svg'
},
{
id: 16,
title: 'Nestle Everyday Tea Whitener Powder 850 gm Pouch',
category: 'nutrition',
price: 150,
oldPrice: 200,
discount: 25,
rating: 4.5,
reviews: 98,
image: '/images/selling-top-image-icon-6.svg'
},

],
    };
  },

  computed: {
    activeCategoryName() {
      const cat = this.categories.find(
        c => c.id === this.activeCategory
      );
      return cat ? cat.name : "";
    },
    filteredProducts() {
    return this.products; // abhi filter nahi lagaya
  }

  },

  methods: {
    resetHover() {
      this.isHovering = false;
      this.activeCategory = null;
    }
  }
  
};

</script>

<style>


</style>