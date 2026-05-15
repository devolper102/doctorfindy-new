<template>
  <div>
    <div class="container">
      <div class="row">
          <div class="col-12 mt-3">
            <div class="heading-all-specialties">
              <h2 class="text_black font-weight-bold">{{page_title}} Online Test Report</h2>
            </div>
            <span>
            <label class="text-black text_12 mr-sm-2 float-left mt-1">
              Last Updated On {{moment().format("dddd")}},
              {{ moment().format("MMMM") }} {{ moment().format("DD") }}, {{ moment().format("YYYY") }}
            </label>
          </span>
          </div>
        </div>
      <div class="row">
        <div class="col-12">
          <div class="w-100 d-inline-block lab-iframe">
            <iframe class="embed-responsive-item" :src="lab.profile.online_report_url" allowfullscreen=""></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import moment from 'moment';
export default {
  name: "MirrorSectionComponent",
  props:['lab','page_title'],
   data() {
    return {
      moment:moment,
    }
  },
  created() {
  },
  methods: {

  }
}
</script>
<style>
  .lab-iframe iframe{
    width: 100%;
    height: 500px;
  }
</style>
