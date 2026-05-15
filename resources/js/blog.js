import Vue from 'vue';
require('./bootstrap')
window.Vue = require('vue')

window.moment = require('moment')
import moment from 'moment'
import VueLazyload from 'vue-lazyload'

Vue.use(VueLazyload)

import VueSocialSharing from 'vue-social-sharing'

Vue.use(VueSocialSharing);
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
Vue.component('paginate', Paginate)

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
Vue.component('article-section', require('./components/front-end/blogs/ArticlesSectionComponent').default)
Vue.component('blog-profile-banner-section', require('./components/front-end/blog-profile/BlogProfileBannerComponent').default)
Vue.component('blog-auther-profile-section', require('./components/front-end/blog-profile/BlogAutherProfileComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('category-detail', require('./components/front-end/blogs/CategoryDetailSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('article-detail', require('./components/front-end/blogs/ArticleDetailSectionComponent').default)
/*Header Component End*/
Vue.component('subscribe-section', require('./components/front-end/blogs/SubscribeSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('sidebar', require('./components/front-end/blogs/SidebarSectionComponent').default)
/*Header Component End*/

/*Header Component Start*/
Vue.component('profile', require('./components/front-end/blogs/ProfileSectionComponent').default)
/*Header Component End*/

/*Doctor Profile Component*/
Vue.component('about-doctor', require('./components/front-end/profile-pages/AboutDoctorSectionComponent').default)
/*Home Header Component End*/
/*Doctor Profile Component*/
Vue.component('work-experience', require('./components/front-end/profile-pages/WorkExperienceSectionComponent').default)
/*Home Header Component End*/
/*Doctor Profile Component*/
Vue.component('education-section', require('./components/front-end/profile-pages/EducationalSectionComponent').default)
/*Home Header Component End*/
/*Doctor Profile Component*/
Vue.component('award-section', require('./components/front-end/profile-pages/AwardsComponentSection').default)
/*Home Header Component End*/
/*Doctor Profile Component*/
Vue.component('membership-section', require('./components/front-end/profile-pages/MembershipSectionComponent').default)
/*Home Header Component End*/
/*Report Component Start*/
Vue.component('certificates', require('./components/front-end/profile-pages/CertificatesSectionComponent').default)
/*Report Component End*/
/*Breadcrumb Component Start*/
Vue.component('bread-crumb-spec', require('./components/front-end/search-page/BreadCrumbComponent').default)
/*Breadcrumb Component End*/
Vue.component('other-doctor',require('./components/front-end/profile-pages/OtherDoctorSectionComponent').default)
Vue.component('doctor-card',require('./components/front-end/profile-pages/RelatedDoctorCardComponent').default)

const blog = new Vue({
  el: '#blog',
  mounted: function () {
    this.loading = false
  },  created () {
  },
  data: {
    loading: false,
  }
})