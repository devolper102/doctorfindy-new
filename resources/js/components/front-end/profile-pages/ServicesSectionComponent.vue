<template>
  <div>
    <div class="mt-3 w-100 d-inline-block bg-white box-shadow box_radius pt-2 pb-2 pl-3 pr-3">
      <div class="heading-box w-100 d-inline-block">
        <h6 class="font-weight-bold m-0 text_black">Services</h6>
      </div>
      <ul class="Services-list mt-2 d-inline-block w-100">
        <li v-for="service in services" class="float-left w-50 w_md_45 w-xs-100 mr-xs-3 mr-sm-3 mr-md-3 mr-lg-0 ">
          <a class="text_14 text_black ml-2" :href="'/treatments/'+service.slug">
            {{service.title}}
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ServicesSectionComponent',
  props: ['user','services','specialities'],
  data() {
    return {}
  },
  created () {
  },
}
</script>

<style scoped>

</style>