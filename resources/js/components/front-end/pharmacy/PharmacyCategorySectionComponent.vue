<template>
  <div id="explore-categories">
    <section class="pharmacy-category-section mt-5 mb-5">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h2 class="text-center font-weight-bold text_24 mb-4">Explore by Category</h2>
          </div>
        </div>
        <div class="row" v-if="categories && categories.length > 0">
          <div v-for="(category, index) in categories" :key="category.id" 
               class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="category-card bg-white box-shadow rounded p-3 text-center h-100 cursor-pointer"
                 @click="goToCategory(category.slug)">
              <div class="category-icon mb-3">
                <img v-if="category.image_url" 
                     :src="category.image_url" 
                     :alt="category.name"
                     class="category-image"
                     @error="handleImageError($event)" />
                <i class="fa fa-pills fa-3x text-primary" :class="{'d-none': category.image_url}"></i>
              </div>
              <h5 class="font-weight-bold text_16 mb-2">{{ category.name }}</h5>
              <p class="text_12 text-muted mb-0" v-if="category.subcategories && category.subcategories.length > 0">
                {{ category.subcategories.length }} Subcategories
              </p>
            </div>
          </div>
        </div>
        <div class="row" v-else>
          <div class="col-12 text-center">
            <p class="text-muted">No categories available at the moment.</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "PharmacyCategorySectionComponent",
  props: ['fileSystemDriver', 'categories'],
  data() {
    return {
      basePath: window.location.origin
    }
  },
  methods: {
    goToCategory(slug) {
      // Navigate to category detail page
      window.location.href = `/pharmacy/${slug}`;
    },
    handleImageError(event) {
      // Hide image and show icon fallback
      event.target.style.display = 'none';
      const icon = event.target.nextElementSibling;
      if (icon && icon.classList.contains('fa')) {
        icon.classList.remove('d-none');
      }
    }
  }
}
</script>

<style scoped>
.category-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.category-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
}
.cursor-pointer {
  cursor: pointer;
}
.category-icon {
  min-height: 80px;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
}
.category-image {
  max-width: 100%;
  max-height: 120px;
  object-fit: contain;
  border-radius: 8px;
}
.category-icon .fa {
  display: inline-block;
}
</style>

