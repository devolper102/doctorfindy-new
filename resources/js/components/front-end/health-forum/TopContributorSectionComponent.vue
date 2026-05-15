<template>
  <div>
    <div class="doctor_profile heading-top-contributors w-100 d-inline-block p-2">
      <div class="top-contributors-text">
        <span class="text_black font-weight-bold text_14">
          Top Contributors
        </span>
      </div>
      <div class="heading-top-contributors bg-white box_shadow w-100 d-inline-block p-2 text-center">
        <div v-if="index < 5" v-for="(contributor, index) in $parent.contributors" class="top-contributors-image float-left mr-4 mr-xs-3">
          <a :href="'/health-forum/profile/'+contributor.slug">
            <img class="w-40px h_40 rounded-pill" v-lazy="'/uploads/users/'+contributor.id+'/'+contributor.profile.avatar" :alt="contributor.first_name + ' ' + contributor.last_name">
            <span class="text_black text_12 d-block">
            {{contributor.first_name}} {{contributor.last_name}}
          </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "TopContributorSectionComponent",
  created () {
    console.log(this.$parent.contributors)
  }
}
</script>

<style scoped>

</style>