<template>
  <div>
    <!--   <div class="container">
      <div class="row">
            <div class="col-12 mt-4">
              <bread-crumb-spec></bread-crumb-spec>
            </div>
      </div>
    </div> -->
    <section class="doctor-following-profile">
      <div class="container">
        <div class="row mb-xs-3">
          <div class="col-12">
            <div class="bg-white box_radius mt-4 mb-4 box_shadow p-3">
              <div class="row">
                <div class="col-md-9">
                  <div class="doctor_profile_left w-100 d-flex">
                    <div class="user_imgSec position-relative float-left mr-2">
                      <div class="position-relative" style="width: 100px;">
                        <img v-lazy="'/uploads/users/'+user.id+'/'+user.profile.avatar" :alt=" user.first_name + ' ' + user.last_name " :name=" user.first_name + ' ' + user.last_name " class="img-fluid rounded-circle h_110 w_110px w_md_80px h_md_80">
                        <a  class="circle_anchor position-absolute"></a>
                      </div>
                    </div>
                      <div class="prfile_detail float-xs-left float-sm-left float-md-left float-lg-none w_md_65 overflow-hidden">
                        <div class="doctor_name float-xs-left float-sm-left float-md-left float-lg-none">
                          <h2 class="d-inline-block text_md_16 theme-color-text">
                            {{user.first_name}} {{user.last_name}}
                            <span class="ml-3">
													<img v-if="user.profile.verify_registration" src="/images/check.png" alt="Check" class="img-fluid">
												</span>
                          </h2>
                        </div>
                        <div class="doctor_degree text_black d-inline-block text_md_13 w-100">
                           <p class="text_14 text_md_13 d-lg-block"><span v-for="(spec, index) in user.specialities">
                    <span v-if="index === 1">, {{ spec.title }}</span>
                    <span v-else>{{ spec.title }}</span>
                    </span> </p>
                          <p class="mt-2 mb-2">
                            <span v-for="(edu, index) in education" v-if="education !== ''"> {{ edu.degree_title }}{{ index === 0 ? '' : ',' }} </span>
                          <!-- MBBS, -->
                          </p>
                          <span>
                            <img src="/images/experience.png" :alt=" user.first_name + ' ' + user.last_name " :name=" user.first_name + ' ' + user.last_name " class="img-fluid mr-2">
                            <span class="theme-color-text font-weight-bold">
                              {{ user.profile.total_experience }} Years
                            </span>
                            Experience
                          </span>
                          <p class="text_14 text_md_13 d-xs-none d-sm-none d-md-none d-lg-block color-date">Member since
                            {{ user.created_at | formatDate }}</p>
                        </div>
                        <ul class="shares-icon d-none d-lg-inline-block mb-0 mt-3">
                          <li class="float-left mr-5 mr-xs-4">
                            <a class="color-date text_14 color-date" ><i class="fa fa-heart text_15" aria-hidden="true"></i>
                              <span class="font-weight-bold">
                                {{ user.profile.votes !== null ? user.profile.votes : 0 }}
                              </span> Likes</a>
                          </li>
                          <li class="float-left mr-5 mr-xs-0">
                            <a class="color-date text_14" ><i class="fas fa-comments"></i>
                              <span class="font-weight-bold">
                                {{ user.answers.length }}
                              </span> Answers</a>
                          </li>
                          <li class="float-left mr-5 mr-xs-2">
                            <a class="color-date text_14">
                              <i class="fas fa-user-plus"></i>
                              <span class="font-weight-bold">
                                {{ user.profile.followers !== null && user.profile.followers !== '[]' ? (JSON.parse(user.profile.followers)).length : 0 }}
                              </span>followers</a>
                          </li>
                          <li class="float-left mr-5 mr-xs-0">
                            <a class="color-date text_14" >
                              <i class="far fa-comment-alt"></i>
                              <span class="font-weight-bold">
                                {{ user.profile.followings !== null && user.profile.followings !== '[]' ? (JSON.parse(user.profile.followings)).length : 0 }}
                              </span>following</a>
                          </li>
                        </ul>
                      </div>
                  </div>
                      <ul class="shares-icon d-inline-block d-lg-none mb-0 mt-3">
                          <li class="float-left mr-4 mr-lg-5">
                            <a class="color-date text_14 color-date" ><i class="fa fa-heart text_15" aria-hidden="true"></i>
                              <span class="font-weight-bold">
                                {{ user.profile.votes !== null ? user.profile.votes : 0 }}
                              </span> Likes</a>
                          </li>
                          <li class="float-left mr-4 mr-lg-5">
                            <a class="color-date text_14" ><i class="fas fa-comments"></i>
                              <span class="font-weight-bold">
                                {{ user.answers.length }}
                              </span> Answers</a>
                          </li>
                          <li class="float-left mr-4 mr-lg-5 mt-3 mt-lg-0 mt-md-0">
                            <a class="color-date text_14">
                              <i class="fas fa-user-plus"></i>
                              <span class="font-weight-bold">
                                {{ user.profile.followers !== null && user.profile.followers !== '[]' ? (JSON.parse(user.profile.followers)).length : 0 }}
                              </span>followers</a>
                          </li>
                          <li class="float-left mr-4 mr-lg-5 mt-3 mt-lg-0 mt-md-0">
                            <a class="color-date text_14" >
                              <i class="far fa-comment-alt"></i>
                              <span class="font-weight-bold">
                                {{ user.profile.followings !== null && user.profile.followings !== '[]' ? (JSON.parse(user.profile.followings)).length : 0 }}
                              </span>following</a>
                          </li>
                        </ul>
                </div>
                <div class="col-md-3">
                  <div class="doctor_profile_right pt-lg-3 pb-lg-3 pl-lg-5 pl-xs-0 pl-sm-0 pl-md-0">
                    <div class="row">
                      <div class="col-md-12">
                        <!-- <div class="mobile_design mt-3 d-xs-block d-sm-block d-md-block d-lg-none">
                          <p class="text_14 text_md_13"><span v-for="(edu, index) in education" v-if="education !== ''"> {{ edu.degree_title }}{{ index === 1 ? '' : ',' }} </span></p>
                          <p class="mt-2 mb-2">
                            <span v-for="(spec, index) in user.specialities">
                            {{ spec.title }} ,
                            </span>
                          </p>
                          <p class="text_14 mt-2 mb-2 text_md_13">Khayaban-e-Iqbal, Lahore 9.9 km</p>
                          <div class="Satisfy_percentage mt-2 mb-2">
                            <p class="badge knockdoc_sign_up_bg text-white text_md_13"> <i class="fa fa-thumbs-up" aria-hidden="true"></i> 98% </p>
                            <span>Satisfied patients</span>
                          </div>
                        </div> -->
                        <div v-if="following" class="list_btns d-xs-inline-block pb-2 d-sm-inline-block w-100 mt-3 mt-lg-0">
                          <a @click="unfollow" class="d-block rounded-pill text-center knockdoc_doctor_profile_btn text_14">Following</a>
                        </div>
                        <div v-else class="list_btns d-xs-inline-block pb-2 d-sm-inline-block w-100 mt-3 mt-lg-0">
                          <a @click="addFollowing" class="d-block rounded-pill text-center knockdoc_doctor_profile_btn text_14">Follow</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MMM DD,YYYY')
  }
});
export default {
  name: "DoctorProfileComponent",
  props: ['user', 'patient','segments'],
  data() {
    return {
      following: false,
       resultSegments: this.segments,
    }
  },
  created () {
     if (this.user.profile.educations !== null || this.user.profile.educations !== undefined) {
    this.education = JSON.parse(this.user.profile.educations)
    }
    else{
      this.education = ''
    }
    if (this.patient.profile.followings !== null) {
      this.following = this.patient.profile.followings.includes(this.user.id)
    }
  },
  methods: {
    addFollowing() {
      let self = this
      if (self.patient.length === 0) {
        Vue.toasted.show('You are not logged in' , { duration: 3000 })
        return
      }
      axios.post(APP_URL + '/follow-doctor', {
        doctor: self.user.id
      })
        .then(function (response) {
          if (response.data.type === 'success') {
            self.following = true
            Vue.toasted.success(response.data.message , { duration: 3000 })

          } else {
            Vue.toasted.error(response.data.message , { duration: 3000 })

          }
        })
    },
    unfollow() {
      let self = this
      axios.post(APP_URL + '/unfollow-doctor', {
        doctor: self.user.id
      })
          .then(function (response) {
            if (response.data.type === 'success') {
              self.following = false
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
</style>