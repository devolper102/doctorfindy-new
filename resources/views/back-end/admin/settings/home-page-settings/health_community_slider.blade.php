{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform dc-dbsectionspace', 'id'=>'health-community-slider-form', '@submit.prevent'=>'submitHealthCommunitySlider']) !!}
<div class="dc-securitysettings dc-hwtabsinfo">
    <div class="dc-tabscontenttitle la-switch-option">
        <h3>{{ trans('Health Community Slider') }}</h3>
        <div class="float-right">
            <switch_button v-model="show_healthtabs">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
            <input type="hidden" :value="show_healthtabs" name="show_healthtabs">
        </div>
    </div>
    <div class="dc-sidepadding dc-tabsinfo">
        <div class="dc-formtheme dc-userform">
            <fieldset class="how-it-tab-area">
                @if (!empty($health_community_slider))
                    @php $counter = 0; @endphp
                    @foreach ($health_community_slider as $key => $value)
                        <div class="wrap-healthtabs-icons dc-haslayout">
                            <div class="form-group-holder">
                                <div class="form-group form-group-half">
                                    {!! Form::text('tabs['.$counter.'][title]', e($value->title),
                                    ['class' => 'form-control', 'placeholder' => trans('lang.ph.title')]) !!}
                                </div>
                                <div class="form-group form-group-half">
                                    {!! Form::text('tabs['.$counter.'][subtitle]', e($value->subtitle),
                                    ['class' => 'form-control', 'placeholder' => trans('lang.ph.subtitle')]) !!}
                                </div>
                                <div class="form-group">
                                {!! Form::textarea('tabs['.$counter.'][description]', e($value->description), ['class' =>
                                'form-control','placeholder'=>trans('lang.ph.desc')]) !!}
                             </div>
                                <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
                                    <div class = "dc-formtheme dc-userform">
                                         @if (!empty($value->health_img))
                                            <upload-media
                                            :img="'{{{ $value->health_img }}}'"
                                            :img_id="'health_img-{{{ $counter }}}'"
                                            :img_name="'tabs[{{{ $counter }}}][health_img]'"
                                            :img_ref="'health_img-{{{ $counter }}}'"
                                            :img_hidden_name="'tabs[{{{ $counter }}}][health_img]'"
                                            :img_hidden_id="'hidden_health_img-{{{ $counter }}}'"
                                            :existed_img="'{{ $value->health_img }}'"
                                            :url="'{{ url("media/upload-temp-image/settings/tabs.$counter.health_img") }}'"
                                            :existing_img_url="'{{ url("uploads/settings/home/".$value->health_img) }}'"
                                            :size = "'{{ Helper::getImageDetail( $value->health_img, 'size', 'uploads/settings/home') }}'"
                                            :existing_img_name = "'{{ Helper::getImageDetail( $value->health_img, 'name', 'uploads/settings/home') }}'"
                                            >
                                            </upload-media>
                                        @else
                                    
                                            <upload-media
                                        :img="'tabs[0][health_img]'"
                                        :img_id="'health_img-0'"
                                        :img_name="'tabs[0][health_img]'"
                                        :img_ref="'health_img-0'"
                                        :img_hidden_name="'tabs[0][health_img]'"
                                        :img_hidden_id="'hidden_health_img-0'"
                                        :url="'{{ url("media/upload-temp-image/settings/tabs.0.health_img") }}'"
                                        >
                                        </upload-media>
                                         @endif
                                    </div>
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
    cursor: pointer;" @click="addhealthTab"><i class="fa fa-plus"></i>{{ trans('lang.add_more') }}</span>
                                    @else
                                        <span class="dc-addinfobtn dc-deleteinfo delete-healthtab" style="display: inline-block;
    vertical-align: middle;
    line-height: 50px;
    min-width: 50px;
    padding: 0 20px;
    text-align: center;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;"data-check="{{{ $counter }}}">
                                            <i class="fa fa-trash"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @php $counter++; @endphp
                    @endforeach
                @else
                    <div class="wrap-healthtabs-icons dc-haslayout">
                        <div class="form-group-holder">
                            <div class="form-group form-group-half">
                                {!! Form::text('tabs[0][title]', null, ['class' => 'form-control',
                                'placeholder' => trans('lang.ph.btn_title')]) !!}
                            </div>
                            <div class="form-group form-group-half">
                                {!! Form::text('tabs[0][subtitle]', null, ['class' => 'form-control',
                                'placeholder' => trans('lang.ph.btn_url')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::textarea('tabs[0][description]',  null, ['class' =>
                                'form-control','placeholder'=>trans('lang.ph.desc')]) !!}
                             </div>
                            <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
                                <div class = "dc-formtheme dc-userform">
                                     @if (!empty($health_img))
                                        <upload-media
                                        :img="'{{ $health_img }}'"
                                        :img_id="'health_img-0'"
                                        :img_name="'tabs[0][health_img]'"
                                        :img_ref="'health_img-0'"
                                        :img_hidden_name="'tabs[0][health_img]'"
                                        :img_hidden_id="'hidden_health_img-0'"
                                        :existed_img="'{{$health_img}}'"
                                        :url="'{{ url("media/upload-temp-image/settings/tabs.0.health_img") }}'"
                                        :existing_img_url="'{{ url("uploads/settings/home/$health_img") }}'"
                                        >
                                        </upload-media>
                                    @else
                                    <upload-media
                                        :img="'tabs[0][health_img]'"
                                        :img_id="'health_img-0'"
                                        :img_name="'tabs[0][health_img]'"
                                        :img_ref="'health_img-0'"
                                        :img_hidden_name="'tabs[0][health_img]'"
                                        :img_hidden_id="'hidden_health_img-0'"
                                        :url="'{{ url("media/upload-temp-image/settings/tabs.0.health_img") }}'"
                                        >
                                        </upload-media>
                                     @endif
                                </div>
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
    cursor: pointer;" @click="addhealthTab"><i class="fa fa-plus"></i>{{ trans('lang.add_more') }}</span>
                        </div>
                    </div>
                @endif
                <div class="wrap-healthtabs-icons dc-haslayout" v-for="(healthtab, index) in healthtabs" ref="howlistelement" v-cloak>
                    <div class="form-group-holder">
                        <div class="form-group form-group-half">
                            <input placeholder="{{{trans('Title')}}}" v-bind:name="'tabs['+[healthtab.count]+'][title]'" type="text" class="form-control"
                                v-model="healthtab.btn_title">
                        </div>
                        <div class="form-group form-group-half">
                            <input placeholder="{{{trans('Subtitle')}}}" v-bind:name="'tabs['+[healthtab.count]+'][subtitle]'" type="text" class="form-control"
                                v-model="healthtab.btn_url">
                        </div>
                        <div class="form-group">
                            <textarea placeholder="{{{trans('Description')}}}" v-bind:name="'tabs['+[healthtab.count]+'][description]'" type="text" class="form-control"
                                v-model="healthtab.description"></textarea>
                        </div>
                        <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
                            <div class = "dc-formtheme dc-userform">
                                <upload-media
                                    :img="'health_img'"
                                    :img_id="'health_img-'+healthtab.count"
                                    :img_name="'tabs['+[healthtab.count]+'][health_img]'"
                                    :img_ref="'health_img-'+healthtab.count"
                                    :img_hidden_name="'tabs['+[healthtab.count]+'][health_img]'"
                                    :img_hidden_id="'hidden_health_img-'+healthtab.count"
                                    :url="'{{ url("media/upload-temp-image/settings/tabs.'+[healthtab.count]+'.health_img") }}'"
                                    >
                                </upload-media>
                            </div>
                        </div>
                        <div class="form-group dc-rightarea">
                            <span class="dc-addinfo dc-deleteinfo dc-addinfobtn" @click="removehealthTab(index)"><i class="fa fa-trash"></i></span>
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
