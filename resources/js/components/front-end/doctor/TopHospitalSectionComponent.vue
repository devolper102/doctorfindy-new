<template>
  <div>
    <div class="container">
    	<div class="col-12">
    		<h2>DoctorFindy Top Hospitals of the Month </h2>
    	</div>
      <div class="container" v-if="index < 3" v-for="(user, index) in hospitals">
          <hospital-listing-tab
              :user="user"
          >
          </hospital-listing-tab>
      </div>
    	
    </div>
  </div>
</template>

<script>
export default {
  name: "TopHospitalSectionComponent",
  props:['hospitals'],
  data() {
    return {
      
    }
  },
  computed: {},
  created () {

  },
  mounted () {},
  methods:{},

}
</script>

<style>

</style>