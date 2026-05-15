<template>
   <div>
      <div class="d-inline-block w-100 mt-3">
         <div class="heading-box" id="profileDetialFAQ">
            <h2 class="font-weight-bold text-blue text_18 text-xs-16 d-inline-block">
               Frequently Asked Questions
            </h2>
            <div v-if="user.roles[0].role_type === 'doctor'">
               <div class="question_main border-bottom bg-white box-shadow mt-2">
                  <a data-toggle="collapse" class="collapsed faq_inner" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
                  <span class="service-text font-weight-bold text_15">
                     What is the fee of {{user.first_name}}
                  {{user.last_name}}?</span>
                  </a>
                  <div class="collapse" id="collapseExample3">
                     <div class="card card-body custom_collapse p-2 pl-3">
                        <span class="text_14">
                        fee range of {{user.first_name}}{{user.last_name}} is Rs. {{fee}}
                         
                        </span> for consultation
                     </div>
                  </div>
               </div>
               <div class="question_main border-bottom bg-white box-shadow mt-2">
                  <a data-toggle="collapse" class="collapsed faq_inner" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  <span class="service-text font-weight-bold text_15">
                  How to book an appointment with {{user.first_name}} {{user.last_name}}</span>
                  </a>
                  <div class="collapse" id="collapseExample">
                     <div class="card card-body custom_collapse p-2 pl-3">
                        <span class="text_14">
                        Call at 0345-0435621. You do not have to pay any extra fee for booking an appointment through DoctorFindy.
                     </span>
                     </div>
                  </div>
               </div>
               <div class="question_main border-bottom bg-white box-shadow mt-2">
                  <a data-toggle="collapse" class="collapsed faq_inner" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                  <span class="service-text font-weight-bold text_15">What is the Qualification of {{user.first_name}}
                  {{user.last_name}}?</span>
                  </a>
                  <div class="collapse" id="collapseExample1">
                     <div class="card card-body custom_collapse p-2 pl-3">
                        <span class="text_14">
                        {{user.first_name}} {{user.last_name}} has the following Qualification <span v-for="(edu, index) in education">{{ edu.degree_title }}{{ index === 0 ? '' : ',' }}
                        </span>
                     </span>
                     </div>
                  </div>
               </div>
               <div class="question_main border-bottom bg-white box-shadow mt-2">
                  <a data-toggle="collapse" class="collapsed faq_inner" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                  <span class="service-text font-weight-bold text_15">
                     What is {{user.first_name}} {{user.last_name}} speciality & area of expertise?
               </span>
                  </a>
                  <div class="collapse" id="collapseExample2">
                     <div class="card card-body custom_collapse p-2 pl-3">
                        <span class="text_14">
                        {{user.first_name}}
                        {{user.last_name}} is specialist in {{specialisties.join(", ")}}. His area of expertise include {{userServices.join(",")}}.
                     </span>
                     </div>
                  </div>
               </div>
               
               <div v-if="hospitals != '' && hospitals.length > 0 " class="question_main border-bottom bg-white box-shadow mt-2">
                  <a data-toggle="collapse" class="collapsed faq_inner" data-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample">
                  <span class="service-text font-weight-bold text_15">Practice timings of {{user.first_name}}
                  {{user.last_name}}:</span>
                  </a> 
                  <div class="collapse collapsed" id="collapseExample4">
                     <div class="card card-body custom_collapse p-2 pl-3">
                       <span class="text_14"> Hospital Name : {{hospitals[0].first_name+' '+hospitals[0].last_name}}
                         
                        Timming : {{dayName()}}
                     </span>
                     </div>
                  </div>
               </div>
            </div>
         <div  v-if="user.roles[0].role_type === 'hospital'">   
         <div class="question_main border-bottom bg-white box-shadow mt-2">
            <a data-toggle="collapse" class="collapsed faq_inner" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <span class="service-text font-weight-bold text_15">How can I book an appointment with a doctor in {{user.first_name}} {{user.last_name}}?</span>
            </a>
            <div class="collapse" id="collapseExample">
               <div class="card card-body custom_collapse p-2 pl-3">
                 <span class="text_14"><a :href="'/hospitals/'+user.location.slug+'/'+user.slug">Click here</a> to book an appointment online with a doctor or you can also call 0345-0435621 from 9 AM to 6 PM to book your appointment.</span>
               </div>
            </div>
         </div>
         <div class="question_main border-bottom bg-white box-shadow mt-2">
            <a data-toggle="collapse" class="collapsed faq_inner" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
            <span class="service-text font-weight-bold text_15">
            Who are the top 10 doctors in {{user.first_name}} {{user.last_name}}?</span>
            </a>
            <div class="collapse" id="collapseExample1">
               <div class="card card-body custom_collapse">
                  <span class="text_14">
                  Top 10 doctors in  {{user.first_name}} {{user.last_name}}, {{user.location.title}} are : 
               </span>
                  <span> 
                  <ul v-for="(doctor,index) in checkhospitalDoctors" v-if="index < 9">
                     <li v-if="doctor.specialities.length > 0">
                        <a :href="'/doctors/'+doctor.location.slug+'/'+doctor.specialities[0].slug+'/'+doctor.slug">{{doctor.first_name}} {{doctor.last_name}}</a>
                     </li>
                     <li v-else>
                        <a :href="'/profile/'+doctor.slug">{{doctor.first_name}} {{doctor.last_name}}</a>
                     </li>
                  </ul>
                  </span>
               </div>
            </div>
         </div>
         <div class="question_main border-bottom bg-white box-shadow mt-2">
            <a data-toggle="collapse" class="collapsed faq_inner" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
            <span class="service-text font-weight-bold text_15">What is the fee range of doctors in  {{user.first_name}} {{user.last_name}}?</span>
            </a>
            <div class="collapse" id="collapseExample2">
               <div class="card card-body custom_collapse p-2">
                  <span class="text_14">
                  The fee range of doctors consultation in {{user.first_name}} {{user.last_name}} ranges from Rs. 500-3000
               </span>
               </div>
            </div>
         </div>
         <div class="question_main border-bottom bg-white box-shadow mt-2">
            <a data-toggle="collapse" class="collapsed faq_inner" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
            <span class="service-text font-weight-bold text_15">What is the address of {{user.first_name}} {{user.last_name}}?</span>
            </a>
            <div class="collapse" id="collapseExample3">
               <div class="card card-body custom_collapse p-2">
                  <span class="text_14">
              {{user.first_name}} {{user.last_name}} located in {{ user.profile.address ? user.profile.address : '' }}
           </span>
               </div>
            </div>
         </div>
         <div class="question_main border-bottom bg-white box-shadow mt-2">
            <a data-toggle="collapse" class="collapsed faq_inner" data-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample">
            <span class="service-text font-weight-bold text_15">What is the Contact Number of {{user.first_name}} {{user.last_name}}?
            </span>
            </a> 
            <div class="collapse collapsed" id="collapseExample4">
               <div class="card card-body custom_collapse p-2">
                  <span class="text_14">
                  You can contact {{user.first_name}} {{user.last_name}} at 0345-0435621.
               </span>
               </div>
            </div>
         </div>
       </div>
       <div v-if="user.roles[0].role_type === 'laboratory'">
               <div class="question_main border-bottom bg-white box-shadow mt-2">
                  <a data-toggle="collapse" class="collapsed faq_inner" data-target="#lab-faq" aria-expanded="false" aria-controls="lab-faq">
                  <span class="service-text font-weight-bold text_15">How to book a Test at {{user.first_name}} {{user.last_name}}?</span>
                  </a>
                  <div class="collapse" id="lab-faq">
                     <div class="card card-body custom_collapse p-2">
                        <span class="text_14">
                        Call at 0345-0435621 or visit doctorfindy.com. You do not have to pay any extra fee for booking a Test through DoctorFindy.
                     </span>
                     </div>
                  </div>
               </div>
               <div class="question_main border-bottom bg-white box-shadow mt-2">
                  <a data-toggle="collapse" class="collapsed faq_inner" data-target="#lab-faq-1" aria-expanded="false" aria-controls="lab-faq-1">
                  <span class="service-text font-weight-bold text_15">How to get Discount on lab Tests at {{user.first_name}}
                  {{user.last_name}}?</span>
                  </a>
                  <div class="collapse" id="lab-faq-1">
                     <div class="card card-body custom_collapse p-2">
                        <span class="text_14">
                        To get discount You can Visit doctorfindy.com and get a discount coupen or you can also call at 0345-0435621.
                        </span>
                     </div>
                  </div>
               </div>
                
               <div class="question_main border-bottom bg-white box-shadow mt-2">
                  <a data-toggle="collapse" class="collapsed faq_inner" data-target="#lab-faq-2" aria-expanded="false" aria-controls="lab-faq-2">
                  <span class="service-text font-weight-bold text_15">What is {{user.first_name}}
                  {{user.last_name}} speciality & area of expertise?</span>
                  </a>
                  <div class="collapse" id="lab-faq-2">
                     <div class="card card-body custom_collapse p-2 pl-3">
                        <span class="text_14">
                        {{user.first_name}}
                        {{user.last_name}} is specialist in Radiology and Pathology.
                     </span>
                     </div>
                  </div>
               </div>
               <div class="question_main border-bottom bg-white box-shadow mt-2">
                  <a data-toggle="collapse" class="collapsed faq_inner" data-target="#lab-faq-3" aria-expanded="false" aria-controls="lab-faq-3">
                  <span class="service-text font-weight-bold text_15">What is the fee range of Tests at {{user.first_name}}
                  {{user.last_name}}?</span>
                  </a>
                  <div class="collapse" id="lab-faq-3">
                     <div class="card card-body custom_collapse p-2 pl-3">
                        <span class="text_14">
                        Fee range of {{user.first_name}} {{user.last_name}} is Rs 120-9000
                         
                        </span>
                     </div>
                  </div>
               </div>
               <div class="question_main border-bottom bg-white box-shadow mt-2">
                  <a data-toggle="collapse" class="collapsed faq_inner" data-target="#lab-faq-4" aria-expanded="false" aria-controls="lab-faq-4">
                  <span class="service-text font-weight-bold text_15">What are the Practice timings of {{user.first_name}}
                  {{user.last_name}}?</span>
                  </a> 
                  <div class="collapse collapsed" id="lab-faq-4">
                     <div class="card card-body custom_collapse p-2 pl-3">
                       <span class="text_14"> Practice timing of {{user.first_name}} {{user.last_name}} are 9:00 AM - 9:00 PM
                     </span>
                     </div>
                  </div>
               </div>
            </div>
         <!-- <div v-for="(faq, index) in faqs">
            <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider">
            </div>
            <div class="heading-box-under-collapse faq_accordian icon_color pt-0 pb-2 my-2 question_main">
                  <a class="text_black collapsed w-100 d-inline-block" data-toggle="collapse" :href="'#collapse-appointment-'+index" role="button" aria-expanded="false" aria-controls="collapseExample">
                  <span v-html="faq['question']" class="w-90 d-inline-block"></span>
                  </a>
               <div class="collapse":id="'collapse-appointment-'+index">
                  <div class="card card-body collapse-body p-0 text_15 work-color-text">
                     <span v-html="faq['answer']"></span>
                  </div>
               </div>
            </div>
         </div> -->
         <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
      </div>
   </div>
   </div>
</template>
<script>
   export default {
     name: "ProfileFaqsSectionComponent",
     props: ['user','fee','hospitals','services','hospitalDoctors'],
     data() {
       return {
         faqs: [],
         education:[],
         specialisties:[],
         userServices:[],
         checkhospitalDoctors:this.hospitalDoctors,
       }
     },
     created() {
       let self = this
      if(self.user.roles[0].name == 'doctor')
      { let specialisties = self.user.specialities
       self.education = JSON.parse(self.user.profile.educations)
             if(specialisties.length != 0
              ){
              specialisties.forEach(function (item) {
                self.specialisties.push(item.title)
              })
             }
             if(self.services.length != 0){
                self.services.forEach(function(item){
                  self.userServices.push(item.title)
                })
             }}
     },
     mounted()
     {
       if(this.checkhospitalDoctors.length < 4 && this.doctors != undefined || this.doctors != 'undefined')
       {
         this.getDoctorNamesFaq(this.user.id);
       }
     },
   methods: {
      getDoctorNamesFaq(id)
      {
         axios.get('/get-hospital-top-doctor-name/'+id)
         .then(response=>{
            this.checkhospitalDoctors=response.data;
         })
      },
     feesRange(fee) {
             let fees = JSON.parse(fee)
             return fees['from_fees'] + ' - ' + fees['to_fees']
       },
      dayName(){
         var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
         var d = new Date();
         var dayName = days[d.getDay()].toLowerCase();
         if(this.user.doc_teams[0].slots != null && this.user.doc_teams[0].slots != ""){
              if((JSON.parse(this.user.doc_teams[0].slots)[dayName]) != undefined && (JSON.parse(this.user.doc_teams[0].slots)[dayName]) != null){

                let start_end_time = ((JSON.parse(this.user.doc_teams[0].slots)[dayName]['start_end_time']));
                let start_end_time1 = ((JSON.parse(this.user.doc_teams[0].slots)[dayName]['start_end_time1']));
                  if(start_end_time1 != '')
                    return start_end_time+"\n"+start_end_time1;
                  else
                    return start_end_time ?? 'Not Available';
               }else{
                  return 'Not Available';
               }
              
               }

               return 'Not Available';
            }
   }
   }
   
</script>
<style scoped>
</style>