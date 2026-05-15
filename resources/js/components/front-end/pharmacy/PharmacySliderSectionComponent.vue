<template>
  <div>
    <section class="pharmacy-slider-section">
      <div class="container-fluid p-0">
        <div id="pharmacyCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="pharmacy-slide-bg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 400px; display: flex; align-items: center; justify-content: center;">
                <div class="container text-center text-white">
                  <h1 class="display-4 font-weight-bold mb-3">Welcome to Our Pharmacy</h1>
                  <p class="lead mb-4">Your trusted source for quality medicines and health products</p>
                  <a href="#explore-categories" class="btn btn-light btn-lg px-5 py-3">Shop Now</a>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="pharmacy-slide-bg" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); min-height: 400px; display: flex; align-items: center; justify-content: center;">
                <div class="container text-center text-white">
                  <h1 class="display-4 font-weight-bold mb-3">Best Prices Guaranteed</h1>
                  <p class="lead mb-4">Get the best deals on prescription and over-the-counter medicines</p>
                  <a href="#top-products" class="btn btn-light btn-lg px-5 py-3">View Products</a>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="pharmacy-slide-bg" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); min-height: 400px; display: flex; align-items: center; justify-content: center;">
                <div class="container text-center text-white">
                  <h1 class="display-4 font-weight-bold mb-3">Fast & Reliable Delivery</h1>
                  <p class="lead mb-4">Get your medicines delivered to your doorstep quickly and safely</p>
                  <a href="#all-medicines" class="btn btn-light btn-lg px-5 py-3">Explore Medicines</a>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#pharmacyCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#pharmacyCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "PharmacySliderSectionComponent",
  props: ['fileSystemDriver'],
  data() {
    return {
      basePath: window.location.origin
    }
  },
  mounted() {
    // Initialize carousel if needed
  }
}
</script>

<style scoped>
.pharmacy-slider-section {
  margin-top: 20px;
}
.pharmacy-slide-bg {
  border-radius: 0;
}
@media (max-width: 768px) {
  .pharmacy-slide-bg {
    min-height: 300px !important;
  }
  .display-4 {
    font-size: 2rem;
  }
  .lead {
    font-size: 1rem;
  }
}
</style>

