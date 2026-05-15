{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'procedure_banner_sectionform', '@submit.prevent'=>'submitProcedureBannerSection'])!!}
    <div class="dc-securitysettings dc-search-banner-settings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('Procedure Banner Section') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_procedure_banner_sec">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_procedure_banner_sec" name="show_procedure_banner_sec">
            </div>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset class="how-it-tab-areas">
         
                    <div class="form-group">
                        {!! Form::text('heading', !empty($procedure_banner_heading) ? e($procedure_banner_heading) : null, ['class' =>
                            'form-control','placeholder'=>trans('Heading')]) !!}
                    </div>
                   
                  <div class="dc-settingscontent dc-dbsectionspace  upload-imgresizehold">
                        <div class="dc-formtheme dc-userform">
                                 @if (!empty($procedure_banner_img))
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $procedure_banner_img }}'"
                                :img_id="'procedure_banner_img'"
                                :img_name="'procedure_banner_img'"
                                :img_ref="'procedure_banner_img'"
                                :img_hidden_name="'hidden_procedure_banner_img'"
                                :img_hidden_id="'hidden_procedure_banner_img'"
                                :existed_img="'{{$procedure_banner_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/procedure_banner_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$procedure_banner_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $procedure_banner_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $procedure_banner_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'procedure_banner_img'"
                                :img_id="'procedure_banner_img'"
                                :img_name="'procedure_banner_img'"
                                :img_ref="'procedure_banner_img'"
                                :img_hidden_name="'hidden_procedure_banner_img'"
                                :img_hidden_id="'hidden_procedure_banner_img'"
                                :url="'{{ url("media/upload-temp-image/settings/procedure_banner_img/banner_img") }}'"
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
