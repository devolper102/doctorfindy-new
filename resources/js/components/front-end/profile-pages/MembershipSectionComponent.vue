<template>
  <div>
    <div class="mt-3 d-inline-block w-100 pt-2 pb-2 pl-3 pr-3 bg-white box-shadow box_radius">
      <div class="heading-box w-100 d-inline-block">
        <strong class="m-0 text_black">Professional memberships
        </strong>
        <ul class="d-inline-block mb-0 w-100 mt-2">
          <li class="d-inline-block w-100" v-if="memberships!== ''" v-for="(membership, index) in memberships">
            <span class="green_dots" style="float: left;
            margin-top:7px;margin-right:10px;">
              <i class="fas fa-circle"></i>
            </span>
            <span class="text_14 text_black w-90 float-left">
            {{ membership.title }}</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MembershipSectionComponent",
  props: ['user'],
  data() {
    return {
      memberships:'',
    }
  },
  created () {
    
    this.memberships = JSON.parse(this.user.profile.memberships)
  },
}
</script>

<style scoped>

</style>