{!! Form::open(['url' => '', 'class' =>'dc-formtheme dc-userform', 'id' =>'map_img_section', '@submit.prevent'=>'submitMapImgSection'])!!}
    <div class="dc-securitysettings dc-tabsinfo">

         <div class="dc-settingscontent dc-dbsectionspace upload-imgresizehold">
            <div class = "dc-formtheme dc-userform">
                   @if (!empty($map_img))
                                     <upload-media
                                :title="'{{ trans('Map Image') }}'"
                                :img="'{{ $map_img }}'"
                                :img_id="'map_img'"
                                :img_name="'map_img'"
                                :img_ref="'map_img'"
                                :img_hidden_name="'hidden_map_img'"
                                :img_hidden_id="'hidden_map_img'"
                                :existed_img="'{{$map_img}}'"
                                :url="'{{ url("media/upload-temp-image/settings/map_img") }}'"
                                :existing_img_url="'{{ url("uploads/settings/home/$map_img") }}'"
                                :size = "'{{ Helper::getImageDetail( $map_img, 'size', 'uploads/settings/home') }}'"
                                :existing_img_name = "'{{ Helper::getImageDetail( $map_img, 'name', 'uploads/settings/home') }}'"
                                >
                                </upload-media>
                            @else
                                <upload-media
                                :title="'{{ trans('Map Image') }}'"
                                :img="'map_img'"
                                :img_id="'map_img'"
                                :img_name="'map_img'"
                                :img_ref="'map_img'"
                                :img_hidden_name="'hidden_map_img'"
                                :img_hidden_id="'hidden_map_img'"
                                :url="'{{ url("media/upload-temp-image/settings/map_img") }}'"
                                >
                                </upload-media>
                          @endif
                </div>
            </div>
    </div>
    <div class="dc-experienceaccordion">
        <div class="dc-updatall la-btn-setting">
            {!! Form::submit(trans('lang.btn_save'), ['class' => 'dc-btn']) !!}
        </div>
    </div>
{!! Form::close() !!}
