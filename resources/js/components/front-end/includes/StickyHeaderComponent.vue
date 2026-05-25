<template>
  <div>
    <div class="bg-white box_shadow w-100 position-relative p-3 sticky-header d-none d-lg-block" style="z-index: 999;
    position: fixed !important;
    top: 0;
    left: 0;
    right: 0;">
      <div class="container">
        <div class="row">
          <div class="sticky_main d-flex w-100">
            <div class="sticklogo w-sm-30 w-15 d-flex">
              <a href="/" class="navbar-brand w-sm-40 d-flex w-100">
                <img v-lazy="basePath+'/uploads/settings/general/'+ main_logo" alt="Site Logo" name="Site Logo" />
              </a>
            </div>
             <form class="form-inline d-lg-flex m-0 w-65">
              <div class=" location_input w-30 pr-2 position-relative" id="sticky_location">
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
                    <a href="javascript:void(0)" class="p-2 w-100 d-inline-block text-dark">
                      <div class="rounded-circle w-40px h_40 mr-2 red_circle float-left p-1 search-img-bg">
                        <v-lazy-image v-if="suggestion.item.flag" :class="{ avatar: true }" :src="basePath+'/uploads/locations/' + suggestion.item.flag" :name="suggestion.item.title" :alt="suggestion.item.title" class="img-fluid"/>
                        <v-lazy-image v-else :class="{ avatar: true }" :src="basePath+'/uploads/locations/default/location.svg'" :name="suggestion.item.title" :alt="suggestion.item.title" class="img-fluid"/>
                      </div>
                      <p style="overflow:hidden;text-overflow: ellipsis;" v-html="boldenLocation(query, suggestion)"/></p>
                    </a>
                  </template>
                </vue-autosuggest>
                <span class="banner_locationIcon">
                  <i class="fa fa-map-marker fa-sm" aria-hidden="true"></i>
                </span>
              </div>
              <div class="input-group w-70 search_main" id="main_sticky_header" style="color:black;">
        <vue-autosuggest
            class="w-100"
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
                <v-lazy-image v-if="suggestion.item.profile.avatar !== null" :class="{ avatar: true }" :src="basePath+'/uploads/users/' + suggestion.item.id + '/small-' + suggestion.item.profile.avatar" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name" class="w-40px h_40 rounded-circle mr-2 search-img-bg"/>
                <v-lazy-image v-else :class="{ avatar: true }" :src="basePath+'/uploads/users/default/doctor.svg'" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name" class="w-40px h_40 rounded-circle mr-2"/>
                <span v-html="bolden(query, suggestion)"/>
              </a>
            </div>
            <div v-if="suggestion.label === 'Hospitals'">
              <div role="separator" class="dropdown-divider"></div>
              <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
                <v-lazy-image v-if="suggestion.item.profile.avatar !== null" :class="{ avatar: true }" :src="basePath+'/uploads/users/' + suggestion.item.id + '/' + suggestion.item.profile.avatar" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name" class="w-40px h_40 rounded-circle mr-2"/>
                <v-lazy-image v-else :class="{ avatar: true }" :src="basePath+'/uploads/users/default/hospital.svg'" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name" class="w-40px h_40 rounded-circle mr-2 search-img-bg"/>
                <span v-html="bolden(query, suggestion)"/>
              </a>
            </div>
            <div v-if="suggestion.label === 'Laboratories'">
              <div role="separator" class="dropdown-divider"></div>
              <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
                <v-lazy-image v-if="suggestion.item.profile.avatar !== null" :class="{ avatar: true }" :src="basePath+'/uploads/users/' + suggestion.item.id + '/' + suggestion.item.profile.avatar" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name" class="w-40px h_40 rounded-circle mr-2"/>
                <v-lazy-image v-else :class="{ avatar: true }" :src="basePath+'/uploads/users/default/lab.svg'" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name" class="w-40px h_40 rounded-circle mr-2 search-img-bg"/>
                <span v-html="bolden(query, suggestion)"/>
              </a>
            </div>
            <div v-if="suggestion.label === 'Specialities'">
              <div role="separator" class="dropdown-divider"></div>
              <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
                <span v-if="suggestion.item.image !== null" class="w-40px h_40 rounded-circle mr-2 search_imgPadding d-inline-block" :class="[colors[suggestion.item.id], { avatar: true }]">
                  <v-lazy-image   :src="basePath+'/uploads/specialities/' + suggestion.item.image" :alt="suggestion.item.title" :name="suggestion.item.title"/>
                </span>
                <span v-else :class="{ avatar: true }" class="w-40px h_40 rounded-circle mr-2 search_imgPadding search-img-bg d-inline-block">
                  <v-lazy-image  :src="basePath+'/uploads/specialities/default/speciality.svg'" :alt="suggestion.item.title" :name="suggestion.item.title"  />
                </span>
                <span v-html="bolden(query, suggestion)"/>
              </a>
            </div>
            <div v-if="suggestion.label === 'Services'">
              <div role="separator" class="dropdown-divider"></div>
              <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
                <v-lazy-image v-if="suggestion.item.image !== null" :class="{ avatar: true }" :src="basePath+'/uploads/services/' + suggestion.item.image" :alt="suggestion.item.title" :name="suggestion.item.title" class="w-40px h_40 rounded-circle mr-2"/>
                <v-lazy-image v-else :class="{ avatar: true }" :src="basePath+'/uploads/services/default/service.svg'" :alt="suggestion.item.title" :name="suggestion.item.title" class="w-40px h_40 rounded-circle mr-2 search-img-bg"/>
                <span v-html="bolden(query, suggestion)"/>
              </a>
            </div>
            <div v-if="suggestion.label === 'Diseases'">
              <div role="separator" class="dropdown-divider"></div>
              <a href="javascript:void(0)" class="p-2 w-100 d-inline-block">
                <v-lazy-image v-if="suggestion.item.flag !== null" :class="[colors[suggestion.item.id], { avatar: true }]" :src="basePath+'/uploads/disease/' + suggestion.item.flag" :alt="suggestion.item.title" :name="suggestion.item.title" class="w-40px h_40 rounded-circle mr-2"/>
                <v-lazy-image v-else :class="{ avatar: true }" :src="basePath+'/uploads/diseases/default/disease.svg'" :alt="suggestion.item.title" :name="suggestion.item.title" class="w-40px h_40 rounded-circle mr-2 search-img-bg"/>
                <span v-html="bolden(query, suggestion)"/>
              </a>
            </div>
          </template>
        </vue-autosuggest>
        <span class="input-group-btn btn_position"><a   href="/doctors"type="button" class="btn knockdoc_btn_bg banner_btn text-white text_14">Search
          <span><i data-v-40bb7c29="" aria-hidden="true" class="fa fa-search fa-sm"></i></span></a></span>
      </div>
            </form> 
            <ul class="m-0 w-30">
              <li v-if="logged_user.length !== undefined"  class="nav-item header_margin position-relative sticky_header_cstm_border mr-0 mt-1 float-right">
                <a href="/login" class="nav-link header_cstm_border float-left text_black applink position-relative">Login </a>
                <a href="/register" class="nav-link float-left text_black applink "> Register</a>
              </li>
              <li v-if="logged_user.length === undefined" class=" dropdown d-none d-lg-block header_margin position-relative pb-2 float-right">
                <div class="d-inline-block user_dropdown_main">
                  <a class="nav-link float-left pl-0 text_black" href="javascript:void(0)">{{logged_user.first_name}} {{logged_user.last_name}}</a>
                  <a class="float-left" href="javascript:void(0)">
                    <v-lazy-image v-if="logged_user.profile.avatar !== null" class="h_40 w-40px border-1 border border-white rounded-circle d-flex" :src="basePath+'/uploads/users/'+logged_user.id+'/'+logged_user.profile.avatar" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name"/>
                    <v-lazy-image v-else-if="logged_user.roles[0].name === 'doctor'" class="h_40 w_40px border-1 border border-white rounded-circle d-flex" :src="basePath+'/uploads/users/default/doctor.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name"/>
                    <v-lazy-image v-else-if="logged_user.roles[0].name === 'hospital'" :src="basePath+'/uploads/users/default/hospital.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name" class="h_40 w_40px border-1 border border-white rounded-circle d-flex"/>
                    <v-lazy-image v-else-if="logged_user.roles[0].name === 'patient'" :src="basePath+'/uploads/users/default/patient.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name" class="h_40 w_40px border-1 border border-white rounded-circle d-flex"/>

                    <v-lazy-image v-else-if="logged_user.roles[0].name === 'laboratory'" :src="basePath+'/uploads/users/default/lab.svg'" :alt="logged_user.first_name+' '+logged_user.last_name" :name="logged_user.first_name+' '+logged_user.last_name" class="h_40 w_40px border-1 border border-white rounded-circle d-flex"/>
                  </a>
                  <div class="dropdown-menu user_dropdown_list w-100 box_shadow box_radius text_12">
                    <a class="dropdown-item" :href="'/'+logged_user.roles[0].name+'/dashboard'">Dashboard</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/doctors">Book appointment</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" :href="'/'+logged_user.roles[0].name+'/appointments'">My appointment</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" :href="'/'+logged_user.roles[0].name+'/dashboard#wish-list'">Wish list</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" @click="logout()"> Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { VueAutosuggest } from 'vue-autosuggest'
import VLazyImage from "v-lazy-image/v2";
export default {
  components: { VueAutosuggest, VLazyImage},
  name: "StickyHeaderComponent",
  props: ['cities','logged_user','doctorss','hospitalss','laboratorys','specialitys','servicess','diseasess','managements', 'fileSystemDriver'],
  data() {
    return {
      basePath:'',
      colors:['','red_circle','green_circle','blue_circle','red_circle','red_circle','green_circle','blue_circle','red_circle','','red_circle','green_circle','blue_circle','red_circle','red_circle','green_circle','blue_circle','red_circle','','red_circle','green_circle','blue_circle','red_circle','red_circle','green_circle','blue_circle','red_circle','','red_circle','green_circle','blue_circle','red_circle','red_circle','green_circle','blue_circle','red_circle','','red_circle','green_circle','blue_circle','red_circle','red_circle','green_circle','blue_circle','red_circle'],
      query: "",
      specialities: this.specialitys,
      doctors: this.doctorss,
      hospitals: this.hospitalss,
      diseases: this.diseasess,
      services: this.servicess,
      laboratories: this.laboratorys,
      locations: this.cities,
      site_logo: '' ,
      main_logo: '',
      results: [],
      timeout: null,
      selected: null,
      debounceMilliseconds: 250,
      inputProps: {
        id: "autosuggest__input",
        placeholder: "Search for doctors, hospitals, specialties, services, disease",
        class: "form-control banner_input text_13 w-100",
        name: "search"
      },
       queryLocation: "",
      resultsLocation: [],
      timeoutLocation: null,
      selectedLocation: [],
      debounceMillisecondsLocation: 250,
      inputPropsLocation: {
        id: "autosuggest__input__location",
        placeholder: "Select Location ",
        class: "form-control rounded-pill mr-3 text_13",
        name: "location"
      },
      suggestionsLocation: [],
      sectionConfigsLocation: {
        locations: {
          limit: 4,
          label: "Locations",
          onSelected: selected => {
            this.selectedLocation.push(selected.item)
            this.selected = selected.item;
          }
        },
      },

      suggestions: [],
      sectionConfigs: {
        hospitals: {
          limit: 4,
          label: "Hospitals",
          onSelected: selected => {
            this.selectedItem(selected)
            this.selected = selected.item;
          }
        },
        doctors: {
          limit: 4,
          label: "Doctors",
          onSelected: selected => {
           this.selectedItem(selected)
            this.selected = selected.item;
          }
        },
        laboratories: {
          limit: 4,
          label: "Laboratories",
          onSelected: selected => {
            this.selectedItem(selected)
            this.selected = selected.item;
          }
        },
        specialities: {
          limit: 4,
          label: "Specialities",
          onSelected: selected => {
           this.selectedItem(selected)
            this.selected = selected.item;
          }
        },
        services: {
          limit: 4,
          label: "Services",
          onSelected: selected => {
            this.selectedItem(selected)
            this.selected = selected.item;
          }
        },
        diseases: {
          limit: 4,
          label: "Diseases",
          onSelected: selected => {
            this.selectedItem(selected)
            this.selected = selected.item;
          }
        },
      },

    }
  },
created() {
      let location = this.locations.find(x => x.title === 'Lahore')
      this.queryLocation = 'Lahore'
      this.selectedLocation.push(location)
      // this.selected = this.$parent.selectedLocation
    
       this.site_logo = this.managements.find(pf =>pf.meta_key ==='general_settings')
       this.main_logo = JSON.parse(this.site_logo.meta_value).site_logo;

  },
  mounted() {
    if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  methods: {
    logout() {
      axios.post(APP_URL + '/logout')
          .then(function (response) {
              window.location = APP_URL

          })
          .catch(function (error) {

          })
    },
    getData(){

      axios.get('/get-search',{params:{ query:this.query}}).then((response) => {
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
     selectedItem(result) {
      if (this.selectedLocation.length > 0) {
        if (result.label === 'Doctors') {
          window.location.href = '/doctors/'+result.item.location.slug+'/'+result.item.specialities[0].slug+'/'+result.item.slug
        }
        else if (result.label === 'Hospitals') {
          window.location.href = '/hospitals/'+result.item.location.slug+'/'+result.item.slug
        }
        else if (result.label === 'Specialities') {
          /*  dermatologist-in-lahore  */
          
          window.location.href = '/'+result.item.slug+'-in-pakistan'
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
          
             window.location.href = '/labs/'+result.item.location.slug+'/'+result.item.slug+'/lab'
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
          
             window.location.href = '/labs/'+result.item.location.slug+'/'+result.item.slug+'/'+result.item.area.slug
        }
        // else {}
      }
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
                  class:"w-40px h_40 rounded-circle mr-2"
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
                  class:"w-40px h_40 rounded-circle mr-2"
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
                  class:"w-40px h_40 rounded-circle mr-2"
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
                      class:"w-40px h_40 rounded-circle mr-2"
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
                      class:"w-40px h_40 rounded-circle mr-2"
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
                      class:"w-40px h_40 rounded-circle mr-2"
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
                  class:"w-40px h_40 rounded-circle mr-2"
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
  // watch: {

  // }

}
</script>
<style>

.sticky-header {
  z-index: 999;
  position: fixed !important;
  top: 0;
  left: 0;
  right: 0;
}
/*#main_sticky_header .autosuggest__results-container{
  left: 20px !important;
}*/
.sticky_header_cstm_border:after{
  opacity: 0.6;
}
#sticky_location .autosuggest__results-container .autosuggest__results ul{
  margin:0px;
}
#sticky_location .banner_locationIcon{
  position: absolute;
  margin-left: 5px;
  height: 25px;
  display: flex;
  color: #073B4C;
  align-items: center;
  right: 25px;
  top: 10px;
}
#sticky_location .autosuggest__results-container{
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
  z-index: 1000;
  width: 86%;
  left: 10px;
  box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.34);
}
#sticky_location .autosuggest__results{
  width: 100%;
  max-height: 253px;
  overflow-y: scroll;
  font-size: 14px;
  padding: 0px;
}
#main_sticky_header .autosuggest__results-item a{
  color: #212529;
}
#main_sticky_header .autosuggest__results-item a:hover{
  background: #ebe9e9;
  color: #212529 !important;
}
.search-img-bg{
  background: #ea4335;
}
.search_imgPadding{
  padding: 2px;
}
#main_sticky_header .autosuggest__results-container {
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
  z-index: 1000;
  width: 79% !important;
  left: 20px !important;
  top: 50px !important;
  box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.34);
  }
#main_sticky_header  .banner_location .autosuggest__results-container {
  width: 85% !important;
  left: 5px !important;
  }
#main_sticky_header  .autosuggest__results {
  width: 100%;
  max-height: 253px;
  overflow-y: scroll;
  font-size: 14px;
  padding: 0px;
  }
#main_sticky_header  .autosuggest__results ul{
  margin:0px;
}
#main_sticky_header  .autosuggest__results ul li:first-child , #sticky_location .autosuggest__results-container ul li:first-child {
  padding: 10px;
  background: #EDEDF6;
  }
  .location_input input{
  width: 100% !important;
  padding: 1.375rem 0.75rem;
  }
#main_sticky_header .location_input > span {
  position: absolute;
  margin-left: 5px;
  height: 25px;
  display: flex;
  color: #073B4C;
  align-items: center;
  right: 25px;
  top: 10px;
}
  
</style>
