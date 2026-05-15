{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'home-article-section-form', '@submit.prevent'=>'submitArticleSettings'])!!}
    <div class="dc-securitysettings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('Data Protection') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_article_sec">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_article_sec" name="show_article_sec">
            </div>
        </div>
        <div class="dc-settingscontent dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group form-group-half">
                        {!! Form::text('title', !empty($data_protection_title) ? e($data_protection_title) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.title')]) !!}
                    </div>
                    <div class="form-group form-group-half">
                        {!! Form::text('subtitle', !empty($data_protection_subtitle) ? e($data_protection_subtitle) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.sub_heading')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('description', !empty($data_protection_desc) ? e($data_protection_desc) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.desc')]) !!}
                    </div>
                </fieldset>
            </div>
        </div>
         <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
            <div class = "dc-formtheme dc-userform">
                   @if (!empty($data_protection_img))
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $data_protection_img }}'"
                                :img_id="'data_protection_img'"
                                :img_name="'data_protection_img'"
                                :img_ref="'data_protection_img'"
                                :img_hidden_name="'hidden_data_protection_img'"
                                :img_hidden_id="'hidden_data_protection_img'"
                                :existed_img="'{{$data_protection_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/data_protection_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$data_protection_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $data_protection_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $data_protection_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'data_protection_img'"
                                :img_id="'data_protection_img'"
                                :img_name="'data_protection_img'"
                                :img_ref="'data_protection_img'"
                                :img_hidden_name="'hidden_data_protection_img'"
                                :img_hidden_id="'hidden_data_protection_img'"
                                :url="'{{ url("media/upload-temp-image/settings/data_protection_img") }}'"
                                >
                                </upload-media>
                          @endif
                </div>
            </div>
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
