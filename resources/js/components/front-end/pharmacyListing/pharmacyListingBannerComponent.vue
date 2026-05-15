<template>
	<div>
		<div class="w-100 d-inline-block 
		bg-trending-product">
		<div class="container">
			<div class="row mt-3 mb-3">
				<div class="col-lg-3 col-12 mb-3 mb-xl-0 category-collapse-box mt-lg-3">
					<div class="collapse-box bg-white box_radius 
          w-100">
    <div class="category"
         v-for="(cat, index) in categories"
         :key="index">

      <!-- HEADER -->
      <div class="category-header"
           :class="{ active: cat.open }"
           @click="toggleCategory(index)">

        <div class="left">
          <img :src="cat.icon" alt="" class="category-icon" />
          {{ cat.title }}
        </div>

        <span class="toggle-icon">
          <i class="fa" :class="cat.open ? 'fa-minus' : 'fa-plus'"></i>
        </span>
      </div>

      <!-- BODY -->
      <div class="category-body" v-show="cat.open">

        <div class="sub-item"
             v-for="(item, i) in cat.items"
             :key="i"
             @click.stop="item.checked = !item.checked">

          <span class="check-box" :class="{ checked: item.checked }">
            <i v-if="item.checked" class="fa fa-check"></i>
          </span>

          {{ item.name }}

        </div>

      </div>

    </div>

  </div>
  <div class="w-100 d-inline-block filter-card-section">
  <div class="filter-card bg-white box_radius mt-3">

    <!-- Header -->
    <div class="filter-header" @click="open = !open">
      <span>Filter</span>
      <span class="icon" :class="{ rotate: open }">
        <i class="fa fa-angle-down" aria-hidden="true"></i>
      </span>
    </div>

    <!-- Body -->
    <transition name="filter-slide">
      <div class="filter-body p-3" v-show="open">

        <!-- Availability -->
        <div class="section mb-3">
          <h4 class="text_black text_16 mb-2">Availability
          </h4>
          <label class="checkbox">
            <input type="checkbox" v-model="availability.inStock">
            <span></span>
            In Stock (14)
          </label>

          <label class="checkbox disabled">
            <input type="checkbox" disabled>
            <span></span>
            Out Of Stock (2)
          </label>
        </div>

        <!-- Price -->
        <div class="section mb-3">
          <h4 class="text_black text_16 mb-2">Price Range
          </h4>
          <div class="price-label text_14 mb-2">
            Price <b>${{ price.min }} - ${{ price.max }}</b>
          </div>
<div class="range-wrap position-relative">
  <div class="range-track">
    <div class="range-fill" :style="rangeStyle"></div>
  </div>

  <input type="range"
         min="10"
         max="2000"
         v-model="price.min"
         @input="fixMin">

  <input type="range"
         min="10"
         max="2000"
         v-model="price.max"
         @input="fixMax">
</div>
        </div>

        <!-- Brands -->
        <div class="section mb-3">
          <h4 class="text_black text_16 mb-2">Brands</h4>
          <label v-for="brand in brands"
                 :key="brand.name"
                 class="checkbox"
                 :class="{ disabled: !brand.available }">

            <input type="checkbox"
                   v-model="brand.checked"
                   :disabled="!brand.available">

            <span></span>
            {{ brand.name }}
          </label>
        </div>

        <!-- Button -->
        <button class="filter-btn" @click="applyFilter">
          FILTER
        </button>

      </div>
    </transition>

  </div>
  </div>
  <div class="medical-card w-100 d-inline-block mt-3 position-relative">
    <div class="pill-bg">
      <img src="/images/pills.svg" alt="Pills" class="pill-image position-absolute" />
      <img src="/images/bottle.svg" alt="Bottle" class="bottle-image position-absolute" />
    </div>

    <div class="card-content text-center position-absolute w-100">
      <h2 class="text-white">Medical<br>company</h2>
      <p class="text_15 mb-2 text-white font-weight-bold mb-2">Get a free consultation</p>
      <a href="javascript:void(0)" class="btn d-inline-block text_14 rounded-pill text-white font-weight-bold">Learn more</a>
    </div>
  </div>
				</div>
				<div class="col-lg-9 col-12">
					<listing-trending-product-section>
          </listing-trending-product-section>
				</div>
			</div>
		</div>
	</div>
	</div>
</template>

<script>

export default {
  name: "pharmacyListingBannerComponent",
  
data() {
    return {
      open: true, 
      availability: {
        inStock: true
      },
      price: {
      min: 200,
      max: 1500
    },
      brands: [
        { name: 'Mauris Lobortis', checked: true, available: true },
        { name: 'Risus Egestas', checked: false, available: false },
        { name: 'Diam', checked: false, available: false },
        { name: 'Efficiur Dapibus', checked: true, available: true },
        { name: 'Nulla Finibus', checked: false, available: false },
        { name: 'Ex Nec Lectus', checked: false, available: false },
        { name: 'Faucibus Porta', checked: false, available: false },
        { name: 'Sed Fermentum', checked: false, available: false }
      ],

      categories: [
        {
          title: 'Medicines & Treatments',
          icon: '/images/Medicines-treatment.svg',
          open: true,
          items: [
            { name: 'Cough, Cold & Flu', checked: false },
            { name: 'Pain Relief', checked: false },
            { name: 'Allergy Care', checked: false }
          ]
        },

        {
          title: 'Vitamins & Supplements',
          icon: '/images/vitamins-supplement.svg',
          open: false,
          items: [
            { name: 'Vitamin C', checked: false },
            { name: 'Multivitamins', checked: false },
            { name: 'Omega 3', checked: false },
            { name: 'Calcium', checked: false }
          ]
        },

        {
          title: 'Beauty & Health',
          icon: '/images/beauty-health.svg',
          open: false,
          items: [
            { name: 'Skin Care', checked: false },
            { name: 'Hair Care', checked: false },
            { name: 'Body Care', checked: false }
          ]
        },
        { title: 'Homeopathic Remedies', icon: '/images/homeopathic-remedies.svg', open: false, items: this.sampleItems() },
        { title: 'Health Care', icon: '/images/health-care.svg', open: false, items: this.sampleItems() },
        { title: 'Personal Care', icon: '/images/personal-care.svg', open: false, items: this.sampleItems() },
        { title: "Nutrition's & Supplements", icon: '/images/nutrition-supplement.svg', open: false, items: this.sampleItems() },
        { title: 'Sexual Wellness', icon: '/images/sexual-wellness.svg', open: false, items: this.sampleItems() },
        { title: 'Gift Sets', icon: '/images/gift-sets.svg', open: false, items: this.sampleItems() },
        { title: 'Weekly Deals', icon: '/images/weekly-deals.svg', open: false, items: this.sampleItems() }
      ]
    };
  },
computed: {
  rangeStyle() {
    const min = 10
    const max = 2000

    const left = ((this.price.min - min) / (max - min)) * 100
    const right = 100 - ((this.price.max - min) / (max - min)) * 100

    return {
      left: left + '%',
      right: right + '%'
    }
  }
},
  methods: {
    fixMin() {
    if (this.price.min > this.price.max - 50) {
      this.price.min = this.price.max - 50
    }
  },
  fixMax() {
    if (this.price.max < this.price.min + 50) {
      this.price.max = this.price.min + 50
    }
  },
    applyFilter() {
      console.log({
        availability: this.availability,
        price: this.price,
        brands: this.brands.filter(b => b.checked)
      })
    },
    toggleCategory(index) {
      this.categories[index].open = !this.categories[index].open;
    },

    sampleItems() {
      return [
        { name: 'Item One', checked: false },
        { name: 'Item Two', checked: false },
        { name: 'Item Three', checked: false }
      ];
    }
  }

};

</script>

<style>

</style>