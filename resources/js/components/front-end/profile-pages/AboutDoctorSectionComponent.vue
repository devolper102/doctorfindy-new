<template>
  <div>
    <div id="introduction-lab-content" class="mt-3 d-inline-block w-100 p-3 mb-lg-3 bg-white box-shadow box_radius">
      <div class="heading-box lab-introduction">
        <h2 class="font-weight-bold m-0 text-blue mb-3 text_25 text-xs-22">
          About {{ user.first_name }} {{ user.last_name }}
        </h2>
         <div v-if="user.profile.description == ''">
          {{ user.first_name }} {{ user.last_name }} is one of the best <span v-if="user.speciality[0] && user.speciality[0] !== null && user.speciality[0] !== ''">{{user.speciality[0].title }}</span> in <span v-if="user.location.title && user.location.title !== null && user.location.title !== ''">{{ user.location.title }}</span>.<span v-if="educations && educations !== null && educations!== ''"><span v-if="educations[0] && educations[0] !== null && educations[0]!== ''"> He/She has completed his/her {{educations[0].job_desc}}.</span><span v-if="educations[1] && educations[1] !== null && educations[1]!== ''"> He/She did his/her {{educations[1].job_desc}}.</span><span v-if="educations[2] && educations[2] !== null && educations[2]!== ''"> He/She also did  {{educations[2].job_desc}}.</span> He/She is expert in the latest 
            advances in the field of <span v-if="user.speciality[0] && user.speciality[0] !== null && user.speciality[0] !== ''">{{user.speciality[0].title }}</span>.<span v-if="educations[3] && educations[3] !== null && educations[3]!== ''">He/She did {{educations[3].job_desc}}.</span><span v-if="educations[4] && educations[4] !== null && educations[4]!== ''">He/She is also {{educations[4].job_desc}}.</span></span><span v-if="experiences && experiences !== null && experiences!== ''"><span v-if="experiences[0] && experiences[0] !== null && experiences[0]!== ''"> He/She is currently working in {{experiences[0].job_desc}}.</span><span v-if="experiences[1] && experiences[1] !== null && experiences[1]!== ''"> He/She is also working in {{experiences[1].job_desc}}.</span></span> He/She has more than <span v-if="user.profile.total_experience && user.profile.total_experience!== '' && user.profile.total_experience!== null">{{ user.profile.total_experience }}</span> of experience in the field of 
            <span v-if="user.speciality[0] && user.speciality[0] !== null && user.speciality[0] !== ''">{{user.speciality[0].title }}</span>.<span v-if="experiences && experiences !== null && experiences!== ''"><span v-if="experiences[2] && experiences[2] !== null && experiences[2]!== ''"> He/She is  working in {{experiences[2].job_desc}},</span> and <span v-if="experiences[3] && experiences[3] !== null && experiences[3]!== ''"> He/She is also working in {{experiences[3].job_desc}}.</span></span>
            He/She is a great listener and gives full attention to his/her patients. He/She is good at diagnosing the exact 
            diseases and its causative agent and giving the effective treatment plan. <span v-if="diseases && diseases !== null && diseases!== ''">His/Her area of interest 
            includes <span v-if="diseases[0] && diseases[0] !== null && diseases[0]!== ''">{{ diseases[0].title}},</span><span v-if="diseases[1] && diseases[1] !== null && diseases[1]!== ''">{{ diseases[1].title}},</span> <span v-if="diseases[2] && diseases[2] !== null && diseases[2]!== ''">{{ diseases[2].title}},</span> <span v-if="diseases[3] && diseases[3] !== null && diseases[3]!== ''">{{ diseases[3].title}},</span> <span v-if="diseases[4] && diseases[4] !== null && diseases[4]!== ''">{{ diseases[4].title}},</span> <span v-if="diseases[5] && diseases[5] !== null && diseases[5]!== ''">{{ diseases[5].title}},</span> <span v-if="diseases[6] && diseases[6] !== null && diseases[6]!== ''">{{ diseases[6].title}},</span> <span v-if="diseases[7] && diseases[7] !== null && diseases[7]!== ''">{{ diseases[7].title}},</span> <span v-if="diseases[8] && diseases[8] !== null && diseases[8]!== ''">{{ diseases[8].title}},</span> <span v-if="diseases[9] && diseases[9] !== null && diseases[9]!== ''">{{ diseases[9].title}}.</span><span v-if="diseases[10] && diseases[10] !== null && diseases[10]!== ''">{{ diseases[10].title}}.</span></span><span v-if="services && services !== null && services !== ''"><span v-if="services[0] && services[0] !== null && services[0]!== ''"> He/She is expert in dealing with procedures such as {{ services[0].title}},</span> <span v-if="services[1] && services[1] !== null && services[1]!== ''">{{ services[1].title}},</span> <span v-if="services[2] && services[2] !== null && services[2]!== ''">{{ services[2].title}},</span> and <span v-if="services[3] && services[3] !== null && services[3]!== ''">{{ services[3].title}}.</span></span>
            <span v-if="user.doc_teams[0] && user.doc_teams[0] !== null && user.doc_teams[0] !== ''"> <span v-if="user.doc_teams[0].hospital && user.doc_teams[0].hospital !== null && user.doc_teams[0].hospital !== ''">{{ user.first_name }} {{ user.last_name }} is available at <span v-if="user.doc_teams[0].hospital.first_name && user.doc_teams[0].hospital.first_name !== null && user.doc_teams[0].hospital.first_name !== ''">{{ user.doc_teams[0].hospital.first_name }}</span><span v-if="user.doc_teams[0].hospital.last_name && user.doc_teams[0].hospital.last_name !== null && user.doc_teams[0].hospital.last_name !== ''">{{ user.doc_teams[0].hospital.last_name }},</span></span> <span v-if="user.doc_teams[0].hospital.location_id && user.doc_teams[0].hospital.location_id == user.location.id">{{user.location.title}}.</span></span> He/She is also giving his/her consultations online at doctorfindy.com. He/She has a patient 
            satisfaction score of about 90% and his/her clinic average waiting time is 15 minutes. His/Her patients 
            always give positive feedback about Him/Her. You can read these reviews on his/her profile for your 
            mental satisfaction.<span v-if="user.profile.fees_range && user.profile.fees_range !== '' && user.profile.fees_range!== null">He/She charges Rupees {{ user.profile.fees_range }} for an appointment.</span> You can easily catch Him/Her 
            online or book an appointment on our website doctorfindy.com. For appointment booking, go to our
            websites http://www.doctorfindy.com or call us at 0345-0435621.
         </div>
         <div v-else v-html="user.profile.description"></div>
           
         </div>
        </div>
      </div>
    </div>
</template>
 
<script>
export default {
  name: "AboutDoctorSectionComponent",
  props: ['user'],
  data() {
    return {
      experiences:[],
      educations:[]
    }
  },
  created () {
    if(this.user.roles[0].name == 'doctor')
      {
    this.educations = JSON.parse(this.user.profile.educations);
    this.experiences = JSON.parse(this.user.profile.experiences);
  }
  }
}
</script>

<style>

.lab-introduction p a{
color: #0E4D92;
font-weight:bold;
}

</style>