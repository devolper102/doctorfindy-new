<template>
  <div>
    <div class="mt-3 d-inline-block w-100 p-3 bg-white box-shadow box_radius">
      <div class="fee_structure m-0">
        <h2 class="font-weight-bold m-0 text_black text_16">
          Fee structure of {{user.first_name}} {{user.last_name}}</h2>
        <table class="table table-bordered mt-3">
          <thead class="d-none">
          <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
          </tr>
          </thead>
          <tbody>
          <tr v-if="tests.length > 0" v-for="(test, index) in tests">
            <td>{{ index+1 }}</td>
            <td>{{ test.title }}</td>
            <td>{{ test.fee }}</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FeeStructureSectionComponent",
  props: ['user'],
  data() {
    return {
      tests: [],
    }
  },
  created () {
    let self = this
    if (self.user.specialities.length > 0) {
      self.user.specialities.forEach(function (specialty){
        specialty.tests.forEach(function (test){
          self.tests.push(test)
        })
      })
    }
  },
}
</script>

<style scoped>

</style>