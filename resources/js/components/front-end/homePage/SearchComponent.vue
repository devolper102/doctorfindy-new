<template>
  <div>

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
      <!--  @focus="getData()" -->
      <template slot-scope="{ suggestion }">
        <div v-if="suggestion.label === 'Specialities'">
          <div role="separator" class="dropdown-divider"></div>
          <a href="javascript:void(0)" class="p-1 w-100 d-block searchListMain clearfix">
            <span v-if="suggestion.item.image !== null" class="w_25px h_25 rounded-circle mr-2 red_circle d-inline-block bannerSearchImg" :class="[colors[suggestion.item.id], { avatar: true }]">
              <img v-lazy="basePath+'/uploads/specialities/' + suggestion.item.image" :alt="suggestion.item.title" :name="suggestion.item.title">
            </span>
            <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 red_circle d-inline-block bannerSearchImg">
              <img v-lazy="basePath+'/uploads/specialities/default/speciality.svg'" :alt="suggestion.item.title" :name="suggestion.item.title">
            </span>
            <span v-html="bolden(query, suggestion)"/>
          </a>
        </div>
        <div v-if="suggestion.label === 'Doctors'">
          <div role="separator" class="dropdown-divider"></div>
          <a href="javascript:void(0)" class="p-1 w-100 d-block searchListMain clearfix">
            <span v-if="suggestion.item.profile.avatar !== null" class="w_25px h_25 rounded-circle mr-2 red_circle d-inline-block bannerSearchImg" :class="[colors[suggestion.item.id], { avatar: true }]">
              <img v-lazy="basePath+'/uploads/users/' + suggestion.item.id + '/small-' + suggestion.item.profile.avatar" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name" class="rounded-circle">
            </span>
            <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 red_circle d-inline-block bannerSearchImg">
              <img v-lazy="basePath+'/uploads/users/default/doctor.svg'" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name">
            </span>
            <span v-html="bolden(query, suggestion)"/>
          </a>
        </div>
        <div v-if="suggestion.label === 'Hospitals'">
          <div role="separator" class="dropdown-divider"></div>
          <a href="javascript:void(0)" class="p-1 w-100 d-block searchListMain clearfix">
            <span v-if="suggestion.item.profile.avatar !== null" class="w_25px h_25 rounded-circle mr-2 red_circle d-inline-block bannerSearchImg" :class="[colors[suggestion.item.id], { avatar: true }]">
              <img  v-lazy="basePath+'/uploads/users/' + suggestion.item.id + '/small-' + suggestion.item.profile.avatar" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name" class="rounded-circle">
            </span>
            <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 red_circle d-inline-block bannerSearchImg">
              <img v-lazy="basePath+'/uploads/users/default/hospital.svg'" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name">
            </span>
            <span v-html="bolden(query, suggestion)"/>
          </a>
        </div>
        <div v-if="suggestion.label === 'Laboratories'">
          <div role="separator" class="dropdown-divider"></div>
          <a href="javascript:void(0)" class="p-1 w-100 d-block searchListMain clearfix">
            <span v-if="suggestion.item.profile.avatar !== null" class="w_25px h_25 rounded-circle mr-2 red_circle d-inline-block bannerSearchImg" :class="[colors[suggestion.item.id], { avatar: true }]">
              <img  :class="{ avatar: true }" v-lazy="basePath+'/uploads/users/' + suggestion.item.id + '/medium-' + suggestion.item.profile.avatar" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name" class="rounded-circle">
            </span>
            <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 red_circle d-inline-block bannerSearchImg">
              <img v-lazy="basePath+'/uploads/users/default/lab.svg'" :name="suggestion.item.first_name+' '+suggestion.item.last_name"  :alt="suggestion.item.first_name+' '+suggestion.item.last_name">
            </span>
            <span v-html="bolden(query, suggestion)"/>
          </a>
        </div>
        <div v-if="suggestion.label === 'Services'">
          <a href="javascript:void(0)" class="p-1 w-100 d-block searchListMain clearfix">
            <span v-if="suggestion.item.image !== null" class="w_25px h_25 rounded-circle mr-2 red_circle d-inline-block bannerSearchImg" :class="[colors[suggestion.item.id], { avatar: true }]">
              <img v-lazy="basePath+'/uploads/services/' + suggestion.item.image" :alt="suggestion.item.title" :name="suggestion.item.title">
            </span>
            <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 red_circle d-inline-block bannerSearchImg">
              <img v-lazy="basePath+'/uploads/services/default/service.svg'" :alt="suggestion.item.title" :name="suggestion.item.title">
            </span>
            <span v-html="bolden(query, suggestion)"/>
          </a>
        </div>
        <div v-if="suggestion.label === 'Diseases'">
          <a href="javascript:void(0)" class="p-1 w-100 d-block searchListMain clearfix">
            <!-- :class="[colors]{ avatar: true }" -->
            <span v-if="suggestion.item.flag !== null" class="w_25px h_25 rounded-circle mr-2 red_circle d-inline-block bannerSearchImg" :class="[colors[suggestion.item.id], { avatar: true }]">
              <img  v-lazy="basePath+'/uploads/disease/' + suggestion.item.flag" :alt="suggestion.item.title" :name="suggestion.item.title">
            </span>
            <span v-else :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 red_circle d-inline-block bannerSearchImg">
              <img v-lazy="basePath+'/uploads/diseases/default/disease.svg'" :alt="suggestion.item.title" :name="suggestion.item.title">
            </span>
            <span v-html="bolden(query, suggestion)"/>
          </a>
        </div>
      </template>
    </vue-autosuggest>

  </div>
</template>

<script>
import { VueAutosuggest } from 'vue-autosuggest';

export default {
  components: { VueAutosuggest },
  name: "SearchComponent",
  props: ['locations','docs','hosp','labs','special','service','dise', 'fileSystemDriver'],
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
      locationSlug: this.$parent.locationSlug,
      debounceMilliseconds: 250,
      inputProps: {
        id: "autosuggest__input",
        placeholder: "Search for doctors, hospitals, specialties, services, disease",
        class: "form-control banner_input text_14 w-100",
        name: "search"
      },
      suggestions: [],
      sectionConfigs: {
        specialities: {
          limit: 4,
          label: "Specialities",
          onSelected: selected => {
            this.$parent.selectedItem(selected)
            this.selected = selected.item;
          }
        },
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
      }
    }
  },
  created() {
    // const specs = await axios.get('/all-spec')
    // this.specialities = Object.freeze(specs.data)

    // const doc = await axios.get('/all-docs')
    // this.doctors = Object.freeze(doc.data) 

    // const hosp = await axios.get('/all-hosp')
    // this.hospitals = Object.freeze(hosp.data)

    // const dis = await axios.get('/all-dise')
    // this.diseases = Object.freeze(dis.data)
    
    // const labs = await axios.get('/all-labs')
    // this.laboratories = Object.freeze(labs.data)

    // const sev = await axios.get('/all-services')
    // this.services = Object.freeze(sev.data)

    
    let i = this;
    this.specialities.forEach((item, index) => {
      if(item.top === '1'){
        i.specs.push(item);
      }
    })
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
    getData(){
      axios.get('/get-search',{params:{ query:this.query, location:this.$parent.locationSlug}}).then((response) => {
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
    // getData(){
    //   let self = this
    //             axios.get('/all-data')
    //                  .then((response)=>{
    //                    self.all_specialities = response.data
    //                  })
    // },
    renderSuggestion(suggestion) {
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
      if (name === "specialities"){
        return item.title;
      }
      if (name === "doctors"){
        return item.first_name + ' ' + item.last_name ;
      }
      if (name === "hospitals"){
        return item.first_name + ' ' + item.last_name ;
      }
      if (name === "laboratories"){
        return item.first_name + ' ' + item.last_name ;
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
      if (suggestion.name === 'services' || suggestion.name === 'specialities' || suggestion.name === 'diseases') {
        let name = suggestion.item.title
        let regex = new RegExp("(" + text + ")", "gi")
        suggestion = name.replace(regex, "<b>$1</b>")
        return suggestion;
      }
      if (suggestion.name === 'doctors' || suggestion.name === 'hospitals' || suggestion.name === 'laboratories') {
        let name = suggestion.item.first_name + ' ' + suggestion.item.last_name
        let regex = new RegExp("(" + text + ")", "gi")
        suggestion = name.replace(regex, "<b>$1</b>")
        return suggestion;
      }
    },
  },
  // watch: {

  // }
}
</script>

<style>
.autosuggest__results-item a{
    color: #212529;
}
.autosuggest__results-item a:hover{
    background: #ebe9e9;
    color: #212529 !important;
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
    border-radius: 0rem;
    float: left;
    min-width: 10rem;
    z-index: 99;
    width: 80%;
    left: 15px;
    top: 50px;
  }
  .banner_location .autosuggest__results-container {
    width: 85% !important;
    left: 12px !important;
  }
  .autosuggest__results {
    width: 100%;
    max-height: 253px;
    overflow-y: scroll;
    font-size: 14px;
    padding: 0px;
  }
  .autosuggest__results ul li:first-child {
    padding: 10px;
    background: #EDEDF6;
  }
  .search_main [cities] {
    width: 100% !important;
  }
  .search_imgPadding{
    padding: 2px;
  }
</style>