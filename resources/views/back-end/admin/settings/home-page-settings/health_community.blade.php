{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'health-communitysection-form', '@submit.prevent'=>'submitHealthCommunity'])!!}
    <div class="dc-securitysettings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('Health Community Banner Section') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_health_community_banner">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_health_community_banner" name="show_health_community_banner">
            </div>
        </div>
        <div class="dc-settingscontent dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group form-group-half">
                        {!! Form::text('title', !empty($health_community_title) ? e($health_community_title) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.title')]) !!}
                    </div>
                    <div class="form-group form-group-half">
                        {!! Form::text('subtitle', !empty($health_community_subtitle) ? e($health_community_subtitle) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.sub_heading')]) !!}
                    </div>
                </fieldset>
            </div>
        </div>
         <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
            <div class = "dc-formtheme dc-userform">
                   @if (!empty($health_community_img))
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $health_community_img }}'"
                                :img_id="'health_community_img'"
                                :img_name="'health_community_img'"
                                :img_ref="'health_community_img'"
                                :img_hidden_name="'hidden_health_community_img'"
                                :img_hidden_id="'hidden_health_community_img'"
                                :existed_img="'{{$health_community_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/health_community_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$health_community_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $health_community_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $health_community_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'health_community_img'"
                                :img_id="'health_community_img'"
                                :img_name="'health_community_img'"
                                :img_ref="'health_community_img'"
                                :img_hidden_name="'hidden_health_community_img'"
                                :img_hidden_id="'hidden_health_community_img'"
                                :url="'{{ url("media/upload-temp-image/settings/health_community_img") }}'"
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
