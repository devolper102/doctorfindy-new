import Vue from 'vue';
require('./bootstrap')
window.Vue = require('vue')

window.moment = require('moment')
import moment from 'moment'
import VueLazyload from 'vue-lazyload'

Vue.use(VueLazyload)

Vue.use(VueLazyload, {
  preLoad: 1.3,
  error: '/images/loader/error.jpg',
  loading: '/images/loader/loaderss.gif',
  attempt: 1,

})

/*Header Component Start*/
Vue.component('header-section', require('./components/front-end/includes/HeaderComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('sticky-header', require('./components/front-end/includes/StickyHeaderComponent').default)
/*Header Component End*/
/*mobilefixedMenu*/
Vue.component('mobile-fixed-menu-section', require('./components/front-end/includes/MobileFixedMenuComponent').default)
/*mobilefixedMenu*/
/*Header Component Start*/
Vue.component('footer-section', require('./components/front-end/includes/FooterComponent').default)
/*Header Component End*/

// Pharmacy specific components
Vue.component('pharmacy-slider-section', require('./components/front-end/pharmacy/PharmacySliderSectionComponent').default);
Vue.component('pharmacy-category-section', require('./components/front-end/pharmacy/PharmacyCategorySectionComponent').default);
Vue.component('pharmacy-top-products-section', require('./components/front-end/pharmacy/PharmacyTopProductsSectionComponent').default);
Vue.component('pharmacy-all-medicines-section', require('./components/front-end/pharmacy/PharmacyAllMedicinesSectionComponent').default);

// Pharmacy home components
Vue.component('pharmacy-banner-home-section', require('./components/front-end/pharmacyHome/pharmacyBannerComponent').default);
Vue.component('pharmacy-search-section', require('./components/front-end/pharmacyHome/pharmacySearchComponent').default);
Vue.component('trending-product-section', require('./components/front-end/pharmacyHome/trendingProductComponent').default);
Vue.component('pharmacy-delivery-section', require('./components/front-end/pharmacyHome/pharmacyDeliveryComponent').default);
Vue.component('subscribe-email-section', require('./components/front-end/pharmacyHome/subscribeEmailComponent').default);
Vue.component('top-selling-section', require('./components/front-end/pharmacyHome/topSellingComponent').default);
Vue.component('shop-brand-section', require('./components/front-end/pharmacyHome/shopBrandComponent').default);

// Pharmacy listing components
Vue.component('pharmacy-listing-banner-section', require('./components/front-end/pharmacyListing/pharmacyListingBannerComponent').default);
Vue.component('listing-trending-product-section', require('./components/front-end/pharmacyListing/listingTrendingProductComponent').default);

// Pharmacy Detail components
Vue.component('pharmacy-detail-banner-section', require('./components/front-end/pharmacyDetail/pharmacyDetailBannerComponent').default);
Vue.component('detail-trending-product-section', require('./components/front-end/pharmacyDetail/detailTrendingProductComponent').default);

// Pharmacy checkout components
Vue.component('pharmacy-checkout-banner-section', require('./components/front-end/pharmacyCheckout/pharmacyCheckoutBannerComponent').default);

// Pharmacy upload information components
Vue.component('pharmacy-upload-information-section', require('./components/front-end/pharmacyUploadInformation/pharmacyUploadInformationComponent').default);


// Pharmacy category page components
Vue.component('pharmacy-category-header-section', require('./components/front-end/pharmacy/PharmacyCategoryHeaderSectionComponent').default);
Vue.component('pharmacy-subcategory-filters-section', require('./components/front-end/pharmacy/PharmacySubcategoryFiltersSectionComponent').default);
Vue.component('pharmacy-category-medicines-section', require('./components/front-end/pharmacy/PharmacyCategoryMedicinesSectionComponent').default);

// Pharmacy medicine detail page component
Vue.component('pharmacy-medicine-detail-section', require('./components/front-end/pharmacy/PharmacyMedicineDetailSectionComponent').default);

/* Pharmacy Pages */
if (document.getElementById('pharmacy')) {
  const pharmacy = new Vue({
    el: '#pharmacy',
    mounted: function () {
      this.loading = false
    },  created () {
    },
    data: {
      loading: false,
    }
  })
}

if (document.getElementById('pharmacy-category')) {
  const pharmacyCategory = new Vue({
    el: '#pharmacy-category',
    mounted: function () {
      this.loading = false
    },  created () {
    },
    data: {
      loading: false,
    }
  })
}

if (document.getElementById('pharmacy-medicine')) {
  const pharmacyMedicine = new Vue({
    el: '#pharmacy-medicine',
    mounted: function () {
      this.loading = false
    },  created () {
    },
    data: {
      loading: false,
    }
  })
}

