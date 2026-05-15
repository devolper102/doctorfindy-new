<template>
    <div>
        <div class="dc-tabscontenttitle dc-addnew">
            <h3>{{trans('lang.add_experience')}}</h3>
            <a href="javascript:void(0);" @click="addExperience" class="add-exp-btn">{{trans('lang.add_new')}}</a>
        </div>
        <ul class="dc-experienceaccordion accordion" id="exp-list">
            <li class="exp-inner-list" v-for="(stored_experience, index) in stored_experiences" :id="'exp-list-'+index" :key="'db'+index" v-if="stored_experiences.length > 0">
                <div class="exp-inner-list-item dc-settingscontent" :id="'experience-element-'+index">
                    <div class="exp-inner-list-item dc-settingscontent">
                        <div :id="'existingexperienceaccordion['+index+']'" class="exp-inner-list-item dc-accordioninnertitle">
                            <span>{{ stored_experience.company_title }}</span>
                            <div class="dc-rightarea">
                            <div class="dc-btnaction">
                                <a href="javascript:void(0);" class="dc-editbtn" :id="'existingexperienceaccordion['+index+']'" 
                                    data-toggle="collapse" aria-expanded="true" v-on:click="toggleChildCollapse('exp-list-'+index)">
                                    <i class="lnr lnr-pencil"></i>
                                </a>
                                <a href="javascript:void(0);" @click="removeStoredexperience(index)"  class="dc-delbtn"><i class="lnr lnr-trash"></i></a></div>
                            </div>
                        </div>
                        <div class="dc-collapseexp collapse" :id="'existingexperienceaccordioninner['+index+']'">
                            <div class="dc-formtheme dc-userform">
                                <fieldset>
                                    <div class="form-group form-group-half">
                                        <vue-bootstrap-typeahead
                                                class="mb-6"
                                                size="lg"
                                                :name="'experience['+[index]+'][company_title]'" 
                                                :data="hospitals"
                                                v-model="stored_experience.company_title"
                                                :placeholder="stored_experience.company_title" 
                                                :serializer="item => item.name"
                                                ref="searchfield"
                                                inputClass="search-field"
                                                @input="watchSearchResults()"
                                            >
                                        </vue-bootstrap-typeahead>
                                        <input type="hidden" 
                                            v-model="stored_experience.company_title"
                                            :serializer="item => item.name"
                                            :name="'experience['+[index]+'][company_title]'"
                                            size="sm"
                                            placeholder="Enter your name">
                                        <span v-if="is_show" class="no-record-span">{{no_record}}</span>
                                    </div>
                                    <div class="form-group form-group-half">
                                    <vue-bootstrap-typeahead
                                                class="mb-6"
                                                size="lg"
                                                v-model="stored_experience.location"
                                                :name="'experience['+[experience.count]+'][location]'" 
                                                :data="locations"
                                                :placeholder=stored_experience.location
                                                :serializer="item => item.title"
                                                ref="searchfield"
                                                inputClass="search-field"
                                                @input="watchLocationResults()"
                                            >
                                        </vue-bootstrap-typeahead>
                                        <input type="hidden" 
                                            v-model="stored_experience.location"
                                            :serializer="item => item.title"
                                            :name="'experience['+[index]+'][location]'"
                                            size="sm"
                                            placeholder="Enter your name" >
                                        <span v-if="is_show" class="no-record-span">{{no_record}}</span>
                                </div>
                                    <div class="form-group form-group-half">
                                        <date-pick v-model="stored_experience.start_date"></date-pick>
                                        <input type="hidden" :value="stored_experience.start_date" v-bind:name="'experience['+[index]+'][start_date]'" class="form-control" :placeholder="ph_starting_date" required>
                                    </div>
                                    <div class="form-group form-group-half">
                                        <date-pick v-model="stored_experience.end_date"></date-pick>
                                        <input type="hidden" :value="stored_experience.end_date" v-bind:name="'experience['+[index]+'][end_date]'" class="form-control" :placeholder="ph_ending_date"  required>
                                    </div>
                                    <div class="form-group form-group-half">
                                        <input type="text" :value="stored_experience.job_title" v-bind:name="'experience['+[index]+'][job_title]'" class="form-control" :placeholder="ph_job_title" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea :value="stored_experience.job_desc" v-bind:name="'experience['+[index]+'][job_desc]'" class="form-control" :placeholder="ph_job_desc"></textarea required>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="exp-inner-list" v-for="(experience, index) in experiences" :id="'exp-list-'+experience.count" :key="index">
                <div ref="experiencelistelement" class="exp-inner-list-item dc-settingscontent">
                    <div :id="'experienceaccordion['+experience.count+']'" class="exp-inner-list-item dc-accordioninnertitle">
                        <span>{{ experience.company_title }} ({{ experience.start_date }} - {{ experience.end_date }})</span>
                        <div class="dc-rightarea">
                        <div class="dc-btnaction">
                            <a href="javascript:void(0);" class="dc-editbtn" :id="'experienceaccordion['+experience.count+']'" 
                             v-on:click="toggleChildCollapse('exp-list-'+experience.count)"
                            data-toggle="collapse" aria-expanded="true"><i class="lnr lnr-pencil"></i></a>
                            <a href="javascript:void(0);" class="dc-delbtn delete-exp"><i class="lnr lnr-trash"></i></a></div>
                        </div>
                    </div>
                    <div class="dc-collapseexp collapse" :id="'experienceaccordioninner['+experience.count+']'">
                        <div class="dc-formtheme dc-userform">
                            <fieldset>
                            
                                <div class="form-group form-group-half">
                                
                                        <vue-bootstrap-typeahead
                                                class="mb-6"
                                                size="lg"
                                                v-model="experience.company_title"
                                                :name="'experience['+[experience.count]+'][company_title]'" 
                                                :data="hospitals"
                                                :placeholder="ph_company_title" 
                                                :serializer="item => item.name"
                                                ref="searchfield"
                                                inputClass="search-field"
                                                @input="watchSearchResults()"
                                            >
                                    
    
                                        </vue-bootstrap-typeahead>
                                        <input type="hidden" 
                                            v-model="experience.company_title"
                                            :serializer="item => item.name"
                                            :name="'experience['+[experience.count]+'][company_title]'"
                                            
                                            size="sm"
                                            placeholder="Enter your name" required>
                                        <span v-if="is_show" class="no-record-span">{{no_record}}</span>
                                   
                                </div>
                                <div class="form-group form-group-half">
                                    <vue-bootstrap-typeahead
                                                class="mb-6"
                                                size="lg"
                                                v-model="experience.location"
                                                :name="'experience['+[experience.count]+'][location]'" 
                                                :data="locations"
                                                :placeholder=city 
                                                :serializer="item => item.title"
                                                ref="searchfield"
                                                inputClass="search-field"
                                                @input="watchLocationResults()"
                                            >
                                    
    
                                        </vue-bootstrap-typeahead>
                                        <input type="hidden" 
                                            v-model="experience.location"
                                            :serializer="item => item.title"
                                            :name="'experience['+[experience.count]+'][location]'"
                                            size="sm"
                                            placeholder="Enter your name">
                                        <span v-if="is_show" class="no-record-span">{{no_record}}</span>
                                </div>
                                <div class="form-group form-group-half">
                                    <date-pick v-model="experience.start_date"></date-pick>
                                    <input type="hidden" v-bind:name="'experience['+[experience.count]+'][start_date]'" :value="experience.start_date" required>
                                </div>
                                <div class="form-group form-group-half">
                                    <date-pick v-model="experience.end_date"></date-pick>
                                    <input type="hidden" v-bind:name="'experience['+[experience.count]+'][end_date]'" :value="experience.end_date" required>
                                </div>
                                <div class="form-group form-group-half">
                                    <input type="text" v-bind:name="'experience['+[experience.count]+'][job_title]'" class="form-control" :placeholder="ph_job_title" required>
                                </div>
                                <div class="form-group">
                                    <textarea v-bind:name="'experience['+[experience.count]+'][job_desc]'" class="form-control" :placeholder="ph_job_desc" required></textarea>
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
import DatePick from 'vue-date-pick';
export default{
    components: {DatePick},
    props: ['ph_company_title', 'ph_starting_date', 'ph_ending_date', 'ph_job_title', 'ph_job_desc'],
        data(){
            return {
                stored_experiences:[],
                tart_date: window.trans.lang.start_date,
                end_date: window.trans.lang.end_date,
                job_title: window.trans.lang.job_title,
                description: window.trans.lang.desc,
                city:'City',
                experience: {
                    url: APP_URL,
                    company_title: this.ph_company_title,
                    start_date: this.ph_starting_date,
                    end_date: this.ph_ending_date,
                    job_title: this.ph_job_title,
                    description: this.ph_job_desc,
                    count: 0,
                },
                experiences: [],
                hospitals:[],
                locations:[],
                no_record:this.no_record_message,
                url: APP_URL + '/search-results',
                is_show: false,
                query:'',
                placeholder:''
            }
        },
        methods: {
        getSearchableData: function(newQuery){
                let self = this;
                axios.get(APP_URL + '/search/get-hospitals')
                .then(function (response) {
                    self.hospitals = response.data.hospitals;
                });
            },
            getSearchableLocations: function(newQuery){
                let self = this;
                axios.get(APP_URL + '/search/get-locations')
                .then(function (response) {
                    self.locations = response.data.locations;
                });
            },
            watchSearchResults: function() {
                if(this.$refs.searchfield.$children[0].matchedItems == '') {
                    jQuery('.search-field').parents('.form-group').find('span.no-record-span').css("display", "block");
                    this.is_show = true;
                } else {
                    jQuery('.search-field').parents('.form-group').find('span.no-record-span').css("display", "none");
                    this.is_show = false;
                }
            },
            watchLocationResults: function() {
                if(this.$refs.searchfield.$children[0].matchedItems == '') {
                    jQuery('.search-field').parents('.form-group').find('span.no-record-span').css("display", "block");
                    this.is_show = true;
                } else {
                    jQuery('.search-field').parents('.form-group').find('span.no-record-span').css("display", "none");
                    this.is_show = false;
                }
            },
            toggleChildCollapse: function(element_id) {
                jQuery('#'+element_id).find('.dc-collapseexp').toggleClass('show')
            },
            getCurrentDate() {
                var date = new Date();
                var day = ("0" + date.getDate()).slice(-2);
                var monthIndex = ("0" + (date.getMonth() + 1)).slice(-2);
                var year = date.getFullYear();
                return year+'-'+monthIndex+'-'+day ;
            },
            getexperiences(){
                let self = this;
                axios.get(APP_URL + '/doctor/get-experiences')
                .then(function (response) {
                    if(response.data.type == 'success') {
                        self.stored_experiences = response.data.experiences;
                    }
                });
            },
            addExperience: function () {
                var date = this.getCurrentDate();
                var experiences_list_count = jQuery('#exp-list').find('.exp-inner-list').length
                if(this.$refs.experiencelistelement) {
                    this.experience.count = experiences_list_count + this.$refs.experiencelistelement.length;
                } else {
                    this.experience.count = experiences_list_count -1;
                }
                this.experiences.push(Vue.util.extend({}, this.experience, this.experience.count++, this.experience.start_date = date, this.experience.end_date = date ))
            },
            removeStoredexperience: function (index) {
                this.stored_experiences.splice(index, 1);
                return false;
            },
        },
        created: function() {
            this.getexperiences();
            this.getSearchableData();
            this.getSearchableLocations();
        },
        watch: {
           query: _.debounce(function(newQuery) { this.getSearchableData(newQuery) }, 250)
        },
        mounted: function () {
            jQuery(document).on('click', '.delete-exp', function (e) {
                e.preventDefault();
                var _this = jQuery(this);
                _this.parents('.exp-inner-list-item').remove();
            });

             jQuery(".search-field").keydown(function(){
                var input = jQuery('.search-field');
                input.on('keydown', function() {
                    var key = event.keyCode || event.charCode;
                    if( key == 8 || key == 46 ) {
                        if(!jQuery(this).val()) {
                            jQuery(this).parents('.form-group').find('span.no-record-span').css("display", "none");
                        } else {
                            this.is_show = true;
                        }
                    }
                });
            });
        },
    }
</script>
<style>
.wt-radioholder{transition: 1s;}
</style>
