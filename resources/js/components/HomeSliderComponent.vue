<template>
    <div>
        <div class="dc-tabscontenttitle dc-addnew">
            <h3>{{trans('lang.add_slides')}}</h3>
            <div  >
                <a href="javascript:void(0);" @click="addSlide" class="add-slide-btn">{{trans('lang.add_new')}}</a>
            </div>
        </div>
        <ul class="dc-experienceaccordion accordion" id="slides-list">
            <li class="slide-inner-list" v-for="(stored_slide, index) in stored_slides" :key="'stored_'+index" v-if="stored_slides.length > 0">
                <div class="slide-inner-list-item dc-settingscontent" :id="'slide-element-'+index">
                    <updateHomeSlider
                        :main_accordion_id="'existingslideaccordion['+index+']'"
                        :inner_accordion_id="'existingslideaccordioninner['+index+']'"
                        :stored_slide_title_one="stored_slide.slide_title_one"
                        :stored_slide_title_two="stored_slide.slide_title_two" 
                        :stored_slide_title_url="stored_slide.slide_title_url" 
                        :slide_title_one="'slide['+[index]+'][slide_title_one]'"
                        :slide_title_two="'slide['+[index]+'][slide_title_two]'"
                        :slide_title_url="'slide['+[index]+'][slide_title_url]'"
                        @removeElement="removeStoredSlide(index)"
                        @editElement="editStoredSlide(index)"
                        :ph_edit_slide_title_one="ph_slide_title_one"
                        :ph_edit_slide_title_two="ph_slide_title_two"
                        :ph_edit_slide_title_url="ph_slide_title_url"

                    >
                    </updateHomeSlider>
                </div>
            </li>
            <li class="slide-inner-list" v-for="(slide, index) in slides" :key="index" ref="slidelistelement">
                <div class="slide-inner-list-item dc-settingscontent">
                    <div :id="'slideaccordion['+slide.count+']'" class="slide-inner-list-item dc-accordioninnertitle" data-toggle="collapse" :data-target="'#slideaccordioninner['+slide.count+']'">
                        <figure :class="slide.preview_class"></figure>
                        <span>{{ slide.slide_title_one }}</span>
                        <div class="dc-rightarea">
                        <div class="dc-btnaction">
                            <a href="javascript:void(0);" class="dc-editbtn" :id="'slideaccordion['+slide.count+']'" data-toggle="collapse" aria-expanded="true"><i class="lnr lnr-pencil"></i></a>
                            <a href="javascript:void(0);" class="dc-delbtn" :id="'del-slider'+slide.count" @click="removeSlide(slide.count, 'del-slider'+slide.count)"><i class="lnr lnr-trash"></i></a></div>
                        </div>
                    </div>
                    <div class="dc-collapseexp collapse hide" :id="'slideaccordioninner['+slide.count+']'" :aria-labelledby="'slideaccordion['+slide.count+']'" data-parent="#accordion">
                        <div class="dc-formtheme dc-userform">
                            <fieldset>
                                <div class="form-group form-group-half">
                                    <input type="text" v-bind:name="'slide['+[slide.count]+'][slide_title_one]'" class="form-control" :placeholder="ph_slide_title_one" v-model="slide.slide_title_one">
                                </div>
                                <div class="form-group form-group-half">
                                    <input type="text" v-bind:name="'slide['+[slide.count]+'][slide_title_two]'" class="form-control" :placeholder="ph_slide_title_two">
                                </div>
                                 <div class="form-group form-group-half">
                                    <input type="text" v-bind:name="'slide['+[slide.count]+'][slide_title_url]'" class="form-control" :placeholder="ph_slide_title_url">
                                </div>
                          
                            </fieldset>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
import updateHomeSlider from './EditHomeSliderComponent'
export default{
    components: {updateHomeSlider},
    props: ['ph_slide_title_one', 'ph_slide_title_two','ph_slide_title_url'],
        data(){
            return {
                stored_slides:[],
                slide: {
                    url: APP_URL,
                    slide_title_one: '',
                    count: 0,
                },
                slides: [],
            }
        },
        methods: {
            getSlides(){
                let self = this;
                axios.get(APP_URL + '/admin/get-homeslider-slides')
                .then(function (response) {
                    console.log(response.data.slides);
                    if(response.data.type == 'success') {
                        self.stored_slides = response.data.slides;
                        self.slide.count = response.data.slides.length;
                        console.log(self.slide.count)
                    }
                });
            },
            addSlide: function () {
                var slides_list_count = jQuery('#slides-list').find('.slide-inner-list').length
                if(this.$refs.slidelistelement) {
                    this.slide.count = slides_list_count + this.$refs.slidelistelement.length;
                } else {
                    this.slide.count = slides_list_count -1;
                }
                if(slides_list_count < 4)
                {
                this.slides.push(Vue.util.extend({}, this.slide, this.slide.count++ ))
                }
                else {

                 this.$swal({
                    title: "You are restricted to 4 Slides",
                    type: "info",
                    customClass: {
                        container: 'la-warning-popup',
                    },
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "ok",
                    closeOnConfirm: true,
                    showLoaderOnConfirm: true
                  }).then((result) => {
                    var self = this;
                    if(result.value) {
                        this.$swal.close()
                    } else {
                        this.$swal.close()
                    }
                  }); 

                }
                
            },
            removeStoredSlide: function (index) {
                this.stored_slides.splice(index, 1);

            },
            editStoredSlide: function (index) {
                if(this.$refs.slidelistelement) {
                    this.slide.count = slides_list_count + this.$refs.slidelistelement.length;
                } else {
                    this.slide.count = slides_list_count -1;
                }
                this.slides.push(Vue.util.extend({}, this.slide, this.slide.count++ ))
            },
            removeSlide: function (index, element_id) {
                this.slides.splice(index, 1);
                jQuery('#' + element_id).parents('.slide-inner-list').remove();  
            },
           
        },
        created: function() {
            this.getSlides();
        }
    }
</script>
