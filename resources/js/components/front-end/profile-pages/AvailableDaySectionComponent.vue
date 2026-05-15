<template>
  <div>
    <div v-if="days != null" class="mt-xl-3 d-xl-inline-block w-100 pt-2 pb-2 pl-3 pr-3 bg-white box-shadow 
    box_radius mb-xl-0 mb-3 d-none">
      <div class="heading-box w-100 d-inline-block">
        <h2 class="text_black font-weight-bold text_14 mb-1">Open time and Date</h2>
        <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
        <p class="text-blue font-weight-bold mb-1 mt-1 text_13">Day
          <span class="float-right">Timing</span></p>
        <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
        <ul class="open-clinic-day mb-0 mt-2">
          <li v-for="day in days">
            <p class="text_black text_13 font-weight-bold pb-2">
              {{ day | dayFormat }}<span class="float-right">{{user.profile.working_time}}</span></p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
Vue.filter('dayFormat', function (value) {
  if (value) {
    return moment().day(value).format("dddd");
  }
});
export default {
  name: "AvailableDaySectionComponent",
  props: ['user'],
  data() {
    return {
      days: [],
    }
  },
  created () {
    this.days = JSON.parse(this.user.profile.available_days)
  },
}
</script>

<style scoped>

</style>