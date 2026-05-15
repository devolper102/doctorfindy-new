{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'home-search-banner-form', '@submit.prevent'=>'submitHomeSearchBannerSettings'])!!}
    <div class="dc-securitysettings dc-search-banner-settings dc-tabsinfo">
        <div class="dc-tabscontenttitle la-switch-option">
            <h3>{{ trans('lang.search_banner_settings') }}</h3>
            <div class="float-right">
                <switch_button v-model="show_search_banner">{{{ trans('lang.show_or_hide_section') }}}</switch_button>
                <input type="hidden" :value="show_search_banner" name="show_search_banner">
            </div>
        </div>
        <div class="dc-sidepadding">
            <div class="dc-formtheme dc-userform">
                <fieldset class="how-it-tab-areas">
                 @if (!empty($home_search_banner))
                 @php $counter = 0; @endphp
                     <div class="form-group">
                        {!! Form::text('search_banner_subheading', e($home_search_banner->search_banner_subheading), ['class' =>
                            'form-control','placeholder'=>trans('Background Color')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('search_banner_btn_title', e($home_search_banner->search_banner_btn_title), ['class' =>
                            'form-control','placeholder'=>trans('Wave Color')]) !!}
                    </div>

                       <div class="dc-settingscontent dc-dbsectionspace  upload-imgresizehold">
                        <div class="dc-formtheme dc-userform">
                            @if (!empty($home_search_banner->hidden_search_banner_img))
                    @php
                        $search_banner_img = $home_search_banner->hidden_search_banner_img;
                    @endphp
                                <upload-media
                                :title="'{{ trans('lang.search_banner_image') }}'"
                                :img="'{{ $search_banner_img }}'"
                                :img_id="'search_banner_img'"
                                :img_name="'search_banner_img'"
                                :img_ref="'search_banner_img'"
                                :img_hidden_name="'hidden_search_banner_img'"
                                :img_hidden_id="'hidden_search_banner_img'"
                                :existed_img="'{{$search_banner_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/search_banner_img/banner_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$search_banner_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $search_banner_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $search_banner_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('lang.search_banner_image') }}'"
                                :img="'search_banner_img'"
                                :img_id="'search_banner_img'"
                                :img_name="'search_banner_img'"
                                :img_ref="'search_banner_img'"
                                :img_hidden_name="'hidden_search_banner_img'"
                                :img_hidden_id="'hidden_search_banner_img'"
                                :url="'{{ url("media/upload-temp-image/settings/search_banner_img/banner_img") }}'"
                                >
                                </upload-media>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::text('search_form_title', e($home_search_banner->search_form_title),['class' =>
                            'form-control','placeholder'=>trans('Small Text')]) !!}
                    </div>
                     <div class="form-group">
                        {!! Form::text('search_banner_heading', e($home_search_banner->search_banner_heading),['class' =>
                            'form-control','placeholder'=>trans('Large Text')]) !!}
                    </div>
   @foreach ($home_search_banner->tabs as $key => $value)
                        <div class="wrap-searchtabs-icons dc-haslayout">
                            <div class="form-group-holder">
                                <div class="form-group">
                                    {!! Form::text('tabs['.$counter.'][title]', e($value->title),
                                    ['class' => 'form-control', 'placeholder' => trans('Many Text')]) !!}
                                </div>                          
                                <div class="form-group dc-rightarea">
                                    @if ($key == 0 )
                                        <span class="dc-addinfobtn" style="display: inline-block;
    vertical-align: middle;
    line-height: 50px;
    min-width: 50px;
    padding: 0 20px;
    text-align: center;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;"@click="addsearchTab"><i class="fa fa-plus"></i></span>
                                    @else
                                        <span class="dc-addinfobtn dc-deleteinfo delete-searchtab"style="display: inline-block;
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
                    <div class="form-group">
                        {!! Form::text('search_banner_subheading', null, ['class' =>
                            'form-control','placeholder'=>trans('Background Color')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('search_banner_btn_title', null, ['class' =>
                            'form-control','placeholder'=>trans('Wave Color')]) !!}
                    </div>
                   <div class="dc-settingscontent dc-dbsectionspace  upload-imgresizehold">
                        <div class="dc-formtheme dc-userform">
                                <upload-media
                                :title="'{{ trans('lang.search_banner_image') }}'"
                                :img="'search_banner_img'"
                                :img_id="'search_banner_img'"
                                :img_name="'search_banner_img'"
                                :img_ref="'search_banner_img'"
                                :img_hidden_name="'hidden_search_banner_img'"
                                :img_hidden_id="'hidden_search_banner_img'"
                                :url="'{{ url("media/upload-temp-image/settings/search_banner_img/banner_img") }}'"
                                >
                                </upload-media>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::text('search_form_title', null,['class' =>
                            'form-control','placeholder'=>trans('Small Text')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('search_banner_heading', null,['class' =>
                            'form-control','placeholder'=>trans('Large Text')]) !!}
                    </div>
                    <div class="wrap-searchtabs-icons dc-haslayout">
                        <div class="form-group-holder">
                            <div class="form-group">
                                {!! Form::text('tabs[0][title]', null, ['class' => 'form-control',
                                'placeholder' => trans('Many Text')]) !!}
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
    cursor: pointer;" @click="addsearchTab"><i class="fa fa-plus"></i></span>
                        </div>
                    </div> 
                    @endif
                       <div class="wrap-searchtabs-icons dc-haslayout" v-for="(searchtab, index) in searchtabs" ref="howlistelements" v-cloak>
                    <div class="form-group-holder">
                        <div class="form-group">
                            <input placeholder="{{{trans('Many Text')}}}" v-bind:name="'tabs['+[searchtab.count]+'][title]'" type="text" class="form-control"
                                v-model="searchtab.tab_title">
                        </div>
                        <div class="form-group dc-rightarea">
                            <span class="dc-addinfo dc-deleteinfo dc-addinfobtn" style="display: inline-block;
    vertical-align: middle;
    line-height: 50px;
    min-width: 50px;
    padding: 0 20px;
    text-align: center;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;"@click="removeSearchTab(index)"><i class="fa fa-trash"></i></span>
                        </div>
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
