<template>
  <div>
    <section class="request-knockdock-demo"  id="request-demo">
      <div class="bg-doctor-demo pb-3 pb-lg-5 mt-lg-0 mt-4">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="heading-doctor-demo">
                <h2 class="font-weight-bold text-center mt-5 mb-5 mt-xs-4 mb-xs-4">Request a DoctorFindy demo</h2>
              </div>
            </div>
          </div>
          <form @submit.prevent="handleSubmit" method="POST">
            <ul class="text-center w-70 w-sm-100 m-auto overflow-hidden">
              <li class="form-group w-45 w-sm-100 float-left mr-5 box_shadow mb-5 box_radius">
                <input type="text" v-model="name" @keypress="isLetter($event)"class="form-control h_40 text_14"id="firstnameInputText" aria-describedby="emailHelp" placeholder="Full name">
                 <label class="error d-none" v-model="name_error" id="name_error">Enter Number</label>
              </li>
              <li class="form-group w-45 w-sm-100 float-left box_shadow mb-5 box_radius">
                <input type="text" v-model="registration" class="form-control h_40 text_14" id="lastnameInputText" aria-describedby="emailHelp" placeholder="Registration name">
                   <label class="error d-none" v-model="register_error" id="register_error">Enter Registration</label>
              </li>
              <li class="form-group w-45 w-sm-100 float-left box_shadow mr-5 mb-5 box_radius">
                <input type="text"v-model="phone" @keypress="isNumber($event)" class="form-control h_40 text_14" id="primaryInputText" aria-describedby="emailHelp" placeholder="03XXXXXXXXX" maxlength="11">
                   <label class="error d-none" v-model="phone_error" id="phone_error">Enter Phone Number</label>
              </li>
              <li class="form-group w-45 w-sm-100 float-left box_shadow mb-5 box_radius">
                <input type="email" v-model="email"class="form-control h_40 text_14" id="phoneInputPhone" aria-describedby="emailHelp" placeholder="Enter email">
                   <label class="error d-none" v-model="email_error" id="email_error">Enter Email</label>
              </li>
              <li class="form-group w-45 w-sm-100 float-left box_shadow mb-5 mr-5 box_radius">
                <input type="text" v-model="city"class="form-control h_40 text_14" id="phoneInputPhone" aria-describedby="emailHelp" placeholder="Enter City">
                   <label class="error d-none" v-model="city_error" id="city_error">Enter City</label>
              </li>
              <li class="form-group w-45 w-sm-100 float-left box_shadow box_radius">
                <button class="knockdoc_btn_bg text-white border-0 box_radius2 form-control h_40 text_14">Submit
                </button>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
name: "HospitalDemoSectionComponent",
 data() {
    return {
         submitted: false,
          name: '',
          registration: '',
          city: '',
          phone: '',
          email: '',
          name_error: '',
          register_error: '',
          phone_error: '',
          email_error: '',
          city_error: '',
    }
  },
  created () {


  },
  methods: {
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
        handleSubmit(e) {
      this.checkFormRemoveError();
      this.submitted = true;
      const { name, registration, city, phone, email } = this;
      if (name && registration && city && phone && email ) {
        this.register( name, registration, city, phone, email  )
      }
      else { this.checkForm() }
    },
  register( name, specialty, city, phone, email ) {
      let self = this
      if (self.email === '' || self.email.length < 1 ) {
        Vue.toasted.error('Enter Email' , { duration: 3000 })
        return
      }
      if ((/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(self.email))) {

      }
      else{
        Vue.toasted.error('Incorrect Email ' , { duration: 3000 })
        return
      }
      if (phone === '' || phone.length < 1 ) {
        Vue.toasted.error('Enter your mobile number' , { duration: 3000 })
        return
      }
      else if (!(/^(3)([0-9]{2}[0-9]{7})$/.test(phone)) && !(/^(03)([0-9]{2}[0-9]{7})$/.test(phone)) && !(/^(923)([0-9]{2}[0-9]{7})$/.test(phone))) {
        Vue.toasted.error("Use Correct Format  03XXXXXXXXX" , { duration: 3000 })
        return
      }
      if ((/^(3)([0-9]{2}[0-9]{7})$/.test(phone))) {
        phone = '92'+phone
        self.phone = phone
      }
      if ((/^(03)([0-9]{2}[0-9]{7})$/.test(phone))) {
        phone = '92' + phone.substring(1)
        self.phone = phone
      }
      if ((/^(923)([0-9]{2}[0-9]{7})$/.test(phone))) {
        self.phone = phone
      }

      axios.post(APP_URL + '/demo-request', {
         name : this.name,
        registration : this.registration,
        city : this.city,
        phone : this.phone,
        email : this.email,
        role: 'hospital'
      }
      ).then(function (response) {
        console.log(response,response.data)
        if (response.data.type === 'success'){
          Vue.toasted.success('Demo Request Send Successfully...' , { duration: 3000 })
        }
        else {
           Vue.toasted.error('Demo Request Cannot Send' , { duration: 3000 })
        }
                    self.name = '';
                    self.registration = '';
                    self.city = '';
                    self.phone = '';
                    self.email = '';
                   preventDefault();

      })
    },
        checkForm() {
      if (!this.name) { document.querySelector("#name_error").classList.remove('d-none') }
      if (!this.registration) { document.querySelector("#register_error").classList.remove('d-none') }
      if (!this.phone) { document.querySelector("#phone_error").classList.remove('d-none') }
      if (!this.email) { document.querySelector("#email_error").classList.remove('d-none') }
         if (!this.city) { document.querySelector("#city_error").classList.remove('d-none') }
    },
      checkFormRemoveError() {
      let self = this
      if (self.name) { document.querySelector("#name_error").classList.add('d-none') }
      if (self.registration) { document.querySelector("#register_error").classList.add('d-none') }
      if (self.phone) { document.querySelector("#phone_error").classList.add('d-none') }
      if (self.email) { document.querySelector("#email_error").classList.add('d-none') }
      if (self.city) { document.querySelector("#city_error").classList.add('d-none') }
    },
    },
}
</script>

<style>
</style>