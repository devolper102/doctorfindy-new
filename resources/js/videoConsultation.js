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
/*mobilefixedMenu*/

/*Header Component Start*/
Vue.component('banner-section', require('./components/front-end/online-consultation/BannerSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('result-section', require('./components/front-end/online-consultation/ResultsSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('top-doctor-section', require('./components/front-end/online-consultation/TopDoctorsSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('how-it-section', require('./components/front-end/online-consultation/HowItWorksComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('benefits-section', require('./components/front-end/online-consultation/BenefitsSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('common-health-problem-section', require('./components/front-end/online-consultation/CommonHealthProblemsSectionComponent').default)
/*Header Component End*/
/*doctor-blogs-tips-section Component Start*/
Vue.component('doctor-blogs-tips-section', require('./components/front-end/online-consultation/DoctorBlogsAndTipsSectionComponent').default)
/*doctor-blogs-tips-section Component End*/
/*Header Component Start*/
Vue.component('online-chat-experience', require('./components/front-end/online-consultation/OnlineChatExperienceSectionComponent').default)
/*Header Component End*/


/*Home Page Search Section Start*/
Vue.component('main-search-page', require('./components/front-end/homePage/SearchComponent.vue').default)
/*Home Page Search Section End*/
/*Home Page Search Section Start*/
Vue.component('search-location-input', require('./components/front-end/homePage/SearchCitiesInputComponent.vue').default)
/*Home Page Search Section End*/

/*Doctor Profile Component*/
// Vue.component('faq-section', require('./components/front-end/online-consultation/FaqsSectionComponent').default)
Vue.component('faq-section', require('./components/front-end/listing/FaqSectionComponent').default)
/*Home Header Component End*/
/*Doctor Profile Component*/
Vue.component('faq-accordion', require('./components/front-end/online-consultation/FaqsAccordianComponent').default)
/*Home Header Component End*/

/*Doctor Profile Component*/
Vue.component('doctor-card', require('./components/front-end/procedures/RelatedDoctorCardComponent').default)
/*Home Header Component End*/

/*Specalities Section Start*/
Vue.component('speciality-section', require('./components/front-end/homePage/SpecialitySectionComponent.vue').default)
/*Specalities Section End*/

/*Care ON The Go Section*/
Vue.component('care-on-section', require('./components/front-end/homePage/CareOnGoSectionComponent.vue').default)
/*End Care ON The Go Section*/
/*Breadcrumb Component Start*/
Vue.component('bread-crumb-spec', require('./components/front-end/search-page/BreadCrumbComponent').default)
/*Breadcrumb Component End*/

const videoConsultation = new Vue({
  el: '#videoConsultation',
  mounted: function () {
    this.loading = false
  },  created () {
  },
  data: {
    loading: false,
  }
})