<template>
  <div>

    <!-- Start section all specialties  -->
    <section class="all-specialties">
      <div class="container">
        <div class="row">
          <div class="col-12 mt-3">
            <div class="heading-all-specialties">
              <h2 class="text_black font-weight-bold">Check Lab Test Report Online</h2>
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
            <div class="bg-white box_shadow p-4 mb-4 patient-doctor-box">
              <div class="row mt-4">
                <div v-for="(lab, index) in allLaboratories" class="col-12 col-lg-3 col-md-4 col-sm-6" v-if="lab.profile && lab.profile.online_report_url != null">
                  <div class="all-procedure text-center city-border mb-3">
                    <a class="text_black text_13 w-100 d-inline-block p-2" :href="'get-online-test-reports-'+lab.slug" style="text-overflow: ellipsis; overflow: hidden; ">{{ lab.first_name}} {{ lab.last_name}}</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>      

      </div>
    </section>

  </div>
</template>

<script>
import moment from 'moment';
export default {
  name: 'labsOnlineSectionComponent',
  props: ['laboratories'],
  data() {
    return {
      moment:moment,
      search:'',
      allLaboratories: this.laboratories,
    }
  },
  mounted()
  {
  },
  computed: {
    // filteredList() {
    //   return this.allLaboratories.filter(post => {
    //     return post.title.toLowerCase().includes(this.search.toLowerCase())
    //   })
    // }
  },
 async created() {
    const spe = await axios.get('/get-all-laboratories')
    this.allLaboratories = Object.freeze(spe.data)
  },
  mounted () {},
  methods:{},
}
</script>

<style>
img[lazy=loading] {
    background-image: url("/images/loader/loaderss.gif");
    background-position: center;
    background-size: contain;
    display: flex;
    width: auto;
    height: auto;
    background-repeat: no-repeat;
  }
img[lazy=error] {
    background-image: url("/images/loader/healthcare-image.png");
    background-position: center;
    background-size: contain;
    display: flex;
    width: auto;
    height: auto;
    background-repeat: no-repeat;
  }

.all-procedure a{

  background-color:#dddddd;
  color:black;
}  
</style>