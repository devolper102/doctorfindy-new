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
/*
Vue.component('main-content', require('./components/back-end/DashboardPageComponent').default)
Vue.component('today-table', require('./components/back-end/TodayTableComponent.vue').default);
Vue.component('tomorrow-table', require('./components/back-end/TomorrowTableComponent.vue').default);*/

Vue.component('header-section', require('./components/back-end/includes/HeaderComponent').default);
Vue.component('sidebar-section', require('./components/back-end/includes/SidebarComponent').default);
Vue.component('footer-section', require('./components/back-end/includes/FooterComponent').default);

Vue.component('doctor-dashboard', require('./components/back-end/dashboard/doctor/DashboardContentSectionComponent').default);
Vue.component('doctor-tab', require('./components/back-end/dashboard/doctor/DoctorTabSectionComponent').default);
Vue.component('doctor-summary', require('./components/back-end/dashboard/doctor/DoctorSummarySectionComponent').default);
Vue.component('appointment-section', require('./components/back-end/dashboard/doctor/AppointmentListingSectionComponent').default);
Vue.component('patient-detail', require('./components/back-end/dashboard/doctor/PatientDetailsSectionComponent').default);
Vue.component('invoice-section', require('./components/back-end/dashboard/doctor/InvoicesSectionComponent').default);
Vue.component('saved-section', require('./components/back-end/dashboard/doctor/SavedSectionComponent').default);

Vue.component('appointment-listing', require('./components/back-end/dashboard/doctor/AppointmentListComponent').default);
Vue.component('all-appointment', require('./components/back-end/dashboard/doctor/AllAppointmentsComponent').default);
Vue.component('all-appointment-notification', require('./components/back-end/dashboard/doctor/AllAppointmentsNotificationComponent').default);
Vue.component('blog-lists', require('./components/back-end/dashboard/doctor/BlogListComponent').default);
Vue.component('person-info', require('./components/back-end/dashboard/doctor/personInformationSectionComponent').default);
Vue.component('all-orders', require('./components/back-end/dashboard/doctor/AllOrdersComponent').default);

// Patient Dashboard 
Vue.component('header-patient-section', require('./components/back-end/includes/HeaderPatientComponent').default);
Vue.component('sidebar-patient-section', require('./components/back-end/includes/SidebarPatientComponent').default);
Vue.component('patient-dashboard', require('./components/back-end/dashboard/patient/DashboardContentSectionComponent').default);
Vue.component('patient-appointment-section', require('./components/back-end/dashboard/patient/PatientAppointmentsSectionComponent').default);
Vue.component('patient-tab', require('./components/back-end/dashboard/patient/PatientTabSectionComponent').default);
Vue.component('doctor-detail', require('./components/back-end/dashboard/patient/DoctorDetailsSectionComponent').default);
Vue.component('patient-invoices', require('./components/back-end/dashboard/patient/PatientInvoicesSectionComponent').default);
Vue.component('patient-saved', require('./components/back-end/dashboard/patient/PatientSavedSectionComponent').default);
Vue.component('patient-payment', require('./components/back-end/dashboard/patient/DashboardPaymentSectionComponent').default);
Vue.component('patient-information', require('./components/back-end/dashboard/patient/PatientInformationSectionComponent').default);
Vue.component('patient-choose-payment-method', require('./components/back-end/dashboard/patient/PatientChoosePaymentMethodSectionComponent').default);
Vue.component('patient-booking-doctor', require('./components/back-end/dashboard/patient/PatientBookingDoctorSectionComponent').default);
Vue.component('patient-appointments-listing', require('./components/back-end/dashboard/patient/PatientAppointmentListComponent').default);
Vue.component('patient-all-appointments', require('./components/back-end/dashboard/patient/PatientAllAppointmentComponent').default);
Vue.component('payout-appointments', require('./components/back-end/dashboard/patient/PayoutAppointmentsComponent').default);
Vue.component('get-appointment-payment', require('./components/back-end/dashboard/patient/GetAppointmentPaymentSectionComponent').default);
Vue.component('patient-show-invoice', require('./components/back-end/dashboard/patient/ShowInvoiceSectionComponent').default);


import Swal from 'sweetalert2'
window.Swal = Swal
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Toast = Toast;
const dashboard = new Vue({
  el: '#dashboard',
  mounted: function () {
    this.loading = false
  },
  created () {
  },
  data: {
    loading: false,
  }
});
