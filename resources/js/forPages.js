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
/*mobilefixedMenu*/
/*Header Component Start*/
Vue.component('banner-section', require('./components/front-end/doctor/BannerSectionCompoent').default)
/*Header Component End*/
/*Lab Banner Section Start*/
Vue.component('lab-banner-section', require('./components/front-end/for-lab/LabBannerSectionCompoent').default)
/*Lab Baner Section End*/
/*Lab Benifits Start*/
Vue.component('lab-benefits-section', require('./components/front-end/for-lab/LabBenefitsSectionComponent').default)
/*Lab Benifits End*/
/*Lab Knockdoc Start*/
Vue.component('lab-knockdoc-section', require('./components/front-end/for-lab/LabKnockdocSectionComponent').default)
/*Lab Knockdoc End*/
/*Lab Protection Start*/
Vue.component('lab-protection-section', require('./components/front-end/for-lab/LabProtectionSectionComponent').default)
/*Lab Protection End*/
/*Top Laboratories Start*/
Vue.component('top-laboratory-section', require('./components/front-end/for-lab/TopLaboratoriesSectionComponent').default)
/*Top Laboratories End*/

Vue.component('lab-listing-tab', require('./components/front-end/search-page/LaboratoryListingTabComponent').default)

Vue.component('lab-demo-section', require('./components/front-end/for-lab/LabDemoSectionComponent').default)


/*for Hospital Banner Section Start*/
Vue.component('for-hospital-banner-section', require('./components/front-end/for-hospital/HospitalBannerSectionCompoent').default)
/*for Hospital Baner Section End*/
/*for Hospital Benifits Start*/
Vue.component('for-hospital-benefits-section', require('./components/front-end/for-hospital/HospitalBenefitsSectionComponent').default)
/*for Hospital Benifits End*/
/*for Hospital Knockdoc Start*/
Vue.component('for-hospital-knockdoc-section', require('./components/front-end/for-hospital/KnocdocHospitalToolSectionComponent').default)
/*for Hospital Knockdoc End*/
/*for Hospital Protection Start*/
Vue.component('for-hospital-protection-section', require('./components/front-end/for-hospital/HospitalProtectionSectionComponent').default)
/*for Hospital Protection End*/
Vue.component('hospital-listing-tab', require('./components/front-end/search-page/HospitalListingComponent.vue').default)
/*Top Hospital Start*/
Vue.component('top-hospital-section', require('./components/front-end/for-hospital/TopHospitalSectionComponent').default)
/*Top Hospital End*/

Vue.component('hospital-demo-section', require('./components/front-end/for-hospital/HospitalDemoSectionComponent').default)

/*Top Hospital Start*/
Vue.component('management-software-section', require('./components/front-end/for-hospital/ManagementSoftwareSectionComponent').default)
/*Top Hospital End*/
/*Top Hospital Start*/
Vue.component('knocdoc-hospital-section', require('./components/front-end/for-hospital/KnocdocHospitalProfileSectionComponent').default)
/*Top Hospital End*/
/*Header Component Start*/
Vue.component('benefit-section', require('./components/front-end/doctor/BenefitSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('joining-section', require('./components/front-end/doctor/JoinSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('online-benefits-section', require('./components/front-end/doctor/OnlineBenefitsSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('data-protection-section', require('./components/front-end/doctor/DataProtectionSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('app-section', require('./components/front-end/doctor/AppSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('demo-section', require('./components/front-end/doctor/DemoRequestSectionComponent').default)
/*Header Component End*/


/*Doctor Profile Component*/
Vue.component('top-doctor', require('./components/front-end/doctor/TopDoctorsComponent').default)
/*Home Header Component End*/
/*Doctor Profile Component*/
Vue.component('doctor-card', require('./components/front-end/procedures/RelatedDoctorCardComponent').default)
/*Home Header Component End*/
/*Doctor Profile Component*/
Vue.component('other-doctor-card', require('./components/front-end/health-forum/OtherDoctorCardComponent').default)
/*Home Header Component End*/

/*Breadcrumb Component Start*/
Vue.component('bread-crumb-spec', require('./components/front-end/search-page/BreadCrumbComponent').default)
/*Breadcrumb Component End*/



const forPage = new Vue({
  el: '#forPage',
  mounted: function () {
    this.loading = false
  },  created () {
  },
  data: {
    loading: false,
  }
})
