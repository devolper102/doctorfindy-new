<template>
  <div>
    <div v-if="loading" id="loader"></div>

   <!--  <ul class="filter mt-3 d-none d-lg-inline-block w-100 mb-0 pb-4" v-if="this.$parent.type !== 'laboratory' && this.$parent.type !== 'hospital'">
     <li class="float-left mr-3 mt-1">
        <div class=" mb-2 text_black">
          <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="male" @click="scrolltodiv">
          <label class="form-check-label " for="male">Male</label>
        </div>
      </li>
      <li class="float-left mr-3 mt-1">
        <div class=" mb-2 text_black">
          <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="female" @click="scrolltodiv">
          <label class="form-check-label" for="female">Female</label>
        </div>
      </li>
      <li class="float-left mr-3 mt-1" v-if="this.$parent.type !== 'laboratory'">
        <div class=" mb-2 text_black">
          <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="video_check" @click="scrolltodiv">
          <label class="form-check-label " for="video_check">Video consultation</label>
        </div>
      </li>
      <li class="float-left mr-3 mt-1">
        <div class=" mb-2 text_black">
          <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="available_today" @click="scrolltodiv">
          <label class="form-check-label " for="available_today">Available today</label>
        </div>
      </li>
      <li class="float-left mr-3 mt-1">
        <div class=" mb-2 text_black">
          <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="experience" @click="scrolltodiv">
          <label class="form-check-label " for="experience">Most Experienced</label>
        </div>
      </li>
      <li class="float-left mr-3 mt-1">
        <div class=" mb-2 text_black">
          <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="rating">
          <label class="form-check-label " for="rating">Most Rating</label>
        </div>
      </li>
      <li class="float-left mr-3 mt-1">
        <div class=" mb-2 text_black">
          <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="experience">
          <label class="form-check-label " for="experience">Most Experience</label>
        </div>
      </li>
      <li class="float-left mr-3 mt-1">
        <div class=" mb-2 text_black">
          <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="available_tomorrow">
          <label class="form-check-label " for="available_tomorrow">Tomorrow</label>
        </div>
      </li>
      <li class="float-left mr-3 mt-1">
        <div class=" mb-2 text_black" v-if="this.$parent.type !== 'laboratory'">
          <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="available_next_3_days">
          <label class="form-check-label " for="available_next_3_days">Next 3 days</label>
        </div>
      </li>
      <li class="float-left mr-3 mt-1">
        <div class=" mb-2 text_black" v-if="this.$parent.type !== 'laboratory'">
          <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="available_next_7_days">
          <label class="form-check-label " for="available_next_7_days">Next 7 Days</label>
        </div>
      </li>
      <li class="float-left mr-2 position-relative option_field" id="hospital_search" v-if="this.$parent.type !== 'laboratory'">
        <vue-single-select
            ref="selectHospitals"
            v-model="selectedHos"
            name="hopitals"
            placeholder="Choose Hospital"
            :options="allHospitals"
            option-key="id"
            :filterBy="filterBy"
            @select="setSelected"
            :max-results="4"
            :get-option-description="getOptionDescription "
        ></vue-single-select>
        <i class="fas fa-angle-down"></i> 
      </li>
     <li class="float-left mr-2 select_fee text_14 position-relative option_field" id="fee_main">
        <vue-single-select
            ref="selected fee"
            v-model="selectedfee"
            name="fees"
            placeholder="Select Fee"
            :options="[500, 1000, 1500,2000,4000]"
        ></vue-single-select>
      </li>
      <li class="float-left mr-2 select_fee text_14 position-relative option_field" id="fee_main" v-if="this.$parent.resultLocation !== 'pakistan'">
        <vue-single-select
            ref="selected area"
            v-model="selectedarea"
            name="name"
            placeholder="Select Area"
            :options="areasResultLocation"
            :max-results="areasResultLocation.length"
            :option-key="areasResultLocation.id"
            :option-label="areasResultLocation.title"
            :get-option-description="getAreaDescription"
            @change="onChange()"
        ></vue-single-select>
        <i class="fas fa-angle-down"></i>
      </li>
     <li class="float-left mr-2 select_fee text_14 position-relative option_field" id="fee_main">
        <vue-single-select
            ref="selected fee"
            v-model="selectSort"
            name="fees"
            placeholder="Sorted By"
            :options="['Years of experience', 'Fee high to low']"
        ></vue-single-select>
       <i class="fas fa-angle-down"></i>
      </li>
      <li class="float-right">
        <a href="javascript:void(0)" @click="this.$parent.clearFilters" v-if="this.$parent.filters" class="rounded-pill knockdoc_btn_bg text-white p-2 filter_btn_padding text_14 float-left">Clear</a>
      </li>
    </ul> -->
    <!-- <div class="row">
      <div class="col-12">
        <div class="w-100 d-inline-block position-relative">
        <div class="position-absolute box-right">
          <div class="consultation-box bg-white box_shadow book-rounded d-xl-block d-none sticky" 
          :class="{ 'sticky': isSticky }">
            <div class="w-100 d-inline-block text-center 
            mt-2">
              <blink>
                <img src="/images/emergency-icon-image.png" 
              alt="pictire">
              </blink>
              <p class="text-blue font-weight-bold text_13 mt-1">Consult Now</p>
            </div>
            <div class="w-100 d-inline-block text-center consult-video-btn mb-1">
              <a href="javascript:void(0)" 
              class="d-inline-block book-rounded bg-red text-white text_13 mt-1 mb-1">Video Call
              </a>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="float-right call-btn call-sticky d-xl-block d-lg-block d-none">
          <a class="text_14 text-white d-inline-block font-weight-bold" href="javascript:void(0)">
            <span>
              <i class="fa fa-whatsapp mr-2 float-left" aria-hidden="true">
              </i>
            </span>
            Whatsapp Us
          </a>
        </div>
      </div>
    </div> -->
  </div>
</template>

<script>
import VueSingleSelect from "vue-single-select";
import Toasted from 'vue-toasted';
Vue.use(Toasted);



export default {
  components: { VueSingleSelect },
  name: "FiltersSectionComponent",
  data() {
    return {
      // isSticky: false,
      // prevScrollPos: window.pageYOffset,
      loading: false,
      selectedHos: '',
      selectedfee: 0,
      selectedarea:'',
      selectSort:'',
      allHospitals: this.$parent.allHospitals,
      areasResultLocation:[],
      areasResultLocationOption:[],
      query: "",
      results: [],
      timeout: null,
      selected: null,
      suggestions: [],
      debounceMilliseconds: 250,
      inputProps: {
        id: "hospitals",
        placeholder: "Choose Hospital",
        class: "form-control banner_input text_14 w-30",
        name: "search"
      },
      sectionConfigs: {
        hospitals: {
          limit: 4,
          label: "Hospitals",
          onSelected: selected => {
            this.setSelected(selected)
            this.selected = selected.item;
          }
        },
      }
    }
  },
  created () {
    this.getAreaResultLocation();

  },
  watch: {
    selectedHos: function (val) {
      if (val === null) {
        this.$parent.clearFilters()
      }
      else {
        this.setSelected(val)
      }
    },
    selectedfee: function (val) {
      if (val === null) {
        this.$parent.clearFilters()
      }
      else {
        this.setFeeSelected(val)
      }
    },
    selectedarea:function(val){
       if(val === null)
       {
         this.selectAreaFirst();
       }
       else
       {
         this.setAreaSelected(val);
       }
    },
     selectSort: function (val) {
      if (val === null) {
        this.$parent.clearFilters()
      }
      else {
        this.setSelectSort(val)
      }
    }
  },
  // mounted(){
  //  window.addEventListener('scroll', this.handleScroll);
  // },
  // beforeDestroy() {
  //   window.removeEventListener('scroll', this.handleScroll);
  // },
  methods: {
    // handleScroll() {
    //   const currentScrollPos = window.pageYOffset;

    //   if (currentScrollPos > 360 && currentScrollPos) {
    //     this.isSticky = true;
    //   } else {
    //     this.isSticky = false;
    //   }
    // },
    selectAreaFirst()
    {
       Vue.toasted.error('Select Area' , { duration: 3000 });
    },
    getAreaResultLocation(){
        if(this.$parent.resultLocation !== 'pakistan')
        {
          axios.get('/get-selected-location-area/'+this.$parent.resultLocation)
         .then(response=>{
           this.areasResultLocation=response.data;
         });
        }
       
      },
    scrolltodiv(){
      var element = document.getElementById('filter-section');
      element.scrollIntoView({ behavior: 'smooth' });
    },
    getOptionDescription (item) {
      return item.first_name + " " + item.last_name
    },
    getAreaDescription(item){
       return item.title;
    },
    filterBy(option, text) {
      const searchText = this.$refs.selectHospitals.searchText
      if (option.first_name.toLowerCase().includes(searchText.toLowerCase())) {
        return option
      }
      else if (option.last_name.toLowerCase().includes(searchText.toLowerCase())) {
        return option
      }
      else {
        return
      }
    },

    setSelected(value) {
      let self = this
      if (value === null) {

      }
      else {
        this.$parent.sort_by_hospital = true
        this.$parent.hospital_name = value
        this.$parent.filterData()
      }
    },
    setFeeSelected(value) {
      if (value === null) {

      }
      else {
        this.$parent.fees_filter = true
        this.$parent.fees_range = value
        this.$parent.filterData()
      }
    },
    setAreaSelected(value){
     if (value === null) {
         this.selectAreaFirst();
      }
      else {
          // console.log('asdasds',value);


         if(this.$parent.page_type === 'speciality-detail')
         {
           var base = window.location.origin;
           var slug=this.$parent.resultSpeciality.slug;
           var location=this.$parent.resultLocation;
           this.$parent.selectedAreaFilter=value.slug;

           window.location.href=base+'/'+slug+'-in-'+location+'/'+value.slug;
           
         }
         if(this.$parent.page_type === 'disease-detail')
         {
           var base = window.location.origin;
           var slug=this.$parent.resultDisease.slug;
           var location=this.$parent.resultLocation;
           this.$parent.selectedAreaFilter=value.slug;
           window.location.href=base+'/diseases/'+slug+'/'+location+'/'+value.slug;
         }
         if(this.$parent.page_type === 'service-detail')
         {
           var base = window.location.origin;
           var slug=this.$parent.resultService.slug;
           var location=this.$parent.resultLocation;
           this.$parent.selectedAreaFilter=value.slug;
           window.location.href=base+'/treatments/'+slug+'/'+location+'/'+value.slug;

         }
         if(this.$parent.page_type === 'city-detail')
         {
            var base = window.location.origin;
           var location=this.$parent.resultLocation;
           this.$parent.selectedAreaFilter=value.slug;


           window.location.href=base+'/doctors/'+location+'/'+value.slug;
         }

        
      }
    },
    setSelectSort(value) {
      if (value === null) {

      }
      else {
        this.$parent.sort_by_filter = true
        this.$parent.sort_by_filter = value
        this.$parent.filterData()
      }
    },
    onSelect(value) {
          },
    fetchResults() {
      let self = this
      const query = this.query;
      clearTimeout(this.timeout);
      this.timeout = setTimeout(() => {
        Promise.all([self.allHospitals]).then(values => {
          this.suggestions = [];
          this.selected = null;
          const hospitalsData = this.filterResults(values[0], query, "first_name", "last_name");
          hospitalsData.length && this.suggestions.push({ name: "hospitals", data: hospitalsData });
        });
      }, this.debounceMilliseconds);
    },
    filterResults(data, text, field, field2) {
      return data
          .filter(item => {
            if (item[field].toLowerCase().indexOf(text.toLowerCase()) > -1) {
              return item[field];
            }
            if (item[field2]){
              if (item[field2].toLowerCase().indexOf(text.toLowerCase()) > -1) {
                return item[field2];
              }
            }

          })
          .sort();
    },
    getSuggestionValue(suggestion) {
      let { name, item } = suggestion;
      if (name === "hospitals"){
        return item.first_name + ' ' + item.last_name ;
      }
    },
  },

}
</script>

<style>

</style>