{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'small_devices_top_section', '@submit.prevent'=>'submitSmallDeviceSection'])!!}
    <div class="dc-securitysettings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('Small Devices Top Section') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_smalldevice_sec">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_smalldevice_sec" name="show_smalldevice_sec">
            </div>
        </div>
        <div class="dc-settingscontent dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('title', !empty($small_devices_title) ? e($small_devices_title) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.title')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('description', !empty($small_devices_desc) ? e($small_devices_desc) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.desc')]) !!}
                    </div>
                    <div class="form-group form-group-half">
                        {!! Form::text('button', !empty($small_devices_btn) ? e($small_devices_btn) : null, ['class' =>
                            'form-control','placeholder'=>trans('Button')]) !!}
                    </div>
                    <div class="form-group form-group-half">
                        {!! Form::text('url', !empty($small_devices_url) ? e($small_devices_url) : null, ['class' =>
                            'form-control','placeholder'=>trans('URL')]) !!}
                    </div>
                </fieldset>
            </div>
        </div>
         <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
            <div class = "dc-formtheme dc-userform">
                   @if (!empty($small_device_img))
                                     <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $small_device_img }}'"
                                :img_id="'small_device_img'"
                                :img_name="'small_device_img'"
                                :img_ref="'small_device_img'"
                                :img_hidden_name="'hidden_small_device_img'"
                                :img_hidden_id="'hidden_small_device_img'"
                                :existed_img="'{{$small_device_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/small_device_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$small_device_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $small_device_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $small_device_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'small_device_img'"
                                :img_id="'small_device_img'"
                                :img_name="'small_device_img'"
                                :img_ref="'small_device_img'"
                                :img_hidden_name="'hidden_small_device_img'"
                                :img_hidden_id="'hidden_small_device_img'"
                                :url="'{{ url("media/upload-temp-image/settings/small_device_img") }}'"
                                >
                                </upload-media>
                          @endif
                </div>
            </div>
              <div class="dc-settingscontent dc-sidepadding">
                <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('title1', !empty($small_devices_title1) ? e($small_devices_title1) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.title')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('description1', !empty($small_devices_desc1) ? e($small_devices_desc1) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.desc')]) !!}
                    </div>
                    <div class="form-group form-group-half">
                        {!! Form::text('button1', !empty($small_devices_btn1) ? e($small_devices_btn1) : null, ['class' =>
                            'form-control','placeholder'=>trans('Button')]) !!}
                    </div>
                    <div class="form-group form-group-half">
                        {!! Form::text('url1', !empty($small_devices_url1) ? e($small_devices_url1) : null, ['class' =>
                            'form-control','placeholder'=>trans('URL')]) !!}
                    </div>
                </fieldset>
            </div>
        </div>
         <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
            <div class = "dc-formtheme dc-userform">
                   @if (!empty($small_device_img1))
                                     <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $small_device_img1 }}'"
                                :img_id="'small_device_img1'"
                                :img_name="'small_device_img1'"
                                :img_ref="'small_device_img1'"
                                :img_hidden_name="'hidden_small_device_img1'"
                                :img_hidden_id="'hidden_small_device_img1'"
                                :existed_img="'{{$small_device_img1}}'"
                                :url="'{{ url("media/upload-temp-image/settings/small_device_img1") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$small_device_img1") }}'"
                                :size = "'{{ Helper::getImageDetail( $small_device_img1, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $small_device_img1, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'small_device_img1'"
                                :img_id="'small_device_img1'"
                                :img_name="'small_device_img1'"
                                :img_ref="'small_device_img1'"
                                :img_hidden_name="'hidden_small_device_img1'"
                                :img_hidden_id="'hidden_small_device_img1'"
                                :url="'{{ url("media/upload-temp-image/settings/small_device_img1") }}'"
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
