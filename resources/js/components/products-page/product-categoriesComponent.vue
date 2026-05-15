<template>
  <div>
    <b-container>
      <b-row class="mt-4">
        <b-col cols="12">
          <div class="product-btn float-right">
            <a href="javascript:void(0)" class="text-white font-weight-bold knockdoc_btn_bg box_radius d-inline-block" v-b-modal.product-backend-categories>
            Create Categories
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
                   :items="products"
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
                  <template v-slot:cell(logo)="data">
                    <a href="javascript:void(0)">
                      <img v-if="data.item.logo" class="img-fluid" :src="'/uploads/product_category/'+data.item.logo" @error="onImageLoadFailure($event)"/> 
                      <div v-if="!data.item.logo" class="addedClient_character">
                      <span>{{data.item.logo.split(' ').slice(0, 2).map(name => name[0]).join('').toUpperCase()}}</span>
                    </div>   
                   </a>        
                </template>
                 <template v-slot:cell(banner)="data">
                    <a href="javascript:void(0)">
                      <img v-if="data.item.banner" class="img-fluid" :src="'/uploads/product_category/'+data.item.banner" @error="onImageLoadFailure($event)"/> 
                      <div v-if="!data.item.banner" class="addedClient_character">
                      <span>{{data.item.banner.split(' ').slice(0, 2).map(name => name[0]).join('').toUpperCase()}}</span>
                    </div>   
                   </a>        
                </template>
                  <template v-slot:cell(status)="data">
                <p v-if='data.item.status == 0' class="pending-status">Disabled</p>
                <p v-if='data.item.status == 1' class="approve-status">Enabled</p>
              </template>
            <template v-slot:cell(top)="data">
              <p class="approve-status mt-2 w-100px" 
              v-if="data.item.top ==1">Top</p>
              <p class="w-100px flaged-status mt-2" v-if="data.item.top ==0">Not Top</p>
            </template>
             <template v-slot:cell(action)="data">
   <!-- <b-icon icon="three-dots-vertical" font-scale="1" @click="showdropdown(data.item.id)">
   </b-icon> -->
   <a class="dots-icon theme-color-text" href="javascript:void(0)" @click="showdropdown(data.item.id)">
      <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
    </a>
  <div :id="'drop'+data.item.id" class="show-dropdown">
            <a v-if="data.item.status == 0"  class="approve font-weight-bold d-block" href="javascript:void(0)" @click="$bvModal.show('bv-modal-active'); getId(data.item.id);">
                Enable
            </a> 
            <a  v-if="data.item.status == 1" class="decline font-weight-bold d-block" href="javascript:void(0)" @click="$bvModal.show('bv-modal-disable'); getId(data.item.id);">
              Disbale
            </a>
            <a v-if="data.item.top == 0" class="decline font-weight-bold d-block" href="javascript:void(0)" @click="markTop(data.item.id);">
              Mark as Top
            </a>
            <a v-if="data.item.top == 1" class="decline font-weight-bold d-block" href="javascript:void(0)" @click="unmarkTop(data.item.id);">
              UnMark as Top
            </a>
            <a  class="decline font-weight-bold d-block" href="javascript:void(0)" @click="$bvModal.show('bv-modal-delete'); getId(data.item.id);">   Delete
            </a>
            <a v-b-modal.editProductCategory class="font-weight-bold" href="javascript:void(0)" @click="getId(data.item.id);">
               Edit 
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
  <b-modal id="product-backend-categories" ref="product-categories-modal" title="BootstrapVue" :no-close-on-backdrop = "true" :no-close-on-esc = "true" hide-footer 
  :hide-header="true">
    <div class="w-100 d-inline-block p-2">
      <div class="cross-btn float-right">
         <a class="text_black text_16" href="javascript:void(0)" @click="productcategorieshideModal()">
           <i class="fa fa-times" aria-hidden="true"></i>
         </a>
      </div>
      <b-form>
       <b-form-group class="w-100 d-inline-block mt-4">
          <label class="w-15 float-left 
             text_black pt-2 w-xs-100">Name
          </label>
          <b-form-input 
             id="input-name" 
             type="text"
             v-model="productCategory.name" 
             class="w-85 d-inline-block 
             float-left w-xs-100 theme-color-border h_37"
             autofocus>
          </b-form-input>
       </b-form-group>
       <b-form-group class="w-100 d-inline-block mt-4">
          <label class="w-15 w-xs-100 float-left text_black pt-2">Slug
          </label>
           <b-form-input 
           id="input-meta-title" 
           type="text"
           v-model="productCategory.slug" 
           class="w-85 d-inline-block 
             float-left w-xs-100 theme-color-border h_37"
           >
           </b-form-input>
        </b-form-group>
        <b-form-group class="w-100 d-inline-block mt-4">
          <label class="w-15 w-xs-100 float-left text_black pt-2">SEO Title
          </label>
           <b-form-input 
           id="input-meta-title" 
           type="text"
           v-model="productCategory.seo_title" 
           class="w-85 d-inline-block 
             float-left w-xs-100 theme-color-border h_37"
           >
           </b-form-input>
        </b-form-group>
        <b-form-group class="w-100 d-inline-block mt-4">
          <label class="w-15 w-xs-100 float-left text_black pt-2">SEO Keyword
          </label>
           <b-form-input 
           id="input-meta-title" 
           type="text"
           v-model="productCategory.seo_keyword" 
           class="w-85 d-inline-block 
             float-left w-xs-100 theme-color-border h_37"
           >
           </b-form-input>
        </b-form-group>
        <b-form-group class="w-100 d-inline-block mt-4">
          <label class="w-15 w-xs-100 float-left text_black pt-2">SEO Description
          </label>
           <b-form-textarea
           id="input-meta-title" 
           placeholder="Enter Something..."
           type="text"
           rows="3"
           v-model="productCategory.seo_description" 
           class="w-85 d-inline-block 
             float-left w-xs-100 theme-color-border"
           >
           </b-form-textarea>
        </b-form-group>
    </b-form>
    <div class="chose-browser w-100 d-inline-block mt-4">
        <label class="w-100 float-left text-black">Base Image</label>
        <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
          <div class="upload_img admin-upload product-upload-picture">
            <div class="image_icon position-relative float-left d-inline-block 
            mr-3">
                <a href="javascript:void(0)">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
                <b-form-file @change="baseImage" accept="image" enctype="multipart/form-data"
                id="base-img">
                </b-form-file>
                <b-img v-if="!imagePreview" :src="'/uploads/product_category/' + productCategory.baseImg" width="100" fluid alt="picture" height="100"></b-img>
                    <b-img v-else v-bind:src="imagePreview" width="100" height="100" fluid alt="base-picture" v-show="showPreview"></b-img>
            </div>
          </div>
        </div>
      </div>
      <div class="chose-browser w-100 d-inline-block mt-4">
        <label class="w-100 float-left text-black">Additional Images</label>
        <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
          <div class="upload_img admin-upload product-upload-picture">
            <div class="image_icon position-relative float-left d-inline-block 
            mr-3">
                <a href="javascript:void(0)">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
                <b-form-file @change="additionalImage" accept="image" enctype="multipart/form-data"
                id="additional-img">
                </b-form-file>
                <b-img v-if="!additionalImagePreview" :src="'/uploads/product_category/' + productCategory.additionalImg" width="100" fluid alt="picture" height="100"></b-img>
                    <b-img v-else v-bind:src="additionalImagePreview" width="100" height="100" fluid alt="additional-picture" v-show="additionalShowPreview"></b-img>
            </div>
          </div>
        </div>
      </div>
    <div class="w-100 d-inline-block mb-2 product-categories-checkbox">
     <div class="checkbox-status w-85 float-left w-xs-100 mt-2">
        <b-form-checkbox v-model="selected">
          <label class="text_black">Enable the product
          </label>
        </b-form-checkbox>
     </div>
    </div>


    <div class="product-save-btn w-85 w-xs-100 float-right mt-3 pb-4">
       <a href="javascript:void(0)" @click="saveProductCategory()" class="text-white knockdoc_btn_bg box_radius d-inline-block">
       Save
       </a>
    </div>
    </div>
  </b-modal>
</div>
<!-- End product categories modal -->
<!-- Start Approve modal -->
  <div>
    <div id="approve-modal">
  <b-modal id="bv-modal-active" hide-footer :hide-header="true" title="BootstrapVue" :no-close-on-backdrop = "true" :no-close-on-esc = "true">
    <div class="w-100 d-inline-block p-2">
      <div class="cross-btn float-right">
        <a href="javascript:void(0)" class="text_black text_16" @click="hideModalActive()">
            <i aria-hidden="true" class="fa fa-times"></i>
        </a>
      </div>
      <h6 class="w-100 d-inline-block mt-3 text-center">Are you sure to Enable</h6>
      <div class="approve-btn w-100 d-inline-block text-center pb-3">
    <b-button class="mt-3 cancle-btn mr-3 text-white font-weight-bold box_radius d-inline-block" @click="hideModalActive()">Cancel</b-button>
    <b-button class="mt-3 done-btn knockdoc_btn_bg theme-color-border text-white font-weight-bold box_radius d-inline-block" @click="hideModalActive(); active(status_id);">Done</b-button>
  </div>
    </div>
  </b-modal>
</div>
</div>
<!-- End Approve modal -->
<!-- Start Decline modal -->
  <div>
    <div id="decline-modal">
  <b-modal id="bv-modal-disable" hide-footer :hide-header="true" title="BootstrapVue" :no-close-on-backdrop = "true" :no-close-on-esc = "true">
    <div class="w-100 d-inline-block p-2">
      <div class="cross-btn float-right">
        <a href="javascript:void(0)" class="text_black text_16" @click="hideModalDisable()">
            <i aria-hidden="true" class="fa fa-times"></i>
        </a>
      </div>
      <h6 class="w-100 d-inline-block mt-3 text-center">Are you sure to Disable</h6>
      <div class="approve-btn w-100 d-inline-block text-center pb-3">
    <b-button class="mt-3 cancle-btn mr-3 text-white font-weight-bold box_radius d-inline-block" @click="hideModalDisable()">Cancel</b-button>
    <b-button class="mt-3 done-btn knockdoc_btn_bg theme-color-border text-white font-weight-bold box_radius d-inline-block" @click="hideModalDisable(); disable(status_id);">Done</b-button>
  </div>
    </div>
  </b-modal>
</div>
</div>
<!-- End Decline modal -->
<!-- Start Delete modal -->
  <div>
    <div id="delete-modal">
  <b-modal id="bv-modal-delete" hide-footer :no-close-on-backdrop = "true" 
  :no-close-on-esc = "true" title="BootstrapVue" :hide-header="true">
    <div class="w-100 d-inline-block p-2">
      <div class="cross-btn float-right">
        <a href="javascript:void(0)" class="text_black text_16" @click="hideModalDelete()">
            <i aria-hidden="true" class="fa fa-times"></i>
        </a>
      </div>
      <h6 class="w-100 d-inline-block mt-3 text-center">Are you sure to Delete</h6>
      <div class="approve-btn w-100 d-inline-block text-center pb-3">
    <b-button class="mt-3 cancle-btn mr-3 text-white font-weight-bold box_radius d-inline-block" @click="hideModalDelete()">Cancel</b-button>
    <b-button class="mt-3 done-btn knockdoc_btn_bg theme-color-border text-white font-weight-bold box_radius d-inline-block" @click="hideModalDelete(); deleteProductCategory(status_id);">Delete</b-button>
  </div>
    </div>
  </b-modal>
</div>
</div>
<!-- End Delete modal -->
<!-- Edit product category -->
<div>
  <b-modal id="editProductCategory" ref="edit-product-categorie" 
  :no-close-on-backdrop = "true" 
  :no-close-on-esc = "true" title="BootstrapVue" hide-footer 
  :hide-header="true">
    <div class="w-100 d-inline-block p-2">
      <div class="cross-button float-right">
        <b-icon icon="x" aria-hidden="true" 
        @click="hideeditproductcategorieModal()"></b-icon>
      </div>
      <b-form>
        <b-form-group class="w-100 d-inline-block mt-4">
          <label class="w-10 w-xs-100 float-left text-black pt-2">Name
          </label>
           <b-form-input 
           id="input-meta-title" 
           type="text"
           v-model="editProductCategory.name" 
           class="w-80 w-xs-100 d-inline-block 
           float-left border-gold"
           autofocus>
           </b-form-input>
        </b-form-group>
        <div class="checkbox-status w-80 float-left w-xs-100">
          <b-form-checkbox v-model="selected">
            <label class="text-black">Enable the product
            </label>
          </b-form-checkbox>
        </div>
      </b-form>
      <div class="chose-browser w-100 d-inline-block mt-4">
        <label class="w-100 float-left text-black">Base Image</label>
        <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
          <div class="upload_img admin-upload product-upload-picture">
            <div class="image_icon position-relative float-left d-inline-block mr-3">
                <b-icon icon="plus" aria-hidden="true"></b-icon>
                <b-form-file @change="logoImage" accept="image" enctype="multipart/form-data"
                id="base-img">
                </b-form-file>
                <b-img v-if="!logoimagePreview" :src="'/uploads/product_category/' + editProductCategory.logo" width="100" fluid alt="picture" height="100"></b-img>
                    <b-img v-else v-bind:src="logoimagePreview" width="100" height="100" fluid alt="base-picture" v-show="logoshowPreview"></b-img>
            </div>
          </div>
        </div>
      </div>
      <div class="chose-browser w-100 d-inline-block mt-4">
        <label class="w-100 float-left text-black">Additional Images</label>
        <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
          <div class="upload_img admin-upload product-upload-picture">
            <div class="image_icon position-relative float-left d-inline-block mr-3">
                <b-icon icon="plus" aria-hidden="true"></b-icon>
                <b-form-file @change="bannerImage" accept="image" enctype="multipart/form-data"
                id="additional-img">
                </b-form-file>
                <b-img v-if="!bannerimagePreview" :src="'/uploads/product_category/' + editProductCategory.banner" width="100" fluid alt="picture" height="100"></b-img>
                    <b-img v-else v-bind:src="bannerimagePreview" width="100" height="100" fluid alt="additional-picture" v-show="bannershowPreview"></b-img>
            </div>
          </div>
        </div>
      </div>
      <b-form-group class="w-100 d-inline-block mt-4">
          <label class="w-10 w-xs-100 float-left text-black pt-2">Slug
          </label>
           <b-form-input 
           id="input-meta-title" 
           type="text"
           v-model="editProductCategory.slug" 
           class="w-80 w-xs-100 d-inline-block 
           float-left border-gold"
           >
           </b-form-input>
        </b-form-group>
      <b-form-group class="w-100 d-inline-block mt-4">
          <label class="w-10 w-xs-100 float-left text-black pt-2">SEO Title
          </label>
           <b-form-input 
           id="input-meta-title" 
           type="text"
           v-model="editProductCategory.seo_title" 
           class="w-80 w-xs-100 d-inline-block 
           float-left border-gold"
           >
           </b-form-input>
        </b-form-group>
        <b-form-group class="w-100 d-inline-block mt-4">
          <label class="w-10 w-xs-100 float-left text-black pt-2">SEO Keyword
          </label>
           <b-form-input 
           id="input-meta-title" 
           type="text"
           v-model="editProductCategory.seo_keyword" 
           class="w-80 w-xs-100 d-inline-block 
           float-left border-gold"
           >
           </b-form-input>
        </b-form-group>
        <b-form-group class="w-100 d-inline-block mt-4">
          <label class="w-10 w-xs-100 float-left text-black pt-2">SEO Description
          </label>
           <b-form-textarea
           id="input-meta-title" 
           type="text"
           v-model="editProductCategory.seo_description" 
           class="w-80 w-xs-100 d-inline-block 
           float-left border-gold"
           >
           </b-form-textarea>
        </b-form-group>
      <div class="product-save-btn w-90 float-right mt-3 pb-4 w-xs-100">
        <a href="javascript:void(0)" @click="updateProductCategory(status_id)" class="text-white bg-gold box-radius 
        d-inline-block">
          update
        </a>
      </div>
    </div>
  </b-modal>
</div>
<!-- End edit product category -->
  </div>
</template>
<script>

export default {
  name: "product-categoriesComponent",
data() {
      return {
       imagePreview: null,
        showPreview: false,
        additionalImagePreview: null,
        additionalShowPreview: false,
        logoimagePreview: null,
        logoshowPreview: false,
        bannerimagePreview: null,
        bannershowPreview: false,
          dateRange: { // for v-model
            type: [Object],
            default: null,
            required: true
          },
           /*data table*/
           totalRows: 1,
           productCategory:{
               name:'',
               baseImg:'',
               additionalImg:'',
               status:0,
               seo_title:'',
               seo_description:'',
               seo_keyword:'',
               slug:''
           },
           editProductCategory:{
               name:'',
               logo:'',
               banner:'',
               status:0,
               seo_title:'',
               seo_description:'',
               seo_keyword:'',
               slug:''
           },
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
           products:[],
           options: [
             { value: null, text: 'Any status' },
             { value: 'a', text: 'Any status' },
             { value: 'b', text: 'Any status'},
           ],
           fields: [
         { key: 'id', label: 'ID'},
         { key: 'name', label: 'Name'},
         { key: 'logo', label: 'Logo Image'},
         { key: 'banner', label: 'Banner Image'},
         { key: 'top', label: 'Top'},
         { key: 'seo_title', label: 'SEO Title'},
         { key: 'seo_description', label: 'SEO Description'},
         { key: 'seo_keyword', label: 'SEO Keyword'},
         { key: 'status', label: 'Status' , sortable: true  },
         { key: 'action', label: 'Action'  },
         
        ],
      }
    },
    mounted(){
         this.getAllProductCategory();
    },
methods: {
  //  hidedeleteModal() {
  //       this.$refs['delete-modal'].hide()
  //     },
   deleteProductCategory(id){
        axios.delete('/admin/delete-product-category/'+id)
          .then(response => {
            this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
            this.getAllProductCategory();
          })
      },
   markTop(id){
            axios.get('/admin/product/category/marktop/'+id)
            .then(response => {
              this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
              this.getAllProductCategory();
              this.showdropdown(id);
            });
          },
          unmarkTop(id){
            axios.get('/admin/product/category/unmarktop/'+id)
            .then(response => {
              this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
              this.getAllProductCategory();
              this.showdropdown(id);
            });
          },
  disable(id){
        axios.get('/admin/disable-product-category/'+id)
          .then(response => {
            this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
            this.getAllProductCategory();
          })
      },
  active(id){
    axios.get('/admin/enable-product-category/'+id)
      .then(response => {
        this.$toasted.show(response.data.message,{
                type:'success',
                duration: 2000
              });
        this.getAllProductCategory();
    });
  },
  hideModalDisable() {
        this.$root.$emit('bv::hide::modal', 'bv-modal-disable')
      },
      hideModalActive() {
        this.$root.$emit('bv::hide::modal', 'bv-modal-active')
      },
      hideModalDelete() {
        this.$root.$emit('bv::hide::modal', 'bv-modal-delete')
      },
  getId(id){
          // alert(id);
          var data = {specs:this.products};
          var valObj = data.specs.filter((elem)=>{
            if(elem.id == id){
                 this.editProductCategory=elem;
                 if(this.editProductCategory.status==1)
                 {
                  this.selected=true;
                 }
                 else
                 {
                  this.selected=false;
                 }
                 
            }
         });
        this.status_id = id;
        this.showdropdown(id);
      },
  getAllProductCategory(){
           axios.get('/get_admin_all_product_category')
             .then(response => {
                 this.products=response.data;
                 this.totalRows = this.products.length;
                 // console.log('pro',this.products);
                 
             })
             .catch((error) => {
             this.success = false;
           });
         },
         baseImage(event)
         {
             this.productCategory.baseImg=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.showPreview = true;
              this.imagePreview = reader.result;
             }
             .bind(this), false);
 
            if( this.productCategory.baseImg )
            {
              reader.readAsDataURL( this.productCategory.baseImg );
            }
    
         },
          logoImage(event)
         {
             this.editProductCategory.logo=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.logoshowPreview = true;
              this.logoimagePreview = reader.result;
             }
             .bind(this), false);
 
            if( this.editProductCategory.logo )
            {
              reader.readAsDataURL( this.editProductCategory.logo );
            }
    
         },
         bannerImage(event)
         {
             this.editProductCategory.banner=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.bannershowPreview = true;
              this.bannerimagePreview = reader.result;
             }
             .bind(this), false);
 
            if( this.editProductCategory.banner)
            {
              reader.readAsDataURL( this.editProductCategory.banner);
            }
         },
         additionalImage(event)
         {
              this.productCategory.additionalImg=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.additionalShowPreview = true;
              this.additionalImagePreview = reader.result;
             }
             .bind(this), false);
 
            if( this.productCategory.additionalImg )
            {
              reader.readAsDataURL( this.productCategory.additionalImg );
            }
         },
         saveProductCategory()
          {
              if(this.selected==true)
              {
                 this.productCategory.status=1;
              }
              else
              { 
                 this.productCategory.status=0;
              }
              if(this.productCategory.name)
              {
                let formData = new FormData();

                 formData.append('name',this.productCategory.name);
                 formData.append('baseImg',this.productCategory.baseImg); 
                 formData.append('additionalImg',this.productCategory.additionalImg);
                 formData.append('seo_title',this.productCategory.seo_title);
                 formData.append('seo_description',this.productCategory.seo_description);
                 formData.append('seo_keyword',this.productCategory.seo_keyword);
                 formData.append('slug',this.productCategory.slug);
                 if(this.productCategory.status!=0)
                 {
                 formData.append('status',this.productCategory.status);  
                 } 
                  axios.post('/save-product-category',formData)
                     .then((response)=>{
                         this.$toasted.show("Category Saved",{
                            type:'success',
                            duration: 2000
                          });
                         this.productCategory={
                          name:'',
                          baseImg:'',
                          additionalImg:'',
                          status:0,
                         };
                         this.selected=null;
                         this.showPreview=false;
                         this.additionalShowPreview=false;
                         this.imagePreview=null;
                         this.additionalImagePreview=null;

                         this.getAllProductCategory();
                     this.$refs['product-categories-modal'].hide();
                     

                     });
              }
              else
              {
                this.getAllProductCategory();
                  this.$toasted.show("Please Enter Category Name",{
                    type:'error',
                    duration: 2000
                  });
              }

                
          },
          updateProductCategory(id)
          {
              if(this.selected==true)
              {
                 this.editProductCategory.status=1;
              }
              else
              { 
                 this.editProductCategory.status=0;
              }
              if(this.editProductCategory.name)
              {
                let formData = new FormData();

                 formData.append('name',this.editProductCategory.name);
                 formData.append('logo',this.editProductCategory.logo); 
                 formData.append('banner',this.editProductCategory.banner);
                 formData.append('seo_title',this.editProductCategory.seo_title);
                 formData.append('seo_description',this.editProductCategory.seo_description);
                 formData.append('seo_keyword',this.editProductCategory.seo_keyword);
                 formData.append('slug',this.editProductCategory.slug);
                 if(this.editProductCategory.status!=0)
                 {
                 formData.append('status',this.editProductCategory.status);  
                 } 
                  axios.post('/update-product-category/'+id,formData)
                     .then((response)=>{
                         this.$toasted.show("Category Updated",{
                            type:'success',
                            duration: 2000
                          });
                         this.editProductCategory={
                          name:'',
                          baseImg:'',
                          additionalImg:'',
                          status:0,
                         };
                         this.selected=null;
                         this.logoimagePreview=null;
                          this.logoshowPreview=false;
                          this.bannerimagePreview=null;
                          this.bannershowPreview=false;
                         this.getAllProductCategory();
                     this.$refs['edit-product-categorie'].hide();
                     

                     });
              }
              else
              {
                this.getAllProductCategory();
                  this.$toasted.show("Please Enter Category Name",{
                    type:'error',
                    duration: 2000
                  });
              }
          },
  onFiltered(filteredItems) {
           // Trigger pagination to update the number of buttons/pages due to filtering
           this.totalRows = filteredItems.length
           this.currentPage = 1
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

<style>

</style>