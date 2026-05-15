<template>
	<div>
		<div class="w-100 d-inline-block bg-trending-product pb-xl-4">
         <div class="container">
           <div class="row mt-3 mb-3">
          <div class="col-12">
            <div class="w-100 d-inline-block trending-product-section">
              <div class="d-xl-flex align-items-center justify-content-between">
                <div class="d-inline-block">
                  <h2 class="knockdoc-heading service-text text_25 mb-0 text_xs_20">Trending products</h2>
                </div>
                <div class="filters d-inline-block mt-xl-0 mt-3">
                  <button
                  v-for="cat in categoryList"
                  :key="cat.id"
                  :class="['filter-btn', { active: activeCategory === cat.id }]"
                  @click="activeCategory = cat.id"
                  >
                  {{ cat.name }}
                  </button>
                  </div>
              </div>
              <div class="page d-inline-block w-100 mt-2">

<!-- Product Grid -->
<div class="grid">
<div class="card bg-white position-relative d-flex box_radius p-2" v-for="product in filteredProducts" :key="product.id">
<span v-if="product.discount" class="badge position-absolute text-white text_14 book-rounded">-{{ product.discount }}%</span>
<button class="border text_12 text-white service-bg box_radius position-absolute out-stock-btn">OUT OF STOCK
</button>
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


<div class="price d-flex align-items-center mt-2 mb-2 justify-content-between">
  <div class="d-inline-block">
<strong class="service-text text_15">${{ product.price }}
</strong>
<br>
<del class="text_14" v-if="product.oldPrice">${{ product.oldPrice }}</del>
</div>
<div class="d-inline-block">
  <button class="cart-btn border-0 text-white text_14 rounded-pill pt-1 pb-1 pl-2 pr-2 service-bg" @click="addToCart(product)">
    <img class="mr-2" src="/images/white-cart-icon.svg">
    Add to Cart
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
  name: "trendingProductComponent",
  data() {
  	return {

  		activeCategory: 'all',
  		 categoryList: [
{ id: 'all', name: 'Show All' },
{ id: 'cold_fever', name: 'Cold & Fever' },
{ id: 'dry_eyes', name: 'Dry Eyes' },
{ id: 'nutrition', name: 'Nutrition' },
{ id: 'probiotics', name: 'Probiotics' },
{ id: 'skincare', name: 'Skincare' },
{ id: 'vitamins', name: 'Vitamins' }
],
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
image: '/images/trending-product-image.png'
},
{
id: 10,
title: 'Ultra Men Multivitamin',
category: 'vitamins',
price: 150,
oldPrice: 200,
discount: 25,
rating: 4.6,
reviews: 120,
image: '/images/trending-product-image-2.png'
},
{
id: 11,
title: 'Dettol Antiseptic Liquid',
category: 'skincare',
price: 150,
oldPrice: 200,
discount: 25,
rating: 4.7,
reviews: 210,
image: '/images/trending-product-image-3.png'
},
{
id: 12,
title: 'Rossmax Blood Pressure Monitor',
category: 'cold_fever',
price: 150,
oldPrice: 200,
discount: 25,
rating: 4.4,
reviews: 75,
image: '/images/trending-product-image-4.png'
},
{
id: 13,
title: 'Rossmax Blood Pressure Monitor',
category: 'cold_fever',
price: 150,
oldPrice: 200,
discount: 25,
rating: 4.4,
reviews: 75,
image: '/images/trending-product-image-5.png'
},
{
id: 14,
title: 'Nestle Everyday Tea Whitener Powder 850 gm Pouch',
category: 'nutrition',
price: 150,
oldPrice: 200,
discount: 25,
rating: 4.5,
reviews: 98,
image: '/images/trending-product-image.png'
},
{
id: 15,
title: 'Ultra Men Multivitamin',
category: 'vitamins',
price: 150,
oldPrice: 200,
discount: 25,
rating: 4.6,
reviews: 120,
image: '/images/trending-product-image-2.png'
},
{
id: 16,
title: 'Dettol Antiseptic Liquid',
category: 'skincare',
price: 150,
oldPrice: 200,
discount: 25,
rating: 4.7,
reviews: 210,
image: '/images/trending-product-image-3.png'
},

],
  	}

  },
  computed: {
      filteredProducts() {
if (this.activeCategory === 'all') return this.products
return this.products.filter(p => p.category === this.activeCategory)
},
      
    },


};

</script>

<style>


</style>