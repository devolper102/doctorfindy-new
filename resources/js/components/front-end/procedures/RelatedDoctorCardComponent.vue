<template>
  <div>
    <div class="suggest-doctor bg-white w-100 d-inline-block p-2 box_shadow mb-lg-0 mb-3">
      <div class="doctor_image position-relative float-left w-20 w-xs-25 w-sm-30">
        <div class="position-relative mb-2">
          <span class="video-cam-icon bg-blue d-inline-block position-absolute text-white surgery-video-icon">
            <!-- <img src="/images/video-cam-icon.svg" alt="pictire"> -->
            <i class="fas fa-video text_12" aria-hidden="true"></i>
          </span>
          <img v-if="doctor.profile.avatar" v-lazy="basePath+'/uploads/users/'+doctor.id+'/'+doctor.profile.avatar" :alt="doctor.first_name + ' ' + doctor.last_name" :name="doctor.first_name + ' ' + doctor.last_name"class="img-fluid rounded-circle h_60 w_60px h_md_60">
          <img v-else v-lazy="basePath+'/uploads/users/default/doctor.svg'" :alt="doctor.first_name + ' ' + doctor.last_name" :name="doctor.first_name + ' ' + doctor.last_name"class="img-fluid rounded-circle h_50 w_60px">
          <a :href="'/doctors/'+doctor.location.slug+'/'+doctor.specialities[0].slug+'/'+doctor.slug" class="circle_anchor position-absolute mb-2"></a>
        </div>
       <!--  <div class="total_rating w-80 m-auto mt-2 mb-2">
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
</template>

<script>
import StarRating from 'vue-star-rating'

Vue.component('star-rating', StarRating);

export default {
  name: 'RelatedDoctorCardComponent',
  props: ['doctor', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      satisfiedPatients: 0,
      rating: 0.0,
      userRating: 0.0,
    }
  },
  mounted(){
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  created () {
    this.satisfiedPatients =  (this.doctor.profile.votes  / this.doctor.feedbacks.length * 100).toFixed(1)
    let avgRating = 0.0
    this.doctor.feedbacks.forEach(function (feedback){
      avgRating += parseFloat(feedback.avg_rating)
    })
    this.rating = this.doctor.feedbacks.length > 0 ? parseFloat(((avgRating/parseFloat(this.doctor.feedbacks.length))/5).toFixed(1)) : 0
  },
  methods: {
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
  }
}
</script>

<style scoped>
.vue-star-rating{
  margin-top: -2px;
}

</style>