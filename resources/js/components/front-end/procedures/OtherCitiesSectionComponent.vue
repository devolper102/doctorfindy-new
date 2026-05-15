<template>
    <div class="col-12 col-lg-4 mb-3 mb-lg-0">
      <div class="bg-white box_shadow box_radius mt-lg-0 mt-4">
        <div class="heading-box p-3">
          <h2 class="text_black font-weight-bold text_20 text-xs-18">Others cities</h2>
          <div class="other-city-hospital">
            <a v-for="hospital in hospitals" class="text_14 w-100 d-inline-block text_black other-city-border pb-2 pt-2" :href="'/hospitals/'+hospital.location.slug+'/'+hospital.slug+'/'+hospital.area.slug">{{ hospital.first_name }} {{ hospital.last_name }}</a>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  name: "OtherCitiesSectionComponent",
  props: ['users'],
  data() {
    return {
      hospitals: [],
    }
  },
  created () {
    let self = this
    this.users.forEach(function (user) {
      if (user.roles[0].name === 'hospital') {
        self.hospitals.push(user)
      }
    })
  }
}
</script>

<style scoped>

</style>