<template>
  <div>
    <div v-if="loading" id="loader"></div>
    <section class="discover-best-doctor-and-consultation">
      <div class="container-fluid">
        <div class="row">
          <div class="col-5 p-0 d-none d-lg-block" v-if="sign_show_hide === 'true'">
            <div class="bg-image-discover-doctor-consultation" :style="{ 'background-image': 'url(/uploads/settings/home/' + sign_img + ')' }"
            style="background:no-repeat left;background-size: contain;
            width: 100%;
            display: inline-block;
            position: relative;
            height: 100vh;
            background-size: cover;">
              <div class="register_header ml-lg-5 ml-md-5">
                <!-- <a href="/" class="navbar-brand w-sm-40 register-logo">
                  <img v-lazy="'/uploads/settings/general/'+ main_logo" alt="Site Logo" name="Site Logo" />
                </a> -->
                <div class="discover-best-consultation-text mt-3">
                  <p class="text-white text_25">{{sign_title}}
                  </p>
                  <span class="text-white text_25 font-weight-bold">{{sign_description}}</span>
                </div>
                <div class="w-90 d-inline-block text-center mt-5 
                logo">
                      <img class="mt-5 d-inline-block" src="/images/login-logo.svg">
                    </div>
                <div class="Terms-and-condition position-absolute">
                  <a class="text-white" href="/privacy">Terms and Conditions</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7 col-12">
           <!--  <div class="not-member-text w-100 d-inline-block">
            
            </div> -->
            <!-- <div class="not-member-text w-100 d-inline-block">
                <span class="text_14 text_black float-right mt-3" style="margin-left:20px;">
              <a href="/" class="theme-color-text font-weight-bold">Go Back To Home</a></span>
            </div> -->
            <div class="w-60 m-auto w-sm-100 w-xs-100 ipad_h_width m-xs-0">
              <div class="w-100 d-inline-block mt-4">
                <div class="welcome-login-text">
                  <span class="text_black font-weight-bold text_30">Create account</span>
                </div>
                <form method="POST" @submit.prevent="handleSubmit" class="dc-formtheme dc-formregister" id="register_form">
                  <div class="radio-button-group w-90 d-inline-block mb-3">
                    <label class="text_black text_13 font-weight-bold w-90 d-inline-block">Start as </label>
                    <div class="custom-control custom-radio w-22 float-left mr-2 default" id="patient_role"  @click="closeFields()">
                      <input type="radio" name="role" v-model="patient" class="custom-control-input" id="customRadio3" value="patient" checked>
                      <label class="custom-control-label text-radio-btn font-weight-bold text_14"  for="customRadio3">Patient</label>
                    </div>
                    <div class="custom-control custom-radio w-21 float-left mr-2 ml-2" @click="registerDoctor('getdoctor')">
                      <input type="radio" name="role" v-model="doctor" class="custom-control-input" id="customRadio1" value="doctor">
                      <label class="custom-control-label text-radio-btn font-weight-bold text_14" for="customRadio1">Doctor</label>
                    </div>
                    <!-- <div class="custom-control custom-radio w-22 float-left mr-2" @click="closeFields()">
                      <input type="radio" name="role" v-model="hospital" class="custom-control-input" id="customRadio2" value="hospital">
                      <label class="custom-control-label text-radio-btn font-weight-bold text_15" for="customRadio2">Hospital</label>
                    </div> -->
                    <!-- <div class="custom-control custom-radio w-22 float-left"  @click="closeFields()">
                      <input type="radio" name="role" v-model="laboratory" class="custom-control-input" id="customRadio4" value="laboratory">
                      <label class="custom-control-label text-radio-btn font-weight-bold text_15" for="customRadio4">Laboratory</label>
                    </div> -->
                    <label class="error d-none" v-model="role_error" id="role_error">Choose Role</label>
                  </div>
                  <div class="form-group w-48 w-md-100 w-sm-100 float-left mb-2 mr-lg-3 mr-md-3">
                    <label class="login-text text_13 font-weight-bold">First name</label>
                    <input type="text" name="first_name" maxlength="22" v-model="first_name" @keypress="isLetter($event)" class="form-control h_37 text_14 specialities-background" id="firstnameInputText" aria-describedby="emailHelp" placeholder="" >
                    <label class="error d-none" v-model="first_name_error" id="first_name_error">Enter First Name</label>

                  </div>
                  <div class="form-group w-48 w-md-100 w-sm-100 float-left mb-2 float-md-right">
                    <label class="login-text text_13 font-weight-bold">Last name</label>
                    <input type="text" name="last_name" maxlength="22" v-model="last_name" @keypress="isLetter($event)"class="form-control h_37 text_14 specialities-background" id="lastnameInputText" aria-describedby="emailHelp" placeholder="">
                    <label class="error d-none" v-model="last_name_error" id="last_name_error">Enter Last Name</label>
                  </div>
                  <div  v-if="getdoctor">
                    <div class="form-group w-48 w-md-100 w-xs-100 w-sm-100 float-left mb-2 mr-lg-3 mr-md-3">
                      <label class="login-text text_13 font-weight-bold"> Select PMDC / NCS </label>
                      <select  class="form-control h_40 text_14 specialities-background" @change="onChanges($event)">
                         <option value="pmc">PMC</option>
                        <option value="ncs">NCS</option>
                      </select>
                    </div>
                     <div v-if="getvalue === 'pmc'"class="form-group w-48 w-md-100 float-left mb-0 float-md-right w-xs-100 w-sm-100">
                      <label class="login-text text_13 font-weight-bold"> Enter Registeration </label>
                      <input type="text" v-model="pmdc_number" class="form-control h_40 text_14 specialities-background" id="PDMC_input" aria-describedby="emailHelp" placeholder="Enter PMC">
                      <label class="error d-none" v-model="pmdc_number" id="pmdc_number">Enter Number</label>
                    </div>
                     <div v-if="getvalue === 'ncs'" class="form-group w-48 w-md-100 w-sm-100 float-left mb-0">
                      <label class="login-text text_13 font-weight-bold"> Enter Registeration </label>
                      <input type="text" v-model="ncs_number" class="form-control h_40 text_14 form-control h_40 text_14 specialities-background" id="NCS_input" aria-describedby="emailHelp" placeholder="Enter NCS">
                      <label class="error d-none" v-model="ncs_number" id="ncs_number">Enter Number</label>
                    </div>

                    <div class="form-group w-100 w-md-100 w-sm-100 float-left mb-2 register-select">
                      <label class="login-text text_13 font-weight-bold"> Select Specialities </label>
                      <!-- <select  class="form-control h_40 text_14 specialities-background" @change="onSelectSpeciality($event)" :max-results="specialitiesOpt.length" multiple>
                         <option value="">Please Select</option>
                         <option v-for="speciality in specialitiesOpt" :value="speciality.id">{{speciality.title}}</option>
                      </select> -->
                      <multiselect v-model="selectedSpeciality" :options="specialitiesOpt" @select="onSelectSpeciality" placeholder="Select Specialities" label="title" :multiple="true" track-by="id" >
                                    
                      </multiselect>
                    </div>

                    <div class="form-group w-100 w-md-100 w-sm-100 float-left mb-2 register-select">
                      <label class="login-text text_13 font-weight-bold"> Select Location </label>
                      <multiselect v-model="selectLocation" :options="locationOpt" @select="onSelectLocation" placeholder="Select Location" label="title" track-by="id" >
                                    
                      </multiselect>
                    </div>
                  </div>
                  <div class="form-group w-100 w-md-100 d-inline-block mb-2">
                    <label class="login-text text_13 font-weight-bold">Phone Number</label>
                    <input type="text" name="phone_number" v-model="phone_number" @keypress="isNumber($event)"class="form-control specialities-background h_37" placeholder="03XXXXXXXXX" id="phone_number"maxlength="11">
                    <label class="error d-none" v-model="phone_number_error" id="phone_number_error">Enter Phone Number</label>
                  </div>
                  <div class="form-group mb-2 w-100 w-md-100 d-inline-block">
                    <label class="login-text text_13 font-weight-bold">Email address</label>
                    <input type="email" name="email" v-model="email" class="form-control specialities-background h_37" placeholder="" id="emailaddress">
                    <label class="error d-none" v-model="email_error" id="email_error">Enter Email</label>
                  </div>
                  <div class="form-group w-100 w-md-100 d-inline-block mb-2">
                    <label class="login-text text_13 font-weight-bold">Password</label>
                    <div class="form-group position-relative">
                      <input type="password" name="password" v-model="password" class="form-control specialities-background h_37" placeholder="" id="passwordnumber">
                      <label @click="showPassword()" id="changeText"><i class="fa fa-eye-slash" aria-hidden="true"></i></label>
                    </div>
                    <label class="error d-none" v-model="password_error" id="password_error">Enter Password</label>
                  </div>
                  <div class="custom-control custom-checkbox mb-3 w-90 d-inline-block mt-1">
                    <input type="checkbox" name="termNcondition" v-model="termNcondition" class="custom-control-input" id="customCheck">
                    <label class="custom-control-label text_14 text_black" for="customCheck"> Accept <a class="font-weight-bold d-inline-block text_black" href="/privacy">terms and conditions</a></label>
                    <label class="error d-none" v-model="termNcondition_error" id="termNcondition_error">Our Term & Condition are must</label>
                  </div>
                  <div class="signup-button w-50 d-block m-auto w-sm-100 w-xs-100 w-md-100">
                    <button class="text_16 bg-blue book-rounded text-white border-0 w-100 font-weight-bold" type="submit">Register</button>
                  </div>
                </form>
                <div class="text-you-can-sign w-100 d-inline-block">
                  <p class="text_black text-center mt-2">Or you can sign up with</p>
                </div>
                <div class="awesome-icon w-100 d-inline-block mt-2 text-center mb-4">
                  <a class="d-inline-block book-rounded mr-xl-3 google-icon" href="/auth/redirect/facebook">
                    <img class="google-image" src="/images/gmail.svg">
                  <span class="text_black text_14">
                    Sign up with Google
                  </span>
                  </a>
                  <a class="book-rounded d-inline-block facebook-icon mt-xl-0 mt-3" href="/auth/redirect/google">
                    <img class="google-image" src="/images/facebook.svg">
                    <span class="text_black text_14">
                    Sign up with Facebook
                  </span>
                  </a>
                  <div class="text_14 text_black mt-3">Already have an account? 
                    <a href="/login" class="service-text font-weight-bold sign-in border-0">Sign In</a>
                  </div>
                </div>
              </div>
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
            <div class="verification-text-phone-number w-100 d-inline-block text-center">
              <p class="text_black text_14 text-center w-100 d-inline-block" href="javascript:void(0)">We’ve sent verification code on your Phone Number</p>
              
            </div>
            <div class="modal-footer w-75 m-auto d-inline-block border-0 pt-0">
              <p class="text_14 font-weight-bold theme-green-text text-right">
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
              <button @click="submitVerificationCode" type="button" class="btn knockdoc_btn_bg text-white w-48 m-0 float-left" data-dismiss="modal">Verify</button>
              <button @click="resendVerificationCode" :disabled='isDisabled' type="button" class="btn knockdoc_btn_bg text-white w-48 m-0 float-right">Resend</button>
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
import Multiselect from "vue-multiselect";

Vue.use(Toasted)

export default {
  name: "RegisterComponent",
  components: { CodeInput },
  props:[
    'sign_up_section',
    'site_logo'
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
      specialitiesOpt:[],
      selectedSpeciality:[],
      locationOpt:[],
      selectLocation:"",
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
      main_logo: '',
      getvalue: 'pmc',
      getdoctor: false,


    }
  },
  created () {
    this.endAt = (new Date).getTime()+60000
    this.startAt = (new Date).getTime()+60000

    this.sign_title = JSON.parse(this.sign_up_section.meta_value).title;
    this.sign_description =  JSON.parse(this.sign_up_section.meta_value).description;
    this.sign_img = JSON.parse(this.sign_up_section.meta_value).hidden_sign_up_img;
    this.sign_show_hide = JSON.parse(this.sign_up_section.meta_value).show_signup_sec;
    this.main_logo = JSON.parse(this.site_logo.meta_value).site_logo;
  },
  mounted(){
      this.getSpecialityAndLocationOption();
  },
  methods: {
     customLabel ({id, title}) {
      return {$title}
    },
    getSpecialityAndLocationOption()
    {
      axios.get('/get-specialities-and-location-options')
      .then(response=>{
        this.specialitiesOpt=response.data[0];
        this.locationOpt=response.data[1];
        console.log('hereyoucan',this.specialitiesOpt,this.locationOpt);


      })
    },
    isLetter(e) {
      let char = String.fromCharCode(e.keyCode);
      if (/^[a-zA-Z ]*$/.test(char)) return true;
      else e.preventDefault();
    },
    isNumber(e) {
      let char = String.fromCharCode(e.keyCode);
      if (/^[0-9]+$/.test(char)) return true;
      else e.preventDefault();
    },
    showPassword() {
         var elementsArray = document.querySelectorAll("#passwordnumber")
        elementsArray.forEach(element => {
        if (element.type === "password") {
            element.type = "text";
            document.getElementById('changeText').innerHTML ="<i class='fa fa-eye' aria-hidden='true'></i>"; 
          } else {
            element.type = "password";
            document.getElementById('changeText').innerHTML ="<i class='fa fa-eye-slash' aria-hidden='true'></i>"; 
          }
      });
  },
  onChanges(event) {
    this.getvalue =  event.target.value
        },
  onSelectSpeciality(value)
  {
     // let id=value;
     // this.specialitiesOpt.forEach
     // this.specialitiesOpt.filter((item) => {
     //       if(item.id == id)
     //       {
     //          this.selected = {id:item.id, title:item.title};
     //       }
     //    });
     this.selectedSpeciality.push(value);
  },
  onSelectLocation(value)
  {
     this.selectLocation=value;
  },

  registerDoctor(value) {
    if (value === 'getdoctor') {
    this.getdoctor = true
    }
    else{
    this.getdoctor = false
    }
    },
    closeFields(){
      this.getdoctor = false
    },
    handleSubmit (e) {
      this.checkFormRemoveError();
      this.submitted = true;
      let role = ''
      const { first_name, last_name, email, phone_number, password, doctor, hospital, patient, laboratory, termNcondition,pmdc_number,ncs_number } = this;
      if(!this.doctor && !this.hospital && !this.patient && !this.laboratory) { role = '' }
      else { role = document.querySelector('input[name="role"]:checked').value }
      if (first_name && last_name && email && password  && role && termNcondition || pmdc_number || ncs_number) {
        this.register( first_name, last_name, email, phone_number, password, role, termNcondition,pmdc_number,ncs_number )
      }
      else { this.checkForm() }
    },

    register( first_name, last_name, email, phone_number, password, role, termNcondition ,pmdc_number,ncs_number) {
      let self = this
      self.loading = true
      if (role === 'doctor') {
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
          if(self.selectedSpeciality.length === 0)
          {
            Vue.toasted.error('Select Speciality' , { duration: 3000 })
            return
          }
          if(self.selectedLocation === '')
          {
            Vue.toasted.error('Select Location' , { duration: 3000 })
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
            selectedSpeciality: this.selectedSpeciality,
            selectLocation : this.selectLocation,
      }
      ).then(function (response) {
        console.log('myconsole',response.data.user.roles);
        if (response.data.type === 'error'){
          self.loading = false
        Vue.toasted.error(error , { duration: 3000 })
          
      }
      else{
         Vue.toasted.success(response.data.message , { duration: 3000 })
              self.loading = false
              window.location = APP_URL + '/'+ response.data.user.roles[0].role_type +'/dashboard'
      }
      }).catch(function (error) {
        self.loading = false
        Vue.toasted.error('Something went wrong. Please try again' , { duration: 3000 })
      })
    },

    checkForm() {
      let role = ''
      if(!this.doctor && !this.hospital && !this.patient && !this.laboratory) {
        role = ''
      }
      else {
        role = document.querySelector('input[name="role"]:checked').value
      }
      if (!this.first_name) { document.querySelector("#first_name_error").classList.remove('d-none') }
      if (!this.last_name) { document.querySelector("#last_name_error").classList.remove('d-none') }
      if (!this.email) { document.querySelector("#email_error").classList.remove('d-none') }
      if (!this.password) { document.querySelector("#password_error").classList.remove('d-none') }
      if (!this.phone_number) { document.querySelector("#phone_number_error").classList.remove('d-none') }
      if (!role) { document.querySelector("#role_error").classList.remove('d-none') }
      if (!this.termNcondition) { document.querySelector("#termNcondition_error").classList.remove('d-none') }
        if (!this.email) { document.querySelector("#email_error").classList.remove('d-none') }
        //   if (this.getvalue === 'pmdc') {
        //     if (!this.pmdc_number) { document.querySelector("#pmdc_number").classList.remove('d-none') }
        //   }
        // if (this.getvalue === 'ncs') {
        //     if (!this.ncs_number) { document.querySelector("#ncs_number").classList.remove('d-none') }
        //   }

    },
    checkFormRemoveError() {
      let self = this
      let role = ''
      if(!this.doctor && !this.hospital && !this.patient && !this.laboratory) {
        role = ''
      }
      else {
        role = document.querySelector('input[name="role"]:checked').value
      }
      if (self.first_name) { document.querySelector("#first_name_error").classList.add('d-none') }
      if (self.last_name) { document.querySelector("#last_name_error").classList.add('d-none') }
      if (self.email) { document.querySelector("#email_error").classList.add('d-none') }
      if (self.password) { document.querySelector("#password_error").classList.add('d-none') }
      if (self.phone_number) { document.querySelector("#phone_number_error").classList.add('d-none') }
      if (role) { document.querySelector("#role_error").classList.add('d-none') }
      if (self.termNcondition) { document.querySelector("#termNcondition_error").classList.add('d-none') }
       //   if (this.getvalue === 'pmdc') {
       //  if (self.pmdc_number) { document.querySelector("#pmdc_number").classList.add('d-none') }
       //  }
       // if (this.getvalue === 'ncs') {
       //  if (self.ncs_number) { document.querySelector("#ncs_number").classList.add('d-none') }
       // }
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
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
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
.w-60{
  width: 60% !important
}
@media (max-width: 1024px){
.ipad_h_width {
    width: 75% !important;
  }
}
@media (max-width: 767px){
.w-sm-100 {
    width: 100%!important;
  }
}
@media (max-width: 576px){
.w-xs-100 {
    width: 100%!important;
  }
}
.specialities-background:focus{
  background-color: #e5e5e5 !important;
}
.bg-image-discover-doctor-consultation{
  width: 100%;
  display: inline-block;
  position: relative;
  height: 100%;
  background-position: bottom;
  background-size: cover;
  background-repeat: no-repeat;
}
.error{
  font-size: 15px !important;
  color:#eb4335;
}
.custom-control-label::after{

  cursor:pointer;
}
 #changeText{
  position: absolute;
  bottom: 0px;
  right: 15px;
}
#changeText i{
  cursor: pointer;
}
.w-48{
  width: 48%;
}
@media (min-width: 576px)
.modal-dialog {
    margin: 7.75rem auto;
}
</style>