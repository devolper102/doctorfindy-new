<template>
	<div>
    <b-container>
      <b-row>
        <b-col cols="12">
          <div class="brand-heading w-100 d-inline-block">
            <h2 class="text-black font-weight-bold mt-4 text-size-32 text-xs-25">{{page_setting.brand_heading}}</h2>
          </div>
        </b-col>
      </b-row>
      <div class="d-flex brands pb-3 mt-4">
        <b-col v-for="(brandimg,index) in product_brands" :key="index" cols="12" col lg ="6" col xl ="3" col sm ="6" col md ="6">
          <a class="circle-anchor" :href="'/product/brand/'+brandimg.slug">
          <div class="brand-images w-100 d-inline-block bg-white box_shadow text-center">
            <b-img :src="'uploads/brands/'+brandimg.logo" fluid :alt="brandimg.name+' - photo'"></b-img>
          </div>
          </a>
        </b-col>
      </div>
      <b-row>
        <b-col cols="12">
          <div class="feature-heading w-100 d-inline-block">
            <h2 class="text-black font-weight-bold mt-4 text-size-32 text-xs-25">{{page_setting.feature_heading}}</h2>
          </div>
        </b-col>
      </b-row>
      <b-row class="mt-4">
        <b-col cols="12">
          <div class="feature-product-slider discount-offer-slider w-100 d-inline-block">
            <VueSlickCarousel
              v-bind="c2Setting">
                <div v-for="(featureproduct,index) in featured_products" :key="index">
                  <b-col cols="12">
                    <b-row>
                      <a :href="'/product-detail/'+featureproduct.slug">
                        <b-col cols="12">
                          <div class="feature-image w-100 d-inline-block text-center pb-2">
                            <b-img :src="'uploads/products/'+featureproduct.thumbnail" fluid :alt="featureproduct.name+' - photo'" class="d-inline-block mt-3"></b-img>
                            <div v-if="featureproduct.reviews.length>0" class="rating-star mt-2">
                            <star-rating 
                              :show-rating="false" 
                              active-color="#B59E5C" 
                              :star-size="20"
                              v-model="featureproduct.reviews[0].aggregate"
                              read-only="true" 
                              >
                              </star-rating>
                            </div>
                            <div v-else class="rating-star mt-2">
                              <star-rating 
                              :show-rating="false" 
                              active-color="#B59E5C" 
                              :star-size="20"
                              v-model="featureproduct.reviews.length"
                              read-only="true" 
                              >
                              </star-rating>
                            </div>
                            <p class="text-black text_14 mt-2 mb-2">
                              {{featureproduct.name}}
                            </p>
                            <span v-if="featureproduct.discount_price" class="theme-color-text text_14">
                              RS. {{featureproduct.discount_price}}
                            </span>
                            <span v-else class="theme-color-text text_14">
                              Rs. {{featureproduct.price}}
                            </span>
                          </div>
                        </b-col>
                      </a>
                    </b-row>
                  </b-col>
                </div>
              </VueSlickCarousel>
            </div>
        </b-col>
      </b-row>
      <div class="main-call-center-box w-90 w-xs-100 w-sm-100 w-md-100 d-block">
      <b-row class="mt-4 mb-4">
        <b-col cols="12" col lg ="6" col xl ="3" col sm ="6" col md ="6">
          <div class="call-center-box w-100 d-inline-block box_radius 
          text-center mb-2">
            <b-img :src="'/uploads/productsetting/'+page_setting.call_center_logo" fluid :alt="page_setting.call_center_heading+' - photo'" class="d-inline-block mt-2"></b-img>
            <span class="text-white text_14 font-weight-bold mt-2 d-inline-block w-100">{{page_setting.call_center_heading}}</span>
            <p class="text-white text_14 mt-2 mb-2">
              {{page_setting.call_center_text}}
            </p>
          </div>
        </b-col>
        <b-col cols="12" col lg ="6" col xl ="3" col sm ="6" col md ="6">
          <div class="call-center-box w-100 d-inline-block box_radius 
          text-center mb-2">
            <b-img :src="'/uploads/productsetting/'+page_setting.shop_confidence_logo" fluid :alt="page_setting.shop_confidence_heading+' - photo'" class="d-inline-block mt-2"></b-img>
            <span class="text-white text_14 font-weight-bold mt-2 d-inline-block w-100">{{page_setting.shop_confidence_heading}}</span>
            <p class="text-white text_14 mt-2 mb-2">
              {{page_setting.shop_confidence_text}}
            </p>
          </div>
        </b-col>
        <b-col cols="12" col lg ="6" col xl ="3" col sm ="6" col md ="6">
          <div class="call-center-box w-100 d-inline-block box_radius 
          text-center mb-2">
            <b-img :src="'/uploads/productsetting/'+page_setting.safe_payment_logo" fluid :alt="page_setting.safe_payment_heading+' - photo'" class="d-inline-block mt-2"></b-img>
            <span class="text-white text_14 font-weight-bold mt-2 d-inline-block w-100">{{page_setting.safe_payment_heading}}</span>
            <p class="text-white text_14 mt-2 mb-2">
              {{page_setting.safe_payment_text}}
            </p>
          </div>
        </b-col>
        <b-col cols="12" col lg ="6" col xl ="3" col sm ="6" col md ="6">
          <div class="call-center-box w-100 d-inline-block box_radius 
          text-center mb-2">
            <b-img :src="'/uploads/productsetting/'+page_setting.deliver_all_logo" fluid :alt="page_setting.deliver_all_heading+' - photo'" class="d-inline-block mt-2"></b-img>
            <span class="text-white text_14 font-weight-bold mt-2 d-inline-block w-100">{{page_setting.deliver_all_heading}}</span>
            <p class="text-white text_14 mt-2 mb-2">
              {{page_setting.deliver_all_text}}
            </p>
          </div>
        </b-col>
      </b-row>
    </div>
    </b-container>
  </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
import StarRating from 'vue-star-rating'
export default 
{
  components: 
  { VueSlickCarousel,
    StarRating,
  },
  name: "product-brandComponent",
props: ['forums','product_brands','featured_products','page_setting'],
  data() {
    return {
      count_review:4,
      c2Setting: {
        arrows: true,
        dots: false,
        slidesToShow:4,
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
              slidesToShow: 2,
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
  
};
</script>

<style>
</style>