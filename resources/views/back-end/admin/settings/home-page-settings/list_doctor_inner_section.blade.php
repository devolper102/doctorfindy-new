{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'list-doctor-inner-section-form', '@submit.prevent'=>'submitDoctorInnerSection'])!!}
    <div class="dc-securitysettings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('City Wise List of Doctor Inner Section') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_doctor_inner_section">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_doctor_inner_section" name="show_doctor_inner_section">
            </div>
        </div>
        <div class="dc-settingscontent dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group form-group-half">
                        {!! Form::text('title', !empty($doctor_inner_title) ? e($doctor_inner_title) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.title')]) !!}
                    </div>
                    <div class="form-group form-group-half">
                        {!! Form::text('subtitle', !empty($doctor_inner_subtitle) ? e($doctor_inner_subtitle) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.sub_heading')]) !!}
                    </div>
                      <div class="form-group form-group-half">
                        {!! Form::text('btn', !empty($doctor_inner_btn) ? e($doctor_inner_btn) : null, ['class' =>
                            'form-control','placeholder'=>trans('Button')]) !!}
                    </div>
                      <div class="form-group form-group-half">
                        {!! Form::text('url', !empty($doctor_inner_url) ? e($doctor_inner_url) : null, ['class' =>
                            'form-control','placeholder'=>trans('URL')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('description', !empty($doctor_inner_description) ? e($doctor_inner_description) : null, ['class' =>
                            'form-control','placeholder'=>trans('lang.ph.desc')]) !!}
                    </div>
                </fieldset>
            </div>
        </div>
         <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
            <div class = "dc-formtheme dc-userform">
                   @if (!empty($doctor_inner_img))
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $doctor_inner_img }}'"
                                :img_id="'doctor_inner_img'"
                                :img_name="'doctor_inner_img'"
                                :img_ref="'doctor_inner_img'"
                                :img_hidden_name="'hidden_doctor_inner_img'"
                                :img_hidden_id="'hidden_doctor_inner_img'"
                                :existed_img="'{{$doctor_inner_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/doctor_inner_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$doctor_inner_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $doctor_inner_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $doctor_inner_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'doctor_inner_img'"
                                :img_id="'doctor_inner_img'"
                                :img_name="'doctor_inner_img'"
                                :img_ref="'doctor_inner_img'"
                                :img_hidden_name="'hidden_doctor_inner_img'"
                                :img_hidden_id="'hidden_doctor_inner_img'"
                                :url="'{{ url("media/upload-temp-image/settings/doctor_inner_img") }}'"
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
