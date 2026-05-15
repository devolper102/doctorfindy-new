<template>
  <div>
    <div v-if="loading" id="loader"></div>
      <!-- <div class="container">
      <div class="row">
            <div class="col-12 mt-4">
              <bread-crumb-spec></bread-crumb-spec>
            </div>
      </div>
    </div> -->
    <section class="doctor-hospital-medical-center">
      <div class="bg-medical-doctor-hospital">
        <div class="container">
          <div class="col-md-12 bg-summery-box box_radius mt-4 mb-4 pb-xl-0 pb-3">
            <!-- Start Doctor Profile -->
            <div class="row">
              <div class="col-md-8">
                <div class="doctor_profile_left pt-3 pb-3">
                  <div class="pr-xs-0 pr-sm-0 pr-md-0 pr-lg-2">
                    <div class="doctor_image position-relative float-left mr-xl-2 mr-1 pb-2 w-xs-20">
                      <img v-if="user.profile.avatar" v-lazy="basePath+'/uploads/users/'+user.id+'/medium-'+user.profile.avatar" :alt="user.first_name + ' ' + user.last_name" :name="user.first_name + ' ' + user.last_name" class="img-fluid rounded-circle h_80 w_80px w_md_80px h_md_80 w-xs-60px h_md_60 h-52 h-48">
                      <img v-else v-lazy="basePath+'/uploads/users/default/lab.svg'" :alt="user.first_name + ' ' + user.last_name" :name="user.first_name + ' ' + user.last_name" class="img-fluid rounded-circle h_80 w_80px w_md_80px h_md_80 w-xs-60px h_md_60 h-52 h-48">
                      <div class="total_rating text-center mt-2">
                        <span class="text-xs-11">
                          <span class="text-blue font-weight-bold text-xs-12">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            {{ user.feedbacks | averageRating }}
                          </span>
                          ({{user.feedbacks.length}})</span>
                      </div>
                      <!-- <div class="float-left text-center w-100 mt-2">
                        <p v-if="user.feedbacks.length > 0" class="badge knockdoc_sign_up_bg text-white text_14 d-xs-none d-sm-none d-md-none d-lg-inline-block">
                          <i class="fa fa-thumbs-up"></i> {{ Math.round(user.profile.votes) }}
                        </p>
                        <p v-else class="badge knockdoc_sign_up_bg text-white text_14 d-xs-none d-sm-none d-md-none d-lg-inline-block">
                          <i class="fa fa-thumbs-up"></i> 0
                        </p>
                      </div> -->
                    </div>
                    <div class="prfile_detail float-xs-left float-sm-left float-md-left float-lg-none w-md-65 overflow-hidden w-xs-78 
                    lab-icon-images">
                      <div class="doctor_name float-none float-lg-left float-md-left">
                        <div class="w-100 d-inline-block">
                          <h2 class="d-inline-block text_13 float-left mt-1 text-xs-11">
                            <span>
                              {{ user.first_name }} {{ user.last_name }}
                            </span>
                            <label class="ml-lg-1 ml-md-1 text_16 text-xs-11 font-weight-bold" v-if="user.user_discount_percentage && user.user_discount_percentage != ' '" 
                        style="margin-top2px;"> (<span >{{user.user_discount_percentage}}% 
                        </span> Discount)</label>
                        <!-- <span class="ml-xl-2 ml-1 profile-icon-image mt-1">
                          <img src="/images/check.png" alt="Check" class="img-fluid">
                        </span>
                        <span class="profile-icon-image mt-1 ml-xl-2 ml-1">
                          <img src="/images/shield.png" alt="Shield" class="img-fluid">
                        </span>
                        <span class="ml-xl-4 ml-1 ">
                          <a href="javascript:void(0)">
                            <i class="fa fa-heart text-xs-14 text_20" style="color: rgb(188, 188, 188);" aria-hidden="true">
                            </i>
                          </a>
                        </span> -->
                          </h2>
                        </div>
                      </div>
                      <!-- <div class="float-right">
                        <p v-if="user.feedbacks.length > 0" class="badge knockdoc_sign_up_bg text-white text_md_13 d-xs-none d-sm-none d-md-none d-lg-inline-block">
                          <i class="fa fa-thumbs-up"></i> {{ user.profile.votes / user.feedbacks.length * 100 }}%
                        </p>
                        <p v-else class="badge knockdoc_sign_up_bg text-white text_md_13 d-xs-none d-sm-none d-md-none d-lg-inline-block">
                          <i class="fa fa-thumbs-up"></i> 0%
                        </p>
                      </div> -->
                      <div class="doctor_degree text_black d-lg-inline-block text_md_13 w_md_100 w-100 mb-lg-0 mb-2">
                        <!-- <p class="text_black">
                          {{ user.profile.address }} {{ user.location.title }}</p> -->
                        <span class="text-black text_13 text-xs-12 w-100 d-inline-block">
                            {{ user.profile.meta_intro }}
                          <a class="d-inline-block" id="show-more" 
                          @click="scrolltodiv()" href="javascript:void(0)">
                            <span class="text-blue font-weight-bold text_14">Read More
                            </span>
                            <i class="fa fa-angle-double-right text_14" aria-hidden="true"></i>
                          </a>
                        </span>
                        <!-- <div class="w-33 border-right 
                        d-lg-inline-block d-none w-xs-50">
                          <span class="mr-1 d-inline-block">
                              <img src="/images/patient-icon.svg" 
                              class="img-fluid experience-image">
                            </span>
                            <span class="text_13 mt-1 text-xs-9">
                            <span class="text-blue font-weight-bold text-xs-10">Satisfied patient</span> 
                            {{user.feedbacks | satisfiedPatient}}
                          </span>
                        </div> -->
                          <div v-if="user.profile.total_experience" class="w-25 d-lg-inline-block d-none w-xs-45">
                            <span class="mr-1 d-inline-block">
                              <img :src="basePath+'/images/experience.svg'" 
                              class="img-fluid experience-image">
                            </span>
                            <span class="text_13 mt-1 text-xs-9">
                            <span class="text-blue font-weight-bold text-xs-10">{{ user.profile.total_experience }} Years </span> Experience
                          </span>
                          </div>
                       <!--  <p class="d-block text-black text_12 font-weight-bold">{{ user.teams.length }} Doctors available</p> -->
                       
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="doctor_profile_right pt-xl-3 pb-xl-3 pb-2">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="doctor_profile_right pt-lg-3 pb-lg-3 pl-lg-0 pl-xs-0 pl-sm-0 pl-md-0 w-sm-100 w-55 float-right">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="list_btns d-xs-inline-block w-xs-100 w-sm-100 w-md-100 position-relative">
                              <div class="w-100 mb-3 float-left d-lg-none 
                              d-block">
                                <!-- <div class="w-33 float-left w-xs-50">
                          <span class="w-100 
                          d-inline-block">
                              <img src="/images/patient-icon.svg" 
                              class="img-fluid experience-image">
                            </span>
                            <span class="text_13 mt-1 text-xs-9">
                            <span class="text-blue font-weight-bold text-xs-10 d-block">Satisfied patient</span>
                            {{user.feedbacks | satisfiedPatient}}
                          </span>
                        </div> -->
                          <div v-if="user.profile.total_experience" class="w-25 float-left w-xs-100">
                            <span>
                              <img :src="basePath+'/images/experience.svg'" 
                              class="img-fluid experience-image">
                            </span>
                            <span class="text_13 mt-1 text-xs-9">
                            <span class="text-blue font-weight-bold text-xs-10">{{ user.profile.total_experience }} Years </span> Experience
                          </span>
                          </div>
                              </div>
                              <!-- <a href="#reviews_section" @click="showAddReview"  class="d-block rounded-pill text-center knockdoc_doctor_profile_btn text_14 text_md_12 float-xs-left float-sm-left float-md-left float-md-none small_btn w-sm-45 mb-2"> Add Review</a>
                              <a href="#testSection" class="d-block rounded-pill text-center knockdoc_doctor_profile_btn mt-1 mb-2 text_14 text_md_12 float-right float-lg-none float-md-none small_btn w-100 d-md-inline-block w-sm-45 mb-lg-1 share-network-facebook">
                            Book A Test
                          </a> -->
                          
                        <!--       <a v-if="user.user_discount_percentage && user.user_discount_percentage != ' '" href="javascript:void(0)" @click="showDiscountModal" class="d-block book-rounded text-center bg-green book-padding text-white mt-xl-3 mb-2 mb-lg-1 text_14 text_md_12 float-right float-md-none small_btn w-xs-45 position-relative">Get Discount Code
                                <a class="bg-blue d-inline-block discount-icon position-absolute" 
                                href="javascript:void(0)">
                                  <span class="d-inline-block">
                                  <img src="/images/discount-icon.svg">
                                </span>
                                </a>
                              </a> -->
                                    <a v-if="user.first_name=='Chughtai' && user.last_name=='Lab'" href="javascript:void(0)" @click="showDiscountModal" class="d-xl-block book-rounded text-center bg-green book-padding text-white mt-xl-3 mb-2 mb-lg-1 text_14 text_md_12 float-xl-right float-md-none w-xs-45 position-relative w-100 d-inline-block get-discount-btn">Get Discount Code
                                <a class="bg-blue d-inline-block discount-icon position-absolute" 
                                href="javascript:void(0)">
                                  <span class="d-inline-block">
                                  <img :src="basePath+'/images/discount-icon.svg'">
                                </span>
                                </a>
                              </a>
                             <!-- {{user.profile.online_report_url}} -->
                              <a v-if="user.profile.online_report_url":href="getOnlineTestReportsUrl" class=" d-xl-block book-rounded text-center bg-blue book-padding text-white mt-xl-2 mb-2 mb-lg-1 text_14 text_md_12 float-xl-right float-md-none w-xs-45 position-relative w-100 ml-xl-0 ml-3 d-inline-block">Get Online Report
                              </a>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Doctor Profile -->
          </div>
        </div>
      </div>
    </section>

    <report
        :user="user"
        :patient="patient"
    ></report>
    <div class="modal" id="discount_modal" tabindex="-1" role="dialog" aria-labelledby="mobile_number_detail" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content box_radius  box_shadow">
          <div class="modal-header p-0 bg-blue">
            <div class="modal_bg w-100 d-inline-block box_radius box_bottom_lr_radius position-relative bg-blue">
              <button type="button" class="close text-white" v-on:click="hideDiscountModal(false)" aria-label="Close" style="opacity: 1 !important;">
                <span aria-hidden="true" style="padding:4px 10px 0 0;display: inline-block;">&times;</span>
              </button>
              <div class="container">
                <div class="heading-doctor-report p-2">
                  <p class="text-white text_14 text-xs-13">Get Discount
                </p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body pt-2 pb-2 pl-3 pr-3">
            <form>
              <div class="form-group w-100 float-left 
              d-inline-block mb-2">
                <label class="text_black text_13 font-weight-bold">Name</label>
                <input v-model="name" type="text" class="form-control h_37 text_14 specialities-background" id="nameInputText" aria-describedby="emailHelp" placeholder="Name">
              </div>
              <!-- <div class="form-group mb-2 w-100 d-inline-block float-left">
                <label class="text_black text_15 font-weight-bold">Email</label>
                <input type="password" class="form-control specialities-background h_37" placeholder="Password" id="discount_password">
              </div> -->
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2">
                <label class="text_black text_13 font-weight-bold">Phone Number</label>
                <input v-model="phone_number"  type="number" class="form-control specialities-background h_37" placeholder="92345-0435621" id="phone"  @input="formatPhoneNumber" onKeyPress="if(this.value.length==12) return false;">
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2">
                <input v-model="home_sampling" type="checkbox" id="home_sampling" true-value="yes" v-on:click="forHomeSampling()">
                <label class="form-check-label" for="home_sampling">For Home Sampling (گھر سے ٹیسٹ کیلئے)</label>
              </div>
              <div id="home-sampling-field">
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2">
                <label class="text_black text_13 font-weight-bold">Address</label>
                <input v-model="address" type="text" class="form-control specialities-background h_37" placeholder="address" id="phone">
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2">
                <label class="text_black text_13 font-weight-bold">Age</label>
                <input v-model="age" type="number" class="form-control specialities-background h_37" placeholder="Age" id="age">
              </div>
              </div>
              <div class="modal_footer_btn w-85 m-auto d-block w-xs-100 w-sm-100 w-md-100 w-ipad-100">
                <div class="modal_footer_btn w-100 d-inline-flex m-0 float-left mt-1 ml-0 mr-0 mb-0">
                  <div class="cancle-btn doctor-report-btn w-48 float-left mt-2">
                    <a v-on:click="hideDiscountModal(false)" class="book-border text-blue book-rounded w-100 p-2 text-center font-weight-bold d-inline-block">Cancel</a>
                  </div>
                  <div class="submit-btn w-48 float-right ml-2 mt-2">
                    <a href="javascript:void(0)" @click="getDiscount" class="bg-green book-rounded border-green w-100 text-white p-2 text-center font-weight-bold d-inline-block":disabled="submitting">Submit</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Discount modal End -->

    <div class="modal" id="response_modal" tabindex="-1" role="dialog" aria-labelledby="mobile_number_detail" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content box_radius  box_shadow">
          <div class="modal-header p-0 bg-blue">
            <div class="modal_bg w-100 d-inline-block box_radius box_bottom_lr_radius position-relative bg-blue">
              <button type="button" class="close text-white" v-on:click="hideSummaryDiscountModal(false)" aria-label="Close" style="opacity: 1 !important;">
                <span aria-hidden="true" style="padding:4px 10px 0 0;display: inline-block;">&times;</span>
              </button>
              <div class="container">
                <div v-if="balance < 10" class="heading-doctor-report p-2">
                  <p class="text-white text_14 text-xs-13">Your Discount Code</p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body px-0 py-3 w-80 m-auto">
            <form v-if="balance < 10">
              <!-- <div class="verification-text-phone-number float-right d-block mb-2" id="coupon_summary">
               <a class="text_14 float-left text-blue" :href="'/lab/download-discount/'+c_code">Download <img :src="basePath+'/images/final-save.png'" class="img-fluid"></a> 
               <a class="text_14 float-left theme-color-text" href="" @click.prevent="printme" target="_blank">Print <img src="/images/final-print.png" class="img-fluid"></a>
               
              </div> -->
              <div class="form-group w-100 float-left d-inline-block mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Name :   </label>
                <label class="text_black text_13 font-weight-bold float-right">{{c_name}}</label>
                
              </div>
             
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Phone Number :   </label>
                <label class="text_black text_13 font-weight-bold float-right">{{c_phone_number}}</label>
               
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Dicount Code :   </label>
                <label class="text_black text_13 font-weight-bold float-right"><b>{{c_code}}</b></label>
               
              </div>
              <div v-if="c_home_sampling !== null">
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Address :   </label>
                <label class="text_black text_13 font-weight-bold float-right">{{c_address}}</label>
               
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Age :   </label>
                <label class="text_black text_13 font-weight-bold float-right">{{c_age}}</label>
               
              </div>
              <div class="form-group mb-2 w-100 d-inline-block float-left mb-2 border-bottom">
                <label class="text_black text_13 font-weight-bold">Requested Home Sampling :   </label>
                <label class="text_black text_13 font-weight-bold float-right">{{c_home_sampling}}</label>
               
              </div>
              </div>
              </form>
            <form v-else>
              <div class="w-100 d-inline-block text-center">
                <img src="/images/pop-img.svg">
                <h2 class="text-black font-weight-bold text_25 mt-3 text-xs-20 text-center discount-font-family">
                  شکریہ!
                </h2>
              </div>
              <div class="form-group w-100  
              d-inline-block mb-2">
                <label class="text_black text_15 font-weight-bold text-right discount-font-family">تصدیق کے بعد آپ کے نمبر پر ڈسکاؤنٹ کوڈ بھیج دیا جائے گا، وہ کوڈ کسی بھی چغتائی لیب میں دکھائیں اور لیب ٹیسٹ پر  <span class="text-red text_30 font-weight-bold text_xs_20">%20</span> ڈسکاؤنٹ حاصل کریں </label>
                              
              </div>
              <div class="form-group w-100  
              d-inline-block mb-2">
                <label class="text_black text_15 font-weight-bold text-right discount-font-family">اگر آپ کو اپنا کوپن نمبر موصول نہیں ہوا تو  3 سے 5 منٹ انتظار کریں پھر ہمیں اس نمبر 03450435621 پر کال یا واٹس ایپ پر رابطہ کریں</label>
                              
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="w-100 text-center call-btn d-inline-block">
                    <a class="text_14 text-white d-inline-block font-weight-bold" href="https://wa.me/+923450435621?text=Hello I am looking for Discount code ">
                      <span>
                        <i class="fa fa-whatsapp mr-2 float-left" aria-hidden="true">
                        </i>
                      </span>
                      Whatsapp Us
                    </a>
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
Vue.filter('averageRating', function(value) {
  let avgRating = 0.0
  if (value.length > 0) {
    value.forEach(function (feedback){
      avgRating += parseFloat(JSON.parse(feedback.avg_rating))
    })
    return (avgRating/value.length).toFixed(1)
  }
  else {
    return '0'
  }

});
Vue.filter('satisfiedPatient', function(value) {
  let avgRating = 0.0
  if (value.length > 0) {
    value.forEach(function (feedback){
      avgRating += parseFloat(JSON.parse(feedback.avg_rating))
    })
    let total=value.length * 5
    let percent=(avgRating/total) * 100
    return percent+'% ('+value.length+')'
  }
  else {
    return '0'
  }

});

export default {
  name: "LabTabComponent",
  props: ['user', 'patient','segments', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      loading: false,
      submitting: false,   
      discountCodeGenerated: false,
      resultSegments: this.segments,
      name: '',
      phone_number: '',
      c_name:'Name',
      c_phone_number:'Phone Number',
      c_address:'Address',
      c_code:"testCode",
      phone_number:'',
      address:'',
      name:'',
      c_home_sampling:null,
      c_age:'',
      home_sampling:'',
      balance: 0,
      age:'',
      meta_intro:'',

    }
  },
  mounted() {
  },
  created () {
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  computed: {
    getOnlineTestReportsUrl() {
      // Generate the URL based on the current slug or other data
      return `/get-online-test-reports-${this.user.slug}`;
    },
  },
  methods: {
     formatPhoneNumber() {
      if (this.phone_number.startsWith('0')) {
        this.phone_number = '92' + this.phone_number.slice(1);
      }
    },
    scrolltodiv(){
      const introductionElement = document.getElementById('introduction-lab-content');
      if (introductionElement) {
        introductionElement.scrollIntoView({ behavior: 'smooth' });
      }
    },
    closeModal() {
      document.querySelector('#discount_modal').classList.remove('show')
      document.querySelector('body').classList.remove('scroll')
      /*document.querySelector('#doctor-report-modal').style.display = "none"*/
    },
     getDiscount()
    {
       if (this.submitting) {
    return;    }
  this.submitting = true;
      let self = this;
       axios.post(APP_URL + '/labs/get-discount', {
                        phone_number : this.phone_number,
                        name : this.name,
                        address : this.address,
                        age : this.age,
                        home_sampling : this.home_sampling,
                    })
                    .then((response)=> {
                      if(response.data.success===1)
                      {
                        if (!this.discountCodeGenerated) {
                             this.discountCodeGenerated = true;
                        document.querySelector('#discount_modal').classList.remove('feedback_modle')
                        document.querySelector('body').classList.remove('scroll')
                        document.querySelector('#discount_modal').style.display = 'none'
                         document.querySelector('#response_modal').classList.add('show')
                        document.querySelector('#response_modal').style.display = "block"
                        document.querySelector('#home-sampling-field').style.display = "none"
                         this.c_name = response.data.data.name;
                         this.c_phone_number = response.data.data.phone_number;
                         this.c_address = response.data.data.address;
                         this.c_code = response.data.data.code;
                         this.c_home_sampling = response.data.data.home_sampling;
                         this.c_age = response.data.data.age;
                         this.balance = response.data.balance;
                         this.phone_number = '';
                         this.name = '';
                         this.address = '';
                         this.age = '';
                         this.home_sampling = '';
                           this.$toasted.show("Your request submitted",{
                            type:'success',
                            duration: 2000
                          });
                         }
                       }
                        else{

                          this.$toasted.show(response.data.data,{
                            type:'error',
                            duration: 4000
                          });
                        } 
                    }); 
    },
    forHomeSampling(){
      document.getElementById('home_sampling').onchange = function() {
    document.getElementById('home-sampling-field').style.display = this.checked ? 'block' : 'none';};
    },
    avgRating:function(user){
      let avgRating = 0.0
      this.user.feedbacks.forEach(function (feedback){
        avgRating += parseFloat(feedback.avg_rating)
      })
      if (this.user.feedbacks.length > 0) {
        this.rating = parseFloat(((avgRating/parseFloat(this.user.feedbacks.length))/5).toFixed(0))
      }
      else {
        this.rating = 0
      }
    },
     showDiscountModal(){
      this.loading = true
      // if(this.patient.length === undefined) {
        document.querySelector('#discount_modal').classList.add('show')
        document.querySelector('body').classList.add('modal-open')
        document.querySelector('#discount_modal').style.display = "block"
      // }
      // else {
      //   Vue.toasted.show('Please Login First' , { duration: 3000 })
      // }
      this.loading = false
    },
    ResponseDiscountModal(){
      this.loading = true
      // if(this.patient.length === undefined) {
        document.querySelector('#response_modal').classList.add('show')
        document.querySelector('#response_modal').style.display = "block"
      // }
      // else {
      //   Vue.toasted.show('Please Login First' , { duration: 3000 })
      // }
      this.loading = false
    },
    hideDiscountModal(e) {
      this.loading = true
      document.querySelector('#discount_modal').classList.remove('feedback_modle')
      document.querySelector('body').classList.remove('modal-open')
      document.querySelector('#discount_modal').style.display = 'none'
      this.discountCodeGenerated = false;

      this.loading = false
    },
   
    hideSummaryDiscountModal(e) {
      this.loading = true
      document.querySelector('#response_modal').classList.remove('feedback_modle')
      document.querySelector('body').classList.remove('scroll')
      document.querySelector('#response_modal').style.display = 'none'
      this.discountCodeGenerated = false;
      
      this.loading = false
    },
    showAddReview(e) {
      this.loading = true
      document.querySelector('#discount_modal').classList.remove('feedback_modle')
      document.querySelector('body').classList.remove('scroll')
      document.querySelector('#discount_modal').style.display = 'none'
      this.loading = false
    },
    // showReportModal: function () {
    //   this.loading = true
    //   if(this.patient.length === undefined) {
    //     document.querySelector('#doctor-report-modal').classList.add('show')
    //     document.querySelector('#doctor-report-modal').style.display = "block"
    //   }
    //   else {
    //     Vue.toasted.show('Please Login First' , { duration: 3000 })
    //   }
    //   this.loading = false
    // },
  }
}
</script>

<style scoped>
#discount_modal,#response_modal{
  background: rgba(0,0,0,0.7);
}
#home-sampling-field{
  display: none;
}

.list_btns .discount-icon{
  width: 22px;
    height: 22px;
    border-radius: 50%;
    top: -5px;
    right: -6px;
}
.list_btns .discount-icon span{
margin-top: 3px;
}
.list_btns .discount-icon span img{
  height: 15px;
}


</style>