<template>
	<div>
		<div id="forHidingListing" class="bg-lab-image w-100 d-inline-block">
    <div class="container">
      <div v-if="this.bread_crumb_data && this.bread_crumb_data.length" class="row">
        <div class="col-12">
          <ul  class="w-100 d-inline-block bread-crumb-listing mt-3">
        <li v-for="(breadcrumbs,index) in this.bread_crumb_data" class="float-left">
          <a v-if="index === 0" class="text-white text_12" :href="breadcrumbs.url">
            {{breadcrumbs.title}}
          </a>
          <a v-else class="text-white text_12 speciality-bread" :href="breadcrumbs.url">
            {{breadcrumbs.title}}
          </a>
        </li>
      </ul>
        </div>
      </div>     
      <div class="row">
        <div class="col-lg-12 col-12">
          <div class="banner_left_section w-100 d-inline-block 
          text-center">
            <div class="banner_heading">
              <h1 class="text-white mb-3 mt-4">
                <span class="text_20 font-weight-normal book-lab">{{tests[0].title}} Test Rates and Report details ({{testsCount}} Labs available)
                </span>
                <!-- <span class="online-test text_35 pl-4">Tests Online In Pakistan
                </span> -->
              </h1>
            </div>
            <div class="form-inline d-none d-lg-none mb-3">
                <!-- banner_input -->
              <input type="text" placeholder="Search for Lab Tests" name="search" v-model="keyword1" class="form-control banner_input text_14 w-100">
                  <div class="listing_main" v-if="showDropdown">
                    <ul  class="lab_listing_dropdown">
                      <li v-for="item in testResult" :key="item.id">
                        <div>
                          <div role="separator" class="dropdown-divider"></div> 
                          <a :href="'/book-a-lab-test/'+item.slug" class="pt-1 pb-1 pl-2 pr-2 w-100 d-block searchListMain clearfix">
                            <div class="row">
                              <div class="col-6">
                                <div class="w-100 d-inline-block mt-xl-0 mt-1 text-left">
                                  <span class="text_black text_13 mt-1 text-truncate w-100 
                                  text-xs-9">{{item.title}}
                                  </span>
                                </div>
                              </div>
                              <div class="col-3 p-0">
                                <div class="w-100 d-inline-block mt-xl-0 mt-1">
                                  <span class="text_black text_13 
                                mt-1 text-xs-9">
                                     Rs: {{item.averagePrice}}
                                  </span>
                                </div>
                              </div>
                              <div class="col-3 p-xl-0">
                                <div class="w-100 d-inline-block detail-btn">
                                  <a class="font-weight-bold text_12 text-blue book-rounded d-inline-block border-blue book-padding text-xs-9" :href="'/book-a-lab-test/'+item.slug">
                                    View Detail
                                  </a>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                      </li>
                    </ul>
                  </div>
            </div>
            <form class="form-inline w-100 d-inline-block">
              <div id="online-consultation-search" 
              class="w-60 search_main d-block m-auto position-relative w-xs-100 w-sm-100 
              w-md-100">
                  <input @input="hideListing($event)" type="text" placeholder="Search for Lab Test" name="search" v-model="keyword1" class="form-control text_14 w-100 h_35 book-rounded position-relative pl-5">
                  <a class="position-absolute" 
                  href="javascript:void(0)">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </a>
                  <div class="listing_main" v-if="showDropdown">
                    <ul  class="lab_listing_dropdown">
                      <li v-for="item in testResult" :key="item.id">
                        <div>
                          <div role="separator" class="dropdown-divider"></div> 
                          <a :href="'/book-a-lab-test/'+item.slug" class="pt-1 pb-1 pl-2 pr-2 w-100 d-block searchListMain clearfix">
                            <div class="row">
                              <div class="col-6">
                                <div class="w-100 d-inline-block text-left mt-xl-0 mt-1">
                                  <span class="text_black text_13 mt-1 w-100 text-truncate text-xs-9">{{item.title}}
                                  </span>
                                </div>
                              </div>
                              <div class="col-3 p-0">
                                <div class="w-100 d-inline-block mt-xl-0 
                                mt-1 text-center">
                                  <span class="text_black text_13 mt-1 text-xs-9">
                                     Rs: {{item.averagePrice}}
                                  </span>
                                </div>
                              </div>
                              <div class="col-3 p-xl-0">
                                <div class="w-100 d-inline-block detail-btn">
                                  <a class="font-weight-bold text_12 text-blue book-rounded d-inline-block border-blue book-padding text-xs-9" :href="'/book-a-lab-test/'+item.slug">
                                    View Detail
                                  </a>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                      </li>
                    </ul>
                  </div>
              </div>
            </form>
            <div class="search-below-text w-60 d-block m-auto w-xs-100 w-sm-100 w-md-100">
              <p class="text-white mt-3 mb-xl-4 text_13">Discover the Best Prices for Your Tests with DoctorFindy- Compare and Find Affordable Options from Trusted Labs in Your City
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="w-100 d-inline-block mb-2">
        <p class="text-white text_13">
          Last Updated On {{moment().format("dddd")}},
              {{ moment().format("MMMM") }} {{ moment().format("DD") }}, {{ moment().format("YYYY") }}
        </p>
      </div>
    </div>
  </div>
  <div class="w-100 d-inline-block b-bottom">
          <div class="container">
            <div class="w-45 d-block m-auto w-xs-100 w-sm-100 w-md-100">
            <div class="row">
              <div class="col-12">
                 <ul class="w-100 d-inline-block position-relative mb-1 mt-2">
                   <li class="reports-section float-left position-relative w-xs-45">
                      <a class="text_black text_13 text-xs-11" href="javascript:void(0)">
                        Get online test Reports
                      </a>
                      <div class="d-inline-block reports-section-menu p-2 book-rounded position-absolute bg-white">
                        <ul class="w-100 d-inline-block 
                        mb-0">
                          <li v-for="(lab,index) in users" v-if="lab.profile && lab.profile.online_report_url != null && index < 4" class="float-left w-100 mb-1 pb-1 d-inline-block">
                            <a :href="'/get-online-test-reports-'+lab.slug" 
                            class="text_black text_13 
                            d-inline-block p-0 w-100">
                              {{lab.first_name}} {{lab.last_name}}
                            </a>
                          </li> 
                          <li class="w-100 d-inline-block text-center">
                            <a class="bg-green book-rounded text-white text_12" href="/lab-test-report-online">
                              View All
                            </a>
                          </li>
                        </ul>
                      </div>
                   </li>
                   <li class="float-left position-relative discount-link w-xs-52">
                      <a class="text_black text_13 text-xs-10" href="javascript:void(0)" 
                      @click="showDiscountModal" style="padding: 5px 30px;">
                        Get Discounts Code For Walk-in
                      </a>
                   </li>
                 </ul>
              </div>
            </div>
          </div>
          
          </div>
        </div>
   <!-- Discount Model Start -->
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
import moment from 'moment';
export default {
  name: "searchBannerComponent",
  props: ['bread_crumb_data','users','tests', 'fileSystemDriver'],
  data() {
    return {
      moment:moment,
    	showDropdown:false,
    	keyword1: null,
      	testResult:null,
        submitting: false,   
      discountCodeGenerated: false,
      	c_name:'Name',
	      c_phone_number:'Phone Number',
	      c_address:'',
	      c_code:"",
	      c_home_sampling:null,
	      c_age:'',
	      phone_number:'',
        balance: 0,
	      address:'',
	      name:'',
	      home_sampling:'',
	      age:'',
	      testsCount:'',
        basePath:'',
    }
},	
watch: {
        keyword1(after, before) {
            this.getResults1();
        }
    },
    created() {
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
    },
	mounted()
	{
		
		this.testsCount = this.tests.length;
	},
	methods:
	{
     formatPhoneNumber() {
      if (this.phone_number.startsWith('0')) {
        this.phone_number = '92' + this.phone_number.slice(1);
      }
    },
		 hideSummaryDiscountModal(e) {
      this.loading = true
      document.querySelector('body').classList.remove('modal-open')
      document.querySelector('#response_modal').style.display = 'none'
      this.discountCodeGenerated = false;

      this.loading = false
    },
		 forHomeSampling(){
		      document.getElementById('home_sampling').onchange = function() {
		    document.getElementById('home-sampling-field').style.display = this.checked ? 'block' : 'none';};
		    },
		hideDiscountModal(e) {
	      this.loading = true
	      document.querySelector('#discount_modal').classList.remove('feedback_modle')
	      document.querySelector('body').classList.remove('modal-open')
	      document.querySelector('#discount_modal').style.display = 'none'
      this.discountCodeGenerated = false;

	      this.loading = false
	    },
		hideListing(e){
		      if (e.target.className == 'form-control banner_input text_14 w-100') {
		        if(this.keyword1.length > 3){
		          this.showDropdown = true;
		        }else{
		          this.showDropdown = false
		        }
		      }else{
		        this.showDropdown = false;
		      }
		    },
		getResults1() {
          if(this.keyword1.length > 2){
            this.showDropdown=true;
            axios.get('/all-test-search-banner', { params: { keyword1: this.keyword1 } })
                .then(res => this.testResult = res.data)
                .catch(error => {});
          }
        },
        showDiscountModal(){
      this.loading = true
      
        document.querySelector('#discount_modal').classList.add('show')
        document.querySelector('body').classList.add('modal-open')
        document.querySelector('#discount_modal').style.display = "block"
    
      this.loading = false
    },	
    	getDiscount()
    {
      if (this.submitting) {
    return;    }
  this.submitting = true;
      // let self = this;
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
	},

};

</script>
<style>
#discount_modal,#response_modal{
  background: rgba(0,0,0,0.7);
}
</style>
