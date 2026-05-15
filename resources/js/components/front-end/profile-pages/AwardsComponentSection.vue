<template>
  <div v-if="hasAwards">
    <div class="mt-3 d-inline-block w-100 pt-2 pb-2 pl-3 pr-3 bg-white box-shadow box_radius">
      <div class="heading-box w-100 d-inline-block">
        <strong class="m-0 text_black">Awards</strong>
           <ul class="d-inline-block mb-0 w-100 mt-2">
          <li class="d-inline-block w-100" v-if="awards!== ''" v-for="(award, index) in awards">
            <span class="green_dots" style="float: left;
            margin-top:7px;margin-right:10px;">
              <i class="fas fa-circle"></i>
            </span>
            <span class="text_14 text_black w-90 float-left">
            {{ award.title }}</span>
          </li>
        </ul>
       </div>
    </div>
  </div>

</template>

<script>
export default {
  name: 'AwardsComponentSection',
  props: ['user'],
  data() {
    return {
      awards:'',
    }
  },
  computed: {
    hasAwards() {
      // Check if awards exist and are not empty
      if (!this.awards || this.awards === '' || this.awards === null) {
        return false;
      }
      // Check if awards is an array with items
      if (Array.isArray(this.awards)) {
        return this.awards.length > 0;
      }
      // Check if awards is an object with properties
      if (typeof this.awards === 'object') {
        return Object.keys(this.awards).length > 0;
      }
      return false;
    }
  },
  created () {
    try {
      if (this.user.profile.awards && this.user.profile.awards !== null && this.user.profile.awards !== '') {
        this.awards = JSON.parse(this.user.profile.awards);
      } else {
        this.awards = [];
      }
    } catch (e) {
      this.awards = [];
    }
  },
}
</script>

<style scoped>

</style>