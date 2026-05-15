{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'for_labs_knockdoc_profile_form', '@submit.prevent'=>'submitForLabsKnockdocProfile'])!!}
    <div class="dc-securitysettings dc-search-banner-settings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('For Labs DoctorFindy Profile Section') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_for_labs_knockdoc_profile_sec">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_for_labs_knockdoc_profile_sec" name="show_for_labs_knockdoc_profile_sec">
            </div>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset class="how-it-tab-areas">
         
                    <div class="form-group">
                        {!! Form::text('heading', !empty($for_labs_knockdoc_profile_heading) ? e($for_labs_knockdoc_profile_heading) : null, ['class' =>
                            'form-control','placeholder'=>trans('Heading')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('description', !empty($for_labs_knockdoc_profile_description) ? e($for_labs_knockdoc_profile_description) : null, ['class' =>
                            'form-control','placeholder'=>trans('Description')]) !!}
                    </div>
                   
                  <div class="dc-settingscontent dc-dbsectionspace  upload-imgresizehold">
                        <div class="dc-formtheme dc-userform">
                                 @if (!empty($for_labs_knockdoc_profile_img))
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $for_labs_knockdoc_profile_img }}'"
                                :img_id="'for_labs_knockdoc_profile_img'"
                                :img_name="'for_labs_knockdoc_profile_img'"
                                :img_ref="'for_labs_knockdoc_profile_img'"
                                :img_hidden_name="'hidden_for_labs_knockdoc_profile_img'"
                                :img_hidden_id="'hidden_for_labs_knockdoc_profile_img'"
                                :existed_img="'{{$for_labs_knockdoc_profile_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/for_labs_knockdoc_profile_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$for_labs_knockdoc_profile_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $for_labs_knockdoc_profile_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $for_labs_knockdoc_profile_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'for_labs_knockdoc_profile_img'"
                                :img_id="'for_labs_knockdoc_profile_img'"
                                :img_name="'for_labs_knockdoc_profile_img'"
                                :img_ref="'for_labs_knockdoc_profile_img'"
                                :img_hidden_name="'hidden_for_labs_knockdoc_profile_img'"
                                :img_hidden_id="'hidden_for_labs_knockdoc_profile_img'"
                                :url="'{{ url("media/upload-temp-image/settings/for_labs_knockdoc_profile_img/banner_img") }}'"
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
