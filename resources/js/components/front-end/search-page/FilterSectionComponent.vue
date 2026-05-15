<template>
  <div>
    <div class="row">
      <div class="col-lg-9 col-md-12">
        <div class="search_detail w-100 d-inline-block mt-xl-3">
          <span v-if="$parent.resultDisease.length === undefined" >
          <h2 class="text_25 text-xs-15 text-white mb-0">
            Top ({{ this.$parent.totalCount }}) Doctor Related to {{ $parent.resultDisease.title }} in {{capitalizeFirstLetter($parent.resultLocation)}}
          </h2>
          <p class="mt-2 mb-2 w-100 d-inline-block text-white" v-if="$parent.resultDisease.urdu_decription">{{ $parent.resultDisease.urdu_decription }}</p>
          <!-- <span>
            <label class="text-white text_12 mr-sm-2 float-left mt-1">
              Last Updated On {{moment().format("dddd")}},
              {{ moment().format("MMMM") }} {{ moment().format("DD") }}, {{ moment().format("YYYY") }}
            </label>
          </span> -->
          <!-- <span class="w-xs-100 text-white" 
          v-if="this.$parent.usersData.length === 0 ">
            <h2 class="text_25 text-xs-18 text-white mb-0" align="center">No Results Found...
            </h2>
          </span> -->
              <!-- <p class="font-weight-bold">Urdu Summary</p> -->
          </span>
          <span v-else-if="$parent.resultService.length === undefined" >
          <h2 class="text_25 text-xs-15 text-white mb-0">
          Top ({{ this.$parent.totalCount }}) Doctor Related to {{ $parent.resultService.title }} in {{capitalizeFirstLetter($parent.resultLocation)}}
          </h2>
         <!--  <span>
            <label class="text-white text_12 mr-sm-2 float-left mt-1">
              Last Updated On {{moment().format("dddd")}},
              {{ moment().format("MMMM") }} {{ moment().format("DD") }}, {{ moment().format("YYYY") }}
            </label>
          </span> -->
          <!-- <span class="w-xs-100 text-white" v-if="this.$parent.usersData.length === 0">
            <h2 class="font-weight-bold text-xs-14 text_18 text-white mb-0" align="center">No Results Found... 
            </h2>
          </span> -->
          </span>
          <span v-else-if="$parent.resultSpeciality.length === undefined" >
          <h2 class="text_25 text-xs-15 text-white mb-0">
          Best {{ this.$parent.resultSpeciality.title }} in {{capitalizeFirstLetter($parent.resultLocation)}} ({{this.$parent.totalCount}})
          </h2>
          <span v-if="this.$parent.resultSpeciality.known_as">
            <label class="text-white text_12 mr-sm-2 float-left mt-1">
             Also Known as {{ this.$parent.resultSpeciality.known_as }}
            </label>
          </span>
         <!--  <span class="w-xs-100 d-xs-inline-block text-white" 
          v-if="this.$parent.usersData.length === 0">
            <h2 class="font-weight-bold text-xs-14 text_18 no-result text-white mb-0" 
            align="center" style="margin-left: 36%;">No Results Found...</h2>
          </span> -->

            <span class="text-white" v-if="$parent.resultSpeciality.urdu_description != '' || $parent.resultSpeciality.urdu_description != null">
           <!--    <p class="font-weight-bold">Urdu Summary</p>
              <p class="mt-2 mb-4">{{ $parent.resultSpeciality.urdu_description }}</p> -->
              </span>
          </span>
            <span class="text-white" v-else-if="$parent.resultLocation.length!==0 && $parent.resultService.length === 0 && $parent.resultSpeciality.length===0" >
          <p class="font-weight-bold text-white">
          Top {{ this.$parent.usersData.length }} {{ typeCheck }}s  Related to {{ this.$parent.resultLocation }} 
          </p>
         <!--  <span>
            <label class="text-white text_12 mr-sm-2 float-left mt-1">
              Last Updated On {{moment().format("dddd")}},
              {{ moment().format("MMMM") }} {{ moment().format("DD") }}, {{ moment().format("YYYY") }}
            </label>
          </span> -->
            <!-- <span class="w-xs-100 text-white" 
            v-if="this.$parent.usersData.length === 0">
            <h2 class="text_25 text-xs-18 text-white mb-0" align="center">No Results Found...
            </h2>
          </span> -->
          </span>
          <span class="text-white" v-else-if="$parent.resultService.length === 0 && $parent.resultSpeciality.length===0 && typeCheck==='Lab'" >
          <p v-if="$parent.resultLocation" class="font-weight-bold text-white">
          Top {{ this.$parent.usersData.length }} {{ typeCheck }}s  in {{ this.$parent.resultLocation }} 
          </p>
          <p v-else class="font-weight-bold text-white">
          Top {{ this.$parent.usersData.length }} {{ typeCheck }}s  in Pakistan 
          </p>
          <!-- <span>
            <label class="text-white text_12 mr-sm-2 float-left mt-1">
              Last Updated On {{moment().format("dddd")}},
              {{ moment().format("MMMM") }} {{ moment().format("DD") }}, {{ moment().format("YYYY") }}
            </label>
          </span> -->
           <!--  <span class="w-xs-100 text-white" 
            v-if="this.$parent.usersData.length === 0">
            <h2 class="text_25 text-xs-18 text-white mb-0" align="center">No Results Found...
            </h2>
          </span> -->
          </span>
          <span class="text-white" v-else-if="$parent.resultService.length === 0 && $parent.resultSpeciality.length===0 && typeCheck==='Hospital'" >
          <p v-if="$parent.resultLocation" class="font-weight-bold text-white">
          Top {{ this.$parent.usersData.length }} {{ typeCheck }}s  in {{ this.$parent.resultLocation }} 
          </p>
          <p v-else class="font-weight-bold text-white">
          Top {{ this.$parent.usersData.length }} {{ typeCheck }}s  in Pakistan 
          </p>
          <span>
            <label class="text-white text_12 mr-sm-2 float-left mt-1">
              Last Updated On {{moment().format("dddd")}},
              {{ moment().format("MMMM") }} {{ moment().format("DD") }}, {{ moment().format("YYYY") }}
            </label>
          </span>
            <!-- <span class="w-xs-100 text-white" 
            v-if="this.$parent.usersData.length === 0">
            <h2 class="text_25 text-xs-18 text-white mb-0" align="center">No Results Found...
            </h2>
          </span> -->
          </span>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <!-- <label class="text_black float-left pr-2 w-30 text-left mt-1 text-right">Sort by</label> -->
        <div class="relevance w-70 w-sm-100 w_md_100 float-right mt-4 mt-md-0 mt-lg-0 position-relative option_field">
         <!--  <vue-single-select
              ref="sortBy"
              v-model="selectedSortBy"
              name="sortBy"
              placeholder="Sort by"
              :options="['Relevance', 'Fee low to high', 'Fee high to low', 'Patient rating', 'Years of experience', 'Distance']"
          ></vue-single-select> -->
        <!-- <i class="fas fa-angle-down"></i> -->
        </div>
      </div>
    </div>
    <!-- <div class="row">
        <div  v-if="$parent.usersData.length !== 0" v-for="(doctor, index) in $parent.usersData" class="col-12 col-lg-3 mb-3">
          <div v-if="doctor.recommend_status===1">
          <doctor-card
                :doctor="doctor"
          ></doctor-card>
        </div>
        </div>
      </div> -->
      <recommended-doctor-section></recommended-doctor-section>
  </div>
</template>

<script>
import VueSingleSelect from "vue-single-select";
import moment from 'moment';
export default {
  components: { VueSingleSelect },
  name: "FilterSectionComponent",
  props: ['resultType', 'resultLocation', 'resultService', 'resultDisease', 'resultSpeciality', 'resultKeywords'],
  data() {
    return {
      moment: moment,
      details: [],
      location: false,
      service: false,
      disease: false,
      speciality: false,
      selectedSortBy: '',
      name: '',
      typeCheck: '',
    }
  },
  created () {
    if (this.$parent.type === 'doctor') { this.typeCheck = 'Doctor'}
    if (this.$parent.type === 'hospital') { this.typeCheck = 'Hospital'}
    if (this.$parent.type === 'laboratory') { this.typeCheck = 'Lab'}
  },
  watch: {
    selectedSortBy: function (val) {
      if (val === null) {
        this.$parent.clearFilters()
      }
      else {
        this.setFeeSelected(val)
      }
    },
  },
  mounted () {
    // console.log('laab',this.$parent.resultLocation);
  },
  methods:{
     capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
},
    setFeeSelected(value) {
      if (value === null) {

      }
      else {
        this.$parent.sort_by = true
        this.$parent.sort_by_filter = value
        this.$parent.filterData()
      }
    },
    searchTypeCheck () {
      if(this.resultLocation.length > 0  || this.resultLocation.length === undefined) {
        this.details = this.resultLocation
        this.location = true
        this.name = true
      }
      if(this.resultService.length > 0 || this.resultService.length === undefined) {
        this.details = this.resultService
        this.service = true
        this.name = true
      }
      if(this.resultDisease.length > 0  || this.resultDisease.length === undefined) {
        this.disease = this.resultDisease
        this.location = true
        this.name = true
      }
      if(this.resultSpeciality.length > 0 || this.resultSpeciality.length === undefined) {
        this.details = this.resultSpeciality
        this.speciality = true
        this.name = true
      }
    }
  }
}
</script>

<style scoped>

</style>