<template>
  <div>
      <section class="subscribe-newsletter">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bg-white box_shadow w-100 d-inline-block mt-5 mb-5 p-4">
                        <div class="subscribe-newsletter w-85 m-auto d-block w-xs-100">
                            <p class="banner_heading_color font-weight-bold">Subscribe to Newsletter</p>
                            <span class="text_18 mt-2 d-inline-block banner_heading_color">Get daily health updates to your inbox!</span>
                            <form>
                                <div class="form-group w-50 float-left mt-3 w-xs-100 w-md-100 w-sm-100">
                                    <input name="email" v-model="email" type="email" class="form-control rounded-pill pr-5 specialities-background text_18 text_black" placeholder="Enter your email">
                                </div>
                                <div class="subscrib-btn w-100 d-inline-block mt-2">
                                    <a  @click="submitEmail" href="javascript:void(0)"class="text-white rounded-pill text_16 d-inline-block knockdoc_btn_bg border-0 w-25 p-2 w-sm-50 text-center" >
                                        Subscribe
                                    </a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>
</template>

<script>
import Toasted from 'vue-toasted';

Vue.use(Toasted)
export default {
  name: "SubscribeSectionComponent",
  props:[],
    data: function() {
    return {
          
      email: '',
      loading: false,
      errors:[],
    }
  },
   methods: {
    submitEmail () {
      let self = this
         if (self.email === '' || self.email.length < 1 ) {
        Vue.toasted.error('Enter Email' , { duration: 3000 })
        return
      }
      if ((/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(self.email))) {
                axios.post(APP_URL + '/subscriber', {
          email: self.email
        }).then(function (response) {
          console.log(response)
          if (response.data.type === 'success') {
            self.loading = false
            Vue.toasted.success(response.data.message , { duration: 3000 })
            self.email = ''
            window.location = APP_URL + '/'
          }
          else {
            self.loading = false
            Vue.toasted.show(response.data.message , { duration: 3000 })
          }
            });
      }
      else{
        Vue.toasted.error('Incorrect Email ' , { duration: 3000 })
        return
      }  
    }
  }

}
</script>

<style>
img[lazy=loading] {
    background-image: url("/images/loader/loaderss.gif");
    background-position: center;
    background-size: contain;
    display: flex;
    width: auto;
    height: auto;
    background-repeat: no-repeat;
  }
img[lazy=error] {
    background-image: url("/images/loader/healthcare-image.png");
    background-position: center;
    background-size: contain;
    display: flex;
    width: auto;
    height:162px !important;
    background-repeat: no-repeat;
  }
</style>