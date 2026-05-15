{!! Form::open(['url' => '', 'class' =>'dc-haslayout', 'id' =>'create-article-form', '@submit.prevent'=>'postArticle'])!!}
    <div class="dc-dashboardbox">
        <div class="dc-dashboardboxtitle la-switch-option py-3">
            <h2>{{ trans('lang.post_new_article') }}</h2>
            <!-- <div class="float-right">
                <switch_button v-model="is_featured">{{{ trans('lang.feture_article') }}}</switch_button>
                <input type="hidden" :value="is_featured" name="is_featured">
            </div> -->
        </div>
        <div class="dc-dashboardboxcontent dc-addservices dc-articlesservices">
            <div class="dc-tabscontenttitle">
                <h3>{{ trans('lang.add_article_detail') }}</h3>
            </div>
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('title', null, ['class' =>
                        'form-control','placeholder'=>trans('lang.ph.title')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('url_title', null, ['class' =>
                        'form-control','placeholder'=>trans('Title For Url')]) !!}
                    </div>
                    <div class="form-group dc-tinymceeditor text_area_main">
                        <textarea class="form-control" name="short_description" placeholder="Short Description"></textarea>
                    </div>
                    <div class="form-group text_area_main">
                        {!! Form::textarea('description', null, [ 'id' => 'description' ]) !!}
                    </div>
                </fieldset>
            </div>
            <div class="dc-profilephoto dc-tabsinfo">
                <div class="dc-tabscontenttitle">
                    <h3>{{ trans('lang.featured_photo') }}</h3>
                </div>
                <div class="dc-profilephotocontent">
                    <!-- <div class="dc-description">
                        <p>{{ trans('lang.featured_photo_desc') }}</p>
                    </div> -->
                    <div class="dc-formtheme dc-formprojectinfo dc-formcategory">
                        <div class="dc-settingscontent">
                            <div class = "dc-formtheme dc-userform">
                                <upload-media-blog
                                :img="'feature_img'"
                                :img_id="'feature_img'"
                                :img_name="'feature_img'"
                                :img_ref="'feature_img'"
                                :img_hidden_name="'hidden_feature_img'"
                                :img_hidden_id="'hidden_feature_img'"
                                :url="'{{ url("media/upload-temp-image/users/feature_img/articles") }}'"
                                :width="825"
                                :height="360">
                                </upload-media-blog>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  <div class="form-group">
                                    <span class="dc-select">
                                    <select name="reading_time" id="vaccination_id" class="form-control">
                                       <option value="">Select Reading Time in Minutes </option>
                                        <option value="1">1 Minutes</option>
                                        <option value="2">2 Minutes</option>
                                        <option value="3">3 Minutes</option>
                                        <option value="4">4 Minutes</option>
                                        <option value="5">5 Minutes</option>
                                        <option value="6">6 Minutes</option>
                                        <option value="7">7 Minutes</option>
                                        <option value="8">8 Minutes</option>
                                        <option value="9">9 Minutes</option>
                                        <option value="10">10 Minutes</option>
                                        <option value="11">11 Minutes</option>
                                        <option value="12">12 Minutes</option>
                                        <option value="13">13 Minutes</option>
                                        <option value="14">14 Minutes</option>
                                        <option value="15">15 Minutes</option>
                                        
                                    </select>
                                </span>
                                </div>
            <div class="dc-profilephoto dc-tabsinfo">
                <div class="dc-tabscontenttitle">
                    <h3>{{ trans('lang.select_category') }}</h3>
                </div>
                <article-cats :placeholder="'{{ trans('lang.all_cats_selected') }}'"></article-cats>
            </div>
            <div class="dc-btnarea">
                {!! Form::button(trans('lang.post_now'), [ 'type' => 'submit' ,'class' => 'dc-btn']) !!}
            </div>
        </div>
    </div>
{!! Form::close() !!}

