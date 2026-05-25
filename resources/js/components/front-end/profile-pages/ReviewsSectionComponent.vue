<template>
  <div>
    <div v-if="loading" id="loader"></div>
    <div class="w-100 d-inline-block">
      <div class="heading-box total-reviews" 
      id="reviews_section">
        <h2 class="font-weight-bold m-lg-0 mb-2 text_black text_16">{{user.first_name}} {{user.last_name}} Reviews
        </h2>
        <div class="position-relative">
          <div class="text_14 text_black" >
            <p class="mb-lg-0 mb-2 d-inline-block w-xs-60 
            w-sm-65">
              <span class=" d-inline-block">All reviews have been submitted by patients after seeing the provider.
              </span>
            </p>
            <span class="reviews-number text_black position-relative d-inline-block text-right w-md-30">{{ feedBacks.length }} {{ feedBacks.length > 1 ? ' Reviews ' : ' Review '}}
              <strong class="text-blue text_18 d-inline-block">{{ averageRating() }}</strong>
            </span>
          </div>
        </div>
        <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
        <div class="review-main w-100 d-inline-block p-3 bg-white box-shadow box_radius mb-3">
        <div class="row">
          <!-- <div class="col-1 pr-lg-0">
            <div class="patient-image w-100 d-inline-block mt-2">
               <img class="d-inline-block rounded-pill w_60px h_60" 
               src="/images/patient-image.jpg" alt="pictire">
            </div>
          </div> -->
          <div class="col-12">
            <div class="w-100 d-inline-block" v-if="feedBacksToShow > index" v-for="(feedback, index) in feedBacks">
            <h6 class="font-weight-bold mt-2 text_black">
            <span class="float-left mr-2">{{ feedback.patient.first_name }} {{ feedback.patient.last_name }}</span>
            <a class="theme-color-text ml-2" href="javascript:void(0)">
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
              <span class="text-blue">
              {{ Math.round(feedback.avg_rating) }}</span>
            </a>
          </h6>
          <p class="text_14 w-100 d-inline-block text_black 
          mt-2">
            {{feedback.comment}}
          </p>
          <span class="text_14 work-color-text mb-2 float-left w-100 d-inline-block mt-2">{{formatDate(feedback.created_at) }}</span>
          <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
        </div>
          </div>
        </div>
          <div class="feedback-btn d-inline-block mt-2 w-50 float-left">
          <a v-if="reviews.length > 0 && feedBacksToShow < reviews.length" href="javascript:void(0)" @click="feedBacksToShow += 50" class="more-reviews text-blue book-border rounded-pill text_14 d-inline-block small_btn">
          View more reviews</a>
        </div>
        <div class="feedback-btn d-inline-block mt-2 w-50">
          <span v-if="user.roles[0].name === 'doctor'">
          <a href="javascript:void(0)" v-if="checkdoctor !== undefined" @click="showAddReview"  class="text-white bg-green text_14 float-right small_btn book-rounded d-inline-block">Add Review</a>
          </span>
          <span v-if="user.roles[0].name === 'hospital'">
          <a href="javascript:void(0)" v-if="checkhospital !== undefined" @click="showAddReview"  class="text-white bg-green text_14 float-right small_btn book-rounded d-inline-block">Add Review</a>
          </span>
          <span v-if="user.roles[0].name === 'laboratory'">
          <a href="javascript:void(0)" v-if="checkhospital !== undefined" @click="showAddReview"  class="text-white bg-green text_14 float-right small_btn book-rounded d-inline-block">Add Review</a>
          </span>
        </div>
        </div>
      </div>
    </div>
    <!-- Start feedback Modal -->
    <div id="add-feedback-modal" tabindex="-1" role="dialog" aria-labelledby="mobile_number_detail" aria-hidden="true">
      <div class="modal-dialog w-35 procedure-popup" role="document" v-if="reviewForm">
        <div class="modal-content box_radius box-shadow">
          <div class="modal-header border-0 p-0">
            <div class="container-fluid">
            <div class=" w-100 d-inline-block box_radius box_bottom_lr_radius position-relative modal_bg p-2">
              <button type="button" class="close" v-on:click="showAddReview(false)" aria-label="Close">
                <span aria-hidden="true" style="padding:10px 10px 0 0;display: inline-block;">&times;</span>
              </button>
              <div class="container">
                <div class="row">
                  <div class="col-md-3 p-0 ">
                    <div class="patient-feedback-image w-80 float-left" v-if="user.profile">
                      <img v-lazy="basePath+'/uploads/users/'+user.id+'/'+user.profile.avatar" :alt="user.first_name + ' ' + user.last_name" :name="user.first_name + ' ' + patient.last_name" class="img-fluid rounded-circle h_80 w_80px">
                    </div>
                  </div>
                  <div class="col-md-9 pl-0 pr-2 pt-3 pb-3">
                    <div class="prfile_detail">
                      <p class="font-weight-bold text_black"> {{ user.first_name }} {{ user.last_name }} </p>
                      <div class="doctor_degree
										text_black">
                        <span class="text_13 text_black"> {{ user.first_name }} {{ user.last_name }} , , {{ user.location_id ? user.location.title : '' }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
          <div class="modal-body pt-0 pr-4 pb-4 pl-4 modal_bg">
            <div class="w-100 d-inline-block">
              <a href="javascript:void(0)" @click="likeDoctor = !likeDoctor" :class="!likeDoctor ? ' dislike_btn ' : '' " class="badge bg-blue text-white text_md_13 text_15 float-right"> 
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
              </a>
            </div>
            <ul class="patient-cost lab_reviews w-60">
              <li class="mb-3">
                <a class="text_black font-weight-bold
			      				text_14" href="javascript:void(0)">
                  <span class="rating_title">Cost</span>
                  <span class="float-right color-date">
                    <star-rating
                        v-model="costRating"
                        inactive-color="#cccccc"
                        active-color="#0E4D92"
                        v-bind:star-size="14"></star-rating>
                  </span>
                </a>
              </li>
              <li class=" mb-3">
                <a class="text_black font-weight-bold
			      				text_14" href="javascript:void(0)">
                  <span class="rating_title">Wait</span>
                  <span class="float-right color-date">
                    <star-rating
                        v-model="waitRating"
                        inactive-color="#cccccc"
                        active-color="#0E4D92"
                        v-bind:star-size="14"></star-rating>
                  </span>
                </a>
              </li>
              <li class="mb-3">
                <a class="text_black font-weight-bold text_14" href="javascript:void(0)">
                  <span class="rating_title">Environment</span>
                  <span class="float-right color-date">
                    <star-rating
                        v-model="environmentRating"
                        inactive-color="#cccccc"
                        active-color="#0E4D92"
                        v-bind:star-size="14"></star-rating>
                  </span>
                </a>
              </li>
              <li class="mb-3">
                <a class="text_black font-weight-bold text_14" href="javascript:void(0)">
                  <span class="rating_title">Staff Behaviour</span>
                  <span class="float-right color-date">
                    <star-rating
                        v-model="staffBehaviourRating"
                        inactive-color="#cccccc"
                        active-color="#0E4D92"
                        v-bind:star-size="14"></star-rating>
                  </span>
                </a>
              </li>
              <li>
                <a class="text_black font-weight-bold text_14" href="javascript:void(0)">
                  <span class="rating_title">Doctor Checkup</span>
                  <span class="float-right color-date">
                    <star-rating
                        v-model="checkupRating"
                        inactive-color="#cccccc"
                        active-color="#0E4D92"
                        v-bind:star-size="14"></star-rating>
                  </span>
                </a>
              </li>
            </ul>
            <form>
              <div class="form-group patient-reviews-feedback">
                <label class="text_14 text_black font-weight-bold">Review
                </label>
                <textarea v-model="description" class="form-control text_14" rows="8" id="feedback" placeholder="Type......."></textarea>
              </div>
            </form>
            <div class="modal-footer border-0 pb-0 pl-0 pr-0">
              <div class="modal_footer_btn w-100 d-inline-flex m-0">
                <a href="javascript:void(0)" @click="addFeedBack" class="bg-blue rounded-pill w-100 text-white p-2 text-center number_modal font-weight-bold">Submit</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End feedback Modal -->

  </div>
</template>

<script>
import Toasted from 'vue-toasted';
import StarRating from 'vue-star-rating'

Vue.use(Toasted)

Vue.component('star-rating', StarRating);

Vue.use(Toasted)

Vue.filter('fixDecimal', function(value) {
  if (value) {
    return parseFloat(value).toFixed(1)
  }
});
export default {
  name: "ReviewsSectionComponent",
  props: ['reviews', 'patient', 'user', 'type', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
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
    self.reviews.forEach(function (feed){
      self.feedBacks.push(feed)
    })
  },
  mounted()
  {
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
      var id = this.user.id;
      var self=this;
      setTimeout(function(){
        self.getAllLabFeedBacks(id);
      },6000);
  },
  methods:{
    getAllLabFeedBacks(id)
    {
      axios.get('/get-lab-profile-page-all-feedbacks/'+id)
      .then((response)=>{
          this.feedBacks = response.data.feedbacks;

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

      });
    },
    formatDate(date) {
   return moment.utc(date).format('DD/MM/YYYY')
},
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