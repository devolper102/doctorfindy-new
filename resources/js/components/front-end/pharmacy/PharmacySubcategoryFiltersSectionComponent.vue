<template>
  <div>
    <section class="pharmacy-subcategory-filters-section mb-4">
      <div class="row">
        <div class="col-12">
          <div class="filter-buttons d-flex flex-wrap">
            <button 
              class="btn btn-filter mb-2 mr-2"
              :class="{ 'btn-primary': !currentSubcategory, 'btn-outline-primary': currentSubcategory }"
              @click="filterBySubcategory(null)">
              All
            </button>
            <button 
              v-for="subcategory in subcategories" 
              :key="subcategory.id"
              class="btn btn-filter mb-2 mr-2"
              :class="{ 'btn-primary': currentSubcategory === subcategory.slug, 'btn-outline-primary': currentSubcategory !== subcategory.slug }"
              @click="filterBySubcategory(subcategory.slug)">
              {{ subcategory.name }}
            </button>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "PharmacySubcategoryFiltersSectionComponent",
  props: ['subcategories', 'currentSubcategory'],
  data() {
    return {
      basePath: window.location.origin
    }
  },
  methods: {
    filterBySubcategory(slug) {
      const url = new URL(window.location.href);
      if (slug) {
        url.searchParams.set('subcategory', slug);
      } else {
        url.searchParams.delete('subcategory');
      }
      // Reset to page 1 when filtering
      url.searchParams.delete('page');
      window.location.href = url.toString();
    }
  }
}
</script>

<style scoped>
.btn-filter {
  border-radius: 25px;
  padding: 8px 20px;
  font-weight: 500;
  transition: all 0.3s ease;
}
.btn-filter:hover {
  transform: translateY(-2px);
  box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}
.pharmacy-subcategory-filters-section {
  padding: 15px 0;
  border-bottom: 1px solid #e9ecef;
}
</style>

