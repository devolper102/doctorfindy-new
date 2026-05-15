{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform dc-dbsectionspace', 'id'=>'home-hwtabs-section-form', '@submit.prevent'=>'submitHwTabSectionSettings']) !!}
<div class="dc-securitysettings dc-hwtabsinfo">
    <div class="dc-tabscontenttitle la-switch-option">
        <h3>{{ trans('lang.hw_section_tabs') }}</h3>
        <div class="float-right">
            <switch_button v-model="show_how_work_tabs">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
            <input type="hidden" :value="show_how_work_tabs" name="show_how_work_tabs">
        </div>
    </div>
           
    <div class="dc-sidepadding dc-tabsinfo">
        <div class="dc-formtheme dc-userform">
            <fieldset class="how-it-tab-area">
                @if (!empty($home_how_works_tabs))
                    @php $counter = 0; @endphp
            <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
            <div class = "dc-formtheme dc-userform">
                     @if (!empty($home_how_works_tabs->hidden_how_it_works_img))
                     @php
                        $how_it_works_img = $home_how_works_tabs->hidden_how_it_works_img;
                     @endphp
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'{{ $how_it_works_img }}'"
                                :img_id="'how_it_works_img'"
                                :img_name="'how_it_works_img'"
                                :img_ref="'how_it_works_img'"
                                :img_hidden_name="'hidden_how_it_works_img'"
                                :img_hidden_id="'hidden_how_it_works_img'"
                                :existed_img="'{{$how_it_works_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/how_it_works_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$how_it_works_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $how_it_works_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $how_it_works_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Side Bar Image') }}'"
                                :img="'how_it_works_img'"
                                :img_id="'how_it_works_img'"
                                :img_name="'how_it_works_img'"
                                :img_ref="'how_it_works_img'"
                                :img_hidden_name="'hidden_how_it_works_img'"
                                :img_hidden_id="'hidden_how_it_works_img'"
                                :url="'{{ url("media/upload-temp-image/settings/how_it_works_img") }}'"
                                >
                                </upload-media>
                            @endif
                        </div>
                     </div>
                    @foreach ($home_how_works_tabs->tabs as $key => $value)
                        <div class="wrap-hwtabs-icons dc-haslayout">
                            <div class="form-group-holder">
                                <div class="form-group form-group-half">
                                    {!! Form::text('tabs['.$counter.'][title]', e($value->title),
                                    ['class' => 'form-control', 'placeholder' => trans('lang.ph.title')]) !!}
                                </div>
                                <div class="form-group form-group-half">
                                    {!! Form::text('tabs['.$counter.'][subtitle]', e($value->subtitle),
                                    ['class' => 'form-control', 'placeholder' => trans('lang.ph.subtitle')]) !!}
                                </div>
                                 <div class="form-group form-group-half">
                                    {!! Form::text('tabs['.$counter.'][btn_title]', e($value->btn_title),
                                    ['class' => 'form-control', 'placeholder' => trans('lang.ph.btn_title')]) !!}
                                </div>
                                 <div class="form-group form-group-half">
                                    {!! Form::text('tabs['.$counter.'][btn_url]', e($value->btn_url),
                                    ['class' => 'form-control', 'placeholder' => trans('lang.ph.btn_url')]) !!}
                                </div>
                           
                                <div class="form-group dc-rightarea">
                                    @if ($key == 0 )
                                        <span class="dc-addinfobtn" @click="addHwTab"><i class="fa fa-plus"></i></span>
                                    @else
                                        <span class="dc-addinfobtn dc-deleteinfo delete-hwtab" data-check="{{{ $counter }}}">
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
                                :img="'how_it_works_img'"
                                :img_id="'how_it_works_img'"
                                :img_name="'how_it_works_img'"
                                :img_ref="'how_it_works_img'"
                                :img_hidden_name="'hidden_how_it_works_img'"
                                :img_hidden_id="'hidden_how_it_works_img'"
                                :url="'{{ url("media/upload-temp-image/settings/how_it_works_img") }}'"
                                >
                                </upload-media>
                            </div>
                        </div>
                    <div class="wrap-hwtabs-icons dc-haslayout">
                        <div class="form-group-holder">
                            <div class="form-group form-group-half">
                                {!! Form::text('tabs[0][title]', null, ['class' => 'form-control',
                                'placeholder' => trans('lang.ph.title')]) !!}
                            </div>
                            <div class="form-group form-group-half">
                                {!! Form::text('tabs[0][subtitle]', null, ['class' => 'form-control',
                                'placeholder' => trans('lang.ph.subtitle')]) !!}
                            </div>
                             <div class="form-group form-group-half">
                                {!! Form::text('tabs[0][btn_title]', null, ['class' => 'form-control',
                                'placeholder' => trans('lang.ph.btn_title')]) !!}
                            </div>
                             <div class="form-group form-group-half">
                                {!! Form::text('tabs[0][btn_url]', null, ['class' => 'form-control',
                                'placeholder' => trans('lang.ph.btn_url')]) !!}
                            </div>
                           
                        </div>
                        <div class="form-group dc-rightarea">
                            <span class="dc-addinfobtn" @click="addHwTab"><i class="fa fa-plus"></i></span>
                        </div>
                    </div>
                @endif

                <div class="wrap-hwtabs-icons dc-haslayout" v-for="(hwtab, index) in hwtabs" ref="howlistelement" v-cloak>
                    <div class="form-group-holder">
                        <div class="form-group form-group-half">
                            <input placeholder="{{{trans('lang.ph.title')}}}" v-bind:name="'tabs['+[hwtab.count]+'][title]'" type="text" class="form-control"
                                v-model="hwtab.tab_title">
                        </div>
                        <div class="form-group form-group-half">
                            <input placeholder="{{{trans('lang.ph.subtitle')}}}" v-bind:name="'tabs['+[hwtab.count]+'][subtitle]'" type="text" class="form-control"
                                v-model="hwtab.tab_subtitle">
                        </div>
                         <div class="form-group form-group-half">
                            <input placeholder="{{{trans('lang.ph.btn_title')}}}" v-bind:name="'tabs['+[hwtab.count]+'][btn_title]'" type="text" class="form-control"
                                v-model="hwtab.btn_title">
                        </div>
                         <div class="form-group form-group-half">
                            <input placeholder="{{{trans('lang.ph.btn_url')}}}" v-bind:name="'tabs['+[hwtab.count]+'][btn_url]'" type="text" class="form-control"
                                v-model="hwtab.btn_url">
                        </div>
                    
                        <div class="form-group dc-rightarea">
                            <span class="dc-addinfo dc-deleteinfo dc-addinfobtn" @click="removeHwTab(index)"><i class="fa fa-trash"></i></span>
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
