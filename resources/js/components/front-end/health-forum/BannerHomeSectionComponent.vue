<template>
  <div>
    <!--  <div class="container">
      <div class="row">
            <div class="col-12 mt-4">
              <bread-crumb-spec></bread-crumb-spec>
            </div>
      </div>
    </div> -->
    <div class="position-relative d-inline-block w-100 banner_main">
      
      <div class="banner-health-community">
        <div class="container-fluid">
          <div class="row">
            <div class="col">
              <div class="banner_left_section">
                <div class="community_banner_heading">
                  <h1 class="text-white text_md_20"><span>DoctorFindy Health Community</span>
                  </h1>
                  <span class="text-white text_25 text_md_16">Get answesrs to your questions</span>
                </div>
                <!-- <div class="form-inline d-xs-block d-sm-block d-md-block d-lg-none position-relative mb-3">
                  <span class="form-control banner_input p-2 text_14 w-sm-80 d-table" data-toggle="modal" data-target="#search_doctor_on_device"> Search for doctors and Hospitals</span>
                  <button class="btn knockdoc_btn_bg banner_btn p-2 text-white text_14 position-absolute mobile_search_btn" type="button">Search
                    <span>
						    				<i class="fa fa-search fa-sm" aria-hidden="true"></i>
						  				</span>
                  </button>
                </div> -->
                <form class="form-inline d-inline-block mt-4 bannerfixSearch">
                  <div class="input-group search_main" id="simple_search">
                    <!-- <input type="text" class="form-control banner_input text_14" id="main_Search" placeholder="Search or Ask a Questions" data-toggle="dropdown"> -->
                    <div class="select-hospital position-relative w-100">
                        <vue-autosuggest
                            v-model="query"
                            :suggestions="suggestions"
                            :inputProps="inputProps"
                            @click="fetchResults"
                            @input="fetchResults"
                            :getSuggestionValue="getSuggestionValue"
                            :sectionConfigs="sectionConfigs"
                            id="autosuggest_main"
                        >
                          <template slot-scope="{suggestion}">
                            <div role="separator" class="dropdown-divider"></div>
                            <span class="my-suggestion-item p-2 w-100 d-inline-block">
                            {{suggestion.item.question_title}}</span>
                          </template>
                        </vue-autosuggest>
                      </div>
                    <span class="input-group-btn d-none d-lg-block position-absolute" style="top: 0;right: 0;">
    									<button class="btn bg-green banner_btn text-white text_14 h_45" type="button">Search
    										<span>
							    				<i class="fa fa-search fa-sm" aria-hidden="true"></i>
							  				</span>
    									</button>
  									</span>
                    <span class="input-group-btn d-block d-lg-none mobile_search_btn btn_position position-absolute" style="top: 0;right: 0;">
                      <button class="btn bg-green banner_btn text-white text_14 h_45" type="button">
                        <span>
                          <i class="fa fa-search fa-sm" aria-hidden="true"></i>
                        </span>
                      </button>
                    </span>
                    <!-- <div class="dropdown-menu banner_main_search w-85">
                      <p class="p-2 w-100">Specialties</p>
                      <a class="dropdown-item" href="#"><img src="/images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Allergy Immunology</a>
                      <div role="separator" class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#"><img src="/images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Family Medicine</a>
                      <p class="p-2 w-100">Hospitals</p>
                      <a class="dropdown-item" href="#"><img src="/images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Doctor Hospital</a>
                      <div role="separator" class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#"><img src="/images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Jinnah Hospital</a>
                      <p class="p-2 w-100">Doctors</p>
                      <a class="dropdown-item" href="#"><img src="/images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Dr. David</a>
                      <div role="separator" class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#"><img src="/images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Dr. Alex</a>
                      <div role="separator" class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#"><img src="/images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Dr. Smith</a>
                      <p class="p-2 w-100">Services</p>
                      <a class="dropdown-item" href="#"><img src="/images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Book a Test</a>
                      <div role="separator" class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#"><img src="/images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Services</a>
                      <div role="separator" class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#"><img src="/images/banner-1.png" class="w-30px h_30 rounded-circle mr-2">Find a doctor</a>
                    </div> -->
                  </div>
                    <div class="input-group w-55 search_main">

                      
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { VueAutosuggest } from 'vue-autosuggest';
export default {
   components: { VueAutosuggest },
name: "BannerHomeSectionComponent",
props: ['segments','forums'],
 data() {
    return {
       resultSegments: this.segments,
      search: '',
      doctors: [],
      details: [],
      keys: [],
      selectedForums: '',
      allForums: this.forums,
      query: "",
      results: [],
      timeout: null,
      selected: null,
      suggestions: [],
      debounceMilliseconds: 250,
      inputProps: {
        id: "forums",
        placeholder: "Search Questions",
        class: "form-control banner_input text_14 w-100 h_45",
        name: "search"
      },
      sectionConfigs: {

        forums: {
          limit: 4,
           label: "",
          onSelected: selected => {
            this.setSelected(selected)
            this.selected = selected.item;
          }
        },
      },
    }
  },
  created () {
console.log('questions',this.forums)
  },
  methods: {
    setSelected(value) {
      let self = this
      this.selectedForums = value.item
      console.log('selectedForums',this.selectedForums);
       window.location.href = '/ask-a-doctor-online/speciality/'+this.selectedForums.speciality.slug+'#'+this.selectedForums.slug
      //  trigger a mutation, or dispatch an action
    },
    fetchResults() {
      let self = this
      const query = this.query;
      clearTimeout(this.timeout);
      this.timeout = setTimeout(() => {
        Promise.all([self.allForums]).then(values => {
          console.log(self.allForums, values)
          this.suggestions = [];
          this.selected = null;
          const forumsData = this.filterResults(values[0], query, "question_title");
          forumsData.length && this.suggestions.push({ name: "forums", data: forumsData });
        });
      }, this.debounceMilliseconds);
    },
    filterResults(data, text, field) {
      console.log(data, text, field)
      return data
          .filter(item => {
            if (item[field].toLowerCase().indexOf(text.toLowerCase()) > -1) {
              return item[field];
            }
          })
          .sort();
    },
    getSuggestionValue(suggestion) {
      let { name, item } = suggestion;
      if (name === "forums"){
        return item.question_title ;
      }
    },
  },
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
.banner_main_search{
  left: 10px !important;
}
#autosuggest_main input{
  border-radius: 50px;
  padding: 0.75rem 6rem 0.75rem 0.75rem !important;
  height: auto;
  width: 100%;
}
.modal_search:after{
  display: none;
}
#autosuggest_main #autosuggest-autosuggest__results  .autosuggest__results{
  position: absolute !important;
  width: 86% !important;
  background: #fff !important;
  top: 46px !important;
  left: 15px !important;
  box-shadow: 0px 5px 10px rgb(0 0 0 / 34%);
  max-height: 135px;
  z-index: 100;
}
#autosuggest_main #autosuggest-autosuggest__results  .autosuggest__results ul{
  margin: 0px !important;
}

#autosuggest_main #autosuggest-autosuggest__results  .autosuggest__results ul li{
  cursor: pointer;
}
#autosuggest_main #autosuggest-autosuggest__results  .autosuggest__results ul li:hover{
  background: #ebe9e9;
}
.bannerfixSearch{
  width: 680px !important;
}
@media (max-width: 767px){
  #autosuggest_main #autosuggest-autosuggest__results  .autosuggest__results{
    width: 100% !important;
    left: 0px !important;
  }
  .bannerfixSearch{
    width: 100% !important;
  }
  #autosuggest_main input{
    padding: 0.75rem 2rem 0.75rem 0.75rem !important;
  }
}
</style>