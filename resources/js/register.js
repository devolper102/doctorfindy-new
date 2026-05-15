import Vue from 'vue';
require('./bootstrap')
window.Vue = require('vue')


import VueLazyload from 'vue-lazyload'

Vue.use(VueLazyload)

import Multiselect from 'vue-multiselect'
Vue.component('multiselect', Multiselect)

// or with options
//const loadimage = require('./images/loader/loaderss.gif')
//const errorimage = require('./images/loader/error.jpg')  observer: true,

Vue.use(VueLazyload, {
  preLoad: 1.3,
  error: '/images/loader/error.jpg',
  loading: '/images/loader/loaderss.gif',
  attempt: 1,

})
import VueCountdownTimer from 'vuejs-countdown-timer'


Vue.use(VueCountdownTimer)

/*Login Component Start*/
Vue.component('register-component', require('./components/front-end/register/RegisterComponent').default)
/*Login Component End*/


const register = new Vue({
  el: '#register',
  mounted: function () {
    this.loading = false
  },  created () {
  },
  data: {
    loading: false,
  }
})