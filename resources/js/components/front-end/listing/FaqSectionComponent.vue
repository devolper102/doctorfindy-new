<template>
  <div>

    <div v-if="index < 8" v-for="(faq, index) in faqs">
      <div role="separator" class="dropdown-divider d-inline-block w-100"></div>
      <div class="heading-box-under-collapse faq_accordian icon_color py-0">
        <a class="text_black collapsed pt-2 d-inline-block w-100" data-toggle="collapse" :href="'#best-doctor-collapse-'+index" role="button" aria-expanded="false" aria-controls="collapseExample">
         <span class="w-80 d-inline-block"> {{ (JSON.parse(faq.description))[0] }}</span>
        </a>
        <div class="collapse" :id="'best-doctor-collapse-'+index">
          <div class="card card-body collapse-body p-0 text_15 work-color-text border-0" v-html="(JSON.parse(faq.description))[1]">
          </div>
        </div>
      </div>
    </div>
    <div role="separator" class="dropdown-divider d-inline-block w-100"></div>
  </div>
</template>

<script>
export default {
  name: "FaqSectionComponent",
  props: ['faqs'],
  data() {
    return {
      search: '',
      doctors: [],
    }
  },
  computed: {},
  created () {
    let self = this
  }
}
</script>

<style scoped>

</style>