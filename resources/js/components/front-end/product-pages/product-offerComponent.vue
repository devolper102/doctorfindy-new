<template>
	<div>
        <b-container>
        	<b-row class="mt-4">
		        <b-col cols="8">
		            <div class="brand-heading w-100 d-inline-block">
		                <h2 class="text-black font-weight-bold text-size-32 text-xs-25">{{page_setting.monthly_offer_heading}}</h2>
		            </div>
		        </b-col>
		        <!-- <b-col cols="4">
		        	<div class="view-all float-right">
		        		<a class="text_black text_20 font-weight-bold" href="javascript:void(0)">
		        			View All
		        		</a>
		        	</div>
		        </b-col> -->
            </b-row>
            <div v-if="cartItem.length>0" class="w-100 d-lg-block d-none position-relative">
			 <div id="cartsticky" style="display:none;" class="dropdown-add-to-cart w-30 bg-white box_shadow position-absolute dropdown-add-to-cart-2">
                     <div class="w-20 bg-white box_shadow d-inline-block p-2 cart-sticky" @scroll="handleSCroll">
         <div class="sign-modal-heading w-100 d-inline-block">
            <!-- <a class="text-black d-inline-block float-right text-size-24" 
            href="javascript:void(0)" @click="crossicon()">
                <b-icon icon="X"></b-icon>
            </a> -->
            <h5 class="text-fee font-weight-bold border-bottom pb-3">Cart
               <span class="color-date font-weight-normal">({{cartItem.length}} item)</span>
            </h5>
         </div>
		 <div v-if="cartItem.length>0">
		<div class="scroll-cart-drop w-100 d-inline-block">
         <b-col cols="12 border-bottom pb-2" 
         v-for="(item,index) in cartItem" :key="index">
         <b-row class="mt-3">
            <b-col cols="4">
               <div class="cart-modal-image w-100 d-inline-block">
                  <b-img :src="'/uploads/products/'+item.thumbnail" fluid :alt="item.name+' - photo'">
                  </b-img>
               </div>
            </b-col>
            <b-col cols="12">
            	<b-row>
            		<b-col cols="9">
		               <div class="image-text w-100 d-inline-block">
		                  <p class="text-fee text-size-15 mb-1">
		                     {{item.name}}
		                  </p>
		               </div>
		            </b-col>
		            <b-col cols="3">
                     <div class="remove-text w-100 d-inline-block">
                        <a @click="removeCartItem(index)" class="color-date border-bottom font-weight-bold text-size-14" 
                  href="javascript:void(0)">
                     <i class="fa fa-times" aria-hidden="true"></i>
                  </a>
                     </div>
                  </b-col>
               </b-row>
               <b-row class="mt-3">
                  <b-col cols="12">
                     <label class="w-100 d-inline-block font-weight-bold text-fee mb-0 text-size-14 pl-3">
                        QTY
                     </label>
                     <div class="discount-input w-100 mb-2 
               position-relative service-bg m-auto d-block box-radius w-xs-100">
               <a href="javascript:void(0)" class="float-left d-inline-block w-30 text-center text-size-22" v-on:click="decrement(index,item.discount_price!=''||item.discount_price!=null?item.discount_price:item.price)" 
                      variant="outline-secondary percentage_Btn"> 
                      <span class="minus-icon"></span> 
                  </a>
				  <div style="display:none">
					{{updateState}}
				  </div>
                  <vue-numeric class="form-control w-40 float-left text-center border-0 number-input bg-white box-shadow" 
                  v-model="counterVal[index]" readonly>
                  </vue-numeric>
                   <a href="javascript:void(0)" class="float-left d-inline-block w-30 text-center text-size-22 color-date" v-on:click="increment(index,item.discount_price!=''||item.discount_price!=null?item.discount_price:item.price)" variant="outline-secondary percentage_Btn">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                  </a>
              </div>
                  </b-col>


                  <b-col cols="6">
                     <div class="price w-100 d-inline-block mt-3">
                        <span v-if="item.price" class="color-date text-xs-14">Rs. {{item.price}}</span>
                     </div>
                  </b-col>
                  <b-col cols="6">
                     <div class="price w-100 d-inline-block mt-3">
                        <span v-if="item.discount_price" class="text-fee text-xs-14">Rs. {{item.discount_price}}</span>
                     </div>
                  </b-col>
               </b-row>
            </b-col>
            </b-row>
         </b-col>
		 </div>
            <b-row>
            <b-col cols="6">
               <div class="total-price w-100 d-inline-block mt-3">
                  <span class="text-fee text-size-15 text-xs-14">Total
                      <span class="color-date text-xs-14">(Inclusive of VAT)</span>
                   </span>
               </div>
            </b-col>
            <b-col cols="6">
               <div class="total-price w-100 d-inline-block mt-3 text-center">
                  <span class="text-fee font-weight-bold text-size-17 text-xs-14">
                      Rs. {{total_cart_amount}}
                  </span>
               </div>
            </b-col>
         </b-row>
            <b-row>
            <b-col cols="12">
               <div class="checkout-btn w-100 d-inline-block mt-3 text-center 
               pb-2">
                  <a class="text-white knockdoc_btn_bg box_radius d-inline-block font-weight-bold w-100 pt-2 pb-2" 
                  href="/product/checkout">
                     Proceed to Checkout
                  </a>
               </div>
            </b-col>
         </b-row>
		 </div>
		 <div v-else>
			<p>Cart is Empty! Choose your Product(s)</p>
		 </div>
    </div>
                  </div>
				  </div>
	        <b-row v-if="current_month_products.length>0" class="mt-4 mb-4 monthly-offer-product">
	            <b-col v-for="(month,index) in current_month_products" :key="index" cols="12 mb-lg-0 mb-4" col lg ="6" col xl ="3" col sm ="6"
	            col md ="6">
	            <a :href="'/product-detail/'+month.slug">
		            <div class="product-offer-images w-100 d-inline-block position-relative">
		            	<b-img :src="'uploads/products/'+month.thumbnail" 
		            		fluid :alt="month.name+' - photo'" class="w-100"></b-img>
		            		<div class="deal-off position-absolute">
		            			<span v-if="month.percentage_value>0" class="text-white bg_black box_radius">{{month.percentage_value}}% OFF
		            			</span>
		            			<span v-else class="text-white bg_black box_radius">Exclusive
		            			</span>
		            		</div>
		            		<p class="mt-2 mb-2 text_black text_15">
		            			{{month.name}}
		            		</p>
		            		<strike v-if="month.discount_price" class="text_black float-left">Rs. {{month.price}}
		            		</strike>
		            		<span v-if="month.discount_price" class="text_black font-weight-bold float-right">Rs. {{month.discount_price}}
		            		</span>
		            		<span v-else class="text_black font-weight-bold float-right">Rs. {{month.price}}
		            		</span>
		            		<p class="color-date mt-2 mb-2 text_15 w-100 d-inline-block">{{month.short_description}}</p>
		            		<div v-if="month.reviews.length>0" class="view-rating-star mt-2 w-55 float-left d-inline-block">
	                            <star-rating 
	                            class="float-left mr-3" 
	                            read-only="true"
	                            v-model="month.reviews[0].aggregate"
	                            :show-rating="false" 
	                            active-color="#EA4335" 
	                            :star-size="15">
	                            </star-rating>
	                            <span>{{parseFloat(month.reviews[0].aggregate).toFixed(1)}}</span>
	                        </div>
	                        <div v-else class="view-rating-star mt-2 w-55 float-left d-inline-block">
	                            <star-rating 
	                            class="float-left mr-3" 
	                            read-only="true"
								v-model="month.reviews.length"
	                            :show-rating="false" 
	                            active-color="#EA4335" 
	                            :star-size="15">
	                            </star-rating>
	                            <span class="theme-color-text">{{month.reviews.length}}</span>
	                        </div>
	                        <div class="add-to-cart-btn w-45 float-left 
	                        d-inline-block mt-2">
	                        	<a class="theme-color-text text_14 box_radius font-weight-bold theme-color-border" 
	                        	href="javascript:void(0)" @click="showcartdropdown(month)">
	                        		Add to cart
	                        	</a>
	                        </div>
		            	</div>
		            </a>
	            </b-col>
	        </b-row>
	        <b-row class="mt-4">
		        <b-col cols="8">
		            <div class="brand-heading w-100 d-inline-block">
		                <h2 class="text-black font-weight-bold text-size-32 text-xs-25">{{page_setting.weekly_offer_heading}}</h2>
		            </div>
		        </b-col>
		        <!-- <b-col cols="4">
		        	<div class="view-all float-right">
		        		<a class="text_black text_20 font-weight-bold" href="javascript:void(0)">
		        			View All
		        		</a>
		        	</div>
		        </b-col> -->
            </b-row>
	        <b-row v-if="current_week_products.length>0" class="mt-4 mb-4 monthly-offer-product">
	            <b-col v-for="(week,index) in current_week_products" :key="index" cols="12 mb-lg-0 mb-4" col lg ="6" col xl ="3" col sm ="6" col md ="6">
	            	<a :href="'/product-detail/'+week.slug">
		            	<div class="product-offer-images w-100 d-inline-block position-relative">
		            		<b-img :src="'uploads/products/'+week.thumbnail" 
	            		fluid :alt="week.name+' - photo'" class="w-100"></b-img>
		            		<div class="deal-off position-absolute">
		            			<span v-if="week.percentage_value>0" class="text-white bg_black box_radius">{{week.percentage_value}}% OFF
		            			</span>
		            		</div>
		            		<p class="mt-2 mb-2 text_black text_15">
		            			{{week.name}}
		            		</p>
		            		<strike v-if="week.discount_price" class="text_black float-left">Rs. {{week.price}}
		            		</strike>
		            		<span v-if="week.discount_price" class="text_black font-weight-bold float-right">Rs. {{week.discount_price}}
		            		</span>
		            		<span v-else class="text_black font-weight-bold float-right">Rs. {{week.price}}
		            		</span>
		            		<p class="color-date mt-2 mb-2 text_15 w-100 d-inline-block">{{week.short_description}}</p>
		            		<div v-if="week.reviews.length>0" class="view-rating-star mt-2 w-55 float-left d-inline-block">
	                            <star-rating 
	                            class="float-left mr-3" 
	                            read-only="true"
								v-model="week.reviews[0].aggregate"
	                            :show-rating="false" 
	                            active-color="#EA4335" 
	                            :star-size="15">
	                            </star-rating>
	                            <span class="theme-color-text">{{parseFloat(week.reviews[0].aggregate).toFixed(1)}}</span>
	                        </div>
	                        <div v-else class="view-rating-star mt-2 w-55 float-left d-inline-block">
	                            <star-rating 
	                            class="float-left mr-3" 
	                            read-only="true"
								v-model="week.reviews.length"
	                            :show-rating="false" 
	                            active-color="#EA4335" 
	                            :star-size="15">
	                            </star-rating>
	                            <span class="theme-color-text">{{week.reviews.length}}</span>
	                        </div>
	                        <div class="add-to-cart-btn w-45 float-left 
	                        d-inline-block mt-2">
	                        	<a class="theme-color-text text_14 box_radius font-weight-bold theme-color-border" 
	                        	href="javascript:void(0)" @click="showcartdropdown(week)">
	                        		Add to cart
	                        	</a>
	                        </div>
		            	</div>
		            </a>
	            </b-col>
	        </b-row>
	         <!-- <b-row class="mt-4">
		        <b-col cols="8">
		            <div class="brand-heading w-100 d-inline-block">
		                <h2 class="text-black font-weight-bold text-size-32 text-xs-25">Medicines and Treatment</h2>
		            </div>
		        </b-col>
		        <b-col cols="4">
		        	<div class="view-all float-right">
		        		<a class="text_black text_20 font-weight-bold" href="javascript:void(0)">
		        			View All
		        		</a>
		        	</div>
		        </b-col>
            </b-row> -->
            <!-- <b-row class="mt-4 mb-4">
            	<b-col cols="12 mb-lg-0 mb-4">
	            	<div class="product-offer-images w-100 d-inline-block position-relative">
	            		<b-img src="images/treatment-image.png" 
	            		fluid alt="picture" class="w-100"></b-img>
	            	</div>
	            </b-col>
            </b-row> -->
            <!-- <b-row class="mt-4 mb-4 monthly-offer-product">
	            <b-col cols="12 mb-lg-0 mb-4" col lg ="6" col xl ="3" col sm ="6" col md ="6">
	            	<div class="product-offer-images w-100 d-inline-block position-relative">
	            		<b-img src="images/makeup-offer-image.svg" 
	            		fluid alt="picture" class="w-100"></b-img>
	            		<div class="deal-off position-absolute">
	            			<span class="text-white bg_black box_radius">10% OFF
	            			</span>
	            		</div>
	            		<p class="mt-2 mb-2 text-fee text-size-15">
	            			Philips Beardtrimmer series 1000 Beard trimmer BT1214/15
	            		</p>
	            		<strike class="text-gold d-block">$40.50
	            		</strike>
	            		<span class="text-black font-weight-bold d-block">$39.50
	            		</span>
	            		<p class="color-date mt-2 mb-2 text-size-15">Eligible for Shipping To Mars or somewhere else</p>
	            		<div class="view-rating-star mt-2 w-55 float-left d-inline-block">
                            <star-rating class="float-left mr-3" :show-rating="false" 
                            active-color="#EA4335" :star-size="15">
                            </star-rating>
                            <span>4.5</span>
                        </div>
                        <div class="add-to-cart-btn w-45 float-left 
                        d-inline-block mt-2">
                        	<a class="theme-color-text text_14 box_radius font-weight-bold theme-color-border" 
                        	href="javascript:void(0)" @click="showcartdropdown()">
                        		Add to cart
                        	</a>
                        </div>
	            	</div>
	            </b-col>
	            <b-col cols="12 mb-lg-0 mb-4" col lg ="6" col xl ="3" col sm ="6" col md ="6">
	            	<div class="product-offer-images w-100 d-inline-block position-relative">
	            		<b-img src="images/makeup-box-image.svg" 
	            		fluid alt="picture" class="w-100"></b-img>
	            		<div class="deal-off position-absolute">
	            			<span class="text-white bg_black box_radius">10% OFF
	            			</span>
	            		</div>
	            		<p class="mt-2 mb-2 text-fee text-size-15">
	            			Philips Beardtrimmer series 1000 Beard trimmer BT1214/15
	            		</p>
	            		<strike class="text-gold d-block">$40.50
	            		</strike>
	            		<span class="text-black font-weight-bold d-block">$39.50
	            		</span>
	            		<p class="color-date mt-2 mb-2 text-size-15">Eligible for Shipping To Mars or somewhere else</p>
	            		<div class="view-rating-star mt-2 w-55 float-left d-inline-block">
                            <star-rating class="float-left mr-3" :show-rating="false" 
                            active-color="#EA4335" :star-size="15">
                            </star-rating>
                            <span>4.5</span>
                        </div>
                        <div class="add-to-cart-btn w-45 float-left 
                        d-inline-block mt-2">
                        	<a class="theme-color-text text_14 box_radius font-weight-bold theme-color-border" 
                        	href="javascript:void(0)" @click="showcartdropdown()">
                        		Add to cart
                        	</a>
                        </div>
	            	</div>
	            </b-col>
	            <b-col cols="12 mb-lg-0 mb-4" col lg ="6" col xl ="3" col sm ="6" col md ="6">
	            	<div class="product-offer-images w-100 d-inline-block position-relative">
	            		<b-img src="images/miracle-image.svg" 
	            		fluid alt="picture" class="w-100"></b-img>
	            		<div class="deal-off position-absolute">
	            			<span class="text-white bg_black box_radius">10% OFF
	            			</span>
	            		</div>
	            		<p class="mt-2 mb-2 text-fee text-size-15">
	            			Philips Beardtrimmer series 1000 Beard trimmer BT1214/15
	            		</p>
	            		<strike class="text-gold d-block">$40.50
	            		</strike>
	            		<span class="text-black font-weight-bold d-block">$39.50
	            		</span>
	            		<p class="color-date mt-2 mb-2 text-size-15">Eligible for Shipping To Mars or somewhere else</p>
	            		<div class="view-rating-star mt-2 w-55 float-left d-inline-block">
                            <star-rating class="float-left mr-3" :show-rating="false" 
                            active-color="#EA4335" :star-size="15">
                            </star-rating>
                            <span>4.5</span>
                        </div>
                        <div class="add-to-cart-btn w-45 float-left 
                        d-inline-block mt-2">
                        	<a class="theme-color-text text_14 box_radius font-weight-bold theme-color-border" 
                        	href="javascript:void(0)" @click="showcartdropdown()">
                        		Add to cart
                        	</a>
                        </div>
	            	</div>
	            </b-col>
	            <b-col cols="12 mb-lg-0 mb-4" col lg ="6" col xl ="3" col sm ="6" col md ="6">
	            	<div class="product-offer-images w-100 d-inline-block position-relative">
	            		<b-img src="images/makeup-offer-image-2.svg" 
	            		fluid alt="picture" class="w-100"></b-img>
	            		<div class="deal-off position-absolute">
	            			<span class="text-white bg_black box_radius">10% OFF
	            			</span>
	            		</div>
	            		<p class="mt-2 mb-2 text-fee text-size-15">
	            			Philips Beardtrimmer series 1000 Beard trimmer BT1214/15
	            		</p>
	            		<strike class="text-gold d-block">$40.50
	            		</strike>
	            		<span class="text-black font-weight-bold d-block">$39.50
	            		</span>
	            		<p class="color-date mt-2 mb-2 text-size-15">Eligible for Shipping To Mars or somewhere else</p>
	            		<div class="view-rating-star mt-2 w-55 float-left d-inline-block">
                            <star-rating class="float-left mr-3" :show-rating="false" 
                            active-color="#EA4335" :star-size="15">
                            </star-rating>
                            <span>4.5</span>
                        </div>
                        <div class="add-to-cart-btn w-45 float-left 
                        d-inline-block mt-2">
                        	<a class="theme-color-text text_14 box_radius font-weight-bold theme-color-border" 
                        	href="javascript:void(0)" @click="showcartdropdown()">
                        		Add to cart
                        	</a>
                        </div>
	            	</div>
	            </b-col>
	        </b-row>
	        <b-row class="mt-4">
		        <b-col cols="8">
		            <div class="brand-heading w-100 d-inline-block">
		                <h2 class="text-black font-weight-bold text-size-32 text-xs-25">Surgical Tools</h2>
		            </div>
		        </b-col>
		        <b-col cols="4">
		        	<div class="view-all float-right">
		        		<a class="text_black text_20 font-weight-bold" href="javascript:void(0)">
		        			View All
		        		</a>
		        	</div>
		        </b-col>
            </b-row>
            <b-row class="mt-4 mb-4">
            	<b-col cols="12 mb-lg-0 mb-4">
	            	<div class="product-offer-images w-100 d-inline-block position-relative">
	            		<b-img src="images/surgical-image.png" 
	            		fluid alt="picture" class="w-100"></b-img>
	            	</div>
	            </b-col>
            </b-row>
            <b-row class="mt-4 mb-4 monthly-offer-product">
	            <b-col cols="12 mb-lg-0 mb-4" col lg ="6" col xl ="3" col sm ="6" col md ="6">
	            	<div class="product-offer-images w-100 d-inline-block position-relative">
	            		<b-img src="images/makeup-offer-image.svg" 
	            		fluid alt="picture" class="w-100"></b-img>
	            		<div class="deal-off position-absolute">
	            			<span class="text-white bg_black box_radius">10% OFF
	            			</span>
	            		</div>
	            		<p class="mt-2 mb-2 text-fee text-size-15">
	            			Philips Beardtrimmer series 1000 Beard trimmer BT1214/15
	            		</p>
	            		<strike class="text-gold d-block">$40.50
	            		</strike>
	            		<span class="text-black font-weight-bold d-block">$39.50
	            		</span>
	            		<p class="color-date mt-2 mb-2 text-size-15">Eligible for Shipping To Mars or somewhere else</p>
	            		<div class="view-rating-star mt-2 w-55 float-left d-inline-block">
                            <star-rating class="float-left mr-3" :show-rating="false" 
                            active-color="#EA4335" :star-size="15">
                            </star-rating>
                            <span>4.5</span>
                        </div>
                        <div class="add-to-cart-btn w-45 float-left 
                        d-inline-block mt-2">
                        	<a class="theme-color-text text_14 box_radius font-weight-bold theme-color-border" 
                        	href="javascript:void(0)" @click="showcartdropdown()">
                        		Add to cart
                        	</a>
                        </div>
	            	</div>
	            </b-col>
	            <b-col cols="12 mb-lg-0 mb-4" col lg ="6" col xl ="3" col sm ="6" col md ="6">
	            	<div class="product-offer-images w-100 d-inline-block position-relative">
	            		<b-img src="images/makeup-box-image.svg" 
	            		fluid alt="picture" class="w-100"></b-img>
	            		<div class="deal-off position-absolute">
	            			<span class="text-white bg_black box_radius">10% OFF
	            			</span>
	            		</div>
	            		<p class="mt-2 mb-2 text-fee text-size-15">
	            			Philips Beardtrimmer series 1000 Beard trimmer BT1214/15
	            		</p>
	            		<strike class="text-gold d-block">$40.50
	            		</strike>
	            		<span class="text-black font-weight-bold d-block">$39.50
	            		</span>
	            		<p class="color-date mt-2 mb-2 text-size-15">Eligible for Shipping To Mars or somewhere else</p>
	            		<div class="view-rating-star mt-2 w-55 float-left d-inline-block">
                            <star-rating class="float-left mr-3" :show-rating="false" 
                            active-color="#EA4335" :star-size="15">
                            </star-rating>
                            <span>4.5</span>
                        </div>
                        <div class="add-to-cart-btn w-45 float-left 
                        d-inline-block mt-2">
                        	<a class="theme-color-text text_14 box_radius font-weight-bold theme-color-border" 
                        	href="javascript:void(0)" @click="showcartdropdown()">
                        		Add to cart
                        	</a>
                        </div>
	            	</div>
	            </b-col>
	            <b-col cols="12 mb-lg-0 mb-4" col lg ="6" col xl ="3" col sm ="6" col md ="6">
	            	<div class="product-offer-images w-100 d-inline-block position-relative">
	            		<b-img src="images/miracle-image.svg" 
	            		fluid alt="picture" class="w-100"></b-img>
	            		<div class="deal-off position-absolute">
	            			<span class="text-white bg_black box_radius">10% OFF
	            			</span>
	            		</div>
	            		<p class="mt-2 mb-2 text-fee text-size-15">
	            			Philips Beardtrimmer series 1000 Beard trimmer BT1214/15
	            		</p>
	            		<strike class="text-gold d-block">$40.50
	            		</strike>
	            		<span class="text-black font-weight-bold d-block">$39.50
	            		</span>
	            		<p class="color-date mt-2 mb-2 text-size-15">Eligible for Shipping To Mars or somewhere else</p>
	            		<div class="view-rating-star mt-2 w-55 float-left d-inline-block">
                            <star-rating class="float-left mr-3" :show-rating="false" 
                            active-color="#EA4335" :star-size="15">
                            </star-rating>
                            <span>4.5</span>
                        </div>
                        <div class="add-to-cart-btn w-45 float-left 
                        d-inline-block mt-2">
                        	<a class="theme-color-text text_14 box_radius font-weight-bold theme-color-border" 
                        	href="javascript:void(0)" @click="showcartdropdown()">
                        		Add to cart
                        	</a>
                        </div>
	            	</div>
	            </b-col>
	            <b-col cols="12 mb-lg-0 mb-4" col lg ="6" col xl ="3" col sm ="6" col md ="6">
	            	<div class="product-offer-images w-100 d-inline-block position-relative">
	            		<b-img src="images/makeup-offer-image-2.svg" 
	            		fluid alt="picture" class="w-100"></b-img>
	            		<div class="deal-off position-absolute">
	            			<span class="text-white bg_black box_radius">10% OFF
	            			</span>
	            		</div>
	            		<p class="mt-2 mb-2 text-fee text-size-15">
	            			Philips Beardtrimmer series 1000 Beard trimmer BT1214/15
	            		</p>
	            		<strike class="text-gold d-block">$40.50
	            		</strike>
	            		<span class="text-black font-weight-bold d-block">$39.50
	            		</span>
	            		<p class="color-date mt-2 mb-2 text-size-15">Eligible for Shipping To Mars or somewhere else</p>
	            		<div class="view-rating-star mt-2 w-55 float-left d-inline-block">
                            <star-rating class="float-left mr-3" :show-rating="false" 
                            active-color="#EA4335" :star-size="15">
                            </star-rating>
                            <span>4.5</span>
                        </div>
                        <div class="add-to-cart-btn w-45 float-left 
                        d-inline-block mt-2">
                        	<a class="theme-color-text text_14 box_radius font-weight-bold theme-color-border" 
                        	href="javascript:void(0)" @click="showcartdropdown()">
                        		Add to cart
                        	</a>
                        </div>
	            	</div>
	            </b-col>
	        </b-row> -->
        </b-container>
        <div id="banner-footer" class="w-100 d-inline-block">
	       <!--  <div class="inner-banner position-relative"> -->
	      	    <!-- <div class="wave_img doctor-wave-image">
          <svg class="d-sm-none d-xs-none d-md-none d-lg-block" viewBox="0 0 500 500" preserveAspectRatio="xMinYMin meet">
            <defs>
              <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%"   stop-color="#4374EA"/>
                <stop offset="50%" stop-color="#3563D3"/>
                <stop offset="100%" stop-color="#4173EA"/>
              </linearGradient>
            </defs>
            <path d="M0, 260 C200, 260 190,0 500, 2 L500, -10 L0, 0 Z" style="fill : url(#gradient)">
            </path>
          </svg>
        </div> -->
        <b-container>
		        <b-row>
		        	<b-col cols="12" col lg ="6">
		        		<div class="favourite-product w-100 d-inline-block">
		        			<p class="text-white text-center font-weight-bold text_30 mb-0 position-relative text-xs-20">
		        				{{page_setting.favourite_product_text}}
		        			</p>
		        		</div>
		        	</b-col>
		        	<b-col cols="12" col lg ="6">
		        		<div class="doctor-image w-100 d-inline-block mt-4">
		        			<b-img src="/images/doctor-image.png" 
	            		fluid alt="picture" class="w-100"></b-img>
		        		</div>
		        	</b-col>
		        </b-row>	
		    </b-container>
	        <!-- </div> -->
        </div>

    </div>
</template>

<script>
import StarRating from 'vue-star-rating'
import VueNumeric from 'vue-numeric';
export default 
{
	components: 
  {
  	StarRating,
  	VueNumeric,
  },
  name: "product-offerComponent",
  props:['current_week_products','current_month_products','page_setting'],
  data(){
   			return{
   				value:0,
   				cart_array:[],
				cart_value:[],
				total_cart_amount:0,
				total_amount_array:[],
            	cartItem:[],
				counterVal:[],
				updateState:'',
   			}
   		},
   	mounted(){
		var url_string = window.location.href; //window.location.href
		var url = new URL(url_string);
		var RC = this.getParameterByName('RC');
		var RD = this.getParameterByName('RD');
		var TS = this.getParameterByName('TS');
		var O = this.getParameterByName('O');
		//for checking redirecting from alpha
		if (window.performance.navigation.type == 0 && window.performance.navigation.type != 2) { //for checking redirecting or reloading
			if (RC=='00' && TS=='P') {
				axios.get('/alfa/product/redirect/payment/save/'+O).then((response)=>{
					document.onreadystatechange = () => {
						if (document.readyState == "complete") {
							this.$toasted.show(response.data.message+". Your Order ID is "+response.data.order_id,{
								type:'success',
								duration: 5000
							});
						}
					}
				});
			}
			if (RC=='01' && TS=='F') {
				document.onreadystatechange = () => {
					if (document.readyState == "complete") {
						this.$toasted.show("Payment Declined Please Contact to Reservim",{
							type:'error',
							duration: 4000
						});
					}
				}
			}
		}
		document.onreadystatechange = () => { 
            if (document.readyState == "complete") { 
				// alert('here');
                var storage = JSON.parse(localStorage.getItem('cart'));
				// document.getElementById('cart-item').innerHTML=storage.length;
				var numberCart = document.querySelectorAll("#cart-item");
	        for (var i = numberCart.length - 1; i >= 0; i--) {
	          numberCart[i].innerHTML = storage.length;
	        }
				if(storage){
					this.cartItem = storage;
					this.calculateTotalAmountCart();
					this.productQuantityUpdate();
				}
            } 
        }
	},
methods: {
	getParameterByName(name, url = window.location.href) {
				name = name.replace(/[\[\]]/g, '\\$&');
				var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
				results = regex.exec(url);
				if (!results) return null;
				if (!results[2]) return '';
				return decodeURIComponent(results[2].replace(/\+/g, ' '));
			},
			hidecartModal() {
        		this.$refs['cart-modal'].hide()
      		},
			handleSCroll (event) {
				var cart =  document.getElementById('cartsticky');
				if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 400) {
					cart.style.display = "block";
					document.getElementById("cartdrop").style.display = 'none';
					var storage = JSON.parse(localStorage.getItem('cart'));
					// document.getElementById('cart-item').innerHTML=storage.length;
					var numberCart = document.querySelectorAll("#cart-item");
		        for (var i = numberCart.length - 1; i >= 0; i--) {
		          numberCart[i].innerHTML = storage.length;
		        }
					if(storage){
						this.cartItem = storage;
						this.calculateTotalAmountCart();
						this.productQuantityUpdate();
					}
				} else {
					cart.style.display = "none";
				}
			},
			productQuantityUpdate(){
				if(this.cartItem.length>0){
					this.counterVal=[];
					this.cartItem.filter(elem=>{
						this.counterVal.push(elem.product_quantity);
					});
				}
				this.updateState = this.counterVal[0];
			},
      		increment(index,amount) { 
		        this.counterVal[index]++;
				if(this.counterVal[index]>=100){
					this.counterVal[index] = 100;
					this.$toasted.show('For More Quantity Contact Us.',{
						type:'success',
						duration: 2000
					});
				}else{
					this.saveProductQuantity(index,this.counterVal[index]);
					this.total_cart_amount = this.total_cart_amount+amount;
				}
				this.updateState = this.counterVal[index];
		    },
		    decrement(index,amount) {
		      	this.counterVal[index]--;
				if(this.counterVal[index]<=0){
					this.counterVal[index] = 1;
				}else{
					this.saveProductQuantity(index,this.counterVal[index]);
					this.total_cart_amount = this.total_cart_amount-amount;
				}
				this.updateState = this.counterVal[index];
		  	},
			saveProductQuantity(index,quantity){
				this.cartItem[index].product_quantity = quantity;
				localStorage.setItem("cart", JSON.stringify([...new Set(this.cartItem)]));
			},
		    showcartdropdown(data){
		    	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
					document.getElementById("cartdrop").style.display = 'block';
					window.scrollTo(0, 0);
				}else{
					document.getElementById("cartdrop").style.display = 'block';			
				}
				// this.cart_array.push(data);
				var value = this.cartItem.filter((v) => (v.id===data.id)).length;
				if(value>0){
					this.$toasted.show('Already in Cart. Change quantity from Cart',{
						type:'success',
						duration: 2000
					});
				}else{
					this.getOccurrence(data);
				}
          },
		  getOccurrence(val){
			var obj = val;
			obj.product_quantity = 1;
			this.cartItem.push(obj);
			this.$toasted.show('Product Added in the Cart',{
				type:'success',
				duration: 2000
			});
			localStorage.setItem("cart", JSON.stringify([...new Set(this.cartItem)]));
			// document.getElementById('cart-item').innerHTML=[...new Set(this.cartItem)].length;
			var numberCart = document.querySelectorAll("#cart-item");
        for (var i = numberCart.length - 1; i >= 0; i--) {
          numberCart[i].innerHTML = [...new Set(this.cartItem)].length;
        }
			this.calculateTotalAmountCart();
			this.productQuantityUpdate();
		  },
		  	removeCartItem(index) {
				this.cartItem.splice(index, 1);
				this.counterVal.splice(index, 1);
				localStorage.setItem("cart", JSON.stringify(this.cartItem));
				// document.getElementById('cart-item').innerHTML=[...new Set(this.cartItem)].length;
				var numberCart = document.querySelectorAll("#cart-item");
	        for (var i = numberCart.length - 1; i >= 0; i--) {
	          numberCart[i].innerHTML = [...new Set(this.cartItem)].length;
	        }
				this.calculateTotalAmountCart();
			},
			calculateTotalAmountCart(){
				if(this.cartItem.length > 0){
					this.total_amount_array=[];
					this.cartItem.filter((amount)=>{
						if(amount.discount_price){
							this.total_amount_array.push(amount.discount_price*amount.product_quantity);
						}else{
							this.total_amount_array.push(amount.price*amount.product_quantity);
						}
					});
					this.total_cart_amount = this.total_amount_array.reduce((a,b)=>{return a+b});
				}
			},
          crossicon(id){
            var newid = 'cartdrop';
            var check = document.getElementById("cartdrop").style.display;
            if (check == "block") {
              document.getElementById("cartdrop").style.display = 'none';
            }else{
              document.getElementById("cartdrop").style.display = 'block';
            }
          },
          scrollMeTo() {
		    var element = document.getElementById("cartdrop");
		    var eTop = element.getBoundingClientRect().top;
		    window.scrollBy(0, eTop);
		  },
},
created () {
      window.addEventListener('scroll', this.handleSCroll);
      this.endAt = (new Date).getTime()+60000
      this.startAt = (new Date).getTime()+60000

    },
    destroyed () {
      window.removeEventListener('scroll', this.handleSCroll);
    }
};
</script>

<style>
</style>