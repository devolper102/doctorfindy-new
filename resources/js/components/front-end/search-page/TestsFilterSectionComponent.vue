<template>
  <div>
    <div class="container px-0 px-lg-3">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-12">
    <div class="accordion md-accordion w-100 mt-lg-2 mb-lg-3 mt-0 mb-3" id="internationl_tests" role="tablist" aria-multiselectable="true">
      <!-- Start International Test -->
      <div class="box_radius box_shadow border-0 ">

        <!-- Card header -->
        <div v-if="internationalTest.length > 0" class="card-header p-0 heading-doctor-city-pakistan" role="tab" id="internationl_tests_header">
          <a data-toggle="collapse" data-parent="#internationl_tests_header" href="#internationl_tests_list" aria-expanded="true" aria-controls="internationl_tests_list" class="p-2 d-inline-block w-100 collapsed knockdoc_btn_bg text-white box_radius" style="border-bottom-left-radius: 0px;border-bottom-right-radius: 0px;">International Tests</a>
        </div>
        <!-- Card body -->
        <div v-if="internationalTest.length > 0" id="internationl_tests_list" class="collapse show" role="tabpanel" aria-labelledby="internationl_tests_list" data-parent="#internationl_tests_list">
          <div class="card-body bg-white p-2 box_radius" style="border-top-left-radius: 0px;border-top-right-radius: 0px;">
            <ul class="navbar-nav doctor-hospital-city border-test">
              <li v-for="test in internationalTest" class="nav-item w-100">
                <div class="form-check mb-2 text_black test_list_checkbox p-0">
                  <span class="w-85 d-inline-block mt-2">{{ test.title }}</span>
                  <input @click="labFilterData(test.id)"  :value="test.id" type="checkbox" class="form-check-input filled-in" :id="'internationl-'+test.id">
                  <label class="form-check-label float-right" :for="'internationl-'+test.id"></label>
                </div>
              </li>
            </ul>
          </div>
        </div>

      </div>
      <!-- End International Test -->
    </div>
    </div>
    <div class="col-12 col-sm-6 col-md-6 col-lg-12">
    <!-- Common Tests -->
    <div class="accordion md-accordion mt-lg-2 mb-lg-3 mt-0 mb-3" id="common_test" role="tablist" aria-multiselectable="true">
      <!-- Accordion card -->
      <div class=" box_radius box_shadow border-0">

        <!-- Card header -->
        <div v-if="nationalTest.length > 0" class="card-header p-0 heading-doctor-city-pakistan" role="tab" id="common_test_heading">
          <a data-toggle="collapse" data-parent="#common_test_heading" href="#common_test_list" aria-expanded="true" aria-controls="common_test_list" class="p-2 d-inline-block w-100 collapsed knockdoc_btn_bg text-white box_radius" style="border-bottom-left-radius: 0px;border-bottom-right-radius: 0px;">Common Tests</a>
        </div>
        <!-- Card body -->
        <div v-if="nationalTest.length > 0" id="common_test_list" class="collapse show" role="tabpanel" aria-labelledby="common_test_list" data-parent="#Islamabad">
          <div class="card-body bg-white p-2 box_radius" style="border-top-left-radius: 0px;border-top-right-radius: 0px;">
            <ul class="navbar-nav doctor-hospital-city border-test">
              <li v-for="test in nationalTest" class="nav-item w-100">
                <div class="form-check mb-2 text_black test_list_checkbox p-0">
                  <span class="w-85 d-inline-block mt-2">{{ test.title }}</span>
                  <input @click="labFilterData(test.id)" :value="test.id" type="checkbox" class="form-check-input filled-in" :id="'national-'+test.id">
                  <label class="form-check-label float-right" :for="'national-'+test.id"></label>
                </div>
              </li>
            </ul>
          </div>
        </div>

      </div>
      <!-- Accordion card -->
    </div>
    <!-- Common Tests -->

  </div>
  </div>
  </div>
  </div>
</template>

<script>
export default {
  name: "TestsFilterSectionComponent",
  props: ['users', 'tests'],
  data() {
    return {
      internationalTest: [],
      nationalTest: [],
    }
  },
  created () {
    let self = this
    self.tests.forEach(function (test){
      if (test.type === 'international'){
        self.internationalTest.push(test)
      }
      if (test.type === 'national'){
        self.nationalTest.push(test)
      }
    })
  },
  methods: {
    labFilterData(id) {
      let self = this
      if(document.querySelector('#national-'+id)) {
        if(document.querySelector('#national-'+id).checked) {
          let result = false
          self.$parent.usersData = self.$parent.usersData.filter(function (user) {
            result = false
            user.specialities.forEach(function (spec) {
              spec.tests.forEach(function (test) {
                if(test.id === id) {
                  return result = true
                }
              })
              return result
            })
            return result
          })
        }
        else {
          self.$parent.usersData = self.$parent.userData
        }
      }
      else if(document.querySelector('#internationl-'+id)) {
        if(document.querySelector('#internationl-'+id).checked) {
          let result = false
          self.$parent.usersData = self.$parent.usersData.filter(function (user) {
            result = false
            user.specialities.forEach(function (spec) {
              spec.tests.forEach(function (test) {
                if(test.id === id) {
                  return result = true
                }
              })
              return result
            })
            return result
          })
        }
        else {
          self.$parent.usersData = self.$parent.userData
        }
      }
      else {
        self.$parent.usersData = self.$parent.userData
      }
    }
  }
}
</script>

<style scoped>

</style>