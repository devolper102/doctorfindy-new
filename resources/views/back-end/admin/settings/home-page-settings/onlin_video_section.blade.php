{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'onlin_video_section_form', '@submit.prevent'=>'submitOnlinVideoSection'])!!}
    <div class="dc-securitysettings dc-search-banner-settings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('Online Video Consultation  Banner Section') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_onlin_video_sec">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_onlin_video_sec" name="show_onlin_video_sec">
            </div>
        </div>

        <div class="dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset class="how-it-tab-areas">
         
                    <div class="form-group">
                        {!! Form::text('heading', !empty($onlin_video_heading) ? e($onlin_video_heading) : null, ['class' =>
                            'form-control','placeholder'=>trans('Heading')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('subheading', !empty($onlin_video_subheading) ? e($onlin_video_subheading) : null, ['class' =>
                            'form-control','placeholder'=>trans('Sub Heading')]) !!}
                    </div>
                   
                    <div class="form-group">
                        {!! Form::text('below_title', !empty($onlin_video_below_title) ? e($onlin_video_below_title) : null,['class' =>
                            'form-control','placeholder'=>trans('Below Title')]) !!}
                    </div>
                    <div class="form-group form-group-half">
                        {!! Form::text('btn', !empty($onlin_video_btn) ? e($onlin_video_btn) : null,['class' =>
                            'form-control','placeholder'=>trans('Button')]) !!}
                    </div>
                     <div class="form-group form-group-half">
                        {!! Form::text('url', !empty($onlin_video_url) ? e($onlin_video_url) : null,['class' =>
                            'form-control','placeholder'=>trans('URL')]) !!}
                    </div>
                  <div class="dc-settingscontent dc-dbsectionspace  upload-imgresizehold">
                        <div class="dc-formtheme dc-userform">
                                 @if (!empty($onlin_video_img))
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $onlin_video_img }}'"
                                :img_id="'onlin_video_img'"
                                :img_name="'onlin_video_img'"
                                :img_ref="'onlin_video_img'"
                                :img_hidden_name="'hidden_onlin_video_img'"
                                :img_hidden_id="'hidden_onlin_video_img'"
                                :existed_img="'{{$onlin_video_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/onlin_video_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$onlin_video_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $onlin_video_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $onlin_video_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'onlin_video_img'"
                                :img_id="'onlin_video_img'"
                                :img_name="'onlin_video_img'"
                                :img_ref="'onlin_video_img'"
                                :img_hidden_name="'hidden_onlin_video_img'"
                                :img_hidden_id="'hidden_onlin_video_img'"
                                :url="'{{ url("media/upload-temp-image/settings/onlin_video_img/banner_img") }}'"
                                >
                                </upload-media>
                                 @endif
                        </div>
                    </div>
                 </fieldset>
            </div>
        </div>
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
      
{!! Form::close() !!}
