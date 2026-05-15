import Vue from 'vue';
require('./bootstrap')
window.Vue = require('vue')


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

import VueCountdownTimer from 'vuejs-countdown-timer'


Vue.use(VueCountdownTimer)
/*Login Component Start*/
Vue.component('login-component', require('./components/front-end/login/LoginComponent').default)
/*Login Component End*/


const login = new Vue({
  el: '#login',
  mounted: function () {
    this.loading = false
  },  created () {
  },
  data: {
    loading: false,
  }
})