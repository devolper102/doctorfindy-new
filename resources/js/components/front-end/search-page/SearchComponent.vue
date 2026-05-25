<template>
  <div>
    <div class="form-inline d-block d-lg-none mb-2 book-rounded">
      <div class="form-control dummyinput p-2 text_14 w-sm-100 w-md-100 d-table box_shadow position-relative"  data-toggle="modal" data-target="#search_doctor_on_device"> 
        <div class="btn text_14 position-absolute mobile_search_btn pl-0 pr-0">
        <span>
          <i class="fa fa-search fa-sm" aria-hidden="true"></i>
        </span>
      </div> Search for doctors and Hospitals</div>
      
    </div>
     <div class="form-inline other_page_banne d-xs-none d-sm-none d-md-none d-lg-flex mt-3">
      <div class="location_input w-20 w-xs-100 pr-2 
      position-relative w-md-30">
        <vue-autosuggest
            v-model="queryLocation"
            ref="autosuggestLocation"
            @input="fetchLocation"
            @click="fetchResultsLocation"
            :suggestions="suggestionsLocation"
            :inputProps="inputPropsLocation"
            :sectionConfigs="sectionConfigsLocation"
            :getSuggestionValue="getSuggestionValueLocation"
        >
          <template slot-scope="{ suggestion }">
            <div role="separator" class="dropdown-divider"></div>
            <a href="javascript:void(0)" class="p-2 w-100 d-inline-block clearfix locationListMain">
            <span v-if="suggestion.item.flag" class="w_25px h_25 rounded-circle mr-2 search_imgPadding d-inline-block locationListImg" :class="[colors[suggestion.item.id], { avatar: true }]">

              <v-lazy-image :src="basePath+'/uploads/locations/' + suggestion.item.flag" :name="suggestion.item.title" :alt="suggestion.item.title" class="img-fluid"/>
            </span>
            <span v-else :class="{ avatar: true }" class="w_25px h_25 rounded-circle mr-2 search_imgPadding search-img-bg d-inline-block">
              <v-lazy-image  :src="basePath+'/uploads/locations/default/location.svg'" :name="suggestion.item.title" :alt="suggestion.item.title" class="img-fluid"/>
            </span>
                <span v-html="boldenLocation(query, suggestion)"/>
          </a>
          </template>
        </vue-autosuggest>
        <span>
            <i class="fa fa-map-marker fa-sm" aria-hidden="true"></i>
         </span>
      </div>
      <div class=" w-50 other_search position-relative w-xs-100 
      mt-3 mt-xl-0 w-md-60 mt-md-0">
        <vue-autosuggest
            v-model="query"
            ref="autosuggest"
            @input="fetchResults1"
            @click="fetchResults"
            :suggestions="suggestions"
            :inputProps="inputProps"
            :sectionConfigs="sectionConfigs"
            :getSuggestionValue="getSuggestionValue"
        >
          <template slot-scope="{ suggestion }">
            <div v-if="suggestion.label === 'Doctors'">
              <div role="separator" class="dropdown-divider"></div>
              <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
                <span v-if="suggestion.item.profile.avatar !== null" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block" :class="[colors[suggestion.item.id], { avatar: true }]">
                  <v-lazy-image :src="basePath+'/uploads/users/' + suggestion.item.id + '/medium-' + suggestion.item.profile.avatar" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name"/>
                </span>
                <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block">
                  <v-lazy-image :src="basePath+'/uploads/users/default/doctor.svg'" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name"/>
                </span>
                <span v-html="bolden(query, suggestion)"/>
              </a>
            </div>
            <div v-if="suggestion.label === 'Hospitals'">
              <div role="separator" class="dropdown-divider"></div>
              <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
                <span v-if="suggestion.item.profile.avatar !== null" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block" :class="[colors[suggestion.item.id], { avatar: true }]">
                  <v-lazy-image  :src="basePath+'/uploads/users/' + suggestion.item.id + '/medium-' + suggestion.item.profile.avatar" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name"/>
                </span>
                <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block">
                  <v-lazy-image :src="basePath+'/uploads/users/default/hospital.svg'" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name"/>
                </span>
                <span v-html="bolden(query, suggestion)"/>
              </a>
            </div>
            <div v-if="suggestion.label === 'Laboratories'">
              <div role="separator" class="dropdown-divider"></div>
              <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
                <span v-if="suggestion.item.profile.avatar !== null" class="w_25px h_25 rounded-circle mr-2 red_circle d-inline-block bannerSearchImg" :class="[colors[suggestion.item.id], { avatar: true }]">
                  <v-lazy-image  :class="{ avatar: true }" :src="basePath+'/uploads/users/' + suggestion.item.id + '/medium-' + suggestion.item.profile.avatar" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name" class="rounded-circle"/>
                </span>
                <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block">
                  <v-lazy-image :src="basePath+'/uploads/users/default/lab.svg'" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name"/>
                </span>
                <span v-html="bolden(query, suggestion)"/>
              </a>
            </div>
            <div v-if="suggestion.label === 'Specialities'">
              <div role="separator" class="dropdown-divider"></div>
              <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
                <span v-if="suggestion.item.image !== null" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block" :class="[colors[suggestion.item.id], { avatar: true }]">
                  <v-lazy-image :src="basePath+'/uploads/specialities/' + suggestion.item.image" :alt="suggestion.item.title" :name="suggestion.item.title"/>
                </span>
                <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 red_circle search_imgPadding red_circle d-inline-block">
                  <v-lazy-image :src="basePath+'/uploads/specialities/default/speciality.svg'" :alt="suggestion.item.title" :name="suggestion.item.title"/>
                </span>
                <span v-html="bolden(query, suggestion)"/>
              </a>
            </div>
            <div v-if="suggestion.label === 'Services'">
              <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
                <span v-if="suggestion.item.image !== null" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block" :class="[colors[suggestion.item.id], { avatar: true }]">
                  <v-lazy-image :src="basePath+'/uploads/services/' + suggestion.item.image" :alt="suggestion.item.title" :name="suggestion.item.title"/>
                </span>
                <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block">
                  <v-lazy-image :src="basePath+'/uploads/services/default/service.svg'" :alt="suggestion.item.title" :name="suggestion.item.title"/>
                </span>
                <span v-html="bolden(query, suggestion)"/>
              </a>
            </div>
            <div v-if="suggestion.label === 'Diseases'">
              <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
                <span v-if="suggestion.item.flag !== null" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block" :class="[colors[suggestion.item.id], { avatar: true }]">
                  <v-lazy-image  :src="basePath+'/uploads/disease/' + suggestion.item.flag" :alt="suggestion.item.title" :name="suggestion.item.title"/>
                </span>
                <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block">
                  <v-lazy-image :src="basePath+'/uploads/diseases/default/disease.svg'" :alt="suggestion.item.title" :name="suggestion.item.title"/>
                </span>
                <span v-html="bolden(query, suggestion)"/>
              </a>
            </div>
          </template>
        </vue-autosuggest>
        <span class="input-group-btn position-absolute" 
        style="top: 8px;right: 5px;">
          <a href="javascript:void(0)" class="btn text_black 
          text_14" type="button" 
          style="border-radius: 10px;padding: 8px 15px;"> 
            <span>
              <i class="fa fa-search fa-sm" aria-hidden="true"></i>
            </span>
          </a>
        </span>
      </div>
    </div> 
    <!-- Modal fo search Doctor on small devices -->
    <div class="modal fade" id="search_doctor_on_device" tabindex="-1" aria-hidden="true" >
      <div class="modal-dialog m-0">
        <div class="modal-content">
          <div class="modal-header border-0 pb-2 pt-1">
            <span class="text-center w-100 text_18 pt-1">Search</span>
            <span class="text_25 p-0 text-white text-right" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="text_black" style="display: flex;margin-top:-3px;">&times;</span>
            </span>
          </div>
          <div class="form-inline other_page_banne">
      <div class=" location_input w-100 px-2 position-relative" id="mobile_location_dropdown">
        <vue-autosuggest
            v-model="queryLocation"
            ref="autosuggestLocation"
            @input="fetchResultsLocation"
            @click="fetchResultsLocation"
            :suggestions="suggestionsLocation"
            :inputProps="inputPropsLocation"
            :sectionConfigs="sectionConfigsLocation"
            :getSuggestionValue="getSuggestionValueLocation"
        >
          <template slot-scope="{ suggestion }">
            <div role="separator" class="dropdown-divider"></div>
            <a href="javascript:void(0)" class="p-2 w-100 d-block locationListMain clearfix">
              <span v-if="suggestion.item.flag" :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 search_imgPadding d-inline-block locationListImg">
                <v-lazy-image :src="basePath+'/uploads/locations/' + suggestion.item.flag" :name="suggestion.item.title" :alt="suggestion.item.title" class="img-fluid"/>
              </span>
              <span v-else :class="{ avatar: true }" class="w_25px h_25 rounded-circle mr-2 search_imgPadding search-img-bg d-inline-block">
                <v-lazy-image :src="basePath+'/uploads/locations/default/location.svg'" :name="suggestion.item.title" :alt="suggestion.item.title" class="img-fluid"/>
              </span>
              <span v-html="boldenLocation(query, suggestion)"></span>
            </a>
          </template>
        </vue-autosuggest>
        <a href="#" class="text_black detect_btn hospital_lab_btn d-block d-lg-none">  Detect 
          <svg width="15px" height="15px" viewBox="0 0 561 561" fill="#3d4461" style="margin-bottom: 2px;"><path d="M280.5,178.5c-56.1,0-102,45.9-102,102c0,56.1,45.9,102,102,102c56.1,0,102-45.9,102-102 C382.5,224.4,336.6,178.5,280.5,178.5z M507.45,255C494.7,147.9,410.55,63.75,306,53.55V0h-51v53.55 C147.9,63.75,63.75,147.9,53.55,255H0v51h53.55C66.3,413.1,150.45,497.25,255,507.45V561h51v-53.55 C413.1,494.7,497.25,410.55,507.45,306H561v-51H507.45z M280.5,459C181.05,459,102,379.95,102,280.5S181.05,102,280.5,102 S459,181.05,459,280.5S379.95,459,280.5,459z"></path></svg>
        </a>
      </div>
      <div class=" w-100 other_search position-relative px-2">
        <vue-autosuggest
            v-model="query"
            ref="autosuggest"
            @input="fetchResults1"
            @click="fetchResults"
            :suggestions="suggestions"
            :inputProps="inputProps"
            :sectionConfigs="sectionConfigs"
            :getSuggestionValue="getSuggestionValue"
        >
          <template slot-scope="{ suggestion }">
        <div v-if="suggestion.label === 'Specialities'">
          <div role="separator" class="dropdown-divider"></div>
          <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
            <span v-if="suggestion.item.image !== null" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block" :class="[colors[suggestion.item.id], { avatar: true }]">
              <v-lazy-image :src="basePath+'/uploads/specialities/' + suggestion.item.image" :alt="suggestion.item.title" :name="suggestion.item.title"/>
            </span>
            <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w-25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block">
              <v-lazy-image :src="basePath+'/uploads/specialities/default/speciality.svg'" :alt="suggestion.item.title" :name="suggestion.item.title"/>
            </span>
            <span v-html="bolden(query, suggestion)"/>
          </a>
        </div>
        <div v-if="suggestion.label === 'Doctors'">
          <div role="separator" class="dropdown-divider"></div>
          <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
            <span v-if="suggestion.item.profile.avatar !== null" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block" :class="[colors[suggestion.item.id], { avatar: true }]">
              <v-lazy-image :src="basePath+'/uploads/users/' + suggestion.item.id + '/small-' + suggestion.item.profile.avatar" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name"/>
            </span>
            <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block">
              <v-lazy-image :src="basePath+'/uploads/users/default/doctor.svg'" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name"/>
            </span>
            <span v-html="bolden(query, suggestion)"/>
          </a>
        </div>
        <div v-if="suggestion.label === 'Hospitals'">
          <div role="separator" class="dropdown-divider"></div>
          <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
            <span v-if="suggestion.item.profile.avatar !== null" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block" :class="[colors[suggestion.item.id], { avatar: true }]">
              <v-lazy-image  :src="basePath+'/uploads/users/' + suggestion.item.id + '/small-' + suggestion.item.profile.avatar" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name"/>
            </span>
            <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block">
              <v-lazy-image :src="basePath+'/uploads/users/default/hospital.svg'" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name"/>
            </span>
            <span v-html="bolden(query, suggestion)"/>
          </a>
        </div>
        <div v-if="suggestion.label === 'Laboratories'">
          <div role="separator" class="dropdown-divider"></div>
          <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
            <span v-if="suggestion.item.profile.avatar !== null" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block" :class="[colors[suggestion.item.id], { avatar: true }]">
              <v-lazy-image  :class="{ avatar: true }" :src="basePath+'/uploads/users/' + suggestion.item.id + '/small-' + suggestion.item.profile.avatar" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name"/>
            </span>
            <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block">
              <v-lazy-image :src="basePath+'/uploads/users/default/lab.svg'" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name"/>
            </span>
            <span v-html="bolden(query, suggestion)"/>
          </a>
        </div>
        <div v-if="suggestion.label === 'Services'">
          <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
            <span v-if="suggestion.item.image !== null" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block" :class="[colors[suggestion.item.id], { avatar: true }]">
              <v-lazy-image :src="basePath+'/uploads/services/' + suggestion.item.image" :alt="suggestion.item.title" :name="suggestion.item.title"/>
            </span>
            <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block">
              <v-lazy-image :src="basePath+'/uploads/services/default/service.svg'" :alt="suggestion.item.title" :name="suggestion.item.title"/>
            </span>
            <span v-html="bolden(query, suggestion)"/>
          </a>
        </div>
        <div v-if="suggestion.label === 'Diseases'">
          <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
            <!-- :class="[colors]{ avatar: true }" -->
            <span v-if="suggestion.item.flag !== null" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block" :class="[colors[suggestion.item.id], { avatar: true }]">
              <v-lazy-image  :src="basePath+'/uploads/disease/' + suggestion.item.flag" :alt="suggestion.item.title" :name="suggestion.item.title"/>
            </span>
            <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 search_imgPadding red_circle d-inline-block">
              <v-lazy-image :src="basePath+'/uploads/diseases/default/disease.svg'" :alt="suggestion.item.title" :name="suggestion.item.title"/>
            </span>
            <span v-html="bolden(query, suggestion)"/>
          </a>
        </div>
      </template>
        </vue-autosuggest>
        <!-- <span class="input-group-btn search_btn position-absolute">
          <a href="doctors" class="btn knockdoc_btn_bg banner_btn text-white" type="button">Search 
            <span>
              <i class="fa fa-search fa-sm" aria-hidden="true"></i>
            </span>
          </a>
        </span> -->
      </div>
    </div>
        </div>
      </div>
    </div>
    <!-- End Modal fo search Doctor on small devices -->
  </div>
</template>

<script>
import { VueAutosuggest } from 'vue-autosuggest'
import VLazyImage from "v-lazy-image/v2";
export default {
  components: { VueAutosuggest,VLazyImage },
  name: "SearchComponent",
  props: ['fileSystemDriver', 'cities','docs','hosp','labs','special','service','dise','resultLocation'],
  data() {
    return {
      colors:['','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle','red_circle','green_circle','blue_circle'],
      specs:[],
      basePath:'',
      query: "",
      results: [],
      timeout: null,
      selected: null,
      specialities: this.special,
      doctors: this.docs,
      hospitals: this.hosp,
      diseases: this.dise,
      laboratories: this.labs,
      services: this.service,
      locations: this.cities,
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
          limit: 8,
          label: "Hospitals",
          onSelected: selected => {
            this.$parent.selectedItem(selected)
            this.selected = selected.item;
          }
        },
        doctors: {
          limit: 8,
          label: "Doctors",
          onSelected: selected => {
            this.$parent.selectedItem(selected)
            this.selected = selected.item;
          }
        },
        laboratories: {
          limit: 8,
          label: "Laboratories",
          onSelected: selected => {
            this.$parent.selectedItem(selected)
            this.selected = selected.item;
          }
        },
        specialities: {
          limit: 8,
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
      queryLocation:this.resultLocation.charAt(0).toUpperCase() + this.resultLocation.slice(1),
      resultsLocation: [],
      timeoutLocation: null,
      selectedLocation: null,
      debounceMillisecondsLocation: 250,
      inputPropsLocation: {
        id: "autosuggest__input__location",
        placeholder: "Select Location ",
        class: "form-control mr-3 text_14 pr-5",
        name: "location",
      },
      suggestionsLocation: [],
      sectionConfigsLocation: {
        locations: {
          limit: 6,
          label: "Locations",
          onSelected: selected => {
             this.queryLocation=selected.item.slug;
            this.$parent.selectedLocation.push(selected.item)
            this.selected = selected.item;
            this.$parent.selectedCity(selected);
          }
        },
      }
    }
  },
created() {
    // console.log('this.docs',this.docs)
    let i = this;
    this.specialities.forEach(function(e){
      if(e.top === '1'){
        i.specs.push(e);
      }
    })
  },
  mounted() {
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  methods: {
    getData(){
      if(this.queryLocation=='')
      {
        this.queryLocation="lahore";
      }

      axios.get('/get-search',{params:{ query:this.query,location:this.queryLocation}}).then((response) => {
        if(response.data.specialities.length > 0){
          this.specialities = [];
          response.data.specialities.forEach((item, index)=>{
              this.specialities.push(item)
            })
        }
      if(response.data.laboratories.length > 0){
        this.laboratories = [];
        response.data.laboratories.forEach((item, index)=>{
            this.laboratories.push(item)
          })
      }
      if(response.data.doctors.length > 0){
        this.doctors=[];
        response.data.doctors.forEach((item, index)=>{
            this.doctors.push(item)
          })
      }
      if(response.data.services.length > 0){
        this.services = [];
        response.data.services.forEach((item, index)=>{
            this.services.push(item)
          })
      }
      if(response.data.hospitals.length > 0){
        this.hospitals = [];
        response.data.hospitals.forEach((item, index)=>{
            this.hospitals.push(item)
          })
      }
      if(response.data.diseases.length > 0){
        this.diseases = [];
        response.data.diseases.forEach((item, index)=>{
            this.diseases.push(item)
          })
      }
      this.fiterData();
        })
     },
     fetchLocationData(){
      axios.get('/get-location',{params:{ query:this.queryLocation}}).then((response) => {
        if(response.data.locations.length > 0){
          this.locations = [];
          response.data.locations.forEach((item, index)=>{
              this.locations.push(item)
            })
        }
        this.fetchResultsLocation();
        })
     },
     fetchLocation() {
     setTimeout(() => {
            this.fetchLocationData();
       }, 1000);
    },
     fetchResults1() {
     setTimeout(() => {
            this.getData();
       }, 1000);
    },
    fiterData(){
       const query = this.query;
      clearTimeout(this.timeout);
      this.timeout = setTimeout(() => {
      if(this.query.length >2 ){
        Promise.all([this.specialities, this.doctors, this.hospitals, this.laboratories, this.services, this.diseases]).then(values => {
          this.suggestions = [];
          this.selected = null;
          const specialitiesData = this.filterResults(values[0], query, "title");
          const doctorsData = this.filterResults(values[1], query, "first_name", "last_name");
          const hospitalsData = this.filterResults(values[2], query, "first_name", "last_name");
          const labData = this.filterResults(values[3], query, "first_name", "last_name");
          const servicesData = this.filterResults(values[4], query, "title");
          const diseasesData = this.filterResults(values[5], query, "title");
          specialitiesData.length && this.suggestions.push({ name: "specialities", data: specialitiesData });
          doctorsData.length && this.suggestions.push({ name: "doctors", data: doctorsData });
          hospitalsData.length && this.suggestions.push({ name: "hospitals", data: hospitalsData });
          labData.length && this.suggestions.push({ name: "laboratories", data: labData });
          servicesData.length && this.suggestions.push({ name: "services", data: servicesData });
          diseasesData.length && this.suggestions.push({ name: "diseases", data: diseasesData });
        });
        }
      }, this.debounceMilliseconds);
    },
    fetchResults() {
      const query = this.query;
      clearTimeout(this.timeout);
      this.timeout = setTimeout(() => {
        Promise.all([this.doctors, this.hospitals, this.laboratories, this.specialities, this.services, this.diseases]).then(values => {
          this.suggestions = [];
          this.selected = null;
          const doctorsData = this.filterResults(values[0], query, "first_name", "last_name");
          const hospitalsData = this.filterResults(values[1], query, "first_name", "last_name");
          const labData = this.filterResults(values[2], query, "first_name", "last_name");
          const specialitiesData = this.filterResults(values[3], query, "title");
          const servicesData = this.filterResults(values[4], query, "title");
          const diseasesData = this.filterResults(values[5], query, "title");
          if (this.$parent.type === 'doctor') {
            specialitiesData.length && this.suggestions.push({ name: "specialities", data: specialitiesData });
            doctorsData.length && this.suggestions.push({ name: "doctors", data: doctorsData });
            hospitalsData.length && this.suggestions.push({ name: "hospitals", data: hospitalsData });
            labData.length && this.suggestions.push({ name: "laboratories", data: labData });
          }
          else if (this.$parent.type === 'laboratory') {
            labData.length && this.suggestions.push({ name: "laboratories", data: labData });
            doctorsData.length && this.suggestions.push({ name: "doctors", data: doctorsData });
            hospitalsData.length && this.suggestions.push({ name: "hospitals", data: hospitalsData });
            specialitiesData.length && this.suggestions.push({ name: "specialities", data: specialitiesData });
          }
          else if (this.$parent.type === 'hospital') {
            hospitalsData.length && this.suggestions.push({ name: "hospitals", data: hospitalsData });
            doctorsData.length && this.suggestions.push({ name: "doctors", data: doctorsData });
            labData.length && this.suggestions.push({ name: "laboratories", data: labData });
            specialitiesData.length && this.suggestions.push({ name: "specialities", data: specialitiesData });
          }
          else {
            specialitiesData.length && this.suggestions.push({ name: "specialities", data: specialitiesData });
            doctorsData.length && this.suggestions.push({ name: "doctors", data: doctorsData });
            hospitalsData.length && this.suggestions.push({ name: "hospitals", data: hospitalsData });
            labData.length && this.suggestions.push({ name: "laboratories", data: labData });
          }
          servicesData.length && this.suggestions.push({ name: "services", data: servicesData });
          diseasesData.length && this.suggestions.push({ name: "diseases", data: diseasesData });
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
                  src:'/uploads/users/' + image.id +'/' + image.profile.avatar,
                  class:"w_25px h_25 rounded-circle mr-2"
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
                  src:'/uploads/users/' + image.id +'/' + image.profile.avatar,
                  class:"w_25px h_25 rounded-circle mr-2"
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
                  src:'/uploads/users/'+ image.id +'/' + image.profile.avatar,
                  class:"w_25px h_25 rounded-circle mr-2"
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
                      src:'/uploads/specialities/' + image.image,
                      class:"w_25px h_25 rounded-circle mr-2"
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
                      src:'/uploads/services/' + image.image,
                      class:"w_25px h_25 rounded-circle mr-2"
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
                      src:'/uploads/disease/' + image.flag,
                      class:"w_25px h_25 rounded-circle mr-2"
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
        Promise.all([this.locations]).then(values => {
          this.suggestionsLocation = [];
          this.selectedLocation = null;
          const locationsData = this.filterResultsLocation(values[0], query, "title");
          // console.log(locationsData,'tests');
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
                  src:'/uploads/locations/' + image.flag,
                  class:"w_25px h_25 rounded-circle mr-2"
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
    // selectHandlerLocation(item) {
    //   if (item) {
    //     this.selected = item.item;
    //   }
    // },
    boldenLocation(text, suggestion) {
      let name = suggestion.item.title
      let regex = new RegExp("(" + text + ")", "gi")
      suggestion = name.replace(regex, "<b>$1</b>")
      return suggestion;
    },
  },
  watch: {

  }
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
.autosuggest__results-container {
  background: #fff;
  font-size: 16px;
  position: absolute;
  color: #212529;
  text-align: left;
  list-style: none;
  background-color: #fff;
  background-clip: padding-box;
  border-radius: .25rem;
  float: left;
  min-width: 10rem;
  z-index: 99;
  width: 88%;
  left: 15px;
  box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.34);
}
.autosuggest__results ul li:first-child {
  padding: 10px;
  background: #EDEDF6;
}
.search_main [cities] {
  width: 80% !important;
}
.autosuggest__results-item a{
    color: #212529;
}
.autosuggest__results-item a:hover{
    background: #ebe9e9;
    color: #212529 !important;
}
.dropdown-divider {
    margin: 0px;
}
.search_imgPadding{
  padding: 2px;
}
</style>