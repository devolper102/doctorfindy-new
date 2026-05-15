<template>  
  	<div>
	  	<div class="near_tests mt-4">
        <h5 class="font-weight-bold text-blue">Book Lab Tests Near You</h5>
        <div class="row">
          <div v-for="city in cities" class="col-12 col-lg-3 col-md-4 col-sm-6">
            <div class="all-procedure text-center city-border mb-3">
                <a :href="'/lab-tests-in-'+ city.slug" class="text_black text_13 w-100 d-inline-block pl-2 pr-2 pt-1 pb-1" style="text-overflow: ellipsis; overflow: hidden;">Lab Tests in {{city.title}}</a>
            </div>
          </div>
        </div>
      </div>
      <div class="near_tests mt-lg-4 mt-md-4 mt-0">
        <h5 class="font-weight-bold text-blue">Radiology Pathology Labs in Pakistan</h5>
        <div class="row">
          <div v-for="city in cities" class="col-12 col-lg-3 col-md-4 col-sm-6">
            <div class="all-procedure text-center city-border mb-3">
                <a :href="'/labs/'+ city.slug" class="text_black text_13 w-100 d-inline-block pl-2 pr-2 pt-1 pb-1" style="text-overflow: ellipsis; overflow: hidden;">Labs in {{city.title}}</a>
            </div>
          </div>
          
        </div>
      </div>
  	</div>
</template>

<script>
export default {
  name: "laboratoryTagComponent",
  props:['cities'],
  data() {
    return {

    }
  },
  mounted(){
  },
}
</script>

<style scoped>
.city-border a {
  border: 1px solid #e5e5e5;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.all-procedure a {
  background-color: #dddddd;
  color: black;
}
</style>