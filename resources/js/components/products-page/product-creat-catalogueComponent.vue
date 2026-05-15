<template>
   <div>
      <b-container>
         <b-row class="mt-4">
            <b-col cols="12">
               <div class="catalogue-heading w-100 d-inline-block">
                  <h1 class="text-black text_20">Create Product</h1>
               </div>
            </b-col>
         </b-row>
         <b-row>
            <b-col cols="12">
               <div class="product-tabs w-100 d-inline-block">
                  <b-row>
                     <b-col cols="12" col lg ="2">
                        <div class="nav flex-column nav-pills tab-left-side w-100 d-inline-block float-left p-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                           <a class="nav-link active text-white" 
                              id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true">
                           General
                           </a>
                           <a class="nav-link text-white" id="v-pills-price-tab" 
                              data-toggle="pill" href="#v-pills-price" role="tab" aria-controls="v-pills-price" aria-selected="false"> Price
                           </a>
                           <a class="nav-link text-white" id="v-pills-inventory-tab" data-toggle="pill" href="#v-pills-inventory" role="tab" 
                              aria-controls="v-pills-inventory" aria-selected="false">
                           Inventory
                           </a>
                           <a class="nav-link text-white" id="v-pills-images-tab" data-toggle="pill" href="#v-pills-images" role="tab" aria-controls="v-pills-images" aria-selected="false">
                           Images
                           </a>
                           <a class="nav-link text-white" id="v-pills-seo-tab" 
                              data-toggle="pill" href="#v-pills-seo" role="tab" aria-controls="v-pills-seo" aria-selected="false">
                           SEO
                           </a>
                           <a class="nav-link text-white" id="v-pills-attribute-tab" 
                              data-toggle="pill" href="#v-pills-attribute" role="tab" aria-controls="v-pills-attribute" aria-selected="false">
                           Attribute
                           </a>
                        </div>
                     </b-col>
                     <b-col cols="12" col lg ="10">
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
                                       v-model="product.name"
                                       class="w-85 d-inline-block 
                                       float-left w-xs-100 theme-color-border h_37"
                                       autofocus>
                                    </b-form-input>
                                 </b-form-group>
                                 <b-form-group class="w-100 d-inline-block mt-4">
                                    <label class="w-15 float-left 
                                       text_black pt-2 w-xs-100">Manufacturer Name
                                    </label>
                                    <b-form-input 
                                       id="input-name" 
                                       type="text"
                                       v-model="product.manufacturer_name"
                                       class="w-85 d-inline-block 
                                       float-left w-xs-100 theme-color-border h_37"
                                       autofocus>
                                    </b-form-input>
                                 </b-form-group>
                                 <b-form-group class="editor-desc">
                                    <label class="w-15 float-left pt-2 text_black w-xs-100">Description
                                    </label>
                                    <editor 
                                       class="w-85 w-xs-100 float-left" 
                                       theme="snow" 
                                       :options="editor_options" 
										         v-model="product.description"
                                       >
                                    </editor>
                                 </b-form-group>
                              </b-form>
                              <div class="w-100 d-inline-block mb-2 
                                 product-categories">
                                 <label class="w-15 w-xs-100 float-left pt-2 text_black">Brand
                                 </label>
                                 <div class="product-categories-select w-85 d-inline-block float-left w-xs-100">
                                    <multiselect v-model="product.brand" 
									                     :options="product.brandOpt"  
                                                label="name" 
                                                :allow-empty="false" 
                                                placeholder="Search By Product Name"
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
                              <div class="w-100 d-inline-block mb-2 
                                 product-categories mt-3">
                                 <label class="w-15 w-xs-100 float-left pt-2 text_black">Categories
                                 </label>
                                 <div class="product-categories-select w-85 d-inline-block float-left w-xs-100">
                                    <multiselect v-model="product.selectedCategory" 
                                                placeholder="Add category"
                                                label="name" 
                                                tag-placeholder="Add to new category"
                                                track-by="id"  
                                                :options="product.categoryOpt"
                                                :multiple="true" 
                                                :taggable="false" >
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
                              <div class="w-100 d-inline-block mb-2 
                                 product-categories mt-3">
                                 <label class="w-15 w-xs-100 float-left pt-2 text_black">Tag
                                 </label>
                                 <div class="product-categories-select w-85 d-inline-block float-left w-xs-100">
                                    <multiselect placeholder="Please Select Tag"
                                                   v-model="product.selectedTag" 
                                                   label="name" 
                                                   tag-placeholder="Add to new TAG"
                                                   track-by="id"  
                                                   :options="product.tagOpt"
                                                   :multiple="true" 
                                                   :taggable="false">
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
                                    <b-form-checkbox v-model="product.status">
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
                           <div class="tab-pane fade" id="v-pills-price" role="tabpanel" aria-labelledby="v-pills-price-tab">
                              <div class="banner-heading w-100 d-inline-block pb-2 border-bottom mt-lg-0 mt-4">
                                 <h2 class="text-black text_16 mb-0">Price</h2>
                              </div>
                              <b-form>
                                 <b-form-group class="w-100 d-inline-block mt-3">
                                    <label class="w-15 float-left 
                                       text_black pt-2 w-xs-100">Price
                                    </label>
                                    <b-form-input 
                                       id="Price-name"
                                       v-model="product.price" 
                                       type="text"
                                       class="w-85 d-inline-block 
                                       float-left w-xs-100 theme-color-border h_37"
                                       autofocus>
                                    </b-form-input>
                                 </b-form-group>
                                 <b-form-group class="w-100 d-inline-block mt-4">
                                    <label class="w-15 float-left 
                                       text_black pt-2 w-xs-100">Special Price 
                                    </label>
                                    <b-form-input 
                                       id="special-price" 
                                       v-model="product.discount_price"
                                       type="text"
                                       class="w-85 d-inline-block 
                                       float-left w-xs-100 theme-color-border h_37"
                                       autofocus>
                                    </b-form-input>
                                 </b-form-group>
                              </b-form>
                              <div class="w-100 d-inline-block mb-2 
                                 product-categories mt-3">
                                 <label class="w-15 w-xs-100 float-left pt-2 text_black">Special Price Type
                                 </label>
                                 <div class="product-categories-select w-85 d-inline-block float-left w-xs-100">
                                    <multiselect 
                                       v-model="product.selectedPriceType" 
                                       :options="product.pricetypeOpt" 
                                       label="name" 
                                       track-by="id" 
                                       placeholder = "Please Select">
                                       <template slot="caret">
                                          <div class="multiselect__select">
                                             <b-icon icon="chevron-down" variant="secondary"></b-icon>
                                          </div>
                                          <div class="custom_placeholder">
                                             <!-- Select City -->
                                          </div>
                                       </template>
                                    </multiselect>
                                    <b-form-group v-if="product.selectedPriceType && product.selectedPriceType.id == 2" class="w-100 d-inline-block mt-4">
                                       <label class="w-10 w-xs-100 float-left 
                                       text-black pt-2">Percentage Value
                                       </label>
                                             <b-form-input 
                                             id="input-special-price" 
                                             type="number" 
                                    v-model="product.percentage_value"
                                             class="w-80 d-inline-block 
                                             float-left border-gold w-xs-100"
                                             >
                                             </b-form-input>
                                    </b-form-group>
                                 </div>
                              </div>
                              <div class="appointment-date w-100 d-inline-block mt-3">
									    					<label class="text_black w-15 w-xs-100 float-left">Special Price Start
									    					</label>
									    					<div class="w-85 w-xs-100 d-inline-block">
														    <template>
															    <datetime 
															     format="YYYY-MM-DD h:i" 
                                                  v-model="product.price_start"
										                    placeholder="Date & Time">
															    </datetime>
									              </template>
														    </div>
    				                  </div>
    				                  <div class="appointment-date w-100 d-inline-block mt-4">
									    					<label class="text_black w-15 w-xs-100 float-left">Special Price End
									    					</label>
									    					<div class="w-85 w-xs-100 d-inline-block">
														    <template>
															    <datetime 
															     format="YYYY-MM-DD h:i" 
                                                  v-model="product.price_end"
										                    placeholder="Date & Time">
															    </datetime>
									              </template>
														    </div>
    				                  </div>
                              <div class="product-save-btn w-85 w-xs-100 float-right mt-3 pb-4">
                                 <a href="javascript:void(0)" @click="savePrice()" class="text-white knockdoc_btn_bg box_radius d-inline-block">
                                 Save
                                 </a>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="v-pills-inventory" role="tabpanel" aria-labelledby="v-pills-inventory-tab">
                              <div class="banner-heading w-100 d-inline-block pb-2 border-bottom mt-lg-0 mt-4">
                                 <h2 class="text-black text_16 mb-0">Inventory</h2>
                              </div>
                              <b-form>
                                 <b-form-group class="w-100 d-inline-block mt-3">
                                    <label class="w-15 float-left 
                                       text_black pt-2 w-xs-100">SKU
                                    </label>
                                    <b-form-input 
                                       id="number-name" 
                                       v-model="product.sku"
                                       type="text"
                                       class="w-85 d-inline-block 
                                       float-left w-xs-100 theme-color-border h_37"
                                       autofocus>
                                    </b-form-input>
                                 </b-form-group>
                                 <b-form-group class="w-100 d-inline-block mt-4">
                                    <label class="w-15 float-left 
                                       text_black pt-2 w-xs-100">Available Quantity 
                                    </label>
                                    <b-form-input 
                                       id="number-price" 
                                       v-model="product.quantity"
                                       type="number"
                                       class="w-85 d-inline-block 
                                       float-left w-xs-100 theme-color-border h_37"
                                       autofocus>
                                    </b-form-input>
                                 </b-form-group>
                                 <b-form-group class="w-100 d-inline-block mt-4 product-textarea">
										      					<label class="w-15 w-xs-100 float-left 
										      					text_black pt-2">Return Policy
										      					</label>
                                       <b-form-textarea 
                                       id="input-inventory" 
                                       v-model="product.return_policy"
                                       type="txt" 
                                       placeholder="Enter something..."
                                       rows="4"
                                       class="w-85 w-xs-100 d-inline-block 
                                       float-left theme-color-border" 
                                       autofocus>
                                       </b-form-textarea>
				      				            </b-form-group>
                              </b-form>
                              <div class="w-100 d-inline-block mb-2 
                                 product-categories mt-3">
                                 <label class="w-15 w-xs-100 float-left pt-2 text_black">Stock Availability
                                 </label>
                                 <div class="product-categories-select w-85 d-inline-block float-left w-xs-100">
                                    <multiselect  
                                       v-model="product.stock_availablity" 
                                       :options="product.stockavailablityOpt" 
                                       label="name" track-by="id" 
                                       placeholder="Please Select">
                                            <template slot="caret">
                                                <div class="multiselect__select">
                                                  <b-icon icon="chevron-down" variant="secondary"></b-icon>
                                                </div>
                                            </template>    
                                        </multiselect>
                                 </div>
                              </div>
                              <div class="product-save-btn w-85 w-xs-100 float-right mt-3 pb-4">
                                 <a @click="saveInventory()" href="javascript:void(0)" class="text-white knockdoc_btn_bg box_radius d-inline-block">
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
                                       <label class="w-100 float-left text-black">Additional Images</label>
                                          <div class="ant-upload-picture-card-wrapper pl-lg-3 pr-lg-3 w-100 float-left b-bottom pb-lg-2 pb-5">
                                              <div class="upload_img admin-upload product-upload-picture">
                                                 <div class="image_icon position-relative float-left d-inline-block mr-3">
                                                   <a class="plus-icon theme-color-text position-absolute" 
                                                   href="javascript:void(0)">
                                                      <i class="fa fa-plus" aria-hidden="true"></i>
                                                   </a>
                                                     <b-form-file @change="bannerimage($event)" accept="image" enctype="multipart/form-data"
                                                     id="img">
                                                     </b-form-file>
                                                   <b-img v-if="product.additionalimagespreview" v-for="(item,index) in product.additionalimagepreview" :key="index" :src="item" width="100" height="100" fluid alt="base-picture"></b-img>
                                                 </div>
                                                </div>
                                                </div>
                                    </div>
                                 </div>
                                 <b-form-group class= "form-group input-email mb-2 pr-lg-3 pl-lg-3 product-cropper-image">
                                    <template>
                                    <div id="company_info_croper" class="position-relative d-inline-block">
                                       <a-image-cropper
                                       :auto-crop="true"
                                       :fixed="false"
                                       :original="true"
                                       :centerBox="true"
                                       :fixed-number="[2, 2]"
                                       output-type="webp"
                                       @crop="onImageChange"
                                       >
                                       <template #upload="{ beforeUpload }">
                                          <a-upload
                                          list-type="picture-card"
                                          :before-upload="beforeUpload"
                                          :show-upload-list="false"
                                          accept="image/*"
                                          >
                                          <!-- <img v-if="product.thumbnailurl" :src="product.thumbnailurl" alt="product.thumbnailurl" /> -->
                                          <div class="position-relative d-inline-block"> 
                                             <span v-if="product.thumbnail" class="removelogo_text admin_themecolor font-weight-bold cursor-pointer position-absolute">
                                             Change Base Image
                                             </span>
                                             <span v-else class="company_info_text admin_themecolor font-weight-bold cursor-pointer mt-4 d-inline-block">
                                             Add Base Image
                                             </span>
                                             <span class="float-left">
                                             <img v-if="product.thumbnail" :src="product.thumbnailurl" @error="onImageLoadFailure($event)" :alt="product.thumbnail"/>
                                             <!-- <img v-if="!product.thumbnail" src="/images/barber-cutting-image.svg" :alt="product.name"/> -->
                                             </span>
                                          </div>
                                          </a-upload>
                                       </template>
                                       </a-image-cropper>
                                       <a @click="removeImg" href="#" class="admin_themecolor ml-2" v-if="product.thumbnailurl">
                                       Remove Image
                                       </a>
                                    </div>
                                    </template>
                                 </b-form-group>
                                 </div>
                                 <div class="product-save-btn w-85 w-xs-100 float-right mt-3 pb-4">
                                    <a @click="saveImage()" href="javascript:void(0)" class="text-white knockdoc_btn_bg box_radius d-inline-block">
                                    Save
                                    </a>
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
                                       v-model="product.meta_title"
                                       type="text"
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
                                       v-model="product.meta_key"
                                       type="text"
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
                                       v-model="product.meta_description"
                                       type="txt" 
                                       placeholder="Enter something..."
                                       rows="4"
                                       class="w-85 w-xs-100 d-inline-block 
                                       float-left theme-color-border" 
                                       autofocus>
                                       </b-form-textarea>
				      				            </b-form-group>
				      				            <b-form-group class="w-100 d-inline-block mt-4 product-textarea">
										      					<label class="w-15 w-xs-100 float-left 
										      					text_black pt-2">Short Description
										      					</label>
                                       <b-form-textarea 
                                       id="input-inventory" 
                                       type="txt" 
                                       v-model="product.short_description"
                                       placeholder="Enter something..."
                                       rows="4"
                                       class="w-85 w-xs-100 d-inline-block 
                                       float-left theme-color-border" 
                                       autofocus>
                                       </b-form-textarea>
				      				            </b-form-group>
                              </b-form>
                              <div class="product-save-btn w-85 w-xs-100 float-right mt-3 pb-4">
                                 <a @click="saveSeo()" href="javascript:void(0)" class="text-white knockdoc_btn_bg box_radius d-inline-block">
                                 Save
                                 </a>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="v-pills-attribute" role="tabpanel" aria-labelledby="v-pills-attribute-tab">
                              <div class="banner-heading w-100 d-inline-block pb-2 border-bottom mt-lg-0 mt-4">
                                 <h2 class="text-black text_16 mb-0">Attribute</h2>
                              </div>
                              <b-row>
                                 <b-col v-for="(item,index) in numberofitem" :key="index+1" :id="'valuerepeat'+item" cols="12">
                                    <b-row>
                              	<b-col cols="12" col lg ="5">
                              	<div class="w-100 d-inline-block mb-2 
                                 product-categories mt-3">
                                 <label class="w-100 d-inline-block float-left pt-2 text_black">Attributes
                                 </label>
                                 <div class="product-categories-select w-100 d-inline-block float-left">
                                 <div v-if="updatedomattribute" style="display:none">
                                    {{updatedomattribute}}
                                 </div>
                                    <multiselect 
                                    v-model="product.selectedAttribute[index]" 
                                    :options="product.attributeOpt[index]" 
                                    @input="selectAttributeValue(index)"
                                    label="name" track-by="id" 
                                    placeholder = "Please Select">
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
                              	</b-col>
                              	<b-col cols="12" col lg ="5">
                              		<div class="w-100 d-inline-block mb-2 
                                 product-categories mt-3">
                                 <label class="w-100 d-inline-block float-left pt-2 text_black">Values
                                 </label>
                                 <div class="product-categories-select w-100 d-inline-block float-left">
                                    <div v-if="updatedom" style="display:none">
                                       {{updatedom}}
                                    </div>
                                    <multiselect 
                                    placeholder="Please Select Values"
                                    v-model="product.selectedAttributeValue[index]" 
                                    tag-placeholder="Add to new Value"  
                                    :options="product.attributeValueOpt[index]"
                                    :multiple="true" 
                                    :taggable="false">
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
                              	</b-col>
                              	<b-col cols="12" col lg ="2">
                              		<div class="delete-btn w-100 float-left d-inline-block mt-5 text-center">
                                 <a @click="removeAttribute(index)" href="javascript:void(0)" class="text-white knockdoc_btn_bg box_radius d-inline-block">
                                 <i class="fa fa-trash" aria-hidden="true"></i>
                                 </a>
                              </div>
                              	</b-col>
                              </b-row>
                              </b-col>
                              	<b-col cols="12">
                              		 <div class="product-save-btn w-100 float-left mt-3 d-inline-block">
                                 <a href="javascript:void(0)" @click="addNewAttrDiv()" class="text-white knockdoc_btn_bg box_radius d-inline-block">
                                 Add New Attribute 
                                 </a>
                              </div>
                              	</b-col>
                              	<b-col cols="12">
                              		 <div class="product-save-btn w-100 float-left mt-3 d-inline-block">
                                 <a @click="saveAttribute()" href="javascript:void(0)" class="text-white knockdoc_btn_bg box_radius d-inline-block">
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
      </b-container>
   </div>
</template>
<script>
import datetime from 'vuejs-datetimepicker';
import AImageCropper from "./AImageCropper";
   export default {
   	components: {
   		      datetime, 
   	        AImageCropper
   	      },
     name: "product-creat-catalogueComponent",
     props: ['id'],
   data() {
   	return{
         options:[],
   		product:{
			name:'',
			manufacturer_name:'',
			description:'',
			brand:null,
			brandOpt:[],
			selectedCategory:[],
			categoryOpt:[],
			selectedTag:[],
			tagOpt:[],
			status:'',
			price:'',
			discount_price:'',
			percentage_value:10,
			pricetypeOpt:[],
			selectedPriceType:null,
			price_start:'',
			price_end:'',
			sku:'',
			quantity:0,
			return_policy:'',
			stock_availablity:null,
			stockavailablityOpt:[{id:1,name:"In stock"},{id:0,name:"Out of stock"}],
			thumbnail:'',
			thumbnailurl:'',
			additional_images:[],
			additionalimagespreview:[],
			additionalimagepreview:[],
			meta_title:'',
			meta_key:'',
			meta_description:'',
			short_description:"",
			attributeOpt:[],
			selectedAttribute:[],
			selectedAttributeValue:[],
			attributeValueOpt:[],
			current_save_product_id:'',
			slug:''
		},
		mainText:"Create",
		editState:false,
		numberofitem:1,
		generalTab:true,
		priceTab:false,
		inventoryTab:false,
		imageTab:false,
		seoTab:false,
		attributeTab:false,
		updatedom:0,
		updatedomattribute:0,
  		selectCity:'',
           citiesOpt:[],
        appointment:{
  			datetime:'',
  			charges:'',
  			services:'',
  			description:'',
  		},
  		 editor_options: {
                    modules: {

                        'toolbar': [
                            [{ 'size': [] }],
                            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                            ['bold', 'italic', 'underline'],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'script': 'super' }, { 'script': 'sub' }],
                            [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }],
                            [{ 'direction': 'rtl' }, { 'align': [] }],
                            ['link', 'image', 'video'],
                        ],
                    },
                },
   	}
   },
   mounted(){
		if(this.id){
			this.editState = true;
			this.product.current_save_product_id = this.id;
			this.mainText = "Edit";
			this.setDetails();
			this.getProductData(this.id);
		}else{
         // alert('jere');
			this.getDetails();
		}
	},
   methods:{
      saveGeneral(){
			// console.log('93939',this.product.name,this.product.description,this.product.brand,this.product.selectedCategory,this.product.selectedTag,this.product.status)
			var jsonCategory = [];
			var jsonTag = [];
			var data = {specs:this.product.selectedCategory};
			var tagdata = {tagspecs:this.product.selectedTag}
            var valObj = data.specs.filter((elem,index)=>{
            	jsonCategory.push(elem.id);
            });
			var valObj = tagdata.tagspecs.filter((elem,index)=>{
            	jsonTag.push(elem.id);
            });
			if(this.editState){
				// alert('edit');
				let formData=new FormData();
				formData.append('name',this.product.name);
				formData.append('description',this.product.description);
				formData.append('manufacturer_name',this.product.manufacturer_name);
				formData.append('product_brand_id',this.product.brand.id);
				formData.append('product_category_id',JSON.stringify(jsonCategory));
				formData.append('product_tag_id',JSON.stringify(jsonTag));
				formData.append('product_id',this.product.current_save_product_id);
				formData.append('status',this.product.status==true || this.product.status=='true'?1:0);
				axios.post('/save-product-general',formData).then(response=>{
					this.product.current_save_product_id = response.data.id;
               const tab = document.querySelector('#v-pills-general-tab');
               const newtab = document.querySelector('#v-pills-price-tab');
               const activetab = document.querySelector('#v-pills-price');
               const prevtab = document.querySelector('#v-pills-general')
               //make deactive general tab
               tab.ariaSelected === 'false';
               tab.classList.remove("active");
               //make price tab active
               newtab.ariaSelected === 'true';
               newtab.classList.add("active");
               //active content
               activetab.classList.add("active","show");
               prevtab.classList.remove("active","show");
				});
			}else{
				// alert('save');
				let formData=new FormData();
				formData.append('name',this.product.name);
				formData.append('manufacturer_name',this.product.manufacturer_name);
				formData.append('description',this.product.description);
				formData.append('product_brand_id',this.product.brand.id);
				formData.append('product_category_id',JSON.stringify(jsonCategory));
				formData.append('product_tag_id',JSON.stringify(jsonTag));
				formData.append('status',this.product.status==true || this.product.status=='true'?1:0);
				axios.post('/save-product-general',formData).then(response=>{
					this.product.current_save_product_id = response.data.id;
					const tab = document.querySelector('#v-pills-general-tab');
               const newtab = document.querySelector('#v-pills-price-tab');
               const activetab = document.querySelector('#v-pills-price');
               const prevtab = document.querySelector('#v-pills-general')
               //make deactive general tab
               tab.ariaSelected === 'false';
               tab.classList.remove("active");
               //make price tab active
               newtab.ariaSelected === 'true';
               newtab.classList.add("active");
               //active content
               activetab.classList.add("active","show");
               prevtab.classList.remove("active","show");
				});
			}
		},
		savePrice(){
			// console.log('93939',this.product.price,this.product.discount_price,this.product.selectedPriceType,this.product.price_start,this.product.price_end)
			let formData=new FormData();
         formData.append('price',this.product.price);
         formData.append('discount_price',this.product.discount_price);
         formData.append('price_type_id',this.product.selectedPriceType.id);
			formData.append('price_start',this.product.price_start);
			formData.append('price_end',this.product.price_end);
			formData.append('percentage_value',this.product.percentage_value);
			formData.append('product_id',this.product.current_save_product_id);
         axios.post('/save-product-price',formData).then(response=>{
				if(response.data.statusCode == 200){
					const tab = document.querySelector('#v-pills-price-tab');
               const newtab = document.querySelector('#v-pills-inventory-tab');
               const activetab = document.querySelector('#v-pills-inventory');
               const prevtab = document.querySelector('#v-pills-price')
               //make deactive general tab
               tab.ariaSelected === 'false';
               tab.classList.remove("active");
               //make price tab active
               newtab.ariaSelected === 'true';
               newtab.classList.add("active");
               //active content
               activetab.classList.add("active","show");
               prevtab.classList.remove("active","show");
				}else{
					this.$toasted.show(response.data.message,{
						type:'error',
						duration: 2000
					});
				}
            });
		},
		saveInventory(){
			// console.log('93939',this.product.sku,this.product.stock_availablity)
			let formData=new FormData();
            formData.append('sku',this.product.sku);
            formData.append('stock_availablity',this.product.stock_availablity.id);
            formData.append('quantity',this.product.quantity);
            formData.append('return_policy',this.product.return_policy);
			formData.append('product_id',this.product.current_save_product_id);
            axios.post('/save-product-inventory',formData).then(response=>{
				if(response.data.statusCode == 200){
					const tab = document.querySelector('#v-pills-inventory-tab');
               const newtab = document.querySelector('#v-pills-images-tab');
               const activetab = document.querySelector('#v-pills-images');
               const prevtab = document.querySelector('#v-pills-inventory')
               //make deactive general tab
               tab.ariaSelected === 'false';
               tab.classList.remove("active");
               //make price tab active
               newtab.ariaSelected === 'true';
               newtab.classList.add("active");
               //active content
               activetab.classList.add("active","show");
               prevtab.classList.remove("active","show");
				}else{
					this.$toasted.show(response.data.message,{
						type:'error',
						duration: 2000
					});
				}
            });
		},
		saveSeo(){
			// console.log('93939',this.product.meta_title,this.product.meta_key,this.product.meta_description)
			let formData=new FormData();
         formData.append('meta_title',this.product.meta_title);
         formData.append('meta_key',this.product.meta_key);
			formData.append('meta_description',this.product.meta_description);
			formData.append('short_description',this.product.short_description);
			formData.append('slug',this.product.slug);
			formData.append('product_id',this.product.current_save_product_id);
         axios.post('/save-product-seo',formData).then(response=>{
				if(response.data.statusCode == 200){
					const tab = document.querySelector('#v-pills-seo-tab');
               const newtab = document.querySelector('#v-pills-attribute-tab');
               const activetab = document.querySelector('#v-pills-attribute');
               const prevtab = document.querySelector('#v-pills-seo');
               //make deactive general tab
               tab.ariaSelected === 'false';
               tab.classList.remove("active");
               //make price tab active
               newtab.ariaSelected === 'true';
               newtab.classList.add("active");
               //active content
               activetab.classList.add("active","show");
               prevtab.classList.remove("active","show");
				}else{
					this.$toasted.show(response.data.message,{
						type:'error',
						duration: 2000
					});
				}
            });
		},
		saveAttribute(){
			var jsonAttribute = [];
			var attrdata = {attrspecs:this.product.selectedAttribute};
            var valObj = attrdata.attrspecs.filter((elem,index)=>{
            	jsonAttribute.push(elem.id);
            });
			console.log("33434",jsonAttribute);
			let formData=new FormData();
            formData.append('attributes', JSON.stringify(jsonAttribute));
			formData.append('values',JSON.stringify(this.product.selectedAttributeValue));
			formData.append('product_id',this.product.current_save_product_id);
            axios.post('/save-product-attribute',formData).then(response=>{
				if(response.data.statusCode == 200){
					window.location.href = "/product/catalogue";
				}else{
					this.$toasted.show(response.data.message,{
						type:'error',
						duration: 2000
					});
				}
            });
		},
		saveImage(){
			let formData=new FormData();
			const config = {
				headers: { 'enctype': 'multipart/form-data' },
			}
            formData.append('thumbnail', this.product.thumbnail);
			for( var i = 0; i < this.product.additional_images.length; i++ ){
                  let file = this.product.additional_images[i];
                  formData.append('additional_images[' + i + ']', file);
            }
			formData.append('product_id',this.product.current_save_product_id);
            axios.post('/save-product-images',formData,config).then(response=>{
				if(response.data.statusCode == 200){
					const tab = document.querySelector('#v-pills-images-tab');
               const newtab = document.querySelector('#v-pills-seo-tab');
               const activetab = document.querySelector('#v-pills-seo');
               const prevtab = document.querySelector('#v-pills-images')
               //make deactive general tab
               tab.ariaSelected === 'false';
               tab.classList.remove("active");
               //make price tab active
               newtab.ariaSelected === 'true';
               newtab.classList.add("active");
               //active content
               activetab.classList.add("active","show");
               prevtab.classList.remove("active","show");
				}else{
					this.$toasted.show(response.data.message,{
						type:'error',
						duration: 2000
					});
				}
            });
		},
		selectAttributeValue(index){
			var id = this.product.selectedAttribute[index].id;
			axios.get('/get_attribute_value/'+id).then(response=>{
				this.product.attributeValueOpt[index] = response.data.values;
				this.product.selectedAttributeValue[index]=[];
				this.updatedom++;
				// console.log('03030',this.product.attributeValueOpt[index],index);
				// this.product.attributeOpt[index+1] = response.data;
			});
		},
		setSelectAttributeValue(attributes,attribute_values){
			this.product.attributeOpt=[];
			this.product.attributeValueOpt=[];
			for(var i=0; i<this.numberofitem; i++){
				this.product.attributeOpt.push(attributes);
				this.product.selectedAttribute[i] = this.product.attributeOpt[i].find(option => option.id === attributes[i].id);
				var id = this.product.selectedAttribute[i].id;
				axios.get('/get_attribute_value/'+id).then(response=>{
					this.product.attributeValueOpt.push(response.data.values);
					this.defaultSelectAttrVal(this.product.attributeValueOpt,attribute_values);
				});
			}
		},
		defaultSelectAttrVal(val_option,option_val){
			for(var z=0; z<option_val.length; z++){
				this.product.selectedAttributeValue[z] = option_val[z];
			}
		},
		addNewAttrDiv(){
            this.numberofitem++;
			this.product.attributeValueOpt[this.numberofitem-1] = [];
			this.product.selectedAttributeValue[this.numberofitem-1]=[];
			axios.get('/get_admin_product_attributes').then(response=>{
				this.product.attributeOpt[this.numberofitem-1] = response.data;
				this.updatedomattribute++;
			});
        },
		removeAttribute(index){
			this.product.selectedAttribute.splice(index, 1);
			this.product.selectedAttributeValue.splice(index, 1);
			this.numberofitem--;
			// console.log("939393",this.product.selectedAttribute,this.product.selectedAttributeValue,this.numberofitem);
		},
		onImageChange(image){
			this.product.thumbnail = image;
			this.product.thumbnailurl = URL.createObjectURL(this.product.thumbnail);
		},
		removeImg(){
			this.product.thumbnail='';
      		this.product.thumbnailurl=null;
		},
		onImageLoadFailure(event){
			event.target.src='/images/barber-cutting-image.svg';   
		},
		bannerimage(event){
			var newimage = event.target.files[0];
			var selectedFiles = event.target.files;
            for (let i=0; i < selectedFiles.length; i++){
                this.product.additional_images.push(selectedFiles[i]);
        	}
            let reader  = new FileReader();
            reader.addEventListener("load", function ()
            {
              this.product.additionalimagespreview = true;
              this.product.additionalimagepreview.push(reader.result);
            }
             .bind(this), false);
            if(newimage)
            {
              reader.readAsDataURL(newimage);
            }
		},
		getProductData(id){
			axios.get('/get_product_data/'+id).then(response=>{
				// console.log('here',response.data);
				this.product.name = response.data.name;
				this.product.manufacturer_name = response.data.manufacturer_name;
				this.product.description = response.data.description;
				this.product.brand = response.data.brand;
				this.product.selectedCategory = response.data.categories;
				this.product.selectedTag = response.data.tags;
				this.product.status = response.data.status==1?true:false;
				this.product.price = response.data.price;
				this.product.discount_price = response.data.discount_price;
				this.product.price_start = response.data.price_start;
				this.product.price_end = response.data.price_end;
				this.product.selectedPriceType = this.product.pricetypeOpt.find(option => option.id === response.data.price_type_id);
				this.product.sku = response.data.sku;
				this.product.stock_availablity = this.product.stockavailablityOpt.find(option => option.id === response.data.stock_available);
				this.product.thumbnailurl = "/uploads/products/"+response.data.thumbnail;
				this.product.thumbnail = response.data.thumbnail;
				this.product.meta_title = response.data.meta_title;
				this.product.meta_key = response.data.meta_key;
				this.product.meta_description = response.data.meta_description;
				this.product.quantity = response.data.quantity;
				this.product.return_policy = response.data.return_policy;
				this.product.percentage_value = response.data.percentage_value;
				this.product.slug = response.data.slug;
				this.numberofitem = response.data.attributes.length;
				this.updatedomattribute = 0;
				self = this
				// console.log("cphaeopfi",window.performance.getEntriesByType("navigation"));
				window.document.onreadystatechange = function () {
					if (window.document.readyState === "complete") {
							self.setSelectAttributeValue(response.data.attributes,response.data.values);
					}
				}
				// self.setSelectAttributeValue(response.data.attributes,response.data.values);
			});
		},
		getDetails(){
         // alert('here');
			axios.get('/get_product_details').then(response=>{
				this.product.categoryOpt = response.data.categories;
				this.product.brandOpt = response.data.brands;
				this.product.tagOpt = response.data.tags;
				this.product.pricetypeOpt = response.data.price_type;
				this.product.attributeOpt[0] = response.data.attributes;
				this.product.attributeValueOpt[0] = [];
			});
		},
		setDetails(){
			// alert('set');
			axios.get('/get_product_details').then(response=>{
				this.product.categoryOpt = response.data.categories;
				this.product.brandOpt = response.data.brands;
				this.product.tagOpt = response.data.tags;
				this.product.pricetypeOpt = response.data.price_type;
				// this.product.attributeOpt[0] = response.data.attributes;
				// this.product.attributeValueOpt[0] = [];
			});
		}
   }
   };
   
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>