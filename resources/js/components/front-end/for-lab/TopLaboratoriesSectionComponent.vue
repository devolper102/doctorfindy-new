<template>
  <div>
    <div class="container">
    	<div class="col-12 mb-5 text-center">
        <div class="top_hospitals_month">
    		  <h2>DoctorFindy Top Labs of the month </h2>
        </div>
    	</div>
        <div class="container" v-if="index < 3" v-for="(user, index) in laboratories">
          <lab-listing-tab
              :user="user"
          >
          </lab-listing-tab>
      </div>
   
    </div>
  </div>
</template>

<script>
export default {
  name: "TopLaboratoriesSectionComponent",
  props:['laboratories'],
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