{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'home-banner_video_section', '@submit.prevent'=>'submitBannerVideoSection'])!!}
    <div class="dc-securitysettings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('Practice Doctor Banner Section') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_bannervide_sec">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_bannervide_sec" name="show_bannervide_sec">
            </div>
        </div>
        <div class="dc-settingscontent dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('title', !empty($banner_video_sec_title) ? e($banner_video_sec_title) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.title')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('heading', !empty($banner_video_sec_heading) ? e($banner_video_sec_heading) : null, ['class' =>
                            'form-control','placeholder'=>trans('Heading')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('description', !empty($banner_video_sec_desc) ? e($banner_video_sec_desc) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.desc')]) !!}
                    </div>
                    
                    <div class="form-group ">
                        {!! Form::text('url', !empty($banner_video_sec_url) ? e($banner_video_sec_url) : null, ['class' =>
                            'form-control','placeholder'=>trans('URL')]) !!}
                    </div>
                </fieldset>
            </div>
        </div>
         <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
            <div class = "dc-formtheme dc-userform">
                   @if (!empty($banner_section_img))
                                     <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $banner_section_img }}'"
                                :img_id="'banner_section_img'"
                                :img_name="'banner_section_img'"
                                :img_ref="'banner_section_img'"
                                :img_hidden_name="'hidden_banner_section_img'"
                                :img_hidden_id="'hidden_banner_section_img'"
                                :existed_img="'{{$banner_section_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/banner_section_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$banner_section_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $banner_section_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $banner_section_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'banner_section_img'"
                                :img_id="'banner_section_img'"
                                :img_name="'banner_section_img'"
                                :img_ref="'banner_section_img'"
                                :img_hidden_name="'hidden_banner_section_img'"
                                :img_hidden_id="'hidden_banner_section_img'"
                                :url="'{{ url("media/upload-temp-image/settings/banner_section_img") }}'"
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
