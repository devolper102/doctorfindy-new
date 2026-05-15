<template>
  <div>
    <div class="modal" id="doctor-report-modal" tabindex="-1" role="dialog" aria-labelledby="mobile_number_detail" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content box_radius  box-shadow">
          <div class="modal-header p-0">
            <div class="modal_bg w-100 d-inline-block box_radius box_bottom_lr_radius position-relative">
              <button type="button" class="close m-0" 
              v-on:click="showAddReview(false)" 
              aria-label="Close">
                <span aria-hidden="true" style="display: inline-block;">&times;</span>
              </button>
              <div class="container">
                <div class="heading-doctor-report p-3">
                  <p class="text_black
									font-weight-bold text_18 text-xs-13">Report Doctor or Hospital</p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body p-3 modal_bg">
            <form>
              <div class="form-group w-100 float-left d-inline-block">
                <label class="text_black text_15 font-weight-bold">Name</label>
                <input v-model="name" type="text" class="form-control h_37 text_14 specialities-background" id="nameInputText" aria-describedby="emailHelp" placeholder="Name">
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left">
                <label class="text_black text_15 font-weight-bold">Email</label>
                <input v-model="email" type="email" class="form-control specialities-background h_37" placeholder="Email" id="emailaddress">
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left">
                <label class="text_black text_15 font-weight-bold">Phone Number</label>
                <input v-model="phone_number" type="text" class="form-control specialities-background h_37" placeholder="300-0000000" id="phone">
              </div>
              <!--<div class="form-group w-100 d-inline-block">
                <div class="doctor-report-category mt-4 position-relative">
                  <select class="form-control bg-white box_shadow input-border h_45 text_14"
                          id="Doctor-Report-Select">
                    <option>Allergy Immunology</option>
                    <option>Anesthesiology</option>
                    <option>Family Medicine</option>
                    <option>Anesthesiology</option>
                    <option>Emergency Medicine</option>
                    &lt;!&ndash; <a class="position-absolute" href="#"><i class="fa fa-angle-down" aria-hidden="true"></i></a> &ndash;&gt;
                  </select>
                  <a class="position-absolute text_black text_20" href="#"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                </div>
              </div>-->
              <div class="form-group patient-reviews-feedback">
                <label class="text_20 text_black">Description
                </label>
                <textarea v-model="description" name="decription" class="form-control text_14" rows="6" id="feedback"></textarea>
              </div>
              <div class="modal-footer border-0 p-0 w-100 d-inline-block">
                <div class="modal_footer_btn w-100
					               d-inline-flex m-0 float-left mt-1 ml-0 mr-0 mb-0">
                  <div class="cancle-btn doctor-report-btn w-48 float-left">
                    <a @click="closeModal" class="light_btn_bg rounded-pill w-100 p-2 text-center font-weight-bold d-inline-block">Cancel</a>
                  </div>
                  <div class="submit-btn w-48 float-right ml-4">
                    <a href="javascript:void(0)" @click="submitReport" class="bg-green rounded-pill w-100 text-white p-2 text-center font-weight-bold d-inline-block">Submit</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Toasted from 'vue-toasted'

Vue.use(Toasted)
export default {
  name: "ReportModalComponent",
  props: ['user', 'patient'],
  data() {
    return {
      email: '',
      name: '',
      description: '',
      phone_number: '',
      doctor_id: this.user.id,
    }
  },
  mounted() {},
  created () {},
  methods: {
    closeModal() {
      document.querySelector('#doctor-report-modal').classList.remove('show')
      document.querySelector('body').classList.remove('scroll')
      /*document.querySelector('#doctor-report-modal').style.display = "none"*/
    },
    submitReport() {
      let self = this;
      self.loading = true
      if (self.phone_number === '' || self.phone_number.length < 1 ) {
        self.loading = false
        Vue.toasted.error('Enter your mobile number' , { duration: 3000 })
        return
      }
      else if (self.phone_number.length > 10 && self.phone_number.length > 13 && !(/^(3)([0-9]{2}[0-9]{7})$/.test(self.phone_number)) && !(/^(03)([0-9]{2}[0-9]{7})$/.test(self.phone_number)) && !(/^(923)([0-9]{2}[0-9]{7})$/.test(self.phone_number))) {
        self.loading = false
        Vue.toasted.error("Use Correct Format  923XXXXXXXXX" , { duration: 3000 })
        return
      }
      if ((/^(3)([0-9]{2}[0-9]{7})$/.test(self.phone_number))) {
        self.phone_number = '92'+self.phone_number
      }
      if ((/^(03)([0-9]{2}[0-9]{7})$/.test(self.phone_number))) {
        self.phone_number = '92' + self.phone_number.substring(1)
      }

      if (this.description && this.email) {
        axios.post(APP_URL + '/submit-report', {
          email: self.email,
          name: self.name,
          description: self.description,
          phone_number: self.phone_number,
          doctor_id: self.doctor_id,
        })
            .then(function (response) {
              if (response.data.type === 'success') {
                self.loading = false
                Vue.toasted.success(response.data.message , { duration: 3000 })
                document.querySelector('#doctor-report-modal').classList.remove('show')
                document.querySelector('#doctor-report-modal').style.display = "none"
              } else if (response.data.type === 'error') {
                self.loading = false
                Vue.toasted.error(response.data.message , { duration: 3000 })
                document.querySelector('#doctor-report-modal').classList.remove('show')
                document.querySelector('#doctor-report-modal').style.display = "none"
              }
            })
            .catch(error => {
              self.loading = false
              if (error.response.status === 422) {
                if (error.response.data.errors.name) {
                  Vue.toasted.error(error.response.data.errors.name[0] , { duration: 3000 })
                }
                if (error.response.data.errors.email) {
                  Vue.toasted.error(error.response.data.errors.email[0] , { duration: 3000 })
                }
                if (error.response.data.errors.description) {
                  Vue.toasted.error(error.response.data.errors.description[0] , { duration: 3000 })
                }
              }
            })
      }
      else {
        Vue.toasted.show('All fields are mandatory' , { duration: 3000 })
      }
    },
    showAddReview(e) {
      this.loading = true
      document.querySelector('#doctor-report-modal').classList.remove('feedback_modle')
      document.querySelector('body').classList.remove('scroll')
      document.querySelector('#doctor-report-modal').style.display = 'none'
      this.loading = false
    },
  }
}
</script>

<style>

.doctor-report-category select {
  -webkit-appearance: none;
}

.doctor-report-category a{
  top: 7px;
  right:20px;
}
#doctor-report-modal{
  background: rgba(0,0,0,0.7);
}

</style>