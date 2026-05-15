<template>
  <div>
    <div class="mt-3 d-inline-block w-100 pt-2 pb-2 pl-3 pr-3">
      <div class="heading-box w-100 d-inline-block"> 
        <h2 class="font-weight-bold mb-3 text_black text_16">
          Frequently Asked Questions</h2>
        <p>  
        <div v-for="(spec, index) in user.specialities">
          <faq-accordion
             :faqs="spec.faqs_assign"
             :num="index"
          ></faq-accordion>
        </div>
        <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FAQSectionComponent",
  props: ['user','fee'],
  data() {
    return {}
  },
  created () {},
}
</script>

<style scoped>

</style>