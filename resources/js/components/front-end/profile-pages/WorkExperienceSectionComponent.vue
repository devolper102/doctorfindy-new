<template>
  <div>
    <div class="mt-3 d-inline-block w-100 pt-2 pb-2 pl-3 pr-3 bg-white box-shadow box_radius">
      <div class="heading-box d-inline-block w-100">
        <p class="text_black w-100"><b>Work & Experience</b>
        </p>
        <ul class="d-inline-block mb-0 w-100 mt-2 pl-1">
          <li class="d-inline-block w-100"  v-if="experiences!== ''" v-for="(experience, index) in experiences">
            <span class="green_dots" style="float: left;
            margin-top:7px;margin-right:10px;">
              <i class="fas fa-circle"></i>
            </span>
            <span class="text_14 text_black w-90 float-left">
            {{ experience.job_desc }}</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('YYYY')
  }
});
export default {
  name: "WorkExperienceSectionComponent",
  props: ['user'],
  data() {
    return {
      experiences:'',
    }
  },
  created () {
    this.experiences = JSON.parse(this.user.profile.experiences)
  },
}
</script>

<style scoped>

</style>