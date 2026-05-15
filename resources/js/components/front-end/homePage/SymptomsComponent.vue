<template>
  <div>
    <div class="container">
      <div class="row mt-2 mb-2">
        <div class="col-12">
          <div class="speacialities-heading w-100 
          d-inline-block">
            <h2 class="mb-4 knockdoc-heading service-text">
              Top Symptoms
            </h2>
          </div>
        </div>
      </div>
      <div v-if="screenSize === 'Mobile'" class="row mt-2 mb-4">
        <div class="col-12">
          <div class="float-left zoom-box position-relative w-33 text-center">
                <div class="w-100 d-inline-block mb-2">
                  <img v-lazy="basePath+'/images/fever.svg'" 
                  alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_12 d-block">Fever
                  </span>
                  <span class="text_black text_12 d-block">بخار
                  </span> 
                </div>
                <a href="/general-physician-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <div class="float-left zoom-box position-relative 
              w-33 text-center">
                <div class="w-100 d-inline-block mb-2">
                  <img v-lazy="basePath+'/images/heart-pain.svg'" 
                  alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_12 d-block">Heart Pain</span>
                  <span class="text_black text_12 d-block">
                    دل کا درد
                  </span>
                </div>
                <a href="/cardiologist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <div class="float-left zoom-box position-relative 
              w-33 text-center">
                <div class="w-100 d-inline-block mb-2">
                  <img v-lazy="basePath+'/images/slider-pregnancy.svg'" 
                  alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_12 d-block">
                    Pregnancy
                  </span>
                  <span class="text_black text_12 d-block">
                    حمل
                  </span>
                </div>
                <a href="/gynecologist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <div class="float-left zoom-box position-relative w-33 mt-3 text-center">
                <div class="w-100 d-inline-block mb-2">
                  <img v-lazy="basePath+'/images/teeth-pain.svg'" 
                  alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_12 d-block">
                    Teeth Pain
                  </span>
                  <span class="text_black text_12 d-block">
                    دانتوں کا درد
                  </span>
                </div>
                <a href="/dentist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <div class="float-left zoom-box position-relative w-33 mt-3 text-center">
                <div class="w-100 d-inline-block mb-2">
                  <img v-lazy="basePath+'/images/slider-blood-pressure.svg'" 
                  alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_12 d-block">
                    High blood pressure
                  </span>
                  <span class="text_black text_12 d-block">
                    ہائی بلڈ پریشر
                  </span>
                </div>
                <a href="/cardiologist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <div class="float-left zoom-box position-relative w-33 mt-3 text-center">
                <div class="w-100 d-inline-block mb-2">
                  <img v-lazy="basePath+'/images/breathless.svg'" 
                  alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_12 d-block">
                    Shortness of breath
                  </span>
                  <span class="text_black text_12 d-block">
                    سانس کی تکلیف
                  </span>
                </div>
                <a href="/pulmonologist-lung-specialist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <div class="float-left zoom-box position-relative w-33 mt-3 text-center">
                <div class="w-100 d-inline-block mb-2">
                  <img v-lazy="basePath+'/images/prp-hair-transplant.svg'" alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_12 d-block">
                    Hairfall
                  </span>
                  <span class="text_black text_12 d-block">
                    بالوں کا گرنا
                  </span>
                </div>
                <a href="/dermatologist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <div class="float-left zoom-box position-relative w-33 mt-3 text-center">
                <div class="w-100 d-inline-block mb-2">
                  <img v-lazy="basePath+'/images/anxiety.svg'" 
                  alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_12 d-block">
                    Anxiety/Depression
                  </span>
                  <span class="text_black text_12 d-block">
                     تشویش / افسردگی
                  </span>
                </div>
                <a href="/psychiatrist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
                <div class="float-left zoom-box position-relative w-33 mt-3 text-center">
                <div class="w-100 d-inline-block mb-2">
                  <img v-lazy="basePath+'/images/severe-headache.svg'" alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_12 d-block">
                    Severe headache
                  </span>
                  <span class="text_black text_12 d-block">
                     شدید سر درد
                  </span>
                </div>
                <a href="/acupuncture-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <!-- <div class="float-left zoom-box position-relative w-33 mt-3">
                <div class="m-auto h_90 w_90px">
                  <img src="/images/skin-infection.svg" alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_14 d-block">
                    Skin Infection
                  </span>
                  <span class="text_black text_14 d-block">
                     جلدی انفیکشن
                  </span>
                </div>
                <a href="/dermatologist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>  -->
        </div>
        <div class="col-12 mt-3">
          <div class="d-inline-block w-100 text-center">
            <a href="/diseases" class="box_radius bg-green text-white p-2 btn_padding d-inline-block">
                View All Diseases
            </a>
          </div>
        </div>
      </div>
      <div v-else class="row mt-2">
        <div class="col-12">
          <div class="symptoms-slider w-100 d-inline-block">
            <VueSlickCarousel
            v-bind="c2Setting">
              <div class="float-left zoom-box position-relative">
                <div class="symptoms-images-box m-auto rounded-circle h_90 w_90px">
                  <img v-lazy="basePath+'/images/fever.svg'" 
                  alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_14 d-block">Fever
                  </span>
                  <span class="text_black text_16 d-block">بخار
                  </span> 
                </div>
                <a href="/general-physician-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <div class="float-left zoom-box position-relative">
                <div class="symptoms-images-box m-auto rounded-circle h_90 w_90px">
                  <img v-lazy="basePath+'/images/heart-pain.svg'" 
                  alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_14 d-block">Heart Pain</span>
                  <span class="text_black text_16 d-block">
                    دل کا درد
                  </span>
                </div>
                <a href="/cardiologist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <div class="float-left zoom-box position-relative">
                <div class="symptoms-images-box m-auto rounded-circle h_90 w_90px">
                  <img v-lazy="basePath+'/images/slider-pregnancy.svg'" 
                  alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_14 d-block">
                    Pregnancy
                  </span>
                  <span class="text_black text_13 d-block">
                    حمل
                  </span>
                </div>
                <a href="/gynecologist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <div class="float-left zoom-box position-relative">
                <div class="symptoms-images-box m-auto rounded-circle h_90 w_90px">
                  <img v-lazy="basePath+'/images/teeth-pain.svg'" 
                  alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_14 d-block">
                    Teeth Pain
                  </span>
                  <span class="text_black text_16 d-block">
                    دانتوں کا درد
                  </span>
                </div>
                <a href="/dentist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <div class="float-left zoom-box position-relative">
                <div class="symptoms-images-box m-auto rounded-circle h_90 w_90px">
                  <img v-lazy="basePath+'/images/slider-blood-pressure.svg'" 
                  alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_14 d-block">
                    High blood pressure
                  </span>
                  <span class="text_black text_16 d-block">
                    ہائی بلڈ پریشر
                  </span>
                </div>
                <a href="/cardiologist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <div class="float-left zoom-box position-relative">
                <div class="symptoms-images-box m-auto rounded-circle h_90 w_90px">
                  <img v-lazy="basePath+'/images/breathless.svg'" 
                  alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_14 d-block">
                    Shortness of breath
                  </span>
                  <span class="text_black text_16 d-block">
                    سانس کی تکلیف
                  </span>
                </div>
                <a href="/pulmonologist-lung-specialist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <div class="float-left zoom-box position-relative">
                <div class="symptoms-images-box m-auto rounded-circle h_90 w_90px">
                  <img v-lazy="basePath+'/images/prp-hair-transplant.svg'" alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_14 d-block">
                    Hairfall
                  </span>
                  <span class="text_black text_16 d-block">
                    بالوں کا گرنا
                  </span>
                </div>
                <a href="/dermatologist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <div class="float-left zoom-box position-relative">
                <div class="symptoms-images-box m-auto rounded-circle h_90 w_90px">
                  <img v-lazy="basePath+'/images/anxiety.svg'" 
                  alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_14 d-block">
                    Anxiety/Depression
                  </span>
                  <span class="text_black text_16 d-block">
                     تشویش / افسردگی
                  </span>
                </div>
                <a href="/psychiatrist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
                <div class="float-left zoom-box position-relative">
                <div class="symptoms-images-box m-auto rounded-circle h_90 w_90px">
                  <img v-lazy="basePath+'/images/severe-headache.svg'" alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_14 d-block">
                    Severe headache
                  </span>
                  <span class="text_black text_16 d-block">
                     شدید سر درد
                  </span>
                </div>
                <a href="/acupuncture-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div>
              <div class="float-left zoom-box position-relative">
                <div class="symptoms-images-box m-auto rounded-circle h_90 w_90px">
                  <img v-lazy="basePath+'/images/skin-infection.svg'" alt="pictire">
                </div>
                <div class="w-100 d-inline-block text-center">
                  <span class="text_black text_14 d-block">
                    Skin Infection
                  </span>
                  <span class="text_black text_16 d-block">
                     جلدی انفیکشن
                  </span>
                </div>
                <a href="/dermatologist-in-lahore" 
                class="circle_anchor position-absolute"></a>
              </div> 
            </VueSlickCarousel>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
   import 'vue-slick-carousel/dist/vue-slick-carousel.css'
   import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
export default {
  components: { VueSlickCarousel },
  name: "SymptomsComponent",
  props:[
     'fileSystemDriver'
  ],
  data() {
       return {
        screenSize:'',
        basePath:'',
        symptom:[],
         c2Setting: {
           arrows: true,
           dots:false,
           slidesToShow:8,
           speed: 500,
           responsive: [
             {
               breakpoint: 1024,
               settings: {
                 slidesToShow: 4,
                 slidesToScroll: 1,
               }
             },
             {
               breakpoint: 600,
               settings: {
                 slidesToShow: 3,
                 slidesToScroll: 1,
                 initialSlide: 2
               }
             },
             {
               breakpoint: 480,
               settings: {
                 slidesToShow: 2,
                 slidesToScroll: 1
               }
             }
           ]
         },
       }
     },
     mounted()
     {
      if (this.fileSystemDriver === 'production') {
        // Use DigitalOcean Spaces URL for production
        this.basePath = 'https://doctorfindy.sgp1.cdn.digitaloceanspaces.com';
      } else {
        // Use local path for development
        this.basePath = '';
      }
        this.updateScreenSize();
        window.addEventListener('resize', this.updateScreenSize);
        // this.getSymptomsData();
     },
     beforeUnmount() {
        window.removeEventListener('resize', this.updateScreenSize);
      },
     methods:
     {
       updateScreenSize() {
          if (window.innerWidth < 768) {
            this.screenSize = 'Mobile';
          } else {
            this.screenSize = 'Desktop';
          }
        },
        getSymptomsData()
        { 
          axios.get('/home-page-symptoms-slider-data')
            .then(response=>{
                  this.symptom=response.data;
            }); 
        },
     },
  
}
</script>

<style scoped>

</style>