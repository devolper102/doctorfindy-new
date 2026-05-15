{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'about_us_banner_form', '@submit.prevent'=>'submitAboutUsBannerSection'])!!}
    <div class="dc-securitysettings dc-search-banner-settings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('About Us Banner Section') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_about_us_banner_sec">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_about_us_banner_sec" name="show_about_us_banner_sec">
            </div>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset class="how-it-tab-areas">
         
                    <div class="form-group">
                        {!! Form::text('heading', !empty($about_us_banner_heading) ? e($about_us_banner_heading) : null, ['class' =>
                            'form-control','placeholder'=>trans('Heading')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('description', !empty($about_us_banner_description) ? e($about_us_banner_description) : null, ['class' =>
                            'form-control','placeholder'=>trans('Description')]) !!}
                    </div>
                   
                  <div class="dc-settingscontent dc-dbsectionspace  upload-imgresizehold">
                        <div class="dc-formtheme dc-userform">
                                 @if (!empty($about_us_banner_img))
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $about_us_banner_img }}'"
                                :img_id="'about_us_banner_img'"
                                :img_name="'about_us_banner_img'"
                                :img_ref="'about_us_banner_img'"
                                :img_hidden_name="'hidden_about_us_banner_img'"
                                :img_hidden_id="'hidden_about_us_banner_img'"
                                :existed_img="'{{$about_us_banner_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/about_us_banner_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$about_us_banner_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $about_us_banner_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $about_us_banner_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'about_us_banner_img'"
                                :img_id="'about_us_banner_img'"
                                :img_name="'about_us_banner_img'"
                                :img_ref="'about_us_banner_img'"
                                :img_hidden_name="'hidden_about_us_banner_img'"
                                :img_hidden_id="'hidden_about_us_banner_img'"
                                :url="'{{ url("media/upload-temp-image/settings/about_us_banner_img/banner_img") }}'"
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
