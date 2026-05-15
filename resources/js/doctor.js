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
Vue.component('forum', require('./components/front-end/health-forum/ForumComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('forum-banner', require('./components/front-end/health-forum/BannerSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('home-banner', require('./components/front-end/health-forum/BannerHomeSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('user-info', require('./components/front-end/health-forum/UserInfoSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('top-user', require('./components/front-end/health-forum/TopContributorSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('related-forum', require('./components/front-end/health-forum/RelatedForumTopics').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('ask-question', require('./components/front-end/health-forum/AskQuestionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('answer', require('./components/front-end/health-forum/AnswersSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('nav-section', require('./components/front-end/health-forum/NavSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('tags-section', require('./components/front-end/health-forum/TagSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('post-section', require('./components/front-end/health-forum/PostsSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('post-search-section', require('./components/front-end/health-forum/PostSearchSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('doctor-tab', require('./components/front-end/health-forum/DoctorProfileComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('other-doctor', require('./components/front-end/health-forum/OtherDoctorSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('trending-section', require('./components/front-end/health-forum/TrendingSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('results-nav', require('./components/front-end/health-forum/ResultsSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('question-slider', require('./components/front-end/health-forum/QuestionSliderSectionComponent').default)
/*Header Component End*/
/*Header Component Start*/
Vue.component('forum-slider', require('./components/front-end/health-forum/ForumSliderSectionComponent').default)
/*Header Component End*/
/*Doctor Profile Component*/
Vue.component('other-doctor-card', require('./components/front-end/health-forum/OtherDoctorCardComponent').default)
/*Home Header Component End*/

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

/* Site Pages */

const doctor = new Vue({
  el: '#doctor',
  mounted: function () {
    this.loading = false
  },  created () {
  },
  data: {
    loading: false,
  }
})
