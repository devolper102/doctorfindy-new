<template>
  <div>
    <div id="disease-section" class="mt-3 d-inline-block w-100 pt-2 pb-2 pl-3 pr-3 bg-white box-shadow box_radius">
      <div class="heading-box d-inline-block w-100">
        <h2 class="font-weight-bold m-0 text_black text_16">Disease
        </h2>
      </div>
      <ul class="Services-list mt-2 d-inline-block w-100">
        <li v-for="disease in allDiseases" class="float-left w-30 w_md_45 w-xs-100 mr-xs-3 mr-sm-3 mr-md-3 mr-lg-0">
          <a class="text_14 text_black ml-2" :href="'/diseases/'+disease.slug">
            {{ disease.title }}
          </a>
        </li>
      </ul>
    </div>
  </div>

</template>

<script>
export default {
  name: "DiseaseSectionComponent",
  props: ['user','diseases'],
  data() {
    return {
      allDiseases:'',
    }
  },
  created () {
  },
  mounted()
  {
    if(this.diseases && this.diseases.length === 0)
    {
      this.getDiseases();

    }
    else
    {
      this.allDiseases = this.diseases;
    }
  },
  methods:{
    getDiseases()
    {
      let speciality=this.user.specialities[0].id;
      axios.get('/front-end/get-diseases-of-user/'+this.user.id+'/'+speciality)
      .then(response=>{
         this.allDiseases=response.data;
      })
    },
  }
}
</script>

<style scoped>

</style>