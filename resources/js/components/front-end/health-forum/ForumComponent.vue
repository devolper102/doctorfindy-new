<template>
  <div>

    <!-- Start section popular question button -->
    <nav-section></nav-section>
    <!-- End section  popular question button  -->

    <!-- Start section  explore question tags  -->
    <tags-section
        :allspecialities="allspecialities"
    ></tags-section>
    <!-- End section  explore question tags  -->

    <!-- Start section  patient name  and doctor consultent -->
    <section class="patient-doctor-consultent">
      <div class="container">
        <div class="row mt-4">
          <div class="col-lg-8 col-xs-12 col-md-12">
            <form>
              <div class="form-group input-doctor-onboard w-100 bg-white rounded-pill float-left dropdown position-relative">
                <input v-model="search" type="text" class="form-control text_14 rounded-pill border-0 h_45 btn dropdown-toggle text-left box_shadow w-70 w-xs-100 mb-lg-0 mb-4 w-sm-100 w-md-100" data-toggle="dropdown" aria-describedby="emailHelp" placeholder="Search Question...." aria-expanded="false">
                  <a class="text_black position-absolute" 
                  href="/ask-a-doctor-online">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </a>
              </div>

            </form>
            <div v-for="question in filteredList" class="bg-white box_radius box_shadow patient-doctor-box w-100 d-inline-block mb-4 mt-xs-4">
              <div class="patient-date pr-5 pt-2 w-100 d-inline-block">
                <span class="text_black text_14 float-right"> {{ question.created_at | formatDate }}</span>
              </div>
              <div class="patient-image-heading w-100 d-inline-block pl-lg-5 pr-lg-5 p-2" :id="question.slug">
                <div class="patient-image w-10 w-xs-25 float-left w-sm-25 text-sm-center w-md-25">
                  <img class="w-40px h_40 rounded-pill" v-lazy="'/uploads/users/'+question.questioner[0].id+'/'+question.questioner[0].profile.avatar" alt="banner-1 picture">
                </div>
                <div class="patient-image-content w-75 float-left">
                  <h6 class="font-weight-bold m-0 text_black text_14">
                    {{ question.questioner[0].first_name }} {{ question.questioner[0].last_name }}
                  </h6>
                   <h6 class="text_black">
                    {{ question.question_title }}
                  </h6>
                  <span class="text_black text_12 font-weight-bold">
                    {{ question.question_description }}
                  </span>
                 
                </div>
              </div>
              <div v-for="answer in question.answers" class="doctor-profile-image-and-detail pl-lg-5 pr-lg-5 p-2">
                <div class="bg-doctor-consultent w-100 d-inline-block mt-2 p-2 mb-2">
                  <div class="doctor-profile w-100 d-inline-block">
                    <div class="doctor-image w-5 w-xs-25 float-left pl-lg-2 pl-0 w-sm-25 text-sm-center w-md-25">
                      <img class="w-40px h_40 rounded-pill
                      " v-lazy="'/uploads/users/'+answer.id+'/'+answer.profile.avatar" :alt="answer.first_name +' '+ answer.last_name">
                    </div>
                    <div class="doctor-profile-detail w-75 float-left ml-lg-2 w-xs-65">
                      <p class="theme-color-text text_14">{{ answer.first_name }} {{ answer.last_name }}</p>
                      <span class="color-date text_12">{{ answer.created_at | formatDateAnswer}}
                      </span>
                      <p class="text_black text_13 mt-3">
                      {{answer.pivot.answer}}
                    </p>
                    </div>
                  </div>
                 <!--  <div class="doctor-feedback w-100 d-inline-block pb-2">
                    <p class="text_black text_13 pl-5 ml-2">
                      {{answer.pivot.answer}}
                    </p>
                  </div> -->
                </div>
              </div>
              <ul class="shares-icon-2 d-inline-block w-100 mb-0 pl-lg-5 pr-lg-5 pt-lg-2 pb-lg-2 pt-2 pb-2 pl-4 pr-2">
                <li class="float-left mr-lg-5 mr-3 mr-sm-5">
                  <a :class="patient ? question.liked !== null ? question.liked.includes(patient.id) ? ' liked ' : '' : '' : ''" class="color-date text_14 text-xs-12" :id="'q-'+question.id" @click="likeQuestion(question.id)"><i class="fa fa-heart text_15" aria-hidden="true"></i>
                    <span v-if="question.liked !== null" class="font-weight-bold"> {{ (JSON.parse(question.liked)).length }}</span>
                    Likes
                  </a>
                </li>
                <li class="float-left mr-lg-5 mr-3 mr-sm-4">
                  <a class="color-date text_14 text-xs-12"><i class="fa fa-comment text_15" aria-hidden="true"></i>
                    <span class="font-weight-bold"> {{ question.comments.length }}</span> Comment </a>
                </li>
                <li class="float-left mr-lg-5 mr-sm-4">
                  <a class="color-date text_14 text-xs-12">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    <span class="font-weight-bold">{{ question.views }}</span>Views</a>
                </li>
                <span v-if="logged_user === null || logged_user === 'null' || logged_user === '' || logged_user === 'undefined' || logged_user === undefined"></span>
                <span v-else>
                <li class="float-lg-right float-left mt-lg-0 mt-3 mt-sm-0 w-xs-100 w-md-25" v-if="logged_user.roles[0].role_type === 'doctor'">
                  <a @click="showAnswerModal(question.id)" class="text_14 knockdoc_btn_bg text-white pt-2 pb-2 pl-3 pr-3 text-xs-12 rounded-pill d-inline-block w-xs-100 text-xs-center w-md-100 text-md-center text-sm-center">Answer</a>
                </li>
                </span>
              </ul>
              <div v-for="comment in question.comments" class="doctor-profile-image-and-detail patient-image pl-5 pr-5 pl-xs-1 pr-xs-1">
                <div class="bg-doctor-consultent w-100 d-inline-block mt-2 p-2 mb-2">
                  <div class="patient-image-heading w-100	d-inline-block pl-3 pr-3 pl-xs-2 pr-xs-0">
                    <div class="patient-image w-10 float-left">
                      <img class="w_40px h_40" v-lazy="'/uploads/users/'+comment.id+'/'+comment.profile.avatar" :alt="comment.first_name +' '+ comment.last_name">
                    </div>
                    <div class="patient-image-content w-75 float-left">
                      <h6 class="font-weight-bold m-0 text_black text_14">
                        {{ comment.first_name }} {{ comment.last_name }}
                      </h6>
                      <span class="text_black text_12">
                        {{ comment.pivot.answer }}
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-inline-block w-100 pl-lg-5 pr-lg-5 p-2">
                <div class="w-100 d-inline-block mt-2 p-2 mb-2">
                  <div class="patient-image-heading w-100 d-inline-block">
                    <div class="commented-patient-image w-10 float-left w-xs-20">
                      <img class="w-40px h_40 rounded-circle" src="/images/banner-1.png" alt="banner-1 picture">
                    </div>
                    <div class="patient-image-content w-75 float-left w-sm-80">
                      <textarea rows="4" v-model="comment[question.id]" class="form-control" type="text" name="text" placeholder="leave a comment ...">
                        
                      </textarea>
                    </div>
                    <div class="float-lg-right mt-lg-0 mt-3 w-xs-100 mt-md-0 mt-sm-0">
                      <button @click="submitComment(question.id, comment[question.id], question.speciality_id)" class="rounded-pill knockdoc_btn_bg text-white  pt-2 pb-2 pl-3 pr-3 border-0 text_black d-inline-block w-xs-100 mt-lg-0 mt-3 mt-md-0 ml-md-3 ml-sm-3 mt-sm-3"> Submit 
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <span v-if="filteredList.length === 0">No Result Found...</span>
          </div>
          <div class="col-lg-4 col-xs-12">
            <user-info></user-info>
            <top-user></top-user>
            <related-forum
                :forums="allQuestion"
            ></related-forum>
          </div>
        </div>
      </div>
    </section>
    <!-- End section   -->
    <answer></answer>

    <!-- Start button ask question modal -->
    <ask-question></ask-question>
    <!-- End  button ask question modal -->
    <!--Answering Modal Start -->
    <!--Answering Modal End -->


  </div>
</template>

<script>
import Toasted from 'vue-toasted';

Vue.use(Toasted)

Vue.filter('formatDateAnswer', function(value) {
  if (value) {
    return moment(String(value)).format('HH:mm:ss MMMM DD,YYYY ')
  }
});
export default {
  name: "ForumComponent",
  props: ['questions', 'specialities', 'patient', 'allQuestion','logged_user'],
  data() {
    return {
      forums: this.questions,
      search: '',
      specialty: '',
      question: '',
      title: '',
      show: false,
      showAnswer: false,
      contributors: [],
      quesLength: this.questions.length,
      answersLength: 0,
      answer: '',
      qid: '',
      comment: [],
      allspecialities: this.specialities,
    }
  },
async  created () {
  console.log('logged_user',this.logged_user)
    let self = this
    let answersLength = 0
    this.forums.forEach(function (ques) {
      answersLength += ques.answers.length
      ques.questioner.forEach(function (forum) {
        let id = forum.id
        if (!self.contributors.find(x => x.id === JSON.parse(id))) {
          self.contributors.push(forum)
        }
      })
    })
    self.answersLength = answersLength
     const specs = await axios.get('/get-all-specialities-health-forum')
    this.allspecialities = Object.freeze(specs.data)
  },
  computed: {
    filteredList() {
      return this.forums.filter(post => {
        return post.question_description.toLowerCase().includes(this.search.toLowerCase())
      })
    }
  },
  methods: {
    showQuestionModal() {
      let self = this
      if (self.patient.length === 0) {
        Vue.toasted.show('You are not logged in' , { duration: 3000 })
        return
      }
      self.show = self.patient.length !== 0;
      document.querySelector('#question-modal').style.display = 'block'
      document.querySelector('#question-modal').classList.add('show')
      document.querySelector('#question-modal').classList.add('fade')
      document.querySelector('#question-modal').classList.add('abc')
    },

    showAnswerModal(id) {
      let self = this
      self.qid = id
      self.showAnswer = self.patient.length !== 0;
      
      if (self.patient.length === 0) {
        Vue.toasted.show('You are not logged in' , { duration: 3000 })
      }
      else{
        document.querySelector('#answer-modal').style.display = 'block'
      }
    },
    hideQuestionModal() {
      document.querySelector('#question-modal').style.display = 'none'
      this.show = false

    },
    hideAnswerModal() {
      document.querySelector('#answer-modal').style.display = 'none'
      this.showAnswer = false
    },
    submitQuestion() {
      let self = this
      if (self.title === '' || self.question === '' || self.specialty === '') {
        Vue.toasted.error('Fill all fields' , { duration: 3000 })
        return false
      }
      axios.post(APP_URL + '/health-forum/post-question',
        {
          speciality_id: self.specialty,
          question_description: self.question,
          question_title: self.title,
        })
        .then(function (response) {
          if (response.data.type === 'success') {
            self.forums = response.data.forums
            Vue.toasted.success(response.data.message , { duration: 3000 })
            self.specialty = ''
            self.question = ''
            self.title = ''
            document.querySelector('#question-modal').style.display = 'none'
            document.querySelector('#question-modal').classList.remove('show')
            document.querySelector('#question-modal').classList.remove('fade')
            document.querySelector('#question-modal').classList.remove('abc')
            self.show = !self.show
          } else {
            Vue.toasted.error(response.data.message , { duration: 3000 })
          }
        })
        .catch(function (error) {

        });
    },
    submitAnswer() {
      let self = this
      if (self.answer === '') {
        Vue.toasted.error('Fill all fields' , { duration: 3000 })
        return false
      }
      axios.post(APP_URL + '/health-forum/post-answer',
          {
            forum_answer: self.answer,
            forum_id: self.qid,
          })
          .then(function (response) {
            if (response.data.type === 'success') {
              self.forums = response.data.forums
              Vue.toasted.success(response.data.message , { duration: 3000 })
              self.answer = ''
              document.querySelector('#answer-modal').style.display = 'none'
              self.show = !self.show
            } else {
              Vue.toasted.error(response.data.message , { duration: 3000 })
            }

          })
          .catch(function (error) {
            Vue.toasted.error(error , { duration: 3000 })
          });
    },
    submitComment(id, comment, specialty_id) {
      let self = this
      if (self.patient.length === 0) {
        Vue.toasted.show('You are not logged in' , { duration: 3000 })
      }
      else if (comment === undefined) {
        Vue.toasted.error('Add some comment' , { duration: 3000 })
        return false
      }

      axios.post(APP_URL + '/health-forum/post-comment',
        {
          speciality_id: specialty_id,
          forum_answer: comment,
          forum_id: id,
        })
        .then(function (response) {
          if (response.data.type === 'success') {
            Vue.toasted.success(response.data.message , { duration: 3000 })

            self.comment = []
            self.forums = response.data.forums
          } else {
            Vue.toasted.error(response.data.message , { duration: 3000 })
          }
        })
        .catch(function (error) {
          Vue.toasted.error(error , { duration: 3000 })
        });
    },
    filterBySpec(specialty) {
      this.forums = this.questions.filter(ques => ques.speciality_id === specialty.id)
    },
    sortByPopularQuestions() {
      return this.forums.sort(function (a, b) {
        {

          if (a['views'] < b['views']) return -1
          if (a['views'] > b['views']) return  1
          return 0
        }
      })
    },
    sortByNewQuestions() {
      return this.forums.sort(function (a, b) {
        {
          if (a.created_at < b.created_at) return -1
          if (a.created_at > b.created_at) return  1
          return 0
        }
      })
    },
    sortByUnansweredQuestions() {
      return this.forums.filter(x => x.answers.length === 0)

    },
    likeQuestion(id) {
      let self = this
      if (self.patient.length === 0) {
        Vue.toasted.show('You are not logged in' , { duration: 3000 })
        return
      }
      axios.post(APP_URL + '/health-forum/post-like', {
        id: id,
        speciality_id: self.specialty,
        patient: self.patient
      })
        .then(function (response) {
          if (response.data.type === 'success') {
            document.querySelector('#q-'+id).classList.add('liked')
            Vue.toasted.success(response.data.message , { duration: 3000 })
          }
          else if (response.data.type === 'remove') {
            document.querySelector('#q-'+id).classList.remove('liked')
            Vue.toasted.show(response.data.message , { duration: 3000 })
          } else {
            Vue.toasted.error(response.data.message , { duration: 3000 })

          }
        })
    }

  },

}
</script>

<style>


</style>