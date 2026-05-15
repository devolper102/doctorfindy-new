{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'for_hospital_knockdoc_tool_form', '@submit.prevent'=>'submitForHospitalKnockdocTool'])!!}
    <div class="dc-securitysettings dc-search-banner-settings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('For Hospital DoctorFindy Tool Section') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_for_hospital_knockdoc_tool_sec">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_for_hospital_knockdoc_tool_sec" name="show_for_hospital_knockdoc_tool_sec">
            </div>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset class="how-it-tab-areas">
         
                    <div class="form-group">
                        {!! Form::text('heading', !empty($for_hospital_knockdoc_tool_heading) ? e($for_hospital_knockdoc_tool_heading) : null, ['class' =>
                            'form-control','placeholder'=>trans('Heading')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::textarea('description', !empty($for_hospital_knockdoc_tool_description) ? e($for_hospital_knockdoc_tool_description) : null, ['class' =>
                            'form-control','placeholder'=>trans('Description')]) !!}
                    </div>
                   
                  <div class="dc-settingscontent dc-dbsectionspace  upload-imgresizehold">
                        <div class="dc-formtheme dc-userform">
                                 @if (!empty($for_hospital_knockdoc_tool_img))
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $for_hospital_knockdoc_tool_img }}'"
                                :img_id="'for_hospital_knockdoc_tool_img'"
                                :img_name="'for_hospital_knockdoc_tool_img'"
                                :img_ref="'for_hospital_knockdoc_tool_img'"
                                :img_hidden_name="'hidden_for_hospital_knockdoc_tool_img'"
                                :img_hidden_id="'hidden_for_hospital_knockdoc_tool_img'"
                                :existed_img="'{{$for_hospital_knockdoc_tool_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/for_hospital_knockdoc_tool_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$for_hospital_knockdoc_tool_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $for_hospital_knockdoc_tool_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $for_hospital_knockdoc_tool_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'for_hospital_knockdoc_tool_img'"
                                :img_id="'for_hospital_knockdoc_tool_img'"
                                :img_name="'for_hospital_knockdoc_tool_img'"
                                :img_ref="'for_hospital_knockdoc_tool_img'"
                                :img_hidden_name="'hidden_for_hospital_knockdoc_tool_img'"
                                :img_hidden_id="'hidden_for_hospital_knockdoc_tool_img'"
                                :url="'{{ url("media/upload-temp-image/settings/for_hospital_knockdoc_tool_img/banner_img") }}'"
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
