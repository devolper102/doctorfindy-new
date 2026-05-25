<template>
  <div>
<!-- Modal Start -->
                        <div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="testModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header p-2">
                                <h5 class="modal-title" id="testModalLabel">Book your test/package </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body p-2">
                            <form method="POST" @submit.prevent="handleSubmit" >
                              <div class="form-group w-100 d-inline-block">
                                <label class="text_black text_14 mb-0 text-xs-13">Select Lab *</label>
                                <multiselect v-model="query" :options="allLaboratories"  placeholder="Select Lab" label="name" track-by="name" @select="selectLaboratory" @remove="unSelectLab"></multiselect>
                              </div>
                              <div class="form-group w-100 d-inline-block">
                                <label class="text_black text_14 mb-0 text-xs-13">Select Test / Package *</label>
                                <div class="select-hospital position-relative modal_search">
                                  <multiselect v-model="query2" :options="tests"  placeholder="Select Test" label="name" :custom-label="customLabel" :multiple="true" track-by="name" >
                                    
                                  </multiselect>
                                </div>
                              </div>
                              <div class="form-group w-100 d-inline-block">
                                <label class="text_black text_14 mb-0 text-xs-13">Select City *
                                </label>
                                <div class="select-hospital position-relative modal_search">
                                <multiselect v-model="query1" :options="cities"  placeholder="Select City" label="name" track-by="name" @select="selectCity" @open="cityOpen"></multiselect></multiselect>
                                </div>
                              </div>
                              <div class="form-group w-100 d-inline-block">
                                <label class="text_black text_14 mb-0 text-xs-13">Select Branch
                                </label>
                                <div class="select-hospital position-relative modal_search">
                                <multiselect v-model="query3" :options="allBranches"  placeholder="Select Branch" label="name" track-by="name" @open="branchOpen" @select="branchSelected"></multiselect>
                              </multiselect>
                                </div>
                              </div>
                              <div class="form-group w-48 
                              float-left">
                                <label class="text_black text_14 mb-0 text-xs-13">Full name * 
                                </label>
                                <input name="full_name" v-model="full_name"@keypress="isLetter($event)"  type="text" class="form-control h_45 text_14 bg-white input-border" id="firstnameInputText" aria-describedby="emailHelp" placeholder="Enter full name">
                              </div>
                              <div class="form-group w-48 
                              float-right">
                                <label class="text_black text_14 mb-0 text-xs-13">Email
                                </label>
                                <input name="email" v-model="email"  type="email" class="form-control h_45 text_14 bg-white input-border" id="lastnameInputText" aria-describedby="emailHelp" placeholder="Enter email">
                              </div>
                              <div class="form-group">
                                <label class="text_black text_14 mb-0 w-100 text-xs-13">Mobile number *</label>
                                <input name="phone_number" v-model="phone_number"  @keypress="isNumber($event)" type="text" class="form-control h_45 text_14 bg-white input-border" id="phoneInputPhone" aria-describedby="emailHelp" placeholder="03XXXXXXXXX" maxlength="11">
                              </div>
                                <div class="form-group w-48 float-left">
                                  <label class="mb-0 text_14 text_black w-100 d-inline-block text-xs-13">Age
                                </label>
                                  <input name="age" v-model="age" @keypress="isNumber($event)" type="text" class="form-control h_45 text_14 bg-white input-border" id="dateInput" aria-describedby="emailHelp" placeholder="Enter age" maxlength="2">
                                </div>
                                 <div class="form-group w-48 float-right">
                                <label class="text_black text_14 mb-0 text-xs-13">Select gender
                                </label>
                                <select name="gender" v-model="gender" class="form-control h_45 text_14 bg-white input-border">
                                  <option value="">Select gender
                                  </option>
                                  <option value="male">Male</option>
                                  <option value="female">Female
                                  </option>
                                </select>
                              </div>
                              <div class="form-group">
                                  <label class="mb-0 text_14 text_black w-100 d-inline-block text-xs-13">Preferred date
                                </label>
                                  <input name="date_preferred" v-model="date_preferred"  type="date" class="form-control h_45 text_14 bg-white input-border" id="dateInput" aria-describedby="emailHelp" placeholder="Enter age">
                                </div>
                                <div class="form-group">
                                  <label for="name" class="mb-0 text_14 text_black w-100 d-inline-block text-xs-13">Enter you address</label>
                                  <input type="address"  v-model="address"id="title"class="form-control h_45" aria-describedby="emailHelp" placeholder="Enter address">
                                </div>
                                <div class="modal_footer_btn w-48 d-inline-flex m-0 float-right mt-1 ml-0 mr-0 mb-0">
                                  <input type="submit" class="bg-blue book-rounded w-100 text-white p-2 text-center number_modal font-weight-bold border-0">
                                </div>
                            </form>
                          </div>
                          </div>
                        </div>
                        </div>
                <!-- Modal End -->
                <div v-if="bookTestFinal" class="modal" id="success_Modal" tabindex="-1" role="dialog" aria-labelledby="success_ModalLabel" aria-hidden="true" style="display:block;">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title font-weight-normal mt-lg-4 mt-md-4 text-lg-center text-md-center" id="success_ModalLabel"><p>Congratulations!</p> <span class="font-weight-bold text-capitalize">{{bookData.full_name}}</span> You have Successfully Booked <span class="font-weight-bold text-capitalize">{{testData.name}}</span> with <span class="theme-color-text text-capitalize">{{selectlab.first_name}} {{selectlab.last_name}}</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeTestModal()">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="verification-text-phone-number float-right" id="removed">
                          <a class="text_14 float-left theme-color-text" :href="'/download/test/'+bookData.date_preferred+'/'+lastInsertId">Download <img :src="basePath+'/images/final-save.png'" class="img-fluid"></a>
                          <!-- <a class="text_14 float-left theme-color-text" href="" @click.prevent="printme" target="_blank">Print <img src="/images/final-print.png" class="img-fluid"></a> -->
                        </div>
                       <p class="float-left w-100">Thank you <span class="font-weight-bold text-capitalize">{{bookData.full_name}}</span> for Booking Test with <span class="theme-color-text text-capitalize">{{selectlab.first_name}} {{selectlab.last_name}}</span> Soon we will get back to you.</p>
                       <div class="knockdoc_border w-100 d-inline-block">
              <div class="verification-text-phone-number pb-3 pt-3 text_20 text_xs_13">
                <div class="patient_summary">
                  <span class="text_black font-weight-bold w-50 d-inline-block float-left"> <img :src="basePath+'/images/date-image.png'" class="img-fluid"> Test Name</span>
                  <span class="w-40 d-inline-block">{{testData.name  }}</span>
                </div>
                <div class="patient_summary">
                  <span class="text_black font-weight-bold w-50 d-inline-block"> <img :src="basePath+'/images/rs.png'" class="img-fluid"> Price</span>
                  <span class="w-40 d-inline-block">Rs: {{ testData.discounted_price }}</span>
                </div>
                <div class="patient_summary">
                  <span class="text_black font-weight-bold w-50 d-inline-block"> <img :src="basePath+'/images/time-image.png'" class="img-fluid"> Date</span>
                  <span class="w-40 d-inline-block">{{ bookData.date_preferred | formatDate }}</span>
                </div>
                <div v-if="discountCode != 1234" class="patient_summary">
                  <span class="text_black font-weight-bold w-50 d-inline-block"> <img :src="basePath+'/images/shield.png'" class="img-fluid"> Discount Code</span>
                  <span class="w-40 d-inline-block">{{discountCode}}</span>
                </div>
                
                <!-- <div class="patient_summary">
                  <span class="text_black font-weight-bold w-50 d-inline-block"> <img src="/images/address-image.png" class="img-fluid"> Address</span>
                  <span class="w-40 d-inline-block">{{ $parent.selectedHospital.first_name }} {{ $parent.selectedHospital.last_name }}</span>
                </div> -->
              </div>
            </div>
                      </div>
                    </div>
                  </div>
                </div>
</div>
</template>
<script>
import Toasted from 'vue-toasted';
import { VueAutosuggest } from 'vue-autosuggest';
import Multiselect  from 'vue-multiselect'
Vue.use(Toasted)
export default {
  components: {VueAutosuggest,Multiselect },
  props:[ 'branches','cities','laboratories','tests','selectlab','test_id', 'fileSystemDriver'],
  name: "LabModelComponent",
  data() {
    return {
      basePath:'',
      diseases: this.diseasess,
      symptomsToShow: 5,
      TestsToShow: 8,
      search: '',
      details: [],
      keys: [],
      selectedLab: [],
      labBranches:[],
      allLaboratories: this.laboratories,
      labTests:[],
      query: "",
      testData:[],
      results: [],
      timeout: null,
      selected: null,
      suggestions: [],
      selectedCity: '',
      allLocations: this.cities,
      allBranches:[],
      query1: "",
      results1: [],
      selected1: null,
      suggestions1: [],
      selectedTest: '',
      allTests: this.tests,
      query2: "",
      query3: "",
      results2: [],
      selected2: null,
      suggestions2: [],
      findTests: [],
      full_name: '',
      email: '',
      phone_number: '',
      age: '',
      gender: '',
      date_preferred: '',
      address: '',
      selectedLocation: [],
      id : '',
      edittitle : '',
      findsymptoms : this.tests,
      get_title: 'All',
      selectedBranch:'',
      bookTestFinal: false,
      bookData: [],
      lastInsertId:'',
      discountCode:1234,
      // date: this.date_preferred,
    }
  },
  created() {
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = '';
      } else {
        // Use local path for development
        this.basePath = '';
      }
  },
  mounted(){
    // $(this.$el).on('shown.bs.modal', this.setLabData);
    $(this.$el).on('shown.bs.modal' , this.setTestData);
    // $(this.$el).on('shown.bs.modal' , this.setCityData);
    // $(this.$el).on('shown.bs.modal' , this.setTestName);
  },
  methods: {
    customLabel ({ name, price ,discounted_price}) {
      if(price != ''){
      // return `${name}  - Rs ${price}`
      // }
      // else{
        return `${name}  - Rs ${discounted_price}`
      }
    },
    // setCityData()
    // { 
    //     let self = this;
    //     if(self.selectlab.location !== null){
    //       self.selectedCity = '';
    //       self.query1 = {name:self.selectlab.location.title, id:self.selectlab.location.id};
    //        self.selectedCity = self.query1.id ;
    //       this.filterBranches(self.selectedCity ? self.selectedCity : null,null)
    //   }
      
    // },
      setLabData(){
        let self = this;
        if(self.selectlab !== null){
          self.query = {name:self.selectlab.first_name+" "+self.selectlab.last_name, id:self.selectlab.id};
         
        this.filterBranches(this.selectlab.id,null)
        
      }
    },
    setTestName()
    { 
      let data = this.tests.find(x => x.id === this.test_id);
      this.testData = data;
      // return testData;
    },
    setTestData()
    {   
        let self = this;
        var test_id = this.test_id;
        if(self.test_id !== null){
          self.findTests = [];
          self.tests.forEach(function (x) {
            if (x.id === test_id) {
                self.findTests.push(x)
                self.query2 = { name: x.name, id:x.id,price:x.price,discounted_price:x.discounted_price,labo_id:x.labo_id};

            }
      }) 
          
          // self.query2 = self.findTests;

      } 
      var element_id = [];
      var valobj = this.allLaboratories.forEach(function(elemtest) {
      
        if(elemtest.id == self.query2.labo_id){ 
             element_id.push(elemtest);
             self.query = elemtest;
        }
     
    })
    this.tests = element_id;
    },
      selectCity(value,id){
        
        let city_id = value.id;
        this.selectedCity = city_id;
        this.filterBranches(this.query.id,this.selectedCity ? this.selectedCity : null)
      },
      selectLaboratory(value,id){
        let lab_id = value.id;
        let slctlab = this.laboratories.filter((item) => {
          return (item.id == lab_id)
        })
        this.selectlab = slctlab[0];
        this.labTests=[];
        var user=[];
        self=this;
        this.branches.forEach(function(x){
            if(x.id == self.selectlab.id)
            {
              user.push(x);
            }
          
        })
        if(user != null || user != undefined)
        {
          user[0].lab_test.forEach(function(data){
             if(data.title == self.query2.name)
             {
              self.query2 = { name: data.title, id:data.id, price:data.price,discounted_price:data.discounted_price,labo_id:data.lab_id};
             }
          })
        }

        this.query1 = '';
        this.query3 = '';
        this.filterBranches(lab_id,this.selectedCity ? this.selectedCity : null)
       },
       branchSelected(value,id){
        let branch_id = value.id;
        this.selectedBranch = branch_id;
       },
      branchOpen(){
        if(this.selectedCity == ""){
          alert('Select City First')
        }
      },
      cityOpen(){
        if(this.selectlab == null){
          alert('Select Lab First')
        }
      },
      unSelectLab(value,id){
        this.allBranches = [];
        this.selectlab = null;
      },
      filterBranches(lab_id,city_id){
        if(this.branches.length > 1){
        let labBranches = this.branches.filter((item) => {
          return (item.id == lab_id)
        })
        this.allBranches = []
        if(city_id != null)
        this.allBranches = labBranches[0].branches.filter((item) => {
          return (item.location_id == city_id)
        })  
        else
        this.allBranches = labBranches[0].branches.filter((item) => {
          return item;
        })
    }
    else
    {
       if(city_id != null)
        this.allBranches = this.branches.branches.filter((item) => {
          return (item.location_id == city_id)
        })  
        else
        this.allBranches = this.branches.branches.filter((item) => {
          return item;
        })
    }
      },
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
    handleSubmit (e) {
      let self = this
      this.submitted = true;
      this.selectedLab = this.query.id ? this.query.id : '';
      this.selectedCity = this.query1.id ? this.query1.id : '';
      this.selectedBranch = this.query3.id ? this.query3.id : '';
      // this.selectedCity = this.query1.id;
      self.findTests = [];
      if(self.query2.length > 0){
      self.query2.forEach(function (x) {
          self.findTests.push(x);
        });
      }
      else if(self.query2 != null || self.query2 != undefined)
      {
        self.findTests=self.query2;
      }
     if (self.full_name === '') {
        Vue.toasted.error('Enter full name' , { duration: 3000 })
        return
      }
      
      if (self.selectedLab === '') {
        Vue.toasted.error('Select Lab' , { duration: 3000 })
        return
      }
      if (self.selectedCity === '') {
        Vue.toasted.error('Select City' , { duration: 3000 })
        return
      }
      // if (self.selectedBranch === '') {
      //   Vue.toasted.error('Select Branch' , { duration: 3000 })
      //   return
      // }
      if (self.selectedCity === '') {
        Vue.toasted.error('Select City' , { duration: 3000 })
        return
      }
      if (self.findTests.length === 0) {
        Vue.toasted.error('Please Select minimum 1 test' , { duration: 3000 })
        return
      }
      if (self.phone_number === '' || self.phone_number.length < 1 ) {
        Vue.toasted.error('Enter your mobile number' , { duration: 3000 })
        return
      }
      else if (!(/^(3)([0-9]{2}[0-9]{7})$/.test(self.phone_number)) && !(/^(03)([0-9]{2}[0-9]{7})$/.test(self.phone_number)) && !(/^(923)([0-9]{2}[0-9]{7})$/.test(self.phone_number))) {
        Vue.toasted.error("Use Correct Format  923XXXXXXXXX" , { duration: 3000 })
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
      if (self.full_name) {
        axios.post(APP_URL + '/store-book-test', {
          full_name: self.full_name,
          city:  self.selectedCity,
          email: self.email,
          age: self.age,
          gender: self.gender,
          address: self.address,
          date_preferred: self.date_preferred,
          lab_id: self.selectedLab,
          phone_number: self.phone_number,
          selected_test: self.findTests,
          branch_id:self.selectedBranch,

        })
            .then(function (response) {
              if (response.data.type === 'success') {
                Vue.toasted.success(response.data.message , { duration: 3000 })
                self.lastInsertId = response.data.lastInsertId;
                self.discountCode = response.data.discountCode;
                self.bookData = {'full_name' : self.full_name,
          'city' :  self.selectedCity,
          'email' : self.email,
          'age' : self.age,
          'gender' : self.gender,
          'address' : self.address,
          'date_preferred' : self.date_preferred,
          'lab_id' : self.selectedLab,
          'phone_number' : self.phone_number,
          'selected_test' : self.findTests,
          'branch_id' : self.selectedBranch};

                    self.full_name = '';
                    self.city = '';
                    self.email = '';
                    self.age = '';
                    self.phone_number = '';
                    self.gender = '';
                    self.date_preferred = '';
                    self.address = '';
                    self.query = '',
                    self.query1 = '',
                    self.query2 = '',
                    self.query3 = ''
                self.closeModal();
                self.setTestName();
                self.bookTestFinal = true;
                // document.querySelector('#crossModal').style.display = "block";
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
    closeModal() {
      document.querySelector('#testModal').classList.remove('show')
      document.querySelector('#testModal').classList.remove('feedback_modle')
      document.querySelector('#testModal').style.display = "none"
       let element = document.querySelector('.modal-backdrop')
      if (element) {
        element.remove(element.classList);
      }
    },
    closeTestModal() {
      // document.querySelector('#success_Modal').classList.remove('show')
      document.querySelector('body').classList.remove('modal-open')
      document.querySelector('#success_Modal').style.display = "none"
       let element = document.querySelector('.modal-backdrop')
      if (element) {
        element.remove(element.classList);
      }
    },
   selectedItem(result) {
      if (this.selectedLocation.length > 0) {
        if (result.label === 'Doctors') {
          window.location.href = '/doctors/'+result.item.location.slug+'/'+result.item.specialities[0].slug+'/'+result.item.slug
        }
        else if (result.label === 'Hospitals') {
          window.location.href = '/hospitals/'+result.item.location.slug+'/'+result.item.slug+'/'+result.item.area.slug
        }
        else if (result.label === 'Specialities') {
          /*  speciality/{slug}/{location}  */
          
          window.location.href = '/doctors/'+this.selectedLocation[0].slug+'/'+result.item.slug
        }
        else if (result.label === 'Services') {
          /*  service/{slug}/{location}  */
          window.location.href = '/services/'+result.item.slug+'/'+this.selectedLocation[0].slug
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
          /*  speciality/{slug}  */
           window.location.href = '/doctors/'+this.selectedLocation[0].slug+'/'+result.item.slug
        }
        else if (result.label === 'Services') {
          /*  service/{slug}  */
          window.location.href = '/services/'+result.item.slug+'/'+this.selectedLocation[0].slug
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
  }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped="scoped">
.autosuggest__results-container{
  width: 84%;
}
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
/*#search_doctor_on_device #autosuggest input{
  border-radius: 0px !important;
  margin-bottom: 10px !important;
  padding-right: 5rem;
  padding: 1.375rem .75rem;
}
#search_doctor_on_device .autosuggest__results-container {
    width: 100% !important;
    left: 0px !important;
    top: 110px !important;
}
#search_doctor_on_device .autosuggest__results{
  max-height: 100vh;
  overflow-y: auto !important;
}
.disease_search .autosuggest__results {
    overflow-y: scroll;
  }
.autosuggest__results ul{
  margin: 0px !important;
}*/
@media (max-width: 991px){
  .banner_heading span{
    font-size: 27px;
  }
  .banner_heading{
    color: #fff;
  }
  .mobile_search_btn {
    top: 12px;
  }
  .inner-slider{
    margin-top: 40px;
  }
}
.inner-slider{
  margin-top: 75px;
}
@media (max-width: 360px){
  .slick-prev {
    left: -13px;
  }
  .slick-next {
    right: -17px;
  }
}
.modal-open{
  overflow-y: scroll !important;
}
.sliderBox {
  margin: 20px;
}
.work_text{
  height: 60px;
  overflow: hidden;
}
.default_test{
  background: #2b4df9;
}
#success_Modal{
  background-color: #0000004a;
}
</style>