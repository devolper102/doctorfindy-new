<template>
  <div>
  <!--   <div class="container">
        <div class="row">
              <div class="col-12 mt-4">
                <bread-crumb-spec></bread-crumb-spec>
              </div>
        </div>
    </div>  -->

<!-- Modal fo search Doctor on small devices -->
    <div class="modal fade" id="search_doctor_on_device" tabindex="-1" aria-hidden="true" >
      <div class="modal-dialog m-0">
        <div class="modal-content">
          <div class="modal-header border-0 pb-2 pt-1">
            <span class="text-center w-100 text_18 pt-1">Search</span>
            <a href="/doctors"type="button" class="close p-0 w_33px h_30 text-white rounded-circle bg-white border-2 mt-1 mr-1 text-right" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="text_black">&times;</span>
            </a>
          </div>
          <div class="modal-body pl-2 pr-2 pt-0 pb-0">
            <search-location-input
                :locations = "allLocations"
            >
            </search-location-input>
              <main-search-page
                    :docs = "doctors"
                    :hosp = "hospitals"
                    :labs = "laboratories"
                    :dise = "diseases"
                    :special = "specialities"
                    :service = "services"
                    :locations = "allLocations"
              ></main-search-page>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal fo search Doctor on small devices -->

    <!-- start BookedTestsComponent -->
      <div class="booking_section">
        <div class="container">
          <div class="col-12">
            <div class="section-heading mt-3 mb-3 mt-lg-4 mb-lg-4">
              <h2 class="font-weight-bold text_xs_20">
                Popular Labs In {{searchCity.title}}
              </h2>
            </div>
          </div>
          <div class="row lab_titles">
            <div class="col-6 col-lg-2 col-md-2 mb-3 mb-lg-0 mb-md-0" v-for="(user, index) in users">
              <a :href="'/lab/'+user.location.slug+'/'+user.slug" class="test_box bg-white box_shadow p-2 position-relative d-inline-block w-100">
                <span class="lab_image d-inline-block w-100 text-center">
                  <img v-if="user.profile.avatar" v-lazy="'/uploads/users/'+user.id+'/medium-'+user.profile.avatar" :alt="user.first_name+' '+user.last_name" :name="user.first_name+' '+user.last_name" >
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="top-content lab-test-slider">
        <div class="container">
            <div class="row">
              <div class="col-lg-3 col-md-3" v-for="test in tests" >
                <div class="test_box bg-white box_shadow p-2 position-relative sliderBox">
                  <div class="lab_image d-inline-block w-100 text-center">
                    <img src="images/eyes-image.png">
                  </div>
                  <a :href="'/book-a-lab-test/'+test.slug" class="font-weight-bold theme-color-text">{{test.title}}</a>
                  <div class="test_description">
                    <p>{{test.details}} </p>
                  </div>
                  <p class="font-weight-bold">Rs: {{test.averagePrice}}</p>
                  <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
                  <a @click="findTest(test.id)" class="theme-color-text text-center w-100 d-inline-block p-1 add_testBtn font-weight-bold" data-toggle="modal" data-target="#testModal">Book Test</a>
                </div>
              </div>
            </div>
        </div>
      </div> -->
            
    <!-- Start Health Checkups and Screenings -->
    <!-- <div class=" specalities w-100 mt-4 ">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-heading mt-3 mt-lg-0">
              <h2 class="font-weight-bold mb-4 text_xs_20">
                Health Checkups and Screenings For
              </h2>
            </div>
          </div>
        </div>
        <div class="col-12 text-center">
          <div class="row">
          <div class="specalities-image col-lg-2 col-md-3 col-6 col-sm-3 p-0">
              <div class="p-2 m-auto rounded-circle d-table visible_rounded_circle">
                <span class="d-table-cell align-middle p-2">
                  <img src="/uploads/symptoms/default/symptom.svg" name="default" alt="default" class="h_50 w_50px">
                </span>
              </div>
              <span class="pt-2 pb-2 d-block text_14">All </span>
              <a @click="getAlltests" class="circle_anchor position-absolute"></a>
            </div>
            <div class="specalities-image col-lg-2 col-md-3 col-6 col-sm-3 p-0" v-for="(symptom,index) in symptoms" v-if="index < symptomsToShow">
              <div class="p-2 m-auto rounded-circle d-table visible_rounded_circle">
                <span class="d-table-cell align-middle p-2">
                  <img v-if="symptom.image" v-lazy="'/uploads/symptoms/'+symptom.image" :name="symptom.title" :alt="symptom.title" class="h_50 w_50px">
                  <img v-else v-lazy="'/uploads/symptoms/default/symptom.svg'" :name="symptom.title" :alt="symptom.title" class="h_50 w_50px">
                </span>
              </div>
              <span class="pt-2 pb-2 d-block text_14">{{symptom.title}}</span>
              <a @click="symptomData(symptom.id)" class="circle_anchor position-absolute"></a>
            </div>
          </div>
          <span class=" d-inline-block w-100 text-center "><a href="javascript:void(0)" v-if="symptoms.length > 5 && symptoms.length > symptomsToShow-1" @click="symptomsToShow += 5" class="d-inline-block rounded-pill knockdoc_btn_bg text-white p-2 btn_padding mt-lg-4 mb-3 mb-lg-3 mt-3">View All Symptoms
            <i aria-hidden="true" class="fa fa-arrow-right ml-2"></i></a></span>
        </div>
      </div>
    </div> -->
  <!-- End Health Checkups and Screenings -->
<div class="container">
   <div class="booking_section">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="section-heading mt-3 mb-3 mt-lg-4 mb-lg-4 w-50 w-sm-100 float-left">  
                <h2 class="font-weight-bold text_xs_20">
                 {{get_title.capitalize()}} Symptom Tests ({{findsymptoms.length}})
                </h2>
              </div>
              <div class="input-lab-test-search w-50 w-sm-100 float-left mt-lg-4 mb-3 mb-lg-0 mb-md-0">
        <input class="w-100 d-inline-block h_37 radius_50 pl-4 pr-5" 
        type="text" v-model="keyword" placeholder="Search Test Name">
        
    </div>
            </div>
          </div>
          </div>
      </div>
      <div class="top-content" v-if="findsymptoms.length" >
        <div class="container">
         <div class="row">
             <div class="col-lg-3 col-md-4 col-12 col-sm-6 mb-3" v-for="(findsymptom,index) in findsymptoms" v-if="index < TestsToShow">
                <div class="test_box bg-white box_shadow p-2 position-relative" >
                  <a :href="'/book-a-lab-test/'+findsymptom.slug" class="font-weight-bold theme-color-text">{{findsymptom.title}}</a>
                  <div class="test_description">
                    <span>Known As:</span><p>{{findsymptom.known_as}} </p>
                  </div>
                  <p class="font-weight-bold">Rs: {{findsymptom.averagePrice}}</p>
                  <div v-if="findsymptom.turn_around_time" class="row">
            <div class="col-12 col-lg-6 col-md-6 mt-2">
              <span class="font-weight-bold text_12">Sample Type</span>
            </div>
            <div class="col-12 col-lg-6 col-md-6 mt-2">
              <span class="font-weight-bold text_12 d-inline-block w-100">{{findsymptom.sample_type}}</span>
            </div>
            <div class="col-12 col-lg-6 col-md-6">
              <span class="font-weight-bold text_12">Turn Around Time</span>
            </div>
            <div class="col-12 col-lg-6 col-md-6">
              <span class="font-weight-bold text_12 d-inline-block w-100">{{findsymptom.turn_around_time}}</span>
            </div>
          </div>
                  <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
                <a @click="findTest(findsymptom.id)" class="theme-color-text text-center w-100 d-inline-block p-1 add_testBtn font-weight-bold" data-toggle="modal" data-target="#testModal">
                                      Book Test
                                    </a>
                </div>
              </div>
          </div> 
        </div>
      </div>
       <div v-else><h5 class="text-center font-weight-bold">No Test Found...</h5></div> 
       <span class=" d-inline-block w-100 text-center "><a href="javascript:void(0)" v-if="findsymptoms.length > 8 && findsymptoms.length > TestsToShow-1" @click="TestsToShow += 8" class="d-inline-block rounded-pill knockdoc_btn_bg text-white p-2 btn_padding mt-lg-4 mb-3 mb-lg-3 mt-3">Show more tests
            <i aria-hidden="true" class="fa fa-arrow-right ml-2"></i></a></span> 
</div>     
  <!-- End Why Book With Us -->
  
  <!-- FAQ Questions -->
  <!-- <div class="container">
    <div class="row">
      <div class="bg-white mt-3 box_radius box_shadow w-100">
        <div class="heading-box p-3" id="profileDetialFAQ">
          <h6 class="font-weight-bold m-0 text_black mb-2">
             Frequently Asked Questions
          </h6>
          <div>
             <div class="my-2 question_main" >
                <a data-toggle="collapse" class="my-2 collapsed faq_inner faq_accordian" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <span>How to book an appointment with asdfasd</span>
                </a>
                <div class="collapse" id="collapseExample">
                   <div class="card card-body custom_collapse">
                      Call at 0345-8817087. You do not have to pay any extra fee for booking an appointment through DoctorFindy.
                   </div>
                </div>
             </div>
              
             <div class="my-2 question_main">
                <a data-toggle="collapse" class="my-2 collapsed faq_inner faq_accordian" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                <span>What is the Qualification of sdasdf?</span>
                </a>
                <div class="collapse" id="collapseExample1">
                   <div class="card card-body custom_collapse">
                      asdfasdf has the following Qualification 
                      <span>
                        asdfasdfasf
                      </span>
                   </div>
                </div>
             </div>
              
             <div class="my-2 question_main">
                <a data-toggle="collapse" class="my-2 collapsed faq_inner faq_accordian" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                <span>What is asdfasdf</span>
                </a>
                <div class="collapse" id="collapseExample2">
                   <div class="card card-body custom_collapse">
                      adfasdfasdf
                   </div>
                </div>
             </div>
              
             <div class="my-2 question_main">
                <a data-toggle="collapse" class="my-2 collapsed faq_inner faq_accordian" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
                <span>What is the fee of adsfasfd</span>
                </a>
                <div class="collapse" id="collapseExample3">
                   <div class="card card-body custom_collapse">
                      <span>
                      fee range of dfasdfdas
                       
                      </span> for consultation
                   </div>
                </div>
             </div>
              
             <div class="my-2 question_main">
                <a data-toggle="collapse" class="my-2 collapsed faq_inner faq_accordian" data-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample">
                <span>Practice timings of asfdasdf :</span>
                </a> 
                <div class="collapse collapsed" id="collapseExample4">
                   <div class="card card-body custom_collapse">
                     <span> Hospital Name : adsfasdf
                       
                      Timming : dayName
                   </span>
                   </div>
                </div>
             </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

  <!-- FAQ Questions -->


  <!-- Start Privacy Section -->
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="privacy-section-text w-100 d-inline-block mt-3 pb-4">
          <!-- <p class="text_black">
            <span class="font-weight-bold">
              Book Diagnostic
            </span> tests near you with DoctorFindy Associate Labs, your online lab test service provider for diagnostic, medical tests and health checkup packag
          </p>
          <p class="text_black mt-3">
            Get all the benefits of 
            <span class="font-weight-bold">
              diagnostic centre 
            </span> and <span class="font-weight-bold">pathology</span> labs right from the comfort of your home. With a phlebotomy team to ensure speedy home sample collection, and diagnostic services ranging from individual tests to complete health checkup packages for Men, Women, Senior Citizens & Corporates. DoctorFindy Associate Labs takes care of all your diagnostic needs.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Wide Selection of Tests:</h6> DoctorFindy Associate Labs covers a wide array of tests like blood sugar tests, thyroid tests, pregnancy tests, allergy tests, lipid profile, liver profile, platelet count, VDRL test, vitamin
            B12 deficiency test and more. Get details of all these tests such as blood test cost, when to take the tests, why it is required, who should take the test and what to do before taking the blood tests at home.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Sample Collection at Home:</h6> Book blood tests online from your home and our expert team of DoctorFindy Associate Labs technicians will arrive at the pre-scheduled time to pick up your sample. Once you
            get a diagnostic test done, you will receive your reports online.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Digital Reports:</h6> Get all your diagnostic reports emailed directly to you with detailed blood test reports & secure storage to easily access your medical records online.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Full Body Health Checkup:</h6> Keep your health and well being in check with exclusive Health Checkup Packages like Men’s Health Package, Women’s Health Package, Vitamin Package, Health Package for
            Corporates, Diabetes Packages, Packages for Senior Citizens & more. Get full details of all tests available in a package when booking online pathology tests.
          </p>
          <p class="text_black mt-3">
            DoctorFindy Associate Labs provides services to the following cities: Lahore, Islamabad, Karachi, Quetta, Peshawar, Gujranwala, Faisalabad, Gujrat, Jehlum, Sargoda, Mianwali, Hayedrabad, Gawadar.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">DoctorFindy – Leading Medical Care Providers</h6>
            DoctorFindy is a Lahore-based E-commerce marketplace for healthcare and fitness service providers and is one of the best e-health platforms, the fastest growing health tech company in Pakistan. It is the best platform for patients to connect with doctors run by a superb team of professionals. Motility throughout the country has been more difficult for Pakistanis in need of health care services. This private sector partnership helps Pakistani citizens to connect with a healthcare professional to address the issues they or their families are confronting.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">State of The Art Labs in Pakistan</h6>
            Founded in 2015, DoctorFindy stands among the top national and award-winning international companies in the healthcare industry. This platform has been built to bridge a patient with the right healthcare providers. The popular lab test in Pakistan provided by DoctorFindy includes:
            <ul class="text_list">
              <li>Chughtai Lab (Radiology Test)</li>
              <li>Alnoor Diagnostic Center</li>
              <li>Dr. Essa Laboratory</li>
              <li>Excels Lab</li>
              <li>Citi-Labs And Research Center</li>
              <li>Advance Diagnostic Center</li>
              <li>ProLab Diagnostic Center</li>
              <li>Doctors Hospital (Pathology Lab)</li>
              <li>Akbar Niazi Teaching Hospital Lab</li>
              <li>Hormone Lab</li>
            </ul>
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Chughtai Lab</h6>
            Chughtai Lab provides you free home sampling service, you can get the benefits of a diagnostic center in your home. You can also book an online blood test with Chughtai lab. It offers blood tests like C/E (complete, CBC), vitamin D test, Cholesterol / HDL cholesterol ratio, blood glucose random, Covid-19 test, and many more. Chughtai lab provides blood sampling services in the cities such as Lahore, Karachi, Islamabad, Rawalpindi, Faisalabad, Gujranwala, Multan, Peshawar, Quetta, Sargodha, Rajanpur, Sialkot, Sahiwal, Dera Ghazi Khan, Dera Ismail Khan, Balakot and all other famous cities in Pakistan.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Alnoor Diagnostic Center</h6>
            Alnoor Diagnostic Center provides free medical testing services such as 17-OH progesterone, Albumin (fluid), Anti-Hbs, Liver function tests, Uric acid, and many more tests for patients. Alnoor Diagnostic Center labs are present in Lahore, Karachi, Islamabad, Rawalpindi, Faisalabad, Gujranwala, Multan, Peshawar, Quetta, Sargodha, Sialkot.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Dr. Essa Laboratory</h6>
            Dr. Essa Laboratory provides the lowest price of tests services throughout Pakistan. It provides medical tests such as lipid profile, X-ray: abdomen erect view, liver function test, 17-OH progesterone, Semen analysis, etc. Its lab test service is available in Lahore, Karachi, Islamabad, Rawalpindi, Gujranwala, Sialkot, Wah cant, Taxila, Peshawar, etc.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Excels Lab</h6>
            Excels Lab provides 24 hours service to patients with an accurate diagnosis. You can book an online test such as CT chest high resolution, albumin (fluid), anti-ds DNA, cholesterol ratio, blood urea, blood culture test, and many more. Its service is available in Lahore, Karachi, Islamabad, Rawalpindi, Gujranwala, Sialkot, Sahiwal, Taxila, etc.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Citi-Labs And Research Center</h6>
            Citi-Labs And Research Center provides high-ranking quality diagnostic services to patients. They provide 24 hours lab service. Citi-lab offers 1000+ clinical laboratory tests such as C/E (complete, CBC), vitamin D test, Cholesterol / HDL cholesterol ratio, liver function test, and many more. Its lab service is available in Lahore, Karachi, Islamabad, Rawalpindi, Faisalabad, Multan, Peshawar, Quetta, Sargodha, Sialkot, Sahiwal.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Advance Diagnostic Center</h6>
            Advance Diagnostic Center provides a free online medical testing service for patients. It provides lab testing such as renal function test, 24 hrs calcium, complete blood count (CBC) (blood test), liver function test, and many more. Its lab test services are available in Lahore, Karachi, Islamabad, Rawalpindi, Faisalabad, Gujranwala, Multan, Peshawar, Quetta.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">ProLab Diagnostic Center</h6>
            ProLab Diagnostic Center provides online lab test services such as liver function test, 17-OH progesterone, lipid profile, uric acid (serum), and many more. Its services are available in Lahore, Karachi, Islamabad, Rawalpindi, Faisalabad, Multan, Peshawar, Quetta, Sargodha, Sialkot, Faizabad.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Doctors Hospital (Pathology Lab)</h6>
            Doctors Hospital (Pathology Lab) provides you reliable and appropriate laboratory testing services for 24 hours for patients. It offers 50+ laboratory tests which include CBC test, Absolute Lymphocyte Count Test, Anti-Hbs, Absolute Neutrophil Count Test, Glucose (Fluid) Test, HbA1c, and many more.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Akbar Niazi Teaching Hospital Lab</h6>
            Akbar Niazi Teaching Hospital Lab provides complete healthcare facilities and advanced laboratory services to patients at an affordable cost. It offers blood tests like blood C/E (complete, CBC), vitamin D test, cholesterol / HDL cholesterol ratio, MCV, hemoglobin test, leukocyte count test, hematocrit test, coagulation time, blood sugar, fasting blood glucose (FBG), fasting blood sugar (FBS), isospora test and many more.
          </p>
          <p class="text_black mt-3">
            <h6 class="font-weight-bold">Hormone Lab</h6>
            Hormone Lab is one of the main pathology labs in Pakistan. You can book an online lab test by visiting the DoctorFindy website.
          </p> -->
          <section class="collepse-best-doctor-in-pakistan" v-cloak>
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 col-lg-12">
                    <lab-tag-section
                     :cities = "cities"
                    ></lab-tag-section>
                </div>
            </div>
        </div>
    </section>
          <!-- <p class="text_black mt-3 text-center">
            This site is protected by reCAPTCHA and the Google <a class="font-weight-bold theme-color-text" 
            href="javascript:void(0)">Privacy Policy
            </a> and <a class="font-weight-bold theme-color-text" href="javascript:void(0)">Terms of Service
            </a> apply.
          </p> -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Privacy Section -->
        <lab-model :branches="users" :specialitys="specialities" :doctorss="doctors" :hospitalss="hospitals" :diseasess="diseases" :servicess="services" :laboratories="allLaboratories" :cities="allcities" :tests="allTests" :selectlab="lab"  :test_id="test_id"></lab-model>
  </div>
</template>

<script>
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
import { VueAutosuggest } from 'vue-autosuggest';
Vue.use(Toasted)
export default {
   components: { VueSlickCarousel , VueAutosuggest },
  props:[ 'specialitys', 'servicess', 'cities', 'diseasess', 'doctorss', 'hospitalss', 'laboratories', 'trendingTopics','managements', 'logged_user', 'segments','tests','symptoms','users','searchCity'],
  name: "bookTestInCityComponent",
  data() {
    return {
      selectedLocation: [],
      specialities: this.specialitys,
      doctors: this.doctorss,
      hospitals: this.hospitalss,
      diseases: this.diseasess,
      services: this.servicess,
      symptomsToShow: 5,
      TestsToShow: 8,
      search: '',
      allLaboratories: [],
      allLocations: this.cities,
      allcities: [],
      allTests: [],
      findTests: [],
      id : '',
      showDropdown:false,
      test_id : '',
      lab:null,
      findsymptoms : this.tests,
      keyword: null,
      get_title: 'All',
       c2Setting: {
        slidesToShow:4,
        arrows: true,
        health_community_slider: '',
        show_healthtabs: '',
        hide_show: '',
        slides: '',
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 640,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
              initialSlide: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      },
    }
  },
  watch: {
        keyword(after, before) {
            this.getResults();
        }
    },
async  created () {
    // const specs = await axios.get('/all-spec')
    // this.specialities = Object.freeze(specs.data)

    // const doc = await axios.get('/all-docs')
    // this.doctors = Object.freeze(doc.data) 

    // const hosp = await axios.get('/all-hosp')
    // this.hospitals = Object.freeze(hosp.data)

    // const dis = await axios.get('/all-dise')
    // this.diseases = Object.freeze(dis.data)

    // const sev = await axios.get('/all-services')
    // this.services = Object.freeze(sev.data)

    // const city = await axios.get('/all-cities')
    // this.allLocations = Object.freeze(city.data)
    
    // const labs = await axios.get('/all-labs')
    // this.allLaboratories = Object.freeze(labs.data)
  },
  mounted(){
      this.users.forEach(fields => {
        var lab_name = fields.first_name +" "+fields.last_name;

         this.allLaboratories.push({name:lab_name,id:fields.id})
      });

      this.cities.forEach(fields => {
         this.allcities.push({name:fields.title,id:fields.id})
      });
      this.tests.forEach(fields => {
         this.allTests.push({name:fields.title,id:fields.id,price:fields.price,discounted_price:fields.discounted_price,labo_id:fields.lab_id})
      });
  },
  methods: {
    hideListing(e){
      if (e.target.className == 'form-control banner_input text_14 w-100') {
        if(this.showDropdown == true){
          this.showDropdown = false;
        }else{
          this.showDropdown = true
        }
      }else{
        this.showDropdown = false;
      }
    },
    bodyHideListing(event){
      if (event.target.className != "form-control banner_input text_14 w-100") {
        this.showDropdown = false
      }
    },
    getResults() {
            axios.get('/all-test-search', { params: { keyword: this.keyword } })
                .then(res => this.findsymptoms = res.data)
                .catch(error => {});
        },
      findTest(id){

        this.test_id =id;
               let self = this
              self.findTests = [];
          self.tests.forEach(function (x) {
            if (x.id === id) {
                self.findTests.push(x)
            }
      })
        },
           symptomData(id) {
              let self = this
              self.findsymptoms = [];
          self.symptoms.forEach(function (x) {
            if (x.id === id) {
                self.findsymptoms = x.tests
                self.get_title = x.title
            }
      })
    },
    getAlltests(){
      let self = this
      self.findsymptoms = self.tests;
      self.get_title = 'All'
    },
// end search test
  }
}
</script>
<style>
.test_box {
  min-height: 156px;
}
.autosuggest__results-container{
  width: 84%;
}
.lab-tests img{
  height: 100%;
}
.lab_listing_dropdown{
  width: 100%;
  background-color: #ffffff;
  margin: 0px;
}
.listing_main{
  width: 88%;
  display: block;
  margin-left: 20px;
  max-height: 200px;
  overflow-y: auto;
  background-color: #ffffff;
  position: absolute;
  top: 50px;
  left: 0;
}
.lab-search-btn{
  right: -30px !important;
}
.text_list{
  list-style: disc;
  padding-left: 40px;
}
.city-border a {
  border: 1px solid #e5e5e5;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.all-procedure a {
  background-color: #dddddd;
  color: black;
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
#search_doctor_on_device #autosuggest input{
  border-radius: 0px !important;
  margin-bottom: 10px !important;
  padding-right: 5rem;
  padding: 1.375rem .75rem;
}
#search_doctor_on_device .autosuggest__results-container {
    width: 100% !important;
    left: 0px !important;
    top: 110px !important;
}
#search_doctor_on_device .autosuggest__results{
  max-height: 100vh;
  overflow-y: auto !important;
}
.disease_search .autosuggest__results {
    overflow-y: auto;
  }
.autosuggest__results ul{
  margin: 0px !important;
}
.slick-prev, .slick-next{
  top: 35%;
}
@media (max-width: 991px){
  .banner_heading span{
    font-size: 27px;
  }
  .banner_heading{
    color: #fff;
  }
  .mobile_search_btn {
    top: 10px !important;
  }
  .inner-slider{
    margin-top: 40px;
  }
}
.inner-slider{
  margin-top: 75px;
}
@media (max-width: 360px){
  .slick-prev {
    left: -13px;
  }
  .slick-next {
    right: -17px;
  }
}
.modal-open{
  overflow-y: scroll !important;
}
.sliderBox {
  margin: 20px;
}
.work_text{
  height: 60px;
  overflow: hidden;
}
.default_test{
  background: #2b4df9;
}
.input-lab-test-search input{
  border:1px solid #8b8b8b !important;
}
.lab_image{
  margin: 20px 0;
}
.lab_image img{
  width: 100px;
  border-radius: 135px;
  height: 95px;
}
</style>