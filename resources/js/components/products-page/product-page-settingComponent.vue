<template>
  <div>
    <b-container>
      <b-row class="mt-4">
        <b-col cols="12">
        <div class="product-btn float-right mt-lg-0 mt-4">
          <a v-if="productSetting.length==0" class="text-white font-weight-bold knockdoc_btn_bg box_radius d-inline-block" href="javascript:void(0)" 
          v-b-modal.setting-product>
            Create Setting
          </a>
        </div>
      </b-col>
        <b-col cols="12">
          <template>
            <div class="product-table w-100 d-inline-block mt-4">
              <!-- <b-table striped hover :items="items"></b-table> -->
              <b-table
                  :items="productSetting"
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
                  <template v-slot:cell(banner_image)="data">
                      <a class="d-inline-block product-banner-image date-time" 
                      href="javascript:void(0)">
                        <img v-if="data.item.banner_image" class="img-fluid" :src="'/uploads/productsetting/'+data.item.banner_image"/>   
                    </a> 
                  </template>
                  <template v-slot:cell(category_banner_image)="data">
                      <a class="d-inline-block product-input-image" href="javascript:void(0)">
                        <img v-if="data.item.category_banner_image" class="img-fluid" :src="'/uploads/productsetting/'+data.item.category_banner_image"/>   
                    </a> 
                  </template>
                  <template v-slot:cell(favourite_product_image)="data">
                      <a href="javascript:void(0)">
                        <img v-if="data.item.favourite_product_image" class="img-fluid" :src="'/uploads/productsetting/'+data.item.favourite_product_image"/>   
                    </a> 
                  </template>
                  <template v-slot:cell(call_center_logo)="data">
                      <a href="javascript:void(0)">
                        <img v-if="data.item.call_center_logo" class="img-fluid" :src="'/uploads/productsetting/'+data.item.call_center_logo"/>   
                    </a> 
                  </template>
                  <template v-slot:cell(shop_confidence_logo)="data">
                      <a href="javascript:void(0)">
                        <img v-if="data.item.shop_confidence_logo" class="img-fluid" :src="'/uploads/productsetting/'+data.item.shop_confidence_logo"/>   
                    </a> 
                  </template>
                  <template v-slot:cell(safe_payment_logo)="data">
                      <a href="javascript:void(0)">
                        <img v-if="data.item.safe_payment_logo" class="img-fluid" :src="'/uploads/productsetting/'+data.item.safe_payment_logo"/>   
                    </a> 
                  </template>
                  <template v-slot:cell(deliver_all_logo)="data">
                      <a href="javascript:void(0)">
                        <img v-if="data.item.deliver_all_logo" class="img-fluid" :src="'/uploads/productsetting/'+data.item.deliver_all_logo"/>   
                    </a> 
                  </template>
             <template v-slot:cell(action)="data">
                <a class="text_black dots-icon" href="javascript:void(0)" 
                @click="showdropdown(data.item.id)">
                  <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                </a>
                <div :id="'drop'+data.item.id" class="show-dropdown">
                    <a  class="decline font-weight-bold d-block" href="javascript:void(0)" @click="$bvModal.show('bv-modal-delete'); getId(data.item.id);">   Delete
                    </a>
                    <a v-b-modal.setting-product class="font-weight-bold" href="javascript:void(0)" @click="pageSettingData(data.item.id);">
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
    <!-- Start creat setting modal -->
    <div>
  <b-modal id="setting-product" ref="page-setting-modal" title="BootstrapVue" :no-close-on-backdrop = "true" :no-close-on-esc = "true" hide-footer 
  :hide-header="true">
    <div class="w-100 d-inline-block p-3">
      <div class="cross-btn float-right">
        <a class="text_black text_18" href="javascript:void(0)" 
        @click="hideproductcategorieModal()">
          <i class="fa fa-times" aria-hidden="true"></i>
        </a>
        </div>
        <!-- <div class="upload_img admin-upload product-upload-picture w-100 d-inline-block border-bottom pb-2">
            <div class="image_icon position-relative float-left d-inline-block mr-3">
               <label class="w-100 float-left text-black">Banner Image</label>
                  <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
                      <div class="upload_img admin-upload product-upload-picture">
                         <div class="image_icon position-relative float-left d-inline-block mr-3">
                           <a class="plus-icon theme-color-text position-absolute" 
                           href="javascript:void(0)">
                              <i class="fa fa-plus" aria-hidden="true"></i>
                           </a>
                             <b-form-file @change="baseBannerImage" accept="image" enctype="multipart/form-data"
                             id="img">
                             </b-form-file>
                           <b-img v-if="!imageBannerPreview" :src="'/uploads/productsetting/' + productPageSetting.banner_image" width="100" height="100" fluid alt="base-picture"></b-img>
                           <b-img v-else v-bind:src="imageBannerPreview" width="100" height="100" fluid alt="base-picture"></b-img>
                         </div>
                        </div>
                        </div>
            </div>
         </div> -->
         <div class="upload_img admin-upload product-upload-picture w-100 d-inline-block border-bottom pb-2">
            <div class="image_icon position-relative float-left d-inline-block mr-3">
               <label class="w-100 float-left text-black">Category Banner Image</label>
                  <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
                      <div class="upload_img admin-upload product-upload-picture">
                         <div class="image_icon position-relative float-left d-inline-block mr-3">
                           <a class="plus-icon theme-color-text position-absolute" 
                           href="javascript:void(0)">
                              <i class="fa fa-plus" aria-hidden="true"></i>
                           </a>
                             <b-form-file @change="baseCategoryImage" accept="image" enctype="multipart/form-data"
                             id="img2">
                             </b-form-file>
                           <b-img v-if="!imageCategoryBannerPreview" :src="'/uploads/productsetting/' + productPageSetting.category_banner_image" width="100" height="100" fluid alt="base-picture"></b-img>
                           <b-img v-else v-bind:src="imageCategoryBannerPreview" width="100" height="100" fluid alt="base-picture"></b-img>
                         </div>
                        </div>
                        </div>
            </div>
         </div>
      <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Brand Heading 
        </label>
        <b-form-input 
           id="brand-price"
           type="text"
           v-model="productPageSetting.brand_heading" 
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Feature Heading 
        </label>
        <b-form-input 
           id="feature-price"
           type="text"
           v-model="productPageSetting.feature_heading" 
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Monthly Offer Heading 
        </label>
        <b-form-input 
           id="monthly-price"
           type="text"
           v-model="productPageSetting.monthly_offer_heading"
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Weekly Offer Heading 
        </label>
        <b-form-input 
           id="weekly-price"
           type="text"
           v-model="productPageSetting.weekly_offer_heading" 
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <div class="upload_img admin-upload product-upload-picture w-100 d-inline-block border-bottom pb-2 mt-4">
            <div class="image_icon position-relative float-left d-inline-block mr-3">
               <label class="w-100 float-left text-black">Favourite Product Image</label>
        <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
            <div class="upload_img admin-upload product-upload-picture">
               <div class="image_icon position-relative float-left d-inline-block mr-3">
                 <a class="plus-icon theme-color-text position-absolute" 
                 href="javascript:void(0)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                 </a>
                   <b-form-file @change="baseFavouriteProductImage" accept="image" enctype="multipart/form-data"
                   id="img3">
                   </b-form-file>
                 <b-img v-if="!imageFavouriteProductPreview" :src="'/uploads/productsetting/' + productPageSetting.call_center_logo" width="100" height="100" fluid alt="base-picture"></b-img>
                 <b-img v-else v-bind:src="imageFavouriteProductPreview" width="100" height="100" fluid alt="base-picture" v-show="showPreview"></b-img>
               </div>
              </div>
              </div>
            </div>
         </div>
         <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Favourite Product Text 
        </label>
        <b-form-input 
           id="favourite-price"
           type="text"
           v-model="productPageSetting.favourite_product_text" 
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <div class="upload_img admin-upload product-upload-picture w-100 d-inline-block border-bottom pb-2 mt-4">
            <div class="image_icon position-relative float-left d-inline-block mr-3">
               <label class="w-100 float-left text-black">Call Center Logo</label>
        <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
            <div class="upload_img admin-upload product-upload-picture">
               <div class="image_icon position-relative float-left d-inline-block mr-3">
                 <a class="plus-icon theme-color-text position-absolute" 
                 href="javascript:void(0)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                 </a>
                   <b-form-file @change="baseCallCenterImage" accept="image" enctype="multipart/form-data"
                   id="img4">
                   </b-form-file>
                 <b-img v-if="!imageCallCenterPreview" :src="'/uploads/productsetting/' + productPageSetting.call_center_logo" width="100" height="100" fluid alt="base-picture"></b-img>
                 <b-img v-else v-bind:src="imageCallCenterPreview" width="100" height="100" fluid alt="base-picture"></b-img>
               </div>
              </div>
              </div>
            </div>
         </div>
         <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Call Center Heading 
        </label>
        <b-form-input 
           id="call-center"
           type="text"
           v-model="productPageSetting.call_center_heading" 
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Call Center Text
        </label>
        <b-form-input 
           id="call-center-text"
           type="text"
           v-model="productPageSetting.call_center_text"
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <div class="upload_img admin-upload product-upload-picture w-100 d-inline-block border-bottom pb-2 mt-4">
            <div class="image_icon position-relative float-left d-inline-block mr-3">
               <label class="w-100 float-left text-black">Shop Confidence Logo</label>
        <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
            <div class="upload_img admin-upload product-upload-picture">
               <div class="image_icon position-relative float-left d-inline-block mr-3">
                 <a class="plus-icon theme-color-text position-absolute" 
                 href="javascript:void(0)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                 </a>
                   <b-form-file @change="baseShopConfidenceImage" accept="image" enctype="multipart/form-data"
                   id="img5">
                   </b-form-file>
                 <b-img v-if="!imageShopConfidencePreview" :src="'/uploads/productsetting/' + productPageSetting.shop_confidence_logo" width="100" height="100" fluid alt="base-picture"></b-img>
                 <b-img v-else v-bind:src="imageShopConfidencePreview" width="100" height="100" fluid alt="base-picture"></b-img>
               </div>
              </div>
              </div>
            </div>
         </div>
         <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Shop Confidence Heading 
        </label>
        <b-form-input 
           id="shop-confidence-heading"
           type="text"
           v-model="productPageSetting.shop_confidence_heading" 
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Shop Confidence Text
        </label>
        <b-form-input 
           id="shop-confidence-text"
           type="text"
           v-model="productPageSetting.shop_confidence_text" 
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <div class="upload_img admin-upload product-upload-picture w-100 d-inline-block border-bottom pb-2 mt-4">
            <div class="image_icon position-relative float-left d-inline-block mr-3">
               <label class="w-100 float-left text-black">Safe Payment Logo</label>
        <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
            <div class="upload_img admin-upload product-upload-picture">
               <div class="image_icon position-relative float-left d-inline-block mr-3">
                 <a class="plus-icon theme-color-text position-absolute" 
                 href="javascript:void(0)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                 </a>
                   <b-form-file @change="baseSafePaymentImage" accept="image" enctype="multipart/form-data"
                   id="img6">
                   </b-form-file>
                 <b-img v-if="!imageSafePaymentPreview" :src="'/uploads/productsetting/' + productPageSetting.safe_payment_logo" width="100" height="100" fluid alt="base-picture"></b-img>
                 <b-img v-else v-bind:src="imageSafePaymentPreview" width="100" height="100" fluid alt="base-picture"></b-img>
               </div>
              </div>
              </div>
            </div>
         </div>
         <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Safe Payment Heading 
        </label>
        <b-form-input 
           id="safe-payment-heading"
           type="text"
           v-model="productPageSetting.safe_payment_heading"
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Safe Payment Text
        </label>
        <b-form-input 
           id="safe-payment-text"
           type="text"
           v-model="productPageSetting.safe_payment_text"
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <div class="upload_img admin-upload product-upload-picture w-100 d-inline-block border-bottom pb-2 mt-4">
            <div class="image_icon position-relative float-left d-inline-block mr-3">
               <label class="w-100 float-left text-black">Deliver all Logo</label>
        <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
            <div class="upload_img admin-upload product-upload-picture">
               <div class="image_icon position-relative float-left d-inline-block mr-3">
                 <a class="plus-icon theme-color-text position-absolute" 
                 href="javascript:void(0)">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                 </a>
                   <b-form-file @change="baseDeliverAllImage" accept="image" enctype="multipart/form-data"
                   id="img7">
                   </b-form-file>
                 <b-img v-if="!imageDeliverAllPreview" :src="'/uploads/productsetting/' + productPageSetting.deliver_all_logo" width="100" height="100" fluid alt="base-picture"></b-img>
                 <b-img v-else v-bind:src="imageDeliverAllPreview" width="100" height="100" fluid alt="base-picture"></b-img>
               </div>
              </div>
              </div>
            </div>
         </div>
         <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Deliver all Heading 
        </label>
        <b-form-input 
           id="deliver-heading"
           type="text"
           v-model="productPageSetting.deliver_all_heading" 
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Deliver all Text
        </label>
        <b-form-input 
           id="deliver-text"
           type="text"
           v-model="productPageSetting.deliver_all_text"
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Product Page SEO Title 
        </label>
        <b-form-input 
           id="seo-title"
           type="text"
           v-model="productPageSetting.product_seo_title"
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Product Page SEO Keyword
        </label>
        <b-form-input 
           id="seo-keyword"
           type="text"
           v-model="productPageSetting.product_seo_keyword"
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <b-form-group class="w-100 d-inline-block mt-4">
        <label class="w-20 float-left 
           text_black pt-2 w-xs-100">Product Page SEO Description
        </label>
        <b-form-input 
           id="seo-description"
           type="text"
           v-model="productPageSetting.product_seo_description"
           class="w-80 d-inline-block 
           float-left w-xs-100 theme-color-border h_37"
           >
        </b-form-input>
      </b-form-group>
      <div class="product-save-btn w-80 w-xs-100 float-right mt-3 pb-4">
        <a href="javascript:void(0)" @click="saveProductPageSetting()" class="text-white knockdoc_btn_bg box_radius d-inline-block">
         Save
        </a>
      </div>
    </div>
  </b-modal>
</div>
    <!-- End creat setting modal -->
    <!-- Edit product category -->
<div>
  <b-modal id="editproductPageSetting" ref="edit-product-categorie" 
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
           v-model="editproductPageSetting.name" 
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
                <b-img v-if="!logoimagePreview" :src="'/uploads/productsetting/' + editproductPageSetting.logo" width="100" fluid alt="picture" height="100"></b-img>
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
                <b-img v-if="!bannerimagePreview" :src="'/uploads/productsetting/' + editproductPageSetting.banner" width="100" fluid alt="picture" height="100"></b-img>
                    <b-img v-else v-bind:src="bannerimagePreview" width="100" height="100" fluid alt="additional-picture" v-show="bannershowPreview"></b-img>
            </div>
          </div>
        </div>
      </div>
      <b-form-group class="w-100 d-inline-block mt-4">
          <label class="w-10 w-xs-100 float-left text-black pt-2">SEO Title
          </label>
           <b-form-input 
           id="input-meta-title" 
           type="text"
           v-model="editproductPageSetting.seo_title" 
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
           v-model="editproductPageSetting.seo_keyword" 
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
           v-model="editproductPageSetting.seo_description" 
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
  name: "product-page-settingComponent",
data() {
      return {
        imagePreview: null,
          imageBannerPreview:null,
          imageCategoryBannerPreview:null,
          imageCallCenterPreview:null,
          imageShopConfidencePreview:null,
          imageSafePaymentPreview:null,
          imageDeliverAllPreview:null,
          imageFavouriteProductPreview:null,
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
           productPageSetting:{
               banner_image:'',
                category_banner_image:'',
                brand_heading:'',
                feature_heading:'',
                monthly_offer_heading:'',
                weekly_offer_heading:'',
                favourite_product_text:'',
                favourite_product_image:'',
                call_center_logo:'',
                call_center_heading:'',
                call_center_text:'',
                shop_confidence_logo:'',
                shop_confidence_heading:'',
                shop_confidence_text:'',
                safe_payment_logo:'',
                safe_payment_heading:'',
                safe_payment_text:'',
                deliver_all_logo:'',
                deliver_all_heading:'',
                deliver_all_text:'',
                product_seo_title:'',
                product_seo_keyword:'',
                product_seo_description:''
           },
           editproductPageSetting:{
               banner_image:'',
                category_banner_image:'',
                brand_heading:'',
                feature_heading:'',
                monthly_offer_heading:'',
                weekly_offer_heading:'',
                favourite_product_text:'',
                favourite_product_image:'',
                call_center_logo:'',
                call_center_heading:'',
                call_center_text:'',
                shop_confidence_logo:'',
                shop_confidence_heading:'',
                shop_confidence_text:'',
                safe_payment_logo:'',
                safe_payment_heading:'',
                safe_payment_text:'',
                deliver_all_logo:'',
                deliver_all_heading:'',
                deliver_all_text:'',
                product_seo_title:'',
                product_seo_keyword:'',
                product_seo_description:''
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
           productSetting:[],
           options: [
             { value: null, text: 'Any status' },
             { value: 'a', text: 'Any status' },
             { value: 'b', text: 'Any status'},
           ],
           fields: [
         { key: 'id', label: 'ID'},
         { key: 'banner_image', label: 'Banner Image'},
         { key: 'category_banner_image', label: 'Category Banner Image'},
         { key: 'brand_heading', label: 'Brand Heading'},
         { key: 'feature_heading', label: 'Feature Heading'},
         { key: 'monthly_offer_heading', label: 'Monthly Offer Heading'},
         { key: 'weekly_offer_heading', label: 'Weekly Offer Heading'},
         { key: 'favourite_product_text', label: 'Featured Product Text'},
         { key: 'favourite_product_image', label: 'Featured Product Image'},
         { key: 'call_center_logo', label: 'Call Center Logo'},
         { key: 'call_center_heading', label: 'Call Center Heading'},
         { key: 'call_center_text', label: 'Call Center Text'},
         { key: 'shop_confidence_logo', label: 'Shop Confidence Logo'},
         { key: 'shop_confidence_heading', label: 'Shop Confidence Heading'},
         { key: 'shop_confidence_text', label: 'Shop Confidence Text'},
         { key: 'safe_payment_logo', label: 'Safe Payment Logo'},
         { key: 'safe_payment_heading', label: 'Safe Payment Heading'},
         { key: 'safe_payment_text', label: 'Safe Payment Text'},
         { key: 'deliver_all_logo', label: 'Deliver All Logo'},
         { key: 'deliver_all_heading', label: 'Deliver All Heading'},
         { key: 'deliver_all_text', label: 'Deliver All Text'},
         { key: 'product_seo_title', label: 'SEO Title'},
         { key: 'product_seo_keyword', label: 'SEO Heading'},
         { key: 'product_seo_description', label: 'SEO Description'},
         { key: 'action', label: 'Action'  },
        ],
      }
    },
    mounted(){
         this.getAllProductSetting();
       },
methods: {
    hideproductcategorieModal() {
        this.$refs['page-setting-modal'].hide()
      },
      hideeditproductcategorieModal() {
        this.$refs['edit-product-categorie'].hide()
      },
    getAllProductSetting(){
           axios.get('/get_admin_all_product_setting')
             .then(response => {
                 this.productSetting=response.data;
                 // console.log('pro',this.products);
                 
             })
             .catch((error) => {
             this.success = false;
           });
         },
         updateProductCategory(id)
          {
              if(this.selected==true)
              {
                 this.editproductPageSetting.status=1;
              }
              else
              { 
                 this.editproductPageSetting.status=0;
              }
              if(this.editproductPageSetting.name)
              {
                let formData = new FormData();

                 formData.append('name',this.editproductPageSetting.name);
                 formData.append('logo',this.editproductPageSetting.logo); 
                 formData.append('banner',this.editproductPageSetting.banner);
                 formData.append('seo_title',this.editproductPageSetting.seo_title);
                 formData.append('seo_description',this.editproductPageSetting.seo_description);
                 formData.append('seo_keyword',this.editproductPageSetting.seo_keyword);
                 if(this.editproductPageSetting.status!=0)
                 {
                 formData.append('status',this.editproductPageSetting.status);  
                 } 
                  axios.post('/update-product-category/'+id,formData)
                     .then((response)=>{
                         // console.log('prrro',response.data);
                         this.editproductPageSetting={
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
                         this.getAllProductSetting();
                     $('#setting-product').modal('hide');
                     

                     });
              }
              else
              {
                this.getAllProductSetting();
                  this.$toasted.show("Please Enter Category Name",{
                    type:'error',
                    duration: 2000
                  });
              }
          },
  saveProductPageSetting()
          {
                let formData = new FormData();
                 formData.append('banner_image',this.productPageSetting.banner_image);
                 formData.append('category_banner_image',this.productPageSetting.category_banner_image); 
                 formData.append('brand_heading',this.productPageSetting.brand_heading);
                 formData.append('feature_heading',this.productPageSetting.feature_heading);
                 formData.append('monthly_offer_heading',this.productPageSetting.monthly_offer_heading);
                 formData.append('weekly_offer_heading',this.productPageSetting.weekly_offer_heading);
                 formData.append('favourite_product_text',this.productPageSetting.favourite_product_text);
                 formData.append('favourite_product_image',this.productPageSetting.favourite_product_image);
                 formData.append('call_center_logo',this.productPageSetting.call_center_logo);
                 formData.append('call_center_heading',this.productPageSetting.call_center_heading);
                 formData.append('call_center_text',this.productPageSetting.call_center_text);
                 formData.append('shop_confidence_logo',this.productPageSetting.shop_confidence_logo);
                 formData.append('shop_confidence_heading',this.productPageSetting.shop_confidence_heading);
                 formData.append('shop_confidence_text',this.productPageSetting.shop_confidence_text);
                 formData.append('safe_payment_logo',this.productPageSetting.safe_payment_logo);
                 formData.append('safe_payment_heading',this.productPageSetting.safe_payment_heading);
                 formData.append('safe_payment_text',this.productPageSetting.safe_payment_text);
                 formData.append('deliver_all_logo',this.productPageSetting.deliver_all_logo);
                 formData.append('deliver_all_heading',this.productPageSetting.deliver_all_heading);
                 formData.append('deliver_all_text',this.productPageSetting.deliver_all_text);
                 formData.append('product_seo_title',this.productPageSetting.product_seo_title);
                 formData.append('product_seo_keyword',this.productPageSetting.product_seo_keyword);
                 formData.append('product_seo_description',this.productPageSetting.product_seo_description);
                  axios.post('/save-product-page-setting',formData)
                     .then((response)=>{
                        this.$toasted.show(response.data.message,{
                            type:'success',
                            duration: 2000
                        });
                        this.getAllProductSetting();
                        $('#setting-product').modal('hide');
                     });
          },
          pageSettingData(id){
              this.productPageSetting = this.productSetting[0];
            //   this.productSetting.filter((elem)=>{
            //       if(el)
            //   });
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
          baseBannerImage(event)
         {
            //  alert('fhfhn');
             this.productPageSetting.banner_image=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.showPreview = true;
              this.imageBannerPreview = reader.result;
             }
             .bind(this), false);
 
            if( this.productPageSetting.banner_image )
            {
              reader.readAsDataURL( this.productPageSetting.banner_image );
            }
    
         },
         baseCategoryImage(event){
            //  alert('here');
             this.productPageSetting.category_banner_image=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.showPreview = true;
              this.imageCategoryBannerPreview = reader.result;
             }
             .bind(this), false);
 
            if( this.productPageSetting.category_banner_image )
            {
              reader.readAsDataURL( this.productPageSetting.category_banner_image );
            }
         },
         baseDeliverAllImage(event){
            this.productPageSetting.deliver_all_logo=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.showPreview = true;
              this.imageDeliverAllPreview = reader.result;
             }
             .bind(this), false);
 
            if( this.productPageSetting.deliver_all_logo )
            {
              reader.readAsDataURL( this.productPageSetting.deliver_all_logo );
            }
         },
         baseFavouriteProductImage(event){
             this.productPageSetting.favourite_product_image=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.showPreview = true;
              this.imageFavouriteProductPreview = reader.result;
             }
             .bind(this), false);
 
            if( this.productPageSetting.favourite_product_image )
            {
              reader.readAsDataURL( this.productPageSetting.favourite_product_image );
            }
         },
         baseCallCenterImage(event){
             this.productPageSetting.call_center_logo=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.showPreview = true;
              this.imageCallCenterPreview = reader.result;
             }
             .bind(this), false);
 
            if( this.productPageSetting.call_center_logo )
            {
              reader.readAsDataURL( this.productPageSetting.call_center_logo );
            }
         },
         baseShopConfidenceImage(event){
             this.productPageSetting.shop_confidence_logo=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.showPreview = true;
              this.imageShopConfidencePreview = reader.result;
             }
             .bind(this), false);
 
            if( this.productPageSetting.shop_confidence_logo )
            {
              reader.readAsDataURL( this.productPageSetting.shop_confidence_logo );
            }
         },
         baseSafePaymentImage(event){
             this.productPageSetting.safe_payment_logo=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.showPreview = true;
              this.imageSafePaymentPreview = reader.result;
             }
             .bind(this), false);
 
            if( this.productPageSetting.safe_payment_logo )
            {
              reader.readAsDataURL( this.productPageSetting.safe_payment_logo );
            }
         },
          logoImage(event)
         {
             this.editproductPageSetting.logo=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.logoshowPreview = true;
              this.logoimagePreview = reader.result;
             }
             .bind(this), false);
 
            if( this.editproductPageSetting.logo )
            {
              reader.readAsDataURL( this.editproductPageSetting.logo );
            }
    
         },
         bannerImage(event)
         {
             this.editproductPageSetting.banner=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.bannershowPreview = true;
              this.bannerimagePreview = reader.result;
             }
             .bind(this), false);
 
            if( this.editproductPageSetting.banner)
            {
              reader.readAsDataURL( this.editproductPageSetting.banner);
            }
         },
         additionalImage(event)
         {
              this.productPageSetting.additionalImg=event.target.files[0];
            
              let reader  = new FileReader();
            reader.addEventListener("load", function ()
             {
              this.additionalShowPreview = true;
              this.additionalImagePreview = reader.result;
             }
             .bind(this), false);
 
            if( this.productPageSetting.additionalImg )
            {
              reader.readAsDataURL( this.productPageSetting.additionalImg );
            }
         },

}


};

</script>

<style>

</style>