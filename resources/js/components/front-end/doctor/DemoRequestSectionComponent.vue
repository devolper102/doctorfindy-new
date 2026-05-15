<template>
  <div>
    <section class="request-knockdock-demo" id="request-demo">
      <div class="bg-doctor-demo pb-3 pb-lg-5 mt-lg-0 mt-4">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="heading-doctor-demo">
                <h2 class="font-weight-bold text-center mt-lg-5 mb-lg-5 mt-3 mb-3 text-xs-20">Request a DoctorFindy Demo</h2>
              </div>
            </div>
          </div>
          <form @submit.prevent="handleSubmit" method="POST">
            <ul class="w-70 w-sm-100 m-auto overflow-hidden">
              <li class="demo_input form-group w-45 w-sm-100 float-left mr-5 mb-lg-5 mb-4">
                <input type="text" v-model="name" @keypress="isLetter($event)"class="form-control h_40 text_14 specialities-background"id="firstnameInputText" aria-describedby="add_emailHelp" placeholder="Full name">
                <label class="error mt-2 d-none" v-model="name_error" id="name_error">Enter  Name</label>
              </li>
              <li class="demo_input position-relative form-group w-45 w-sm-100 float-left mb-lg-5 
              mb-4">
                <input type="text"v-model="specialty" class="form-control h_40 text_14 specialities-background" id="lastnameInputText" aria-describedby="add_emailHelp" placeholder="Primary specialty">
                <label class="error mt-2 d-none" v-model="specialty_error" id="specialty_error">Enter Specialty</label>
              </li>
              <li class="demo_input position-relative form-group w-45 w-sm-100 float-left mb-lg-5 mb-4 mr-5">
                <select  class="form-control h_40 text_14 specialities-background" @change="onChange($event)">
                   <option value="pmc">PMC</option>
                  <option value="ncs">NCS</option>
                </select>
              </li>
               <li v-if="getvalue === 'pmc'"class="demo_input position-relative form-group w-45 w-sm-100 float-left mb-lg-5 mb-4">
                <input type="text" v-model="pdmc_number"class="form-control h_40 text_14 specialities-background" id="phoneInputPhone" aria-describedby="add_emailHelp" placeholder="Enter PMC">
                <label class="error mt-2 d-none" v-model="pdmc_number" id="pdmc_number">Enter Number</label>
              </li>
               <li v-if="getvalue === 'ncs'" class="demo_input position-relative form-group w-45 w-sm-100 float-left mb-lg-5 mb-4">
                <input type="text" v-model="ncs_number"class="form-control h_40 text_14 specialities-background" id="phoneInputPhone" aria-describedby="add_emailHelp" placeholder="Enter NCS">
                <label class="error mt-2 d-none" v-model="ncs_number" id="ncs_number">Enter Number</label>
              </li> 
              <li class="demo_input position-relative form-group w-45 w-sm-100 float-left mb-lg-5 mb-4 mr-5">
                <input type="text" v-model="city"class="form-control h_40 text_14 specialities-background" id="phoneInputPhone" aria-describedby="add_emailHelp" placeholder="Enter City">
                <label class="error mt-2 d-none" v-model="city_error" id="city_error">Enter City Name</label>
              </li>
              <li class="demo_input position-relative form-group w-45 w-sm-100 float-left mb-lg-5 
              mb-4">
                <input type="text" v-model="phone"class="form-control h_40 text_14 specialities-background" @keypress="isNumber($event)"id="primaryInputText" aria-describedby="add_emailHelp"placeholder="03XXXXXXXXX" maxlength="11">
                <label class="error mt-2 d-none" v-model="phone_error" id="phone_error">Enter Phone Name</label>
              </li>
              <li class="demo_input position-relative form-group w-45 w-sm-100 float-left mr-5  mb-lg-0 mb-4">
                <input type="email" v-model="add_email"class="form-control h_40 text_14 specialities-background"  aria-describedby="add_emailHelp" placeholder="Enter Email">
                <label class="error mt-2 d-none" v-model="add_email_error" id="add_email_error">Enter Email</label>
              </li>
              <li class="form-group w-45 w-sm-100 float-left">
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
name: "DemoRequestSectionComponent",
   data() {
    return {
    getvalue: 'pmc',
          submitted: false,
          name: '',
          specialty: '',
          pdmc_number: '',
          ncs_number: '',
          city: '',
          phone: '',
          add_email: '',
          name_error: '',
          specialty_error: '',
          city_error: '',
          phone_error: '',
          add_email_error: ''
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
    onChange(event) {
    this.getvalue =  event.target.value
        },
        handleSubmit(e) {
      this.checkFormRemoveError();
      this.submitted = true;
      const { name, specialty,pdmc_number,ncs_number, city, phone, add_email } = this;
      if (name && specialty && city && phone && add_email || pdmc_number || ncs_number) {
        this.register( name, specialty,pdmc_number,ncs_number, city, phone, add_email  )
      }
      else { this.checkForm() }
    },
   register( name, specialty,pdmc_number,ncs_number, city, phone, add_email ) {
      let self = this
      if (self.getvalue === 'pmc') {
        if (pdmc_number === '' || pdmc_number.length < 1) {
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
        if (self.add_email === '' || self.add_email.length < 1 ) {
        Vue.toasted.error('Enter Email' , { duration: 3000 })
        return
      }
      if ((/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(self.add_email))) {

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

      axios.post(APP_URL + '/doctor-demo-request', {
        name : this.name,
       specialty : this.specialty,
       select_dagree : this.getvalue,
       pdmc_number : this.pdmc_number,
       ncs_number : this.ncs_number,
       city : this.city,
       phone : this.phone,
       add_email : this.add_email
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
                    self.specialty = '';
                    self.pdmc_number = '';
                    self.ncs_number = '';
                    self.city = '';
                    self.phone = '';
                    self.add_email = '';

      })
    },

     checkForm() {
      if (!this.name) { document.querySelector("#name_error").classList.remove('d-none') }
      if (!this.specialty) { document.querySelector("#specialty_error").classList.remove('d-none') }
      if (!this.city) { document.querySelector("#city_error").classList.remove('d-none') }
      if (!this.phone) { document.querySelector("#phone_error").classList.remove('d-none') }
         if (!this.add_email) { document.querySelector("#add_email_error").classList.remove('d-none') }
          if (this.getvalue === 'pmc') {
            if (!this.pdmc_number) { document.querySelector("#pdmc_number").classList.remove('d-none') }
          }
        if (this.getvalue === 'ncs') {
            if (!this.ncs_number) { document.querySelector("#ncs_number").classList.remove('d-none') }
          }
    },
  checkFormRemoveError() {
      let self = this
      if (self.name) { document.querySelector("#name_error").classList.add('d-none') }
      if (self.specialty) { document.querySelector("#specialty_error").classList.add('d-none') }
      if (self.city) { document.querySelector("#city_error").classList.add('d-none') }
      if (self.phone) { document.querySelector("#phone_error").classList.add('d-none') }
      if (self.add_email) { document.querySelector("#add_email_error").classList.add('d-none') }
      if (this.getvalue === 'pmc') {
        if (self.pdmc_number) { document.querySelector("#pdmc_number").classList.add('d-none') }
        }
       if (this.getvalue === 'ncs') {
        if (self.ncs_number) { document.querySelector("#ncs_number").classList.add('d-none') }
       }
    },

    },
}
</script>

<style>
.error{
  color:#ea4335 !important;
}
</style>