<template>
  <div>
    <section class="question-and-active-user">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-6">
            <div class="patient-detail-banner-text result_section float-left text-center mt-3 mt-xs-3 w-sm-80 w-100">
              <span class="text_black font-weight-bold text_xs_15 text_20">{{users.length}}</span>
              <p class="text_black d-block font-weight-bold text_xs_13 text_20">Active Users</p>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="patient-detail-banner-text result_section float-left text-center mt-3 mt-xs-3 w-sm-80 w-100">
              <span class="text_black font-weight-bold text_xs_15 text_20">{{ forums.length }}</span>
              <p class="text_black d-block font-weight-bold text_xs_13 text_20">Asked Questions</p>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="patient-detail-banner-text result_section float-left text-center mt-3 mt-xs-3 w-sm-80 w-100">
              <span class="text_black font-weight-bold text_xs_15 text_20">{{ answers.length }}</span>
              <p class="text_black d-block font-weight-bold text_xs_13 text_20">Given Answers</p>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <div class="patient-detail-banner-text result_section float-left text-center mt-3 mt-xs-3 w-sm-80 w-100">
              <span class="text_black font-weight-bold text_xs_15 text_20">{{ isNaN(views) ? 0 : views }}</span>
              <p class="text_black d-block font-weight-bold text_xs_13 text_20">Total Views</p>
            </div>
          </div>
          <div class="col-lg-2 col-6">
            <div class="patient-detail-banner-text result_section float-left text-center mt-3 mt-xs-3 w-sm-80 w-100">
            <span class="text_black font-weight-bold text_xs_15 text_20">{{allspecialities.length}}</span>
            <p class="text_black d-block font-weight-bold text_xs_13 text_20">Topics</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'ResultsSectionComponent',
  props: ['forums', 'specialities'],
  data() {
    return {
      users: [],
      answers: [],
      views: 0,
      allspecialities: this.specialities,
    }
  },
 async created () {
    let self = this
    let found = false
    this.forums.forEach(function (x) {
      found = false
      self.views += parseInt(x.views)
      self.answers.push(x.answers)
      if (x.users.length > 0) {
        x.users.forEach(function (user) {
          if (self.users === []) {
            self.users.push(user)
          }
          else {
            self.users.forEach(function (r) {
              if (r.id === user.id) {
                found = true
              }
            })
            if (found === false) {
              self.users.push(user)
            }
          }
        })
      }
    })
    console.log('users',this.users)
    const specs = await axios.get('/get-all-specialities-health-forum')
    this.allspecialities = Object.freeze(specs.data)
  }

}
</script>

<style scoped>

</style>