{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'city_wise_hospital_form', '@submit.prevent'=>'submitCityWiseHospitalSection'])!!}
    <div class="dc-securitysettings dc-search-banner-settings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('City wise Hospital Banner Section') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_city_wise_hospital_sec">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_city_wise_hospital_sec" name="show_city_wise_hospital_sec">
            </div>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset class="how-it-tab-areas">
         
                    <div class="form-group">
                        {!! Form::text('heading', !empty($city_wise_hospital_heading) ? e($city_wise_hospital_heading) : null, ['class' =>
                            'form-control','placeholder'=>trans('Heading')]) !!}
                    </div>
                   
                  <div class="dc-settingscontent dc-dbsectionspace  upload-imgresizehold">
                        <div class="dc-formtheme dc-userform">
                                 @if (!empty($city_wise_hospital_img))
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $city_wise_hospital_img }}'"
                                :img_id="'city_wise_hospital_img'"
                                :img_name="'city_wise_hospital_img'"
                                :img_ref="'city_wise_hospital_img'"
                                :img_hidden_name="'hidden_city_wise_hospital_img'"
                                :img_hidden_id="'hidden_city_wise_hospital_img'"
                                :existed_img="'{{$city_wise_hospital_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/city_wise_hospital_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$city_wise_hospital_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $city_wise_hospital_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $city_wise_hospital_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'city_wise_hospital_img'"
                                :img_id="'city_wise_hospital_img'"
                                :img_name="'city_wise_hospital_img'"
                                :img_ref="'city_wise_hospital_img'"
                                :img_hidden_name="'hidden_city_wise_hospital_img'"
                                :img_hidden_id="'hidden_city_wise_hospital_img'"
                                :url="'{{ url("media/upload-temp-image/settings/city_wise_hospital_img/banner_img") }}'"
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
