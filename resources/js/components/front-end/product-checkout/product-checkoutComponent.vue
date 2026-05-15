<template>
	<div>
		<b-container>
			<b-row class="mt-4 mb-4"> 
				<b-col cols="12" col lg ="6">
					<div class="login-heading float-right">
						<span v-if="!logged_user" class="text-fee text_16">
							Already have an account? <a href="/login">Log in</a>
						</span>
					</div>
					<div class="w-100 d-inline-block border box_radius mt-2">
						<div class="product-checkout-accordian w-100 d-inline-block position-relative p-3">
							<a :disabled="disableDetail" href="javascript:void(0)" class="text_black font-weight-bold text_18 w-100 d-inline-block" v-b-toggle.collapse-product-checkout-deatils>
								<span class="theme-color-text bg_black mr-2 d-inline-block text-center text_16">1</span>Detail
							</a>
						    <b-collapse id="collapse-product-checkout-deatils" v-model="visible" accordion="my-accordion">
							    <b-card class="border-0">
							      	<b-form>
				                        <b-form-group class="product-checkout-form w-100 d-inline-block mt-3">
				                        	<label class="w-100 d-inline-block text_black text_14 font-weight-bold">
				                        		Name
				                        	</label>
				                           <b-form-input
				                              id="checkout-name"
				                              type="text"
				                              v-model="register.name"
				                              class="w-100 d-inline-block h-45"
				                              placeholder="Enter your name">
				                           </b-form-input>
				                           <span v-if="allerrors.first_name" class=" text-danger">{{ allerrors.first_name[0] }}</span>
				                        </b-form-group>
				                        <b-form-group class="product-checkout-form w-100 d-inline-block">
				                        	<label class="w-100 d-inline-block mb-0 text_black text_14 font-weight-bold">
				                        		Phone Number
				                        	</label>
				                           <b-form-input
				                              id="checkout-name"
				                              type="text"
				                              v-model="register.number"
				                              class="w-100 d-inline-block border-gold h-45"
				                              placeholder="Enter your phone number"
				                              @keyup.stop.native="phoneValid($event)"
											  			trim>
				                           </b-form-input>
				                           <span v-if="allerrors.phone_number" class=" text-danger">{{ allerrors.phone_number[0] }}</span>
				                        </b-form-group>
				                        <div class="product-checkout-address w-100 d-inline-block">
				                        	<label class="w-100 d-inline-block mb-0 text_black text_14 font-weight-bold">
				                        		Address
				                        	</label>
										    <b-form-textarea
										    id="textarea-rows"
										    v-model="register.address"
										    class="w-100 d-inline-block border-gold"
										    placeholder="Enter your address"
										    rows="3">
										    </b-form-textarea>
										    <span v-if="allerrors.address" class=" text-danger">{{ allerrors.address[0] }}</span>
                                        </div>
                                        <div class="next-btn mt-2 float-right d-inline-block">
                                        	<a @click="registerNext()" class="d-inline-block knockdoc_btn_bg box_radius text-white text_15 font-weight-bold" 
                                        	href="javascript:void(0)">
                                        		Next
                                        	</a>
                                        </div>
                                    </b-form>
							    </b-card>
						    </b-collapse>
						</div>
						<div class="product-checkout-accordian w-100 d-inline-block position-relative product-verification-accordian mt-3">
							<a href="javascript:void(0)" class="color-date font-weight-bold text_18 w-100 d-inline-block service-bg p-3" 
							v-b-toggle.collapse-product-checkout-verification>
								<span class="text-white knockdoc_btn_bg mr-2 d-inline-block text-center text_16 verification-item">
								  1
								</span>
							Verification
							</a>
								<b-collapse 
								v-model="verificationvisible" 
								id="collapse-product-checkout-verification" 
								class="p-3">
							    <b-card class="border-0">
							    	<b-form>
							    		<b-form-group class="product-checkout-form w-100 d-inline-block">
				                        	<label class="w-100 d-inline-block mb-0 text_black text_14 font-weight-bold">
				                        		An OTP is sent to your number
				                        	</label>
				                           <b-form-input
				                              id="otp-number"
				                              type="number"
				                              v-model="smsotp"
				                              class="w-100 d-inline-block h-45"
				                              placeholder="Enter OTP">
				                           </b-form-input>
				                        </b-form-group>
				                        <div class="next-btn mt-2 float-left d-inline-block w-48 back-btn">
                                            <a @click="backToDetail()" class="d-inline-block bg-gold box-radius text-white text-size-15" 
                                        	href="javascript:void(0)">
                                        		Back
                                        	</a>     
												</div>
				                        <div class="next-btn mt-2 float-right d-inline-block">
                                        	<a v-if="hideNextOtp == 0" @click="submitOtpNext(smsotp)" class="d-inline-block knockdoc_btn_bg box_radius text-white text_15 font-weight-bold" 
                                        	href="javascript:void(0)">
                                        		Next
                                        	</a>
                                        	<span style="display:none;">{{updateHideNextOtp}}</span>
                                        	<a v-if="hideNextOtp == 1" @click="resendOtp()" class="d-inline-block knockdoc_btn_bg box_radius text-white text_15 font-weight-bold" 
                                        	href="javascript:void(0)">
                                        		Resend
                                        	</a>
                                        </div>
							    	</b-form>
							    </b-card>
							</b-collapse>
						</div>
						<div class="product-checkout-accordian w-100 d-inline-block position-relative product-verification-accordian 
						border-top">
							<a :disabled="disableOrderDetail" href="javascript:void(0)" class="color-date font-weight-bold text_18 w-100 d-inline-block service-bg p-3" v-b-toggle.collapse-product-checkout-order>
							<span class="text-white knockdoc_btn_bg mr-2 d-inline-block text-center text_16 verification-item">1</span>Order Detail
							</a>
							<b-collapse v-model="orderdetailvisible" id="collapse-product-checkout-order" 
							class="p-3">
							    <b-card class="border-0">
							    	<ul class="product-order-detail w-100 d-inline-block pl-0">
							    		<li class="w-100 float-left pb-2">
							    			<span class="text_black w-45 float-left font-weight-bold text_15">Name:
							    			</span>
							    			<span class="text_black w-45 float-left text_15">
							    				{{register.name}}
							    			</span>
							    		</li>
							    		<li class="w-100 float-left pb-2">
							    			<span class="text_black w-45 float-left font-weight-bold text_15">Phone number:</span>
							    			<span class="text_black w-45 float-left text_15">
							    				{{register.number}}
							    			</span>
							    		</li>
							    		<li class="w-100 float-left pb-2">
							    			<span class="text_black w-45 float-left font-weight-bold text_15">Address:</span>
							    			<span class="text_black w-45 float-left text_15">
							    				{{register.address}}
							    			</span>
							    		</li>
							    	</ul>
						            <div class="confirm-order-btn w-100 d-inline-block float-left text-lg-center">
                                    	<!-- <a @click="payNow()" class="theme-color-text theme-color-border box_radius d-inline-block pt-lg-2 pb-lg-2 pl-lg-5 pr-lg-5 text-center font-weight-bold mr-lg-3 mr-1 pay-btn" 
                                    	href="javascript:void(0)">
                                    		Pay Now
                                    	</a> -->
                                    	<a @click="cashOnDelivery()" class="text-white knockdoc_btn_bg box_radius d-inline-block pt-lg-2 pb-lg-2 pl-lg-3 pr-lg-3 text-center font-weight-bold delivery-btn" 
                                    	href="javascript:void(0)">
                                    		Cash On Delivery
                                    	</a>
                                    </div>
							    </b-card>
							</b-collapse>
						</div>
					</div>
				</b-col>
				<b-col cols="12" col lg ="6">
					<b-row v-if="cartItem.length>0">
						<b-col cols="12 border-bottom pb-2" 
						v-for="(item,index) in cartItem" :key="index">
							<b-row class="mt-3">
            <b-col cols="4">
               <div class="cart-modal-image w-100 d-inline-block">
                  <b-img :src="'/uploads/products/'+item.thumbnail" fluid :alt="item.name+' - photo'">
                  </b-img>
               </div>
            </b-col>
            <b-col cols="8">
            	<b-row>
            		<b-col cols="9">
		               <div class="image-text w-100 d-inline-block">
		                  <p class="text_black text_15 mb-1">
		                     {{item.name}}
		                  </p>
		               </div>
                  </b-col>
                  <b-col cols="3">
                     <div class="remove-text w-100 d-inline-block">
                        <a @click="removeCartItem(index)" 
                        class="color-date border-bottom font-weight-bold 
                        text_14" href="javascript:void(0)">
                     	  <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                     </div>
                  </b-col>
               </b-row>
               <b-row class="mt-3">
                  <b-col cols="12">
                     <label class="w-100 d-inline-block font-weight-bold text_black mb-0 text_14 pl-3">
                        QTY
                     </label>
                     <div class="discount-input mb-2 
               position-relative service-bg m-auto d-block box_radius w-xs-90">
               <a href="javascript:void(0)" class="float-left d-inline-block w-30 text-center text-size-22" v-on:click="decrement(index,item.discount_price!=''||item.discount_price!=null?item.discount_price:item.price)" 
                      variant="outline-secondary percentage_Btn"> 
                      <span class="minus-icon"></span> 
                  </a>
                  <div style="display:none">
						{{updateState}}
					  </div>
                  <vue-numeric class="form-control w-40 float-left text-center border-0 number-input bg-white box-shadow" 
                  v-model="counterVal[index]">
                  </vue-numeric>
                   <a href="javascript:void(0)" class="float-left d-inline-block w-30 text-center mt-1 color-date" v-on:click="increment(index,item.discount_price!=''||item.discount_price!=null?item.discount_price:item.price)" variant="outline-secondary percentage_Btn">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                  </a>
              </div>
                  </b-col>
                  <b-col cols="6">
                     <div class="price w-100 d-inline-block mt-3">
                        <span v-if="item.price" class="color-date text_16">Rs. {{item.price}}</span>
                     </div>
                  </b-col>
                  <b-col cols="6">
                     <div class="price w-100 d-inline-block mt-3">
                        <span v-if="item.discount_price" class="text-fee text_16">Rs. {{item.discount_price}}</span>
                     </div>
                  </b-col>
               </b-row>
            </b-col>
            </b-row>
            <b-row>
            <b-col cols="6">
               <div class="total-price w-100 d-inline-block mt-3">
                  <span class="text-fee text_16">Total
                      <span class="color-date text_16">(Inclusive of VAT)</span>
                   </span>
               </div>
            </b-col>
            <b-col cols="6">
               <div class="total-price w-100 d-inline-block mt-3 text-center">
                  <span class="text-fee font-weight-bold text_17">
                      Rs. {{total_cart_amount}}
                  </span>
               </div>
            </b-col>
         </b-row>
			</b-col>
			</b-row>
			<div class="shoping-empty-cart-image w-100 d-inline-block text-center" v-if="cartItem.length==0">
            <b-img src="/images/empty-cart.png" fluid-img="picture">
            </b-img>
         </div>
         </b-col>			
        </b-row>
		</b-container>
		<!-- Start checkout confirm modal  -->
		<div>
  <b-modal id="checkout-confirm" ref="checkout-confirm-modal" title="BootstrapVue" :no-close-on-backdrop = "true" :no-close-on-esc = "true" hide-footer hide-header="true">
    <div class="checkout-main w-100 d-inline-block">
    	<div class="checkout-heading w-100 d-inline-block bg_black p-3">
    		<a class="theme-color-text font-weight-bold text_30" 
    		href="javascript:void(0)">
    			<i class="fa fa-angle-left float-left" aria-hidden="true" 
    			@click="checkoutconfirmhideModal()"></i>
    		</a>
    		<span class="text-white font-weight-bold text-size-16 float-left pt-1 pl-4">Your Order Confirmed!
    		</span>
    	</div>
    	<div class="w-100 d-inline-block pl-lg-5 pl-3 pr-lg-0 pr-3">
    		<b-row class="mt-4">
    		<b-col cols="12">
    			<div class="order-text w-100 d-inline-block">
    				<span class="w-100 d-inline-block text-black text-size-14 
    				font-weight-bold" v-if="orderDetail">Hi, {{orderDetail.client.name}}
    				</span>
    				<p class="text-black text-size-15 mt-2 font-weight-bold">Your Order has been Confirmed and will be Shipping soon.</p>
    			</div>
    		</b-col>
    	</b-row>
    	</div>
    	<div class="w-100 d-inline-block border-bottom pb-3 pl-lg-5 pl-3 pr-lg-0 pr-3">
    		<b-row class="mt-3">
    		<b-col cols="6" col lg ="3" col sm ="3" col md ="3">
    			<div class="order-date w-100 d-inline-block">
    				<span class="text-black text-size-16 text-xs-14 font-weight-bold d-block">Order Date</span>
    				<span class="color-date text-size-14 text-xs-13 font-weight-bold d-block" v-if="orderDetail">{{moment(orderDetail.created_at).format('LL')}}
    				</span>
    			</div>
    		</b-col>
    		<b-col cols="6" col lg ="3" col sm ="3" col md ="3">
    			<div class="order-date w-100 d-inline-block">
    				<span class="text-black text-size-16 text-xs-14 font-weight-bold d-block">Order Number</span>
    				<span class="color-date text-size-14 text-xs-13 font-weight-bold d-block" v-if="orderDetail">{{orderDetail.unique_order_id}}
    				</span>
    			</div>
    		</b-col>
    		<b-col cols="6" col lg ="3" col sm ="3" col md ="3">
    			<div class="order-date w-100 d-inline-block">
    				<span class="text-black text-size-16 text-xs-14 font-weight-bold d-block">Payment Type
    				</span>
    				<span class="color-date text-size-14 text-xs-13 font-weight-bold d-block">Cash On Delivery
    				</span>
    			</div>
    		</b-col>
    		<b-col cols="6" col lg ="3" col sm ="3" col md ="3">
    			<div class="order-date w-100 d-inline-block">
    				<span class="text-black text-size-16 text-xs-14 font-weight-bold d-block">Address
    				</span>
    				<span class="color-date text-size-14 text-xs-13 font-weight-bold d-block" v-if="orderDetail">{{register.address}}
    				</span>
					<!-- <span class="color-date text-size-14 text-xs-13 font-weight-bold d-block" v-if="orderDetail && orderDetail.client.address">{{orderDetail.client.address}}
    				</span> -->
    			</div>
    		</b-col>
    	</b-row>
    	</div>
    	<div v-if="orderDetail" class="w-100 d-inline-block border-bottom pb-3 pl-lg-5 pl-3 pr-lg-0 pr-3">
    		<b-row v-for="(item,index) in orderDetail.cart" :key="index" class="mt-3">
    		<b-col cols="12 mb-lg-0 mb-3" col lg ="2" col sm ="3" col md ="3">
    			<div class="order-image w-100 d-inline-block">
    				<b-img :src="'/uploads/products/'+item.thumbnail" :alt="item.name+' - photo'" 
    				class="border-radius">
    				</b-img>
    			</div>
    		</b-col>
    		<b-col cols="6" col lg ="4" col sm ="3" col md ="3">
    			<div class="product-name w-100 d-inline-block">
    				<span class="text-black text-size-16 text-xs-14 font-weight-bold d-block">Product Name</span>
    				<span class="color-date text-size-14 text-xs-13 font-weight-bold d-block">{{item.name}}
    				</span>
    			</div>
    		</b-col>
    		<b-col cols="6" col lg ="2" col sm ="2" col md ="2">
    			<div class="quintity w-100 d-inline-block">
    				<span class="text-black text-size-16 text-xs-14 font-weight-bold d-block">Qty
    				</span>
    				<span class="color-date text-size-14 text-xs-13 font-weight-bold d-block">{{item.product_quantity}}
    				</span>
    			</div>
    		</b-col>
    		<b-col cols="6" col lg ="2" col sm ="2" col md ="2">
    			<div class="price-order w-100 d-inline-block">
    				<span class="text-black text-size-16 text-xs-14 font-weight-bold d-block">Price
    				</span>
					<span class="color-date text-size-14 text-xs-13 font-weight-bold d-block">Rs:{{item.price}}
    				</span>
    			</div>
    		</b-col>
			<b-col cols="6" col lg ="2" col sm ="2" col md ="2">
    			<div class="quintity w-100 d-inline-block">
    				<span class="text-black text-size-16 text-xs-14 font-weight-bold d-block">Discount Price
    				</span>
    				<span class="color-date text-size-14 text-xs-13 font-weight-bold d-block" v-if="item.discount_price">Rs:{{item.discount_price}}
    				</span>
					<span class="color-date text-size-14 text-xs-13 font-weight-bold d-block" v-else>
    				</span>
    			</div>
    		</b-col>
    	</b-row>
    	</div>
    	<div class="w-100 d-inline-block border-bottom">
    		<b-row class="mt-3">
    			<b-col cols="12">
    				<ul class="w-100 d-inline-block order-total pl-lg-5 pl-3 pr-lg-0 pr-3">
		    			<!-- <li class="w-100 d-inline-block">
		    				<span class="text-black text-size-16 font-weight-bold w-80 float-left">Subtotal
		    				</span>
		    				<span class="color-date text-size-14 font-weight-bold w-20 float-right">Rs:1500
		    				</span>
		    			</li>
		    			<li class="w-100 d-inline-block">
		    				<span class="text-black text-size-16 font-weight-bold w-80 float-left">Express Shipping
		    				</span>
		    				<span class="color-date text-size-14 font-weight-bold w-20 float-right">Rs:150
		    				</span>
		    			</li>
		    			<li class="w-100 d-inline-block">
		    				<span class="text-black text-size-16 font-weight-bold w-80 float-left">Taxes
		    				</span>
		    				<span class="color-date text-size-14 font-weight-bold w-20 float-right">Rs:20
		    				</span>
		    			</li> -->
		    			<!-- <li class="w-100 d-inline-block">
		    				<span class="text-black text-size-16 font-weight-bold w-80 float-left">Discount
		    				</span>
		    				<span class="color-date text-size-14 font-weight-bold w-20 float-right">Rs:15
		    				</span>
		    			</li> -->
		    			<li class="w-100 d-inline-block">
		    				<span class="text-black text-size-16 text-xs-14 font-weight-bold w-80 float-left">Total
		    				</span>
		    				<span class="color-date text-size-14 text-size-13 font-weight-bold w-20 float-right">Rs:{{total_cart_amount}}
		    				</span>
		    			</li>
    		      </ul>
    			</b-col>
    		</b-row>
    	</div>
    	<div class="w-100 d-inline-block border-bottom pb-3 pl-lg-5 pl-3 pr-lg-0 pr-3">
    		<b-row class="mt-3">
    			<b-col cols="12">
    				<div class="text w-100 d-inline-block">
    					<p class="text-black text-size-15 text-xs-14 mt-2 font-weight-bold">We will send you a confirmation when your item's are on the way! We appreciate your purchase, and hope you enjoy your purchase.</p>
    					<span class="text-black text-size-16 text-xs-14 font-weight-bold d-block mt-4">
    						Thank You!
		    			</span>
		    			<span v-if="orderDetail" class="text-black text-size-18 font-weight-bold d-block mt-2 text-xs-16">
		    				<!-- {{orderDetail.client.name}} -->
							Doctorfindy
		    			</span>
    				</div>
    			</b-col>
    		</b-row>
    	</div>
    	<div class="w-100 d-inline-block pb-3 pl-lg-5 pl-3 pr-lg-0 pr-3">
    		<b-row class="mt-3">
    			<b-col cols="12">
    				<div class="text w-100 d-inline-block">
    					<p class="text-black text-size-15 text-xs-14 font-weight-bold">Have a Questions? 
    						<a href="/contact-us">
    							<span class="theme-color-text d-xs-block">Contact Us
    							</span>
    						</a>
    					</p>
    				</div>
    			</b-col>
    		</b-row>
    	</div>
    </div>
  </b-modal>
</div>
<!-- End checkout confirm modal  -->
	</div>
</template>

<script>
import VueNumeric from 'vue-numeric';
export default {
  name: "product-checkoutComponent",
  props:['logged_user'],
  components: {VueNumeric, },
data(){
    return{
    	allerrors:[],
		hideNextOtp:0,
		coderesult:null,
		client_id:'',
		smsotp:'',
    	value:1,
		number:0,
		updateHideNextOtp:0,
		register:{
			name:'',
			number:'',
			address:''
		},
		login_user:this.logged_user,
		cartItem:[],
		cart_array:[],
		cart_value:[],
		total_cart_amount:0,
		total_amount_array:[],
		counterVal:[],
		orderDetail:null,
		moment: moment,
		updateState:'',
		disableDetail:true,
		disableVerification:true,
		disableOrderDetail:true,
		visible:false,
		verificationvisible:false,
		orderdetailvisible:false
    }
  },
  mounted(){
  	document.onreadystatechange = () => {
		if (document.readyState == "complete") {
		this.cartItem = JSON.parse(localStorage.getItem('cart'));
			if(this.cartItem && this.cartItem.length>0){
				if(Object.keys(this.login_user).length>0 || this.login_user.length>0){
					this.client_id = this.login_user.id;
					this.register.name = this.login_user.first_name;
					this.register.number = this.login_user.phone_number;
					this.register.address = this.login_user.profile.address;
					this.visible=false;
					this.disableDetail=true;
					if(this.login_user.phone_number== null || this.login_user.profile.address == null){
						this.visible=true;
						this.disableDetail=false;
					}else{
						this.verificationvisible=true;
						this.disableVerification=false;
						this.orderdetailvisible = false;
						this.disableOrderDetail=true;
					}
				}else{
					this.visible=true;
					this.disableDetail=false;
				}
				this.calculateTotalAmountCart();
				this.productQuantityUpdate();
			}else{
				this.disableDetail=true;
				this.visible=false;
				this.disableVerification=true;
				this.disableOrderDetail=true;
				this.verificationvisible=false;
				this.orderdetailvisible=false;
			}
		}
		var storage = JSON.parse(localStorage.getItem('cart'));
		var numberCart = document.querySelectorAll("#cart-item");
	   for (var i = numberCart.length - 1; i >= 0; i--) {
	      numberCart[i].innerHTML = storage.length;
	   }
	}
  },
methods: {
    	checkoutconfirmhideModal() {
        this.$refs['checkout-confirm-modal'].hide();
			window.location = '/products';
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
		productQuantityUpdate(){
			if(this.cartItem.length>0){
				this.counterVal=[];
				this.cartItem.filter(elem=>{
					this.counterVal.push(elem.product_quantity);
				});
			}
			this.updateState = this.counterVal[0];
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
		registerNext(){
			let formData = new FormData();
         formData.append('phone_number',this.register.number);
			formData.append('first_name',this.register.name);
			formData.append('address',this.register.address);
			formData.append('patient_id',this.client_id);
			axios.post('/register/checkout/client',formData).then(response=>{
				this.client_id = response.data.user_data.id
				this.allerrors = [];
				if(response.data.type == 'error'){
					this.$toasted.show(response.data.message,{
						type:'error',
						duration: 2000
					});
					this.register.number = '';
				}else{
					this.sendOtp(this.register.number);
					this.$toasted.show("SMS OTP Send to Your Number",{
						type:'success',
						duration: 2000
					});
					this.disableDetail = true;
					this.visible = false;
					this.disableVerification=false;
					this.verificationvisible=true;
				}
			}).catch((error) => {
				this.allerrors = error.response.data.errors;
				this.$toasted.show("Please fill Information correctly",{
					type:'error',
					duration: 2000
				});
			});
		},
		sendOtp(phone){
			self = this;
			if(self.hideNextOtp == 0){
				setTimeout(function(){
					self.hideNextOtp=1;
				}, 60000);
			}else{
				self.hideNextOtp=0;
			}
			// setTimeout(function() {
			var number = "+92"+phone.substring(1);
			firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier)
			.then(function (confirmationResult) {
				self.coderesult = confirmationResult;
				self.hideNextOtp = 0;
				// console.log("wwe43e",coderesult);
				}).catch(function (error) {
					self.$toasted.show(error.message,{
						type:'error',
						duration: 5000
					});
					self.hideNextOtp = 1;
				// console.log("wwe43e",error.message);
				});
			// }, 3000);
		},
		submitOtpNext(code){
			if(code.length==6){
				self = this;
				if(self.coderesult){
					self.coderesult.confirm(code).then(function (result) {
						self.$toasted.show("Verified",{
							type:'success',
							duration: 3000
						})
						self.disableVerification = true;
						self.verificationvisible = false;
						self.disableOrderDetail = false;
						self.orderdetailvisible = true; 
					}).catch(function (error) {
						self.hideNextOtp = 1;
						self.$toasted.show(error.message,{
							type:'error',
							duration: 5000
						});
					});
				}else{
					self.$toasted.show("Some error in sending otp. Check your number again",{
						type:'error',
						duration:3000
					});
					self.hideNextOtp = 1;
				}
			}else{
				this.$toasted.show("Please Enter Valid OTP",{
					type:'error',
					duration: 5000
				});
				this.hideNextOtp = 0;
			}
		},
		payNow(){
			let formData = new FormData();
            formData.append('client_id',this.client_id); //
 			formData.append('total',this.total_cart_amount);
			formData.append('type',2); //1 for cash on delivery, 2 for through alfa
			formData.append('status',1); //by default pending
			formData.append('cart',JSON.stringify(this.cartItem));
			formData.append('is_received',0);
			axios.post('/checkout/orderSave',formData).then(response=>{
				this.$toasted.show(response.data.message,{
					type:'success',
					duration: 2000
				});
				localStorage.removeItem('cart');
				var currentlocation = window.location.hostname;
				if (currentlocation=="127.0.0.1") {
					window.location.href ='/alfa/product/handshake/'+response.data.order_id+'/'+this.total_cart_amount;
				}
				if (currentlocation=="dev.reservim.com") {
                  	window.location.href ='/alfa/product/handshake/'+response.data.order_id+'/'+this.total_cart_amount;
				}
				if (currentlocation=="reservim.com") {
					window.location.href ='/alfa/live/product/handshake/'+response.data.order_id+'/'+this.total_cart_amount;
				}
			});
			// /alfa/product/handshake/{order_id}/{price} For dev & Localhost
			// /alfa/live/product/handshake/{order_id}/{price}
		},
		cashOnDelivery(){
			let formData = new FormData();
         formData.append('client_id',this.client_id); //
 			formData.append('total',this.total_cart_amount);
			formData.append('type',1); //1 for cash on delivery, 0 for through alfa
			formData.append('status',0); //by default pending
			formData.append('cart',JSON.stringify(this.cartItem));
			formData.append('is_received',0);
			axios.post('/checkout/orderSave',formData).then(response=>{
				this.$toasted.show(response.data.message,{
					type:'success',
					duration: 2000
				});
				localStorage.removeItem('cart');
				this.orderDetail=response.data.order;
				this.$refs['checkout-confirm-modal'].show();
			});
		},
		phoneValid(){
			if(this.register.number.length>11){
				this.$toasted.show('Number should not be greater than 11 digits',{
					type:'error',
					duration: 2000
				});
			}
		},
		backToDetail(){
			this.disableDetail =false;
			this.visible=true;
			this.verificationvisible =false;
			this.hideNextOtp = 0;
		},
		resendOtp(){
			this.sendOtp(this.register.number);
		},
    }
};
</script>

<style>
	
</style>