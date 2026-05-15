<template>
  <div>
    <b-container>
      <b-row class="mt-4">
        <b-col cols="12">
          <div class="product-btn float-right">
            <a href="javascript:void(0)" class="text-white font-weight-bold knockdoc_btn_bg box_radius d-inline-block" v-b-modal.product-backend-brand>
            Create Brand
            </a>
          </div>
        </b-col>
      </b-row>
      <b-row class="mt-4">
        <b-col cols="12">
          <template>
            <div class="product-table w-100 d-inline-block">
              <b-table
                  :items="allBrands"
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
                  <img v-if="data.item.logo" class="img-fluid" :src="'/uploads/brands/'+data.item.logo" @error="onImageLoadFailure($event)"/> 
                  <div v-if="!data.item.logo" class="addedClient_character">
                  <span>{{data.item.name.split(' ').slice(0, 2).map(name => name[0]).join('').toUpperCase()}}</span>
                </div>   
               </a>        
            </template>
                <template v-slot:cell(banner)="data">
                <a href="javascript:void(0)">
                  <img v-if="data.item.banner" class="img-fluid" :src="'/uploads/brands/'+data.item.banner" @error="onImageLoadFailure($event)"/> 
                  <div v-if="!data.item.banner" class="addedClient_character">
                  <span>{{data.item.name.split(' ').slice(0, 2).map(name => name[0]).join('').toUpperCase()}}</span>
                </div>   
               </a> 
               </template> 
               <template v-slot:cell(status)="data">
                <p v-if='data.item.status == 0' class="pending-status">Disabled</p>
                <p v-if='data.item.status == 1' class="approve-status">Enabled</p>
              </template>      
           
             <template v-slot:cell(action)="data">
   <a class="dots-icon theme-color-text" href="javascript:void(0)" @click="showdropdown(data.item.id)">
      <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
    </a>
  <div :id="'drop'+data.item.id" class="show-dropdown">
    <a v-if="data.item.status == 0"  class="approve font-weight-bold d-block" href="javascript:void(0)" @click="$bvModal.show('bv-modal-enable'); getId(data.item.id);">
                Enable
            </a> 
            <a  v-if="data.item.status == 1" class="decline font-weight-bold d-block" href="javascript:void(0)" @click="$bvModal.show('bv-modal-disable'); getId(data.item.id);">
              Disable
            </a>
            <a  class="decline font-weight-bold d-block" href="javascript:void(0)" @click="$bvModal.show('bv-modal-delete'); getId(data.item.id);">   Delete
            </a>
            <a v-b-modal.editBrand class="font-weight-bold" href="javascript:void(0)" @click="getId(data.item.id);">
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
  <b-modal id="product-backend-brand" ref="product-categories-modal" title="BootstrapVue" :no-close-on-backdrop = "true" :no-close-on-esc = "true" hide-footer 
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
                           <a class="nav-link text-white" id="v-pills-images-tab" data-toggle="pill" href="#v-pills-images" role="tab" aria-controls="v-pills-images" aria-selected="false">
                           Images
                           </a>
                           <a class="nav-link text-white" id="v-pills-seo-tab" 
                              data-toggle="pill" href="#v-pills-seo" role="tab" aria-controls="v-pills-seo" aria-selected="false">
                           SEO
                           </a>
                        </div>
                     </b-col>
                     <b-col cols="12" col lg ="9">
                        <div class="tab-content tabs-description w-100 d-inline-block float-left" id="v-pills-tabContent">
                           <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                              <div class="banner-heading w-100 d-inline-block pb-2 border-bottom mt-lg-0 mt-4">
                                 <h2 class="text-black text_16 mb-0">General</h2>
                              </div>
                              <b-form>
                                 <b-form-group class="w-100 d-inline-block mt-4">
                                    <label class="w-15 float-left 
                                       text_black pt-2 w-xs-100">Name
                                    </label>
                                    <b-form-input 
                                       id="input-name" 
                                       type="text"
                                       v-model="brand.name"
                                       class="w-85 d-inline-block 
                                       float-left w-xs-100 theme-color-border h_37"
                                       autofocus>
                                    </b-form-input>
                                 </b-form-group>
                              </b-form>
                              <div class="w-100 d-inline-block mb-2 product-categories-checkbox">
                                 <label class="w-15 w-xs-100 float-left text_black">Status
                                 </label>
                                 <div class="checkbox-status w-85 
                                    float-left w-xs-100">
                                    <b-form-checkbox v-model="selected">
                                       <label class="text_black">Enable the product</label>
                                    </b-form-checkbox>
                                 </div>
                              </div>
                              <div class="product-save-btn w-85 w-xs-100 float-right mt-3 pb-4">
                                 <a @click="saveBrand()" href="javascript:void(0)" class="text-white knockdoc_btn_bg box_radius d-inline-block">
                                 Save
                                 </a>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="v-pills-images" role="tabpanel" aria-labelledby="v-pills-images-tab">
                              <div class="banner-heading w-100 d-inline-block pb-2 border-bottom mt-lg-0 mt-4">
                                 <h2 class="text-black text_16 mb-0">IMAGES</h2>
                              </div>
                              <label class="w-100 float-left text-black">Logo Image</label>
                              <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
                                 <div class="upload_img admin-upload product-upload-picture">
                                    <div class="image_icon position-relative float-left d-inline-block mr-3">
                                       <a href="javascript:void(0)">
                                          <i aria-hidden="true" class="fa fa-plus">
                                          </i>
                                       </a>
                                       <b-form-file @change="logoImage" accept="image" enctype="multipart/form-data"
                                       id="logo-img">
                                       </b-form-file>
                                       <b-img v-if="!logoImagePreview" :src="'/uploads/brands/' + brand.logo" width="100" fluid alt="logo-picture" height="100">
                                       </b-img>
                                       <b-img v-else v-bind:src="logoImagePreview" width="100" height="100" fluid alt="logo-picture" v-show="logoShowPreview">
                                       </b-img>
                                    </div>
                                 </div>
                                 </div>
                                 <label class="w-100 float-left text-black">Banner Images
                                 </label>
                                 <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
                                    <div class="upload_img admin-upload product-upload-picture">
                                       <div class="image_icon position-relative float-left d-inline-block mr-3">
                                          <a href="javascript:void(0)">
                                             <i aria-hidden="true" 
                                             class="fa fa-plus"></i>
                                          </a>
                                          <b-form-file @change="bannerImage" accept="image" enctype="multipart/form-data"
                                          id="banner-img">
                                          </b-form-file>
                                          <b-img v-if="!bannerImagePreview" :src="'/uploads/brands/' + brand.banner" width="100" fluid alt="picture" height="100"></b-img>
                                       <b-img v-else v-bind:src="bannerImagePreview" width="100" height="100" fluid alt="base-picture" v-show="bannerShowPreview"></b-img>
                                       </div>
                                    </div>
                                 </div>
                           </div>
                           <div class="tab-pane fade" id="v-pills-seo" role="tabpanel" aria-labelledby="v-pills-seo-tab">
                              <div class="banner-heading w-100 d-inline-block pb-2 border-bottom mt-lg-0 mt-4">
                                 <h2 class="text-black text_16 mb-0">SEO</h2>
                              </div>
                              <b-form>
                                 <b-form-group class="w-100 d-inline-block mt-3">
                                    <label class="w-15 float-left 
                                       text_black pt-2 w-xs-100">Meta Title
                                    </label>
                                    <b-form-input 
                                       id="meta-title-input" 
                                       type="text"
                                       v-model="brand.meta_title"
                                       class="w-85 d-inline-block 
                                       float-left w-xs-100 theme-color-border h_37"
                                       autofocus>
                                    </b-form-input>
                                 </b-form-group>
                                 <b-form-group class="w-100 d-inline-block mt-4">
                                    <label class="w-15 float-left 
                                       text_black pt-2 w-xs-100">Meta Title Keyword 
                                    </label>
                                    <b-form-input 
                                       id="meta-title-keyword" 
                                       type="text"
                                       v-model="brand.meta_key"
                                       class="w-85 d-inline-block 
                                       float-left w-xs-100 theme-color-border h_37"
                                       autofocus>
                                    </b-form-input>
                                 </b-form-group>
                                 <b-form-group class="w-100 d-inline-block mt-4 product-textarea">
                                    <label class="w-15 w-xs-100 float-left 
                                    text_black pt-2">Meta Description
                                    </label>
                                       <b-form-textarea 
                                       id="input-inventory" 
                                       type="text" 
                                       v-model="brand.meta_description"
                                       placeholder="Enter something..."
                                       rows="3"
                                       class="w-85 w-xs-100 d-inline-block 
                                       float-left theme-color-border" 
                                       autofocus>
                                       </b-form-textarea>
                                  </b-form-group>
                              </b-form>
                              <div class="product-save-btn w-85 w-xs-100 float-right mt-3 pb-4">
                                 <a @click="saveBrand()" href="javascript:void(0)" class="text-white knockdoc_btn_bg box_radius d-inline-block">
                                 Save
                                 </a>
                              </div>
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
<!-- Start Approve modal -->
  <div>
    <div id="approve-modal">
  <b-modal id="bv-modal-enable" hide-footer>
    <div class="d-block text-center mb-5">
      <h6>Are you sure to Enable</h6>
    </div>
    <div class="approve-btn w-100 d-inline-block text-center">
    <b-button class="mt-3 cancle-btn mr-3" @click="hideModalEnable()">Cancel</b-button>
    <b-button class="mt-3 bg-gold done-btn border-gold" @click="hideModalEnable(); enable(status_id);">Done</b-button>
  </div>
  </b-modal>
</div>
</div>
<!-- End Approve modal -->
<!-- Start Decline modal -->
  <div>
    <div id="decline-modal">
  <b-modal id="bv-modal-disable" hide-footer>
    <div class="d-block text-center mb-5">
      <h6>Are you sure to Disable</h6>
    </div>
    <div class="approve-btn w-100 d-inline-block text-center">
    <b-button class="mt-3 cancle-btn mr-3" @click="hideModalDisable()">Cancel</b-button>
    <b-button class="mt-3 bg-gold done-btn border-gold" @click="hideModalDisable(); disable(status_id);">Done</b-button>
  </div>
  </b-modal>
</div>
</div>
<!-- End Decline modal -->
<!-- Start Delete modal -->
  <div>
    <div id="delete-modal">
  <b-modal id="bv-modal-delete" hide-footer>
    <div class="d-block text-center mb-5">
      <h6>Are you sure to Delete</h6>
    </div>
    <div class="approve-btn w-100 d-inline-block text-center">
    <b-button class="mt-3 cancle-btn mr-3" @click="hideModalDelete()">Cancel</b-button>
    <b-button class="mt-3 bg-gold done-btn border-gold" @click="hideModalDelete(); deleteBrand(status_id);">Delete</b-button>
  </div>
  </b-modal>
</div>
</div>
<!-- Edit Brand -->
<div>
  <b-modal id="editBrand" ref="edit-brand" 
  :no-close-on-backdrop = "true" 
  :no-close-on-esc = "true" title="BootstrapVue" hide-footer 
  :hide-header="true">
    <div class="w-100 d-inline-block p-2">
      <div class="cross-button float-right">
        <b-icon icon="x" aria-hidden="true" 
        @click="hideeditbrandModal()"></b-icon>
      </div>
      <div class="product-tabs w-100 d-inline-block mt-4">
        <div>
  <b-card no-body>
    <b-tabs pills card vertical>
      <b-tab title="General" active>
        <b-card-text>
            <b-form>
              <b-form-group class="w-100 d-inline-block mt-4">
                <label class="w-10 float-left text-black pt-2 w-xs-100">Name
                </label>
                <b-form-input 
                 id="input-name" 
                 type="text" 
                 v-model="editBrand.name"
                 class="w-80 d-inline-block 
                 float-left border-gold w-xs-100"
                 autofocus>
                </b-form-input>
              </b-form-group>
              <div class="w-100 d-inline-block mb-2">
                <label class="w-10 w-xs-100 float-left text-black">Status
                </label>
                <div class="checkbox-status w-80 float-left w-xs-100">
                  <b-form-checkbox v-model="selected">
                    <label class="text-black">Enable the product</label>
                  </b-form-checkbox>
                </div>
                </div>
            </b-form>
            <div class="product-save-btn w-90 w-xs-100 float-right pb-4">
              <a href="javascript:void(0)" @click="updateBrand(status_id)" class="text-white bg-gold box-radius 
                d-inline-block">
                Update
              </a>
            </div>
        </b-card-text>
      </b-tab>
      <b-tab title="Images">
        <b-card-text>
          <div class="chose-browser w-100 d-inline-block">
            <label class="w-100 float-left text-black">Logo Image</label>
            <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
              <div class="upload_img admin-upload product-upload-picture">
                <div class="image_icon position-relative float-left d-inline-block mr-3">
                    <b-icon icon="plus" aria-hidden="true"></b-icon>
                    <b-form-file @change="editlogoImage" accept="image" enctype="multipart/form-data"
                    id="logo-img">
                    </b-form-file>
                    <b-img v-if="!editLogoImgPreview" :src="'/uploads/brands/' + editBrand.logo" width="100" fluid alt="logo-picture" height="100"></b-img>
                    <b-img v-else v-bind:src="editLogoImgPreview" width="100" height="100" fluid alt="logo-picture" v-show="editLogoShowPreview"></b-img>
                </div>
              </div>
            </div>
            </div>
            <div class="chose-browser w-100 d-inline-block mt-4">
              <label class="w-100 float-left text-black">Banner Images
              </label>
              <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
                <div class="upload_img admin-upload product-upload-picture">
                  <div class="image_icon position-relative float-left d-inline-block mr-3">
                      <b-icon icon="plus" aria-hidden="true"></b-icon>
                      <b-form-file @change="updatebannerImage" accept="image" enctype="multipart/form-data"
                      id="banner-img">
                      </b-form-file>
                       <b-img v-if="!editBannerImgPreview" :src="'/uploads/brands/' + editBrand.banner" width="100" fluid alt="picture" height="100"></b-img>
                    <b-img v-else v-bind:src="editBannerImgPreview" width="100" height="100" fluid alt="base-picture" v-show="editBannerShowPreview"></b-img>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-save-btn w-90 float-right mt-3 pb-4 w-xs-100">
              <a href="javascript:void(0)" @click="updateBrand(status_id)" class="text-white bg-gold box-radius 
              d-inline-block">
                  Update
              </a>
            </div>
        </b-card-text>
      </b-tab>
      <b-tab title="SEO">
        <b-card-text>
          <b-form>
            <b-form-group class="w-100 d-inline-block">
              <label class="w-20 w-xs-100 float-left text-black pt-2">Meta Title
              </label>
             <b-form-input 
             id="input-meta-title" 
             type="text" 
             v-model="editBrand.meta_title"
             class="w-80 w-xs-100 d-inline-block 
             float-left border-gold"
             autofocus>
             </b-form-input>
            </b-form-group>
            <b-form-group class="w-100 d-inline-block mt-3">
              <label class="w-20 w-xs-100 float-left text-black pt-2">Meta Title Keword
              </label>
             <b-form-input 
             id="input-meta-title-keword" 
             type="text" 
             v-model="editBrand.meta_key"
             class="w-80 w-xs-100 d-inline-block 
             float-left border-gold"
             autofocus>
             </b-form-input>
            </b-form-group>
            <label class="w-20 w-xs-100 float-left text-black pt-2">Meta Description
            </label>
            <b-form-textarea
            id="textarea"
            v-model="editBrand.meta_description"
            placeholder="Enter something..."
            rows="3"
            max-rows="6"
            class="border-gold w-80 w-xs-100 float-left">
          </b-form-textarea>
        </b-form>
        <div class="product-save-btn w-80 float-right mt-3 pb-4 w-xs-100">
          <a href="javascript:void(0)" @click="updateBrand(status_id)" class="text-white bg-gold box-radius 
            d-inline-block">
            Update
          </a>
        </div>
        </b-card-text>
      </b-tab>
    </b-tabs>
  </b-card>
</div>
      </div>
    </div>
  </b-modal>
</div>

<!-- End Edit Brand -->
  </div>
</template>
<script>

export default {
  name: "product-brandComponent",
data() {
      return {
        logoImagePreview: null,
        logoShowPreview: false,
        bannerImagePreview: null,
        bannerShowPreview: false,
         editLogoImgPreview: null,
        editLogoShowPreview: false,
        editBannerImgPreview: null,
        editBannerShowPreview: false,
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
           brand:{
              name:'',
              status:'',
              logo:'',
              banner:'',
              meta_title:'',
              meta_description:'',
              meta_key:'',
           },
           editBrand:{
              name:'',
              status:'',
              logo:'',
              banner:'',
              meta_title:'',
              meta_description:'',
              meta_key:'',
           },
           /*data table*/
           moment: moment,
           rows: 100,
           selected: null,
           allBrands:[],
           options: [
             { value: null, text: 'Any status' },
             { value: 'a', text: 'Any status' },
             { value: 'b', text: 'Any status'},
           ],
           fields: [
         { key: 'id', label: 'ID'},
         { key: 'name', label: 'Brand Name'},
         { key: 'logo', label: 'Image'},
         { key: 'banner', label: 'Banner Image'},
         { key: 'meta_title', label: 'Meta Title'},
         { key: 'meta_description', label: 'Meta Description'},
         { key: 'meta_key', label: 'Meta Key'},
         { key: 'status', label: 'Status' , sortable: true  },
         { key: 'action' , label: 'Action'},
         
        ],
      }
    },
    mounted(){
         this.getAllBrands();
       },
methods: {
   enable(id){
        this.$bvModal.show('bv-modal-loading');
        axios.get('/admin/enable-brand/'+id)
          .then(response => {
            this.$bvModal.hide('bv-modal-loading');
            this.getAllBrands();
          })
      },
   disable(id){
        this.$bvModal.show('bv-modal-loading');
        axios.get('/admin/disable-brand/'+id)
          .then(response => {
            this.$toasted.show("Brand Disabled",{
                type:'success',
                duration: 2000
              });
            this.$bvModal.hide('bv-modal-loading');
            this.getAllBrands();
          })
      },
      deleteBrand(id){
        this.$bvModal.show('bv-modal-loading');
        axios.delete('/admin/delete-brand/'+id)
          .then(response => {
            this.$toasted.show("Brand Deleted",{
                type:'success',
                duration: 2000
              });
            this.$bvModal.hide('bv-modal-loading');
            this.getAllBrands();
          })
      },
   hideModalDelete() {
        this.$root.$emit('bv::hide::modal', 'bv-modal-delete')
      },
      hideModalDisable() {
        this.$root.$emit('bv::hide::modal', 'bv-modal-disable')
      },
      hideModalEnable() {
        this.$root.$emit('bv::hide::modal', 'bv-modal-enable')
      },
      hideeditbrandModal(){
        this.$refs['edit-brand'].hide()
      },
   getId(id){
          var data = {specs:this.allBrands};
        var valObj = data.specs.filter((elem)=>{
            if(elem.id == id){
                 this.editBrand=elem;
                 if(this.editBrand.status==1)
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
   logoImage(event)
         {
             this.brand.logo=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.logoShowPreview = true;
              this.logoImagePreview = reader.result;
             }
             .bind(this), false);
 
            if( this.brand.logo )
            {
              reader.readAsDataURL( this.brand.logo );
            }
    
         },
           editlogoImage(event)
         {
             this.editBrand.logo=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.editLogoShowPreview = true;
              this.editLogoImgPreview = reader.result;
             }
             .bind(this), false);
 
            if( this.editBrand.logo )
            {
              reader.readAsDataURL( this.editBrand.logo );
            }
    
         },
         bannerImage(event)
         {
              this.brand.banner=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.bannerShowPreview = true;
              this.bannerImagePreview = reader.result;
             }
             .bind(this), false);
 
            if( this.brand.banner )
            {
              reader.readAsDataURL(this.brand.banner);
            }
         },
         updatebannerImage(event)
         {
              this.editBrand.banner=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.editBannerShowPreview = true;
              this.editBannerImgPreview = reader.result;
             }
             .bind(this), false);
 
            if( this.editBrand.banner )
            {
              reader.readAsDataURL(this.editBrand.banner);
            }
         },
         updateBrand(id)
         {
             if(this.selected==true)
              {
                 this.editBrand.status=1;
              }
              else
              { 
                 this.editBrand.status=0;
              }
              if(this.editBrand.name)
              {
                let formData=new FormData();
                formData.append('name',this.editBrand.name);
                formData.append('status',this.editBrand.status);
                formData.append('logo',this.editBrand.logo);
                formData.append('banner',this.editBrand.banner);
                formData.append('meta_title',this.editBrand.meta_title);
                formData.append('meta_description',this.editBrand.meta_description);
                formData.append('meta_key',this.editBrand.meta_key);
                axios.post('/admin/update-brand/'+id,formData)
                .then((response)=>{
                  this.$toasted.show("Brand Updated",{
                   type:'success',
                   duration: 2000
                 });
                   this.getAllBrands();
                   this.editBrand={
                    name:'',
                    status:'',
                    logo:'',
                    banner:'',
                    meta_title:'',
                    meta_description:'',
                    meta_key:'',
                   };
                   this.selected=null;
                   editLogoShowPreview=false;
                   editBannerShowPreview=false;
                   editLogoImgPreview=null;
                   editBannerImgPreview=null;
                })

              }
              else
              {
                 this.getAllBrands();
                  this.$toasted.show("Please Enter Brand Name",{
                    type:'error',
                    duration: 2000
                  });
              }
         },
   saveBrand()
         {
              if(this.selected==true)
              {
                 this.brand.status=1;
              }
              else
              { 
                 this.brand.status=0;
              }
              if(this.brand.name)
              {
                let formData=new FormData();
                formData.append('name',this.brand.name);
                formData.append('status',this.brand.status);
                formData.append('logo',this.brand.logo);
                formData.append('banner',this.brand.banner);
                formData.append('meta_title',this.brand.meta_title);
                formData.append('meta_description',this.brand.meta_description);
                formData.append('meta_key',this.brand.meta_key);
                axios.post('/admin/save-brand',formData)
                .then((response)=>{
                  this.$toasted.show("Brand Added",{
                   type:'success',
                   duration: 2000
                 });
                   this.getAllBrands();
                   this.brand={
                    name:'',
                    status:'',
                    logo:'',
                    banner:'',
                    meta_title:'',
                    meta_description:'',
                    meta_key:'',
                   };
                   this.selected=null;
                   logoShowPreview=false;
                   bannerShowPreview=false;
                    logoImagePreview=null;
                   bannerImagePreview=null;
                   this.$refs['product-categories-modal'].hide();
                })

              }
              else
              {
                 this.getAllBrands();
                  this.$toasted.show("Please Enter Brand Name",{
                    type:'error',
                    duration: 2000
                  });
              }
            

         },
   getAllBrands()
          {
              axios.get('/admin/get-all-brands')
              .then((response)=>{
                this.allBrands=response.data;
                this.totalRows=this.allBrands.length;
              });
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