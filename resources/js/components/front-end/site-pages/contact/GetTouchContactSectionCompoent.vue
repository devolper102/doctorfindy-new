<template>
  <div>
   <!--    <div class="container">
      <div class="row">
            <div class="col-12 mt-4">
              <bread-crumb-spec></bread-crumb-spec>
            </div>
      </div>
    </div> -->
    <div class="row order-1 order-lg-2"> 
    <div class="col-lg-7 pr-lg-0 col-12 col-md-6">
          <div class="bg-white w-100 d-inline-block px-4">
            <div class="heading-contact-us">
              <h3 class="font-weight-bold mt-4 text_black">Get in touch</h3>
              <p class="text_black">Please send us a note and we’ll get back to you as quickly as possible.</p>
            </div>
            <form @submit.prevent="handleSubmit" method="POST">
            <div class="row mt-4">
              <div class="col-12 col-lg-6 col-md-6">
                  <div class="form-group w-100 float-left mb-3">
                          <label class="text_black text_13 font-weight-bold">Name</label>
                          <input type="text" v-model="name"@keypress="isLetter($event)"class="form-control h_37 text_14" id="firstnameInputText" aria-describedby="emailHelp" placeholder="Enter  Name">
                              <label class="error d-none" v-model="name_error" id="name_error">Enter  Name</label>
                  </div>
              </div>
               <div class="col-12 col-lg-6 col-md-6">
                  <div class="form-group w-100 float-left mb-3">
                          <label class="text_black text_13 font-weight-bold">Phone</label>
                          <input type="text" v-model="phone"@keypress="isNumber($event)"class="form-control h_37 text_14" id="firstnameInputText" aria-describedby="emailHelp" placeholder="03XXXXXXXXX" maxlength="11">
                              <label class="error d-none" v-model="phone_error" id="phone_error">Enter  Phone Number</label>
                  </div>
              </div>
               <div class="col-12 col-lg-6 col-md-6">
                  <div class="form-group w-100 float-left mb-3">
                          <label class="text_black text_13 font-weight-bold">Email</label>
                          <input type="email" v-model="email"class="form-control h_37 text_14" id="firstnameInputText" aria-describedby="emailHelp" placeholder="Enter Email">
                              <label class="error d-none" v-model="email_error" id="email_error">Enter  Email</label>
                  </div>
              </div>
                <div class="col-12 col-lg-6 col-md-6">
                  <div class="form-group w-100 float-left mb-3">
                          <label class="text_black text_13 font-weight-bold">Subject</label>
                          <input type="text" v-model="subject"class="form-control h_37 text_14" id="firstnameInputText" aria-describedby="emailHelp" placeholder="Enter Subject">
                              <label class="error d-none" v-model="subject_error" id="subject_error">Enter  Subject</label>
                  </div>
              </div>
              <div class="col-12">
                <div class="feedback form-group w-100 d-inline-block">
                    <label class="text_14 text_black font-weight-bold">Message
                   </label>
                   <textarea v-model="message"class="form-control text_14"rows="4" id="feedback" 
                    placeholder="Enter Message">
                    </textarea>
                    <label class="error d-none" v-model="message_error" id="message_error">Enter  Message</label>
                    <div class="custom-control custom-checkbox w-100 d-inline-block mt-1">
                      <input type="checkbox" v-model="terms"class="custom-control-input" id="customCheck" value="true" name="terms">
                      <label class="error d-none" v-model="terms_error" id="terms_error">Our Term & Condition are must</label>
                      <label class="custom-control-label text_14 mt-2 text_black" for="customCheck"> By clicking you agree to the 
                        <a class="font-weight-bold d-block text_black" href="/privacy">terms and conditions</a> 
                      </label>
                    </div>
                    <div class="send-message-btn w-100 d-inline-block 
                    mt-2">
                      <button type="submit" class="border-0 send_btn  bg-blue text_14 text-white rounded-pill d-inline-block w-sm-100">Send Message
                      </button>
                      </div> 
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-5 pl-lg-0 col-12 col-md-6">
          <div class="w-100 d-inline-block p-4 address-box">
            <div class="heading-contact-us">
              <h3 class="text-white font-weight-bold mt-4 text-xs-25">Contact Information
              </h3>
            </div>
            <div class="address-bar w-100 d-inline-block">
              <h6 class="text-white mt-3 font-weight-bold">Lahore</h6>
              <p class="text-white">Address: Air Defence Plaza, 644, Shahbaz chowk, Airline Society, Lahore
              </p>
              <span class="text-white d-block">Email: doctorfindy@gmail.com</span>
              <span class="text-white d-block">Phone: 0345-0435621
              </span>
            </div>
            <div class="social-media-icon w-100 
            d-inline-block">
              <a class="social-icon-color bg-white mr-lg-5 mr-3 facebook-icon float-left" 
              href="https://www.facebook.com/">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a class="social-icon-color bg-white mr-lg-5 mr-3 instagram-icon float-left" 
              href="https://www.instagram.com/">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
              <a class="social-icon-color bg-white mr-lg-5 mr-3 youtube-icon float-left" 
              href="https://www.youtube.com/?gl=PK">
                <i class="fa fa-youtube" aria-hidden="true"></i>
              </a>
              <a class="social-icon-color bg-white mr-lg-5 mr-3 linkedin-icon float-left" 
              href="https://www.linkedin.com/">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
  </div>
</div> 
</template>

<script>
import Toasted from 'vue-toasted';

Vue.use(Toasted)
export default {
  name: "GetTouchContactSectionCompoent",
   props:['segments'],
  data: function() {
    return {
         submitted: false,
          name: '',
          email: '',
          phone: '',
          subject: '',
          message: '',
          terms: '',
          name_error: '',
          email_error: '',
          phone_error: '',
          subject_error: '',
          message_error: '',
          terms_error: '',
          resultSegments: this.segments,
    }
  },
  methods:{
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
      const { name, email, phone, subject, message,terms } = this;
      if (name && email && phone && subject && message && terms) {
        this.register( name, email, phone, subject, message,terms  )
      }
      else { this.checkForm() }
    },
   register( name, email, phone, subject, message,terms ) {
      let self = this
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

      axios.post(APP_URL + '/user-message', {
            name : this.name,
       email : this.email,
       phone : this.phone,
       subject : this.subject,
       message : this.message,
       terms : this.terms,
      }
      ).then(function (response) {
        console.log(response,response.data)
        if (response.data.type === 'success'){
           Vue.toasted.success('Message Send Successfully...' , { duration: 3000 })
        }
        else {
           Vue.toasted.error('Message Cannot Send' , { duration: 3000 })
        }
                    self.name = '';
                    self.email = '';
                    self.phone = '';
                    self.subject = '';
                    self.message = '';
                    self.terms = '';
                    
      })
    },
       checkForm() {
      if (!this.name) { document.querySelector("#name_error").classList.remove('d-none') }
      if (!this.email) { document.querySelector("#email_error").classList.remove('d-none') }
      if (!this.phone) { document.querySelector("#phone_error").classList.remove('d-none') }
      if (!this.subject) { document.querySelector("#subject_error").classList.remove('d-none') }
      if (!this.message) { document.querySelector("#message_error").classList.remove('d-none') }
       if (!this.terms) { document.querySelector("#terms_error").classList.remove('d-none') }
    },
    checkFormRemoveError() {
      let self = this
      if (self.name) { document.querySelector("#name_error").classList.add('d-none') }
      if (self.email) { document.querySelector("#email_error").classList.add('d-none') }
      if (self.phone) { document.querySelector("#phone_error").classList.add('d-none') }
      if (self.subject) { document.querySelector("#subject_error").classList.add('d-none') }
      if (self.message) { document.querySelector("#message_error").classList.add('d-none') }
      if (self.terms) { document.querySelector("#terms_error").classList.add('d-none') }
    },

          }

}
</script>

<style>
.send_btn{
  padding: 6px 30px;
}
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
</style>