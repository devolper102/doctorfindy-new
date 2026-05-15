<template>
  <div>
  <!--     <div class="container">
      <div class="row">
            <div class="col-12 mt-4">
              <bread-crumb-spec></bread-crumb-spec>
            </div>
      </div>
    </div>  -->
    <div id="banner">
      <div class="inner-banner position-relative">
        <div class="wave_img d-none d-lg-block">
          <svg class="d-sm-none d-xs-none d-md-none d-lg-block" viewBox="0 0 500 500" preserveAspectRatio="xMinYMin meet">
            <defs>
              <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%"   stop-color="#BCCFFF"/>
                <stop offset="50%" stop-color="#BCCFFF"/>
                <stop offset="100%" stop-color="#BCCFFF"/>
              </linearGradient>
            </defs>
            <path d="M0, 260 C200, 260 190,0 500, 2 L500, -10 L0, 0 Z" style="fill : url(#gradient)">
            </path>
          </svg>
        </div>
        <section class="Coronary-artery-bypass-grafting d-inline-block w-100">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="heading-bypass-grafting mt-xl-5 mt-3 w-100 d-inline-block">
              <h1 class="text_black font-weight-bold text_30 text-xs-25">{{ procedure.title }}</h1>
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-12 col-lg-7">
            <div class="bg-white box_radius box_shadow">
              <div class="heading-box p-3">
                <!-- <ul class="procedure-surgery">
                  <li v-if="index < 4" v-for="(key, index) in keys" class="float-left mr-3 mb-3">
                    <a class="text_12 text_black font-weight-bold">{{ key.capitalize() }}:
                      <span class="font-weight-normal"> {{ details[key].capitalize() }}</span>
                    </a>
                  </li>
                </ul>
                <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div> -->
                <div class="procedure-surgery-text w-100 d-inline-block">
                  <span class="text_black font-weight-bold text_16">Introduction
                  </span>
                  <p class="text_14 text_black mt-2">
                    {{procedure.intro_procedure}}
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 pr-lg-0 col-lg-5 mt-3 mt-lg-0 
          pr-xs-3">
            <div class="bg-white box_shadow box_radius">
              <div class="heading-box p-2">
                <h2 class="text_black mb-0 text-xs-14 text_20 text-xs-18">{{ procedure.title }} Cost in Pakistan</h2>
                <p class="text_black text_12 mt-xs-3">Starting from</p>
                <div class="bypass-grafting-estimate w-50 mt-3 mb-2 p-2 float-left mt-xs-1 w-sm-80">
                  <p class="theme-color-text font-weight-bold text_15 text-xs-11">Estimated National Average</p>
                  <p class="theme-color-text font-weight-bold text_20 text-xs-18 pb-xs-2">Rs: <span v-if="procedure.range !==null" class="text_black">{{procedure.range}}</span>
                    <span v-else class="text_black">N/A</span></p>
                </div>
                <ul class="procedure-duration float-right mt-2 w-45 mt-xs-0 w-sm-100">
                  <li v-if="index > 3 && index < 7" v-for="(key, index) in keys" class="d-table">
                    <a class="text_13 text_black d-table-cell align-middle text-xs-11" ><span class="font-weight-bold">{{ key.capitalize() }}:</span> {{ details[key].capitalize() }}
                    </a>
                  </li>
                </ul>
                <div class="join-doctor-btn mb-2 mt-2 w-100 mt-xs-0 d-inline-block">
                  <a @click="showCostModal" class="rounded-pill bg-blue text-white p-2 btn_padding d-inline-block text-xs-13" data-toggle="modal" data-target="#bypass-grafting-modal">
                    Get estimated cost
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
      </div>
    </div>
    <!-- Start feedback Modal -->
    <!-- Start bypass grafting in pakistan modal -->
    <div class="modal fade" id="bypass-grafting-modal" tabindex="-1" role="dialog" aria-labelledby="mobile_number_detail" aria-hidden="true">
      <div class="modal-dialog bypass-grafting-popup" role="document">
        <div class="modal-content box_radius  box_shadow">
          <div class="modal-header p-0">
            <div class="w-100 d-inline-block box_radius box_bottom_lr_radius position-relative p-2">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                <div class="heading-bypass-grafting">
                  <p class="text_black font-weight-bold text_18 text-center text-xs-13">Get cost of {{ procedure.title }} in Pakistan</p>
                </div>
            </div>
          </div>
          <div class="modal-body p-4">
            <form method="POST" @submit.prevent="handleSubmit" >
              <div class="form-group w-100 d-inline-block">
                <label class="text_black text_15 mb-0 text-xs-13">Select hospital</label>
                <div class="select-hospital position-relative modal_search arrow_img">
                  <vue-autosuggest
                      v-model="query"
                      :suggestions="suggestions"
                      :inputProps="inputProps"
                      @click="fetchResults"
                      @input="fetchResults"
                      :getSuggestionValue="getSuggestionValue"
                      :sectionConfigs="sectionConfigs"
                  >
                    <template slot-scope="{suggestion}">
                      <span class="my-suggestion-item p-2 w-100 d-inline-block">{{suggestion.item.first_name}} {{suggestion.item.last_name}}</span>
                    </template>
                  </vue-autosuggest>
                </div>
              </div>
              <div class="form-group w-100 d-inline-block">
                <label class="text_black text_15 mb-0 text-xs-13">Enter full name
                </label>
                <input name="full_name" v-model="full_name" @keypress="isLetter($event)" type="text" class="form-control h_45 text_14 bg-white input-border" id="firstnameInputText" aria-describedby="emailHelp" placeholder="Enter full name">
              </div>
              <div class="form-group w-100 d-inline-block">
                <label class="text_black text_15 mb-0 w-100 text-xs-13">Contact number</label>
                <input name="phone_number" v-model="phone_number"  @keypress="isNumber($event)" type="text" class="form-control h_45 text_14 bg-white input-border" id="phoneInputPhone" aria-describedby="emailHelp" placeholder="03XXXXXXXXX" maxlength="11">
              </div>
              <div class="form-group w-100 d-inline-block">
                <label class="mb-0 text_15 text_black text-xs-13">Email ID</label>
                <input name="email" v-model="email"  type="email" class="form-control h_45 text_14 bg-white input-border" id="emailInputEmail" aria-describedby="emailHelp" placeholder="Enter email">
              </div>
              <div class="modal-footer border-0 p-0 w-100 d-inline-block">
                <label class="mb-0 text_15 text_black w-100 d-inline-block text-xs-13">Age
                </label>
                <div class="form-group w-48 float-left">
                  <!-- <label class="mb-0 text_15 text_black">Date of Birth</label> -->
                  <input name="dob" v-model="dob"  @keypress="isNumber($event)"type="text" class="form-control h_45 text_14 bg-white input-border" id="dateInput" aria-describedby="emailHelp" placeholder="Enter age" maxlength="2">
                </div>
                <div class="modal_footer_btn w-48 d-inline-flex m-0 float-right mt-1 ml-0 mr-0 mb-0">
                  <input type="submit" class="bg-blue rounded-pill w-100 text-white p-2 text-center number_modal font-weight-bold border-0">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End  bypass grafting in pakistan modal -->

    <!-- End feedback Modal -->

  </div>
</template>

<script>
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1).split('_').join(' ');
}
import { VueAutosuggest } from 'vue-autosuggest';
import Toasted from 'vue-toasted';
Vue.use(Toasted)

export default {
  components: { VueAutosuggest },
  name: "DetailsSectionComponent",
  props: ['procedure', 'hospitals','segments'],
  data() {
    return {
      resultSegments: this.segments,
      search: '',
      doctors: [],
      details: [],
      keys: [],
      selectedHospital: '',
      allHospitals: this.hospitals,
      query: "",
      results: [],
      timeout: null,
      selected: null,
      suggestions: [],
      debounceMilliseconds: 250,
      inputProps: {
        id: "hospitals",
        placeholder: "Choose Hospital",
        class: "form-control banner_input text_14 w-100",
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
      },
      full_name: '',
      phone_number: '',
      email: '',
      dob: '',
    }
  },
  computed: {},
 async created () {
    const hosp = await axios.get('/all-hosp')
    this.allHospitals = Object.freeze(hosp.data)
    let self = this
    self.details = JSON.parse(self.procedure.details)
    self.keys = Object.keys(self.details)
  },
  methods: {
        isLetter(e) {
      let char = String.fromCharCode(e.keyCode);
      if (/^[a-zA-Z ]*$/.test(char)) return true;
      else e.preventDefault();
    },
    isNumber(e) {
      let char = String.fromCharCode(e.keyCode);
      if (/^[0-9]+$/.test(char)) return true;
      else e.preventDefault();
    },
    setSelected(value) {
      let self = this
      this.selectedHospital = value.item
      //  trigger a mutation, or dispatch an action
    },
    fetchResults() {
      let self = this
      const query = this.query;
      clearTimeout(this.timeout);
      this.timeout = setTimeout(() => {
        Promise.all([self.allHospitals]).then(values => {
          console.log(self.allHospitals, values)
          this.suggestions = [];
          this.selected = null;
          const hospitalsData = this.filterResults(values[0], query, "first_name", "last_name");
          hospitalsData.length && this.suggestions.push({ name: "hospitals", data: hospitalsData });
        });
      }, this.debounceMilliseconds);
    },
    filterResults(data, text, field, field2) {
      console.log(data, text, field, field2)
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
    showCostModal() {
      document.querySelector('#bypass-grafting-modal').classList.add('show')
      document.querySelector('#bypass-grafting-modal').classList.add('fade')
      document.querySelector('#bypass-grafting-modal').classList.add('abc')
      document.querySelector('#bypass-grafting-modal').style.display = "block"

    },
    closeModal() {
      document.querySelector('#bypass-grafting-modal').classList.remove('show')
      document.querySelector('#bypass-grafting-modal').classList.remove('fade')
      document.querySelector('#bypass-grafting-modal').classList.remove('abc')
      document.querySelector('#bypass-grafting-modal').style.display = "none"

      let element = document.querySelector('.modal-backdrop')
      if (element) {
        element.remove(element.classList);
      }
    },
    handleSubmit (e) {
      let self = this
      this.submitted = true;
     if (self.full_name === '') {
        Vue.toasted.error('Enter full name' , { duration: 3000 })
        return
      }
       if (self.email === '' || self.email.length < 1 ) {
        Vue.toasted.error('Enter Email' , { duration: 3000 })
        return
      }
      if ((/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(self.email))) {

      }
      else{
        Vue.toasted.error('Incorrect Email ' , { duration: 3000 })
        return
      }
      if (self.dob === '') {
        Vue.toasted.error('Enter your age' , { duration: 3000 })
        return
      }
        if (self.selectedHospital === '') {
        Vue.toasted.error('Select Hospital' , { duration: 3000 })
        return
      }
      if (self.phone_number === '' || self.phone_number.length < 1 ) {
        Vue.toasted.error('Enter your mobile number' , { duration: 3000 })
        return
      }
      else if (!(/^(3)([0-9]{2}[0-9]{7})$/.test(self.phone_number)) && !(/^(03)([0-9]{2}[0-9]{7})$/.test(self.phone_number)) && !(/^(923)([0-9]{2}[0-9]{7})$/.test(self.phone_number))) {
        Vue.toasted.error("Use Correct Format  03XXXXXXXXX" , { duration: 3000 })
        return
      }
      if ((/^(3)([0-9]{2}[0-9]{7})$/.test(self.phone_number))) {
        self.phone_number = '92'+self.phone_number
      }
      if ((/^(03)([0-9]{2}[0-9]{7})$/.test(self.phone_number))) {
        self.phone_number = '92' + self.phone_number.substring(1)
      }
      if ((/^(923)([0-9]{2}[0-9]{7})$/.test(self.phone_number))) {
      }
      if (self.full_name && self.email && self.dob) {
        axios.post(APP_URL + '/store-estimated-cost', {
          first_name: self.full_name,
          email: self.email,
          dob: self.dob,
          hospital_id: self.selectedHospital.id,
          procedure_id: self.procedure.id,
          phone_number: self.phone_number,

        })
            .then(function (response) {
              console.log(response)
              if (response.data.type === 'success') {
                Vue.toasted.success(response.data.message , { duration: 3000 })
                    self.full_name = '';
                    self.email = '';
                    self.dob = '';
                    self.phone_number = '';
                    self.selectedHospital = '';
                self.closeModal();
              } else {
                Vue.toasted.error(response.data.message , { duration: 3000 })
              }

            })
            .catch(function (error) {
              Vue.toasted.error(error);
            });
      }
      else {
        Vue.toasted.error('Fill all fields' , { duration: 3000 })
      }
    },
    register( full_name, email, phone_number, dob ) {
      console.log( full_name, email, phone_number, dob )
    }
  }
}
</script>

<style>
.bypass-grafting-estimate {
  border: 0.5px solid #000000;
}
.procedure-duration li a{
  cursor:inherit;
}
.procedure-duration li:before {
  content: "";
  display: inline-block;
  width: 10px;
  background-color: #06D6A0;
  height: 10px;
  border-radius: 50%;
  margin-right: 5px;
  margin-top: 6px;
}
.heading-bypass-grafting p {
  margin: 28px 0 28px 0;
}
/*.modal_search:after{
  background-image: url('/images/arrow-down.png');
  background-size: contain;
  background-repeat: no-repeat;
  position: absolute;
  top: 25px;
  content: '' !important;
  width: 15px;
  right: 10px;
  height: 10px;
}*/
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
.my-suggestion-item{
  cursor: pointer;
}
.my-suggestion-item:hover{
  background-color: #ebe9e9 !important;
}
.autosuggest__results ul{
  margin: 0px !important;
}
</style>