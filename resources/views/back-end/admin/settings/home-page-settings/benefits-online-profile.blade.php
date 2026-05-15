{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform dc-dbsectionspace', 'id'=>'home-onlinetabs-section-form', '@submit.prevent'=>'benefitsOnlineProfile']) !!}
<div class="dc-securitysettings dc-hwtabsinfo">
    <div class="dc-tabscontenttitle la-switch-option">
        <h3>{{ 'Benefits of Online DoctorFindy profile' }}</h3>
        <div class="float-right">
            <switch_button v-model="show_onlinetabs">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
            <input type="hidden" :value="show_onlinetabs" name="show_onlinetabs">
        </div>
    </div>
    <div class="dc-sidepadding dc-tabsinfo">
        <div class="dc-formtheme dc-userform">
            <fieldset class="how-it-tab-areas">
                @if (!empty($benefits_online_profile))
                    @php $counter = 0; @endphp
            <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
            <div class = "dc-formtheme dc-userform">
                     @if (!empty($benefits_online_profile->hidden_benefits_online_img))
                     @php
                        $online_profile = $benefits_online_profile->hidden_benefits_online_img;
                     @endphp
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $online_profile }}'"
                                :img_id="'online_profile'"
                                :img_name="'online_profile'"
                                :img_ref="'online_profile'"
                                :img_hidden_name="'hidden_benefits_online_img'"
                                :img_hidden_id="'hidden_benefits_online_img'"
                                :existed_img="'{{$online_profile}}'"
                                :url="'{{ url("media/upload-temp-image/settings/online_profile") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$online_profile") }}'"
                                :size = "'{{ Helper::getImageDetail( $online_profile, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $online_profile, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'benefits_online_img'"
                                :img_id="'benefits_online_img'"
                                :img_name="'benefits_online_img'"
                                :img_ref="'benefits_online_img'"
                                :img_hidden_name="'hidden_benefits_online_img'"
                                :img_hidden_id="'hidden_benefits_online_img'"
                                :url="'{{ url("media/upload-temp-image/settings/benefits_online_img") }}'"
                                >
                                </upload-media>
                            @endif
                        </div>
                     </div>
                    @foreach ($benefits_online_profile->tabs as $key => $value)
                  

                        <div class="wrap-onlinetabs-icons dc-haslayout">
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
    cursor: pointer;" @click="addOnlineTab"><i class="fa fa-plus"></i></span>
                                    @else
                                        <span class="dc-addinfobtn dc-deleteinfo delete-onlinetab"style="display: inline-block;
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
                                :img="'benefits_online_img'"
                                :img_id="'benefits_online_img'"
                                :img_name="'benefits_online_img'"
                                :img_ref="'benefits_online_img'"
                                :img_hidden_name="'hidden_benefits_online_img'"
                                :img_hidden_id="'hidden_benefits_online_img'"
                                :url="'{{ url("media/upload-temp-image/settings/benefits_online_img") }}'"
                                >
                                </upload-media>
                            </div>
                        </div>
                    <div class="wrap-onlinetabs-icons dc-haslayout">
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
    cursor: pointer;" @click="addOnlineTab"><i class="fa fa-plus"></i></span>
                        </div>
                    </div>
                @endif

                <div class="wrap-onlinetabs-icons dc-haslayout" v-for="(onlinetab, index) in onlinetabs" ref="howlistelements" v-cloak>
                    <div class="form-group-holder">
                        <div class="form-group form-group-half">
                            <input placeholder="{{{trans('lang.ph.title')}}}" v-bind:name="'tabs['+[onlinetab.count]+'][title]'" type="text" class="form-control"
                                v-model="onlinetab.tab_title">
                        </div>
                        <div class="form-group form-group-half">
                            <input placeholder="{{{trans('lang.ph.subtitle')}}}" v-bind:name="'tabs['+[onlinetab.count]+'][subtitle]'" type="text" class="form-control"
                                v-model="onlinetab.tab_subtitle">
                        </div>
                        <div class="form-group dc-rightarea">
                            <span class="dc-addinfo dc-deleteinfo dc-addinfobtn" @click="removeOnlineTab(index)"><i class="fa fa-trash"></i></span>
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
