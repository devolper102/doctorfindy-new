{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform dc-dbsectionspace', 'id'=>'for_labs_benefits_of_knockdoc_form', '@submit.prevent'=>'submitForLabsBenefitsOfKnockdoc']) !!}
<div class="dc-securitysettings dc-hwtabsinfo">
    <div class="dc-tabscontenttitle la-switch-option">
        <h3>{{ trans('For Labs Benefits Of DoctorFindy') }}</h3>
        <div class="float-right">
            <switch_button v-model="show_for_labs_benefits_of_knockdoc_sec">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
            <input type="hidden" :value="show_for_labs_benefits_of_knockdoc_sec" name="show_for_labs_benefits_of_knockdoc_sec">
        </div>
    </div>
    <div class="dc-sidepadding dc-tabsinfo">
        <div class="dc-formtheme dc-userform">
            <fieldset class="how-it-tab-area">
                @if (!empty($for_labs_benefits_of_knockdoc))
                    @php $counter = 0; @endphp
                    @foreach ($for_labs_benefits_of_knockdoc as $key => $value)
                        <div class="wrap-for-labs-benefits-icons dc-haslayout">
                            <div class="form-group-holder">
                                <div class="form-group">
                                    {!! Form::text('for_labs_tabs['.$counter.'][title]', e($value->title),
                                    ['class' => 'form-control', 'placeholder' => trans('lang.ph.title')]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::text('for_labs_tabs['.$counter.'][subtitle]', e($value->subtitle),
                                    ['class' => 'form-control', 'placeholder' => trans('lang.ph.subtitle')]) !!}
                                </div>
                                <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
                                    <div class = "dc-formtheme dc-userform">
                                         @if (!empty($value->for_labs_tab_img))
                                            <upload-media
                                            :img="'{{{ $value->for_labs_tab_img }}}'"
                                            :img_id="'for_labs_tab_img-{{{ $counter }}}'"
                                            :img_name="'for_labs_tabs[{{{ $counter }}}][for_labs_tab_img]'"
                                            :img_ref="'for_labs_tab_img-{{{ $counter }}}'"
                                            :img_hidden_name="'for_labs_tabs[{{{ $counter }}}][for_labs_tab_img]'"
                                            :img_hidden_id="'hidden_for_labs_tab_img-{{{ $counter }}}'"
                                            :existed_img="'{{ $value->for_labs_tab_img }}'"
                                            :url="'{{ url("media/upload-temp-image/settings/for_labs_tabs.$counter.tab_img") }}'"
                                            :existing_img_url="'{{ url("uploads/settings/home/".$value->for_labs_tab_img) }}'"
                                            :size = "'{{ Helper::getImageDetail( $value->for_labs_tab_img, 'size', 'uploads/settings/home') }}'"
                                            :existing_img_name = "'{{ Helper::getImageDetail( $value->for_labs_tab_img, 'name', 'uploads/settings/home') }}'"
                                            >
                                            </upload-media>
                                        @else
                                            <upload-media
                                            :img="'for_labs_tabs[{{{ $counter }}}][for_labs_tab_img]'"
                                            :img_id="'for_labs_tab_img-{{{ $counter }}}'"
                                            :img_name="'for_labs_tabs[{{{ $counter }}}][for_labs_tab_img]'"
                                            :img_ref="'for_labs_tab_img-{{{ $counter }}}'"
                                            :img_hidden_name="'for_labs_tabs[{{{ $counter }}}][for_labs_tab_img]'"
                                            :img_hidden_id="'hidden_for_labs_tab_img-{{{ $counter }}}'"
                                            :url="'{{ url("media/upload-temp-image/settings/tabs.$counter.for_labs_tab_img]") }}'"
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
    cursor: pointer;" @click="addForLabsBenefitsOfKnockdo"c><i class="fa fa-plus"></i>{{ trans('lang.add_more') }}</span>
                                    @else
                                        <span class="dc-addinfobtn dc-deleteinfo delete-for-labs-benefits" style="display: inline-block;
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
                    <div class="wrap-for-labs-benefits-icons dc-haslayout">
                        <div class="form-group-holder">
                            <div class="form-group form-group-half">
                                {!! Form::text('for_labs_tabs[0][title]', null, ['class' => 'form-control',
                                'placeholder' => trans('lang.ph.btn_title')]) !!}
                            </div>
                            <div class="form-group form-group-half">
                                {!! Form::text('for_labs_tabs[0][subtitle]', null, ['class' => 'form-control',
                                'placeholder' => trans('lang.ph.btn_url')]) !!}
                            </div>
                            <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
                                <div class = "dc-formtheme dc-userform">
                                     @if (!empty($for_labs_hw_tab_img))
                                        <upload-media
                                        :img="'{{ $for_labs_hw_tab_img }}'"
                                        :img_id="'for_labs_tab_img-0'"
                                        :img_name="'for_labs_tabs[0][for_labs_tab_img]'"
                                        :img_ref="'for_labs_tab_img-0'"
                                        :img_hidden_name="'for_labs_tabs[0][for_labs_tab_img]'"
                                        :img_hidden_id="'hidden_for_labs_tab_img-0'"
                                        :existed_img="'{{$for_labs_hw_tab_img}}'"
                                        :url="'{{ url("media/upload-temp-image/settings/for_labs_tabs.0.for_labs_tab_img") }}'"
                                        :existing_img_url="'{{ url("uploads/settings/home/$for_labs_hw_tab_img") }}'"
                                        >
                                        </upload-media>
                                    @else
                                        <upload-media
                                        :img="'for_labs_tabs[0][for_labs_tab_img]'"
                                        :img_id="'for_labs_tab_img-0'"
                                        :img_name="'for_labs_tabs[0][for_labs_tab_img]'"
                                        :img_ref="'for_labs_tab_img-0'"
                                        :img_hidden_name="'for_labs_tabs[0][for_labs_tab_img]'"
                                        :img_hidden_id="'hidden_for_labs_tab_img-0'"
                                        :url="'{{ url("media/upload-temp-image/settings/for_labs_tabs.0.for_labs_tab_img") }}'"
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
    cursor: pointer;" @click="addForLabsBenefitsOfKnockdoc"><i class="fa fa-plus"></i>{{ trans('lang.add_more') }}</span>
                        </div>
                    </div>
                @endif
                <div class="wrap-for-labs-benefits-icons dc-haslayout" v-for="(for_labs_benefits, index) in for_labs_benefits_of_knockdoc" ref="howlistelement" v-cloak>
                    <div class="form-group-holder">
                        <div class="form-group form-group-half">
                            <input placeholder="{{{trans('lang.ph.btn_title')}}}" v-bind:name="'for_labs_tabs['+[for_labs_benefits.count]+'][title]'" type="text" class="form-control"
                                v-model="for_labs_benefits.btn_title">
                        </div>
                        <div class="form-group form-group-half">
                            <input placeholder="{{{trans('lang.ph.btn_url')}}}" v-bind:name="'for_labs_tabs['+[for_labs_benefits.count]+'][subtitle]'" type="text" class="form-control"
                                v-model="for_labs_benefits.btn_url">
                        </div>
                        <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
                            <div class = "dc-formtheme dc-userform">
                                <upload-media
                                    :img="'for_labs_tab_img'"
                                    :img_id="'for_labs_tab_img-'+for_labs_benefits.count"
                                    :img_name="'for_labs_tabs['+[for_labs_benefits.count]+'][for_labs_tab_img]'"
                                    :img_ref="'for_labs_tab_img-'+for_labs_benefits.count"
                                    :img_hidden_name="'for_labs_tabs['+[for_labs_benefits.count]+'][for_labs_tab_img]'"
                                    :img_hidden_id="'hidden_for_labs_tab_img-'+for_labs_benefits.count"
                                    :url="'{{ url("media/upload-temp-image/settings/for_labs_tabs.'+[for_labs_benefits.count]+'.for_labs_tab_img") }}'"
                                    >
                                </upload-media>
                            </div>
                        </div>
                        <div class="form-group dc-rightarea">
                            <span class="dc-addinfo dc-deleteinfo dc-addinfobtn" @click="removeForLabsBenefitsOfKnockdoc(index)"><i class="fa fa-trash"></i></span>
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
