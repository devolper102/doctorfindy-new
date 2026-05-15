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
Vue.component('banner', require('./components/front-end/listing/BannerSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('banner-hospital', require('./components/front-end/listing/BannerHospitalSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('trending-cities', require('./components/front-end/listing/TrendingCitiesSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('hospitals', require('./components/front-end/listing/HospitalSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('speciality-section', require('./components/front-end/listing/SpecialtiesSectionComponent').default)
Vue.component('speciality-banner', require('./components/front-end/listing/SpecialtiesBannerComponent').default)
Vue.component('disease-banner', require('./components/front-end/listing/DiseaseBannerComponent').default)
Vue.component('disease-categorey', require('./components/front-end/listing/DiseaseCategoreyComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('disease-listing', require('./components/front-end/listing/DiseaseListingSectionComponent').default)
/*Header Component End*/
/*Others doctor*/
Vue.component('other-doctor', require('./components/front-end/profile-pages/OtherDoctorSectionComponent').default)
Vue.component('doctor-card', require('./components/front-end/listing/RelatedDoctorCardComponent').default)

/*Header Component Start*/
Vue.component('all-services-section', require('./components/front-end/listing/AllServicesSectionComponent').default)
/*Header Component End*/

/*Breadcrumb Component Start*/
Vue.component('bread-crumb-spec', require('./components/front-end/search-page/BreadCrumbComponent').default)
/*Breadcrumb Component End*/

/*Doctor Tab Component Start*/
Vue.component('hospital-tab', require('./components/front-end/profile-pages/HospitalTabComponet').default)
/*Doctor Tab Component End*/
/*Report Component Start*/
Vue.component('report', require('./components/front-end/profile-pages/ReportModalComponent').default)
/*Report Component End*/

/*Doctor Profile Component*/
Vue.component('doc-card', require('./components/front-end/profile-pages/OtherDoctorCardComponent').default)
/*Home Header Component End*/
/*Header Component Start*/
Vue.component('location-section', require('./components/front-end/procedures/ProceduresSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('top-location', require('./components/front-end/listing/TopLocationsSectionComponent').default)
/*Header Component End*/


/*Doctor Profile Component*/
Vue.component('faq-section', require('./components/front-end/listing/FaqSectionComponent').default)
Vue.component('internal-linking-section', require('./components/front-end/listing/internal-linkingComponent').default)
/*Home Header Component End*/
Vue.component('book-now-appointment-slots', require('./components/front-end/book-now/BookNowAppointmentComponent').default)
/*Search Page Book Now Section End*/
/*Search Page Book Now Section Start*/
Vue.component('book-now-mobile-number', require('./components/front-end/book-now/BookNowMobileNumberComponent').default)
/*Search Page Book Now Section End*/
/*Search Page Book Now Section Start*/
Vue.component('book-now-number-verification', require('./components/front-end/book-now/BookNowVerificationCodeComponent').default)
/*Search Page Book Now Section End*/
/*Search Page Book Now Section Start*/
Vue.component('book-now-final', require('./components/front-end/book-now/BookNowFinalComponent').default)

const listing = new Vue({
  el: '#listing',
  mounted: function () {
    this.loading = false
  },  created () {
  },
  data: {
    loading: false,
  }
})