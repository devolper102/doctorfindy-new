<template>
	<div>
    <div id="banner">
      <div class="inner-banner position-relative pb-lg-3 pb-4">
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
              <h2 class="text-white text-xs-25 d-inline-block text-size-32 font-weight-bold">Brands &amp; Offers</h2>
            </div>
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
          <b-col cols="12">
            <div class="w-100 d-inline-block dc-categorie-image">
              <b-row>
                <b-col cols="12 pr-lg-0" col lg ="3">
                  <div class="categorie-heading-main w-100 d-inline-block bg-white box_shadow p-2">
                      <div class="menu-heading w-100 d-inline-block">
                        <a class="text-gold d-inline-block float-left" 
                      href="javascript:void(0)" @click="categoriesdropdown()">
                        <b-img src="images/categories-image-icon.svg" 
                  fluid alt="picture" class="w-100"></b-img>
                      </a>
                      <span class="d-inline-block text-center font-weight-bold text_18 w-90 theme-color-text">Categories</span>
                      </div>
                    </div> 
                      <ul id="categories-drop" class="w-100 d-lg-block categories pl-5 input-search-deal bg-white box_shadow">
                        <!-- <span class="d-lg-none d-block mb-lg-0 mb-5">
                           <a class="d-lg-none d-block position-absolute cros-icon text_18 text_black text-center" href="javascript:void(0)" 
                      @click="categoriescrossicon()">
                        <i class="fa fa-times" aria-hidden="true"></i>
                      </a>
                        </span> -->
                      <li v-for="(category,index) in product_categories" :key="index">
                        <a class="text_black font-weight-bold text_14" :href="'/products/category/'+category.slug">
                          {{category.name}}
                        </a>
                      </li>
                    </ul>
                </b-col>
                <b-col cols="12 pl-lg-0 d-lg-block d-none" col lg ="9">
                  <div class="product-input-image w-100 d-inline-block">
                    <b-img :src="'/uploads/productsetting/'+page_setting.category_banner_image" fluid alt="picture"></b-img>
                  </div>
                </b-col>
              </b-row>
            </div>
          </b-col>
        </b-row>
      </b-container>
      </div>
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
      <div v-if="allCategory.length>0" class="mt-2 headeing-categorie-search w-45 w-xs-100 float-left d-inline-block">
        <span class="text-black font-weight-bold">Top Categories</span>
      </div>
      <ul class="w-100 d-inline-block mt-lg-5 mt-md-5 mt-4 p-0 
      makeup-categories">
        <li class="mb-3" v-for="(category, index) in allCategory" :key="index">
          <a @click="saveToLocal(category.name,'category',category.slug)" class="text_black box_radius pt-1 pb-1 pl-3 w-100 d-inline-block" :href="'/products/category/'+category.slug">
            {{category.name}}
          </a>
        </li>
      </ul>
      <div v-if="allProduct.length>0" class="headeing-categorie-search w-45 w-xs-100 float-left d-inline-block">
        <span class="text-black font-weight-bold">Products</span>
        </div>
        <ul v-if="allProduct.length>0" class="w-100 d-inline-block p-0 mt-3 recent-categories">
          <li v-for="(product,index) in allProduct" :key="index" class="w-33 float-left mb-2 w-xs-100 w-sm-50 
          w-md-50">
            <a @click="saveToLocal(product.name,'product',product.slug)" class="text-black text-size-14" :href="'/product-detail/'+product.slug">
              {{product.name}}
            </a>
          </li>
        </ul>
      <div class="headeing-categorie-search w-45 w-xs-100 float-left d-inline-block">
        <span class="text-black font-weight-bold">Recent Search</span>
        </div>
        <div class="recent-search-clear-btn w-55 w-xs-100 text-lg-center d-inline-block mt-lg-0 mt-3">
          <a @click="clearRecentSearch()" v-if="allRecentSearch.length>0" class="knockdoc_btn_bg text-white text_14 d-inline-block" 
          href="javascript:void(0)">
            Recent Search Clear
          </a>
        </div>
        <ul v-if="allRecentSearch.length>0" class="w-100 d-inline-block p-0 mt-3 recent-categories">
          <li v-for="(product,index) in allRecentSearch" :key="index" class="w-33 float-left mb-2 w-xs-100 w-sm-50 
          w-md-50">
            <a :href="product.type=='product'?'/product-detail/'+product.id:'/products/category/'+product.id" class="text_black text_14" href="javascript:void(0)">
              {{product.name}}
            </a>
            <a @click="removeSearchItem(index)" class="theme-color-text text_18 font-weight-bold" 
            href="javascript:void(0)">
              <span><b-icon icon="x">x</b-icon></span>
            </a>
          </li>
        </ul>
        <ul v-else class="w-100 d-inline-block p-0 mt-3 recent-categories">
          <li class="w-33 float-left mb-2 w-xs-100 w-sm-50 w-md-50">
            <p class="text-size-15">No Recent Search</p>
          </li>
        </ul>
      <div class="heading-recommended w-100 d-inline-block">
        <span class="text_black font-weight-bold">Recommended</span>
        </div>
        <ul class="w-100 d-inline-block p-0 mt-2 recommended-categories-btn">
          <li v-for="(product,index) in top_products" :key="index">
            <a class="text-white knockdoc_btn_bg d-inline-block text_14 mr-3 float-left mb-2 text-xs-center w-xs-40" 
            :href="'/product-detail/'+product.slug">
              {{product.name}}
            </a>
          </li>
        </ul>
      </div>
    </div>
    </div>
  </div>
</template>

<script>
export default 
{
  name: "product-home-bannerComponent",
  props:['product_categories','top_categories','top_products','page_setting'],
data(){
    return{
      search: '',
      value: '',
      allCategory:this.top_categories,
      allProduct:[],
      allRecentSearch:[],
      search_category:'',
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
    var search_data = localStorage.getItem('recent_search');
    if(search_data && search_data.length>0){
      this.allRecentSearch = JSON.parse(search_data);
    }
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
      saveToLocal(name,type,id){
        this.allRecentSearch.push({'id':id,'name':name,'type':type});
        localStorage.setItem('recent_search', JSON.stringify([...new Set(this.allRecentSearch)]));
      },
      clearRecentSearch(){
        localStorage.removeItem('recent_search');
        this.allRecentSearch = [];
      },
      removeSearchItem(index){
        this.allRecentSearch.splice(index, 1);
        localStorage.setItem("recent_search", JSON.stringify(this.allRecentSearch));
      },
       searchCategory(){
         if(this.search_category.length>2){
           axios.get('/product/category/search/'+this.search_category).then(response=>{
             this.allCategory = response.data.category;
             this.allProduct = response.data.product;
           });
         }else{
           this.allCategory = this.top_categories;
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
          categoriesdropdown(id){
            var newid = 'categories-drop';
            var check = document.getElementById("categories-drop").style.display;
            if (check == "block") {
              document.getElementById("categories-drop").style.display = 'none';
            }else{
              document.getElementById("categories-drop").style.display = 'block';
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
          categoriescrossicon(id){
            var newid = 'categories-drop';
            var check = document.getElementById("categories-drop").style.display;
            if (check == "block") {
              document.getElementById("categories-drop").style.display = 'none';
            }else{
              document.getElementById("categories-drop").style.display = 'block';
            }
          },
     }
};
</script>

<style>
</style>