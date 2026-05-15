<template>
  <div>
  </div>
</template>

<script>


Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MMM DD,YYYY')
  }
});

export default {
  name: "PostsSectionComponent",
  props: ['forums'],
  data() {
    return {
      questions: this.forums,
      question_id: '',
    }
  },
  created () {
    console.log(this.questions)
    this.forums.forEach(x => {
      // console.log(x.answers)
    })
  },
  methods: {
  },
}
</script>

<style scoped>

</style>