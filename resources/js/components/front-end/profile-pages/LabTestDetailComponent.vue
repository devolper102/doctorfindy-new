<template>
  
  <div class="top-content"  >
    <div class="lab_heading mb-3">
      <h5 class="font-weight-bold">{{tests[0].title}} Price and Details ({{testsCount}} tests available)</h5>
      <h3 class="text_14">Last Updated On {{moment().format("dddd")}},
              {{ moment().format("MMMM") }} {{ moment().format("DD") }}, {{ moment().format("YYYY") }}</h3>
    </div>
    <div class="row mb-3">
      <div class="col-12 col-md-3 col-lg-3" v-for="(test,index) in tests" v-if="index < TestsToShow">
        <div class="test_box bg-white box-shadow p-2 position-relative float-left d-inline-block mb-3 mr-lg-2 height_box w-100">
          <a href="#" class=" py-2 position-relative d-inline-block w-100">
            <span class="lab_image d-inline-block w-100 text-center">
              <img  v-lazy="'/uploads/users/'+test.user.id+'/medium-'+test.user.profile.avatar" :alt="test.user.first_name+' '+test.user.last_name" :name="test.user.first_name+' '+test.user.last_name" >
            </span>
          </a>
          <a :href="'/test/'+test.user.slug+'/'+test.slug" class="font-weight-bold theme-color-text test_name text_16">{{test.title}} in {{test.user.first_name}} {{test.user.last_name}}</a>
          <div class="test_description mt-2">
            <p><span class="font-weight-bold">Known As:</span> {{test.known_as}} </p>
          </div>
          <div class="position-relative w-100 d-inline-block">
            <s class="font-weight-bold text_20" v-if="test.price != '' ">Rs: {{test.price}}</s>
            <p class="font-weight-bold text_20" v-if="test.price != '' ">Rs: {{test.discounted_price}}</p>
            <div v-if="test.user.user_discount_percentage" class="percent_main text-center mb-2 adjust_percentage">
              <span class="percent_off">
                {{test.user.user_discount_percentage}}%
              </span>
              <sub>OFF</sub>
            </div>
          </div>
          <div v-if="test.turn_around_time" class="row">
            <div v-if="test.sample_type" class="col-12 col-lg-6 col-md-6 mt-2">
              <span class="font-weight-bold text_12">Sample Type</span>
            </div>
            <div v-if="test.sample_type" class="col-12 col-lg-6 col-md-6 mt-2">
              <span class="font-weight-bold text_12 d-inline-block w-100">{{test.sample_type}}</span>
            </div>
            <div class="col-12 col-lg-6 col-md-6">
              <span class="font-weight-bold text_12">Turn Around Time</span>
            </div>
            <div class="col-12 col-lg-6 col-md-6">
              <span class="font-weight-bold text_12 d-inline-block w-100">{{test.turn_around_time}}</span>
            </div>
          </div>
          <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
          <a @click="labData(test.user.id, test.id)" class="theme-color-text text-center w-100 d-inline-block p-1 add_testBtn font-weight-bold" data-toggle="modal" data-target="#testModal">Book Test</a>
        </div>
      </div>
    </div>
    <!-- <div class="col-12">
      <div class="singleTestReview">
        <lab-review></lab-review>
      </div>
    </div>
    <div class="col-12">
      <div class="singleTestFAQ">
        <lab-faq-section></lab-faq-section>
      </div>
    </div> -->
    <div class="bg-white mt-3 box_radius box-shadow">
      <div class="heading-box p-3" id="profileDetialFAQ">
        <h2 class="font-weight-bold m-0 text_black mb-2 text_16">
           Frequently Asked Questions
        </h2>
        <div>
           <div class="question_main" >
              <a data-toggle="collapse" class="collapsed faq_inner" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              <span class="service-text font-weight-bold text_15">
              Does DoctorFindy Take Any Additional Charges for Appointment Booking for {{tests[0].user.first_name}} {{tests[0].user.last_name}} Test?</span>
              </a>
              <div class="collapse" id="collapseExample">
                 <div class="card card-body custom_collapse test_faq">
                    <span class="text_14">
                    We care for your health and value your concerns; therefore, DoctorFindy doesn't charge additional fees for booking an appointment at {{tests[0].user.first_name}} {{tests[0].user.last_name}}.</span>
                 </div>
              </div>
           </div>
            
           <div class="question_main">
              <a data-toggle="collapse" class="collapsed faq_inner" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
              <span class="service-text font-weight-bold text_15">
              Can I Get My {{tests[0].user.first_name}} {{tests[0].user.last_name}} Test Result Online?</span>
              </a>
              <div class="collapse" id="collapseExample1">
                 <div class="card card-body custom_collapse">
                  <span class="text_14">
                    Yes, why not? DoctorFindy can provide you with online test results. You can check them through your DoctorFindy account or send them via email.
                  </span>
                 </div>
              </div>
           </div>
            
           <div class="question_main">
              <a data-toggle="collapse" class="collapsed faq_inner" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
              <span class="service-text font-weight-bold text_15">
              How Can I Check For {{tests[0].user.first_name}} {{tests[0].user.last_name}} Reports Online?</span>
              </a>
              <div class="collapse" id="collapseExample2">
                 <div class="card card-body custom_collapse">
                  <span class="text_14">
                    DoctorFindy uploads all the test results. You can enter your invoice number and get the code. This code will help you to view your medical report.
                  </span>
                 </div>
              </div>
           </div>
            
           <div class="question_main">
              <a data-toggle="collapse" class="collapsed faq_inner" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
              <span class="service-text font-weight-bold text_15">
              How to Book an Appointment for {{tests[0].user.first_name}} {{tests[0].user.last_name}} Test Online Through DoctorFindy?</span>
              </a>
              <div class="collapse" id="collapseExample3">
                 <div class="card card-body custom_collapse">
                    <span class="text_14">Booking a test online is a breeze with DoctorFindy. You can use DoctorFindy's official website or DoctorFindy app for online booking. Or, you can contact our customer services team at 0345-0435621. You can get an appointment for {{tests[0].user.first_name}} {{tests[0].user.last_name}} at competitive prices through DoctorFindy..</span>
                 </div>
              </div>
           </div>
        </div>
      </div>
    </div>
    <section class="collepse-best-doctor-in-pakistan" v-cloak>
      <div class="row mb-4">
          <div class="col-12 col-lg-12">
              <lab-tag-section
               :cities = "cities"
              ></lab-tag-section>
          </div>
      </div>
    </section>
    <lab-model ref="LabTestModal" :branches="user" :specialitys="specialities" :doctorss="doctors" :hospitalss="hospitals" :diseasess="diseases" :servicess="services" :laboratories="allLaboratories" :cities="allcities" :tests="allTests" :selectlab="lab" :test_id="test_id"></lab-model>
  </div>
</template>

<script>
import moment from 'moment';
export default {
name: "LabTestDetailComponent",
  props: ['specialitys', 'servicess', 'cities', 'diseasess', 'doctorss', 'hospitalss', 'laboratories', 'trendingTopics','managements', 'logged_user', 'segments','tests','symptoms','user'],
  data() {
    return {
      moment: moment,
      selectedLocation: [],
      specialities: this.specialitys,
      doctors: this.doctorss,
      hospitals: this.hospitalss,
      diseases: this.diseasess,
      services: this.servicess,
      TestsToShow: 6,
      search: '',
      allLaboratories: [],
      allLocations: this.cities,
      allcities: [],
      allTests: [],
      findTests: [],
      id : '',
      lab:null,
      testsCount:'',
      test_id : '',
    }
  },
  created () {
    // this.tests = JSON.parse(this.user.lab_test);


  },
  mounted(){
      
        var lab_name = this.user.first_name +" "+this.user.last_name;
         this.allLaboratories.push({name:lab_name,id:this.user.id});
      this.cities.forEach(fields => {
         this.allcities.push({name:fields.title,id:fields.id})
      });
      this.user.lab_test.forEach(fields => {
         this.allTests.push({name:fields.title,id:fields.id,price:fields.price,discounted_price:fields.discounted_price,labo_id:fields.lab_id})
      });
      this.testsCount = this.tests.length;

  },
  methods: {
      // findTest(id){
      //     this.$refs.LabTestModal.selectedFirstLab();
      //          let self = this
      //         self.findTests = [];
      //     self.tests.forEach(function (x) {
      //       if (x.id === id) {
      //           self.findTests.push(x)
      //       }
      // })
      //   },
        labData(data,id){
          
      this.lab = data;
      this.test_id =id;
    },
  }
}
</script>

<style>
.all-procedure a{
  background-color: #dddddd;
  color: black;
}
.city-border a{
  border: 1px solid #e5e5e5;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.test_description {
    min-height: 85px;
}
.percent_main sub {
    bottom: -1.25em;
    font-weight: bold;
}
.test_name{
  display: inline-block;
  height: 45px;
}
.lab_image img {
  width: 100px;
  border-radius: 135px;
  height: 100px;
}
.adjust_percentage{
  position: absolute;
  top: 0px;
  right: 0px;
  text-align: right;
}
.test_box:hover .add_testBtn {
  background-color: #EA4335;
  color: #fff !important;
}
</style>