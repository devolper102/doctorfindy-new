<template>
  <div>
    <section class="signup-lorem-ipsum">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="heading-signup mt-lg-5 mt-3 mb-3 mb-lg-4 w-40 w-xs-100 w-sm-100 w-md-100">
              <h2 class="font-weight-bold">Sign up</h2>
              <p class="text_black text_15">To Expands access to care and reach more patients, enhance your revenue and Improve Healthcare quality</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row mb-lg-5 mb-4">
          <div class="col-12 col-sm-12 col-md-6 col-lg-6 pl-0 d-none d-md-none d-lg-block">
            <div class="signup-image">
              <img src="images/signup-image.png" alt="signup-image
              picture" class="img-fluid">
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-6">
              <div class="signup-box w-80 w-sm-100 d-inline-block p-3 box_radius ml-0 ml-sm-0 ml-md-0 ml-lg-5 w-md-100 box_shadow">
                <div class="w-100 d-inline-block Card">
                  <div class="welcome-login-text">
                    <span class="text_black font-weight-bold text_30">Sign up</span>
                  </div>
                  <form method="POST" @submit.prevent="handleSubmit" class="dc-formtheme dc-formregister " id="register_form" >
                    <div class="form-group w-48 w-md-100 float-left mb-0 mr-lg-2 custom_height">
                      <label class="text_black text_13 font-weight-bold">First name</label>
                      <input type="text" name="first_name" v-model="first_name" @keypress="isLetter($event)"class="form-control h_37 text_14 specialities-background" id="firstnameInputText" aria-describedby="emailHelp" placeholder="">
                      <label class="error mt-1 d-none" v-model="first_name_error" id="first_name_error">Enter First Name</label>

                    </div>
                    <div class="form-group w-48 w-md-100 float-left mb-2 custom_height">
                      <label class="text_black text_13 font-weight-bold">Last name</label>
                      <input type="text" name="last_name" v-model="last_name"@keypress="isLetter($event)" class="form-control h_37 text_14 specialities-background" id="lastnameInputText" aria-describedby="emailHelp" placeholder="">
                      <label class="error mt-1 d-none" v-model="last_name_error" id="last_name_error">Enter Last Name</label>
                    </div>
                    <div>
                      <div class="form-group w-48 w-md-100 float-left mb-0 mr-lg-2 custom_height">
                        <label class="text_black text_13 font-weight-bold"> Select PMC / NCS </label>
                        <select  class="form-control h_40 text_14 specialities-background" @change="onChanges($event)">
                           <option value="pmc">PMC</option>
                          <option value="ncs">NCS</option>
                        </select>
                      </div>
                       <div v-if="getvalue === 'pmc'"class="form-group w-48 w-md-100 float-left mb-2 custom_height">
                        <label class="text_black text_13 font-weight-bold"> Enter Registeration </label>
                        <input type="text" v-model="pmdc_number" class="form-control h_40 text_14 specialities-background" id="PDMC_input" aria-describedby="emailHelp" placeholder="Enter PMC">
                        <label class="error mt-1 d-none" v-model="pmdc_number" id="pmdc_number">Enter Number</label>
                      </div>
                       <div v-if="getvalue === 'ncs'" class="form-group w-48 w-md-100 float-left mb-2 custom_height">
                        <label class="text_black text_13 font-weight-bold"> Enter Registeration </label>
                        <input type="text" v-model="ncs_number" class="form-control h_40 text_14 form-control h_40 text_14 specialities-background" id="NCS_input" aria-describedby="emailHelp" placeholder="Enter NCS">
                        <label class="error mt-1 d-none" v-model="ncs_number" id="ncs_number">Enter Number</label>
                      </div>
                    </div>
                      <div class="form-group w-48 w-md-100 float-left mb-2 custom_height mr-lg-2">
                      <label class="text_black text_13 font-weight-bold">Phone Number</label>
                      <input type="text" name="phone_number" v-model="phone_number"@keypress="isNumber($event)"maxlength="11" class="form-control specialities-background h_37" placeholder="03XXXXXXXXX" id="phone_number">
                      <label class="error mt-1 d-none" v-model="phone_number_error" id="phone_number_error">Enter Phone Number</label>
                    </div>
                    <div class="form-group w-48 w-md-100 float-left mb-0 mr-lg-2 custom_height">
                      <label class="text_black text_13 font-weight-bold">Email address</label>
                      <input type="email" name="email" v-model="email" class="form-control specialities-background h_37" placeholder="" id="emailaddress">
                      <label class="error mt-1 d-none" v-model="email_error" id="email_error">Enter Email</label>
                    </div>
                    <div class="form-group w-100 w-md-100 float-left mb-0 mr-lg-2 custom_height">
                      <label class="text_black text_13 font-weight-bold">Password</label>
                      <input type="password" name="password" v-model="password" class="form-control specialities-background h_37" placeholder="" id="passwordnumber">
                      <label class="error mt-1 d-none" v-model="password_error" id="password_error">Enter Password</label>
                    </div>
                    <div class="custom-control custom-checkbox  form-group d-inline-block">
                      <input type="checkbox" id="showid" class="custom-control-input"> <label class="custom-control-label" for="showid" id="changeText" @click="showPassword()">Show Password</label>
                    </div>
                    <div class="custom-control custom-checkbox mb-3 w-100 d-inline-block mt-1">
                      <input type="checkbox" name="termNcondition" v-model="termNcondition" class="custom-control-input" id="customCheck">
                      <label class="custom-control-label text_14 text_black" for="customCheck"> Creating an account means you're ok with our <span><a class="font-weight-bold d-block text_black" href="/privacy">terms and conditions</a></span></label>
                    </div>
                     <label class="error mt-1 d-none" v-model="termNcondition_error" id="termNcondition_error">Our Term & Condition are must</label>
                    <div class="signup-button w-100 float-left w-sm-100">
                      <button class="text_16 knockdoc_btn_bg text-white border-0 w-50 font-weight-bold">Sign up</button>
                    </div>
                  </form>
                </div>
                <br />
              </div>
          </div>
        </div>
      </div>
    </section>
      <div v-if="showModal">
      <div class="modal fade show" style="display: block" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog register-modal" role="document">
          <div class="modal-content box_radius">
            <div class="modal-header w-100 d-inline-block text-center mt-4 border-0 pb-0">
              <h3 class="modal-title text_black font-weight-bold" id="registerModalLabel">Enter Verification Code</h3>
              <p class="text_black font-weight-bold text_13">A text message with code was sent to your phone</p>
            </div>
            <div class="modal-body w-75 m-auto">
              <div class="row">
                <div class="col-2 pl-0">
                  <div class="form-group float-left mb-0">
                    <CodeInput :loading="false" class="input" v-on:change="onChange" v-on:complete="onComplete" />
                  </div>
                </div>
              </div>
            </div>
            <div class="verification-text-phone-number w-100 d-inline-block">
              <a class="text_black text_14" href="#">We’ve sent verification code on your Phone Number</a>
              <p class="text_14 font-weight-bold theme-green-text float-right">
                <vue-countdown-timer
                    @start_callback="startCallBack('event started')"
                    @end_callback="endCallBack('event ended')"
                    :start-time="startAt"
                    :end-time="endAt"
                    :interval="1000"
                    :start-label="'Timer'"
                    label-position="begin"
                    :end-text="'00.00'"
                >
                  <template slot="countdown" slot-scope="scope">
                    <span>{{scope.props.minutes}}<i></i>:</span>
                    <span>{{scope.props.seconds}}</span><i></i>
                  </template>
                </vue-countdown-timer>
              </p>
            </div>
            <div class="modal-footer w-75 m-auto d-inline-block border-0 pt-0">
              <button @click="submitVerificationCode" type="button" class="btn knockdoc_btn_bg text-white w-45 float-left" data-dismiss="modal">Verify</button>
              <button @click="resendVerificationCode" :disabled='isDisabled' type="button" class="btn knockdoc_btn_bg text-white w-45 float-right">Resend</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>

import Toasted from 'vue-toasted';
import CodeInput from "vue-verification-code-input";

Vue.use(Toasted)

export default {
  name: "JoinSectionComponent",
  components: { CodeInput },
  props:[
    '',
    ''
  ],
  data() {
    return{
        loading: false,
      submitted: false,
      first_name: '',
      last_name: '',
      email: '',
      password: '',
      phone_number: '',
      doctor: '',
      patient: '',
      laboratory: '',
      hospital: '',
      termNcondition: '',
      pmdc_number: '',
      ncs_number: '',

      showModal: false,
      startAt: '',
      endAt: '',
      verification_code: '',
      isDisabled: true,
      first_name_error: '',
      last_name_error: '',
      email_error: '',
      phone_number_error: '',
      password_error: '',
      role_error: '',
      termNcondition_error: '',
      sign_title: '',
      sign_description: '',
      sign_img: '',
      sign_show_hide: '',
      site_logo: '' ,
      getvalue: 'pmc',


    }
  },
  created () {
    this.endAt = (new Date).getTime()+60000
    this.startAt = (new Date).getTime()+60000
  },
  methods: {
    isLetter(e) {
      let char = String.fromCharCode(e.keyCode);
      if (/^[A-Za-z]+$/.test(char)) return true;
      else e.preventDefault();
    },
    isNumber(e) {
      let char = String.fromCharCode(e.keyCode);
      if (/^[0-9]+$/.test(char)) return true;
      else e.preventDefault();
    },
    showPassword() {
         var elementsArray = document.querySelectorAll("#passwordnumber, #retypepassword")
        elementsArray.forEach(element => {
        if (element.type === "password") {
            element.type = "text";
            document.getElementById('changeText').innerHTML ="Hide Password"; 
          } else {
            element.type = "password";
            document.getElementById('changeText').innerHTML ="Show Password"; 
          }
      });
  },
  onChanges(event) {
    this.getvalue =  event.target.value
        },
    handleSubmit (e) {
      this.checkFormRemoveError();
      this.submitted = true;
      let role = 'doctor'
      const { first_name, last_name, email, phone_number, password, doctor, hospital, patient, laboratory, termNcondition,pmdc_number,ncs_number } = this;
      if (first_name && last_name && email && password  && role && termNcondition || pmdc_number || ncs_number) {
        this.register( first_name, last_name, email, phone_number, password, role, termNcondition,pmdc_number,ncs_number )
      }
      else { this.checkForm() }
    },

    register( first_name, last_name, email, phone_number, password, role, termNcondition ,pmdc_number,ncs_number) {
      let self = this
      self.loading = true
          if (self.getvalue === 'pmc') {
        if (pmdc_number === '' || pmdc_number.length < 1) {
          Vue.toasted.error('Enter PMC Number' , { duration: 3000 })
        return
        }
      }
      if (self.getvalue === 'ncs') {
        if (ncs_number === '' || ncs_number.length < 1) {
          Vue.toasted.error('Enter NCS Number' , { duration: 3000 })
        return
        }
      }
         if (email === '' || email.length < 1 ) {
        Vue.toasted.error('Enter Email' , { duration: 3000 })
        return
      }
      if ((/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email))) {

      }
      else{
        Vue.toasted.error('Incorrect Email ' , { duration: 3000 })
        return
      }
       if (password === '' || password.length < 1 ) {
        Vue.toasted.error('Enter Password' , { duration: 3000 })
        return
      }
      if (password.length < 8) {
        Vue.toasted.error('Minimum password length will be 8 characters' , { duration: 3000 })
        return
      }
      if (phone_number === '' || phone_number.length < 1 ) {
        Vue.toasted.error('Enter your mobile number' , { duration: 3000 })
        return
      }
      else if (!(/^(3)([0-9]{2}[0-9]{7})$/.test(phone_number)) && !(/^(03)([0-9]{2}[0-9]{7})$/.test(phone_number)) && !(/^(923)([0-9]{2}[0-9]{7})$/.test(phone_number))) {
        Vue.toasted.error("Use Correct Format  923XXXXXXXXX" , { duration: 3000 })
        return
      }
      if ((/^(3)([0-9]{2}[0-9]{7})$/.test(phone_number))) {
        phone_number = '92'+phone_number
        self.phone_number = phone_number
      }
      if ((/^(03)([0-9]{2}[0-9]{7})$/.test(phone_number))) {
        phone_number = '92' + phone_number.substring(1)
        self.phone_number = phone_number
      }
      if ((/^(923)([0-9]{2}[0-9]{7})$/.test(phone_number))) {
        self.phone_number = phone_number
      }

      axios.post(APP_URL + '/register-user', {
        first_name: first_name,
            last_name: last_name,
            email: email,
            password: password,
            phone_number: phone_number,
            role: role,
            termNconditi: termNcondition,
            select_degree : this.getvalue,
            pmdc_number: this.pmdc_number,
            ncs_number: this.ncs_number,
      }
      ).then(function (response) {
        console.log(response,response.data)
        if (response.data !== 'Password Cannot Match') {
        if (response.data.type === 'success'){
          self.endAt = (new Date).getTime()+60000
          self.showModal = !self.showModal
          self.loading = false
          Vue.toasted.success(response.data.message , { duration: 3000 })
        }
        else {
          self.loading = false
          Vue.toasted.error(response.data.message , { duration: 3000 })
        }
      }
      else{
        self.loading = false
        Vue.toasted.error(error , { duration: 3000 })
      }
      }).catch(function (error) {
        self.loading = false
        Vue.toasted.error('Something went wrong. Please try again' , { duration: 3000 })
      })
    },

    checkForm() {
      if (!this.first_name) { document.querySelector("#first_name_error").classList.remove('d-none') }
      if (!this.last_name) { document.querySelector("#last_name_error").classList.remove('d-none') }
      if (!this.email) { document.querySelector("#email_error").classList.remove('d-none') }
      if (!this.password) { document.querySelector("#password_error").classList.remove('d-none') }
      if (!this.phone_number) { document.querySelector("#phone_number_error").classList.remove('d-none') }
      if (!this.termNcondition) { document.querySelector("#termNcondition_error").classList.remove('d-none') }
        if (!this.add_email) { document.querySelector("#add_email_error").classList.remove('d-none') }
          if (this.getvalue === 'pmc') {
            if (!this.pmdc_number) { document.querySelector("#pmdc_number").classList.remove('d-none') }
          }
        if (this.getvalue === 'ncs') {
            if (!this.ncs_number) { document.querySelector("#ncs_number").classList.remove('d-none') }
          }

    },
    checkFormRemoveError() {
      let self = this
      if (self.first_name) { document.querySelector("#first_name_error").classList.add('d-none') }
      if (self.last_name) { document.querySelector("#last_name_error").classList.add('d-none') }
      if (self.email) { document.querySelector("#email_error").classList.add('d-none') }
      if (self.password) { document.querySelector("#password_error").classList.add('d-none') }
      if (self.phone_number) { document.querySelector("#phone_number_error").classList.add('d-none') }
      if (self.termNcondition) { document.querySelector("#termNcondition_error").classList.add('d-none') }
         if (this.getvalue === 'pmc') {
        if (self.pmdc_number) { document.querySelector("#pmdc_number").classList.add('d-none') }
        }
       if (this.getvalue === 'ncs') {
        if (self.ncs_number) { document.querySelector("#ncs_number").classList.add('d-none') }
       }
    },
     endCallBack (x) {
      console.log(x)
      this.isDisabled = false
      // document.querySelector('#resend-button').prop('disabled', false)
    },
    startCallBack (x) {
      console.log(x)
      this.isDisabled = true
    },
    submitVerificationCode (code) {
      let self = this
      self.loading = true
      self.verification_code = code
      axios.post(APP_URL + '/code/verification', {
        phone_number: self.phone_number,
        verification_code: self.verification_code
      }).then(function (response) {
          if (response.data.result === 'error') {
              Vue.toasted.error(response.data.message , { duration: 3000 })
            }
            else {
              Vue.toasted.success('Your account verified successfully' , { duration: 3000 })
              self.loading = false
              window.location = APP_URL + '/'+ response.data.roles[0].role_type +'/dashboard'
            }
      }).catch(function (error) {});
    },
  resendVerificationCode () {
      let self = this
      self.loading = false
      axios.post(APP_URL + '/user/resend-code', {
        phone_number: self.phone_number
      }).then(function (response) {
        if (response.data.type === 'success') {
          self.endAt = (new Date).getTime()+60000
          self.isDisabled = true
          self.loading = false
          Vue.toasted.success(response.data.message)
        }
        else {
          self.loading = false
          Vue.toasted.error(response.data.message , { duration: 3000 })
        }
      }).catch(function (error) {
        Vue.toasted.error(error, { duration: 3000 })
      });
    },
    onChange(v) {
    },
    onComplete(v) {
      console.log(v, v.length)
      this.submitVerificationCode(v)
    }
  },
}

</script>

<style scoped>
#register_form .error{
  font-size: 14px;
}
.custom_height{
  min-height: 87px;
}
.error{
  color:#ea4335 !important;
}
</style>