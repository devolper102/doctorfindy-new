<template> 
  <div>
    <div v-if="user.procedures.length > 0" class="mt-3 d-inline-block w-100 pt-2 pb-2 pl-3 pr-3 bg-white box-shadow box_radius">
      <div class="heading-box">
        <h6 class="font-weight-bold m-0 text_black">Surgeries of Doctors Hospital</h6>
      </div>
      <ul class="Specialties-list mt-2 d-inline-block">
        <li v-for="procedure in user.procedures" class="float-left w-50 w-md-100 w-sm-100 w-xs-100 mr-lg-2 mb-3 d-table">
          <a class="text_14 text_black d-table-cell align-middle" :href="'/Surgeries/lahore/' + procedure.slug">
            {{ procedure.title }}
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
name: "ProceduresSectionComponent",
  props: ['user']
}
</script>

<style scoped>

</style>