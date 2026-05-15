<template>
  <div>
    <div v-for="(faq, index) in faqs">
      <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
      <div class="heading-box-under-collapse faq_accordian icon_color ">
        <a class="text_black collapsed" data-toggle="collapse" :href="'#collapse-appointment-'+num+'-'+index" role="button" aria-expanded="false" aria-controls="collapseExample">
          <span v-html="JSON.parse(faq.faqs.description)[0]"></span>
        </a>
        <div class="collapse" :id="'collapse-appointment-'+num+'-'+index">
          <div class="card card-body collapse-body p-0 text_15 work-color-text">
            <span v-html="JSON.parse(faq.faqs.description)[1]"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FAQAccordionComponent",
  props: ['faqs', 'num'],
  data() {
    return {}
  },
  created () {},
}
</script>

<style scoped>

</style>