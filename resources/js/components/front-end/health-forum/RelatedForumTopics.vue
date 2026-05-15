<template>
  <div>
    <div class="doctor_profile heading-top-contributors w-100 d-inline-block p-2 mt-3">
      <div class="top-contributors-text">
        <span class="text_black font-weight-bold text_14">
          You might also be interested in
        </span>
      </div>
    </div>
    <div v-if="index < 3" v-for="(forum, index) in forums" class="heading-top-contributors bg-white box_shadow p-2 w-100 d-inline-block mb-lg-0 mb-4">
       <a :href="'/ask-a-doctor-online/speciality/'+forum.speciality.slug+'#'+forum.slug"> 
       <p class="text_black font-weight-bold text_8">
          {{ forum.question_title }}
        </p>
        <p class="theme-color-text text_12 mb-3">
          {{ forum.question_description }}
        </p>
         </a> 
        <div v-if="forum.answers.length > 0" class="top-contributors-image float-left w-100 text-sm-center">
          <a :href="'/ask-a-doctor-online/profile/'+forum.answers[0].slug">
          <img class="w-40px h_40 rounded-pill float-left" v-lazy="'/uploads/users/'+forum.answers[0].id+'/'+forum.answers[0].profile.avatar" :alt="forum.answers[0].first_name + ' ' +forum.answers[0].last_name" :name="forum.answers[0].first_name + ' ' +forum.answers[0].last_name">
          <span class="text_black text_12 d-block float-left ml-2">
          {{ forum.answers[0].first_name }} {{ forum.answers[0].last_name }}
        </span>
        </a>
        </div>
        <div v-if="forum.answers.length > 0" class="top-contributors-image-text w-100 float-left">
          <p class="text_black text_12 pl-5">
            {{ forum.answers[0].pivot.answer }}
          </p>
        </div>
        <div class="icon-weight-problem pb-2 w-100 d-inline-block mt-3 pl-lg-0 pl-3">
          <a class="tags-icon text_black text_13 float-left" href="#">
            <i class="fa fa-tag mr-2" aria-hidden="true"></i>
            Weight problem
          </a>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "RelatedForumTopics",
  props: ['forums'],
  data() {
    return {}
  },
  created () {
    console.log('forums',this.forums)
    this.forums.forEach(function (x) {
      console.log(x)
    })
  }
}
</script>

<style scoped>

</style>