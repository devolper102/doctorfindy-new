<template>
	<div>
    <div id="banner">
      <div class="inner-banner position-relative">
        <div class="wave_img d-lg-block d-none">
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
        </div>
        <b-container>
        <b-row>
          <b-col cols="12">
            <div class="product-banner-heading w-100 d-inline-block text-center">
              <h2 class="text-white font-weight-bold text-size-32 text-xs-25">All Products</h2>
            </div>
          </b-col>
          <b-col cols="12">
            <div class="main-product-search d-block position-relative pl-lg-5 pt-lg-3 pb-lg-3 w-xs-100 w-sm-100 w-md-100">
              <b-form @click="showdropdown()">
                <b-form-group class="w-80 float-left d-lg-block d-none position-relative mb-0 mt-lg-0 mt-5 pr-lg-0 pr-2 pl-lg-0 pl-2 input-product-btn">
                  <b-form-input
                  type="text"
                  v-model="search_category"
                  @keyup="searchCategory()"
                  class="w-100 border-0 search-autocomplete h_45"
                  id="input-product"
                  placeholder="Search for doctors, hospitals, specialties, services, disease"
                  autofocus>
                  </b-form-input>
                </b-form-group>
            </b-form>
            <div class="dummy-product-btn w-100 d-lg-none d-block bg-white box_shadow p-2" @click="showdropdown()">
              <a class="color-date text_16 d-inline-block" 
              href="javascript:void(0)">
                Search Products
              </a>
              <a href="javascript:void(0)" class="color-date position-absolute search-icon bg-gold d-inline-block text-center">
                  <i aria-hidden="true" class="fa fa-search"></i>
                </a>
            </div>
            <div class="search-btn w-20 d-lg-block d-none float-left">
              <a href="javascript:void(0)" class="text-white search-icon knockdoc_btn_bg text_15 h_45 d-inline-block 
              text-center">
              Search
                  <i aria-hidden="true" class="fa fa-search"></i>
                </a>
            </div>
            </div>
          </b-col>
        </b-row>
      </b-container>
      </div>
      <div id="drop" class="show-dropdown bg-white box_shadow position-absolute w-55">
      <div class="w-100 d-inline-block input-search-deal pl-3 pr-3">
        <a class="d-inline-block position-absolute cros-icon text_18 text_black text-center" href="javascript:void(0)" @click="crossicon">
        <i class="fa fa-times" aria-hidden="true"></i>
      </a>
      <b-form>
        <b-form-group class="w-100 d-lg-none d-block d-md-none position-relative mb-0 mt-lg-0 mt-5 pr-lg-0 pr-2 pl-lg-0 pl-2 input-product-btn">
          <b-form-input
          type="text"
          v-model="search_category"
          @keyup="searchCategory()"
          class="w-100 border-0 search-autocomplete"
          id="input-product"
          placeholder="Search for doctors, hospitals, specialties, services, disease">
          </b-form-input>
        </b-form-group>
      </b-form>
      <ul v-if="allTopCategory.length>0" class="w-100 d-inline-block mt-lg-5 mt-md-5 mt-4 p-0 
      makeup-categories">
        <li class="mb-3" v-for="(category, index) in allTopCategory" :key="index">
          <a class="text_black box_radius pt-1 pb-1 pl-3 w-100 d-inline-block" :href="'/products/category/'+category.slug">
            {{category.name}}
          </a>
        </li>
      </ul>
      <!-- <div class="headeing-categorie-search w-45 w-xs-100 float-left d-inline-block">
        <span class="text-black font-weight-bold">Recent Search</span>
        </div>
        <div class="recent-search-clear-btn w-55 w-xs-100 text-lg-center d-inline-block mt-lg-0 mt-3">
          <a class="knockdoc_btn_bg text-white text_14 d-inline-block" 
          href="javascript:void(0)">
            Recent Search Clear
          </a>
        </div> -->
        <div v-if="allProduct.length>0" class="headeing-categorie-search w-45 w-xs-100 float-left d-inline-block">
        <span class="text-black font-weight-bold">Products</span>
        </div>
        <ul v-if="allProduct.length>0" class="w-100 d-inline-block p-0 mt-3 recent-categories">
          <li v-for="(product,index) in allProduct" :key="index" class="w-33 float-left mb-2 w-xs-100 w-sm-50 
          w-md-50">
            <a class="text_black text_14" :href="'/product-detail/'+product.slug">
              {{product.name}}
            </a>
            <!-- <a class="theme-color-text text_18 font-weight-bold" 
            href="javascript:void(0)">
              <span><b-icon icon="x">x</b-icon></span>
            </a> -->
          </li>
        </ul>
      <div class="heading-recommended w-100 d-inline-block">
        <span class="text_black font-weight-bold">Recommended</span>
        </div>
        <ul v-if="allTopProduct.length>0" class="w-100 d-inline-block p-0 mt-2 recommended-categories-btn">
          <li v-for="(product,index) in allTopProduct" :key="index">
            <a class="text-white knockdoc_btn_bg d-inline-block text_14 mr-3 float-left mb-2 text-xs-center w-xs-40" 
            :href="'/product-detail/'+product.slug">
              {{product.name}}
            </a>
          </li>
        </ul>
      </div>
    </div>
    </div>
    <b-container>
      <b-row class="mt-4 mb-4">
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
                    <a @click="removeCartItem(index)" class="color-date border-bottom font-weight-bold text-size-14" href="javascript:void(0)">
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
                        <span class="color-date text-xs-14">{{item.price}}</span>
                     </div>
                  </b-col>
                  <b-col cols="6">
                     <div class="price w-100 d-inline-block mt-3">
                        <span class="text-fee text-xs-14">{{item.discount_price}}</span>
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
        <b-col cols="12 mt-lg-0 mt-3" col lg ="6" col sm ="6" col md ="6">
      <div class="heading w-100 d-inline-block">
        <h2 class="text-black font-weight-bold text_25">
          {{best_salon_heading}}
        </h2>
      </div>
    </b-col>
        <b-col cols="12 mt-lg-0 mt-3" col lg ="3" col sm ="6" 
        col md ="6">
           <div class="product-categorie-select w-100 d-inline-block">
             <multiselect @input="changeCity()" v-model="selectedCity" :options="cityOpt" label="title" :allow-empty="false" placeholder="Select City">
                <template slot="caret">
                <div class="multiselect__select">
                  <b-icon icon="chevron-down" variant="secondary">
                  </b-icon>
                </div>
                <div class="custom_placeholder">
                  Select City
                </div>
                </template>
              </multiselect>
           </div>
        </b-col>
        <b-col cols="12 mt-lg-0 mt-3" col lg ="3" col sm ="6" 
        col md ="6">
           <div class="product-categorie-select w-100 d-inline-block">
             <multiselect @input="changeFilter()" v-model="selectedFilter" :options="filterOpt" label="name" :allow-empty="false" placeholder="Select Filter">
                <template slot="caret">
                <div class="multiselect__select">
                  <b-icon icon="chevron-down" variant="secondary">
                  </b-icon>
                </div>
                <div class="custom_placeholder">
                  Filter
                </div>
                </template>
              </multiselect>
           </div>
        </b-col>
      </b-row>
      <b-row class="mt-4 mb-4">
        <b-col cols="12" col lg ="4">
          <div class="categorie-heading-main w-100 d-inline-block bg-white box-shadow p-2">
              <div class="menu-heading w-100 d-inline-block">
                <a class="text-gold d-inline-block float-left" 
              href="javascript:void(0)" @click="categoriesdropdown()">
                <b-img src="/images/categories-image-icon.svg" 
          fluid alt="picture" class="w-100"></b-img>
              </a>
              <span class="theme-color-text d-inline-block text-center font-weight-bold text_18 w-90">Categories</span>
              </div>
            </div> 
            <div id="categories-drop" class="w-100 d-lg-block bg-white box_shadow categories-product pb-3">
            <div class="categories-heading w-100 d-inline-block 
            pl-4 mt-3">
              <span class="text-black font-weight-bold">Categories</span>
            </div>
              <ul class="w-100 d-inline-block categories mt-2 mb-0 pl-5">
                <li v-for="(category,index) in allCategories" 
                :key="index">
                  <a class="text_black text_14 font-weight-bold" 
                  :href="'/products/category/'+category.slug" :id="category.name.replaceAll(' ', '')">
                    {{category.name}}
                  </a>
                </li>
                <li>
                  <a v-if="showMoreCatBtn" @click="showMoreCategories()" class="theme-color-text text_14 show-more-btn font-weight-bold" href="javascript:void(0)">
                    Show More
                  </a>
                </li>
              </ul>
              <div class="categories-heading w-100 d-inline-block pl-4 mt-3">
              <span class="text-black font-weight-bold">Brands</span>
            </div>
              <ul class="w-100 d-inline-block categories mt-2 mb-0 pl-5">
                <li v-for="(brand,index) in allBrands" :key="index">
                  <a class="text_black text_14 font-weight-bold" :href="'/product/brand/'+brand.slug">
                   {{brand.name}}
                  </a>
                </li>
                <li>
                  <a v-if="showMoreBrandBtn" @click="showMoreBrands()" class="theme-color-text text_14 show-more-btn font-weight-bold" 
                  href="javascript:void(0)">
                    Show More
                  </a>
                </li>
              </ul>
            </div>
              <div class="categories-heading w-100 d-inline-block pl-4 mt-3">
              <span class="text-black font-weight-bold">Price</span>
            </div>
              <b-form>
                <b-form-group class="price-list w-100 d-inline-block mt-3 pl-lg-4">
                  <b-form-input
                  type="text"
                  class="w-20 d-inline-block mr-3"
                  id="input-min"
                  v-model="priceStart"
                  placeholder="Min">
                  </b-form-input>
                  <span class="text-black text-size-16 mr-3">To</span>
                  <b-form-input
                  type="text"
                  class="w-20 d-inline-block mr-3"
                  id="input-max"
                  v-model="priceEnd"
                  placeholder="Max">
                  </b-form-input>
                  <a @click="getProductWithinPrice()" href="javascript:void(0)" class="knockdoc_btn_bg text-white box_radius theme-color-border text_16">Go
              </a>
                </b-form-group>
              </b-form>
              <div class="reset-btn w-100 d-inline-block text-center mt-2 mb-lg-0 mb-4">
                <a @click="resetPriceVal()" class="text-white knockdoc_btn_bg text_16 w-100 d-inline-block box_radius font-weight-bold pt-2 pb-2" 
                href="javascript:void(0)">
                  Reset
                </a>
              </div>
          </b-col>
          <b-col cols="12" col lg ="8">
            <b-row v-if="allProducts.length>0" class="mt-4 mb-4 monthly-offer-product">
              <b-col v-for="(product,index) in allProducts" :key="index" cols="12 mb-4" col lg ="6" col xl ="4" col sm ="6"
              col md ="6">
              <a :href="'/product-detail/'+product.slug">
                  <div class="product-offer-images w-100 d-inline-block position-relative">
                    <b-img :src="'/uploads/products/'+product.thumbnail" 
                  fluid :alt="product.name+' - photo'" class="w-100"></b-img>
                    <div class="deal-off position-absolute">
                      <span v-if="product.percentage_value" class="text-white bg_black box_radius">{{product.percentage_value}}% OFF
                      </span>
                      <span v-else class="text-white bg_black box_radius">Exclusive
                      </span>
                    </div>
                    <p class="mt-2 mb-2 text_black text_15">
                      {{product.name}}
                    </p>
                    <strike v-if="product.discount_price" class="text_black float-left">Rs. {{product.price}}
                    </strike>
                    <span v-if="product.discount_price" class="text_black font-weight-bold float-right">Rs. {{product.discount_price}}
                    </span>
                    <span v-else class="text_black font-weight-bold float-right">Rs. {{product.price}}
                    </span>
                    <p class="color-date mt-2 mb-2 text_15 w-100 d-inline-block">{{product.short_description}}</p>
                          <div v-if="product.reviews.length>0" class="view-rating-star mt-2 w-55 float-left d-inline-block">
                              <star-rating 
                              class="float-left mr-3" 
                              read-only="true" 
                              v-model="product.reviews[0].aggregate"
                              :show-rating="false" 
                              active-color="#EA4335" 
                              :star-size="15">
                              </star-rating>
                              <span class="theme-color-text">{{parseFloat(product.reviews[0].aggregate).toFixed(1)}}</span>
                          </div>
                          <div v-else class="view-rating-star mt-2 w-55 float-left d-inline-block">
                              <star-rating 
                              class="float-left mr-3" 
                              read-only="true" 
                              v-model="product.reviews.length"
                              :show-rating="false" 
                              active-color="#EA4335" 
                              :star-size="15">
                              </star-rating>
                              <span class="theme-color-text">{{product.reviews.length}}</span>
                          </div>
                          <div class="add-to-cart-btn w-45 float-left 
                          d-inline-block mt-2">
                            <a @click="showcartdropdown(product)" class="theme-color-text text_14 box_radius font-weight-bold theme-color-border" 
                            href="javascript:void(0)">
                              Add to cart
                            </a>
                          </div>
                  </div>
                </a>
              </b-col>
          </b-row>
          <b-row v-else class="monthly-offer-product">
                <b-col cols="12">
                    <div class="empty-product-image w-100 d-inline-block mt-4 text-center">
                      <b-img src="/images/empty-product.png" fluid-alt="No product picture"></b-img>
                      <p class="text-black font-weight-bold text-size-14">
                        No Products Available Against {{current_brand.name}} Category</p>
                    </div>
                </b-col>
            </b-row>
            <b-row>
        <b-col cols="12 mb-5 mt-lg-5 mt-3">
         <div class="product-list-pagination m-auto d-block mb-4 
         position-relative">
            <b-pagination
              v-model="currentPage"
              :total-rows="rows"
              :per-page="perPage"
              @input="getMoreProducts"
              first-number
              last-number>
            </b-pagination>
          </div>
        </b-col>
      </b-row>
          </b-col>
      </b-row>
    </b-container>
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
  name: "product-allComponent",
  props:['products','min_price','max_price','categories','current_category','cities','brands','top_products','top_categories'],
data(){
    return{
      options:[],
      best_salon_heading:'',
      cart_array:[],
      cart_value:[],
      total_cart_amount:0,
      total_amount_array:[],
      cartItem:[],
      counterVal:[],
      updateState:'',
      priceStart:this.min_price,
      priceEnd:this.max_price,
      allCategories:this.categories,
      allBrands:this.brands,
      allCities:this.cities,
      allProducts:this.products.data,
      allTopProduct:this.top_products,
      allTopCategory:this.top_categories,
      allProduct:[],
      search_category:'',
      showMoreCat:5,
      showMoreBrand:5,
      showMoreCatBtn:true,
      showMoreBrandBtn:true,
      selectedCity:null,
      selectedFilter:null,
      rows: 0,
        perPage: 12,
        currentPage: 1,
      search: '',
      value: '',
      value:0,
       cityOpt: this.cities,
       filterOpt: [
         {id: 0, name:"All Products"},
         {id: 1, name:"Featured"},
         {id: 2, name:"Alphabetically, A-Z"},
         {id: 3, name:"Alphabetically, Z-A"},
         {id: 4, name:"Price, low to high"},
         {id: 5, name:"Price, high to low"}
       ],
        allspeciallties: [
          { name: 'Oreal Paris Makeup True Match',},
          { name: 'Makeup Paris True Match',},
          { name: 'Paris Makeup True Match',},
          { name: 'Beard maintenance',},
          { name: 'Shave & Hair Removal',},
          { name: 'Personal Care',},
        ]
    }
  },
  mounted(){
    document.onreadystatechange = () => { 
      if (document.readyState == "complete") { 
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
    this.rows = this.products.total;
    this.selectedFilter = this.filterOpt.find(option => option.id === 0);
    this.makeActiveCurrentCategory();
  },
   computed: {
    filteredList() {
      return this.allspeciallties.filter(post => {
        return post.name.toLowerCase().includes(this.search.toLowerCase())
      })
    }
  },
  methods:
     {
      categoriesdropdown(id){
            var newid = 'categories-drop';
            var check = document.getElementById("categories-drop").style.display;
            if (check == "block") {
              document.getElementById("categories-drop").style.display = 'none';
            }else{
              document.getElementById("categories-drop").style.display = 'block';
            }
          },
      getMoreProducts(page){
        axios.get('/get_category_products_list/'+this.current_brand.id+'?page='+page).then(response=>{
          this.allProducts = response.data.data;
          this.rows = response.data.total;
        });
      },
      changeCity(){
        this.best_salon_heading = "Best Products in "+this.selectedCity.title;
      },
      changeFilter(){
        axios.get('/filter_products/'+this.selectedFilter.id+'/'+this.selectedFilter.name).then(response=>{
          this.allProducts = response.data.data;
          this.rows = response.data.total;
        });
      },
      resetPriceVal(){
        this.priceStart=0;
        this.priceEnd=2000;
      },
      makeActiveCurrentCategory(){
        var url = window.location.pathname.split("/");
        if(url[url.length-1].includes("%20")){
          var str = url[url.length-1].replaceAll('%20', '');
          var element = document.getElementById(str);
          if(element.classList.contains("text-black"))
            element.classList.remove('text-black');
          element.classList.add("text-gold");
        }else{
          var element = document.getElementById(url[url.length-1]);
          if(element.classList.contains("text-black"))
            element.classList.remove('text-black');
          element.classList.add("text-gold");
        }
      },
       searchCategory(){
         if(this.search_category.length>2){
           axios.get('/product/category/search/'+this.search_category).then(response=>{
             this.allTopCategory = response.data.category;
             this.allProduct = response.data.product;
           });
         }else{
           this.allTopCategory = this.top_categories;
           this.allTopProduct = this.top_products;
         }
       },
       getProductWithinPrice(){
        let formData = new FormData();
        formData.append('priceStart',this.priceStart);
        formData.append('priceEnd',this.priceEnd);
        formData.append('category_id',this.current_brand.id);
        axios.post('/product/getPriceRangeProduct',formData).then(response=>{
          this.allProducts = response.data.products.data;
          this.rows = response.data.products.total;
        });
       },
       showMoreCategories(){
         this.showMoreCat=this.showMoreCat+5;
         axios.get('/product/getMoreCategories/'+this.showMoreCat).then(response=>{
           this.allCategories = response.data.categories;
           if(response.data.categories.length < this.showMoreCat){
             this.showMoreCatBtn = false;
           }
           var self = this;
           setTimeout(function(){ 
              self.makeActiveCurrentCategory(); 
            }, 1500);
         });
       },
       showMoreBrands(){
         this.showMoreBrand=this.showMoreBrand+5;
         axios.get('/product/getMoreBrands/'+this.showMoreBrand).then(response=>{
           this.allBrands = response.data.brands;
           if(response.data.brands.length < this.showMoreBrand){
             this.showMoreBrandBtn = false;
           }
         });
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
        document.getElementById("cartdrop").style.display = 'none';
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
      showdropdown(id){
            var newid = 'drop';
            var check = document.getElementById("drop").style.display;
            if (check == "block") {
              document.getElementById("drop").style.display = 'none';
            }else{
              document.getElementById("drop").style.display = 'block';
            }
          },
          crossicon(id){
            var newid = 'drop';
            var check = document.getElementById("drop").style.display;
            if (check == "block") {
              document.getElementById("drop").style.display = 'none';
            }else{
              document.getElementById("drop").style.display = 'block';
            }
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

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>