<template>
  <!-- <h1>{{roles}}</h1> -->
  <div>
    <div v-if="loading" id="loader"></div>
    <div class="bg-white box_radius box_shadow mt-2 mb-4">
      <div class="heading-box p-3 total-reviews" id="reviews_section">
        <div class="feedback-btn d-inline-block mt-2 w-100">
          <!-- <span v-if="roles.name === 'doctor'">
          <a href="javascript:void(0)" v-if="checkdoctor !== undefined" @click="showAddReview"  class="text-white knockdoc_sign_up_bg text_15 float-right small_btn" style="color: #fff !important;">Add Review</a>
          </span>
          <span v-if="roles.name === 'hospital'">
          <a href="javascript:void(0)" v-if="checkhospital !== undefined" @click="showAddReview"  class="text-white knockdoc_sign_up_bg text_15 float-right small_btn" style="color: #fff !important;">Add Review</a>
          </span> -->
          <!-- v-if="roles.name === 'laboratory'" -->
          <span>
          <a href="javascript:void(0)" v-if="checkhospital !== undefined" 
          @click="showAddReview"  class="text-white bg-blue text_15 float-right small_btn" style="color: #fff !important;">Add Review</a>
          </span>
        </div>
        <h6 class="font-weight-bold m-lg-0 mb-2 text_black">Patient reviews</h6>
        <div class="position-relative">
          <div class="text_14 text_black" >
            <p class="mb-lg-0 mb-2 d-inline-block w-xs-60 
            w-sm-65">
              <span class=" d-inline-block">All reviews have been submitted by patients after seeing the provider.
              </span>
            </p>
            <span class="reviews-number lab_review text_black font-weight-bold position-relative d-inline-block text-right w-md-30">{{ feedBacks.length }} {{ feedBacks.length > 1 ? ' Reviews ' : ' Review '}}
              <strong class="text-blue text_18 d-inline-block">{{ averageRating() }}</strong>
            </span>
          </div>
        </div>
        <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
        <div v-if="feedBacksToShow > index" v-for="(feedback, index) in feedBacks">
          <h6 class="font-weight-bold mt-2 text_black">
            <span class="float-left mr-2">{{ feedback.patient.first_name }} {{ feedback.patient.last_name }}</span>
            <a class="text-blue ml-2" href="javascript:void(0)">
              {{filterRating(feedback.rating, index)}}
              <star-rating
                  :max-rating="5"
                  :show-rating="false"
                  v-model="feedback.avg_rating"
                  :increment="feedback.avg_rating"
                  :rating="feedback.avg_rating"
                  inactive-color="#cccccc"
                  active-color="#0E4D92"
                  v-bind:star-size="14"
              ></star-rating>
              <span>{{ Math.round(feedback.avg_rating) }}</span>
            </a>
          </h6>
          <p class="text_14 w-90 text_black mb-2">
            {{feedback.comment}}
          </p>
          <span class="text_14 work-color-text mb-2 float-left">{{ feedback.created_at | formatDate }}</span>
          <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
        </div>
        <div class="feedback-btn d-inline-block mt-2 w-100">
          <a v-if="reviews > 0 && feedBacksToShow < reviews.length" href="javascript:void(0)" @click="feedBacksToShow += 50" class="more-reviews theme-color-text knockdoc_doctor_profile_btn rounded-pill text_15 d-inline-block small_btn">View more reviews</a>
          
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Toasted from 'vue-toasted';
import StarRating from 'vue-star-rating'

Vue.use(Toasted)

Vue.component('star-rating', StarRating);

Vue.use(Toasted)
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MMMM DD,YYYY')
  }
});
Vue.filter('fixDecimal', function(value) {
  if (value) {
    return parseFloat(value).toFixed(1)
  }
});
export default {
  name: "laboratoryReviewComponent",
  props: ['reviews', 'patient', 'user', 'type','roles'],
  data() {
    return {
      feedBacks: [],
      reviewForm: false,
      costRating: 0,
      waitRating: 0,
      environmentRating: 0,
      description: '',
      feedBacksToShow: 3,
      staffBehaviourRating: 0,
      checkupRating: 0,
      rating: 0.0,
      loading: false,
      likeDoctor: false,
      singleRating: [],
      checkdoctor: '',
      checkhospital: '',
    }
  },
  created () {
    if (this.user.appointments === undefined) {
  }
  else{
    this.checkdoctor = this.user.appointments.find(pf =>pf.patient_id === this.patient.id)
  }
    // this.checkhospital = this.user.appointments.find(pf =>pf.patient_id === this.patient.id)
    let self = this
    if (self.reviews) {
      self.reviews.forEach(function (feed){
        self.feedBacks.push(feed)
      })
    if (this.feedBacks > 0) {
      this.rating = parseFloat(((avgRating/parseFloat(this.feedBacks.length))/5).toFixed(1))
      this.satisfiedPatients =  (this.doctor.profile.votes  / this.feedBacks.length * 100).toFixed(1)
      let avgRating = 0.0
      this.feedBacks.forEach(function (feedback){
        avgRating += parseFloat(feedback.avg_rating)
      })
    }
    else {
      this.satisfiedPatients = 0
      this.rating = 0
    }
  }
  },
  methods:{
    filterRating(value, index) {
      value = JSON.parse(value)
      let rate = 0.0
      let keys = Object.keys(value)
      keys.forEach(function(x) {
        rate += value[x]
      })
      this.singleRating[index] = rate/25
    },
    averageRating() {
      let average = 0.0
      if (this.feedBacks.length > 0) {
        this.feedBacks.forEach(function (feedback) {
          average += parseFloat(feedback.avg_rating)
        })
        return (average / this.feedBacks.length).toFixed(1)
      }
      else {
        return '0'
      }

    },
    showAddReview(e) {
      this.loading = true
      if (this.patient.length === 0) {
        Vue.toasted.show('Please Login First' , { duration: 3000 })
      }
      else {
         if (e === false) {
          this.reviewForm = false
        document.querySelector('body').classList.remove('scroll')
        document.querySelector('#add-feedback-modal').classList.remove('feedback_modle')
        document.querySelector('#add-feedback-modal').style.display = 'none'
         }
         else{
        this.reviewForm = true
          document.querySelector('body').classList.add('scroll')
          document.querySelector('#add-feedback-modal').classList.add('feedback_modle')
          document.querySelector('#add-feedback-modal').style.display = 'block'
        }
      }
      this.loading = false
    },
    addFeedBack() {
      let self = this;
      self.loading = true
      if (
          self.description === '' ||
          self.costRating === 0 ||
          self.waitRating === 0 ||
          self.environmentRating === 0
      ) {
        self.loading = false
        Vue.toasted.show('All Fields are compulsory' , { duration: 3000 })
        return false
      }


      axios.post(APP_URL + '/submit-feedback', {
        comments: self.description,
        waiting_time: 0,
        feedbackpublicly: 'off',
        costRating: self.costRating,
        waitRating: self.waitRating,
        environmentRating: self.environmentRating,
        staffBehaviourRating: self.staffBehaviourRating,
        checkupRating: self.checkupRating,
        vote: self.likeDoctor,
        user_id: self.user.id,
        type: self.type,
      }).then(function (response) {
        if (response.data.type === 'success') {
          self.loading = false
          Vue.toasted.success(response.data.message , { duration: 3000 })
          document.querySelector('body').classList.remove('scroll')
          document.querySelector('#add-feedback-modal').classList.remove('show')
          document.querySelector('#add-feedback-modal').style.display = 'none'
        }
        else {
          self.loading = false
          Vue.toasted.error(response.data.message , { duration: 3000 })
        }
      }).catch(function (error) {
        Vue.toasted.error(error , { duration: 3000 })
      });
    },
  }
}
</script>

<style>
.lab_review {
    width: 58% !important;
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
.vue-star-rating{
  display: block !important;
  margin-right: 0px !important;
}
.scroll{
  overflow: hidden;
}
</style>