{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'home-signup-section-form', '@submit.prevent'=>'submitSignUpSection'])!!}
    <div class="dc-securitysettings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('Sign Up/In Section') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_signup_sec">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_signup_sec" name="show_signup_sec">
            </div>
        </div>
        <div class="dc-settingscontent dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('title', !empty($sign_up_sec_title) ? e($sign_up_sec_title) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.title')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('description', !empty($sign_up_sec_desc) ? e($sign_up_sec_desc) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.desc')]) !!}
                    </div>
                </fieldset>
            </div>
        </div>
         <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
            <div class = "dc-formtheme dc-userform">
                   @if (!empty($sign_up_img))
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $sign_up_img }}'"
                                :img_id="'sign_up_img'"
                                :img_name="'sign_up_img'"
                                :img_ref="'sign_up_img'"
                                :img_hidden_name="'hidden_sign_up_img'"
                                :img_hidden_id="'hidden_sign_up_img'"
                                :existed_img="'{{$sign_up_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/sign_up_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$sign_up_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $sign_up_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $sign_up_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'sign_up_img'"
                                :img_id="'sign_up_img'"
                                :img_name="'sign_up_img'"
                                :img_ref="'sign_up_img'"
                                :img_hidden_name="'hidden_sign_up_img'"
                                :img_hidden_id="'hidden_sign_up_img'"
                                :url="'{{ url("media/upload-temp-image/settings/sign_up_img") }}'"
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
