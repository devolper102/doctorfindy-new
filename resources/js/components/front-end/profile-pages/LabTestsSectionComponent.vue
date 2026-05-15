
<!-- <p class="font-weight-bold">Rs: {{test.discounted_price}}</p> -->
<template>
  <div id="testSection">
   <div class="booking_section">
          <div class="row">
            <div class="col-12">
              <div class="section-heading mt-lg-4 mb-lg-4 w-50 float-left w-xs-100">
                <h1 class="font-weight-bold text_xs_20 text_30 text-blue">
                 All Lab Tests ({{tests_count}})
                </h1>
              </div>
              <div class="input-lab-test-search w-50 float-left mt-lg-4 w-xs-100 position-relative mb-xl-0 mb-3">
        <input class="w-100 d-inline-block h_37 border-0 book-rounded pl-4 pr-5"
        type="text" v-model="keyword" placeholder="Search Test Name">
        <span class="input-group-btn position-absolute" style="top: 2px; right: 5px;">
          <a href="javascript:void(0)" type="button" class="btn bg-green text_14 text-white" style="border-radius: 10px; padding: 5px 10px;">Search 
            <span><i aria-hidden="true" class="fa fa-search fa-sm">
            </i></span>
          </a>
        </span>
    </div>
            </div>
          </div>
      </div>
      <!-- <div class="top-content" v-if="user.lab_test.length">
             <div class="mb-3" v-for="(test,index) in user.lab_test" v-if="index < TestsToShow">
                <div class="test_box bg-white box_shadow p-2 position-relative w-48 float-left d-inline-block w-xs-100 mb-3 mr-lg-2">
                  <a :href="'/lab/'+user.location.slug+'/'+user.slug+'/'+test.slug" class="font-weight-bold theme-color-text">{{test.title}}</a>
                  <div class="test_description">
                    <p>{{test.details}} </p>
                  </div>
                  <p class="font-weight-bold">Rs: {{test.price}}</p>
                  <div role="separator" class="dropdown-divider d-inline-block w-100 custom_divider"></div>
                <a @click="labData(user, test.id)" class="theme-color-text text-center w-100 d-inline-block p-1 add_testBtn font-weight-bold" data-toggle="modal" data-target="#testModal">
                                      Book Test
                                    </a>
                </div>
              </div>
      </div> -->
      <div class="top-content" v-if="user.lab_test.length">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12" v-for="(test,index) in user.lab_test" v-if="index < TestsToShow">
                    <div class="bg-white box-shadow p-2 mb-3 h-80 book-rounded lab-profile-box">
                      <div class="row">
                        <div class="col-9 col-md-8 
                        col-lg-8">
                          <a :href="'/test/'+user.slug+'/'+test.slug" class="font-weight-bold text_black d-inline-block text_14 hidden-line" style="max-width: 320px;">{{test.title}}</a>
                          <div class="test_description">
                            <p class="text_black text_13"><span>known as :</span>{{test.known_as}} 
                            </p>
                          </div>
                        </div>
                        <div class="col-3 col-lg-4 
                        col-md-4">
                          <!-- <div class="percent_main text-center mb-2" v-if="user.user_discount_percentage && user.user_discount_percentage != ' '">
                            <span class="percent_off">
                              {{user.user_discount_percentage}}%
                            </span>
                            <sub>OFF</sub>
                          </div> -->
                          <div v-if="test.title !== '25-OH Vitamin D Level' && test.title !== 'Lipid Profile' && test.title !== 'HbA1c' ">
                            <div class="percent_main text-center mb-2" v-if="user.user_discount_percentage && user.user_discount_percentage != ' '">
                              <span class="percent_off">
                                {{user.user_discount_percentage}}%
                              </span>
                              <sub>OFF</sub>
                            </div>
                          </div>
                          <div class="percent_main text-center mb-2" v-else>
                            <span class="percent_off">
                              30%
                            </span>
                            <sub>OFF</sub>
                          </div>
                        </div>
                      </div>
                      <div v-if="test.turn_around_time" class="row">
                        <div v-if="test.sample_type" class="col-12 col-lg-6 col-md-6 mt-2">
                          <span class="font-weight-bold text_12">Sample Type</span>
                        </div>
                        <div v-if="test.sample_type" class="col-12 col-lg-6 col-md-6 mt-2">
                          <span class="font-weight-bold text_12 d-inline-block w-100 text-right">{{test.sample_type}}</span>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6">
                          <span class="font-weight-bold text_12">Turn Around Time</span>
                        </div>
                        <div class="col-12 col-lg-6 
                        col-md-6">
                          <span class="font-weight-bold text_12 d-inline-block w-100 text-right">{{test.turn_around_time}}</span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xl-5 col-6">
                          <div class="float-left w-100">
                          <a @click="labData(user,test.id)" class="theme-color-text text-center w-100 d-inline-block book-rounded book-padding text-white bg-green text_13 font-weight-bold lab-cart-btn" data-toggle="modal" data-target="#testModal">
                        Book Test
                      </a>
                        </div>
                      </div>
                        <div class="col-xl-7 col-6 mb-xl-0 mb-3">
                          <div class="float-right mt-2 00">
                          <span class="font-weight-bold text_13 
                          color-date">
                          <strike class="text-red">
                            <span class="color-date text_13">
                              Rs.{{test.price}}
                            </span>
                          </strike>
                            </span>
                            <span class="font-weight-bold text_15 ml-xl-4 ml-2">Rs.{{test.discounted_price}}
                            </span>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
      </div>
       <div v-else><h5 class="text-center font-weight-bold">No Test Found...</h5></div>
       <span class=" d-inline-block w-100 text-center ">
        <a href="javascript:void(0)" v-if="user.lab_test.length > 6 && user.lab_test.length > TestsToShow-1" @click="TestsToShow += 6" class="d-inline-block book-rounded bg-green text-white p-2 book-padding mb-2 mt-2">View More
          <!-- <i aria-hidden="true" class="fa fa-arrow-right ml-2"></i> -->
        </a>
          </span>
            <lab-model v-if="renderLabModel" ref="LabTestModal" :branches="user" :specialitys="specialities" :doctorss="doctors" :hospitalss="hospitals" :diseasess="diseases" :servicess="services" :laboratories="allLaboratories" :cities="allcities" :tests="allTests" :selectlab="mylab" :test_id="test_id" :fileSystemDriver="fileSystemDriver"></lab-model>
</div>
</template>
<script>
export default {
name: "LabTestsSectionComponent",
  props: ['specialitys', 'servicess', 'cities', 'diseasess', 'doctorss', 'hospitalss', 'laboratories', 'trendingTopics','managements', 'logged_user', 'segments','tests','symptoms','user','tests_count', 'fileSystemDriver'],
  data() {
    return {
      renderLabModel:false,
      allLabTests:this.user.lab_test,
      selectedLocation: [],
      specialities: this.specialitys,
      doctors: this.doctorss,
      hospitals: this.hospitalss,
      diseases: this.diseasess,
      services: this.servicess,
      TestsToShow: 6,
      search: '',
      allLaboratories: [],
      allLocations: this.cities,
      allcities: [],
      allTests: [],
      findTests: [],
      id : '',
      test_id : '',
      mylab : {},
      keyword: null,
    }
  },
  watch: {
        keyword(after, before) {
            this.getResults();
        }
    },
  created () {
    // this.tests = JSON.parse(this.user.lab_test);
  },
  mounted(){
        var lab_name = this.user.first_name +" "+this.user.last_name;
         this.allLaboratories.push({name:lab_name,id:this.user.id});
      this.cities.forEach(fields => {
         this.allcities.push({name:fields.title,id:fields.id})
      });
      // this.user.lab_test.forEach(fields => {
      //    this.allTests.push({name:fields.title,id:fields.id,price:fields.price,discounted_price:fields.discounted_price,labo_id:fields.lab_id})
      // });
       var id = this.user.id;
       var self=this;
      setTimeout(function(){
        self.getAllLabTests(id);
      },4000);
  },
  methods: {
     labData(data,id){
      this.mylab = data;
      this.test_id =id;
    },
    getResults() {
            if(this.keyword.length > 2)
            {
              axios.get('/test-search', { params: { keyword: this.keyword, user_id: this.user.id } })
                .then(res => this.user.lab_test = res.data)
                .catch(error => {});
            }
            else
            {
              if(this.keyword.length < 1)
              {
                this.user.lab_test = this.allLabTests;
              }
            }
            
        },
        getAllLabTests(id)
        {
          axios.get('/get-lab-profile-all-tests/'+id)
          .then((response)=>{
               this.user.lab_test = response.data[0];
               this.user.branches = response.data[1];

               this.user.lab_test.forEach(fields => {
                 this.allTests.push({name:fields.title,id:fields.id,price:fields.price,discounted_price:fields.discounted_price,labo_id:fields.lab_id})
              });
               this.renderLabModel = true;
          });
        }
      //   findTest(id){
      //     this.$refs.LabTestModal.selectedFirstLab();
      //          let self = this
      //         self.findTests = [];
      //     self.tests.forEach(function (x) {
      //       if (x.id === id) {
      //           self.findTests.push(x)
      //       }
      // })
      //   },
  }
}
</script>
<style scoped>
.input-lab-test-search input{
  border:1px solid #8B8B8B !important;
}
.test_description {
    min-height: 85px;
}
.test_description {
    min-height: 85px;
}
.percent_main sub {
    font-weight: bold;
    right: 32px;
    color: #fff;
    top: 10px;
}
.percent_off {
    background: #EA1938 !important;
    padding-top: 2px !important;
}
.test_description p{
  overflow:hidden;
  height:80px;
}
.input-lab-test-search input::placeholder{
  font-size:13px;
}



</style>