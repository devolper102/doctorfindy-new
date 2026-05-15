<template>
  <div>
    
    <!-- Start Doctor Specialiety -->
    <section class="doctor-specialiety">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="doctor-specialiety-btn d-flex d-lg-block overflow-sm-auto overflow-md-auto text_nowrap mt-lg-4">
              <a v-for="spec in user.specialities" class="text_14 bg-doctor-section mr-2 mb-3 d-inline-block" style="min-width:150px;max-width:150px;text-overflow: ellipsis;overflow: hidden;" :href="'/'+spec.slug+'-in-Pakistan'" >{{ spec.title }}</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Doctor Specialiety -->
  </div>
</template>

<script>
export default {
  name: 'HospitalSpecialtySectionComponent',
  props: ['user'],
  data() {
    return {}
  },
  created () {},
}
</script>

<style scoped>

</style>