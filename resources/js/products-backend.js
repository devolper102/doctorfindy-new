import Vue from 'vue';
require('./bootstrap')
window.Vue = require('vue')
window.moment = require('moment')
import moment from 'moment'
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import '@morioh/v-quill-editor/dist/editor.css';
import Editor from '@morioh/v-quill-editor'
import Multiselect from"vue-multiselect";
Vue.component("multiselect", Multiselect);
import VueCropper from"vue-cropperjs";
import"cropperjs/dist/cropper.css";
Vue.component(VueCropper);
// global register
Vue.use(Editor);
import VueLazyload from 'vue-lazyload'

Vue.use(BootstrapVue)
Vue.use(VueLazyload)
import Antd from"ant-design-vue";
import"ant-design-vue/dist/antd.css";
Vue.config.productionTip= !1;
Vue.use(Antd);
import Toasted from 'vue-toasted';
Vue.use(Toasted)
// or with options
//const loadimage = require('./images/loader/loaderss.gif')
//const errorimage = require('./images/loader/error.jpg')  observer: true,

Vue.use(VueLazyload, {
  preLoad: 1.3,
  error: '/images/loader/error.jpg',
  loading: '/images/loader/loaderss.gif',
  attempt: 1,

})
Vue.component("product-catalogue-section", require("./components/products-page/catalogueComponent.vue").default)
Vue.component("product-creat-catalogue-section", require("./components/products-page/product-creat-catalogueComponent.vue").default)
Vue.component("product-categories-section", require("./components/products-page/product-categoriesComponent.vue").default)
Vue.component("product-tag-section", require("./components/products-page/product-tagComponent.vue").default)
Vue.component("product-page-setting-section", require("./components/products-page/product-page-settingComponent.vue").default)
Vue.component("product-brand-section", require("./components/products-page/product-brandComponent.vue").default)
Vue.component("product-attributes-section", require("./components/products-page/product-attributesComponent.vue").default)
Vue.component("product-reviews-section", require("./components/products-page/product-reviewsComponent.vue").default)
Vue.component("product-order-section", require("./components/products-brand-page/product-orderComponent.vue").default)
Vue.component("product-transcations-section", require("./components/products-brand-page/product-transcationsComponent.vue").default)
const productBackend = new Vue({
    el: '#productBackend',
    mounted: function () {
        this.loading = false
    },
    created () {},
    data: {
        loading: true,
    }
})
