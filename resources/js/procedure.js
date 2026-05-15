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
Vue.component('banner-section', require('./components/front-end/procedures/BannerSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('trending-section', require('./components/front-end/procedures/TrendingSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('city-procedure-section', require('./components/front-end/procedures/CityProceduresSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('doctor-section', require('./components/front-end/procedures/DoctorSectionComponent').default)
/*Header Component End*/
/*internal linking*/
Vue.component('internal-linking-section', require('./components/front-end/procedures/internalLinkingComponent').default)
/*Header Component Start*/
Vue.component('hospital-section', require('./components/front-end/procedures/HospitalSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('procedures-section', require('./components/front-end/procedures/ProceduresSectionComponent').default)
/*Header Component End*/
/*Doctor Tab Component Start*/
Vue.component('hospital-tab', require('./components/front-end/profile-pages/HospitalTabComponet').default)
/*Doctor Tab Component End*/
/*Report Component Start*/
Vue.component('report', require('./components/front-end/profile-pages/ReportModalComponent').default)
/*Report Component End*/
/*Doctor Profile Component*/
Vue.component('doctor-card', require('./components/front-end/procedures/RelatedDoctorCardComponent').default)
/*Home Header Component End*/
/*Doctor Profile Component*/
Vue.component('faq-section', require('./components/front-end/procedures/FaqSectionComponent').default)
/*Home Header Component End*/
/*Doctor Profile Component*/
Vue.component('other-section', require('./components/front-end/procedures/OtherCitiesSectionComponent').default)
/*Home Header Component End*/

/*Doctor Profile Component*/
Vue.component('search-location-input', require('./components/front-end/homePage/SearchCitiesInputComponent').default)
/*Home Header Component End*/


/*Doctor Profile Component*/
Vue.component('detail-card', require('./components/front-end/procedures/DetailsSectionComponent').default)
/*Home Header Component End*/
/*Doctor Profile Component*/
Vue.component('related-doctor', require('./components/front-end/procedures/RelatedDoctorComponent').default)
/*Home Header Component End*/
/*Doctor Profile Component*/
Vue.component('related-hospital', require('./components/front-end/procedures/RelatedHospitalComponent').default)
/*Home Header Component End*/
/*Breadcrumb Component Start*/
Vue.component('bread-crumb-spec', require('./components/front-end/search-page/BreadCrumbComponent').default)
/*Breadcrumb Component End*/
Vue.component('procedure-detail-faq', require('./components/front-end/procedures/ProceduresDetailFaqComponent').default)
const procedure = new Vue({
  el: '#procedure',
  mounted: function () {
    this.loading = false
  },
  created () {
  },
  data: {
    loading: true,
  }
})