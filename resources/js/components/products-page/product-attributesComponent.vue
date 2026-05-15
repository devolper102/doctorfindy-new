<template>
  <div>
    <b-container>
      <b-row class="mt-4">
        <b-col cols="12">
          <div class="product-btn float-right">
            <a @click="getAllCategories()" href="javascript:void(0)" class="text-white font-weight-bold knockdoc_btn_bg box_radius d-inline-block" v-b-modal.product-backend-attributes>
            Create Attributes
            </a>
          </div>
        </b-col>
      </b-row>
      <b-row class="mt-4">
        <b-col cols="12">
          <template>
            <div class="product-table w-100 d-inline-block">
              <!-- <b-table striped hover :items="items"></b-table> -->
              <b-table
                  :items="productAttributes"
                  :fields="fields"
                  :current-page="currentPage"
                  :per-page="perPage"
                  :filter="filter"
                  :filter-included-fields="filterOn"
                  :sort-by.sync="sortBy"
                  :sort-desc.sync="sortDesc"
                  :sort-direction="sortDirection"
                  show-empty
                  small
                  @filtered="onFiltered"
                  >
                  <template v-slot:cell(categories)="data">
                    <p v-for="(category,index) in data.item.categories" :key="index">
                      {{category.name}}
                    </p>
                  </template>
                  <template v-slot:cell(values)="data">
                    <p v-for="(value,index) in data.item.values" :key="index">
                      {{value}}
                    </p>
                  </template>
             <template v-slot:cell(action)="data">
              <!-- <b-icon icon="three-dots-vertical" font-scale="1" @click="showdropdown(data.item.id)">
              </b-icon> -->
              <a class="dots-icon theme-color-text" href="javascript:void(0)" @click="showdropdown(data.item.id)">
                  <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
              </a>
                <div :id="'drop'+data.item.id" class="show-dropdown">
                  <a class="approve font-weight-bold d-block" href="javascript:void(0)" v-b-modal.product-backend-attributes @click="getProductAttribute(data.item.id)">
                              Edit
                  </a> 
                  <a class="decline font-weight-bold d-block" href="javascript:void(0)" @click="$bvModal.show('bv-modal-inActive'); getId(data.item.id);">
                    Delete
                  </a>
                </div>      
            </template>
                </b-table>
            </div>
          </template>
        </b-col>
        <b-col cols="12 mb-5">
         <div class="product-list-pagination mb-4 position-relative float-right">
            <b-pagination
              v-model="currentPage"
               :total-rows="totalRows"
               :per-page="perPage"
              first-number
              last-number>
            </b-pagination>
          </div>
        </b-col>
      </b-row>
    </b-container>
    <!-- Start product categories modal -->
<div>
  <b-modal id="product-backend-attributes" ref="product-categories-modal" title="BootstrapVue" :no-close-on-backdrop = "true" :no-close-on-esc = "true" hide-footer 
  :hide-header="true">
    <div class="w-100 d-inline-block p-2">
      <div class="cross-btn float-right">
         <a class="text_black text_16" href="javascript:void(0)" @click="productcategorieshideModal()">
           <i class="fa fa-times" aria-hidden="true"></i>
         </a>
      </div>
      <b-row class="mt-5">
            <b-col cols="12">
               <div class="product-tabs w-100 d-inline-block">
                  <b-row>
                     <b-col cols="12" col lg ="3">
                        <div class="nav flex-column nav-pills tab-left-side w-100 d-inline-block float-left p-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                           <a class="nav-link active text-white" 
                              id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true">
                           General
                           </a>
                           <a class="nav-link text-white" id="v-pills-attribute-tab" 
                              data-toggle="pill" href="#v-pills-attribute" role="tab" aria-controls="v-pills-attribute" aria-selected="false">
                           Values
                           </a>
                        </div>
                     </b-col>
                     <b-col cols="12" col lg ="9">
                        <div class="tab-content tabs-description w-100 d-inline-block float-left" id="v-pills-tabContent">
                           <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                              <b-form>
                                 <b-form-group class="w-100 d-inline-block mt-4">
                                    <label class="w-15 float-left 
                                       text_black pt-2 w-xs-100">Name
                                    </label>
                                    <b-form-input 
                                       id="input-name" 
                                       type="text"
                                       v-model="attribute.name"
                                       class="w-85 d-inline-block 
                                       float-left w-xs-100 theme-color-border h_37"
                                       autofocus>
                                    </b-form-input>
                                 </b-form-group>
                              </b-form>
                              <div class="w-100 d-inline-block mb-2 
                                 product-categories mt-3">
                                 <label class="w-15 w-xs-100 float-left pt-2 text_black">Categories
                                 </label>
                                 <div class="product-categories-select w-85 d-inline-block float-left">
                                    <multiselect 
                                                   v-model="attribute.selectedCategory" 
                                                   placeholder="Add category"
                                                   label="name" 
                                                   tag-placeholder="Add to new category"
                                                   track-by="id"  
                                                   :options="attribute.categoryOpt"
                                                   :multiple="true" 
                                                   :taggable="false" 
                                                   >
                                       <template slot="caret">
                                          <div class="multiselect__select">
                                             <b-icon icon="chevron-down" variant="secondary"></b-icon>
                                          </div>
                                          <div class="custom_placeholder">
                                             <!-- Select City -->
                                          </div>
                                       </template>
                                    </multiselect>
                                 </div>
                              </div>
                              <div class="w-100 d-inline-block mb-2 product-categories-checkbox">
                                 <label class="w-15 w-xs-100 float-left text_black">Status
                                 </label>
                                 <div class="checkbox-status w-85 
                                    float-left w-xs-100">
                                    <b-form-checkbox v-model="attribute.status">
                                       <label class="text_black">Enable the product</label>
                                    </b-form-checkbox>
                                 </div>
                              </div>
                              <div class="product-save-btn w-85 w-xs-100 float-right mt-3 pb-4">
                                 <a @click="saveGeneral()" href="javascript:void(0)" class="text-white knockdoc_btn_bg box_radius d-inline-block">
                                 Save
                                 </a>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="v-pills-attribute" role="tabpanel" aria-labelledby="v-pills-attribute-tab">
                              <div class="banner-heading w-100 d-inline-block pb-2 border-bottom mt-lg-0 mt-4">
                                 <h2 class="text-black text_16 mb-0">Attribute</h2>
                              </div>
                              <b-row>
                                    <b-col cols="12">
                                       <div v-for="(item,index) in numberofitem" :key="index+1" :id="'valuerepeat'+item">
                                       <div class="w-80 w-xs-100 mt-lg-0 mt-3 d-inline-block mb-2 
                                       product-categories float-left">
                                       <label class="w-100 d-inline-block float-left pt-2 text_black mt-3">Values
                                       </label>
                                       <b-form>
                                       <b-form-group class="w-100 d-inline-block mb-0">
                                          <b-form-input 
                                             id="number-name" 
                                             type="text"
                                             v-model="attribute.values[index]"
                                             class="w-85 d-inline-block 
                                             float-left w-xs-100 theme-color-border h_37"
                                             autofocus>
                                          </b-form-input>
                                       </b-form-group>
                                       </b-form>
                                    </div>
                                    <div class="delete-btn w-20 w-xs-100 mt-lg-4 mt-3 float-left d-inline-block mt-5 text-center">
                                       <a @click="removeAttrDiv(item)" href="javascript:void(0)" class="text-white knockdoc_btn_bg box_radius d-inline-block mt-4">
                                       <i class="fa fa-trash" aria-hidden="true"></i>
                                       </a>
                                    </div>
                                    </div>
                                    </b-col>
                                <b-col cols="12">
                                   <div class="product-save-btn w-100 float-left d-inline-block">
                                 <a @click="addNewAttrDiv()" href="javascript:void(0)" class="text-white knockdoc_btn_bg box_radius d-inline-block">
                                 Add New Attribute 
                                 </a>
                              </div>
                                </b-col>
                                <b-col cols="12">
                                   <div class="product-save-btn w-100 float-left mt-3 d-inline-block">
                                 <a @click="saveValue()" href="javascript:void(0)" class="text-white knockdoc_btn_bg box_radius d-inline-block">
                                 Save
                                 </a>
                              </div>
                                </b-col>
                              </b-row>
                           </div>
                        </div>
                     </b-col>
                  </b-row>
               </div>
            </b-col>
         </b-row>
    </div>
  </b-modal>
</div>
<!-- End product categories modal -->
<!-- Start Decline modal -->
  <div>
    <div id="decline-modal">
  <b-modal id="bv-modal-inActive" ref="active-modal" hide-footer :hide-header="true" title="BootstrapVue" :no-close-on-backdrop = "true" :no-close-on-esc = "true">
    <div class="w-100 d-inline-block p-2">
      <div class="cross-btn float-right">
         <a class="text_black text_16" href="javascript:void(0)" 
         @click=" hidecrossModal()">
           <i class="fa fa-times" aria-hidden="true"></i>
         </a>
      </div>
      <h6 class="w-100 d-inline-block mt-3 text-center">Are you sure to Delete this Attribute?</h6>
      <div class="approve-btn w-100 d-inline-block text-center pb-3">
    <b-button class="mt-3 cancle-btn mr-3 text-white font-weight-bold box_radius d-inline-block" @click="hideModalInActive()">No</b-button>
    <b-button class="mt-3 done-btn knockdoc_btn_bg theme-color-border text-white font-weight-bold box_radius d-inline-block" @click="hideModalInActive(); deleteAttribute(status_id);">Yes</b-button>
  </div>
    </div>
  </b-modal>
</div>
</div>
<!-- End Decline modal -->
  </div>
</template>
<script>

export default {
  name: "product-attributesComponent",
data() {
      return {
        generaltab:true,
           valuetab:false,
           numberofitem:1,
           attribute:{
             name:'',
             status:'',
             selectedCategory:null,
             categoryOpt:[],
             categories:[],
             values:[],
             valueOpt:[],
             currentsavedid:'',
           },
          dateRange: { // for v-model
            type: [Object],
            default: null,
            required: true
          },
           /*data table*/
           totalRows: 1,
           currentPage: 1,
           perPage: 15,
           pageOptions: [15, 30, 45, { value: 100, text: "Show a lot" }],
           sortBy: '',
           sortDesc: false,
           sortDirection: 'asc',
           filter: null,
           filterOn: [],
           selectCity:'',
           selectService:'',
           citiesOpt:[],
           servicesOpt:[],
           infoModal: {
             id: 'info-modal',
             title: '',
             content: ''
           },
           /*data table*/
           moment: moment,
           rows: 100,
           selected: null,
           productAttributes:[],
           options: [
             { value: null, text: 'Any status' },
             { value: 'a', text: 'Any status' },
             { value: 'b', text: 'Any status'},
           ],
           fields: [
         { key: 'id', label: 'ID'},
         { key: 'name', label: 'Name'},
         { key: 'categories', label: 'Categories'},
         { key: 'values', label: 'Values'},
         { key: 'action', label: 'Action'  }
        ],
      }
    },
    mounted(){
      this.getAllProductAttribute();
         this.getFilterDataopt();
         var item = this.items;
    },
methods: {
   getProductAttribute(id){
            this.getAllCategories();
            this.showdropdown(id);
            axios.get('/get_admin_product_attribute/'+id)
             .then(response => {
                this.generaltab=true;
                this.valuetab=false;
                this.numberofitem=response.data[0].values.length;
                this.attribute={
                  name:response.data[0].name,
                  status:response.data[0].status==1?true:false,
                  categoryOpt:response.data[1],
                  selectedCategory:response.data[0].categories,
                  values:response.data[0].values,
                  valueOpt:[],
                  currentsavedid:response.data[0].id
                };
             });
          },
    hidecrossModal() {
        this.$refs['active-modal'].hide()
      },
   getAllCategories(){
            axios.get('/get_admin_all_product_category').then(response=>{
              this.attribute.categoryOpt = response.data;
            });
          },
   getAllProductAttribute(){
            this.$bvModal.show('bv-modal-loading');
           axios.get('/get_admin_product_attributes')
             .then(response => {
             this.productAttributes = response.data;
             this.$bvModal.hide('bv-modal-loading');
             this.totalRows =this.productAttributes.length;
             })
             .catch((error) => {
              this.$bvModal.hide('bv-modal-loading');
             this.success = false;
           });
         },
         getId(id){
          // alert(id);
        this.status_id = id;
        this.showdropdown(id);
      },
      saveGeneral(){
            if(this.attribute.currentsavedid){
              var jsonCategory = [];
              var data = {specs:this.attribute.selectedCategory};
              var valObj = data.specs.filter((elem,index)=>{
                jsonCategory.push({id:elem.id,name:elem.name,status:elem.status});
              });
              let formData=new FormData();
              formData.append('attribute_id',this.attribute.currentsavedid);
              formData.append('name',this.attribute.name);
              formData.append('status',this.attribute.status);
              formData.append('categories',JSON.stringify(jsonCategory));
              axios.post('/save-product-attribute-general',formData).then(response=>{
                this.valuetab = true;
                this.generaltab = false;
                this.$toasted.show(response.data.message,{
                  type:'success',
                  duration: 2000
                });
                this.getAllProductAttribute();
              });
            }else{
              var jsonCategory = [];
              var data = {specs:this.attribute.selectedCategory};
              var valObj = data.specs.filter((elem,index)=>{
                jsonCategory.push({id:elem.id,name:elem.name,status:elem.status});
              });
              let formData=new FormData();
              formData.append('name',this.attribute.name);
              formData.append('status',this.attribute.status);
              formData.append('categories',JSON.stringify(jsonCategory));
              axios.post('/save-product-attribute-general',formData).then(response=>{
                this.attribute.currentsavedid = response.data.id;
                this.valuetab = true;
                this.generaltab = false;
                this.$toasted.show(response.data.message,{
                  type:'success',
                  duration: 2000
                });
                this.getAllProductAttribute();
              });
            }
          },
   saveValue(){
            if(this.attribute.currentsavedid){
              var data = {specs:this.attribute.values};
              var jsonValue = [];
              var valObj = data.specs.filter((elem,index)=>{
                if(elem){
                  jsonValue.push(elem);
                }
              });
              this.attribute.values = jsonValue;
              let formData=new FormData();
              formData.append('attribute_id',this.attribute.currentsavedid);
              formData.append('values',JSON.stringify(this.attribute.values));
              axios.post('/save-product-attribute-value',formData).then(response=>{
                if(response.data.statusCode == 401){
                  this.$toasted.show(response.data.message,{
                    type:'error',
                    duration: 2000
                  });
                }else{
                  this.$toasted.show(response.data.message,{
                    type:'success',
                    duration: 2000
                  });
                  this.getAllProductAttribute();
                  this.hideproductattributeModal();
                }
              })
            }else{
              this.$toasted.show("Please Save Attribute First in General",{
                type:'error',
                duration: 2000
              });
            }
          },
          hideproductattributeModal() {
        this.$refs['product-categories-modal'].hide();
           this.generaltab=true;
           this.valuetab=false;
           this.numberofitem=1;
           this.attribute={
             name:'',
             status:'',
             selectedCategory:null,
             categoryOpt:[],
             categories:[],
             values:[],
             valueOpt:[],
             currentsavedid:''
           };
      },
   addNewAttrDiv(){
            this.numberofitem++;
          },
          removeAttrDiv(){
            this.attribute.values.pop();
            this.numberofitem--;
          },
   productcategorieshideModal() {
        this.$refs['product-categories-modal'].hide()
      },
showdropdown(id){
            var newid = 'drop'+id;
            var check = document.getElementById("drop"+id).style.display;
            if (check == "block") {
              document.getElementById("drop"+id).style.display = 'none';
            }else{
              document.getElementById("drop"+id).style.display = 'block';
            }
          },

}


};

</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>