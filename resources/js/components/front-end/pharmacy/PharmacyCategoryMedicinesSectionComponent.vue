<template>
  <div>
    <section class="pharmacy-category-medicines-section">
      <div class="row" v-if="medicinesList && medicinesList.length > 0">
        <div v-for="(medicine, index) in medicinesList" :key="medicine.id" 
             class="col-6 col-md-4 col-lg-3 mb-4">
          <div class="medicine-card bg-white box-shadow rounded overflow-hidden h-100 position-relative">
            <a :href="medicine.slug ? '/pharmacy/medicine/' + medicine.slug : '#'" 
               class="text-decoration-none text-dark d-block h-100 medicine-link"
               style="position: relative; z-index: 1;">
              <div class="medicine-image position-relative">
                <img v-if="medicine.image_url" 
                     :src="medicine.image_url" 
                     :alt="medicine.name"
                     class="img-fluid w-100"
                     style="height: 200px; object-fit: cover;"
                     @error="handleImageError($event)">
                <div v-else class="bg-light d-flex align-items-center justify-content-center" 
                     style="height: 200px;">
                  <i class="fa fa-pills fa-3x text-muted"></i>
                </div>
                <div v-if="medicine.sale_price && medicine.price" class="badge badge-danger position-absolute" 
                     style="top: 10px; right: 10px;">
                  {{ getDiscountPercent(medicine.price, medicine.sale_price) }}% OFF
                </div>
              </div>
              <div class="medicine-details p-3">
                <h6 class="font-weight-bold text_14 mb-2 medicine-name">{{ medicine.name }}</h6>
                <p class="text_12 text-muted mb-1" v-if="medicine.subcategory">
                  <i class="fa fa-tag mr-1"></i>{{ medicine.subcategory.name }}
                </p>
                <p class="text_12 text-muted mb-2" v-if="medicine.manufacturer">
                  {{ medicine.manufacturer }}
                </p>
                <div class="medicine-rating mb-2" v-if="medicine.rating">
                  <span class="text-warning">
                    <i v-for="n in 5" :key="n" 
                       :class="n <= medicine.rating ? 'fa fa-star' : 'fa fa-star-o'"></i>
                  </span>
                </div>
                <div class="medicine-price mb-2">
                  <span v-if="medicine.sale_price" class="text-primary font-weight-bold text_16">
                    Rs. {{ medicine.sale_price }}
                  </span>
                  <span v-if="medicine.price && medicine.sale_price" 
                        class="text-muted text_12 ml-2 text-decoration-line-through">
                    Rs. {{ medicine.price }}
                  </span>
                  <span v-else-if="medicine.price" class="text-primary font-weight-bold text_16">
                    Rs. {{ medicine.price }}
                  </span>
                </div>
              </div>
            </a>
            <div class="medicine-details p-3 pt-0" style="position: relative; z-index: 2;">
              <button class="btn btn-primary btn-sm w-100" 
                      @click.stop.prevent="addToCart(medicine)"
                      style="position: relative; z-index: 10;">
                <i class="fa fa-shopping-cart mr-1"></i> Add to Cart
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Pagination -->
      <div class="row mt-4" v-if="medicines && medicines.last_page > 1">
        <div class="col-12">
          <nav aria-label="Medicines pagination">
            <ul class="pagination justify-content-center">
              <li class="page-item" :class="{ disabled: medicines.current_page === 1 }">
                <a class="page-link" href="#" @click.prevent="loadPage(medicines.current_page - 1)">Previous</a>
              </li>
              <li v-for="page in medicines.last_page" :key="page" 
                  class="page-item" 
                  :class="{ active: page === medicines.current_page }">
                <a class="page-link" href="#" @click.prevent="loadPage(page)">{{ page }}</a>
              </li>
              <li class="page-item" :class="{ disabled: medicines.current_page === medicines.last_page }">
                <a class="page-link" href="#" @click.prevent="loadPage(medicines.current_page + 1)">Next</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <div class="row" v-else-if="!medicinesList || medicinesList.length === 0">
        <div class="col-12 text-center">
          <p class="text-muted">No medicines available in this category.</p>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "PharmacyCategoryMedicinesSectionComponent",
  props: ['fileSystemDriver', 'medicines'],
  data() {
    return {
      basePath: window.location.origin
    }
  },
  computed: {
    medicinesList() {
      if (!this.medicines) return [];
      // Handle both paginated and array formats
      return this.medicines.data || this.medicines || [];
    }
  },
  methods: {
    getDiscountPercent(price, salePrice) {
      if (!price || !salePrice) return 0;
      return Math.round(((price - salePrice) / price) * 100);
    },
    handleImageError(event) {
      event.target.style.display = 'none';
      const fallback = event.target.nextElementSibling;
      if (fallback && fallback.classList.contains('bg-light')) {
        fallback.style.display = 'flex';
      }
    },
    addToCart(medicine) {
      // Prevent navigation when clicking add to cart
      event.stopPropagation();
      // Add to cart functionality
      alert(`Added ${medicine.name} to cart`);
    },
    loadPage(page) {
      if (this.medicines && page >= 1 && page <= this.medicines.last_page) {
        const url = new URL(window.location.href);
        url.searchParams.set('page', page);
        window.location.href = url.toString();
      }
    }
  }
}
</script>

<style scoped>
.medicine-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.medicine-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.15) !important;
}
.medicine-card a {
  cursor: pointer;
  display: block;
}
.medicine-name {
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

