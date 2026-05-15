<template>
  <div id="top-products">
    <section class="pharmacy-top-products-section mt-5 mb-5">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h2 class="text-center font-weight-bold text_24 mb-4">Top Selling Products</h2>
          </div>
        </div>
        <div class="row" v-if="products && products.length > 0">
          <div v-for="(product, index) in products" :key="product.id" 
               class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="product-card bg-white box-shadow rounded overflow-hidden h-100 position-relative">
              <a :href="product.slug ? '/pharmacy/medicine/' + product.slug : '#'" 
                 class="text-decoration-none text-dark d-block h-100 product-link"
                 style="position: relative; z-index: 1;">
                <div class="product-image position-relative">
                  <img v-if="product.image_url" 
                       :src="product.image_url" 
                       :alt="product.name"
                       class="img-fluid w-100"
                       style="height: 200px; object-fit: cover;"
                       @error="handleImageError($event)">
                  <div v-else class="bg-light d-flex align-items-center justify-content-center" 
                       style="height: 200px;">
                    <i class="fa fa-pills fa-3x text-muted"></i>
                  </div>
                  <div v-if="product.sale_price && product.price" class="badge badge-danger position-absolute" 
                       style="top: 10px; right: 10px;">
                    {{ getDiscountPercent(product.price, product.sale_price) }}% OFF
                  </div>
                </div>
                <div class="product-details p-3">
                  <h6 class="font-weight-bold text_14 mb-2 product-name">{{ product.name }}</h6>
                  <p class="text_12 text-muted mb-2" v-if="product.manufacturer">
                    {{ product.manufacturer }}
                  </p>
                  <div class="product-rating mb-2" v-if="product.rating">
                    <span class="text-warning">
                      <i v-for="n in 5" :key="n" 
                         :class="n <= product.rating ? 'fa fa-star' : 'fa fa-star-o'"></i>
                    </span>
                  </div>
                  <div class="product-price">
                    <span v-if="product.sale_price" class="text-primary font-weight-bold text_16">
                      Rs. {{ product.sale_price }}
                    </span>
                    <span v-if="product.price && product.sale_price" 
                          class="text-muted text_12 ml-2 text-decoration-line-through">
                      Rs. {{ product.price }}
                    </span>
                    <span v-else-if="product.price" class="text-primary font-weight-bold text_16">
                      Rs. {{ product.price }}
                    </span>
                  </div>
                </div>
              </a>
              <div class="product-details p-3 pt-0" style="position: relative; z-index: 2;">
                <button class="btn btn-primary btn-sm w-100 mt-2" 
                        @click.stop.prevent="addToCart(product)"
                        style="position: relative; z-index: 10;">
                  <i class="fa fa-shopping-cart mr-1"></i> Add to Cart
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="row" v-else>
          <div class="col-12 text-center">
            <p class="text-muted">No products available at the moment.</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "PharmacyTopProductsSectionComponent",
  props: ['fileSystemDriver', 'products'],
  data() {
    return {
      basePath: window.location.origin
    }
  },
  methods: {
    getDiscountPercent(price, salePrice) {
      if (!price || !salePrice) return 0;
      return Math.round(((price - salePrice) / price) * 100);
    },
    handleImageError(event) {
      // Hide image and show icon fallback
      event.target.style.display = 'none';
      const fallback = event.target.nextElementSibling;
      if (fallback && fallback.classList.contains('bg-light')) {
        fallback.style.display = 'flex';
      }
    },
    addToCart(product) {
      // Prevent navigation when clicking add to cart
      event.stopPropagation();
      // Add to cart functionality
      alert(`Added ${product.name} to cart`);
    }
  }
}
</script>

<style scoped>
.product-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.15) !important;
}
.product-card {
  cursor: pointer;
}
.product-card a {
  cursor: pointer;
  display: block;
}
.product-name {
  min-height: 40px;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.text-decoration-line-through {
  text-decoration: line-through;
}
</style>

