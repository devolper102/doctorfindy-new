<template>
  <div>
    <section class="pharmacy-category-header-section mb-4">
      <div class="row align-items-center">
        <div class="col-md-2 text-center mb-3 mb-md-0">
          <img v-if="category.image_url" 
               :src="category.image_url" 
               :alt="category.name"
               class="category-header-image"
               @error="handleImageError($event)" />
          <i v-else class="fa fa-pills fa-4x text-primary"></i>
        </div>
        <div class="col-md-10">
          <h1 class="font-weight-bold text_28 mb-2">{{ category.name }}</h1>
          <p v-if="category.description" class="text-muted mb-0" v-html="category.description"></p>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "PharmacyCategoryHeaderSectionComponent",
  props: ['fileSystemDriver', 'category'],
  data() {
    return {
      basePath: window.location.origin
    }
  },
  methods: {
    handleImageError(event) {
      event.target.style.display = 'none';
      const icon = event.target.nextElementSibling;
      if (icon && icon.classList.contains('fa')) {
        icon.style.display = 'inline-block';
      }
    }
  }
}
</script>

<style scoped>
.category-header-image {
  max-width: 150px;
  max-height: 150px;
  object-fit: contain;
  border-radius: 12px;
  border: 2px solid #e9ecef;
  padding: 10px;
}
.pharmacy-category-header-section {
  padding: 20px 0;
  border-bottom: 2px solid #e9ecef;
}
</style>

