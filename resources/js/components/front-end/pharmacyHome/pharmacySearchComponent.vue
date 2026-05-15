<template>
	<div>
		<div class="pharmacy-banner-bg-image w-100 d-inline-block" style="background: url(/images/pharmacy-banner-bg-image.png) left center no-repeat;">
      <div class="container">
        <div class="row">
          <div class="col-12 mt-xl-5 mt-4 text-center">
            <h1 class="text_black font-weight-bold text_25 text-xs-22">
              What Are You Looking For?
            </h1>
            <p class="text_black text_14 mb-3">
              Integer efficitur aliquam mauris a sodales
            </p>
          <form>
                <div class="position-relative w-55 d-block bg-white p-2 book-rounded pharmacy-banner-main w-xs-100 w-sm-100 w-md-100 w-ipad-100">
                  <div class="search-wrap" ref="root">
                    <!-- Top search row -->
                    <div class="top-search">
                      <div class="inner-container flex align-items-center d-xs-inline-block w-xs-100">
                        <!-- Search 1: All Category -->
                        <div class="search-col right 
                        all-category-search">
                          <div class="search-input-group white-bg d-flex align-items-center search-input-group-sticky">
                            <input
                              type="text"
                              v-model="whereQuery"
                              placeholder="All Category"
                              @focus="openCitiesBox"
                              @input="onWhereInput"
                              class="search-input border-0 text_15"
                              aria-label="Search city"
                              />
                            <span class="search-icon">
                              <img src="/images/angle-green-icon.svg" alt="picture">
                            </span>
                          </div>
                          <!-- Cities dropdown -->
                          <transition name="fade-slide">
                            <div v-if="showCitiesBox" class="cities-box" ref="citiesBox">
                              <div class="city-list-header">
                                <h3 class="text-black text_16 font-weight-bold regular-family pt-3 pl-3 pr-3 pb-0 text-left">Popular cities</h3>
                              </div>
                              <ul class="city-list pl-0 mb-0">
                                <li
                                  v-for="city in filteredCities"
                                  :key="city.id"
                                  class="city-item"
                                  @click="selectCity(city)"
                                  >
                                  <div class="city-left">
                                    <img v-if="city.img" :src="city.img" class="city-thumb" />
                                    <span class="city-name font-weight-bold text_14 text-black">{{ city.name }}</span>
                                  </div>
                                </li>
                                <li v-if="!filteredCities.length" class="no-result text-black">No cities found</li>
                              </ul>
                            </div>
                          </transition>
                        </div>
                        <!-- Search 2: search for -->
                        <div class="search-col position-relative search-for-input mt-xl-0 mt-2 mt-md-0 mt-lg-0">
                          <div class="search-input-group white-bg d-flex align-items-center search-input-group-sticky">
                            <input
                              type="text"
                              v-model="serviceQuery"
                              placeholder="Search for ..."
                              @focus="openCategoriesBox"
                              @input="onServiceInput"
                              class="search-input border-0 text_15"
                              aria-label="Search service"
                              />
                              <span class="search-icon ml-2">
                              <img src="/images/search-normal.svg" alt="picture">
                            </span>
                          </div>
                          <!-- Categories box -->
                          <transition name="fade-slide">
                            <div
                              v-if="showCategoriesBox"
                              class="categories-box"
                              @mouseleave="onCategoriesMouseLeave"
                              @mouseenter="onCategoriesMouseEnter"
                              ref="categoriesBox"
                              >
                              <h3 class="categories-title text-black text_16 font-weight-bold regular-family pt-3 pl-3 pr-3 pb-0 text-left">Categories</h3>
                              <ul class="categories-list pl-0 mb-0">
                                <li
                                  v-for="(cat, idx) in filteredCategories"
                                  :key="cat.id"
                                  :ref="'catItem' + idx"
                                  class="category-item d-flex align-items-center"
                                  :class="{ active: idx === activeCategoryIndex }"
                                  @mouseenter="setActiveCategory(idx)"
                                  >
                                  <div class="cat-left d-flex align-items-center">
                                    <img v-if="cat.icon" :src="cat.icon" class="cat-icon" />
                                    <span class="cat-name text-size-14 font-weight-bold text-black">{{ cat.name }}</span>
                                  </div>
                                </li>
                              </ul>
                              <!-- Subcategories panel (shows on hover) -->
                              <transition name="fade">
                                <div
                                  v-if="activeCategory && showSubcategories"
                                  class="subcategories-panel"
                                  :style="subPanelPosition"
                                  >
                                  <ul class="pl-0 mb-0">
                                    <li
                                      v-for="(sub, sIdx) in activeCategory.subcategories"
                                      :key="sIdx"
                                      class="sub-item text_14 
                                      text-black text-left"
                                      >
                                      • {{ sub }}
                                    </li>
                                  </ul>
                                </div>
                              </transition>
                            </div>
                          </transition>
                        </div>
                      </div>
                    </div>
                    <!-- The rest of your page content can go here -->
                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
	</div>
</template>

<script>

export default {
  name: "pharmacySearchComponent",
  
  data() {
    return {
      // inputs
      serviceQuery: "",
      whereQuery: "",

      // control boxes
      showCategoriesBox: false,
      showCitiesBox: false,

      // categories data (sample) - include icons if available
      categories: [
        {
          id: 1,
          name: "Hair Salon",
          icon: "/images/hair-saloon-icon-image.svg",
          subcategories: ["Haircut", "Hair Color", "Keratin Treatment"]
        },
        {
          id: 2,
          name: "Makeup",
          icon: "/images/makeup-image-icon.svg",
          subcategories: [
            "Natural Makeup",
            "Party Makeup",
            "Bridal Makeup",
            "Eyebrow Treatment",
            "Eyelash Extensions"
          ]
        },
        {
          id: 3,
          name: "Nail Salon",
          icon: "/images/nail-saloon-icon-image.svg",
          subcategories: ["Manicure", "Pedicure", "Gel Nails"]
        },
        {
          id: 4,
          name: "Barbershop",
          icon: "/images/barbershop-icon-image.svg",
          subcategories: ["Beard Trim", "Classic Cut"]
        },
        {
          id: 5,
          name: "Tattoo",
          icon: "/images/tattoo-icon-image.svg",
          subcategories: ["Small Tattoos", "Portraits"]
        },
        {
          id: 6,
          name: "Day Spa",
          icon: "/images/day-spa-icon-image.svg",
          subcategories: ["Day Spa", "Portraits"]
        },
        {
          id: 7,
          name: "Piercing",
          icon: "/images/piercing-icon-image.svg",
          subcategories: ["Small Tattoos", "Piercing"]
        },
        {
          id: 8,
          name: "Beauty Salon",
          icon: "/images/beauty-salon-icon-image.svg",
          subcategories: ["Beauty Salon", "Portraits"]
        },
        {
          id: 9,
          name: "Wedding Makeup Artist",
          icon: "/images/wedding-icon-image.svg",
          subcategories: ["Small Tattoos", "Wedding Makeup Artist"]
        },
        {
          id: 10,
          name: "Eyebrows & Lashes",
          icon: "/images/eyebrow-icon-image.svg",
          subcategories: ["Eyebrows & Lashes", "Portraits"]
        },
        {
          id: 11,
          name: "Massage",
          icon: "/images/massage-icon-image.svg",
          subcategories: ["Massage", "Portraits"]
        },
      ],

      // cities (sample)
      cities: [
  { id: "c1", name: "Islamabad" },
  { id: "c2", name: "Lahore" },
  { id: "c3", name: "Karachi" },
  { id: "c4", name: "Faisalabad" },
  { id: "c5", name: "Peshawar" },
  { id: "c6", name: "Quetta" },
  { id: "c7", name: "Rawalpindi" },
  { id: "c8", name: "Multan" },
  { id: "c9", name: "Sialkot" },
  { id: "c10", name: "Hyderabad" }
],

      // active hover index for categories; used to show subcategories
      activeCategoryIndex: -1,
      // control whether subcategories panel shows (helps with smooth hide when mouse leaves)
      showSubcategories: false,
      subPanelPosition: { top: "40px", left: "260px" } // default location relative to categories box
    };
  },
  computed: {
    filteredCategories() {
      const q = this.serviceQuery.trim().toLowerCase();
      if (!q) return this.categories;
      // filter by category name OR by subcategory
      return this.categories.filter((c) => {
        const inCat = c.name.toLowerCase().includes(q);
        const inSub = c.subcategories.some((s) => s.toLowerCase().includes(q));
        return inCat || inSub;
      });
    },
    activeCategory() {
      return this.filteredCategories[this.activeCategoryIndex] || null;
    },
    filteredCities() {
      const q = this.whereQuery.trim().toLowerCase();
      if (!q) return this.cities;
      return this.cities.filter((c) => c.name.toLowerCase().includes(q));
    }
  },
  methods: {
    hideSaloonModal() {
      this.$refs['saloonModal'].hide()
    },
    openCategoriesBox() {
      this.showCategoriesBox = true;
      this.showCitiesBox = false;
    },
    openCitiesBox() {
      this.showCitiesBox = true;
      this.showCategoriesBox = false;
    },
    onServiceInput() {
      // keep the categories box open while typing
      this.showCategoriesBox = true;
      // reset active index so hover corresponds to filtered list
      this.activeCategoryIndex = -1;
    },
    onWhereInput() {
      this.showCitiesBox = true;
    },
    // setActiveCategory(idx) {
    //   this.activeCategoryIndex = idx;
    //   this.showSubcategories = true;
    //   this.$nextTick(this.updateSubPanelPosition);
    // },
    setActiveCategory(idx) {
  this.activeCategoryIndex = idx;
  this.showSubcategories = true;

  this.$nextTick(() => {
    const item = this.$refs['catItem' + idx][0]; // li element
    const itemRect = item.getBoundingClientRect();
    const catBoxRect = this.$refs.categoriesBox.getBoundingClientRect();

    const topOffset = itemRect.top - catBoxRect.top;

    this.subPanelPosition = {
      top: topOffset + "px",
      left: catBoxRect.width + 10 + "px"
    };
  });
},
    updateSubPanelPosition() {
      // calculate a better position for the sub panel if needed
      const catBox = this.$refs.categoriesBox;
      if (!catBox) return;
      const rect = catBox.getBoundingClientRect();
      // show the panel just to the right of the categories box
      this.subPanelPosition = {
        top: "40px",
        left: rect.width + 10 + "px"
      };
    },
    onCategoriesMouseLeave() {
      // hide subcategories with a slight delay for smooth UX
      this._subHideTimer = setTimeout(() => {
        this.showSubcategories = false;
        this.activeCategoryIndex = -1;
      }, 120);
    },
    onCategoriesMouseEnter() {
      if (this._subHideTimer) {
        clearTimeout(this._subHideTimer);
        this._subHideTimer = null;
      }
    },
    selectCity(city) {
      this.whereQuery = city.name;
      this.showCitiesBox = false;
    },
    handleBodyClick(e) {
      // if click outside component root, close the boxes
      const root = this.$refs.root;
      if (!root) return;
      if (!root.contains(e.target)) {
        this.showCategoriesBox = false;
        this.showCitiesBox = false;
        this.showSubcategories = false;
        this.activeCategoryIndex = -1;
      }
    },
    cityCategoriesSample(city) {
      // sample function to return a few category icons to show alongside cities
      // here just return first 3 categories with icon (or fallback)
      return this.categories.slice(0, 3).map((c) => ({
        icon: c.icon || "",
        name: c.name
      }));
    }
  },
  mounted() {
    // close dropdowns on body click
    document.addEventListener("click", this.handleBodyClick);
    // keyboard: Esc closes boxes
    this._escHandler = (e) => {
      if (e.key === "Escape") {
        this.showCategoriesBox = false;
        this.showCitiesBox = false;
      }
    };
    document.addEventListener("keydown", this._escHandler);
  },
  beforeDestroy() {
    document.removeEventListener("click", this.handleBodyClick);
    document.removeEventListener("keydown", this._escHandler);
  }

};

</script>

<style>



</style>