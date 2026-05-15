import Vue from 'vue';
require('./bootstrap')
window.Vue = require('vue')

window.moment = require('moment')
import moment from 'moment'
import VueLazyload from 'vue-lazyload'

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

import 'izitoast/dist/css/iziToast.css'
import VueIziToast from 'vue-izitoast'
import VueSweetalert2 from 'vue-sweetalert2'
import BootstrapVue from 'bootstrap-vue'
import Verte from 'verte'
import 'vue-date-pick/dist/vueDatePick.css'
import VueBootstrapTypeahead from 'vue-bootstrap-typeahead'
import DatePick from 'vue-date-pick'
import { TimePicker } from 'ant-design-vue'
import { Calendar } from 'ant-design-vue'
import { VueStars } from "vue-stars"
import { Printd } from "printd"
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'


// import 'ant-design-vue/dist/antd.css'

import 'sweetalert2/src/sweetalert2.scss'
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
var Paginate = require('vuejs-paginate')


require('./bootstrap')
window.Vue = require('vue')

/*import algoliasearch from 'algoliasearch/lite';
window.algoliasearch = algoliasearch;*/

/*import InstantSearch from 'vue-instantsearch';
Vue.use(InstantSearch);*/

import 'verte/dist/verte.css'
Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key)
}

Vue.filter('two_digits', function (value) {
    if (value.toString().length <= 1) {
        return "0" + value.toString();
    }
    return value.toString();
});

Vue.use(VueIziToast)
Vue.use(VueSweetalert2)
Vue.use(BootstrapVue)
Vue.use(TimePicker)
Vue.use(Calendar)
Vue.use(VueFormWizard)


/*Header Component Start*/
Vue.component('header-home-section', require('./components/front-end/includes/HeaderHomeComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('header-section', require('./components/front-end/includes/HeaderComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('footer-section', require('./components/front-end/includes/FooterComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('sticky-header', require('./components/front-end/includes/StickyHeaderComponent').default)
/*Header Component End*/

/*mobilefixedMenu*/
Vue.component('mobile-fixed-menu-section', require('./components/front-end/includes/MobileFixedMenuComponent').default)
/* Site Pages */

/* About Us Page */
Vue.component('we-are-about-section', require('./components/front-end/site-pages/about/WeAreAboutSectionCompoent').default)
Vue.component('for-you-about-section', require('./components/front-end/site-pages/about/ForYouAboutSectionCompoent').default)
/* Contact Us Page */
Vue.component('get-in-touch-contact-section', require('./components/front-end/site-pages/contact/GetTouchContactSectionCompoent').default)


/* Arivacy Us Page */
Vue.component('privacy-section', require('./components/front-end/site-pages/privacy/PrivacySectionComponent').default)
Vue.component('disclaimer-section', require('./components/front-end/site-pages/disclaimer-page/disclaimer-policyComponent').default)

const sitePages = new Vue({
  el: '#sitePages',
  mounted: function () {
    this.loading = false
  },  created () {
  },
  data: {
    loading: false,
  }
})
