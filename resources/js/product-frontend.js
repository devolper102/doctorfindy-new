import Vue from 'vue';
require('./bootstrap')
window.Vue = require('vue')
window.moment = require('moment')
import moment from 'moment'
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import Multiselect from "vue-multiselect";
Vue.component("multiselect", Multiselect);
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";

import VueLazyload from 'vue-lazyload'

Vue.use(BootstrapVue)
Vue.use(VueLazyload)

// or with options
//const loadimage = require('./images/loader/loaderss.gif')
//const errorimage = require('./images/loader/error.jpg')  observer: true,

Vue.use(VueLazyload, {
  preLoad: 1.3,
  error: '/images/loader/error.jpg',
  loading: '/images/loader/loaderss.gif',
  attempt: 1,

})
import Toasted from 'vue-toasted';
Vue.use(Toasted)
/*Header Component Start*/
Vue.component('header-section', require('./components/front-end/includes/HeaderComponent').default)
/*Header Component End*/
/*mobilefixedMenu*/
Vue.component('mobile-fixed-menu-section', require('./components/front-end/includes/MobileFixedMenuComponent').default)
/*mobilefixedMenu*/
/*Header Component Start*/
Vue.component('sticky-header', require('./components/front-end/includes/StickyHeaderComponent').default)
/*Header Component End*/



/*Footer Component Start*/
Vue.component('footer-section', require('./components/front-end/includes/FooterComponent').default)
/*Footer Component End*/
Vue.component("product-home-section", require("./components/front-end/product-pages/product-home-bannerComponent.vue").default)
Vue.component("product-brand-section", require("./components/front-end/product-pages/product-brandComponent.vue").default)
Vue.component("product-offer-section", require("./components/front-end/product-pages/product-offerComponent.vue").default)
Vue.component("product-checkout-section", require("./components/front-end/product-checkout/product-checkoutComponent.vue").default)
Vue.component("product-listing-section", require("./components/front-end/product-listing-pages/product-listing-bannerComponent.vue").default)
Vue.component("product-detail-section", require("./components/front-end/product-detail-pages/product-detail-sliderComponent.vue").default)
Vue.component("product-brand-page-section", require("./components/front-end/product-brand-pages/product-brandComponent.vue").default)
Vue.component("product-all-section", require("./components/front-end/product-all-pages/product-allComponent.vue").default)
const home = new Vue({
    el: '#home',
    mounted: function () {
        this.loading = false
    },
    created () {},
    data: {
        loading: true,
    }
})
