{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform dc-dbsectionspace', 'id'=>'home-onlinedoctortabs-section-form', '@submit.prevent'=>'benefitsOnlineDoctor']) !!}
<div class="dc-securitysettings dc-hwtabsinfo">
    <div class="dc-tabscontenttitle la-switch-option">
        <h3>{{ 'Benefits of Online Consultation a Doctor' }}</h3>
        <div class="float-right">
            <switch_button v-model="show_onlinedoctortabs">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
            <input type="hidden" :value="show_onlinedoctortabs" name="show_onlinedoctortabs">
        </div>
    </div>
    <div class="dc-sidepadding dc-tabsinfo">
        <div class="dc-formtheme dc-userform">
            <fieldset class="how-it-tab-areas">
                @if (!empty($benefits_online_doctor))
                    @php $counter = 0; @endphp
            <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
            <div class = "dc-formtheme dc-userform">
                     @if (!empty($benefits_online_doctor->hidden_benefits_onlinedoctor_img))
                     @php
                        $benefits_onlinedoctor_img = $benefits_online_doctor->hidden_benefits_onlinedoctor_img;
                     @endphp
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $benefits_onlinedoctor_img }}'"
                                :img_id="'benefits_onlinedoctor_img'"
                                :img_name="'benefits_onlinedoctor_img'"
                                :img_ref="'benefits_onlinedoctor_img'"
                                :img_hidden_name="'hidden_benefits_onlinedoctor_img'"
                                :img_hidden_id="'hidden_benefits_onlinedoctor_img'"
                                :existed_img="'{{$benefits_onlinedoctor_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/benefits_onlinedoctor_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$benefits_onlinedoctor_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $benefits_onlinedoctor_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $benefits_onlinedoctor_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'benefits_onlinedoctor_img'"
                                :img_id="'benefits_onlinedoctor_img'"
                                :img_name="'benefits_onlinedoctor_img'"
                                :img_ref="'benefits_onlinedoctor_img'"
                                :img_hidden_name="'hidden_benefits_onlinedoctor_img'"
                                :img_hidden_id="'hidden_benefits_onlinedoctor_img'"
                                :url="'{{ url("media/upload-temp-image/settings/benefits_onlinedoctor_img") }}'"
                                >
                                </upload-media>
                            @endif
                        </div>
                     </div>
                    @foreach ($benefits_online_doctor->tabs as $key => $value)
                  

                        <div class="wrap-onlinedoctortabs-icons dc-haslayout">
                            <div class="form-group-holder">
                                <div class="form-group form-group-half">
                                    {!! Form::text('tabs['.$counter.'][title]', e($value->title),
                                    ['class' => 'form-control', 'placeholder' => trans('lang.ph.title')]) !!}
                                </div>
                                <div class="form-group form-group-half">
                                    {!! Form::text('tabs['.$counter.'][subtitle]', e($value->subtitle),
                                    ['class' => 'form-control', 'placeholder' => trans('lang.ph.subtitle')]) !!}
                                </div>
                                
                           
                                <div class="form-group dc-rightarea">
                                    @if ($key == 0 )
                                        <span class="dc-addinfobtn"style="display: inline-block;
    vertical-align: middle;
    line-height: 50px;
    min-width: 50px;
    padding: 0 20px;
    text-align: center;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;" @click="addonlinedoctorTab"><i class="fa fa-plus"></i></span>
                                    @else
                                        <span class="dc-addinfobtn dc-deleteinfo delete-onlinedoctortab"style="display: inline-block;
    vertical-align: middle;
    line-height: 50px;
    min-width: 50px;
    padding: 0 20px;
    text-align: center;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;" data-check="{{{ $counter }}}">
                                            <i class="fa fa-trash"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @php $counter++; @endphp
                    @endforeach
                @else
                     <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
                            <div class = "dc-formtheme dc-userform">
                               <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'benefits_onlinedoctor_img'"
                                :img_id="'benefits_onlinedoctor_img'"
                                :img_name="'benefits_onlinedoctor_img'"
                                :img_ref="'benefits_onlinedoctor_img'"
                                :img_hidden_name="'hidden_benefits_onlinedoctor_img'"
                                :img_hidden_id="'hidden_benefits_onlinedoctor_img'"
                                :url="'{{ url("media/upload-temp-image/settings/benefits_onlinedoctor_img") }}'"
                                >
                                </upload-media>
                            </div>
                        </div>
                    <div class="wrap-onlinedoctortabs-icons dc-haslayout">
                        <div class="form-group-holder">
                            <div class="form-group form-group-half">
                                {!! Form::text('tabs[0][title]', null, ['class' => 'form-control',
                                'placeholder' => trans('lang.ph.title')]) !!}
                            </div>
                            <div class="form-group form-group-half">
                                {!! Form::text('tabs[0][subtitle]', null, ['class' => 'form-control',
                                'placeholder' => trans('lang.ph.subtitle')]) !!}
                            </div>
                        </div>
                        
                        <div class="form-group dc-rightarea">
                            <span class="dc-addinfobtn"style="display: inline-block;
    vertical-align: middle;
    line-height: 50px;
    min-width: 50px;
    padding: 0 20px;
    text-align: center;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;" @click="addonlinedoctorTab"><i class="fa fa-plus"></i></span>
                        </div>
                    </div>
                @endif

                <div class="wrap-onlinedoctortabs-icons dc-haslayout" v-for="(onlinedoctortab, index) in onlinedoctortabs" ref="howlistelements" v-cloak>
                    <div class="form-group-holder">
                        <div class="form-group form-group-half">
                            <input placeholder="{{{trans('lang.ph.title')}}}" v-bind:name="'tabs['+[onlinedoctortab.count]+'][title]'" type="text" class="form-control"
                                v-model="onlinedoctortab.tab_title">
                        </div>
                        <div class="form-group form-group-half">
                            <input placeholder="{{{trans('lang.ph.subtitle')}}}" v-bind:name="'tabs['+[onlinedoctortab.count]+'][subtitle]'" type="text" class="form-control"
                                v-model="onlinedoctortab.tab_subtitle">
                        </div>
                        <div class="form-group dc-rightarea">
                            <span class="dc-addinfo dc-deleteinfo dc-addinfobtn" @click="removeOnlinedoctorTab(index)"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}
