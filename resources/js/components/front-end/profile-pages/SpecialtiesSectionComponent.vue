<template>
  <div>
    <div id="specialtie-section" class="w-100 d-inline-block bg-white box-shadow box_radius mt-3 pt-2 pb-2 pl-3 pr-3">
      <div class="heading-box w-100 d-inline-block">
        <h6 class="font-weight-bold m-0 text_black">Specialties
        </h6>
      </div>
      <ul class="Specialties-list mt-2 d-inline-block w-100">
        <li v-for="spec in user.specialities" class="float-left w-30 w_md_45 w-xs-100 mr-xs-3 mr-sm-3 mr-md-3 mr-lg-0">
          <a class="text_14 text_black w-90 float-left" 
          :href="'/'+spec.slug+'-in-pakistan'">
            {{spec.title}}
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SpecialtiesSectionComponent',
  props: ['user'],
  data() {
    return {}
  },
  created () {
  },
}
</script>

<style scoped>

</style>