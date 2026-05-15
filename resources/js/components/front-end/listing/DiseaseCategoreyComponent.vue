<template>
    <div class="w-100 d-inline-block bg-doctor">
        <div class="container">
            <div v-if="this.bread_crumb_data && this.bread_crumb_data.length" class="row">
          <div class="col-12 pl-xl-0">
            <ul  class="w-100 d-inline-block bread-crumb-listing">
          <li v-for="(breadcrumbs,index) in this.bread_crumb_data" class="float-left">
            <a v-if="index === 0" class="text-blue text_12" :href="breadcrumbs.url">
              {{breadcrumbs.title}}
            </a>
            <a v-else class="text-blue text_12 speciality-bread" :href="breadcrumbs.url">
              {{breadcrumbs.title}}
            </a>
          </li>
        </ul>
          </div>
        </div>
            <div class="row">
                <div class="col-12">
                    <div v-if="resultDisease && resultDisease.introduction_detail" class="w-100 d-inline-block disease-content">
                        <h1 class="service-text text_30 text-xs-25 font-weight-bold mb-0">
                            {{resultDisease.title}}
                        </h1>
                        <p class="text-blue text_11">
                           Last Updated On {{moment().format("dddd")}},
                           {{ moment().format("MMMM") }} {{ moment().format("DD") }}, {{ moment().format("YYYY") }}
                        </p>
                        <span v-html="resultDisease.introduction_detail">
                        </span>
                    </div>
                </div>
            </div>
            </div>
            <div class="w-100 d-inline-block bg-white mt-4">
              <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-doctor-video-calling w-100 d-inline-block">
                      <h2 class="mt-xl-2 mt-3 service-text mb-xs-0 text_20 text-xs-16 font-weight-bold">Doctors Treating {{resultDisease.title}} 
                    </h2>
                    </div>
                </div>
            </div>
            <div class="row mb-lg-4 mb-xs-2">
              <div v-if="userData.length > 0 && index < 6" v-for="(doctor, index) in userData" class="col-12 col-lg-4 col-xl-4 col-md-6 mt-2 mb-lg-0">
                <div class="suggest-doctor bg-white w-100 d-inline-block p-2 box_shadow mb-lg-0 mb-3">
                  <div class="doctor_image position-relative float-left w-20 w-xs-25 w-sm-30">
                    <div class="position-relative mb-2">
                      <span class="video-cam-icon bg-blue d-inline-block position-absolute text-white disease-video-icon">
                        <!-- <img src="/images/video-cam-icon.svg" alt="pictire"> -->
                        <i aria-hidden="true" class="fas fa-video text_12"></i>
                      </span>
                      <img v-if="doctor.profile.avatar" v-lazy="basePath+'/uploads/users/'+doctor.id+'/'+doctor.profile.avatar" :alt="doctor.first_name + ' ' + doctor.last_name" :name="doctor.first_name + ' ' + doctor.last_name"class="img-fluid rounded-circle h_60 w_60px">
                      <img v-else v-lazy="basePath+'/uploads/users/default/doctor.svg'" :alt="doctor.first_name + ' ' + doctor.last_name" :name="doctor.first_name + ' ' + doctor.last_name"class="img-fluid rounded-circle h_60 w_60px">
                      <a :href="'/doctors/'+doctor.location.slug+'/'+doctor.specialities[0].slug+'/'+doctor.slug" class="circle_anchor position-absolute mb-2"></a>
                    </div>
        <!-- <div class="total_rating w-80 m-auto mt-2 mb-2">
              <span>
                 {{ averageRating(doctor.feedbacks) }} 
                <span class="text-blue font-weight-bold float-left w-100">
                <star-rating
                    class="w-30 float-left rating"
                    :max-rating="1"
                    :show-rating="false"
                    v-model="userRating"
                    :increment="userRating"
                    :rating="userRating"
                    inactive-color="#cccccc"
                    active-color="#0E4D92"
                    v-bind:star-size="14"
                ></star-rating> 
                                 <i class="fa fa-star" aria-hidden="true"></i> 
                  <span class="w-50 float-left text-center mt-1">{{ userRating }}</span>
                </span>
              </span>
                </div> -->
              </div>
              <div class="doctor-name-specialties w-75 float-left ml-2 w-xs-70 w-sm-65 mt-1">
                <div class="w-100 d-inline-block">
                  <a class="text_black font-weight-bold w-75 d-inline-block text-truncate text_13" :href="'/doctors/'+doctor.location.slug+'/'+doctor.specialities[0].slug+'/'+doctor.slug">{{ doctor.first_name }} {{ doctor.last_name }}</a>
                  <span class="badge safety-box text-white text_12 float-right">
                    <i aria-hidden="true" class="fa fa-thumbs-up"></i>
                      0%
                  </span>
                </div>
                <span v-if="doctor.specialities.length > 0" class="text_12 text_black d-block">
                  {{doctor.specialities[0].title}}
                </span>
                <p class="text_12 text_black">Experience<strong> {{ doctor.profile.total_experience }} years</strong></p>
                <p class="text_12 text_black">Fee<strong> Rs <span v-if="doctor.profile.fees_range === '' || doctor.profile.fees_range === null || doctor.profile.fees_range === 'null'">
                                {{docFee(doctor)}} 
                               </span>
                               <span v-else>
                                {{docFee(doctor)}} 
                               </span>

                </strong></p>
              </div>
              <div class="view-profile-btn w-100 d-inline-block text-center mt-2 mb-2">
                <a class="text-white rounded-pill text_14 d-inline-block bg-blue w-90" :href="'/doctors/'+doctor.location.slug+'/'+doctor.specialities[0].slug+'/'+doctor.slug">View Profile</a>
              </div>
            </div>

              </div>
            </div>
            <div class="row mt-xl-3 mb-3">
              <div class="col-12">
                    <div class="view-profile-btn w-100 d-inline-block see-more-doctor-btn text-center">
                <a class="text-white rounded-pill text_14 d-inline-block bg-blue" :href="'/diseases/'+resultDisease.slug+'/pakistan'">See more doctors</a>
              </div>
                </div>
            </div>
            </div>
            </div>
            <div class="container">
            <div class="row mt-4">
                <div class="col-12">
                    <div v-if="resultDisease && resultDisease.description" class="w-100 d-inline-block disease-content">
                        <span v-html="resultDisease.description"></span>
                       
                    </div>
                </div>
            </div>
            <div class="row">
        <div v-if="details.faqs_assign" class="col-12">
          <div class="accordion md-accordion" v-if="this.resultSpeciality.length > 0 || this.resultSpeciality.length === undefined">
            <!-- Accordion card -->
            <div class="card border-0">

              <!-- Card header -->
              <div class="p-0 heading-doctor-city-pakistan">
                <div href="javascript:void(0)" class="pt-2 pb-0 d-inline-block w-100 main-faq text_15">
                  <h2 class="w-90 d-inline-block text_18 text-xs-16 text-blue font-weight-bold">Frequently Asked Questions
                  </h2>
                </div>
                <!-- <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div> -->
              </div>
              <!-- Card body -->
              <div v-if="details.faqs_assign" id="doctors_in_karachi">
                <div class="pt-0 pb-2">
                  <div class="accordion" id="FaqS">
                    <div class="card border-0 bg-white box_radius box-shadow mt-2" v-if="faq.faqs" v-for="(faq, index) in details.faqs_assign">
                      <div class="card-header pl-3 pt-2 bg-white border-0 faq_accordian" :id="'faq_one_heading'+faq">
                        <h6 class="mb-0">
                          <a href="#" class="text_black p-0 text-left w-100 collapsed" data-toggle="collapse" :data-target="'#first_faq'+index" aria-expanded="true" aria-controls="first_faq">
                            <span v-html="(JSON.parse(faq.faqs.description))[0].find_replace() " class="w-100 d-inline-block service-text"></span>
                          </a>
                        </h6>
                      </div>
                      <div :id="'first_faq'+index" class="collapse" :aria-labelledby="'faq_one_heading'+faq" data-parent="#FaqS">
                        <div class="card-body p-0 mt-xl-3 mt-1 mb-xl-3 mb-1 faq_details p-2 pl-3">
                          <span v-html="(JSON.parse(faq.faqs.description))[1].find_replace()"></span>
                          <span v-if="index === 4">
                            <span v-for="(user,index) in userData">
                          <span
                            v-if="user.roles[0] !== undefined">
                            <span v-if="(user.roles[0].name   === 'doctor') && index < 10" class="w-90 d-inline-block text_15">{{user.first_name}} {{user.last_name}} </span></span>
                            </span>
                          </span>
                        </div>
                      </div>
                      <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Accordion card -->
          </div>
          <div class="accordion md-accordion" id="Karachi" role="tablist" aria-multiselectable="true" v-else>
            <!-- Accordion card -->
            <div class="border-0">

              <!-- Card header -->
              <div class="p-0 heading-doctor-city-pakistan" role="tab" id="karachi_doctors">
                <a href="#" class="p-2 d-inline-block w-100 collapsed main-faq text_15">
                  <h2 class="w-90 d-inline-block text_25 text-xs-22 text-blue font-weight-bold mb-0 mt-3">Frequently Asked Questions 
                  </h2>
                </a>
              </div>
              <!-- Card body -->
              <div v-if="details.faqs_assign.length > 0">
                <div class="card-body p-2">
                  <div class="accordion" id="FaqS">
                    <div class="card border-0 bg-white box_radius box-shadow mt-2" v-for="(faq, index) in details.faqs_assign">
                      <div class="card-header border-0 faq_accordian 
                      bg-white" :id="'faq_one_heading'+index">
                        <h6 class="mb-0">
                          <a href="#" class="text_black p-0 text-left w-100 collapsed pt-2 pb-2" data-toggle="collapse" :data-target="'#first_faq'+index" aria-expanded="true" aria-controls="first_faq">
                            <span v-html="(JSON.parse(faq.faqs.description))[0].find_replace_service() " 
                            class="w-90 d-inline-block service-text 
                            text_15"></span>
                          </a>
                        </h6>
                      </div>
                      <div :id="'first_faq'+index" class="collapse" :aria-labelledby="'faq_one_heading'+faq" data-parent="#FaqS">
                        <div class="card-body mt-xl-2 mt-1 mb-xl-2 mb-1 p-2 pl-3 faq_details">
                          <span v-html="(JSON.parse(faq.faqs.description))[1].find_replace_service()"></span>
                          <span v-if="index === 4">
                            <span v-for="(user,index) in userData">
                          <span  class="w-90 d-inline-block"  v-if="user.roles[0] !== undefined"><span v-if=" (user.roles[0].name   === 'doctor') && index < 10">{{user.first_name}} {{user.last_name}} </span></span>
                          </span>
                          </span>
                        </div>
                      </div>
                      <div data-v-7645c7bc="" role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
                    </div>
                  </div>
                </div>
              </div>

                <div v-else>
                <div class="card-body bg-white p-2">
                  <div class="accordion" id="FaqS">
                    <div class="card border-0">
                  <!-- First question -->
                      <div class=" pl-0 pt-2 pb-2 bg-white border-0 faq_accordian" :id="'faq_one_heading'">
                        <h6 class="mb-0">
                          <a href="#" class="text_black p-0 text-left w-100 collapsed pt-2 pb-2" data-toggle="collapse" :data-target="'#first_faq'" aria-expanded="true" aria-controls="first_faq">
                            <span class="w-90 d-inline-block">
                              How can I book an appointment with a doctor for  {{details.title}} <span v-if="resultLocation!=='pakistan'">in {{resultLocation}}, Pakistan?</span><span v-else>?</span>
                            </span>
                          </a>
                        </h6>
                      </div>
                      <div :id="'first_faq'" class="collapse" :aria-labelledby="'faq_one_heading'">
                        <div class="card-body p-0 mb-3 faq_details">
                          <span>
                            <p><a href="">Click here</a> to book an appointment with a top {{details.title}} Doctor <span v-if="resultLocation!=='pakistan'">in {{resultLocation}}, Pakistan</span><span v-else>in Pakistan</span>. Or, you can also call at <a href="tel:0345-0435621">0345-0435621</a> from 9AM to 11PM to book your appointment.</p>
                          </span>
                        </div>
                      </div>
                      <!-- Second question -->

                      <div class=" pl-0 pt-2 pb-2 bg-white border-0 faq_accordian" :id="'faq_two_heading'">
                        <h6 class="mb-0">
                          <a href="#" class="text_black p-0 text-left w-100 collapsed pt-2 pb-2" data-toggle="collapse" :data-target="'#second_faq'" aria-expanded="true" aria-controls="second_faq">
                            <span class="w-90 d-inline-block">
                              What is the fee range of the best doctors for {{details.title}} <span v-if="resultLocation!=='pakistan'">in {{resultLocation}}, Pakistan?</span><span v-else>?</span>
                            </span>
                          </a>
                        </h6>
                      </div>
                      <div :id="'second_faq'" class="collapse" :aria-labelledby="'faq_two_heading'">
                        <div class="card-body p-0 mb-3 faq_details">
                          <span>
                            <p>The fee for top {{details.title}} Doctors <span v-if="resultLocation!=='pakistan'">in {{resultLocation}}, Pakistan</span><span v-else>in Pakistan</span> ranges from 500 to 3000. You will pay at the reception when you visit the doctor.</p>
                          </span>
                        </div>
                      </div>

                      <!-- third question -->
                      <div class=" pl-0 pt-2 pb-2 bg-white border-0 faq_accordian" :id="'faq_three_heading'">
                        <h6 class="mb-0">
                          <a href="#" class="text_black p-0 text-left w-100 collapsed pt-2 pb-2" data-toggle="collapse" :data-target="'#third_faq'" aria-expanded="true" aria-controls="third_faq">
                            <span class="w-90 d-inline-block">
                              Are there any additional charges to book an appointment with doctors for {{details.title}} <span v-if="resultLocation!=='pakistan'">in {{resultLocation}}, Pakistan</span><span v-else>Pakistan</span> <a href="/">doctorfindy.com</a>?
                            </span>
                          </a>
                        </h6>
                      </div>
                      <div :id="'third_faq'" class="collapse" :aria-labelledby="'faq_three_heading'">
                        <div class="card-body p-0 mb-3 faq_details">
                          <span>
                            <p>There will be no additional charges when you book appointment through <a href="/">doctorfindy.com</a></p>
                          </span>
                        </div>
                      </div>

                      <!-- four question -->
                      <div class=" pl-0 pt-2 pb-2 bg-white border-0 faq_accordian" :id="'faq_four_heading'">
                        <h6 class="mb-0">
                          <a href="#" class="text_black p-0 text-left w-100 collapsed pt-2 pb-2" data-toggle="collapse" :data-target="'#forth_faq'" aria-expanded="true" aria-controls="forth_faq">
                            <span class="w-90 d-inline-block">
                              Can I book an online video consultation with the best doctor for {{details.title}} ? </span>
                          </a>
                        </h6>
                      </div>
                      <div :id="'forth_faq'" class="collapse" :aria-labelledby="'faq_four_heading'">
                        <div class="card-body p-0 mb-3 faq_details">
                          <span>
                            <p>Yes, you can book an online video consultation with the best doctors near you .Find the list of top doctors near you providing online consultation or call at <a href="tel:0345-0435621">0345-0435621</a></p>

                          </span>
                        </div>
                      </div>

                        <!-- four question -->
                      <div class=" pl-0 pt-2 pb-2 bg-white border-0 faq_accordian" :id="'faq_five_heading'">
                        <h6 class="mb-0">
                          <a href="#" class="text_black p-0 text-left w-100 collapsed pt-2 pb-2" data-toggle="collapse" :data-target="'#fifth_faq'" aria-expanded="true" aria-controls="fifth_faq">
                            <span class="w-90 d-inline-block">
                               Who is the best doctor for {{details.title}} <span v-if="resultLocation!=='pakistan'">in {{resultLocation}}, Pakistan?</span><span v-else>?</span> </span>
                          </a>
                        </h6>
                      </div>
                      <div :id="'fifth_faq'" class="collapse" :aria-labelledby="'faq_five_heading'">
                        <div class="card-body p-0 mb-3 faq_details">
                          <p>Top doctors for {{details.title}} <span v-if="resultLocation!=='pakistan'">in {{resultLocation}}, Pakistan are below:</span><span v-else>are below:</span></p>
                          <span>
                            <ul v-for="(user,index) in userData" v-if="index<9">
                              <a :href="'/doctors/'+user.location.slug+'/'+user.specialities[0].slug+'/'+user.slug">
                                <li>{{user.first_name}} {{user.last_name}}</li>
                              </a>

                            </ul>

                          </span>
                        </div>
                      </div>
                      
                      <div data-v-7645c7bc="" role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Accordion card -->
          </div>
        </div>
      </div>

            <div v-if="relatedDiseases.length !== 0" class="w-100 d-inline-block mt-3">
            <div class="row">
              <div class="col-12">
                <div class="heading-allergy-immunology">
                  <h2 class="text-blue text_20 text-xs-15 font-weight-bold">Related Diseases</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <ul class="disease-allergy-immunology w-100 d-inline-block patient-date mb-0">
                  <li v-for="disease in relatedDiseases" class=" mr-lg-3 mb-3 w-md-48 float-left">
                    <a class="pt-1 pb-1 pl-2 pr-2 text_black d-inline-block w-100" :href="'/diseases/'+disease.slug">{{ disease.title }}
                    </a>
                  </li>
                </ul>
              </div>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
var currentLocation = window.location.pathname;
var asd = currentLocation.split('/');
var locationSlug = '';
if(asd[1] == 'diseases'){
var diseaseTreatment = asd[1].replace('diseases','disease');
}
if(asd[1] == 'treatments'){
var diseaseTreatment = asd[1].replace('treatments','treatment');
}
if(asd[3]){
  locationSlug = asd[3]+' ';
}
var slug = asd[2]+' '+diseaseTreatment+' in '+locationSlug+'Pakistan';
slug = slug.replace(/-/g, ' '); 
// console.log('dada',slug = asd[2]+' '+diseaseTreatment+' in '+locationSlug+'Pakistan')
var onboard='';
var current = currentLocation.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, ' ');
var current_new = currentLocation.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
String.prototype.find_replace = function() {
    return this.replace(/Slug in City/g,current);
}
String.prototype.find_replace_service = function() {
    let a = this.replace(/SlugBoth in City/g,slug).replace(/onboard_doctors/g,onboard);
    return a;
}
import moment from 'moment';

export default {
  name: "DiseaseCategoreyComponent",
  props: [

      'userData', 'resultLocation', 'resultService', 'labs', 'cities', 'dise', 'special',
      'resultDisease', 'resultSpeciality', 'patientsData', 'hosp', 'allservices', 'type', 'tests', 'docs','totalCount','citiesPakistan','location_areas','bread_crumb_data', 'fileSystemDriver'],
data(){
    return{
        relatedDiseases:[],
        moment: moment,
       details: [],
       rating: 0.0,
      userRating: 0.0,
      basePath:'',
    }
  },
  created () {
    this.searchTypeCheck();
    // this.satisfiedPatients =  (this.doctor.profile.votes  / this.doctor.feedbacks.length * 100).toFixed(1)
    // let avgRating = 0.0
    // this.userData.feedbacks.forEach(function (feedback){
    //   avgRating += parseFloat(feedback.avg_rating)
    // })
    // this.rating = this.doctor.feedbacks.length > 0 ? parseFloat(((avgRating/parseFloat(this.doctor.feedbacks.length))/5).toFixed(1)) : 0
  },
  mounted()
  {
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
    this.getRelatedDiseases();
  },
  methods: {
    getRelatedDiseases()
    {
        axios.get('/related-diseases-to-the-selected-disease/'+this.resultDisease.slug)
        .then((response)=>{
            this.relatedDiseases = response.data;
        });
    },
     averageRating(value) {
      let avgRating = 0.0
      if (value.length > 0) {
        value.forEach(function (feedback){
          avgRating += parseFloat(JSON.parse(feedback.avg_rating))
        })
        this.userRating = parseFloat((avgRating/value.length).toFixed(1))
      }
      else {
        this.userRating = 0
      }
    },
    docFee(user){
      var docPrice = [];
        if(user.doc_teams.length > 0){

        user.doc_teams.forEach(function(x) {
          docPrice.push(x.price);
        })
        return Math.min.apply(Math, docPrice);
        }
        return 0;
      },
    searchTypeCheck () {
      // if(this.resultLocation.length > 0  || this.resultLocation.length === undefined) {
      //   this.details = this.resultLocation
      // }
      if(this.resultService.length > 0 || this.resultService.length === undefined) {
        this.details = this.resultService
      }
      if(this.resultDisease.length > 0  || this.resultDisease.length === undefined) {
        this.details = this.resultDisease;
      }
      if(this.resultSpeciality.length > 0 || this.resultSpeciality.length === undefined) {
        this.details = this.resultSpeciality
        
      }
    
    }

  },

};

</script>

<style>
.disease-list-style li .list-style{
    width: 4px;
    height: 4px;
    display: inline-block;
    background: #000;
    border-radius: 50%;
    float: left;
    margin-top: 9px;
    margin-right: 20px;
}




</style>