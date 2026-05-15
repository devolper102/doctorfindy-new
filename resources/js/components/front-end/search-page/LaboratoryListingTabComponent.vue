<template>
  <div>
    <div class="row bg-white box_radius box_shadow mb-4" v-for="(user, index) in users" v-model="usersData">
      <div class="col-md-8 mt-3 mb-lg-3 mb-2">
        <div class="doctor_profile_left w-100 laboratories_border d-flex">
          <div class="user_imgSec position-relative float-left mr-2">
            <v-lazy-image v-if="user.profile.avatar" :src="basePath+'/uploads/users/'+user.id+'/medium-'+user.profile.avatar" :alt="user.first_name+' '+user.last_name" :name="user.first_name+' '+user.last_name" class="img-fluid rounded-circle h_110 w_110px w_md_80px h_md_80"/>
            <v-lazy-image v-else :src="basePath+'/uploads/users/default/lab.svg'" :alt="user.first_name+' '+user.last_name" :name="user.first_name+' '+user.last_name" class="img-fluid rounded-circle h_110 w_110px w_md_80px h_md_80"/>
              <div class="total_rating w-80 m-auto w-md-100">
                <span class="text-blue"/>
                  <star-rating
                      class="w-15 float-left m-0 vue-star-rating"
                      :max-rating="1"
                      :show-rating="false"
                      v-model="rating"
                      :increment="rating"
                      :rating="rating"
                      inactive-color="#cccccc"
                      active-color="#FF465C"
                      v-bind:star-size="14"
                  ></star-rating>
                  <!--                <i class="fa fa-star" aria-hidden="true"></i> -->
                    <span class=" float-left text-center mr-1 ml-1 text-blue">{{ rating }}</span>
                    <span class="d-inline-block text-blue"> 
                    ({{ user.feedbacks.length }})</span>
                  </span>
              </div>
              <div class="Satisfy_percentage mt-1 ml-3 d-none d-lg-block d-md-block ml-md-0 ml-lg-3">
                    <span class="badge bg-blue text-white text_14 font-weight-normal">
                      <i class="fa fa-thumbs-up"></i>
                      <span v-if="user.profile.votes === 'null' || user.profile.votes === '' || user.profile.votes === null || user.profile.votes === 0">
                        0%</span>
                        <span v-else>
                          {{ (user.profile.votes / user.feedbacks.length * 100).toFixed(0) }}%
                        </span>
                    </span>
                    <span class="text_10 d-none">Satisfied patients</span>
                  </div>
          </div>
            <div class="profile_inner prfile_detail float-left float-lg-none overflow-hidden">
              <div class="doctor_name float-xs-left float-sm-left float-md-left float-lg-none">
                <h2 class="d-inline-block text_md_16">
                  <a :href="'/lab/'+user.location.slug+'/'+user.slug">
                    {{ user.first_name }} {{ user.last_name }}
                  </a>
                    <label class="ml-lg-1 ml-md-1" v-if="user.user_discount_percentage && user.user_discount_percentage != ' '"> (<span class="text-blue">{{user.user_discount_percentage}}% </span> Discount)</label>
                 </h2>
              </div>
              <div class="doctor_degree text_black d-inline-block text_md_13 w-100">
                <p class=" d-lg-block d-none w-100 text-truncate text_13">
                  {{ user.profile.address }}
                  {{ user.area_id ? user.area.title : '' }}
                  {{ user.location_id ? user.location.title : '' }}
                </p>
                <p class="text_13 text_md_13 font-weight-bold">
                 <!--  <span class="theme-color-text"> {{ user.profile.working_time.capitalize() }} </span> -->
                  <span class="text-blue"> Open   24/7 Hours </span>
                </p>
                <p class="text_13 mt-1 text_md_13"> <span class="text-blue font-weight-bold">{{ user.profile.total_experience }} Years </span> Experience</p>
                <span class=" theme-green-text text_13">
                    {{ checkAvailability(user) }}
                </span>
              </div>
            </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="doctor_profile_right pt-0 mt-lg-3 mt-md-3">
          <div class="row">
            <div class="col-md-12">
              <!-- <div class="mobile_design mt-3 d-block d-lg-none">
                <p class="text_14 text_md_13">MBBS, CRCP (Dow), D.Derm, Diploma in Dermato-Surgery</p>
                <p class="text_14 text_md_13">
                  {{ user.profile.address }}
                  {{ user.area_id ? user.area.title : '' }}
                  {{ user.location_id ? user.location.title : '' }}
                </p>
                <p class="text_14 mt-2 mb-2 text_md_13">Khayaban-e-Iqbal, Lahore 9.9 km</p>
                <div class="Satisfy_percentage mb-3 d-inline-block w-100">
                  <p class="badge knockdoc_sign_up_bg text-white text_md_13"> <i class="fa fa-thumbs-up" aria-hidden="true"></i> {{ user.profile.votes / 100 * 5}}%</p>
                  <span>Satisfied patients</span>
                  <span class="float-right theme-green-text">{{ checkAvailability(user) }}</span>
                </div>
              </div> -->
              <p class=" d-lg-none d-md-none d-block text_md_13 mb-2">
                {{ user.profile.address }}
                {{ user.area_id ? user.area.title : '' }}
                {{ user.location_id ? user.location.title : '' }}
              </p>
              <div class="list_btns w-100 d-inline-block pb-2 pl-lg-5 mt-lg-3 mt-md-0 mt-0 position-relative">
                <a  href="javascript:void(0)" @click="labData(user)" class="d-block book-rounded text-center book-border book-padding mt-lg-2 mt-md-2 mb-lg-2 mt-0 mb-0 text_12 text_md_12 text_md_12 float-right float-md-none float-lg-none small_btn w-sm-45 text-blue font-weight-bold position-relative w-100"  data-toggle="modal" data-target="#testModal position-relative">Book A Test
                  <span class="finger-icon bg-blue d-inline-block position-absolute">
                    <img :src="basePath+'/images/finger-icon.png'" 
                    alt="pictire">
                  </span>
                </a>
                <!-- <a :href="'/lab/'+user.location.slug+'/'+user.slug" class="d-block book-rounded text-center bg-green book-padding text_md_12 float-left float-md-none float-lg-none text_12 small_btn w-md-100 mt-0 mt-lg-2 mt-md-3 w-sm-45 text-white 
                font-weight-bold">View Profile</a> -->
              <!--   <a target="_blank" :href="'https://maps.google.com/?q='+user.profile.latitude+'+'+user.profile.longitude" class="d-block rounded-pill text-center knockdoc_doctor_profile_btn mt-lg-2 mt-md-2 mb-lg-2 mt-2 mb-0 text_14 text_md_12 text_md_12 float-right float-md-none float-lg-none small_btn w-sm-100 text-white">Direction</a> -->
              <a v-if="user.user_discount_percentage && user.user_discount_percentage != ' ' && user.id != 13057" href="javascript:void(0)" @click="showDiscountModal" class="d-block book-rounded text-center bg-green book-padding mt-xl-3 mb-2 mb-lg-1 text_12 text_md_12 float-xl-right float-md-none small_btn w-md-100 text-white position-relative font-weight-bold w-sm-45 border-green w-100">Get Discount Code
                  <a href="javascript:void(0)" class="bg-blue d-inline-block discount-icon position-absolute"><span class="d-inline-block">
                    <img :src="basePath+'/images/discount-icon.svg'">
                  </span>
                </a>
              </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <lab-model v-if="showBooking" :branches="users" :laboratories="laboratories" :cities="allcities" :tests="tests" :selectlab="lab" :test_id="test_id"></lab-model>
    </div>
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

import VLazyImage from "v-lazy-image/v2";
Vue.filter('averageRating', function(value) {
  let avgRating = 0.0
  if (value.length > 0) {
    value.forEach(function (feedback){
      avgRating += parseFloat(JSON.parse(feedback.avg_rating))
    })
    return (avgRating/value.length).toFixed(0)
  }
  else {
    return '0'
  }
});

export default {
  components: {VLazyImage},
  name: 'LaboratoryListingTabComponent',
  props: ['users','allLaboratories','allLocations','allTests', 'fileSystemDriver'],
  data () {
    return {
      basePath:'',
      rating: 0.0,
      submitting: false,   
      discountCodeGenerated: false,
      usersData: this.$parent.usersData,
      laboratories:[],
      showBooking:false,
      allcities:[],
      tests:[],
      test_id : null,
      lab:{},
      c_name:'Name',
      c_phone_number:'Phone Number',
      c_address:'Address',
      c_code:"testCode",
      c_home_sampling:null,
      c_age:'',
      phone_number:'',
      address:'',
      name:'',
      home_sampling:'',
      age:'',
      balance: 0,
    }
  },
  created () {
   
  },
  mounted(){
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
      
    this.allLaboratories.forEach(fields => {
        var lab_name = fields.first_name +" "+fields.last_name;

         this.laboratories.push({name:lab_name,id:fields.id})
      });
    this.allLocations.forEach(fields => {
         this.allcities.push({name:fields.title,id:fields.id})
      });
     // this.getAllTestsData();

    // this.allTests.forEach(fields => {
    //      this.tests.push({name:fields.title,id:fields.id,price:fields.price,discounted_price:fields.discounted_price,labo_id:fields.lab_id})
    //   });
    // console.log('mytest',this.tests)
  },
  methods: {
     formatPhoneNumber() {
      if (this.phone_number.startsWith('0')) {
        this.phone_number = '92' + this.phone_number.slice(1);
      }
    },
    getAllTestsData(id)
     {
        axios.get('/front-end-get-all-tests/'+id)
        .then(response=>{
             let data=response.data;
             // console.log('seeeItok',response.data);
             data.forEach(fields => {
             this.tests.push({name:fields.title,id:fields.id,price:fields.price,discounted_price:fields.discounted_price,labo_id:fields.lab_id})
              });
              this.findsymptoms= this.tests;
        });
              this.showBooking=true;

     },
    labData(data){
      this.lab = data;
      this.getAllTestsData(this.lab.id);
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
                      // console.log("ress");
                      if(response.data.success===1)
                      {
                        if (!this.discountCodeGenerated) {
                             this.discountCodeGenerated = true;
                        // console.log("up");
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
    forHomeSampling(){
      document.getElementById('home_sampling').onchange = function() {
    document.getElementById('home-sampling-field').style.display = this.checked ? 'block' : 'none';};
      console.log(this.checked);
    },
    checkAvailability: function (user) {
      let availableDays = JSON.parse(user.profile.available_days.toLowerCase())
      if (availableDays !== '') {
        let availability = '';
        let day1 = ((moment().format('ddd')).toLowerCase().trim());
        let day2 = ((moment().add(1, 'day').format('ddd')).toLowerCase().trim());
        let day3 = ((moment().add(2, 'day').format('ddd')).toLowerCase().trim());
        let day4 = ((moment().add(3, 'day').format('ddd')).toLowerCase().trim());
        let day5 = ((moment().add(4, 'day').format('ddd')).toLowerCase().trim());
        let day6 = ((moment().add(5, 'day').format('ddd')).toLowerCase().trim());
        let day7 = ((moment().add(6, 'day').format('ddd')).toLowerCase().trim());
        if (availableDays !== null) {
          if (availableDays.includes(day1) === true) {
            this.dayName = day1
            this.availableDayName = moment().day(day1).format('dddd')
            return availability = 'Available Today'
          } else if (availableDays.includes(day2)) {
            this.dayName = day2
            this.availableDayName = moment().day(day2).format('dddd')
            return availability = ' Available Tomorrow'
          } else if (availableDays.includes(day3)) {
            this.dayName = day3
            this.availableDayName = moment().day(day3).format('dddd')
            return availability = ' Available on ' + moment().add(2, 'day').format('dddd')
          } else if (availableDays.includes(day4)) {
            this.dayName = day4
            this.availableDayName = moment().day(day4).format('dddd')
            return availability = ' Available on ' + moment().add(3, 'day').format('dddd')
          } else if (availableDays.includes(day5)) {
            this.dayName = day5
            this.availableDayName = moment().day(day5).format('dddd')
            return availability = ' Available on ' + moment().add(4, 'day').format('dddd')
          } else if (availableDays.includes(day6)) {
            this.dayName = day6
            this.availableDayName = moment().day(day6).format('dddd')
            return availability = ' Available on ' + moment().add(5, 'day').format('dddd')
          } else if (availableDays.includes(day7)) {
            this.dayName = day7
            this.availableDayName = moment().day(day7).format('dddd')
            return availability = ' Available on ' + moment().add(6, 'day').format('dddd')
          } else {
            return availability = 'Not Available'
          }
        } else {
          return availability = 'Not Available'
        }
        return availability;
      }
      else {

      }
    },
  }
}
</script>

<style>

#discount_modal,#response_modal{
  background: rgba(0,0,0,0.7);
}
#home-sampling-field{
  display: none;
}
#home_sampling{
  position: relative;
  pointer-events: auto;
  opacity: 1;
}
</style>