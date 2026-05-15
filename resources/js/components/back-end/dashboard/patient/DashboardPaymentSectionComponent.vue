<template>
  <div>
    <!-- Topbar -->
    <header-section
      :managements="managements"
    ></header-section>
    <!-- End of Topbar -->
    <!-- Sidebar -->
    <sidebar-patient-section></sidebar-patient-section>
    <!-- End of Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Begin Page Content -->
          <div class="container-fluid" v-if="last_appointment.payment === null">
            <div class="row mt-5">
              <div class="col-12 col-lg-7">
                <form class="d-inline-block w-100" @submit.prevent="handleSubmit" method="POST">
                  <div class="bg-white box_shadow box_radius p-3 w-100 d-inline-block">
                  <div class="heading-personal-information mb-2">
                    <p class="text_black font-weight-bold">Personal Information
                    </p>
                  </div>
                  <div class="col-12 p-0">
                    <div class="row">
                      <div class="col-12 col-lg-4">
                        <div class="form-group  mb-lg-0 input-amount">
                        <label class="text_black mb-2 mt-2">First name</label>
                        <input type="text"v-model="last_appointment.patient_profile.first_name"  class="form-control" id="firstnameInputText" aria-describedby="emailHelp" placeholder="">
                        </div>
                      </div>
                      <div class="col-12 col-lg-4">
                        <div class="form-group  mb-lg-0 input-amount">
                        <label class="text_black mb-2 mt-2">Last name</label>
                        <input type="text" v-model="last_appointment.patient_profile.last_name"  class="form-control" id="lastnameInputText" aria-describedby="emailHelp" placeholder="">
                        </div>
                      </div>
                      <div class="col-12 col-lg-4 p-lg-0">
                        <div class="redio_btns">
                           <p class="text_black font-weight-bold">Who is visiting to doctor?</p>
                        <div class="radio-button-group d-inline-block mt-5 mb-2">
                          <div @click="checkPatien('myself')" class="custom-control custom-radio float-left mr-2">
                            <input type="radio" class="custom-control-input" id="customRadio5" name="example" value="customEx"checked="checked">
                            <label class="custom-control-label text-radio-btn" for="customRadio5">My self
                            </label>
                          </div>
                          <div @click="checkPatien('someone')" class="custom-control custom-radio float-left mr-2">
                            <input type="radio" class="custom-control-input" id="customRadio6" name="example" value="customEx">
                            <label class="custom-control-label text-radio-btn" for="customRadio6">Someone else
                            </label>
                          </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-if="someone">
                  <div class="row">
                    <div class="col-12 col-lg-8">
                      <div class="form-group float-left mb-0 input-amount w-100">
                        <label class="text_black mb-2 mt-2">Patient name</label>
                        <input type="text" v-model="user.patient_name" class="form-control" id="patientname" aria-describedby="patientname" placeholder="">
                      </div>
                    </div>
                    <div class="col-12 col-lg-4">
                      <div class="form-group mb-lg-0 input-amount">
                        <label class="text_black mb-2 mt-2">Relation with you
                        </label>
                        <input type="text" v-model="user.relation_you" class="form-control" id="relationship" aria-describedby="relationship" placeholder="">
                      </div>
                    </div>
                  </div></div>
                  <div class="form-group patient-feedback w-100 d-inline-block mb-lg-0 input-amount">
                    <label class="text_14 text_black mb-2 mt-2">Note: 
                      <span>(optional)</span>
                    </label>
                    <textarea class="form-control text_14"v-model="user.commants"  rows="4" id="feedback"></textarea>
                  </div>
                </div>
                 <div>
                <div class="payment-section mt-4">
                  <h4 class="text_black mb-0">Payment</h4>
                  <span class="text_black text_20">Choose payment method below
                  </span>
                </div>
                <div class="row mt-2">
              <!--     <div class="col-12 col-lg-4">
                    <div class="bg-white box_shadow box_radius w-100 h-100 d-inline-block p-2">
                      <div class="payment_box text-center">
                        <img class="img-fluid" src="/images/credit-card-image.png" alt="credit-card-image picture">
                        <p class="text_black text_12 m-2">PAY WITH CREDIT CARD</p>
                      </div>
                    </div>
                  </div> -->
             <!--      <div class="col-12 col-lg-4 mt-3 mb-3 mt-lg-0 mb-lg-0">
                    <div class="bg-white box_shadow box_radius w-100 h-100 d-inline-block p-2">
                      <div class="payment_box text-center">
                        <img class="img-fluid" src="/images/jazz-cash-image.png" alt="jazz-cash-image picture">
                        <p class="text_black text_12 m-2">PAY WITH JAZZ CASH</p>
                      </div>
                    </div>
                  </div> -->
                  <div class="col-12 col-lg-4">
                    <input type="radio" name="gender"@click="user.payment_method = 'visit'" value="visit" id="payOnVisit"> <label  for="payOnVisit">Pay On Visit</label> <br>
  <input type="radio" name="gender" @click="user.payment_method = 'jazz'"value="jazz" id="payOnjazz"> <label for="payOnjazz">Pay On  Jazz</label> <br>
  <input type="radio" name="gender"@click="user.payment_method = 'other'" value="other" id="other"> <label for="other">Other</label> 
                 <!--    <div class="bg-white box_shadow box_radius w-100 h-100 d-inline-block p-2 position-relative">
                      <div class="payment_box text-center mt-mb-1">
                        <input type="radio" @click="user.payment_method = 'visit'" name="visited" id="payOnVisit"  />
                        <label class="payVisitImg" for="payOnVisit"></label>
                        <img class="img-fluid" src="/images/pay-visit-image.png" alt="pay-visit-image picture">
                        <p class="text_black text_12 payment_title">PAY ON VISIT</p>
                      </div>
                    </div> -->
                  </div>
            <!--       <div class="col-12 col-lg-4">
                    <div class="bg-white box_shadow box_radius w-100 h-100 d-inline-block p-2 position-relative">
                      <div class="payment_box text-center mt-mb-1">
                        <input type="radio" @click="user.payment_method = 'jazz'" name="visited" id="payOnVisit"  />
                        <label class="payVisitImg" for="payOnVisit"></label>
                        <img class="img-fluid" src="/images/pay-visit-image.png" alt="pay-visit-image picture">
                        <p class="text_black text_12 payment_title">PAY ON JAXX CASH</p>
                      </div>
                    </div>
                  </div> -->
                </div>
                <!-- <div class="bg-white box_radius box_shadow w-100 d-inline-block p-3 mt-4 mb-4">
                  <div class="jazz-cash-account">
                    <h5 class="text_black">Jazz cash account</h5>
                  </div>
                    <div class="row">
                      <div class="col-12 col-lg-7">
                        <div class="form-group w-100 float-left input-amount">
                          <label class="text_black mb-2 mt-2">Account number
                          </label>
                          <input type="number" class="form-control" id="cashInputNumber" aria-describedby="emailHelp" placeholder="0300***********">
                        </div>
                      </div>
                      <div class="col-12 col-lg-5">
                        <div class="jazz-cash-price float-left text-center mt-4">
                          <span>Rs:600</span>
                        </div>
                        
                      </div>
                    </div>
                </div> -->
                <div class="form-group pay-btn w-100 float-left mt-4 ml-2 ml-lg-4">
                  <button type="submit"class="knockdoc_btn_bg text-white border-0 form-control rounded-pill w-50 m-auto">Pay</button>
                </div>
              </div>
              </form>
              </div>
              <div class="col-12 col-lg-5">
                <div class=" box_radius  box_shadow">
                   <div>
              <div class="header_bg w-100 d-inline-block box_radius box_bottom_lr_radius position-relative p-2">
                        <div class=" doctor_image position-relative float-left mr-3">
                          <div class="book-dr-image mt-3 mt-lg-0 mb-3 mb-lg-0 float-left">
                            <img :src="'/uploads/users/'+last_appointment.user_id+'/'+last_appointment.user.profile.avatar" :alt="last_appointment.user.first_name" class="img-fluid rounded-circle h_50 w-50px modal_img">
                          </div>
                        </div>
                     <div class="prfile_detail mb-2">
                          <h5 class="d-inline-block font-weight-bold">
                          {{last_appointment.user.first_name}} {{last_appointment.user.last_name}}</h5>
                           <span class="ml-2">
                          <img src="/images/check.png"  v-tooltip="verified_message"  alt="Check" class="img-fluid">
                        </span>
                    <span>
                          <img src="/images/shield.png" alt="Shield" v-tooltip="medical_message" class="img-fluid">
                    </span>
                         
                  <p><span v-for="(edu, index) in education"> {{ edu.degree_title }}{{ index === 1 ? '' : ',' }} </span> </p>
                  <p class="text_14 text_md_13 d-xs-none d-sm-none d-md-none d-lg-block">
                    {{ last_appointment.user.profile.sub_heading }}</p>
                       
                        </div>
              </div>
           <div class="modal-body">
                  <div class="border-bottom-dark w-100 d-inline-block pb-2">
                    <div class="verification-text-phone-number pb-3">
                      <div class="patient_summary mb-2 overflow-hidden">
                        <span class="text_black font-weight-bold w-50 float-left"> <img src="/images/time-image.png" class="img-fluid mr-2"> Time
                        </span>
                        <span class="float-right text-right text-lg-left w-50">{{last_appointment.appointment_time}}
                        </span>
                      </div>
                      <div class="patient_summary mb-2 overflow-hidden">
                        <span class="text_black font-weight-bold w-50 float-left"> <img src="/images/date-image.png" class="img-fluid mr-2"> Date
                        </span>
                        <span class="float-right text-right text-lg-left w-50">{{last_appointment.appointment_date | formatDate}}</span>
                      </div>
                      <div class="patient_summary mb-2 overflow-hidden">
                        <span class="text_black font-weight-bold w-50 float-left"> <img src="/images/address-image.png" class="img-fluid mr-2"> Address</span>
                        <span class="float-right w-50 text-right text-lg-left" v-if="last_appointment.hospital_id !== 0">{{last_appointment.hospital_profile.first_name}} {{last_appointment.hospital_profile.last_name }},{{last_appointment.hospital_profile.profile.address}}
                        </span>
                        <span class="float-right w-50 text-right text-lg-left" v-else>Online
                        </span>
                      </div>
                      <div class="patient_summary mb-2 overflow-hidden">
                        <span class="text_black font-weight-bold w-50 float-left"> <img src="/images/fee-image.png" class="img-fluid mr-2"> Consulting Fee</span>
                        <span class="float-right w-50 text-right text-lg-left">{{last_appointment.charges}}</span>
                      </div>
                      <!-- <div class="patient_summary mb-2 overflow-hidden">
                        <span class="text_black font-weight-bold w-50 float-left"> <img src="/images/fee-image.png" class="img-fluid mr-2"> Booking Fee</span>
                        <span class="float-right w-50 text-right text-lg-left">Rs.100</span>
                      </div> -->
                    <!--   <div class="patient_summary">
                        <span class="text_black font-weight-bold w-50 float-left"> <img src="/images/fee-image.png" class="img-fluid mr-2"> Video Call Fee</span>
                        <span class="float-right w-50 text-right text-lg-left">Rs.100</span>
                      </div> -->
                    </div>
                  </div>
                
                <div class="modal-footer pb-0">
                  <div class="verification-text-phone-number w-90 m-auto 
                  text_13">
                    <div class="patient_summary">
                      <span class="text_black font-weight-bold w-50 float-left pl-2 pl-lg-4"> Total</span>
                      <span class="float-right w-50 text-right text-lg-left">Rs.{{last_appointment.charges}}</span>
                      </div>
                  </div>    
                </div>
              </div>
              </div>
                </div>
              </div>
            </div>
          </div>
          <div v-else>
            <div class="container">
              <h1>Please Appointment An other...</h1>
            </div>
          </div>
      <!-- Footer -->
    <footer class="sticky-footer bg-white box_shadow p-2 d-inline-block mt-4 p-2 border-top w-100">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
  </div>
 </div> 
</template>

<script>

import VTooltip from 'v-tooltip';
import Toasted from 'vue-toasted';

Vue.use(Toasted)
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MMM DD,YYYY')
  }
});
export default {
   components: {VTooltip},
  name: "DashboardPaymentSectionComponent",
    props: ['patient','doctors','hospitals','managements'],
   data() {
    return {
      mode: "date",
      selectedDate: new Date(),
      appointment_patient: '',
      date: new Date(),
      visibility: true,
      last_appointment: '',
      verified_message: 'Verified User',
      medical_message: 'Medical Registration Verified',
       user:{
          first_name: '',
          last_name: '',
          patient_name: '',
          relation_you: '',
          commants: '',
          payment_method: '',
    },
    user_id: '',
    hospital_id: '',
    patient_id: '',
    someone: false,
    }
  },
  created () {

    this.last_appointment = this.patient.appointments_patient.pop()
    this.education = JSON.parse(this.last_appointment.user.profile.educations)
  console.log('last',this.last_appointment)
     // console.log('last_appointment',last_appointment,this.patient.appointments_patient)

  },
   methods: {
    checkPatien(value) {
      console.log(value)
      if (value === 'someone') {
        this.someone = true
      }
        else{
          this.someone = false
        }
    },
        handleSubmit(e) {
                let self = this;
                  this.errors = [];
      axios.post(APP_URL + '/patient-payment', {
      first_name : this.last_appointment.patient_profile.first_name,
      last_name : this.last_appointment.patient_profile.last_name,
       patient_name : this.user.patient_name,
       relation_you : this.user.relation_you,
       commants : this.user.commants,
       payment_method : this.user.payment_method,
       user_id : this.last_appointment.user_id,
       patient_id : this.last_appointment.patient_id,
       hospital_id : this.last_appointment.hospital_id,
       appointment_time : this.last_appointment.appointment_time,
       appointment_date : this.last_appointment.appointment_date,
       charges : this.last_appointment.charges,
       appointment_id:this.last_appointment.id
            })
             .then(function (response) {
              console.log(response.data.type);
              if (response.data.type === 'success') {
              Vue.toasted.success('Payment Method Success Please Wait For Verification ' , { duration: 3000 })
              window.location = "/patient/dashboard";
            }
              else {
                Vue.toasted.error('Payment Method Not Success' , { duration: 3000 })
              }
                    self.user.first_name = '';
                    self.user.last_name = '';
                    self.user.patient_name = '';
                    self.user.relation_you = '';
                    self.user.commants = '';
                   e.preventDefault();

                }).catch(function (error) {
                  Vue.toasted.error('All The Fields are Required' , { duration: 3000 })
                });
            },

   
  }


}
</script>

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
<style>
.tooltip {
  display: block !important;
  z-index: 10000;
}

.tooltip .tooltip-inner {
  background: #00A2E8;
  color: white;
  border-radius: 4px;
  padding: 5px 10px 4px;
}

.tooltip .tooltip-arrow {
  width: 0;
  height: 0;
  border-style: solid;
  position: absolute;
  margin: 5px;
  border-color: #00A2E8;
  z-index: 1;
}

.tooltip[x-placement^="top"] {
  margin-bottom: 5px;
}

.tooltip[x-placement^="top"] .tooltip-arrow {
  border-width: 5px 5px 0 5px;
  border-left-color: transparent !important;
  border-right-color: transparent !important;
  border-bottom-color: transparent !important;
  bottom: -5px;
  left: calc(50% - 5px);
  margin-top: 0;
  margin-bottom: 0;
}

.tooltip[x-placement^="bottom"] {
  margin-top: 5px;
}

.tooltip[x-placement^="bottom"] .tooltip-arrow {
  border-width: 0 5px 5px 5px;
  border-left-color: transparent !important;
  border-right-color: transparent !important;
  border-top-color: transparent !important;
  top: -5px;
  left: calc(50% - 5px);
  margin-top: 0;
  margin-bottom: 0;
}

.tooltip[x-placement^="right"] {
  margin-left: 5px;
}

.tooltip[x-placement^="right"] .tooltip-arrow {
  border-width: 5px 5px 5px 0;
  border-left-color: transparent !important;
  border-top-color: transparent !important;
  border-bottom-color: transparent !important;
  left: -5px;
  top: calc(50% - 5px);
  margin-left: 0;
  margin-right: 0;
}

.tooltip[x-placement^="left"] {
  margin-right: 5px;
}

.tooltip[x-placement^="left"] .tooltip-arrow {
  border-width: 5px 0 5px 5px;
  border-top-color: transparent !important;
  border-right-color: transparent !important;
  border-bottom-color: transparent !important;
  right: -5px;
  top: calc(50% - 5px);
  margin-left: 0;
  margin-right: 0;
}

.tooltip.popover .popover-inner {
  background: #f9f9f9;
  color: black;
  padding: 24px;
  border-radius: 5px;
}

.tooltip.popover .popover-arrow {
  border-color: #f9f9f9;
}

.tooltip[aria-hidden='true'] {
  visibility: hidden;
  opacity: 0;
  transition: opacity .15s, visibility .15s;
}

.tooltip[aria-hidden='false'] {
  visibility: visible;
  opacity: 1;
  transition: opacity .15s;
}

</style>

