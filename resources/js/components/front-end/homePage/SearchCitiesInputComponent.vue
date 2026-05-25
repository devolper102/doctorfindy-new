<template>
  <div>
    <vue-autosuggest
        v-model="query"
        ref="autosuggest"
        @input="fetchLocation"
        @click="fetchResults"
        @selected="onSelected"
        :suggestions="suggestions"
        :inputProps="inputProps"
        :sectionConfigs="sectionConfigs"
        :getSuggestionValue="getSuggestionValue"
    >
      <template slot-scope="{ suggestion }">
        <div role="separator" class="dropdown-divider"></div>
          <a href="javascript:void(0)" class="p-2 w-100 d-block clearfix locationListMain">
            <span v-if="suggestion.item.flag" :class="[colors[suggestion.item.id], { avatar: true }]" class="w_25px h_25 rounded-circle mr-2 search_imgPadding d-inline-block locationListImg">
              <img v-lazy="basePath+'/uploads/locations/' + suggestion.item.flag" :name="suggestion.item.title" :alt="suggestion.item.title" class="img-fluid">
            </span>
            <span v-else :class="{ avatar: true }" class="w-40px h_40 rounded-circle mr-2 search_imgPadding search-img-bg d-inline-block">
              <img v-lazy="basePath+'/uploads/locations/default/location.svg'" :name="suggestion.item.title" :alt="suggestion.item.title" class="img-fluid">
            </span>
            <span v-html="bolden(query, suggestion)"></span>
          </a>

      </template>
    </vue-autosuggest>
      <!-- <a href="#" class="text_black detect_btn d-block d-lg-none">Detect 
        <svg width="15px" height="15px" viewBox="0 0 561 561" fill="#3d4461" style="margin-bottom: 2px;"><path d="M280.5,178.5c-56.1,0-102,45.9-102,102c0,56.1,45.9,102,102,102c56.1,0,102-45.9,102-102 C382.5,224.4,336.6,178.5,280.5,178.5z M507.45,255C494.7,147.9,410.55,63.75,306,53.55V0h-51v53.55 C147.9,63.75,63.75,147.9,53.55,255H0v51h53.55C66.3,413.1,150.45,497.25,255,507.45V561h51v-53.55 C413.1,494.7,497.25,410.55,507.45,306H561v-51H507.45z M280.5,459C181.05,459,102,379.95,102,280.5S181.05,102,280.5,102 S459,181.05,459,280.5S379.95,459,280.5,459z"></path></svg>
      </a> -->
  </div>
</template>

<script>
import { VueAutosuggest } from 'vue-autosuggest';
export default {
  components: { VueAutosuggest },
  name: "SearchCitiesInputComponent",
  props:[
    'locations', 'fileSystemDriver'
  ],
  data() {
    return {
      basePath:'',
      colors:['','red_circle','green_circle','blue_circle','red_circle','red_circle','green_circle','blue_circle','red_circle','red_circle','green_circle','blue_circle','red_circle','red_circle','green_circle','blue_circle','red_circle'],
      position: '',
      location: '',
      query: "",
      results: [],
      timeout: null,
      selected: null,
      debounceMilliseconds: 250,
      inputProps: {
        id: "autosuggest__input",
        placeholder: "Select Location ",
        class: "form-control rounded-pill text_14",
        name: "location"
      },
      suggestions: [],
      sectionConfigs: {
        locations: {
          limit: 4,
          label: "Locations",
          onSelected: selected => {
            this.$parent.locationSlug = selected.item.slug
            this.$parent.selectedLocation.push(selected.item)
            this.selected = selected.item.slug;

          }
        },
      }
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
  created() {
    let location = this.locations.find(x => x.title === 'Lahore')
    this.query = 'Lahore'
    this.$parent.selectedLocation.push(location)
    this.selected = this.$parent.selectedLocation
  },
  computed: {
  },
  methods: {
    fetchLocationData(){
      axios.get('/get-location',{params:{ query:this.query}}).then((response) => {
        if(response.data.locations.length > 0){
          this.locations = [];
          response.data.locations.forEach((item, index)=>{
              this.locations.push(item)
            })
        }
        this.fetchResults();
        })
     },
     fetchLocation() {
     setTimeout(() => {
            this.fetchLocationData();
       }, 1000);
    },
    fetchResults() {
      const query = this.query;

      clearTimeout(this.timeout);
      this.timeout = setTimeout(() => {
        Promise.all([this.locations]).then(values => {
          this.suggestions = [];
          this.selected = null;
          const locationsData = this.filterResults(values[0], query, "title");
          locationsData.length && this.suggestions.push({ name: "locations", data: locationsData });

        });
      }, this.debounceMilliseconds);
    },
    filterResults(data, text, field) {
      return data
          .filter(item => {
            if (item[field].toLowerCase().indexOf(text.toLowerCase()) > -1) {
              return item[field];
            }
          })
          .sort();
    },
    renderSuggestion(suggestion) {
      if (suggestion.name === "locations") {
        const image = suggestion.item;

        return this.$createElement("a", {attrs: {
            href: '#',
            class: "dropdown-item"
          }
        }, [
          this.$createElement("img", {attrs: {
                  src:'/uploads/locations/' + image.flag,
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
    getSuggestionValue(suggestion) {
      let { name, item } = suggestion;
      if (name === "locations"){
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
      let name = suggestion.item.title
      let regex = new RegExp("(" + text + ")", "gi")
      suggestion = name.replace(regex, "<b>$1</b>")

      return suggestion;
    },
    onSelected(option) {
          this.selected = option.item;

      },
  },
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
  .autosuggest__results {
    width: 100%;
    max-height: 270px;
    font-size: 14px;
    padding: 0px;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.34);
  }
  .autosuggest__results ul li:first-child {
    padding: 10px;
    background: #EDEDF6;
  }
  .search_main [cities] {
    width: 100% !important;
  }
  .autosuggest-autosuggest__results{
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.34);
  }
  .search_imgPadding{
    padding: 2px;
  }
</style>