<template>
	<div>
		<b-container>
			<b-row class="mt-4 mb-4 border-bottom">
				<b-col cols="12" col lg ="6">
					<div class="product-detail-slider w-100 d-inline-block">
						<VueSlickCarousel 
						v-bind="c2Setting">
							<div v-for="(image,index) in product.additional_images" :key="index">
								<div class="slider-main w-100 d-inline-block position-relative">
									<div class="product-detail-slider-image w-100 d-inline-block">
										<figure class="zoom" @mousemove="zoom($event)" v-bind:style="{ backgroundImage: 'url(/uploads/products/' + image + ')' }">
											<b-img :title="product.name" :src="'/uploads/products/'+image" fluid :alt="product.name+' - photo'" class="d-inline-block w-100">
											</b-img>
										</figure>
									</div>
									<div class="slider-review-listing position-absolute">
										<div class="reviews-text box_radius text-center">
											<span v-if="product.reviews.length>0" class="text-white font-weight-bold text_14 pt-lg-2 d-inline-block">
                                              {{parseFloat(product.reviews[0].aggregate).toFixed(1)}}
                                            </span> 
                                            <span v-else class="text-white font-weight-bold text_14 pt-lg-2 d-inline-block">
                                              {{product.reviews.length}}
                                            </span> 
						                    <p class="text-white mb-0 
						                    text_13">
						                        {{product.reviews.length}} reviews
						                    </p>                
						                </div>
									</div>
								</div>
							</div>
						</VueSlickCarousel>
					</div>
				</b-col>
				<b-col cols="12" col lg ="5">
					<div class="slider-heading w-100 d-inline-block">
						<span class="text_black font-weight-bold text_22 text-xs-18">{{product.name}}</span>
					</div>
					<div class="view-rating-star mt-2 w-100 border-bottom float-left d-inline-block">
						<div v-if="product.reviews.length>0">
							<star-rating 
	                        class="float-left mr-3" 
	                        read-only="true" 
	                        v-model="product.reviews[0].aggregate"
	                        :show-rating="false" 
	                        active-color="#EA4335" 
	                        :star-size="20">
	                        </star-rating>
	                        <!-- <span class="text_black text_18 mr-4">4.5</span> -->
	                        <span class="theme-color-text text_17">{{parseFloat(product.reviews[0].aggregate).toFixed(1)}} Ratings</span>
						</div>
                        <strike v-if="product.discount_price" class="color-date text_17 mt-1 float-left">Rs. {{product.price}}
                        </strike>
                        <span v-if="product.discount_price" class="text_black font-weight-bold text_18 mt-1 float-right">Rs. {{product.discount_price}}
                        </span>
                        <span v-else class="text_black font-weight-bold text_18 mt-1 float-right">Rs. {{product.price}}
                        </span>
                    </div>
                    <div class="w-100 d-inline-block">
	                   	<label class="w-100 d-inline-block font-weight-bold text-fee mb-0 text_18 mt-2">
	   					  Quantity
	   					</label>
	   					<div class="discount-input mb-2 position-relative service-bg d-inline-block box-radius w-xs-100 mt-2">
	   				        <a href="javascript:void(0)" class="float-left d-inline-block w-30 text-center text-size-22" 
	   				        v-on:click="decrement" variant="outline-secondary percentage_Btn"> 
			                    <span class="minus-icon"></span> 
			                </a>
				            <vue-numeric class="form-control w-40 float-left text-center border-0 number-input bg-white box-shadow" 
				            v-model="value">
				            </vue-numeric>
				            <a href="javascript:void(0)" class="float-left d-inline-block w-30 text-center mt-1 color-date" v-on:click="increment(product.discount_price!=''||product.discount_price!=null?product.discount_price:product.price)" variant="outline-secondary percentage_Btn">
				                <i class="fa fa-plus" aria-hidden="true"></i>
				            </a>
			            </div>
			        </div>    
		            <div class="w-100 d-inline-block mt-3 border-bottom pb-3">
			            <div class="shoping-btn w-45 d-inline-block float-left">
	            			<a @click="buynow()" class="theme-color-text box_radius theme-color-border font-weight-bold d-inline-block text_14 buy-btn" 
	            			href="javascript:void(0)">
	            				Buy Now
	            			</a>
			            </div>
			            <div class="shoping-btn w-45 d-inline-block float-left">
	            			<a @click="showcartdropdown()" class="text-white text-white box_radius theme-color-border font-weight-bold d-inline-block text_14 knockdoc_btn_bg" href="javascript:void(0)">
	            				Add To Cart
	            			</a>
			            </div>
			        </div>  
			        <ul class="shoping-categories w-100 d-inline-block pl-0 mt-2 border-bottom">
			        	<li v-if="product.brand" class="w-100 d-inline-block pb-1">
			        		<span class="text-black font-weight-bold w-45 
			        		float-left">
			        		    Brand:
			        	    </span>
			        		<span class="text-fee w-45 float-left">
			        		   {{product.brand.name}}
			        	    </span>
			        	</li>
			        	<li v-if="product.categories.length>0" class="w-100 d-inline-block pb-1">
			        		<span class="text-black font-weight-bold w-45 
			        		float-left">
			        		    Category:
			        	    </span>
			        		<span class="text-fee w-45 float-left">
			        		   <span v-for="(category,index) in product.categories" :key="index">{{category.name}} </span>
			        	    </span>
			        	</li>
			        	<li v-if="product.attributes.length>0" class="w-100 d-inline-block pb-1">
			        		<span class="text-black font-weight-bold w-45 
			        		float-left">
			        		   Attribute:
			        	    </span>
			        		<span class="text-fee w-45 float-left">
			        		   <span v-for="(attribute,index) in product.attributes" :key="index">{{attribute.name}} </span>
			        	    </span>
			        	</li>
			        	<li class="w-100 d-inline-block pb-1">
			        		<span class="text-black font-weight-bold w-45 
			        		float-left">
			        		    Variation:	
			        	    </span>
			        		<span class="text-fee w-45 float-left">
			        		  	<span v-for="(value,index) in product.values" :key="index">
								  {{typeof(value)=='string'?value+',':value.join(', ')}} 
								</span>
			        	    </span>
			        	</li>
			        	<li v-if="product.tags.length>0" class="w-100 d-inline-block pb-1">
			        		<span class="text-black font-weight-bold w-45 
			        		float-left">
			        		    Tags:
			        	    </span>
			        		<span v-for="(tag,index) in product.tags" class="text-fee w-45 float-left">
			        		   {{tag.name}}
			        	    </span>
			        	</li>
			        </ul> 
			        <div class="about-heading w-100 d-inline-block mb-2">
			        	<span class="text-black font-weight-bold">About this item
			        	</span>
			        </div> 
			        <div v-if="product.description" v-html="product.description">
        			</div>
				</b-col>
			</b-row>
			<b-row v-if="similarproducts.length>0" class="mt-4">
		        <b-col cols="12">
		            <div class="brand-heading w-100 d-inline-block">
		                <h2 class="text-black font-weight-bold text-size-32 text-xs-25">Consider a similar item</h2>
		            </div>
		        </b-col>
            </b-row>
	        <b-row v-if="similarproducts.length>0" class="mt-4 mb-4 monthly-offer-product">
	            <b-col v-for="(samecategoryproduct,index) in similarproducts" :key="index" cols="12 mb-lg-0 mb-4" col lg ="6" col xl ="3" col sm ="6"
	            col md ="6">
		            <a :href="'/product-detail/'+samecategoryproduct.slug">
		            	<div class="product-offer-images w-100 d-inline-block position-relative">
		            		<b-img :src="'/uploads/products/'+samecategoryproduct.thumbnail" 
	            		fluid :alt="samecategoryproduct.name+' - photo'" class="w-100"></b-img>
		            		<div class="deal-off position-absolute">
		            			<span v-if="samecategoryproduct.percentage_value" class="text-white bg-gold box-radius">{{samecategoryproduct.percentage_value}}% OFF
		            			</span>
		            			<span v-else class="text-white bg-gold box-radius">Exclusive
		            			</span>
		            		</div>
		            		<p class="mt-2 mb-2 text_black text_15">
		            			{{samecategoryproduct.name}}
		            		</p>
		            		<strike v-if="samecategoryproduct.discount_price" class="text_black float-left">Rs. {{samecategoryproduct.price}}
		            		</strike>
		            		<span class="text_black font-weight-bold float-right">Rs. {{samecategoryproduct.discount_price}}
		            		</span>
		            		<p class="color-date mt-2 mb-2 text_15 w-100 d-inline-block">{{samecategoryproduct.short_description}}</p>
		            		<div v-if="samecategoryproduct.reviews.length>0" class="view-rating-star mt-2 w-55 float-left d-inline-block">
	                            <star-rating 
	                            class="float-left mr-3" 
	                            read-only="true" 
								v-model="samecategoryproduct.reviews[0].aggregate"
	                            :show-rating="false" 
	                            active-color="#EA4335" 
	                            :star-size="15">
	                            </star-rating>
	                            <span class="theme-color-text">{{parseFloat(samecategoryproduct.reviews[0].aggregate).toFixed(1)}}</span>
	                        </div>
	                        <div v-else class="view-rating-star mt-2 w-55 float-left d-inline-block">
	                            <star-rating 
	                            class="float-left mr-3" 
	                            read-only="true" 
								v-model="samecategoryproduct.reviews.length" 
	                            :show-rating="false" 
	                            active-color="#EA4335" 
	                            :star-size="15">
	                            </star-rating>
	                            <span class="theme-color-text">{{samecategoryproduct.reviews.length}}
	                            </span>
	                        </div>
	                        <div class="add-to-cart-btn w-45 float-left 
	                        d-inline-block mt-2">
	                        	<a @click="addToCart(samecategoryproduct)" class="theme-color-text text_14 box_radius font-weight-bold theme-color-border" 
	                        	href="javascript:void(0)">
	                        		Add to cart
	                        	</a>
	                        </div>
		            	</div>
		            </a>
	            </b-col>
	        </b-row>
		</b-container>
	</div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
import StarRating from 'vue-star-rating'
import VueNumeric from 'vue-numeric';
export default {
	components: 
  {
  	VueSlickCarousel,
  	StarRating,
  	VueNumeric,
  },
  name: "product-detail-sliderComponent",
  props:['product','similarproducts'],
data(){
   			return{
   				max: 100,
				review_rating:0,
				review_message:'',
				count_rating1:0,
				count_rating2:0,
				count_rating3:0,
				count_rating4:0,
				count_rating5:0,
				percent1rating:0,
				percent2rating:0,
				percent3rating:0,
				percent4rating:0,
				percent5rating:0,
				login_user:null,
				cartItem:[],
				moment: moment,
   				value:1,
   				c2Setting: {
        arrows: true,
        dots: false,
        slidesToShow:1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            }
          },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              initialSlide: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      },
   			}
   		},
   		mounted(){
			if(this.product.review_rating.length>0){
				var all_ratings = [];
				this.product.review_rating.filter(elem=>{
					all_ratings.push(elem.rating);
				});
				const countOccurrences = (arr, val) => arr.reduce((a, v) => (v === val ? a + 1 : a), 0);
				this.count_rating5 = countOccurrences(all_ratings, 5);
				this.count_rating4 = countOccurrences(all_ratings, 4);
				this.count_rating3 = countOccurrences(all_ratings, 3);
				this.count_rating2 = countOccurrences(all_ratings, 2);
				this.count_rating1 = countOccurrences(all_ratings, 1);
				this.percent1rating= this.count_rating1/all_ratings.length * 100;
				this.percent2rating= this.count_rating2/all_ratings.length * 100;
				this.percent3rating= this.count_rating3/all_ratings.length * 100;
				this.percent4rating= this.count_rating4/all_ratings.length * 100;
				this.percent5rating= this.count_rating5/all_ratings.length * 100;
			}
			this.cartItem = JSON.parse(localStorage.getItem('cart'));
			if(this.cartItem.length>0){
				this.cartItem.filter(elem=>{
					if(elem.id == this.product.id){
						this.value = elem.product_quantity;
					}
				});
			}
		},
	computed: {
		count_review(){
			var rating = [];
			if(this.product.reviews.length>0){
				this.product.reviews.filter((elem,index)=>{
					rating.push(elem.rating);
				});
				var sum = rating.reduce((a, b) => {
					return a + b;
				});
				return sum = sum/this.product.reviews.length;
			}else{
				return 0;
			}
		}
	},
methods: {
      zoom(e){
		var zoomer = e.currentTarget;
		var offsetX = '';
		var offsetY = '';
		e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
		e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
		var x = offsetX/zoomer.offsetWidth*100
		var y = offsetY/zoomer.offsetHeight*100
		zoomer.style.backgroundPosition = x + '% ' + y + '%';
	},
		saveReview(){
			this.login_user=this.$store.getters.user;
			if(this.login_user){
				let formData = new FormData();
				formData.append('rating',this.review_rating);
				formData.append('message',this.review_message);
				formData.append('login_user_id',this.login_user.id);
				formData.append('reviewer_name',this.login_user.name);
				formData.append('product_id',this.product.id);
				axios.post('/product/review/save',formData).then(response=>{
					this.$toasted.show(response.data.message,{
						type:'success',
						duration: 2000
					});
					// this.allProducts = response.data.products;
				});
			}else{
				this.$toasted.show('Please Login First',{
					type:'success',
					duration: 2000
				});
			}
		},
      	increment(price) {
			document.getElementById("cartdrop").style.display = 'none';
			var cartValue = JSON.parse(localStorage.getItem('cart'));
			this.value++;
			if(cartValue && cartValue.length>0){
				this.cartItem = cartValue;
				this.cartItem.filter(elem=>{
					if(elem.id == this.product.id){
						elem.product_quantity = this.value;
					}
				});
				localStorage.setItem("cart", JSON.stringify([...new Set(this.cartItem)]));
			}
		},
		decrement(e) {
		    document.getElementById("cartdrop").style.display = 'none';
			var cartValue = JSON.parse(localStorage.getItem('cart'));
			this.value--;
			if(this.value<=0){
				this.value = 1;
				this.$toasted.show('You cannot change the quantity',{
					type:'success',
					duration: 2000
				});
			}else{
				if(cartValue && cartValue.length>0){
					this.cartItem = cartValue;
					this.cartItem.filter(elem=>{
						if(elem.id == this.product.id){
							elem.product_quantity = this.value;
						}
					});
					localStorage.setItem("cart", JSON.stringify([...new Set(this.cartItem)]));
				}
			}
		},
		showcartdropdown(){
		    document.getElementById("cartdrop").style.display = 'none';
			var cartValue = JSON.parse(localStorage.getItem('cart'));
			if(cartValue && cartValue.length>0){
				this.cartItem = cartValue;
				const existProduct = this.cartItem.find(x => x.id === this.product.id);
				if(existProduct){
					this.$toasted.show('Product Already in the Cart',{
						type:'success',
						duration: 2000
					});
				}else{
					var obj = this.product;
					if(this.value>0){
						obj.product_quantity = this.value;
					}else{
						this.value = 1;
						obj.product_quantity = this.value;
					}
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
					console.log('33',cartValue,this.cartItem);
				}
			}else{
				if(cartValue && cartValue.length>0){
					this.cartItem = cartValue;
				}else{
					this.cartItem = [];
				}
				var obj = this.product;
				obj.product_quantity = this.value;
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
			}	
		},
		buynow(){
			document.getElementById("cartdrop").style.display = 'none';
			var cartValue = JSON.parse(localStorage.getItem('cart'));
			if(cartValue && cartValue.length>0){
				this.cartItem = cartValue;
				const existProduct = this.cartItem.find(x => x.id === this.product.id);
				if(existProduct){
					this.$toasted.show('Product Exist in the Cart',{
						type:'success',
						duration: 2000
					});
					window.location = '/product/checkout';
				}else{
					var obj = this.product;
					if(this.value>0){
						obj.product_quantity = this.value;
					}else{
						this.value=1;
						obj.product_quantity = this.value;
					}
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
					window.location = '/product/checkout';
				}
			}else{
				if(!this.cartItem){
					this.cartItem = [];
				}
				var obj = this.product;
				obj.product_quantity = this.value;
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
				window.location = '/product/checkout';
			}
		},
		addToCart(data){
			document.getElementById("cartdrop").style.display = 'none';
            this.cartItem = JSON.parse(localStorage.getItem('cart'));
			if(this.cartItem.length>0){
				const existProduct = this.cartItem.find(x => x.id === data.id);
				if(existProduct){
					this.$toasted.show('Product Already in the Cart',{
						type:'success',
						duration: 2000
					});
				}else{
					var obj = data;
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
				}
			}else{
				var obj = this.product;
				obj.product_quantity = this.value;
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
			}		
		}
}
};
</script>

<style>
</style>