<template>

  <div>
    <div v-if="this.$parent.bread_crumb_data && this.$parent.bread_crumb_data.length" class="row">
      <div class="col-12">
        <ul  class="w-100 d-inline-block bread-crumb-listing">
      <li v-for="(breadcrumbs,index) in this.$parent.bread_crumb_data" class="float-left">
        <a v-if="index === 0" class="text-white text_12" :href="breadcrumbs.url">
          {{breadcrumbs.title}}
        </a>
        <a v-else class="text-white text_12 speciality-bread" :href="breadcrumbs.url">
          {{breadcrumbs.title}}
        </a>
      </li>
      <!-- <li v-if="index != 0" class="float-left speciality-bread">
        <a class="text-white text_12" :href="breadcrumbs.url">
          {{breadcrumbs.title}}
        </a>
      </li> -->
    </ul>
      </div>
    </div>
    <!-- <div v-if="this.$parent.bread_crumb_data.length" class="row">
          <div v-for="(breadcrumb,index) in this.$parent.bread_crumb_data" class="col-12 mt-4">
               <a :href="breadcrumb.url">
                 {{breadcrumb.title}}
               </a>      
          </div>
    </div> -->
    <!-- <div class="banner_heading shadow-0 mt-3 mb-3">
      <h1 class="text_black">Find Your <span>Nearest {{ typeCheck }}s</span></h1>
    </div> -->
    
    <!-- <div class="mobile_dropdown d-inline-block d-lg-none w-100 mt-lg-3 mb-lg-3 m-0"
    v-if="this.$parent.type !== 'laboratory' && this.$parent.type !== 'hospital'">
      <div class="choose_hospitals d-flex w-50 float-left">
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
      </div>
      <div class="choose_fee float-right d-flex">
        <vue-single-select
            ref="selected fee"
            v-model="selectedfee"
            name="fees"
            placeholder="Select Fee"
            :options="[1000, 2000, 3000, 4000, 5000]"
        ></vue-single-select>
      </div>
      <div class="mobile_filter mt-4 mb-4 pt-3 pb-3 pl-2 pr-2  d-inline-block w-100 mb-xs-2">
        <a href="#" class="text_black" data-toggle="modal" data-target="#filter_modal"><img src="/images/filter.png"> Filters </a> <span> ({{ this.$parent.usersData.length }} Results) </span>
        <div class="float-right">
          <a @click="this.$parent.clearFilters" v-if="this.$parent.filters" class="rounded-pill knockdoc_btn_bg text-white p-2 filter_btn_padding text_14 float-rigt d-none d-lg-inline-block">Clear</a>
        </div>
      </div>
    </div> -->

    <!-- Filter Modal -->
    <div class="modal fade bg-white" id="filter_modal" tabindex="-1" role="dialog" aria-labelledby="filter_modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="max-width: 100%">
        <div class="modal-content">
          <div class="modal-header border-0 pb-2 pt-1">
            <span class="text-center w-100 text_18 pt-2">Add Filters</span>
            <button type="button" class="close p-0 w_33px h_30 text-white rounded-circle bg-white border-0 mt-1 mr-1" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text_black">&times;</span>
            </button>
          </div>
          <div class="modal-body p-0">
            <ul class="filter mt-3 mobile_filter_list d-inline-block">
              <li class="p-2 pl-4 font-weight-bold mb-3">Filters</li>
          <li class="float-left mr-2 mt-1">
            <div class="form-check mb-2 text_black">
              <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="mobile_male">
              <label class="form-check-label " for="mobile_male">Male</label>
              </div>
          </li>
          <li class="float-left mr-2 mt-1">
            <div class="form-check mb-2 text_black">
              <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="mobile_female">
              <label class="form-check-label" for="mobile_female">Female</label>
              </div>
          </li>
          <li class="float-left mr-2 mt-1">
            <div class="form-check mb-2 text_black">
              <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="mobile_video_check">
              <label class="form-check-label " for="mobile_video_check">Video consultation</label>
              </div>
          </li>
          <li class="float-left mr-2 mt-1">
            <div class="form-check mb-2 text_black">
              <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="mobile_available_today">
              <label class="form-check-label " for="mobile_available_today">Available today</label>
            </div>
          </li>
          <li class="float-left mr-2 mt-1">
            <div class="form-check mb-2 text_black">
              <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="mobile_experience">
              <label class="form-check-label " for="mobile_experience">Most Experience</label>
            </div>
          </li>
         <!--  <li class="float-left mr-2 mt-1">
            <div class="form-check mb-2 text_black">
              <input v-on:click="this.$parent.filterData" type="checkbox" class="form-check-input filled-in" id="mobile_rating">
              <label class="form-check-label " for="mobile_Rating">Most Rating</label>
            </div>
          </li> -->
          <li class="mt-5 float-left text-center">
            <a class="rounded-pill knockdoc_btn_bg text-white p-2 filter_btn_padding text_14 float-rigt border-0 w-50 d-inline-block"  data-dismiss="modal" aria-label="Close">Apply</a>
          </li>
          <li class="mt-5 ml-2 d-inline-block float-left w-40">
            <a href="#" @click="this.$parent.clearFilters" v-if="this.$parent.filters" class="rounded-pill knockdoc_btn_bg text-white p-2 filter_btn_padding text_14 float-rigt d-inline-block d-lg-none w-100 text-center">Clear</a>
          </li>
        </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Filter Modal -->



    


  </div>

</template>

<script>
import VueSingleSelect from "vue-single-select";
import { VueAutosuggest } from 'vue-autosuggest'

export default {
  components: { VueSingleSelect, VueAutosuggest },
  name: "SearchBannerComponent",
    props:[ 'specialities', 'services', 'cities', 'diseases', 'doctors', 'hospitals', 'laboratories', 'trendingTopics','managements', 'logged_user', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      selectedLocation: [],
      trendingDisease: this.diseases,
      trendingServices: this.services,
      trendingSpecialities: this.specialities,
      home_slider: '',
      home_search_banner: '',
      small_devices: '',
      slides: '',
      search_form_title: '',
      search_banner_heading: '',
      image: '',
      tabs: [],
      first:'',
      second:'',
      third:'',
      all: [],
      loading: false,
      typeCheck: '',
      selectedHos: '',
      selectedfee: 0,
      allHospitals: this.$parent.allHospitals,


      query: "",
      results: [],
      timeout: null,
      selected: null,
      debounceMilliseconds: 250,
      inputProps: {
        id: "autosuggest__input",
        placeholder: "Search for doctors, hospitals, specialties, services, disease",
        class: "form-control banner_input text_14 w-100",
        name: "search"
      },

      suggestions: [],
      sectionConfigs: {
        hospitals: {
          limit: 4,
          label: "Hospitals",
          onSelected: selected => {
            this.$parent.selectedItem(selected)
            this.selected = selected.item;
          }
        },
        doctors: {
          limit: 4,
          label: "Doctors",
          onSelected: selected => {
            this.$parent.selectedItem(selected)
            this.selected = selected.item;
          }
        },
        laboratories: {
          limit: 4,
          label: "Laboratories",
          onSelected: selected => {
            this.$parent.selectedItem(selected)
            this.selected = selected.item;
          }
        },
        specialities: {
          limit: 4,
          label: "Specialities",
          onSelected: selected => {
            this.$parent.selectedItem(selected)
            this.selected = selected.item;
          }
        },
        services: {
          limit: 4,
          label: "Services",
          onSelected: selected => {
            this.$parent.selectedItem(selected)
            this.selected = selected.item;
          }
        },
        diseases: {
          limit: 4,
          label: "Diseases",
          onSelected: selected => {
            this.$parent.selectedItem(selected)
            this.selected = selected.item;
          }
        },
      },
      queryLocation: "",
      resultsLocation: [],
      timeoutLocation: null,
      debounceMillisecondsLocation: 250,
      inputPropsLocation: {
        id: "autosuggest__input__location",
        placeholder: "Select Location ",
        class: "form-control rounded-pill mr-3 text_14",
        name: "location"
      },
      suggestionsLocation: [],
      sectionConfigsLocation: {
        locations: {
          limit: 4,
          label: "Locations",
          onSelected: selected => {
            
            this.$parent.selectedLocation.push(selected.item)
            this.selected = selected.item;
          }
        },
      }
    }
  },
  created () {

    if (this.$parent.type === 'doctor') { this.typeCheck = 'Doctor'}
    if (this.$parent.type === 'hospital') { this.typeCheck = 'Hospital'}
    if (this.$parent.type === 'laboratory') { this.typeCheck = 'Laboratory'}
  },
  watch: {
    selectedHos: function (val) {
      this.setSelected(val)
    },
    selectedfee: function (val) {
      this.setFeeSelected(val)
    }
  },
  mounted(){
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  methods: {
    selectedItem(result) {
      if (this.selectedLocation.length > 0) {
        if (result.label === 'Doctors') {
          window.location.href = '/doctors/'+result.item.location.slug+'/'+result.item.specialities[0].slug+'/'+result.item.slug
        }
        else if (result.label === 'Hospitals') {
          window.location.href = '/hospitals/'+result.item.location.slug+'/'+result.item.slug+'/'+result.item.area.slug
        }
        else if (result.label === 'Specialities') {
          /*  dermatologist-in-lahore  */
        
          window.location.href = '/'+result.item.slug+'-in-'+this.selectedLocation[0].slug
        }
        else if (result.label === 'Services') {
          /*  treatments/{slug}/{location}  */
          window.location.href = '/treatments/'+result.item.slug+'/'+this.selectedLocation[0].slug
        }
        else if (result.label === 'Diseases') {
          /*  diseases/{slug}/{location}  */
         
          window.location.href = '/diseases/'+result.item.slug+'/'+this.selectedLocation[0].slug
        }
        else if (result.label === 'Laboratories') {
          /*  laboratories/{speciality}/{location}  */
         
             window.location.href = '/laboratories/'+result.item.location.slug+'/'+result.item.slug+'/'+result.item.area.slug
        }
        // else {}
      }
      else {
        if (result.label === 'Doctors') {
         
          return
          window.location.href = '/doctors/'+result.item.location.slug+'/'+result.item.specialities[0].slug+'/'+result.item.slug
        }
        else if (result.label === 'Hospitals') {
          window.location.href = '/hospitals/'+result.item.location.slug+'/'+result.item.slug+'/'+result.item.area.slug
        }
        else if (result.label === 'Specialities') {
          /*  dermatologist-in-lahore  */
       
          window.location.href = '/'+result.item.slug+'-in-'+this.selectedLocation[0].slug
        }
        else if (result.label === 'Services') {
          /*  treatments/{slug}  */
          
          window.location.href = '/treatments/'+result.item.slug+'/'+this.selectedLocation[0].slug
        }
        else if (result.label === 'Diseases') {
          /*  diseases/{slug}  */
          
            window.location.href = '/diseases/'+result.item.slug+'/'+this.selectedLocation[0].slug
        }
        else if (result.label === 'Laboratories') {
          
             window.location.href = '/laboratories/'+result.item.location.slug+'/'+result.item.slug+'/'+result.item.area.slug
        }
        // else {}
      }
    },
    getOptionDescription (item) {
      return item.first_name + " " + item.last_name
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
    renderSuggestion(suggestion) {
      if (suggestion.name === "doctors") {
        const image = suggestion.item;
        return this.$createElement("a", {attrs: {
            href: '#',
            class: "dropdown-item"
          }
        }, [
          this.$createElement("img", {attrs: {
                  src:this.basePath+'/uploads/users/' + image.id +'/' + image.profile.avatar,
                  class:"w-30px h_30 rounded-circle mr-2"
                }
              }
          ), image.first_name + ' ' + image.last_name
        ])
      }
      if (suggestion.name === "hospitals") {
        const image = suggestion.item;
        return this.$createElement("a", {attrs: {
            href: '#',
            class: "dropdown-item"
          }
        }, [
          this.$createElement("img", {attrs: {
                  src:this.basePath+'/uploads/users/' + image.id +'/' + image.profile.avatar,
                  class:"w-30px h_30 rounded-circle mr-2"
                }
              }
          ), image.first_name + ' ' + image.last_name
        ])
      }
      if (suggestion.name === "laboratories") {
        const image = suggestion.item;
        return this.$createElement("a", {attrs: {
            href: '#',
            class: "dropdown-item"
          }
        }, [
          this.$createElement("img", {attrs: {
                  src:this.basePath+'/uploads/users/'+ image.id +'/' + image.profile.avatar,
                  class:"w-30px h_30 rounded-circle mr-2"
                }
              }
          ), image.first_name + ' ' + image.last_name
        ])
      }
      if (suggestion.name === "specialities") {
        const image = suggestion.item;
        return this.$createElement("a", {attrs: {
                href: '#',
                class: "dropdown-item"
              }
            }, [
              this.$createElement("img", {attrs: {
                      src:this.basePath+'/uploads/specialities/' + image.image,
                      class:"w-30px h_30 rounded-circle mr-2"
                    }
                  }
              ), image.title
            ]
        )
      }
      if (suggestion.name === "services") {
        const image = suggestion.item;
        return this.$createElement("a", {attrs: {
                href: '#',
                class: "dropdown-item"
              }
            }, [
              this.$createElement("img", {attrs: {
                      src:this.basePath+'/uploads/services/' + image.image,
                      class:"w-30px h_30 rounded-circle mr-2"
                    }
                  }
              ), image.title
            ]
        )
        return image.title
      }
      if (suggestion.name === "diseases") {
        const image = suggestion.item;
        return this.$createElement("a", {attrs: {
                href: '#',
                class: "dropdown-item"
              }
            }, [
              this.$createElement("img", {attrs: {
                      src:this.basePath+'/uploads/disease/' + image.flag,
                      class:"w-30px h_30 rounded-circle mr-2"
                    }
                  }
              ), image.title
            ]
        )
        return image.title
      }
      else {
        return suggestion.item.name;
      }
    },
    getSuggestionValue(suggestion) {
      let { name, item } = suggestion;
      if (name === "doctors"){
        return item.first_name + ' ' + item.last_name ;
      }
      if (name === "hospitals"){
        return item.first_name + ' ' + item.last_name ;
      }
      if (name === "laboratories"){
        return item.first_name + ' ' + item.last_name ;
      }
      if (name === "specialities"){
        return item.title;
      }
      if (name === "services"){
        return item.title;
      }
      if (name === "diseases"){
        return item.title;
      }
    },
    clickHandler() {
      this.fetchResults();
    },
    selectHandler(item) {
      if (item) {
        this.selected = item.item;
      }
    },
    bolden(text, suggestion) {
      if (suggestion.name === 'doctors' || suggestion.name === 'hospitals' || suggestion.name === 'laboratories') {
        let name = suggestion.item.first_name + ' ' + suggestion.item.last_name
        let regex = new RegExp("(" + text + ")", "gi")
        suggestion = name.replace(regex, "<b>$1</b>")
        return suggestion;
      }
      if (suggestion.name === 'services' || suggestion.name === 'specialities' || suggestion.name === 'diseases') {
        let name = suggestion.item.title
        let regex = new RegExp("(" + text + ")", "gi")
        suggestion = name.replace(regex, "<b>$1</b>")
        return suggestion;
      }
    },


    fetchResultsLocation() {
      const query = this.queryLocation;
      clearTimeout(this.timeoutLocation);
      this.timeout = setTimeout(() => {
        Promise.all([this.cities]).then(values => {
         
          this.suggestionsLocation = [];
          this.selectedLocation = null;
          const locationsData = this.filterResultsLocation(values[0], query, "title");
          locationsData.length && this.suggestionsLocation.push({ name: "locations", data: locationsData });
        });
      }, this.debounceMillisecondsLocation);
    },
    filterResultsLocation(data, text, field) {
      
      return data
          .filter(item => {
            if (item[field].toLowerCase().indexOf(text.toLowerCase()) > -1) {
              return item[field];
            }
          })
          .sort();
    },
    renderSuggestionLocation(suggestion) {
      if (suggestion.name === "locations") {
        const image = suggestion.item;

        return this.$createElement("a", {attrs: {
            href: '#',
            class: "dropdown-item"
          }
        }, [
          this.$createElement("img", {attrs: {
                  src:this.basePath+'/uploads/locations/' + image.flag,
                  class:"w-30px h_30 rounded-circle mr-2"
                }
              }
          ), image.title
        ])

      }
      else {
        return suggestion.item.name;
      }
    },
    getSuggestionValueLocation(suggestion) {
      let { name, item } = suggestion;
      if (name === "locations"){
        return item.title;
      }
    },
    clickHandlerLocation() {
      this.fetchResults();
    },
    selectHandlerLocation(item) {
      if (item) {
        this.selected = item.item;
      }
    },
    boldenLocation(text, suggestion) {
      let name = suggestion.item.title
      let regex = new RegExp("(" + text + ")", "gi")
      suggestion = name.replace(regex, "<b>$1</b>")
      return suggestion;
    },
  },

}
</script>

<style>
#search_doctor_on_device #autosuggest input{
  border-radius: 0px !important;
  margin-bottom: 10px !important;
  padding-right: 5rem;
}
#search_doctor_on_device .autosuggest__results-container {
    width: 100% !important;
    left: 0px !important;
    top: 100px !important;
}
#search_doctor_on_device .autosuggest__results{
  max-height: 100vh;
  overflow-y: auto !important;
}
.spec_img_space{
  padding: 8px;
}
@media (max-width: 991px){
  #search_doctor_on_device .autosuggest__results-container{
    width: 100% !important;
    left: 0px !important;
    top: 55px !important;
    box-shadow:none;
  }
  #mobile_location_dropdown .autosuggest__results-container{
    top: 110px !important;
  }
}
</style>