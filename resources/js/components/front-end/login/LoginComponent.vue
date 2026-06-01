<template>
  <div>
    <!-- Start section discover best doctor and consultation  -->
    <section class="discover-best-doctor-and-consultation">
      <div class="container-fluid">
        <div class="row">
          <div class="col-5 col-lg-5 p-0 d-none d-lg-block"  v-if="sign_show_hide ==='true'">
              <div class="bg-image-discover-doctor-consultation login_img" :style="{ 'background-image': 'url(/uploads/settings/home/' + sign_img + ')' }" style="background:no-repeat left;background-size: contain;
            width: 100%;
            display: inline-block;
            position: relative;
            height: 100vh;
            background-size: cover;">
              <div class="container">
                <div class="row">
                  <div class="col-12 text-center">
                    <div class="discover-best-consultation-text mt-5 text-left pl-4">
                      <p class="text-white text_25">{{sign_title}}
                      </p>
                      <span class="text-white text_25 font-weight-bold">{{sign_description}}</span>
                    </div>
                    <div class="w-100 d-inline-block text-center mt-5 logo">
                      <img class="mt-5 d-inline-block" src="/images/login-logo.svg">
                    </div>
                </div>
                  </div>
                </div>
                <div class="Terms-and-condition position-absolute">
                  <span class="text-white">Terms and Conditions</span>
              </div>
            </div>
          </div>
          <div class="col-lg-7 col-12">
            <!-- <div class="not-member-text w-100 d-inline-block">
              <a class="text_14 text_black float-right mt-5" href="/register">Not a member ? <span class="theme-color-text font-weight-bold">Sign Up
              </span> </a>
            </div> -->
            <div class="w-60 m-auto w-sm-100">
              <div class="w-100 d-inline-block mt-4">
                <div class="welcome-login-text">
										<span class="text_black font-weight-bold text_30">
										Welcome back</span>
                  <p class="text_black text_25">Login to your account
                  </p>
                </div>
                <form @submit.prevent="handleSubmit">
                  <div class="form-group mt-3 mb-2 w-90 w-md-100 d-inline-block">
                    <label for="email" class="login-text text_13 font-weight-bold">Email address / Phone number
                    </label>
                    <input type="text" name="email" v-model="email" class="form-control specialities-background" placeholder="user@gmail.com / 03xxxxxxxxx" id="email">
                    <label class="error d-none login-text text_13 font-weight-bold" id="email_name_error">Email address / Phone number
                    </label>
                  </div>
                  <div class="form-group w-90 w-md-100 d-inline-block position-relative mb-0">
                    <label for="password" class="login-text text_13 font-weight-bold">Password</label>
                    <input type="password" name="password" v-model="password" class="form-control specialities-background" placeholder="Enter password" id="password">
                    <label class="error d-none" id="password_name_error">Enter Password</label>
                     <label @click="showPasswordlogin()" id="changeTextPass"><i class="fa fa-eye-slash" aria-hidden="true"></i></label>

                  </div>
                  <div class="custom-control custom-checkbox mb-3 w-90 w-md-100 d-inline-block w-sm-100">
                    <input type="checkbox" class="custom-control-input"
                           id="customCheck" name="remember"  v-model="remember" value="1">
                    <label class="custom-control-label text_14 login-text" for="customCheck">Keep me logged in
                    </label>
                    <a class="service-text float-right text_14 font-weight-bold" href="/password/reset">Forgot password?
                    </a>
                  </div>
                  <div class="signup-button w-50 w-xs-100 w-sm-100 w-md-100">
                    <button class="text_16 bg-blue book-rounded text-white border-0 w-100 font-weight-bold" type="submit">Sign in</button>
                  </div>
                </form>

                <div class="text-you-can-sign w-100 d-inline-block">
                  <p class="text_black text-center text_14">Not a member ? <a href="/register" class="service-text font-weight-bold">Sign up</a>
                  </p>
                </div>
                <div class="w-100 d-inline-block text-center mb-3">
                  <p class="mb-0 text_black text_14 font-weight-bold">OR</p>
                </div>
                <div class="awesome-icon w-100 d-inline-block mt-2 text-center">
                  <a class="d-inline-block book-rounded mr-xl-3 google-icon" href="/auth/redirect/google">
                    <img class="google-image" src="/images/gmail.svg">
                  <span class="text_black text_14">
                    Sign up with Google
                  </span>
                </a>
                  <a class="book-rounded d-inline-block facebook-icon mt-xl-0 mt-3" href="/auth/redirect/facebook">
                    <img class="google-image" src="/images/facebook.svg">
                    <span class="text_black text_14">
                    Sign up with Facebook
                  </span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End section -->
  </div>

</template>

<script>
// register the plugin on vue
import Toasted from 'vue-toasted';
Vue.use(Toasted)

export default {
  name: "LoginComponent",
  props:[
    'sign_up_section',
    'site_logo'
  ],
  data() {
    return{
      submitted: false,
      email: '',
      password: '',
      remember:'',
      email_name_error: '',
      password_name_error: '',
      sign_title: '',
      sign_description: '',
      sign_img: '',
      sign_show_hide: '',
      main_logo: '',
    }
  },
  created () {
    const parseMeta = (item, fallback = {}) => {
      if (!item || !item.meta_value) {
        return fallback;
      }
      try {
        return JSON.parse(item.meta_value);
      } catch (error) {
        return fallback;
      }
    };

    const signUpSettings = parseMeta(this.sign_up_section);
    const generalSettings = parseMeta(this.site_logo);

    this.sign_title = signUpSettings.title || '';
    this.sign_description = signUpSettings.description || '';
    this.sign_img = signUpSettings.hidden_sign_up_img || '';
    this.sign_show_hide = signUpSettings.show_signup_sec || '';
    this.main_logo = generalSettings.site_logo || '';
  },
  methods:{
     showPasswordlogin() {
         var elementsArray = document.querySelectorAll("#password")
        elementsArray.forEach(element => {
        if (element.type === "password") {
            element.type = "text";
            document.getElementById('changeTextPass').innerHTML ="<i class='fa fa-eye' aria-hidden='true'></i>"; 
          } else {
            element.type = "password";
            document.getElementById('changeTextPass').innerHTML ="<i class='fa fa-eye-slash' aria-hidden='true'></i>"; 
          }
      });
  },
    handleSubmit (e) {
      this.checkLogin()
      this.submitted = true;
      const { email, password ,remember} = this;
      if (email && password || remember) {
        this.login( email, password,remember )
      }
    },
    login (email, password, remember) {
      const meta = document.head.querySelector('meta[name="csrf-token"]');
      const csrfToken = meta ? meta.content : null;

      const postLogin = () => axios.post(APP_URL + '/vueLogin', {
        email: email,
        password: password,
        remember: remember,
      });

      const handleResponse = (response) => {
        if (response.data.result === 'error') {
          Vue.toasted.error(response.data.message, { duration: 3000 });
        } else {
          Vue.toasted.success('You have logged in successfully', { duration: 3000 });
          window.location = APP_URL + '/' + response.data.roles[0].role_type + '/dashboard';
        }
      };

      const handleError = () => {
        Vue.toasted.error('Login failed. Please refresh the page and try again.', { duration: 3000 });
      };

      if (csrfToken) {
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
        postLogin().then(handleResponse).catch(handleError);
        return;
      }

      axios.get('/csrf').then((response) => {
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = response.data;
        return postLogin();
      }).then(handleResponse).catch(handleError);
    },
    checkLogin () {
      let self = this
      if (self.email) { document.querySelector("#email_name_error").classList.add('d-none') }
      if (self.password) { document.querySelector("#password_name_error").classList.add('d-none') }

      if (!self.email) { document.querySelector("#email_name_error").classList.remove('d-none') }
      if (!self.password) { document.querySelector("#password_name_error").classList.remove('d-none') }
    },

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
    height: auto;
    background-repeat: no-repeat;
  }
.custom-control-label::after{

  cursor:pointer;
}
.error{

  color:#ea4335!important;
  font-size:15px;
}
</style>