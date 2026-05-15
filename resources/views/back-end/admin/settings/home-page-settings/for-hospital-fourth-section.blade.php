{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'for_hospital_fourth_section_form', '@submit.prevent'=>'submitForHospitalFourthSection'])!!}
    <div class="dc-securitysettings dc-search-banner-settings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('For Hospital Fourth Section') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_for_hospital_fourth_section_sec">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_for_hospital_fourth_section_sec" name="show_for_hospital_fourth_section_sec">
            </div>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset class="how-it-tab-areas">
         
                    
                    <div class="form-group">
                        {!! Form::textarea('description', !empty($for_hospital_fourth_section_description) ? e($for_hospital_fourth_section_description) : null, ['class' =>
                            'form-control','placeholder'=>trans('Description')]) !!}
                    </div>
                   
                  <div class="dc-settingscontent dc-dbsectionspace  upload-imgresizehold">
                        <div class="dc-formtheme dc-userform">
                                 @if (!empty($for_hospital_fourth_section_img))
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $for_hospital_fourth_section_img }}'"
                                :img_id="'for_hospital_fourth_section_img'"
                                :img_name="'for_hospital_fourth_section_img'"
                                :img_ref="'for_hospital_fourth_section_img'"
                                :img_hidden_name="'hidden_for_hospital_fourth_section_img'"
                                :img_hidden_id="'hidden_for_hospital_fourth_section_img'"
                                :existed_img="'{{$for_hospital_fourth_section_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/for_hospital_fourth_section_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$for_hospital_fourth_section_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $for_hospital_fourth_section_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $for_hospital_fourth_section_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'for_hospital_fourth_section_img'"
                                :img_id="'for_hospital_fourth_section_img'"
                                :img_name="'for_hospital_fourth_section_img'"
                                :img_ref="'for_hospital_fourth_section_img'"
                                :img_hidden_name="'hidden_for_hospital_fourth_section_img'"
                                :img_hidden_id="'hidden_for_hospital_fourth_section_img'"
                                :url="'{{ url("media/upload-temp-image/settings/for_hospital_fourth_section_img/banner_img") }}'"
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
